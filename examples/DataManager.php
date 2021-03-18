<?php
class DataManager
{
    private $file_name = 'example_db.json';
    private $db = [];

    public function __construct() {//вызывается когда указываем new DataManager()
        if (file_exists($this->file_name)) {
            $json_db = file_get_contents($this->file_name);
            $db = json_decode($json_db, true);//local variable inside function
            if (is_array($db)) {
                $this->db = $db;// получаем из объекта переменную
            }
        }
    }

    protected function save() {// сохранение в json format
        $content = json_encode($this->db, JSON_PRETTY_PRINT);
        file_put_contents($this->file_name, $content);
    }

    public function add($value) {// вызов save()
        $this->db[] = $value;
        $this->save();
    }

    public function delete($id) {// вызов save()
        if (array_key_exists($id, $this->db)){//если есть db
            unset($this->db[$id]);// удалить значение с ключом id
            $this->save();
        }
    }

    public function update($id, $new_value){// $new_value - массив
        if (array_key_exists($id, $this->db)) //если есть id - будет изменен
        {
            $this->db[$id] = $new_value;
            $this->save();
        }
    }

    public function getAll() {
        return $this->db;
    }
}