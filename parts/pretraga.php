<?php

//echo"rrrrrrrrrr";
if(isset($_POST['submitPretraga'])){
	$pre=$_POST['txtPretraga'];
	
	$sql =  "SELECT korisnik.ime, korisnik.prezime FROM korisnik WHERE  (ime like '%".$pre."%')or(prezime like '%".$pre."%')";
			$result = mysqli_query($con, $sql);
			if (! $result)
				echo "nije prosao select";
			else
			{
				while($row = mysqli_fetch_array($result))
				{
					echo "<div class=\"rezPretrage\">";
						echo $row['ime']." ";
						echo $row['prezime'];
						    
					echo "</div>";
					echo "<br>";
				}
				
				
			}
	
	
	
}

?>