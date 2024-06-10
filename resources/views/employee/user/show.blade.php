<x-employee-layout>
  <div class="w-full py-5">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="mb-4">   
          <a href="{{ route('employee.users.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Lista Utenti
          </a>
        </div>
        
          <div class=" flex items-center justify-center text-white pb-5">
            <div class="w-full lg:max-w-4xl rounded overflow-hidden shadow-lg border bg-slate-800/30 dark:bg-slate-800 border-[#C83B1A] px-3 lg:px-8 py-4 ">
             <div class="lg:flex">
               <div class="flex flex-col items-start justify-center lg:w-1/3">
                 
                  <div class="w-full text-center">
                    <div class="flex items-center justify-center w-full">
                      <img class="w-40 h-40 rounded-full" src="{{ asset('assets/img/user.png') }}" alt="profile photo">
                    </div>
                    <h2 class="text-[#C83B1A] font-bold uppercase text-lg">{{ $user->first_name }} {{ $user->last_name }}</h2>
                    <span class="text-sm text-zinc-700 dark:text-zinc-400 block">{{ $user->email }}</span>
                    <span class=" text-zinc-700 dark:text-zinc-400 block">{{ $user->phone_number }}</span>
                  </div>
                 
               </div>
 
               <div class="content lg:w-2/3 md:h-[250px] py-3 overflow-y-auto flex flex-col justify-center sm:justify-start  my-8 lg:my-0 bg-slate-200 dark:bg-slate-600 px-4 rounded-md">
                 <h2 class="text-[#C83B1A] font-bold uppercase text-lg mb-2">Indirizzi Registrati</h2>
                 @foreach ($user->addresses as $address)
                   <div class="mb-1 text-gray-500 dark:text-gray-400">
                     <span class="text-[#C83B1A]">indirizzo: {{ $address->road }}</span>
                     <p>città: {{ $address->city }}, {{ $address->zip_code }}</p>
                   </div>
                 @endforeach
               
               </div>

               
               </div>
               
               <div class="my-3 bg-slate-200 dark:bg-slate-600 px-4 py-2 rounded-md">
                <h2 class="text-[#C83B1A] font-bold text-start sm:text-center uppercase text-lg mb-2">Ruoli Utente</h2>

                <div class="flex flex-col md:flex-row items-start sm:items-center justify-center gap-3">
                  @foreach ($user->roles as $user_role)
                      <span class="font-medium text-[#C83B1A] border border-[#C83B1A] rounded-md px-2">
                          {{ ($user_role->name == 'admin') ? 'Amministratore' : (($user_role->name == 'employee') ? 'Dipendente' : 'Utente') }}
                      </span>
                  @endforeach
                </div>
                
             </div>
             
              <div class="mt-7">
                <h2 class="text-[#C83B1A] font-bold uppercase text-lg mb-2">Ordini effettuati</h2>
                <div class="h-[250px] overflow-y-auto">
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
                        @foreach ($user->orders as $order)
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
                                      <a href="{{ route('employee.orders.show', $order->id) }}" class="font-medium inline-block text-blue-600 dark:text-blue-500 hover:underline px-2 py-2 border rounded-md hover:bg-blue-500 hover:text-white border-blue-500">Visualizza</a>                         
                                  </div>
                              </td>
                          </tr>
                          @endforeach
                          
                    </tbody> 

                    
      
                  </table>
                </div>
              </div>
            </div>
          </div>

      </div>
  </div>
</x-employee-layout>