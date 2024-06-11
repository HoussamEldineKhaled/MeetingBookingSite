<html>

<head>
    <script>
        $(document).ready(function () {
            $("#LoginB").click(function () {
                $.ajax({
                    type: "POST",
                    url: "logout.php",
                    success: function (data) {
                        window.location.href = "login.html";
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log("Logout failed: " + errorThrown);
                    }
                });
            });
        });
    </script>
    <style>
        body {
            background-color: rgb(255, 240, 220);
        }

        .Logo {
            position: absolute;
            left: 0;
            top: 0;
            width: 300px;
            height: 290px;
        }

        .welc {
            height: 500px;
            width: 600px;

        }

        #Prop {

            width: 1039px;
            height: 90px;
            margin-top: 120px;
            margin-left: 50%;
            font-size: 30px;

        }

        a {
            text-decoration: none;
            color: black;
            margin: 30px;

        }

        a:hover {
            color: brown;
        }

        #MiddleSection {
            height: 150px;
            margin-top: 100px;
            text-align: center;

        }

        #LoginB {
            font-size: 30px;
            font-family: 'Times New Roman', Times, serif;
            width: 20%;
            height: 50%;
            border: none;
            background-color: burlywood;
            border-radius: 10px;
        }

        #LoginB:hover {
            background-color: rgb(196, 120, 20);
        }
    </style>

</head>


<body>
    <header>
        <img class="Logo" src="../Frontend/img/Logo.png"></img>
        <div id="Prop">
            <a href="calendar.html">Calendar</a>
            <a href="">Admin Hub</a>
            <a href="About.html">About Us</a>
            <a href="Contact.html">Contact Us</a>
            <a href="index.html">
                <button id="LoginB">Logout</button>
            </a>
        </div>

    </header>

    <div id="MiddleSection">
        <h1>Welcome to the Schedumeet Admin Page</h1>
        <img class="welc" src="../Frontend/img/ManagerKing.png">

    </div>


</body>


</html>