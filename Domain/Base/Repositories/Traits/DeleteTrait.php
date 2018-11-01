<?php

namespace Domain\Base\Repositories\Traits;

use Exception;
use Log;

trait DeleteTrait
{

    /**
     * Destroy item of model by id :id.
     *
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function delete($id)
    {
        try {
            return $this->model->destroy($id);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
