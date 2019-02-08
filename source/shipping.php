<?
require_once "classes/utils/Settings.php";
require_once "classes/utils/Template.php";
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

		<span class="page-title">Условия доставки</span>
		<span class="question_title">На заказы до 1500 рублей стоимость доставки:</span>
		<span>-50 рублей по г. Каменка.</span>
		<span class="question_title">На заказы от 1500 рублей, доставка по городу БЕСПЛАТНО*!</span>
		<span>САМОВЫВОЗ осуществляется в заранее обговоренное время по адресу: г. Каменка ул. Чернышевского д.37, рядом с кафе "Молодежное"</span>
	</div>
</div>


<? foreach ( Template::$jsTemplate as $js ): ?>
	<script src="<?= $js ?>"></script>
<?php endforeach; ?>


<script>
	document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')
</script>
</body>
</html>