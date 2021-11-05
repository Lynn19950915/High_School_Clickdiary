<?php
	session_start();
    include "db.php";

    if($_SESSION["acc_info"]["id"]==null){
        header("Location: ./index.php");  //0.登入後查看
	}
    $id=$_SESSION["acc_info"]["id"];
    $today=date("Y-m-d");

    if(isset($_POST["A1"])){
        $A1=$_POST["A1"];
        $A2=$_POST["A2"];
        $A3=$_POST["A3"];
        $A4=$_POST["A4"];
        $A5M=$_POST["A5"];  $A5=implode(",", $A5M);
        $A6M=$_POST["A6"];  $A6=implode(",", $A6M);
        $A7=$_POST["A7"];
        $A8=$_POST["A8"];
        $A9=$_POST["A9"];
        $A10=$_POST["A10"];
        $A11=$_POST["A11"];
        
        $sql1="INSERT INTO `lifediary` VALUES(:v1, CURTIME(), :A0, :A1, :A2, :A3, :A4, :A5, :A6, :A7, :A8, :A9, :A10, :A11)";
        $stmt=$db->prepare($sql1);
        $stmt->bindParam(":v1", $id);
        $stmt->bindParam(":A0", $today);
        $stmt->bindParam(":A1", $A1);
        $stmt->bindParam(":A2", $A2);
        $stmt->bindParam(":A3", $A3);
        $stmt->bindParam(":A4", $A4);
        $stmt->bindParam(":A5", $A5);
        $stmt->bindParam(":A6", $A6);
        $stmt->bindParam(":A7", $A7);
        $stmt->bindParam(":A8", $A8);
        $stmt->bindParam(":A9", $A9);
        $stmt->bindParam(":A10", $A10);
        $stmt->bindParam(":A11", $A11);
        $stmt->execute();
        
        echo "Submit Success";
        exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>生活日記</title>
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
            width: 18%;
        }
        
        label:hover{
            background-color: #C4C400;
        }
        
        input{
            width: 12%;
        }
    
        #btn_submit{
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
            
            #btn_submit{
                font-size: 0.8em;
            }
            
            h5{
                font-size: 1.1em;
            }
            
            label{
                width: 90%;
            }
		}       
    </style>
    
    <script>
		$(document).ready(function(){            
            $(".A5o").on("change", function(event){
                event.preventDefault();
                
                if($(".A5o").prop("checked")==true){
                    var cA5e=document.getElementsByClassName("A5e");
                    for(var i=0, iLen=cA5e.length; i<iLen; i++){
                        cA5e[i].checked=false;
                        cA5e[i].disabled=true;
                    }
                }else{
                    var cA5e=document.getElementsByClassName("A5e");
                    for(var i=0, iLen=cA5e.length; i<iLen; i++){
                        cA5e[i].disabled=false;
                    }
                }
            })
            
            $(".A6o").on("change", function(event){
                event.preventDefault();
                
                if($(".A6o").prop("checked")==true){
                    var cA6e=document.getElementsByClassName("A6e");
                    for(var i=0, iLen=cA6e.length; i<iLen; i++){
                        cA6e[i].checked=false;
                        cA6e[i].disabled=true;
                    }
                }else{
                    var cA6e=document.getElementsByClassName("A6e");
                    for(var i=0, iLen=cA6e.length; i<iLen; i++){
                        cA6e[i].disabled=false;
                    }
                }
            })
            
            $("#lifeDiaryForm").on("submit", function(event){
                event.preventDefault();
                check();
                
                $.ajax({ 
					type: "POST",
					url: "",
					data: $("form#lifeDiaryForm").serialize(),
                    success: function(data){ 
						console.log("Submit", data);	
						if(data=="Submit Success"){
                            $.confirm({
                                title: "",
                                content: "今日生活日記完成填寫！",
                                buttons: {
                                    "OK": function(){
                                        window.location.href="./main.php";
                                    }
								}
                            })
                        }
                    }, error: function(e){
                        console.log(e);
				    }
				})
                
                function check(){
                    var cA1 =getValue("A1");
                    var cA2 =getValue("A2");
                    var cA3 =getValue("A3");
                    var cA4 =getValue("A4");
                    var cA5M=getValueM("A5[]");
                    var cA6M=getValueM("A6[]");
                    var cA7 =getValue("A7");
                    var cA8 =getValue("A8");
                    var cA9 =getValue("A9");
                    var cA10=getValue("A10");
                    var cA11=getValue("A11");
                    
                    var record=[], j=0;
                    if(cA1==0)  {record[j]="1"; j++}
                    if(cA2==0)  {record[j]="2"; j++}
                    if(cA3==0)  {record[j]="3"; j++}
                    if(cA4==0)  {record[j]="4"; j++}
                    if(cA5M==0) {record[j]="5"; j++}
                    if(cA6M==0) {record[j]="6"; j++}
                    if(cA7==0)  {record[j]="7"; j++}
                    if(cA8==0)  {record[j]="8"; j++}
                    if(cA9==0)  {record[j]="9"; j++}
                    if(cA10==0) {record[j]="10"; j++}
                    if(cA11==0) {record[j]="11"; j++}
                    
                    if(j>0){
                        alert("你好，第"+record+"題尚未填答完畢唷！");
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
    
    <form id="lifeDiaryForm" name="lifeDiaryForm">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>1. 我今天感受到來自<b style="color: red"><u>家庭</u></b>的壓力：</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="radio" name="A1" value="1">非常沒有壓力</label>
            <label><input type="radio" name="A1" value="2">有點沒有壓力</label>
            <label><input type="radio" name="A1" value="3">普通</label>
            <label><input type="radio" name="A1" value="4">有點壓力</label>
            <label><input type="radio" name="A1" value="5">非常有壓力</label>
        </fieldset>
        </div>
    </div>

    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>2. 我今天感受到來自<b style="color: red"><u>師長</u></b>的壓力：</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="radio" name="A2" value="1">非常沒有壓力</label>
            <label><input type="radio" name="A2" value="2">有點沒有壓力</label>
            <label><input type="radio" name="A2" value="3">普通</label>
            <label><input type="radio" name="A2" value="4">有點壓力</label>
            <label><input type="radio" name="A2" value="5">非常有壓力</label>
        </fieldset>
        </div>
    </div>
        
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>3. 我今天感受到來自<b style="color: red"><u>同學</u></b>的壓力：</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="radio" name="A3" value="1">非常沒有壓力</label>
            <label><input type="radio" name="A3" value="2">有點沒有壓力</label>
            <label><input type="radio" name="A3" value="3">普通</label>
            <label><input type="radio" name="A3" value="4">有點壓力</label>
            <label><input type="radio" name="A3" value="5">非常有壓力</label>
        </fieldset>
        </div>
    </div>

    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>4. 我今天對人際關係的滿意程度：</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="radio" name="A4" value="1">很不滿意</label>
            <label><input type="radio" name="A4" value="2">有點不滿意</label>
            <label><input type="radio" name="A4" value="3">普通</label>
            <label><input type="radio" name="A4" value="4">有點滿意</label>
            <label><input type="radio" name="A4" value="5">很滿意</label>
        </fieldset>
        </div>
    </div>
        
    <div class="modal-content" id="A5M">
        <div class="modal-header">
            <div class="modal-title"><b>5. 我今天感覺到以下心理不適：（可複選）</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="checkbox" name="A5[]" class="A5e" value="1">坐立不安或感覺緊張</label>
            <label><input type="checkbox" name="A5[]" class="A5e" value="2">易怒</label>
            <label><input type="checkbox" name="A5[]" class="A5e" value="3">感到憂鬱</label>
            <label><input type="checkbox" name="A5[]" class="A5e" value="4">注意力難以集中</label>
            <label><input type="checkbox" name="A5[]" class="A5e" value="5">難以入睡</label>
            <label><input type="checkbox" name="A5[]" class="A5e" value="6">睡不安穩</label>
            <label><input type="checkbox" name="A5[]" class="A5e" value="7">容易感到疲勞</label>
            <label><input type="checkbox" name="A5[]" class="A5e" value="8">頭痛</label>
            <label><input type="checkbox" name="A5[]" class="A5e" value="9">肌肉僵硬</label>
            <label><input type="checkbox" name="A5[]" class="A5o" value="0"><b>以上皆無</b></label>
        </fieldset>
        </div>
    </div>
    
    <div class="modal-content" id="A6M">
        <div class="modal-header">
            <div class="modal-title"><b>6. 我今天感覺到以下身體不適：（可複選）</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="checkbox" name="A6[]" class="A6e" value="1">發燒</label>
            <label><input type="checkbox" name="A6[]" class="A6e" value="2">咳嗽</label>
            <label><input type="checkbox" name="A6[]" class="A6e" value="3">喉嚨痛</label>
            <label><input type="checkbox" name="A6[]" class="A6e" value="4">流鼻水</label>
            <label><input type="checkbox" name="A6[]" class="A6o" value="0"><b>以上皆無</b></label>
        </fieldset>
        </div>
    </div>
    
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>7. 我今天對學習：</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="radio" name="A7" value="1">完全沒有熱忱</label>
            <label><input type="radio" name="A7" value="2">有點沒有熱忱</label>
            <label><input type="radio" name="A7" value="3">不低也不高</label>
            <label><input type="radio" name="A7" value="4">有點熱忱</label>
            <label><input type="radio" name="A7" value="5">充滿熱忱</label>
        </fieldset>
        </div>
    </div>
        
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>8. 我今天的自修時間：</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="radio" name="A8" value="1">不到 1 小時</label>
            <label><input type="radio" name="A8" value="2">1～3 小時</label>
            <label><input type="radio" name="A8" value="3">3～5 小時</label>
            <label><input type="radio" name="A8" value="4">大於 5 小時</label>
        </fieldset>
        </div>
    </div>
    
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>9. 我今天的學習成果：</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="radio" name="A9" value="1">很不充實</label>
            <label><input type="radio" name="A9" value="2">有點不充實</label>
            <label><input type="radio" name="A9" value="3">不低也不高</label>
            <label><input type="radio" name="A9" value="4">有點充實</label>
            <label><input type="radio" name="A9" value="5">很充實</label>
        </fieldset>
        </div>
    </div>
        
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>10. 我今天的學習效率：</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="radio" name="A10" value="1">很低</label>
            <label><input type="radio" name="A10" value="2">有點低</label>
            <label><input type="radio" name="A10" value="3">不低也不高</label>
            <label><input type="radio" name="A10" value="4">有點高</label>
            <label><input type="radio" name="A10" value="5">很高</label>
        </fieldset>
        </div>
    </div>
        
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><b>11. 整體而言，我覺得今天的心情：</b></div>
        </div>
        <div class="modal-body">
        <fieldset data-role="controlgroup" data-type="horizontal">
            <label><input type="radio" name="A11" value="1">很不好</label>
            <label><input type="radio" name="A11" value="2">有點不好</label>
            <label><input type="radio" name="A11" value="3">普通</label>
            <label><input type="radio" name="A11" value="4">有點好</label>
            <label><input type="radio" name="A11" value="5">很好</label>
        </fieldset>
        </div>
    </div>
        
    <center>
        <div><button id="btn_submit" class="btn" type="submit">完成</button></div>
    </center>
    </form>
    
	<?php include("footer.php");?>
</body>
</html>
