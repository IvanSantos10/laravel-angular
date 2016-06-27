<?php

namespace Projeto\Presenters;

use Projeto\Transformers\ProjectTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProjectPresenter
 *
 * @package namespace App\Presenters;
 */
class ProjectPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProjectTransformer();
    }
}
