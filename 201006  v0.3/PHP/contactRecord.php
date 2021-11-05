<?php
	session_start();
    include "db.php";

    if($_SESSION["acc_info"]["id"]==null){
        header("Location: ./index.php");  //0.登入後查看
	}
    $id=$_SESSION["acc_info"]["id"];
    $class=$id[0];

    //利用id首位數(或除以100取商)列出同學
    $sql1="SELECT * FROM `account` WHERE id LIKE '$class%'";
    $stmt=$db->prepare($sql1);
    $stmt->execute();                     //1.A0:列出班級成員清單
    $rs1=$stmt->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_POST["A0"])){
        $A0M=$_POST["A0"];  $A0=implode(",", $A0M);
        $A1=$_POST["A1"];
        $A2=$_POST["A2"];
        $A3=$_POST["A3"];
        $A4=$_POST["A4"];
        $A5=$_POST["A5"];
        $A6=$_POST["A6"];
        $A7=$_POST["A7"];
        $A8=$_POST["A8"];
        $A9=$_POST["A9"];
        
        echo "ContactRecord Success";
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>接觸紀錄</title>
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
            letter-spacing: 0.05em;
        }
        
        .modal-header{
            background-color: #C4C400;
        }
        
        .modal-body{
            text-align: center;
        }
        
        /* DETAILED */
        label{
            width: 14%;
        }
        
        label:hover{
            background-color: #C4C400;
        }
        
        input{
            width: 12%;
        }
        
        select{
            width: 24%;
        }
    
        #submit{
            width: 40vmin;
            color: #f0f0f0; background-color: #C4C400;
            -webkit-border-radius: 40px; border-radius: 40px;
        }
            
        /* RESPONSIVE */
		@media screen and (max-width: 550px){
            .modal-content{
                width: 80%; margin: 20px auto;
                font-size: 0.8em;
            }
            
            .modal-body{
                text-align: left;
            }
            
            .modal-body#A4, .modal-body#A5, .modal-body#A6{
                text-align: center;
            }
            
            #submit{
                font-size: 0.8em;
            }
            
            h5{
                font-size: 1.1em;
            }
            
            label{
                width: 40%; margin-left: 5%;
            }
            
            select{
                width: 30%;
            }
		}       
    </style>
    
    <script>
		$(document).ready(function(){                       
            $("#contactRecord").on("submit", function(event){
                event.preventDefault();
                check();
                
                $.ajax({
                    type: "POST",
                    url: "",
                    data: $("form#contactRecord").serialize(),
                    success: function(data){
                        console.log("ContactRecord", data);
                        if(data=="ContactRecord Success"){
                            $.confirm({
                                title: "",
                                content: "接觸紀錄寫入成功！",
                                buttons: {
                                    "OK": function(){
                                        window.location.href="./main.php";
                                    }
								}
                            })
                        }
                    }, error: function(){
                        console.log(e);
                    }
                })
                
                function check(){
                    var cA0M=getValueM("A0[]");
                    var cA1 =getValue("A1");
                    var cA2 =getValue("A2");
                    var cA3 =getValue("A3");
                    var cA4 =$("#cA4").val();
                    var cA5 =document.contactRecord.A5.value;
                    var cA6 =document.contactRecord.A6.value;
                    var cA7 =getValue("A7");
                    var cA8 =getValue("A8");
                    var cA9 =getValue("A9");
                                        
                    var record=[], j=0;
                    if(cA0M==0){record[j]="A0"; j++}
                    if(cA1==0){record[j]="A1"; j++}
                    if(cA2==0){record[j]="A2"; j++}
                    if(cA3==0){record[j]="A3"; j++}
                    if(cA4==""){record[j]="A4"; j++}
                    if(cA5==0){record[j]="A5"; j++}
                    if(cA6==0){record[j]="A6"; j++}
                    if(cA7==0){record[j]="A7"; j++}
                    if(cA8==0){record[j]="A8"; j++}
                    if(cA9==0){record[j]="A9"; j++}

                    if(j>0){
                        alert("您好，第"+record+"題尚未填答完畢唷！");
                        return false;
                    }else{
                        return true;
                    }
                }
                
                function getValue(name){
                    var items=document.getElementsByName(name);
                    
                    for(var i=0, iLen=items.length; i<iLen; i++){
                        if(items[i].checked){
                            //return代表結束執行(單選只有一個答案)
                            return items[i].value;
                        }
                    }
                    //所有選項都沒選，才會運行至此
                    return 0;
                }

                function getValueM(name){
                    var items=document.getElementsByName(name);
                    
                    var record=[], j=0;
                    for(var i=0, iLen= items.length; i<iLen; i++){
                        if(items[i].checked){
                            //不return，要跑完迴圈收所有答案(多選不限項數)
                            record[j]=items[i].value;
                            j++; 
                        }
                    }
                    if(j>0){
                        return record;
                    }else{
                        return 0;
                    }
                }              
            })
        })
    </script>
</head>


