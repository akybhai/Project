@extends('staffadmin.layouts.app')

@section('admincontent')

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
            <p><b>
                    <?php
                    use App\User;
                    $users=\DB::select('select count(*) as c from users where role_id=3');

                        echo $users[0]->c;



                    ?>

              </b></p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="widget-small info coloured-icon"><i class="icon fa fa-user-secret"></i>
          <div class="info">
            <h4>Admin/Staff</h4>
            <p><b>
                    <?php
                    $users=\DB::select('select count(*) as c from users where role_id!=3');

                    echo $users[0]->c;



                    ?>

              </b></p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
          <div class="info">
            <h4>Categories</h4>
            <p><b>

                    <?php
                    $cat=\DB::select('select count(*) as c from categories');

                    echo $cat[0]->c;



                    ?>

              </b></p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
          <div class="info">
            <h4>Products</h4>
            <p><b>
                    <?php
                    $prod=\DB::select('select count(*) as c from products');

                    echo $prod[0]->c;



                    ?>

              </b></p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">

      <div class="col-md-6">
        <div class="tile">
          <h3 class="tile-title">Products in each Categories</h3>
          <div class="embed-responsive embed-responsive-16by9">
            <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="tile">
          <h3 class="tile-title">Monthly Bookings</h3>
          <div class="embed-responsive embed-responsive-16by9">
            <canvas class="embed-responsive-item" id="barChartDemo"></canvas>
          </div>
        </div>
      </div>


    </div>
    <div class="row" >
      <div class="col-md-6" style="height: 350px;overflow-y:scroll;>
        <div class="tile">
          <h3 class="tile-title">Outgoing Products</h3>
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Id</th>
              <th>Product Name</th>
              <th>Reason</th>
              <th></th>
            </tr>
            </thead>
            <tbody>


                <?php
                $inTran = \DB::select('select booking_id as id,product_id as prod, booking_reason as bs from transactions WHERE booking_status  in ("approved") and Start_Date=?',[date("Y-m-d")]);

                foreach($inTran as $t)
                {
                    $prodname=\DB::select('select name from products where productID=?',[$t->prod]);
                    echo "<tr><td>".$t->id."</td>";
                    echo "<td>".$prodname[0]->name."</td>";
                    echo "<td>".$t->bs."</td>";
                    echo '<td>
                <button type="button" class="btn btn-info" data-toggle="modal" onclick="updatecpnb('.$t->id.','.$t->prod.')" data-target="#exampleModalCenter">
                  Collect
                </button>
              </td></tr>';
                }

                $inTran = \DB::select('select count(*) as c from transactions WHERE booking_status  in ("approved") and Start_Date=?',[date("Y-m-d")]);
                if($inTran[0]->c==0)
                {
                    echo "No Product Today";
                }
                ?>


                <script>
                  function updatecpnb(x,y)
                  {
                      document.getElementById("cprodID").value=y;
                      document.getElementById("cbookID").value=x;
                  }
                  </script>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Collect product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <!-- Collect products logic -->
                        <div class="form-group">
                          {{ csrf_field() }}
                          <label class="control-label" for="prodID"><b>Product ID:</b></label>
                          <input type="prodID" class="form-control collect-from" value="0" id="cprodID" placeholder="Enter product ID" name="prodID" required disabled>
                        </div>

                        <div class="form-group">
                          <label class="control-label" for="studID"><b>Student ID:</b></label>
                          <input type="studID"  class="form-control collect-from"  id="studID" placeholder="Enter student ID" name="studID" required>
                        </div>

                        <div class="form-group">
                          <label class="control-label" for="bookID"><b>Booking ID:</b></label>
                          <input type="bookID"  class="form-control collect-from" id="cbookID" value="0" name="bookID" required disabled>
                        </div>

                        <div class="form-group">
                          <label class="control-label" for="staff"><b>Staff Incharge:</b></label>
                          <select class="form-control collect-from" id="staff" name="staff">
                            <option value="" selected disabled hidden>Please select</option>
                            <?php
                              $users = User::where('role_id', '!=', 3)->get();

                              foreach ($users as $u)
                              {
                                  echo " <option>".$u->id."</option>";
                              }


                              ?>
                          </select>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" onclick="submitform()" class="btn btn-info"><b>Collect</b></button>
                      </div>
                    </div>
                  </div>
                </div>



            </tbody>
          </table>
        </div>


      <div class="col-md-6" style="height: 350px;overflow-y:scroll;>
        <div class="tile">
          <h3 class="tile-title">Incoming Products</h3>
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Id</th>
              <th>Product Name</th>
              <th>Reason</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $inTran = \DB::select('select booking_id as id,product_id as prod, booking_reason as bs from transactions WHERE booking_status  in ("collected") and End_Date=?',[date("Y-m-d")]);

            foreach($inTran as $t)
            {
                $prodname=\DB::select('select name from products where productID=?',[$t->prod]);
                echo "<tr><td>".$t->id."</td>";
                echo "<td>".$prodname[0]->name."</td>";
                echo "<td>".$t->bs."</td>";
                echo '<td>
                <button type="button" class="btn btn-primary" data-toggle="modal" onclick="updaterpnb('.$t->id.','.$t->prod.')" data-target="#exampleModalCenter1">
                  Return
                </button>
              </td></tr>';
            }

            $inTran = \DB::select('select count(*) as c from transactions WHERE booking_status  in ("collected") and End_Date=?',[date("Y-m-d")]);
            if($inTran[0]->c==0)
                {
                    echo "No Product Today";
                }



            ?>


            <script>
                function updaterpnb(x,y)
                {
                    document.getElementById("rprodID").value=y;
                    document.getElementById("rbookID").value=x;
                }
            </script>


                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Return product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="container">
                          <form class="form-horizontal" action="/collecting" method="post" id="returnfrom">
                            <div class="form-group">
                              {{ csrf_field() }}
                              <label class="control-label" for="prodID"><b>Product ID:</b></label>
                              <input type="prodID" class="form-control" id="rprodID" value="1" name="prodID" readonly>
                            </div>
                            <div class="form-group">
                              <label class="control-label" for="bookID"><b>Booking ID:</b></label>
                              <input type="bookID" class="form-control" id="rbookID" value="1" name="bookID" readonly>
                            </div>
                            <div class="form-group">
                              <label class="control-label" for="staff"><b>Staff Incharge:</b></label>
                              <select class="form-control" id="staff" name="staff">
                                <option value="" selected disabled hidden>Please select</option>
                                  <?php
                                  $users = User::where('role_id', '!=', 3)->get();

                                  foreach ($users as $u)
                                  {
                                      echo " <option>".$u->id."</option>";
                                  }


                                  ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label class="control-label" for="bookID"><b>Comments:</b></label>
                              <textarea class="form-control" rows="5" id="comment" name="comment" required></textarea>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" onclick="document.getElementById('returnfrom').submit();"class="btn btn-primary"><b>Return</b></button>
                        </div>
                      </div>
                    </div>
                  </div>
              </td>
            </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
    </div>
    @endsection
    @section('script')
      <script type="text/javascript">

          var data = {
              labels: ["January", "February", "March", "April", "May","June","July","August","September","October","November","December"],
              datasets: [
                  {
                      label: "My Second dataset",
                      fillColor: "rgba(151,187,205,0.2)",
                      strokeColor: "rgba(151,187,205,1)",
                      pointColor: "rgba(151,187,205,1)",
                      pointStrokeColor: "#fff",
                      pointHighlightFill: "#fff",
                      pointHighlightStroke: "rgba(151,187,205,1)",
                      data: [ <?php
                          $array = array(0,0,0,0,0,0,0,0,0,0,0,0);

                          $inTran=\DB::select('select Start_Date as sd from transactions');

                          foreach($inTran as $t)
                          {
                              $month = date("m",strtotime($t->sd));
                              $Year = date("Y",strtotime($t->sd));
                              $PresentYear = date("Y");
                              if($PresentYear==$Year)
                              {
                                  $array[$month-1]=$array[$month-1]+1;
                              }

                          }

                          foreach($array as $a)
                              {
                                  echo $a.",";
                              }

                          ?>]
                  }
              ]
          };

          var pdata = [
          <?php
              $inCatC=\DB::select('SELECT count(*) as cc,category as c FROM products group by category');

              foreach($inCatC as $c)
                  {
                      $catt=\DB::select('SELECT category from categories where id=?',[$c->c]);
                      echo '{
                  value: '.$c->cc.',
                  color:getRandomColor(),
                  highlight: getRandomColor(),
                  label: "'.$catt[0]->category.'"
              },';
                  }

              ?>
          // {
          //         value: 100,
          //         color:getRandomColor(),
          //         highlight: getRandomColor(),
          //         label: "Red"
          //     },
          //     {
          //         value: 50,
          //         color: getRandomColor(),
          //         highlight: getRandomColor(),
          //         label: "Green"
          //     },
          //     {
          //         value: 34,
          //         color: "#65ce3d",
          //         highlight: "#75f446",
          //         label: "Light"
          //     },
          //     {
          //         value: 80,
          //         color: "#ff0080",
          //         highlight: "#ff00ff",
          //         label: "Pink"
          //     },
          //     {
          //         value: 200,
          //         color: "#FDB45C",
          //         highlight: "#FFC870",
          //         label: "Yellow"
          //     }
          ]


          function getRandomColor() {
              var letters = '0123456789ABCDEF';
              var color = '#';
              for (var i = 0; i < 6; i++) {
                  color += letters[Math.floor(Math.random() * 16)];
              }
              return color;
          }

          var ctxb = $("#barChartDemo").get(0).getContext("2d");
          var barChart = new Chart(ctxb).Bar(data);

          var ctxp = $("#pieChartDemo").get(0).getContext("2d");
          var pieChart = new Chart(ctxp).Pie(pdata);

          function submitform(){
              method = "post";
              var form = document.createElement("form");
              form.setAttribute("method", method);
              form.setAttribute("action", "/insert");

              var x=document.getElementsByClassName("collect-from");
              try{
                  Array.prototype.forEach.call(x, i => {
                      var j=i.value;
                  if(j.length == 0)
                  {
                      i.focus();
                      throw "Enter all values";
                  }
                  var Field = document.createElement("input");
                  Field.setAttribute("type", "hidden");
                  Field.setAttribute("name", i.name);
                  Field.setAttribute("value", i.value);
                  form.appendChild(Field);
              });

                  var Field = document.createElement("input");
                  Field.setAttribute("type", "hidden");
                  Field.setAttribute("name", "_token");
                  Field.setAttribute("value", <?php echo "'".csrf_token()."'"; ?>);
                  form.appendChild(Field);
                  document.body.appendChild(form);
                  form.submit();
              }
              catch(err)
              {
                  alert(err);
              }
          }
      </script>
@endsection
