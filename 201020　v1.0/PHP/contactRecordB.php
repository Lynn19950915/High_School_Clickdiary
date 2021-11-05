<?php
	session_start();
    include "db.php";

    if($_SESSION["acc_info"]["id"]==null){
        header("Location: ./index.php");  //0.登入後查看
	}
    $id=$_SESSION["acc_info"]["id"];
    $today=date("Y-m-d");

    //檢查當日是否有不完整的資料(之前的已作廢)
    if(isset($_POST["CheckContactA"])){
        $sql1="SELECT * FROM `record` WHERE id= :v1 and DATE(time)= :v2 and (B1 IS NULL or B2 IS NULL)";
        $stmt=$db->prepare($sql1);
        $stmt->bindParam(":v1", $id);
        $stmt->bindParam(":v2", $today);
        $stmt->execute();                 //1.當日的不完整資料
        $rs1=$stmt->fetch(PDO::FETCH_ASSOC);
        
        if($stmt->rowCount()==0){
            echo "Invalid Access";        
        }
        exit();
    }

    //從不完整資料中，找出寫入時間最近(及其十秒內)的筆數，避免多筆資料寫入時間差
    $sql2="SELECT *, name FROM `record` LEFT JOIN `account` ON record.A0=account.id WHERE record.id= :v1 and time between(
        SELECT subtime(time, '10') FROM `record` WHERE id= :v1 and (B1 IS NULL or B2 IS NULL) ORDER BY time desc limit 1) and(
        SELECT time FROM `record` WHERE id= :v1 and (B1 IS NULL or B2 IS NULL) ORDER BY time desc limit 1)
        and (B1 IS NULL or B2 IS NULL)";
    $stmt=$db->prepare($sql2);
    $stmt->bindParam(":v1", $id);
    $stmt->execute();                     //2.呈現B部分問卷                       
    $rs2=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["PartAList"]=$rs2;

    //將$rs2當中的recordId收集起來，於提交時逐一與表單中的變數核對、寫入
    if(isset($_POST["00"])){
        $i=0;
        $j=0;
        $k=array(); 
        while($i<count($rs2)){
            array_push($k, $rs2[$i]["recordId"]);
            $i++;
        }
        
        while($j<count($k)){
            $B1=isset($_POST["$k[$j]B1"])?$_POST["$k[$j]B1"]:0;
            $B2=isset($_POST["$k[$j]B2"])?$_POST["$k[$j]B2"]:0;           
            
            if($B1!="0"){
                $sql3="UPDATE `record` SET B1= :B1 WHERE recordId= :v1";
                $stmt=$db->prepare($sql3);
                $stmt->bindParam(":v1", $k[$j]);
                $stmt->bindParam(":B1", $B1);
                $stmt->execute();
            }
            if($B2!="0"){
                $sql4="UPDATE `record` SET B2= :B2 WHERE recordId= :v1";
                $stmt=$db->prepare($sql4);
                $stmt->bindParam(":v1", $k[$j]);
                $stmt->bindParam(":B2", $B2);
                $stmt->execute();
            }
            $j++;
        }
        echo "PartB Success";
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>接觸紀錄 B</title>
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
        .modal-content{
            width: 70%; margin: 40px auto;
            letter-spacing: 0.05em;
        }
        
        .modal-header{
            background-color: #C4C400;
        }
        
        .modal-body{
            font-size: 0.95em; text-align: center;
        }
        
        /* DETAILED */        
        label{
            width: 18%;
        }
        
        label:hover{
            background-color: #C4C400;
        }
        
        input{
            width: 12%;
        }
    
        #submitB{
            width: 40vmin;
            color: #f0f0f0; background-color: #C4C400;
            -webkit-border-radius: 40px; border-radius: 40px;
        }
            
        /* RESPONSIVE */
		@media screen and (max-width: 550px){
            .modal-content{
                width: 80%; margin: 20px auto;
                font-size: 0.8em;
            }
            
            .modal-body{
                text-align: left;
            }
            
            #submitB{
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
            $.ajax({ 
                type: "POST",
                url: "",
                data: {CheckContactA: 1},
                success: function(data){
                    console.log("CheckContactA:", data);
                    if(data=="Invalid Access"){
                        $.confirm({
                            title: "",
                            content: "你今日並無尚未完成之接觸紀錄，若要新增請從 A 卷開始起填",
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
            
            $("#submitB").on("click", function(event){
                event.preventDefault();
                
                $.ajax({
                    type: "POST",
                    url: "",
                    data: $("form#contactRecordB").serialize(),
                    success: function(data){
                        console.log(data)	
                        if(data=="PartB Success"){
                            $.confirm({
                                title: "",
                                content: "接觸紀錄寫入成功！",
                                buttons:{
                                    "OK": function(){
                                        window.location.href="./main.php";
                                    }
                                }
                            }) 
                        }
                    }, error: function(){
                        console.log(e);
                    }
                })
            })
        })
    </script>
</head>


<body>
    <?php include("header.php");?>

    <form id="contactRecordB" name="contactRecordB">
    <div class="modal-content" style="border: none">
        <h5 style="text-align: right"><b>紀錄日期：<?=date("Y-m-d")?></b></h5>
    </div>
    
    <input type="hidden" name="00">  
    <?php foreach($_SESSION['PartAList'] as $r){?>
    <div class="modal-content">
        <div class="modal-body" style="margin-bottom: -10px">
            <div style="text-align: left">以下問題針對 <b><?=$r["A0"][1]?><?=$r["A0"][2]?>號 <?=$r["name"]?></b></div>
        </div>
        
        <div style="display: inline-flex">
        <div class="modal-content" style="width: 48%; margin: 1% auto">
            <div class="modal-header">
                <div class="modal-title"><b>B1. 這次互動<u>前</u>，<?=$r["name"]?>的心情：</b></div>
            </div>
            <div class="modal-body">
                <fieldset data-role="controlgroup" data-type="horizontal">
                    <label><input type="radio" name="<?=$r["recordId"]?>B1" value="1">很不好</label>
                    <label><input type="radio" name="<?=$r["recordId"]?>B1" value="2">有點不好</label>
                    <label><input type="radio" name="<?=$r["recordId"]?>B1" value="3">普通</label>
                    <label><input type="radio" name="<?=$r["recordId"]?>B1" value="4">有點好</label>
                    <label><input type="radio" name="<?=$r["recordId"]?>B1" value="5">很好</label>
                    <label><input type="radio" name="<?=$r["recordId"]?>B1" value="9">不清楚</label>
                </fieldset>
            </div>
        </div>
        
        <div class="modal-content" style="width: 48%; margin: 1% auto">
            <div class="modal-header">
                <div class="modal-title"><b>B2. 這次互動<u>後</u>，<?=$r["name"]?>的心情：</b></div>
            </div>
            <div class="modal-body">
                <fieldset data-role="controlgroup" data-type="horizontal">
                    <label><input type="radio" name="<?=$r["recordId"]?>B2" value="1">很不好</label>
                    <label><input type="radio" name="<?=$r["recordId"]?>B2" value="2">有點不好</label>
                    <label><input type="radio" name="<?=$r["recordId"]?>B2" value="3">普通</label>
                    <label><input type="radio" name="<?=$r["recordId"]?>B2" value="4">有點好</label>
                    <label><input type="radio" name="<?=$r["recordId"]?>B2" value="5">很好</label>
                    <label><input type="radio" name="<?=$r["recordId"]?>B2" value="9">不清楚</label>
                </fieldset>
            </div>
        </div>
        </div>
    </div>
    <?php }?>
        
    <center>
        <div><button id="submitB" class="btn" type="submit">完成</button></div>
    </center>
    </form>
    
    <?php include("footer.php");?>
</body>
</html>
