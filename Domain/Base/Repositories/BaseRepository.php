<?php

namespace Domain\Base\Repositories;

use Auth;
use Domain\Base\Repositories\Traits\DeleteTrait;
use Domain\Base\Repositories\Traits\GetsTrait;
use Domain\Base\Repositories\Traits\SearchTrait;
use Domain\Base\Repositories\Traits\StoreTrait;
use Domain\Base\Repositories\Traits\UpdateTrait;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    use DeleteTrait;
    use GetsTrait;
    use StoreTrait;
    use UpdateTrait;
    use SearchTrait;

    abstract public function model();

    protected $model;

    /**
     * Get model.
     *
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * @return Model|mixed
     * @throws \Exception
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());
        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @param array|null $orderBy
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = ['*'], $orderBy = null)
    {
        $query = $this->model;
        $query = $query->where($attribute, '=', $value)->select($columns);
        if (isset($orderBy) && is_array($orderBy)) {
            foreach ($orderBy as $field => $direction) {
                $query->orderBy($field, $direction ?? 'ASC');
            }
        }
        return $query->get();
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return Model
     */
    public function findOneBy($attribute, $value, $columns = ['*'], $orderBy = null)
    {
        $query = $this->model;
        $query = $query->where($attribute, '=', $value)->select($columns);
        if (isset($orderBy) && is_array($orderBy)) {
            foreach ($orderBy as $field => $direction) {
                $query->orderBy($field, $direction ?? 'ASC');
            }
        }
        return $query->first();
    }
}
