<?php
	session_start();
    include "db.php";

    if($_SESSION["acc_info"]["id"]==null){
        header("Location: ./index.php");  //0.登入後查看
	}
    $id=$_SESSION["acc_info"]["id"];
    $class=$id[0];
    $hour=date("H");

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
        
        if($A4>23 or $A4<0 or floor($A4)-$A4!=0){
            echo "Wrong A4";             //a.輸入錯誤(超過範圍、小數)
        }else if($A4>$hour){
            echo "Invalid A4";           //b.輸入無效(未來時間)
        }else{
            if(count($A0M)==1){
                $sql2="INSERT INTO `record`(id, time, `groups`, A0, A1, A2, A3, A4, A5, A6, A7, A8, A9) VALUES(:v1, CURTIME(), 0, :A0, :A1, :A2, :A3, :A4, :A5, :A6, :A7, :A8, :A9)";
                $stmt=$db->prepare($sql2);
                $stmt->bindParam(":v1", $id);
                $stmt->bindParam(":A0", $A0M[0]);
                $stmt->bindParam(":A1", $A1);
                $stmt->bindParam(":A2", $A2);
                $stmt->bindParam(":A3", $A3);
                $stmt->bindParam(":A4", $A4);
                $stmt->bindParam(":A5", $A5);
                $stmt->bindParam(":A6", $A6);
                $stmt->bindParam(":A7", $A7);
                $stmt->bindParam(":A8", $A8);
                $stmt->bindParam(":A9", $A9);
                
                $stmt->execute();       //2.單一對象接觸(groups=0)                
            }else{
                $i=0;
                while($i<count($A0M)){
                    $sql3="INSERT INTO `record`(id, time, `groups`, A0, A1, A2, A3, A4, A5, A6, A7, A8, A9) VALUES(:v1, CURTIME(), 1, :A0, :A1, :A2, :A3, :A4, :A5, :A6, :A7, :A8, :A9)";
                    $stmt=$db->prepare($sql3);
                    $stmt->bindParam(":v1", $id);
                    $stmt->bindParam(":A0", $A0M[i]);
                    $stmt->bindParam(":A1", $A1);
                    $stmt->bindParam(":A2", $A2);
                    $stmt->bindParam(":A3", $A3);
                    $stmt->bindParam(":A4", $A4);
                    $stmt->bindParam(":A5", $A5);
                    $stmt->bindParam(":A6", $A6);
                    $stmt->bindParam(":A7", $A7);
                    $stmt->bindParam(":A8", $A8);
                    $stmt->bindParam(":A9", $A9);

                    $stmt->execute();   //3.多對象(團體)接觸(groups=1)，利用迴圈逐筆建立
                    $i++;
                }
            }
            echo "PartA Success";   
        }
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>接觸紀錄 A</title>
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
        #remind{
            margin: 0px auto;
            font-size: 1.2em; letter-spacing: 0.05em; text-align: center;
        }
        
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
    
        #submitA{
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
            
            #remind, #submitA{
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
            $("#submitA").on("click", function(event){
                event.preventDefault();
                check();
                
                $.ajax({
                    type: "POST",
                    url: "",
                    data: $("form#contactRecordA").serialize(),
                    success: function(data){
                        console.log("ContactRecordA", data);
                        if(data=="Wrong A4"){
                            $.alert({
                                title: "",
                                content: "無效答覆：請輸入合理的整數。"
                            })
                        }else if(data=="Invalid A4"){
                            $.alert({
                                title: "",
                                content: "無效答覆：請不要填寫還沒到的時間。"
                            })
                        }else if(data=="PartA Success"){
                            window.location.href="./contactRecordB.php";
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
                    var cA5 =document.contactRecordA.A5.value;
                    var cA6 =document.contactRecordA.A6.value;
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
    <p id="remind" style="color: red"><b>請注意：同一時間、地點下的接觸才可計入同筆資料，否則請分開數筆填寫！</b></p>
    
    <form id="contactRecordA" name="contactRecordA">
    <div class="modal-content" style="border: none">
        <h5 style="text-align: right"><b>記錄日期：<?=date("Y-m-d")?></b></h5>
    </div>
    
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>A0. 我和哪（幾）位同學有接觸互動：（可複選）</b></div>
        </div>
        <div class="modal-body" style="text-align: left">
            <fieldset data-role="controlgroup" data-type="horizontal">
                <?php foreach($rs1 as $r){?>
                    <?php if($r["id"]==$id){?>
                    <label style="margin-left: 5%"><input type="checkbox" name="A0[]" value="<?=$r["id"]?>" disabled="disabled">
                    <?=$r["id"][1]?><?=$r["id"][2]?>號 <?=$r["name"]?>
                    </label>
                    <?php }else{?>
                    <label style="margin-left: 5%"><input type="checkbox" name="A0[]" value="<?=$r["id"]?>">
                    <?=$r["id"][1]?><?=$r["id"][2]?>號 <?=$r["name"]?>
                    </label>
                    <?php }?>
                <?php }?>
            </fieldset>
        </div>
    </div>
    
    <div class="modal-content" style="font-size: 1em">
        <div class="modal-body" style="margin-bottom: -10px">
            <div style="text-align: left">以下問題針對<b>本次接觸之所有成員</b></div>
        </div>

        <div class="modal-content" style="width: 100%; margin: 10px auto">
            <div class="modal-header">
                <div class="modal-title"><b>A1. 這次互動的主要目的或內容：</b></div>
            </div>
            <div class="modal-body">
                <fieldset data-role="controlgroup" data-type="horizontal">
                    <label><input type="radio" name="A1" value="課業">課業</label>
                    <label><input type="radio" name="A1" value="社交聊天">社交聊天</label>
                    <label><input type="radio" name="A1" value="運動">運動</label>
                    <label><input type="radio" name="A1" value="休閒育樂">休閒育樂</label>                    
                    <label><input type="radio" name="A1" value="其他">其他</label>
                </fieldset>
            </div>
        </div>

        <div class="modal-content" style="width: 100%; margin: 10px auto">
            <div class="modal-header">
                <div class="modal-title"><b>A2. 這次互動<u>主要</u>由誰發起：</b></div>
            </div>
            <div class="modal-body">
                <fieldset data-role="controlgroup" data-type="horizontal">
                    <label><input type="radio" name="A2" value="自己">自己</label>
                    <label><input type="radio" name="A2" value="對方">對方</label>
                    <label><input type="radio" name="A2" value="雙方約定">雙方約定</label>
                    <label><input type="radio" name="A2" value="偶然相遇">偶然相遇</label>
                    <label><input type="radio" name="A2" value="其他人">其他人</label>
                </fieldset>
            </div>
        </div>

        <div class="modal-content" style="width: 100%; margin: 10px auto">
            <div class="modal-header">
                <div class="modal-title"><b>A3. 這次互動的<u>主要</u>方式：</b></div>
            </div>
            <div class="modal-body">
                <fieldset data-role="controlgroup" data-type="horizontal">
                    <label><input type="radio" name="A3" value="見面">見面</label>
                    <label><input type="radio" name="A3" value="視訊">視訊</label>
                    <label><input type="radio" name="A3" value="即時語音通話">即時語音通話</label>
                    <label><input type="radio" name="A3" value="傳文字或錄音">傳文字或錄音</label>
                </fieldset>
            </div>
        </div>

        <div class="modal-content" style="width: 100%; margin: 10px auto">
            <div class="modal-header">
                <div class="modal-title"><b>A4.這次互動的開始時間：（請輸入整數 0 點～23 點）</b></div>
            </div>
            <div class="modal-body" id="A4">
                <input style="width: 24%; text-align: center" name="A4" id="cA4" type="number" min="0" max="23">
            </div>
        </div>

        <div class="modal-content" style="width: 100%; margin: 10px auto">
            <div class="modal-header">
                <div class="modal-title"><b>A5. 這次互動大概多久：</b></div>
            </div>
            <div class="modal-body" id="A5">
                <select class="std" name="A5">
                    <option value="0"></option>  
                    <option value="少於一分鐘">少於一分鐘</option>
                    <option value="1~4 分鐘">1~4 分鐘</option>
                    <option value="5~14 分鐘">5~14 分鐘</option>
                    <option value="15~59 分鐘">15~59 分鐘</option>
                    <option value="1~4 小時">1~4 小時</option>
                    <option value="大於 4 小時">大於 4 小時</option>
                </select>
            </div>
        </div>

        <div class="modal-content" style="width: 100%; margin: 10px auto">
            <div class="modal-header">
                <div class="modal-title"><b>A6. 這次互動，我在哪裡：</b></div>
            </div>
            <div class="modal-body" id="A6">
                <select class="std" name="A6">
                    <option value="0"></option>  
                    <option value="校內">校內</option>
                    <option value="自己住處／家裡">自己住處／家裡</option>
		    <option value="對方住處／家裡">對方住處／家裡</option>
                    <option value="交通工具">交通工具</option>
                    <option value="補習班">補習班</option>
                    <option value="校外餐廳">校外餐廳</option>
                    <option value="校外圖書館">校外圖書館</option>
                    <option value="校外娛樂場所">校外娛樂場所</option>
                    <option value="其他">其他</option>
                </select>
            </div>
        </div>

        <div class="modal-content" style="width: 100%; margin: 10px auto">
            <div class="modal-header">
                <div class="modal-title"><b>A7. 這次互動<u>前</u>，我的心情：</b></div>
            </div>
            <div class="modal-body">
                <fieldset data-role="controlgroup" data-type="horizontal">
                    <label><input type="radio" name="A7" value="很不好">很不好</label>
                    <label><input type="radio" name="A7" value="有點不好">有點不好</label>
                    <label><input type="radio" name="A7" value="普通">普通</label>
                    <label><input type="radio" name="A7" value="有點好">有點好</label>
                    <label><input type="radio" name="A7" value="很好">很好</label>
                </fieldset>
            </div>
        </div>

        <div class="modal-content" style="width: 100%; margin: 10px auto">
            <div class="modal-header">
                <div class="modal-title"><b>A8. 這次互動<u>後</u>，我的心情：</b></div>
            </div>
            <div class="modal-body">
                <fieldset data-role="controlgroup" data-type="horizontal">
                    <label><input type="radio" name="A8" value="很不好">很不好</label>
                    <label><input type="radio" name="A8" value="有點不好">有點不好</label>
                    <label><input type="radio" name="A8" value="普通">普通</label>
                    <label><input type="radio" name="A8" value="有點好">有點好</label>
                    <label><input type="radio" name="A8" value="很好">很好</label>
                </fieldset>
            </div>
        </div>

        <div class="modal-content" style="width: 100%; margin: 0px auto">
            <div class="modal-header">
                <div class="modal-title"><b>A9. 這次互動後，我覺得我有情感以外的收穫（例如：獲得有用資訊、知識、物品、幫助）：</b></div>
            </div>
            <div class="modal-body">
                <fieldset data-role="controlgroup" data-type="horizontal">
                    <label><input type="radio" name="A9" value="有很大的損失">有很大的損失</label>
                    <label><input type="radio" name="A9" value="有一點損失">有一點損失</label>
                    <label><input type="radio" name="A9" value="沒有變">沒有變</label>
                    <label><input type="radio" name="A9" value="有一點收穫">有一點收穫</label>
                    <label><input type="radio" name="A9" value="有很大的收穫">有很大的收穫</label>
                </fieldset>
            </div>
        </div>
    </div>
        
    <center>
        <div><button id="submitA" class="btn" type="submit">繼續</button></div>
    </center>
    </form>
 
    <?php include("footer.php");?>
</body>
</html>
