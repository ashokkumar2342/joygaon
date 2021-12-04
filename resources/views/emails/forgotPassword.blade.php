<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
	 

<style type="text/css">
body{
	padding:20px;
}
	p{
		font-size: 11px;
	}
	li{
		font-size: 11px;
	}
	ul {
    	padding-left:15px;margin-top:-10px; 
	}
	#logo{ 
		padding-bottom: 40px;
	}

	#main-div{
		/*border: solid 1px #000;*/
		padding:20px;
		background-color: rgb(240,240,240);
		font-family: Tahoma;

	}

</style>
</head>
<body> 

	<br>
	<p>Dear {{$user_name}},</p>
	<p>We recently received a request to change your Joygaon&rsquo;s password for email {{$email}}.</p>
	<p>To finish changing your password, use following link. 
	 </br><a href="{{$link}}">{{$link}}</a></p>
	
	<p>Notes:</p>
	<ul>
	<li>Above link expires in 24 hours.</li>
	<li>If you can't click on the link, copy and paste it into your Web browser.</li>
	
	</ul>
	 <p>Thank You</p>
</div>
		 
</body>
</html>