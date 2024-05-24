<x-employee-layout>
  <div class="w-full py-3 lg:py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-4">

        <h2 class="text-[#C83B1A] font-bold uppercase text-lg mb-4">Lista pizze</h2>

        <div class="overflow-x-auto border bg-gray-200 dark:bg-gray-600 p-2 border-[#C83B1A] rounded-md">
            <table class="rounded-md min-w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
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
                            Disponibile
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pizzas as $pizza)
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
                            <td class="px-6 py-4 {{ $pizza->available ? 'text-green-500' : 'text-red-500' }}">
                                {{ $pizza->available ? 'Disponibile' : 'Non disponibile' }}
                            </td>
                            <td>

                            <div class="space-x-1 min-w-fit text-nowrap px-3">
                                <a href="{{ route('employee.pizzas.show', $pizza->id) }}" class="font-medium inline-block text-blue-600 dark:text-blue-500 hover:underline px-2 py-2 border rounded-md hover:bg-blue-500 hover:text-white border-blue-500">Visualizza</a>                       
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
</x-employee-layout>