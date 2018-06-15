<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user">
        {{-- <img class="app-sidebar__user-avatar" src="img/IMG.jpg" alt="User Image" width="60px"> --}}
        <div>
          <?php
                use app\User;

            $user = User::find(Auth::id());
            $role=\DB::select('select name from roles WHERE cast(role_id as signed)=?', [$user->role_id]);

            ?>
          <p class="app-sidebar__user-name">{{$user->name}}</p>
          <p class="app-sidebar__user-designation">{{$role[0]->name}}</p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a id="dashboardsidenav" class="app-menu__item" href="{{ route('home')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li><a id="categoriessidenav" class="app-menu__item" href="{{ route('adminstaff.categories')}}"><i class="app-menu__icon fa fa-pencil-square-o"></i><span class="app-menu__label">Categories</span></a></li>
        <li><a id="requestsidenav" class="app-menu__item" href="{{ route('adminstaff.request')}}"><i class="app-menu__icon fa fa-envelope"></i><span class="app-menu__label">Requests</span></a></li>
        <li><a id="addprodsidenav" class="app-menu__item" href="{{ route('adminstaff.products')}}"><i class="app-menu__icon fa fa-plus-circle"></i><span class="app-menu__label">Products</span></a></li>
        <li><a id="userlistsidenav" class="app-menu__item" href="{{ route('adminstaff.userlist')}}"><i class="app-menu__icon fa fa-address-book-o"></i><span class="app-menu__label">Users List</span></a></li>
        <li><a id="logssidenav" class="app-menu__item"  href="{{ route('adminstaff.logs')}}"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Logs</span></a></li>
        <li><a id="helppagesidenav" class="app-menu__item" href="{{ route('adminstaff.adhocRequest')}}"><i class="app-menu__icon fa fa-question-circle"></i><span class="app-menu__label">ADhoc Request</span></a></li>
      </ul>
    </aside>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<script>
    $(document).ready(function() {
        if (document.URL.search(/categories/i)>0) {
            $("#categoriessidenav").addClass("active");
        }
        else if (document.URL.search(/request/i)>0) {
            $("#requestsidenav").addClass("active");
        }
        else if (document.URL.search(/products/i)>0) {
            $("#addprodsidenav").addClass("active");
        }
        else if (document.URL.search(/user/i)>0) {
            $("#userlistsidenav").addClass("active");
        }
        else if (document.URL.search(/report/i)>0) {
            $("#reportssidenav").addClass("active");
        }
        else if (document.URL.search(/log/i)>0) {
            $("#logssidenav").addClass("active");
        }
        else if (document.URL.search(/help/i)>0) {
            $("#helppagesidenav").addClass("active");
        }
        else {
            $("#dashboardsidenav").addClass("active");
        }
    });

</script>
