<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
	protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
    	$this->middleware('auth');
    	$this->taskRepository = $taskRepository;
    }

    public function index(Request $request)
    {
    	$tasks = $this->taskRepository->forUser($request->user());
   		return view('tasks.index',['tasks'=>$tasks]); 	
    }

    public function store(Request $request)
    {
    	$rules 	= [
    		'name' => 'required|max:255',
    	];
    	$msg 	= [
    		'name.required' => 'The task name is not empty!',
    	];

    	$this->validate($request,$rules,$msg);

    	$request->user()->tasks()->create($request->all());

    	return redirect('/tasks');
    }

    public function destroy(Request $request, Task $task)
    {
    	$this->authorize('destroy', $task);

    	$task->delete();

    	return redirect('/tasks');
    }
}
