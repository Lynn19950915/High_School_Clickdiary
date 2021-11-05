<?php
    session_start();
    include "db.php";

    if($_SESSION["acc_info"]["id"]==null){
        header("Location: ./index.php");  //0.登入後查看
	}
    $id=$_SESSION["acc_info"]["id"];
?>

<!DOCTYPE html>
<html>
<head>
	<title>任務專區</title>
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
        .wrapper{
            width: 70%; margin: 40px auto;
            text-align: center; letter-spacing: 0.05em;
        }        
        
        /* DETAILED */
        #remind{
            margin: 0px auto;
            font-size: 1.2em; letter-spacing: 0.05em; text-align: center;
        }
        
        #record1{
            width: 15%;
            display: inline-block; text-align: center;
        }
        
        #record2{
            width: 25%;
            display: inline-block; text-align: center;
        }
        
        /* RESPONSIVE */
		@media screen and (max-width: 550px){       
            .wrapper{
                width: 95%; line-height: 80%;
                font-size: 0.8em;
            }
            
            #remind{
                font-size: 0.8em;
            }
            
            #record1, #record2{
                width: 90%; margin: 1em auto;
                display: block;
            }
		}        
    </style>
</head>


<body>
    <?php include("header.php");?>
    <p id="remind" style="color: red"><b>請注意：每份任務均有填答期限，敬請把握時間完成，即可獲得積分！</b></p>
    
	<div class="wrapper">
        <div>
            <div id="record1">編號</div>
            <div id="record2">任務</div>                 
            <div id="record1">報酬</div>                   
            <div id="record1">作答期限</div>                   
            <div id="record1">連結</div>
        </div><hr>
    </div>
    
    <?php include("footer.php");?>
</body>
</html>
