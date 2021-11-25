<?php

//variabili
$host="localhost";
$username="root";
$password="";
$dbname="vulnerableDB";

//connessione
$conn=new mysqli($host, $username, $password, $dbname);

//gestione errori
if($conn->connect_errno)
{
	print("<p>Errore nella connessione".$conn->connect_error."</p>");
	exit;	//esce dal sistema
}

?>