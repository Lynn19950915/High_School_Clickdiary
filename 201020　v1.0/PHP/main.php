<?php
	session_start();
    include "db.php";

    if($_SESSION["acc_info"]["id"]==null){
        header("Location: ./index.php");  //0.登入後查看
	}
    $rs=$_SESSION["acc_info"];
    $id=$_SESSION["acc_info"]["id"];
    $month=date("m");
    $today=date("Y-m-d");

    $sql1="SELECT * FROM `lifediary` WHERE id= :v1 and date= :v2";
    $stmt=$db->prepare($sql1);
    $stmt->bindParam(":v1", $id);
    $stmt->bindParam(":v2", $today);
    $stmt->execute();                     //1.當日生活日記
    $rs1=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql2="SELECT *, name FROM `record` LEFT JOIN `account` ON record.A0=account.id WHERE record.id= :v1 ORDER BY DATE(time) desc, A4 desc";
    $stmt=$db->prepare($sql2);
    $stmt->bindParam(":v1", $id);
    $stmt->execute();                     //2.接觸紀錄一覽(依時間倒序列出)
    $rs2=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql3="SELECT COUNT(*) FROM `record` WHERE id= :v1 and MONTH(time)= :v2 and B1 IS NOT NULL and B2 IS NOT NULL";
    $stmt=$db->prepare($sql3);
    $stmt->bindParam(":v1", $id);
    $stmt->bindParam(":v2", $month);
    $stmt->execute();                     //3.本月累計接觸筆數
    $rs3=$stmt->fetch(PDO::FETCH_ASSOC);

    $sql4="SELECT DATE(time) FROM `record` WHERE id= :v1 and MONTH(time)= :v2 and B1 IS NOT NULL and B2 IS NOT NULL GROUP BY DATE(time)";
    $stmt=$db->prepare($sql4);
    $stmt->bindParam(":v1", $id);
    $stmt->bindParam(":v2", $month);
    $stmt->execute();                     //4.新增接觸紀錄之日期
    $rs4=$stmt->fetchAll(PDO::FETCH_ASSOC);

    //rs4包含許多項，利用迴圈逐項將日期(DATE(time))寫入array
    $i=0;
    $j=array();
    while($i<count($rs4)){
        array_push($j, $rs4[$i]["DATE(time)"]);
        $i++;
    }

    $sql5="SELECT date FROM `lifediary` WHERE id= :v1 and MONTH(time)= :v2";
    $stmt=$db->prepare($sql5);
    $stmt->bindParam(":v1", $id);
    $stmt->bindParam(":v2", $month);
    $stmt->execute();                     //5.完成生活日記之日期
    $rs5=$stmt->fetchAll(PDO::FETCH_ASSOC);

    //rs5原理相同，最後將兩者取交集得到有效天數
    $k=0;
    $l=array();
    while($k<count($rs5)){
        array_push($l, $rs5[$k]["date"]);
        $k++;
    }
    $result=array_intersect($j,$l);
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
            width: 20%; padding: 1%;
            display: inline-block; vertical-align: top;
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
        
        #crButton, .ctRecord{
            padding: 1% 2% 0.5% 2%; line-height: 160%; border: none;
            background-color: #C4C400;
            -webkit-border-radius: 20px; border-radius: 20px;
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
    </style>
    
    <script>
		$(document).ready(function(){
            $("#ldButton").on("click", function(event){
			    event.preventDefault();
			    window.location.href="./lifeDiary.php";
            })
            
            $("#crButton").on("click", function(event){
			    event.preventDefault();
			    window.location.href="./contactRecordA.php";
            })
        })
    </script>
</head>


<body>
    <?php include("header.php");?>
    <p class="remind">歡迎登入，<?=$rs["name"])?>同學！</p><br>
    
    <div style="text-align: center">
        <div class="lifeDiary">
            <h5><b>生活日記</b></h5>
            
            <div class="ldContent">
            <?php if(count($rs1)==0){?>
                <p>我今日尚未完成生活日記
                <center><button id="ldButton" class="btn">開始填寫</button></center>
                </p>
            <?php }else{?>    
                <?php foreach($rs1 as $r){?>
                    <div style="margin-bottom: 0.4em">日期：<?=date("Y-m-d")?></div>

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
                
                    <p>
                    <center><button id="ldButton" class="btn">修改</button></center>
                    </p>
                <?php }?>
            <?php }?>
            </div>
        </div>
        
        <div class="contactRecord">
            <h5><b>接觸紀錄</b></h5>
            <center><button id="crButton" style="width: 85%; font-size: 0.95em">新增一筆接觸</button></center>
            
            <div class="ctContent">   
            <form id="contactAll" name="contactAll">
            <?php if(count($rs2)==0){?>    
                <div style="color: red"><b>我目前尚無接觸紀錄</b></div>
            <?php }else{?>
                <?php foreach($rs2 as $r){?>
                    <div class="ctRecord">
                        <div style="text-align: right"><?=date("Y-m-d", strtotime($r["time"]))?> <?=$r["A4"]?>:00</div>
                        <div style="margin-top: 3%; text-align: left">
                            <b>與 <?=$r["id"][1]?><?=$r["id"][2]?>號 <?=$r["name"]?> <?=$r["A3"]?></b><br>
                            我在<?=$r["A6"]?>和他進行了<?=$r["A5"]?>的互動，內容與<?=$r["A1"]?>相關。
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
                    <div class="point1">本月<br>有效天數</div>
                    <div class="squareWrap">
                        <div class="square"></div>
                        <div class="point2"><?=count($result)?></div>
                    </div>            
                </div>
                    
                <div class="wrapper">
                    <div class="point1">本月累計<br>接觸筆數</div>
                    <div class="squareWrap">
                        <div class="square"></div>
                        <div class="point2"><?=$rs3["COUNT(*)"]?></div>
                    </div>            
                </div>              
            </div>
        </div>   
    </div>
    
    <?php include("footer.php");?>
</body>
</html>
