<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url('assets/yonlendirme.css') ?>">
</head>
<body>
    <div class="adminyonlendirmediv">
        <p class="hangiislemiyapmakistersinizp">Hangi İşlemi Yapmak İstersiniz?</p>
        <form action="admin/crud" method="post">
            <input type="submit" class="crudislemleributon" name="crudislemleributon" value="CRUD İşlemleri">
        </form>
        <form action="admin/site" method="post">
            <input type="submit" class="siteislemleributon" name="siteislemleributon" value="Site İşlemleri">
        </form>
    </div>
</body>
</html>