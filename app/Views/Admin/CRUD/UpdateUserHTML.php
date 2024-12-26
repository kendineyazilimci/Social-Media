<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Güncelle</title>
</head>
<body>
    <h2>Kullanıcı Güncelle</h2>
    <form action="<?= base_url('admin/crud/updateuser') ?>" method="post">
        <p>İsim:</p>
        <input type="text" id="name" name="name" required>

        <p>Soyisim:</p>
        <input type="text" id="surname" name="surname" required>
        
        <p>Email:</p>
        <input type="email" id="email" name="email" required><br><br>

        <h3>Güncellenecek Bilgiler</h3>
        <p>Yeni İsim:</p>
        <input type="text" id="namee" name="namee">

        <p>Yeni Soyisim:</p>
        <input type="text" id="surnamee" name="surnamee">
        
        <p>Yeni Telefon Numarası:</p>
        <input type="number" id="tell" name="tell"><br>
        
        <p>Yeni Yaş:</p>
        <input type="number" id="agee" name="agee"><br>
        
        <p>Yeni E-mail:</p>
        <input type="email" id="emaill" name="emaill"><br><br>
        
        <p>Yeni Şifre:</p>
        <input type="password" id="sifree" name="sifree"><br><br>

        <input type="submit" value="Güncelle">
    </form>
</body>
</html>
