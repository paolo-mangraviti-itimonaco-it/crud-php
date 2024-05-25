<!DOCTYPE html>
<html lang="it">
  <head>
    <title>Selezione Modifica</title>
  </head>
  <body>
    <h1>Seleziona Modifica</h1>
<?php
		$serverName = "localhost";
		$IPserver = "127.0.1";
		$username = "applicazioneWeb";
		$password = "123456_Web&&";
		$db = "listaeventi";

        $ID = $_GET['id'];

		// Stabilisce la connessione al DBMS remoto
		$connessione = mysqli_connect($serverName, $username, $password, $db);

		// Check connection
		if (!$connessione) { die("Errore connessione");	}

		$istruzioneSQL = "SELECT * FROM eventi WHERE ?";
		
        mysqli_stmt_bind_param($istruzioneSQL, "i",$ID);

		echo("<p>".$istruzioneSQL."</p>");
		
		$risultato = mysqli_query($connessione,$istruzioneSQL);

		echo("<p>".$istruzioneSQL."</p>");
		
		if (mysqli_num_rows($risultato) > 0) 
		{
			$riga = mysqli_fetch_assoc($risultato);
	?>
		<form method="post" action="modificaEvento.php">
			<input type="hidden" name="id" value="<?php echo($riga['id']);?>">
			<fieldset>
				<legend>Dati obbligatori</legend>
				<label for="titoloEvento">Titolo Evento</label>
				<input type="text" name="titoloEvento" id="titoloEvento"  value="<?php echo($riga['titolo']);?>">
				<label for="loc">Localit&agrave;</label>
				<input type="text" name="loc" id="loc" value="<?php echo($riga['localita']);?>">
				<label for="descrizione">Descrizione</label>
				<input type="text" name="descrizione" id="descrizione" value="<?php echo($riga['descrizione']);?>">
			</fieldset>
			<fieldset>
				<legend>Coordinate</legend>
				<label for="lat">latitudine</label> <input type="text" name="lat" id="lat" value="<?php echo($riga['lat']);?>"><br>
				<label for="lon">longitudine</label> <input type="text" name="lon" id="lon" value="<?php echo($riga['lon']);?>">
			</fieldset>
			<input type="submit" value="Modifica">
			<a href="./" style="margin-left: 30px;">Home comandi</a>
	<?php
		} 
		else 
			{ echo "Nessun risultato"; }

		mysqli_close($connessione);
    ?> 	
  
  </body>
</html>
