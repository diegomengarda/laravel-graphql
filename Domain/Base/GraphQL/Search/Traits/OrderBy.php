<?php

namespace Domain\Base\GraphQL\Search\Traits;

trait OrderBy
{

    protected function orderBy(array $data, $query)
    {
        if (isset($data['orderBy'])) {
            if (is_array($data['orderBy'])) {
                foreach ($data['orderBy'] as $order) {
                    $query->orderBy($order['column'], $order['direction'] ?? 'ASC');
                }
            }
        }
        return $this;
    }
}
