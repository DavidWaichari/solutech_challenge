<template>
    <div class="container-fluid">
  
      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Create User</h1>
  
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">A New User</h6>
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
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" v-model="form.email">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" v-model="form.password">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword2" name="password_confirmation" v-model="form.password_confirmation">
                  </div>
                  <button type="submit" class="btn btn-primary" @click.prevent="addNewUser">Submit</button>
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
          'email':'',
          'password':'',
          'password_confirmation':'',
        },
      };
    },
    methods:{
        async addNewUser(){
           await axios.post('api/auth/register', this.form).then(
            response => {
              if (response.status == 200) {
                this.$router.push('/users');
              }
            }
           )
        }
    }
  };
  </script>
  