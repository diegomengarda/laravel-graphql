<?php

namespace Domain\Base\GraphQL\Search\Query;

use Domain\Base\GraphQL\Search\Traits\PrepareTrait;
use Illuminate\Database\Eloquent\Model;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

class SearchQuery extends Query
{
    use PrepareTrait;

    protected $searchModel;

    /**
     * SearchQuery constructor.
     * @param Model $searchModel
     */
    public function __construct(Model $searchModel)
    {
        $this->searchModel = app($searchModel);
        parent::__construct();
    }

    public function resolve($root, $args, SelectFields $fields)
    {
        $filters = isset($args['filters']) ? $args['filters'] : [];
        $with = array_keys($fields->getRelations()) ?? [];
        $columns = $fields->getSelect() ?? ['*'];
        $limit = data_get($args, 'limit') ?? 20;
        $page = data_get($args, 'page') ?? 1;
        if (isset($args['id']) && $args['id']) {
            $filters[] = [
                'field' => 'id',
                'rule' => null,
                'value1' => $args['id'],
                'value2' => null
            ];
        }
        if (count($filters)) {
            $this->searchModel = $this->prepareSearch($this->searchModel, $filters);
        }
        return $this->searchModel
            ->select($columns)
            ->with($with)
            ->paginate($limit, $columns, 'page', $page);
    }
}
