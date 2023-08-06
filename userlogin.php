<!-- I certify that this submission is my own original work - Kristopher Lopez -->
<?php 
            session_start();
            if (isset($_SESSION['username'])) {
                // if yes, redirect to the main menu page
                $_SESSION["loggedin"] = "active";
                header("Location: main.php");
                exit();
            }
            
            ?><html>
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

    #message {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    }

        </style>


<script>
      function validate(form)
      {
        
        fail += validateUsername(form.username.value)
        fail += validatePassword(form.password.value)
        

        if   (fail == "")   return true
        else { alert(fail); return false }
      }

      

      function validateUsername(field)
      {
        if (field == "") return "No Username was entered.\n"
        else if (field.length < 5)
          return "Usernames must be at least 5 characters.\n"
        else if (/[^a-zA-Z0-9_-]/.test(field))
          return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.\n"
        return ""
      }

      function validatePassword(field)
      {
        if (field == "") return "No Password was entered.\n"
        else if (field.length < 6)
          return "Passwords must be at least 6 characters.\n"
        else if (! /[a-z]/.test(field) ||
                 ! /[A-Z]/.test(field) ||
                 ! /[0-9]/.test(field))
          return "Passwords require one each of a-z, A-Z and 0-9.\n"
        return ""
      }

      
    </script>

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
                        <form action="userlogin.php">
                            <button type="submit" id="button" class="btn btn-info" style="margin-top:11px;margin-left:<?php if (isset($_SESSION['username'])){echo "396px;";}else echo "465px;" ?>">Login</button>
                        </form>
                    </li>
                    <?php  
                    if (isset($_SESSION['username'])) {?>
                    <li><a href="logout.php">logout</a></li>
                        
                    <?php
                    }

                    ?>
                        
                </div>  
            </nav>
           

            
            <form  action="login2.php" onsubmit="return validate(this)" method="post">
                <div class="form-group">
                    <label for="user">User</label>
                    <input type="text" class="form-control" id="user" aria-describedby="emailHelp" placeholder="User" name="user">
                </div>
                <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="password" class="form-control" id="pass" placeholder="Password" name="pass">
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="signup.php" class="btn btn-secondary">Sign Up</a>
            </form>

            <?php
            if ( isset($_POST['user']) && $_POST['Username']=='good' ){
                $user = htmlentities($_POST['user']);
                 echo "<div id='message'><div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button>
                 <strong>Success!</strong> " . $user ." was Added to the database Please try logging in.
               </div></div>";
            }
            elseif ( isset($_POST['invalidUserPass']) && $_POST['invalidUserPass']=='good' ){
                 die("Invalid username/password combination");
            }
            elseif (isset($_SESSION['PleaseLogin'])) {
                echo "<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert'>&times;</button>
                 Please Log in before using functions.
              </div>";
              unset($_SESSION['PleaseLogin']);
              exit();
            }
            elseif ( isset($_POST['invalid']) && $_POST['invalid']=='good' ){
                header('WWW-Authenticate: Basic realm="Restricted Area"');
                header('HTTP/1.0 401 Unauthorized');
                die ("Please enter your username and password");
            }


            ?>


        </div>

        
        
    </body>
</html>