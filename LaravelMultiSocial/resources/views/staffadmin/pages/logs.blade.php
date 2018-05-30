@extends('staffadmin.layouts.app')

@section('admincontent')
<style media="screen">
tr, table, td, th {

  text-align: center;
}
</style>
    <div class="app-title">
      <div>
        <h1><i class="fa fa-file-text"></i> Logs</h1>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
      </ul>
    </div>

    <div class="row justify-content-center">
      <a class="btn btn-primary btn-lg" href="download"><i class="fa fa-download"></i>Export Logs</a>
    </div><br>

    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">Activity logs</h3>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th width="25%">Timestamp</th>
                <th width="25%">Product/User</th>
                <th width="25%">Action</th>
                <th width="25%">Incharge</th>
              </tr>
            </thead>
            <tbody>
              @foreach($activity as $row)
              <tr>
                <td width="25%">{{$row->event_timestamp}}</td>
                <td width="25%">{{$row->prod_user}}</td>
                <td width="25%">{{$row->action}}</td>
                <td width="25%">{{$row->performed_by}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

@endsection
