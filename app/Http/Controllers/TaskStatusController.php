<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Models\Status;


class TaskStatusController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all task_status
        $task_status = Status::all();

        return $this->success([
            'task_status' => $task_status
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

        $status = Status::create($request->all());

        return $this->success([
            'status' => $status
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
        
        $status = Status::find($id);
        
        //check if the tak status exists
        if ($status == null) {
            return $this->error('Tast Status not found');
        }
        return $this->success([
            'status' => $status
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

        //check if the tak status exists

        $status = Status::find($id);

        if ($status == null) {
            return $this->error('Tast Status not found');
        }
        //update
        $status->update($request->all());

        return $this->success([
            'status' => $status,
        ],'task status updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Status::find($id);
        
        //check if the tak status exists
        if ($status == null) {
            return $this->error('Tast Status not found');
        }
        $status->delete();
        return $this->success([
            'status' => $status,
        ],'task status deleted successfully');
    }

    public function associatedUserTasks($task_status_id)
    {
        $status = Status::find($task_status_id);
         //check if the tak status exists
         if ($status == null) {
            return $this->error('Tast Status not found');
        }
       
        return $this->success([
            'user_tasks' => $status->usertasks,
        ]);
    }
    public function associatedTasks($task_status_id)
    {
        $status = Status::find($task_status_id);
         //check if the tak status exists
         if ($status == null) {
            return $this->error('Tast Status not found');
        }
       
        return $this->success([
            'tasks' => $status->tasks,
        ]);
    }
}
