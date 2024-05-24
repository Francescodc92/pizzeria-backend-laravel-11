<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\UserTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use UserTrait;

    protected function getViewPrefix()
    {
        return 'admin';
    }


    public function assignRole(Request $request , User $user)
    {
        if($user->hasRole($request->role)){
            return back()->with('message', 'L\'utente possiede già il ruolo selezionato');
        }

        $user->assignRole($request->role);

        return back()->with('message', 'Ruolo assegnato con successo!');
    }


    public function removeRole(User $user , Role $role)
    {
        if(!$user->hasRole($role)){
            return back()->with('message', 'Il ruolo non è attribuito all\'utente');
        }

        $adminUsers = User::role('admin')->get();

        if($role->name == 'admin' && count($adminUsers) <= 1){
            return back()->with('message', 'L\'utente è l\'unico admin presente nel sistema non puoi revocare il ruolo');
        }

        if($role->name == 'admin' && $user->id == auth()->user()->id)
        {
            return back()->with('message', 'Rimuovendo il ruolo dal tuo account non avrai più accesso alla pagina corrente');
        }


        $user->removeRole($role);

        return back()->with('message', 'Ruolo rimosso con successo');
    }
}
