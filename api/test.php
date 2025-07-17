<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Demo Registration - Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: white;
        }
        .card {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            margin: 2rem 0;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            color: #333;
        }
        .success {
            background: #d1fae5;
            color: #065f46;
            padding: 1rem;
            border-radius: 0.5rem;
            margin: 1rem 0;
        }
        .info {
            background: #dbeafe;
            color: #1e40af;
            padding: 1rem;
            border-radius: 0.5rem;
            margin: 1rem 0;
        }
        .btn {
            background: #4f46e5;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            text-decoration: none;
            display: inline-block;
            margin: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>🎓 Student Demo Registration System</h1>
        
        <div class="success">
            <h2>✅ Vercel Deployment Successful!</h2>
            <p>Your PHP application is now running on Vercel!</p>
        </div>
        
        <div class="info">
            <h3>📊 System Information:</h3>
            <ul>
                <li><strong>PHP Version:</strong> <?php echo phpversion(); ?></li>
                <li><strong>Server:</strong> <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'Vercel'; ?></li>
                <li><strong>Timestamp:</strong> <?php echo date('Y-m-d H:i:s'); ?></li>
                <li><strong>Extensions:</strong> 
                    <?php 
                    $extensions = ['pdo', 'pdo_mysql', 'json'];
                    $loaded = array_filter($extensions, 'extension_loaded');
                    echo implode(', ', $loaded);
                    ?>
                </li>
            </ul>
        </div>
        
        <div class="info">
            <h3>🔧 Environment Variables Status:</h3>
            <ul>
                <li><strong>DB_HOST:</strong> <?php echo $_ENV['DB_HOST'] ?? 'Not set'; ?></li>
                <li><strong>DB_NAME:</strong> <?php echo $_ENV['DB_NAME'] ?? 'Not set'; ?></li>
                <li><strong>DB_USER:</strong> <?php echo $_ENV['DB_USER'] ?? 'Not set'; ?></li>
                <li><strong>DB_PASS:</strong> <?php echo $_ENV['DB_PASS'] ? 'Set' : 'Not set'; ?></li>
            </ul>
        </div>
        
        <div class="info">
            <h3>📁 File Structure Test:</h3>
            <ul>
                <li><strong>Current Directory:</strong> <?php echo __DIR__; ?></li>
                <li><strong>Parent Directory:</strong> <?php echo dirname(__DIR__); ?></li>
                <li><strong>Includes Directory:</strong> <?php echo file_exists('../includes/functions.php') ? 'Exists' : 'Missing'; ?></li>
                <li><strong>Config Directory:</strong> <?php echo file_exists('../config/database.php') ? 'Exists' : 'Missing'; ?></li>
            </ul>
        </div>
        
        <div style="margin-top: 2rem;">
            <a href="index.php" class="btn">📝 Registration Form</a>
            <a href="admin.php" class="btn">👥 Admin Panel</a>
            <a href="health.php" class="btn">❤️ Health Check</a>
        </div>
        
        <div style="margin-top: 2rem; padding: 1rem; background: #f3f4f6; border-radius: 0.5rem;">
            <h3>🚀 Next Steps:</h3>
            <ol>
                <li>Set up a database (PlanetScale recommended)</li>
                <li>Add environment variables in Vercel dashboard</li>
                <li>Test the full application functionality</li>
                <li>Configure custom domain (optional)</li>
            </ol>
        </div>
    </div>
</body>
</html> 