<?php
include 'config/db.php'; 

$popupType = '';
$popupMessage = '';
$redirect = false;


if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM students WHERE id = $id");

    if (mysqli_num_rows($result) > 0) {
        $student = mysqli_fetch_assoc($result);
    } else {
        die("⚠️ Student not found.");
    }
} else {
    die("⚠️ Invalid request. No student ID provided.");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm_delete'])) {
        
        $deletedName = $student['fullname'];

        $delete = "DELETE FROM students WHERE id = $id";
        if (mysqli_query($conn, $delete)) {
            $popupType = 'success';
            
            $popupMessage = '✅ ' . htmlspecialchars($deletedName) . ' has been deleted successfully!';
            $redirect = true;
        } else {
            $popupType = 'error';
            $popupMessage = '❌ Error deleting student: ' . mysqli_error($conn);
        }
    } else {
        
        header("Location: read.php");
        exit;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Delete Student</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-image: url('https://images5.alphacoders.com/132/thumb-1920-1327658.jpeg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        color: #fff;
        margin: 0;
        padding: 0;
    }
    body::before {
        content: "";
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.6);
        z-index: 0;
    }

    .container {
        position: relative;
        z-index: 1;
        max-width: 700px;
        margin: 80px auto;
        background: rgba(255, 0, 0, 0.12);
        border-radius: 12px;
        padding: 28px;
        box-shadow: 0 8px 24px rgba(255,0,0,0.24);
        text-align: center;
        backdrop-filter: blur(8px);
        border: 2px solid #ff6666;
        display: flex;
        gap: 20px;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
    }

    .info {
        max-width: 420px;
    }

    .info h2 {
        color: #ff7777;
        margin: 0 0 10px 0;
    }

    .info p {
        margin: 8px 0;
        font-size: 16px;
        color: #fff;
    }

    .warning {
        color: #ffd84d;
        font-weight: 700;
    }

    .sticker {
        width: 160px;
        height: auto;
        background: rgba(255,255,255,0.85);
        padding: 8px;
        border-radius: 10px;
    }

    form {
        width: 100%;
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 12px;
    }

    button {
        width: 160px;
        padding: 10px 12px;
        border: none;
        font-weight: 700;
        border-radius: 8px;
        cursor: pointer;
        font-size: 15px;
    }

    .confirm {
        background: #e74c3c;
        color: #fff;
    }
    .confirm:hover { background: #c0392b; }

    .cancel {
        background: #3498db;
        color: #fff;
    }
    .cancel:hover { background: #2980b9; }

    
    .popup {
        display: none; 
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.6);
        z-index: 999;
        display: flex;
        justify-content: center;
        align-items: center;
        animation: fadeIn .25s ease-in-out;
    }

    .popup-content {
        background: rgba(255,255,255,0.98);
        color: #000;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 8px 28px rgba(0,0,0,0.35);
        max-width: 360px;
        width: 100%;
        animation: popUp .28s ease;
    }

    .popup-content img {
        width: 140px;
        height: auto;
        margin-bottom: 10px;
    }

    .popup-content h3 {
        margin: 0;
        font-size: 18px;
    }

    @keyframes fadeIn { from {opacity:0} to {opacity:1} }
    @keyframes popUp { from {transform:scale(.92); opacity:0} to {transform:scale(1); opacity:1} }

    @media (max-width:720px){
        .container { padding: 20px; gap: 12px; }
        .sticker { width: 120px; }
        button { width: 130px; }
    }
</style>
</head>
<body>
    <div class="container">

        <div>
            <img class="sticker" src="https://s3.getstickerpack.com/storage/uploads/sticker-pack/genshin-impact-wanderer/sticker_2.png?843fd7058a1f79b65b13d715c6132bed" alt="warning sticker">
        </div>

        <div class="info">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete <strong><?php echo htmlspecialchars($student['fullname']); ?></strong>?</p>
            <p class="warning">This action <strong>cannot</strong> be undone!</p>

            <form method="POST" action="">
                <button type="submit" name="confirm_delete" class="confirm">Delete</button>
                <button type="submit" name="cancel" class="cancel">Cancel</button>
            </form>
        </div>
    </div>

    
    <div class="popup" id="popup" style="display:none;">
        <div class="popup-content" id="popup-content">
            <img id="popup-img" src="" alt="popup sticker">
            <h3 id="popup-text"></h3>
        </div>
    </div>

<script>
    
    const popupType = "<?php echo $popupType; ?>";       
    const popupMessage = "<?php echo addslashes($popupMessage); ?>";
    const redirect = <?php echo $redirect ? 'true' : 'false'; ?>;

    const popupEl = document.getElementById('popup');
    const popupImg = document.getElementById('popup-img');
    const popupText = document.getElementById('popup-text');

    
    window.addEventListener('load', () => {
        
        if (!popupType) {
            popupImg.src = "https://s3.getstickerpack.com/storage/uploads/sticker-pack/genshin-impact-wanderer/sticker_2.png?843fd7058a1f79b65b13d715c6132bed";
            popupText.innerText = "Warning! You are about to delete this student!";
            popupEl.style.display = 'flex';
            setTimeout(() => { popupEl.style.display = 'none'; }, 2800);
        }
    });

    
    if (popupType) {
        
        if (popupType === 'success') {
            popupImg.src = "https://s3.getstickerpack.com/storage/uploads/sticker-pack/genshin-impact-wanderer/sticker_1.png?843fd7058a1f79b65b13d715c6132bed";
        } else {
            
            popupImg.src = "https://s3.getstickerpack.com/storage/uploads/sticker-pack/genshin-impact-wanderer/sticker_2.png?843fd7058a1f79b65b13d715c6132bed";
        }

        popupText.innerText = popupMessage;
        popupEl.style.display = 'flex';

        
        setTimeout(() => {
            popupEl.style.display = 'none';
            if (redirect) {
                window.location.href = 'read.php';
            }
        }, 3000);
    }
</script>
</body>
</html>
