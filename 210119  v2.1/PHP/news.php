<?php
	session_start();
    include "db.php";

    if($_SESSION["acc_info"]["id"]==null){
		header("Location: ./index.php");  //0.登入後查看
	}

    //依日記牆上點選的新聞呈現，利用_SESSION做暗碼省去查詢及安全檢查
    if(isset($_POST["CheckNews"])){
        $newsRecord=isset($_SESSION["newsRecord"])?$_SESSION["newsRecord"]:"0"; 
        if($newsRecord=="0"){
            echo "Not Choose Yet";        //1.無效訪問：尚未選擇
        }
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>最新消息</title>
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
    
    <style>
        /* BASIC */
        html{
            min-height: 100%;
            font-family: Microsoft JhengHei; position: relative;
        }
        
        body{
            padding-top: 100px; padding-bottom: 100px;
        }
        
        /* STRUCTURE */
        .nRecord{
            width: 45%;
            display: inline-block; vertical-align: top;
        }
        
        .newsContent{
            width: 85%; margin: 0px auto; 
            font-size: 0.9em; letter-spacing: 0.05em;
        }
        
        /* DETAILED */
        .newsRecord{
            border: 0.1em solid pink;
            -webkit-border-radius: 10px; border-radius: 10px;
        }
        
        #newsQuestion{
            padding: 3% 3% 0% 3%;
            text-align: left;
        }
        
        #newsAnswer{
            padding: 0% 3% 4% 3%;
            font-weight: bold;
        }
        
        #newsBack{
            width: 20vmin; margin: -1em auto;
            font-size: 0.9em; text-align: center;
        }

        /* RESPONSIVE */
		@media screen and (max-width: 550px){            
            .nRecord{
                width: 95%; margin-top: 20px auto;
                font-size: 0.75em;
            }
            
            #newsQuestion{
                line-height: 300%;
            }
            
            #newsTitle, #newsAnswer{
                line-height: 180%;
            }
            
            #newsBack{
                margin: 0em auto;
            }
		}
    </style>

    <script>
		$(document).ready(function(){
            $.ajax({ 
               type: "POST",
               url: "",
               data: {CheckNews: 1},
               success: function(data){
                   console.log("CheckNews", data);
                   if(data=="Not Choose Yet"){
                       $(".check").attr("hidden", true);
                       $.confirm({
                           title: "",
                           content: "你尚未選擇查看項目，請重新操作。",
                           buttons:{
                               "OK": function(){
                                   window.location.href="./main.php";
                               }
                           }
                       })
                   }
                }, error: function(e){
                    console.log(e);
                }     
            })
            
            $("#newsBack").on("click", function(event){
		$("#loading").show();
                event.preventDefault();
			    window.location.href="./main.php";
            })
        })
	</script>
</head>

   
<body>
	<?php include("header.php");?>
    <div id="loading"><img src="pic/ajax-spinner.gif" style="width: 10vmin"/><b>正在載入中 ...</b></div><br>
    
    <div class="check" style="text-align: center">
        <div class="nRecord">
        <div class="newsContent">         
            <div class="newsRecord">
                <div style="font-size: 1.05em">
                    <div id="newsTitle" style="padding: 3%; text-align: right">
                        發佈時間：<b><?=date("Y-m-d", strtotime($_SESSION["newsRecord"]["time"]))?></b>
                    </div> 
                </div>
                    
                <div style="background-color: pink">
                    <div id="newsQuestion">title</div>            
                    <div id="newsAnswer"><?=$_SESSION["newsRecord"]["title"]?></div>
                </div>
                <div>
                    <div id="newsQuestion" style="padding-bottom: 1em">content</div>          
                    <div id="newsAnswer" style="text-align: left"><?=$_SESSION["newsRecord"]["content_l"]?></div>
                </div>
            </div>
            
            <div style="margin: 2vmax auto;"><center>
                <button id="newsBack" class="btn" style="border: 0.1em solid pink">回上一頁</button>
            </center></div>        
        </div>
        </div>
    </div>
    
	<?php include("footer.php");?>
</body>
</html>