<body>
    <?php include("header.php");?>
    
    <form id="contactRecord" name="contactRecord">        
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>A0. 我和哪（幾）位同學有接觸互動：</b></div>
        </div>
        <div class="modal-body" style="text-align: left">
            <fieldset data-role="controlgroup" data-type="horizontal">
                <?php foreach($rs1 as $r){?>
                    <label style="margin-left: 5%"><input type="checkbox" name="A0[]" value="<?=$r["id"]?>">
                    <?=$r["id"][1]?><?=$r["id"][2]?>號 <?=$r["name"]?>
                    </label>
                <?php }?>
            </fieldset>
        </div>
    </div>
    
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>A1. 這次互動的主要目的或內容：</b></div>
        </div>
        <div class="modal-body">
            <fieldset data-role="controlgroup" data-type="horizontal">
                <label><input type="radio" name="A1" value="1">課業</label>
                <label><input type="radio" name="A1" value="2">社交聊天</label>
                <label><input type="radio" name="A1" value="3">運動</label>
                <label><input type="radio" name="A1" value="4">休閒育樂</label>                    
                <label><input type="radio" name="A1" value="5">其他</label>
            </fieldset>
        </div>
    </div>
        
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>A2. 這次互動主要由誰發起：</b></div>
        </div>
        <div class="modal-body">
            <fieldset data-role="controlgroup" data-type="horizontal">
                <label><input type="radio" name="A2" value="1">自己</label>
                <label><input type="radio" name="A2" value="2">對方</label>
                <label><input type="radio" name="A2" value="3">雙方約定</label>
                <label><input type="radio" name="A2" value="4">偶然相遇</label>
                <label><input type="radio" name="A2" value="5">其他人</label>
            </fieldset>
        </div>
    </div>
        
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>A3. 這次互動的主要方式：</b></div>
        </div>
        <div class="modal-body">
            <fieldset data-role="controlgroup" data-type="horizontal">
                <label><input type="radio" name="A3" value="1">見面</label>
                <label><input type="radio" name="A3" value="2">視訊</label>
                <label><input type="radio" name="A3" value="3">即時語音通話</label>
                <label><input type="radio" name="A3" value="4">傳文字或錄音</label>
            </fieldset>
        </div>
    </div>
        
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>A4.這次互動的開始時間：（請輸入整數）</b></div>
        </div>
        <div class="modal-body" id="A4">
            <input style="width: 24%; text-align: center" name="A4" id="cA4" type="number" min="0" max="23">
        </div>
    </div>
        
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>A5. 這次互動大概多久：</b></div>
        </div>
        <div class="modal-body" id="A5">
            <select class="std" name="A5">
                <option value="0"></option>  
                <option value="1">少於一分鐘</option>
                <option value="2">1-4分鐘</option>
                <option value="3">5-14分鐘</option>
                <option value="4">15-59分鐘</option>
                <option value="5">1-4小時</option>
                <option value="6">大於4小時</option>
            </select>
        </div>
    </div>
        
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>A6. 這次互動，我在哪裡：</b></div>
        </div>
        <div class="modal-body" id="A6">
            <select class="std" name="A6">
                <option value="0"></option>  
                <option value="1">校內</option>
                <option value="2">自己住處／家裡</option>
                <option value="3">對方住處／家裡</option>
                <option value="4">交通工具</option>
                <option value="5">補習班</option>
                <option value="6">校外餐廳</option>
                <option value="7">校外圖書館</option>
                <option value="8">校外娛樂場所</option>
                <option value="9">其他</option>
            </select>
        </div>
    </div>
        
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>A7. 這次互動<u>前</u>，我的心情：</b></div>
        </div>
        <div class="modal-body">
            <fieldset data-role="controlgroup" data-type="horizontal">
                <label><input type="radio" name="A7" value="1">很不好</label>
                <label><input type="radio" name="A7" value="2">有點不好</label>
                <label><input type="radio" name="A7" value="3">普通</label>
                <label><input type="radio" name="A7" value="4">有點好</label>
                <label><input type="radio" name="A7" value="5">很好</label>
            </fieldset>
        </div>
    </div>
        
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>A8. 這次互動<u>後</u>，我的心情：</b></div>
        </div>
        <div class="modal-body">
            <fieldset data-role="controlgroup" data-type="horizontal">
                <label><input type="radio" name="A8" value="1">很不好</label>
                <label><input type="radio" name="A8" value="2">有點不好</label>
                <label><input type="radio" name="A8" value="3">普通</label>
                <label><input type="radio" name="A8" value="4">有點好</label>
                <label><input type="radio" name="A8" value="5">很好</label>
            </fieldset>
        </div>
    </div>

    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>A9. 這次互動<u>後</u>，我覺得我有情感以外的收穫：</b></div>
        </div>
        <div class="modal-body">
            <fieldset data-role="controlgroup" data-type="horizontal">
                <label><input type="radio" name="A9" value="1">有很大的損失</label>
                <label><input type="radio" name="A9" value="2">有一點損失</label>
                <label><input type="radio" name="A9" value="3">沒有變</label>
                <label><input type="radio" name="A9" value="4">有一點收穫</label>
                <label><input type="radio" name="A9" value="5">有很大的收穫</label>
            </fieldset>
        </div>
    </div>                       
        
    <center>
        <div><button id="submit" class="btn" type="submit">完成</button></div>
    </center>
    </form>
 
    <?php include("footer.php");?>
</body>
</html>
