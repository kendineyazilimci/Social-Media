<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üyelik</title>
    <link rel="stylesheet" href="assets/login-uyelik-exit.css">
</head>
<body class="homecontent" id="homecontent">
    <div class="uyelikdiv">
        <form action="" method="post" id="uyelikForm" class="uyelikform">
            <h2>Hoşgeldiniz. Lütfen Üyelik Oluşturunuz.</h2>
            <div class="form-row">
            <h3>İsim:</h3>
            <input type="text" name="name" class="name" required>
            <h3>Soyisim:</h3>
            <input type="text" name="surname" class="surname" required>
            </div>
            <br>
            <div class="form-row">
            <h3>Tel:</h3>
            <input type="number" name="tel" class="tel" required>
            <h3>Yaş:</h3>
            <input type="number" name="age" class="age" required>
            </div>
            <br>
            <div class="form-row">
            <h3>Email:</h3>
            <input type="email" name="email" class="email" required>
            <h3>Şifre:</h3>
            <input type="password" name="sifre" class="sifre" required>
            <br>
            </div>
            <button type="submit" name="uyelikbuton" class="uyelikbuton">Kayıt Ol</button>
        </form>
    </div>
</body>
</html>