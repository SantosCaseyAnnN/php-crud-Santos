<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Branch Directory System</title>

<style>
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background-image: url('https://images5.alphacoders.com/132/thumb-1920-1327658.jpeg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        margin: 0;
        padding: 0;
        color: #fff;
    }

    body::before {
        content: "";
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.55);
        z-index: 0;
    }

    .container {
        position: relative;
        z-index: 1;
        max-width: 400px;
        margin: 140px auto;
        background: rgba(255,255,255,0.1);
        border-radius: 16px;
        padding: 40px 30px;
        text-align: center;
        backdrop-filter: blur(8px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.4);
    }

    h1 {
        font-size: 28px;
        margin-bottom: 20px;
        color: #fff;
        text-shadow: 0 0 10px rgba(255,255,255,0.3);
    }

    .menu {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-top: 20px;
    }

    .menu a {
        text-decoration: none;
        padding: 15px 0;
        border-radius: 8px;
        font-weight: bold;
        font-size: 16px;
        color: white;
        background-color: #1e6fff; /* bright blue */
        transition: all 0.2s ease;
        display: block;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    }

    .menu a:hover {
        background-color: #12409cff;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.4);
    }

    footer {
        text-align: center;
        color: #aaa;
        margin-top: 60px;
        font-size: 14px;
    }
</style>
</head>
<body>

    <div class="container">
        <h1>Student Branch Directory System</h1>
        <p>Welcome! Use the options below to manage student records.</p>

        <div class="menu">
            <a href="create.php" class="add">Add Student</a>
            <a href="read.php" class="view">View Students</a>
            <a href="read.php" class="update">Update Student</a>
            <a href="read.php" class="delete">Delete Student</a>
        </div>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> Student Branch Directory System
    </footer>

</body>
</html>
