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
        <form action="deleteuser">
            <input type="submit" class="deleteuserbuton" value="Delete User">
        </form>
        <form action="insertuser">
            <input type="submit" class="insertuserbuton" value="Insert User">
        </form>
        <form action="queryuser">    
            <input type="submit" class="queryuserbuton" value="Query User">
        </form>
        <form action="updateuser">
            <input type="submit" class="updateuserbuton" value="Update User">
        </form>
    </div>
</body>
</html>