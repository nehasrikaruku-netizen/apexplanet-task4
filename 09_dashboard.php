<?php

include("01_db.php");

session_start();

if(!isset($_SESSION['username']))
{
    header("Location: /expense_tracker/task4/03_login.php");
    exit();
}

$username = $_SESSION['username'];

/* SET EXPENSE LIMIT */

if(isset($_POST['set_limit']))
{
    $limit = $_POST['expense_limit'];

    $updateLimit = "UPDATE users
                    SET expense_limit='$limit'
                    WHERE username='$username'";

    mysqli_query($conn, $updateLimit);

    echo "<script>alert('Expense Limit Updated Successfully');</script>";
}

/* FETCH USER LIMIT */

$userQuery = "SELECT expense_limit FROM users
              WHERE username='$username'";

$userResult = mysqli_query($conn, $userQuery);

$userRow = mysqli_fetch_assoc($userResult);

$expenseLimit = $userRow['expense_limit'];

/* TOTAL EXPENSE */

$totalQuery = "SELECT SUM(amount) AS total FROM expenses";

$totalResult = mysqli_query($conn, $totalQuery);

$totalRow = mysqli_fetch_assoc($totalResult);

$totalExpense = $totalRow['total'];

/* TOTAL COUNT */

$countQuery = "SELECT COUNT(*) AS totalExpenses FROM expenses";

$countResult = mysqli_query($conn, $countQuery);

$countRow = mysqli_fetch_assoc($countResult);

$totalCount = $countRow['totalExpenses'];

$search = "";


if(isset($_GET['search']))
{
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    $searchQuery = "SELECT * FROM expenses
                    WHERE title LIKE '%$search%'
                    OR category LIKE '%$search%'
                    OR payment_method LIKE '%$search%'
                    ORDER BY id DESC";

    $searchResult = mysqli_query($conn, $searchQuery);
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Dashboard - SpendWise</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{

    min-height:100vh;

    background:
    linear-gradient(rgba(15,23,42,0.88),
    rgba(16,185,129,0.55)),

    url('https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=1470&auto=format&fit=crop');

    background-size:cover;
    background-position:center;

    padding:40px;
}

.container{

    width:95%;
    max-width:1200px;

    margin:auto;
}

.header{

    text-align:center;

    margin-bottom:40px;
}

.header h1{

    color:white;

    font-size:42px;

    margin-bottom:10px;
}

.header p{

    color:#d1fae5;

    font-size:18px;
}

.limit-box{

    background:rgba(255,255,255,0.12);

    backdrop-filter:blur(10px);

    border-radius:20px;

    padding:25px;

    margin-bottom:30px;

    text-align:center;

    border:1px solid rgba(255,255,255,0.2);
}

.limit-box h2{

    color:white;

    margin-bottom:15px;
}

.limit-box input{

    padding:12px;

    width:250px;

    border:none;

    border-radius:10px;

    margin-right:10px;
}

.limit-box button{

    padding:12px 18px;

    border:none;

    border-radius:10px;

    background:#10b981;

    color:white;

    font-weight:bold;

    cursor:pointer;
}

.limit-box button:hover{

    background:#059669;
}

.current-limit{

    color:#d1fae5;

    margin-top:15px;

    font-size:18px;
}

.cards{

    display:grid;

    grid-template-columns:repeat(auto-fit, minmax(250px,1fr));

    gap:25px;

    margin-bottom:40px;
}

.card{

    background:rgba(255,255,255,0.12);

    backdrop-filter:blur(10px);

    border-radius:20px;

    padding:30px;

    text-align:center;

    box-shadow:0 8px 32px rgba(0,0,0,0.2);

    border:1px solid rgba(255,255,255,0.2);

    transition:0.3s;
}

.card:hover{

    transform:translateY(-5px);
}

.card h2{

    color:white;

    margin-bottom:15px;

    font-size:24px;
}

.card p{

    color:#d1fae5;

    font-size:28px;

    font-weight:bold;
}

.links{

    display:grid;

    grid-template-columns:repeat(auto-fit, minmax(220px,1fr));

    gap:20px;

    margin-top:30px;
}

.links a{

    background:#10b981;

    color:white;

    text-decoration:none;

    padding:18px;

    border-radius:15px;

    text-align:center;

    font-size:18px;

    font-weight:bold;

    transition:0.3s;

    box-shadow:0 4px 15px rgba(0,0,0,0.2);
}

.links a:hover{

    background:#059669;

    transform:translateY(-3px);
}

.search-box{

    text-align:center;

    margin-bottom:30px;
}

.search-box input{

    padding:12px;

    width:250px;

    border:none;

    border-radius:8px;
}

.search-box button{

    padding:12px 15px;

    border:none;

    border-radius:8px;

    background:#10b981;

    color:white;

    cursor:pointer;
}

.footer{

    text-align:center;

    margin-top:50px;

    color:white;

    font-size:15px;
}

</style>

</head>

<body>

<div class="container">

<div class="header">

<h1>SpendWise Dashboard</h1>

<p>Welcome, <?php echo $username; ?> 👋</p>

</div>

<!-- EXPENSE LIMIT -->

<div class="limit-box">

<h2>Set Expense Limit</h2>

<form method="POST">

<input type="number"
name="expense_limit"
placeholder="Enter Expense Limit"
required>

<button type="submit" name="set_limit">
Set Limit
</button>

</form>

<div class="current-limit">

Current Limit:
₹ <?php echo $expenseLimit ? $expenseLimit : 0; ?>

</div>

</div>

<!-- CARDS -->

<div class="cards">

<div class="card">

<h2>Total Expenses</h2>

<p><?php echo $totalCount; ?></p>

</div>

<div class="card">

<h2>Total Spending</h2>

<p>₹ <?php echo $totalExpense ? $totalExpense : 0; ?></p>

</div>

</div>

<!-- SEARCH -->

<div class="search-box">

<form method="GET">

<input type="text"
name="search"
placeholder="Search expense">

<button type="submit">
Search
</button>

</form>

</div>
<?php

if(isset($_GET['search']))
{

?>

<div style="
background:rgba(255,255,255,0.12);
padding:25px;
border-radius:20px;
margin-bottom:30px;
backdrop-filter:blur(10px);
">

<h2 style="color:white; margin-bottom:20px; text-align:center;">
Search Results
</h2>

<table width="100%" cellpadding="10" style="color:white; text-align:center;">

<tr>

<th>ID</th>
<th>Title</th>
<th>Amount</th>
<th>Category</th>
<th>Payment</th>

</tr>

<?php

while($row = mysqli_fetch_assoc($searchResult))
{

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['title']; ?></td>

<td>₹<?php echo $row['amount']; ?></td>

<td><?php echo $row['category']; ?></td>

<td><?php echo $row['payment_method']; ?></td>

</tr>

<?php

}

?>

</table>

</div>

<?php

}

?>

<!-- LINKS -->

<div class="links">

<a href="/expense_tracker/task4/04_add_expense.php">
Add Expense
</a>

<a href="/expense_tracker/task4/05_view_expense.php">
View Expenses
</a>

<a href="/expense_tracker/task4/08_logout.php">
Logout
</a>

</div>

<!-- FOOTER -->

<div class="footer">

<p>Smart Expense Tracker • SpendWise</p>

</div>

</div>

</body>

</html>