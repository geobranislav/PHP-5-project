<?php
//napomena: pre prvog pokretanja napraviti folder "photos"
	$oka=false;
	
	if( isset($_FILES["slika"]) ){
		//sledeća tri reda dodata radi testiranja
		//foreach($_FILES["slika"] as $id => $vred)
			//echo "$id = $vred<br>";
		//echo "<br><br>";

		//poruka u slučaju greške
		$errorMessage = "";
		//folder u koji se smešta slika
		$uploadPath = "./photos";
		//dozvoljeni fajlovi
		$allowedExt = array("jpg", "png", "gif");
		//dozvoljena veličina u bajtovima
		$allowedSize = 1024*1024; // 1 MB
		//maksimalna dozvoljena širina
		$maxWidth = 1200;
		//maksimalna dozvoljena visina
		$maxHeight = 900;

		//ime postavljenog fajla
		$fileName = $_FILES["slika"]["name"];
		//veličina postavljenog fajla
		$fileSize = $_FILES["slika"]["size"];
		//dimenzije postavljene slike
        $dim = GetImageSize( $_FILES["slika"]["tmp_name"] );
		//ekstenzija fajla
		//funkcija end pronalazi poslednji element niza
		$extension = strtolower( end( explode(".", $_FILES["slika"]["name"]) ) );
		//relativna putanja do postavljenog fajla
		$targetFile = $uploadPath."/".$fileName;
		
		//proverava se da li je nastala greška prilikom postavljanja fajla
		if( $_FILES["slika"]["error"] == UPLOAD_ERR_OK ){
		
			if( $fileSize > $allowedSize ) {
				$errorMessage = "Postavili ste preveliki fajl";
			} else {
				//proverava se da li je fajl dozvoljenog tipa
				if( !in_array($extension, $allowedExt) ){
					$errorMessage = "Postavili ste fajl pogrešnog tipa";
				} else {
					//proverava se da li je slika dozvoljenih dimenzija
					if ($dim[0]>$maxWidth || $dim[1]>$maxHeight){
						$errorMessage = "Slika ima veće dimenzije od dozvoljenih (1200x900)";
					} else {
						if (file_exists($targetFile)){
							$errorMessage = "Fajl sa tim nazivom već postoji";
						} else {
							//premeštanje postavljenog fajla iz privremenog foldera u 
							//predviđeni folder
							if( !@move_uploaded_file($_FILES["slika"]["tmp_name"], $targetFile) ){ 
								$errorMessage = "Neuspelo premeštanje postavljenog fajla 
												iz privremenog foldera u folder \"$uploadPath\"";
								
							} else {
							/*
								//preimenovanje fajla
								$newName = "slika123";
								$newTargetFile = "$uploadPath/$newName.$extension";
								if( !rename($targetFile, $newTargetFile) ) {
									$errorMessage = "Neuspelo automatsko preimenovanje fajla";
								} else {
									$targetFile = $newTargetFile;
								}
							*/
							$oka=true;
							global $oka;
							}
						}
					}
				}
			}
			
		} else {
			//kod greške se prebacuje u poruku
			switch( $_FILES["slika"]["error"] ) {
				case UPLOAD_ERR_INI_SIZE: 
					$errorMessage = "Veličina prenetog fajla je veća od maksimalne
					dozvoljene na osnovu podešavanja u php.ini";
					break; 
				case UPLOAD_ERR_FORM_SIZE: 
					$errorMessage = "Veličina prenetog fajla je veća od maksimalne
					dozvoljene na osnovu podešavanja u HTML formi"; 
					break; 
				case UPLOAD_ERR_PARTIAL: 
					$errorMessage = "Proces prenosa fajla je delimično izvršen"; 
					break; 
				case UPLOAD_ERR_NO_FILE: 
					$errorMessage = "Nikakav fajl nije prenet"; 
					break; 
				case UPLOAD_ERR_NO_TMP_DIR: 
					$errorMessage = "Nedostaje privremeni direktorijum"; 
					break; 
				case UPLOAD_ERR_CANT_WRITE: 
					$errorMessage = "Fajl ne može biti zapisan na disk"; 
					break; 
				case UPLOAD_ERR_EXTENSION: 
					$errorMessage = "Prenos fajla zaustavljen od strane PHP ekstenzije"; 
					break; 
	            default: 
					$errorMessage = "Nepoznata greška prilikom prenosa fajla"; 
			}
			
		}
		
		if($errorMessage) echo $errorMessage."<hr>";
		else echo "proslo je bez greske<br>";

	}
	
	if((isset($_POST['upload']))&&($oka)){
		$con = @mysqli_connect("localhost", "root", "", "baneprojekat");
			if (! $con) die("Nije uspela konekcija na server.");
			
			$sl=$_FILES['slika']['name'];
			$op=$_POST['komentar'];
			$ko=$_SESSION["korisnikIme"];
			
			$sql = "insert into `slike`(`slika`,`opis`,`koKaci`)
					values
					('$sl','$op','$ko')";


			$result = mysqli_query($con, $sql);
			if (! $result)
				echo "nije prosao upis slike u bazu";
			else echo "uneto u bazu";
			
	
		
	}
	
?>	