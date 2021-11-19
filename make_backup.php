<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/secret.php';

$filename = make_archive($screen_name, $server_path);

$ch = curl_init('https://cloud-api.yandex.net/v1/disk/resources/upload?path=' . urlencode($backup_path . basename($filename)));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: OAuth ' . $token));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$res = curl_exec($ch);
curl_close($ch);
 
$res = json_decode($res, true);

if (empty($res['error'])) {

	echo "\n\n\n\n3";
	// Если ошибки нет, то отправляем файл на полученный URL.
	$fp = fopen($filename, 'r');

	print_r($fp);

	echo "\n\n\n\n3.1";
	
 	$ch = curl_init($res['href']);
	curl_setopt($ch, CURLOPT_PUT, true);
	curl_setopt($ch, CURLOPT_UPLOAD, true);
	curl_setopt($ch, CURLOPT_INFILESIZE, filesize($filename));
	curl_setopt($ch, CURLOPT_INFILE, $fp);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_exec($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);

	print_r($http_code);
	
	if ($http_code == 201) {
		echo 'Файл успешно загружен' . "\n\n\n";		
	}
} 