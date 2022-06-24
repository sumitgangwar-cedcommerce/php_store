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
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Admin Log In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
		
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
				<!-- <div class="group">
					<input id="check" type="checkbox" class="check" checked>
					<label for="check"><span class="icon"></span> Keep me Signed in</label>
				</div> -->
				<div class="group">
					<input type="submit" class="button" id="login_submit" value="Log In">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<a href="login_register_page.php">LogIn/Register as User?</a>
				</div>
			</div>
			<div class="sign-up-htm">
				
			</div>
		</div>
	</div>
</div>
</body>
<script>
	$(document).ready(function(){
		$("#login_submit").click(function(){
			$user = $('#user').val();
			$pass = $('#pass').val();
			check_ldata();
			if($tt==1){
				//$check = $("#check").prop('checked');
				$.ajax({
					type:'post',
					url:'admin_server.php',
					data:{
						admin_login_req:"xds",
						email:$user,
						password:$pass
					},
					success:function(response){
						console.log(response);
						if(response==1)	window.location = 'admin_page.php';
						else	alert('wrong input');
					}
				});
			}
			
		});
	});
    
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
		}else	$('#err_lemail').html('');
		return $tt;
	}
</script>
</html>