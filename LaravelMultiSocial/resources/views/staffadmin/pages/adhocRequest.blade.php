@extends('staffadmin.layouts.app')

@section('admincontent')

<div class="container">
  <div class="row">
    <div class="col-md-offset-2 col-md-6">
      <form class="form-horizontal" id="productDetailsForm">
        <div class="form-group">
          <label class="col-md-2 control-label">ProductID:</label>
          <div class="col-md-3">
              <input type="text" class="form-control"  name="productID" id="productID">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label">From Date:</label>
          <div class="col-md-3">
              <input type="date" name="fromDate" id="fromDate">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label">From Time:</label>
          <div class="col-md-3">
              <input type="time" name="fromTime" id="fromTime">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label">Till Date:</label>
          <div class="col-md-3">
              <input type="date" name="tillDate" id="tillDate">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label">Till Time:</label>
          <div class="col-md-3">
              <input type="time" name="tillTime" id="tillTime">
          </div>
        </div>

        <button class="btn btn-primary btn-lg" type="button" name="button" id="checkAvail">Check Availibility</button>
      </form>
    </div>
    <div class="col-md-offset-2 col-md-6" style="display:none;" id="userDetails">
      <form class="form-horizontal" id="userDetailsForm">
        <div class="form-group">
          <label class="col-md-2 control-label">Username:</label>
          <div class="col-md-5">
              <input type="text" class="form-control"  name="userName" id="userName" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label">Mobile No:</label>
          <div class="col-md-3">
              <input type="tel" name="userMob" id="userMob" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label">Society:</label>
          <div class="col-md-3">
              <input type="text" name="userSoc" id="userSoc" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label">Event:</label>
          <div class="col-md-3">
              <input type="text" name="userEvent" id="userEvent" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label">Description:</label>
          <div class="col-md-3">
            <textarea name="userDecription" id="userDecription" rows="5" cols="50" required></textarea>
          </div>
        </div>
        <button class="btn btn-warning btn-lg" type="button" name="button" onclick="bookProduct()">Book</button>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="Success1" id="mdb_success_div" style="display:none;">
        <div class="alert alert-success" role="alert" id="mdb_success">
            Product is Available on below time slots
            <div id="avadate">
            </div>
        </div>
    </div>
    <div class="Failure1" id="mdb_fail_div" style="display:none;">
        <div class="alert alert-danger" role="alert" id="mdb_fail">

            Product is Not available on selected Dates, Please change the Date for booking!!

        </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
var datesAvailable = []
$(document).ready(function(){
  // click on check availibilty button
    $("#checkAvail").click(function(e){
        e.preventDefault();


        var a = new Date($('input[name="tillDate"]').val());
        var b = new Date($('input[name="fromDate"]').val());

        var at=$('input[name="fromTime"]').val();
        var bt=$('input[name="tillTime"]').val();

        if(a=="" || b=="" || at=="" || bt=="")
        {
            alert("All Field must be filled out");
            return false;

        }
        var date = new Date();
        console.log(b);
        check =date.setDate(date.getDate() -1)
        console.log(check);
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
//function to check the availibilty
function avafunction()
{
  // add the code to check if the product ID is valid
    $.ajax({type: "GET",
        url: "/getava?prodid="+$('input[name="productID"]').val()+"&todate="+$('input[name="tillDate"]').val()+"&fromdate="+$('input[name="fromDate"]').val()+"&fromtime="+$('input[name="fromTime"]').val()+"&totime="+$('input[name="tillTime"]').val(),
        dataType: 'json',
        success:function(result){

            document.getElementById("mdb_success_div").style.display = "none";
            document.getElementById("mdb_fail_div").style.display = "none";

            document.getElementById("avadate").innerHTML="";

            if(result[0].length) {
                document.getElementById("mdb_success_div").style.display = "block";

                var datesprint = "";
                result[0].forEach(function (item, index) {
                    datesAvailable.push(item);
                    if (index % 2 == 0) {
                        datesprint = datesprint + "<li>" + item + " to ";
                    }
                    else {
                        datesprint = datesprint + item + "</li> \n ";
                    }

                });
                if(result[1])
                {
                datesprint = datesprint + "<p></p><p>(Product with ID-"+result[1]+" has better availability)</p>";
              }

              datesprint = datesprint +  "<hr><button type=\"button\" id=\"addToCart\" class=\"btn btn-primary\"  data-dismiss=\"modal\" onclick='addtocart(\"" + result[0] + "\")'>Add to Cart</button>";

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

// function to get details prior to booking
function addtocart(values)
{
  // Disable the add to cart Button
  //document.getElementById("addToCart").style.display = "block";

document.getElementById("userDetails").style.display = "block";
// Check if all the detials are entered properly
}
//function to book Product
function bookProduct()
{

  // get the value
  var productID  = $('input[name="productID"]').val();
  var username = $('input[name="userName"]').val();
  var usermobNo = $('input[name="userMob"]').val();
  var userSociety = $('input[name="userSoc"]').val();
  var userEvent = $('input[name="userEvent"]').val();
  var userReason = $('#userDecription').val();
  // check if the Value is blank
  if(username == '' || usermobNo == '' || userSociety == '' || userEvent == '')
  {
      console.log("Welcome");
  }
  // function to build a json array

  // The JSON Cart Details to be sent
  var cartdetails = {"cart":[]};

  // prepare json
  var i;
  for (i = 0; i < datesAvailable.length - 1; i=i+2) {

    // CART DETAILS
    cartdetails.cart.push({
	     "userId": {{ Auth::id() }},
	     "productID": productID,
       "startDate": datesAvailable[i],
       "endDate": datesAvailable[i+1],
       "bookingStatus":"approved",
       "bookingReason": userReason
	     });
  }
  console.log(cartdetails);
  $.ajax({
  type : 'POST',
  url : '{{ url('/')}}/checkout',
  data:  {'cartdetails': cartdetails,_token: '{{csrf_token()}}'},
  dataType:'json',
  success:function(data){
    console.log(data);
    alert("Booking successfull");
    //reset
    cartdetails = {"cart":[]};
    datesAvailable = [];
    // set form
    document.getElementById("productDetailsForm").reset();
    document.getElementById("userDetailsForm").reset();
    document.getElementById("userDetailsForm").style.display = "none";
    // make the
    document.getElementById("mdb_success_div").style.display = "none";
    document.getElementById("mdb_fail_div").style.display = "none";
  }
  });


}



</script>
@endsection
