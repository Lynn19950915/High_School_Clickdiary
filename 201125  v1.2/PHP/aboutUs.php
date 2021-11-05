<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>關於我們</title>
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
            letter-spacing: 0.1em;
        }
        
        .agree{
            width: 70%; height: 70%; margin: 0px auto;
            display: block;
        }
        
        .agree:hover{
            transform: scale(1.2,1.2);
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
            
            .agree{
                width: 80%; height: 80%;
            }
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
            <p>「高中生點日記」是中央研究院社會學研究所與統計科學研究所的點日記研究團隊所開發，用以記錄在學期行進之間，高中生於其班級內之人際互動網絡、心情與健康行為等變化。本計畫名稱為「從自我核心網絡到完整網絡：部分及不一致接觸資料的推論設計」，已於 2020 年 2 月通過中央研究院倫理委員會之審查。<br><br>
            
            由自我核心網絡至完整網絡的推論，核心精神乃聚焦在獲取獨立之自我網絡數據，從中提取盡可能多的訊息，以此做模擬演算，並從而產生出一組與真實網絡特徵盡可能相近之網絡。這樣的重建過程會受到模型選擇、抽樣估計及網絡結構等變因影響，考量校園班級具備人數少、結構相對穩定且成員聯繫密集等特點，本計畫選擇高中班級作為研究對象。<br><br>
            
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
            <h5 class="modal-title">補助細則</h5>
        </div>
        <div class="modal-body">
            一、會員在研究期間於本平台執行各項活動後，可獲得點數獎勵，其積分公式如下：<br><br>
            <center>
                <b><span style="padding: 0.5%; background-color: #C4C400">總點數＝登入獎勵＋任務獎勵＋日記牆獎勵</span></b><br><br>
                會員當月所添加之點數，需滿足「當月有效會員」資格，方能獲得
            </center><br>
            
            二、獎勵項目細則<br>
            <div style="width: 94.5%; padding: 1% 1% 0% 1%; margin: 0px auto">
            <b>當月有效會員</b><br>
            同時完成「生活日記填寫」及「接觸紀錄新增」，視為一天有效日數，每月有效天數達 20 天（含）以上者，即判定為當月有效會員。<br>
            <span style="color: red">※注意：若未符合有效會員資格，當月將無法獲得任何點數。</span><br><br>
                                
            <b>登入獎勵</b><br>
            每日登入點日記系統即可獲得 20 點積分。此點數為即時性發放、單日以領取一次為限。<br><br>
            
            <b>任務獎勵</b><br>
            包含快問快答及問卷兩大類（可參見<a href="./mission.php">任務專區</a>）。此點數為即時性發放、單項任務以領取一次為限。<br>
            ⭗完成每題快問快答可獲得 40 點積分，每份問卷依照長度可獲得 400 點以上之不等積分。<br>
            <span style="color: red">※注意：各項任務均有完成期限，逾期無法重新補填，亦不可重複作答，請把握時間完成！</span><br><br>
                
            <b>日記牆獎勵</b><br>
            包含接觸紀錄筆數及班級團體加成兩方面核算。此點數為月度性結算，統一於次月 5 日進行點數發放。<br>
            
            ⭗接觸紀錄筆數：系統將以「當月累計接觸筆數」將該月有效會員進行高低排序，依結果予以分段化回饋。<br><br>
            <center><table style="border: 1px solid #C4C400; font-size: 0.9em; text-align: center">
                <tr style="background-color: #C4C400">
                    <td style="width: 40%">當月總體有效會員之</td>
                    <td style="width: 15%">前 15 ％</td>
                    <td style="width: 15%">16~50 ％</td>
                    <td style="width: 15%">51~85 ％</td>
                    <td style="width: 15%">後 15 ％</td>
                </tr>
                <tr>
                    <td style="width: 40%">日記牆獎勵</td>
                    <td style="width: 15%">30000</td>
                    <td style="width: 15%">20000</td>
                    <td style="width: 15%">15000</td>
                    <td style="width: 15%">10000</td>
                </tr>
            </table></center><br>
            
            ⭗班級團體加成：若當月有效會員達班級總人數 30％（含）以上者，該班有效會員之當月日記牆獎勵可獲得 10％ 加成；達 50％（含）以上者，獲得 20％ 加成。<br>
            </div><br>
            
            三、會員可於<a href="./myPoint.php">積分專區</a>查看個人之點數明細；攸關月結算資格的「當月有效天數」及「當月累計接觸筆數」等資訊，則可在<a href="./main.php">日記牆</a>上查看。所有之積分點數將於研究結束後統一進行核算，每 20 點獎勵點數可換得新台幣 1 元整。<br><br>
            
            四、本平台同時也將舉辦每月抽獎活動，獎項包括 Apple Watch SE（市值 9900 元）、AirPods 2（市值 5290 元）及富士 instax mini 9 拍立得（市值 2190 元）等，相關訊息敬請關注<a href="./main.php">最新消息</a>。<br><br>
            
            五、為鼓勵會員參與，凡全程參與本研究活動者將獲得由中研院社會所開立之「學習時數認證」，共一學期四個月、計 80 小時。<br><br>
            
            <div style="font-size: 0.75em">
            ※會員參與本研究之同時，即視為同意接受本活動之規範，如有違反、或有任何以詐騙方式或其他足以破壞本活動之不法行徑，應負一切相關責任。<br>
            ※本研究活動有任何因電腦、網路、技術或其他不可歸責於單位之事由，而使會員所登錄之資料有所遺失、錯誤或無法辨識所導致資料無效之情況，本單位不負任何法律責任。為求公平公正，會員若以惡意之電腦程式或其他明顯違反活動公平性之方式，意圖混淆或影響結果者，一經單位察覺得立即取消會員之參與及補助資格，並保留法律追訴權力。<br>
            ※本單位對上述細則內容保有最終解釋權，以及隨時修改、暫停或終止研究活動之權利，如有變動將公告於活動網頁。
            </div>
        </div>
    </div>

    <?php include("footer.php");?>
</body>
</html>
