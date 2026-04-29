<?php 
include("../../function/connection.php");
include("../../function/functions.php");
$or_date=$_GET["or_date"];
$cus_id=$_GET["cus_id"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending</title>

    <!-- flowbite -->
    <link rel="stylesheet" href="../../../node_modules/flowbite/dist/flowbite.min.css">
    <script src="../../../node_modules/flowbite/dist/flowbite.min.js"></script>

    <!-- tailwind -->
    <link href="../../output.css" rel="stylesheet">

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

    .view-accept-box {
        margin-top: 100px;
    }

    .gapping {
        gap: 8px;
    }

    @media (min-width: 640px) {
        .gapping {
            gap: 0px;
        }

        .view-accept-box {
            margin-top: 0px;
        }

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
</head>

<body>
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
                    <a href="../home.php"
                        class="flex h-[48px] grow items-center justify-center gap-2 rounded-md text-sm font-medium hover:bg-blue-100 hover:text-blue-600 md:flex-none md:justify-start md:p-2 md:px-3 text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                    </a>
                    <a href="./ordered.php"
                        class='flex h-[48px] grow items-center justify-center gap-2 rounded-md  text-sm font-medium bg-blue-100 text-blue-600 md:flex-none md:justify-start md:p-2 md:px-3'>
                        <svg class='w-7 h-7' viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg"
                            stroke="#FF4F4E" stroke-width="1.128">
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
                    <a href="./notification.php"
                        class='flex h-[48px] grow items-center justify-center gap-2 rounded-md text-sm font-medium hover:bg-blue-100 hover:text-blue-600 text-gray-600 md:flex-none md:justify-start md:p-2 md:px-3 '>
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

                    <a href="../../pages/home.php"
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
                <a class="flex h-[48px] grow items-center justify-center gap-2 rounded-lg bg-gray-100 p-3 text-base font-semibold  sm:flex-none sm:justify-start sm:p-2 sm:px-3 text-gray-600"
                    href="../home.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </a>
                <a class="flex h-[48px] grow items-center justify-center gap-2 rounded-lg bg-blue-100 p-3 text-base font-semibold hover: text-blue-600 sm:flex-none sm:justify-start sm:p-2 sm:px-3"
                    href="./ordered.php">
                    <svg class='w-6 h-6' viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg"
                        stroke="currentColor" stroke-width="1.128">
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
                    href="./notification.php">
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
    <section class="bg-white mx-auto flex items-center justify-center min-h-screen h-fit view-accept-box">
        <main
            class="relative shadow-md border border-gray-200 rounded-xl container w-full flex flex-col main items-center px-4 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6">
            <div class='absolute top-5' style='left:3%;'>
                <div
                    class='text-primary border border-primary w-fit flex justify-center items-center gap-1 rounded-full px-2 py-1.5'>
                    <svg class='w-4 h-4' viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 3L4.5 8.5L2 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <p class='text-base max-sm:text-base font-medium'>Pending</p>
                </div>
            </div>
            <div class="w-full sm:w-96 px-2 my-2 ">


                <div class='flex flex-col gap-4'>
                    <!-- user profile -->
                    <div class='flex sm:flex-row flex-col gapping w-full'>
                        <!-- user profile -->
                        <div class='flex items-center w-full px-3'>
                            <div class='h-fit  flex justify-center w-full relative rounded-xl bg-image bg-cover bg-no-repeat'
                                style="background-image : url('../../public/profileCoverImg.jpg')">

                                <div class="relative ">
                                    <?php 
                                    $img=personaldetail("per_img",$cus_id);
                                    if(isset($img)){  ?>
                                    <img src="data:image/jepg;base64,<?php echo base64_encode($img) ?>"
                                        class="w-40 h-40 border border-gray-300 bg-gray-200 rounded-full" alt="avatar">
                                    <?php }else{?>
                                    <svg class="w-32 h-32 ring-4 ring-white bg-gray-200 rounded-full"
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        stroke="#bbb">
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
                                    </svg> <?php }?>
                                </div>
                            </div>
                        </div>
                        <!-- user info -->
                        <div class='w-full  px-3'>
                            <!-- name , email , address , status -->
                            <div class='space-y-4'>
                                <div class="relative grid grid-cols-4 items-center justify-between ">
                                    <!-- <input type="text" placeholder="Full Name"
                                        class="px-4 py-2.5 bg-white text-gray-800 rounded-md w-full text-sm border-b focus:border-gray-800 outline-none" /> -->
                                    <div class='col-span-1 h-full flex justify-center'>
                                        <svg class='w-6 h-6' viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                                    stroke="#bbb" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                                                    stroke="#bbb" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class=' col-span-3 h-full flex'>
                                        <h3 class="text-lg max-sm:text-base font-medium text-gray-800">
                                            <?php echo personaldetail("user_name",$cus_id)?>
                                        </h3>

                                    </div>

                                </div>
                                <div class="relative grid grid-cols-4 items-center justify-between ">
                                    <!-- <input type="text" placeholder="Full Name"
                                        class="px-4 py-2.5 bg-white text-gray-800 rounded-md w-full text-sm border-b focus:border-gray-800 outline-none" /> -->
                                    <div class='col-span-1 h-full flex justify-center'>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb"
                                            class="w-6 h-6" viewBox="0 0 682.667 682.667">
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
                                    </div>
                                    <div class='col-span-3 h-full flex'>
                                        <h3 class="text-lg max-sm:text-base font-medium text-gray-800">
                                            <?php echo personaldetail("email",$cus_id)?>
                                        </h3>

                                    </div>

                                </div>
                                <div class="relative grid grid-cols-4 items-center justify-between ">
                                    <!-- <input type="text" placeholder="Full Name"
                                        class="px-4 py-2.5 bg-white text-gray-800 rounded-md w-full text-sm border-b focus:border-gray-800 outline-none" /> -->
                                    <div class='col-span-1 h-full flex justify-center'>
                                        <svg class='w-6 h-6' fill="#bbb" height="200px" width="200px" version="1.1"
                                            id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 473.806 473.806"
                                            xml:space="preserve" stroke="#bbb">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M374.456,293.506c-9.7-10.1-21.4-15.5-33.8-15.5c-12.3,0-24.1,5.3-34.2,15.4l-31.6,31.5c-2.6-1.4-5.2-2.7-7.7-4 c-3.6-1.8-7-3.5-9.9-5.3c-29.6-18.8-56.5-43.3-82.3-75c-12.5-15.8-20.9-29.1-27-42.6c8.2-7.5,15.8-15.3,23.2-22.8 c2.8-2.8,5.6-5.7,8.4-8.5c21-21,21-48.2,0-69.2l-27.3-27.3c-3.1-3.1-6.3-6.3-9.3-9.5c-6-6.2-12.3-12.6-18.8-18.6 c-9.7-9.6-21.3-14.7-33.5-14.7s-24,5.1-34,14.7c-0.1,0.1-0.1,0.1-0.2,0.2l-34,34.3c-12.8,12.8-20.1,28.4-21.7,46.5 c-2.4,29.2,6.2,56.4,12.8,74.2c16.2,43.7,40.4,84.2,76.5,127.6c43.8,52.3,96.5,93.6,156.7,122.7c23,10.9,53.7,23.8,88,26 c2.1,0.1,4.3,0.2,6.3,0.2c23.1,0,42.5-8.3,57.7-24.8c0.1-0.2,0.3-0.3,0.4-0.5c5.2-6.3,11.2-12,17.5-18.1c4.3-4.1,8.7-8.4,13-12.9 c9.9-10.3,15.1-22.3,15.1-34.6c0-12.4-5.3-24.3-15.4-34.3L374.456,293.506z M410.256,398.806 C410.156,398.806,410.156,398.906,410.256,398.806c-3.9,4.2-7.9,8-12.2,12.2c-6.5,6.2-13.1,12.7-19.3,20 c-10.1,10.8-22,15.9-37.6,15.9c-1.5,0-3.1,0-4.6-0.1c-29.7-1.9-57.3-13.5-78-23.4c-56.6-27.4-106.3-66.3-147.6-115.6 c-34.1-41.1-56.9-79.1-72-119.9c-9.3-24.9-12.7-44.3-11.2-62.6c1-11.7,5.5-21.4,13.8-29.7l34.1-34.1c4.9-4.6,10.1-7.1,15.2-7.1 c6.3,0,11.4,3.8,14.6,7c0.1,0.1,0.2,0.2,0.3,0.3c6.1,5.7,11.9,11.6,18,17.9c3.1,3.2,6.3,6.4,9.5,9.7l27.3,27.3 c10.6,10.6,10.6,20.4,0,31c-2.9,2.9-5.7,5.8-8.6,8.6c-8.4,8.6-16.4,16.6-25.1,24.4c-0.2,0.2-0.4,0.3-0.5,0.5 c-8.6,8.6-7,17-5.2,22.7c0.1,0.3,0.2,0.6,0.3,0.9c7.1,17.2,17.1,33.4,32.3,52.7l0.1,0.1c27.6,34,56.7,60.5,88.8,80.8 c4.1,2.6,8.3,4.7,12.3,6.7c3.6,1.8,7,3.5,9.9,5.3c0.4,0.2,0.8,0.5,1.2,0.7c3.4,1.7,6.6,2.5,9.9,2.5c8.3,0,13.5-5.2,15.2-6.9 l34.2-34.2c3.4-3.4,8.8-7.5,15.1-7.5c6.2,0,11.3,3.9,14.4,7.3c0.1,0.1,0.1,0.1,0.2,0.2l55.1,55.1 C420.456,377.706,420.456,388.206,410.256,398.806z">
                                                        </path>
                                                        <path
                                                            d="M256.056,112.706c26.2,4.4,50,16.8,69,35.8s31.3,42.8,35.8,69c1.1,6.6,6.8,11.2,13.3,11.2c0.8,0,1.5-0.1,2.3-0.2 c7.4-1.2,12.3-8.2,11.1-15.6c-5.4-31.7-20.4-60.6-43.3-83.5s-51.8-37.9-83.5-43.3c-7.4-1.2-14.3,3.7-15.6,11 S248.656,111.506,256.056,112.706z">
                                                        </path>
                                                        <path
                                                            d="M473.256,209.006c-8.9-52.2-33.5-99.7-71.3-137.5s-85.3-62.4-137.5-71.3c-7.3-1.3-14.2,3.7-15.5,11 c-1.2,7.4,3.7,14.3,11.1,15.6c46.6,7.9,89.1,30,122.9,63.7c33.8,33.8,55.8,76.3,63.7,122.9c1.1,6.6,6.8,11.2,13.3,11.2 c0.8,0,1.5-0.1,2.3-0.2C469.556,223.306,474.556,216.306,473.256,209.006z">
                                                        </path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class='col-span-3 h-full flex'>
                                        <h3 class="text-lg max-sm:text-base font-medium text-gray-800">
                                            <?php echo personaldetail("ph_no",$cus_id)?>
                                        </h3>

                                    </div>

                                </div>
                                <div class="relative grid grid-cols-4 items-center justify-between ">
                                    <!-- <input type="text" placeholder="Full Name"
                                        class="px-4 py-2.5 bg-white text-gray-800 rounded-md w-full text-sm border-b focus:border-gray-800 outline-none" /> -->
                                    <div class='col-span-1 h-full flex justify-center'>
                                        <svg class='w-6 h-6' viewBox="-4 0 32 32" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <title>location</title>
                                                <desc>Created with Sketch Beta.</desc>
                                                <defs> </defs>
                                                <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                                    fill-rule="evenodd" sketch:type="MSPage">
                                                    <g id="Icon-Set" sketch:type="MSLayerGroup"
                                                        transform="translate(-104.000000, -411.000000)" fill="#bbb">
                                                        <path
                                                            d="M116,426 C114.343,426 113,424.657 113,423 C113,421.343 114.343,420 116,420 C117.657,420 119,421.343 119,423 C119,424.657 117.657,426 116,426 L116,426 Z M116,418 C113.239,418 111,420.238 111,423 C111,425.762 113.239,428 116,428 C118.761,428 121,425.762 121,423 C121,420.238 118.761,418 116,418 L116,418 Z M116,440 C114.337,440.009 106,427.181 106,423 C106,417.478 110.477,413 116,413 C121.523,413 126,417.478 126,423 C126,427.125 117.637,440.009 116,440 L116,440 Z M116,411 C109.373,411 104,416.373 104,423 C104,428.018 114.005,443.011 116,443 C117.964,443.011 128,427.95 128,423 C128,416.373 122.627,411 116,411 L116,411 Z"
                                                            id="location" sketch:type="MSShapeGroup"> </path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class='col-span-3 h-full flex'>
                                        <h3 class="text-lg max-sm:text-base font-medium text-gray-800">
                                            <?php echo personaldetail("address",$cus_id)?>
                                        </h3>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- order fees -->
                        <div class='rounded-xl flex items-center justify-center w-full bg-gray-100'>
                            <div class='h-full w-full grid grid-rows-3 p-4 space-y-2'>
                                <h3
                                    class="w-full text-base max-sm:text-base font-bold text-gray-800 border-b border-gray-300 pb-2">
                                    Order
                                    Summary
                                </h3>
                                <div class='row-span-1 w-full h-full flex gap-3 items-center justify-between'>
                                    <span class='text-base text-gray-700'>Subtotal :</span>
                                    <h3 class='text-base font-medium text-gray-900'><?php  $subtotal=subtotal2($or_date,$cus_id);
                                    echo  $subtotal;?>KS</h3>
                                </div>
                                <div class=' row-span-1 w-full h-full flex gap-3 items-center justify-between'>
                                    <span class='text-base text-gray-700'>Shipping :</span>
                                    <h3 class='text-base font-medium text-gray-900'>3000Ks</h3>
                                </div>
                                <div
                                    class='border-b border-gray-300 row-span-1 w-full h-full flex gap-3 items-center justify-between'>
                                    <span class='text-base text-gray-700'>Tax :</span>
                                    <h3 class='text-base font-medium text-gray-900'>1000Ks</h3>
                                </div>

                                <div class=' row-span-1 w-full h-full flex gap-3 items-center justify-between'>
                                    <span class='text-base text-gray-700'>Total :</span>
                                    <h3 class='text-base font-medium text-gray-900'><?php echo $subtotal+3000+1000?>KS
                                    </h3>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- ordered item  accepted by admin  -->
                    <div class='mt-5 '>
                        <div class="item-box sm:w-0 grid lg:grid-cols-2  gap-5">
                            <?php
            ob_start();
    
    $result=$con->query("SELECT * FROM orderhistory JOIN closet ON closet.clo_id=orderhistory.clo_id JOIN customers ON customers.cus_id=orderhistory.cus_id where admindec='Pending' and orderhistory.or_date='$or_date' and orderhistory.cus_id='$cus_id' ");
    if(!empty($result)&& $result->num_rows>0){
       while($row=$result->fetch_assoc()){ 
        
         ?>
                            <!-- loop start from here  -->
                            <div class='item-detail bg-gray-100 py-4 px-3 w-full rounded-xl h-fit flex  gap-0'>
                                <!-- image  -->
                                <div class="w-1/2 rounded-md flex justify-center items-center overflow-hidden ">
                                    <img src="data:image/jepg;base64,<?php echo base64_encode(retriimg($row["clo_id"])) ?>"
                                        alt="Product"
                                        style='min-width:150px; max-width:150px; min-height:150px; max-height:150px; '
                                        class=" object-fill object-top " />
                                </div>
                                <!-- text belong to that item -->
                                <div class='w-1/2 grid grid-rows-3 py-2'>
                                    <div class=' row-span-1 w-full h-full flex gap-3 items-center'>
                                        <h3 class='text-xl font-medium text-gray-900'>type :</h3>
                                        <span class='text-base text-gray-700'><?php echo $row["type"]?></span>
                                    </div>
                                    <div class='items-fact row-span-1 w-full h-full flex '>
                                        <div class='w-full h-full flex  gap-3 items-center '>
                                            <h3 class='text-xl font-medium text-gray-900'>color :</h3>
                                            <div
                                                style='width: 20px; height: 20px; border-radius:50%; background-color:<?Php echo $row["or_color"]?>'>
                                            </div>
                                        </div>
                                        <div class='w-full h-full flex   gap-3 items-center'>
                                            <h3 class='text-xl font-medium text-gray-900'>size :</h3>
                                            <span class='text-base text-gray-700'><?php echo $row["size"]?></span>
                                        </div>
                                    </div>
                                    <div class='items-fact row-span-1 w-full h-full flex'>
                                        <div class='w-full h-full flex  gap-3 items-center'>
                                            <h3 class='text-xl font-medium text-gray-900'>quantity :</h3>
                                            <span class='text-base text-gray-700'><?php echo $row["quantity"]?></span>
                                        </div>
                                        <div class='w-full h-full flex gap-3 items-center'>
                                            <h3 class='text-xl font-medium text-gray-900'>cost :</h3>
                                            <span
                                                class='text-base text-gray-700'><?php  echo $row["orderprice"]?>KS</span>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?PHP }}?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 w-1/2 flex gap-4 deli-btn">
                <label for="submit" style="text-align:center;" class=" cursor-pointer text-sm px-4 py-2.5 w-full font-semibold tracking-wide bg-primary hover:bg-white hover:text-blue-600  border border-blue-600  text-white rounded-md">
           
                     Check Payment
                    
               
                </label>
            <!-- <form action="../../function/validate.php" method="get" style="display:none;">
    <input type="text" style="display:none" value="<?php echo $cus_id ?>" name="cus_id"><br>
                <input type="text" style="display:none" value="<?php echo $or_date ?>" name="or_date"><br>
                 <input type="submit" id="submit">
            </form> -->
             <form action="../components/checkPayment.php" method="POST" style="display:none;">
    <input type="text" style="display:none" value="<?php echo $cus_id ?>" name="cus_id"><br>
                <input type="text" style="display:none" value="<?php echo $or_date ?>" name="or_date"><br>
                 <input type="submit" id="submit">
            </form>
                <button type="button"
                    class="text-sm px-4 py-2.5 w-full font-semibold tracking-wide bg-transparent text-gray-800 border border-gray-300 rounded-md"
                    onclick="location.href='./ordered.php'">
                    Back
                </button>
            </div>
        </main>
    </section>


</body>
<style>
.item-box {
    flex-direction: column;
}

.item-detail {
    flex-direction: column;
}

.item-detail>div {
    width: 100%;
}

.items-fact {
    flex-direction: column;
}

@media (min-width: 640px) {
    .item-detail>div {
        width: 50%;
    }

    .item-detail {
        flex-direction: row;
    }

    .items-fact {
        flex-direction: row;
    }
}

@media (min-width: 1024px) {
    .item-box {
        flex-direction: row;
    }
}
</style>

</html>