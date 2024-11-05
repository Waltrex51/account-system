<?php
require 'config.php';
if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM accounts WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
}
else{
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-indigo-600 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-white text-2xl font-bold">Dashboard</h1>
            <a href="logout.php" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600">Logout</a>
        </div>
    </nav>
    <div class="container mx-auto p-8">
        <div class="bg-white p-8 rounded-lg shadow-lg mb-6">
            <h2 class="text-2xl font-bold mb-4">Welcome, <?php echo $row["name"]; ?></h2>
            <p class="text-gray-700">This is your dashboard. Here you can find an overview of your activities and manage your account.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-bold mb-4">Section 1</h3>
                <p class="text-gray-700">Placeholder content for section 1.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-bold mb-4">Section 2</h3>
                <p class="text-gray-700">Placeholder content for section 2.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-bold mb-4">Section 3</h3>
                <p class="text-gray-700">Placeholder content for section 3.</p>
            </div>
        </div>
    </div>
</body>
</html>