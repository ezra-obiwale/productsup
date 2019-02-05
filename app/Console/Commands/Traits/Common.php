<?php

namespace App\Console\Commands\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Validator;

trait Common
{
    /**
     * Display the table representation of the given model
     *
     * @param Model $model
     * @return void
     */
    protected function modelTable(Model $model) : void
    {
        $array = $model->toArray();
        $headers = $this->getTableHeaders($array);

        $this->table($headers, [$array]);
    }

    /**
     * Display the table representation of the given collection
     *
     * @param Collection $collection
     * @return void
     */
    protected function collectionTable(Collection $collection) : void
    {
        if ($collection->count()) {
            $array = $collection->first()->toArray();
            $headers = $this->getTableHeaders($array);

            $this->table($headers, $collection->toArray());
        }

    }

    /**
     * Display the table representation of the given validation errors
     *
     * @param Validator $validation
     * @return void
     */
    protected function validationTable(Validator $validation) : void
    {
        $array = $validation->errors()->toArray();
        $this->table(['errors'], $array);
    }

    /**
     * Fetch table headers from an array
     *
     * @param array $data
     * @return array
     */
    protected function getTableHeaders(array $data) : array
    {
        return array_keys($data);
    }

    /**
     * Parse array of key:value pairs into proper key => value arrays
     *
     * @param array $data
     * @return array
     */
    protected function parseKeyValue(array $data) : array
    {
        $array = [];
        foreach ($data as $value) {
            if ($value && str_contains($value, ':')) {
                list($key, $value) = explode(':', $value);
                $array[$key] = $value;
            }
        }
        return $array;
    }
}
