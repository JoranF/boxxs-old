<?php 
// user.php
require_once '../src/user.php';
if (isset($_POST['register'])) {
    $user = new User();
    if($user->register($_POST['username'], $_POST['email'], $_POST['password'])) {
        echo 'User registered!';
        header('Location: login.php');
    } else {
        echo 'User not registered!';
    }
}
?>
<!-- register page -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.1.2/tailwind.min.css">
    <title>Document</title>
</head>

<body>
    <div class="flex h-screen justify-center items-center">
        <div class="w-full max-w-xs">
            <div class="bg-white shadow-xl rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <h1 class="text-center text-2xl font-bold">Register</h1>
                </div>
                <form action="register.php" method="POST">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            Username
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" name="username" placeholder="Username">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                            Email
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" name="email" placeholder="Email">
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            Password
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" placeholder="******** ">
                    </div>
                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="register">
                            Register
                        </button>
                    </div>
                    <div class="flex pt-4 text-blue-400">
                        <a href="login.php">Log in op een bestaand account!</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
</body>

</html>