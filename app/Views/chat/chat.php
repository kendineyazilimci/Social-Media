<?php 

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="assets/chat.css">
</head>
<body class="chatcontent" id="chatcontent">
    <div class="chatscreen">
        <div class="chatarea">
            <form action="<?= base_url('chat/sendMessage') ?>" method="post">
                <input type="hidden" name="recipientEmail" value="<?= $userEmail ?>"> <!-- Use hidden input for recipient email -->
                <textarea name="message" placeholder="Mesajınızı yazın..." required></textarea>
                <button type="submit">Gönder</button>
            </form>
            <div id="messages">
                <?php if (isset($messages) && !empty($messages)): ?>
                    <?php foreach ($messages as $message): ?>
                        <p><strong><?= $message['gonderen'] ?>:</strong> <?= $message['icerik'] ?></p>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Henüz mesaj yok.</p>
                <?php endif; ?>
            </div>    
        </div>    
    </div>
    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const headerRight = document.getElementById('header-right');
        const footerRight = document.getElementById('footer-right');
        const homecontent = document.getElementById('homecontent');
        const toggleButton = document.querySelector('.toggle-btn');

        sidebar.classList.toggle('open');
        
        headerRight.classList.toggle('shifted');
        footerRight.classList.toggle('shifted');
        homecontent.classList.toggle('shifted');

        toggleButton.classList.toggle('open'); 
        toggleButton.textContent = toggleButton.classList.contains('open') ? '✖' : '☰';
    }
</script>
</body>
</html>