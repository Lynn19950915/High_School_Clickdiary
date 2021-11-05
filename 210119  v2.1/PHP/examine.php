<?php
    session_start();
    include "db.php";

    if($_SESSION["acc_info"]["id"]==null){
		header("Location: ./index.php");  //0.登入後查看
	}

    //依日記牆上點選的接觸紀錄呈現，利用_SESSION做暗碼省去查詢及安全檢查
    if(isset($_POST["CheckExamine"])){
        $ctRecord=isset($_SESSION["ctRecord"])?$_SESSION["ctRecord"]:"0"; 
        if($ctRecord=="0"){
            echo "Not Choose Yet";        //1.無效訪問：尚未選擇
        }
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>查看接觸紀錄</title>
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
        .contactRecord{
            width: 45%;
            display: inline-block; vertical-align: top;
        }
        
        .ctContent{
            width: 85%; margin: 0px auto; 
            font-size: 0.9em; letter-spacing: 0.05em;
        }
        
        /* DETAILED */
        .ctRecord{
            border: 0.1em solid #C4C400;
            -webkit-border-radius: 10px; border-radius: 10px;
        }
        
        #ctQuestion{
            padding: 2% 3% 0% 3%;
            text-align: left;
        }
        
        #ctAnswer{
            padding: 0% 3% 2% 3%;
            font-weight: bold;
        }
        
        #ctBack, #ctRevise{
            width: 20vmin; margin: -1em auto;
            font-size: 0.9em; text-align: center;
        }

        /* RESPONSIVE */
		@media screen and (max-width: 550px){            
            .contactRecord{
                width: 95%; margin-top: 20px auto;
                font-size: 0.75em;
            }
            
            #ctTitle, #ctQuestion, #ctAnswer{
                line-height: 180%;
            }
            
            #ctQuestion{
                padding: 3% 3% 0% 3%;
            }
        
            #ctAnswer{
                padding: 0% 3% 3% 3%;
            }
            
            #ctBack, #ctRevise{
                margin: 0em auto;
            }
		}
    </style>
    
    <script>
		$(document).ready(function(){
            $.ajax({ 
               type: "POST",
               url: "",
               data: {CheckExamine: 1},
               success: function(data){
                   console.log("CheckExamine", data);
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
            
            $("#ctBack").on("click", function(event){
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
        <div class="contactRecord">
        <div class="ctContent">  
            <div class="ctRecord">
                <div style="font-size: 1.05em">
                    <div id="ctTitle" style="padding: 3% 3% 0% 3%; text-align: right">
                        互動時間：<b><?=$_SESSION["ctRecord"]["A4d"]?> <?=$_SESSION["ctRecord"]["A4"]?>:00</b>
                    </div>
                    <div id="ctTitle" style="padding: 0% 3% 3% 3%; text-align: left">
                        互動對象：<b><?=$_SESSION["ctRecord"]["id"][-2]?><?=$_SESSION["ctRecord"]["id"][-1]?>號 <?=$_SESSION["ctRecord"]["name"]?></b>
                    </div>
                </div>
                    
                <div style="background-color: #C4C400">
                    <div id="ctQuestion">A1. 這次互動最主要的目的或內容：</div>            
                    <div id="ctAnswer"><?=$_SESSION["ctRecord"]["A1"]?></div>
                </div>
                <div>
                    <div id="ctQuestion">A2. 這次互動主要由誰發起：</div>            
                    <div id="ctAnswer"><?=$_SESSION["ctRecord"]["A2"]?></div>
                </div>
                <div style="background-color: #C4C400">
                    <div id="ctQuestion">A3. 這次互動的主要方式：</div>            
                    <div id="ctAnswer"><?=$_SESSION["ctRecord"]["A3"]?></div>
                </div>
                <div>
                    <div id="ctQuestion">A5. 這次互動大概多久：</div>            
                    <div id="ctAnswer"><?=$_SESSION["ctRecord"]["A5"]?></div>
                </div>
                
                <?php if($_SESSION["ctRecord"]["tagged"]=="0"){?>
                <div style="background-color: #C4C400">
                    <div id="ctQuestion">A6. 這次互動，大部分時間我在哪裡：</div>            
                    <div id="ctAnswer"><?=$_SESSION["ctRecord"]["A6"]?></div>
                </div>
                <?php }else{?>
                <div style="background-color: #C4C400">
                    <div id="ctQuestion">A6. 這次互動，大部分時間 <b><?=$_SESSION["ctRecord"]["id"][-2]?><?=$_SESSION["ctRecord"]["id"][-1]?>號<?=$_SESSION["ctRecord"]["name"]?></b> 在哪裡：</div>            
                    <div id="ctAnswer"><?=$_SESSION["ctRecord"]["A6"]?></div>
                </div>
                <?php }?>
                
                <?php if($_SESSION["ctRecord"]["A7"]==""){?>
                <div style="background-color: red; color: white; font-weight: bold">
                    <div id="ctQuestion">A7. 這次互動後，我的心情變化：</div>
                    <div id="ctAnswer">未填寫</div>
                </div>
                <?php }else{?>
                <div>
                    <div id="ctQuestion">A7. 這次互動後，我的心情變化：</div>
                    <div id="ctAnswer"><?=$_SESSION["ctRecord"]["A7"]?></div>
                </div>
                <?php }?>
                
                <?php if($_SESSION["ctRecord"]["A8"]==""){?>
                <div style="background-color: red; color: white; font-weight: bold">
                    <div id="ctQuestion">A8. 這次互動過程中，我覺得我有具體的收穫：</div>
                    <div id="ctAnswer">未填寫</div>
                </div>
                <?php }else{?>
                <div style="background-color: #C4C400">
                    <div id="ctQuestion">A8. 這次互動過程中，我覺得我有具體的收穫：</div>
                    <div id="ctAnswer"><?=$_SESSION["ctRecord"]["A8"]?></div>
                </div>
                <?php }?>
                
                <?php if($_SESSION["ctRecord"]["B1"]==""){?>
                <div style="background-color: red; color: white; font-weight: bold">
                    <div id="ctQuestion">B. 這次互動後，我認為 <b><?=$_SESSION["ctRecord"]["id"][-2]?><?=$_SESSION["ctRecord"]["id"][-1]?>號<?=$_SESSION["ctRecord"]["name"]?></b> 的心情變化：</div>
                    <div id="ctAnswer">未填寫</div>
                </div>
                <?php }else{?>
                <div>
                    <div id="ctQuestion">B. 這次互動後，我認為 <b><?=$_SESSION["ctRecord"]["id"][-2]?><?=$_SESSION["ctRecord"]["id"][-1]?>號<?=$_SESSION["ctRecord"]["name"]?></b> 的心情變化：</div>
                    <div id="ctAnswer"><?=$_SESSION["ctRecord"]["B"]?></div>
                </div>
                <?php }?>
            </div>
            
            <div style="margin: 2vmax auto;"><center>
                <button id="ctBack" class="btn" style="border: 0.1em solid #C4C400">回上一頁</button>
            </center></div>        
        </div>
        </div>
    </div>

	<?php include("footer.php");?>
</body>
</html>
