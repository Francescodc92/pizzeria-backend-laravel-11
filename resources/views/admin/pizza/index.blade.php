<x-admin-layout>
  <div class="w-full py-3 lg:py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-4 pb-3">

        <h2 class="text-[#C83B1A] font-bold uppercase text-lg mb-4">Lista pizze</h2>

        <div class="mb-5">
            <a href="{{ route('admin.pizzas.create') }}" class="bg-green-500 cursor-pointer hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Crea Pizza
            </a>
        </div>

        <div class="overflow-x-auto border bg-gray-100 dark:bg-gray-600 p-2 border-[#C83B1A] rounded-md mb-5">
            <table class="rounded-md min-w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-600 dark:text-gray-400">
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
                            Disponibile
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pizzas as $pizza)
                        <tr class="bg-slate-200 min-w-fit border-b-2 border-gray-100 dark:bg-gray-800 dark:border-gray-700 hover:border-b-2 hover:border-[#C83B1A]">
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
                            <td class="px-6 py-4 {{ $pizza->available ? 'text-green-500' : 'text-red-500' }}">
                                {{ $pizza->available ? 'Disponibile' : 'Non disponibile' }}
                            </td>
                            <td>

                            <div class="space-x-1 min-w-fit text-nowrap px-3">
                                <a href="{{ route('admin.pizzas.show', $pizza->id) }}" class="font-medium inline-block text-blue-600 dark:text-blue-500 hover:underline px-2 py-2 border rounded-md hover:bg-blue-500 hover:text-white border-blue-500">Visualizza</a>
                                <a href="{{ route('admin.pizzas.edit', $pizza->id) }}" class="font-medium inline-block text-yellow-600 dark:text-yellow-500 hover:underline px-4 py-2 border rounded-md hover:bg-yellow-500 hover:text-white border-yellow-500">Modifica</a>
                            
                                <form onclick="confirmation(event)"  class="inline-block" action="{{ route('admin.pizzas.destroy', $pizza->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="font-medium text-red-600 dark:text-red-500 hover:underline px-2 py-2 border rounded-md hover:bg-red-500 hover:text-white border-red-500" type="button">Elimina</button>
                                </form>                           
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody> 
            </table>
            <div class="py-2 px-3 text-xs text-gray-700 bg-gray-200 dark:bg-gray-600 dark:text-gray-400">
                {{ $pizzas->onEachSide(1)->links() }}
            </div>
        </div>

    </div>

</div>
</x-admin-layout>