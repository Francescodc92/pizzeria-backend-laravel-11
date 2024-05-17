<x-admin-layout>
  <div class="w-full py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      
          <h2 class="text-[#C83B1A] font-bold uppercase text-lg mb-4">Ordine n:{{ $order->id }}</h2>
          
          <div class="mb-8">   
            <a href="{{ route('admin.orders.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
              Lista Ordini
            </a>
          </div>

          <div class=" flex items-center justify-center text-white ">
            <div class="w-full lg:max-w-4xl rounded overflow-hidden shadow-lg border dark:bg-slate-800 border-[#C83B1A] px-8 py-4">
              <div class="content ">
              
                <div class="text-center mt-6">
                  <a href="{{ route('admin.orders.edit', $order->id) }}" class="font-medium inline-block text-yellow-600 dark:text-yellow-500 hover:underline px-4 py-2 border rounded-md hover:bg-yellow-500 hover:text-white border-yellow-500">Modifica</a>
                  <form  class="inline-block"
                    action="{{ route('admin.orders.destroy', $order->id)}}" 
                    method="POST"
                    onclick="confirmation(event)"
                    >
                        @method('DELETE')
                        @csrf
                        <button class="font-medium text-red-600 dark:text-red-500 hover:underline px-2 py-2 border rounded-md hover:bg-red-500 hover:text-white border-red-500" type="submit">Elimina</button>
                  </form>
                </div>
              </div>
            </div>
            
          </div>

      </div>
  </div>
</x-admin-layout>