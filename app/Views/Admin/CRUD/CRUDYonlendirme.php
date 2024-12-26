<?php
namespace app\Views\Admin\CRUD;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url('assets/yonlendirme.css') ?>">
</head>
<body>
    <div class="CRUDyonlendirmediv">
        <p class="hangiislemiyapmakistersinizp">Hangi İşlemi Yapmak İstersiniz?</p>
        <form action="crud/deleteuser">
            <input type="submit" class="deleteuserbuton" value="Delete User">
        </form>
        <form action="crud/insertuser">
            <input type="submit" class="insertuserbuton" value="Insert User">
        </form>
        <form action="crud/queryuser">    
            <input type="submit" class="queryuserbuton" value="Query User">
        </form>
        <form action="crud/updateuser">
            <input type="submit" class="updateuserbuton" value="Update User">
        </form>
        <form action="crud/listele">
            <input type="submit" class="kullanıcılistelebuton" value="Kullanıcıları Listele">
        </form>
    </div>
</body>
</html>