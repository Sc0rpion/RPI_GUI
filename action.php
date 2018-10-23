<!DOCTYPE HTML>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>PS4 Remote Package Installer</title>
 </head>
 <body>
	 <b>Установка PGK</b>
<form action="action.php" method="get">
 <p>ip ps4: <input type="text" name="ip" /></p>
 <p>url pkg (обязательно с http://): <input type="text" name="package" /></p>
 <input type="hidden" name="procedure" value="install">
 <p><input type="submit" /></p>
</form>
<br><br><b>Проверка операции по task_id</b>
<form action="action.php" method="get">
	<p>ip ps4: <input type="text" name="ip" /></p>
 <p>task_id: <input type="text" name="task_id" /></p>
 <input type="hidden" name="procedure" value="get_task_progress">
 <p><input type="submit" /></p>
</form>
<br><br>
 </body>
</html>

<?php

	$package = isset($_GET['package'])?$_GET['package']:' ';
	$ip = isset($_GET['ip'])?$_GET['ip']:' ';
	$procedure = isset($_GET['procedure'])?$_GET['procedure']:' ';
	$task_id = intval(isset($_GET['task_id'])?$_GET['task_id']:' ');

	if (isset($_GET['procedure']) && isset($_GET['ip'])) {

	$type = 'direct';
	$packages[] = $package;

	if ($procedure == 'install') {$data = array("type" => $type, "packages" => $packages);} 
	if ($procedure == 'get_task_progress') {$data = array("task_id" => $task_id);}                                                                
	$data_string = json_encode($data);                                                                                   
                                                                                                                     
	$ch = curl_init("http://$ip:12800/api/$procedure");                                                                      
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                      
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
	    'Content-Type: application/json',                                                                                 
	    'Content-Length: ' . strlen($data_string))                                                                       
	);                                                                                                                   
                                                                                                                     
	$result = curl_exec($ch);
	curl_close($ch);

	$status = parse("status",$result);

	if ($status == 'fail') {$error = parse("error",$result); $error_r = parse("error_code",$result); echo "Что то пошло не так, ошибка: $error, $error_r";}
	if ($status == 'success' && $procedure == 'install') {$task_id = parse("task_id",$result); $title = parse("title",$result); echo "Успешно, игра: $title устанавивается, task_id: $task_id";}
	if ($status == 'success' && $procedure == 'get_task_progress') {
		$length = round((hexdec(parse("length",$result)))/1000000000, 3);
		$transferred = round((hexdec(parse("transferred",$result)))/1000000000, 3);
		$length_total = round((hexdec(parse("length_total",$result)))/1000000000, 3);
		$transferred_total = round((hexdec(parse("transferred_total",$result)))/1000000000, 3);
		$num_index = parse("num_index",$result);
		$num_total = parse("num_total",$result);
		$rest_sec = parse("rest_sec",$result);
		$rest_sec_total = round(parse("rest_sec_total",$result)/60, 1);
		$preparing_percent = parse("preparing_percent",$result);
		$local_copy_percent = parse("local_copy_percent",$result);
		$error = parse("error",$result);
		$bits = (hexdec(parse("bits",$result))); 
		$percents = round($transferred_total * 100 / $length_total); 
		if ($error == 0 && $transferred_total == $length_total) { echo 'Все установилось успешно!';} else
		echo "Устанавливается файл №$num_index из $num_total, осталось всего времени $rest_sec_total мин., $percents%. Скопировалось $transferred_total ГБ из $length_total ГБ";
	}

} else {echo 'Укажите IP и URL для установки или task_id';}
	function parse($arg,$string){
	if(preg_match("/\"$arg\": (.*?),/",str_replace('}', ",", $string),$matches)){ $text = str_replace('"', "", $matches[1]);} else {$text = '';}
	return $text;
	}
	

?>
<br><br><br> Developed by <b>Sc0rpion</b>