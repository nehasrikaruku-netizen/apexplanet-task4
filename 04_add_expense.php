<?php

include("01_db.php");

session_start();

// Check Login

if(!isset($_SESSION['username']))
{
    header("Location: 02_login.php");
    exit();
}

if(isset($_POST['submit']))
{
    $title = trim(mysqli_real_escape_string($conn, $_POST['title']));
    $amount = trim(mysqli_real_escape_string($conn, $_POST['amount']));
    $category = trim(mysqli_real_escape_string($conn, $_POST['category']));
    $payment = trim(mysqli_real_escape_string($conn, $_POST['payment']));
    $expense_date = trim(mysqli_real_escape_string($conn, $_POST['expense_date']));
    $description = trim(mysqli_real_escape_string($conn, $_POST['description']));

    // Validation

    if(empty($title) || empty($amount) || empty($category) || empty($payment) || empty($expense_date))
    {
        echo "<script>alert('Please fill all required fields');</script>";
    }

    elseif(!is_numeric($amount))
    {
        echo "<script>alert('Amount must be a valid number');</script>";
    }

    elseif($amount <= 0)
    {
        echo "<script>alert('Amount must be greater than 0');</script>";
    }

    else
    {
        // CHECK EXPENSE LIMIT

        $username = $_SESSION['username'];

        $user_query = "SELECT expense_limit FROM users
                       WHERE username='$username'";

        $user_result = mysqli_query($conn, $user_query);

        $user = mysqli_fetch_assoc($user_result);

        $expense_limit = $user['expense_limit'];

        $total_query = "SELECT SUM(amount) AS total_expense
                        FROM expenses";

        $total_result = mysqli_query($conn, $total_query);

        $total = mysqli_fetch_assoc($total_result);

        $current_expense = $total['total_expense'];

        $new_total = $current_expense + $amount;

    
         if($expense_limit > 0 && $new_total > $expense_limit)
{
    echo "<script>alert('Expense Limit Exceeded! Cannot Add Expense');</script>";
}
else
{
        // INSERT EXPENSE

        $stmt = mysqli_prepare($conn, "INSERT INTO expenses
        (title, amount, category, payment_method, expense_date, description)
        VALUES (?, ?, ?, ?, ?, ?)");

        mysqli_stmt_bind_param(
            $stmt,
            "sdssss",
            $title,
            $amount,
            $category,
            $payment,
            $expense_date,
            $description
        );

        if(mysqli_stmt_execute($stmt))
        {
            echo "<script>alert('Expense Added Successfully');</script>";
            echo "<script>window.location.href='05_view_expense.php';</script>";
        } 

        else
        {
            echo "<script>alert('Error Adding Expense');</script>";
        }
}
    }
}



?>

<!DOCTYPE html>
<html>

<head>

<title>Add Expense - SpendWise</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{

    min-height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;

    background:
    linear-gradient(rgba(15,23,42,0.85),
    rgba(16,185,129,0.6)),

    url('https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?q=80&w=1470&auto=format&fit=crop');

    background-size:cover;
    background-position:center;

    padding:40px;
}

.container{

    width:450px;

    background:rgba(255,255,255,0.15);

    backdrop-filter:blur(12px);

    border-radius:20px;

    padding:35px;

    box-shadow:0 8px 32px rgba(0,0,0,0.2);

    border:1px solid rgba(255,255,255,0.2);
}

h2{

    text-align:center;
    color:white;
    margin-bottom:10px;
    font-size:30px;
}

p{

    text-align:center;
    color:#e5e7eb;
    margin-bottom:25px;
}

input,
select,
textarea{

    width:100%;

    padding:14px;
    margin-bottom:18px;

    border:none;
    border-radius:12px;

    background:rgba(255,255,255,0.2);

    color:white;
    font-size:15px;
}

input::placeholder,
textarea::placeholder{
    color:#f3f4f6;
}

select option{
    color:black;
}

input:focus,
textarea:focus,
select:focus{

    outline:none;
    background:rgba(255,255,255,0.3);
}

textarea{
    height:100px;
    resize:none;
}

button{

    width:100%;
    padding:14px;

    background:#10b981;

    border:none;
    border-radius:12px;

    color:white;
    font-size:16px;
    font-weight:bold;

    cursor:pointer;

    transition:0.3s;
}

button:hover{

    background:#059669;
    transform:translateY(-2px);
}

.nav-links{

    text-align:center;
    margin-top:20px;
}

.nav-links a{

    color:white;
    text-decoration:none;
    margin:0 10px;
    font-weight:bold;
}

.nav-links a:hover{
    text-decoration:underline;
}

</style>

</head>

<body>

<div class="container">

<h2>Add Expense</h2>

<p>Track your spending smartly</p>

<form method="POST">

<input type="text"
       name="title"
       placeholder="Expense Title"
       required>

<input type="number"
       name="amount"
       placeholder="Enter Amount"
       required>

<select name="category" required>

<option value="">Select Category</option>

<option>Food</option>
<option>Travel</option>
<option>Shopping</option>
<option>Bills</option>
<option>Education</option>
<option>Entertainment</option>

</select>

<select name="payment" required>

<option value="">Payment Method</option>

<option>Cash</option>
<option>UPI</option>
<option>Card</option>

</select>

<input type="date"
       name="expense_date"
       required>

<textarea name="description"
          placeholder="Expense Description"></textarea>

<button type="submit" name="submit">
    Add Expense
</button>

</form>
<div class="nav-links">

<a href="/expense_tracker/task4/05_view_expense.php">
View Expenses
</a>

<a href="/expense_tracker/task4/09_dashboard.php">
Dashboard
</a>

</div>

</div>

</body>

</html>