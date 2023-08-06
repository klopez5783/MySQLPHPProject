<!-- I certify that this submission is my own original work - Kristopher Lopez -->
<?php session_start()?>
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
    	width: 1000px;
    	margin: 40px auto 0px auto;
    }

    #content {
    	background: #A8ACAB;
    	border: 8px #29293d solid;
    	height: 730px;

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


    .searchForm{
      margin: 10px 30px 0px auto;
      margin-left: 30px;
    }

    #font{
      font-family: "Lucida Bright", Georgia, serif;
    }

    #errorimg{
    display: block;
    margin-left: auto;
    margin-right: auto;
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
                        <button type="submit" id="button" class="btn btn-info" style="margin-top:11px;margin-left:<?php if (isset($_SESSION['username'])){echo "645px;";}else echo "265px;" ?>">Login</button>
                        </form></li>
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

            <div class="searchForm">
            
              <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >

              <?php 
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
              ?>

                    

                    <div style="display:flex;">

                        <div class="formField">
                          <div for="FieldSearch" id="font">Select a field to search in: </div>


                          <div class="dropdown">
                            <select name="FieldSearch" id="FieldSearch" required class="btn btn-secondary dropdown-toggle">
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"></div>
                              <option value="TeamName" class="dropdown-item">Team</option>
                              <option value="FirstName" class="dropdown-item">FirstName</option>
                              <option value="LastName" class="dropdown-item">LastName</option>
                              <option value="Height" class="dropdown-item">Height</option>
                              <option value="StrongFoot"class="dropdown-item">StrongFoot</option>
                              <option value="Weight_LBS" class="dropdown-item">Weight</option>
                              <option value="Nationality" class="dropdown-item">Nation</option>
                              <option value="KitNumber" class="dropdown-item">KitNumber</option>
                            </select>
                          </div>

                          <div class="valueSearch" id="font">
                            Enter a value to search for:
                          </div>
                          <input type="text" name="valueSearch" class="form-control" placeholder="Search Value" required class="formField" style="width:200px;">

                          <div>
                            <input type="submit" value="Submit" id="SubmitButton" class="btn btn-success" style="margin-top:10px;">
                          </div>

                        </div>
                              
                        <div class="GifDiv" style="block-size: 200px;">

                                <img src="Juggling.gif" width="200" height="150" style="margin-left:450px;">
                
                        </div>

                    </div>
            

              </form>

            </div>


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

                          if (isset($_POST['FieldSearch']) && isset($_POST['valueSearch'])) {
                              require_once 'login.php';

                              $conn = new mysqli($hn, $un, $pw, $db);

                              $column = mysql_entities_fix_string($conn, $_POST['FieldSearch']);
                              $input = mysql_entities_fix_string($conn, $_POST['valueSearch']);

                              if ($conn->connect_error) {
                                  die("Fatal Connection");
                              }

                              $query = "SELECT * FROM players WHERE $column LIKE '%$input%';";

                              $result = $conn->query($query);
                              if (!$result) {
                                  echo("Error description: " . $conn->error . "/n");
                              }
                              if (!$result) {
                                  die("Database Connection Failed");
                              }

                              $rows = $result->num_rows;

                              if ($rows > 0) {
                                  echo '<div style="margin-left:30px;">';

                                  echo '<table class="tableclass"><tr> 
                                      <th>Player ID</th>
                                      <th>Team Name</th>
                                      <th>First Name</th>
                                      <th>Last Name</th>
                                      <th>Height (Inches)</th>
                                      <th>Strong Foot</th>
                                      <th>Weight (lbs)</th>
                                      <th>Nationality</th>
                                      <th>Kit Number</th>
                                      </tr>';

                                  for ($j = 0; $j < $rows; ++$j) {
                                      $result->data_seek($j);
                                      $row = $result->fetch_array(MYSQLI_NUM);

                                      $r0 = htmlspecialchars($row[0]);
                                      $r1 = htmlspecialchars($row[1]);
                                      $r2 = htmlspecialchars($row[2]);
                                      $r3 = htmlspecialchars($row[3]);
                                      $r4 = htmlspecialchars($row[4]);
                                      $r5 = htmlspecialchars($row[5]);
                                      $r6 = htmlspecialchars($row[6]);
                                      $r7 = htmlspecialchars($row[7]);
                                      $r8 = htmlspecialchars($row[8]);

                                      echo '<tr>';
                                      echo "<td>$r0</td>";
                                      echo "<td>$r1</td>";
                                      echo "<td>$r2</td>";
                                      echo "<td>$r3</td>";
                                      echo "<td>$r4</td>";
                                      echo "<td>$r5</td>";
                                      echo "<td>$r6</td>";
                                      echo "<td>$r7</td>";
                                      echo "<td>$r8</td>";
                                      echo '<td>
                                          <form action="DeletePlayers.php" method="post">
                                          <input type="hidden" name="delete" value="yes">
                                          <input type="hidden" name="id" value="' . $r0 . '">
                                          <input type="submit" class="btn btn-danger" style="width:80px;" value="DELETE"></td></form>';
                                      echo '</tr>';
                                  }

                                  echo '</table>';
                                  echo '</div>';

                                  $result->close();
                                  $conn->close();
                            }
                            else {
                              echo '<div class="errorGif">
                              <img src="ezgif.com-gif-maker.gif" width="200" height="230" id="errorimg">
                              <div class="alert alert-danger" role="alert" style="text-align:center;">No Records Where Found, Please Try a Different Criteria.</div>
                              </div>';
    
                            } 
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