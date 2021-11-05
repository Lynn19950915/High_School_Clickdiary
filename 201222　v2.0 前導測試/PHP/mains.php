<?php
	session_start();
    include "db.php";

    if($_SESSION["acc_info"]["id"]==null){
        header("Location: ./index.php");  //0.登入後查看
	}
    $rs=$_SESSION["acc_info"];
    $id=$_SESSION["acc_info"]["id"];
    $hour=date("H");
    $today=date("Y-m-d");

    if(isset($_POST["CheckMain"])){
        if(!isset($_SESSION["cdate"])){
            echo "Invalid Access";        //0.無效訪問：尚未選擇       
        }
        exit();
    }

    $sql1="SELECT *, name FROM `record` LEFT JOIN `account` ON record.A0=account.id WHERE record.id= :v1 and A4d= :v2";
    $stmt=$db->prepare($sql1);
    $stmt->bindParam(":v1", $id);
    $stmt->bindParam(":v2", $_SESSION["cdate"]);
    $stmt->execute();                     //1.接觸紀錄一覽(本頁不顯示，作為查看或修改用)
    $rs1=$stmt->fetchAll(PDO::FETCH_ASSOC);

    //接觸紀錄區當成一張表單，按鈕攜帶recordId並具備送出功能
    if(isset($_POST["11"])){
        $i=0;
        $j=0;
        $k=array();
        while($i<count($rs1)){
            array_push($k, $rs1[$i]["recordId"]);
            $i++;
        }
        
        while($j<count($k)){
            $ctRecord=isset($_POST["$k[$j]"])?$_POST["$k[$j]"]:"0";
            
            if($ctRecord=="0"){
                $j++;
            }else{
                //選中的_POST不會為0，這時要取它的input.name(埋recordId)而不是_POST
                $sql2="SELECT *, name FROM `record` LEFT JOIN `account` ON record.A0=account.id WHERE recordId= :v1";
                $stmt=$db->prepare($sql2);
                $stmt->bindParam(":v1", $k[$j]);
                $stmt->execute();         //2.欲查看/修改之接觸紀錄
                $rs2=$stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION["ctRecord"]=$rs2;
            
                $j++; 
            }
        }
        echo "Contact Selection Success";
        exit();
    }

    //每次篩選日期即覆蓋新的_SESSION，故要檢查表單的$cdate而非記憶的_SESSION
    if(isset($_POST["cdate"])){
        $cdate=$_POST["cdate"];
        $_SESSION["cdate"]=$cdate;
        
        if($cdate==""){
            echo "Nothing Enter";
        }else{     
            $sql3="SELECT * FROM `lifediary` WHERE id= :v1 and date= :v2";
            $stmt=$db->prepare($sql3);
            $stmt->bindParam(":v1", $id);
            $stmt->bindParam(":v2", $cdate);
            $stmt->execute();             //3.篩選生活日記
            $rs3=$stmt->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION["ldCdate"]=$rs3;
            
            $sql4="SELECT *, name FROM `record` LEFT JOIN `account` ON record.A0=account.id WHERE record.id= :v1 and (A7 IS NULL or A8 IS NULL or A9 IS NULL or B1 IS NULL or B2 IS NULL) and A4d= :v2 ORDER BY A4 desc";
            $stmt=$db->prepare($sql4);
            $stmt->bindParam(":v1", $id);
            $stmt->bindParam(":v2", $cdate);
            $stmt->execute();             //4.篩選日不完整的接觸紀錄(置頂)
            $rs4=$stmt->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION["crCdate1"]=$rs4;
            
            $sql5="SELECT *, name FROM `record` LEFT JOIN `account` ON record.A0=account.id WHERE record.id= :v1 and (A7 IS NOT NULL and A8 IS NOT NULL and A9 IS NOT NULL and B1 IS NOT NULL and B2 IS NOT NULL) and A4d= :v2 ORDER BY A4 desc";
            $stmt=$db->prepare($sql5);
            $stmt->bindParam(":v1", $id);
            $stmt->bindParam(":v2", $cdate);
            $stmt->execute();             //5.篩選日完整的接觸紀錄
            $rs5=$stmt->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION["crCdate2"]=$rs5;
            
            $sql6="SELECT COUNT(*) FROM `record` WHERE id= :v1 and A4d= :v2 and A7 IS NOT NULL and A8 IS NOT NULL and A9 IS NOT NULL and B1 IS NOT NULL and B2 IS NOT NULL";
            $stmt=$db->prepare($sql6);
            $stmt->bindParam(":v1", $id);
            $stmt->bindParam(":v2", $cdate);
            $stmt->execute();             //6.篩選日完整接觸筆數
            $rs6=$stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION["dtValid"]=$rs6;
                    
            echo "Select Success";
        }
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>日記牆</title>
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
        .lifeDiary, .calendar{
            width: 20%; height: 65vmin; padding: 1%;
            background-color: #FFFD9F;
            display: inline-block; vertical-align: top;
            -webkit-border-radius: 5px; border-radius: 5px;
        }
        
        .contactRecord{
            width: 45%; padding: 0.95%;
            display: inline-block; vertical-align: top;
        }
        
        .ldContent, .ctContent, .dtContent{
            width: 85%; line-height: 175%; margin: 0px auto; 
            font-size: 0.85em; letter-spacing: 0.05em;
        }
        
        .wrapper{
            padding: 1%;
            display: inline-block; letter-spacing: 0.1em;
        }
        
        /* DETAILED */       
        .remind{
            margin: 0px auto; line-height: 100%;
            font-size: 1.2em; text-align: center;
        }
        
        #ldRecord1{
            width: 35%;
            display: inline-block; vertical-align: middle;
        }
    
        #ldRecord2{
            width: 45%;
            display: inline-block; vertical-align: middle;
        }
        
        #ldButton, #dtButton{
            width: 15vmin; margin: -1em auto;
            background-color: #C4C400;
            font-size: 0.9em; text-align: center;
        }
        
        .ctRecord{
            padding: 1% 2% 0.5% 2%; line-height: 160%; border: none;
            background-color: #C4C400;
            -webkit-border-radius: 20px; border-radius: 20px;
        }
        
        input[type="radio"]{
            width: 25%; opacity: 0;
        }
        
        label{
            width: 10%; height: 28px; border: #272727;
            background-color: #272727; color: white;
            font-size: 0.9em; text-align: left;
            -webkit-border-radius: 5px; border-radius: 5px;
        }
        
        #dtInput{
            width: 100%; line-height: 100%;
            text-align: center;
        }
        
        .point1{
            width: 120px; line-height: 20px;
            background-color: #C4C400;
            font-size: 0.8em; text-align: center; vertical-align: middle;
            -webkit-border-radius: 20px 20px 0px 0px; border-radius: 20px 20px 0px 0px;
        }
              
        .squareWrap{
            width: 120px; height: 80px;
            display: inline-block; vertical-align: middle; position: relative;
        }
        
        .square{
            height: 80px; border: 0.1em solid #C4C400;
            -webkit-border-radius: 0px 0px 20px 20px; border-radius: 0px 0px 20px 20px;
        }
                
        .point2{
            width: 120px; line-height: 80px; top: 0;
            font-size: 2.4em; font-weight: bold; text-align: center; position: absolute;
        }
        
        /* RESPONSIVE */
		@media screen and (max-width: 550px){
            .lifeDiary, .contactRecord, .calendar{
                width: 80%;  margin: 1% auto;
                display: block; text-align: center;
            }
		}
    </style>
    
    <script>
		$(document).ready(function(){
            $.ajax({ 
                type: "POST",
                url: "",
                data: {CheckMain: 1},
                success: function(data){
                    console.log("CheckMain:", data);
                    if(data=="Invalid Access"){
                        $(".check").attr("hidden", true);
                        $.confirm({
                            title: "",
                            content: "你尚未選擇查看日期，請重新操作。",
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
            
            $("#ldButton").on("click", function(event){
			    event.preventDefault();
			    window.location.href="./lifeDiary.php";
            })
            
            $(".examine2").on("click", function(event){
                event.preventDefault();
                
                $.ajax({
                    type: "POST",
                    url: "",
                    data: $("form#contactAll").serialize(),
                    success: function(data){
                        console.log("ExamineCt", data);
                        if(data=="Contact Selection Success"){
                            window.location.href="./examine.php";
                        }
                    }, error: function(e){
                        console.log(e);
                    }  
                })
            })
            
            $(".revise").on("click", function(event){
                event.preventDefault();
                
                $.ajax({
                    type: "POST",
                    url: "",
                    data: $("form#contactAll").serialize(),
                    success: function(data){
                        console.log("ReviseCt", data);
                        if(data=="Contact Selection Success"){
                            window.location.href="./reviseCr.php";
                        }
                    }, error: function(e){
                        console.log(e);
                    }  
                })
            })
            
            $("#dtButton").on("click", function(event){
			    event.preventDefault();               
                check();
                
                $.ajax({
                    type: "POST",
                    url: "",
                    data: $("form#dtForm").serialize(),
                    success: function(data){
                        console.log("SelectDt", data);
                        if(data=="Select Success"){
                            window.location.href="./mains.php";
                        }
                    }, error: function(){
                        console.log(e);
                    }
                })
                
                //#dtInput.val()=$("form#dtForm):_POST("cdate")，前者為個別元素、後者為表單值列
                function check(){
                    if($("#dtInput").val()==""){
                        alert("請先選擇欲查看的日期。");
                        return false;
                    }else{
                        return true;
                    }
                }
            })
        })
    </script>
</head>


<body>
    <?php include("header.php");?>
    <div class="check">
    <p class="remind">歡迎登入，<?=$rs["name"]?>同學！</p><br>
    
    <div style="text-align: center">
        <div class="lifeDiary">
            <h5><b>查看生活日記</b></h5>
            
            <div class="ldContent">    
            <?php if(count($_SESSION["ldCdate"])==0){?>
                <div style="margin-bottom: 0.4em">日期：<?=$_SESSION["cdate"]?></div>
                <div style="color: red">
                <b>我當天並未完成生活日記</b>
                </div>
            <?php }else{?>
                <?php foreach($_SESSION["ldCdate"] as $r){?>
                    <div style="margin-bottom: 0.4em">日期：<?=$_SESSION["cdate"]?></div>

                    <div style="background-color: #C4C400">
                        <div id="ldRecord1">家庭壓力</div>            
                        <div id="ldRecord2"><?=$r["A1"]?></div>
                    </div>
                    <div>
                        <div id="ldRecord1">師長壓力</div>            
                        <div id="ldRecord2"><?=$r["A2"]?></div>
                    </div>
                    <div style="background-color: #C4C400">
                        <div id="ldRecord1">同學壓力</div>            
                        <div id="ldRecord2"><?=$r["A3"]?></div>
                    </div>
                    <div>
                        <div id="ldRecord1">人際關係</div>            
                        <div id="ldRecord2"><?=$r["A4"]?></div>
                    </div>
                    <div style="background-color: #C4C400">
                        <div id="ldRecord1">心理不適</div>            
                        <div id="ldRecord2"><?=$r["A5"]?></div>
                    </div>
                    <div>
                        <div id="ldRecord1">身體不適</div>            
                        <div id="ldRecord2"><?=$r["A6"]?></div>
                    </div>
                    <div style="background-color: #C4C400">
                        <div id="ldRecord1">學習熱忱</div>            
                        <div id="ldRecord2"><?=$r["A7"]?></div>
                    </div>
                    <div>
                        <div id="ldRecord1">自修時間</div>            
                        <div id="ldRecord2"><?=$r["A8"]?></div>
                    </div>
                    <div style="background-color: #C4C400">
                        <div id="ldRecord1">學習成果</div>            
                        <div id="ldRecord2"><?=$r["A9"]?></div>
                    </div>
                    <div>
                        <div id="ldRecord1">學習效率</div>            
                        <div id="ldRecord2"><?=$r["A10"]?></div>
                    </div>
                    <div style="background-color: #C4C400">
                        <div id="ldRecord1">我的心情</div>            
                        <div id="ldRecord2"><?=$r["A11"]?></div>
                    </div>
                <?php }?>
            <?php }?>
            </div>
        </div>    
        
        <div class="contactRecord">
            <h5><b>查看接觸紀錄</b></h5>

            <div class="ctContent">
            <form id="contactAll" name="contactAll">
            <input type="hidden" name="11">
            
            <?php if(count($rs1)==0){?>
                <div style="margin-bottom: 0.4em">日期：<?=$_SESSION["cdate"]?></div>
                <div style="color: red">
                <b>我當天並未新增接觸紀錄</b>
                </div><br>
            <?php }else{?>
                <div style="margin-bottom: 0.4em">日期：<?=$_SESSION["cdate"]?></div>
            <?php }?> 
                
                <?php foreach($_SESSION["crCdate1"] as $r){?>                             
                <?php if($r["tagged"]=="1"){?>
                    <?php if($today==date("Y-m-d", strtotime($r["time"]))){?>
                        <div class="ctRecord" style="background-color: #5119C2; color: white">
                            <div style="padding: 0.5% 1%; background-color: #BFFF00; color: black; float: left; font-weight: bold; -webkit-border-radius: 5px; border-radius: 5px">我被標註</div>
                            
                            <div style="text-align: right"><?=date("Y-m-d", strtotime($r["time"]))?> <?=$r["A4"]?>:00</div>
                            <div style="margin-top: 3%; text-align: left">
                                <b>與 <?=$r["id"][1]?><?=$r["id"][2]?>號 <?=$r["name"]?> <?=$r["A3"]?></b><br>
                                他在<?=$r["A6"]?>和我進行了<?=$r["A5"]?>的互動，內容與<?=$r["A1"]?>相關。
                            </div> 
                    
                            <div style="text-align: right">
                                <fieldset data-role="controlgroup" data-type="horizontal">
                                    <label><input class="examine2" type="radio" name="<?=$r["recordId"]?>" value="查看">查看</label>
                                    <label><input class="revise" type="radio" name="<?=$r["recordId"]?>" value="修改">修改</label>
                                </fieldset>
                            </div>
                        </div><br>
                    <?php }else{}?>
                <?php }else{?>
                    <?php if($today==date("Y-m-d", strtotime($r["time"]))){?>
                    <div class="ctRecord" style="background-color: #5119C2; color: white">
                        <div style="text-align: right"><?=date("Y-m-d", strtotime($r["time"]))?> <?=$r["A4"]?>:00</div>
                        <div style="margin-top: 3%; text-align: left">
                            <b>與 <?=$r["id"][1]?><?=$r["id"][2]?>號 <?=$r["name"]?> <?=$r["A3"]?></b><br>
                            我在<?=$r["A6"]?>和他進行了<?=$r["A5"]?>的互動，內容與<?=$r["A1"]?>相關。
                        </div> 
                    
                        <div style="text-align: right">
                            <fieldset data-role="controlgroup" data-type="horizontal">
                                <label><input class="examine2" type="radio" name="<?=$r["recordId"]?>" value="查看">查看</label>
                                <label><input class="revise" type="radio" name="<?=$r["recordId"]?>" value="修改">修改</label>
                            </fieldset>
                        </div>
                    </div><br>
                    <?php }else{}?>
                <?php }?>
                <?php }?>
 
                <?php foreach($_SESSION["crCdate2"] as $r){?>
                <?php if($r["tagged"]=="1"){?>
                    <div class="ctRecord">
                        <div style="text-align: right"><?=date("Y-m-d", strtotime($r["time"]))?> <?=$r["A4"]?>:00</div>
                        <div style="margin-top: 3%; text-align: left">
                            <b>與 <?=$r["id"][1]?><?=$r["id"][2]?>號 <?=$r["name"]?> <?=$r["A3"]?></b><br>
                            他在<?=$r["A6"]?>和我進行了<?=$r["A5"]?>的互動，內容與<?=$r["A1"]?>相關。
                        </div> 

                        <div style="text-align: right">
                            <?php if($today==date("Y-m-d", strtotime($r["time"]))){?>
                            <fieldset data-role="controlgroup" data-type="horizontal">
                                <label><input class="examine2" type="radio" name="<?=$r["recordId"]?>" value="查看">查看</label>
                                <label><input class="revise" type="radio" name="<?=$r["recordId"]?>" value="修改">修改</label>
                                <?php }else{?>
                                <label><input class="examine2" type="radio" name="<?=$r["recordId"]?>" value="查看">查看</label>
                            </fieldset>
                            <?php }?>
                        </div>
                    </div><br>
                <?php }else{?>
                    <div class="ctRecord">
                        <div style="text-align: right"><?=date("Y-m-d", strtotime($r["time"]))?> <?=$r["A4"]?>:00</div>
                        <div style="margin-top: 3%; text-align: left">
                            <b>與 <?=$r["id"][1]?><?=$r["id"][2]?>號 <?=$r["name"]?> <?=$r["A3"]?></b><br>
                            我在<?=$r["A6"]?>和他進行了<?=$r["A5"]?>的互動，內容與<?=$r["A1"]?>相關。
                        </div> 

                        <div style="text-align: right">
                            <?php if($today==date("Y-m-d", strtotime($r["time"]))){?>
                            <fieldset data-role="controlgroup" data-type="horizontal">
                                <label><input class="examine2" type="radio" name="<?=$r["recordId"]?>" value="查看">查看</label>
                                <label><input class="revise" type="radio" name="<?=$r["recordId"]?>" value="修改">修改</label>
                                <?php }else{?>
                                <label><input class="examine2" type="radio" name="<?=$r["recordId"]?>" value="查看">查看</label>
                            </fieldset>
                            <?php }?>
                        </div>
                    </div><br>
                <?php }?>
                <?php }?>          
            </form>
            </div>
        </div>
        
        <div class="calendar">
            <h5><b>日曆選單</b></h5>
            
            <div class="dtContent">
            <form id="dtForm">
                <p>
                <input id="dtInput" type="date" name="cdate">
                <center><button id="dtButton" class="btn">篩選</button></center>
                </p>
            </form>
            </div>
            
            <div style="text-align: center; margin-top: 15%">                  
                <div class="wrapper">
                    <div class="point1">當日<br>接觸筆數</div>
                    <div class="squareWrap">
                        <div class="square"></div>
                        <div class="point2"><?=$_SESSION["dtValid"]["COUNT(*)"]?></div>
                    </div>            
                </div>              
            </div>
        </div>
    </div>
    
    </div>
    <?php include("footer.php");?>
</body>
</html>
