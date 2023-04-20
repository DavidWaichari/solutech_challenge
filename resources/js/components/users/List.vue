<template>
    <div class="container-fluid">
  
      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Users</h1>
  
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">A list of Users</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Added On</th>
                  <th>Manage</th>
                  <th>Assigned Tasks</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Added On</th>
                  <th>Manage</th>
                  <th>Assigned Tasks</th>
                </tr>
              </tfoot>
              <tbody>
                <tr v-for="(user, index) in usersData" :key="index">
                  <td>{{ user.name }}</td>
                  <td>{{ user.email }}</td>
                  <td>{{ user.created_at }}</td>
                  <td><button  class="btn btn-warning btn-block" @click.prevent="deleteUser(index)"> Delete</button></td>
                  <td><button  class="btn btn-primary btn-block" @click.prevent="userTasks(user.id)"> View Tasks</button></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        user: {},
        usersData: [],
      };
    },
    async created() {
      this.user = JSON.parse(localStorage.getItem('user'));
  
      try {
        const response = await axios.get('/api/users');
        console.log(response.data.data.users);
        this.usersData = response.data.data.users;
      } catch (error) {
        console.error(error);
      }
    },
    methods:{
        deleteUser(id){
            alert('We are not deleting a user at this level')
        },
        userTasks(id){
          this.$router.push(`/users/${id}/tasks`);
        }
    }
  };
  </script>
  