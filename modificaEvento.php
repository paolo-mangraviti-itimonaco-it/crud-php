<!DOCTYPE html>
<html lang="it">
  <head>
    <title>Modifica Evento</title>
  </head>
  <body>
    <h1>Modifica evento</h1>
    <?php
      $serverName = "localhost";
      $IPserver = "127.0.1";
      $username = "applicazioneWeb";
      $password = "123456_Web&&";
      $db = "listaeventi";
      
      // Stabilisce la connessione al DBMS remoto
      $connessione = mysqli_connect($serverName, $username, $password, $db);
      
      // Verifica che la connessione sia attiva
      if (!$connessione) { die("Errore connessione");	}
      
	  
$istruzioneSQL = mysqli_prepare($connessione,"UPDATE  eventi SET  (titolo,localita,descrizione,lat,lon )  WHERE id (?,?,?,?,?)");
	
	// Esecuzione della query
	mysqli_stmt_bind_param($istruzioneSQL, "sssii", $titolo, $localita, $localita, $descrizione, $lat, $lon);
	mysqli_stmt_execute($istruzioneSQL);

	  
      mysqli_query($connessione,$istruzioneSQL);

      echo("<p>Operazione di modifica eseguita</p>");
      
      mysqli_close($connessione);
    ?> 	
  
  </body>
</html>
