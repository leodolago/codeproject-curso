<?php
/**
 * Created by PhpStorm.
 * User: leodolago
 * Date: 18/05/2016
 * Time: 15:19
 */

namespace CodeProject\Repositories;


use CodeProject\Entities\Client;
use Prettus\Repository\Eloquent\BaseRepository;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{

    public function model()
    {
        return Client::class;
    }
}