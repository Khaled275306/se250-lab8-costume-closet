
<?php
require 'db.php';

$sql = "SELECT id, item, borrower, due_date, returned FROM loans";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Could not load loans.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Costume Closet - Loans</title>
</head>
<body>

<h1>Campus Costume Closet</h1>
<h2>All Loans</h2>

<a href="add.php">Add New Loan</a>
<br><br>

<?php if (mysqli_num_rows($result) == 0) { ?>

    <p>No loans yet. The closet is empty!</p>

<?php } else { ?>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Item</th>
        <th>Borrower</th>
        <th>Due Date</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $row["id"]; ?></td>

        <td><?php echo htmlspecialchars($row["item"]); ?></td>

        <td><?php echo htmlspecialchars($row["borrower"]); ?></td>

        <td><?php echo htmlspecialchars($row["due_date"] ?? ""); ?></td>

        <td>
            <?php
            if ($row["returned"] == 1) {
                echo "Returned";
            } else {
                echo "Still Out";
            }
            ?>
        </td>

        <td>
            <?php if ($row["returned"] == 0) { ?>
                <a href="mark_returned.php?id=<?php echo $row['id']; ?>">
                    Mark Returned
                </a>
            <?php } ?>

            <a href="delete.php?id=<?php echo $row['id']; ?>"
               onclick="return confirm('Delete this loan?');">
                Delete
            </a>
        </td>
    </tr>
    <?php } ?>
</table>

<?php } ?>

</body>
</html>
