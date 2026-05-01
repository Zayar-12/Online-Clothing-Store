<?php
include("../function/connection.php");
include("../function/functions.php");
session_start();
$key = true;
$key2 = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    ob_start();
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
    $pass = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    // if($email=="admin@gmail.com" && $pass =="admin123"){
    //     header("Location:../admin/home.php");
    // } 
    $_SESSION["role"] = checkrole($email);
    if ($_SESSION["role"] == "admin") {

        header("Location:../admin/home.php");
        exit();
    } else {
        $result = $con->query("SELECT * FROM customers");
        if (!empty($result) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row["email"] == $email && password_verify($pass, $row["pass"])) {
                    $_SESSION["user_id"] = $row["cus_id"];
                    echo $_SESSION["user_id"];
                    $_SESSION["success"] = true;
                    $key = false;

                    header("Location:../pages/home.php");

                    ob_end_flush();

?>
                    <script>
                        document.getElementById("success").style.display = "block";
                    </script>
            <?php


                }
            }
        }
        if ($key) {
            $_SESSION["loginfail"] = true; ?>
            <script>
                document.getElementById("unsuccess").style.display = "block";
            </script>

            <script>
                function togglePassword() {
                    const passwordInput = document.querySelector('input[name="password"]');
                    const passwordIcon = document.querySelector('svg[viewBox="0 0 128 128"]');
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        passwordIcon.classList.add('text-blue-600');
                    } else {
                        passwordInput.type = 'password';
                        passwordIcon.classList.remove('text-blue-600');
                    }
                }
            </script>

<?php
            header("Location:../components/login.php");
        }
    }
}

?>