<x-admin-layout>
  <div class="w-full py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-4">

        <h2 class="text-[#C83B1A] font-bold uppercase text-lg mb-4">Lista utenti</h2>

        <div class="overflow-x-auto">
          <table class="rounded-lg min-w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-800 dark:text-gray-400">
                <tr>
                    <th colspan="4" class="px-6 py-3">
                      <div class="max-w-xl ms-auto">
                        <form action="{{ route('admin.users.index') }}" method="get">
                            @csrf
                            <div>
                                <label for="serch-input" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Cerca per nome o email</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </div>
                                    <input type="search" id="serch-input" name="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="cerca per nome/email" value="{{ $searchTerm }}">
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
                       Ruoli Utente
                   </th>
                   <th scope="col" class="px-6 py-3 text-right">
                       Assegna ruolo
                   </th>
                  </tr>
            </thead>
            <tbody>
                  @foreach ($users as $user)
                      <tr class="bg-slate-100 min-w-fit border-b-2 dark:bg-gray-800 dark:border-gray-700 hover:border-b-2 hover:border-[#C83B1A]">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                          {{ $user->first_name }}  {{ $user->last_name }}
                                </th>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $user->email }}
                                </td>
                                <td scope="row" class="px-6 flex space-x-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                  @foreach ($user->roles as $user_role)
                                        <form  class="inline-block"
                                        action="{{ route('admin.user.role.remove', [ $user->id , $user_role->id])}}"
                                        method="POST"
                                        onclick="confirmation(event)"
                                        >
                                            @method('DELETE')
                                            @csrf
                                            <button class="font-medium text-red-600 dark:text-red-500 hover:underline px-2 py-2 border rounded-md hover:bg-red-500 hover:text-white border-red-500" type="submit">
                                                {{ ($user_role->name == 'admin') ? 'Amministratore' : (($user_role->name == 'employee') ? 'Dipendente' : 'Utente') }}
                                            </button>
                                        </form>
                                  @endforeach

                                </td>
                                <td >
                                    <form method="POST" action="{{route('admin.user.role', $user->id)}}" class="flex gap-3 items-center justify-end  rounded px-2">
                                        @csrf
                                        
                                    <select onchange="this.form.submit()" id="roles" name="role" class="block appearance-none w-full dark:bg-gray-400 border border-gray-400  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-gray-100 focus:border-gray-500" >
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}" >
                                                {{ ($role->name == 'admin') ? 'Amministratore' : (($role->name == 'employee') ? 'Dipendente' : 'Utente') }}    
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <span class="text-red-400 text-sm">{{$message}}</span>
                                    @enderror
                                        
                                    </form>
                                </td>
                            </tr>
                          <td>
                    </tr>
                    @endforeach
                </tbody> 

          </table>
          <div class="py-2 px-3 text-xs text-gray-700 bg-gray-200 dark:bg-gray-600 dark:text-gray-400">

          {{ $users->links() }}
          </div>
        </div>

    </div>

</div>
</x-admin-layout>