@extends('staffadmin.layouts.app')

@section('admincontent')

    <div class="app-title">
      <div>
        <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-6 col-lg-3">
          <a href="{{ url('/admin/userlist') }}"><div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
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
          </a>
      </div>
      <div class="col-md-6 col-lg-3">
          <a href="{{ url('/admin/userlist') }}"> <div class="widget-small info coloured-icon"><i class="icon fa fa-user-secret"></i>
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
          </a>
      </div>
      <div class="col-md-6 col-lg-3">
          <a href="{{ url('/admin/categories') }}"><div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
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
          </a>
      </div>
      <div class="col-md-6 col-lg-3">
          <a href="{{ url('admin/products') }}"><div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
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
          </a>
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
              <th></th>
            </tr>
            </thead>
            <tbody>


                <?php
                $inTran = \DB::select('select booking_id as id,product_id as prod, booking_reason as bs from transactions WHERE booking_status  in ("approved") and Date(Start_Date)=? order by Start_Date',[date("Y-m-d")]);

                foreach($inTran as $t)
                {
                    $prodname=\DB::select('select name,productID as id from products where productID=?',[$t->prod]);
                    echo "<tr><td>".$t->id."</td>";
                    echo '<td><a href="#"  data-toggle="modal" data-target="#product_view" class="pull-left singleProductView" onclick="singleProductViewFunc('.$prodname[0]->id.','.$t->id.')">'.$prodname[0]->name."</td>";
                    echo '<td>
                <button type="button" class="btn btn-info" data-toggle="modal" onclick="updatecpnb('.$t->id.','.$t->prod.')" data-target="#exampleModalCenter">
                  Collect
                </button>
              </td></tr>';
                }
                $inTran = \DB::select('select count(*) as c from transactions WHERE booking_status  in ("approved") and Date(Start_Date)=?',[date("Y-m-d")]);
                if($inTran[0]->c==0)
                {
                    echo "<td>No Products Today</td>";
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
                          <input type="prodID" class="form-control collect-from" value="0" id="cprodID" placeholder="Enter product ID" name="prodID" required>
                        </div>

                        <div class="form-group">
                          <label class="control-label" for="collectUserName"><b>Collector name:</b></label>
                          <input type="collectUserName"  class="form-control collect-from"  id="collectUserName" placeholder="Enter name of collector" name="collectUserName" required>
                        </div>

                        <div class="form-group">
                          <label class="control-label" for="mob"><b>Mobile no:</b></label>
                          <input type="mob"  class="form-control collect-from"  id="mob" placeholder="Enter mobile no." name="mob" required>
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
                                  echo " <option >".$u->name."</option>";
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
              <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $inTran = \DB::select('select booking_id as id,product_id as prod, booking_reason as bs from transactions WHERE booking_status  in ("collected") and Date(End_Date)=? order by End_Date',[date("Y-m-d")]);

            foreach($inTran as $t)
            {
                $prodname=\DB::select('select name,productID as id from products where productID=?',[$t->prod]);
                echo '<tr><td>'.$t->id."</td>";
                echo '<td><a href="#"  data-toggle="modal" data-target="#product_view"  class="pull-left singleProductView" onclick="singleProductViewFunc('.$prodname[0]->id.','.$t->id.')">'.$prodname[0]->name."</td>";
                echo '<td>
                <button type="button" class="btn btn-primary" data-toggle="modal" onclick="updaterpnb('.$t->id.','.$t->prod.')" data-target="#exampleModalCenter1">
                  Return
                </button>
              </td></tr>';
            }

            $inTran = \DB::select('select count(*) as c from transactions WHERE booking_status  in ("collected") and Date(End_Date)=?',[date("Y-m-d")]);
            if($inTran[0]->c==0)
                {
                    echo "<td>No Products Today</td>";
                }



            ?>


            <script>


                function updaterpnb(x,y)
                {
                    document.getElementById("rprodID").value=y;
                    document.getElementById("rbookID").value=x;
                }


                function singleProductViewFunc(id,tID)
                {
                    // ajax get call to single product
                    var imgRoute = "/storage/cover_images/";

                    $.ajax({
                        type : 'GET',
                        url : '/getProdviewsingledashboard?productID='+id+'&tran_ID='+tID,
                        dataType:'json',
                        success:function(data){
                            console.log(data);

                            document.getElementById("singleProductId").innerHTML=data[0][0].productID;
                            document.getElementById("singleProductName").innerHTML=data[0][0].name;
                            $('#singleProductViewImg').attr('src',imgRoute + data[1]);
                            document.getElementById("singleProductFromDate").innerHTML=data[2][0].start_date;
                            document.getElementById("singleProductToDate").innerHTML=data[2][0].end_date;
                            document.getElementById("singleProductBy").innerHTML=data[3][0].name+" ("+data[3][0].mobile+")";
                            document.getElementById("singleProductBookingReason").innerHTML=data[2][0].booking_reason;

                            // console.log();
                        },
                        error:function()
                        {
                            alert("fail");
                        }

                    });
                }
            </script>


            {{--Modal single product view --}}
            <div class="modal fade product_view" id="product_view">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <a href="#" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                            <h3 class="modal-title">Product Description</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6" style="overlay:auto">
                                    <img src="" class="img-responsive" style="height:300px;width:100%;" id="singleProductViewImg">
                                </div>
                                <div class="col-md-6 product_content">
                                    <h4>Product Id: <span id="singleProductId"></span></h4>
                                    <h4>Product Name: <span id="singleProductName"></span></h4>
                                    <h4>From: <span id="singleProductFromDate"></span></h4>
                                    <h4>To: <span id="singleProductToDate"></span></h4>
                                    <h4>Collected By: <span id="singleProductBy"></span></h4>
                                    <h3>Booking Reason</h3>
                                    <p id="singleProductBookingReason"></p>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="btn-ground" align="middle">
                                    <button type="button" data-dismiss="modal" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
{{--end of modal--}}
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
                                      echo " <option >".$u->name."</option>";
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

    <div class="row" >
    <div class="col-md-6">
        <div class="tile">
            <h3 class="tile-title">Monthly Bookings</h3>
            <div class="embed-responsive embed-responsive-16by9">
                <canvas class="embed-responsive-item" id="barChartDemo"></canvas>
            </div>
        </div>
    </div>

        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Products in each Categories</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
                </div>
            </div>
        </div>

    </div>




    <div class="row" >

        <div class="col-md-6" style="height: 350px;overflow-y:scroll;>
            <div class="tile">
        <h3 class="tile-title">Most Booked Products</h3>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Product Name</th>
                <th>Number of Bookings</th>
            </tr>
            </thead>

            <?php
            $inTran = \DB::select('select count(*) as c,name from transactions a, products b WHERE Date(Start_Date)>? and product_id=productID GROUP BY name ORDER BY c DESC ',[date("Y-m-d", strtotime("-3 months"))]);

            for($t=0;$t< count($inTran) and $t<3; $t++ )
            {

                echo '<tr><td>'.$inTran[$t]->name."</td>";
                echo "<td>".$inTran[$t]->c."</td>";
                echo '</tr>';
            }


            if(count($inTran)==0)
            {
                echo "Not Enough Data";
            }
            ?>
            <tbody>
            </tbody>
        </table>
    </div>

    <div class="col-md-6" style="height: 350px;overflow-y:scroll;>
        <div class="tile">
    <h3 class="tile-title">Today's Inventory </h3>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
        </tr>
        </thead>

        <?php
        $inTran = \DB::select('select count(*) as c,name from  products b where productID not in(select product_id from transactions a WHERE Date(Start_Date)<=? and Date(End_Date)>=? AND booking_status in ("approved")) GROUP BY name ORDER BY name ',[date("Y-m-d"),date("Y-m-d")]);

        for($t=0;$t< count($inTran); $t++ )
        {
            echo "<tr><td>".$inTran[$t]->name."</td>";
            echo "<td>".$inTran[$t]->c."</td>";
            echo '</tr>';
        }

        $inTran = \DB::select('select count(*) as c from products ');
        if($inTran[0]->c==0)
        {
            echo "Not Enough Data";
        }
        ?>
        <tbody>
        </tbody>
    </table>
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

          ]



          <?php
          $prod_name=\DB::select('select * from  products ');


          ?>


var prodidarray=[<?php
          for ($key=0;$key<count($prod_name);$key++)
          {
          echo $prod_name[$key]->productID.",";

          }
          ?>0];



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
                  if(i.name=="prodID")
                  {
                    var condi=1;
                      Array.prototype.forEach.call(prodidarray, prodi => {

                        if(prodi==i.value)
                        {
                          condi=0;
                        }


                      });
                      if(condi)
                      {
                        throw "Product Not in System";
                      }


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
