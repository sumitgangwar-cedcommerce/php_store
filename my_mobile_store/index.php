<?php
    session_start();
    if(isset($_COOKIE['login'])){
        include 'sql_conn.php';
        $email = $_COOKIE['login'];
        $sql = "SELECT Name FROM User Where Email = '$email'";
        foreach($conn->query($sql) as $res) $name = $res['Name'];
        $_SESSION['login'] = array($email , $name);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            background-image: url('img/back1.jpeg') no-repeat/center;
        }
        body{
            background-image: url('img/back1.jpeg') no-repeat/center;
            background-attachment: fixed;
            height: 100vh;
            width: 100%;
        } */
        #main_conten{
            background-image: url('img/back1.jpeg');
            background-repeat: no-repeat center;
             background-size: cover; 
            background-attachment: fixed;
            display: flex;
            align-items:center;
            justify-content:center;
            /* height: 100vh; */
            
        }
        /* #header , #footer , #body{
            width:100%;
            height:100%;
        } */
        #body{
            position:relative;
            margin-top:8vh;
            min-height:90vh;
        }
        #footer{
            background-color:black;
            /* position: fixed;
            bottom:0; */
            width: 100%;
            /* height:10%; */
            color:white;
        }
        /* #header{
        height:1vw;
        } */
    </style>
</head>
<body>
    
    <div id="main_conten">
        <div id="header">

        </div>
        <div id="body">

        </div>
        
    </div>
    <div id="footer">

        </div>
</body>
<script>
    $("#header").load('header.php');
    $("#body").load('product_page.php');
    $("#footer").load('footer.php');
</script>
<script src="code.js"></script>
</html>