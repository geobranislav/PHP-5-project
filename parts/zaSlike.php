 <?php
		    $sql = "SELECT * from slike";
			$result = mysqli_query($con, $sql);
			if (! $result)
				echo "nije prosao select";
			else
			{
				
				
				while($row = mysqli_fetch_array($result))
				{
					echo "<div class=\"zaglavljeSlike\">"; 
						echo "<p class=\"koKaciSl\">".$row['koKaci'].":<p><br>";
						echo "<p class=\"opisSlike\">".$row['opis']."</p>";
						echo "<img  src=\"photos/".$row['slika']."\" class=\"slika\" width=\"300px\"><br><br>";
						echo('<form action="" method="post">'); 
				        echo('<input type="hidden" name="txtIdKomentar" value="'. $row['slikeID'] .'" />'); 
						echo('<label>komentar: </label>');
						echo('<input type="text" name="komentar" placeholder="unesi komentar">	');
						echo('<input type="submit" name="komen" value="prosledi">');
						echo('</form>');
						
						
						    $sqli = "SELECT * FROM komentarise inner join korisnik on (komentarise.korisnikID=korisnik.korisnikID) WHERE slikeID=".$row['slikeID']." ";
		    
								$resulti = mysqli_query($con, $sqli);
								if (! $resulti)
									echo "nije prosao select";
								else
								{
									
									
									while($rod = mysqli_fetch_array($resulti))
									{   
										echo"<div class=\"komentari\">";
										echo "<span class=\"koKomentarise\">".($rod['ime']).": </span>";
									    echo($rod['komentar']);
										echo"<br><br>";
										echo"</div>";
									}
									
									
								}
						//}
						//if(!empty($row['komentar']))echo($row['komentar']);
						//echo($row['komentar']);
					echo "</div>";
					echo "<br>";
				}
				//header();
				
			}
			    
		 ?>
		<?php
		if (isset($_POST['komen'])){
		 
			$kor=$_SESSION['korisnikID'];
			$sli=$_POST['txtIdKomentar'];
			$kom=$_POST['komentar'];
			
			$sql = "insert into `komentarise`(`korisnikID`,`slikeID`,`komentar`)
			values
			('$kor','$sli','$kom')";


			$result = mysqli_query($con, $sql);
			if (! $result)
				echo "nije prosao upis";
				

			
			$bane=true;
				if($bane){
					echo('<script>');
					echo('window.location.assign("index.php");');
					echo('</script>');
					$bane=false;
					global $bane;
					 //header( "refresh:5;" );
				}
				
		}
		 
		 
		 
		 ?>