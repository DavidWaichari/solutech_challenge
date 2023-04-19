<template>
    <div class="container-fluid">
  
      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Create A User Task </h1>
  
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">A New User Task</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <div class="container">
              <div class="p-5">
                <form>
                  <div class="mb-3">
                    <label for="due_date" class="form-label">User</label>
                    <select class="form-select" aria-label="Default select example" name="user_id" v-model="form.user_id">
                      <!-- <option selected>Select Status</option> -->
                      <option :value="user.id" v-for="(user, index) in users" :key="index" >{{user.name}}</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="due_date" class="form-label">Task</label>
                    <select class="form-select" aria-label="Default select example" name="task_id" v-model="form.task_id">
                      <!-- <option selected>Select Status</option> -->
                      <option :value="task.id" v-for="(task, index) in tasks" :key="index" >{{task.name}}</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="due_date" class="form-label">Due Date</label>
                    <input type="datetime-local" class="form-control" id="due_date" aria-describedby="emailHelp" name="due_date" v-model="form.due_date">
                  </div>
                  <div class="mb-3">
                    <label for="start_time" class="form-label">Start Time</label>
                    <input type="datetime-local" class="form-control" id="start_time" aria-describedby="emailHelp" name="start_time" v-model="form.start">
                  </div>
                  <div class="mb-3">
                    <label for="end_time" class="form-label">End Time</label>
                    <input type="datetime-local" class="form-control" id="end_time" aria-describedby="emailHelp" name="end_time" v-model="form.end_time">
                  </div>
                  <div class="mb-3">
                    <label for="remarks" class="form-label">Remarks</label>
                    <textarea class="form-control" id="remarks" rows="3" name="remarks"  v-model="form.remarks"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="due_date" class="form-label">Task Status</label>
                    <select class="form-select" aria-label="Default select example" name="status_id" v-model="form.status_id">
                      <!-- <option selected>Select Status</option> -->
                      <option :value="status.id" v-for="(status, index) in task_status" :key="index" >{{status.name}}</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary" @click.prevent="addNewUserTask">Submit</button>
                </form>
              </div>
            </div>
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
        form: {
          'user_id':'',
          'task_id':'',
          'due_date':'',
          'start_time':'',
          'end_time':'',
          'remarks':'',
          'status_id':'',
        },
        task_status:[],
        users:[],
        tasks:[],
      };
    },
    async created(){
      await axios.get('/api/task_status').then(
        response => {
          this.task_status = response.data.data.task_status
        }
      )
      await axios.get('/api/users').then(
        response => {
          this.users = response.data.data.users
        }
      )
      await axios.get('/api/tasks').then(
        response =>{
          this.tasks = response.data.data.tasks
        }
      )
    },
    methods:{
        async addNewUserTask(){
           await axios.post('api/user_tasks', this.form).then(
            response => {
              if (response.status == 200) {
                this.$router.push('/user_tasks');
              }
            }
           )
        }
    }
  };
  </script>
  