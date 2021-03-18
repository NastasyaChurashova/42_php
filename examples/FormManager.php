<?php  

class FormManager extends DataManager
{
    public function add($req) {//существуют ли в массиве те значения, что мы ожидаем
/* $req = ['username' =>, 'message']*/
    if (
        array_key_exists('username', $req) &&
        array_key_exists('message', $req) &&
        is_string($req['username']) &&
        is_string($req['message']) &&
        $req['username'] !== '' &&
        $req['message'] !== ''
        ){
            echo "test add method";
            parent::add([
               'username' => $req['username'],
               'message' => $req['message']
            ]);
        }
    }

    public function updateMessages($req) {//существуют ли в массиве те значения, что мы ожидаем
        /* $req = ['username' =>, 'message']
        $req содержит тот же массив, что в index file*/

        if (
            array_key_exists('username', $req) &&
            array_key_exists('message', $req) &&
            array_key_exists('id', $req) &&
            is_string($req['username']) &&
            is_string($req['message']) &&
            is_string($req['id']) &&
            $req['username'] !=='' &&
            $req['message'] !=='' &&
            $req['id'] !==''
        ){
            echo "test update method";
            $this->update(//function, гдеподаётся значение id
                $req['id'],
                [ 
                'username' => $req['username'],
                'message' => $req['message']
                ]
            );
        }
    }
}



