<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
</head>
<body>
    <form action="<?= base_url('admin/crud/manageuser') ?>" method="post">
        <h2>Silinecek Kullanıcı Bilgileri</h2>

        <p>İsim:</p>
        <input type="text" id="name" name="name">

        <p>Soyisim:</p>
        <input type="text" id="surname" name="surname">
        
        <p>Telefon Numarası:</p>
        <input type="text" id="tel" name="tel"><br>
        
        <p>Yaş:</p>
        <input type="text" id="age" name="age"><br>
        
        <p>E-mail:</p>
        <input type="text" id="email" name="email"><br><br>
        
        <p>Şifre:</p>
        <input type="text" id="sifre" name="sifre"><br><br>

        <input type="hidden" id="action" name="action" value="list">
        <input type="submit" name="listUsersSubmit" value="Listele" onclick="document.getElementById('action').value='list'"><br><br>
        <input type="submit" name="deleteUserSubmit" value="Sil" onclick="document.getElementById('action').value='delete'"><br><br>
    </form>
</body>
</html>