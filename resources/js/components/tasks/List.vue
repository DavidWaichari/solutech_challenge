<template>
    <div class="container-fluid">
  
      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Tasks List</h1>
  
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">A list of available tasks that have been created</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Due Date</th>
                  <th>Status</th>
                  <th>Added On</th>
                  <th>Manage</th>
                  <th>Assigned Tasks</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Due Date</th>
                  <th>Status</th>
                  <th>Added On</th>
                  <th>Manage</th>
                  <th>Assigned Tasks</th>
                </tr>
              </tfoot>
              <tbody>
                <tr v-for="(task, index) in tasks" :key="index">
                  <td>{{ task.name }}</td>
                  <td>{{ task.description }}</td>
                  <td>{{ task.due_date }}</td>
                  <td>{{ task.status_id }}</td>
                  <td>{{ task.created_at }}</td>
                  <td><button  class="btn btn-warning btn-block" @click.prevent="deleteStatus(index)"> Delete</button></td>
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
        tasks: [],
      };
    },
    async created() {
      this.user = JSON.parse(localStorage.getItem('user'));
  
      try {
        const response = await axios.get('/api/tasks');
        this.tasks = response.data.data.tasks;
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
  