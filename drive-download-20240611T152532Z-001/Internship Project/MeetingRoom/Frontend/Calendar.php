<?php
session_set_cookie_params(2400);
session_start();

if (isset($_SESSION['Id']) && isset($_SESSION['UserName']) && isset($_SESSION['UserRole']) &isset( $_SESSION['UserCompany'])) {
    $userId = $_SESSION['Id'];
    $userName = $_SESSION['UserName'];
    $userRole = $_SESSION['UserRole'];
    $userCompany= $_SESSION['UserCompany'];

   
} else {
    header("Location: ../Frontend/testlogin.html");
    exit(); 
}?>
<html>
<head>
    <title>Meeting Calendar</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(255, 240, 220);
            margin: 0;
            padding: 0;
        }

        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #ffffff;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .Logo {
            width: 100px;
            height: 100px;
        }

        #Prop {
            font-size: 18px;
        }

        a {
            text-decoration: none;
            color: black;
            margin: 0 15px;
        }

        a:hover {
            color: brown;
        }

        #MiddleSection {
            height: 150px;
            margin-top: 100px;
            text-align: center;
        }

        .calendar {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f7f7f7;
        }

        .date {
            background-color: #fff;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            margin-right: 5px;
        }

        select,
        input[type="datetime-local"],
        input[type="number"] {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        button {
            padding: 8px 15px;
            background-color: burlywood;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            color: #fff;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: rgb(196, 120, 20);
        }

        #createForm {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }
    </style>
    <script>
    $(document).ready(function(){
        $("#LoginB").click(function(){
            $.ajax({
                type: "POST", 
                url: "../php/services/SystemUserLogout.php", 
                success: function (data) {
                    window.location.href = "../Frontend/testlogin.html";
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log("Logout failed: " + errorThrown);
                }
            });
        });
    });
    </script>
</head>

<body>
    <header>
        <img class="Logo" src="../Frontend/img/Logo.png" alt="Logo">
        
        <div id="Prop">
            <a href="About.html">About Us</a>
            <a href="Contact.html">Contact Us</a>
            <button id="LoginB">Logout</button>
        </div>
        <span style="margin-left: 10px;">Welcome <?php echo $userName ?></span>
    </header>

    <div id="MiddleSection">
        <h1 id="meet">Upcoming Meetings:
        </h1>
        <div>
        <label for="sorting">Sort by:</label>
        <select id="sorting">
            <option value="startTime">Start Time</option>
            <option value="date">Date</option>
        </select>
    </div>
    <div class="calendar" id="calendar">
        <!-- Dates will be populated here -->
    </div>
    <h1>Schedule Meeting:</h1>
    <form id="createForm">
        <label>Start Time:</label>
        <input type="datetime-local" id="startTimeInput">
        <br>
        <label>End Time:</label>
        <input type="datetime-local" id="endTimeInput">
        <br>
        <label>Related Room:</label>
        <select id="relatedRoomSelect"></select>
        <br>
        <label>Number of Attendees:</label>
        <input type="number" id="numAttendeesInput">
        <br>
        <button type="submit">Create Meeting</button>
    </form>
    <button id="displayAllButton">Display All Meetings</button>


</div>
    
    
    <script>
        

       // Format time in 12-hour format



        $(document).ready(function () {
            var allRooms = [];
//Util functions
function formatTime(dateString) {
    const [datePart, timePart] = dateString.split(' ');
    const [year, month, day] = datePart.split('-');
    const [hours, minutes] = timePart.split(':');

    const formattedDate = new Date(year, month - 1, day, hours, minutes);
    return new Intl.DateTimeFormat('en-US', { hour: 'numeric', minute: 'numeric', hour12: true }).format(formattedDate);
}




        // Sort dates based on selected criteria
        function sortDates(dates,criteria) {
            switch (criteria) {
                case "startTime":
                    dates.sort((a, b) => new Date(a.StartTime) - new Date(b.StartTime));
                    break;
                case "date":
                    dates.sort((a, b) => new Date(a.StartTime).getTime() - new Date(b.StartTime).getTime());
                    break;
                default:
                    break;
            }
        }

        // Populate the calendar with dates and meetings
        // Populate the calendar with dates and meetings
function populateCalendar(dates) {
    const calendarElement = $("#calendar");
    const currentDate = new Date();
    const sortingCriteria = $("#sorting").val();

    sortDates(dates, sortingCriteria); // Pass the dates data here

    calendarElement.empty(); // Clear previous entries

    dates.forEach(date => {
        const startTime = new Date(date.StartTime.replace(/-/g, '/')); // Convert dashes to slashes
        if (startTime < currentDate) {
            return; // Skip dates before the current day
        }
        const room = allRooms.find(room => room.RoomId === date.RelatedRoom);
        const roomName = room ? room.RoomLocation : "Room not found";
        const dateDiv = $("<div>")
            .addClass("date")
            .text(formatTime(date.StartTime) + " - " + formatTime(date.EndTime) + " " + roomName + " " + startTime.toDateString());

        calendarElement.append(dateDiv);
        
       
    });
}


//Util functions end

//Room Select
const relatedRoomSelect=$("#relatedRoomSelect");
$.ajax({
    type: 'POST',
    url: '../php/Controllers/RoomController.php', 
    data: {
        action: 'getByCompany',
        Id: <?php echo  $userCompany; ?>
    },
    dataType: 'json',
    success: function(response) {
        allRooms=response;
        relatedRoomSelect.empty(); // Clear any previous options
        response.forEach(room => {
            const option = $('<option>').text(room.RoomLocation); 
            relatedRoomSelect.append(option);
        });

        //Meeting Fetching
        $.ajax({
    type: 'POST',
    url: '../php/Controllers/MeetingController.php',
    data: {
        action: 'getByManager',
        Id: <?php echo $userId; ?> // Fix here
    },
    dataType: 'json',
    success: function(response) {
    if (response) {
        populateCalendar(response);

        $("#sorting").on("change", function() {
            populateCalendar(response); // Pass the response data
        });
    } else {
        $("#calendar").append($("<h1>").text("No Meetings Available"));
    }
},


    error: function(xhr, status, error) {
        console.log("AJAX request error:", status, error);
    }
});
        //Meeting Fetching End
    },
    error: function(xhr, status, error) {
        alert("This meeting date is already taken")
        console.log("AJAX request error:", status, error);
    }
});

//Room select end


            $('form').submit(function(event) {
                event.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../php/Controllers/MeetingController.php',
            data: {
                action : 'create',
            StartTime : $('#startTimeInput').val(),
           EndTime :$('#endTimeInput').val(),
            RelatedRoom :$('#relatedRoomSelect').val(),
            NumberOfAttendees : $('#numAttendeesInput').val(),
            MeetingStatus : 1,
            MeetingManagerId : <?php echo  $userId; ?>
            },
            dataType: 'json',
            success: function(response) {
               if(response.error)
               alert("Time conflict: another meeting is set at this time");
               else{
               alert("meeting successfully created.");
               location.reload();
               }

            },
            error: function(xhr, status, error) {
                console.log("AJAX request error:", status, error);
            }
        });
    });

         
          

// ...
// Function to populate calendar with meetings by other managers
function populateOtherManagerMeetings(meetings) {
        const calendarElement = $("#calendar");
        const currentDate = new Date();
        const sortingCriteria = $("#sorting").val();

        sortDates(meetings, sortingCriteria);

        calendarElement.empty();

        meetings.forEach(meeting => {
            const startTime = new Date(meeting.StartTime.replace(/-/g, '/'));
            if (startTime < currentDate) {
                return;
            }
            const host= allUsers.find(user=>user.Id === meeting.MeetingManagerId);
        const UserName = host ? host.UserName: "User not found";
            const room = allRooms.find(room => room.RoomId === meeting.RelatedRoom);
        const roomName = room ? room.RoomLocation : "Room not found";
           console.log(room);
                    const dateDiv = $("<div>")
                        .addClass("date")
                        .html(formatTime(meeting.StartTime) + " - " + formatTime(meeting.EndTime) + " Host: <b>" + UserName + "</b> Location: " + roomName + " " + startTime.toDateString());

                    calendarElement.append(dateDiv);
               
        });
    } // Flag to track "Display Other" mode

// Function to toggle button text

var allUsers=[];
// Button click event to fetch and display meetings by other managers
$("#displayAllButton").click(function () {

    
        $.ajax({
            type: 'POST',
            url: '../php/Controllers/SystemUserController.php',
            data: {
                action: 'getAll',
               
            },
            dataType: 'json',
            success: function (response) {
                allUsers=response;
                
            $.ajax({
                type: 'POST',
            url: '../php/Controllers/MeetingController.php',
            data: {
                action: 'getByOtherManagers',
                Id: <?php echo $userId; ?>
            },
            dataType: 'json',
            success: function (response) {
                if ($("#displayAllButton").text() === "Display Your Meetings") {
                    location.reload();
        } 
                if (response) {
                    $("#displayAllButton").text("Display Your Meetings");
                    $("#meet").text("Other Up Meetings:");
                    populateOtherManagerMeetings(response);
                } else {
                    $("#calendar").append($("<h1>").text("No Meetings Available"));
                }
            },
            error: function (xhr, status, error) {
                console.log("AJAX request error:", status, error);
            }
        });
               
            },
            error: function (xhr, status, error) {
                console.log("AJAX request error:", status, error);
            }
        });
        
    });
});
        
            
       
    </script>
        
    </body>



</html>