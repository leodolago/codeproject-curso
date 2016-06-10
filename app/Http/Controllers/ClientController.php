<?php

namespace CodeProject\Http\Controllers;


use CodeProject\Repositories\ClientRepository;
use CodeProject\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * @var ClientRepository
     */

   private $repository;
    /**
     * @var ClientService
     */
    private $service;

    public function __construct(ClientRepository $repository, ClientService $service)
    {
            $this->repository = $repository;
            $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return $this->repository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /** return Client::create($request->all()); */
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->service->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)

    {
        return $this->service->update($request->all(), $id);
       /**
        $client = $this->repository->find($id); //consulta o client pelo id

        $client->update($request->all(), $id); //atualiza os dados, e retorna um valor booleano

        return $client; //retorna os dados em JSON */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        return $this->service->delete($id);

      /**  $client = $this->repository->find($id);

        if (!$client) {
            return ('Client não encontrado');
        } else {
            $client->delete();
            return ('Client deletado');
        }
       */
    } 

}