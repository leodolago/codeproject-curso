<?php
/**
 * Created by PhpStorm.
 * User: leodolago
 * Date: 30/05/2016
 * Time: 09:11
 */

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectService
{
    /**
     * @var ProjectRepository
     */
    protected $repository;
    /**
     * @var ProjectValidator
     */
    protected $validator;

    public function __construct(ProjectRepository $repository, ProjectValidator $validator )
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }
    
    public function create(array $data)
    {
        try{
            $this->validator->with($data)->passesOrFail();
            
            return $this->repository->create($data);
            
        } catch (ValidatorException $e) {

            return[
                'error' => true, 'Verifique os campos obrigatorios'];
            /**return[
                'error' => true,
                'message' => $e->getMessageBag()
            ]; */
        }
        
    }
    
    public function  update(array $data, $id)
    {
        try {
            $this->repository->with(['client', 'owner'])->find($id);
            try{
                $this->validator->with($data)->passesOrFail();

                return $this->repository->update($data, $id);

                return $this->repository->find($id);

            } catch (ValidatorException $e) {
                return[
                    'error' => true, 'Verifique os campos obrigatorios'];
            }

        } catch  (ModelNotFoundException $e) {
            return ['error' => true, 'Projeto não existe.'];
        }
    }

    /**
    $client = $this->repository->find($id); //consulta o client pelo id

    $client->update($request->all(), $id); //atualiza os dados, e retorna um valor booleano

    return $client; //retorna os dados em JSON */

    public function delete($id)
    {
        try {
            $this->repository->find($id)->delete();
            return ['success'=>true, 'Projeto deletado!'];
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'Projeto não existe.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'Ocorreu algum erro ao excluir o projeto.'];
        }
    }

    public function find($id)
    {
        try {
            
            return $this->repository->with(['client', 'owner',])->find($id);
            
        } catch (ModelNotFoundException $e) {

            return [
                'error'=>true, 'Projeto não existe.'];
        }
    }

    public function addMember($project_id, $member_id)
    {
        $project = $this->repository->find($project_id);
        if(!$this->isMember($project_id, $member_id)){
            $project->members()->attach($member_id);
        }
        return $project->members()->get();
    }

    public function isMember($project_id, $member_id)
    {
        $project = $this->repository->find($project_id)->members()->find(['member_id' => $member_id]);
        if (count($project)) {
            return true;
        }
        return false;

    }

    public function removeMember($project_id, $member_id)
    {
        $project = $this->repository->find($project_id);
        $project->members()->detach($member_id);
        return $project->members()->get();
    }

    }