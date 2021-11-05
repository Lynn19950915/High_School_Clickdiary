<?php
    /*不需多寫一次session_start()，會導致重複報錯*/
?>

<style>
    nav{
        background-color: #C4C400;
    }
</style>

<script>
	$(document).ready(function(){
        $(document).click(function(event){
            $(".navbar-collapse").collapse("hide");
        })
    })
</script>


<header>
	<nav class="navbar navbar-expand-lg navbar-light fixed-top">
		<a class="navbar-brand" href="./main.php">
            <img src="./pic/logo_small.png">
		</a>
        
		<button class="navbar-toggler" data-toggle="collapse" data-target="#option">
			<span class="navbar-toggler-icon"></span>
		</button>
        
		<div id="option" class="collapse navbar-collapse">
			<ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="./aboutUs.php">關於我們</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true">帳號管理</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="./passport.php">帳號總覽</a>
                        <a class="dropdown-item" href="./myPoint.php">我的積分</a>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="./mission.php">任務專區</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true">填答幫手</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="./SOP.php">填答手冊</a>
                        <a class="dropdown-item" href="./FAQ.php">常見問題</a>
                    </div>
                </li>
            </ul>
            
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-3"><a href="mailto:***@sinica.edu.tw">聯絡我們</a></li>
				<li class="nav-item mr-3"><a href="./logout.php">登出</a></li>
			</ul>
		</div>
	</nav>
</header>
