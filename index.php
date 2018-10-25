<?php	if (isset($_GET['procedure']) && isset($_GET['ip'])) {
		setcookie("package",isset($_GET['package'])?trim($_GET['package']):' ');
		setcookie("ip",isset($_GET['ip'])?trim($_GET['ip']):' ');
		setcookie("task_id",intval(isset($_GET['task_id'])?trim($_GET['task_id']):' '));}
		
		//Найстройки
		$folder = ".";  // Папка играми, '.' категория где и index.php
		
		function allDir($dir,&$files)
		{
		    $result = scandir($dir);
		    unset($result[0],$result[1]);
		    foreach($result as $v)
		    {
		        if (is_dir($dir."/".$v)) 
		        {
		            allDir($dir."/".$v,$files);
		        }
		        else 
		        {
				    if(($dir."/".$v ==".") || ($dir."/".$v=="..") || (strpos($dir."/".$v,'.pkg' ) === false)) continue;
		            $files[] = $dir."/".$v;
					$fil = $dir."/".$v;
				    $path = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
				    $fold = substr($path, 0, -strlen(basename($path))-1); 
					$file = substr($fil, 1);
					
					if ($dir != $oldFold) {echo '<optgroup label="'.$dir.'">';}
					
				    echo   '<option value="'.$fold.$file.'">'.basename($file).'</option>'; 
					$oldFold = $dir;
		        }
		    }
		}
		$files = array();
		$oldFold = '';
		?>		

<!DOCTYPE HTML>

<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>PS4 Remote Package Installer GUI</title>
  
  <script type="text/javascript">
  function WhereYouWillSend(a){document.getElementById('url').value=a;document.getElementById('url').size=50;};
</script>
  
  
 </head>
 <body>
	<center><h1>PS4 Remote Package Installer GUI</h1></center>
	 <b>Установка PGK</b>
<form action="index.php" method="get">
 <p>ip ps4: <input type="text" name="ip" required pattern="^([0-9]{1,3}\.){3}[0-9]{1,3}$" value="<?php echo isset($_COOKIE['ip'])?$_COOKIE['ip']:' '; ?>"/></p>
 
 <p>url pkg (обязательно с http://): <input type="text" id="url" size="" name="package" value="http://"/></p>
 
 <?php
echo '<select onchange="WhereYouWillSend(this.value)">
	<option value="http://" selected="">Выберите *.PKG для установки или введите URL</option>
	';

	allDir($folder,$files);	

 echo '</select>';
 ?>
 
 <input type="hidden" name="procedure" value="install">
 <p><input type="submit" /></p>
</form>
<br><b>Статус операции по task_id</b>
<form action="index.php" method="get">
 <p>ip ps4: <input type="text" name="ip" required pattern="^([0-9]{1,3}\.){3}[0-9]{1,3}$" value="<?php echo isset($_COOKIE['ip'])?$_COOKIE['ip']:' '; ?>"/></p>
 <p>task_id: <input type="text" name="task_id" value="<?php echo isset($_COOKIE['task_id'])?$_COOKIE['task_id']:' '; ?>"/>
 <?php
 if (file_exists("task_id.txt")){
	 $f = fopen ("task_id.txt", "r");
 
	 while (($s = fgets($f)) !== false)
	       $last_line = $s;
	 echo '<em>Последняя установка: </em>'.$last_line.'</p>';
	 fclose($f);
 }
 ?>
 <input type="hidden" name="procedure" value="get_task_progress">
 <p><input type="submit" /></p>
</form>
<br>
 </body>
</html>

<?php
	$package = isset($_GET['package'])?trim($_GET['package']):' ';
	$ip = isset($_GET['ip'])?trim($_GET['ip']):' ';
	$procedure = isset($_GET['procedure'])?trim($_GET['procedure']):' ';
	$task_id = intval(isset($_GET['task_id'])?trim($_GET['task_id']):' ');

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
	
	if ($result == TRUE) {

	$status = parse("status",$result);

	if ($status == 'fail') {$error = parse("error",$result); $error_r = parse("error_code",$result); echo "Что то пошло не так, ошибка: $error, $error_r";}
	if ($status == 'success' && $procedure == 'install') {
		$task_id = parse("task_id",$result); $title = parse("title",$result); 
		echo "Успешно, игра: $title устанавивается, task_id: $task_id"; 
		echo '<br><b><p><a href="'."?ip=$ip&task_id=$task_id&procedure=get_task_progress".'">Проверить операцию task_id: '.$task_id.'</a></p></b>'; 		
		//Начинается запись в файл task_id.txt
		$filelog = fopen("task_id.txt","a+"); 
		fwrite($filelog,"\n task_id: $task_id   game: $title"); 
		fclose($filelog);
	}
	if ($status == 'success' && $procedure == 'get_task_progress') {
//		$length = round((hexdec(parse("length",$result)))/1000000000, 3);
//		$transferred = round((hexdec(parse("transferred",$result)))/1000000000, 3);
		$length_total = round((hexdec(parse("length_total",$result)))/1000000000, 3);
		$transferred_total = round((hexdec(parse("transferred_total",$result)))/1000000000, 3);
		$num_index = parse("num_index",$result);
		$num_total = parse("num_total",$result);
//		$rest_sec = parse("rest_sec",$result);
		$rest_sec_total = round(parse("rest_sec_total",$result)/60, 1);
		$preparing_percent = parse("preparing_percent",$result);
//		$local_copy_percent = parse("local_copy_percent",$result);
		$error = parse("error",$result);
//		$bits = (hexdec(parse("bits",$result))); 
		$percents = round($transferred_total * 100 / $length_total); 
		if ($error == 0 && $transferred_total == $length_total) { echo 'Все установилось успешно!';} else
		echo "Устанавливается файл №$num_index из $num_total, осталось всего времени $rest_sec_total мин., $percents%. Скопировалось $transferred_total ГБ из $length_total ГБ";
	}

} else echo 'Нет связи с PS4, либо не установлен cURL.';

} else echo 'Укажите IP и URL для установки или task_id для получения статуса установки';

	function parse($arg,$string){
	if(preg_match("/\"$arg\": (.*?),/",str_replace('}', ",", $string),$matches)){ $text = str_replace('"', "", $matches[1]);} else {$text = '';}
	return $text;
	}
?>
<br><br>
<form method="link" action="javascript:document.location.reload()"><input type="submit" value="update" onClick="this.value = 'updating...'"></form></p>
<br><br> Developed by <b>Sc0rpion</b>, v0.04
