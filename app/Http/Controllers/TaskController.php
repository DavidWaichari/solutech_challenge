<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Models\Task;
use Carbon\Carbon;


class TaskController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all tasks
        $tasks = Task::with('status')->get();

        return $this->success([
            'tasks' => $tasks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $request['due_date'] = Carbon::parse($request->due_date)->format('Y-m-d H:i');
        $task = Task::create($request->all());

        return $this->success([
            'task' => $task
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $task = Task::find($id);
        
        //check if the task exists
        if ($task == null) {
            return $this->error('Tast  not found');
        }
        return $this->success([
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attr = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        //check if the task exists

        $task = Task::find($id);

        if ($task == null) {
            return $this->error('Tast not found');
        }
        //update
        $task->update($request->all());

        return $this->success([
            'task' => $task,
            
        ],'task updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        
        //check if the task exists
        if ($task == null) {
            return $this->error('Tast  not found');
        }
        $task->delete();
        return $this->success([
            'task' => $task,
        ],'task  deleted successfully');
    }
}
