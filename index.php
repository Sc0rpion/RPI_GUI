<?php	
date_default_timezone_set('UTC');
if (isset($_POST['procedure']) && isset($_POST['ip'])) {
	setcookie("package",isset($_POST['package'])?trim($_POST['package']):' ');
	setcookie("ip",isset($_POST['ip'])?trim($_POST['ip']):' ');
	setcookie("task_id",intval(isset($_POST['task_id'])?trim($_POST['task_id']):' '));}
	
	//	Найстройки/Settings
	$folder = ".";  			// Папка играми, '.' категория где и index.php 	// Folder with Games, '.' folder where index.php, last simbol must be '/'
	$folder_log = './extra/';  	// Папка с логами				   				// Folder with logs,  '.' folder where index.php, last simbol must be '/'
	$lang = "rus";				// Переключение языка, rus						// Select language, for english set "eng"
	?>		
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>PS4 Remote Package Installer GUI</title>
		<link href="icons/favicon.ico" rel="shortcut icon" type="image/x-icon">
		<link rel="apple-touch-icon" href="icons/apple-touch-icon.png">
		<link rel="apple-touch-icon" sizes="57x57" href="icons/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="72x72" href="icons/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="icons/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="114x114" href="icons/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="icons/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="icons/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="icons/apple-touch-icon-152x152.png">
		<?php
			// For mobile
			$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
			$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
			$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
			$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
			$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
			$mobile = strpos($_SERVER['HTTP_USER_AGENT'],"Mobile");
			$symb = strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
			$operam = strpos($_SERVER['HTTP_USER_AGENT'],"Opera M");
			$htc = strpos($_SERVER['HTTP_USER_AGENT'],"HTC_");
			$fennec = strpos($_SERVER['HTTP_USER_AGENT'],"Fennec/");
			$winphone = strpos($_SERVER['HTTP_USER_AGENT'],"WindowsPhone");
			$wp7 = strpos($_SERVER['HTTP_USER_AGENT'],"WP7");
			$wp8 = strpos($_SERVER['HTTP_USER_AGENT'],"WP8");
			
			if ($iphone || $android || $palmpre || $ipod || $berry || $mobile || $symb || $operam || $htc || $fennec || $winphone || $wp7 || $wp8 === true) {
				$brow = 1;
				echo '<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />';
			}
			?>
		<style>
			body {
				padding: 10px;
			background: url(./extra/images/qwe.jpg) no-repeat;
			background-size: auto; 
			}
			.content-title {
			padding: 0px 20px;
			margin: 1px;
			background: #003263;
			color: #fff;
			border: 1px solid #6392b1;
			}
			.contentblock {
			margin: 10px;
			}
			.flex-container {
			padding: 0;
			margin: 0;
			list-style: none;
			display: -webkit-box;
			display: -moz-box;
			display: -ms-flexbox;
			display: -webkit-flex;
			display: flex;
			-webkit-flex-flow: row wrap;
			justify-content: space-around;
			}
			.flex-item {
			padding-top: 20px;
			width: 350px;
			height: 200px;
			}
			select {
			width: 350px; /* Ширина списка в пикселах */
			}
			.credits{overflow:hidden;left:50%;font-size:16px;font-family:sans-serif;text-align:center;}
		</style>
		<script type="text/javascript">
			function WhereYouWillSend(a){document.getElementById('url').value=a;document.getElementById('url').size=50;};
		</script>
	</head>
	<body>
		<div class= "content-title">
			<center>
				<h1>PS4 Remote Package Installer GUI v0.1</h1>
			</center>
		</div>
		<ul class="flex-container">
			<li class="flex-item">
				<b>Install PKG</b>
				<form action="index.php" method="POST">
					<p>ip ps4: <input type="text" name="ip" required pattern="^([0-9]{1,3}\.){3}[0-9]{1,3}$" value="<?php echo isset($_COOKIE['ip'])?$_COOKIE['ip']:''; ?>"/></p>
					<p>url pkg (http://): <input type="text" id="url" size="" name="package" value="http://"/></p>
					<?php
						echo '<select onchange="WhereYouWillSend(this.value)">
							 <option value="http://" selected="">'.lang_echo($lang, "set_PKG",0,0,0,0,0,0).'</option>';
						allDir($folder,$files);
						echo '</select>';
						        ?>
					<input type="hidden" name="procedure" value="install">
					<p><input type="submit" /></p>
				</form>
			</li>
			<li class="flex-item">
				<b>Status install</b>
				<form action="index.php" method="POST">
					<p>ip ps4: <input type="text" name="ip" required pattern="^([0-9]{1,3}\.){3}[0-9]{1,3}$" value="<?php echo isset($_COOKIE['ip'])?$_COOKIE['ip']:''; ?>"/></p>
					<p>task_id: <input type="text" name="task_id" value="<?php echo isset($_COOKIE['task_id'])?$_COOKIE['task_id']:' '; ?>"/>
						<input type="hidden" name="procedure" value="get_task_progress">
					<p><input type="submit" /></p>
				</form>
			</li>
		</ul>
		<?php
			$package = isset($_POST['package'])?trim($_POST['package']):' ';
			$ip = isset($_POST['ip'])?trim($_POST['ip']):' ';
			$procedure = isset($_POST['procedure'])?trim($_POST['procedure']):' ';
			$task_id = intval(isset($_POST['task_id'])?trim($_POST['task_id']):' ');
			
			if (isset($_POST['procedure']) && isset($_POST['ip'])) {
			
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
			
			if ($status == 'fail') {$error = parse("error",$result); $error_r = parse("error_code",$result); echo lang_echo($lang, "something_wrong", $error, $error_r,0,0,0,0);}
			if ($status == 'success' && $procedure == 'install') {
				$task_id = parse("task_id",$result); $title = parse("title",$result); 
				echo lang_echo($lang, "install_start", $title, $task_id,0,0,0,0);		
				write_file($folder_log."task_id.txt","\n".json_encode(array($task_id,$title)));	
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
				if ($error == 0 && $transferred_total == $length_total) { echo lang_echo($lang, "install_success",0,0,0,0);} else
				echo lang_echo($lang, "status_install",$num_index,$num_total,$rest_sec_total,$percents,$transferred_total,$length_total);
			}
			write_file($folder_log."logs.txt","\n".date(DATE_RFC822)."		$procedure		$result");			//write logs
			} else echo lang_echo($lang, "curl_error",0,0,0,0,0,0);
			
			} else echo lang_echo($lang, "empty_all",0,0,0,0,0,0);
			
			echo "<br><br>". last_install($folder_log);
			?>
		</p>
		<div id=footer class=credits>
			<center>
				<br>
				<ul style=list-style:none;padding-left:0>
					<li>Developers</li>
					<li><a link="0000FF" href="https://github.com/flatz">Remote Package Installer - <b>flatz</b></a></li>
					<li><a style="color: rgb (255, 255, 255)" href="https://github.com/Sc0rpion">WEB GUI - <b>Sc0rpion</b></a></li>
				</ul>
			</center>
		</div>
	</body>
