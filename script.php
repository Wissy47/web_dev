 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
      
       <script>
      $("#togglebtn").click(function() {
          
        if ($("#loginactive").val() == 1)
        {
            $("#loginactive").val("0");
            $("#exampleModalLabel").html("SIGN UP");
            $("#loginsignup").html("Signup");
            $("#togglebtn").html("Login");
            $(".signuponly").css("display", "block");
           
        }
        else {
            $("#loginactive").val("1");
            $("#exampleModalLabel").html("LOGIN");
            $("#loginsignup").html("Login");
            $("#togglebtn").html("Sign up");
            $(".signuponly").css("display", "none");
        }
      })
      
    $("#loginsignup").click(function() {
         if ($("#loginactive").val() == 1){
         $.ajax({
        type: "POST",
        url: "action.php?action=loginsignup",
        data: "email=" + $("#email").val() + "&password=" + $("#password").val() + "&loginactive=" + $("#loginactive").val(),
        success: function(result){
            if (result == "1") {
                    
                    window.location.assign("http://wizzingnet.tech/");
                    
                } else {
                    
                    $("#loginAlert").html(result).show().delay( 2000 ).fadeOut();

                }    
        }
        })
}
         if ($("#loginactive").val() == 0){
                   $.ajax({
        type: "POST",
        url: "action.php?action=loginsignup",
        data: "email=" + $("#email").val() + "&password=" + $("#password").val() + "&loginactive=" + $("#loginactive").val() + "&firstname=" + $("#firstname").val() + "&lastname=" + $("#lastname").val(),
        success: function(result){
            if (result == "1") {
                    
                    window.location.assign("http://wizzingnet.tech/");
                    
                } else {
                    
                    $("#loginAlert").html(result).show().delay( 2000 ).fadeOut();

                }    
        }
        })        
         }
})



$("#presetBtn").click(function(){
    $.ajax({
        type: "POST",
        url: "action.php?action=preset",
        data: "remail=" + $("#emailRecovery").val(),
        success: function (result){
            alert (result)
        }
    })
})

$("#resetBtn").click(function(){
    $.ajax({
        type: "POST",
        url: "action.php?action=update",
        data: "pass1=" + $("#passwordUpdate1").val() + "&pass2=" + $("#passwordUpdate2").val() + "&email=" + $("#email").val(),
        success: function (result) {
            alert (result)
        }
    })
})
$("#sendEmail").click(function(){
    $.ajax({
        type: "POST",
        url: "action.php?action=sender",
        data: "send=" + $("#sent").val(),
        success: function (result){
            alert (result)
        }
    })
})
    </script>