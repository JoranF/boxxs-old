<?php

session_start();
require_once "../src/db.php";
require_once "../src/files.php";

$files = new Files();


?>

<!-- cloud storage page -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.1.2/tailwind.min.css">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />
    <title>Document</title>
</head>

<body>
    <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-800">
        <div class="container flex ">
            <a href="../public/" class="">
                <img src="https://upload.wikimedia.org/wikipedia/commons/7/73/Lays_brand_logo.png" class="mr-3 h-6 sm:h-9" alt="Bloxxs Logo">
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Bloxxs</span>
            </a>
            <?php if (isset($_SESSION['user']['id'])) : ?>
                <div class="flex items-center absolute right-5 top-0 m-5">
                    <button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 rounded-full" src="https://picsum.photos/100/100" alt="user photo">
                    </button>
                    <div class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(1246px, 783px);" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top">
                        <div class="py-3 px-4">
                            <span class="block text-sm text-gray-900 dark:text-white"><?= $_SESSION['user']['username']; ?></span>
                            <span class="block text-sm font-medium text-gray-500 truncate dark:text-gray-400"><?= $_SESSION['user']['email']; ?></span>
                        </div>
                        <ul class="py-1" aria-labelledby="dropdown">
                            <li>
                                <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                            </li>
                            <!-- <li>
                            <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                        </li> -->
                            <li>
                                <a href="../src/signout.php" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
                            </li>
                        </ul>
                    </div>
                <?php endif ?>
                <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
                </div>
        </div>
    </nav>

    <div class="flex">
        <?php if (!isset($_GET['shared'])) : ?>
            <aside class="w-64" aria-label="Sidebar">
                <div class="overflow-y-auto py-4 px-3 rounded dark:bg-gray-800">
                    <ul class="space-y-2">
                        <li>
                            <a href="../public/" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
                                </svg>
                                <span class="flex-1 ml-3 whitespace-nowrap" type="" data-modal-toggle="">Home</span>
                            </a>
                        </li>
                </div>
            <?php endif ?>
            </aside>
    </div>

    <?php
    $shared_files = $files->getsharedFromUser($_SESSION['user']['id']);
    ?>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-1/2 m-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Files
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Receiver
                    </th>
                    <th scope="col" class="px-6 py-3">
                        link
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">delete</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <h1 class="text-xl text-center">files from you</h1>
                <?php foreach ($shared_files as $shared) :
                    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?shared=";
                    $actual_link = str_replace("sharing.php", "index.php", $actual_link);
                ?>

                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <?php foreach ($files->getFileNames($shared['id']) as $fileNames) : ?>
                                <?= $fileNames['file_name'] ?>
                                <br>
                            <?php endforeach  ?>
                        </th>
                        <td class="px-6 py-4">
                            <?= $shared['shared_user_mail']  ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= $actual_link, $shared['random_link']; ?>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline" name="delete" value="<?= $shared['id'] ?>">Delete</button>
                        </td>
                    </tr>
                <?php endforeach  ?>
            </tbody>
        </table>
        <?php
        $shared_files = $files->getsharedFromMail($_SESSION['user']['email']);
        ?>
        <h1 class="text-xl text-center mt-10">files shared to you</h1>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Files
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Receiver
                    </th>
                    <th scope="col" class="px-6 py-3">
                        link
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($shared_files as $shared) :
                    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?shared=";
                    $actual_link = str_replace("sharing.php", "index.php", $actual_link);
                ?>

                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <?php foreach ($files->getFileNames($shared['id']) as $fileNames) : ?>
                                <?= $fileNames['file_name'] ?>
                                <br>
                            <?php endforeach  ?>
                        </th>
                        <td class="px-6 py-4">
                            <?= $shared['shared_user_mail']  ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= $actual_link, $shared['random_link']; ?>
                        </td>
                    </tr>
                <?php endforeach  ?>
            </tbody>
        </table>
    </div>

    <footer class="p-4 bg-white rounded-lg shadow md:flex md:items-center md:justify-between md:p-6 dark:bg-gray-800 fixed bottom-0">
        <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2022 <a href="" class="hover:underline">Boxxs</a>. All Rights Reserved.
        </span>
        <ul class="flex flex-wrap items-center mt-3 text-sm text-gray-500 dark:text-gray-400 sm:mt-0">
            <li>
                <a href="#" class="mr-4 hover:underline md:mr-6 ">About</a>
            </li>
            <li>
                <a href="#" class="mr-4 hover:underline md:mr-6">Privacy Policy</a>
            </li>
            <li>
                <a href="#" class="mr-4 hover:underline md:mr-6">Licensing</a>
            </li>
            <li>
                <a href="#" class="hover:underline">Contact</a>
            </li>
        </ul>
    </footer>
</body>
<script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    $(document).ready(function() {
        $('button[name="delete"]').click(function() {
            var id = $(this).val();
            $.ajax({
                url: '../src/dataHandler.php',
                type: 'POST',
                data: {
                    shared_id: id
                },
                success: function(data) {
                    location.reload();
                }
            });
        });
    });
</script>

</html>