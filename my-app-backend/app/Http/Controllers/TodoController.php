<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TodoResource;
use App\Repositories\Contracts\TodoRepositoryInterface;

class TodoController extends Controller
{
	private $todoRepository;

	public function __construct(TodoRepositoryInterface $todoRepository)
	{
		$this->todoRepository = $todoRepository;
	}

	public function create(Request $request)
	{
		return $this->todoRepository->newQuery()->create($request->all());
	}

	public function complete($id)
	{
		return $this->todoRepository->updateComplete($id);
	}

	public function remove($id)
	{
		return $this->todoRepository->updateRemove($id);
	}

	public function getTodoList()
	{
		return TodoResource::collection($this->todoRepository->fetchTodoList());
	}
}
