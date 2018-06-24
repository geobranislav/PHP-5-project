<?php
session_start(); 

$con = @mysqli_connect("localhost", "root", "", "baneprojekat");
			if (! $con) die("Nije uspela konekcija na server.");

			if (isset($_SESSION["korisnik"])){
				$sql = "SELECT email FROM korisnik";
				$result = mysqli_query($con, $sql);
				if (! $result)
					echo "nije prosao select";
				else
				{
					

					while($row = mysqli_fetch_array($result))
					{
						if($_SESSION["korisnik"]==$row['email']){// KAKO DA IZBEGNEM DA MI OVDE, PROMENLJIVA $_SESSION["korisnik"] 
							session_destroy();
						}
						
					}
				}
			}

?>

<?php
	$korisnik = array( 
						'email' => '',
						'lozinka' => '');
					
	if (isset($_POST['btnProsledi']))
	{
		$korisnik['email'] = trim($_POST['txtEmail']);
		$korisnik['lozinka'] = trim($_POST['txtLozinka']);
		
		
		
			$sql = "SELECT korisnikID, ime, prezime, email, lozinka FROM korisnik";
			$result = mysqli_query($con, $sql);
			if (! $result)
				echo "nije prosao select";
			else
			{
				

				while($row = mysqli_fetch_array($result))
				{
					if(($korisnik['email']==$row['email'])&&($korisnik['lozinka']==$row['lozinka'])){
						$_SESSION["korisnik"] = $korisnik['email'];
						$_SESSION["korisnikIme"] = $row['ime'];
						$_SESSION["korisnikPrezime"] = $row['prezime'];
						$_SESSION["korisnikID"] = $row['korisnikID'];
						
						header('Location: index.php');
					}
					
				}
			}

		
		
		
	}
	
?>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>LOG IN</title>
		<link href="style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div>
			<h1>LOG IN</h1>

			
			</p>
			<br />
			<form action="" method="post">
				<table style="margin: auto">
					<tr>
						<th> Email:</th>
						<td><input type="text" name="txtEmail"  size="40" value="<?php echo($korisnik['email']); ?>" /></td>
					</tr>
					<tr>
						<th> Lozinka:</th>
						<td><input type="password" name="txtLozinka" size="40" /></td>
					</tr>
					
					
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" name="btnProsledi" value="log in" /></td>
					</tr>
				</table>
			</form>
            <a href="registracija.php">registracija</a>
		</div>
	</body>
</html>