<?php

namespace Domain\Base\Repositories\Traits;

use Domain\Base\Repositories\Criteria\Search;
use Rebing\GraphQL\Support\SelectFields;

trait SearchTrait
{
    /**
     * @param $root
     * @param $args
     * @param SelectFields $fields
     * @return mixed
     */
    public function resolve($root, $args, SelectFields $fields)
    {
        $filters = isset($args['filters']) ? $args['filters'] : [];
        $with = array_keys($fields->getRelations()) ?? [];
        $columns = $fields->getSelect() ?? ['*'];
        $limit = data_get($args, 'limit') ?? 20;
        $page = data_get($args, 'page') ?? 1;
        $searchModel = app($this->searchModel);
        if (isset($args['id']) && $args['id']) {
            $filters[] = [
                'field' => 'id',
                'rule' => null,
                'value1' => $args['id'],
                'value2' => null
            ];
        }
        if (count($filters)) {
            $searchModel = $this->prepareSearch($searchModel, $filters);
        }
        return $searchModel
            ->select($columns)
            ->with($with)
            ->paginate($limit, $columns, 'page', $page);
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
}
