<x-admin-layout>
  <div class="w-full py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-4">

        <h2 class="text-[#C83B1A] font-bold uppercase text-lg mb-4">Lista Ordini</h2>

        <div class="overflow-x-auto">
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
                          Data Ordine
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Stato
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
                          <td class="px-6 py-4">
                              {{ $order->user->first_name .' '. $order->user->last_name }}
                          </td>
                          <td class="px-6 py-4">
                            {{ $order->order_date_forHumans }}
                          </td>
                          <td class="px-6 py-4 ">
                              {{ $order->status }}
                          </td>
                          <td class="px-6 py-4">
                            {{ number_format( $order->order_price , 2 ) }}€
                          </td>
                          <td>
  
                            <div class="space-x-1 min-w-fit text-nowrap px-3 text-right">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="font-medium inline-block text-blue-600 dark:text-blue-500 hover:underline px-2 py-2 border rounded-md hover:bg-blue-500 hover:text-white border-blue-500">Visualizza</a>                         
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody> 

            </table>
            <div class="py-2 px-3 text-xs text-gray-700 bg-gray-200 dark:bg-gray-600 dark:text-gray-400">
                {{ $orders->links() }}
            </div>
        </div>

    </div>

</div>
</x-admin-layout>