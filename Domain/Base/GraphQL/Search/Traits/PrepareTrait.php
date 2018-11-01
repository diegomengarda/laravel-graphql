<?php

namespace Domain\Base\GraphQL\Search\Traits;

use Domain\Base\GraphQL\Search\SearchService;

trait PrepareTrait
{
    public function prepareSearch($searchModel, array $data)
    {
        $search = app(SearchService::class);
        $search->run($searchModel, $data);
        $searchModel = $search->getQuery();
        return $searchModel;
    }
}
