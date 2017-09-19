<?php
    include login.php;

    $searchterm = $_POST["search"];

    $sqlquery = "SELECT results.ID, results.last_name, results.first_name, CONCAT(results.first_name, ' ', results.last_name) AS 'full_name',             email_addresses.email_address, email_addresses.preferred, phones.phone_number, phones.number_type, phones.latest, street, town, _state,           zip_code, country, street_addresses.latest FROM names AS results
        JOIN email_addresses On results.ID = email_addresses.name_ID
        JOIN phones ON results.ID = phones.name_ID
        JOIN street_addresses ON results.ID = street_addresses.name_ID
        WHERE CONCAT(results.first_name, ' ', results.last_name) LIKE '%%';";

    $stmt = sqlsrv_query($conn, $sqlquery);

    while ($row = sqlsrv_fetch_array($stmt)) {
        echo "<div id='result'>
                <span style='display: block'>".$row[first_name]. " " .$row[last_name]."</span>
                <span class='resultButton'>Details</span>
                </div>";
    }
?>