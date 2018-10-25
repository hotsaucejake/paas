<!-- .right-sidebar -->
<div class="right-sidebar">
    <div class="slimscrollright">
        <div class="rpanel-title"> Site Settings <span><i class="ti-close right-side-toggle"></i></span> </div>
        <div class="r-panel-body">
            @if(auth()->user()->hasPermissionTo('view_users'))<h5>Users</h5>@endif
            <div class="list-group">
                @if(auth()->user()->hasPermissionTo('view_users'))<a href="{{ route('user.index') }}" class="list-group-item {{ request()->is('dashboard/user*') ? 'active' : '' }}"><i class="fa fa-users"></i> Users</a>@endif
                @if(auth()->user()->hasPermissionTo('view_roles'))<a href="{{ route('role.index') }}" class="list-group-item {{ request()->is('dashboard/role*') ? 'active' : '' }}"><i class="fa fa-id-badge"></i> Roles</a>@endif
                @if(auth()->user()->hasPermissionTo('view_permissions'))<a href="{{ route('permission.index') }}" class="list-group-item {{ request()->is('dashboard/permission*') ? 'active' : '' }}"><i class="fa fa-key"></i> Permissions</a>@endif
            </div>
            <hr>
        </div>
    </div>
</div>
