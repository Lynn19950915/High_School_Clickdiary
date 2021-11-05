<?php
	session_start();
    include "db.php";

    if($_SESSION["acc_info"]["id"]==null){
        header("Location: ./index.php");  //0.登入後查看
	}
    $id=$_SESSION["acc_info"]["id"];
    //有效填寫時間:中午12點到隔日凌晨4點
    $hour=date("H");
    if($hour<12){
        $todays=date("Y-m-d", strtotime("-1 day"));
    }else{
        $todays=date("Y-m-d");
    }

    if(isset($_POST["CheckLifeDiary"])){
        $sql1="SELECT * FROM `lifediary` WHERE id= :v1 and date= :v2";
        $stmt=$db->prepare($sql1);
        $stmt->bindParam(":v1", $id);
        $stmt->bindParam(":v2", $today);
		$stmt->execute();                 //1.檢查當天是否填過
		$rs1=$stmt->fetch(PDO::FETCH_ASSOC);
        
        if($stmt->rowCount()==1){
            echo "Already Done LifeDiary";
        }else if($hour>=4 and $hour<12){
            echo "Invalid Time";
        }
        exit();
    }

    if(isset($_POST["A1"])){
        $A1=$_POST["A1"];
        $A2=$_POST["A2"];
        $A3=$_POST["A3"];
        $A4=$_POST["A4"];
        $A5=$_POST["A5"];
        $A6=$_POST["A6"];
        $A7=$_POST["A7"];
        $A8=$_POST["A8"];
        $A9=$_POST["A9"];
        $A10=$_POST["A10"];
        $A11=$_POST["A11"];
        $A12M=$_POST["A12"];  $A12=implode("、", $A12M);
        $A13M=$_POST["A13"];  $A13=implode("、", $A13M);
        
        $A10_1=isset($_POST["A10_1"])?$_POST["A10_1"]:"不適用";
        $A11_1=isset($_POST["A11_1"])?$_POST["A11_1"]:"不適用";
        
        $sql2="INSERT INTO `lifediary`(id, time, date, A1, A2, A3, A4, A5, A6, A7, A8, A9, A10, A10_1, A11, A11_1, A12, A13) VALUES(:v1, CURTIME(), :A0, :A1, :A2, :A3, :A4, :A5, :A6, :A7, :A8, :A9, :A10, :A101, :A11, :A111, :A12, :A13)";
        $stmt=$db->prepare($sql2);
        $stmt->bindParam(":v1", $id);
        $stmt->bindParam(":A0", $todays);
        $stmt->bindParam(":A1", $A1);
        $stmt->bindParam(":A2", $A2);
        $stmt->bindParam(":A3", $A3);
        $stmt->bindParam(":A4", $A4);
        $stmt->bindParam(":A5", $A5);
        $stmt->bindParam(":A6", $A6);
        $stmt->bindParam(":A7", $A7);
        $stmt->bindParam(":A8", $A8);
        $stmt->bindParam(":A9", $A9);
        $stmt->bindParam(":A10", $A10);
        $stmt->bindParam(":A101", $A10_1);
        $stmt->bindParam(":A11", $A11);
        $stmt->bindParam(":A111", $A11_1);
        $stmt->bindParam(":A12", $A12);
        $stmt->bindParam(":A13", $A13);
        $stmt->execute();
        
        echo "Submit Success";
        exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>生活日記</title>
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
        html{
            min-height: 100%;
            font-family: Microsoft JhengHei; position: relative;
        }
        
        body{
            padding-top: 100px; padding-bottom: 100px;
        }
        
        /* STRUCTURE */
        .modal-content{
            width: 70%; margin: 40px auto;
            letter-spacing: 0.05em;
        }
        
        .modal-header{
            background-color: #C4C400;
        }
        
        .modal-body{
            text-align: center;
        }
        
        /* DETAILED */
        #remind{
            margin: 0px auto;
            font-size: 1.2em; letter-spacing: 0.05em; text-align: center;
        }
        
        label{
            width: 18%;
        }
        
        label:hover{
            background-color: #C4C400;
        }
        
        input{
            width: 12%;
        }
    
        #btn_submit{
            width: 40vmin;
            color: #f0f0f0; background-color: #C4C400;
            -webkit-border-radius: 40px; border-radius: 40px;
        }
            
        /* RESPONSIVE */
		@media screen and (max-width: 800px){
            .modal-content{
                width: 80%; margin: 20px auto;
                font-size: 0.8em;
            }
            
            .modal-body{
                text-align: left;
            }
            
            #remind, #btn_submit{
                font-size: 0.8em;
            }
            
            h5{
                font-size: 1.1em;
            }
            
            label{
                width: 90%;
            }
		}       
    </style>
    
    <script>
		$(document).ready(function(){
            //載入頁面即檢查: 當日是否填寫過
            $.ajax({ 
				type: "POST",
				url: "",
                data: {CheckLifeDiary: 1},
                success: function(data){
                    console.log("CheckLifeDiary", data);
                     if(data=="Invalid Time"){
                        $.confirm({
                            title: "",
                            content: "現在並非填寫時間！",
                            buttons:{
                                "OK": function(){
                                    $("#loading").show();
                                    window.location.href="./main.php";
                                }
                            }
                        })
                    }else if(data=="Already Done LifeDiary"){
                        $.confirm({
                            title: "",
                            content: "你已完成今日生活日記，若要修正請利用日記牆的修改功能。",
                            buttons: {
                                "OK": function(){
                                    $("#loading").show();
                                    window.location.href="./main.php";
                                }
                            }
                        })
                    }
				}, error: function(e) {
				    console.log(e);
				}
            })
            
            $(".A10e").on("change", function(event){
                event.preventDefault();
                var cA10=getValue("A10");
                var A101=document.getElementById("A101");
                var itemA10_1=document.getElementsByName("A10_1");
                
                if(cA10=="有"){
                    A101.style.display="block";
                }else{
                    A101.style.display="none";
                    for(var i=0, iLen=itemA10_1.length; i<iLen; i++){
                        itemA10_1[i].checked=false;
                    }
                }
            })   
                
            $(".A11e").on("change", function(event){
                event.preventDefault();
                var cA11=getValue("A11");
                var A111=document.getElementById("A111");
                var itemA11_1=document.getElementsByName("A11_1");
                
                if(cA11=="有"){
                    A111.style.display="block";
                }else{
                    A111.style.display="none";
                    for(var i=0, iLen=itemA11_1.length; i<iLen; i++){
                        itemA11_1[i].checked=false;
                    }
                }
            })    
            
            $(".A12o").on("change", function(event){
                event.preventDefault();
                
                if($(".A12o").prop("checked")==true){
                    var cA12e=document.getElementsByClassName("A12e");
                    for(var i=0, iLen=cA12e.length; i<iLen; i++){
                        cA12e[i].checked=false;
                        cA12e[i].disabled=true;
                    }
                }else{
                    var cA12e=document.getElementsByClassName("A12e");
                    for(var i=0, iLen=cA12e.length; i<iLen; i++){
                        cA12e[i].disabled=false;
                    }
                }
            })
            
            $(".A13o").on("change", function(event){
                event.preventDefault();
                
                if($(".A13o").prop("checked")==true){
                    var cA13e=document.getElementsByClassName("A13e");
                    for(var i=0, iLen=cA13e.length; i<iLen; i++){
                        cA13e[i].checked=false;
                        cA13e[i].disabled=true;
                    }
                }else{
                    var cA13e=document.getElementsByClassName("A13e");
                    for(var i=0, iLen=cA13e.length; i<iLen; i++){
                        cA13e[i].disabled=false;
                    }
                }
            })
            
            $("#btn_submit").on("click", function(event){
                event.preventDefault();
                check();
                
                $.ajax({ 
					type: "POST",
					url: "",
					data: $("form#lifeDiaryForm").serialize(),
                    success: function(data){ 
						console.log("Submit", data);
						if(data=="Submit Success"){
                            $.confirm({
                                title: "",
                                content: "今日生活日記完成填寫！",
                                buttons: {
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
                
                function check(){
                    var cA1     =getValue("A1");
                    var cA2     =getValue("A2");
                    var cA3     =getValue("A3");
                    var cA4     =getValue("A4");
                    var cA5     =getValue("A5");
                    var cA6     =getValue("A6");
                    var cA7     =getValue("A7");
                    var cA8     =getValue("A8");
                    var cA9     =getValue("A9");
                    var cA10    =getValue("A10");
                    var cA10_1  =getValue("A10_1");
                    var cA11    =getValue("A11");
                    var cA11_1  =getValue("A11_1");
                    var cA12M   =getValueM("A12[]");
                    var cA13M   =getValueM("A13[]");
                    
                    var record=[], j=0;
                    if(cA1==0)  {record[j]="1"; j++}
                    if(cA2==0)  {record[j]="2"; j++}
                    if(cA3==0)  {record[j]="3"; j++}
                    if(cA4==0)  {record[j]="4"; j++}
                    if(cA5==0)  {record[j]="5"; j++}
                    if(cA6==0)  {record[j]="6"; j++}
                    if(cA7==0)  {record[j]="7"; j++}
                    if(cA8==0)  {record[j]="8"; j++}
                    if(cA9==0)  {record[j]="9"; j++}
                    if(cA10==0|(cA10=="有"&cA10_1==0))   {record[j]="10"; j++}
                    if(cA11==0|(cA11=="有"&cA11_1==0))   {record[j]="11"; j++}
                    if(cA12M==0){record[j]="12"; j++}
                    if(cA13M==0){record[j]="13"; j++}
                    
                    if(j>0){
                        $("#btn_submit").attr("disabled", false);
                        alert("你好，第"+record+"題尚未填答完畢唷！");
                        return false;
                    }else{
                        return true;
                    }
                }
                
                function getValue(name){
                    var items=document.getElementsByName(name);
                    
                    for(var i=0, iLen=items.length; i<iLen; i++){
                        if(items[i].checked){
                            //return代表結束執行(單選只有一個答案)
                            return items[i].value;
                        }
                    }
                    //所有選項都沒選，才會運行至此
                    return 0;
                }

                function getValueM(name){
                    var items=document.getElementsByName(name);
                    
                    var record=[], j=0;
                    for(var i=0, iLen= items.length; i<iLen; i++){
                        if(items[i].checked){
                            //不return，要跑完迴圈收所有答案(多選不限項數)
                            record[j]=items[i].value;
                            j++; 
                        }
                    }
                    if(j>0){
                        return record;
                    }else{
                        return 0;
                    }
                }                
			})
        })
	</script>
</head>


<body>
	<?php include("header.php");?>
    <div id="loading"><img src="pic/ajax-spinner.gif" style="width: 10vmin"/><b>正在載入中 ...</b></div><br>
    <p id="remind" style="color: red"><b>請注意：此份問卷為匿名填寫，不會收集你的身分資料，你可以安心真實地填答。</b></p>
    
    <form id="lifeDiaryForm" name="lifeDiaryForm">
    <div class="modal-content" style="border: none">
        <h5 style="text-align: right"><b>填答日期：<?=$todays?></b></h5>
    </div>
    
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>1. 整體而言，我覺得今天的心情：</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="radio" name="A1" value="很不好">很不好</label>
            <label><input type="radio" name="A1" value="有點不好">有點不好</label>
            <label><input type="radio" name="A1" value="有點好">有點好</label>
            <label><input type="radio" name="A1" value="很好">很好</label>
        </fieldset>
        </div>
    </div>      
        
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>2. 我今天感受到來自<b style="color: red"><u>家庭</u></b>的壓力：</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="radio" name="A2" value="完全沒有壓力">完全沒有壓力</label>
            <label><input type="radio" name="A2" value="有點壓力">有點壓力</label>
            <label><input type="radio" name="A2" value="很有壓力">很有壓力</label>
        </fieldset>
        </div>
    </div>

    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>3. 我今天感受到來自<b style="color: red"><u>師長</u></b>的壓力：</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="radio" name="A3" value="完全沒有壓力">完全沒有壓力</label>
            <label><input type="radio" name="A3" value="有點壓力">有點壓力</label>
            <label><input type="radio" name="A3" value="很有壓力">很有壓力</label>
        </fieldset>
        </div>
    </div>
        
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>4. 我今天感受到來自<b style="color: red"><u>同學</u></b>的壓力：</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="radio" name="A4" value="完全沒有壓力">完全沒有壓力</label>
            <label><input type="radio" name="A4" value="有點壓力">有點壓力</label>
            <label><input type="radio" name="A4" value="很有壓力">很有壓力</label>
        </fieldset>
        </div>
    </div>
        
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>5. 我今天對人際關係的滿意程度：</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="radio" name="A5" value="很不滿意">很不滿意</label>
            <label><input type="radio" name="A5" value="有點不滿意">有點不滿意</label>
            <label><input type="radio" name="A5" value="有點滿意">有點滿意</label>
            <label><input type="radio" name="A5" value="很滿意">很滿意</label>
        </fieldset>
        </div>
    </div>
    
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>6. 我今天對課業學習：</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="radio" name="A6" value="完全沒有動力">完全沒有動力</label>
            <label><input type="radio" name="A6" value="有點動力">有點動力</label>
            <label><input type="radio" name="A6" value="充滿動力">充滿動力</label>
        </fieldset>
        </div>
    </div>
        
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>7. 我今天的自修時間：</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="radio" name="A7" value="不到 1 小時">不到 1 小時</label>
            <label><input type="radio" name="A7" value="1～3 小時">1～3 小時</label>
            <label><input type="radio" name="A7" value="3～5 小時">3～5 小時</label>
            <label><input type="radio" name="A7" value="大於 5 小時">大於 5 小時</label>
        </fieldset>
        </div>
    </div>
    
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>8. 我今天的課業學習成果：</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="radio" name="A8" value="很不充實">很不充實</label>
            <label><input type="radio" name="A8" value="有點不充實">有點不充實</label>
            <label><input type="radio" name="A8" value="有點充實">有點充實</label>
            <label><input type="radio" name="A8" value="很充實">很充實</label>
        </fieldset>
        </div>
    </div>
        
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>9. 我今天的課業學習效率：</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="radio" name="A9" value="很低">很低</label>
            <label><input type="radio" name="A9" value="有點低">有點低</label>
            <label><input type="radio" name="A9" value="有點高">有點高</label>
            <label><input type="radio" name="A9" value="很高">很高</label>
        </fieldset>
        </div>
    </div>
        
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>10. 我今天有沒有考試：</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="radio" name="A10" class="A10e" value="有">有</label>
            <label><input type="radio" name="A10" class="A10e" value="沒有">沒有</label>
        </fieldset>
        </div>
    </div>
    
    <div class="modal-content" id="A101" style="display: none">
        <div class="modal-header">
            <div class="modal-title"><b>10-1. 今天考試我整體的作答表現：</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="radio" name="A10_1" value="很差">很差</label>
            <label><input type="radio" name="A10_1" value="有點差">有點差</label>
            <label><input type="radio" name="A10_1" value="普通">普通</label>
            <label><input type="radio" name="A10_1" value="有點好">有點好</label>
            <label><input type="radio" name="A10_1" value="很好">很好</label>
        </fieldset>
        </div>
    </div>
        
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>11. 我今天有沒有拿到考試成績：</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="radio" name="A11" class="A11e" value="有">有</label>
            <label><input type="radio" name="A11" class="A11e" value="沒有">沒有</label>
        </fieldset>
        </div>
    </div>
        
    <div class="modal-content" id="A111" style="display: none">
        <div class="modal-header">
            <div class="modal-title"><b>11-1. 今天拿到的整體考試成績，我認為我的表現：</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="radio" name="A11_1" value="很差">很差</label>
            <label><input type="radio" name="A11_1" value="有點差">有點差</label>
            <label><input type="radio" name="A11_1" value="普通">普通</label>
            <label><input type="radio" name="A11_1" value="有點好">有點好</label>
            <label><input type="radio" name="A11_1" value="很好">很好</label>
        </fieldset>
        </div>
    </div>
    
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>12. 我今天感覺到以下身體不適：（可複選）</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="checkbox" name="A12[]" class="A12e" value="發燒">發燒</label>
            <label><input type="checkbox" name="A12[]" class="A12e" value="咳嗽">咳嗽</label>
            <label><input type="checkbox" name="A12[]" class="A12e" value="喉嚨痛">喉嚨痛</label>
            <label><input type="checkbox" name="A12[]" class="A12e" value="流鼻水">流鼻水</label>
            <label><input type="checkbox" name="A12[]" class="A12o" value="無"><b>以上皆無</b></label>
        </fieldset>
        </div>
    </div>
    
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>13. 我今天有以下感受：（可複選）</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="checkbox" name="A13[]" class="A13e" value="坐立不安或感覺緊張">坐立不安或感覺緊張</label>
            <label><input type="checkbox" name="A13[]" class="A13e" value="易怒">易怒</label>
            <label><input type="checkbox" name="A13[]" class="A13e" value="感到憂鬱">感到憂鬱</label>
            <label><input type="checkbox" name="A13[]" class="A13e" value="注意力難以集中">注意力難以集中</label>
            <label><input type="checkbox" name="A13[]" class="A13e" value="難以入睡">難以入睡</label>
            <label><input type="checkbox" name="A13[]" class="A13e" value="睡不安穩">睡不安穩</label>
            <label><input type="checkbox" name="A13[]" class="A13e" value="容易感到疲勞">容易感到疲勞</label>
            <label><input type="checkbox" name="A13[]" class="A13e" value="頭痛">頭痛</label>
            <label><input type="checkbox" name="A13[]" class="A13e" value="肌肉僵硬">肌肉僵硬</label>
            <label><input type="checkbox" name="A13[]" class="A13o" value="無"><b>以上皆無</b></label>
        </fieldset>
        </div>
    </div>
   
    <center>
        <div><button id="btn_submit" class="btn" type="submit" onclick="javascript:{this.disabled=true}">完成</button></div>
    </center>
    </form>
    
	<?php include("footer.php");?>
</body>
</html>
