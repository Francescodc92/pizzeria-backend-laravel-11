<x-admin-layout>
  <div class="w-full py-4 lg:py-12 text-white">
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-4 pb-5">   
      <h2 class="text-[#C83B1A] font-bold uppercase text-lg mb-4">Statistiche</h2>
      <div class="overflow-x-auto 2xl:flex space-y-3 2xl:space-x-4 2xl:space-y-0">
        
        
          <div class="w-full 2xl:w-1/2 max-w-4xl mx-auto min-w-[600px] rounded-md p-4 xl:p-6 bg-slate-800/30 border border-[#C83B1A] dark:border-0">
            <h3 class="my-3 text-light text-lg font-semibold">Grafico Ordini Ricevuti</h3>
            <label for="orderTimeSelect" class="text-light">
              Periodo
            </label>
            <select id="orderTimeSelect" class="block appearance-none w-1/3 dark:bg-gray-400 border border-gray-400  text-gray-700 my-1 pr-8 rounded leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-500 ">
                <option value="week">Ultimi 7 giorni</option>
                <option value="month">Questo Mese</option>
                <option value="year">Questo Anno</option>
                <option value="lastFiveYears">Ultimi 5 Anni</option>
            </select>
            <canvas id="ordersChart"></canvas>
          </div>

          <div class="w-full 2xl:w-1/2 max-w-4xl mx-auto min-w-[600px] rounded-md p-4 xl:p-6 bg-slate-800/30 border border-[#C83B1A] dark:border-0">
            <h3 class="my-3 text-light text-lg font-semibold">Grafico Entrate</h3>
            <label for="orderPriceTimeSelect" class="text-light">
              Periodo
            </label>
            <select id="orderPriceTimeSelect" class="block appearance-none w-1/3 dark:bg-gray-400 border border-gray-400  text-gray-700 my-1 pr-8 rounded leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-500 ">
                <option value="week">Ultimi 7 giorni</option>
                <option value="month">Questo Mese</option>
                <option value="year">Questo Anno</option>
                <option value="lastFiveYears">Ultimi 5 Anni</option>
            </select>
            <canvas id="ordersPriceChart"></canvas>
          </div>

        

    </div>
  </div>

  <script>
    const ordersLastWeek = @json($ordersPerDayLastWeek );
    const ordersMonth = @json($ordersPerDayThisMonth);
    const ordersYear = @json($ordersPerMonth);
    const ordersLastFiveYears = @json($ordersLastFiveYears);
    const orderPriceSumPerDayLastWeek = @json($orderPriceSumPerDayLastWeek );
    const orderPriceSumPerDayThisMonth = @json($orderPriceSumPerDayThisMonth);
    const orderPriceSumPerMonth = @json($orderPriceSumPerMonth);
    const ordersPriceLastFiveYears = @json($ordersPriceLastFiveYears);
  </script>
  @vite(['resources/js/ordersCountCharts.js', 'resources/js/ordersIncomesCharts.js'])
</x-admin-layout>
