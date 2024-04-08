<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserRole;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;    

class RolePermissionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $user_role = auth()->user()->userRole->role_id;
        

        $rolePermissionExists = RolePermission::where([
            'role_id' => $user_role,
            'confirmed' => '1',
        ])->whereIn('permission_id', $permission->pluck('id'))->exists();

        dd($rolePermissionExists);
        
        return $rolePermissionExists; 
    }


    public function viewAdmin(User $user , $Permission){
        $user_role = auth()->user()->userRole->role_id;

        $rolePermissionExists = RolePermission::where([
            'role_id' => $user_role,
            'permission_id' => $permission->id,
            'confirmed' => '1',
        ])->exists();

        dd($rolePermissionExists);
        
        return $rolePermissionExists; 
    }

   


    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RolePermission $rolePermission): bool
    {

        $user_role = auth()->user()->userRole->role_id;

        if ($rolePermission->role_id == $user_role &&  $rolePermission  && $rolePermission->confirmed == 1) {
            return true; 

        }

        return false; 
       
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RolePermission $rolePermission): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RolePermission $rolePermission): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RolePermission $rolePermission): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RolePermission $rolePermission): bool
    {
        //
    }
}
