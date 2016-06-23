<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 22/06/16
 * Time: 16:10
 */

namespace Projeto\Services;


use Illuminate\Contracts\Validation\ValidationException;
use Projeto\Repositories\ProjectNoteRepository;
use Projeto\Validators\ProjectNoteValidator;

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

    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data)
    {
        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);

        } catch(ValidationException $e){
            return [
                'error' => true,
                'massage' => $e->getMessageBag()
            ];
        }
    }

    public function update(array $data, $id)
    {
        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);

        } catch(ValidationException $e){
            return [
                'error' => true,
                'massage' => $e->getMessageBag()
            ];
        }

    }
}