<template>
    <div class="container-fluid">
  
      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Status List</h1>
  
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">A list of available task status</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Added On</th>
                  <th>Manage</th>
                  <th>Assigned Tasks</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Added On</th>
                  <th>Manage</th>
                  <th>Assigned Tasks</th>
                </tr>
              </tfoot>
              <tbody>
                <tr v-for="(status, index) in task_status" :key="index">
                  <td>{{ status.name }}</td>
                  <td>{{ status.created_at }}</td>
                  <td><button  class="btn btn-warning btn-block" @click.prevent="deleteStatus(index)"> Delete</button></td>
                  <td><button  class="btn btn-primary btn-block" @click.prevent="userTasks(status.id)"> View User Tasks</button></td>
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
        task_status: [],
      };
    },
    async created() {
      this.user = JSON.parse(localStorage.getItem('user'));
  
      try {
        const response = await axios.get('/api/task_status');
        this.task_status = response.data.data.task_status;
      } catch (error) {
        console.error(error);
      }
    },
    methods:{
        deleteStatus(id){
            alert('We are not deleting a status at this level')
        },
        userTasks(id){
          this.$router.push(`/status/${id}/user_tasks`);
        }
    }
  };
  </script>
  