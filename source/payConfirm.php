<?
require_once "classes/utils/Settings.php";
require_once "classes/utils/Template.php";
require_once "classes/utils/Functions.php";
require_once __DIR__ . '/classes/fileUpload/bootstrap.php';
//ini_set( 'display_errors', 1 );
//error_reporting( E_ALL & ~E_DEPRECATED );
$json = $_GET["config"];
$json = json_decode( $json, true );

$fio   = $_GET["fio"];
$mail  = $_GET["mail"];
$phone = $_GET["phone"];
$city  = $_GET["city"];

$newDir = "orders/" . Functions::getNowDate() . " " . $mail;


$zip = new ZipArchive();
$zip->open( $newDir . ".zip", ZIPARCHIVE::CREATE );


if ( !is_dir( $newDir ) ) {
	mkdir( $newDir, 0777, true );
}

$file = $newDir . '/people.txt';

$current = null;
$current .= "Фио: " . $fio . "\n";
$current .= "Мейл: " . $mail . "\n";
$current .= "Телефон: " . $phone . "\n";
$current .= "Город: " . $city . "\n";
$current .= "\n";


//Array ( [0] => Array ( [logo] => uploads/2017-Chevrolet-Camaro-ZL1-018.jpg [size] => 10x15
// [type] => Глянцевая [count] => 1 [cute] => Не обрезать поля ) )

foreach ( $json[0]["items"] as $j ) {


	$photoDirectorySort = $j["size"] . '/' . $j["type"] . '/' . $j["count"];

	$photoDirectorySort = iconv( 'UTF-8', 'CP866', $photoDirectorySort );

	$fileNameCyr1 = iconv( 'UTF-8', 'windows-1251', $j["logo"] );
	$fileNameCyr2 = iconv( 'UTF-8', 'CP866', $j["logo"] );

	if ( file_exists( $fileNameCyr1 ) ) {
		copy( $fileNameCyr1, $newDir . '/' . basename( $fileNameCyr1 ) );
		unlink( $fileNameCyr2 );
	}
	$zip->addEmptyDir( $photoDirectorySort );

	$zip->addFile( $newDir . '/' . basename( $fileNameCyr1 ), $photoDirectorySort . '/' . basename( $fileNameCyr2 ) );


}


file_put_contents( $file, $current );
$zip->addFile( $file, "user.txt" );
$zip->close();


Functions::deleteDir( $newDir );





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
		<span class="page-title">Проверка данных</span>


		<div class="form_pay">
			<div class="row">
				<input type="text" value="<?= $fio; ?>" class="input_text" readonly id="fio">
			</div>
			<div class="row">
				<input type="text" value="<?= $mail; ?>" class="input_text" readonly placeholder="Введите mail" id="mail">
			</div>
			<div class="row">
				<input type="text" value="<?= $phone; ?>" class="input_text" readonly placeholder="Введите телефон" id="phone">
			</div>
			<div class="row">
				<input type="text" value="<?= $city; ?>" class="input_text" readonly placeholder="Введите адрес" id="city">
			</div>
			<div class="row">
				<input type="text" value="<?= $json[0]["info"]["money"]; ?> руб" class="input_text" readonly>
			</div>

            <span class="question_title">Заказ оформлен и ожидает оплаты</span>

			<div class="row">
				<div class="yandex_pay">
					<iframe frameborder="0" allowtransparency="true" scrolling="no" src="https://money.yandex.ru/quickpay/shop-widget?account=<?= Template::$configTemplate["yandex_money"]; ?>&quickpay=shop&payment-type-choice=on&mobile-payment-type-choice=on&writer=seller&targets=Заказ фотографий&default-sum=<?= $json[0]["info"]["money"]; ?>&button-text=01&comment=off&hint=&successURL=google.ru" width="500" height="257"></iframe>

				</div>

			</div>
		</div>


	</div>
</div>


<? foreach ( Template::$jsTemplate as $js ): ?>
	<script src="<?= $js ?>"></script>
<?php endforeach; ?>


<!--<script > document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>-->

</body>
</html>