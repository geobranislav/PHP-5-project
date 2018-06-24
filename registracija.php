<?php
	
	$korisnik = array('ime' => '',
						'prezime' => '',
						'email' => '',
						'lozinka' => '',
						'potvrdaLozinke' => '');
						
	$validacijaUspesna = false;
	$tekstGreske = '';
	
	if (isset($_POST['btnProsledi']))
	{
		$korisnik['ime'] = trim($_POST['txtIme']);
		$korisnik['prezime'] = trim($_POST['txtPrezime']);
		$korisnik['email'] = trim($_POST['txtEmail']);
		$korisnik['lozinka'] = trim($_POST['txtLozinka']);
		$korisnik['potvrdaLozinke'] = trim($_POST['txtLozinka2']);

		$tekstGreske = 'Molimo Vas da popunite polje: ';
		
		$poljaPopunjena = true;
		
		foreach ($korisnik as $indeks => $vrednost)
		{

			if ($vrednost == '')
			{
				$tekstGreske .= $indeks . '; ';
				$poljaPopunjena = false;
			}
		}
		
		if ($poljaPopunjena)
		{
			$tekstGreske = '';
			if (strlen($korisnik['email']) < 8)
			{
				$tekstGreske = 'Vaša email adresa mora imati najmanje osam znakova';
			}
			else if (strpos($korisnik['email'], '@') === false)
			{
				$tekstGreske = 'Nemate @ znak unutar vaše email adrese';
			}
			else if (strpos($korisnik['email'], '@') < 2)
			{
				$tekstGreske = 'Pozicija @ znaka unutar vaše email adrese nije odgovarajuća';
			}
			else if ($korisnik['lozinka'] != $korisnik['potvrdaLozinke'])
			{
				$tekstGreske = 'Unete lozinke se ne poklapaju';
			}
			else
			{
				$validacijaUspesna = true;
				
				$korisnik['pol'] = trim($_POST['rbtnPol']);
				$korisnik['godinaRodjenja'] = trim($_POST['txtGodinaRodjenja']);
			}
		}
	}
	
?>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Registracija korisnika</title>
		<link href="style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div>
			<h1>Registracija korisnika</h1>
<?php
	if (!$validacijaUspesna)
	{
?>
			<p id="greska">
<?php
			echo($tekstGreske);
?>
			</p>
			<br />
			<form action="" method="post">
				<table style="margin: auto">
					<tr>
						<th><span class="obavezno-polje">*</span> Ime:</th>
						<td><input type="text" name="txtIme" size="40" value="<?php echo($korisnik['ime']); ?>" /></td>
					</tr>
					<tr>
						<th><span class="obavezno-polje">*</span> Prezime:</th>
						<td><input type="text" name="txtPrezime" size="40" value="<?php echo($korisnik['prezime']); ?>" /></td>
					</tr>
					<tr>
						<th><span class="obavezno-polje">*</span> Email:</th>
						<td><input type="text" name="txtEmail"  size="40" value="<?php echo($korisnik['email']); ?>" /></td>
					</tr>
					<tr>
						<th><span class="obavezno-polje">*</span> Lozinka:</th>
						<td><input type="password" name="txtLozinka" size="40" /></td>
					</tr>
					<tr>
						<th><span class="obavezno-polje">*</span> Potvrda lozinke:</th>
						<td><input type="password" name="txtLozinka2" size="40" /></td>
					</tr>
					<tr>
						<th>Pol:</th>
						<td><input type="radio" name="rbtnPol" value="z" checked="true" />Ženski <input type="radio" name="rbtnPol" value="m" />Muški</td>
					</tr>
					<tr>
						<th>Godina rođenja:</th>
						<td><input type="text" name="txtGodinaRodjenja" size="5" /></td>
					</tr>
					
					
					
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" name="btnProsledi" value="Prosledi" /></td>
					</tr>
				</table>
			</form>
<?php
	}

	else
	{
		$con = @mysqli_connect("localhost", "root", "", "baneprojekat");
			if (! $con) die("Nije uspela konekcija na server.");
			
			$I=$korisnik['ime'];
			$P=$korisnik['prezime'];
			$e=$korisnik['email'];
			$l=$korisnik['lozinka'];
			$po=$korisnik['pol'];
			$g=$korisnik['godinaRodjenja'];
			
			
			$sql = "insert into `korisnik`(`ime`,`prezime`,`email`,`lozinka`,`godRodj`,`pol`)
					values
					('$I','$P','$e','$l','$g','$po')";


			$result = mysqli_query($con, $sql);
			if (! $result)
				echo "nije prosao select";
			
		
			header('Location: log.php');	
			

	}
?>
		</div>
	</body>
</html>