<?php

namespace CodeProject\Http\Controllers;



use CodeProject\Repositories\ProjectMembersRepository;
use CodeProject\Services\ProjectMembersService;
use Illuminate\Http\Request;

class ProjectMembersController extends Controller
{
    /**
     * @var ProjectMembersRepository
     */

   private $repository;
    /**
     * @var ProjectMembersService
     */
    private $service;

    public function __construct(ProjectMembersRepository $repository, ProjectMembersService $service)
    {
            $this->repository = $repository;
            $this->service = $service;
    }

    public function index($id)
    {
        return $this->repository->findWhere(['project_id' => $id]);
        //  return $this->repository->all();
    }
    
    public function addMem($id, $memberId)
    {
        return $this->service->addMember($id, $memberId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $memberId)
    {
        return $this->repository->findWhere(['project_id' => $id,'id' => $memberId]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id, $memberId)

    {
        return $this->service->update($request->all(), $memberId);
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

    public function destroy($id, $memberId )
    {
        return $this->service->delete($memberId);

    } 

}