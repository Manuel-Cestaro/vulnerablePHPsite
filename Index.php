
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
</head>
<body>
	<form method="POST">
		<br><br>
		<div class="form">
			<input id="inputNome" autocomplete="off" type="text" name="Username" required>
			<label  class="label-name" id="label1">
				<span>Username</span>
			</label>
			<br><br>
			<input id="inputPassword" autocomplete="off" type="password" name="Password" required>
			<label class="label-name" id="label2">
				<span>Password</span>
			</label>
			<br><br>
			<input id="accedi" type="submit" name="submit" value="ACCEDI">
			</div>
	</form>
	
<?php
	include 'connessione.php';
	if(isset($_POST['submit']))
	{
		$username=$conn->real_escape_string(substr( $_POST['Username'], 0, 30 ));
		$password=$conn->real_escape_string(substr( $_POST['Password'], 0, 30 ));
		
		$ammessi = "abcdefghijklmnopqrstuvwxyzòèàùì@é .:,;€%ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$vietate = array ("select", "insert", "update", "delete", "drop", "alter", "––", "'");
		
		$userok = true;
		for( $pos=0; $pos<strlen($username) && $userok; $pos++ )
		{
			$car = substr($username, $pos, 1);
			if ( strpos($ammessi, $car) === false ) 
				$userok = false;
		}

		$pwdok = true;
		for( $pos=0; $pos<strlen($password) && $pwdok; $pos++ )
		{
			$car = substr($password, $pos, 1);
			if ( strpos($ammessi, $car) === false ) 
				$pwdok = false;
		}
		
		$userok2 = true;
		for( $k=0; $k <= 7 && $userok2; $k++ )
			if ( strpos($vietate[$k], $username) !== false ) 
				$userok2 = false;

		$pwdok2 = true;
		for( $k=0; $k <= 7 && $pwdok2; $k++ )
			if ( strpos($vietate[$k], $password) !== false )
				$pwdok2 = false;
		
		if ($userok and $pwdok and $userok2 and $pwdok2)
		{
			$sql="SELECT * FROM users WHERE UserName='$username'";
			$risultato=$conn->query($sql);
			$conta = $risultato->num_rows;
			if($conta==1)
			{	
				$row=$risultato->fetch_assoc();
				if($password==$row['Password'])
				{
					session_start();
					$_SESSION['Id']=$row['Id'];
					header("location:UploadFile.php");
				}
				else
					print("<p class='errore'>Password errata</p>");
			}
			else
				print("<p class='errore'>Username errato</p>");
		}
		else
		print("<p id='errore2'>Dati inseriti non accettabili</p>");
	} 
?>
</body>
</html>
