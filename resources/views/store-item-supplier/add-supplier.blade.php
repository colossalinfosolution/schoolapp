
 <link rel="stylesheet" href="http://demo.plusonetech.in/plusone/backend/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://demo.plusonetech.in/plusone/backend/dist/css/style-main.css">
        <link rel="stylesheet" href="http://demo.plusonetech.in/plusone/backend/dist/themes/blue/skins/skin-darkblue.css">
    <link rel="stylesheet" href="http://demo.plusonetech.in/plusone/backend/dist/themes/blue/ss-main-darkblue.css">
        <link rel="stylesheet" href="http://demo.plusonetech.in/plusone/backend/dist/css/jquery.mCustomScrollbar.min.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Style -->



        
       
<style>
    span.logo-lg img {
    width: 26%;
    margin-left: -6px;
}
label {
    
    font-weight: 500 !important;
}
.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
     border: none !important;
}
@media (max-width: 750px)
{span.logo-lg img {
    width:11%;
    margin-left: -6px;
}
    
}
</style>
<section class="content-header">
        <h1>
            <i class="fa fa-object-group"></i> Supplier</h1>
    </section>
<section class="content">
<div class="row">
<div class="col-md-4">
<!-- Horizontal Form -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">Add/edit supplier</h3>
</div><!-- /.box-header -->
<!-- form start -->
<form id="form1" action="JavaScript:void(0)" name="employeeform" method="post" accept-charset="utf-8">

  <input type="hidden" name="id" id="id" value="@if(!empty($result1[0]->id)){{$result1[0]->id}}@endif">
<div class="box-body">
<input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
@if(!empty($result1[0]->id))
<h3 id="supplier" class="" style="color: green;" hidden>Record Updated successfully</h3>
@else
<h3 id="supplier" class="" style="color: green;" hidden>Record Inserted successfully</h3>
@endif


<div class="form-group">
<label for="exampleInputEmail1">Name</label><small class="req"> *</small>
<input autofocus="" id="name" name="name" placeholder="" type="text" class="form-control" value="@if(!empty($result1[0]->name)){{$result1[0]->name}}@endif" autocomplete="off">
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="exampleInputPhone">Phone</label><small class="req"> *</small>
<input id="phone" name="phone" placeholder="" type="text" class="form-control" value="@if(!empty($result1[0]->phone)){{$result1[0]->phone}}@endif" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  />
<span class="text-danger"></span>
</div>


<div class="form-group">
<label for="exampleInputEmail1">Email</label><small class="req"> *</small>
<input id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="" type="email" class="form-control" value="@if(!empty($result1[0]->email)){{$result1[0]->email}}@endif">
<span class="text-danger"></span>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Address</label><small class="req"> *</small>
<input id="address" name="address" placeholder="" type="text" class="form-control" value="@if(!empty($result1[0]->address)){{$result1[0]->address}}@endif">
<span class="text-danger"></span>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Contact Person Name</label><small class="req"> *</small>
<input id="contact_person_name" name="contact_person_name" placeholder="" type="text" class="form-control" value="@if(!empty($result1[0]->contact_person_name)){{$result1[0]->contact_person_name}}@endif">
<span class="text-danger"></span>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Contact Person Email</label><small class="req"> *</small>
<input id="contact_person_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  name="contact_person_email" placeholder="" type="text" class="form-control" value="@if(!empty($result1[0]->contact_person_email)){{$result1[0]->contact_person_email}}@endif">
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="exampleInputPhone">Contact Person Phone</label><small class="req"> *</small>
<input id="contact_person_phone" name="contact_person_phone" type="text" class="form-control" value="@if(!empty($result1[0]->contact_person_phone)){{$result1[0]->contact_person_phone}}@endif" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="">
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Description</label>
<textarea class="form-control" id="description" name="description" placeholder="" value="@if(!empty($result1[0]->description)){{$result1[0]->description}}@endif" rows="3">@if(!empty($result1[0]->description)){{$result1[0]->description}}@endif</textarea>
<span class="text-danger"></span>
</div>
</div><!-- /.box-body -->
<div class="box-footer">
<button type="submit" id="butupdate" class="btn btn-info pull-right">Save</button>
</div>
</form>
</div>

