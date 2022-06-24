<?php
    session_start();
    include 'sql_conn.php';
    if(isset($_POST['admin_login_req'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        //$check = $_POST['admin_login_req'];
        //if($check=='true')  setcookie('login' , $email);
        $sql = "SELECT Password , Name  FROM User WHERE Email = '$email' AND Role = 'admin'";
        foreach($conn->query($sql) as $res){
            $dbpass = $res['Password'];
            $user_name = $res['Name'];
        }
        if($dbpass===$password){
            echo 1;
            $_SESSION['adminlogin'] = array($email , $user_name);
        }
        else echo 0;
    }
    if(isset($_POST['log_out'])){
        unset($_SESSION['adminlogin']);
    }
    if(isset($_POST['show_user'])){
        show_user();
    }
    if($_POST['type']=="user"){
        $_SESSION['page']['user'] = $_POST['page'];
        show_user();
    }
    if(isset($_POST['add_user'])){
        show_add_user();
    }
    if(isset($_POST['add_user_submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $role = $_POST['role'];
        $sql = "SELECT * FROM User WHERE Email = '$email'";
        $t = 1;
        foreach($conn->query($sql) as $res) $t = $res['email'];
        if($t!=1)   echo 0;
        else{
            $sql = "INSERT INTO User(Name,Password,Email,City,Address,Role) VALUES('$name','$password','$email','$city','$address','$role')";
            $conn->query($sql);
            show_user();
        }
        
    }
    if(isset($_POST['edit_user_show'])){
        $email = $_POST['edit_user_show'];
        $_SESSION['email'] = $email;
        show_edit_user_show($email);
    }
    if(isset($_POST['edit_user_submit'])){
        $e_email = $_SESSION['email']; unset($_SESSION['email']);
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $role = $_POST['role'];
        $sql = "UPDATE User SET Name = '$name', Email = '$email' , Password = '$password' , Address = '$address' , City = '$city' , Role = '$role'  WHERE Email = '$e_email'";
        $conn->query($sql);
        show_user();
    }
    if(isset($_POST['delete_user'])){
        $email = $_POST['delete_user'];
        $sql = "DELETE FROM User WHERE Email = '$email'";
        $conn->query($sql);
        show_user();
    }
    function show_user(){
        include 'sql_conn.php';
        $res_per_page = 5;
        $sql = "SELECT COUNT(*) as Total FROM User";
        $count = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);
        $count = $count['Total'];
       // echo $count;
        $num_of_pages = ceil($count/$res_per_page);
        if(!isset($_SESSION['page']['user']))   $page = 1;
        else $page = $_SESSION['page']['user'];
        $this_page_first_res = ($page-1)*$res_per_page;
        $sql = "SELECT * FROM User LIMIT $this_page_first_res,$res_per_page";
       // echo $page;
       // echo $sql;
        echo '<style>
                table.table{
                    margin-top:2vh;
                    margin-left:auto;
                    margin-right:auto;
                }
                .table td{  
                    padding-left:1vh;
                    padding-right:1vh;
                    padding-top:1vh;
                    padding-bottom:1vh;
                }
                .table tr{
                    margin-top:2%;
                }
                .table th{
                    font-size:120%
                }
                #add_user{
                    margin-left:auto;
                    margin-right:auto;
                    border:none;
                    background-color:black;
                    color:white;
                    border-radius:10px;
                    font-size:3vh;    
                }
                .delete_user{
                    border:none;
                    background-color:Transparent;
                    color:red;
                    font-size:2vh;
                }
                .edit_user{
                    border:none;
                    background-color:Transparent;
                    color:green;
                    font-size:2vh;
                }
                // .page_btn{
                //     border:none;
                //     background-color:Transparent;
                //     color:blue;
                //     font-size:3vh;
                // }
            </style>';
        echo "<br><button id='add_user'>Add User</button>";
        echo "<table class='table' id='user_table'>
                            <tr class='text-primary'>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>City</th>
                                <th>Address</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th colspan='2' style='text-align:center;'>Action</th>
                            </tr>";
        $i=$this_page_first_res+1;
        foreach($conn->query($sql) as $res){
            echo "<tr>
                    <td><b>".$i++."</b></td>
                    <td>".$res['Name']."</td>
                    <td>".$res['Email']."</td>
                    <td>".$res['City']."</td>
                    <td>".$res['Address']."</td>
                    <td>".$res['Password']."</td>
                    <td>".$res['Role']."</td>
                    <td><button class='edit_user'><i class='bi bi-pen'></i><br>Edit</button></td>
                    <td><button class='delete_user'><i class='bi bi-trash'></i><br>Delete</button></td>
                </tr>";
        }
        echo "</table>";

        for($page = 1;$page<=$num_of_pages;$page++){
            echo '<button class="page_btn">'.$page.'</button>';
        }
     
    }
    function show_edit_user_show($email){
        include 'sql_conn.php';
        $sql = "SELECT * FROM User WHERE Email = '$email'";
        echo "<style>
                #edit_user_table{
                    margin-left:auto;
                    margin-right:auto;
                    margin-top:2vh;
                }
                #edit_user_table th{
                    font-size:5vh;
                }
                #edit_user_table td{
                    padding-top:2vh;
                }
                #edit_user_table td input{
                    border:none;
                    border-bottom:solid;
                }
                #e_submit_user{
                    width:80%;
                    color:white;
                    background-color:black;
                    font-size:3vh;
                }
            </style>";
        echo "<table id='edit_user_table'>
                <tr>
                    <th colspan=2>Edit User</th>
                </tr>";
        foreach($conn->query($sql) as $res){
            echo    '<tr>
                        <td>Name:</td>
                        <td><input id="e_name" type="text" value="'.$res['Name'].'"></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input id="e_email" type="text" value="'.$res['Email'].'"></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input id="e_password" type="text" value="'.$res['Password'].'"></td>
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td><input id="e_address" type="text" value="'.$res['Address'].'"></td>
                    </tr>
                    <tr>
                        <td>City:</td>
                        <td><input id="e_city" type="text" value="'.$res['City'].'"></td>
                    </tr>
                    <tr>
                    <td>Role:</td>
                    <td>
                        <select id="role">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </td>
                </tr>';
        }
        echo "<tr><td colspan=2><button id='e_submit_user'>Submit</td></table>";
    }
    function show_add_user(){
        echo "<style>
                #add_user_table{
                    margin-left:auto;
                    margin-right:auto;
                    margin-top:2vh;
                }
                #add_user_table th{
                    font-size:5vh;
                }
                #add_user_table td{
                    padding-top:2vh;
                }
                #add_user_table td input{
                    border:none;
                    border-bottom:solid;
                }
                #a_submit_user{
                    width:80%;
                    color:white;
                    background-color:black;
                    font-size:3vh;
                }
            </style>";

        echo "<table id='add_user_table'>
                <tr>
                    <th colspan=2>Add User</th>
                </tr>";
        
        echo    '<tr>
                    <td>Name:</td>
                    <td><input id="a_name" type="text" placeholder="Enter Name"></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input id="a_email" type="text" placeholder="Enter Email"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input id="a_password" type="text" placeholder="Enter Password"></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><input id="a_address" type="text" placeholder="Enter Address"></td>
                </tr>
                <tr>
                    <td>City:</td>
                    <td><input id="a_city" type="text" placeholder="Enter City"></td>
                </tr>
                <tr>
                    <td>Role:</td>
                    <td>
                        <select id="role">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </td>
                </tr>';
        
        echo "<tr><td colspan=2><button id='a_submit_user'>Submit</td></table>";
    }
    
