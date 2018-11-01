<?php

namespace Domain\Base\Repositories\Traits;

use Exception;
use Log;

trait GetsTrait
{

    /**
     * Get all item of model.
     *
     * @param array $columns
     * @param array $with
     * @param array $orders
     * @param int $limit
     * @param int|null $page
     * @return mixed
     */
    public function all(array $columns = ['*'], array $with = [], $orders = [], $limit = 0, int $page = null)
    {
        $all = $this->model;

        if (!empty($with)) {
            $all = $all->with($with);
        }

        if (count($orders) > 0) {
            foreach ($orders as $order) {
                $order['order'] = isset($order['order']) ? $order['order'] : 'ASC';
                $all = $all->orderBy($order['column'], $order['order']);
            }
        }

        if ($limit === 0) {
            return $all->get($columns);
        }

        $all = $all->paginate($limit, $columns, '_page');

        return $all;
    }

    /**
     * Get item of model by id :id.
     *
     * @param int $id
     * @param array $columns
     * @param array $with
     * @param array $load
     * @return mixed
     * @throws Exception
     *
     */
    public function get(int $id, array $columns = ['*'], array $with = [], array $load = [])
    {
        try {
            $item = $this->model;
            if (!empty($with)) {
                $item = $item->with($with);
            }
            $item = $item->find($id, $columns);

            if (!empty($load) and !is_null($item)) {
                $item->load($load);
            }

            if ($item) {
                return $item;
            } else {
                throw new Exception('Item not found');
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return [
                'error' => $e->getMessage()
            ];
        }
    }
}
