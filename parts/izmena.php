<?php
if(isset($_POST['update'])){
	
	if($_POST['izmIme']=="")
		$_POST['izmIme']=$_SESSION['korisnikIme'];
	if($_POST['izmPrezime']=="")
		$_POST['izmPrezime']=$_SESSION['korisnikPrezime'];
	
	$sql = "UPDATE `korisnik` SET korisnik.ime ='".$_POST['izmIme']."', korisnik.prezime ='".$_POST['izmPrezime']."' WHERE korisnikID=".$_SESSION['korisnikID']."";
			$result = mysqli_query($con, $sql);
			if (! $result)
				echo "nije prosao select";
			else{
				$_SESSION['korisnikIme']=$_POST['izmIme'];
				$_SESSION['korisnikPrezime']=$_POST['izmPrezime'];

				
			}
	
}
?>