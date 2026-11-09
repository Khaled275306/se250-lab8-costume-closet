
<?php
require 'db.php';

if (isset($_GET["id"]) && filter_var($_GET["id"], FILTER_VALIDATE_INT)) {
    $id = (int) $_GET["id"];

    $stmt = mysqli_prepare($conn,
        "UPDATE loans SET returned = 1 WHERE id = ?");

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

header("Location: list.php");
exit;
?>