</html>
<?php
	// Functions
	
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
	
		function last_install($folder_log){
	  	  if (file_exists($folder_log."task_id.txt")){
	    	  $f = fopen ($folder_log."task_id.txt", "r"); 
	    while (($s = fgets($f)) !== false)
	          $last_line = $s;
		$last = json_decode($last_line);
	    return "Last install <em>Game</em>: <b>$last[1]</b>, <em>task_id</em>: <b>$last[0]</b";
	   }}
	  
	   function parse($arg,$string){
	   if(preg_match("/\"$arg\": (.*?),/",str_replace('}', ",", $string),$matches)){ $text = str_replace('"', "", $matches[1]);} else {$text = '';}
	   return $text;
	   }
	  
	   function write_file($file, $text){
	     	$filelog = fopen($file,"a+"); 
	     	fwrite($filelog,$text); 
	     	fclose($filelog);
	   }
	  
	  function lang_echo($lang, $text, $arg1, $arg2, $arg3, $arg4,$arg5,$arg6){
		  if ($text == 'empty_all' && $lang == 'eng') return ("Set the IP and URL to install or task_id to get the installation status");
		  if ($text == 'empty_all' && $lang == 'rus') return ("Укажите IP и URL для установки или task_id для получения статуса установки");
		  if ($text == 'curl_error' && $lang == 'eng') return ("No connection with PS4, or not installed cURL");
		  if ($text == 'curl_error' && $lang == 'rus') return ("Нет связи с PS4, либо не установлен cURL");
		  if ($text == 'install_success' && $lang == 'eng') return ("All install successfully!");
		  if ($text == 'install_success' && $lang == 'rus') return ("Все установилось успешно!");		  
		  if ($text == 'something_wrong' && $lang == 'eng') return ("Something went wrong: ".$arg1.$arg2);
		  if ($text == 'something_wrong' && $lang == 'rus') return ("Что то пошло не так, ошибка: ".$arg1.$arg2);
		  if ($text == 'set_PKG' && $lang == 'eng') return ("Select * .PKG to install or enter URL");
		  if ($text == 'set_PKG' && $lang == 'rus') return ("Выберите *.PKG для установки или введите URL");
		  if ($text == 'install_start' && $lang == 'eng') return ("Success, game: $arg1 install, task_id: $arg2");
		  if ($text == 'install_start' && $lang == 'rus') return ("Успешно, игра: $arg1 устанавивается, task_id: $arg2");
		  if ($text == 'status_install' && $lang == 'eng') return ("Installing file №$arg1 of $arg2, time left $arg3 min., $arg4%. Copy $arg5 ГБ of $arg6 ГБ");
		  if ($text == 'status_install' && $lang == 'rus') return ("Устанавливается файл №$arg1 из $arg2, осталось всего времени $arg3 мин., $arg4%. Скопировалось $arg5 ГБ из $arg6 ГБ");
	  }
	?>
