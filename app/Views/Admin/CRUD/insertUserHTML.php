<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İnsert User</title>
</head>
<body>
    <form action="<?= base_url('admin/crud/insertuser') ?>" method="post">
        <h2>Eklenecek Kullanıcı Bilgileri</h2>

        <p>İsim:</p>
        <input type="text" id="name" name="name">

        <p>Soyisim:</p>
        <input type="text" id="surname" name="surname">
        
        <p>Telefon Numarası:</p>
        <input type="number" id="tel" name="tel"><br>
        
        <p>Yaş:</p>
        <input type="number" id="age" name="age"><br>
        
        <p>E-mail:</p>
        <input type="text" id="email" name="email"><br>

        <p>Şifre:</p>
        <input type="text" id="sifre" name="sifre"><br><br>
        
        <input type="submit" name="insertUserSubmit" id="insertUserSubmit" value="Submit">
    </form>
</body>
</html>
