<link rel="stylesheet" href="index.css">

<?php

include_once 'Controller.php';
$manager = new Controller();//создаём новый объект из класса Controller

$amount = array_key_exists('amount', $_GET) ? $_GET['amount'] : 42;
$amount = 42;

if (array_key_exists('amount', $_GET)) {
    if ((int)($_GET['amount']) ==($_GET['amount']) && $_GET['amount']>0){
        $amount= $_GET['amount'];
    }
    $amount = $_GET['amount'];
    $content = json_encode(['amount' => $amount, 'links' => []]);

    file_put_contents('db.json', $content);
} else {
    if (file_exists('db.json')) {
        $db = json_decode(file_get_contents('db.json'), true);//true - чтобы db был массивом, а не объектом
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

$new_value='';
$id='';

if (array_key_exists('id', $_GET)){
    if ($_GET['id'] % 3 == 0){
        echo $_GET['id'];
        // $new_value=$_GET['id'] +1;
        // $manager ->add($_GET['id'], $new_value);
        $manager ->increase($_GET['id']);
    }
}

for ($id = 1; $id <= $amount; $id++) {
    $classes= ($id % 2 === 0) ? "class='new_colour'" : '';
    if (array_key_exists($id, $manager->getAll())){
        $value = $manager->getAll()[$id];
    }
    else {
        $value= $id;
    }
    echo "<a $classes href='?id=$id'>$value </a>";
}


?>
</div>