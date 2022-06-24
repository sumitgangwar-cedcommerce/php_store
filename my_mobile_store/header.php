<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <link rel="stylesheet" href="header.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> -->
      <!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
   </head>
   <body>
      <!-- <div class="container-fluid"> -->
         <nav class="navbar-default navbar-fixed-top">
            <!-- <div class="container-fluid">  -->
               <!-- Brand and toggle get grouped for better mobile display
                <div class="navbar-header"> -->
                  <!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button> -->
                  <!-- <a class="navbar-brand" href="index.php">The online Store</a>
               </div>
            - Collect the nav links, forms, and other content for toggling -->
               <!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> -->
                  <!-- <ul class="nav navbar-nav">
                     <li><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
                     <li id="Mobile"><a>Mobile</a></li>
                     <li id="TV"><a>Telivision</a></li>
                     <li><a id="//<?php //if(isset($_SESSION['login']))  echo "profile_btn"; else echo "login_register_btn";?>"><?php //if(isset($_SESSION['login']))  echo $_SESSION['login'][1]." <i class='bi bi-box-arrow-right'></i>"; else echo "Login/Register";?></a></li>
                     <li><i class="bi bi-box-arrow-right"></i></li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                    <li id="cart_icon_div" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" > <span class="glyphicon glyphicon-shopping-cart"></span><span id="cart_button"> <?php //if(isset($_SESSION['cart']))	echo count($_SESSION['cart']); else echo "0";?></span> - Items</a>
					   </li>
                  </ul>
               </div> -->
               <!-- /.navbar-collapse -->
               <!-- <center>
              <div class="navbar navbar-dark bg-dark shadow-sm">
               <div class="container">
                  <a href="index.php" class="navbar-brand d-flex align-items-left">The Online Store</a>
                  <a class="navbar-brand d-flex align-items-center" href="index.php">Home<span class="sr-only">(current)</span></a>
                  <a class="navbar-brand d-flex align-items-center">Mobile</a>
                  <a class="navbar-brand d-flex align-items-center">Telivision</a>
                  <a class="navbar-brand d-flex align-items-center" id="<?php// if(isset($_SESSION['login']))  echo "profile_btn"; else echo "login_register_btn";?>"><?php //if(isset($_SESSION['login']))  echo $_SESSION['login'][1]." <i class='bi bi-box-arrow-right'></i>"; else echo "Login/Register";?></a>
                  <a  href="#" class="navbar-brand d-flex align-items-end" data-toggle="dropdown" role="button" aria-expanded="false" > <span class="glyphicon glyphicon-shopping-cart"></span><span id="cart_button"> <?php// if(isset($_SESSION['cart']))	echo count($_SESSION['cart']); else echo "0";?></span> - Items</a>

</div></div></center> -->
            <!-- /.container-fluid -->
         <!-- </nav>
      </div> -->
      <div id="main_div_header" style="display:flex">
            <div id="logo" class="navbar-brand d-flex align-items-center">The Online Store</div>
            <div id="menu_it">
            
                  <a class="navbar-brand d-flex align-items-center" href="index.php">Home<span class="sr-only">(current)</span></a>
                  <a id="TV" class="navbar-brand d-flex align-items-center">Telivision</a>
                  <a id="Mobile" class="navbar-brand d-flex align-items-center">Mobile</a>
                  <a class="navbar-brand d-flex align-items-center" id="<?php if(isset($_SESSION['login']))  echo "profile_btn"; else echo "login_register_btn";?>"><?php if(isset($_SESSION['login']))  echo $_SESSION['login'][1]." <i class='bi bi-box-arrow-right'></i>"; else echo "Login/Register";?></a>
                  <!-- <a  href="#" class="navbar-brand d-flex align-items-end" data-toggle="dropdown" role="button" aria-expanded="false" > <span class="glyphicon glyphicon-shopping-cart"></span><span id="cart_button"> <?php if(isset($_SESSION['cart']))	echo count($_SESSION['cart']); else echo "0";?></span> - Items</a> -->
            </div>
            <a id="cart_icon_div"  class="navbar-brand" data-toggle="dropdown" role="button" aria-expanded="false" > <span class="glyphicon glyphicon-shopping-cart"></span><span id="cart_button"> <?php if(isset($_SESSION['cart']))	echo count($_SESSION['cart']); else echo "0";?></span> - Items</a>
      </div>
   </body>
   <!-- <script src="code.js"></script> -->
</html>