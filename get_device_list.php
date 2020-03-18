    <?php
    $member_id = $_POST["member_id"];
    $email = $_POST["email"];

    // $member_id = $_GET["member_id"];
    // $email = $_GET["email"];

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

    $sql = "SELECT * FROM devices WHERE member_id = \"$member_id\" AND email = \"$email\"";
    $result = $conn->query($sql);

    // $t=time();
    // $register_time = date("Y-m-d H:m:s",$t);
    $count = 0;
    if ($result->num_rows > 0) {
        echo '[';
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $chip_id = $row["chip_id"];
            $device_name = $row["device_name"];
            $control_key = $row["control_key"];
            $local_ip = $row["local_ip"];
            $brightness = $row["brightness"];
            $color = $row["color"];
            $enable_open_api = $row["enable_open_api"];
            $enable_homekit = $row["enable_homekit"];
            if($count != 0)
                echo ",";
            echo "{\"chip_id\":\"$chip_id\", \"device_name\":\"$device_name\", \"control_key\":\"$control_key\", \"local_ip\":\"$local_ip\", \"brightness\":$brightness, \"color\":$color, \"enable_open_api\":$enable_open_api, \"enable_homekit\":$enable_homekit}";
            $count++;
        }
        echo ']';
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
