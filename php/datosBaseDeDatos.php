<?php 
	try {
	    $hostname = "localhost";
	    $dbname = "ProjecteVotaCopia";
	    $username = "root";
	    $pw = "mysql1234";
	    $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
	} catch (PDOException $e) {
	    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
	    exit;
	}
?>
