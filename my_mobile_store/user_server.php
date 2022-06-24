<?php
session_start();
    include 'sql_conn.php';
    if(isset($_POST['login_req'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $check = $_POST['login_req'];
        //if($check=='true')  setcookie('login' , $email);
        $sql = "SELECT Password , Name FROM User WHERE Email = '$email'";
        foreach($conn->query($sql) as $res){
            $dbpass = $res['Password'];
            $user_name = $res['Name'];
        }
        if($dbpass===$password){
            if($check=='true')  setcookie('login' , $email , time() + (86400 * 1));
            echo "true";
            $_SESSION['login'] = array($email , $user_name);
        }
        else echo "false";
    }
    if(isset($_POST['register_req'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $sql = "SELECT * FROM User WHERE Email = '$email'";
        $t = 1;
        foreach($conn->query($sql) as $res) $t = $res['email'];
        if($t!=1)   echo 0;
        else{
            $sql = "INSERT INTO User(Name,Password,Email,City,Address) VALUES('$name','$password','$email','$city','$address')";
            $conn->query($sql);
            echo '<p>Registration Successful</p><input id="login_reg" type="button" value="Login"></p>';
        }
        
    }
    if(isset($_POST['add_to_cart'])){
        $name = $_POST['add_to_cart'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $_SESSION['cart'][$name] = array($name , $price , $quantity);
        echo(count($_SESSION['cart']));
    }
    if(isset($_POST['show_cart'])){
        show_cart(); 
    }
      
    if(isset($_POST['cart_plus'])){
        $_SESSION['cart'][$_POST['cart_plus']][2] = (int)$_SESSION['cart'][$_POST['cart_plus']][2]+1;
        show_cart();
    }
    if(isset($_POST['cart_minus'])){
        if((int)$_SESSION['cart'][$_POST['cart_minus']][2]-1>0) $_SESSION['cart'][$_POST['cart_minus']][2] = (int)$_SESSION['cart'][$_POST['cart_minus']][2]-1;
        show_cart();
    }
    if(isset($_POST['delete_cart_item'])){
        unset($_SESSION['cart'][$_POST['delete_cart_item']]);
        show_cart();
    }
    if(isset($_POST['cart_count'])) echo count($_SESSION['cart']);
    if(isset($_POST['checkout_btn']))   show_checkout();

    

    function show_cart(){
        include 'sql_conn.php';
        $total_amount = 0;
        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">';
        echo '    <style>
        #cart_item_table{
            margin-top:10vh;
            background-color:grey;
            color:black;
            
        }
        .cart_plus_counter{
            background-color:black;
            color:white;
            border:none;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        .cart_minus_counter{
            background-color:black;
            color:white;
            border:none;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            
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
        #btn_checkout{
            margin-left:auto;
            margin-right:auto;
        }
        .delete_cart_item{
            color:red;
        }
        .cart_plus_counter:hover{
            background-color:green;
            color:white;
        }
        .cart_minus_counter:hover{
            background-color:red;
            color:white;
        }
            </style>';
        echo "<table id='cart_item_table' class='table thead-dark'>
                
                <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price(Rs)</th>
                <th>Total amount(Rs)</th>
                <th>Action</th>
                </tr>";
            foreach($_SESSION['cart'] as $res){
                $name = $res[0];
                $price = $res[1];
                $total_amount+=(int)$res[2]*(int)$price;
                $sql = "SELECT Image FROM Products WHERE Name = '$name' LIMIT 1";
                foreach($conn->query($sql) as $val){
                    $image = $val['Image'];
                }
                echo "<tr>
                        <td><img src='".$image."' width=60px height=60px></td>
                        <td>".$name."</td>
                        <td>
                            <button class='cart_minus_counter'>-</button>
                            <input type='button' class='value_counter' value=".$res[2].">
                            <button class='cart_plus_counter'>+</button>
                        </td>
                        <td>".$price.".00</td>
                        <td>".(int)$res[2]*(int)$price.".00</td>
                        <td class='delete_cart_item'><i class='bi bi-trash'></i></td>
                      </tr>";
            }
            echo '<tr>
                    <td colspan=3></td>
                    <td><b>Total Price(Rs):</b></td>
                    <td>'.$total_amount.'.00</td><td></td>';
            echo "</table>";
            echo '
            <div id="checkout">
                <button id="btn_checkout" class="btn btn-primary">CheckOut</button>
            </div>';
    }
   function show_checkout(){
    include 'sql_conn.php';
    echo '<style>
    #main{
        color:black;
        padding:5vh;
        min-height:90vh;
    }
    #order_details{
        
        margin-top: 2vh;
        width: 90%;
        
        text-align: left;
        border-collapse:collapse ;
    }
     tr{
       width: 100%;
    }
    td input{
        margin:1vh;
    }
    
    #final_page{
        background-color:grey;
        height: 100%;
        min-width: 70vh;
        box-shadow: 5px 5px 10px 10px black;
        border: solid;
        margin-botton:3vw;
    }
    #confirm_order_btn{
        margin-bottom:2vh;
        background-color: green;
        color: white;
        width:50%;
        font-size:3vh;
    }
    #confirm_td{
        text-align: center;
        
    }
    #order_summary{
        background-color: rgba(52, 125, 235);
        height: 10%;
        width: 100%;
        text-align: center;
        color: white;
        font-size: 5vh;
    }</style>';
    echo "
        <center id='main'><div id='final_page'><div id='order_summary'>Order Summary</div><table id='order_details'>
        <thead>
        <tr id='order_details_heading'>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
        </thead>";
    foreach($_SESSION['cart'] as $key=>$val){
    $total_price+=(int)$val[1]*(int)$val[2];
    echo "<tr>
            <td>".$val[0]."</td>
            <td>".$val[2]."</td>
            <td>".$val[1]."/-</td>
        </tr>";
    }
    echo "<tr>
        <td colspan=3><h5><b>Total Amount = 
        Rs ".$total_price."/-<b></h5></td>
        </tr>";
    $email = $_SESSION['login'][0];
    $sql = "SELECT Name , Email , Address , City FROM User WHERE Email ='$email'";
    foreach($conn->query($sql) as $res){
        echo "<tr><td colspan=3><b><i>Billing Details:-<i></b></td></tr>
            <tr>
                <td><b>Name<b></td>
                <td colspan=2>".$res['Name']."</td>
            </tr>
            <tr>
                <td><b>City<b></td>
                <td colspan=2><input type='text' value='".$res['City']."'></td>
            </tr>
            <tr>
                <td><b>Address<b></td>
                <td colspan=2><input type='text' value='".$res['Address']."'></td>
            </tr>";
    }
    echo "<tr><td colspan=3 id='confirm_td'><button id='confirm_order_btn'>Confirm Order</button></td><tr></table></div></center>";
    }


    if(isset($_POST['confirm_order'])){
        $sql = "CREATE TABLE IF NOT EXISTS Orders(
            Order_id INT AUTO_INCREMENT PRIMARY KEY,
            User_email VARCHAR(255),
            City VARCHAR(255),
            Total_Amount VARCHAR(255),
            Status ENUM('Pending' , 'Approved' , 'Rejected')
            )";
        $conn->query($sql);
        $email = $_SESSION['login'][0];
        foreach($_SESSION['cart'] as $key=>$val){
            $total_price+=(int)$val[1]*(int)$val[2];
        }
        $sql = "SELECT City FROM User WHERE Email = '$email'";
        foreach($conn->query($sql) as $res){
            $city = $res['City'];
        // echo $city;
        }
        $conn->query($sql);
        $sql = "INSERT INTO Orders(User_email,City,Total_Amount,Status , Order_Date)
                VALUES('$email','$city','$total_price','Pending', NOW())";

        //echo $sql;
        $conn->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS Order_details(
            Order_id INT ,
            Product_id INT,
            Quantity VARCHAR(255)
            )";
        $conn->query($sql);

        $sql = "SELECT Order_id From Orders ORDER BY Order_id DESC LIMIT 1";
        foreach($conn->query($sql) as $res){
            $order_id = $res['Order_id'];
        }
        foreach($_SESSION['cart'] as $key=>$val){
            $sql = "SELECT Id FROM Products Where Name='$key'";
            foreach($conn->query($sql) as $res){
                $product_id = $res['Id'];
            }
            $quantity = $val[2];
            $sql = "INSERT INTO Order_details(Order_id , Product_id , Quantity)
                    VALUES('$order_id' , '$product_id' , '$quantity')";
            $conn->query($sql);
        }
        echo "<center><h1>Your Order Placed Successfully<br><a href='index.php'>Continue Shopping</a></h1></center>";
        unset($_SESSION['cart']);
    }


    if(isset($_POST['check_session']))  echo isset($_SESSION['login']);
    if(isset($_POST['logout'])){
        $email = $_COOKIE['login'];
        unset($_SESSION['cart']);
        unset($_SESSION['login']);
        setcookie('login' , $email ,time() - (86400 * 5));
    }

?>