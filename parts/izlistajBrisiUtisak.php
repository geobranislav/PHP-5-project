<?php
	if(isset($_POST['brisiUtisak'])){
			
			$sql = "DELETE FROM utisci WHERE utisakID=".$_POST['txtIdUtisak']."";
				$result = mysqli_query($con, $sql);
				if (! $result)
					echo "nije proslo brisanje";
				
			
			
		}
	
	
	$sql =  "SELECT utisci.utisak, utisci.utisakID, korisnik.ime FROM utisci inner join korisnik on (utisci.korisnikID=korisnik.korisnikID) ";
			$result = mysqli_query($con, $sql);
			if (! $result)
				echo "nije prosao select";
			else
			{
				
				
				while($row = mysqli_fetch_array($result))
				{
					echo "<div class=\"utisci\">";
 
						echo "<span class=\"koKaciutisak\">".$row['ime'].":<span>";
						echo "<span class=\"utisak\">".$row['utisak']."</span>";
						
						echo('<form action="" method="post" class="formBrisanje">'); 
				        echo('<input type="hidden" name="txtIdUtisak" value="'. $row['utisakID'] .'" />'); 
						echo('<input type="submit" name="brisiUtisak" value="x" class="dugmeBrisi"> ');
						echo('</form>');
						
						
						    
					echo "</div>";
					echo "<br>";
				}
				
				
			}
	
	
			    

?>