<?php

namespace Projeto\Transformers;

use League\Fractal\TransformerAbstract;
use Projeto\Entities\User;

/**
 * Class ProjectTransformer
 * @package namespace App\Transformers;
 */
class ProjectMemberTransformer extends TransformerAbstract
{

    /**
     * Transform the \Project entity
     * @param \Project $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'member_id'  => $model->id,
            'name'  => $model->name,

            /* place your other model properties here */
            /*
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
            */
        ];
    }
}
