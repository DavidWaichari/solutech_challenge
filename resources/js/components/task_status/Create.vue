<template>
    <div class="container-fluid">
  
      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Create A Task Status </h1>
  
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">A New Task Status</h6>
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
                  <button type="submit" class="btn btn-primary" @click.prevent="addNewStatus">Submit</button>
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
        },
      };
    },
    methods:{
        async addNewStatus(){
           await axios.post('api/task_status', this.form).then(
            response => {
              if (response.status == 200) {
                this.$router.push('/task_status');
              }
            }
           )
        }
    }
  };
  </script>
  