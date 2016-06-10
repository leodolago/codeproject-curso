<?php
/**
 * Created by PhpStorm.
 * User: leodolago
 * Date: 30/05/2016
 * Time: 09:11
 */

namespace CodeProject\Services;


use CodeProject\Entities\Project;
use CodeProject\Repositories\ClientRepository;
use CodeProject\Validators\ClientValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Exceptions\ValidatorException;

class ClientService
{
    /**
     * @var ClientRepository
     */
    protected $repository;
    /**
     * @var ClientValidator
     */
    protected $validator;

    public function __construct(ClientRepository $repository, ClientValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();

            return $this->repository->create($data);

        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

    }

    public function update(array $data, $id)
    {
        try {
            $this->repository->find($id);
            try {
                $this->validator->with($data)->passesOrFail();

                return $this->repository->update($data, $id);

                return $this->repository->find($id);

            } catch (ValidatorException $e) {
                return [
                    'error' => true, 'Verifique os campos obrigatorios'
                ];
            }
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'Cliente não existe.'];
        }
    }


    public function delete($id)
    {
        try {
         Project::where('client_id', '=', $id)->delete();
           $this->repository->find($id)->delete();
            return ('Cliente e projetos deletados');
        } catch (ModelNotFoundException $e) {
            return [
                'error' => 'Cliente não existe.'];
        }
    }

    /**
     * { try {
     * $this->teste->findWhere('client_id', '=', $id)->delete();
     * try {
     * $this->repository->find($id)->delete();
     * return ('cliente deletado');
     * } catch (ModelNotFoundException $e) {
     *
     * return [
     * 'error' => 'Cliente não encontrado.'
     * ];
     *
     * }}catch (\Exception $e){
     * return [
     * 'error' => 'Delete os projetos desse cliente primeiro'];
     * }} */


    public function find($id)
    {
        try {
            return $this->repository->find($id);
        } catch (ModelNotFoundException $e) {

            return [
                'error' => true, 'Cliente não existe.'
            ];
        }
    }
}
