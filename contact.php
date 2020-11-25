<?php 
include 'function.php';
include 'header.php';
?>
<form class="infoForm"> <div class="form-group">
    <label for="exampleFormControlInput1">Name</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter your name" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput2">Email address</label>
    <input type="email" class="form-control" id="exampleFormControlInput2" placeholder="name@example.com" required>
  </div>
  
  <div class="form-group">
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" placeholder="Message..."></textarea>
  </div>
<button type="submit" value="Send" class="btn btn-success btn-lg">Send</button>
</form>
      <address>
        123 York street BM
        <p>Tel&#58; 111-2392-1212</p>
      </address>
    <?php
include 'footer.php';
?>