<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * RepositoryAbstract constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get model
     * @return string
     */
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Get all
     */
    public function all()
    {
        return $this->model::all();
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id, $attributes = null)
    {
        if ($attributes) {
            $result = $this->model::select($attributes)->findOrFail($id);
        } else {
            $result = $this->model->findOrFail($id);
        }

        return $result;
    }

    /**
     * Delete
     *
     * @param $id
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

    /**
     * create
     * @param  array
     */
    public function create($attributes = [])
    {
        return $this->model::create($attributes);
    }

    /**
     * insert
     * @param  array
     */
    public function insert($array = [])
    {
        return $this->model::insert($array);
    }

    /**
     * update
     * @param  $id, array
     * @return  bool
     */
    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    public function insertOrUpdate($table, $credentials)
    {
        $credentials = collect($credentials);
        $creFirstData = $credentials->first();

        if ($creFirstData) {
            $columns = implode(", ", array_keys($creFirstData));
            $updates = collect(array_keys($creFirstData))->map(function ($item) {
                return $item . " = VALUES($item)";
            })->implode(',');
        } else {
            return false;
        }

        $values = $credentials->map(function ($cre) {
            $items = collect($cre)
                ->map(function ($item) {
                    return !is_null($item) ? "'" . $item . "'" : "null";
                });
            $items = $items->implode(',');

            return '(' . $items . ')';
        })->implode(',');

        DB::statement("INSERT INTO {$table}({$columns}) VALUES {$values} ON DUPLICATE KEY UPDATE {$updates}");
    }
}
