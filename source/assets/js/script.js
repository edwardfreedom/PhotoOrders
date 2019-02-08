function Settings() {
	var settings = {
		'10x15': {
			'Глянцевая': 5,
			'Матовая'  : 51
		},
		'A4'   : {
			'Глянцевая': 24,
			'Матовая'  : 24,
		}
	};
	return settings;
};
$(document).ready(function () {
	$("li").click(function () {
		var url = $(this).attr("data-url");
		window.location = url == undefined ? '#' : url;
	});


});

var changeSelects = {
	changeSize: function (_this) {
		var $parent = $(_this).parent().closest('.item_photo');
		var selectSize = $(_this).val();
		var $selectTypePaper = $parent.find('.type');
		$selectTypePaper.find('option').remove();
		for (var item in Settings()[selectSize]) {
			$selectTypePaper.append('<option>' + item + '</option>');
		}
		changeMoney.reCount();
	},
};


var changeMoney = {
	sumMoney: 0,
	reCount : function () {
		changeMoney.sumMoney = 0;
		Item.$countPhoto.text(0);
		var $itemsPhoto = $('.item_photo');

		//var $containerItems = $("#imagesArray").children().length;
		//Item.$countPhoto.text($containerItems);
		//if ($containerItems == 0) {
		//	Item.$totalMoney.text(0);
		//}


		$itemsPhoto.each(function (index) {
			var $element = $(this);
			//alert($element.html());
			//alert(changeMoney.$totalMoney.text());
			var $selectSize = $element.find('.size').val();
			var $selectType = $element.find('.type').val();

			var $count = parseInt($element.find('.spinner_value').text());
			var oldValueCount = parseInt(Item.$countPhoto.text());

			changeMoney.sumMoney = changeMoney.sumMoney + Settings()[$selectSize][$selectType] * $count;

			Item.$countPhoto.text(parseInt(oldValueCount + $count));


		});
		Item.$totalMoney.text(changeMoney.sumMoney);
	},

};


var Spinner = {
	changeValue: function (_this) {

		var $spinner_container = $(_this).parent();
		var $spinner_value = $spinner_container.find('.spinner_value');
		var value = parseInt($spinner_value.text());

		//var $photoAllCount = $("#countPhoto");
		//var countAllPhotos = parseInt($photoAllCount.text());
		//$photoAllCount.text("gfg");
		//
		//alert(countAllPhotos);
		if ($(_this).hasClass('increment')) {
			$spinner_value.text(++value);
			//changeMoney.reCount();
		}
		else if ($(_this).hasClass('decrement') && value > 1) {
			$spinner_value.text(--value);
			//changeMoney.reCount();
		}
		$spinner_container.attr('data-value', value);
		changeMoney.reCount();
	},
};


function shop() {
	var $itemsPhoto = $('.item_photo');
	var itemsArrayTemp = [];


	$itemsPhoto.each(function (index) {
		var $element = $(this);
		//	alert($element.find('.type').val());
		itemsArrayTemp.push({
			'logo' : $element.find('.logo').attr('src'),
			'size' : $element.find('.size').val(),
			'type' : $element.find('.type').val(),
			'count': $element.find('.spinner_value').text()
		});

	});
	var itemsArray = [{
		'info' : {
			'money': $('#totalMoney').text()
		},
		'items': itemsArrayTemp
	}];
	window.location = 'pay.php?config=' + JSON.stringify(itemsArray);
	//alert(JSON.stringify(itemsArray));
}

function getParameterByName(name, url) {
	if (!url) url = window.location.href;
	name = name.replace(/[\[\]]/g, "\\$&");
	var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
			results = regex.exec(url);
	if (!results) return null;
	if (!results[2]) return '';
	return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function payConfirm() {
	var fio = $('#fio');
	var mail = $('#mail');
	var phone = $('#phone');
	var city = $('#city');
	var config = getParameterByName("config");
	var parentFio = fio.parent().closest('.row').find('.error');
	var parentMail = mail.parent().closest('.row').find('.error');
	var parentPhone = phone.parent().closest('.row').find('.error');
	var parentCity = city.parent().closest('.row').find('.error');

	parentFio.css({'display' : 'none'});
	parentMail.css({'display' : 'none'});
	parentPhone.css({'display' : 'none'});
	parentCity.css({'display' : 'none'});

	var error = false;

	if(fio.val().length == 0 || fio.val() == ' ') {
		parentFio.text("Заполните инициалы!");
		parentFio.css({'display' : 'block'});
		error = true;
	}
	if(mail.val().length == 0 || mail.val() == ' ') {
		parentMail.text("Не введен емейл адрес!");
		parentMail.css({'display' : 'block'});
		error = true;
	}
	if(phone.val().length == 0 || phone.val() == ' ') {
		parentPhone.text("Не введен телефон!");
		parentPhone.css({'display' : 'block'});
		error = true;
	}
	if(city.val().length == 0 || city.val() == ' ') {
		parentCity.text("Не указан адрес!");
		parentCity.css({'display' : 'block'});
		error = true;
	}

	if (error) {
		return;
	}


	window.location = "payConfirm.php?fio=" + fio.val() +
			"&mail=" + mail.val() +
			"&phone=" + phone.val() +
			"&city=" + city.val() +
			"&config=" + config;


}


var Item = {
	$countPhoto: $('#countPhoto'),
	$totalMoney: $('#totalMoney'),
	itemRender : function (logo) {
		//for(var item in settings) {
		//	alert(item);
		//}

		//alert(settings['10x15']['Глянцевая']);
		//
		var itemsSize = '';
		var itemSizeSelected = null;
		var selectItem = false;
		var itemsType = '';

		for (var item in Settings()) {
			itemsSize += '<option>' + item + '</option>';
			if (!selectItem) {
				itemSizeSelected = item;
				selectItem = !selectItem;
			}

		}

		for (var item in Settings()[itemSizeSelected]) {
			itemsType += '<option>' + item + '</option>';
		}


		var html = [
			' <div class="item_photo clearfix">',
			'    <img src="{{logo}}" alt="" class="logo">',
			'',
			'    <div class="row"><span>Размер</span>',
			'',
			'     <div class="select">',
			'      <select onchange="changeSelects.changeSize(this)" class="customize size">',
			'{{itemsSize}}',
			'      </select></div>',
			'    </div>',
			'    <div class="row"><span>Тип бумаги</span>',
			'',
			'     <div class="select">',
			'      <select onchange="changeMoney.reCount()" class="customize type">',
			'{{itemsType}}',
			'      </select></div>',
			'    </div>',
			'    <div class="row"><span>Кол-во фотографий</span>',
			'',
			'     <div class="spinner_container clearfix"><span class="spinner_value">1</span>',
			'      <span onclick="Spinner.changeValue(this)" class="spinner_button decrement float_l">-</span>',
			'      <span onclick="Spinner.changeValue(this)" class="spinner_button increment float_r">+</span></div>',
			'    </div>',
			'    <div onclick="Item.itemDelete(this)" class="close"></div>',
			'   </div>',
			'',


		].join('')
				.replace(/\{\{logo\}\}/g, logo)
				.replace(/\{\{itemsSize\}\}/g, itemsSize)
				.replace(/\{\{itemsType\}\}/g, itemsType);
		return html;
	},

	itemDelete   : function (_this) {
		var $parent = $(_this).parent().closest('.item_photo');
		$parent.remove();
		changeMoney.reCount();
	},
	itemDeleteAll: function () {
		var $itemsPhoto = $('.item_photo');


		$itemsPhoto.each(function (index) {
			var $element = $(this);
			$element.remove();
			changeMoney.reCount();
		});
	},

};












