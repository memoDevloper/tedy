<!DOCTYPE html>
<html lang="ar" dir="rtl">
	<head>
		<?php include('site.head.php'); ?>
	</head>
	<body class="fix-header" >
		<div class="preloader">
			<svg class="circular" viewBox="25 25 50 50">
				<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
			</svg>
		</div>
		<div id="wrapper">
			<?php include('site.header.php'); ?>
			<div id="page-wrapper" >
				<main>
					<?php include($include); ?>
				</main>
				<footer class="footer-bg">
					<?php include('site.sidebar.php'); ?>
					<?php include('site.footer.php'); ?>
				</footer>
			</div>
		</div>
		<?php include('site.footerscript.php'); ?>
	</body>
</html>