?>

<?php
    if(isset($_POST['show_product'])){
        show_product();
    }
    if(isset($_POST['add_product'])){
        show_add_product();
    }
    if(isset($_POST['add_product_submit'])){
        $name = $_POST['name'];
        $image = $_POST['image'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $sql = "INSERT INTO Products(Name,Image,Category,Price) VALUES('$name','$image','$category','$price')";
        $conn->query($sql);
        show_product();
    }
    if($_POST['type']=="product"){
        $_SESSION['page']['product'] = $_POST['page'];
        show_product();
    }
    if(isset($_POST['delete_product'])){
        $p_id = $_POST['delete_product'];
        $sql = "DELETE FROM Products WHERE Id = '$p_id'";
        $conn->query($sql);
        show_product();
    }
    if(isset($_POST['edit_product_show'])){
        $id = $_POST['edit_product_show'];
        $_SESSION['id'] = $id;
        show_edit_product_show($id);
    }
    if(isset($_POST['edit_product_submit'])){
        $e_id = $_SESSION['id']; unset($_SESSION['id']);
        $name = $_POST['name'];
        $image = $_POST['image'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $sql = "UPDATE Products SET Name = '$name', Image = '$image' , Category = '$category' , Price = '$price' WHERE Id = '$e_id'";
        $conn->query($sql);
        show_product();
    }
    function show_product(){
        include 'sql_conn.php';
        $res_per_page = 5;
        $sql = "SELECT COUNT(*) as Total FROM Products";
        $count = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);
        $count = $count['Total'];
        //echo $count;
        $num_of_pages = ceil($count/$res_per_page);
        if(!isset($_SESSION['page']['product']))   $page = 1;
        else $page = $_SESSION['page']['product'];
        $this_page_first_res = ($page-1)*$res_per_page;
        $sql = "SELECT * FROM Products LIMIT $this_page_first_res,$res_per_page";
        //echo $page;
        //echo $sql;
        echo '<style>
                table.table{
                    margin-top:2vh;
                    margin-left:auto;
                    margin-right:auto;
                }
                .table td{  
                    padding-left:1vh;
                    padding-right:1vh;
                    padding-top:1vh;
                    padding-bottom:1vh;
                }
                .table td img{  
                    width:10vh;
                    height:10vh;
                }
                .table tr{
                    margin-top:2%;
                }
                .table th{
                    font-size:120%
                }
                #add_product{
                    margin-left:auto;
                    margin-right:auto;
                    border:none;
                    background-color:black;
                    color:white;
                    border-radius:10px;
                    font-size:3vh;    
                }
                .edit_product{
                    background:Transparent;
                    color:green;
                    font-size:2vh;
                    border:none;
                }
                .delete_product{
                    background:Transparent;
                    color:red;
                    font-size:2vh;
                    border:none;
                }
            </style>';
        echo "<br><button id='add_product'>Add Product</button>";
        echo "<table class='table' id='product_table'>
                            <tr class='text-primary'>
                                <th>#</th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th colspan='2' style='text-align:center;'>Action</th>
                            </tr>";
        $i=$this_page_first_res+1;
        foreach($conn->query($sql) as $res){
            echo "<tr>
                    <td><b>".$i++."</b></td>
                    <td>".$res['Id']."</td>
                    <td>".$res['Name']."</td>
                    <td><img src='".$res['Image']."'></td>
                    <td>".$res['Category']."</td>
                    <td>".$res['Price']."</td>
                    <td><button class='edit_product'><i class='bi bi-pen'></i><br>Edit</button></td>
                    <td><button class='delete_product'><i class='bi bi-trash'></i><br>Delete</button></td>
                </tr>";
        }
        echo "</table>";

        for($page = 1;$page<=$num_of_pages;$page++){
            echo '<button class="page_btn_product">'.$page.'</button>';
        }
    }
    function show_add_product(){
        echo "<style>
                #add_product_table{
                    margin-left:auto;
                    margin-right:auto;
                    margin-top:2vh;
                }
                #add_product_table th{
                    font-size:5vh;
                }
                #add_product_table td{
                    padding-top:2vh;
                }
                #add_product_table td input{
                    border:none;
                    border-bottom:solid;
                }
                #a_submit_product{
                    width:80%;
                    color:white;
                    background-color:black;
                    font-size:3vh;
                }
            </style>";

        echo "<table id='add_product_table'>
                <tr>
                    <th colspan=2>Add Product</th>
                </tr>";
        
        echo    '<tr>
                    <td>Name:</td>
                    <td><input id="a_name_p" type="text" placeholder="Enter Product Name"></td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td><input id="a_image_p" type="text" placeholder="Enter Product image URL"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td><input id="a_category_p" type="text" placeholder="Enter Product Category"></td>
                </tr>
                <tr>
                    <td>Price(Rs):</td>
                    <td><input id="a_price_p" type="text" placeholder="Enter Product Price"></td>
                </tr>';
        
        echo "<tr><td colspan=2><button id='a_submit_product'>Submit</td></table>";
    }
    function show_edit_product_show($id){
        include 'sql_conn.php';
        $sql = "SELECT * FROM Products WHERE Id = '$id'";
        echo "<style>
                #edit_product_table{
                    margin-left:auto;
                    margin-right:auto;
                    margin-top:2vh;
                }
                #edit_product_table th{
                    font-size:5vh;
                }
                #edit_product_table td{
                    padding-top:2vh;
                }
                #edit_product_table td input{
                    border:none;
                    border-bottom:solid;
                }
                #e_submit_product{
                    width:80%;
                    color:white;
                    background-color:black;
                    font-size:3vh;
                }
            </style>";
        echo "<table id='edit_product_table'>
                <tr>
                    <th colspan=2>Edit Product</th>
                </tr>";
        foreach($conn->query($sql) as $res){
            echo    '<tr>
                        <td>Name:</td>
                        <td><input id="e_name_p" type="text" value="'.$res['Name'].'"></td>
                    </tr>
                    <tr>
                        <td>Image URL:</td>
                        <td><input id="e_image_p" type="text" value="'.$res['Image'].'"></td>
                    </tr>
                    <tr>
                        <td>Category:</td>
                        <td><input id="e_category_p" type="text" value="'.$res['Category'].'"></td>
                    </tr>
                    <tr>
                        <td>Price(Rs):</td>
                        <td><input id="e_price_p" type="text" value="'.$res['Price'].'"></td>
                    </tr>';
        }
        echo "<tr><td colspan=2><button id='e_submit_product'>Submit</td></table>";
    }
