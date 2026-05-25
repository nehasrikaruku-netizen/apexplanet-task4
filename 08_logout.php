<?php

session_start();

session_unset();

session_destroy();

echo "<script>

alert('Logout Successful');

window.location.href='/expense_tracker/task4/03_login.php';

</script>";

?>

<!DOCTYPE html>
<html>

<head>

<title>Logout</title>

<style>

body{

    margin:0;

    padding:0;

    font-family:Arial, sans-serif;

    background:
    linear-gradient(rgba(15,23,42,0.9),
    rgba(16,185,129,0.6));

    height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

    color:white;
}

.container{

    text-align:center;

    background:rgba(255,255,255,0.1);

    padding:40px;

    border-radius:20px;

    backdrop-filter:blur(10px);

    box-shadow:0 8px 32px rgba(0,0,0,0.2);
}

h2{

    margin-bottom:15px;
}

p{

    color:#d1fae5;
}

</style>

</head>

<body>

<div class="container">

<h2>Logging Out...</h2>

<p>Please wait...</p>

</div>

</body>

</html>