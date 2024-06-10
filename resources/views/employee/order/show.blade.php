<x-employee-layout>
  <div class="w-full py-5">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      
          <h2 class="text-[#C83B1A] font-bold uppercase text-lg mb-4">Id Ordine: {{ $order->id }}</h2>
          
          <div class="mb-8">   
            <a href="{{ route('employee.orders.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
              Lista Ordini
            </a>
          </div>

          <div class=" flex items-center justify-center text-white pb-5">
            <div class="w-full lg:max-w-4xl rounded overflow-hidden shadow-lg border bg-slate-800/30 dark:bg-slate-800 border-[#C83B1A] px-8 py-4">
              <div class="content lg:flex gap-3">
                <div class="lg:w-1/2 bg-slate-200 dark:bg-slate-600 rounded-md py-3 px-3 text-black dark:text-white"">
                  <h2 class="text-[#C83B1A] font-bold uppercase text-lg mb-2">Dettagli cliente</h2>
                  <div>
                    <p class="text-lg capitalize text-[#C83B1A]">{{ $order->user->first_name }} {{ $order->user->last_name }}</p>
                    <p>
                      Contatti
                    </p>
                    <span class="text-sm text-zinc-600 dark:text-zinc-400 block">{{ $order->user->email }}</span>
                    <span class=" text-zinc-600 dark:text-zinc-400 block">{{ $order->user->phone_number }}</span>
                    <p>
                      Indirizzo di spedizione
                    </p>
                    <span class=" text-zinc-600 dark:text-zinc-400">{{ $order->address->road }}, {{ $order->address->city }}, {{ $order->address->zip_code }}</span>
                    <div class="mt-5 ">
                      <a href="{{ route('employee.users.show', $order->user->id) }}" class="font-medium inline-block text-blue-600 dark:text-blue-500 hover:underline px-3 py-1 border rounded-md hover:bg-blue-500 hover:text-white border-blue-500">Visualizza Utente</a> 
                    </div>
                  </div>
                </div>

                <div class="lg:w-1/2 bg-slate-200 dark:bg-slate-600 rounded-md py-3 px-3 text-black dark:text-white">
                  <h2 class="text-[#C83B1A] font-bold uppercase text-lg mb-2">Dettagli ordine</h2>
                  <div>
                    <div class="my-2 flex justify-end">
                      @php
                        $statusColors = [
                          'pending' => 'bg-red-400',
                          'processing' => 'bg-yellow-400',
                          'shipped' =>'bg-blue-400',
                          'completed' => 'bg-green-400'
                        ];

                        $statusColor = $statusColors[$order->status];
                       
                      @endphp
                      <p class="text-md font-semibold w-fit px-3 rounded-lg uppercase text-white {{ $statusColor }}">
                        {{ $order->order_statuses[$order->status] }}
                      </p>
                    </div>
                    <p>Data ordine</p>
                    <span class="text-sm text-zinc-600 dark:text-zinc-400 block">{{ $order->order_date_forHumans }}</span>
                    <p>Prezzo totale</p>
                    <span class="text-lg text-zinc-600 dark:text-zinc-400 block">{{ $order->order_price , 2 }}€</span>
                  </div>

                  <div class="mt-2">
                    <label for="status">Cambia lo stato dell'ordine</label>
                    <form action="{{ route('employee.orders.update', $order->id) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <select name="status" id="status" class="block appearance-none w-full dark:bg-gray-400 border border-gray-400  text-gray-700 mt-1 pr-8 rounded leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-500" onchange="this.form.submit()">
                      
                        @foreach ($order->order_statuses as $key => $status)
    
                          <option value="{{ $key }}" {{ $order->status == $key ? 'selected' : '' }}>
                            {{ $status }}
                          </option>  
                        @endforeach
                      </select>
                    </form>
                  </div>
                </div>
              </div>

              <div class="mt-6">
                <h2 class="text-[#C83B1A] font-bold uppercase text-lg mb-2">Lista prodotti</h2>
                <div class="overflow-x-auto">
                  <table class="rounded-lg min-w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-600 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nome
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Prezzo
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Sconto
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Prezzo Scontato
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Quantità
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->pizzas as $pizza)
                            <tr class="bg-slate-100 min-w-fit border-b-2 dark:bg-gray-800 dark:border-gray-700 hover:border-b-2 hover:border-[#C83B1A]">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $pizza->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ number_format( $pizza->price , 2 ) }}€
                                </td>
                                <td class="px-6 py-4">
                                    {{ $pizza->discount_percent > 0 ? $pizza->discount_percent . '%' : 'nessuno sconto' }}
                                </td>
                                <td class="px-6 py-4 ">
                                    {{ number_format( $pizza->price_after_discount , 2 ) }}€
                                </td>
                                <td class="px-6 py-4">
                                    {{ $pizza->pivot->quantity }}
                                </td>
                                <td>
    
                                <div class="space-x-1 min-w-fit text-nowrap px-3">
                                    <a href="{{ route('employee.pizzas.show', $pizza->id) }}" class="font-medium inline-block text-blue-600 dark:text-blue-500 hover:underline px-2 py-2 border rounded-md hover:bg-blue-500 hover:text-white border-blue-500">Dettagli pizza</a>                          
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody> 
                  </table>
                </div>
              </div>

            </div>
          </div>

      </div>
  </div>
</x-employee-layout>