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

    #message {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    }

        </style> 


   

        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function(event) {
                const email = document.getElementById("email");
                const password = document.getElementById("pass");
                const confirmPassword = document.getElementById("confirmpass");
                const submitButton = document.getElementById("button");

                email.addEventListener("input", () => {
                    if (!email.validity.valid) {
                        email.setCustomValidity("Please enter a valid email address");
                    } else {
                        email.setCustomValidity("");
                    }
                });

                confirmPassword.addEventListener("input", () => {
                    if (password.value !== confirmPassword.value) {
                        confirmPassword.setCustomValidity("Passwords do not match");
                    } else {
                        confirmPassword.setCustomValidity("");
                    }
                });
            });


            
        

        </script>


        <script>
            function validate(form){
            fail  = validateUsername(form.user.value)
            fail += validatePassword(form.pass.value)
            
            fail += validateEmail(form.email.value)

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
            return "";
            }

            function validatePassword(field)
            {
            if (field == "") return "No Password was entered.\n"
            else if (field.length < 6)
                return "Passwords must be at least 6 characters.\n"
            else if (!/[a-z]/.test(field) || ! /[A-Z]/.test(field) ||
                    !/[0-9]/.test(field))
                return "Passwords require one each of a-z, A-Z and 0-9.\n"
            return "";
            }
            function validateEmail(field)
            {
            if (field == "") return "No Email was entered.\n"
                else if (!((field.indexOf(".") > 0) &&
                        (field.indexOf("@") > 0)) ||
                        /[^a-zA-Z0-9.@_-]/.test(field))
                return "The Email address is invalid.\n"
            return "";
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
                                
                                <!-- <li>
                                    <form action="userlogin.php" method="POST">
                                        <button type="submit" id="button" class="btn btn-info" style="margin-top:11px;margin-left:265px;">Login</button>
                                    </form>
                                </li> -->
                                <li>
                                    <form action="userlogin.php">
                                        <button type="submit" id="button" class="btn btn-info" style="margin-top:11px;margin-left:<?php  if (isset($_SESSION['username'])){echo "396px;";}else echo "465px;" ?>">Login</button>
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

                    <?php
                    if ( ISSET( $_POST['failedPassMatch'] ) ){
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>Passwords do not match. </strong>
                     </div>";
                    }
                    ?>

                <form method="post" id="signup" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validate(this)">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                        
                    </div>
                    <div class="form-group">
                        <label for="user">Username</label>
                        <input type="text" class="form-control" id="User" name="user" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" class="form-control" id="pass" name="pass"placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="confirmpass">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmpass" name="confirmpass"placeholder="Password">
                    </div>
                    
                    <button type="submit" id="button" class="btn btn-success" >Submit</button>
                </form>


                <?php
                    if ( isset($_POST['user']) && isset($_POST['email']) && isset($_POST['pass']) ){

                        function validate_username($field)
                        {
                            if ($field == "") return "No Username was entered<br>";
                            else if (strlen($field) < 5)
                            return "Usernames must be at least 5 characters<br>";
                            else if (preg_match("/[^a-zA-Z0-9_-]/", $field))
                            return "Only letters, numbers, - and _ in usernames<br>";
                            return "";		
                        }
                        function validate_password($field)
                        {
                            if ($field == "") return "No Password was entered<br>";
                            else if (strlen($field) < 6)
                            return "Passwords must be at least 6 characters<br>";
                            else if (!preg_match("/[a-z]/", $field) ||
                                    !preg_match("/[A-Z]/", $field) ||
                                    !preg_match("/[0-9]/", $field))
                            return "Passwords require 1 each of a-z, A-Z and 0-9<br>";
                            return "";
                        }
                        function validate_email($field)
                        {
                            if ($field == "") return "No Email was entered<br>";
                            else if (!((strpos($field, ".") > 0) &&
                                        (strpos($field, "@") > 0)) ||
                                        preg_match("/[^a-zA-Z0-9.@_-]/", $field))
                                return "The Email address is invalid<br>";
                            return "";
                        }

                        
                        function mysql_entities_fix_string($conn, $string)
                        {
                            return htmlentities(mysql_fix_string($conn, $string));
                        }    

                        function mysql_fix_string($conn, $string)
                        {
                            if (get_magic_quotes_gpc()) $string = stripslashes($string);
                            return $conn->real_escape_string($string);
                        }

                        function add_user($connection, $user, $em, $pw)
                        {
                            $errors = array();
                            $stmt = $connection->prepare('SELECT * FROM users WHERE username = ?');
                            $stmt->bind_param('s', $user);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $rows = $result->num_rows;

                            if ($rows > 0) {
                                echo ('<div id="message"><div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                Username <strong>'.$user.'</strong> already exists please enter a different username.
                            </div></div>');
                            } 
                            else 
                            {
                                $stmt = $connection->prepare('INSERT INTO users VALUES(?,?,?)');
                                $stmt->bind_param('sss', $user, $em, $pw);
                                $stmt->execute();

                                echo ( $user . " " . $em ." ".$pw);

                                if ($stmt->error) {
                                    $errors[] = $stmt->error;
                                    //echo '<script>console.log("Error: ' . implode(" | ", $errors) . '");</script>';
                                    echo ("Error : " . $stmt->error );
                                }
                                $stmt->close();

                                ?> <form action="userlogin.php" method="post" name="myform">
                                    <input type="hidden" id="Success" name="Username" value="good">
                                    <input type="hidden" name='user' value="<?php echo ''.$user.''; ?>">
                                </form>
                
                                <script type="text/javascript">
                                    document.myform.submit();
                                </script>
                
                                <?php
                                
                            }
                        
                    }

                    require_once 'login.php';
                    $conn = new mysqli($hn, $un, $pw, $db);

                    $username = mysqli_real_escape_string($conn, $_POST['user']);
                    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
                    $confirmpass = mysqli_real_escape_string($conn, $_POST['confirmpass']);
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $hash = password_hash($pass, PASSWORD_DEFAULT);

                    if ( $pass == $confirmpass ){ 

                    
                        $fail = validate_username($username);
                        $fail .= validate_password($pass);

                        $fail .= validate_email($email);

                        if ($fail == "")add_user($conn, $username , $email, $hash);
                        else{
                            die($fail);
                        }

                    }

                    else {

                        ?> 
                    <form action=" <?php echo $_SERVER["PHP_SELF"]; ?> " method="post" name="myform">
                        <input type="hidden" name='failedPassMatch' value="fail">
                    </form>
                
                                <script type="text/javascript">
                                    document.myform.submit();
                                </script>
                
                <?php

                    }
                    
                    

                } 


                

                ?>

            </div>
            
        </body>
</html>