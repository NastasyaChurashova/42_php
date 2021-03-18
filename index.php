<link rel="stylesheet" href="index.css">

<?php

$amount = array_key_exists('amount', $_GET) ? $_GET['amount'] : 42;
$amount = 42;

if (array_key_exists('amount', $_GET)) {
    if ((int)($_GET['amount']) ==($_GET['amount']) && $_GET['amount']>0){
        $amount= $_GET['amount'];
    }
    $amount = $_GET['amount'];
    $content = json_encode(['amount' => $amount]);

    file_put_contents('db.json', $content);
} else {
    if (file_exists('db.json')) {
        $db = json_decode(file_get_contents('db.json'), true);
        $amount = $db['amount']; // берём не весь объект,а с ключом amount
    } 
}
?>
<form action="" method="get">
    <input type="number" name="amount" value="<?= $amount; ?>">
    <button type="submit">submit</button>
</form>


<div class="container">
    <?php


 
for ($i = 1; $i <= $amount; $i++) {
    $classes= ($i % 2 == 0) ? "class='new_colour" : '';
        echo "<a $classes href='?id=$i'>$i </a>";
        }
// $links = json_encode('db.json', JSON_PRETTY_PRINT);
//file_put_contents($id, $links);

if (array_key_exists('id', $_GET)){
    if ($_GET['id'] % 3 === 0){
        echo $_GET['id'];
    }
}
    ?>
</div>