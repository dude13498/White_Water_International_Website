<<<<<<< HEAD
<!DOCTYPE html>

<html>
    
<head>
    <title>White Water International - Search Results</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link type="text/css" rel="stylesheet" href="stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $(document).ready(function() {
        $('.button').mouseenter(function() {
            $(this).animate({
                backgroundColor: "#00001f"
            }, 200);
        });
        $('.button').mouseleave(function() {
            $(this).animate({
                backgroundColor: "#00006c"
            }, 200);
        });
        $('.resultButton').mouseenter(function() {
            $(this).animate({
                backgroundColor: "#6a6a99"
            }, 200);
        });
        $('.resultButton').mouseleave(function() {
            $(this).animate({
                backgroundColor: "#b2b2ff"
            }, 200);
        });
        $('.resultButton').click(function() {
            $('#updateForm').css('display', 'inline-block');
        });
    });
    </script>
</head>

<body id="resultsPage">
    <!--Top Nav Bar-->
    <nav id="nav">
        <ul id="logo">
            <li><a href="index.html" id="logoText">White Water International</a></li>
        </ul>
    </nav>
    
    <!--Search Results-->
    <div id="searchResults" class="resultPane">
        <!--Search Bar-->
        <form class="inputBlockFrm" style="padding-top: 10px; height: 40px; width: auto; margin-left: auto; margin-right: auto" method="post">
            <input type="search" id="searchBar" name="search" placeholder="Search the database" style="width: 70%">
            <input type="submit" value="Search" class="button" id="submitButton" style="display: inline-block; width: 28%; margin-left: 2%" tabindex="13">
        </form>
        
        <?php
            session_start();
        
            $serverName = "HAMZA-FAMILY\SQLEXPRESS";
            $connectionInfo = array( "Database"=>"Clients", "UID"=>$_SESSION["username"], "PWD"=>$_SESSION["password"]);
            $conn = sqlsrv_connect( $serverName, $connectionInfo);

            $searchterm = $_POST["search"];

            $sqlquery = "SELECT results.ID, results.last_name, results.first_name, CONCAT(results.first_name, ' ', results.last_name) AS 'full_name', email_addresses.email_address, email_addresses.preferred, phones.phone_number, phones.number_type, phones.latest, street, town, _state, zip_code, country, street_addresses.latest FROM names AS results
                JOIN email_addresses On results.ID = email_addresses.name_ID
                JOIN phones ON results.ID = phones.name_ID
                JOIN street_addresses ON results.ID = street_addresses.name_ID
                WHERE CONCAT(results.first_name, ' ', results.last_name) LIKE '%$searchterm%'";

            $stmt = sqlsrv_query($conn, $sqlquery);

            while ($row = sqlsrv_fetch_array($stmt)) {
                echo "<div id='result'>
                    <span style='display: block'>".$row['first_name']. " " .$row['last_name']."</span>
                    <span class='resultButton'>Details</span>
                    </div>";
            }
        ?>
        
    </div>
    
    <!--Update Form-->
    <div id="updateForm" class="resultPane">
        <!--Add to DB Form-->
        <form id="addForm" action="add.php" method="post" class="active" style="margin-top: 5px; width: 100%">
            <ul id="upFrmLst">
                <!--First and Last Name-->
                <li class="updateBlockFrm" style="padding-top: 10px">
                    <span class="inputLabel">First Name:</span>
                    <input type="text" name="fname" class="input" tabindex="1" value="">
                </li>
                <li class="updateBlockFrm">
                    <span class="inputLabel">Last Name:</span>
                    <input type="text" name="lname" class="input" tabindex="2" value="">
                </li>
                
                <!--Email-->
                <li class="updateBlockFrm">
                    <span class="inputLabel" style="text-align: right">Email Address:</span>
                    <input type="email" name="email" class="input" tabindex="3" value="">
                </li>
                <li class="updateBlockFrm" style="text-align: center">
                    <span class="inputLabel" style="width: 13px; height: 13px; padding-left: 45px">
                        <input type="hidden" name="preferred" value="0">
                        <input type="checkbox" name="preferred" value="1" style="margin: 0" tabindex="4">
                    </span>
                    <span class="inputLabel" style="width: auto">This is my preferred email address</span>
                </li>
                
                <!--Phone-->
                <li class="updateBlockFrm">
                    <span class="inputLabel">Phone Number:</span>
                    <input type="tel" name="phone" class="input" tabindex="5" value="">
                </li>
                <li class="updateBlockFrm" style="text-align: center">
                    <span class="inputLabel" style="width: 83px; padding-left: 26px; text-align: center">
                        <input type="radio" name="numberType" value="Cell" tabindex="6"> Cell
                    </span>
                    <span class="inputLabel" style="width: 83px; padding-left: 0; text-align: center">
                        <input type="radio" name="numberType" value="Home" tabindex="7"> Home
                    </span>
                </li>
                
                <!--Address-->
                <li class="updateBlockFrm">
                    <span class="inputLabel">Street:</span>
                    <input type="text" name="street" class="input" tabindex="8" value="">    
                </li>
                <li class="updateBlockFrm">
                    <span class="inputLabel">City:</span>
                    <input type="text" name="city" class="input" tabindex="9" value="">
                    
                </li>
                <li class="updateBlockFrm">
                    <span class="inputLabel">State:</span>
                    <input type="text" name="state" class="input" style="width: 50px" tabindex="10" value="">
                    <span class="inputLabel" style="width: 50px">ZIP:</span>
                    <input type="number" name="zipcode" class="input" style="width: 70px" tabindex="11" value="">
                </li>
                <li class="updateBlockFrm">
                    <span class="inputLabel">Country:</span>
                    <input type="text" name="country" class="input" tabindex="12" value="">
                </li>
                
                <!--Submit Button-->
                <li class="updateBlockFrm" style="height: 40px">
                    <input type="submit" value="Submit" class="button" id="submitButton" style="width: 85px; margin-right: auto; margin-left: auto" tabindex="13">
                </li>
            </ul>
        </form>
    </div>
    
    <!--Copyright-->
    <div id="copy">
        <p style="margin: 0">White Water International &copy; 2017 | All Rights Reserved | Designed by Zeyad Hamza</p>
    </div>
