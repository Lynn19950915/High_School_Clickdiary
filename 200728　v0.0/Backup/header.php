<?php

?>

<header>
<!-- <nav class="navbar navbar-light" > -->
  <!-- Navbar content -->
<!-- </nav> -->
	<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light" style="/*background-color: #FFE699;*/">
		<a class="navbar-brand" href="./main.php">
			<!-- <img src="/pic/logo.png" style="height: 2em;margin-right: 0.25em;"> -->
			<span>高中生點日記</span>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav">
			  <li class="nav-item"><a class="nav-link" href="./aboutus.php">關於我們</span></a></li>
			  <li class="nav-item dropdown">
			    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">帳號管理</a>
			    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			      <a class="dropdown-item" href="./renew.php">修改資料</a>
			      <a class="dropdown-item" href="./points.php">我的積分</a>
			    </div>
			  </li>
              <li class="nav-item"><a class="nav-link" href="./diary.php">日記牆</span></a></li>
			  <li class="nav-item dropdown">
			    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink_2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">填答說明</a>
			    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink_2">
			      <a class="dropdown-item" href="./sop.php">填答手冊</a>
			      <a class="dropdown-item" href="./rules.php">補助細則</a>
                  <a class="dropdown-item" href="./faq.php">常見FAQ</a>
                  <a href="mailto:***@gmail.com" target="_top">聯絡我們</a>
			    </div>
			  </li>
			</ul>
			<ul class="navbar-nav ml-auto">
				<li class="nav-item"><a href="./logout.php">登出</a></li>
			</ul>
		</div>

	</nav>
</header>
<script type="text/javascript">
	$(document).ready(function() {
		$(function() {
		  $(document).click(function (event) {
		    $('.navbar-collapse').collapse('hide');
		  });
		});

	})
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=***"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '***');
</script>