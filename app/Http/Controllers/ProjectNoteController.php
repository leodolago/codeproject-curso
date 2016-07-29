<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Services\ProjectNoteService;
use Illuminate\Http\Request;

class ProjectNoteController extends Controller
{
    /**
     * @var ProjectNoteRepositoryRepository
     */

   private $repository;
    /**
     * @var ProjectNoteService
     */
    private $service;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service)
    {
            $this->repository = $repository;
            $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
       return $this->repository->findWhere(['project_id' => $id]);
      //  return $this->repository->all();
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
    public function show($id, $noteId)
    {
        return $this->repository->findWhere(['project_id' => $id,'id' => $noteId]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id, $noteId)

    {
        return $this->service->update($request->all(), $noteId);
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

    public function destroy($id, $noteId )
    {
        return $this->service->delete($noteId);

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