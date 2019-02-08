<?
require_once "classes/utils/Settings.php";
require_once "classes/utils/Template.php";
require_once __DIR__ . '/classes/fileUpload/bootstrap.php';

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width" />
	<title>Печать фотографий</title>
	<? foreach ( Template::$cssTemplate as $style ): ?>
		<link href="<?= $style ?>" rel="stylesheet" type="text/css" />
	<?php endforeach; ?>
</head>
<body>

<div class="container">

	<? Template::renderTopMenu(); ?>

	<div class="content clearfix">
		<span class="page-title">Печать фотографий онлайн</span>
		<? Template::renderRightMenu(); ?>

		<form id="upload" method="post" action="upload.php" enctype="multipart/form-data">
			<div id="drop">


				<div class="file_upload">
					<a class="button  btn_success" type="button">Загрузить фотографии</a>
					<input type="file" id="selectFile" multiple  name="upl" accept="image/*,image/jpeg" />
				</div>



			</div>
			<ul id="progress_load"></ul>
		</form>

		<div id="test21"></div>


		<div id="imagesArray" class="content_images clearfix">


			<!--
					<iframe frameborder="0" allowtransparency="true" scrolling="no" src="https://money.yandex.ru/quickpay/shop-widget?account=410012094835056&quickpay=shop&payment-type-choice=on&mobile-payment-type-choice=on&writer=seller&targets=%D0%BF%D1%80%D0%BF%D1%80%D0%BF&default-sum=12&button-text=01&comment=on&hint=&successURL=" width="451" height="257"></iframe>
-->
		</div>





	</div>
</div>


<? foreach ( Template::$jsTemplate as $js ): ?>
	<script src="<?= $js ?>"></script>
<?php endforeach; ?>



<script > document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</body>
</html>