<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Query User</title>
</head>
<body>
    <form action="<?= base_url('admin/crud/queryuser') ?>" method="post">
        <h2>Sorgulanacak Kullanıcı Bilgileri</h2>

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

        <input type="submit" name="queryUserSubmit" value="Sorgula"><br><br>
    </form>

    <?php if (isset($users) && count($users) > 0): ?>
        <h2>Eşleşen Kullanıcılar</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>İsim</th>
                <th>Soyisim</th>
                <th>Telefon</th>
                <th>Yaş</th>
                <th>Email</th>
                <th>Şifre</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['_id'] ?></td>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['surname'] ?></td>
                    <td><?= $user['tel'] ?></td>
                    <td><?= $user['age'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['sifre'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif (isset($error)): ?>
        <p>Hata: <?= $error ?></p>
    <?php elseif (isset($users)): ?>
        <p>Eşleşen kullanıcı bulunamadı.</p>
    <?php endif; ?>
</body>
</html>