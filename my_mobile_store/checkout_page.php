<?php
    session_start();
    include 'sql_conn.php';
    
    if(isset($_SESSION['cart'])){
        $total_price = 0;
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
                    <td>".$val[1]."</td>
                    <td>".$val[2]."/-</td>
                </tr>";
        }
        echo "<tr>
                <td colspan=3><h5><b>Total Amount = 
                Rs ".$total_price."/-<b></h5></td>
                </tr>";
        $email = $_SESSION['login'];
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
    
    
?>


