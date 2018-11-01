<?php

namespace Domain\Base\GraphQL\Search\Traits;

trait Decide
{
    /**
     * @param string $field
     * @param string|null $rule
     * @param $value1
     * @param null $value2
     * @param null $query
     * @throws \Exception
     */
    public function decide(string $field, string $rule = null, $value1, $value2 = null, $query = null)
    {
        if (is_null($query)) {
            $query = $this->getQuery();
        }

        /**
         * where $field = $value.
         */
        if (is_null($rule)) {
            $query->where($field, $value1);
            return;
        }

        if (isset($rule)) {

            /**
             * where $field = $value.
             */
            if ($rule === '=') {
                $query->where($field, $value1);
                return;
            }

            /**
             * where $field ilike $value.
             */
            if ($rule === 'ilike') {
                $query->where($field, 'ilike', $value1);
                return;
            }

            /**
             * where $field not like $value.
             */
            if ($rule === 'notLike') {
                $query->where($field, 'not like', $value1);
                return;
            }

            /**
             * where $field != $value.
             */
            if ($rule === '!=') {
                $query->where($field, '!=', $value1);
                return;
            }

            /**
             * where $field in ($value).
             */
            if ($rule === 'in') {
                if (!is_array($value1)) {
                    $value1 = explode(',', $value1);
                }
                $query->whereIn($field, $value1);
                return;
            }

            /**
             * where $field not in ($value).
             */
            if ($rule === 'notIn') {
                if (!is_array($value1)) {
                    $value1 = explode(',', $value1);
                }
                $query->whereNotIn($field, $value1);
                return;
            }

            /**
             * where $field > $value.
             */
            if ($rule === '>') {
                $query->where($field, '>', $value1);
                return;
            }

            /**
             * where $field < $value.
             */
            if ($rule === '<') {
                $query->where($field, '<', $value1);
                return;
            }

            /**
             * where $field >= $value.
             */
            if ($rule === '>=') {
                $query->where($field, '>=', $value1);
                return;
            }

            /**
             * where $field <= $value.
             */
            if ($rule === '<=') {
                $query->where($field, '<=', $value1);
                return;
            }

            /*
             * where $field between $start and $end.
             */
            if ($rule === 'between' &&
                isset($value1) && $value1 &&
                isset($value2) && $value2) {
                $query->whereBetween($field, [$value1, $value2]);
                return;
            }
        }

        return;
    }
}
