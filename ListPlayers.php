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
    	width: 1200px;
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

    #navimg{
        width: 70px;
        height: 60px;
        background-size: 60px 70px;
        padding-bottom: 10px;
        margin-right: 5px;
    }

    .tableclass{
        width: 95%;
        margin: 5px 10% 0px 1%;
    }

    #empty{
        text-align: center;
        font-size: 30px;
        margin-top: 60px;
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
                            <input type="hidden" name="clicked" value="<?php if (isset($_SESSION['username']) && isset($_SESSION['loggedin'])){echo "true";}else{echo "False";}?>">
                            <button type="submit" id="button" class="btn btn-info" style="margin-top:11px;margin-left:<?php session_start(); if (isset($_SESSION['username'])){echo "845;";}else echo "805px;" ?>">Login</button>
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
            if (isset($_SESSION['username'])){

                require_once 'login.php';

                $conn = new mysqli ( $hn, $un , $pw , $db ) ;

                $query = "select * from players;";

                
                $result = $conn->query($query);
                if (!$result) die ("Database access failed");


                $rows = $result->num_rows;

                

                if (isset($_POST['clicked'])) {
                    // Set a flag in the session
                    $_SESSION['login_clicked'] = true;
                    
                }

                if (isset($_SESSION['username']) && isset( $_SESSION['login_clicked'] ) ) {
                    $user = htmlentities($_SESSION['username']);
                    echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button>
                         <strong>" . $user ."</strong> is already logged in.
                      </div>";
                    // Unset the login clicked flag
                    unset($_SESSION['login_clicked']);
                }

                if( isset($_POST['Delete']) && $_POST['Delete']=='good' ){

                    $fname = htmlentities($_POST['fname']);
                    echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Success!</strong> " . $fname ." was DELETED from the database.
                </div>";
    
                }
                
                

                echo "<table class='tableclass'><tr> 
                    <th>Player ID</th>
                    <th>Team Name</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Height(Inches)</th>
                    <th>Strong Foot</th>
                    <th>Weight(lbs)</th>
                    <th>Nationality</th>
                    <th>Kit Number</th>
                </tr>";

                

                for ($j = 0 ; $j < $rows ; ++$j)
                {
                    

                    $result->data_seek($j);
                    $row = $result->fetch_array(MYSQLI_NUM);

                    

                    $r0 = htmlspecialchars($row[0]);

                    echo "<tr>";
                    for ($k = 0 ; $k < 9 ; ++$k){
                    echo "<td>" . htmlspecialchars($row[$k]) . "</td>";
                    }
                    echo "<td>
                    <form action='DeletePlayers.php' method='post'>
                    <input type='hidden' name='delete' value='yes'>
                    <input type='hidden' name='id' value='$r0'>
                    <input type='submit' class='btn btn-danger' style='width:80px;' value='DELETE'></td></form>";
                    echo "</tr>";
                }

                echo "</table>";


                if ($rows == 0){
                    echo ("
                        <div id='empty'>Player Table is empty. Please add some records using the 'Add Player' tool.</div>
                    ");
                }
            }
            else{
                $_SESSION["PleaseLogin"] = "active";
                header("Location: userlogin.php");
                exit();
            }

?>

        </div>
        
    </body>
</html>