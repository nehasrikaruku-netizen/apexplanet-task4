<?php

include("01_db.php");

session_start();

if(!isset($_SESSION['username']))
{
    header("Location: /expense_tracker/task4/03_login.php");
    exit();
}

$id = $_GET['id'];

$stmt = mysqli_prepare($conn, "DELETE FROM expenses WHERE id=?");

mysqli_stmt_bind_param($stmt, "i", $id);

if(mysqli_stmt_execute($stmt))
{
    echo "<script>alert('Expense Deleted Successfully');</script>";
    echo "<script>window.location.href='05_view_expense.php';</script>";
}
else
{
    echo "<script>alert('Error Deleting Expense');</script>";
    echo "<script>window.location.href='05_view_expense.php';</script>";
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Delete Expense</title>

<style>

body{

    font-family:Arial, sans-serif;

    background:#0f172a;

    color:white;

    display:flex;

    justify-content:center;

    align-items:center;

    height:100vh;
}

.container{

    text-align:center;

    background:#1e293b;

    padding:40px;

    border-radius:15px;

    box-shadow:0 4px 20px rgba(0,0,0,0.3);
}

a{

    color:#10b981;

    text-decoration:none;

    font-weight:bold;
}

</style>

</head>

<body>

<div class="container">

<h2>Deleting Expense...</h2>

<p>Please wait...</p>

<a href="/expense_tracker/task4/05_view_expense.php">
Back to Expenses
</a>

</div>

</body>

</html>