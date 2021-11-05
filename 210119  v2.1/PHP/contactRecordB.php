<?php
	session_start();
    include "db.php";

    if($_SESSION["acc_info"]["id"]==null){
        header("Location: ./index.php");  //0.登入後查看
	}
    $id=$_SESSION["acc_info"]["id"];
    $today=date("Y-m-d");

    //彙整變數中待完成的對象及其名字，以迴圈列入B卷版面
    $i=0;
    $j=array();
    if(!empty($_SESSION["A0M"])){ 
        while($i<count($_SESSION["A0M"])){
            $sql1="SELECT id, name from `account` WHERE id= :v1";
            $stmt=$db->prepare($sql1);
            $stmt->bindParam(":v1", $_SESSION["A0M"][$i]);
            $stmt->execute();
            $rs1=$stmt->fetchAll(PDO::FETCH_ASSOC);

            array_push($j, $rs1);
            $i++;
        }
    }
    
    //逐一與迴圈核對，全都完整填寫才新增紀錄
    if(isset($_POST["00"])){
        $k=0;
        $l=0;
        while($k<count($j)){
            $B=isset($_POST[$j[$k][0]["id"]."B"])?$_POST[$j[$k][0]["id"]."B"]:0;            
            if($B=="0"){
                $l++;
            }
            $k++;
        }
        
        if($l>0){
            echo "PartB Incomplete";
        }else{
            $k=0;            
            while($k<count($j)){
                $B=isset($_POST[$j[$k][0]["id"]."B"])?$_POST[$j[$k][0]["id"]."B"]:0;
                
                if(count($_SESSION["A0M"])==1){
                    $sql2="INSERT INTO `record` (id, time, `groups`, tagged, A0, A1, A2, A3, A4d, A4, A5, A6, A7, A8, B) VALUES (:v1, CURTIME(), 0, 0, :A0, :A1, :A2, :A3, :A4d, :A4, :A5, :A6, :A7, :A8, :B)";
                    $stmt=$db->prepare($sql2);
                    $stmt->bindParam(":v1", $id);
                    $stmt->bindParam(":A0", $j[$k][0]["id"]);
                    $stmt->bindParam(":A1", $_SESSION["A1"]);
                    $stmt->bindParam(":A2", $_SESSION["A2"]);
                    $stmt->bindParam(":A3", $_SESSION["A3"]);
                    $stmt->bindParam(":A4d",$_SESSION["A4d"]);
                    $stmt->bindParam(":A4", $_SESSION["A4"]);
                    $stmt->bindParam(":A5", $_SESSION["A5"]);
                    $stmt->bindParam(":A6", $_SESSION["A6"]);
                    $stmt->bindParam(":A7", $_SESSION["A7"]);
                    $stmt->bindParam(":A8", $_SESSION["A8"]);
                    $stmt->bindParam(":B",  $B);
                    $stmt->execute();   //2.單一對象接觸(groups=0)+自己(tagged=0)
                    
                    $sql3="INSERT INTO `record` (id, time, `groups`, tagged, A0, A1, A2, A3, A4d, A4, A5, A6) VALUES(:v1, CURTIME(), 0, 1, :A0, :A1, :A2, :A3, :A4d, :A4, :A5, :A6)";
                    $stmt=$db->prepare($sql3);
                    $stmt->bindParam(":v1", $j[$k][0]["id"]);
                    $stmt->bindParam(":A0", $id);
                    $stmt->bindParam(":A1", $_SESSION["A1"]);
                    $stmt->bindParam(":A2", $_SESSION["A2"]);
                    $stmt->bindParam(":A3", $_SESSION["A3"]);
                    $stmt->bindParam(":A4d",$_SESSION["A4d"]);
                    $stmt->bindParam(":A4", $_SESSION["A4"]);
                    $stmt->bindParam(":A5", $_SESSION["A5"]);
                    $stmt->bindParam(":A6", $_SESSION["A6"]);
                    $stmt->execute();   //3.單一對象接觸(groups=0)+對方(tagged=1):id, A0對調、只新增前六題
                    
                }else{
                    $sql4="INSERT INTO `record` (id, time, `groups`, tagged, A0, A1, A2, A3, A4d, A4, A5, A6, A7, A8, B) VALUES (:v1, CURTIME(), 1, 0, :A0, :A1, :A2, :A3, :A4d, :A4, :A5, :A6, :A7, :A8, :B)";
                    $stmt=$db->prepare($sql4);
                    $stmt->bindParam(":v1", $id);
                    $stmt->bindParam(":A0", $j[$k][0]["id"]);
                    $stmt->bindParam(":A1", $_SESSION["A1"]);
                    $stmt->bindParam(":A2", $_SESSION["A2"]);
                    $stmt->bindParam(":A3", $_SESSION["A3"]);
                    $stmt->bindParam(":A4d",$_SESSION["A4d"]);
                    $stmt->bindParam(":A4", $_SESSION["A4"]);
                    $stmt->bindParam(":A5", $_SESSION["A5"]);
                    $stmt->bindParam(":A6", $_SESSION["A6"]);
                    $stmt->bindParam(":A7", $_SESSION["A7"]);
                    $stmt->bindParam(":A8", $_SESSION["A8"]);
                    $stmt->bindParam(":B",  $B);
                    $stmt->execute();   //4.多對象(團體)接觸(groups=1)+自己(tagged=0)
                    
                    $sql5="INSERT INTO `record` (id, time, `groups`, tagged, A0, A1, A2, A3, A4d, A4, A5, A6) VALUES(:v1, CURTIME(), 1, 1, :A0, :A1, :A2, :A3, :A4d, :A4, :A5, :A6)";
                    $stmt=$db->prepare($sql5);
                    $stmt->bindParam(":v1", $j[$k][0]["id"]);
                    $stmt->bindParam(":A0", $id);
                    $stmt->bindParam(":A1", $_SESSION["A1"]);
                    $stmt->bindParam(":A2", $_SESSION["A2"]);
                    $stmt->bindParam(":A3", $_SESSION["A3"]);
                    $stmt->bindParam(":A4d",$_SESSION["A4d"]);
                    $stmt->bindParam(":A4", $_SESSION["A4"]);
                    $stmt->bindParam(":A5", $_SESSION["A5"]);
                    $stmt->bindParam(":A6", $_SESSION["A6"]);
                    $stmt->execute();   //5.多對象(團體)接觸(groups=1)+對方(tagged=1):id, A0對調、只新增前六題                 
                }
                $k++;
            }                
            echo "PartB Success";
        }
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
            
            #remind, #submitB{
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
            $("#submitB").on("click", function(event){
                event.preventDefault();
                
                $.ajax({
                    type: "POST",
                    url: "",
                    data: $("form#contactRecordB").serialize(),
                    success: function(data){
                        console.log("ContactRecordB", data);	
                        if(data=="PartB Success"){
                            $.confirm({
                                title: "",
                                content: "接觸紀錄寫入成功！",
                                buttons:{
                                    "OK": function(){
                                        $("#loading").show();
                                        window.location.href="./main.php";
                                    }
                                }
                            }) 
                        }else if(data=="PartB Incomplete"){
                            $("#submitB").attr("disabled", false);
                            $.alert({
							    title: "",
							    content: "你尚未填答完畢唷！",
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
    <div id="loading"><img src="pic/ajax-spinner.gif" style="width: 10vmin"/><b>正在載入中 ...</b></div><br>
    <p id="remind" style="color: red"><b>請注意：同一時間、地點下的接觸才可計入同筆資料，否則請分開數筆填寫！</b></p>

    <?php if($i!=0){?>
    <form id="contactRecordB" name="contactRecordB">
    <div class="modal-content" style="border: none">
        <h5 style="text-align: right"><b>記錄日期：<?=$_SESSION["A4d"]?></b></h5>
    </div>
    
    <input type="hidden" name="00">
    <?php foreach($j as $recordInfo){?>
    <?php foreach($recordInfo as $r){?>
    <div class="modal-content">
        <div class="modal-body" style="margin-bottom: -10px">
            <div style="text-align: left">以下問題針對 <b><?=$r["A0"][1]?><?=$r["A0"][2]?>號 <?=$r["name"]?></b></div>
        </div>
        
        <div style="display: inline-flex">
        <div class="modal-content" style="width: 100%; margin: 10px auto">
            <div class="modal-header">
                <div class="modal-title"><b>B. 這次互動後，<u>我認為</u><?=$r["id"][-2]?><?=$r["id"][-1]?>號 <?=$r["name"]?> 的心情變化：</b></div>
            </div>
            <div class="modal-body">
                <fieldset data-role="controlgroup" data-type="horizontal">
                    <label><input type="radio" name="<?=$r["id"]?>B" value="變得很差">變得很差</label>
                    <label><input type="radio" name="<?=$r["id"]?>B" value="變得有點差">變得有點差</label>
                    <label><input type="radio" name="<?=$r["id"]?>B" value="沒有改變">沒有改變</label>
                    <label><input type="radio" name="<?=$r["id"]?>B" value="變得有點好">變得有點好</label>
                    <label><input type="radio" name="<?=$r["id"]?>B" value="變得很好">變得很好</label>
                    <label><input type="radio" name="<?=$r["id"]?>B" value="我不知道">我不知道</label>
                </fieldset>
            </div>
        </div>
        </div>
    </div>
    <?php }?>
    <?php }?>
        
    <center>
        <div><button id="submitB" class="btn" type="submit" onclick="javascript:{this.disabled=true}">完成</button></div>
    </center>
    </form>
    <?php }?>
    
    <?php include("footer.php");?>
</body>
</html>
