<?php 
include("../function/functions.php");
include("../function/connection.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- flowbite -->
    <link rel="stylesheet" href="../../node_modules/flowbite/dist/flowbite.min.css">
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>

    <!-- tailwind -->
    <link href="../output.css" rel="stylesheet">

    <!-- alpine -->
    <script src="../../public/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>

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

    .hidded {
        display: none;

    }
    </style> 
    <script>
if ( <?Php echo $_SESSION["update"] ?> ) {

alert("Updated Successfully!");
<?php $_SESSION["update"]=null; ?>
}
    </script>
  
</head>

<body class='flex p-0'>

    <!-- navbar -->
    <nav
        class="navbar flex flex-col  items-center w-full sm:w-14 sm:h-screen sm:py-8 overflow-y-auto bg-white sm:border-r rtl:border-l rtl:border-r-0 ">
        <div class="px-3 pb-4  w-full flex flex-col flex-1 sm:space-y-6">

            <div class='flex justify-center h-20 '>
                <a href="#">
                    <img class="w-auto h-6 " src="https://merakiui.com/images/logo.svg" alt="">
                </a>
            </div>

            <!-- for large screen from (table to latop  & desktop) -->
            <div class='w-full h-full hidden sm:flex  flex-col px-0 items-center justify-between'>
                <div class='w-full flex flex-col gap-4 mt-5'>
                    <a href="#"
                        class="flex h-[48px] grow items-center justify-center gap-2 rounded-md text-sm font-medium bg-blue-100 text-blue-600 md:flex-none md:justify-start md:p-2 md:px-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                    </a>
                    <a href="./components/ordered.php"
                        class='flex h-[48px] grow items-center justify-center gap-2 rounded-md  text-sm font-medium hover:bg-blue-100 hover:text-blue-600 md:flex-none md:justify-start md:p-2 md:px-3  text-gray-600'>
                        <svg class='w-7 h-7' viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg"
                            stroke="#000000" stroke-width="1.128">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <rect x="5" y="4" width="14" height="17" rx="2" stroke="currentColor"></rect>
                                <path d="M9 9H15" stroke="currentColor" stroke-linecap="round"></path>
                                <path d="M9 13H15" stroke="currentColor" stroke-linecap="round"></path>
                                <path d="M9 17H13" stroke="currentColor" stroke-linecap="round"></path>
                            </g>
                        </svg>
                    </a>
                    <a href="./components/notification.php"
                        class='flex h-[48px] grow items-center justify-center gap-2 rounded-md text-sm font-medium hover:bg-blue-100 hover:text-blue-600 md:flex-none md:justify-start md:p-2 md:px-3  text-gray-600'>
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
                    <a href="./components/seeAdminList.php"
                        class='flex h-[48px] grow items-center justify-center gap-2 rounded-md text-sm font-medium hover:bg-blue-100 hover:text-blue-600 md:flex-none md:justify-start md:p-2 md:px-3  text-gray-600'>
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

                </div>

                <div class=" flex  flex-col space-y-6">

                    <a href="../pages/home.php"
                        class="p-1.5  focus:outline-nones transition-colors duration-200 rounded-lg bg-gray-100">

                        <svg class='w-6 h-6' viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M15 12L2 12M2 12L5.5 9M2 12L5.5 15" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                <path
                                    d="M9.00195 7C9.01406 4.82497 9.11051 3.64706 9.87889 2.87868C10.7576 2 12.1718 2 15.0002 2L16.0002 2C18.8286 2 20.2429 2 21.1215 2.87868C22.0002 3.75736 22.0002 5.17157 22.0002 8L22.0002 16C22.0002 18.8284 22.0002 20.2426 21.1215 21.1213C20.3531 21.8897 19.1752 21.9862 17 21.9983M9.00195 17C9.01406 19.175 9.11051 20.3529 9.87889 21.1213C10.5202 21.7626 11.4467 21.9359 13 21.9827"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            </g>
                        </svg>
                    </a>


                </div>
            </div>

            <!-- for small screen -->
            <div class="sm:hidden flex grow flex-row justify-between space-x-2 sm:flex-col sm:space-x-0 sm:space-y-2">
                <a class="flex h-[48px] grow items-center justify-center gap-2 rounded-lg bg-blue-100 p-3 text-base font-semibold  sm:flex-none sm:justify-start sm:p-2 sm:px-3 text-blue-600"
                    href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </a>
                <a class="flex h-[48px] grow items-center justify-center gap-2 rounded-lg bg-gray-100 p-3 text-base font-semibold  sm:flex-none sm:justify-start sm:p-2 sm:px-3"
                    href="./components/ordered.php">
                    <svg class='w-7 h-7' viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg"
                        stroke="#000000" stroke-width="1.128">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <rect x="5" y="4" width="14" height="17" rx="2" stroke="currentColor"></rect>
                            <path d="M9 9H15" stroke="currentColor" stroke-linecap="round"></path>
                            <path d="M9 13H15" stroke="currentColor" stroke-linecap="round"></path>
                            <path d="M9 17H13" stroke="currentColor" stroke-linecap="round"></path>
                        </g>
                    </svg>
                </a>
                <a class="flex h-[48px] grow items-center justify-center gap-2 rounded-lg bg-gray-100 p-3 text-base font-semibold  sm:flex-none sm:justify-start sm:p-2 sm:px-3"
                    href="./components/notification.php">
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

                <div>
                    <a href='../pages/home.php'
                        class="flex h-[48px] w-full grow items-center justify-center gap-2 rounded-lg bg-gray-100 p-3 text-base font-semibold  sm:flex-none sm:justify-start sm:p-2 sm:px-3">
                        <svg class='w-6 h-6' viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M15 12L2 12M2 12L5.5 9M2 12L5.5 15" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                <path
                                    d="M9.00195 7C9.01406 4.82497 9.11051 3.64706 9.87889 2.87868C10.7576 2 12.1718 2 15.0002 2L16.0002 2C18.8286 2 20.2429 2 21.1215 2.87868C22.0002 3.75736 22.0002 5.17157 22.0002 8L22.0002 16C22.0002 18.8284 22.0002 20.2426 21.1215 21.1213C20.3531 21.8897 19.1752 21.9862 17 21.9983M9.00195 17C9.01406 19.175 9.11051 20.3529 9.87889 21.1213C10.5202 21.7626 11.4467 21.9359 13 21.9827"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            </g>
                        </svg>
                    </a>
                </div>

            </div>


        </div>
    </nav>

    <!-- data table -->
    <div class='w-full flex justify-center items-center'>
        <div class='container  flex flex-col main px-3 py-4 h-fit gap-5'>


            <h1 class='main-text text-primary font-semibold text-xl sm:text-3xl'>Dashboard</h1>

            <!-- upper 4 boxes-->
            <div class='w-full grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-10 '>

                <div class="rounded-xl bg-gray-100 p-2 shadow-sm">
                    <div class="flex p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true" data-slot="icon" class="h-5 w-5 text-gray-700">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z">
                            </path>
                        </svg>
                        <h3 class="ml-2 text-base text-gray-500 font-medium">Collected</h3>
                    </div>
                    <p class=" rounded-xl bg-white px-4 py-8 text-center text-2xl">
                        <?php  echo acceptitemks()?>KS
                    </p>
                </div>

                <div class="rounded-xl bg-gray-100 p-2 shadow-sm">
                    <div class="flex p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true" data-slot="icon" class="h-5 w-5 text-gray-700">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                        </svg>
                        <h3 class="ml-2 text-base text-gray-500 font-medium">Pending</h3>
                    </div>
                    <p class="rounded-xl bg-white px-4 py-8 text-center text-2xl">
                        <?php  echo pendingitemks();?>KS
                    </p>
                </div>

                <div class="rounded-xl bg-gray-100 p-2 shadow-sm">
                    <div class="flex p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true" data-slot="icon" class="h-5 w-5 text-gray-700">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z">
                            </path>
                        </svg>
                        <h3 class="ml-2 text-base text-gray-500 font-medium">Total items</h3>
                    </div>
                    <p class=" rounded-xl bg-white px-4 py-8 text-center text-2xl"><?php echo itemcount() ?>
                    </p>
                </div>

                <div class="rounded-xl bg-gray-100 p-2 shadow-sm">
                    <div class="flex p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true" data-slot="icon" class="h-5 w-5 text-gray-700">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z">
                            </path>
                        </svg>
                        <h3 class="ml-2 text-base text-gray-500 font-medium">Total Customers</h3>
                    </div>
                    <p class=" rounded-xl bg-white px-4 py-8 text-center text-2xl"><?php echo userscount() ?></p>
                </div>


            </div>

            <!-- Page Wrapper -->
            <div class='w-full my-10 '>
                <table class='rounded border' id="selection-table">
                    <thead>
                        <tr>
                            <th class='noSort bg-gray-100'>
                                <span class="flex items-center">
                                    Image
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th class='bg-gray-100' data-format="YYYY/DD/MM">
                                <span class="flex items-center">
                                    Type
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th class='bg-gray-100'>
                                <span class="flex items-center">
                                    Instock
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th class='bg-gray-100  noSort'>
                                <span class="flex items-center">
                                    Available Colors
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th class='bg-gray-100'>
                                <span class="flex items-center">
                                    Price
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th class='noSort bg-gray-100'>
                                <span class="flex items-center">
                                    Actions
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php   
                            $result=$con->query("SELECT * FROM closet order by arrDate desc ");
                            if(!empty($result)&& $result->num_rows>0){
                               while($row=$result->fetch_assoc()){ 
                             ?>
                        <tr class="hover:bg-gray-50 cursor-pointer ">
                            <td class="font-medium text-gray-900 whitespace-nowrap "><img style="height:45px;"
                                    src="data:image/jepg;base64,<?php echo base64_encode(retriimg($row["clo_id"])) ?>"
                                    alt="product image" /></td>
                            <td><?php echo $row["type"]?></td>
                            <td><?php echo $row["instock"]?></td>
                            <td class="-z-10">
                                <div class='flex gap-3'>
                                    <?php 
                        $colors = json_decode($row['color']);
                        foreach ($colors as $color) { ?>
                                    <div class='border border-gray-400'
                                        style='width: 22px; height: 22px; border-radius:50%; background-color:<?php echo $color;?>'>
                                    </div>
                                    <?php }?>
                                </div>
                            </td>
                            <td><?php echo $row["price"]?></td>
                            <td>
                                <div class='flex justify-start items-center' style='gap:50px;'>
                                    <a
                                        href="../admin/components/update.php?item_id=<?php echo $row["clo_id"] ?> && noti=<?php echo "home" ?>">
                                        <svg class='w-6 h-6' viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M21.1213 2.70705C19.9497 1.53548 18.0503 1.53547 16.8787 2.70705L15.1989 4.38685L7.29289 12.2928C7.16473 12.421 7.07382 12.5816 7.02986 12.7574L6.02986 16.7574C5.94466 17.0982 6.04451 17.4587 6.29289 17.707C6.54127 17.9554 6.90176 18.0553 7.24254 17.9701L11.2425 16.9701C11.4184 16.9261 11.5789 16.8352 11.7071 16.707L19.5556 8.85857L21.2929 7.12126C22.4645 5.94969 22.4645 4.05019 21.2929 2.87862L21.1213 2.70705ZM18.2929 4.12126C18.6834 3.73074 19.3166 3.73074 19.7071 4.12126L19.8787 4.29283C20.2692 4.68336 20.2692 5.31653 19.8787 5.70705L18.8622 6.72357L17.3068 5.10738L18.2929 4.12126ZM15.8923 6.52185L17.4477 8.13804L10.4888 15.097L8.37437 15.6256L8.90296 13.5112L15.8923 6.52185ZM4 7.99994C4 7.44766 4.44772 6.99994 5 6.99994H10C10.5523 6.99994 11 6.55223 11 5.99994C11 5.44766 10.5523 4.99994 10 4.99994H5C3.34315 4.99994 2 6.34309 2 7.99994V18.9999C2 20.6568 3.34315 21.9999 5 21.9999H16C17.6569 21.9999 19 20.6568 19 18.9999V13.9999C19 13.4477 18.5523 12.9999 18 12.9999C17.4477 12.9999 17 13.4477 17 13.9999V18.9999C17 19.5522 16.5523 19.9999 16 19.9999H5C4.44772 19.9999 4 19.5522 4 18.9999V7.99994Z"
                                                    fill="#FFC107"></path>
                                            </g>
                                        </svg>
                                    </a>
                                    <form action="./components/delete.php" method="post">
                                        <input type="text" value="<?php echo $row["clo_id"]; ?>" name="clo_id"
                                            style="display:none;">
                                        <button type='button' class='w-6 h-6 delete-button'>
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                </g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path d="M10 11V17" stroke="#FF4F4E" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M14 11V17" stroke="#FF4F4E" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M4 7H20" stroke="#FF4F4E" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path
                                                        d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z"
                                                        stroke="#FF4F4E" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <path
                                                        d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z"
                                                        stroke="#FF4F4E" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </g>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        <?php }}?>
                    </tbody>
                </table>
                <!-- Custom Modal for Confirmation -->
                <div id="custom-modal"
                    class="hidded fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center"
                    style='z-index:999; !important'>
                    <div class="bg-white rounded-lg shadow-lg p-6 w-80">
                        <h2 class="text-lg font-semibold mb-4">Are you sure?</h2>
                        <p class="mb-6">Do you really want to delete this item? This process cannot be
                            undone.</p>
                        <div class="flex justify-end space-x-4">
                            <button id="cancel-btn"
                                class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">Cancel</button>
                            <button id="confirm-btn"
                                class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Delete</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>




    <script>
    if (document.getElementById("selection-table") && typeof simpleDatatables.DataTable !== 'undefined') {

        const exportCustomCSV = function(dataTable, userOptions = {}) {
            // A modified CSV export that includes a row of minuses at the start and end.
            const clonedUserOptions = {
                ...userOptions
            }
            clonedUserOptions.download = false
            const csv = simpleDatatables.exportCSV(dataTable, clonedUserOptions)
            // If CSV didn't work, exit.
            if (!csv) {
                return false
            }
            const defaults = {
                download: true,
                lineDelimiter: "\n",
                columnDelimiter: ";"
            }
            const options = {
                ...defaults,
                ...clonedUserOptions
            }

            return str
        }
        const table = new simpleDatatables.DataTable("#selection-table", {
            perPage: 5,
            perPageSelect: [5, 10, 20, 50], // Options for the entries dropdown
            columns: [{
                select: [0,3, 5],
                sortable: false
            }],
            template: (options, dom) => "<div class='" + options.classes.top + "'>" +
                "<div class='flex flex-col sm:items-center sm:justify-between sm:flex-row space-y-4 sm:space-y-0 sm:space-x-3 rtl:space-x-reverse w-full h-fit '>" +
                "<a href='./additem.php' id='exportDropdownButton' class='cursor-pointer flex w-fit px-2 h-10 items-center justify-center rounded-lg border border-blue-600 text-sm font-semibold bg-blue-600 hover:bg-white hover:text-blue-600 text-white focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 sm:w-auto'>" +
                "Add Item" +

                " <svg class='-me-0.5 ms-1.5 h-4 w-4' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'><g id='SVGRepo_bgCarrier' stroke-width='0'></g><g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'></g><g id='SVGRepo_iconCarrier'> <path d='M4 12H20M12 4V20' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'></path> </g></svg>" +

                "</a>" +
                (options.paging && options.perPageSelect ?
                    "<div class='" + options.classes.dropdown + "'>" +
                    "<label>" +
                    "<select class='" + options.classes.selector + "'></select> " + options.labels.perPage +
                    "</label>" +
                    "</div>" : ""
                ) +
                "<div id='exportDropdown' class='z-10 hidden w-52 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700' data-popper-placement='bottom'>" +

                "</div>" + "</div>" +
                (options.searchable ?
                    "<div class='" + options.classes.search + "'>" +
                    "<input class='" + options.classes.input + "' placeholder='" + options.labels.placeholder +
                    "' type='search' title='" + options.labels.searchTitle + "'" + (dom.id ?
                        " aria-controls='" + dom.id + "'" : "") + ">" +
                    "</div>" : ""
                ) +
                "</div>" +
                "<div class='" + options.classes.container + "'" + (options.scrollY.length ?
                    " style='height: " + options.scrollY + "; overflow-Y: auto;'" : "") + "></div>" +
                "<div class='" + options.classes.bottom + "'>" +
                (options.paging ?
                    "<div class='" + options.classes.info + "'></div>" : ""
                ) +
                "<nav class='" + options.classes.pagination + "'></nav>" +
                "</div>"
        })
        const $exportButton = document.getElementById("exportDropdownButton");
        const $exportDropdownEl = document.getElementById("exportDropdown");
        const dropdown = new Dropdown($exportDropdownEl, $exportButton);
        console.log(dropdown)


    }
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


    <script>
    let formToSubmit = null;

    // Function to show the custom modal
    function showCustomModal(event) {
        // Prevent form from submitting
        event.preventDefault();

        // Store the form that needs to be submitted
        formToSubmit = event.target.closest('form');

        // Show the modal
        document.getElementById('custom-modal').classList.remove('hidded');
    }

    // Handle the delete confirmation
    document.getElementById('confirm-btn').addEventListener('click', function() {
        // Submit the form if "Delete" is clicked
        if (formToSubmit) {
            formToSubmit.submit();
        }
    });

    // Hide the modal when "Cancel" is clicked
    document.getElementById('cancel-btn').addEventListener('click', function() {
        document.getElementById('custom-modal').classList.add('hidded');
    });

    // Attach the custom modal trigger to all delete buttons
    document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', showCustomModal);
    });
    </script>


</body>

</html>