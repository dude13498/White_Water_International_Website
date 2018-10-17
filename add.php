<<<<<<< HEAD
<?php
    session_start();

    $serverName = "HAMZA-FAMILY\SQLEXPRESS";
    $connectionInfo = array( "Database"=>"Clients", "UID"=>$_SESSION["username"], "PWD"=>$_SESSION["password"]);
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];

    $email = $_POST["email"];
    $preferred_email = $_POST["preferred"];

    $phone_number = (string) $_POST["phone"];
    $number_type = $_POST["numberType"];
    $latest_phone = 1;

    $street = $_POST["street"];
    $town = $_POST["city"];
    $state = $_POST["state"];
    $zipcode = (string) $_POST["zipcode"];
    $country = $_POST["country"];
    $latest_address = 1;

    $sqlquery = "EXECUTE dbo.insertIntoTable '$fname','$lname','$email',$preferred_email,'$phone_number','$number_type',$latest_phone,'$street','$town','$state','$zipcode','$country',$latest_address";

    $stmt = sqlsrv_query( $conn, $sqlquery);
    if( $stmt === false ) {
        die( print_r( sqlsrv_errors(), true)); }

    header("Location: dashboard.html");
=======
<?php
    //include 'login.php';

    $serverName = "HAMZA-FAMILY\SQLEXPRESS"; //serverName\instanceName
    $connectionInfo = array( "Database"=>"Clients", "UID"=>"Zeyad", "PWD"=>"Hamza");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];

    $email = $_POST["email"];
    $preferred_email = $_POST["preferred"];

    $phone_number = (string) $_POST["phone"];
    $number_type = $_POST["numberType"];
    $latest_phone = 1;

    $street = $_POST["street"];
    $town = $_POST["city"];
    $state = $_POST["state"];
    $zipcode = (string) $_POST["zipcode"];
    $country = $_POST["country"];
    $latest_address = 1;

    $sqlquery = "EXECUTE dbo.insertIntoTable '$fname','$lname','$email',$preferred_email,'$phone_number','$number_type',$latest_phone,'$street','$town','$state','$zipcode','$country',$latest_address";

    $stmt = sqlsrv_query( $conn, $sqlquery);
    if( $stmt === false ) {
        die( print_r( sqlsrv_errors(), true)); }

    header("Location: dashboard.html");
>>>>>>> 33c8f815f108155d7888030f93c0a9208ab13de6
?>