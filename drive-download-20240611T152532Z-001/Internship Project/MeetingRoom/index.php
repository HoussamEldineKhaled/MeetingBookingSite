<html>
    <head>


        <style>
            body{
                background-color:rgb(255, 240, 220);
            }
            .Logo{
                position: absolute;
                left: 0;
                top: 0;
                width: 300px;
                height: 290px;
            }
            .welc{
                height: 500px;
                width: 600px;

            }
            #Prop{
                
                width: 743px;
                height: 100px;
                margin-top: 120px;
                margin-left: 63%;
                font-size: 30px;
                
            }
            a{
                text-decoration: none;
                color: black;
                margin: 30px;
            
            }
            a:hover{
                color:brown;
            }

            #MiddleSection{
                height: 150px;
                margin-top: 100px;
                text-align: center;
                
            }
            #LoginB{
                font-size:30px;
                font-family: 'Times New Roman', Times, serif;
                width: 40%;
                height: 50%;
                border: none;
                background-color: burlywood;
                border-radius: 10px;
            }
            #LoginB:hover{
                background-color:rgb(196, 120, 20);
            }




        </style>

    </head>


    <body>
        <header>
            <img class="Logo" src="../MeetingRoom/Frontend/img/Logo.png"></img>
            <div id="Prop">
                <a href="About.html">About Us</a>
                <a href="Contact.html">Contact Us</a>
                <a href="..\MeetingRoom\Frontend\testlogin.html">
                <button id="LoginB">Login</button>
                </a>
            </div>
            
        </header>

        <div id="MiddleSection">
            <h1>Welcome to The Website</h1>
            <img class="welc" src="../MeetingRoom/Frontend/img/Welcome.png">
            
        </div>
        
        
    </body>


</html>