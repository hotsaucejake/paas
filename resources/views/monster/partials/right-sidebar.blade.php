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
            @if(auth()->user()->hasPermissionTo('view_distribution_emails'))<h5>Distribution</h5>@endif
            <div class="list-group">
                @if(auth()->user()->hasPermissionTo('view_distribution_lists'))<a href="{{ route('distribution_list.index') }}" class="list-group-item {{ request()->is('dashboard/distribution_list*') ? 'active' : '' }}"><i class="fa fa-share"></i> Distribution Lists</a>@endif
                @if(auth()->user()->hasPermissionTo('view_distribution_emails'))<a href="{{ route('distribution_email.index') }}" class="list-group-item {{ request()->is('dashboard/distribution_email*') ? 'active' : '' }}"><i class="fa fa-envelope-o"></i> Distribution Emails</a>@endif
            </div>
        </div>
    </div>
</div>
