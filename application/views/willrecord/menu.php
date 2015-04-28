<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="">意志曆 <span class="label label-default">BETA</span></a>
	</div>
	<div class="navbar-collapse collapse">
		<ul class="nav navbar-nav navbar-right">
			<?php if( !empty($account) ) { ?>
				<li><a href="record/<?php echo $account;?>"><?php echo $account;?></a></li>
				<li><a href="logout">登出</a></li>
			<?php } 
			else {?>
				<li><a href="register">免費註冊</a></li>
				<li><a href="login">登入</a></li>
			<?php } ?>
		</ul>
	</div><!--/.navbar-collapse -->
	</div>
</div>