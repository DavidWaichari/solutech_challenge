<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Models\UserTask;
use App\Models\User;
use App\Models\Task;
use Carbon\Carbon;
use DB;


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
        $user_tasks = UserTask::with(['user', 'task', 'status'])->get();

        return $this->success([
            'user_tasks' => $user_tasks
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
           'user_id' => 'required|integer',
           'task_id' => 'required|integer',
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

        $request['due_date'] = Carbon::parse($request->due_date)->format('Y-m-d H:i');
        $request['start_time'] = Carbon::parse($request->start_time)->format('Y-m-d H:i');
        $request['end_time'] = Carbon::parse($request->end_time)->format('Y-m-d H:i');

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
           'user_id' => 'required|integer',
           'task_id' => 'required|integer',
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

    public function userTasksChartData()
    {
        $months = [];
        $no_of_tasks = [];
        for ($i=5; $i >= 0; $i--) { 
            $month = Carbon::now()->subMonth($i);
            //fetch user tasks
            $tasks =DB::table('user_tasks')
                    ->whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count();
            array_push($months, $month->format('M'));
            array_push($no_of_tasks, $tasks);
        }
        return $this->success([
            'months' => $months,
            'no_of_tasks' =>$no_of_tasks
        ],'user chart chart data fetched successfully');
    }
}
