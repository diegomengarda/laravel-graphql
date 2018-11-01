<?php

namespace Domain\Base\Repositories\Traits;

use Illuminate\Database\Eloquent\Model;
use Log;
use Exception;

trait StoreTrait
{
    /**
     * Store new item of model.
     *
     * @param array $data
     * @return Model|array
     *
     * @throws Exception
     */
    public function store(array $data)
    {
        $model = new $this->model;
        try {
            if (empty($data)) {
                throw new Exception('Empty data');
            }
            $model->fill($data);
            $model->save();
            return $model;
        } catch (Exception $e) {
            report($e);
            throw $e;
        }
    }
}
