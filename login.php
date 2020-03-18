<?php
    $email = $_POST["email"];
    $password = $_POST["password"];
    $register_type = $_POST["register_type"];

    // $email = $_GET["email"];
    // $password = $_GET["password"];
    // $register_type = $_GET["register_type"];

    $db_servername = "localhost";
    $db_username = "root";
    $db_password = "csie504";
    $db_name = "lazy_bulb";


    // Create connection
    $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if($register_type=='1'){
    	// echo "register type is 1";
    	$sql = "SELECT * FROM members WHERE email = \"$email\" and password=\"$password\"";
    }else{
    	// echo "register type is 2 or 3";
    	$sql = "SELECT * FROM members WHERE email = \"$email\"";
    }

    $result = $conn->query($sql);
    if($result->num_rows>0){
		$row = $result->fetch_assoc();
		$member_id = $row["id"];
		$name = $row["name"];
		echo "{\"error\":0, \"member_id\":$member_id, \"name\":\"$name\"}";
    }else{
    	echo "{\"error\":1, \"message\":\"Account or Password is wrong !\"}";
    }

    $conn->close();

    // $dbhost = 'localhost';
    // $dbuser = 'root';
    // $dbpass = 'xul4u/ ful6';
    // $dbname = 'lazy_bulb';

    // $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
    // mysql_query("SET NAMES 'utf8'");
    // mysql_select_db($dbname);

    // $sql = "SELECT * FROM `members` WHERE `email` = $email";
    // //$sql = "SELECT COUNT(*) as total FROM `FileList` WHERE `class` = 0;";
    // $result = mysql_query($sql) or die('MySQL query error');
    // $row = mysql_fetch_array($result);
    // $count = row['count'];

    // echo "count:".$count;

    // // while($row = mysql_fetch_array($result)){
    // //     echo $row['name'];
    // // }
?>
