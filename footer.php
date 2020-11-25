  <footer>
        <div class="footertop">
             <div class="connect">
            <h3>Connect With Us On</h3>
            <ul>
                <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
                <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
            </ul>
        </div>
        <div class="about">
            <ul>
                <li><a href="about_us.php">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="#"><i class="fas fa-blog"></i> Blog</a></li>
            </ul>
        </div>
            
       
        </div>
        <div class="clear"></div>
        <div class="downfooter">&copy;Copyright OmaGym 2020</div>
    </footer>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">LOGIN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" id="loginAlert" style="display: none;"></div>
          <form>
  <div class="form-group">
      <input type="hidden" value="1" id="loginactive">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted signuponly" >We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password">
  </div>
 <div class="form-group signuponly">
    <label for="firstname">Firstname</label>
    <input type="test" class="form-control" id="firstname">
  </div>
  <div class="form-group signuponly">
    <label for="lastname">Lastname</label>
    <input type="text" class="form-control" id="lastname">
  </div>
  <button type="button" class="btn btn-primary" id= "loginsignup">Login</button>
  <a href="forget_password.php" class="btn btn-link">forget password</a>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link" id="togglebtn">Sign Up</button>
      </div>
    </div>
  </div>
</div>
  </body>
</html>
<?php include 'script.php';?>