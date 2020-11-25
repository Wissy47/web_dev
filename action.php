<?php

    include("function.php");

    if ($_GET['action'] == "loginsignup") {
        
        if (!$_POST['email']) {
            
            $error = "An email address is required.";
            
        } else if (!$_POST['password']) {
            
            $error = "A password is required";
            
        } else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
  
            $error = "Please enter a valid email address.";
            
}
        
        if ($error != "") {
            
            echo $error;
            exit();
            
        }
        
        
         if ($_POST['loginactive'] == "0") {
            
                $query = "SELECT * FROM users WHERE email = '". mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
                $result = mysqli_query($link, $query);
            if (mysqli_num_rows($result) > 0) {$error = "This email address is already taken.";}
             else if(!$_POST['firstname'] && !$_POST['lastname'] || !$_POST['firstname'] && $_POST['lastname'] || $_POST['firstname'] && !$_POST['lastname']){
            $error = "All fields are require";
            }
            else {
                
                $query = "INSERT INTO users (`lastname`,`firstname`,`email`, `password`) VALUES ('". mysqli_real_escape_string($link, $_POST['lastname'])."','". mysqli_real_escape_string($link, $_POST['firstname'])."','". mysqli_real_escape_string($link, $_POST['email'])."', '". mysqli_real_escape_string($link, $_POST['password'])."')";
                
                if (mysqli_query($link, $query)) {
                    
                    $_SESSION['id'] = mysqli_insert_id($link);
                    
                    $query = "UPDATE users SET password = '". md5(md5($_SESSION['id']).$_POST['password']) ."' WHERE id = ".$_SESSION['id']." LIMIT 1";
                    mysqli_query($link, $query);
                    
                    echo 1;
                } 
                 $email= $_POST['email'];
                 $fname = $_POST['firstname'];
                            
                 if (mysqli_query($link, $query)) {
                        $output='<p>Hello '.$fname.',</p>';
                        $output.='<p>You have successfully register on OmaGym. Please try and register for a training plan and as well take a advantage of our class.</p>';
                        $output.='<p>To Register for a training plan <a href="wizzingnet.tech/plans.php" target="_blank" >Click here</a></p>';
                        $output.='<p>Thanks,</p>';
                        $output.='<p>OmaGym Team</p>';
                        $body = $output; 
                        $subject = "Registration Successful - OmaGym";
                         
                        $email_to = $email;
                        $fromserver = "info@wizzingnet.tech"; 
                        require("PHPMailer/PHPMailerAutoload.php");
                        $mail = new PHPMailer();
                        $mail->IsSMTP();
                        $mail->Host = "smtp.stackmail.com"; // Enter your host here
                        $mail->SMTPAuth = true;
                        $mail->Username = "info@wizzingnet.tech"; // Enter your email here
                        $mail->Password = "wisdom12"; //Enter your password here
                        $mail->Port =  587;
                        $mail->IsHTML(true);
                        $mail->From = "info@wizzingnet.tech";
                        $mail->FromName = "OmaGym";
                        $mail->Sender = $fromserver; // indicates ReturnPath header
                        $mail->Subject = $subject;
                        $mail->Body = $body;
                        $mail->AddAddress($email_to);
                        if(!$mail->Send()){
                        echo "Mailer Error: " . $mail->ErrorInfo;
                        }
                }
                   else {
                          $error = "Couldn't create user - please try again later";
                          }
            }
            
          }        
          else {
            
            $query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
            
            $result = mysqli_query($link, $query);
            
            $row = mysqli_fetch_assoc($result); 
            
               
                if ($row['password'] == md5(md5($row['id']).$_POST['password'])) {
                    
                    echo 1;
                    
                    $_SESSION['id'] = $row['id'];
                    
                } else {
                           if ($row['password'] != md5(md5($row['id']).$_POST['password'])) {
                    
                                $error ="Incorrect password. Please try again";
                            } else{
                                $error = "Could not find that username/password combination. Please try again.";
                            }
                }

            
        }
        
         if ($error != "") {
            
            echo $error;
            exit();
            
        }
        
        
    }
    if ($_GET['action'] == "preset"){
        
        $email = $_POST['remail'];
         
        if (!$_POST['remail']) {
            
            echo  "An email address is required.";
            
        }  else if (filter_var($_POST['remail'], FILTER_VALIDATE_EMAIL) === false) {
  
            echo  "Please enter a valid email address.";
        } 
        else {
            $query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['remail'])."' LIMIT 1";
            $result = mysqli_query($link, $query);
            $row = mysqli_num_rows($result);
            
            if($row ==""){
                echo "This is not a registered email";
            }
            
                $expireformat = mktime (
                    date("H"), date("i"), date("s"), date("m"), date("d")+1, date("Y") );
                $expdate = date("Y-m-d H:i:s", $expireformat);
                $key = md5(2418*2+$email);
                $addkey = substr(md5(uniqid(rand(),1)),3,10);
                $key = $key . $addkey;
                
           if ($row =="1") {
                     mysqli_query($link, "INSERT INTO `tempPassword`(`email`, `key`, `expdate`) VALUES ('". mysqli_real_escape_string($link, $_POST['remail'])."', '".$key."', '".$expdate."');");
                     
                     
                        $output='<p>Dear user,</p>';
                        $output.='<p>Please click on the following link to reset your password.</p>';
                        $output.='<p>-------------------------------------------------------------</p>';
                        $output.='<p><a href="wizzingnet.tech/action.php?key='.$key.'&email='.$email.'&action=reset" target="_blank">wizzingnet.tech/action.php?key='.$key.'&email='.$email.'&action=reset</a></p>'; 
                        $output.='<p>-------------------------------------------------------------</p>';
                        $output.='<p>Please be sure to copy the entire link into your browser.
                        The link will expire after 1 day for security reason.</p>';
                        $output.='<p>If you did not request this forgotten password email, no action 
                        is needed, your password will not be reset. However, you may want to log into 
                        your account and change your security password as someone may have guessed it.</p>';   
                        $output.='<p>Thanks,</p>';
                        $output.='<p>OmaGym Team</p>';
                        $body = $output; 
                        $subject = "Password Recovery - OmaGym";
                         
                        $email_to = $email;
                        $fromserver = "info@wizzingnet.tech"; 
                        require("PHPMailer/PHPMailerAutoload.php");
                        $mail = new PHPMailer();
                        $mail->IsSMTP();
                        $mail->Host = "smtp.stackmail.com"; // Enter your host here
                        $mail->SMTPAuth = true;
                        $mail->Username = "info@wizzingnet.tech"; // Enter your email here
                        $mail->Password = "wisdom12"; //Enter your password here
                        $mail->Port =  587;
                        $mail->IsHTML(true);
                        $mail->From = "info@wizzingnet.tech";
                        $mail->FromName = "OmaGym";
                        $mail->Sender = $fromserver; // indicates ReturnPath header
                        $mail->Subject = $subject;
                        $mail->Body = $body;
                        $mail->AddAddress($email_to);
                        if(!$mail->Send()){
                        echo "Mailer Error: " . $mail->ErrorInfo;
                        }else{
                        echo "An email has been sent to you with instructions on how to reset your password";
                         }
             }
             }
            
    }
    
    
    if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) && ($_GET["action"]=="reset") && !isset($_POST["action"])){
                  
                  $key = $_GET["key"];
                  $email = $_GET["email"];
                  $curDate = date("Y-m-d H:i:s");
                  $query = mysqli_query($link, "SELECT * FROM `tempPassword` WHERE `key`='".$key."' and `email`='".$email."';" );
                  $row = mysqli_num_rows($query);
            if ($row==""){
                  echo  '<h2>Invalid Link</h2>
                <p>The link is invalid/expired. Either you did not copy the correct link
                from the email, or you have already used the key in which case it is 
                deactivated.</p>
                <p><a href="https://www.allphptricks.com/forgot-password/index.php">
                Click here</a> to reset password.</p>';
            }
            else{
                  $row = mysqli_fetch_assoc($query);
                  $expdate = $row['expdate'];
                  if ($expdate >= $curDate){
        
                     include 'password-update.php';
                    
                }else{
                    echo "<h2>Link Expired</h2>
                    <p>The link is expired. You are trying to use the expired link which 
                    is valid only 24 hours (1 days after request).<br /><br /></p>";
                }
            }
                      
    }
                 // isset email key validate end
                 
                 
    if ($_GET['action'] == "update" && isset($_POST["email"])){
            $email = $_POST["email"];
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            
        if (!$_POST['pass1'] && !$_POST['pass2'] )  {
            echo "Enter your new password.";
        }else if($_POST['pass1'] && !$_POST['pass2'] || !$_POST['pass1'] && $_POST['pass2']){
            echo "Both fields are required.";
        } else if ($pass1 != $pass2) {
            echo  "Passwords does not macth";
        }
        else {
            $query = "SELECT * FROM users WHERE email = '". mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
                    $result = mysqli_query($link, $query);
                    $row = mysqli_fetch_assoc($result); 
                    
                    if  (mysqli_query($link, $query)){
                    $query = "UPDATE `users` SET `password` = '".md5(md5($row['id']).$_POST['pass1'])."' WHERE `email` = '".$email."' LIMIT 1";
                    mysqli_query($link, $query);
                    
                    echo "password Reset Successful";
                    mysqli_query($link,"DELETE FROM `tempPassword` WHERE `email`='".$email."';");
                    }
        }
    }      
                 
    if ($_GET['action'] == "sender"){     
        
        
                      //  $output='<p>ബഹു ഇടവക അംഗമെ,</p>';
                      //  $output.='<p>അഭി: ബിലാഷ്യാസ്യോസ് മാർ ബെഹനാസ്യോസ് എന്ന പേരിൽ സോഷ്യൽ മീഡിയയിൽ പ്രചരിക്കുന്ന ഈ ചിത്രം ദയവായി ആരും തന്നെ ഷെയർ ചെയ്യുകയോ, ലൈക്കു ചെയ്യുകയോ ചെയ്യരുത്</p>';
                      //  $output.='<p>എം ഓ സി ദോഹ IT</p>';
                       // $body = $output; 
                      //  $subject = "MOC Doha";
                         
                       // $email_to = "";
                       // $fromserver = "info@wizzingnet.tech"; 
                       // require("PHPMailer/PHPMailerAutoload.php");
                    //    $mail = new PHPMailer();
                      //  $mail->IsSMTP();
                      //  $mail->Host = "smtp.stackmail.com"; // Enter your host here
                       // $mail->SMTPAuth = true;
                       // $mail->Username = "info@wizzingnet.tech"; // Enter your email here
                      //  $mail->Password = "wisdom12"; //Enter your password here
                       // $mail->Port =  587;
                     //   $mail->IsHTML(true);
                      //  $mail->From = "mocdoha@mocdoha.org";
                    //    $mail->FromName = "MOC Doha";
                //        $mail->Sender = $fromserver; // indicates ReturnPath header
                  //      $mail->Subject = $subject;
                    //    $mail->AddEmbeddedImage('my_image/MOC.jpg', 'MOC', 'MOC.jpg ');
                      //  $mail->Body = "$body <img alt='PHPMailer' src='cid:MOC'>";
                        
                    //    $mail->AddBCC('wissy47@gmail.com');
                    
                      
                      //  if(!$mail->Send()){
                       // echo "Mailer Error: " . $mail->ErrorInfo;
                      //  }else{
                    //    echo "An email has been sent";
                      //   } 
   // }                 
                    
   
                      $output="കർത്താവിൽ പ്രിയ ഇടവക അംഗമെ,<br><br>";

                    $output.= "ഈ കോവിഡ് 19 കാലഘട്ടത്തിൽ, എം ഓ സി ദോഹയുടെ നേതൃത്വത്തിൽ, കൊറോണ ബാധിതർക്കും, നാട്ടിൽ പോകുവാൻ ബുദ്ധിമുട്ടനുഭവിക്കുന്നവർക്കും ആയി സാമ്പത്തിക സഹായം നല്കപ്പെടുന്നതാണ്. അർഹതപെട്ടവർ എന്നെ 55277562 ൽ വിളക്കാവുന്നതാണ്. ഈ മഹാമാരിയെ ലോകത്തു നിന്ന് തുടച്ചുനീക്കുവാൻ ദൈവത്തിന്റെ പരിശുദ്ധാത്മാവ് പ്രവർത്തിക്കട്ടെ എന്ന പ്രാർത്ഥനയോടെ.";

                    $output.= "<br><br>നിങ്ങളുടെ സ്വന്തം,
ഡാനിയേലച്ചൻ."  ;
                    
                    
                      $body= $output; 
                      $subject = "MOC Vicar";
                        $email_to = $email;
                        $fromserver = "admin@wizzingnet.tech"; 
                        require("PHPMailer/PHPMailerAutoload.php");
                        $mail = new PHPMailer();
                        $mail->IsSMTP();
                        $mail->Host = "smtp.stackmail.com"; // Enter your host here
                        $mail->SMTPAuth = true;
                        $mail->Username = "sender@wizzingnet.tech"; // Enter your email here
                        $mail->Password = "wisdom12"; //Enter your password here
                        $mail->Port =  587;
                        $mail->IsHTML(true);
                        $mail->From ="vicar@mocdoha.org";
                        $mail->FromName = "MOC Vicar";
                        $mail->Sender = $fromserver; // indicates ReturnPath header
                        $mail->Subject = $subject;
                        $mail->Body = "$body";
                         
                      $recipients = array('roshalex007@gmail.com','reyakrejiabraham@gmail.com','sinivarghese48@yahoo.com','santhosh.kompady@gmail.com','jeffzachariah@gmail.com','anoopmathai@gmail.com','tijoulanadu@gmail.com','hellojacobkoshy@gmail.com','abilash@delta01crop.com','ajeeshmathew007@gmail.com','beno.joykutty@gmail.com','adsajibaby@gmail.com','jacobsijun@gmail.com','bony.philip@gmail.com','philipabrahamphilip@yahoo.com','varghese.bijumathew@gmail.com');
                    
                       foreach ($recipients as $email)
                       {
                        $mail->AddAddress($email);
                       }
                       
                                                
                        if(!$mail->Send()){
                        echo "Mailer Error: " . $mail->ErrorInfo;
                        }else{
                        echo "An email has been sent successfully";
                         }
                       
    }
    
?>