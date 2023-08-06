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

                    require_once 'login.php';

                    $conn = new mysqli ( $hn, $un , $pw , $db ) ;

                    $id = htmlentities($_POST['id']);

                    $query = "select FirstName from players where PlayerID = " . $id . ";";

                    $result = $conn->query($query);

                    $rows = $result->num_rows;

                    $row = $result->fetch_array(MYSQLI_NUM);

                    $name = htmlspecialchars($row[0]);

                    $query = "Delete from players where PlayerID = " . $id . ";";

                    $result = $conn->query($query);
                    if (!$result) die ("Database access failed");

                    ?>

                        <form action="ListPlayers.php" method="post" name="myform">
                            <input type="hidden" id="Delete" name="Delete" value="good">
                            <input type="hidden" name='fname' value="<?php echo $name; ?>">
                        </form>

                        <script type="text/javascript">
                            document.myform.submit();
                        </script>

                <?php

                    
                ?>

        </div>
        
    </body>
</html>