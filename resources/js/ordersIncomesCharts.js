import Chart from 'chart.js/auto';
const ctx = document.getElementById('ordersPriceChart');
const orderTimeSelectElement = document.getElementById('orderPriceTimeSelect');

let ordersPriceData = orderPriceSumPerDayLastWeek; 
let maxOrders = Math.max(...Object.values(ordersLastWeek)) < 10 ? 10 : Math.max(...Object.values(ordersLastWeek));
const updateChart = (chart, data) => {
  maxOrders = Math.max(...Object.values(data)) < 10 ? 10 : Math.max(...Object.values(data));
  chart.data.labels = Object.keys(data);
  chart.data.datasets[0].data = Object.values(data);
  chart.options.scales.y.max = maxOrders;
  chart.update();
};

const ordersPriceChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: Object.keys(ordersPriceData),
    datasets: [{
      label: 'Somma degli Order Price',
      data: Object.values(ordersPriceData),
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
          color: 'white',
          callback: function(value) {
            return value.toLocaleString('it-IT', { style: 'currency', currency: 'EUR' });
          }
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
    ordersPriceData = orderPriceSumPerDayLastWeek;
  } else if (selectedValue === 'month') {
    ordersPriceData = orderPriceSumPerDayThisMonth;
  } else if (selectedValue === 'year') {
    ordersPriceData = orderPriceSumPerMonth;
  } else if (selectedValue === 'lastFiveYears') {
    ordersPriceData = ordersPriceLastFiveYears;
  }
  updateChart(ordersPriceChart, ordersPriceData);
});