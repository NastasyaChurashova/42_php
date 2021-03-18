<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('DataManager.php'); //файл только 1 раз загрузится
include_once('FormManager.php'); //класс включили
$manager = new FormManager(); // __метод construct вызывается, прверяет существует ли файл, если да - то записывается содержимое файла, конвертирует в переменную, записывает в db
?>

<!--"?action=add" адрес куда отправляется запрос на сервер, видно в Header-->
<h2>Add</h2>
<form action="?action=add" method="post"> 
    <input type="text" name="username" placeholder="username">
    <input type="text" name="message" placeholder="message">
    <button type="submit">submit message</button>
</form>

<h2>Update</h2>
<form action="?action=update" method="post">
    <select name="id">
        <?php 
            foreach ($manager->getAll() as $key=> $value) {//присваевает ключ-значение, foreach все элементы массива перебирает]
                $username = $value['username'];// что переменные содержат- будет менять
                echo "<option value='$key'> $key : $username </option>";
            }
        ?>
    </select>
    <input type="text" name="username" placeholder="username">
    <input type="text" name="message" placeholder="message">
    <button type="submit">update message</button>
</form>

<?php
/*NEW PART START*/

//add entry

if (array_key_exists('action', $_REQUEST)){
    if ($_REQUEST['action'] == 'add'){
         $manager->add($_REQUEST); //добавь какой-то текст
    }
    elseif ($_REQUEST['action'] =='update'){
        $manager->updateMessages($_REQUEST);//update text
    }
}

//delete entry

if (array_key_exists('delete', $_REQUEST)){//знать какой элемент удалить, 3 значения нужны - какую запись изменить
    $manager->delete($_REQUEST['delete']);
}

//display entry

if ($manager->getAll() !== []) { //вызов опред.метода - если непустой массив вызвать getAll
    echo "<h2>VIEW</h2>"; 
    echo "<ul>";
     foreach ($manager->getAll() as $key => $value) {//присваевает ключ-значение
        $username = $value['username'];
        $message = $value['message'];
        echo "<li>$username: $message <a href='?delete=$key'>[X]</a></li>";
     }
      //получи всё
    echo "</ul>";
} else {
    echo 'no data yet';
}
