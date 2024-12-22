
<link rel="stylesheet" href="<?= base_url('assets/styles.css') ?>">
<div class="sidebar" id="sidebar">
    <h2>Mesajlar</h2>
    <ul>
<?php
    $uri = getenv('MONGODB_URI');
    $client = new MongoDB\Client($uri);
    $database = $client->selectDatabase("Kullanıcılar");
    $collection = $database->selectCollection('KULLANICILAR');

    $checkhowmanyuser = $collection->countDocuments();
    $users = $collection->find();

    echo $checkhowmanyuser . " Kişi Var. <br>";
    echo "Kime Mesaj Atmak İstediğinizi Seçiniz:";
    foreach($users as $user){
        echo "<li>" . $user['email']. "</li>";
    }
?>
    </ul>
</div>