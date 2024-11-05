<?php
require 'config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$loggedIn = !empty($_SESSION["id"]);
if ($loggedIn) {
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM accounts WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if (isset($_POST["update_email"])) {
        $new_email = $_POST["email"];
        $stmt = $conn->prepare("UPDATE accounts SET email = ? WHERE id = ?");
        $stmt->bind_param("si", $new_email, $id);
        if ($stmt->execute()) {
            $message = "Email updated successfully";
            $row["email"] = $new_email;
        } else {
            $message = "Failed to update email";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $loggedIn ? 'Dashboard' : 'Welcome'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-indigo-600 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-white text-2xl font-bold"><?php echo $loggedIn ? 'Dashboard' : 'Welcome'; ?></h1>
            <?php if ($loggedIn): ?>
                <a href="logout.php" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600">Logout</a>
            <?php else: ?>
                <a href="login.php" class="bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600">Login</a>
            <?php endif; ?>
        </div>
    </nav>
    <div class="container mx-auto p-8">
        <?php if ($loggedIn): ?>
            <div class="bg-white p-8 rounded-lg shadow-lg mb-6">
                <h2 class="text-2xl font-bold mb-4">Welcome, <?php echo $row["name"]; ?></h2>
                <p class="text-gray-700">This is your dashboard. Here you can find an overview of your activities and manage your account.</p>
                <?php if (isset($message)): ?>
                    <div class="mb-4 p-4 text-white bg-green-500 rounded-md">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
                <form action="" method="post" class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo $row["email"]; ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <button type="submit" name="update_email" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update Email</button>
                    </div>
                </form>
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
        <?php else: ?>
            <div class="bg-white p-8 rounded-lg shadow-lg mb-6 text-center">
                <h2 class="text-3xl font-bold mb-4">Welcome to Our App</h2>
                <p class="text-gray-700 mb-4">Join us to access exclusive features and manage your account.</p>
                <a href="registration.php" class="bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600">Get Started</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Feature 1</h3>
                    <p class="text-gray-700">Description of feature 1.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Feature 2</h3>
                    <p class="text-gray-700">Description of feature 2.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Feature 3</h3>
                    <p class="text-gray-700">Description of feature 3.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>