<?php
    $email = $_POST["email"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $register_type = $_POST["register_type"];

    // $email = $_GET["email"];
    // $password = $_GET["password"];
    // $name = $_GET["name"];
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

    $sql = "SELECT * FROM members WHERE email = \"$email\"";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["register_type"]=='1') {
            echo "{\"error\":1, \"message\":\"Account Duplicate\"}";
        } else {
            $member_id = $row["id"];
            echo "{\"error\":0, \"member_id\":$member_id}";
        }
        // output data of each row
        // while($row = $result->fetch_assoc()) {
        //     echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        // }
    } else {
        $t=time();
        $format_time = date("Y-m-d H:m:s",$t);

        $sql = "INSERT INTO members (email, password, name, register_type, register_time) VALUES (\"$email\", \"$password\", \"$name\", \"$register_type\", \"$format_time\")";

        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            // $insert_id = mysql_insert_id($sql);
            echo "{\"error\":0, \"member_id\":$last_id}";
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
