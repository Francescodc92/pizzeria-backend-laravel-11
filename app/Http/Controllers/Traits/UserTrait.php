<?php

namespace App\Http\Controllers\Traits;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

trait UserTrait
{
    public function index(Request $request)
    {
        $roles = Role::all();
        $searchTerm = $request->input('search', '');
        $selectedRole = $request->query('role', '');

        $usersQuery = User::query();

        $usersQuery->where(function ($query) use ($searchTerm) {
            $query->where('first_name', 'like', "%$searchTerm%")
                  ->orWhere('last_name', 'like', "%$searchTerm%")
                  ->orWhere('email', 'like', "%$searchTerm%");
        });

        if ($selectedRole !== '') {
            $usersQuery->whereHas('roles', function ($query) use ($selectedRole) {
                $query->where('name', $selectedRole);
            });
        }

        $users = $usersQuery->paginate(8)->appends([
            'search' => $searchTerm,
            'role' => $selectedRole
        ]);

        return view($this->getViewPrefix() .'.user.index', compact('users', 'roles'));
    }

    public function show(User $user)
    {
        $roles = Role::all();
        return  view($this->getViewPrefix() .'.user.show', compact('user', 'roles'));
    }

    protected abstract function getViewPrefix();
}
