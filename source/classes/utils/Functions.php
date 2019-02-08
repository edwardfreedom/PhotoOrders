<?php
@session_start();

/**
 * Created by PhpStorm.
 * User: Anatoliy
 * Date: 18.03.2016
 * Time: 20:01
 */
class Functions {
	function __construct() {
	}

	public static function screening( $str ) {
		$str = trim( $str );
		$str = stripslashes( $str );
		$str = htmlspecialchars( $str );

		return $str;
	}

	public static function deleteDir($dirPath) {
		if (! is_dir($dirPath)) {
			throw new InvalidArgumentException("$dirPath must be a directory");
		}
		if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
			$dirPath .= '/';
		}
		$files = glob($dirPath . '*', GLOB_MARK);
		foreach ($files as $file) {
			if (is_dir($file)) {
				self::deleteDir($file);
			} else {
				unlink($file);
			}
		}
		rmdir($dirPath);
	}

	public static  function httpPost($url, $data)
	{
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}
	public static function getNowDate() {
		return date( 'Y_ m_d_G_i_s' );
	}

public static function transLiterate(&$textcyr = null, $textlat = null) {
	$rus = array('ё','ж','ц','ч','ш','щ','ю','я','Ё','Ж','Ц','Ч','Ш','Щ','Ю','Я');
	$lat = array('yo','zh','tc','ch','sh','sh','yu','ya','YO','ZH','TC','CH','SH','SH','YU','YA');
	$string = str_replace($rus,$lat,$textcyr);
	$string = strtr($string,
			"АБВГДЕЗИЙКЛМНОПРСТУФХЪЫЬЭабвгдезийклмнопрстуфхъыьэ",
			"ABVGDEZIJKLMNOPRSTUFH_I_Eabvgdezijklmnoprstufh'i'e");

	return($string);
	}


	public static function request( $url, $method = 'GET', $postfields = array() ) {
		$ch        = curl_init();
		$header [] = "Accept-Language: ru-RU,ru;q=0.9,en;q=0.8";


		curl_setopt_array( $ch, array(
				CURLOPT_USERAGENT      => 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322)',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_POST           => ( $method == 'POST' ),
				CURLOPT_POSTFIELDS     => $postfields,
				CURLOPT_URL            => $url,
				CURLOPT_HTTPHEADER     => $header
		) );

		return curl_exec( $ch );
	}


} // class