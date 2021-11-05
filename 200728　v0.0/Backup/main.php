<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>高中生點日記</title>
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
	<!-- Fontawesome CDN -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<!-- SelectPicker -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
	<!-- Lodash -->
	<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.11/lodash.min.js"></script>
	<!-- React -->
	<script src="https://cdn.staticfile.org/react/16.4.0/umd/react.development.js"></script>
	<script src="https://cdn.staticfile.org/react-dom/16.4.0/umd/react-dom.development.js"></script>
	<script src="https://cdn.staticfile.org/babel-standalone/6.26.0/babel.min.js"></script>
    
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
		  margin-bottom: 80px;
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
		/* Table */
		th{
			font-weight:400
		}
		.table>tbody>tr>td {
			vertical-align:middle;
			padding-left:0;
			padding-right:0
		}
		.table{
			width:100%
		}

		#tbl_profile>tbody>tr>td{
			width: 50%;
		}

		/* */
		.btn {
		  border: 2px solid;
		  /*background-color: white;*/
		  /*color: black;*/
		  cursor: pointer;
		}
		.btn-lg{
			font-size:1.2em;
			margin: 1em;
		}
		.container{
			padding-left:1px;
			padding-right:1px;
		}
		
		.card-body {
			padding: 1rem 1rem 0 1rem;
			/*padding: 1em 0.05em;*/
		}

		.text-justify{
			letter-spacing: 0.2em;
			font-size:1.2em;
			padding-left:1em;			
			line-height:2em;
		}

		/* btn-outling */
		/* Green */
		.success {
		  border-color: #4CAF50;
		  color: green;
		}

		.success:hover {
		  background-color: #4CAF50;
		  color: white;
		}

		/* Blue */
		.info {
		  border-color: #2196F3;
		  color: dodgerblue
		}

		.info:hover {
		  background: #2196F3;
		  color: white;
		}

		/* Orange */
		.warning {
		  border-color: #ff9800;
		  color: orange;
		}

		.warning:hover {
		  background: #ff9800;
		  color: white;
		}

		/* Red */
		.danger {
		  border-color: #f44336;
		  color: red
		}

		.danger:hover {
		  background: #f44336;
		  color: white;
		}

		/* Gray */
		.default {
		  border-color: #e7e7e7;
		  color: black;
		}

		.default:hover {
		  background: #e7e7e7;
		}
		.jc-bs3-row row justify-content-md-center justify-content-sm-center justify-content-xs-center justify-content-lg-center{
			width: 90vw;
		}
		/* ---------------------------------------------------- */
		.carousel-control-next,
		.carousel-control-prev,
		.carousel-indicators {
		    filter: invert(100%);
		}
		.carousel-inner{
			padding-bottom: 3em;
		}

		.carousel-control-prev,
		.carousel-control-next{
		    align-items: flex-end;
		    bottom: 10px !important;
		}
		/* ---------------------------------------------------- */
		/* Adjust For mobile */
		@media screen and (max-width: 550px) {
			body{
				padding: 70px 0.5em 0 0.5em;
			}
			.text-justify{
				padding-left:0.5em;
			}
			.news{
				font-size:1.3em;
			}
			.card-body{
				padding-left: 0.2em;
				padding-right: 0.2em;
			}

			.card-footer {
				padding: 0.25rem !important;
			}

			.btn.btn-lg {
				width: 9.5rem;
				height: 8rem;
				margin: 0.5rem;
			}



		}

		/* 排行榜 */
		@media screen and (min-width: 1280px) {
			.card {
				width: 95%;
				margin: 1rem;
			}

			.container {
				display: flex;
			}

			.jc-bs3-container.container {
				display: block;
			}
		}
		.card-footer {
		    /*padding: 10px 15px;*/
		    padding: 0 1rem;
		    background-color: transparent;
		    border: none;
		    /*border-top: 0 solid #fff;*/
		    /*border-bottom-right-radius: 3px;*/
		    /*border-bottom-left-radius: 3px;*/
		}
	</style>
	
</head>
<body>
    <?php include_once("header.php");?>
	<div class="container">
		<div class="card border-danger mb-1">
			<div class="card-header text-white bg-danger pt-1 pb-1">最新快訊</div>
			<div class="card-body pb-1 pl-4 pr-4" style="line-height: 1.6em; letter-spacing: 0.1em;">
				<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" data-interval="5000">
				  <ol class="carousel-indicators">
				    <li data-target="#carouselExampleCaptions" data-slide-to="0"></li>
				  </ol>
				  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
				    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
				    <span class="carousel-control-next-icon" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a>
				  <div class="carousel-inner">
				  	<div class="carousel-item active">
                        <p align="center">內容待補</p>
					</div>
				  </div>				  
				</div>
			</div>
			<div class="card-footer">
				<div class="text-center"></div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="card border-success mb-1">
			<div class="card-header text-white bg-success">會員護照</div>
			<div class="card-body">
				<table id="tbl_profile" class="table table-sm">內容待補</table>
			</div>
			<div class="card-footer">
				<div class="text-center">				  	
				</div>
			</div>
		</div>
		<div class="card border-primary mb-1">
			<div class="card-header text-white bg-primary">任務專區</div>
			<div class="card-body">
				<table id="tbl_diary_summary" class="table table-sm">內容待補</table>
			</div>
			<div class="card-footer">
				<div class="text-center" >
				</div>
			</div>
			<div class="card-footer">
				
			</div>
		</div>
	</div>

	<footer class="footer">
  		<div>
  			<img id="footerimg" src="./pic/Academia_Sinica_Emblem.png" >
		    <div class="text">
			著作權©中研院統計科學研究所. 版權所有.<br>
		    Copyright© Institute of Statistical Science, Academia Sinica.
		    All rights reserved.
		    </div>
		</div>
	</footer>
</body>
</html>