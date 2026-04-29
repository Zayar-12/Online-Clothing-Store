<?php


function fetchSpecificPayment( $user_id, $or_date) {
    include("connection.php");
    // 1. Use '?' placeholders for security
    $sql = "SELECT * FROM `orderhistory` 
            JOIN payment ON orderhistory.cus_id = payment.cus_id 
            WHERE payment.pay_date = ? AND payment.cus_id = ?";

    $stmt = $con->prepare($sql);

    // 2. Bind both parameters: 's' for date (string), 'i' for user_id (integer)
    $stmt->bind_param("si", $or_date, $user_id);

    // 3. Execute the statement
    $stmt->execute();

    // 4. Get the result and fetch as an object
    $result = $stmt->get_result();
    
    // Returns the object if found, or null if not
    return $result->fetch_object();
}