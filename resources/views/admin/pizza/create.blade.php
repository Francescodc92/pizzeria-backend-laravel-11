<x-admin-layout>
  <div class="w-full py-1">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
      
        <h2 class="text-[#C83B1A] font-bold uppercase text-lg mb-2">Create pizza</h2>
        <div class="mb-4">   
          <a href="{{ route('admin.pizzas.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Lista pizze
          </a>
        </div>

        <div class="w-full mx-auto max-w-xl pb-1">
          <form class="bg-slate-800/30 dark:bg-slate-800 shadow-md rounded px-8 pt-6 pb-8 mb-2" action="{{ route('admin.pizzas.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            @include('admin.pizza.pizza-components.form-fields')

          
            <div class="flex items-center justify-between">
              <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Crea
              </button>
            </div>
          </form>
          
        </div>
      

      </div>
  </div>
</x-admin-layout>