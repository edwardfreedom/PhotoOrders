<?php
require_once "classes/utils/Functions.php";
// A list of permitted file extensions
$allowed = array( 'png', 'jpg', 'gif', 'zip' );


//$fileName = Functions::transLiterate($_FILES['upl']['name']);


if ( isset( $_FILES['upl'] ) && $_FILES['upl']['error'] == 0 ) {

	$extension = pathinfo( $_FILES['upl']['name'], PATHINFO_EXTENSION );

	if ( !in_array( strtolower( $extension ), $allowed ) ) {
		echo '{"status":"error"}';
		exit;
	}

	$fileName = Functions::getNowDate() . rand(1000, 9999) . '.' . $extension;

	if ( move_uploaded_file( $_FILES['upl']['tmp_name'], 'uploads/' . $fileName ) ) {


		print_r( json_encode( [
				'status'   => 'success',
				'filePath' => $fileName
		] ) );

		exit;
	}
}

echo '{"status":"error"}';
exit;