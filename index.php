<?php
session_start();

$con = @mysqli_connect("localhost", "root", "", "baneprojekat");
			if (! $con) die("Nije uspela konekcija na server.");

			$sql = "SELECT email FROM korisnik";
			$result = mysqli_query($con, $sql);
			if (! $result)
				echo "nije prosao select";
			else
			{
				

				while($row = mysqli_fetch_array($result))
				{
					if(!$_SESSION['korisnik']==$row['email']){
						header('Location: log.php');
					}
					
				}
			}
?>

<html>
<head>
    <meta charset="UTF-8">
    <link href="peki.css" type="text/css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="pp.png">
	<title>geoBRANISLAV</title>


</head>

<body>

<div id="glavni">
				
	<div id="header">
	    <?php include ("parts/izmena.php"); ?>
		<?php echo "welcome: ".$_SESSION["korisnikIme"]." ".$_SESSION["korisnikPrezime"];?><br>
		<a href="log.php">odjava</a>
		<div id="update">
		    <span onclick="sakriUpdate();">update</span>
			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" id="updateForm">
				<input type="text" name="izmIme" placeholder="izmeni ime"><br>
				<input type="text" name="izmPrezime" placeholder="izmeni prezime"><br>
				<input type="submit" name="update" value="izmeni">
			</form>
		
		</div>
	</div>

	<div id="content">
		
		<center>
         <?php @include ("parts/proveraGreskeSlike.php"); ?>
		 <h1>Postavljanje slike<h1>
		<?php include ("parts/zaSlike.php"); ?>

<!-- FORMA!!!!!! -->
		<p onclick="prikazi();" id="prikaz">ubaci sliku</p>
		
		<div id="forma">
		<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
			<label>izaberi sliku:</label>
			<input type="file" name="slika"/><br><br>
			<label>komentar:</label>
			<textarea name="komentar" rows="3" cols="40"></textarea>
			
			<p><input type="submit" name="upload" value="Postavi sliku"/></p>
		</form>
		</div>
<!-- KRAJ FORME!!!!!! -->

        
		
	
	</center>

		
	</div>

	<div id="sidebar">
	<?php include ("parts/upisiUtisak.php"); ?>
		<center><h5 class="zaNaslov">utisci o sajtu!</h5><hr>
		<form method="POST">
			<input type="text" name="utisak" placeholder="vas utisak">
			<input type="submit" name="submitUtisak" value="postaavi utisak">
		
		</form>
		</center>
		<?php include ("parts/izlistajBrisiUtisak.php"); ?>
		<hr><hr>
		
		<center><h5 class="zaNaslov">pretraga korisnika</h5>
		<form method="POST">
			<input type="text" name="txtPretraga" placeholder="ime za pretragu">
			<input type="submit" name="submitPretraga" value="pretrazi">
		
		</form>
		<?php include ("parts/pretraga.php"); ?>
		</center>
		
		
		
	</div>
	
	<div id="footer">
		<center><h4>Copyright &#169; 2018. |  Banislav Burmudzija</h4></center>
		
	</div>

</div>
<script>
		function prikazi(){
			document.getElementById("forma").style.display = "block";
		}
		function sakriUpdate(){
			document.getElementById("updateForm").style.display = "block";
		}
		
</script>
</body>

</html>
