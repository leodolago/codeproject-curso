<?php
/**
 * Created by PhpStorm.
 * User: leodolago
 * Date: 30/05/2016
 * Time: 09:11
 */

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Validators\ProjectNoteValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectNoteService
{
    /**
     * @var ProjectNoteRepository
     */
    protected $repository;
    /**
     * @var ProjectNoteValidator
     */
    protected $validator;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator )
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
            
            return $this->repository->with(['client', 'owner'])->find($id);
            
        } catch (ModelNotFoundException $e) {

            return [
                'error'=>true, 'Projeto não existe.'];
        }
    }
}
