<?php
	session_start();
    include "db.php";

    if($_SESSION["acc_info"]["id"]==null){
		header("Location: ./index.php");  //0.登入後查看
	}
    $hour=date("H");

    //依日記牆上點選的接觸紀錄呈現，利用_SESSION做暗碼省去查詢及安全檢查
    if(isset($_POST["CheckRevise"])){
        $ctRecord=isset($_SESSION["ctRecord"])?$_SESSION["ctRecord"]:0; 
        if($ctRecord==0){
            echo "Not Choose Yet";        //1.無效訪問：尚未選擇
        }
        exit();
    }

    //各題答案均可能被修改，利用00作為辨識值(類似自訂console data)
    if(isset($_POST["00"])){
        $A1=$_POST["A1"];
        $A2=$_POST["A2"];
        $A3=$_POST["A3"];
        $A4d=$_POST['A4d'];
        $A4=$_POST["A4"];
        $A5=$_POST["A5"];
        $A6=$_POST["A6"];
        $A7=$_POST["A7"];
        $A8=$_POST["A8"];
        $B=$_POST["B"];
   
        if($A1!="0"){
            $sql1="UPDATE `record` SET A1= :v1 WHERE recordId= :v2";
            $stmt=$db->prepare($sql1);
            $stmt->bindParam(":v1", $A1);
            $stmt->bindParam(":v2", $_SESSION["ctRecord"]["recordId"]);
            $stmt->execute();
        }
        if($A2!="0"){
            $sql2="UPDATE `record` SET A2= :v1 WHERE recordId= :v2";
            $stmt=$db->prepare($sql2);
            $stmt->bindParam(":v1", $A2);
            $stmt->bindParam(":v2", $_SESSION["ctRecord"]["recordId"]);
            $stmt->execute();
        }
        if($A3!="0"){
            $sql3="UPDATE `record` SET A3= :v1 WHERE recordId= :v2";
            $stmt=$db->prepare($sql3);
            $stmt->bindParam(":v1", $A3);
            $stmt->bindParam(":v2", $_SESSION["ctRecord"]["recordId"]);
            $stmt->execute();
        }
        if($A4!=""){
            if($A4>23 or $A4<0 or floor($A4)-$A4!=0){
                echo "Wrong A4";
                exit();
            }else if($A4d==date("Y-m-d") and $A4>$hour){
                echo "Late A4";
                exit();
            }else{
                $sql4="UPDATE `record` SET A4d= :v1, A4= :v2 WHERE recordId= :v3";
                $stmt=$db->prepare($sql4);
                $stmt->bindParam(":v1", $A4d);
                $stmt->bindParam(":v2", $A4);
                $stmt->bindParam(":v3", $_SESSION["ctRecord"]["recordId"]);
                $stmt->execute();
            }
        }
        if($A5!="0"){
            $sql5="UPDATE `record` SET A5= :v1 WHERE recordId= :v2";
            $stmt=$db->prepare($sql5);
            $stmt->bindParam(":v1", $A5);
            $stmt->bindParam(":v2", $_SESSION["ctRecord"]["recordId"]);
            $stmt->execute();
        }
        if($A6!="0"){
            $sql6="UPDATE `record` SET A6= :v1 WHERE recordId= :v2";
            $stmt=$db->prepare($sql6);
            $stmt->bindParam(":v1", $A6);
            $stmt->bindParam(":v2", $_SESSION["ctRecord"]["recordId"]);
            $stmt->execute();
        }
        if($A7!="0"){
            $sql7="UPDATE `record` SET A7= :v1 WHERE recordId= :v2";
            $stmt=$db->prepare($sql7);
            $stmt->bindParam(":v1", $A7);
            $stmt->bindParam(":v2", $_SESSION["ctRecord"]["recordId"]);
            $stmt->execute();
        }
        if($A8!="0"){
            $sql8="UPDATE `record` SET A8= :v1 WHERE recordId= :v2";
            $stmt=$db->prepare($sql8);
            $stmt->bindParam(":v1", $A8);
            $stmt->bindParam(":v2", $_SESSION["ctRecord"]["recordId"]);
            $stmt->execute();
        }
        if($B!="0"){
            $sql9="UPDATE `record` SET B= :v1 WHERE recordId= :v2";
            $stmt=$db->prepare($sql9);
            $stmt->bindParam(":v1", $B);
            $stmt->bindParam(":v2", $_SESSION["ctRecord"]["recordId"]);
            $stmt->execute();
        }
        
        echo "Update Success";
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>修改接觸紀錄</title>
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
        
        #ctTitle{
            width: 80%; margin-left: 10%;
            display: inline-block; text-align: right;
        }
        
        #ctInput{
            width: 10%; margin-left: 1%;
            display: inline-block; text-align: right;
        }
        
        #ctQuestion{
            padding: 2% 3% 0% 3%;
            text-align: left;
        }
        
        #ctAnswer, #ctChoice{
            width: 80%; padding: 0% 3% 2% 3%; margin-left: 10%;
            display: inline-block; font-weight: bold;
        }
        
        select{
            width: 30%;
        }
        
        .ctRevise{
            width: 8%; border: 0.1em solid black; margin-right: 1%;
            background-color: black; color: white;
            font-size: 0.85em;
            -webkit-border-radius: 5px; border-radius: 5px;
        }
        
        #ctBack, #ctSubmit{
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
            
            #ctTitle, #ctAnswer, #ctChoice{
                width: 70%;
            }
            
            #ctQuestion{
                padding: 3% 3% 0% 3%;
            }
        
            #ctAnswer, #ctChoice{
                padding: 0% 3% 3% 3%;
            }
            
            select{
                width: 40%;
            }
            
            .ctRevise{
                width: 12%; margin-right: 0%;
                font-size: 0.7em;
            }
            
            #ctBack{
                margin: 0em auto;
            }
		}
    </style>
    
    <script>
		$(document).ready(function(){
            $.ajax({ 
               type: "POST",
               url: "",
               data: {CheckRevise: 1},
               success: function(data){
                   console.log("CheckRevise", data);
                   if(data=="Not Choose Yet"){
                       $(".check").attr("hidden", true);
                       $.confirm({
                           title: "",
                           content: "你尚未選擇修改項目，請重新操作。",
                           buttons:{
                               "OK": function(){
                                   $("#loading").show();
                                   window.location.href="./main.php";
                               }
                           }
                       })
                   }
                }, error: function(e){
                    console.log(e);
                }     
            })
            
            $("#ReviseA1").on("click", function(event){
                event.preventDefault();
                $(".AA1").attr("hidden", true);
                $(".CA1").attr("hidden", false);
            })
            
            $("#ReviseA2").on("click", function(event){
                event.preventDefault();
                $(".AA2").attr("hidden", true);
                $(".CA2").attr("hidden", false);
            })
            
            $("#ReviseA3").on("click", function(event){
                event.preventDefault();
                $(".AA3").attr("hidden", true);
                $(".CA3").attr("hidden", false);
            })
            
            $("#ReviseA4").on("click", function(event){
                event.preventDefault();
                $(".AA4d").attr("hidden", true);
                $(".CA4d").attr("hidden", false);             
                $(".AA4").attr("hidden", true);
                $(".CA4").attr("hidden", false);
            })
            
            $("#ReviseA5").on("click", function(event){
                event.preventDefault();
                $(".AA5").attr("hidden", true);
                $(".CA5").attr("hidden", false);
            })
            
            $("#ReviseA6").on("click", function(event){
                event.preventDefault();
                $(".AA6").attr("hidden", true);
                $(".CA6").attr("hidden", false);
            })
            
            $("#ReviseA7").on("click", function(event){
                event.preventDefault();
                $(".AA7").attr("hidden", true);
                $(".CA7").attr("hidden", false);
            })
            
            $("#ReviseA8").on("click", function(event){
                event.preventDefault();
                $(".AA8").attr("hidden", true);
                $(".CA8").attr("hidden", false);
            })
            
            $("#ReviseB").on("click", function(event){
                event.preventDefault();
                $(".AB").attr("hidden", true);
                $(".CB").attr("hidden", false);
            })

            $("#ctBack").on("click", function(event){
                $("#loading").show();
                event.preventDefault();
                window.location.href="./main.php";
            })
            
            $("#ctSubmit").on("click", function(event){
                event.preventDefault();
                
			    $.ajax({ 
                    type: "POST",
                    url: "",
                    data: $("form#reviseRecord").serialize(),
                    success: function(data){
                        console.log("ReviseRecord", data);
                        if(data=="Wrong A4"){
                            $("#ctSubmit").attr("disabled", false);
                            $.alert({
                                title: "",
                                content: "無效答覆：請輸入合理的整數。"
                            })
                        }else if(data=="Late A4"){
                            $("#ctSubmit").attr("disabled", false);
                            $.alert({
                                title: "",
                                content: "無效答覆：請不要填寫還沒到的時間。"
                            })
                        }else if(data=="Update Success"){
                            $.confirm({
                                title: "",
                                content: "接觸資料修改成功！",
                                buttons:{
                                    "OK": function(){
                                        $("#loading").show();
                                        window.location.href="./main.php";
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
	<?php include("header.php");?>
    <div id="loading"><img src="pic/ajax-spinner.gif" style="width: 10vmin"/><b>正在載入中 ...</b></div><br>
    
    <div class="check" style="text-align: center">
        <div class="contactRecord">
        <div class="ctContent">       
            <form id="reviseRecord" name="reviseRecord">
            <input type="hidden" name="00">
            
            <div class="ctRecord">
                <div style="font-size: 1.05em">
                    <div id="ctTitle" style="padding: 3% 3% 0% 3%; text-align: right">                    
                        互動時間：<div class="AA4d" style="display: inline"><b><?=$_SESSION["ctRecord"]["A4d"]?></b></div>
                        <div id="ctChoice" class="CA4d" style="display: inline" hidden="true">
                            <select class="std" name="A4d">
                                <option value="<?=date("Y-m-d")?>"><?=date("Y-m-d")?></option>
                                <option value="<?=date("Y-m-d", strtotime("-1 day"))?>"><?=date("Y-m-d", strtotime("-1 day"))?></option>   
                            </select>
                        </div>
                        <div class="AA4" style="width: 10%; display: inline-block"><b><?=$_SESSION["ctRecord"]["A4"]?></b></div>
                        <div id="ctInput" class="CA4" hidden="true">
                        <input style="text-align: center" name="A4" class="CA4" type="number" min="0" max="23">
                        </div><b>:00</b>
                    </div>                    
                    <button id="ReviseA4" class="ctRevise">修改</button>
                    <div style="padding: 0% 3% 3% 3%; text-align: left">
                        互動對象：<b><?=$_SESSION["ctRecord"]["id"][-2]?><?=$_SESSION["ctRecord"]["id"][-1]?>號 <?=$_SESSION["ctRecord"]["name"]?></b>
                    </div>
                </div>
                
                <div style="background-color: #C4C400">
                    <div id="ctQuestion">A1. 這次互動最主要的目的或內容：</div>            
                    <div id="ctAnswer" class="AA1"><?=$_SESSION["ctRecord"]["A1"]?></div>
                    <div id="ctChoice" class="CA1" hidden="true">
                        <select class="std" name="A1">
                            <option value="0"></option>  
                            <option value="課業">課業</option>
                            <option value="社交聊天">社交聊天</option>
                            <option value="運動">運動</option>
                            <option value="休閒育樂">休閒育樂</option>
                            <option value="其他">其他</option>
                        </select>
                    </div>
                    <button id="ReviseA1" class="ctRevise">修改</button>
                </div>
                
                <div>
                    <div id="ctQuestion">A2. 這次互動主要由誰發起：</div>
                    <div id="ctAnswer" class="AA2"><?=$_SESSION["ctRecord"]["A2"]?></div>
                    <div id="ctChoice" class="CA2" hidden="true">
                        <select name="A2">
                            <option value="0"></option>  
                            <option value="<?=$rs['name']?>">自己</option>
                            <option value="互動對象">互動對象</option>
                            <option value="共同約定">共同約定</option>
                            <option value="偶然相遇">偶然相遇</option>
                            <option value="互動對象以外的其他人">互動對象以外的其他人</option>
                        </select>
                    </div>
                    <button id="ReviseA2" class="ctRevise">修改</button>       
                </div>
                
                <div style="background-color: #C4C400">
                    <div id="ctQuestion">A3. 這次互動的主要方式：</div>            
                    <div id="ctAnswer" class="AA3"><?=$_SESSION["ctRecord"]["A3"]?></div>
                    <div id="ctChoice" class="CA3" hidden="true">
                        <select name="A3">
                            <option value="0"></option>  
                            <option value="見面">見面</option>
                            <option value="即時語音通話">即時語音通話</option>
                            <option value="文字或錄音">文字或錄音</option>
                            <option value="視訊">視訊</option>   
                        </select>
                    </div>
                    <button id="ReviseA3" class="ctRevise">修改</button>  
                </div>
                
                <div>
                    <div id="ctQuestion">A5. 這次互動大概多久：</div>            
                    <div id="ctAnswer" class="AA5"><?=$_SESSION["ctRecord"]["A5"]?></div>
                    <div id="ctChoice" class="CA5" hidden="true">
                        <select class="std" name="A5">
                            <option value="0"></option>  
                            <option value="少於一分鐘">少於一分鐘</option>
                            <option value="1-4 分鐘">1-4 分鐘</option>
                            <option value="5-14 分鐘">5-14 分鐘</option>
                            <option value="15-59 分鐘">15-59 分鐘</option>
                            <option value="1-4 小時">1-4 小時</option>
                            <option value="大於 4 小時">大於 4 小時</option>
                        </select>
                    </div>
                    <button id="ReviseA5" class="ctRevise">修改</button> 
                </div>
                
                <?php if($_SESSION["ctRecord"]["tagged"]=="0"){?>
                <div style="background-color: #C4C400">
                    <div id="ctQuestion">A6. 這次互動，大部分時間我在哪裡：</div>            
                    <div id="ctAnswer" class="AA6"><?=$_SESSION["ctRecord"]["A6"]?></div>
                    <div id="ctChoice" class="CA6" hidden="true">
                        <select class="std" name="A6">
                            <option value="0"></option>  
                            <option value="校內">校內</option>
                            <option value="<?=$rs['name']?>的住處／家裡">自己住處／家裡</option>
                            <option value="對方住處／家裡">對方住處／家裡</option>
                            <option value="交通工具">交通工具</option>
                            <option value="補習班">補習班</option>
                            <option value="校外餐廳">校外餐廳</option>
                            <option value="校外圖書館">校外圖書館</option>
                            <option value="校外娛樂場所">校外娛樂場所</option>
                            <option value="其他">其他</option>
                        </select>
                    </div>
                    <button id="ReviseA6" class="ctRevise">修改</button>                     
                </div>
                <?php }else{?>
                <div style="background-color: #C4C400">
                    <div id="ctQuestion">A6. 這次互動，大部分時間 <?=$_SESSION["ctRecord"]["id"][-2]?><?=$_SESSION["ctRecord"]["id"][-1]?>號<?=$_SESSION["ctRecord"]["name"]?> 在哪裡：</div>            
                    <div id="ctAnswer" class="AA6"><?=$_SESSION["ctRecord"]["A6"]?></div>
                    <div id="ctChoice" class="CA6" hidden="true">
                        <select class="std" name="A6">
                            <option value="0"></option>  
                            <option value="校內">校內</option>
                            <option value="<?=$rs['name']?>的住處／家裡">自己住處／家裡</option>
                            <option value="對方住處／家裡">對方住處／家裡</option>
                            <option value="交通工具">交通工具</option>
                            <option value="補習班">補習班</option>
                            <option value="校外餐廳">校外餐廳</option>
                            <option value="校外圖書館">校外圖書館</option>
                            <option value="校外娛樂場所">校外娛樂場所</option>
                            <option value="其他">其他</option>
                        </select>
                    </div>
                    <button id="ReviseA6" class="ctRevise">修改</button>                    
                </div>
                <?php }?>
                
                <?php if($_SESSION["ctRecord"]["A7"]==""){?>
                <div style="background-color: red; color: white; font-weight: bold">
                    <div id="ctQuestion">A7. 這次互動後，我的心情變化：</div>
                    <div id="ctAnswer" class="AA7">未填寫</div>
                    <div id="ctChoice" class="CA7" hidden="true">
                        <select class="std" name="A7">
                            <option value="0"></option>  
                            <option value="變得很差">變得很差</option>
                            <option value="變得有點差">變得有點差</option>
                            <option value="沒有改變">沒有改變</option>
                            <option value="變得有點好">變得有點好</option>
                            <option value="變得很好">變得很好</option>
                        </select>
                    </div>
                    <button id="ReviseA7" class="ctRevise">修改</button>
                </div>
                <?php }else{?>
                <div>
                    <div id="ctQuestion">A7. 這次互動後，我的心情變化：</div>
                    <div id="ctAnswer" class="AA7"><?=$_SESSION["ctRecord"]["A7"]?></div>
                    <div id="ctChoice" class="CA7" hidden="true">
                        <select class="std" name="A7">
                            <option value="0"></option>  
                            <option value="變得很差">變得很差</option>
                            <option value="變得有點差">變得有點差</option>
                            <option value="沒有改變">沒有改變</option>
                            <option value="變得有點好">變得有點好</option>
                            <option value="變得很好">變得很好</option>
                        </select>
                    </div>
                    <button id="ReviseA7" class="ctRevise">修改</button>
                </div>
                <?php }?>
                
                <?php if($_SESSION["ctRecord"]["A8"]==""){?>
                <div style="background-color: red; color: white; font-weight: bold">
                    <div id="ctQuestion">A8. 這次互動過程中，我覺得我有具體的收穫：</div>
                    <div id="ctAnswer" class="AA8">未填寫</div>
                    <div id="ctChoice" class="CA8" hidden="true">
                        <select class="std" name="A8">
                            <option value="0"></option>  
                            <option value="有損失">有損失</option>
                            <option value="幾乎沒有收穫">幾乎沒有收穫</option>
                            <option value="有一點收穫">有一點收穫</option>
                            <option value="有很大收穫">有很大收穫</option>
                        </select>
                    </div>
                    <button id="ReviseA8" class="ctRevise">修改</button>
                </div>
                <?php }else{?>
                <div style="background-color: #C4C400">
                    <div id="ctQuestion">A8. 這次互動過程中，我覺得我有具體的收穫：</div>
                    <div id="ctAnswer" class="AA8"><?=$_SESSION["ctRecord"]["A8"]?></div>
                    <div id="ctChoice" class="CA8" hidden="true">
                        <select class="std" name="A8">
                            <option value="0"></option>  
                            <option value="有損失">有損失</option>
                            <option value="幾乎沒有收穫">幾乎沒有收穫</option>
                            <option value="有一點收穫">有一點收穫</option>
                            <option value="有很大收穫">有很大收穫</option>
                        </select>
                    </div>
                    <button id="ReviseA8" class="ctRevise">修改</button>
                </div>
                <?php }?>
                
                <?php if($_SESSION["ctRecord"]["B"]==""){?>
                <div style="background-color: red; color: white; font-weight: bold; -webkit-border-radius: 0 0 10px 10px; border-radius: 0 0 10px 10px;">
                    <div id="ctQuestion">B. 這次互動後，我認為 <?=$_SESSION["ctRecord"]["id"][-2]?><?=$_SESSION["ctRecord"]["id"][-1]?>號<?=$_SESSION["ctRecord"]["name"]?> 的心情變化：</div>
                    <div id="ctAnswer" class="AB">未填寫</div>
                    <div id="ctChoice" class="CB" hidden="true">
                        <select class="std" name="B">
                            <option value="0"></option>  
                            <option value="變得很差">變得很差</option>
                            <option value="變得有點差">變得有點差</option>
                            <option value="沒有改變">沒有改變</option>
                            <option value="變得有點好">變得有點好</option>
                            <option value="變得很好">變得很好</option>
                            <option value="我不知道">我不知道</option>
                        </select>
                    </div>
                    <button id="ReviseB" class="ctRevise">修改</button> 
                </div>
                <?php }else{?>
                <div>
                    <div id="ctQuestion">B. 這次互動後，我認為 <?=$_SESSION["ctRecord"]["id"][-2]?><?=$_SESSION["ctRecord"]["id"][-1]?>號<?=$_SESSION["ctRecord"]["name"]?> 的心情變化：</div>
                    <div id="ctAnswer" class="AB"><?=$_SESSION["ctRecord"]["B"]?></div>
                    <div id="ctChoice" class="CB" hidden="true">
                        <select class="std" name="B">
                            <option value="0"></option>
                            <option value="變得很差">變得很差</option>
                            <option value="變得有點差">變得有點差</option>
                            <option value="沒有改變">沒有改變</option>
                            <option value="變得有點好">變得有點好</option>
                            <option value="變得很好">變得很好</option>
                            <option value="我不知道">我不知道</option>
                        </select>
                    </div>
                    <button id="ReviseB" class="ctRevise">修改</button>
                </div>
                <?php }?>
            </div>
            
            <div style="margin: 2vmax auto;"><center>
                <button id="ctBack" class="btn" style="border: 0.1em solid #C4C400">回上一頁</button>
                <button id="ctSubmit" class="btn" style="background-color: #C4C400" onclick="javascript:{this.disabled=true}">完成</button>
            </center></div>
            </form>
        </div>
        </div>
    </div>
    
	<?php include("footer.php");?>
</body>
</html>
