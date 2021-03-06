<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 22/06/16
 * Time: 16:10
 */

namespace Projeto\Services;

use Prettus\Validator\Exceptions\ValidatorException;
use Projeto\Repositories\ClientRepository;
use Projeto\Validators\ClientValidator;

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
        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);

        } catch(ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function update(array $data, $id)
    {
        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);

        } catch(ValidatorException $e){
            return [
                'error' => true,
                'massage' => $e->getMessageBag()
            ];
        }

    }
}