</body>    
    
=======
<!DOCTYPE html>

<html>
    
<head>
    <title>White Water International - Search Results</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link type="text/css" rel="stylesheet" href="stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $(document).ready(function() {
        $('.button').mouseenter(function() {
            $(this).animate({
                backgroundColor: "#00001f"
            }, 200);
        });
        $('.button').mouseleave(function() {
            $(this).animate({
                backgroundColor: "#00006c"
            }, 200);
        });
        $('.resultButton').mouseenter(function() {
            $(this).animate({
                backgroundColor: "#6a6a99"
            }, 200);
        });
        $('.resultButton').mouseleave(function() {
            $(this).animate({
                backgroundColor: "#b2b2ff"
            }, 200);
        });
        $('.resultButton').click(function() {
            $('#updateForm').css('display', 'inline-block');
        });
    });
    </script>
</head>

<body id="resultsPage">
    <!--Top Nav Bar-->
    <nav id="nav">
        <ul id="logo">
            <li><a href="index.html" id="logoText">White Water International</a></li>
        </ul>
    </nav>
    
    <!--Search Results-->
    <div id="searchResults" class="resultPane">
        <!--Search Bar-->
        <form class="inputBlockFrm" style="padding-top: 10px; height: 40px; width: auto; margin-left: auto; margin-right: auto" method="post">
            <input type="search" id="searchBar" name="search" placeholder="Search the database" style="width: 70%">
            <input type="submit" value="Search" class="button" id="submitButton" style="display: inline-block; width: 28%; margin-left: 2%" tabindex="13">
        </form>
        
        <?php
            //include 'login.php';
        
            $serverName = "HAMZA-FAMILY\SQLEXPRESS"; //serverName\instanceName
            $connectionInfo = array( "Database"=>"Clients", "UID"=>"Zeyad", "PWD"=>"Hamza");
            $conn = sqlsrv_connect( $serverName, $connectionInfo);

            $searchterm = $_POST["search"];

            $sqlquery = "SELECT results.ID, results.last_name, results.first_name, CONCAT(results.first_name, ' ', results.last_name) AS 'full_name', email_addresses.email_address, email_addresses.preferred, phones.phone_number, phones.number_type, phones.latest, street, town, _state, zip_code, country, street_addresses.latest FROM names AS results
                JOIN email_addresses On results.ID = email_addresses.name_ID
                JOIN phones ON results.ID = phones.name_ID
                JOIN street_addresses ON results.ID = street_addresses.name_ID
                WHERE CONCAT(results.first_name, ' ', results.last_name) LIKE '%$searchterm%'";

            $stmt = sqlsrv_query($conn, $sqlquery);

            while ($row = sqlsrv_fetch_array($stmt)) {
                echo "<div id='result'>
                    <span style='display: block'>".$row['first_name']. " " .$row['last_name']."</span>
                    <span class='resultButton'>Details</span>
                    </div>
                    ";
            }
        ?>
        
    </div>
    
    <!--Update Form-->
    <div id="updateForm" class="resultPane">
        <!--Add to DB Form-->
        <form id="addForm" action="add.php" method="post" class="active" style="margin-top: 5px; width: 100%">
            <ul id="upFrmLst">
                <!--First and Last Name-->
                <li class="updateBlockFrm" style="padding-top: 10px">
                    <span class="inputLabel">First Name:</span>
                    <input type="text" name="fname" class="input" tabindex="1" value="">
                </li>
                <li class="updateBlockFrm">
                    <span class="inputLabel">Last Name:</span>
                    <input type="text" name="lname" class="input" tabindex="2" value="">
                </li>
                
                <!--Email-->
                <li class="updateBlockFrm">
                    <span class="inputLabel" style="text-align: right">Email Address:</span>
                    <input type="email" name="email" class="input" tabindex="3" value="">
                </li>
                <li class="updateBlockFrm" style="text-align: center">
                    <span class="inputLabel" style="width: 13px; height: 13px; padding-left: 45px">
                        <input type="hidden" name="preferred" value="0">
                        <input type="checkbox" name="preferred" value="1" style="margin: 0" tabindex="4">
                    </span>
                    <span class="inputLabel" style="width: auto">This is my preferred email address</span>
                </li>
                
                <!--Phone-->
                <li class="updateBlockFrm">
                    <span class="inputLabel">Phone Number:</span>
                    <input type="tel" name="phone" class="input" tabindex="5" value="">
                </li>
                <li class="updateBlockFrm" style="text-align: center">
                    <span class="inputLabel" style="width: 83px; padding-left: 26px; text-align: center">
                        <input type="radio" name="numberType" value="Cell" tabindex="6"> Cell
                    </span>
                    <span class="inputLabel" style="width: 83px; padding-left: 0; text-align: center">
                        <input type="radio" name="numberType" value="Home" tabindex="7"> Home
                    </span>
                </li>
                
                <!--Address-->
                <li class="updateBlockFrm">
                    <span class="inputLabel">Street:</span>
                    <input type="text" name="street" class="input" tabindex="8" value="">    
                </li>
                <li class="updateBlockFrm">
                    <span class="inputLabel">City:</span>
                    <input type="text" name="city" class="input" tabindex="9" value="">
                    
                </li>
                <li class="updateBlockFrm">
                    <span class="inputLabel">State:</span>
                    <input type="text" name="state" class="input" style="width: 50px" tabindex="10" value="">
                    <span class="inputLabel" style="width: 50px">ZIP:</span>
                    <input type="number" name="zipcode" class="input" style="width: 70px" tabindex="11" value="">
                </li>
                <li class="updateBlockFrm">
                    <span class="inputLabel">Country:</span>
                    <input type="text" name="country" class="input" tabindex="12" value="">
                </li>
                
                <!--Submit Button-->
                <li class="updateBlockFrm" style="height: 40px">
                    <input type="submit" value="Submit" class="button" id="submitButton" style="width: 85px; margin-right: auto; margin-left: auto" tabindex="13">
                </li>
            </ul>
        </form>
    </div>
    
    <!--Copyright-->
    <div id="copy">
        <p style="margin: 0">White Water International &copy; 2017 | All Rights Reserved | Designed by Zeyad Hamza</p>
    </div>
</body>    
    
>>>>>>> 33c8f815f108155d7888030f93c0a9208ab13de6
</html>