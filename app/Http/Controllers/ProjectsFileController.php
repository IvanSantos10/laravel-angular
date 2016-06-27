<?php

namespace Projeto\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Projeto\Http\Requests;
use Projeto\Repositories\ProjectRepository;
use Projeto\Services\ProjectService;
use Projeto\Validators\ProjectValidator;


class ProjectsFileController extends Controller
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


    public function __construct(ProjectRepository $repository, ProjectValidator $validator, ProjectService $service)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->service = $service;
    }

    public function index()
    {
        return $this->repository->findWhere(['owner_id' => \Authorizer::getResourceOwnerId()]);
    }

    public function store(Request $request)
    {
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        Storage::put($request->name.".".$extension, File::get($file));
    }

    public function update(Request $request, $id)
    {
        if ($this->chekProjectPermissions($id) == false) {
            return ['error' => 'Access Forbidden'];
        }

        return $this->service->update($request->all(), $id);

    }

    public function show($id)
    {
        if ($this->chekProjectPermissions($id) == false) {
            return ['error' => 'Access Forbidden'];
        }
        return $this->repository->find($id);
    }

    public function destroy($id)
    {
        if ($this->checkProjectOwner($id) == false) {
            return ['error' => 'Access Forbidden'];
        }

        if ($this->repository->delete($id)) {
            return 'Deletado com sucesso';
        }

        return 'Erro ao deletar';
    }

    private function checkProjectOwner($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->isOwner($projectId, $userId);
    }

    private function checkProjectMember($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->hasMember($projectId, $userId);
    }

    private function chekProjectPermissions($projectId)
    {
        if( $this->checkProjectOwner($projectId) or $this->checkProjectMember($projectId)){
            return true;
        }

        return false;
    }
}
