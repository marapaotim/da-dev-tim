<?php

namespace App\Repositories;

use App\Repositories\Contracts\TodoRepositoryInterface;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class TodoRepository implements TodoRepositoryInterface
{
	private $model;

    public function __construct(Todo $model)
    {
        $this->model = $model;
    }

	public function newQuery(): Builder
	{
		return $this->model->newQuery();
	}

	public function fetchTodoList()
	{
		return $this->model->where('status', '!=', 0)->get()->all();
	}

	public function updateComplete($id)
	{
		$item = $this->model->find($id);
		$item->status = 1;
		return $item->save();
	}

	public function updateRemove($id)
	{
		$item = $this->model->find($id);
		$item->status = 0;
		return $item->save();
	}
}
