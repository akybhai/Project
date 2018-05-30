@extends('layouts.app')
@section('content')
<style>
    .grid {
    /* Grid Fallback */
    display: flex;
    flex-wrap: wrap;

    /* Supports Grid */
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    grid-auto-rows: minmax(150px, auto);
    grid-gap: 1em;
    }

    .module {
        -webkit-box-sizing: content-box;
        -moz-box-sizing: content-box;
        box-sizing: content-box;
        cursor: pointer;
        border: none;
        font: normal 30px/normal "Passero One", Helvetica, sans-serif;
        color: rgba(255,255,255,1);
        text-align: center;
        -o-text-overflow: clip;
        text-overflow: clip;



        /* Demo-Specific Styles */

        display: flex;
        align-items: center;
        justify-content: center;
        height: 130px;
        cursor: pointer;

        /* Flex Fallback */
        margin-left: 5px;
        margin-right: 5px;
        flex: 1 1 200px;
    }

    /* If Grid is supported, remove the margin we set for the fallback */
    @supports (display: grid) {
        .module {
            margin: 0;
        }
    }

    /* If Grid is supported, remove the margin we set for the fallback */
    @supports (display: grid) {
    .module {
    margin: 0;
    }
    }

    /* On screens that are 1500px or less, set the background color to blue */
    @media screen and (max-width: 1500px) {
        #Leftpane {
            padding-top: 50px;
        }
    }

    /* On screens that are 992px or less, set the background color to blue */
    @media screen and (max-width: 992px) {
        #Leftpane {
            padding-top: 30px;
        }
    }

    /* On screens that are 760px or less, set the background color to olive */
    @media screen and (max-width: 760px) {
        #Leftpane {
            padding-top: 10px;
        }
    }
    </style>

<link rel="stylesheet" href="sa/css/bootstrap.css">


<script type="text/javascript" src="sa/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

    <div class="fluid-container">
        <div id="SectionPage" class="row grid-divider ">
            <div id="Leftpane" class="col-sm-3" style="min-height:1230">
                <div class="innerclass">

                    <center>
                        <h2><i>NUIG Societies Inventory Bookings</i></h2>
                        <h4>Book the inventory from the SocsBox in Easy steps: <br><br>
                            <ul class="list-group" style="padding:10px">
                                <li class="list-group-item"> <span class="badge badge-primary badge-pill">1</span>Select Suitable Category</li>
                                <li class="list-group-item"> <span class="badge badge-primary badge-pill">2</span>Select Product</li>
                                <li class="list-group-item"> <span class="badge badge-primary badge-pill">3</span>View Product Description</li>
                                <li class="list-group-item"> <span class="badge badge-primary badge-pill">4</span>Check Availability</li>
                                <li class="list-group-item"> <span class="badge badge-primary badge-pill">5</span>Add Product to Cart</li>
                                <li class="list-group-item"> <span class="badge badge-primary badge-pill">6</span>Goto Cart Page</li>
                            </ul>
                        </h4>
                    </center>
                </div>
            </div>
            <script>

                var catRequest;  // The variable that makes Ajax possible!


                try {
                    // Opera 8.0+, Firefox, Safari
                    catRequest = new XMLHttpRequest();
                } catch (e) {
                    // Internet Explorer Browsers
                    try {
                        catRequest = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        try {
                            catRequest = new ActiveXObject("Microsoft.XMLHTTP");

                        }
                        finally {
                        }
                    }
                }
                finally {
                }

                catRequest.onreadystatechange = function () {
                    if (catRequest.readyState == 4) {
                        var ajaxDisplay = document.getElementById('catgrid');
                        ajaxDisplay.innerHTML =  catRequest.responseText;

                        var ancestor = document.getElementById('catgrid'),
                            descendents = ancestor.getElementsByTagName('*');

                        var i, e, d;
                        for (i = 0; i < descendents.length; ++i) {
                            e = descendents[i];
                            e.style.background= getRandomColor();

                        }




                    }
                }


                function getRandomColor() {
                    var letters = ['#FF8F00','#EF6C00','#4DB6AC','#4DD0E1','#00ACC1','#00897B','#00838F','#00695C','#FFC400','#FF9100'];

                    return letters[Math.floor(Math.random() * 10)];

                }

                window.onload =function()
                {
                    catRequest.open("GET", "/getCat", true);
                    catRequest.send(null);

                }
                var cat;

                var prodRequest;  // The variable that makes Ajax possible!


                try {
                    // Opera 8.0+, Firefox, Safari
                    prodRequest = new XMLHttpRequest();
                } catch (e) {
                    // Internet Explorer Browsers
                    try {
                        prodRequest = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        try {
                            prodRequest = new ActiveXObject("Microsoft.XMLHTTP");

                        }
                        finally {
                        }
                    }
                }
                finally {
                }

                prodRequest.onreadystatechange = function () {
                    if (prodRequest.readyState == 4) {
                        var prodDisplay = document.getElementById('ProdBody');
                        prodDisplay.innerHTML = prodRequest.responseText;
                        $('#ProdTable').DataTable();
                    }
                }



                function catClick(el) {
                    $(".Cat").hide();
                    $(".Prod").show();
                    cat=el.innerHTML;

                    prodRequest.open("GET", "/getProd?category="+cat, true);
                    prodRequest.send(null);


                }



            </script>

            <div id="RightPane" class=" col-sm-5 col-sm-offset-2">
                <div class="Cat">
                    <center>
                        <h2>Select Suitable Category</h2>
                    </center>
                    <div class="grid" id="catgrid">

                    </div>
                </div>
            </div>




            <div id="RightPane2" class=" col-sm-8 ">
                <div class="Prod" style="display: none;">
                    <center>
                        <h2>Select Suitable Product</h2>
                    </center>
                    <table id="ProdTable" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th scope="col">Product Id</th>
                            <th scope="col">Name</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody id="ProdBody">
                        </tbody>
                        <tfoot>
                        <tr>
                            <th scope="col">Product Id</th>
                            <th scope="col">Name</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </tfoot>
                    </table>
                    <br>
                    <button type="button" class="btn btn-info btn-lg center-block" onclick="BackClick()" style="align-content: center">
                        <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                        GO BACK
                    </button>
                    <br><br>
                </div>


            </div>
            <script>
                function BackClick() {
                    $(".Cat").show();
                    $(".Prod").hide();
                }
            </script>
        </div>
    </div>

