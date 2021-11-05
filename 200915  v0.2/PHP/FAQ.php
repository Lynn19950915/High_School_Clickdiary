<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>常見問題</title>
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
        
        .modal-header{
            background-color: #C4C400;
        }
        
        /* RESPONSIVE */
		@media screen and (max-width: 550px){
            .modal-content{
                width: 80%; margin: 20px auto;
                font-size: 0.8em;
            }
        }
    </style>
</head>


<body>
	<?php include("header.php");?>

    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>1. 請問怎樣才算是點日記要記錄的接觸呢？</b></div>
        </div>
        <div class="modal-body">
            <p>點日記所要記錄的接觸或互動定義很廣泛，舉凡面對面、網路或電話，無論是一對一或多人，你都可以記錄跟其中一兩位朋友的交流，這種互動可以是社群媒體上的如臉書的私人訊息對話，或是Line的交流都算。請特別注意：<b>本研究聚焦在班級的互動網絡，故只需紀錄「（包含）班級成員」之接觸互動即可。</b></p>
        </div>
    </div>
    
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>2. 我今天有和很多同學接觸互動，是不是在記錄時要一次將他們全都勾選起來呢？</b></div>
        </div>
        <div class="modal-body">
            <p>不是。接觸是以「單次互動」為記錄的單位，意即<b>同一時間、地點下的接觸才可計入同筆資料。</b>若你同時和許多位同學聊天，可一併勾選；但若是在不同時間與許多位同學互動，則需要分開數筆進行新增填寫喔！</p>
        </div>
    </div>
    
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>3. 有些任務顯示「已逾期」了，請問現在還來得及補做嗎？</b></div>
        </div>
        <div class="modal-body">
            <p>不可以。本團隊所發佈之任務常涉及研究前、後期對照或時序性追蹤，因此時間非常重要，<b>逾期者恕無法提供補答。</b></p>
            <p>我們在任務發佈的同時會述明任務的作答期限，你也能在日記牆的「最新消息」區獲得相關資訊，建議你
                養成經常登入的習慣，才不會錯過研究的第一手資訊喔！</p>
        </div>
    </div>  
        
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>4. 請問何時會收到研究補助金呢？是否需提供任何資料？</b></div>
        </div>
        <div class="modal-body">
            <p>本團隊將在研究結束後進行補助金的核算作業，預計將會以現金方式匯款。屆時將以你的註冊帳號（信箱）發送通知信件及google表單連結，再請你提供所需之個人訊息，俾利補助金之核發。</p>
        </div>
    </div>    
    
	<?php include("footer.php");?>
</body>
</html>
