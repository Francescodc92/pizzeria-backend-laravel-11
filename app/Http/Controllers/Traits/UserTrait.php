<?php

namespace App\Http\Controllers\Traits;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

trait UserTrait
{
    public function index(Request $request)
    {
        $searchTerm = $request->input('search', '');

        $users = User::where('first_name', 'like', "%$searchTerm%")
                    ->orWhere('last_name', 'like', "%$searchTerm%")
                    ->orWhere('email', 'like', "%$searchTerm%")
                    ->paginate(8);

        $roles = Role::all();


        return view($this->getViewPrefix() .'.user.index', compact('users', 'roles', 'searchTerm'));
    }

    public function show(User $user)
    {
        $roles = Role::all();
        return  view($this->getViewPrefix() .'.user.show', compact('user', 'roles'));
    }

    protected abstract function getViewPrefix();
}
