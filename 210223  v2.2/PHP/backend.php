<?php
    session_start();
    include "db.php";

    $sql1="SELECT * FROM `account` WHERE agree=1";
    $stmt=$db->prepare($sql1);
    $stmt->execute();       //1.所有參與同學
    $rs1=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql2="SELECT count(date) FROM `account` LEFT JOIN (SELECT * FROM `lifediary` WHERE date='2020/12/10') T1 on account.id=T1.id WHERE agree=1 GROUP BY account.id";
    $stmt=$db->prepare($sql2);
    $stmt->execute();       //2.DAY1: 生活日記
    $rs2=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql3="SELECT account.id AS id, count(A4d) FROM `account` LEFT JOIN (SELECT * FROM `record` WHERE A4d='2020/12/10' and A7 IS NOT NULL and A8 IS NOT NULL and B IS NOT NULL) T1 on account.id=T1.id WHERE agree=1 GROUP BY account.id";
    $stmt=$db->prepare($sql3);
    $stmt->execute();       //3.DAY1: 接觸紀錄
    $rs3=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql4="SELECT count(date) FROM `account` LEFT JOIN (SELECT * FROM `lifediary` WHERE date='2020/12/11') T1 on account.id=T1.id WHERE agree=1 GROUP BY account.id";
    $stmt=$db->prepare($sql4);
    $stmt->execute();       //4.DAY2: 生活日記
    $rs4=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql5="SELECT account.id AS id, count(A4d) FROM `account` LEFT JOIN (SELECT * FROM `record` WHERE A4d='2020/12/11' and A7 IS NOT NULL and A8 IS NOT NULL and B IS NOT NULL) T1 on account.id=T1.id WHERE agree=1 GROUP BY account.id";
    $stmt=$db->prepare($sql5);
    $stmt->execute();       //5.DAY2: 接觸紀錄
    $rs5=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql6="SELECT count(date) FROM `account` LEFT JOIN (SELECT * FROM `lifediary` WHERE date='2020/12/12') T1 on account.id=T1.id WHERE agree=1 GROUP BY account.id";
    $stmt=$db->prepare($sql6);
    $stmt->execute();       //6.DAY3: 生活日記
    $rs6=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql7="SELECT account.id AS id, count(A4d) FROM `account` LEFT JOIN (SELECT * FROM `record` WHERE A4d='2020/12/12' and A7 IS NOT NULL and A8 IS NOT NULL and B IS NOT NULL) T1 on account.id=T1.id WHERE agree=1 GROUP BY account.id";
    $stmt=$db->prepare($sql7);
    $stmt->execute();       //7.DAY3: 接觸紀錄
    $rs7=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql8="SELECT count(date) FROM `account` LEFT JOIN (SELECT * FROM `lifediary` WHERE date='2020/12/13') T1 on account.id=T1.id WHERE agree=1 GROUP BY account.id";
    $stmt=$db->prepare($sql8);
    $stmt->execute();       //8.DAY4: 生活日記
    $rs8=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql9="SELECT account.id AS id, count(A4d) FROM `account` LEFT JOIN (SELECT * FROM `record` WHERE A4d='2020/12/13' and A7 IS NOT NULL and A8 IS NOT NULL and B IS NOT NULL) T1 on account.id=T1.id WHERE agree=1 GROUP BY account.id";
    $stmt=$db->prepare($sql9);
    $stmt->execute();       //9.DAY4: 接觸紀錄
    $rs9=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql10="SELECT count(date) FROM `account` LEFT JOIN (SELECT * FROM `lifediary` WHERE date='2020/12/14') T1 on account.id=T1.id WHERE agree=1 GROUP BY account.id";
    $stmt=$db->prepare($sql10);
    $stmt->execute();       //10.DAY5: 生活日記
    $rs10=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql11="SELECT account.id AS id, count(A4d) FROM `account` LEFT JOIN (SELECT * FROM `record` WHERE A4d='2020/12/14' and A7 IS NOT NULL and A8 IS NOT NULL and B IS NOT NULL) T1 on account.id=T1.id WHERE agree=1 GROUP BY account.id";
    $stmt=$db->prepare($sql11);
    $stmt->execute();       //11.DAY5: 接觸紀錄
    $rs11=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql12="SELECT count(date) FROM `account` LEFT JOIN (SELECT * FROM `lifediary` WHERE date='2020/12/15') T1 on account.id=T1.id WHERE agree=1 GROUP BY account.id";
    $stmt=$db->prepare($sql12);
    $stmt->execute();       //12.DAY6: 生活日記
    $rs12=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql13="SELECT account.id AS id, count(A4d) FROM `account` LEFT JOIN (SELECT * FROM `record` WHERE A4d='2020/12/15' and A7 IS NOT NULL and A8 IS NOT NULL and B IS NOT NULL) T1 on account.id=T1.id WHERE agree=1 GROUP BY account.id";
    $stmt=$db->prepare($sql13);
    $stmt->execute();       //13.DAY6: 接觸紀錄
    $rs13=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql14="SELECT count(date) FROM `account` LEFT JOIN (SELECT * FROM `lifediary` WHERE date='2020/12/16') T1 on account.id=T1.id WHERE agree=1 GROUP BY account.id";
    $stmt=$db->prepare($sql14);
    $stmt->execute();       //14.DAY7: 生活日記
    $rs14=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql15="SELECT account.id AS id, count(A4d) FROM `account` LEFT JOIN (SELECT * FROM `record` WHERE A4d='2020/12/16' and A7 IS NOT NULL and A8 IS NOT NULL and B IS NOT NULL) T1 on account.id=T1.id WHERE agree=1 GROUP BY account.id";
    $stmt=$db->prepare($sql15);
    $stmt->execute();       //15.DAY7: 接觸紀錄
    $rs15=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title>後台監看</title>
	<meta http-equiv="Content-Type" content="text/html"  charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="cache-control" content="no-cache">
    
	<!-- Bootsrap 4 CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="  crossorigin="anonymous"></script>
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
            width: 75%; margin: 40px auto;
            letter-spacing: 0.1em;
        }
        
        .modal-body{
            margin: 0px auto;
        }
        
        .tbl, hr{
            width: 3.5vmax; line-height: 0.5vmax;
            text-align: center;
        }
    </style>
