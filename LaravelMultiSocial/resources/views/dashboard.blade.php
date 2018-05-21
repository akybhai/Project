

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Admin Dashboard</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <style media="screen">
    .vcenter {
      display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: row;
}
    </style>
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.html">Inventory Admin</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <li class="app-search">
          <input class="app-search__input" type="search" placeholder="Search">
          <button class="app-search__button"><i class="fa fa-search"></i></button>
        </li>
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li><a class="dropdown-item" href="page-login.html"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="img/IMG.jpg" alt="User Image" width="60px">
        <div>
          <p class="app-sidebar__user-name">Sagar Gantyala</p>
          <p class="app-sidebar__user-designation">Frontend Developer</p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item active" href="index.html"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li><a class="app-menu__item" href="categories.html"><i class="app-menu__icon fa fa-pencil-square-o"></i><span class="app-menu__label">Categories</span></a></li>
        <li><a class="app-menu__item" href="#"><i class="app-menu__icon fa fa-envelope"></i><span class="app-menu__label">Requests</span></a></li>
        <li><a class="app-menu__item" href="#"><i class="app-menu__icon fa fa-plus-circle"></i><span class="app-menu__label">Add Products</span></a></li>
        <li><a class="app-menu__item" href="userlist.html"><i class="app-menu__icon fa fa-address-book-o"></i><span class="app-menu__label">Users List</span></a></li>
        <li><a class="app-menu__item" href="#"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Logs</span></a></li>
        <li><a class="app-menu__item" href="#"><i class="app-menu__icon fa fa-question-circle"></i><span class="app-menu__label">Help Page</span></a></li>
      </ul>
    </aside>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Users</h4>
              <p><b>21</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
            <div class="info">
              <h4>Staff</h4>
              <p><b>5</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
            <div class="info">
              <h4>Categories</h4>
              <p><b>5</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
            <div class="info">
              <h4>Products</h4>
              <p><b>500</b></p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2 vcenter" align="middle">
          <div class="tile" >
            <div class="tile-title-w-btn">
              <h4 class="title">Select Date</h4>
            </div>
            <div class="tile-body">
              <p>Select Date to see the Inventory:</p>
              <input class="form-control" id="demoDate" type="text" placeholder="Select Date">
            </div>
            <br>
              <button class="btn btn-primary " >Next</button>

          </div>
        </div>
        <div class="col-md-4" align="middle">
          <div class="tile">
            <div class="tile-title-w-btn">
              <h3 class="title">Select Category</h3>
            </div>
            <div class="title-body">
              <p>Select Suitable category to see Inventory:</p>
            </div>
            <div class="bs-component">
              <div class="list-group"><a class="list-group-item list-group-item-action active" href="#" >Instruments</a>
                <a class="list-group-item list-group-item-action" href="#">Music</a>
                <a class="list-group-item list-group-item-action" href="#">Utensils</a>
                <a class="list-group-item list-group-item-action" href="#">Electronics</a>
                <a class="list-group-item list-group-item-action" href="#">Costumes</a>

              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Products Stock</h3>
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="barChartDemo"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Outgoing Products</h3>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Society Name</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td><a class="btn btn-info">Dispatch</a>
                      <!--<button class="btn btn-danger btn-sm"><i class="fa fa-times-circle"></i></button>-->
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td><a class="btn btn-info"></i>Dispatch</a></td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td><a class="btn btn-info"></i>Dispatch</a></td>
                  </tr>
                </tbody>
              </table>
            </div>
            </div>

          <div class="col-md-6">
            <div class="tile">
              <h3 class="tile-title">Incoming Products</h3>
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Product Name</th>
                      <th>Society Name</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td><a class="btn btn-primary"></i>Accept</a></td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Jacob</td>
                      <td>Thornton</td>
                      <td><a class="btn btn-primary"></i>Accept</a></td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Larry</td>
                      <td>the Bird</td>
                      <td><a class="btn btn-primary"></i>Accept</a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
        </div>
      </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('js/plugins/pace.min.js') }}"></script>
    <!-- Page specific javascripts-->
    <script src="{{ asset('js/plugins/chart.js') }}"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript">
    var data = {
      labels: ["January", "February", "March", "April", "May","June"],
      datasets: [
        {
          label: "My Second dataset",
          fillColor: "rgba(151,187,205,0.2)",
          strokeColor: "rgba(151,187,205,1)",
          pointColor: "rgba(151,187,205,1)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(151,187,205,1)",
          data: [2, 4, 3, 9, 6,5]
        }
      ]
    };

    var ctxb = $("#barChartDemo").get(0).getContext("2d");
    var barChart = new Chart(ctxb).Bar(data);

    $('#demoDate').datepicker({
      format: "dd/mm/yyyy",
      autoclose: true,
      todayHighlight: true
    });

    </script>
  </body>
</html>
