<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <h2>🌸 Login ke Sistem 🌸</h2>
        <form action="login.php" method="POST">
            <div class="input-group">
                <label for="usernamesss">Username</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" id="usernamesss" name="usernamesss" required placeholder="Masukkan username">
                </div>
            </div>
            <div class="input-group">
                <label for="passwordsss">Password</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="passwordsss" name="passwordsss" required placeholder="Masukkan password">
                </div>
            </div>
            <button type="submit">Masuk</button>
        </form>
    </div>
</body>
</html>
