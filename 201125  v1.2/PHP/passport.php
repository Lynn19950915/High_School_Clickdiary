<?php
	session_start();
    include "db.php";

    if($_SESSION["acc_info"]["id"]==null){
        header("Location: ./index.php");  //0.登入後查看
	}
    $rs=$_SESSION["acc_info"];
    $id=$_SESSION["acc_info"]["id"];
    $month=date("m");

    $sql1="SELECT COUNT(*) FROM `points` WHERE id= :v1 and event LIKE '每日登入%' and MONTH(time)= :v2";
    $stmt=$db->prepare($sql1);
    $stmt->bindParam(":v1", $id);
    $stmt->bindParam(":v2", $month);
    $stmt->execute();                     //1.本月登入日數
    $rs1=$stmt->fetch(PDO::FETCH_ASSOC);

    $sql2="SELECT COUNT(*) FROM `record` WHERE id= :v1 and MONTH(time)= :v2 and B1 IS NOT NULL and B2 IS NOT NULL";
    $stmt=$db->prepare($sql2);
    $stmt->bindParam(":v1", $id);
    $stmt->bindParam(":v2", $month);
    $stmt->execute();                     //2.本月累計接觸筆數
    $rs2=$stmt->fetch(PDO::FETCH_ASSOC);

    $sql3="SELECT DATE(time) FROM `record` WHERE id= :v1 and MONTH(time)= :v2 and B1 IS NOT NULL and B2 IS NOT NULL GROUP BY DATE(time)";
    $stmt=$db->prepare($sql3);
    $stmt->bindParam(":v1", $id);
    $stmt->bindParam(":v2", $month);
    $stmt->execute();                     //3.新增接觸紀錄之日期
    $rs3=$stmt->fetchAll(PDO::FETCH_ASSOC);

    //rs3包含許多項，利用迴圈逐項將日期(DATE(time))寫入array
    $i=0;
    $j=array();
    while($i<count($rs3)){
        array_push($j, $rs3[$i]["DATE(time)"]);
        $i++;
    }

    $sql4="SELECT date FROM `lifediary` WHERE id= :v1 and MONTH(time)= :v2";
    $stmt=$db->prepare($sql4);
    $stmt->bindParam(":v1", $id);
    $stmt->bindParam(":v2", $month);
    $stmt->execute();                     //4.完成生活日記之日期
    $rs4=$stmt->fetchAll(PDO::FETCH_ASSOC);

    //rs4原理相同，最後將兩者取交集得到有效天數
    $k=0;
    $l=array();
    while($k<count($rs4)){
        array_push($l, $rs4[$k]["date"]);
        $k++;
    }
    $result=array_intersect($j,$l);
?>

<!DOCTYPE html>
<html>
<head>
	<title>帳號總覽</title>
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
            letter-spacing: 0.1em;
        }
        
        .wrapper{
            padding: 1%;
            display: inline-block;
        }
        
        /* DETAILED */
        .point1{
            width: 20vmin; line-height: 3vmin;
            background-color: #C4C400;
            font-size: 0.9em; text-align: center; vertical-align: middle;
            -webkit-border-radius: 20px 20px 0px 0px; border-radius: 20px 20px 0px 0px;
        }
              
        .squareWrap{
            width: 20vmin; height: 12vmin;
            display: inline-block; vertical-align: middle; position: relative;
        }
        
        .square{
            height: 12vmin; border: 0.1em solid #C4C400;
            -webkit-border-radius: 0px 0px 20px 20px; border-radius: 0px 0px 20px 20px;
        }
                
        .point2{
            width: 20vmin; line-height: 12vmin; top: 0;
            font-size: 2.7em; font-weight: bold; text-align: center; position: absolute;
        }        

        /* RESPONSIVE */
		@media screen and (max-width: 550px){
            .modal-content{
                width: 80%; margin: 20px auto;
                font-size: 0.8em;
            }
            
            h5{
                font-size: 1.1em;
            }
            
            .wrapper{
                padding-bottom: 4%;
            }
            
            .point1{
                line-height: 12vmin;
                display: inline-block;
                -webkit-border-radius: 20px 0px 0px 20px; border-radius: 20px 0px 0px 20px;
            }
            
            .squareWrap{
                width: 40vmin; margin-left: -3%;
                display: inline-block;
            }
        
            .square{
                -webkit-border-radius: 0px 20px 20px 0px; border-radius: 0px 20px 20px 0px;
            }
                
            .point2{
                width: 40vmin;
                font-size: 2.4em;
            }
        }
    </style>
</head>


<body>
	<?php include("header.php");?>
    
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">帳號總覽</h5>
        </div>
        
        <div class="modal-body">           
            <div style="text-align: center">
                <div class="wrapper">
                    <div class="point1">姓名</div>
                    <div class="squareWrap">
                        <div class="square"></div>
                        <div class="point2" style="font-size: 1.35em"><?=$rs["name"]?></div>
                    </div>            
                </div>
                
                <div class="wrapper">
                    <div class="point1">註冊信箱</div>
                    <div class="squareWrap">
                        <div class="square"></div>
                        <div class="point2" style="font-size: 0.45em; letter-spacing: -0.05em"><?=$rs["username"]?></div>
                    </div>            
                </div>
            
                <div class="wrapper">
                    <div class="point1">會員編號</div>
                    <div class="squareWrap">
                        <div class="square"></div>
                        <div class="point2"><?=$rs["id"]?></div>
                    </div>            
                </div>                
            </div>
            
            <div style="text-align: center">
                <div class="wrapper">
                    <div class="point1" style="line-height: 22.5px">本月<br>登入日數</div>
                    <div class="squareWrap">
                        <div class="square"></div>
                        <div class="point2"><?=$rs1["COUNT(*)"]?></div>
                    </div>            
                </div>
                    
                <div class="wrapper">
                    <div class="point1" style="line-height: 22.5px">本月累計<br>接觸筆數</div>
                    <div class="squareWrap">
                        <div class="square"></div>
                        <div class="point2"><?=$rs2["COUNT(*)"]?></div>
                    </div>            
                </div>
            
                <div class="wrapper">
                    <div class="point1" style="line-height: 22.5px">本月<br>有效天數</div>
                    <div class="squareWrap">
                        <div class="square"></div>
                        <div class="point2"><?=count($result)?></div>
                    </div>            
                </div>                
            </div>
        </div>
    </div>
    
	<?php include("footer.php");?>
</body>
</html>
