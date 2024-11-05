<?php 
require 'config.php';
$message = "";
if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $duplicate = mysqli_query($conn, "SELECT * FROM accounts WHERE username = '$username' OR email = '$email'");
    if(mysqli_num_rows($duplicate) > 0){
        $message = "Username or Email has already been taken";
    } 
    else{
        if($password == $confirmpassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO accounts VALUES('','$name','$username','$email','$hash')";
            mysqli_query($conn,$query);
            $message = "Registration successful";
            $result = mysqli_query($conn, "SELECT * FROM accounts WHERE username = '$username' OR email = '$email'");
            $row = mysqli_fetch_assoc($result);
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header("Location: index.php");
        }
        else {
            $message = "Password does not match";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Register</h1>
        <?php if ($message): ?>
            <div class="mb-4 p-4 text-white bg-red-500 rounded-md">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form action="" method="post" autocomplete="off" class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" id="username" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="confirmpassword" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="confirmpassword" id="confirmpassword" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <button type="submit" name="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Register</button>
            </div>
        </form>
        <div class="mt-6 text-center">
            <a href="login.php" class="text-indigo-600 hover:text-indigo-500">Login</a>
        </div>
    </div>
</body>

</html>