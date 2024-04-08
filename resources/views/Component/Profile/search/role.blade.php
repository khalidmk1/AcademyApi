@foreach ($filteredRoles as $role)
    <tr class="text-center">
        <td>{{ $role->role_name }} </td>

        @foreach ($permissions as $permission)
            <td class="text-center">
                <form>
                    @csrf
                    <div class="icheck-primary d-inline">

                        <input type="checkbox" class="checkbox make_permission" data-role = "{{ $role->id }}"
                            {!! $role->id == 1 || $role->role_name == 'Admin' ? 'disabled' : '' !!}
                            {{ isset($RolePermissioncheck[$role->id]) &&
                            $RolePermissioncheck[$role->id]->contains('permission_id', $permission->id) &&
                            $RolePermissioncheck[$role->id]->contains('confirmed', 1)
                                ? 'checked'
                                : '' }}
                            data-permission="{{ $permission->id }}"
                            id="checkboxPrimary_{{ $permission->id }}_{{ $role->id }}">
                        <label for="checkboxPrimary_{{ $permission->id }}_{{ $role->id }}">
                        </label>

                    </div>
                </form>
            </td>
        @endforeach

    </tr>
@endforeach