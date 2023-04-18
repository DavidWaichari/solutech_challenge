<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Models\UserTask;
use App\Models\User;
use App\Models\Task;


class UserTaskController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all user tasks
        $task = UserTask::all();

        return $this->success([
            'task' => $task
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
        $request->validate([
            'name' => 'required|string|max:255',
           'user_id' => 'required|integer',
           'task_id' => 'required|integer',
           'remarks' => 'required',
        ]);

        //check if we have a user
        $user = User::find($request->user_id);
        if ($user == null) {
            return $this->error('User not found', 404);
        }
        //check if we have a task
        $task = Task::find($request->task_id);
        if ($task == null) {
            return $this->error('Task not found', 404);
        }
        $user_task = UserTask::create($request->all());

        return $this->success([
            'user_task' => $user_task
        ],'user task created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $user_task = UserTask::find($id);
        
        //check if the user task exists
        if ($user_task == null) {
            return $this->error('User task  not found', 404);
        }
        return $this->success([
            'user_task' => $user_task
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
           'user_id' => 'required|integer',
           'task_id' => 'required|integer',
           'remarks' => 'required',
        ]);

        //check if the user task exists

        $user_task = UserTask::find($id);

        if ($user_task == null) {
            return $this->error('User task not found', 404);
        }

        //check if we have a user
        $user = User::find($request->user_id);
        if ($user == null) {
            return $this->error('User not found', 404);
        }
        //check if we have a task
        $task = Task::find($request->task_id);
        if ($task == null) {
            return $this->error('Task not found', 404);
        }

        //update
        $user_task->update($request->all());

        return $this->success([
            'user_task' => $user_task,
            
        ],'user task updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_task = UserTask::find($id);
        
        //check if the user task exists
        if ($user_task == null) {
            return $this->error('User task  not found', 404);
        }
        $user_task->delete();
        return $this->success([
            'user_task' => $user_task,
        ],'task  deleted successfully');
    }
}
