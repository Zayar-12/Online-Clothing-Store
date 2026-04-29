<?php 
include("../function/connection.php");
session_start(); 
include("../function/functions.php");

if(empty( $_SESSION["res"])){
    echo"";
}
if( isset($_SESSION["update"] )){
    $_SESSION["update"]=null;
    $update=true;
}  
 ?>
<script>
if (<?php echo $update ?>) {
    alert("Update Successfully!");
}
</script>
<?php
if(isset($_SESSION["res"])){ 
    $res=true;
    $_SESSION["res"]=null;
    ?>
<script>
if (<?php echo $res?>) {
    alert("Order all items Successfully!");
}
</script>
<?php
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <!-- flowbite -->
    <link rel="stylesheet" href="../../node_modules/flowbite/dist/flowbite.min.css">
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>

    <!-- tailwind -->
    <link href="../output.css" rel="stylesheet">
    <!-- alpine -->
    <script src="../../public/script.js"></script>


    <style>
    ::-webkit-scrollbar {
        width: 5px;
        height: 5px;
    }

    ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
    }

    nav {
        z-index: 999 !important;
    }

    nav:not(.scrolled) {
        box-shadow: none;
    }

    nav.scrolled {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    #selection-table .noSort svg {
        display: none;
    }

    .test {
        border: 1px solid red;
    }

    .main-text {
        margin-top: 5rem;
        margin-bottom: 1rem;
    }

    .main {
        margin-top: 3rem;
        padding-top: 2rem;
    }

    .navbar {
        position: fixed;
        top: 0;
    }



    @media (min-width: 640px) {

        .main-text {
            margin-top: 0rem;
            margin-bottom: 1rem;
        }

        .main {
            margin-left: 5rem;
            margin-top: 1.25rem;
        }

        .navbar {
            width: 78px;
            position: fixed;
            flex-direction: column;
        }
    }


    .disabled {
        opacity: 0.5;
        pointer-events: none;
    }

    .update:hover {
        background-color: #2563EB;
    }
    </style>

</head>

