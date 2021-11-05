<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>防疫點日記</title>
	<meta http-equiv="Content-Type" content="text/html"  charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="cache-control" content="no-cache">
	<!-- Bootsrap 4 CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="  crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<!-- Fontawesome CDN -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<!-- Jquery-Confirm -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
	<style type="text/css">
		/* BASIC */
		html,body {
		  background-color: #f0f0f0;
		  height: 100%;
		  font-family: Microsoft JhengHei;
		}

		.container{
			height: 100%;
			align-content: center;
			padding-bottom: 5vw;
		}

		a {
		  /*color: #92badd;*/
		  display:inline-block;
		  text-decoration: none;
		  font-weight: 400;
		}

		/* STRUCTURE */

		.wrapper {
		  display: flex;
		  align-items: center;
		  flex-direction: column; 
		  justify-content: center;
		  width: 100%;
		  min-height: 100%;
		  padding: 2em;
		}

		#formContent {
		  -webkit-border-radius: 10px 10px 10px 10px;
		  border-radius: 10px 10px 10px 10px;
		  background: #fff;
		  padding: 1em;
		  width: 90%;
		  max-width: 35em;
		  position: relative;
		  padding-top: 2em;
		  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
		  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
		  text-align: center;
		}

		#formFooter {
		  /*background-color: #f6f6f6;*/
		  border-top: 2px solid #dce8f1;
		  padding: 25px;
		  text-align: center;
		  -webkit-border-radius: 0 0 10px 10px;
		  border-radius: 0 0 10px 10px;
		}

		/* FORM TYPOGRAPHY*/
		.form-group{
		    justify-content: center;
		}

		input[type=button], input[type=submit], input[type=reset]  {
		  background-color: #56baed;
		  border: none;
		  color: white;
		  padding: 15px 80px;
		  text-align: center;
		  text-decoration: none;
		  display: inline-block;
		  text-transform: uppercase;
		  font-size: 13px;
		  -webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
		  box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
		  -webkit-border-radius: 5px 5px 5px 5px;
		  border-radius: 5px 5px 5px 5px;
		  margin: 5px 20px 40px 20px;
		  -webkit-transition: all 0.3s ease-in-out;
		  -moz-transition: all 0.3s ease-in-out;
		  -ms-transition: all 0.3s ease-in-out;
		  -o-transition: all 0.3s ease-in-out;
		  transition: all 0.3s ease-in-out;
		}

		input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
		  background-color: #39ace7;
		}

		input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
		  -moz-transform: scale(0.95);
		  -webkit-transform: scale(0.95);
		  -o-transform: scale(0.95);
		  -ms-transform: scale(0.95);
		  transform: scale(0.95);
		}

		input[type=tel],input[type=password] {
		  background-color: #f6f6f6;
		  border: none;
		  color: #0d0d0d;
		  padding: 15px 32px;
		  text-align: center;
		  text-decoration: none;
		  display: inline-block;
		  font-size: 1em;
		  /*margin: 5px;*/
		  width: 20em;
		  border: 2px solid #f6f6f6;
		  -webkit-transition: all 0.5s ease-in-out;
		  -moz-transition: all 0.5s ease-in-out;
		  -ms-transition: all 0.5s ease-in-out;
		  -o-transition: all 0.5s ease-in-out;
		  transition: all 0.5s ease-in-out;
		  -webkit-border-radius: 5px 5px 5px 5px;
		  border-radius: 5px 5px 5px 5px;
		}

		input[type=tel]:focus,input[type=password]:focus {
		  background-color: #fff;
		  border-bottom: 2px solid #5fbae9;
		}

		input[type=tel]:placeholder {
		  color: #cccccc;
		}

		/* ANIMATIONS */
		/* Simple CSS3 Fade-in-down Animation */
		.fadeInDown {
		  -webkit-animation-name: fadeInDown;
		  animation-name: fadeInDown;
		  -webkit-animation-duration: 0.5s;
		  animation-duration: 0.5s;
		  -webkit-animation-fill-mode: both;
		  animation-fill-mode: both;
		}

		@-webkit-keyframes fadeInDown {
		  0% {
		    opacity: 0;
		    -webkit-transform: translate3d(0, -100%, 0);
		    transform: translate3d(0, -100%, 0);
		  }
		  100% {
		    opacity: 1;
		    -webkit-transform: none;
		    transform: none;
		  }
		}

		@keyframes fadeInDown {
		  0% {
		    opacity: 0;
		    -webkit-transform: translate3d(0, -100%, 0);
		    transform: translate3d(0, -100%, 0);
		  }
		  100% {
		    opacity: 1;
		    -webkit-transform: none;
		    transform: none;
		  }
		}

		/* Simple CSS3 Fade-in Animation */
		@-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
		@-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
		@keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

		.fadeIn {
		  opacity:0;
		  -webkit-animation:fadeIn ease-in 1;
		  -moz-animation:fadeIn ease-in 1;
		  animation:fadeIn ease-in 1;

		  -webkit-animation-fill-mode:forwards;
		  -moz-animation-fill-mode:forwards;
		  animation-fill-mode:forwards;

		  -webkit-animation-duration:1s;
		  -moz-animation-duration:1s;
		  animation-duration:1s;
		}

		.fadeIn.first {
		  -webkit-animation-delay: 0.1s;
		  -moz-animation-delay: 0.1s;
		  animation-delay: 0.1s;
		}

		.fadeIn.second {
		  -webkit-animation-delay: 0.3s;
		  -moz-animation-delay: 0.3s;
		  animation-delay: 0.3s;
		}

		.fadeIn.third {
		  -webkit-animation-delay: 0.5s;
		  -moz-animation-delay: 0.5s;
		  animation-delay: 0.5s;
		  padding: 0;
		}

		.fadeIn.fourth {
		  -webkit-animation-delay: 0.7s;
		  -moz-animation-delay: 0.7s;
		  animation-delay: 0.7s;
		}

		/* Simple CSS3 Fade-in Animation */
		.underlineHover:after {
		  display: block;
		  left: 0;
		  bottom: -10px;
		  width: 0;
		  height: 2px;
		  background-color: #56baed;
		  content: "";
		  transition: width 0.2s;
		}

		.underlineHover:hover {
		  color: #0d0d0d;
		}

		.underlineHover:hover:after{
		  width: 100%;
		}

		.logo_title{
		    /*color:#60a0ff;*/
		    color: black;
	        align-self: center;
	        margin-left: 0.5em;
		}

		/* OTHERS */

		*:focus {
		    outline: none;
		} 

		.icon{
			width: 12em;
			height: 6em;
		}
		.reward_img {
			width: 8em;
			width: 8em;
		}
		/* Adjust For mobile */
		@media screen and (max-width: 550px) {

			h2{
				font-size: 1.5rem;
			}

			#formContent {
				padding: 1rem 0.25em;
				width: 105%;
			}

			.wrapper{
				padding: 0.25em;
			}

			.icon{
				width: 8em;
				height: 5em;
			}

			input[type=tel], input[type=password]{
				width: 12rem;
				padding: 1rem 0.5rem;
			}
			.reward_img {
				width: 5em;
				width: 5em;
			}	
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function(){
			
			$("#ClickModal").on("click", function (event) {
			    event.preventDefault();
			    $("#Modal").modal('show')
			});

			$("#btn_register").on("click", function (event) {
			    event.preventDefault();
			    window.location.href = './register.php';
			});

			$("#LoginForm").on("submit", function (event) {
			// $("#btn_sign_in").on("click", function (event) {
			    event.preventDefault();
                window.location.href = './main.php';
			});
    	});
	</script>
