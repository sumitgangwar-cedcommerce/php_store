<?php   session_start();
        include 'sql_conn.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    

    <!-- Latest compiled JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>     -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
.cart_plus_counter{
    background-color: rgba(0, 0, 0, 0.982);
    border-radius: 5px;
    color: white;
    font-size: 12px;
}
.cart_minus_counter{
    background-color: rgba(12, 12, 12, 0.982);
    color: white;
    font-size: 12px;
}
#total_cart_price{
    font-size: 30px;
}
#btn_checkout{
    font-size: 3vh;
    width: 25vh;
    height: 6vh;
}
#checkout{
    display: flex;
}
#cart_items{
    min-height:100vh;
    margin-top:10vh;
}

    </style>


    
    <div id="cart_items">
    <?php 
        if(isset($_SESSION['cart']) && count($_SESSION['cart'])){?>
            <script>
                $.ajax({
                type:"post",
                url:"user_server.php",
                data:{
                    show_cart:'show'
                },
                success:function(response){
                    $('#cart_items').html(response);
                    console.log("dfv");
                    console.log(response);
                }
                });
            </script>
        <?php }
            else echo "<center style='margin-top:10vh;margin-bottom:auto;width:100%;min-height:87vh'><b><h1>Opps! Your Cart is empty<br><a href='index.php'>Go to Shop Page</a></h1><b></center>";
        ?>
    </div>
    
</body>
<!-- <script src="code.js"></script> -->
</html>