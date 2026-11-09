
<?php
require 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = trim($_POST["item"] ?? "");
    $borrower = trim($_POST["borrower"] ?? "");
    $due_date = $_POST["due_date"] ?? "";

    if ($item == "" || $borrower == "" || $due_date == "") {
        $error = "Please fill in all fields.";
    } else {
        $stmt = mysqli_prepare($conn,
            "INSERT INTO loans (item, borrower, due_date, returned)
             VALUES (?, ?, ?, 0)");

        mysqli_stmt_bind_param($stmt, "sss",
            $item, $borrower, $due_date);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: list.php");
            exit;
        } else {
            $error = "Could not save the loan.";
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Loan</title>
</head>
<body>
    <h1>Campus Costume Closet</h1>
    <h2>Add New Loan</h2>

    <p><?php echo htmlspecialchars($error); ?></p>

    <form method="POST">
        <label>Item:</label>
        <input type="text" name="item" required>
        <br><br>

        <label>Borrower:</label>
        <input type="text" name="borrower" required>
        <br><br>

        <label>Due Date:</label>
        <input type="date" name="due_date" required>
        <br><br>

        <button type="submit">Add Loan</button>
    </form>

    <br>
    <a href="list.php">View All Loans</a>
</body>
</html>
