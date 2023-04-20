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
            name: 'My Series',
            data: [30, 40, 25, 50, 49, 21, 70],
          },
        ],
      };
    },
  };
  </script>
  