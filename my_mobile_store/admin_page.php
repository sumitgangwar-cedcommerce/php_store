<?php
  session_start();
  if(!isset($_SESSION['adminlogin'])) {header("Location: admin_login.php");}
?>
<!doctype html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="admin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hello, world!</title>
  </head>
  <body>
    <style>
      #nn{
        font-size:3vh;
        float:left;
      }
    </style>
    <div id="dash_main" class="">
      <div id="menu" class=""><span id='nn'>Welcome! <?php echo $_SESSION['adminlogin'][1]; ?><i id="log_out" class="bi bi-box-arrow-right"></i></span><center><b>Dashboard</b></center></div>
        <div id="side_bar" class="">
          <div id="Home" class="s_item"  >Home</div>
          <div id="user_management" class="s_item">User Management</div>
          <div id="product_management" class="s_item">Product Management</div>
          <div id="order_management" class="s_item">Order Management</div>
        </div>
      <div id="content">
        <script>
          $.ajax({
            type:'post',
            url:'admin_server.php',
            data:{
                Home:"show"
            },
            success:function(response){
                $('#content').html(response);
            }
        });
        </script>
      </div>
    </div>

  </body>
  <script src="admin_page.js"></script>
</html>