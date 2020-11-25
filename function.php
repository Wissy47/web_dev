<?php
       session_start();
     $link = mysqli_connect("shareddb-u.hosting.stackcp.net", "register_user-3133335852", "3JHH^l[/SR{k", "register_user-3133335852");

    if (mysqli_connect_errno()) {
        
        print_r(mysqli_connect_error());
        exit();
        
    }

  if ($_GET['function'] == "logout") {
        session_unset();  
        echo "<script> location.href='http://wizzingnet.tech/'; </script>";

       
    }
?>