<x-admin-layout>
  <div class="w-full py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      
          <h2 class="text-[#C83B1A] font-bold uppercase text-lg mb-4">{{ $pizza->name }}</h2>
          
          <div class="mb-8">   
            <a href="{{ route('admin.pizzas.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
              Lista Pizze
            </a>
          </div>

          <div class=" flex items-center justify-center text-white ">
            <div class="w-full lg:max-w-4xl rounded overflow-hidden shadow-lg border dark:bg-slate-800 border-[#C83B1A] px-8 py-4 lg:flex">
              <div class="flex justify-center lg:w-[300px] ">
                <img class="w-full object-contain" src="{{asset('storage/'. $pizza->image) }}" alt="{{ $pizza->name }}">
              </div>
              <div class="content ">
                <div class="px-6 py-4">
                  <div class="font-bold text-xl mb-2 uppercase mt-2">{{ $pizza->name }}</div>
                  <p class="text-gray-700 text-base dark:text-white">
                    <span class="text-[#C83B1A] text-lg">Descrizione: </span>{{ $pizza->description }}
                  </p>
                </div>
                <div class="flex px-6 py-4 justify-between max-sm:flex-col ">
                  <p class="text-gray-700 text-base dark:text-white">
                    <span class="text-[#C83B1A] text-lg block">Prezzo: </span>
                    {{ $pizza->price }}€
                  </p>
                  @if ($pizza->discount_percent)  
                    <p class="text-gray-700 text-base dark:text-white ms-1">
                      <span class="text-[#C83B1A] text-lg block">Pezzo scontato</span>
                      {{ number_format( $pizza->price_after_discount , 2 ) }}€
                    </p>
                  @endif
                </div>
                <div class="px-6 pt-4 pb-2">
                  <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $pizza->available ? 'disponibile' : 'non disponibile' }}</span>
                </div>
                <div class="text-center mt-6">
                  <a href="{{ route('admin.pizzas.edit', $pizza->id) }}" class="font-medium inline-block text-yellow-600 dark:text-yellow-500 hover:underline px-4 py-2 border rounded-md hover:bg-yellow-500 hover:text-white border-yellow-500">Modifica</a>
                  <form  class="inline-block"
                    action="{{ route('admin.pizzas.destroy', $pizza->id)}}" 
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