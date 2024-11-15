<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

// Fetch car data from the database
$sql = "SELECT * FROM cars LIMIT 10";  // Limit to 10 cars
$stmt = $pdo->prepare($sql);
$stmt->execute();
$cars = $stmt->fetchAll();

// Check if a like was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['like'])) {
    $car_id = $_POST['car_id'];
    $user_id = $_SESSION['id'];

    // Insert the like into the likes table
    $sql = "INSERT INTO likes (user_id, car_id) VALUES (:user_id, :car_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':car_id', $car_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<p class='alert alert-success'>You liked a car!</p>";
    } else {
        echo "<p class='alert alert-danger'>Something went wrong. Please try again later.</p>";
    }
}

// Close connection
unset($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        font: 14px sans-serif;
        background-color: #121212; /* Dark background */
        color: #ffffff; /* White text */
    }
    .container {
        margin-top: 50px;
    }
    .car-card {
        background-color: #1e1e1e; /* Slightly darker background for cards */
        color: #ffffff; /* White text */
        border-radius: 8px;
        box-shadow: 0px 0px 15px rgba(0, 255, 255, 0.3); /* Cyan glow for modern futuristic look */
    }
    .car-card img {
        max-width: 100%;
        border-bottom: 2px solid #00ff99; /* Neon teal green border */
    }
    .btn-like {
        background-color: #00bfff; /* Neon blue button */
        border: none;
    }
    .btn-like:hover {
        background-color: #ff6347; /* Warm coral on hover */
    }
    .navbar {
        background-color: #333; /* Dark background for navbar */
    }
    .navbar a {
        color: #ffffff; /* White links */
    }
    .navbar a:hover {
        color: #00bfff; /* Neon blue on hover */
    }
</style>

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="dashboard.php">Dashboard</a>
        <div class="ml-auto">
        <a href="join.php" class="btn btn-info">Join Example</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </nav>

    <div class="container">
        <h2 class="text-center mt-4">Welcome to the Car Dashboard</h2>

        <!-- Car containers -->
        <div class="row mt-5">
            <?php foreach ($cars as $car): ?>
                <div class="col-md-4 mb-4">
                    <div class="card car-card">
                        <img src="<?php echo htmlspecialchars($car['image_url']); ?>" alt="Car Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($car['name']); ?></h5>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">
                                <button type="submit" name="like" class="btn btn-like btn-block">Like</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
