<?php
	session_start();
    include "db.php";

    if($_SESSION["acc_info"]["id"]==null){
		header("Location: ./index.php");  //0.登入後查看
	}
    $id=$_SESSION["acc_info"]["id"];
    $hour=date("H");
    $today=date("Y-m-d");

    //依日記牆上點選的生活日記呈現，利用_SESSION做暗碼省去查詢及安全檢查
    if(isset($_POST["CheckRevise"])){
        $ldRecord=isset($_SESSION["ldRecord"])?$_SESSION["ldRecord"]:0; 
        if($ldRecord==0){
            echo "Not Choose Yet";        //1.無效訪問：尚未選擇
        }
        exit();
    }

    //各題答案均可能被修改，利用00作為辨識值(類似自訂console data)
    if(isset($_POST["00"])){
        $A1=$_POST["A1"];
        $A2=$_POST["A2"];
        $A3=$_POST["A3"];
        $A4=$_POST["A4"];
        $A5M=$_POST["A5"];  $A5=implode(",", $A5M);
        $A6M=$_POST["A6"];  $A6=implode(",", $A6M);
        $A7=$_POST["A7"];
        $A8=$_POST["A8"];
        $A9=$_POST["A9"];
        $A10=$_POST["A10"];
        $A11=$_POST["A11"];
   
        if($A1!="0"){
            $sql1="UPDATE `lifediary` SET A1= :v1 WHERE id= :v2 and date= :v3";
            $stmt=$db->prepare($sql1);
            $stmt->bindParam(":v1", $A1);
            $stmt->bindParam(":v2", $id);
            $stmt->bindParam(":v3", $today);
            $stmt->execute();
        }
        if($A2!="0"){
            $sql2="UPDATE `lifediary` SET A2= :v1 WHERE id= :v2 and date= :v3";
            $stmt=$db->prepare($sql2);
            $stmt->bindParam(":v1", $A2);
            $stmt->bindParam(":v2", $id);
            $stmt->bindParam(":v3", $today);
            $stmt->execute();
        }
        if($A3!="0"){
            $sql3="UPDATE `lifediary` SET A3= :v1 WHERE id= :v2 and date= :v3";
            $stmt=$db->prepare($sql3);
            $stmt->bindParam(":v1", $A3);
            $stmt->bindParam(":v2", $id);
            $stmt->bindParam(":v3", $today);
            $stmt->execute();
        }
        if($A4!="0"){
            $sql4="UPDATE `lifediary` SET A4= :v1 WHERE id= :v2 and date= :v3";
            $stmt=$db->prepare($sql4);
            $stmt->bindParam(":v1", $A4);
            $stmt->bindParam(":v2", $id);
            $stmt->bindParam(":v3", $today);
            $stmt->execute();
        }
        if($A5!="0"){            
            $sql5="UPDATE `lifediary` SET A5= :v1 WHERE id= :v2 and date= :v3";
            $stmt=$db->prepare($sql5);
            $stmt->bindParam(":v1", $A5);
            $stmt->bindParam(":v2", $id);
            $stmt->bindParam(":v3", $today);
            $stmt->execute();
        }
        if($A6!="0"){
            $sql6="UPDATE `lifediary` SET A6= :v1 WHERE id= :v2 and date= :v3";
            $stmt=$db->prepare($sql6);
            $stmt->bindParam(":v1", $A6);
            $stmt->bindParam(":v2", $id);
            $stmt->bindParam(":v3", $today);
            $stmt->execute();
        }
        if($A7!="0"){
            $sql7="UPDATE `lifediary` SET A7= :v1 WHERE id= :v2 and date= :v3";
            $stmt=$db->prepare($sql7);
            $stmt->bindParam(":v1", $A7);
            $stmt->bindParam(":v2", $id);
            $stmt->bindParam(":v3", $today);
            $stmt->execute();
        }
        if($A8!="0"){
            $sql8="UPDATE `lifediary` SET A8= :v1 WHERE id= :v2 and date= :v3";
            $stmt=$db->prepare($sql8);
            $stmt->bindParam(":v1", $A8);
            $stmt->bindParam(":v2", $id);
            $stmt->bindParam(":v3", $today);
            $stmt->execute();
        }
        if($A9!="0"){
            $sql9="UPDATE `lifediary` SET A9= :v1 WHERE id= :v2 and date= :v3";
            $stmt=$db->prepare($sql9);
            $stmt->bindParam(":v1", $A9);
            $stmt->bindParam(":v2", $id);
            $stmt->bindParam(":v3", $today);
            $stmt->execute();
        }        
        if($A10!="0"){
            $sql10="UPDATE `lifediary` SET A10= :v1 WHERE id= :v2 and date= :v3";
            $stmt=$db->prepare($sql10);
            $stmt->bindParam(":v1", $A10);
            $stmt->bindParam(":v2", $id);
            $stmt->bindParam(":v3", $today);
            $stmt->execute();
        }
        if($A11!="0"){
            $sql11="UPDATE `lifediary` SET A11= :v1 WHERE id= :v2 and date= :v3";
            $stmt=$db->prepare($sql11);
            $stmt->bindParam(":v1", $A11);
            $stmt->bindParam(":v2", $id);
            $stmt->bindParam(":v3", $today);
            $stmt->execute();
        }
        
        echo "Update Success";
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>修改生活日記</title>
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
        .lifeDiary{
            width: 45%;
            display: inline-block; vertical-align: top;
        }
        
        .ldContent{
            width: 85%; margin: 0px auto; 
            font-size: 0.9em; letter-spacing: 0.05em;
        }
        
        /* DETAILED */
        .ldRecord{
            border: 0.1em solid #C4C400;
            -webkit-border-radius: 10px; border-radius: 10px; 
        }
        
        #ldTitle{
            width: 80%; margin-left: 10%;
            display: inline-block; text-align: right;
        }
        
        #ldQuestion{
            padding: 2% 3% 0% 3%;
            text-align: left;
        }
        
        #ldAnswer, #ldChoice{
            width: 80%; padding: 0% 3% 2% 3%; margin-left: 10%;
            display: inline-block; font-weight: bold;
        }
        
        select{
            width: 30%;
        }
        
        label{
            width: 24%;
        }
        
        label:hover{
            background-color: blue;
        }
        
        input{
            width: 12%;
        }
        
        #ldRevise{
            width: 8%; border: 0.1em solid black; margin-right: 1%;
            background-color: black; color: white;
            font-size: 0.85em;
            -webkit-border-radius: 5px; border-radius: 5px;
        }
        
        #ldBack, #ldSubmit{
            width: 20vmin; margin: -1em auto;
            font-size: 0.9em; text-align: center;
        }

        /* RESPONSIVE */
		@media screen and (max-width: 550px){
            .lifeDiary{
                width: 95%; margin-top: 20px auto;
                font-size: 0.75em;
            }
            
            #ldTitle, #ldQuestion, #ldAnswer{
                line-height: 180%;
            }
            
            #ldTitle, #ldAnswer, #ldChoice{
                width: 70%;
            }
            
            #ldQuestion{
                padding: 3% 3% 0% 3%;
            }
        
            #ldAnswer, #ldChoice{
                padding: 0% 3% 3% 3%;
            }
            
            label{
                width: 40%;
                text-align: left;
            }
            
            input{
                width: 8%;
                text-align: left;
            }
            
            #ldRevise{
                width: 12%; margin-right: 0%;
                font-size: 0.7em;
            }
            
            #ldBack{
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
                                   window.location.href="./main.php";
                               }
                           }
                       })
                   }
                }, error: function(e){
                    console.log(e);
                }     
            })
            
            $(".ReviseA1").on("click", function(event){
                event.preventDefault();
			    $(".AA1").attr("hidden", true);
                $(".CA1").attr("hidden", false);
            })
            
            $(".ReviseA2").on("click", function(event){
                event.preventDefault();
			    $(".AA2").attr("hidden", true);
                $(".CA2").attr("hidden", false);
            })
            
            $(".ReviseA3").on("click", function(event){
                event.preventDefault();
			    $(".AA3").attr("hidden", true);
                $(".CA3").attr("hidden", false);
            })
            
            $(".ReviseA4").on("click", function(event){
                event.preventDefault();
			    $(".AA4").attr("hidden", true);
                $(".CA4").attr("hidden", false);
            })
            
            $(".ReviseA5").on("click", function(event){
                event.preventDefault();
			    $(".CA5").attr("hidden", false);
            })
            
            $(".A5o").on("change", function(event){
                event.preventDefault();
                
                if($(".A5o").prop("checked")==true){
                    var cA5e=document.getElementsByClassName("A5e");
                    for(var i=0, iLen=cA5e.length; i<iLen; i++){
                        cA5e[i].checked=false;
                        cA5e[i].disabled=true;
                    }
                }else{
                    var cA5e=document.getElementsByClassName("A5e");
                    for(var i=0, iLen=cA5e.length; i<iLen; i++){
                        cA5e[i].disabled=false;
                    }
                }
            })    
            
            $(".ReviseA6").on("click", function(event){
                event.preventDefault();
			    $(".CA6").attr("hidden", false);
            })
            
            $(".A6o").on("change", function(event){
                event.preventDefault();
                
                if($(".A6o").prop("checked")==true){
                    var cA6e=document.getElementsByClassName("A6e");
                    for(var i=0, iLen=cA6e.length; i<iLen; i++){
                        cA6e[i].checked=false;
                        cA6e[i].disabled=true;
                    }
                }else{
                    var cA6e=document.getElementsByClassName("A6e");
                    for(var i=0, iLen=cA6e.length; i<iLen; i++){
                        cA6e[i].disabled=false;
                    }
                }
            })

            $(".ReviseA7").on("click", function(event){
                event.preventDefault();
			    $(".AA7").attr("hidden", true);
                $(".CA7").attr("hidden", false);
            })
            
            $(".ReviseA8").on("click", function(event){
                event.preventDefault();
			    $(".AA8").attr("hidden", true);
                $(".CA8").attr("hidden", false);
            })
            
            $(".ReviseA9").on("click", function(event){
                event.preventDefault();
			    $(".AA9").attr("hidden", true);
                $(".CA9").attr("hidden", false);
            })
            
            $(".ReviseA10").on("click", function(event){
                event.preventDefault();
			    $(".AA10").attr("hidden", true);
                $(".CA10").attr("hidden", false);
            })
            
            $(".ReviseA11").on("click", function(event){
                event.preventDefault();
			    $(".AA11").attr("hidden", true);
                $(".CA11").attr("hidden", false);
            })
            
            $("#ldBack").on("click", function(event){
                event.preventDefault();
			    window.location.href="./main.php";
            })
            
            $("#ldSubmit").on("click", function(event){
                event.preventDefault();
                
			    $.ajax({ 
                    type: "POST",
                    url: "",
                    data: $("form#reviseRecord").serialize(),
                    success: function(data){
                        console.log("ReviseRecord", data);
                        if(data=="Update Success"){
                            $.confirm({
                                title: "",
                                content: "生活日記修改成功！",
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
            })
        })
	</script>
</head>

    
<body>
	<?php include("header.php");?>
    
    <div class="check" style="text-align: center">
        <div class="lifeDiary">
        <div class="ldContent">        
            <form id="reviseRecord" name="reviseRecord">            
            <input type="hidden" name="00">
            <input type="hidden" name="A5[]" value="0">
            <input type="hidden" name="A6[]" value="0">
            
            <?php foreach($_SESSION["ldRecord"] as $r){?>
            <div class="ldRecord">
                <div style="font-size: 1.05em">
                    <div id="ldTitle" style="padding: 3% 0% 3% 3%; text-align: right">
                        日期：<b><?=$today?></b>
                    </div>
                </div>
                    
                <div style="background-color: #C4C400">
                    <div id="ldQuestion">1. 我今天感受到來自<b><u>家庭</u></b>的壓力：</div>            
                    <div id="ldAnswer" class="AA1"><?=$r["A1"]?></div>
                    <div id="ldChoice" class="CA1" hidden="true">
                        <select class="std" name="A1">
                            <option value="0"></option>  
                            <option value="非常沒有壓力">非常沒有壓力</option>
                            <option value="有點沒有壓力">有點沒有壓力</option>
                            <option value="普通">普通</option>
                            <option value="有點壓力">有點壓力</option>
                            <option value="非常有壓力">非常有壓力</option>
                        </select>
                    </div>
                    <button id="ldRevise" class="ReviseA1">修改</button>
                </div>
                
                <div>
                    <div id="ldQuestion">2. 我今天感受到來自<b><u>師長</u></b>的壓力：</div>            
                    <div id="ldAnswer" class="AA2"><?=$r["A2"]?></div>
                    <div id="ldChoice" class="CA2" hidden="true">
                        <select name="A2">
                            <option value="0"></option>  
                            <option value="非常沒有壓力">非常沒有壓力</option>
                            <option value="有點沒有壓力">有點沒有壓力</option>
                            <option value="普通">普通</option>
                            <option value="有點壓力">有點壓力</option>
                            <option value="非常有壓力">非常有壓力</option>
                        </select>
                    </div>
                    <button id="ldRevise" class="ReviseA2">修改</button>       
                </div>
                
                <div style="background-color: #C4C400">
                    <div id="ldQuestion">3. 我今天感受到來自<b><u>同學</u></b>的壓力：</div>            
                    <div id="ldAnswer" class="AA3"><?=$r["A3"]?></div>
                    <div id="ldChoice" class="CA3" hidden="true">
                        <select name="A3">
                            <option value="0"></option>  
                            <option value="非常沒有壓力">非常沒有壓力</option>
                            <option value="有點沒有壓力">有點沒有壓力</option>
                            <option value="普通">普通</option>
                            <option value="有點壓力">有點壓力</option>
                            <option value="非常有壓力">非常有壓力</option>
                        </select>
                    </div>
                    <button id="ldRevise" class="ReviseA3">修改</button>  
                </div>
                
                <div>
                    <div id="ldQuestion">4. 我今天對人際關係的滿意程度：</div>            
                    <div id="ldAnswer" class="AA4"><?=$r["A4"]?></div>
                    <div id="ldChoice" class="CA4" hidden="true">
                        <select class="std" name="A4">
                            <option value="0"></option>  
                            <option value="很不滿意">很不滿意</option>
                            <option value="有點不滿意">有點不滿意</option>
                            <option value="普通">普通</option>
                            <option value="有點滿意">有點滿意</option>
                            <option value="很滿意">很滿意</option>
                        </select>
                    </div>
                    <button id="ldRevise" class="ReviseA4">修改</button> 
                </div>
                
                <div style="background-color: #C4C400">
                    <div id="ldQuestion">5. 我今天感覺到以下心理不適：<b>(可複選)</b></div>
                    <div id="ldAnswer" class="AA5"><?=$r["A5"]?></div>
                    <button id="ldRevise" class="ReviseA5">修改</button>
                    <div class="CA5" hidden="true">
                        <fieldset data-role="controlgroup" data-type="horizontal">
                            <label><input type="checkbox" name="A5[]" class="A5e" value="坐立不安或感覺緊張">坐立不安或感覺緊張</label>
                            <label><input type="checkbox" name="A5[]" class="A5e" value="易怒">易怒</label>
                            <label><input type="checkbox" name="A5[]" class="A5e" value="感到憂鬱">感到憂鬱</label>
                            <label><input type="checkbox" name="A5[]" class="A5e" value="注意力難以集中">注意力難以集中</label>
                            <label><input type="checkbox" name="A5[]" class="A5e" value="難以入睡">難以入睡</label>
                            <label><input type="checkbox" name="A5[]" class="A5e" value="睡不安穩">睡不安穩</label>
                            <label><input type="checkbox" name="A5[]" class="A5e" value="容易感到疲勞">容易感到疲勞</label>
                            <label><input type="checkbox" name="A5[]" class="A5e" value="頭痛">頭痛</label>
                            <label><input type="checkbox" name="A5[]" class="A5e" value="肌肉僵硬">肌肉僵硬</label>
                            <label><input type="checkbox" name="A5[]" class="A5o" value="以上皆無"><b>以上皆無</b></label>
                        </fieldset>
                    </div> 
                </div>
                
                <div>
                    <div id="ldQuestion">6. 我今天感覺到以下身體不適：<b>(可複選)</b></div>            
                    <div id="ldAnswer" class="AA6"><?=$r["A6"]?></div>
                    <button id="ldRevise" class="ReviseA6">修改</button>
                    <div class="CA6" hidden="true">
                        <fieldset data-role="controlgroup" data-type="horizontal">
                            <label><input type="checkbox" name="A6[]" class="A6e" value="發燒">發燒</label>
                            <label><input type="checkbox" name="A6[]" class="A6e" value="咳嗽">咳嗽</label>
                            <label><input type="checkbox" name="A6[]" class="A6e" value="喉嚨痛">喉嚨痛</label>
                            <label><input type="checkbox" name="A6[]" class="A6e" value="流鼻水">流鼻水</label>
                            <label><input type="checkbox" name="A6[]" class="A6o" value="以上皆無"><b>以上皆無</b></label>
                        </fieldset>
                    </div> 
                </div>
                
                <div style="background-color: #C4C400">
                    <div id="ldQuestion">7. 我今天對學習：</div>            
                    <div id="ldAnswer" class="AA7"><?=$r["A7"]?></div>
                    <div id="ldChoice" class="CA7" hidden="true">
                        <select class="std" name="A7">
                            <option value="0"></option>  
                            <option value="完全沒有熱忱">完全沒有熱忱</option>
                            <option value="有點沒有熱忱">有點沒有熱忱</option>
                            <option value="不低也不高">不低也不高</option>
                            <option value="有點熱忱">有點熱忱</option>
                            <option value="充滿熱忱">充滿熱忱</option>
                        </select>
                    </div>
                    <button id="ldRevise" class="ReviseA7">修改</button>                     
                </div>
                
                <div>
                    <div id="ldQuestion">8. 我今天的自修時間：</div>            
                    <div id="ldAnswer" class="AA8"><?=$r["A8"]?></div>
                    <div id="ldChoice" class="CA8" hidden="true">
                        <select class="std" name="A8">
                            <option value="0"></option>  
                            <option value="不到 1 小時">不到 1 小時</option>
                            <option value="1～3 小時">1～3 小時</option>
                            <option value="3～5 小時">3～5 小時</option>
                            <option value="大於 5 小時">大於 5 小時</option>
                        </select>
                    </div>
                    <button id="ldRevise" class="ReviseA8">修改</button>                     
                </div>
                
                <div style="background-color: #C4C400">
                    <div id="ldQuestion">9. 我今天的學習成果：</div>            
                    <div id="ldAnswer" class="AA9"><?=$r["A9"]?></div>
                    <div id="ldChoice" class="CA9" hidden="true">
                        <select class="std" name="A9">
                            <option value="0"></option>  
                            <option value="很不充實">很不充實</option>
                            <option value="有點不充實">有點不充實</option>
                            <option value="不低也不高">不低也不高</option>
                            <option value="有點充實">有點充實</option>
                            <option value="很充實">很充實</option>
                        </select>
                    </div>
                    <button id="ldRevise" class="ReviseA9">修改</button>                     
                </div>
                
                <div>
                    <div id="ldQuestion">10. 我今天的學習效率：</div>            
                    <div id="ldAnswer" class="AA10"><?=$r["A10"]?></div>
                    <div id="ldChoice" class="CA10" hidden="true">
                        <select class="std" name="A10">
                            <option value="0"></option>  
                            <option value="很低">很低</option>
                            <option value="有點低">有點低</option>
                            <option value="不低也不高">不低也不高</option>
                            <option value="有點高">有點高</option>
                            <option value="很高">很高</option>
                        </select>
                    </div>
                    <button id="ldRevise" class="ReviseA10">修改</button>                     
                </div>
                
                <div style="background-color: #C4C400">
                    <div id="ldQuestion">11. 整體而言，我覺得今天的心情：</div>            
                    <div id="ldAnswer" class="AA11"><?=$r["A11"]?></div>
                    <div id="ldChoice" class="CA11" hidden="true">
                        <select class="std" name="A11">
                            <option value="0"></option>  
                            <option value="很不好">很不好</option>
                            <option value="有點不好">有點不好</option>
                            <option value="普通">普通</option>
                            <option value="有點好">有點好</option>
                            <option value="很好">很好</option>
                        </select>
                    </div>
                    <button id="ldRevise" class="ReviseA11">修改</button>                     
                </div>
            </div>            
            <?php }?>
            
            <div style="margin: 2vmax auto;"><center>
                <button id="ldBack" class="btn" style="border: 0.1em solid #C4C400">回上一頁</button>
                <button id="ldSubmit" class="btn" style="background-color: #C4C400">完成</button>
            </center></div>
            </form>  
        </div>
        </div>
    </div>
    
	<?php include("footer.php");?>
</body>
</html>
