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

        </style>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

    </head>
    <body>
        <div id="content">
            <div id="Heading">
                Soccer Database
            </div>

            <form action="">

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
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Teams<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="">List Teams</a></li>
                            <li><a href="#">Search Teams</a></li>
                            <li><a href="DeleteTeam.php">Delete Team</a></li>
                        </ul>
                    </li>
                    <li><a href="#">View Fixtures</a></li>
                    <li>
                        <form action="userlogin.php">
                        <button type="submit" id="button" class="btn btn-info" style="margin-top:11px;margin-left:265px;">Login</button>
                        </form></li>
                    <?php  
                    session_start();
                    if (isset($_SESSION['username'])) {?>
                    <li><a href="logout.php">logout</a></li>
                    <?php
                    }

                    ?>
                        
                </div>  
            </nav>
            </form>
            
            
            <?php 

                if (isset($_SESSION['username'])){
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
                <form action="Main.php" method="post" name="myform">
                    <input type="hidden" id="Success" name="Success" value="good">
                    <input type="hidden" name='fname' value="<?php echo ''.$fname.''; ?>">
                </form>

                <script type="text/javascript">
                    document.myform.submit();
                </script>

                <?php
                } else {
                    echo("<div style='color:#cc0000;font-size:18px;margin:5px auto 0px auto;'>Error description: " . $conn -> error."</div>");
                    echo "<div font-size:18px;>Please return to previous page and enter correct input types.</div>";
                    echo "<img src='error.gif' style='margin:40px 50px 0px 250px;'>";

                }
                }
                else{
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