<?php
include("../function/connection.php");
include("../function/functions.php");
session_start();


$key = true;
$key2 = true;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- tailwind -->
    <link href="../output.css" rel="stylesheet">
    <!-- alpine -->
    <script src="../../public/script.js"></script>

    <style>
        svg[viewBox="0 0 128 128"] {
            fill: #bbb;
        }
    </style>
    <script>
        if (<?php echo $_SESSION["loginfail"] ?>) {
            <?php $_SESSION["loginfail"] = null; ?>
            alert("login Fail");
        }
    </script>
</head>


<body>


    <!-- <a href="../pages/home.php">Back</a>
    <form action="<//?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>//" id="form" class="formlog" method="post">
        <h1 style="color:black;font-size:35px; text-align:center;margin-top:0px;">Login </h1>
        <input type="email" name="email" placeholder="E-mail" required><br>
        <input type="password" name="pass" placeholder="Password" maxlength="10" required><br>
        <input type="submit" name="Login" value="Login">
        <div id="success"
            style="margin-top:10px;text-align:center;background-color:white;padding:10px; color:green;border-radius:10px;">
            Login Successfully</div>
        <div id="unsuccess"
            style="margin-top:10px;text-align:center;background-color:white;padding:10px; color:red;border-radius:10px;">
            Login Fail! Please Sign Up first!</div>
    </form> -->
    <div class="font-[sans-serif]">
        <div class="grid lg:grid-cols-2 gap-4 max-lg:gap-12 bg-primary px-8 py-12 h-[320px]">
            <div>
                <a href="javascript:void(0)"><img src="https://readymadeui.com/readymadeui-white.svg" alt="logo"
                        class='w-40' />
                </a>
                <div class="max-w-lg mt-16 max-lg:hidden">
                    <h3 class="text-4xl font-bold text-white">Sign in</h3>
                    <p class="text-base mt-4 text-white">Embark on a seamless journey as you sign in to your account.
                        Unlock a realm of opportunities and possibilities that await you.</p>
                </div>
            </div>

            <div
                class="bg-white mt-16 rounded-xl sm:px-6 px-4 py-8 max-w-md w-full h-max shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] max-lg:mx-auto">
                <form x-data="{show: false, email: '',password: '',toggle: '0',}" action="../function/loginvalidate.php" method="post">

                    <div class="mb-8">
                        <h3 class="text-4xl font-extrabold text-gray-800">Sign in</h3>
                    </div>

                    <div>
                        <label class="text-gray-800 text-base font-medium mb-2 block">Email</label>
                        <div class="relative flex items-center ">
                            <input name="email" type="email" required
                                class="w-full text-base text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                placeholder="Enter Your Email" />

                            <svg viewBox="0 0 24 24" class="w-6 h-6 absolute right-4" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M4 7.00005L10.2 11.65C11.2667 12.45 12.7333 12.45 13.8 11.65L20 7"
                                        stroke="#bbb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    </path>
                                    <rect x="3" y="5" width="18" height="14" rx="2" stroke="#bbb" stroke-width="2"
                                        stroke-linecap="round"></rect>
                                </g>
                            </svg>
                        </div>
                    </div>



                    <div class="mt-6">
                        <label class="text-gray-800 text-base font-medium mb-2 block">Password</label>
                        <div class='relative flex items-center'>
                            <input :type="show ? 'text' : 'password' " x-model="password" name="password"
                                class="w-full text-base text-gray-800 border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                placeholder="Enter password">
                            <button type='button' @click="show = !show" class="w-[18px] h-[18px] absolute right-4 cursor-pointer">

                                <svg x-show="!show" class='w-6 h-6' viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5"
                                            stroke="#bbb" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </svg>


                                <svg x-show="show" class='w-6 h-6' viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z"
                                            stroke="#bbb" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path
                                            d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z"
                                            stroke="#bbb" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </svg>

                            </button>
                        </div>
                    </div>





                    <div class="mt-8">
                        <button type="submit"
                            class="w-full shadow-xl py-3 px-6 text-base font-semibold rounded-md text-white bg-primary hover:bg-blue-700 focus:outline-none">
                            Log in
                        </button>
                    </div>
                    <p class="text-sm mt-8 text-center text-gray-800">Don't have an account <a
                            href="./signup.php" ;
                            class="text-primary font-semibold hover:underline ml-1 whitespace-nowrap">Register</a>
                    </p>
                </form>
            </div>
        </div>
    </div>


</body>

</html>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    ob_start();
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
    $pass = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);





    // $role=checkrole($email,$pass);
    //     if ($role == "admin") {

    //             header("Location:../admin/home.php");

    //     }
    if ($email == "admin@gmail.com" && $pass == "admin123") {
        header("Location:../admin/home.php");
        exit();
    } else {
        $result = $con->query("SELECT * FROM customers");
        if (!empty($result) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row["email"] == $email && password_verify($pass, $row["pass"])) {
                    $_SESSION["user_id"] = $row["cus_id"];

                    $key = false;

?>
                    <script>
                        document.getElementById("success").style.display = "block";
                    </script>
            <?php

                    ob_end_flush();
                }
            }
        }
        if ($key) {
            ?>
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
        }
    }
}
