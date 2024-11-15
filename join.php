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

// Initialize variable to hold the query results
$join_result = [];

// Handle join queries based on the user's selection
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check which join type was clicked
    if (isset($_POST['left_join'])) {
        // Perform LEFT JOIN
        $sql = "
            SELECT users.username, cars.name AS car_name
            FROM users
            LEFT JOIN likes ON users.id = likes.user_id
            LEFT JOIN cars ON cars.id = likes.car_id
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $join_result = $stmt->fetchAll();
    } elseif (isset($_POST['right_join'])) {
        // Perform RIGHT JOIN
        $sql = "
            SELECT users.username, cars.name AS car_name
            FROM users
            RIGHT JOIN likes ON users.id = likes.user_id
            RIGHT JOIN cars ON cars.id = likes.car_id
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $join_result = $stmt->fetchAll();
    } elseif (isset($_POST['cross_join'])) {
        // Perform CROSS JOIN
        $sql = "
            SELECT users.username, cars.name AS car_name
            FROM users
            CROSS JOIN cars
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $join_result = $stmt->fetchAll();
    }
}

// Close connection
unset($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SQL Joins</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
            background-color: #121212;
            color: #ffffff;
        }
        .container {
            margin-top: 50px;
        }
        .navbar {
            background-color: #333;
        }
        .navbar a {
            color: #fff;
        }
        .btn-join {
            margin-right: 10px;
        }
        .table-container {
            margin-top: 30px;
        }
        /* Styling for white background table */
        table {
            background-color: #ffffff;
            color: #000000;
            border-collapse: collapse;
        }
        th, td {
            text-align: center;
            padding: 12px;
        }
        th {
            background-color: #00bfff;
            color: #ffffff;
        }
        td {
            background-color: #f8f8f8;
        }
        .table-bordered {
            border: 1px solid #ddd;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #ddd;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="join.php">SQL Joins</a>
        <div class="ml-auto">
        <a href="dashboard.php" class="btn btn-info">dashboard</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </nav>

    <div class="container">
        <h2 class="text-center mt-4">SQL Joins Example</h2>

        <!-- Join buttons -->
        <div class="text-center mt-4">
            <form method="POST">
                <button type="submit" name="left_join" class="btn btn-primary btn-join">Left Join</button>
                <button type="submit" name="right_join" class="btn btn-secondary btn-join">Right Join</button>
                <button type="submit" name="cross_join" class="btn btn-success btn-join">Cross Join</button>
            </form>
        </div>

        <!-- Table container -->
        <div class="table-container">
            <?php if (!empty($join_result)): ?>
                <table class="table table-bordered table-striped mt-4">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Car Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($join_result as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['username']); ?></td>
                                <td><?php echo htmlspecialchars($row['car_name']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center text-warning">No data to display. Please select a join type.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
