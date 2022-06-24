<!DOCTYPE html>
<html lang="en">
<head>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<link rel="stylesheet" href="login_register_page.css">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
<div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Log In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Register</label>
		
		<div class="login-form">
			<div class="sign-in-htm">
				<div class="group">
					<label for="user" class="label">Email</label>
					<input id="user" type="text" class="input"><span id="err_lemail"></span>
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" type="password" class="input" data-type="password"><span id="err_lpass"></span>
				</div>
				<div class="group">
					<input id="check" type="checkbox" class="check" checked>
					<label for="check"><span class="icon"></span> Keep me Signed in</label>
				</div>
				<div class="group">
					<input type="submit" class="button" id="login_submit" value="Log In">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<a href="admin_login.php">Log In as Admin?</a>
				</div>
			</div>
			<div class="sign-up-htm">
				<div class="group">
					<label for="n_user" class="label">Name</label>
					<input id="n_user" type="text" class="input"><span id="err_name"></span>
				</div>
				<div class="group">
					<label for="n_email" class="label">Email Address</label>
					<input id="n_email" type="txt" class="input"><span id="err_email"></span>
				</div>
				<div class="group">
					<label for="n_pass" class="label">Password</label>
					<input id="n_pass" type="password" class="input" data-type="password"><span id="pass_err"></span>
				</div>
				<div class="group">
					<label for="cpass" class="label">Repeat Password</label>
					<input id="cpass" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<label for="n_city" class="label">City</label>
					<input id="n_city" type="text" class="input"><span id="err_city"></span>
				</div>
				<div class="group">
					<label for="n_address" class="label">Address</label>
					<input id="n_address" type="text" class="input"><span id="err_address"></span>
				</div>
				<div class="group">
					<input id="register_submit" type="submit" class="button" value="Register">
				</div>
				<div class="hr"></div>
				<!-- <div class="foot-lnk">
					<label for="tab-1">Already Member?</a>
				</div> -->
			</div>
		</div>
	</div>
</div>
</body>
<script>
	$(document).ready(function(){
		$("#register_submit").click(function(){
			$user = $('#n_user').val();
			$pass = $('#n_pass').val();
			$cpass = $('#cpass').val();
			$email = $('#n_email').val();
			$city = $('#n_city').val();
			$address  = $('#n_address').val();
			$t = check_data();
			if($t==1){
				$.ajax({
					type:'post',
					url:'user_server.php',
					data:{
						register_req:'register',
						email:$email,
						password:$pass,
						name : $user,
						city:$city,
						address:$address
					},
					success:function(response){
						if(response==0)	alert("Enter different email id");
						else	window.location = 'login_register_page.php';
					}
				});
			}
			
			
			
		});
		$("#login_submit").click(function(){
			$user = $('#user').val();
			$pass = $('#pass').val();
			check_ldata();
			if($tt==1){
				$check = $("#check").prop('checked');
				$.ajax({
					type:'post',
					url:'user_server.php',
					data:{
						login_req:$check,
						email:$user,
						password:$pass
					},
					success:function(response){
						console.log(response);
						if(response=="true")	window.location = 'index.php';
						else	alert('wrong input');
					}
				});
			}
			
		});
	});
	function check_data(){
		$t = 1;
		$user = $('#n_user').val();
		$pass = $('#n_pass').val();
		$cpass = $('#cpass').val();
		$email = $('#n_email').val();
		$city = $('#n_city').val();
		$address  = $('#n_address').val();
		if($user==""){
			$('#err_name').css('color' , 'red');
			$('#err_name').html('*Enter Valid Name');
			$t=0;
		}else	$('#err_name').html('');
		if($address==""){
			$('#err_address').css('color' , 'red');
			$('#err_address').html('*Enter Valid Address');
			$t=0;
		}else	$('#err_address').html('');	
		if($city==""){
			$('#err_city').css('color' , 'red');
			$('#err_city').html('*Enter Valid City');
			$t=0;
		}else	$('#err_city').html('');	
		if($cpass!=$pass || $cpass=="" || $pass==""){
			$t=0;
			$('#pass_err').css('color' , 'red');
			$('#pass_err').html('*Password Should be same');
		}else	$('#pass_err').html('');
		$mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		if(!$email.match($mailformat)){
			//alert("sdv");
			$t=0;
			$('#err_email').css('color' , 'red');
			$('#err_email').html('*Enter Valid email id');
		}else	$('#err_email').html('');
		return $t;
	}
	function check_ldata(){
		$tt=1;
		$user = $('#user').val();
		$pass = $('#pass').val();
		if($user==""){
			$('#err_lemail').css('color' , 'red');
			$('#err_lemail').html('*Enter Email id');
			$tt=0;
		}
		if($pass==""){
			$('#err_lpass').css('color' , 'red');
			$('#err_lpass').html('*Enter password');
			$tt=0;
		}
		$mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		if(!$user.match($mailformat) && $user!=""){
			//alert("sdv");
			$tt=0;
			$('#err_lemail').css('color' , 'red');
			$('#err_lemail').html('*Enter Valid email id');
		}
		return $tt;
	}
</script>
</html>