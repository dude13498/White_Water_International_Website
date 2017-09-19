<?php
    $serverName = "HAMZA-FAMILY\SQLEXPRESS"; //serverName\instanceName
    $username = $_POST["username"];
    $password = $_POST["password"];
    $connectionInfo = array( "Database"=>"Clients", "UID"=>$username, "PWD"=>$password);
    
    if (!($username === "" or $password === "")) {
        $conn = sqlsrv_connect( $serverName, $connectionInfo); }

    if( $conn ) {
        echo "Connection established.<br />";
        header("Location: dashboard.html"); }
    else {
        //header("Location: loginfailed.html");
        die( print_r( sqlsrv_errors(), true)); }
?>


