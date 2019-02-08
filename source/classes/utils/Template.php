<?php

/**
 * Created by PhpStorm.
 * User: Anatoliy
 * Date: 02.04.2016
 * Time: 17:20
 */
class Template {

	public static $cssTemplate = array(
			'assets/style/reset.css',
			'assets/style/theme.css',
	);
	public static $configTemplate = array(
			'yandex_money' => '410013602060026',
			'yandex_access_token' => 'AQAAAAAOWpqUAAOBwPe1kNzIxUpXjbpl1tk5yvY'
	);


	public static $jsTemplate = array(
			'https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js',
			'assets/js/jquery.form-validator.js',
			'assets/vendor/fileUpload/js/jquery.knob.js',
			'assets/vendor/fileUpload/js/jquery.ui.widget.js',
			'assets/vendor/fileUpload/js/jquery.fileupload.js',
			'assets/vendor/fileUpload/js/jquery.iframe-transport.js',

			'assets/js/script.js',
			'assets/vendor/fileUpload/js/script.js',

			'assets/vendor/Loader/jquery.loadie.js',


	);
	public static function renderTopMenu() {
		?>
		<div class="top_menu">
			<div class="top-menu-left">
				<ul>
					<li data-url="index.php">Главная</li>
					<li data-url="print.php">Печать фото online</li>
					<li data-url="shipping.php">Условия доставки</li>
<!--					<li data-url="reviews.php">Вопросы</li>-->
				</ul>
			</div>
		</div>
		<?
	}

	public static function renderRightMenu() {
		?>
		<div class="right_menu clearfix">
			<div class="menu_item">
				<span class="menu_item-title">
					Корзина
				</span>

				<div class="menu_item-content clearfix">
					<table>
						<tr>
							<td>Количество фото:</td>
							<td id="countPhoto">0</td>
						</tr>
						<tr>
							<td>Сумма заказа:</td>
							<td id="totalMoney">0</td>
							<td>руб</td>
						</tr>

					</table>
					<a href="#" onclick="shop()" class="button  btn_success">Оформить заказ</a>
					<a href="#" onclick="Item.itemDeleteAll()" class="button  btn_delete">Удалить все</a>
				</div>
			</div>
		</div>
		<?
	}


}

