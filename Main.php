<!-- I certify that this submission is my own original work - Kristopher Lopez -->
<?php session_start(); ?><html>
    <head>
        <title>CapStone Project</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <style type="text/css">
            body{
    background-image: url("SeamlessPicSoccer.jpg");
    ba  ckground-repeat: repeat;
    background-size: 700px;
    }

    #content{
    	width: 730px;
    	margin: 40px auto 0px auto;
    }

    #content {
    	background: #A8ACAB;
    	border: 8px #29293d solid;
    	height: 530px;

    	background-repeat: no-repeat;
    	background-position: 90% 50%;
    	border-radius: 15px;
    }

    #Heading{
        font-family:"Monospace";
        text-align: center;
        font-size: 45px;
        margin: 10px auto 10px auto;
    }

    #navbar{   
        height: 55px;
        margin: 10px auto 0px auto;
        background-color: white;
        display: flex;
        
    }


    .navItem{
        margin: 13px auto 0px auto;
        font-size: 20px;
        font-family: "Lucida Bright", Georgia, serif;
    }

    #buttons{
        display: flex;
        margin: 20px auto 0px auto;
        width: 100%;
    }

    #AddPlayers{
        margin:40px;
    }
    #ListPlayers{
        margin:40px;
    }
    #SearchPlayers{
        margin:40px;
    }

        </style>

    </head>
    <body>
        <div id="content">
            <div id="Heading">
                Soccer Database
            </div>


            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                    <a href="Main.php"><img id ="navimg"  src="bench.png" alt="" style="width: 65px;
                        height: 60px;
                        background-size: 60px 70px;
                        padding-bottom: 10px;
                        margin-right: 5px;"></a>
                    </div>
                    <ul class="nav navbar-nav">
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Players<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="ListPlayers.php">List Players</a></li>
                            <li><a href="SearchPlayers.php">Search Players</a></li>
                            <li><a href="InsertPlayers.php">Add Player</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <form method='post' action=" <?php if (isset($_SESSION['username'])){ echo $_SERVER["PHP_SELF"]; }else echo "userlogin.php"; ?> ">
                            <input type="hidden" name="clicked" value="<?php if (isset($_SESSION['username']) && isset($_SESSION['loggedin'])){echo "true";}else{echo "False";}?>">
                            <button type="submit" id="button" class="btn btn-info" style="margin-top:11px;margin-left:<?php if (isset($_SESSION['username'])){echo "380px;";}else echo "465px;"; ?>">Login</button>
                        </form>
                    </li>
                    <?php  
                    if (isset($_SESSION['username'])) {?>
                    <li>
                    <form action="logout.php">
                        <button type="submit" id="button" class="btn btn-danger" style="margin-top:11px;margin-left:7px;">Log Out</button>
                    </form>
                    
                    </li>
                    <?php
                    }

                    ?>
                        
                </div>  
            </nav>

            

            <?php

                if (isset($_POST['clicked'])) {
                    // Set a flag in the session
                    $_SESSION['login_clicked'] = true;
                }
                
                if ( isset($_POST['Success']) && $_POST['Success']=='good')
                {
                    $fname = htmlentities($_POST['fname']);
                     echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button>
                     <strong>Success!</strong> " . $fname ." was added to the database.
                   </div>";
                }
                
                elseif (isset($_SESSION['username']) && isset($_SESSION['loggedin']) && isset( $_SESSION['login_clicked'] ) ) {
                    $user = htmlentities($_SESSION['username']);
                    echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>" . $user ."</strong> is already logged in.
                    </div>";
                    // Unset the login clicked flag
                    unset($_SESSION['login_clicked']);
                }
                elseif (isset($_SESSION['username'])) {
                    $user = htmlentities($_SESSION['username']);
                    // if yes, redirect to the main menu page
                    echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button>
                     <strong>" . $user ."</strong> is logged in.
                  </div>";
                    
                }
                elseif (isset($_POST['logout']) ) {
                    echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button>
                     User ".($_POST['logout'])." Logged out succesfully.
                  </div>";
                    
                }
                
            ?>

                <div id="buttons">
                    <div id="AddPlayers">
                        <a href="InsertPlayers.php">
                        <img id="navimg" src="AddPlayer.png" alt="" style="width: 125px;
                                        height: 150px;
                                        padding-bottom: 10px;
                                        margin-right: 5px;">
                        </a>
                        <div>
                            Click here to Add a player
                        </div>
                    </div>
                    <div id="SearchPlayers">
                        <a href="SearchPlayers.php">
                        <img id="navimg" src="SearchPlayeer.png" alt="" style="width: 155px;
                                        height: 150px;
                                        background-size: 60px 70px;
                                        padding-bottom: 10px;
                                        margin-right: 5px;">
                        </a>
                        <div>
                            click here to search for a player
                        </div>
                    </div>
                    <div id="ListPlayers">
                        <a href="ListPlayers.php">
                        <img id="navimg" src="ListPlayers.png" alt="" style="width: 165px;
                                        height: 160px;
                                        background-size: 60px 70px;
                                        padding-bottom: 10px;
                                        margin-right: 5px;">
                        </a>
                        <div>
                            Click here to list all players
                        </div>
                    </div>
                </div>


            

        </div>
        
    </body>
</html>