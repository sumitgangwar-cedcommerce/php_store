$(document).ready(function(){
    // header js
    $("#header").on("click","#login_register_btn" , function(){
        window.location = 'login_register_page.php';
    });
    // $("#cart_button").click(function(){
    //     window.location = 'cart_page.php'
    // });
    $('#header').on("click" , '#cart_icon_div', function(){
        $.ajax({
            type:"post",
            url:"user_server.php",
            data:{
                check_session:'session'
            },
            success:function(response){
                if(response=="1"){
                    $('#body').load('cart_page.php');
                    //$('#footer').html("");
                }
                else window.location = 'login_register_page.php';
            }
        });
    });
    $("#header").on("click","#Mobile" , function(){
        $('#body').load('mobile_page.php');
    });
    $("#header").on("click","#TV" , function(){
        $('#body').load('tv_page.php');
    });
    $("#header").on("click","#profile_btn" , function(){
        $.ajax({
            type:'post',
            url:'user_server.php',
            data:{
                logout:'logout'
            },
            success:function(response){
                window.location = 'index.php';
            }
        });
    });
    // product page  js
    $("#body").on("click",".add_to_cart_btn",function(){
        $div = $(this).closest('center');
        $.ajax({
            type:"post",
            url:"user_server.php",
            data:{
                check_session:'session'
            },
            success:function(response){
                if(response=="1"){
                    
                    $quantity = $div[0].childNodes[1].childNodes[3].value;
                    $price =  $div.closest('div')[0].childNodes[3].childNodes[1].childNodes[2].innerHTML;
                    $name = $div.closest('div')[0].childNodes[3].childNodes[1].childNodes[0].innerHTML;
                    $act_pri = "";
                    for(i=4;i<$price.length-2;i++)  $act_pri+=$price[i];
                    $price = $act_pri;
                    //alert($price);
                    $.ajax({
                        type:"post",
                        url:"user_server.php",
                        data:{
                            add_to_cart:$name,
                            quantity:$quantity,
                            price:$price
                        },
                        success:function(response){
                            $("#header #cart_button").html(response);
                            //$("#header").html(response);
                            //console.log(response);
                        }
                    });    
                }
                else window.location = 'login_register_page.php';
                
            }
        });
        
    })
    $("#body").on("click",".minus_counter",function(){
        $quantity = $(this).closest('div')[0].childNodes[3].value;
        if(Number($quantity)-1>0)
            $(this).closest('div')[0].childNodes[3].value = Number($quantity)-1;
    });
    $("#body").on("click",".plus_counter",function(){
        $quantity = $(this).closest('div')[0].childNodes[3].value;
        $(this).closest('div')[0].childNodes[3].value = Math.ceil(Number($quantity)+1/3);
    });
    // cart_page js
    
    $("#body").on("click",".cart_plus_counter", function(){
        $name = $(this).closest('tr')[0].childNodes[3].innerHTML;
        console.log($name);
        $.ajax({
            type:'post',
            url:'user_server.php',
            data:{
                cart_plus:$name
            },
            success:function(response){
                $('#body').html(response);
            }
        })
        
    });
    $("#body").on("click",".cart_minus_counter", function(){
        $name = $(this).closest('tr')[0].childNodes[3].innerHTML;
        console.log($name);
        $.ajax({
            type:'post',
            url:'user_server.php',
            data:{
                cart_minus:$name
            },
            success:function(response){
                $('#body').html(response);
            }
        });
    });
    $("#body").on("click",".delete_cart_item", function(){
        $name = $(this).closest('tr')[0].childNodes[3].innerHTML;
        console.log($name);
        $.ajax({
            type:'post',
            url:'user_server.php',
            data:{
                delete_cart_item:$name
            },
            success:function(response){
                $('#body').html(response);
            }
        });
        $.ajax({
            type:"post",
            url:"user_server.php",
            data:{
                cart_count:'count'
            },
            success:function(response){
                $("#header #cart_button").html(response);
            }
        });
    });
    $("#body").on("click","#btn_checkout", function(){
       
        $.ajax({
            type:'post',
            url:'user_server.php',
            data:{
                checkout_btn:'btn'
            },
            success:function(response){
                $('#body').html(response);
            }
        });
    });
    $n = 0;
    $("#body").on("click","#confirm_order_btn", function(){
       console.log("sdf");
        $.ajax({
            type:'post',
            url:'user_server.php',
            data:{
                confirm_order:'btn'
            },
            success:function(response){
                //console.log(response);
                $('#body').html(response);
            }
        });
    });
    
       
    
});