</head>
<body>
	<div class="container">
		<div class="wrapper fadeInDown">
            <div id="formContent">
		    <!-- Icon -->
		    <div class="fadeIn first" style="display: inline-flex;">
		      <!-- <img src="http://cdiary3.tw/pic/logo.png" id="logo" alt="點日記3.0" /> -->
		      <h2 class="logo_title">高中生點日記</h2>
		    </div>
		      <!-- Login Form -->
              <form id="LoginForm">
		    	<div class="input-group form-group fadeIn second ">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-user"></i></span>
					</div>
					<input id="username" type="tel" placeholder="請輸入帳號 (手機號碼)" pattern="[0-9]{10}">
				</div>
				<div class="input-group form-group fadeIn second ">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-key"></i></span>
					</div>
					<input id="password" type="password" placeholder="請輸入密碼">
				</div>
				<div>
					<button id="btn_sign_in" class="btn fadeIn third" type="submit">
                        <b>登入</b>
					</button>
					<button id="btn_register" class="btn fadeIn third">
                        <b>註冊</b>
					</button>
				</div>
              </form>
		      <div id="formFooter" class="fadeIn fourth">
		    	<div class="mb-1">
		    		<a id="ClickModal" href="#" style="color: red;" >計畫簡介與補助辦法<i class=""></i></a>
		    	</div>
		    	<div class="mb-2">
		    		<a class="underlineHover" href="./pwreset.php">忘記密碼<i class="fas fa-question-circle"></i></a>
		    	</div>
		    	<div>
		    		<a class="underlineHover" href="mailto:***@gmail.com">若有任何疑問，歡迎來信至：***@gmail.com</a>
		    	</div>
		      </div>
		      </div>
		</div>
    </div>
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">計畫簡介與補助辦法</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					內容待補
				</div>
			</div>
		</div>
	</div>
</body>
</html>