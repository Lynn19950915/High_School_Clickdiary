<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>高中生點日記FAQ</title>
	<meta http-equiv="Content-Type" content="text/html"  charset="utf-8">
	<meta http-equiv="cache-control" content="no-cache">
	<script src="https://code.jquery.com/jquery-3.1.1.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-3.1.1.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.min.js"></script>
	<style type="text/css">
		/*For nav and footer*/
		html {
			  position: relative;
			  min-height: 100%;
			}
			body {
			  /*Avoid nav bar overlap web content*/
			  padding-top: 70px; 
			  /* Margin bottom by footer height ，avoid footer overlap web content*/
			  margin-bottom: 60px;
			}
			.footer {
			  position: absolute;
			  bottom: 0;
			  width: 100%;
			  /* Set the fixed height of the footer here */
			  /*height: 60px;*/
			  /*line-height: 60px; */
			  /* Vertically center the text there */
			  background-color: #f5f5f5;
			  
			}
			.text{
				display: table-cell;
			    vertical-align: middle;
			    /*height: 100%;*/
			    font-size: 0.8em;
			    padding-top: 0.5em
			}
			#footerimg{
				float: left;
				height: 3em;
				padding-top: 0.5em;
			}
		/**/
		
		.container{
			
		}
		.panel-heading{
			font-size: 2.5rem;
		}

		.panel-body{
			font-size:1.2em;
			letter-spacing:0.25em;
			line-height:1.8em;
		}
		div>a{
			font-size:0.9em;
			letter-spacing:0em;
		}
		#quit_agree,#quit_delete{
			font-size:1.5em;
			height:4em;
			width:12em;
		}
		
		@media screen and (max-width: 550px) { 
			#quit_agree,#quit_delete{
				font-size:1em;
				// width:12em;
			}
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function(){
			

		})
	</script>
</head>
<body>
	<?php include("header_b3.php");?>
	<div class="container">
		<ul class="nav nav-tabs">
			<li class="active"> <a href="#1" data-toggle="tab">FAQ</a></li>
			<!-- <li><a href="#2" data-toggle="tab">參與者說明書</a></li> -->
			<!-- <li><a href="#3" data-toggle="tab">退出研究申請</a></li> -->
		</ul>
		<div class="tab-content ">
			<div class="tab-pane active" id="1">
				<div class="panel panel-primary" >
					<div class="panel-heading">請問怎樣才算是點日記要記錄的接觸呢？</div>
					<div class="panel-body">	
						點日記所要記錄的接觸或互動定義很廣泛，舉凡面對面、網路或電話，無論是一對一或多人，您都可以記錄跟其中一兩位朋友的交流。這種互動可以是社群媒體上的如臉書的私人訊息對話，或是Line的交流都算。為了收集高品質的研究資料，<span class="text-danger">請隔離者隔離期間平均每日至少記錄三筆人際互動、解除隔離後平均每日至少記錄五筆人際互動，請一般用戶平均每日至少記錄五筆人際互動</span>，才算符合補助標準喔！
					</div>
				</div>
				<div class="panel panel-primary" >
					<div class="panel-heading">請問如果我昨天忘了填寫點日記，今天可以補上昨天的紀錄嗎？</div>
					<div class="panel-body">	
						點日記在目前的設定下不行。因為點日記的出發點在於清楚記錄一天當中的人際互動與心情狀態，超過一天人們不容易回憶這些接觸與心情。因此我們建議填寫日記的時間以當天晚上睡前為主，這樣您的當天心情、一天接觸到的人、花在各種活動的時間分配都可以有比較清楚的紀錄。
					</div>
				</div>
				<div class="panel panel-primary" >
					<div class="panel-heading">如果我是隔離者，我可以選擇性的填寫隔離期間的生活紀錄與接觸紀錄嗎？</div>
					<div class="panel-body">	
						我們要求隔離或居家（機構）檢疫者在隔離期間每天填寫點日記，因為這段時間您每天所經歷的事件、心情變化、人際互動是我們關注的重點。假設您在居家檢疫第8天加入點日記，我們會要求您剩下的6天隔離期間每天填寫點日記，一個月累積達23天填寫才算滿足補助資格。
					</div>
				</div>
				<div class="panel panel-primary" >
					<div class="panel-heading">如果我在填寫期間發病了以致無法填寫，我還可以領取補助金嗎？</div>
					<div class="panel-body">	
						如果發生上述情形，請與我們的人員聯繫，我們會審核您的狀況給予部分補助。
					</div>
				</div>
				<div class="panel panel-primary" >
					<div class="panel-heading">如果我臨時想退出這項調查，我該如何終止，終止後是否還可以領取補助金？</div>
					<div class="panel-body">	
						如果您想終止參與本項調查，您只須停止更新日記即可，我們將不會採用您的資料。但您的資料已不符合補助條件，因此無法領取補助金。
					</div>
				</div>
				<div class="panel panel-primary" >
					<div class="panel-heading">該提供什麼資料來領取補助金呢？以及我何時能領到補助金？</div>
					<div class="panel-body">	
						待您達成補助條件後，我們會以簡訊方式通知您通過審核，並提供google表單連結，請您提供真實姓名、收件地址、身分證字號，來領取補助金。此外，本研究團隊會於每個月的月底結算補助名單，並以掛號信方式將補助金（商品禮券）寄至您的收件地址。
					</div>
				</div>
				<div class="panel panel-primary" >
					<div class="panel-heading">我是一名居家檢疫的參與者，萬一我在填寫日記期間不幸感染新冠肺炎，請問我還可以參加研究計畫填寫日記嗎？</div>
					<div class="panel-body">	
						根據中央研究院的研究倫理準則，本計畫無法進行確診病患的研究。如果您不幸染病，請您讓我們知道，我們希望您專心養病、儘速恢復健康，同時將終止您的參與，並依照您過去填寫的紀錄給予部分補償。
					</div>
				</div>
				<div class="panel panel-primary" >
					<div class="panel-heading">研究參與者說明書內提及推薦制度，請問我可以如何推薦？</div>
					<div class="panel-body">	
						本計畫目前尚未開放推薦制度，我們將視計畫進度與資料收集狀況，再行決定是否開放推薦制度。
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer class="footer">
  		<div class="container">
  			<img id="footerimg"src="./pic/Academia_Sinica_Emblem.png" >
		    <div class="text">
			著作權©中研院統計科學研究所. 版權所有.<br>
		    Copyright© Institute of Statistical Science, Academia Sinica.
		    All rights reserved.
		    </div>
		</div>
	</footer>
</body>
</html>