$(document).ready(function(){
    $("#log_out").click(function(){
        $.ajax({
            type:'post',
            url:'admin_server.php',
            data:{
                log_out:'admin'
            },
            success:function(response){
                window.location = 'admin_login.php';
            }
        });
    });
    // user management
    $("#user_management").click(function(){
        $("#user_management").css("background-color" , "black");
        $("#user_management").css("color" , "white");
        $("#product_management").css("background-color" , "white");
        $("#product_management").css("color" , "black");
        $("#Home").css("background-color" , "white");
        $("#Home").css("color" , "black");
        $("#order_management").css("background-color" , "white");
        $("#order_management").css("color" , "black");
        $.ajax({
            type:'post',
            url:'admin_server.php',
            data:{
                show_user:'user'
            },
            success:function(response){
                $('#content').html(response);
            }
        });
    });
    $("#content").on("click", "#add_user",function(){
        $.ajax({
            type:"post",
            url:"admin_server.php",
            data:{
                add_user:"user",
            },
            success:function(response){
                $("#content").html(response);
            }
        });
    });
    $("#content").on("click", "#a_submit_user",function(){
        $name = $('#a_name').val();
        $email = $('#a_email').val();
        $password = $('#a_password').val();
        $address = $('#a_address').val();
        $city = $('#a_city').val();
        $role = $('#role').val();
        $.ajax({
            type:"post",
            url:"admin_server.php",
            data:{
                add_user_submit:'submit button',
                name : $name,
                email : $email,
                password : $password,
                city : $city,
                address : $address,
                role:$role
            },
            success:function(response){
                if(response==0) alert("Enter different email id");
                else    $("#content").html(response);
            }
        });
    });
    $("#content").on("click", ".page_btn",function(){
        $page = $(this).html();
        //alert($page);
        $.ajax({
            type:"post",
            url:"admin_server.php",
            data:{
                type:"user",
                page:$page
            },
            success:function(response){
                $("#content").html(response);
            }
        });
    });
    $("#content").on("click", ".edit_user",function(){
        //alert("d");
        $email = $(this).closest('tr')[0].childNodes[5].innerHTML;
        console.log($email);
        $.ajax({
            type:"post",
            url:"admin_server.php",
            data:{
                edit_user_show:$email,
            },
            success:function(response){
                $("#content").html(response);
            }
        });
    });
    $("#content").on("click", ".delete_user",function(){
        $email = $(this).closest('tr')[0].childNodes[5].innerHTML;
        $.ajax({
            type:"post",
            url:"admin_server.php",
            data:{
                delete_user:$email,
            },
            success:function(response){
                $("#content").html(response);
            }
        });
    });
    $("#content").on("click", "#e_submit_user",function(){
        $name = $('#e_name').val();
        $email = $('#e_email').val();
        $password = $('#e_password').val();
        $address = $('#e_address').val();
        $city = $('#e_city').val();
        $role = $('#role').val();
        //alert($role);
        $.ajax({
            type:"post",
            url:"admin_server.php",
            data:{
                edit_user_submit:'submit button',
                name : $name,
                email : $email,
                password : $password,
                city : $city,
                address : $address,
                role:$role
            },
            success:function(response){
                $("#content").html(response);
            }
        });
    });
    // end of user management

    // product management
    $("#product_management").click(function(){
        $("#product_management").css("background-color" , "black");
        $("#product_management").css("color" , "white");
        $("#user_management").css("background-color" , "white");
        $("#user_management").css("color" , "black");
        $("#Home").css("background-color" , "white");
        $("#Home").css("color" , "black");
        $("#order_management").css("background-color" , "white");
        $("#order_management").css("color" , "black");
        $.ajax({
            type:'post',
            url:'admin_server.php',
            data:{
                show_product:'product'
            },
            success:function(response){
                $('#content').html(response);
            }
        });
    });
    $("#content").on("click", "#add_product",function(){
        $.ajax({
            type:"post",
            url:"admin_server.php",
            data:{
                add_product:"user",
            },
            success:function(response){
                $("#content").html(response);
            }
        });
    });
    $("#content").on("click", "#a_submit_product",function(){
        $name = $('#a_name_p').val();
        $image = $('#a_image_p').val();
        $category = $('#a_category_p').val();
        $price = $('#a_price_p').val();
        $.ajax({
            type:"post",
            url:"admin_server.php",
            data:{
                add_product_submit:'submit button',
                name : $name,
                image : $image,
                category : $category,
                price : $price
            },
            success:function(response){
                $("#content").html(response);
            }
        });
    });
    $("#content").on("click", ".page_btn_product",function(){
        $page = $(this).html();
        //alert($page);
        $.ajax({
            type:"post",
            url:"admin_server.php",
            data:{
                type:"product",
                page:$page
            },
            success:function(response){
                $("#content").html(response);
            }
        });
    });
    $("#content").on("click", ".delete_product",function(){
        $p_id = $(this).closest('tr')[0].childNodes[3].innerHTML;
        $.ajax({
            type:"post",
            url:"admin_server.php",
            data:{
                delete_product:$p_id,
            },
            success:function(response){
                $("#content").html(response);
            }
        });
    });
    $("#content").on("click", ".edit_product",function(){
        //alert("d");
        $id = $(this).closest('tr')[0].childNodes[3].innerHTML;
        console.log($id);
        $.ajax({
            type:"post",
            url:"admin_server.php",
            data:{
                edit_product_show:$id,
            },
            success:function(response){
                $("#content").html(response);
            }
        });
    });
    $("#content").on("click", "#e_submit_product",function(){
        $name = $('#e_name_p').val();
        $image = $('#e_image_p').val();
        $category = $('#e_category_p').val();
        $price = $('#e_price_p').val();
        $.ajax({
            type:"post",
            url:"admin_server.php",
            data:{
                edit_product_submit:'submit button',
                name : $name,
                image:$image,
                category:$category,
                price:$price
            },
            success:function(response){
                $("#content").html(response);
            }
        });
    });
    // end of product management

    //order management
    $("#order_management").click(function(){
        $("#user_management").css("background-color" , "white");
        $("#user_management").css("color" , "black");
        $("#product_management").css("background-color" , "white");
        $("#product_management").css("color" , "black");
        $("#Home").css("background-color" , "white");
        $("#Home").css("color" , "black");
        $("#order_management").css("background-color" , "black");
        $("#order_management").css("color" , "white");
        $.ajax({
            type:'post',
            url:'admin_server.php',
            data:{
                show_order:'order'
            },
            success:function(response){
                $('#content').html(response);
            }
        });
    });
    $("#content").on("click", ".page_btn_order",function(){
        $page = $(this).html();
        //alert($page);
        $.ajax({
            type:"post",
            url:"admin_server.php",
            data:{
                type:"order",
                page:$page
            },
            success:function(response){
                $("#content").html(response);
            }
        });
    });
    $("#content").on("click", ".order_details",function(){
        $order_id = $(this).closest('tr')[0].childNodes[3].innerHTML;
        //alert($order_id);
        $.ajax({
            type:"post",
            url:"admin_server.php",
            data:{
                order_detail:$order_id
            },
            success:function(response){
                $("#content").html(response);
            }
        });
    });
    $("#content").on("click", "#go_back",function(){
        $.ajax({
            type:'post',
            url:'admin_server.php',
            data:{
                show_order:'order'
            },
            success:function(response){
                $('#content').html(response);
            }
        });
    });
    $("#content").on("click", ".edit_order",function(){
        $order_id = $(this).closest('tr')[0].childNodes[3].innerHTML;
        $.ajax({
            type:'post',
            url:'admin_server.php',
            data:{
                edit_order:$order_id
            },
            success:function(response){
                $('#content').html(response);
            }
        });
    });
    $("#content").on("click", "#e_submit_order",function(){
        $delivery = $('#delivery_date').val();
        $s_status = $('#s_status').val();
        console.log($delivery);
        $.ajax({
            type:'post',
            url:'admin_server.php',
            data:{
                e_submit_order:"order",
                delivery : $delivery,
                status:$s_status
            },
            success:function(response){
                $('#content').html(response);
            }
        });
    });
    // home
    $("#Home").click(function(){
        $("#user_management").css("background-color" , "white");
        $("#user_management").css("color" , "black");
        $("#product_management").css("background-color" , "white");
        $("#product_management").css("color" , "black");
        $("#Home").css("background-color" , "black");
        $("#Home").css("color" , "white");
        $("#order_management").css("background-color" , "white");
        $("#order_management").css("color" , "black");
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
    });
    
});