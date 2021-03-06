<?php
    session_start();
    include "db.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>ĉççİċ</title>
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
        .container{
            display: flex; letter-spacing: 0.05em;
        }
        
        .wrapper1{
            width: 20%; height: 100%; border: 2px solid; padding: 2em 0; margin: 1em auto;
            font-size: 1.2em; text-align: center; flex-direction: column;
            -webkit-border-radius: 20px; border-radius: 20px;
		}
        
        .wrapper2{
            width: 70%; margin: 1em auto;
            text-align: center;
        }
        
        /* DETAILED */        
        .circleWrap{
            width: 160px; height: 80px;
            display: inline-block; position: relative;
        }
        
        .circle{
            height: 100%; border: 0.4em solid #C4C400;
            border-radius: 5%;
        }
                
        .point{
            width: 100%; line-height: 80px; top: 0; left: 0;
            font-size: 1.8em; font-weight: bold; text-align: center; position: absolute;
        }
               
        #record1{
            width: 30%; 
            font-size: 0.9em; text-align: center; display: inline-block;
        }
        
        #record2{
            width: 40%; 
            font-size: 0.9em; text-align: center; display: inline-block;
        }
       
        #record3{
            width: 15%;
            text-align: center; display: inline-block;
        }
        
        /* RESPONSIVE */
		@media screen and (max-width: 550px){ 
            .container{
				display: block;
			}
            
            .wrapper1{
                width: 60%; line-height: 120%; padding: 1.5em 0em 1em 0em;
                font-size: 1em;
            }
            
            .circleWrap{
                width: 120px; height: 60px;
            }
            
            .wrapper2{
                width: 100%; line-height: 100%; margin: 1em auto;
            }
            
            .point{
                line-height: 60px;
                font-size: 1.5em;
            }
            
            #record1, #record2, #record3{
                width: 80%; padding: 1.5% 1%;
            }
            
            #record2{
                background-color: #C4C400;
            }            
		}
    </style>
</head>


<body>
    <?php include("header.php");?>
    
	<div>
        <div class="container">
            <div class="wrapper1">
                <p style="width: 100%; background-color: #C4C400">ĉċĦç·¨è<b>101</b></p>
                
                <div style="margin: 0.4em auto">ċċç´Żçİ</div>
                <div class="circleWrap">
                    <div class="circle"></div>
                    <div class="point">200</div>
                </div>
                    
                <div style="margin: 0.4em auto">ĉĴĉçİċ</div>
                <div class="circleWrap">
                    <div class="circle" style="border: 0.4em solid red"></div>
                    <div class="point">50</div>
                </div>
            </div>    
            
            <div class="wrapper2">
                <div>
                    <div id="record1">ĉé</div> 
                    <div id="record2">é ç?</div>              
                    <div id="record3">+/-</div>
                </div>
	       </div>
        </div>
    </div>
    
    <?php include("footer.php");?>
</body>
</html>
