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

		<div class="logo_photo-collage">
			<div class="info_orders">
				<span class="title">Фотопечать</span>
				<ul>
					<li>На выбор 2 вида бумаги: глянцевая, матовая.</li>
					<li>Размер — от 10x15 см до 30x45 см.</li>
					<li>Удобный online редактор.</li>
				</ul>
			</div>
		</div>

		<div class="motivation">
			<div class="item">
				<div class="logo">
					<img src="assets/img/12301.jpg">
				</div>
				<span class="title">Насыщенные яркие цвета и глубокие оттенки</span>
			</div>
			<div class="item">
				<div class="logo">
					<img src="assets/img/12298.jpg">
				</div>

				<span class="title">Разнообразие типов и форматов фотографий</span>
			</div>
			<div class="item">
				<div class="logo">
					<img src="assets/img/12302.jpg">
				</div>
				<span class="title">Непревзойденная точность и четкость цветопередачи</span>
			</div>
		</div>


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