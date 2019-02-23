@extends('layouts.app')
@section('content')
<style type="text/css">
    select#topic_name {
    height: 35px;
}
</style>
<div class="container">
<div class="row">

<div class="col-md-6">
    <div class="">
        <div class=" margin-tb">
            <div class="">
                <h2>Search Article By Topic</h2>
            </div>
            
        </div>
    </div>

    <div class="form-group" id="select_li">
        <label>Select Topic</label>
        <select name="topic_name" class="form-control" id="topic_name">
            <option value="">Select Topic</option>
            <option value="Blockchain">Blockchain</option>
            <option value="IoT">IoT</option>
            <option value="DonaldTrump">Donald Trump</option>
        </select>
    </div>

</div>
   

<div class="col-md-6">
    
<h2>Search Article by Domain name and Date</h2>
<form method="POST" name="form_domainarticle" id="form_domainarticle" action="">
    <div class="form-group ">
        <label>Select Domain</label>
        <select name="domain" class="form-control" id="domain" required>
            <option value="">Select Domain</option>
            <option value="bbc.com">bbc.com</option>
            <option value="techcrunch.com">techcrunch.com</option>
            <option value="wsj.com">wsj.com</option>
        </select>
    </div>
    <div class="form-group ">
        <input type="text" class="form-control" name="date" id="date" required>
    </div>
    <div class="form-group">
        <!-- <button name="submit1" id="submit1">Submit</button> -->
        <input type="submit" name="submit1">
    </div>
</form>
</div>

</div>
</div>
 <div id='loadingmessage' style='display:none;'>
     <p>Loading...</p>
    </div>


    <div class="container">
        <div id="articles"></div>

    </div>
   
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script type="text/javascript">
    $(document).ready(function(){

     $("#topic_name").change(function(e){
        $('#loadingmessage').show();
        var topic =$(this).val();
        
e.preventDefault();
               $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
               $.ajax({
                  url: "{{ url('/getarticle') }}",
                  method: 'post',
                  dataType: 'json',
                  data: {
                     name: topic,
                     
                  },
                  success: function(result){
                    $('#loadingmessage').hide();
                     $('#articles').html(result.data);
                  }
              });

     });
 });
 </script>   


<script type="text/javascript">
    $(document).ready(function(){

     $("#submit1").click(function(e){
       

     });
 });
 </script> 


 <script>
$(function() {
  $('#date').daterangepicker();
});
</script>




<script type="text/javascript">
    $(document).ready(function(){

     $('#form_domainarticle').bootstrapValidator({

         fields:{

             domain:{
                 validators:{

                     notEmpty:{

                         message: 'Domain is required',
                     }
                 }
             },
             date:{
                 validators:{

                     notEmpty:{

                         message: 'Date is required',
                     }
                 }
             },
             
             
         }
     })
     .on('success.form.bv', function(e) {

    e.preventDefault();
         $('#loadingmessage').show();
        var domain =$('#domain').val();
        var date =$('#date').val();
        
               $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
               $.ajax({
                  url: "{{ url('/getarticlebydomain') }}",
                  method: 'post',
                  dataType: 'json',
                  data: {
                     domain: domain,
                     date: date,
                     
                  },
                  success: function(result){
                    $('#loadingmessage').hide();
                     $('#articles').html(result.data);
                  }
              });
     });
    })
</script>



@endsection