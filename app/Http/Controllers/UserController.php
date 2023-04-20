<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Models\User;
use App\Models\UserTask;


class UserController extends Controller
{

    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all users
        $users = User::all();

        return $this->success([
            'users' => $users
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         //get user
         $user = User::find($id);
        if ($user == null) {
            return $this->error('user not found', 404);
        }
         return $this->success([
             'user' => $user
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    function userTasks($user_id)
    {
          //get user
          $user = User::find($user_id);
          if ($user == null) {
              return $this->error('user not found', 404);
            }
            $tasks = UserTask::where('user_id', $user->id)->with(['task','status','user'])->get();
           return $this->success([
               'user' => $user,
               'tasks' => $tasks
           ]);
    }
}