</div><!--/.col (right) -->
<!-- left column -->
<!--/.col (left) -->
<!-- right column -->
<div class="col-md-8">
<!-- general form elements -->
<div class="box box-primary" id="hroom">
<div class="box-header ptbnull">
<h3 class="box-title titlefix">Supplier List</h3>
</div><!-- /.box-header -->
<div class="box-body">
<div class="mailbox-controls">
<div class="pull-right">
</div><!-- /.pull-right -->
</div>
<div class="table-responsive mailbox-messages">
<div class="download_label">Supplier List</div>
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
   
            <table class="table table-striped table-bordered table-hover example dataTable no-footer dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 715px;">
<thead>
<tr role="row"><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 181px;" aria-label="Room Number / Name: activate to sort column ascending">Name</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 65px;" aria-label="Hostel: activate to sort column ascending">Email</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Room Type: activate to sort column ascending">Phone</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Room Type: activate to sort column ascending">Address</th><th class="text-right no-print sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 48px;" aria-label="Action: activate to sort column ascending">Action</th></tr>
</thead>
<tbody>
@if(empty($result))
<tr class="odd">
    <td valign="top" colspan="6" class="dataTables_empty">No data available in table <br> <br>
        <img src="https://smart-school.in/ssappresource/images/addnewitem.svg" width="150"><br><br> 
        <span class="text-success bolds"><i class="fa fa-arrow-left">
            
        </i> Add new record or search with different criteria.</span>
    </td>
</tr>
@else
@foreach($result as $data)
<tr class="odd">
    <td valign="top"  class="">{{$data->name}}</td>
     <td valign="top"  class="">{{$data->email}}</td>
     <td valign="top" class="">{{$data->phone}}</td>
    <td valign="top"  class="">{{$data->address}}</td>
    <td>
          <a href="{{url('/supplier/'.$data->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Edit" style="border: 0px solid transparent !important;"><i class="fa fa-pencil"></i>
      </a>
      <a href="{{url('/deleteSupplier/'.$data->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" style="border: 0px solid transparent !important;" title="Delete" onclick="return confirm('Delete Confirm?');"><i class="fa fa-remove"></i>
     </a>

    
    </td>

</tr>
@endforeach
@endif
</tbody>
</table>
{{$result->links()}}
</div><!-- /.table -->
</div><!-- /.mail-box-messages -->
</div><!-- /.box-body -->
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
</div><!--/.col (right) -->
</div>   <!-- /.row -->
</section>




<script>

 

$(document).ready(function() {
   
    $('#butupdate').on('click', function() {
      var name = $('#name').val();
      var id = $('#id').val();
      var email = $('#email').val();
       var phone = $('#phone').val();
        var address = $('#address').val();
         var contact_person_name = $('#contact_person_name').val();
          var contact_person_phone = $('#contact_person_phone').val();
           var contact_person_email = $('#contact_person_email').val();
            var description = $('#description').val();
     
     
        //   $("#butsave").attr("disabled", "disabled");
          $.ajax({
              url: "{{url('/api/estore/addUpdateSupplier')}}",
              type: "POST",
              data: {
                  _token: $("#csrf").val(),
                  name: name,
                  email: email,
                  phone: phone,
                  description: description,
                  id: id,
                  address: address,
                  contact_person_phone: contact_person_phone,
                  contact_person_email: contact_person_email,
                  contact_person_name: contact_person_name 
                 
              },
              cache: false,
              success: function(dataResult){
                  console.log(dataResult);
              
                    $('#supplier').fadeIn(); 
                    setTimeout(function () { document.location.reload(true); }, 3000);
                  var dataResult = JSON.parse(dataResult);
                  if(dataResult.statusCode==200){
                      
                  }
                  else if(dataResult.statusCode==201){
                     alert("Error occured !");
                  }
                  
              }
          });
    
  });
});
</script>