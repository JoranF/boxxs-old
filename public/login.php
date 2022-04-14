<?php
// user.php
require_once '../src/user.php';
if (isset($_POST['login'])) {
    $user = new User();
    if ($user->login($_POST['username'], $_POST['password'])) {
        header('Location: index.php');
    } else {                            
        $error = true;
    }
}
?>
<!-- login page -->
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
                    <h1 class="text-center text-2xl font-bold">Login</h1>
                </div>
                <form action="login.php" method="POST">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            Username
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" name="username" placeholder="Username">
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            Password
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" placeholder="******** ">
                        <?php if (isset($error)) {
                            echo '<div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800" role="alert"><span class="font-medium">Warning alert!</span> Change a few things up and try submitting again.</div>';
                        } ?>
                    </div>
                    <div class="flex items-center ">
                        <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" name="login" type="submit">
                            Login
                        </button>
                    </div>
                    <div class="flex pt-4 text-blue-400">
                        <a href="register.php">Maak een account aan!</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>