?>
<?php
    if(isset($_POST['show_order'])){
        show_order();
    }
    if($_POST['type']=="order"){
        $_SESSION['page']['order'] = $_POST['page'];
        show_order();
    }
    if($_POST['order_detail']){
        show_order_detail($_POST['order_detail']);
    }
    if($_POST['edit_order']){
        $_SESSION['edit_order'] = $_POST['edit_order'];
        show_edit_order($_POST['edit_order']);
    }
    if($_POST['e_submit_order']){
        $id = $_SESSION['edit_order']; unset($_POST['edit_order']);
        $dd = $_POST['delivery'];
        $status = $_POST['status'];
        $sql = "UPDATE Orders SET Delivery_Date = '$dd', Status = '$status' WHERE Order_id = '$id'";
        $conn->query($sql);
        show_order();
    }
    function show_order(){
        include 'sql_conn.php';
        $res_per_page = 5;
        $sql = "SELECT COUNT(*) as Total FROM Orders";
        $count = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);
        $count = $count['Total'];
        //echo $count;
        $num_of_pages = ceil($count/$res_per_page);
        if(!isset($_SESSION['page']['order']))   $page = 1;
        else $page = $_SESSION['page']['order'];
        $this_page_first_res = ($page-1)*$res_per_page;
        $sql = "SELECT * FROM Orders LIMIT $this_page_first_res,$res_per_page";
       // echo $page;
       // echo $sql;
        echo '<style>
                table.table{
                    margin-top:2vh;
                    margin-left:auto;
                    margin-right:auto;
                }
                .table td{  
                    padding-left:3vh;
                    padding-right:2vh;
                    padding-top:2vh;
                    padding-bottom:2vh;
                }
                .table td img{  
                    width:10vh;
                    height:10vh;
                }
                .table tr{
                    margin-top:2%;
                }
                .table th{
                    font-size:120%
                }
                .edit_order{
                    background: Transparent;
                    border:none;
                    font-size:3vh;
                    color:#0267f5;
                }
                .order_details{
                    background: Transparent;
                    border:none;
                    font-size:3vh;
                    color:green;
                }
            </style>';
        echo "<table class='table' id='order_table'>
                            <tr class='text-primary'>
                                <th>#</th>
                                <th>Order Id</th>
                                <th>User Email</th>
                                <th>City</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Order Date</th>
                                <th>Delivery Date</th>
                                <th colspan=2>Action</th>
                            </tr>";
        $i=$this_page_first_res+1;
        foreach($conn->query($sql) as $res){
            echo "<tr>
                    <td><b>".$i++."</b></td>
                    <td>".$res['Order_id']."</td>
                    <td>".$res['User_email']."</td>
                    <td>".$res['City']."</td>
                    <td>".$res['Total_Amount']."</td>
                    <td>".$res['Status']."</td>
                    <td>".$res['Order_Date']."</td>
                    <td>".$res['Delivery_Date']."</td>
                    <td><button class='order_details'><i class='bi bi-newspaper'></i><br>Details</button></td>
                    <td><button class='edit_order'><i class='bi bi-pen'></i>Edit</button></td>
                </tr>";
        }
        echo "</table>";

        for($page = 1;$page<=$num_of_pages;$page++){
            echo '<button class="page_btn_order">'.$page.'</button>';
        }
    }
    function show_order_detail($order_id){
        include 'sql_conn.php';
        $sql = "SELECT * FROM Order_details WHERE Order_id = '$order_id'";
        echo '<style>
                #order_detail{
                    margin-left:auto;
                    margin-right:auto;
                }
                #order_detail , th , td , tr{
                    text-align:center;
                }
                #order_detail td{
                    padding:1vh;
                }
                #order_detail th{
                    padding:2vh;
                }
            </style>';
        echo '<table id="order_detail">
                <tr>
                    <th colspan=2><h3>Order Id:- '.$order_id.'</h3></th>
                </tr>
                <tr>
                    <th>Product Id</th>
                    <th>Quantity</th>
                </tr>';
        foreach($conn->query($sql) as $res){
            echo '<tr>
                    <td>'.$res['Product_id'].'</td>
                    <td>'.$res['Quantity'].'</td>
                </tr>';
        }
        echo '<tr><td colspan=2><button id="go_back">Go back</button></tr></table>';

    }
    function show_edit_order($id){
        include 'sql_conn.php';
        $sql = "SELECT * FROM Orders WHERE Order_id = '$id'";
        echo '<style>
                #order_edit{
                    margin-left:auto;
                    margin-right:auto;
                }
                #order_edit , th , td , tr{
                    text-align:left;
                }
                #order_edit td{
                    padding:1vh;
                }
                #order_edit th{
                    padding:2vh;
                }
            </style>';
        echo '<table id="order_edit">
                <tr>
                    <th colspan=2><h3>Order Id:- '.$id.'</h3></th>
                </tr>';
        foreach($conn->query($sql) as $res){
            echo '<tr>
                    <td><b>User Id</b></td>
                    <td>'.$res['User_email'].'</td>
                </tr>
                <tr>
                    <td><b>Order Date</b></td>
                    <td>'.$res['Order_Date'].'</td>
                </tr>
                <tr>
                    <td><b>Delivery Date</b></td>
                    <td><input id="delivery_date" type="date" value="2022-06-24"></td>
                </tr>
                <tr>
                    <td><b>Status</b></td>
                    <td>
                        <select id="s_status">
                            <option value = "Pending">Pending</option>
                            <option value = "Approved">Approved</option>
                            <option value = "Rejected">Rejected</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><b>Total Amount(Rs)</b></td>
                    <td>'.$res["Total_Amount"].'</td>
                </tr>';
        }
        echo '<tr><td colspan=2><button id="e_submit_order">Submit</button></tr></table>';
    }

