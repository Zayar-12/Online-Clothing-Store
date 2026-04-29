<?php
include("../function/connection.php");
include("../function/functions.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form data များကို ရယူခြင်း
    $user_id        = $_POST['user_id'];
    $total          = $_POST['total_amount'];
    $transaction_id = $_POST['tid'];
   

    $payment_method = $_POST['method']; // Wave Pay, KBZ Pay စသည်ဖြင့် ရရှိမည်
    $paid_status    = 1; 
    
    if (!preg_match('/^[0-9]{6,}$/', $transaction_id)) {
    die("Invalid Transaction ID. It must be at least 6 digits.");
}

    // Screenshot file ကို စစ်ဆေးခြင်း
    if (isset($_FILES['screenshot']) && $_FILES['screenshot']['error'] === 0) {
        
        
        
        // SQL Prepared Statement
        // Column နာမည်များ- user_id, Total, transaction_id, payment_method, pay_ss, paid
        // 1. Grab the image content
$image_content = file_get_contents($_FILES["screenshot"]["tmp_name"]);

// 2. Prepare the INSERT statement
// (Assuming your table columns are: user_id, Total, transaction_id, payment_method, pay_ss, paid)
$sql = "INSERT INTO payment (cus_id, Total, transaction_id, payment_method, pay_ss, paid) 
        VALUES ('$user_id', '$total', '$transaction_id', '$payment_method', ?, '$paid_status')";

$statement = $con->prepare($sql);

// 3. Bind the image as a string ("s") and execute
$statement->bind_param("s", $image_content);


            if ($statement->execute()) {
                // အောင်မြင်လျှင် Function များ run ပြီး redirect လုပ်မည်
                movtoorder($user_id);
                deletcart($user_id);
                
                $_SESSION["res"] = "success";
                header("Location: ../pages/Cart.php");
                exit();
            } else {
                echo "Database Execution Error: " . $statement->error;
            }
            $statement->close();
            
    }}
?>