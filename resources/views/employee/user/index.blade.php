<x-employee-layout>
  <div class="w-full py-3 lg:py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-4 pb-5">

        <h2 class="text-[#C83B1A] font-bold uppercase text-lg mb-4">Lista utenti</h2>

        <div class="overflow-x-auto border bg-gray-200 dark:bg-gray-600 p-2 border-[#C83B1A] rounded-md">
            <table class="rounded-lg min-w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase light:bg-gray-200 dark:text-gray-400">
                    <tr>
                        <th colspan="5" class="px-4 py-2">
                            <div class="max-w-xl ms-auto">
                                <form action="{{ route('employee.users.index') }}" method="get">
                                    @csrf
                                    <div>
                                        <label for="serch-input" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Cerca per nome o email</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </div>
                                            <input type="search" id="serch-input" name="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="cerca per nome/email" value="{{request()->query('search') }}">
                                            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cerca</button>
                                        </div>
                                    </div>
                                </form>          
                            </div>
                        </th>
                    </tr>
                </thead>

                <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-600 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                        Nome utente
                    </th>
                    <th scope="col" class="px-6 py-3">
                        email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Contatto
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <form method="GET" action="{{ route('employee.users.index') }}" class="flex gap-3 items-center justify-end rounded px-2">
                            <select onchange="this.form.submit()" id="roles" name="role" class="block appearance-none w-full dark:bg-gray-400 border border-gray-400 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-500">
                                <option class="text-gray-400" value="">
                                    Tutti i ruoli    
                                </option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ request()->query('role') == $role->name ? 'selected' : '' }}>
                                        {{ ($role->name == 'admin') ? 'Amministratore' : (($role->name == 'employee') ? 'Dipendente' : 'Utente') }}    
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </th>
                    <th scope="col" class="px-6 py-3 text-right">
                        Azioni
                    </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="bg-slate-100 min-w-fit border-b-2 dark:bg-gray-800 dark:border-gray-700 hover:border-b-2 hover:border-[#C83B1A] dark:hover:border-[#C83B1A]">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $user->first_name }}  {{ $user->last_name }}
                            </th>
                            <td scope="row" class="px-6 py-4">
                                {{ $user->email }}
                            </td>
                            <td scope="row" class="px-6 py-4">
                                {{ $user->phone_number }}
                            </td>
                            <td scope="row" class="px-6 flex space-x-2 py-4">
                                @foreach ($user->roles as $user_role)
                                    <span class="font-medium text-[#C83B1A] border border-[#C83B1A] rounded-md px-2">
                                        {{ ($user_role->name == 'admin') ? 'Amministratore' : (($user_role->name == 'employee') ? 'Dipendente' : 'Utente') }}
                                    </span>
                                @endforeach

                            </td>
                            <td class="px-3 text-right">
                                <a href="{{ route('employee.users.show', $user->id) }}" class="font-medium inline-block text-blue-600 dark:text-blue-500 hover:underline px-2 py-2 border rounded-md hover:bg-blue-500 hover:text-white dark:hover:bg-blue-500 dark:hover:text-white border-blue-500 ">Visualizza</a>                              
                            </td>
                        </tr>
                    @endforeach
                </tbody> 

            </table>
            <div class="py-2 px-3 text-xs text-gray-700 bg-gray-200 dark:bg-gray-600 dark:text-gray-400">
                {{ $users->onEachSide(1)->links() }}
            </div>
        </div>

    </div>

</div>
</x-employee-layout>