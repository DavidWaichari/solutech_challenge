<template>
    <div class="container-fluid">
  
      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Users Tasks List</h1>
  
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">A list of available user tasks that have been allocated to users</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>User</th>
                  <th>Task</th>
                  <th>Due Date</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                  <th>Remarks</th>
                  <th>Status</th>
                  <th>Added On</th>
                  <th>Manage</th>
                  <th>Assigned Tasks</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>User</th>
                  <th>Task</th>
                  <th>Due Date</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                  <th>Remarks</th>
                  <th>Status</th>
                  <th>Added On</th>
                  <th>Manage</th>
                  <th>Assigned Tasks</th>
                </tr>
              </tfoot>
              <tbody>
                <tr v-for="(task, index) in user_tasks" :key="index">
                  <td>{{ task.user.name }}</td>
                  <td>{{ task.task.name }}</td>
                  <td>{{ task.due_date }}</td>
                  <td>{{ task.start_time }}</td>
                  <td>{{ task.end_time }}</td>
                  <td>{{ task.remarks }}</td>
                  <td>{{ task.status.name }}</td>
                  <td>{{ task.created_at }}</td>
                  <td><button  class="btn btn-warning btn-block" @click.prevent="deleteTask(index)"> Delete</button></td>
                  <td><button  class="btn btn-primary btn-block"> View Tasks</button></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  
    </div>
  </template>
  
  <script>  
  export default {
    data() {
      return {
        user: {},
        user_tasks: [],
      };
    },
    async created() {
      this.user = JSON.parse(localStorage.getItem('user'));
  
      try {
        const response = await axios.get('/api/user_tasks');
        this.user_tasks = response.data.data.user_tasks;
      } catch (error) {
        console.error(error);
      }
    },
    methods:{
        deleteTask(id){
            alert('We are not deleting a task at this level')
        }
    }
  };
  </script>
  