</head>


<body>
	<?php include("header.php");?>
    <div id="loading"><img src="pic/ajax-spinner.gif" style="width: 10vmin"/><b>正在載入中 ...</b></div><br>
    
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">後台監看</h5>
        </div>
        <div class="modal-body">
            <div class="tbl" style="width: 7vmax; display: inline-block">
                姓名<hr>
                <?php foreach($rs1 as $r){?><?=$r["id"]?> <?=$r["name"]?><hr><?php }?>
            </div>
            
            <div class="tbl" style="display: inline-block">
                Ld10<hr>
                <?php foreach($rs2 as $r){?>
                    <?php if($r["count(date)"]==1){?>❤<hr>
                    <?php }else{?><span style="color: #FFFFFF">0</span><hr>
                    <?php }?>
                <?php }?>
            </div>
            
            <div class="tbl" style="display: inline-block">
                Cr10<hr>
                <?php foreach($rs3 as $r){?>
                    <?php if($r["count(A4d)"]>=10){?><?=$r["count(A4d)"]?><hr>
                    <?php }else if($r["count(A4d)"]>=1){?>0<?=$r["count(A4d)"]?><hr>
                    <?php }else{?><span style="color: #FFFFFF">0</span><hr>
                    <?php }?>
                <?php }?>
            </div>
            
            <div class="tbl" style="display: inline-block">
                Ld11<hr>
                <?php foreach($rs4 as $r){?>
                    <?php if($r["count(date)"]==1){?>❤<hr>
                    <?php }else{?><span style="color: #FFFFFF">0</span><hr>
                    <?php }?>
                <?php }?>
            </div>
            
            <div class="tbl" style="display: inline-block">
                Cr11<hr>
                <?php foreach($rs5 as $r){?>
                    <?php if($r["count(A4d)"]>=10){?><?=$r["count(A4d)"]?><hr>
                    <?php }else if($r["count(A4d)"]>=1){?>0<?=$r["count(A4d)"]?><hr>
                    <?php }else{?><span style="color: #FFFFFF">0</span><hr>
                    <?php }?>
                <?php }?>
            </div>
            
            <div class="tbl" style="display: inline-block">
                Ld12<hr>
                <?php foreach($rs6 as $r){?>
                    <?php if($r["count(date)"]==1){?>❤<hr>
                    <?php }else{?><span style="color: #FFFFFF">0</span><hr>
                    <?php }?>
                <?php }?>
            </div>
            
            <div class="tbl" style="display: inline-block">
                Cr12<hr>
                <?php foreach($rs7 as $r){?>
                    <?php if($r["count(A4d)"]>=10){?><?=$r["count(A4d)"]?><hr>
                    <?php }else if($r["count(A4d)"]>=1){?>0<?=$r["count(A4d)"]?><hr>
                    <?php }else{?><span style="color: #FFFFFF">0</span><hr>
                    <?php }?>
                <?php }?>
            </div>
            
            <div class="tbl" style="display: inline-block">
                Ld13<hr>
                <?php foreach($rs8 as $r){?>
                    <?php if($r["count(date)"]==1){?>❤<hr>
                    <?php }else{?><span style="color: #FFFFFF">0</span><hr>
                    <?php }?>
                <?php }?>
            </div>
            
            <div class="tbl" style="display: inline-block">
                Cr13<hr>
                <?php foreach($rs9 as $r){?>
                    <?php if($r["count(A4d)"]>=10){?><?=$r["count(A4d)"]?><hr>
                    <?php }else if($r["count(A4d)"]>=1){?>0<?=$r["count(A4d)"]?><hr>
                    <?php }else{?><span style="color: #FFFFFF">0</span><hr>
                    <?php }?>
                <?php }?>
            </div>
            
            <div class="tbl" style="display: inline-block">
                Ld14<hr>
                <?php foreach($rs10 as $r){?>
                    <?php if($r["count(date)"]==1){?>❤<hr>
                    <?php }else{?><span style="color: #FFFFFF">0</span><hr>
                    <?php }?>
                <?php }?>
            </div>
            
            <div class="tbl" style="display: inline-block">
                Cr14<hr>
                <?php foreach($rs11 as $r){?>
                    <?php if($r["count(A4d)"]>=10){?><?=$r["count(A4d)"]?><hr>
                    <?php }else if($r["count(A4d)"]>=1){?>0<?=$r["count(A4d)"]?><hr>
                    <?php }else{?><span style="color: #FFFFFF">0</span><hr>
                    <?php }?>
                <?php }?>
            </div>
            
            <div class="tbl" style="display: inline-block">
                Ld15<hr>
                <?php foreach($rs12 as $r){?>
                    <?php if($r["count(date)"]==1){?>❤<hr>
                    <?php }else{?><span style="color: #FFFFFF">0</span><hr>
                    <?php }?>
                <?php }?>
            </div>
            
            <div class="tbl" style="display: inline-block">
                Cr15<hr>
                <?php foreach($rs13 as $r){?>
                    <?php if($r["count(A4d)"]>=10){?><?=$r["count(A4d)"]?><hr>
                    <?php }else if($r["count(A4d)"]>=1){?>0<?=$r["count(A4d)"]?><hr>
                    <?php }else{?><span style="color: #FFFFFF">0</span><hr>
                    <?php }?>
                <?php }?>
            </div>
            
            <div class="tbl" style="display: inline-block">
                Ld16<hr>
                <?php foreach($rs14 as $r){?>
                    <?php if($r["count(date)"]==1){?>❤<hr>
                    <?php }else{?><span style="color: #FFFFFF">0</span><hr>
                    <?php }?>
                <?php }?>
            </div>
            
            <div class="tbl" style="display: inline-block">
                Cr16<hr>
                <?php foreach($rs15 as $r){?>
                    <?php if($r["count(A4d)"]>=10){?><?=$r["count(A4d)"]?><hr>
                    <?php }else if($r["count(A4d)"]>=1){?>0<?=$r["count(A4d)"]?><hr>
                    <?php }else{?><span style="color: #FFFFFF">0</span><hr>
                    <?php }?>
                <?php }?>
            </div>
            
            <div class="tbl" style="width: 7vmax; display: inline-block">
                總時數<hr>
                11<hr>06<hr>12<hr>06<hr>00<hr>12<hr>10<hr>07<hr>12<hr>12<hr>07<hr>06<hr>12<hr>11<hr>07<hr>12<hr>
                10<hr>00<hr>12<hr>11<hr>12<hr>09<hr>07<hr>11<hr>09<hr>12<hr>11<hr>12<hr>10<hr>12<hr>
            </div>
        </div>       
    </div>
    
	<?php include("footer.php");?>
</body>
</html>