<style>
    #singleProductViewImg {
        display: block;
        margin: 0 auto;
    }
</style>


<!-- Modal QUick view -->
<div class="modal fade product_view" id="product_view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h3 class="modal-title">Product Details:</h3>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6" style="overlay:auto">
                        <img src="" class="img-responsive" style="height:300px;width:100%;" id="singleProductViewImg">
                    </div>
                    <div class="col-md-6 product_content " style="text-align: center">
                        <h4>Product Id: <span id="singleProductId"></span></h4>
                        <h4>Product Name: <span id="singleProductName"></span></h4>
                        <h4>Description</h4>
                        <p id="singleProductDescription"></p>

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-ground" align="middle">
                        <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Display single product view MODAL END --}}




<script>

    var prodid=0;

function proddescp(id)
{
    // ajax get call to single product
    var imgRoute = "/storage/cover_images/";

    $.ajax({
        type : 'GET',
        url : '/getProdviewsingle?productID='+id,
        dataType:'json',
        success:function(data){
            console.log(data);
            document.getElementById("singleProductId").innerHTML=data[0][0].id;
            document.getElementById("singleProductName").innerHTML=data[0][0].name;
            document.getElementById("singleProductDescription").innerHTML=data[0][0].description;

            $('#singleProductViewImg').attr('src',imgRoute + data[1]);


            // console.log();
        },
        error:function()
        {
            alert("fail");
        }
    });
}

function multiday(i)
{
    document.getElementById("mdb_success").innerHTML="Product is Available on below time slots"+
        "<div id=\"avadate\">\n" +
        "</div>";
    document.getElementById("mdb_fail").innerHTML="Product is Not available on this mentioned Date, Please change the Date for booking!!";

    document.getElementById("mdb_success_div").style.display = "none";
    document.getElementById("mdb_fail_div").style.display = "none";

    prodid=i;
}


</script>

      {{--multi day modal--}}
