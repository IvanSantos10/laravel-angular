<?php

namespace Projeto\Transformers;

use League\Fractal\TransformerAbstract;
use Projeto\Entities\Project;

/**
 * Class ProjectTransformer
 * @package namespace App\Transformers;
 */
class ProjectTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['members'];
    /**
     *
     * Transform the \Project entity
     * @param \Project $model
     *
     * @return array
     */
    public function transform(Project $model)
    {
        return [
            'project_id'         => (int) $model->id,
            'client_id'         => (int) $model->client_id,
            'owner_id'         => (int) $model->owner_id,
            'name'     =>$model->name,
            'description' =>$model->description,
            'progress'    =>$model->progress,
            'status'    =>$model->status,
            'due_date'    =>$model->due_date,

            /* place your other model properties here */
            /*
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
            */
        ];
    }

    public function includeMembers(Project $project)
    {
        return $this->collection($project->members, new ProjectMemberTransformer());
    }
}
