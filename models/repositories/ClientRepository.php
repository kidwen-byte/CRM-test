<?php

namespace app\models\repositories;

use app\models\entities\Client;
use app\models\Repository;

class ClientRepository extends Repository
{
    protected function getEntityClass() {
        return Client::class;
    }

    public function getTableName()
    {
        return 'clients';
    }
}
