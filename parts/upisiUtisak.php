<?php
if(isset($_POST['submitUtisak'])){
	//echo"ooooooooooo";
	        $uti=$_POST['utisak'];
			$kor=$_SESSION['korisnikID'];
			
			$sql = "insert into `utisci`(`utisak`,`korisnikID`)
			values
			('$uti','$kor')";


			$result = mysqli_query($con, $sql);
			if (! $result)
				echo "nije prosao upis";
}

?>