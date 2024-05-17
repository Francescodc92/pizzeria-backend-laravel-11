<x-admin-layout>
  <div class="w-full py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="mb-8">   
          <a href="{{ route('admin.pizzas.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Lista Pizze
          </a>
        </div>
        
          <div class=" flex items-center justify-center text-white ">
            <div class="w-full lg:max-w-4xl rounded overflow-hidden shadow-lg border dark:bg-slate-800 border-[#C83B1A] px-3 lg:px-8 py-4 lg:flex">
              <div class="flex flex-col items-start justify-center lg:w-1/3 ">
                <div class="w-full flex justify-center my-3 relative">
                  <img class="w-full max-w-[300px] object-contain" src="{{asset('storage/'. $pizza->image) }}" alt="{{ $pizza->name }}">
                
                  @if ($pizza->discount_percent)
                  <div class="absolute top-0 right-0 w-[50px] h-[50px] rounded-full flex items-center justify-center bg-[#C83B1A] text-white">
                    -{{ $pizza->discount_percent }}%
                  </div>
                  @endif
                
                </div>
                <h1 class="w-full font-bold text-xl uppercase my-4 text-center text-gray-800 dark:text-white">{{ $pizza->name }}</h1>
                <div class="flex py-4 justify-center w-full space-x-2">
                  <p class="{{ $pizza->discount_percent ? 'line-through text-gray-500 text-md flex items-center' : 'text-[#C83B1A] text-2xl' }}">
                    {{ $pizza->price }}€
                  </p>
                  @if ($pizza->discount_percent)  
                    <p class="text-[#C83B1A] text-2xl">
                      {{ number_format( $pizza->price_after_discount , 2 ) }}€
                    </p>
                  @endif
                </div>
              </div>
              <div class="content lg:w-2/3 flex flex-col justify-between">
                <div >
                 
                  <div class="md:px-6 py-4">
                    <h2 class="text-[#C83B1A] font-bold text-center text-xl">Descrizione</h2>
                    <p class="text-gray-700 text-base dark:text-white text-center">
                      <span class="text-[#C83B1A] text-lg"> </span>{{ $pizza->description }}
                    </p>
                  </div>

                  <div class="px-6 pt-4 pb-2 text-center ">
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $pizza->available ? 'disponibile' : 'non disponibile' }}</span>
                  </div>

                </div>
                <div class="text-center mt-6 space-x-4">
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