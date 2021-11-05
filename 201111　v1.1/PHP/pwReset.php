<?php
    session_start();
    include "db.php";

    if(isset($_POST["username"])){
		$username=$_POST["username"];
		$password1=$_POST["password1"];
        $password2=$_POST["password2"];
		$password_encoded=base64_encode($password1);
        
        $sql1="SELECT * FROM `account` WHERE username= :v1";
		$stmt=$db->prepare($sql1);
		$stmt->bindParam(":v1", $username);
		$stmt->execute();
        $rs1=$stmt->fetch(PDO::FETCH_ASSOC);
        
        if($stmt->rowCount()==0){
            echo "Invalid Username";    //1a.查無帳號
        }else if(strlen($password1)<6){
            echo "Password Too Short";  //1b.密碼過短
        }else if($password1!=$password2){
            echo "Passwords Different"; //1c.密碼輸入相異
        }else{
            $sql2="UPDATE `account` SET password= :v1 WHERE username= :v2";
            $stmt=$db->prepare($sql2);
            $stmt->bindParam(":v1", $password_encoded);
            $stmt->bindParam(":v2", $username);
            $stmt->execute();           //2.更改成功

            echo "PwReset Success";
        }
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>會員密碼重置</title>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="cache-control" content="no-cache">
    
	<!-- Bootsrap 4 CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
	<!-- Fontawesome CDN -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    
	<!-- Jquery-Confirm -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    
	<style>
		/* BASIC */
		html, body{
            height: 100%;
            background-color: #f0f0f0;
            font-family: Microsoft JhengHei;
		}
        
        /* STRUCTURE */
		.container{
			height: 100%;
			align-content: center;
		}
        
        .wrapper{
            min-height: 100%; width: 100%; padding: 3em 6em;
            display: flex; flex-direction: column; justify-content: center; align-items: center;
		}
        
        #formContent{
            width: 60%; padding: 3em;
            background: #fff;
            position: relative; text-align: center;
            -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3); box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3); -webkit-border-radius: 20px; border-radius: 20px;
		}
        
		/* DETAILED */
		.form-group{
		    justify-content: center;
		}
        
        hr{
            height: 2px; border: 0;
            background-color: #C4C400;
        }

		input[type=email], input[type=password]{
            width: 60%; padding-top: 0.4em; border: 0;
            color: black; background-color: #f0f0f0;
            font-size: 1em; text-align: center; display: inline-block;
            -webkit-border-radius: 5px; border-radius: 5px;            
		}

		input[type=email]:focus, input[type=password]:focus{
            border: 4px solid #C4C400;
		}
        
        #btn_reset, #btn_back{
            width: 24%;
            color: white; background-color: #C4C400;
            font-size: 1em;
            -webkit-border-radius: 10px; border-radius: 10px;
        }

		/* RESPONSIVE */
		@media screen and (max-width: 550px){
            .wrapper{
                padding: 2em 1em;
                font-size: 0.8em;
            }
            
            #formContent{
                width: 100%; padding: 2em;
            }
            
            h5{
                font-size: 1.2em;
            }
		}
	</style>
    
    <script>
		$(document).ready(function(){
            $("#btn_back").on("click", function(event){
                event.preventDefault();
                window.location.href="./index.php";
            })

			$("#pwResetForm").on("submit", function(event){
                event.preventDefault();
                
                $.ajax({
                    type: "POST",
                    url: "",
                    data: $("form#pwResetForm").serialize(),
                    success: function(data){
                        console.log("PwReset:", data)
                        if(data=="Invalid Username"){
                            $.alert({
                                title: "",
                                content: "此帳號不存在，請檢查你註冊的信箱",
                            }) 
                        }else if(data=="Password Too Short"){
                            $.alert({
								title: "",
								content: "密碼長度過短（至少 6 碼）",
                            })    
                        }else if(data=="Passwords Different"){
                            $.alert({
								title: "",
								content: "兩次輸入密碼不一致，請重新確認",
                            })
                        }else if(data=="PwReset Success"){
                            $.confirm({
								title: "",
								content: "密碼重置成功，請重新登入",
								buttons:{
								    "OK": function(){
                                        window.location.href="./index.php";
                                    }
								}
                            })
                        }
                    }, error: function(e){
                        console.log(e);
				    }
                })
			})
    	})
	</script>
</head>


<body>
	<div class="container">
    <div class="wrapper">        
        <div id="formContent">
            <div>
                <p><img src="./pic/logo.png" style="width: 40%"></p>
                <h5 align="center" style="color: #C4C400">會員密碼重置</h5><hr>
            </div>

            <form id="pwResetForm">
            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
				<input name="username" type="email" placeholder="請輸入帳號（學校信箱）">
            </div>
                
            <div class="input-group form-group">
				<div class="input-group-prepend">
				    <span class="input-group-text"><i class="fas fa-key"></i></span>
				</div>
				<input name="password1" type="password" placeholder="請輸入密碼（至少 6 碼）">
            </div>
                
            <div class="input-group form-group">
				<div class="input-group-prepend">
				    <span class="input-group-text"><i class="fas fa-key"></i></span>
				</div>
				<input name="password2" type="password" placeholder="請再次確認密碼">
            </div>
                
            <div>
                <button id="btn_back" class="btn">返回</button>
                <button id="btn_reset" class="btn" type="submit">送出</button>
            </div>
            </form>
        </div>        
    </div>
    </div>
</body>
</html>
