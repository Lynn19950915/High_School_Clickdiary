<?php
?>

<!DOCTYPE html>
<html>
<head>
	<title>高中生點日記－會員註冊</title>
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
	<!-- Lodash -->
	<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>
	<style type="text/css">
		/* BASIC */
		html,body {
		  background-color: #f0f0f0;
		  height: 100%;
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

		.card-body{
		    letter-spacing: 0.5em;
		    line-height: 1.8em;
	        text-align: justify;
		}

		.wrapper {
		  display: flex;
		  align-items: center;
		  flex-direction: column; 
		  justify-content: center;
		  width: 100%;
		  min-height: 100%;
		  padding: 1.25em;
		}

		#formContent {
		  -webkit-border-radius: 10px 10px 10px 10px;
		  border-radius: 10px 10px 10px 10px;
		  background: #fff;
		  padding: 1em;
		  /*width: 90%;*/
		  /*max-width: 35em;*/
		  position: relative;
		  padding-top: 2em;
		  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
		  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
		  /*text-align: center;*/
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
		.form-control{
			height: 3em;
		}

		.form-group{
		    justify-content: center;
		}

		.btn.disabled, .btn:disabled {
		    cursor: not-allowed;
		    opacity: .65;
		}

		input[type=text],input[type=password] {
		  background-color: #f6f6f6;
		  border: none;
		  color: #0d0d0d;
		  padding: 15px 32px;
		  text-align: center;
		  text-decoration: none;
		  display: inline-block;
		  font-size: 1em;
		  /*margin: 5px;*/
		  width: 20em !important;
		  border: 2px solid #f6f6f6;
		  -webkit-transition: all 0.5s ease-in-out;
		  -moz-transition: all 0.5s ease-in-out;
		  -ms-transition: all 0.5s ease-in-out;
		  -o-transition: all 0.5s ease-in-out;
		  transition: all 0.5s ease-in-out;
		  -webkit-border-radius: 5px 5px 5px 5px;
		  border-radius: 5px 5px 5px 5px;
		}

		input[type=text]:focus,input[type=password]:focus {
		  background-color: #fff;
		  border-bottom: 2px solid #5fbae9;
		}

		input[type=text]:placeholder {
		  color: #cccccc;
		}

		/* OTHERS */

		*:focus {
		    outline: none;
		} 

		.icon{
			width: 10em;
		}

		.modal-header {
			padding: 0.25rem 1rem;
		}

		.reward_img {
			width: 8em;
			height: 8em;
		}

		/* Adjust For mobile */
		@media screen and (max-width: 550px) {

			h3{
				font-size: 1.5rem;
			}

			#formContent {
				width: 97%;
				padding: 0.5em;
			}

			.wrapper{
				padding: 0.25em;
			}

			input[type=text], input[type=password]{
				width: 12rem !important;
			}	

			.container {
				padding-left: 0.25rem;
				padding-right: 0.25rem;
			}

			.modal-body {
			    
			    padding: 0.5rem;
			}

			.reward_img {
				width: 6em;
				height: 6em;
			}

			.icon{
				width: 8em;
			}
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function(){

			$("#Modal").modal('show');

			$("#btn_closemodal").on("click", function(evt){
				evt.preventDefault();
				$("#Modal").modal('hide');
			})

			$("#btn_back").on("click", function (event) {
				event.preventDefault();
				window.location.href = './index.php'
			})

			$("#btn_register").on("click", function (event) {
			    event.preventDefault();
                window.location.href = './main.php'
            })
        });			    
	</script>
</head>
<body>
	<div class="container">
		<div class="wrapper">
		  <div id="formContent">
		    <div id="page_1" style="display: none;">
				<div class="card border-primary">
					<div class="card-header text-white bg-primary">防疫點日記簡介</div>
					<div class="card-body">
					
					</div>
					<div align="center">
						<img src="./pic/icf_1.jpg" style="width:80vw">
						<img src="./pic/icf_2.jpg" style="width:80vw">
					</div>
				</div>
				<div class="justify-content-center mt-2" style="text-align: center">
			 		<input type="checkbox"  id="agree"></input>
			 		<label for="agree">本人已詳閱以上說明同意書<br id="br_hide">並完全同意參與點日記研究計畫</label>
		 		</div>
		 		<div class="justify-content-center mt-2" style="text-align: center">
		 			<button id="start_regist" class="btn-primary btn-lg">開始註冊</button>
		 		</div>
	 		</div>
	 		<div id="page_2" >
			    <form class="needs-validation">
			    	<div class="input-group form-group">
			    		<h3>高中生點日記 - 會員註冊</h3>
			    	</div>
			    	<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input id="username" type="text" class="form-control" placeholder="請設定帳號(手機號碼)">
						<div class="invalid-feedback"></div>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input id="password" type="password" class="form-control" placeholder="請設定密碼">
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input id="password2" type="password" class="form-control" placeholder="請確認密碼">
					</div>
					<div class="input-group form-group">
						<button id="btn_back" class="btn">
                            <b>返回</b>
					   </button>
					   <button id="btn_register" class="btn">
                            <b>註冊</b>
						</button>
					</div>
			    </form>
			</div>

		  </div>
		</div>
    </div>
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">中研院防疫點日記研究</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
                    內容待補
				</div>
				<div class="modal-footer" style="align-self: center;">
					<button class="btn btn-primary" id="btn_closemodal">我想參加!</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>