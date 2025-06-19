<?php
	//Connect to database
    $servername = "localhost";
    $username = "root";		//put your phpmyadmin username.(default is "root")
    $password = "";			//if your phpmyadmin has a password put it here.(default is "root")
    $dbname = "";
    
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Create database
	$sql = "CREATE DATABASE IF NOT EXISTS biometricattendace";
	if ($conn->query($sql) === TRUE) {
	    echo "Database 'biometricattendace' checked/created successfully.<br>";
	} else {
	    echo "Error creating database: " . $conn->error . "<br>";
	}

	$dbname = "biometricattendace";
    
	$conn = new mysqli($servername, $username, $password, $dbname);

	// sql to create table users
	$sql = "CREATE TABLE IF NOT EXISTS `users` (
			`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`username` varchar(100) NOT NULL,
			`serialnumber` double NOT NULL,
			`gender` varchar(10) NOT NULL,
			`email` varchar(50) NOT NULL,
			`fingerprint_id` int(11) NOT NULL,
			`fingerprint_select` tinyint(1) NOT NULL DEFAULT '0',
			`user_date` date NOT NULL,
			`time_in` time NOT NULL,
			`del_fingerid` tinyint(1) NOT NULL DEFAULT '0',
			`add_fingerid` tinyint(1) NOT NULL DEFAULT '0'
	) ENGINE=InnoDB DEFAULT CHARSET=latin1";

	if ($conn->query($sql) === TRUE) {
	    echo "Table 'users' checked/created successfully.<br>";
	} else {
	    echo "Error creating table 'users': " . $conn->error . "<br>";
	}

	// sql to create table users_logs
	$sql = "CREATE TABLE IF NOT EXISTS `users_logs` (
			`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`username` varchar(100) NOT NULL,
			`serialnumber` double NOT NULL,
			`fingerprint_id` int(5) NOT NULL,
			`checkindate` date NOT NULL,
			`timein` time NOT NULL,
			`timeout` time NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1";

	if ($conn->query($sql) === TRUE) {
	    echo "Table 'users_logs' checked/created successfully.<br>";
	} else {
	    echo "Error creating table 'users_logs': " . $conn->error . "<br>";
	}
    
    // sql to create table admin
    $sql = "CREATE TABLE IF NOT EXISTS `admin` (
            `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `username` varchar(50) NOT NULL UNIQUE,
            `password` varchar(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

    if ($conn->query($sql) === TRUE) {
	    echo "Table 'admin' checked/created successfully.<br>";
	} else {
	    echo "Error creating table 'admin': " . $conn->error . "<br>";
	}

    // Check if default admin exists, if not, insert it
    $sql = "SELECT id FROM admin WHERE username='admin'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        $admin_user = 'admin';
        $admin_pass = password_hash('password123', PASSWORD_DEFAULT); // Hash the default password
        
        $sql = "INSERT INTO admin (username, password) VALUES ('$admin_user', '$admin_pass')";
        if ($conn->query($sql) === TRUE) {
            echo "Default admin user created successfully. User: admin, Pass: password123<br>";
        } else {
            echo "Error creating default admin: " . $conn->error . "<br>";
        }
    } else {
        echo "Default admin user already exists.<br>";
    }
		
	$conn->close();
?>