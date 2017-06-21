<?php



function openDB(){
    global $conn;
    $servername = "localhost";
	// $username = "bsst";
	// $password = "bsst";
	// $dbname = "feeling";
	$username = "kcfmilkc_test";
	$password = "test!@#$%";
	$dbname = "kcfmilkc_feeling";
// var_dump();

// var_dump($servername);
// var_dump($username); 
// var_dump($password); 
// var_dump($dbname);
// return; 
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
    
    mysqli_query("SET NAMES 'utf8'"); 
    mysqli_query("SET CHARACTER_SET_CLIENT=utf8"); 
    mysqli_query("SET CHARACTER_SET_RESULTS=utf8");
}


function closeDB(){
    global $conn;
    return mysqli_close($conn);
}

?> 