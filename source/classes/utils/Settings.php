<?php
@session_start();

/**
 * Created by PhpStorm.
 * User: Anatoliy
 * Date: 18.03.2016
 * Time: 20:17
 */
class  Settings {


	public static function _urlencode( $text ) {
		return urlencode( $text );
	}

	public static function getLogin() {
		return rawurlencode( $_SESSION['login'] );
	}

	public static function getPassword() {
		return rawurlencode( $_SESSION['password'] );
	}

	public static function getAccess_token() {
		if(!isset($_SESSION['access_token'])) {
			echo "<script>window.location = 'login.php';</script>";
		}
		return $_SESSION['access_token'];
	}

	public static function getUID() {
		return $_SESSION['user_id'];
	}

	public static $post = [
			"client_id"     => "2274003",
			"client_secret" => "hHbZxrka2uZ6jB1inYsH"
	];

	public static $cssMainTemplate = array(
			'assets/style/reset.css',
			'assets/style/theme.css',
	);
}

