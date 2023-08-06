<!-- I certify that this submission is my own original work - Kristopher Lopez -->
<html>
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
    	height: 580px;

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

    #ImgFormFlex{
        display: flex;
        margin: 10px auto 0px auto;
    }

    #formField{
        margin-top: 5px;
    }

    label {
        display: inline-block;
        width: 150px;
        text-align: right;
    }

    #playerimg{
        width: 225px;
        height: 225px;
        margin-left: 90px;
    }

    #button{
        float:right;
        margin-right:40px;
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
                    <form method='post' action=" <?php echo $_SERVER["PHP_SELF"]; ?> ">
                            <input type="hidden" name="clicked" value="<?php session_start(); if (isset($_SESSION['username']) && isset($_SESSION['loggedin'])){echo "true";}else{echo "False";}?>">
                            <button type="submit"  class="btn btn-info"  
                            style="margin-top:11px;margin-left:<?php  if (isset($_SESSION['username'])){echo "380px;";}else echo "465px";?>" 
                            >Login</button>
                        </form>
                    </li>

                    <?php  
                    if (isset($_SESSION['username'])) {?>
                    <li>
                        <form action="logout.php">
                            <button type="submit"  class="btn btn-danger" style="margin-top:11px;margin-left:7px;">Log Out</button>
                        </form>
                    
                    </li>
                    <?php
                    }

                    ?>
                        
                </div>  
            </nav>


            <form method='post' action=" <?php echo $_SERVER["PHP_SELF"]; ?> ">

                <div style="text-align:center;font-size:20px;">
                    Enter Player Information
                </div>

                <?php 

                if (isset($_POST['clicked'])) {
                    // Set a flag in the session
                    $_SESSION['login_clicked'] = true;
                }

                if ( isset($_POST['AddedPlayer']) ){
                    $user = htmlentities($_POST['AddedPlayer']);
                     echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button>
                     <strong>Success!</strong> " . $user ." was Added to the database. 
                   </div>";
                }
                
                if (isset($_SESSION['username']) && isset( $_SESSION['login_clicked'] ) ) {
                    $user = htmlentities($_SESSION['username']);
                    echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button>
                         <strong>" . $user ."</strong> is already logged in.
                      </div>";
                    // Unset the login clicked flag
                    unset($_SESSION['login_clicked']);
                }
                ?>

                

                <div id="ImgFormFlex">

                    <div id="form">

                        <div>
                        <label for="TeamName">Team Name:</label>
                        <input type="text" id="formfield" required name="TeamName">
                        </div>

                        <div>
                        <label for="FirstName">First Name:</label>
                        <input type="text" id="formfield" required name="fname">
                        </div>


                        <div>
                            <label for="LastName">Last Name:</label>
                            <input type="text" id="formfield" required name="lname">
                        </div>

                        <div>
                        <label for="Height">Enter Height (Inches):</label>
                            <input type="int" id="formfield" required name="height">
                        </div>

                        <div>
                        <label for="foot">Strong Foot:</label>
                            <input type="text" id="formfield" required name="foot">
                        </div>

                        <div>
                        <label for="Weight">Weight:</label>
                            <input type="text" id="formfield" required name="weight">
                        </div>

                        <div>
                        <label for="nation">Nationality</label>
                            <input type="text" id="formfield" required name="nation">
                        </div>

                        <div>
                        <label for="kit">Kit Number:</label>
                            <input type="int" id="formfield" required name="kit">
                        </div>
                        
                    </div>

                    <div>
                        <img src="AddPlayer.png" id="playerimg" alt="" style="width:180px;height:200px;margin-top:40px;">
                    </div>


                </div>


                <input type="submit" value="Submit" class="btn btn-success" id="button">

            </form> 



            <?php 

                if (isset($_SESSION['username']) ){
                    
                    if ( isset($_POST['TeamName']) ){
                        function mysql_entities_fix_string($conn, $string)
                    {
                        return htmlentities(mysql_fix_string($conn, $string));
                    }    

                    function mysql_fix_string($conn, $string)
                    {
                        if (get_magic_quotes_gpc()) $string = stripslashes($string);
                        return $conn->real_escape_string($string);
                    }

                    require_once 'login.php';
                    $conn = new mysqli($hn, $un, $pw, $db);

                    $team = mysqli_real_escape_string($conn, $_POST['TeamName']);
                    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
                    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
                    $height = mysqli_real_escape_string($conn, $_POST['height']);
                    $foot = mysqli_real_escape_string($conn, $_POST['foot']);
                    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
                    $nation = mysqli_real_escape_string($conn, $_POST['nation']);
                    $kitNum = mysqli_real_escape_string($conn, $_POST['kit']);

                    $query = $conn->prepare("INSERT INTO Players(TeamName, FirstName, LastName, Height, StrongFoot, Weight_LBS, Nationality, KitNumber) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

                    $query->bind_param('ssssssss', $team, $fname, $lname, $height, $foot, $weight, $nation, $kitNum);

                    if ($conn->connect_error) die("Fatal Error");

                    // $result = $conn->query($query);

                    $query->execute();

                    

                    if ($conn->affected_rows > 0) {
                        ?>
                    <form action=" <?php echo $_SERVER["PHP_SELF"]; ?> " method="post" name="myform">
                        <input type="hidden" name='AddedPlayer' value="<?php echo ''.$fname.''; ?>">
                    </form>

                    <script type="text/javascript">
                        document.myform.submit();
                    </script>

                    <?php
                    }
                    else {
                        echo("<div style='color:#cc0000;font-size:18px;margin:5px auto 0px auto;'>Error description: " . $conn -> error."</div>");
                        echo "<div font-size:18px;>Please enter correct value inputs for form to be valid.</div>";
                        echo "<img src='error.gif' style='margin:40px 50px 0px 250px;'>";

                    }
                    }

                    
                }
                else
                {
                    $_SESSION["PleaseLogin"] = "active";
                    ?>
                    <form action="userlogin.php" method="post" name="myform">
                        <input type="hidden"  value="">
                    </form>

                    <script type="text/javascript">
                        document.myform.submit();
                    </script>

                    <?php
                 }


            ?>


            

        </div>
        
    </body>
</html>