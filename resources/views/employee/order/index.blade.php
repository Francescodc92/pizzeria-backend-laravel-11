<x-employee-layout>
  <div class="w-full py-3 lg:py-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-4 py-3">

        <h2 class="text-[#C83B1A] font-bold uppercase text-lg mb-4">Lista Ordini</h2>

        <div class="overflow-x-auto border bg-gray-200 dark:bg-gray-600 p-2 border-[#C83B1A] rounded-md">
            <table class="rounded-lg min-w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-600 dark:text-gray-400">
                  <tr>
                      <th scope="col" class="px-6 py-3">
                          #Id Ordine
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Utente
                      </th>
                      <th scope="col" class="px-6 py-3">
                        <form action="{{ route('employee.orders.index') }}" method="GET">
                            @csrf
                            <select name="orderBy" id="orderBy" class="block appearance-none w-full dark:bg-gray-400 border border-gray-400 text-gray-700 mt-1 pr-8 rounded leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-500" onchange="this.form.submit()">
                                <option value="DESC" {{ request('orderBy') == 'DESC' ? 'selected' : '' }}>Ordini Recenti</option>
                                <option value="ASC" {{ request('orderBy') == 'ASC' ? 'selected' : '' }}>Meno Recente</option>
                            </select>
                        
                      </th>
                      <th scope="col" class="px-6 py-3">
                            <select name="status" id="status" class="block appearance-none w-full dark:bg-gray-400 border border-gray-400 text-gray-700 mt-1 pr-8 rounded leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-500" onchange="this.form.submit()">
                                <option value="">Tutti gli stati</option>
                                @if (isset($orders[0]))
                                    @foreach ($orders[0]->order_statuses as $key => $status)
                                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>  
                                    @endforeach
                                @endif
                            </select>
                        </form>
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Prezzo Totale
                      </th>
                      <th scope="col" class="px-6 py-3 text-right">
                          Actions
                      </th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($orders as $order)
                      <tr class="bg-slate-100 min-w-fit border-b-2 dark:bg-gray-800 dark:border-gray-700 hover:border-b-2 hover:border-[#C83B1A]">
                          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                              {{ $order->id }}
                          </th>
                          <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                              {{ $order->user->first_name .' '. $order->user->last_name }}
                          </td>
                          <td class="px-6 py-4">
                            {{ $order->order_date_forHumans }}
                          </td>
                          <td class="px-6 py-4 ">
                            @php
                              $statusColors = [
                                  'pending' => 'text-red-400',
                                  'processing' => 'text-yellow-400',
                                  'shipped' =>'text-blue-400',
                                  'completed' => 'text-green-400'
                                ];
        
                                
                                $statusColor = $statusColors[$order->status];
                                
                            @endphp

                            <span class="font-medium {{ $statusColor }}">
                                {{ $order->order_statuses[$order->status] }}
                            </span>
                          </td>
                          <td class="px-6 py-4">
                            {{ number_format( $order->order_price , 2 ) }}€
                          </td>
                          <td>
  
                            <div class="space-x-1 min-w-fit text-nowrap px-3 text-right">
                                <a href="{{ route('employee.orders.show', $order->id) }}" class="font-medium inline-block text-blue-600 dark:text-blue-500 hover:underline px-2 py-2 border rounded-md hover:bg-blue-500 hover:text-white dark:hover:text-white border-blue-500">Visualizza</a>                         
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody> 

            </table>
            <div class="py-2 px-3 text-xs text-gray-700 bg-gray-200 dark:bg-gray-600 dark:text-gray-400">
                {{ $orders->onEachSide(1)->links()}}
            </div>
        </div>

    </div>

</div>
</x-employee-layout>