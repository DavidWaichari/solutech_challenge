<template>
    <div class="container-fluid">
  
      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Create A Task </h1>
  
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">A New Task</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <div class="container">
              <div class="p-5">
                <form>
                  <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="email" class="form-control" id="name" aria-describedby="emailHelp" name="name" v-model="form.name">
                  </div>
                  <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" rows="3" name="description"  v-model="form.description"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="due_date" class="form-label">Due Date</label>
                    <input type="datetime-local" class="form-control" id="due_date" aria-describedby="emailHelp" name="due_date" v-model="form.due_date">
                  </div>
                  <div class="mb-3">
                    <label for="due_date" class="form-label">Task Status</label>
                    <select class="form-select" aria-label="Default select example" name="status_id" v-model="form.status_id">
                      <!-- <option selected>Select Status</option> -->
                      <option :value="status.id" v-for="(status, index) in task_status" :key="index" >{{status.name}}</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary" @click.prevent="addNewTask">Submit</button>
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
          'name':'',
          'description':'',
          'due_date':'',
          'status_id':'',
        },
        task_status:[]
      };
    },
    async created(){
      await axios.get('/api/task_status').then(
        response => {
          this.task_status = response.data.data.task_status
        }
      )
    },
    methods:{
        async addNewTask(){
           await axios.post('api/tasks', this.form).then(
            response => {
              if (response.status == 200) {
                this.$router.push('/tasks');
              }
            }
           )
        }
    }
  };
  </script>
  