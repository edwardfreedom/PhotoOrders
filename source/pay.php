<?
require_once "classes/utils/Settings.php";
require_once "classes/utils/Template.php";
require_once "classes/utils/Functions.php";
require_once __DIR__ . '/classes/fileUpload/bootstrap.php';

$json = $_GET["config"];
$json = json_decode( $json, true );

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
		<span class="page-title">Оформление заказа</span>


		<div class="form_pay">
			<div class="row">
				<span class="error"></span>
				<input type="text"  value="" class="input_text" placeholder="Введите ФИО" id="fio">
			</div>
			<div class="row">
				<span class="error"></span>
				<input type="text"class="input_text" placeholder="Введите mail" id="mail">
			</div>
			<div class="row">
				<span class="error"></span>
				<input type="text" class="input_text" placeholder="Введите телефон" id="phone">
			</div>
			<div class="row">
				<span class="error"></span>
				<input type="text" class="input_text" placeholder="Введите адрес" id="city">
			</div>
			<div class="row">
				<a class="button  btn_success btn_pay" onclick="payConfirm()" type="button">Оплатить</a>
			</div>
			<!--			<div class="row">-->
			<!--				<div class="yandex_pay">-->
			<!--					<iframe  frameborder="0" allowtransparency="true" scrolling="no" src="https://money.yandex.ru/quickpay/shop-widget?account=--><? //= Template::$configTemplate["yandex_money"]; ?><!--&quickpay=shop&payment-type-choice=on&mobile-payment-type-choice=on&writer=seller&targets=%D0%BF%D1%80%D0%BF%D1%80%D0%BF&default-sum=--><? //=$json[0]["info"]["money"]; ?><!--&button-text=01&comment=on&hint=&successURL=" width="500" height="257"></iframe>-->
			<!---->
			<!--				</div>-->
			<!---->
			<!--			</div>-->
		</div>


	</div>
</div>

<? foreach ( Template::$jsTemplate as $js ): ?>
	<script src="<?= $js ?>"></script>
<?php endforeach; ?>





<script > document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</body>
</html>