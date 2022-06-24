<?php
    session_start();
    include 'sql_conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
.img{
    width: 120px;
    height: 150px;
}
.img1{
    width: 250px;
    height: 150px;
}
.plus_counter{
    background-color:black;
    color:white;
    /* font-size:2vh; */
    border:none;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;

}
.minus_counter{
    background-color:black;
    color:white;
    border:none;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}
.value_counter{
    border:none;
    background-color:black;
    color:white;
    border-radius:5px;
}
#listing{
    /* border: solid; */
    margin-top: 10vh;
}
.list_product_info{
    font-size: 15px;
}
#listing{
    display: flex;
    flex-wrap: wrap;
}
.list_product{
    /* background-color:rgba(184, 48, 7); */
    border: solid 1px black;
    z-index: 1;
    color:black;
    margin: 50px;
    box-shadow: 5px 5px 10px 10px black;
    border-radius:10px
}
.list_product_info p , .add_to_cart , .add_to_cart_btn{
    text-align: center;
} 
.add_to_cart{
    border:solid 1px;
    background-color: black;
    color: white;
    border-radius:10px;
}
#counter{
    //margin-left : 3vh;
}
.checked{
    color:#ffd700;
}
.add_to_cart:hover{
    background-color:rgb(3, 165, 252);
    width:100%;
    height:130%;
    border-radius:10px;
}
.plus_counter:hover{
    background-color:green;
    color:white;
}
.minus_counter:hover{
    background-color:red;
    color:white;
}


    </style>
    <div id="listing">
        <?php
            $sql = "SELECT * FROM Products Where Category='Mobile'";
            foreach($conn->query($sql) as $res){
                echo "<div class='list_product'>
                        <div>
                            <img class='img' src=".$res['Image'].">
                        </div>
                        <div class='list_product_info'>
                            <p><b>".$res['Name']."</b><br><i>Rs:-".$res['Price']."\-</i></p>
                        </div>
                        <center><div>
                            <span class='fa fa-star checked'></span>
                            <span class='fa fa-star checked'></span>
                            <span class='fa fa-star checked'></span>
                            <span class='fa fa-star checked'></span>
                            <span class='fa fa-star'></span>
                        </div></center>
                        <center>
                            
                            <div id='counter'>
                                <button class='minus_counter'>-</button>
                                <input type='button' class='value_counter' value='1'>
                                <button class='plus_counter'>+</button>
                            </div>
                            <div class='add_to_cart_btn'>
                                <button class='add_to_cart'>Add to Cart</button>
                            </div>
                        </center>
                    </div>";
            }
        ?>
    </div>
    <div id="listing">
        <?php
            $sql = "SELECT * FROM Products Where Category='TV'";
            foreach($conn->query($sql) as $res){
                echo "<div class='list_product'>
                        <div>
                            <img class='img1' src=".$res['Image'].">
                        </div>
                        <div class='list_product_info'>
                            <p><b>".$res['Name']."</b><br><i>Rs:-".$res['Price']."\-</i></p>
                        </div>
                        <center><div>
                            <span class='fa fa-star checked'></span>
                            <span class='fa fa-star checked'></span>
                            <span class='fa fa-star checked'></span>
                            <span class='fa fa-star checked'></span>
                            <span class='fa fa-star'></span>
                        </div></center>
                        <center>
                            
                            <div id='counter'>
                                <button class='minus_counter'>-</button>
                                <input type='button' class='value_counter' value='1'>
                                <button class='plus_counter'>+</button>
                            </div>
                            <div class='add_to_cart_btn'>
                                <button class='add_to_cart'>Add to Cart</button>
                            </div>
                        </center>
                    </div>";
            }
        ?>
    </div>
</body>
<!-- <script src="code.js"></script> -->
</html>