<?php

namespace app\controllers;

use app\engine\Request;
use app\models\entities\Clients;
use app\models\repositories\ClientRepository;

class ClientsController extends Controller
{
    public function actionIndex()
    {
        $clients = (new ClientRepository())->getAll(); //Получаем из БД все запись клиентов 
        echo $this->render('clients', [
            'clients' => $clients
        ]);
    }

    public function actionAdd()
    {
        $name = (new Request())->getParams()['name']; //Получаем данные из input name (getParams находится в engine/Request.php)
        $email = (new Request())->getParams()['email']; //Получаем данные из input email
        $tel = (new Request())->getParams()['tel']; //Получаем данные из input tel

        if (preg_match("/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/", $tel)) { //Валидация номера телефона
            $client = new Clients($name, $email, $tel); //Создаем хранилище
            $save = (new ClientRepository())->insert($client); //Делаем insert (insert находится в models/Repository.php)
            if ($save) {
                $response = 'Клиент успешно добавлен';
            } else {
                $response = 'Произошла ошибка. Клиент не добавлен';
            }
        } else {
            $response = 'Неверный формат телефона';
        }
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); //Возвращаем ответ на фронт
    }
    public function actionFilter()
    {
        $params = (new Request())->getParams()['params'];
        $clients = (new ClientRepository())->getAllWhere($params);
        echo json_encode($clients, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
