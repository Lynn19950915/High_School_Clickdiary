<?php
	session_start();
    include "db.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>關於我們</title>
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
        
        .agree{
            width: 70%; height: 70%; margin: 0px auto;
            display: block;
        }
        
        .agree:hover{
            transform: scale(1.2,1.2)
        }
        
        /* RESPONSIVE */
		@media screen and (max-width: 550px){
        .modal-content{
            width: 80%; margin: 20px auto;
            font-size: 0.8em;
        }

        h5{
            font-size: 1.1em
        }

        .agree{
            width: 80%; height: 80%;
        }
    </style>
</head>

    
<body>
	<?php include("header.php");?>

    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">計畫簡介</h5>
        </div>
        <div class="modal-body">
            <p>「高中生點日記」是中央研究院社會學研究所與統計科學研究所的點日記研究團隊所開發，用以記錄在學期行進之間，高中生於其班級內之人際互動網絡、心情與健康行為等變化。本計畫名稱為「從自我核心網絡到完整網絡：部分及不一致接觸資料的推論設計」，已於 2020 年 2 月通過中央研究院倫理委員會之審查。
            <br><br>
            由自我核心網絡至完整網絡的推論，核心精神乃聚焦在獲取獨立之自我網絡數據，從中提取盡可能多的訊息，以此做模擬演算，並從而產生出一組與真實網絡特徵盡可能相近之網絡。這樣的重建過程會受到模型選擇、抽樣估計及網絡結構等變因影響，考量校園班級具備人數少、結構相對穩定且成員聯繫密集等特點，本計畫選擇高中班級作為研究對象。
            <br><br>
            有別於過往「關係」導向的探問策略，本計畫從「接觸互動」的面向入手，透過接觸記錄、生活日誌等資料的填報，除了能檢證上述「由自我核心網路推衍班級網絡」的完整度與可行性；更可加上時間維度，在時序性的比較基礎下勘測學生在人際互動過程中，既產生了哪些心情、健康層面的影響，連帶又對自我乃至班級整體的互動網絡帶來什麼樣的動態變化。</p>
        </div>
    </div>
        
   <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">受試者同意書</h5>
        </div>
        <div class="modal-body">
            <img class="agree" src="./pic/agree.png">
        </div>
    </div>
        
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">獎勵細則</h5>
        </div>
        <div class="modal-body">
            內容待補
        </div>
    </div>

    <?php include("footer.php");?>
</body>
</html>
