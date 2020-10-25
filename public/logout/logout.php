<?php

  setcookie("clientID", NULL,time() + 3600, '/');
  header("Location: ../login/login.php");
    

?>