<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * @var ProjectRepository
     */

   private $repository;
    /**
     * @var ProjectService
     */
    private $service;

    public function __construct(ProjectRepository $repository, ProjectService $service)
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
       return $this->repository->with(['client', 'owner'])->all();
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

    public function destroy($id )
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

    public function addMember($project_id, $member_id)
    {
        try {
            return $this->service->addMember($project_id, $member_id);
        } catch (ModelNotFoundException $e) {
            return $this->erroMsgm('Projeto não encontrado.');
        } catch (QueryException $e) {
            return $this->erroMsgm('Membro não encontrado.');
        } catch (\Exception $e) {
            return $this->erroMsgm('Ocorreu um erro ao inserir o membro.');
        }
    }

    public function removeMember($project_id, $member_id)
    {
        try {
            return $this->service->removeMember($project_id, $member_id);
        } catch (ModelNotFoundException $e) {
            return $this->erroMsgm('Projeto não encontrado.');
        } catch (QueryException $e) {
            return $this->erroMsgm('Membro não encontrado.');
        } catch (\Exception $e) {
            return $this->erroMsgm('Ocorreu um erro ao remover o membro.');
        }

    }
    }