<div class="modal fade" id="multidaymodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h3 class="modal-title">Product Availability:</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">From Date</th>
                        <th scope="col">From Time</th>
                        <th scope="col">To Date</th>
                        <th scope="col">To Time</th>
                        <th scope="col"></th>
                    </tr>

                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <input class="form-control" type="date"  id="mdb_from_date" name="mdb_from_date" required>
                        </td>
                        <td>
                            <input class="form-control" type="time"  id="mdb_fromtime" name="mdb_fromtime" required>
                        </td>
                        <td>
                            <input class="form-control" type="date" id="mdb_to_date" name="mdb_to_date" required>
                        </td>
                        <td>
                            <input class="form-control" type="time"  id="mdb_totime" name="mdb_totime" required>
                        </td>
                        <td><button type="button" class="btn btn-primary"  id="mdb_cart">Check</button></td>

                    </tr>
                    </tbody>

                </table>
                <div class="Success1" id="mdb_success_div" >
                    <div class="alert alert-success" role="alert" id="mdb_success">
                        Product is Available on below time slots
                        <div id="avadate">
                        </div>
                    </div>
                </div>
                <div class="Failure1" id="mdb_fail_div" >
                    <div class="alert alert-danger" role="alert" id="mdb_fail">

                        Product is Not available on selected Dates, Please change the Date for booking!!

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>



    $(document).ready(function(){
        $("#mdb_cart").click(function(e){
            e.preventDefault();


            var a = new Date($('input[name="mdb_to_date"]').val());
            var b = new Date($('input[name="mdb_from_date"]').val());

            var at=$('input[name="mdb_fromtime"]').val();
            var bt=$('input[name="mdb_totime"]').val();

            if(a=="" || b=="" || at=="" || bt=="")
            {
                alert("All Field must be filled out");
                return false;

            }
            var date = new Date();
            check =date.setDate(date.getDate() -1)

            check_time=date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();

             if(b> check ) {


                if (a.getTime() === b.getTime()) {
                    if (at > bt) {
                        alert("From Time should be less than To Time")
                    }
                    else {
                        avafunction();
                    }
                }
                else if (a.getTime() > b.getTime()) {
                    avafunction();
                }
                else {
                    alert("From Date should be less than To Date")
                }

            }
            else
                {
                    alert("Cannot book for pervious dates and time");
                }
        });
    });

    function avafunction()
    {
        $.ajax({type: "GET",
            url: "/getava?prodid="+prodid+"&todate="+$('input[name="mdb_to_date"]').val()+"&fromdate="+$('input[name="mdb_from_date"]').val()+"&fromtime="+$('input[name="mdb_fromtime"]').val()+"&totime="+$('input[name="mdb_totime"]').val(),
            dataType: 'json',
            success:function(result){

                document.getElementById("mdb_success_div").style.display = "none";
                document.getElementById("mdb_fail_div").style.display = "none";

                document.getElementById("avadate").innerHTML="";

                if(result[0].length) {
                    document.getElementById("mdb_success_div").style.display = "block";

                    var datesprint = "";
                    result[0].forEach(function (item, index) {
                        if (index % 2 == 0) {
                            datesprint = datesprint + "<li>" + item + " to ";
                        }
                        else {
                            datesprint = datesprint + item + "</il> \n ";
                        }

                    });
                    if(result[1])
                    {
                    datesprint = datesprint + "<p></p><p>(Product with ID-"+result[1]+" has better availability)</p>";
                  }

                  datesprint = datesprint +  "<hr><button type=\"button\" class=\"btn btn-primary\"  data-dismiss=\"modal\" onclick='addtocart(\"" + result[0] + "\")'>Add to Cart</button>";

                    document.getElementById("avadate").innerHTML = datesprint;
                }
                else
                {
                  datesprint=""
                  if(result[1])
                  {
                  datesprint ="<p></p><p>(Product with ID-"+result[1]+" has better availability)</p>";
                }
                document.getElementById("mdb_fail").innerHTML = "Product is Not available on selected Dates, Please change the Date for booking!!"+ datesprint;
                    document.getElementById("mdb_fail_div").style.display = "block";
                }



            }});
    }


    function addtocart(values)
    {

            $.ajax({
            type: "POST",

            url: '/addtocart',
            data: {'ProdId':prodid,'Dates': values,_token: '{{csrf_token()}}'},
            success: function( msg ) {
            if(msg)
            {
            alert("Added to Cart");
            console.log(msg);
            }
            else
            {
            alert("Request not proceed");
            }

            },
            error: function()
            {
            alert("Request not proceed");
            }
            });

    }

</script>

    {{--end of multi day modal--}}
@endsection
@section('script')


@endsection
