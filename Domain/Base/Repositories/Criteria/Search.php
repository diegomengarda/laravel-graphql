<?php

namespace Domain\Base\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Search
{
    use Traits\Decide;
    use Traits\OrderBy;

    /**
     * @var Builder
     */
    private $query;

    /**
     * @param Model $query
     * @return $this
     */
    public function setModel(Model &$query)
    {
        $this->query = $query->newQuery();
        return $this;
    }

    /**
     * @param Model $model
     * @param array $data
     * @return $this
     * @throws \Exception
     */
    public function run(Model &$model, array $data)
    {
        $this->setModel($model);
        $this->loop($data, $this->getQuery());
        $this->orderBy($data, $this->getQuery());

        return $this;
    }

    /**
     * @param array $data
     * @param $query
     * @throws \Exception
     */
    public function loop(array $data, $query)
    {
        foreach ($data as $key => $item) {
            $this->decide($item['field'], $item['rule'], $item['value1'], $item['value2'], $query);
        }
    }

    /**
     * @param $searchModel
     * @param array $data
     * @return mixed
     */
    public function prepareSearch($searchModel, array $data)
    {
        $search = app(Search::class);
        $search->run($searchModel, $data);
        $searchModel = $search->getQuery();
        return $searchModel;
    }

    /**
     * get Model with queries.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getQuery()
    {
        return $this->query;
    }
}
