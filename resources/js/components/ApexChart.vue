<template>
    <div>
      <apexchart type="line" :options="chartOptions" :series="chartSeries" />
    </div>
</template>
  
  <script>
  export default {
    name: 'LineChart',
    data() {
      return {
        chartOptions: {
          chart: {
            id: 'line-chart',
          },
          xaxis: {
            categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
          },
        },
        chartSeries: [
          {
            name: 'No of Tasks',
            data: [30, 40, 25, 50, 49, 21, 70],
          },
        ],
      };
    },
    async created(){
        await axios.get('/api/user_chart_data').then(
            response => {
                this.chartOptions.xaxis.categories = response.data.data.months
                this.chartSeries[0].data = response.data.data.no_of_tasks
            }
        )
    }
  };
  </script>
  