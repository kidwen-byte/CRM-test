<?php

namespace app\controllers;

use app\engine\Request;
use app\models\entities\Clients;
use app\models\repositories\ClientRepository;

class ClientsController extends Controller
{
    public function actionIndex()
    {
        $clients = (new ClientRepository())->getAll();
        echo $this->render('clients', [
            'clients' => $clients
        ]);
    }

    public function actionAdd()
    {
        $name = (new Request())->getParams()['name'];
        $email = (new Request())->getParams()['email'];
        $tel = (new Request())->getParams()['tel'];

        if (preg_match("/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/", $tel)) {
            $client = new Clients($name,  $email, $tel);
            $save = (new ClientRepository())->insert($client);
            if ($save) {
                $response = 'Клиент успешно добавлен';
            } else {
                $response = 'Произошла ошибка. Клиент не добавлен';
            }
        } else {
            $response = 'Неверный формат телефона';
        }
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    public function actionFilter()
    {
        $params = (new Request())->getParams()['params'];
        $clients = (new ClientRepository())->getAllWhere($params);
        echo json_encode($clients, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