<body>

    <nav x-data="{ isOpen: false }" class="w-full  bg-white fixed top-0">
        <div class="container px-6 py-4 mx-auto">
            <div class="lg:flex lg:items-center lg:justify-between">
                <div class="flex items-center justify-between">
                    <a href="./home.php">
                        <img class="w-auto h-6 sm:h-7" src="https://merakiui.com/images/logo.svg" alt="">
                    </a>
                    <!-- Mobile menu button -->

                    <div class="flex lg:hidden gap-5">
                        <div class="flex fle-col items-center justify-center gap-5">
                            <?php if(!empty($_SESSION['user_id'])){
                            $count=cartnoti($_SESSION["user_id"]); ?>
                            <a class="relative text-gray-700 transition-colors duration-300 transform dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-300"
                                href="../components/notification.php">
                                <svg class='w-8 h-8' viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M17.7778 16.4066C18.1725 16.2808 18.3904 15.8588 18.2646 15.4642C18.1388 15.0696 17.7168 14.8516 17.3222 14.9774L17.7778 16.4066ZM11.6797 15.9343C11.2657 15.9455 10.9391 16.2902 10.9503 16.7043C10.9615 17.1183 11.3062 17.4449 11.7203 17.4337L11.6797 15.9343ZM16.876 16.0131C17.0578 16.3853 17.5068 16.5397 17.8791 16.358C18.2513 16.1762 18.4057 15.7272 18.224 15.3549L16.876 16.0131ZM16.9104 14.374L16.2225 14.6728C16.2269 14.683 16.2316 14.6931 16.2364 14.7031L16.9104 14.374ZM15.9422 10.806L16.6868 10.7157C16.6855 10.7048 16.6839 10.694 16.6821 10.6832L15.9422 10.806ZM11.7068 5.941C11.2926 5.941 10.9568 6.27679 10.9568 6.691C10.9568 7.10521 11.2926 7.441 11.7068 7.441V5.941ZM11.7068 7.441C12.121 7.441 12.4568 7.10521 12.4568 6.691C12.4568 6.27679 12.121 5.941 11.7068 5.941V7.441ZM7.45778 10.807L6.71795 10.6839C6.71614 10.6948 6.71457 10.7057 6.71325 10.7166L7.45778 10.807ZM6.48961 14.374L7.16357 14.7031C7.16843 14.6931 7.17308 14.683 7.1775 14.6728L6.48961 14.374ZM5.17605 15.3549C4.99431 15.7272 5.14873 16.1762 5.52095 16.358C5.89317 16.5397 6.34223 16.3853 6.52397 16.0131L5.17605 15.3549ZM10.9568 6.691C10.9568 7.10521 11.2926 7.441 11.7068 7.441C12.121 7.441 12.4568 7.10521 12.4568 6.691H10.9568ZM12.4568 5C12.4568 4.58579 12.121 4.25 11.7068 4.25C11.2926 4.25 10.9568 4.58579 10.9568 5H12.4568ZM10.9568 6.691C10.9568 7.10521 11.2926 7.441 11.7068 7.441C12.121 7.441 12.4568 7.10521 12.4568 6.691H10.9568ZM12.4568 5C12.4568 4.58579 12.121 4.25 11.7068 4.25C11.2926 4.25 10.9568 4.58579 10.9568 5H12.4568ZM6.07781 14.9774C5.68317 14.8516 5.26125 15.0696 5.13544 15.4642C5.00963 15.8588 5.22756 16.2808 5.6222 16.4066L6.07781 14.9774ZM11.6797 17.4337C12.0938 17.4449 12.4385 17.1183 12.4497 16.7043C12.4609 16.2902 12.1343 15.9455 11.7203 15.9343L11.6797 17.4337ZM10.5 16.523C10.5 16.1088 10.1642 15.773 9.75001 15.773C9.33579 15.773 9.00001 16.1088 9.00001 16.523H10.5ZM14.4049 16.523C14.4049 16.1088 14.0691 15.773 13.6549 15.773C13.2407 15.773 12.9049 16.1088 12.9049 16.523H14.4049ZM17.3222 14.9774C15.4929 15.5606 13.5943 15.8825 11.6797 15.9343L11.7203 17.4337C13.7761 17.3782 15.8144 17.0325 17.7778 16.4066L17.3222 14.9774ZM18.224 15.3549L17.5844 14.0449L16.2364 14.7031L16.876 16.0131L18.224 15.3549ZM17.5983 14.0752C17.1347 13.008 16.8275 11.8759 16.6868 10.7157L15.1977 10.8963C15.3558 12.1997 15.701 13.4723 16.2225 14.6728L17.5983 14.0752ZM16.6821 10.6832C16.4696 9.40313 16.017 8.21501 15.1948 7.33897C14.3526 6.44171 13.1869 5.941 11.7068 5.941V7.441C12.8193 7.441 13.5729 7.80279 14.1011 8.36553C14.6492 8.94949 15.0181 9.81887 15.2024 10.9288L16.6821 10.6832ZM11.7068 5.941C10.2266 5.941 9.05835 6.44146 8.21321 7.33789C7.38755 8.21366 6.93123 9.40201 6.71795 10.6839L8.19761 10.9301C8.38214 9.82099 8.75359 8.95134 9.30463 8.36686C9.83619 7.80304 10.5936 7.441 11.7068 7.441V5.941ZM6.71325 10.7166C6.57244 11.8765 6.26519 13.0083 5.80171 14.0752L7.1775 14.6728C7.69888 13.4727 8.04413 12.2004 8.20232 10.8974L6.71325 10.7166ZM5.81565 14.0449L5.17605 15.3549L6.52397 16.0131L7.16357 14.7031L5.81565 14.0449ZM12.4568 6.691V5H10.9568V6.691H12.4568ZM12.4568 6.691V5H10.9568V6.691H12.4568ZM5.6222 16.4066C7.58558 17.0325 9.62394 17.3782 11.6797 17.4337L11.7203 15.9343C9.80576 15.8825 7.90713 15.5606 6.07781 14.9774L5.6222 16.4066ZM9.00001 16.523V17.023H10.5V16.523H9.00001ZM9.00001 17.023C9.00001 18.5252 10.1921 19.7755 11.7024 19.7755V18.2755C11.0561 18.2755 10.5 17.7327 10.5 17.023H9.00001ZM11.7024 19.7755C13.2127 19.7755 14.4049 18.5252 14.4049 17.023H12.9049C12.9049 17.7327 12.3487 18.2755 11.7024 18.2755V19.7755ZM14.4049 17.023V16.523H12.9049V17.023H14.4049Z"
                                            fill="currentColor"></path>
                                    </g>
                                </svg>
                            </a>
                            <a class="relative text-gray-700 transition-colors duration-300 transform dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-300"
                                href="#">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3 3H5L5.4 5M7 13H17L21 5H5.4M7 13L5.4 5M7 13L4.70711 15.2929C4.07714 15.9229 4.52331 17 5.41421 17H17M17 17C15.8954 17 15 17.8954 15 19C15 20.1046 15.8954 21 17 21C18.1046 21 19 20.1046 19 19C19 17.8954 18.1046 17 17 17ZM9 19C9 20.1046 8.10457 21 7 21C5.89543 21 5 20.1046 5 19C5 17.8954 5.89543 17 7 17C8.10457 17 9 17.8954 9 19Z"
                                        stroke="#2563EB" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>

                                <?php  if($count!=0){ ?>
                                <span
                                    class="absolute flex justify-center items-center w-5 h-5 p-0.5 text-center text-white bg-blue-500 rounded-full"
                                    style="font-size : 11px; top :-30%; right : -40%;"><?php  echo $count?>
                                </span>
                                <?php }?>
                            </a>
                            <?php } ?>
                        </div>


                        <button x-cloak @click="isOpen = !isOpen" type="button"
                            class="text-gray-500  hover:text-gray-600  focus:outline-none focus:text-gray-600 "
                            aria-label="toggle menu">
                            <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
                            </svg>

                            <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
                <div x-cloak :class="[isOpen ? 'translate-x-0 opacity-100 shadow-md' : 'opacity-0 -translate-x-full']"
                    class="absolute  inset-x-0 z-20 w-full px-6 py-4 transition-all duration-300 ease-in-out bg-white  lg:mt-0 lg:p-0 lg:top-0 lg:relative lg:bg-transparent lg:w-auto lg:opacity-100 lg:translate-x-0 lg:flex lg:items-center">

                    <div class="relative mt-4  md:mt-0 ">
                        <span class="absolute inset-y-0 pb-4 mb-0 left-0 flex items-center pl-3">
                            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        <form action="../components/search.php" method="get">
                            <input type="text" name='val'
                                class="w-full lg:w-96 py-2 pl-10 pr-4 text-gray-700 bg-white border rounded-lg  focus:border-blue-400  focus:outline-none focus:ring focus:ring-opacity-40 focus:ring-blue-300"
                                placeholder="Search">

                        </form>
                    </div>

                    <div class="flex flex-col -mx-6 lg:flex-row lg:items-center lg:mx-8">
                        <a href="./home.php"
                            class="px-3 py-2 mx-3 mt-2 text-gray-700 font-semibold transition-colors duration-300 transform rounded-md lg:mt-0  hover:bg-gray-100 ">Home</a>
                        <a href="./Men.php"
                            class="px-3 py-2 mx-3 mt-2 text-gray-700 font-semibold transition-colors duration-300 transform rounded-md lg:mt-0  hover:bg-gray-100 ">Men's
                        </a>
                        <a href="./Lady.php"
                            class="px-3 py-2 mx-3 mt-2 text-gray-700 font-semibold transition-colors duration-300 transform rounded-md lg:mt-0  hover:bg-gray-100 ">lady's
                        </a>

                        <?php if(!empty($_SESSION['user_id'])){
                         $count=cartnoti($_SESSION["user_id"]); ?>
                        <div class="lg:flex justify-center hidden gap-5 ">
                            <a class="relative text-gray-700 transition-colors duration-300 transform dark:text-gray-200"
                                href="../components/notification.php">
                                <svg class='w-7 h-7' viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M17.7778 16.4066C18.1725 16.2808 18.3904 15.8588 18.2646 15.4642C18.1388 15.0696 17.7168 14.8516 17.3222 14.9774L17.7778 16.4066ZM11.6797 15.9343C11.2657 15.9455 10.9391 16.2902 10.9503 16.7043C10.9615 17.1183 11.3062 17.4449 11.7203 17.4337L11.6797 15.9343ZM16.876 16.0131C17.0578 16.3853 17.5068 16.5397 17.8791 16.358C18.2513 16.1762 18.4057 15.7272 18.224 15.3549L16.876 16.0131ZM16.9104 14.374L16.2225 14.6728C16.2269 14.683 16.2316 14.6931 16.2364 14.7031L16.9104 14.374ZM15.9422 10.806L16.6868 10.7157C16.6855 10.7048 16.6839 10.694 16.6821 10.6832L15.9422 10.806ZM11.7068 5.941C11.2926 5.941 10.9568 6.27679 10.9568 6.691C10.9568 7.10521 11.2926 7.441 11.7068 7.441V5.941ZM11.7068 7.441C12.121 7.441 12.4568 7.10521 12.4568 6.691C12.4568 6.27679 12.121 5.941 11.7068 5.941V7.441ZM7.45778 10.807L6.71795 10.6839C6.71614 10.6948 6.71457 10.7057 6.71325 10.7166L7.45778 10.807ZM6.48961 14.374L7.16357 14.7031C7.16843 14.6931 7.17308 14.683 7.1775 14.6728L6.48961 14.374ZM5.17605 15.3549C4.99431 15.7272 5.14873 16.1762 5.52095 16.358C5.89317 16.5397 6.34223 16.3853 6.52397 16.0131L5.17605 15.3549ZM10.9568 6.691C10.9568 7.10521 11.2926 7.441 11.7068 7.441C12.121 7.441 12.4568 7.10521 12.4568 6.691H10.9568ZM12.4568 5C12.4568 4.58579 12.121 4.25 11.7068 4.25C11.2926 4.25 10.9568 4.58579 10.9568 5H12.4568ZM10.9568 6.691C10.9568 7.10521 11.2926 7.441 11.7068 7.441C12.121 7.441 12.4568 7.10521 12.4568 6.691H10.9568ZM12.4568 5C12.4568 4.58579 12.121 4.25 11.7068 4.25C11.2926 4.25 10.9568 4.58579 10.9568 5H12.4568ZM6.07781 14.9774C5.68317 14.8516 5.26125 15.0696 5.13544 15.4642C5.00963 15.8588 5.22756 16.2808 5.6222 16.4066L6.07781 14.9774ZM11.6797 17.4337C12.0938 17.4449 12.4385 17.1183 12.4497 16.7043C12.4609 16.2902 12.1343 15.9455 11.7203 15.9343L11.6797 17.4337ZM10.5 16.523C10.5 16.1088 10.1642 15.773 9.75001 15.773C9.33579 15.773 9.00001 16.1088 9.00001 16.523H10.5ZM14.4049 16.523C14.4049 16.1088 14.0691 15.773 13.6549 15.773C13.2407 15.773 12.9049 16.1088 12.9049 16.523H14.4049ZM17.3222 14.9774C15.4929 15.5606 13.5943 15.8825 11.6797 15.9343L11.7203 17.4337C13.7761 17.3782 15.8144 17.0325 17.7778 16.4066L17.3222 14.9774ZM18.224 15.3549L17.5844 14.0449L16.2364 14.7031L16.876 16.0131L18.224 15.3549ZM17.5983 14.0752C17.1347 13.008 16.8275 11.8759 16.6868 10.7157L15.1977 10.8963C15.3558 12.1997 15.701 13.4723 16.2225 14.6728L17.5983 14.0752ZM16.6821 10.6832C16.4696 9.40313 16.017 8.21501 15.1948 7.33897C14.3526 6.44171 13.1869 5.941 11.7068 5.941V7.441C12.8193 7.441 13.5729 7.80279 14.1011 8.36553C14.6492 8.94949 15.0181 9.81887 15.2024 10.9288L16.6821 10.6832ZM11.7068 5.941C10.2266 5.941 9.05835 6.44146 8.21321 7.33789C7.38755 8.21366 6.93123 9.40201 6.71795 10.6839L8.19761 10.9301C8.38214 9.82099 8.75359 8.95134 9.30463 8.36686C9.83619 7.80304 10.5936 7.441 11.7068 7.441V5.941ZM6.71325 10.7166C6.57244 11.8765 6.26519 13.0083 5.80171 14.0752L7.1775 14.6728C7.69888 13.4727 8.04413 12.2004 8.20232 10.8974L6.71325 10.7166ZM5.81565 14.0449L5.17605 15.3549L6.52397 16.0131L7.16357 14.7031L5.81565 14.0449ZM12.4568 6.691V5H10.9568V6.691H12.4568ZM12.4568 6.691V5H10.9568V6.691H12.4568ZM5.6222 16.4066C7.58558 17.0325 9.62394 17.3782 11.6797 17.4337L11.7203 15.9343C9.80576 15.8825 7.90713 15.5606 6.07781 14.9774L5.6222 16.4066ZM9.00001 16.523V17.023H10.5V16.523H9.00001ZM9.00001 17.023C9.00001 18.5252 10.1921 19.7755 11.7024 19.7755V18.2755C11.0561 18.2755 10.5 17.7327 10.5 17.023H9.00001ZM11.7024 19.7755C13.2127 19.7755 14.4049 18.5252 14.4049 17.023H12.9049C12.9049 17.7327 12.3487 18.2755 11.7024 18.2755V19.7755ZM14.4049 17.023V16.523H12.9049V17.023H14.4049Z"
                                            fill="currentColor"></path>
                                    </g>
                                </svg>
                            </a>
                            <a class="relative text-gray-700 transition-colors duration-300 transform hover:text-primary"
                                href="#">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3 3H5L5.4 5M7 13H17L21 5H5.4M7 13L5.4 5M7 13L4.70711 15.2929C4.07714 15.9229 4.52331 17 5.41421 17H17M17 17C15.8954 17 15 17.8954 15 19C15 20.1046 15.8954 21 17 21C18.1046 21 19 20.1046 19 19C19 17.8954 18.1046 17 17 17ZM9 19C9 20.1046 8.10457 21 7 21C5.89543 21 5 20.1046 5 19C5 17.8954 5.89543 17 7 17C8.10457 17 9 17.8954 9 19Z"
                                        stroke="#2563EB" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <?php  if($count != 0){ ?>
                                <span
                                    class="absolute flex justify-center items-center w-5 h-5 p-0.5 text-center text-white bg-blue-500 rounded-full"
                                    style="font-size : 11px; top :-30%; right : -40%;"><?php  echo $count?>
                                </span>
                                <?php }?>

                            </a>
                        </div>
                        <?php } ?>


                        <?php
                            
                             if(empty($_SESSION["user_id"])){ ?>
                        <a href="../components/login.php"
                            class="px-3 py-2 mx-3 mt-2 text-primary font-semibold transition-colors duration-300 transform rounded-md lg:mt-0  hover:bg-gray-100 ">Login</a>
                        <a href="../components/signup.php"
                            class="px-3 py-2 mx-3 mt-2 text-gray-700 font-semibold  transition-colors duration-300 transform rounded-md lg:mt-0  hover:bg-gray-100 ">Sign
                            up</a>


                        <?php    }
                            
                            ?>
                    </div>

                    <?php  
                 
                  if(isset($_SESSION["user_id"])){
                    $user_id=$_SESSION["user_id"];
                 if(profileimgvalidate($user_id)) {

                    
                    $result=$con->query("SELECT * FROM customers  WHERE cus_id=$user_id");
                    if(!empty($result)&& $result->num_rows>0){
                    if($row=$result->fetch_assoc()){?>
                    <div class="flex items-center lg:mt-0">
                        <div class=''>
                            <button onclick="location.href='./profile.php'" type="button"
                                class="flex items-center focus:outline-none" aria-label="toggle profile dropdown">
                                <div class="w-8 h-8 overflow-hidden border-2 border-gray-400 rounded-full">
                                    <img src="data:image/jepg;base64,<?php echo base64_encode($row["per_img"]) ?>"
                                        class="object-cover w-full h-full" alt="avatar">
                                </div>

                                <h3 class="mx-2 text-gray-700 lg:hidden">
                                    <?Php  echo profileout("user_name",$_SESSION["user_id"])?>
                                </h3>
                            </button>
                        </div>
                    </div>

                    <?php   }}} 
                 else{ ?>
                    <div class="flex items-center mt-4 lg:mt-0">
                        <div class=''>
                            <button type="button" class="flex items-center focus:outline-none"
                                onclick="location.href='./profile.php'" aria-label="toggle profile dropdown">
                                <div class="w-8 h-8 overflow-hidden border-2 border-gray-400 rounded-full">
                                    <svg class="object-cover w-full h-full bg-gray-200 " viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" stroke="#bbb">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <g id="Iconly/Curved/Profile">
                                                <g id="Profile">
                                                    <path id="Stroke 1" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M11.8445 21.6618C8.15273 21.6618 5 21.0873 5 18.7865C5 16.4858 8.13273 14.3618 11.8445 14.3618C15.5364 14.3618 18.6891 16.4652 18.6891 18.766C18.6891 21.0658 15.5564 21.6618 11.8445 21.6618Z"
                                                        stroke="#bbb" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                    </path>
                                                    <path id="Stroke 3" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M11.8372 11.1735C14.26 11.1735 16.2236 9.2099 16.2236 6.78718C16.2236 4.36445 14.26 2.3999 11.8372 2.3999C9.41452 2.3999 7.44998 4.36445 7.44998 6.78718C7.4418 9.20172 9.3918 11.1654 11.8063 11.1735C11.8172 11.1735 11.8272 11.1735 11.8372 11.1735Z"
                                                        stroke="#bbb" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>

                                </div>

                                <h3 class="mx-2 text-gray-700 lg:hidden">
                                    <?Php  echo profileout("user_name",$_SESSION["user_id"])?>
                                </h3>
                            </button>
                        </div>
                    </div>

                    <?php   } }?>


                </div>


            </div>
        </div>
    </nav>
    <?php if(!empty($_SESSION["user_id"])){
    $user_id=$_SESSION["user_id"]; 
    $result=$con->query("SELECT * FROM cart JOIN closet ON closet.clo_id=cart.clo_id JOIN customers ON customers.cus_id=cart.cus_id WHERE cart.cus_id='$user_id' ");
    if(!empty($result)&& $result->num_rows>0){
    ?>
    <div class='w-full h-36 flex justify-center items-center  mt-10'>
        <h1 class="text-3xl font-bold text-gray-800 text-center">Shopping Cart</h1>
    </div>

    <div class=" bg-transparent container px-6 py-0 mx-auto flex justify-center z-20 ">

        <div class="font-sans w-fit mx-auto  bg-white ">

            <div class="grid md:grid-cols-3 gap-5">

                <!-- items box  -->
                <div class="md:col-span-2 space-y-4 h-full ">
                    <?php 
                $subtotal=0;
                while($row=$result->fetch_assoc()){
                $email=$row["email"];
                $user_name=$row["user_name"];
                $clo_id=$row["clo_id"];
                 $user_id=$row["cus_id"];
         
           ?>
                    <div class="grid grid-cols-3 items-start gap-4">
                        <div class="col-span-2 flex items-start gap-4">
                            <div class="w-28 h-28 max-sm:w-24 max-sm:h-24 shrink-0 bg-gray-100 p-2 rounded-md">
                                <img src="data:image/jepg;base64,<?php echo base64_encode(retriimg($row["clo_id"])) ?>"
                                    class="w-full h-full object-contain" />

                            </div>

                            <div class="flex flex-col ">
                                <h3 class="text-base font-bold text-gray-800"><?php echo $row["productname"]?></h3>
                                <p class="text-xs font-semibold text-gray-500 mt-0.5">Size : <?php echo $row["size"]?>
                                </p>
                                <p class="text-xs font-semibold text-gray-500 mt-0.5">Number :
                                    <?php echo $row["quantity"]?></p>
                                <span class='rounded-full mt-2 border border-gray-400'
                                    style='width: 20px; height: 20px; background-color:<?php echo $row["cart_color"];?>'></span>

                                <form action="../function/cartitemremove.php" method="post">
                                    <input type="text" name="cart_id" value="<?php  echo $row["cart_id"] ?>"
                                        style="display: none;">
                                    <input type="text" name="clo_id" value="<?php  echo $row["clo_id"] ?>"
                                        style="display: none;">
                                    <input type="text" name="quantity" value="<?php  echo $row["quantity"] ?>"
                                        style="display: none;">
                                    <input type="text" name="size" value="<?php  echo $row["size"] ?>"
                                        style="display: none;">


                                    <button type="submit" name="remove"
                                        class="mt-6 font-semibold text-red-500 text-xs flex items-center gap-1 shrink-0 ">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 fill-current inline"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z"
                                                data-original="#000000"></path>
                                            <path
                                                d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z"
                                                data-original="#000000"></path>
                                        </svg>
                                        REMOVE

                                    </button>
                                </form>
                                <!-- <a
                                    href="../components/updateitem.php?cart_id=<?php echo $row["cart_id"]?>&&  clo_id=<?php echo $row["clo_id"] ?> && quantity=<?php  echo $row["quantity"]?> && size=<?php echo $row["size"]  ?> && price=<?php echo $row["price"] ?> ">Update</a> -->
                            </div>
                        </div>

                        <div class="ml-auto">

                            <h4 class="text-lg max-sm:text-base font-bold text-gray-800"><?php  $subtotal+=$row["orderprice"];
                             echo  $row["orderprice"]?></h4>

                            <a class="update text-primary gap-1 font-semibold mt-6 flex items-center px-3 py-1.5 border border-blue-600  hover:text-white text-sm outline-none bg-transparent rounded-md"
                                href="../components/updateitem.php?cart_id=<?php echo $row["cart_id"]?>&&  clo_id=<?php echo $row["clo_id"] ?> && quantity=<?php  echo $row["quantity"]?> && size=<?php echo $row["size"]  ?> && price=<?php echo $row["price"] ?> ">
                                <svg class='w-4 h-4 ' viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                    fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path fill="none" stroke="currentColor" stroke-width="2"
                                            d="M2.99787498,6.99999999 L2.99787498,0.999999992 L17.4999998,0.999999992 L20.9999998,4.50000005 L21,23 L15,23 M16,1 L16,6 L21,6 M8,23 C11.8659932,23 15,19.8659932 15,16 C15,12.1340068 11.8659932,9 8,9 C4.13400675,9 1,12.1340068 1,16 C1,19.8659932 4.13400675,23 8,23 Z M4.5,16.5 L8,13 L11.5,16.5 M8,13.5 L8,20">
                                        </path>
                                    </g>
                                </svg>
                                Update
                            </a>
                        </div>
                    </div>
                    <?PHP } ?>


                    <hr class="border-gray-300" />


                </div>

                <!-- summary box -->
                <div class="bg-gray-100 rounded-md w-full p-4 h-max">
                    <h3 class="text-lg max-sm:text-base font-bold text-gray-800 border-b border-gray-300 pb-2">Order
                        Summary
                    </h3>

                    <form class="mt-6">
                        <div>
                            <div class="space-y-5">
                                <div class="relative flex items-center justify-between">
                                    <!-- <input type="text" placeholder="Full Name"
                                        class="px-4 py-2.5 bg-white text-gray-800 rounded-md w-full text-sm border-b focus:border-gray-800 outline-none" /> -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-5 h-5"
                                        viewBox="0 0 24 24">
                                        <circle cx="10" cy="7" r="6" data-original="#000000"></circle>
                                        <path
                                            d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z"
                                            data-original="#000000"></path>
                                    </svg>
                                    <h3 class="text-base max-sm:text-sm font-semibold text-gray-800">
                                        <?php echo usernameout($user_id); ?></h3>


                                </div>

                                <div class=" relative flex items-center justify-between">
                                    <!-- <input type="email" placeholder="Email"
                                        class="px-4 py-2.5 bg-white text-gray-800 rounded-md w-full text-sm border-b focus:border-gray-800 outline-none" /> -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-5 h-5 "
                                        viewBox="0 0 682.667 682.667">
                                        <defs>
                                            <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                                <path d="M0 512h512V0H0Z" data-original="#000000"></path>
                                            </clipPath>
                                        </defs>
                                        <g clip-path="url(#a)" transform="matrix(1.33 0 0 -1.33 0 682.667)">
                                            <path fill="none" stroke-miterlimit="10" stroke-width="40"
                                                d="M452 444H60c-22.091 0-40-17.909-40-40v-39.446l212.127-157.782c14.17-10.54 33.576-10.54 47.746 0L492 364.554V404c0 22.091-17.909 40-40 40Z"
                                                data-original="#000000"></path>
                                            <path
                                                d="M472 274.9V107.999c0-11.027-8.972-20-20-20H60c-11.028 0-20 8.973-20 20V274.9L0 304.652V107.999c0-33.084 26.916-60 60-60h392c33.084 0 60 26.916 60 60v196.653Z"
                                                data-original="#000000"></path>
                                        </g>
                                    </svg>
                                    <h3 class="text-base max-sm:text-sm font-semibold text-gray-800">
                                        <?php  echo emailout($user_id)?> </h3>


                                </div>
                            </div>
                        </div>
                    </form>

                    <ul class="text-gray-800 mt-8 space-y-3">
                        <?php if(isset($subtotal)){?>
                        <li class="flex flex-wrap gap-4 text-sm">Subtotal <span
                                class="ml-auto font-bold"><?php echo $subtotal;?>KS</span>
                        </li> <?php } else{?>
                        <li class="flex flex-wrap gap-4 text-sm">Subtotal <span
                                class="ml-auto font-bold"><?php echo $subtotal=0;?>KS</span>
                        </li> <?php }?>
                        <li class="flex flex-wrap gap-4 text-sm">Shipping <span class="ml-auto font-bold">
                                <?PHP  echo $shipping=3000?>KS
                            </span>
                        </li>
                        <li class="flex flex-wrap gap-4 text-sm">Tax <span class="ml-auto font-bold">
                                <?PHP  echo $tax=1000?>KS
                            </span></li>
                        <hr class="border-gray-300" />
                        <li class="flex flex-wrap gap-4 text-sm font-bold">Total <span
                                class="ml-auto"><?php echo $subtotal+$shipping+$tax; ?>KS</span>
                        </li>
                    </ul>

                    <div class="mt-6 w-full space-y-3 ">

                        <button type="submit"
                            class="cursor-pointer text-sm px-4 py-2.5 w-full font-semibold tracking-wide bg-primary hover:bg-white hover:text-blue-600  border border-blue-600  text-white rounded-md">
                            <label for="order" class='cursor-pointer'>Order Now</label>
                        </button>
                        <button type="button"
                            class="text-sm px-4 py-2.5 w-full font-semibold tracking-wide bg-transparent text-gray-800 border border-gray-300 rounded-md"
                            onclick="location.href='./home.php'">Continue
                            Shopping
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- <form action="../function/cartmovorder.php" method="post" style="display: none;">
        <input type="text" name="user_id" value="<?php  echo $user_id;?>">
          <input type="text" name="Total" value="<?php  echo $subtotal+$shipping+$tax;?>">
        <input type="submit" name="submit" value="submit" id="order">
    </form> -->
      <form action="../pages/Payment.php" method="post" style="display: none;">
        <input type="text" name="user_id" value="<?php  echo $user_id;?>">
          <input type="text" name="Total" value="<?php  echo $subtotal+$shipping+$tax;?>">
        <input type="submit" name="submit" value="submit" id="order">
    </form>

    <?php } else {?>
    <div class='w-full mt-10 flex flex-col h-full items-center justify-center gap-8 fixed'>
        <h1 class="text-4xl tracking-wider font-bold text-gray-800">Empty Cart </h1>
        <img class='mx-auto' style='' src="../../public/emptyCart.svg" alt="">

    </div>
    <?php }} ?>
</body>



<script>
const quantityInput = document.getElementById('quantity-input');
const incrementButton = document.getElementById('increment-button');
const decrementButton = document.getElementById('decrement-button');

incrementButton.addEventListener('click', () => {
    const currentValue = parseInt(quantityInput.value, 10);
    quantityInput.value = currentValue + 0.5;
    decrementButton.classList.remove('disabled');
});

decrementButton.addEventListener('click', () => {
    const currentValue = parseInt(quantityInput.value, 10);
    if (currentValue > 1) {
        quantityInput.value = currentValue - 0.5;
    } else if (currentValue === 1) {
        console.log('1');
        quantityInput.value = 1;
        decrementButton.classList.add('disabled');
    }
});
</script>
<script>
const nav = document.querySelector('nav');

window.addEventListener('scroll', () => {
    if (window.scrollY > 0) {
        nav.classList.add('scrolled');
    } else {
        nav.classList.remove('scrolled');
    }
});
document.getElementById("account").addEventListener("click", () => {
    document.getElementById("accountcontent").style.width = "20%";

}, false);
</script>


</html>