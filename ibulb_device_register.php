	<?php
    $member_id = $_POST["member_id"];
    $email = $_POST["email"];
    $chip_id = $_POST["chip_id"];
    $device_name = $_POST["device_name"];
    $control_key = $_POST["control_key"];
    $local_ip = $_POST["local_ip"];
    $register_time = $_POST["register_time"];

    // $member_id = $_GET["member_id"];
    // $email = $_GET["email"];
    // $chip_id = $_GET["chip_id"];
    // $device_name = $_GET["device_name"];
    // $control_key = $_GET["control_key"];
    // $local_ip = $_GET["local_ip"];
    // $register_time = $_GET["register_time"];

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

    $sql = "SELECT * FROM devices WHERE chip_id = \"$chip_id\"";
    $result = $conn->query($sql);

    $t=time();
    $register_time = date("Y-m-d H:m:s",$t);

    if ($result->num_rows > 0) {

    	$sql = "UPDATE devices SET member_id=\"$member_id\", email=\"$email\", device_name=\"$device_name\", control_key=\"$control_key\", local_ip=\"$local_ip\", register_time=\"$register_time\" WHERE chip_id=\"$chip_id\"";
    	if ($conn->query($sql) === TRUE) {
	    	echo "{\"error\":0, \"message\":\"Update Success!\"}";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
	    }

    } else {

        $sql = "INSERT INTO devices (member_id, email, chip_id, device_name, control_key, local_ip, register_time) VALUES (\"$member_id\", \"$email\", \"$chip_id\", \"$device_name\", \"$control_key\", \"$local_ip\", \"$register_time\")";
        if ($conn->query($sql) === TRUE) {
	    	echo "{\"error\":0, \"message\":\"Insert Success!\"}";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
	    }
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
