<x-admin-layout>
  <div class="w-full py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      
        <h2 class="text-[#C83B1A] font-bold uppercase text-lg mb-4">Edit pizze</h2>
        <div class="mb-8">   
          <a href="{{ route('admin.pizzas.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Pizzas Index
          </a>
        </div>

        <div class="w-full mx-auto max-w-xl pb-5">
          <form class="bg-[#C83B1A]/20 dark:bg-slate-800 shadow-md rounded px-8 pt-6 pb-8 mb-4" action="{{ route('admin.pizzas.update', $pizza->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            
            @include('admin.pizza.pizza-components.form-fields')

            <div class="flex items-center justify-between mt-2">
              <button class="font-medium inline-block text-yellow-600 dark:text-yellow-500 hover:underline px-4 py-2 border rounded-md hover:bg-yellow-500 hover:text-white border-yellow-500" type="submit">
                Edit
              </button>
            </div>
          </form>
          
        </div>
      

      </div>
  </div>
</x-admin-layout>