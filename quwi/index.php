<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div class="quwi__form">
	<form action="" method="POST">
		<input class="quwi__number-phone" name="numberPhone" placeholder="Номер телефона">
		<input class="quwi__api-token" name="apiToken" maxlength=125 placeholder="API Токен"> 
		<input class="quwi__search" type="submit" value="Поиск">
	</form>	
</div>


<?php 


	$numberPhone = $_POST["numberPhone"];
	$apiToken = $_POST["apiToken"];

	$url = curl_init();

	curl_setopt($url, CURLOPT_URL, 'https://edge.qiwi.com/funding-sources/v2/persons/' .$numberPhone. '/accounts');
	curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($url, CURLOPT_CUSTOMREQUEST, 'GET');


	$dataHeaders = array();
	$dataHeaders[] = 'Accept: application/json';
	$dataHeaders[] = 'Authorization: Bearer ' .$apiToken;
	curl_setopt($url, CURLOPT_HTTPHEADER, $dataHeaders);

	$result = curl_exec($url);

	$json = json_decode(($result), true);

/*var_dump($json['accounts'])*/ ; // преобразовываем строку в Ассоциативный JSON массив
/*echo 'Баланс ₽: '.$json['accounts']['0']['balance']['amount']*/


/*	echo $json['accounts']['0']['balance']['amount'];*/

	$infoUser = "Баланс: " . $json['accounts']['0']['balance']['amount'] . ".Руб";

	echo "<div class='quwi__result-box'>". $infoUser ."</div>";


	function test(){
		$infoUser = "";
	}
	test();


	if (curl_errno($url)) {
    	echo 'Error:' . curl_error($url);
	}
	curl_close($url);

?>


<script src="js/script.js"></script>
</body>
</html>