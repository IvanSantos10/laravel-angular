<?php

namespace Projeto\Http\Controllers;

use Illuminate\Http\Request;

use Projeto\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Projeto\Http\Requests\ProjectNoteCreateRequest;
use Projeto\Http\Requests\ProjectNoteUpdateRequest;
use Projeto\Repositories\ProjectNoteRepository;
use Projeto\Validators\ProjectNoteValidator;


class ProjectNotesController extends Controller
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
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return  $this->repository->findWhere(['project_id' => $id]);
    }


    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function update(Request $request, $id, $nodeId)
    {
        $this->repository->update($request->all(), $nodeId);
        return $this->show($id);
    }

    public function show($id, $nodeId)
    {
        return $this->repository->findWhere(['project_id' => $id, 'id' => $nodeId]);
    }

    public function destroy($id, $nodeId)
    {
        if($this->repository->delete($nodeId)){
            return 'Deletado com sucesso';
        }

        return 'Erro ao deletar';
    }
}
