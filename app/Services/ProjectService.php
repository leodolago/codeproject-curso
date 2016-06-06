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
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
        
    }
    
    public function  update(array $data, $id)
    {
        try{
            $this->validator->with($data)->passesOrFail();

            return $this->repository->update($data, $id);

            return $this->repository->find($id);

        } catch (ValidatorException $e) {
            return[
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

    }

    public function delete($id)
    {
        try {
            $this->repository->find($id)->delete();
            return ('Projeto deletado');
        } catch (ModelNotFoundException $e) {

            return [
                'error' => 'Projeto não encontrado.'
            ];
        }
    }

    public function find($id)
    {
        try {
            
            return $this->repository->with(['client', 'owner'])->find($id);
            
        } catch (ModelNotFoundException $e) {

            return [
                'error' => 'Projeto não encontrado.'
            ];
        }
    }
}