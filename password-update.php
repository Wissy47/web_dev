<?php
        include 'header.php';
?>
<div class="container" style="text-align: center" >
    <br><br><br>
    <form >
    <div class"form-group" >
    <input type="password" class="form-control" id="passwordUpdate1" placeholder="Enter new password" style="width:400px; margin: auto">
   </div>
   <br>
   <div class"form-group" >
    <input type="password" class="form-control" id="passwordUpdate2" placeholder="Confirm your new password" style="width:400px; margin: auto">
   </div>
   <input type="hidden" name="email" id="email"  value="<?php echo $email;?>" >
   <br>
     <button type="button" id="resetBtn" class="btn btn-primary">Set New Password</button>
  </form>
  <br>
  <div class="alert alert-success" id="status" style="width:400px; margin: auto; display: none"></div>
  
</div>
<br><br><br><br><br><br><br><br><br>
<?php
        include 'footer.php';
?>