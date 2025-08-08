<?php // #начало Обработчик данных
header("Content-Type: text/html; charset=UTF-8");

if(isset($_POST['name'])) { $name = htmlspecialchars($_POST['name']); }
if(isset($_POST['phone'])) { $phone = htmlspecialchars($_POST['phone']); }
if(isset($_POST['hidden'])) { $hidden = htmlspecialchars($_POST['hidden']); }
$ip_r = $_SERVER['REMOTE_ADDR'];

$product = "Сервисный центр iPachino"; // Подпись отправителя

$name1 =  substr(htmlspecialchars(trim($name)), 1, 100); 
$phone1 =  substr(htmlspecialchars(trim($phone)), 1, 20);
	
$tema_r = 'ЗАКАЗ: на ремонт телефона';	 
$to = "ipachinokrsk@yandex.ru"; // ЗДЕСЬ МЕНЯЕМ ПОЧТУ НА КОТОРУЮ ПРИХОДЯТ ЗАКАЗЫ!
$from = "{$product} <noreply@{$_SERVER['HTTP_HOST']}>"; // Адрес отправителя

$subject = "=?utf-8?B?" . base64_encode("$tema_r") . "?=";
$header = "From: $from"; 
$header .= "\nContent-type: text/html; charset=\"utf-8\"";
$message = 'Имя: '.$name.' <br>Телефон: '.$phone.' 
 <br>Форма заказа: '.$hidden.' 

<br>Заказано с лендинга: '.$_SERVER['HTTP_REFERER'].' <br>IP адрес клиента: <a href="http://ipgeobase.ru/?address='.$ip_r.'">'.$ip_r.'</a><br>Время заказа: '.date("Y-m-d H:i:s").'';
?>

<?php if(mail($to, $subject, $message, $header)): ?>

<!-- ========================================================= НАЧИНАЕМ ФОРМИРОВАТЬ HTML СТРАНИЦУ ПОДТВЕРЖДЕНИЯ ======================================================== --> 
	
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8" />
	<meta name='robots' content='noindex,follow' />
	<title>iPachino обратный звонок!</title>
	<link rel="stylesheet" href="ccsl/style.css" />
	<style>
		#senks_block {color: #313E47;text-align: center;position: fixed;top: 10%;width: 100%;}
		#senks_block img {width: 185px;margin-bottom: 10px;}
		#senks_block h1 {font-size: 36px;font-weight: 700;text-transform: uppercase;color: rgba(9, 14, 100, 0.7);}
		.senks_text {line-height: 1.2;font-size: 18px;margin: 25px auto;}
		.senks_red {color: #fff;font-size: 19px;font-weight: bold;background: rgba(9, 14, 100, 0.7);height: 45px;line-height: 45px;}
	</style>
 
</head>
<body style="background-size: 100% 100%;">
	<div id="senks_block">
		<img src="index.png" alt="">
		<h1><?php if(isset($name)){echo $name;} ?><br>Заявка на обратный звонок принята!</h1>
		<p class='senks_text'>Ожидайте звонок от нашего оператора для подтверждения заказа.<br><br>Пожалуйста, проконтролируйте, чтобы ваш контактный телефон <b>"<?=$phone?>"</b> был включен.</p>
		<p class='senks_red'>Пожалуйста<?php if(isset($name)){echo " ".$name;} ?>, дождитесь звонка от оператора</p>
	</div>
</body>
</html>

<!-- ======================================================== ОКОНЧАНИЕ СТРАНИЦЫ ПОДТВЕРЖДЕНИЯ ======================================================== --> 
	
<?php endif; ?>