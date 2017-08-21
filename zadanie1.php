<?php
	$zwrot;
	if((isset($_POST["number"])&&isset($_POST["message"])) && 
	   (!empty($_POST["number"])&&!empty($_POST["message"]))){
			//to check actual user(is www-data) uncomment below line
			//$zwrot=shell_exec("whoami");
			//escapecharacters telefon and message
			$numer = preg_replace('/[^0-9\+]/', '', strip_tags(html_entity_decode($_POST["number"])));
			$wiadomosc = preg_replace('/[^a-zA-Z0-9\s]/', '', strip_tags(html_entity_decode($_POST["message"])));
			$zwrot=shell_exec("/var/www/html/shell/zadanie1_script \"".$numer."\" \"".$wiadomosc."\"");
			//tutaj co ma się wykonać
			//$zwrot=$_POST["number"];
			//jeżeli w zwrocie nie ma słowa error zwroc nr telefonu
			//else zwroc error
			$pos = strpos($zwrot, 'ERROR');
			if($pos == false){
				$zwrot = "OK";
			}else{
				//in $zwrot is debug info
			}
	}else{
			
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<title>SMS Sender</title>
	</head>
	<body>
	<div class="form-style-8">
	<?php
		if($zwrot=="OK"){echo "<h3>Pomyślnie wysłano wiadomość! ".$zwrot."<br><br><h3>";}
		else if(!empty($zwrot)){ echo "<h3>Coś poszło nie tak: ".$zwrot."<br></h3>";}
	?>
		<h2>SMS Sender</h2>
		<form method="POST">
			<table>
				<tr>
					<td>
						Numer odbiorcy:
					</td>
					<td>
						<input type="tel" name="number" placeholder="+(48) 555-555-555">
					</td>
				</tr>
				<tr>
					<td>
						Wiadomość:
					</td>
					<td>
						<input type="text" name="message" placeholder="Tu wpisz swoją wiadomość...">
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<input type="submit" value="Wyślij wiadomość">
					</td>
				</tr>
			</table>
		</form>
		</div>
		
	</body>
</html>
