@extends('layouts.app')
@section('content')


{{--<link rel="stylesheet" href="sa/css/bootstrap.css">--}}
<!-- jQuery -->
<script src="sa/jquery/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="sa/js/bootstrap.min.js"></script>
<style media="screen">

    .img-responsive {
        display: block;
        margin: 0 auto;
    }
    body, html {
        width: 100%;
        height: 100%;
        margin: 0;

    }

    .container1 {
        width: 100%;

    }

</style>

<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>



<div class="jumbotron" style="padding-top:20px;padding-bottom:20px;margin:0px;height:70%;">
    <div class="row" style="height:100%;">
        <div class="col-md-3" style="vertical-align:center">
            <div class='stepOne'>
                <h2  align="middle">Step 1</h2>
                <h4  align="middle">Select the dates for equipment booking: </h4>
                <div class="form-row">
                    <div class='col-sm-6'>
                        <form method="post">
                            <div class="form-group"> <!-- Date input -->
                                <label class="control-label" for="date">From Date:</label>
                                <!-- bc id same nahi ho sakte kabhi -->
                                <input class="form-control" id="fromDate" name="fromDate" placeholder="YYYY-MM-DD" type="text"/>
                            </div>
                        </form>
                    </div>
                    <div class='col-sm-6'>
                        <form method="post">
                            <div class="form-group"> <!-- Date input -->
                                <label>Till Date:</label>
                                <input class="form-control" id="toDate" name="toDate" placeholder="YYYY-MM-DD" type="text"/>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="form-group" align="middle"> <!-- Submit button -->
                    <button class="btn btn-primary" name="submit" type="submit" onclick="step1()">Next Step</button>
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
                                var ajaxDisplay = document.getElementById('highlight1');
                                ajaxDisplay.innerHTML =  catRequest.responseText;



                            }
                        }

                        //for Categories

                        function step1(){
                            if($('#fromDate').val() && $('#toDate').val() ){ //validation that the user has actually selected the dates.
                                var fromDate = $('#fromDate').val();
                                var toDate = $('#toDate').val();
                                $('.stepTwo').show();

                                catRequest.open("GET", "/getCat", true);
                                catRequest.send(null);
                            }
                        }
                    </script>
                </div>
            </div>
        </div>


        <div class='stepTwo' style="display:none">
            <div class="col-md-3" align="middle" style="padding:5px;">
                <h2  align="middle">Step 2</h2 >
                <h4 align="middle"> Please select equipment category:</h4>
                <div class="bs-component" style="height: 250px;overflow-y:scroll;">
                    <div class="list-group" id="highlight1">

                    </div>
                    <script type="text/javascript">
                        function hone(idval)
                        {
                            var x= document.getElementById("highlight1");
                            Array.prototype.forEach.call(x.children, i => {
                                i.classList.remove("active");});
                            var x= document.getElementById(idval);
                            x.classList.add("active");
                        };



                    </script>
                </div>
                <br>
                <div class="form-group" align="middle"> <!-- Submit button -->
                    <button class="btn btn-primary" name="submit" type="submit" onclick="step2()" align="middle">Next Step</button>
                    <script>

                        var cat;


                        //For Products

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


                        Element.prototype.remove = function() {
                            this.parentElement.removeChild(this);
                        }
                        NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
                            for(var i = this.length - 1; i >= 0; i--) {
                                if(this[i] && this[i].parentElement) {
                                    this[i].parentElement.removeChild(this[i]);
                                }
                            }
                        }

                        prodRequest.onreadystatechange = function () {
                            if (prodRequest.readyState == 4) {
                                var prodDisplay = document.getElementById('ProdList');
                                prodDisplay.innerHTML = prodRequest.responseText;



                            }
                        }

                        //for Products

                        function step2(){

                            //for step three replace the class name with rightpane...
                            var x= document.getElementById('highlight1').childNodes;

                            for(var i=0;i< x.length;i++)
                            {
                                if(typeof x[i].tagName != 'undefined') {
                                    if((' ' + x[i].className + ' ').indexOf(' ' + "active"+ ' ') > -1) {
                                        cat= x[i].innerText;

                                    }
                                }
                            }

                            if(typeof cat != 'undefined') {
                                $('.stepThree').show();
                                prodRequest.open("GET", "/getProd?category="+cat, true);
                                prodRequest.send(null);
                            }
                            else{
                                alert("No Category Selected");

                            }
                        }
                    </script>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class='stepThree' style="display:none">
                <h2  align="middle">Step 3</h2>

                <h4  align="middle">Please select the equipment: </h4>
                <!-- Code for products needs to be added here-->

                <table class="table table-hover table-bordered" id="productTable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Product Id</th>
                        <th scope="col">Check Availability</th>
                    </tr>
                    </thead>
                    <tbody id="ProdList">


                    </tbody>
                </table>
                <div id="AvaStyleScript">

                    <style>

                        /* The Modal (background) */
                        .modal {
                            display: none; /* Hidden by default */
                            position: fixed; /* Stay in place */
                            z-index: 1; /* Sit on top */
                            padding-top: 100px; /* Location of the box */
                            left: 0;
                            top: 0;
                            width: 100%; /* Full width */
                            height: 100%; /* Full height */
                            overflow: auto; /* Enable scroll if needed */
                            background-color: rgb(0,0,0); /* Fallback color */
                            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
                        }

                        /* Modal Content */
                        .modal-content {
                            background-color: #fefefe;
                            margin: auto;
                            padding: 20px;
                            border: 1px solid #888;
                            width: 80%;
                            max-height:80%;
                        }

                        /*Table responisvness*/
                        .table-responsive {
                            max-height:300px;
                        }

                        /* The Close Button */
                        .close {
                            color: #aaaaaa;
                            float: right;
                            font-size: 28px;
                            font-weight: bold;
                        }

                        .close:hover,
                        .close:focus {
                            color: #000;
                            text-decoration: none;
                            cursor: pointer;
                        }
                    </style>

                    <script>


                        function AllDateCheck()
                        {
                            if(document.getElementById("selectall").checked) {

                                var x =document.getElementById('AvaTable');

                                $.each( x.getElementsByTagName("input"), function( key, value ) {
                                    if(!value.disabled)
                                    {
                                        value.checked=true;
                                    }

                                });


                            }
                            else
                            {
                                var x =document.getElementById('AvaTable');

                                $.each( x.getElementsByTagName("input"), function( key, value ) {
                                    if(!value.disabled)
                                    {
                                        value.checked=false;
                                    }

                                });
                            }
                        }


                        function UpdateAllSelect()
                        {
                            document.getElementById("selectall").checked=true;
                            var x =document.getElementById('AvaTable');

                            $.each( x.getElementsByTagName("input"), function( key, value ) {
                                if(!value.disabled)
                                {
                                    if(!value.checked)
                                    {
                                        document.getElementById("selectall").checked=false;
                                    }
                                }

                            });
                        }

                        function AddtoCart()
                        {
                            var x =document.getElementById('AvaTable');
                            var Dates=[];
                            $.each( x.getElementsByTagName("input"), function( key, value ) {
                                if (!value.disabled) {
                                    if (value.checked)
                                    {
                                        Dates.push(value.name);
                                    }
                                }
                            });
                            $.ajax({
                                type: "POST",

                                url: '/addtocart',
                                data: {'ProdId':prodid,'Dates': Dates,_token: '{{csrf_token()}}'},
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
                                }
                            });
                            closemodal();
                        }
                    </script>

                </div>
                <div id="AvaModal">




                </div>
                <br>
                <div class="form-group" align="middle"> <!-- Submit button -->
                    <!-- <button class="btn btn-primary" name="submit" type="submit" formaction="#">Add to cart</button> -->
                  <!-- <button class="btn btn-primary" name="submit" type="submit" onclick="step3()">Back</button> -->
                    <script>
                        function step3(){
                            $('.stepThree').hide(); //for step three replace the class name with rightpane...
                        }

                        var avaRequest;  // The variable that makes Ajax possible!


                        try {
                            // Opera 8.0+, Firefox, Safari
                            avaRequest = new XMLHttpRequest();
                        } catch (e) {
                            // Internet Explorer Browsers
                            try {
                                avaRequest = new ActiveXObject("Msxml2.XMLHTTP");
                            } catch (e) {
                                try {
                                    avaRequest = new ActiveXObject("Microsoft.XMLHTTP");

                                }
                                finally {
                                }
                            }
                        }
                        finally {
                        }

                        var prodid=0;
                        var modal;
                        avaRequest.onreadystatechange = function () {
                            if (avaRequest.readyState == 4) {
                                var avaDisplay = document.getElementById('AvaModal');
                                avaDisplay.innerHTML = avaRequest.responseText;

                                modal=document.getElementById(document.getElementById('AvaModal').childNodes[0].id);

                                modal.style.display = "block";



                            }
                        }

                        function viewprod(i)
                        {
                            prodid=i;
                            avaRequest.open("GET", "/getava?prodid="+prodid+"&todate="+$('input[name="toDate"]').val()+"&fromdate="+$('input[name="fromDate"]').val(), true);
                            avaRequest.send(null);

                        }

                        // When the user clicks on <span> (x), close the modal
                        function closemodal()
                        {
                            modal.style.display = "none";
                        }

                        // When the user clicks anywhere outside of the modal, close it
                        window.onclick = function(event) {
                            if (event.target == modal) {
                                modal.style.display = "none";
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>




<!--Datepicker script -->
<script>
    $(document).ready(function(){
        var date_input=$('input[name="date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        var options={
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        };

        function addDays(days) {
            var dat = new Date(this.valueOf());
            dat.setDate(dat.getDate() + days);
            return dat;
        }

        $('input[name="fromDate"]').datepicker(options);
        $('input[name="fromDate"]').datepicker().on('changeDate', function () {


            if(!(Date.parse($('input[name="fromDate"]').val())<=Date.parse($('input[name="toDate"]').val())))
            {
                document.getElementById('toDate').value=$('input[name="fromDate"]').val();
            }


        });




        $('input[name="toDate"]').datepicker(options);
        $('input[name="toDate"]').datepicker().on('changeDate', function () {


            if(!(Date.parse($('input[name="fromDate"]').val())<=Date.parse($('input[name="toDate"]').val())))
            {
                document.getElementById('fromDate').value=$('input[name="toDate"]').val();
            }




        });
    })
</script>
<!-- Datepicker script ends-->


@endsection
@section('script')
    {{--<script type="text/javascript" src="sa/js/plugins/jquery.dataTables.min.js"></script>--}}
    {{--<script type="text/javascript" src="sa/js/plugins/dataTables.bootstrap.min.js"></script>--}}
    {{--<script type="text/javascript">$('#productTable').DataTable();</script>--}}

@endsection
