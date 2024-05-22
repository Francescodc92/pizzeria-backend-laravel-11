import Chart from 'chart.js/auto';
const ctx = document.getElementById('ordersChart');
const orderTimeSelectElement = document.getElementById('orderTimeSelect');


let ordersData = ordersLastWeek; 
let maxOrders = Math.max(...Object.values(ordersLastWeek)) < 10 ? 10 : Math.max(...Object.values(ordersLastWeek));
const updateChart = (chart, data) => {
  maxOrders = Math.max(...Object.values(data)) < 10 ? 10 : Math.max(...Object.values(data));
  chart.data.labels = Object.keys(data);
  chart.data.datasets[0].data = Object.values(data);
  chart.options.scales.y.max = maxOrders;
  chart.update();
};

const ordersChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: Object.keys(ordersData),
    datasets: [{
      label: 'Numero di Ordini',
      data: Object.values(ordersData),
      backgroundColor: '#D44B2A',
      borderColor: '#B03824',
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
        min: 0,
        ticks: {
          color: 'white'
        }
      },
      x: {
        ticks: {
          color: 'white'
        }
      }
    },
    plugins: {
      legend: {
        labels: {
          color: 'white'
        }
      }
    }
  }
});


orderTimeSelectElement.addEventListener('change', (event) => {
  const selectedValue = event.target.value;
  if (selectedValue === 'week') {
    ordersData = ordersLastWeek;
  } else if (selectedValue === 'month') {
    ordersData = ordersMonth;
  } else if (selectedValue === 'year') {
    ordersData = ordersYear;
  }else if(selectedValue === 'lastFiveYears'){
    ordersData = ordersLastFiveYears;
  }
  updateChart(ordersChart, ordersData);
});

