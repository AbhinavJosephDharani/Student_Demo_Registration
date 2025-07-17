<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hello Vercel PHP</title>
</head>
<body>
    <h1>Hello from Vercel PHP!</h1>
    <p>Current time: <?php echo date('Y-m-d H:i:s'); ?></p>
    <p>PHP version: <?php echo phpversion(); ?></p>
    <p>Server: <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown'; ?></p>
</body>
</html> 