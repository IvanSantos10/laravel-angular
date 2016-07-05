<?php

namespace Projeto\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use LucaDegasperi\OAuth2Server\Exceptions\NoActiveAccessTokenException;
use Projeto\Http\Requests;
use Projeto\Repositories\ProjectRepository;
use Projeto\Services\ProjectService;
use Projeto\Validators\ProjectValidator;

class ProjectsController extends Controller
{

    /**
     * @var ProjectRepository
     */
    protected $repository;

    /**
     * @var ProjectValidator
     */
    protected $validator;
    /**
     * @var ProjectService
     */
    private $service;


    /**
     * ProjectsController constructor.
     * @param ProjectRepository $repository
     * @param ProjectValidator $validator
     * @param ProjectService $service
     */
    public function __construct(ProjectRepository $repository, ProjectValidator $validator, ProjectService $service)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return $this->repository->findWhere(['owner_id' => \Authorizer::getResourceOwnerId()]);
        return $this->repository->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { /*
        if ($this->chekProjectPermissions($id) == false) {
            return ['error' => 'Access Forbidden'];
        }
        */
        try {
            return $this->repository->find($id);

        }
        catch(ModelNotFoundException $e){
            return $this->erroMsgm('Projeto não encontrado.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  /*
        if ($this->chekProjectPermissions($id) == false) {
            return ['error' => 'Access Forbidden'];
        }
        */
        return $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $this->repository->skipPresenter()->find($id)->delete();
            return $this->erroMsgm('Projeto deletado com sucesso!');
        }
        catch(QueryException $e){
            return $this->erroMsgm('Projeto não pode ser apagado pois existe um ou mais clientes vinculados a ele.');
        }
        catch(ModelNotFoundException $e){
            return $this->erroMsgm('Projeto não encontrado.');
        }
        catch(NoActiveAccessTokenException $e){
            return $this->erroMsgm('Usuário não está logado.');
        }
        catch(\Exception $e){
            return $this->erroMsgm('Ocorreu um erro ao excluir o projeto.');
        }

    }

    /**
     * @param $projectId
     * @return mixed
     */
    private function checkProjectOwner($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->isOwner($projectId, $userId);
    }

    /**
     * @param $projectId
     * @return mixed
     */
    private function checkProjectMember($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->hasMember($projectId, $userId);
    }

    /**
     * @param $projectId
     * @return bool
     */
    private function chekProjectPermissions($projectId)
    {
        if( $this->checkProjectOwner($projectId) or $this->checkProjectMember($projectId)){
            return true;
        }

        return false;
    }

    private function erroMsgm($mensagem)
    {
        return [
            'error' => true,
            'message' => $mensagem,
        ];
    }

}
