<?php 
	try {
	    $hostname = "localhost";
	    $dbname = "ProjecteVota";
	    $username = "root";
	    $pw = "P@ssw0rd";
	    $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
	} catch (PDOException $e) {
	    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
	    exit;
	}
?>
