<?php
	session_start();
    include "db.php";

    if(isset($_POST["username"])){
		$username=$_POST["username"];
		$password=$_POST["password"];
		$password_encoded=base64_encode($password);

		$sql1="SELECT * FROM `account` WHERE username= :v1";
		$stmt=$db->prepare($sql1);
		$stmt->bindParam(":v1", $username);
		$stmt->execute();
        //註：寫成fetchAll也行，但rs1["id"]會反覆被用到，既然rowCount頂多為1，少寫一層反而更便利。
		$rs1=$stmt->fetch(PDO::FETCH_ASSOC);
		
		if($stmt->rowCount()==0){
			echo "Invalid Username";     //1a.查無帳號
        }else if($rs1["password"]==""){
            echo "No Password";          //1b.未設定密碼
        }else if($password_encoded!=$rs1["password"]){
			echo "Wrong Password";       //1c.密碼錯誤
		}else{	
			$sql2="UPDATE `account` SET last_login= CURTIME() WHERE id= :v1";
			$stmt=$db->prepare($sql2);
			$stmt->bindParam(":v1", $rs1["id"]);
			$stmt->execute();           //2.更新最後登入時間
            
            $ip=$_SERVER["REMOTE_ADDR"];
			$device=$_SERVER["HTTP_USER_AGENT"];
            
			$sql3="INSERT INTO `login_records` VALUES (:v1, CURTIME(), :v2, :v3)";
			$stmt=$db->prepare($sql3);
			$stmt->bindParam(":v1", $rs1["id"]);
			$stmt->bindParam(":v2", $ip);
			$stmt->bindParam(":v3", $device);
			$stmt->execute();           //3.詳細登入資訊
            
            $sql4="SELECT * FROM `login_records` WHERE id= :v1";
            $stmt=$db->prepare($sql4);
			$stmt->bindParam(':v1', $rs1['id']);
            $stmt->execute();
            $rs4=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if($stmt->rowCount()==1){
                $sql5="UPDATE `account` SET reg_time= CURTIME() WHERE id= :v1";
                $stmt=$db->prepare($sql5);
                $stmt->bindParam(':v1', $rs1['id']);
                $stmt->execute();      //5.初次登入時間=註冊時間
            }            
            
            $sql6="SELECT * FROM `login_records` WHERE id= :v1 and DATE(time)= CURDATE()";
            $stmt=$db->prepare($sql6);
			$stmt->bindParam(':v1', $rs1['id']);
            $stmt->execute();
            $rs6=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if($stmt->rowCount()==1){
                $today=date("md");
                
                $sql7="INSERT INTO `points` VALUES (:v1, CURTIME(), :v2, 20)";
                $stmt=$db->prepare($sql7);
                $stmt->bindParam(':v1', $rs1['id']);
                $stmt->bindValue(':v2', "每日登入 #$today");
                $stmt->execute();      //7.每日首登積分
            }
            
            $_SESSION["acc_info"]=$rs1;
			echo "Login Success";
        }
        exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>高中生點日記</title>
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
        
        #formFooter{
            text-align: center;
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
        
        #btn_sign_in{
            width: 60%;
            color: white; background-color: #C4C400;
            font-size: 1em;
            -webkit-border-radius: 40px; border-radius: 40px;
        }
        
        a{
            color: #C4C400;
        }
        
        .modal-dialog{
            width: 50%; margin: 0px auto;
        }
        
        .modal-body{
            letter-spacing: 0.1em;
        }

		/* ANIMATIONS */
		@-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
		@-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
		@keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

		.fadeIn{
            opacity:0;
            -webkit-animation:fadeIn ease-in 1; -moz-animation:fadeIn ease-in 1; animation:fadeIn ease-in 1;
            -webkit-animation-duration: 1s; -moz-animation-duration: 1s; animation-duration: 1s;
            -webkit-animation-fill-mode: forwards; -moz-animation-fill-mode: forwards; animation-fill-mode: forwards;
		}

		.fadeIn.first{
            -webkit-animation-delay: 0.1s; -moz-animation-delay: 0.1s; animation-delay: 0.1s;
		}
		.fadeIn.second{
            -webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;
		}
		.fadeIn.third{
            -webkit-animation-delay: 0.5s; -moz-animation-delay: 0.5s; animation-delay: 0.5s;
		}
		.fadeIn.fourth{
            -webkit-animation-delay: 0.7s; -moz-animation-delay: 0.7s; animation-delay: 0.7s;
		}

		/* RESPONSIVE */
		@media screen and (max-width: 800px){
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
            
            .modal-dialog{
                width: 80%; margin: 0px auto;
            }
		}
	</style>
    
    <script>
		$(document).ready(function(){			
			$("#clickModal").on("click", function(event){
                event.preventDefault();
                $("#researchIntro").modal("show");
            })

			$("#loginForm").on("submit", function(event){
			    event.preventDefault();

    			$.ajax({ 
				    type: "POST",
					url: "",
					data: $("form#loginForm").serialize(),
				    success: function(data){ 
						console.log("LogIn:", data)	
						data=data.trim() 
						if(data=="Invalid Username"){
                            $("#btn_sign_in").attr("disabled", false);
                            $.alert({
							    title: "",
							    content: "此帳號不存在，請檢查你註冊的信箱。",
							})
                        }else if(data=="No Password"){
                            $.confirm({
                                title: "",
                                content: "首次登入：請先設定密碼。",
                                buttons:{
                                    "OK": function(){
                                        window.location.href="./pwReset.php";
                                    }
								}
                            })
                        }else if(data=="Wrong Password"){
                            $("#btn_sign_in").attr("disabled", false);
							$.alert({
							    title: "",
							    content: "密碼不正確，請重新輸入。",
							})
						}else if(data=="Login Success"){
                            window.location.href="./main.php";                           
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
		    <div class="fadeIn first">
                <p><img src="./pic/logo.png" style="width: 40%"></p>
                <h5 align="center" style="color: #C4C400">～記錄生活的最佳小幫手～</h5><hr>
		    </div>
            
            <form id="loginForm">
            <div class="input-group form-group fadeIn second">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
				</div>
                <input name="username" type="email" placeholder="請輸入帳號（學校信箱）">
            </div>
                
            <div class="input-group form-group fadeIn second">
				<div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
				</div>
				<input name="password" type="password" placeholder="請輸入密碼">
            </div>
            
            <div>
                <button id="btn_sign_in" class="btn fadeIn third" type="submit" onclick="javascript:{this.disabled=true}">登入</button>
            </div>
            </form>
            
            <div id="formFooter" class="fadeIn fourth"><hr>
                <div id="clickModal"><a href="#">計畫簡介</a></div>                
                <div>
                    <p>若有任何疑問，歡迎來信：<a href="mailto:***@sinica.edu.tw">***@sinica.edu.tw</a></p>
		    	</div>
                
                <div>無法登入？<a href="./pwReset.php">忘記密碼</a></div>
            </div>
        </div>
        
        <div id="researchIntro" class="modal fade">
        <div class="modal-dialog modal-lg">            
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">計畫簡介</h5>
                    <button class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <p>「高中生點日記」是中央研究院社會學研究所與統計科學研究所的點日記研究團隊所開發，用以紀錄在學期行進之間，高中生於其班級內之人際互動網絡、心情與健康行為等變化。本計畫名稱為「從自我核心網絡到完整網絡：部分及不一致接觸資料的推論設計」，已於 2020 年 2 月通過中央研究院倫理委員會之審查。<br><br>

                    由自我核心網絡至完整網絡的推論，核心精神乃聚焦在獲取獨立之自我網絡數據，從中提取盡可能多的訊息，以此做模擬演算，並從而產生出一組與真實網絡特徵盡可能相近之網絡。這樣的重建過程會受到模型選擇、抽樣估計及網絡結構等變因影響，考量校園班級具備人數少、結構相對穩定且成員聯繫密集等特點，本計畫選擇高中班級作為研究對象。<br><br>
                    
                    有別於過往「關係」導向的探問策略，本計畫從「接觸互動」的面向入手，透過接觸記錄、生活日誌等資料的填報，除了能檢證上述「由自我核心網路推衍班級網絡」的完整度與可行性；更可加上時間維度，在時序性的比較基礎下勘測學生在人際互動過程中，既產生了哪些心情、健康層面的影響，連帶又對自我乃至班級整體的互動網絡帶來什麼樣的動態變化。</p>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>    
</body>
</html>
