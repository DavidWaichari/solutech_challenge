<template>
    <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Users</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ users.length }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Task Status</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ task_status.length }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Tasks</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ tasks.length }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            User Tasks</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{user_tasks.length}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">User Tasks Monthly Progress (Last 6 Months)</h6>
                <p>This is using static data since the api does not have a lot of data(Apex Chart)</p>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <line-chart />
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Space for one more chart..</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <p>Pie chart here...</p>
            </div>
        </div>
    </div>
</div>
</div>
</template>

<script>
import axios from 'axios';
import LineChart from './ApexChart.vue'
export default {
    components: {
    LineChart,
    },
    name:"dashboard",
    data(){
        return {
            user:{},
            users:[],
            task_status:[],
            tasks:[],
            user_tasks:[],
        }
    },
    async created(){
        this.user = JSON.parse(localStorage.getItem('user'))
        await axios.get('/api/users').then(
            response =>{
                this.users = response.data.data.users
            }
        )
        await axios.get('/api/task_status').then(
            response =>{
                this.task_status = response.data.data.task_status
            }
        )
        await axios.get('/api/tasks').then(
            response =>{
                this.tasks = response.data.data.tasks
            }
        )
        await axios.get('api/user_tasks').then(
            response =>{
                this.user_tasks = response.data.data.user_tasks
            }
        )
    },
}
</script>