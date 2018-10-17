<<<<<<< HEAD
<?php
    session_start();

    $_SESSION['username'] = $_POST["username"];
    $_SESSION['password'] = $_POST["password"];
    $serverName = "HAMZA-FAMILY\SQLEXPRESS"; //serverName\instanceName
    $connectionInfo = array( "Database"=>"Clients", "UID"=>$_SESSION["username"], "PWD"=>$_SESSION["password"]);
    
    if (!($_SESSION['username'] === "" or $_SESSION['password'] === "")) {
        $conn = sqlsrv_connect( $serverName, $connectionInfo); }

    if( $conn ) {
        echo "Connection established.<br />";
        header("Location: dashboard.html"); }
    else {
        header("Location: loginfailed.html");
        die( print_r( sqlsrv_errors(), true)); }
?>


=======
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


>>>>>>> 33c8f815f108155d7888030f93c0a9208ab13de6
