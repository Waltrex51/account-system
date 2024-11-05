<?php 
require 'config.php';
$message = "";
if(isset($_POST["submit"])){
    $usernameemail = $_POST["usernameemail"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM accounts WHERE username = '$usernameemail' OR email = '$usernameemail'");
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0){
        if (password_verify($password, $row["password"])){
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header("Location: index.php");
        }
        else{
            $message = "Wrong password";
        }
    }
    else{
        $message = "User not registered";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>
        <?php if ($message): ?>
            <div class="mb-4 p-4 text-white bg-red-500 rounded-md">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form action="" method="post" autocomplete="off" class="space-y-4">
            <div>
                <label for="usernameemail" class="block text-sm font-medium text-gray-700">Username or Email</label>
                <input type="text" name="usernameemail" id="usernameemail" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <button type="submit" name="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Login</button>
            </div>
        </form>
        <div class="mt-6 text-center">
            <a href="registration.php" class="text-indigo-600 hover:text-indigo-500">Registration</a>
        </div>
    </div>
</body>

</html>