?>
<?php
    if(isset($_POST['Home'])){
        include 'sql_conn.php';
        $sql = "SELECT * FROM User LIMIT 5";
        echo "<style>
                table , tr , td , th{
                    padding:1vh;
                    border:solid;   
                    border-collapse:collapse;
                }
                table{
                    width:80%;
                }
                th{
                    border:solid 2px;
                    color:white;
                    background-color:grey;
                }
                #main_home{
                    width:100vw;
                    height:100%;
                    //padding:5px;
                    
                }
                #main_home div{
                    padding:1vw;
                }
                #heading th{
                    background-color:#0d0c0a;
                }
                img{
                    width:8vh;
                    height:5vh;
                }
                #userr{
                    
                }
                #productt{
                   
                }
                #orderr{
                    
                }
            </style>";
        echo "<center><div id='main_home'>
                <div id='userr'>
                    <table>
                        <tr id='heading'><th colspan=5>User Table</th></tr>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>City</th>
                            <th>Address</th>
                            <th>Password    </th>
                        </tr>";
        foreach($conn->query($sql) as $res){
            echo "<tr>
                    <td>".$res['Name']."</td>
                    <td>".$res['Email']."</td>
                    <td>".$res['City']."</td>
                    <td>".$res['Address']."</td>
                    <td>".$res['Password']."</td>
                </tr>";
        }
        echo    "</table></div>";
        $sql = "SELECT * FROM Products ORDER BY Id DESC LIMIT 5";
        echo "<div id='productt'><table>
                            <tr>
                            <tr id='heading'><th colspan=5>Product Table</th></tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Price</th>
                            </tr>";
        foreach($conn->query($sql) as $res){
            echo "<tr>
                    <td>".$res['Id']."</td>
                    <td>".$res['Name']."</td>
                    <td><img src='".$res['Image']."'></td>
                    <td>".$res['Category']."</td>
                    <td>".$res['Price']."</td>
                </tr>";
        }
        echo    "</table></div>";
        $sql = "SELECT * FROM Orders ORDER BY Order_id DESC LIMIT 5";
        echo "<div id='orderr'><table>
                            <tr>
                            <tr id='heading'><th colspan=7>Order Table</th></tr>
                                <th>Order Id</th>
                                <th>User Email</th>
                                <th>City</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Order Date</th>
                                <th>Delivery Date</th>
                            </tr>";
        foreach($conn->query($sql) as $res){
            echo "<tr>
                    <td>".$res['Order_id']."</td>
                    <td>".$res['User_email']."</td>
                    <td>".$res['City']."</td>
                    <td>".$res['Total_Amount']."</td>
                    <td>".$res['Status']."</td>
                    <td>".$res['Order_Date']."</td>
                    <td>".$res['Delivery_Date']."</td>
                </tr>";
        }
        echo    "</table></div></div></center>";
            //     </div>
            // </div>";
    }
?>