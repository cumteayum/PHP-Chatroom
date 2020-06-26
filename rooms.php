<?php

$roomname = $_GET['roomname'];

include "dbc.php";

$sql = "SELECT * FROM `myrooms` WHERE roomname = '$roomname'";

$result = mysqli_query($conn, $sql);

if($result)
{
    if(mysqli_num_rows($result) ==0)
    {
        $message = "This room does not exist anymore";

        echo '<script language="javascript">';
        echo 'alert("' .$message. '");';
        echo 'window.location="http://localhost/chatroom";';
        echo '</script>';
    }
}

else
{
    echo "Err : ".mysqli_error($conn);
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Custom styles for this template -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
  background: #ffd900;

}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}

button
{
  border-radius: 20px;
  border: 1px solid #fff00f;

}
button:hover
{
  border-radius: 20px;
  border: 1px solid ##0dfc69;
  background: #fff00f;
  transition: 0.7s ;

}

</style>

</head>
<body>

<h2>Chat Messages - <?php echo "$roomname";?></h2>

<div class="container">
  <div class="anyClass">
    
  </div>

</div>


<input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="Enter message..."><br>
<button class="btn btn-primary" name="submitmsg" id="submitmsg">Send</button>


<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<script>"https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"</script>


<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script type="text/javascript">
//check for new messages
var name = prompt("Please enter your name to join the chat");

setInterval(runFunction, 800);

function runFunction()
{
  $.post("htcon.php", {room: '<?php echo $roomname?>'},
  
    function(data, status)
    {
      document.getElementsByClassName('anyClass')[0].innerHTML = data;
    }

  );
}


    // courtsey - w3schools.org
    var input = document.getElementById("usermsg");
    input.addEventListener("keyup", function(event) {
      event.preventDefault();

      if(event.keyCode == 13)
      {
        document.getElementById("submitmsg").click();
      }
    });

  //Doing a post request to PHP 
    $("#submitmsg").click(function(){
    var clientmsg = $("#usermsg").val();
    $.post('postmsg.php', {text: clientmsg, room: '<?php echo $roomname?>',
    ip: name},

    // '<?php echo $_SERVER["REMOTE_ADDR"]?>'

    function(data, status){
      document.getElementsByClassName('anyClass')[0].innerHTML = data;});
    $("#usermsg").val("");
    return false;

    });


</script>
</body>
</html>
