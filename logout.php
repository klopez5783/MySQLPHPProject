<!-- I certify that this submission is my own original work - Kristopher Lopez -->
<?php
  session_start();

  if (isset($_SESSION['username']))
  {
    $user = $_SESSION['username'];

    ?>
    <form action="main.php" method="post" name="myform">
        <input type="hidden" id="Success" name="logout" value="<?php echo $user; ?>">
    </form>

    <script type="text/javascript">
        document.myform.submit();
    </script>

    <?php

destroy_session_and_data();

	
    
  }
  else{
    $_SESSION['logout'] = "active";
    header("Location: main.php");
    exit();
  }
  function destroy_session_and_data()
  {
    $_SESSION = array();
    setcookie(session_name(), '', time() - 2592000, '/');
    session_destroy();
  }
?>