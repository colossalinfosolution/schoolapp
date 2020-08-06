
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
.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
     border: none !important;
}
label {
    
    font-weight: 500 !important;
}
@media (max-width: 750px)
{span.logo-lg img {
    width:11%;
    margin-left: -6px;
}
    
}
</style>

<section class="content">
<div class="row">
<div class="col-md-4">
<!-- Horizontal Form -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">Add E-Store Category</h3>
</div><!-- /.box-header -->
<!-- form start -->
<form id="form1" action="JavaScript:void(0)" name="employeeform" method="post" accept-charset="utf-8">
<div class="box-body">
<input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">

<h3 id="success" class="" style="color: green;" hidden>Category Inserted successfully</h3>
<div class="form-group">
<label for="exampleInputEmail1">Category Name</label><small class="req"> *</small>
<input autofocus="" id="name" name="name" placeholder="" type="text" class="form-control" value="" autocomplete="off">
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Category Code</label><small class="req"> *</small>
<input id="code" name="code" placeholder="" type="text" class="form-control" value="">
<span class="text-danger"></span>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Description</label>
<textarea class="form-control" id="description" name="description" placeholder="" rows="3"></textarea>
<span class="text-danger"></span>
</div>
</div><!-- /.box-body -->
<div class="box-footer">
<button type="submit" id="butsave" class="btn btn-info pull-right">Save</button>
</div>
</form>
</div>

</div><!--/.col (right) -->
<!-- left column -->
<div class="col-md-8">
<!-- general form elements -->
<div class="box box-primary" id="hroom">
<div class="box-header ptbnull">
<h3 class="box-title titlefix">Category List</h3>
</div><!-- /.box-header -->
<div class="box-body">
<div class="mailbox-controls">
<div class="pull-right">
</div><!-- /.pull-right -->
</div>
<div class="table-responsive mailbox-messages">
<div class="download_label">Categoty List</div>
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
   
            <table class="table table-striped table-bordered table-hover example dataTable no-footer dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 715px;">
<thead>
<tr role="row"><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 181px;" aria-label="Room Number / Name: activate to sort column ascending">Category Name</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 65px;" aria-label="Hostel: activate to sort column ascending">Code</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Room Type: activate to sort column ascending">Description</th><th class="text-right no-print sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 48px;" aria-label="Action: activate to sort column ascending">Action</th></tr>
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
    <td valign="top"  class="">{{$data->name}} 
    </td>
     <td valign="top"  class="">{{$data->code}} 
    </td>
     <td valign="top" class="">{{$data->description}} 
    </td>
    <td><a href="{{url('/editCategory/'.$data->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Edit" style="border: 0px solid transparent !important;"><i class="fa fa-pencil"></i>
      </a>
      <a href="{{url('/deleteCategory/'.$data->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" style="border: 0px solid transparent !important;" title="Delete" onclick="return confirm('Delete Confirm?');"><i class="fa fa-remove"></i>
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
</div><!--/.col (left) -->
<!-- right column -->

</div>
<div class="row">
<div class="col-md-12">
</div><!--/.col (right) -->
</div>   <!-- /.row -->
</section>


<script>
$(document).ready(function() {
   
    $('#butsave').on('click', function() {
      var name = $('#name').val();
      var code = $('#code').val();
      var description = $('#description').val();
     
      if(name!="" && code!="" && description!=""){
        //   $("#butsave").attr("disabled", "disabled");
          $.ajax({
              url: "{{url('/api/estore/insertCategory')}}",
              type: "POST",
              data: {
                  _token: $("#csrf").val(),
                  name: name,
                  code: code,
                  description: description
                 
              },
              cache: false,
              success: function(dataResult){
                  console.log(dataResult);
                
                    $('#success').fadeIn(); 
                    setTimeout(function () { document.location.reload(true); }, 3000);
                  var dataResult = JSON.parse(dataResult);
                  if(dataResult.statusCode==200){
                      
                  }
                  else if(dataResult.statusCode==201){
                     alert("Error occured !");
                  }
                  
              }
          });
      }
      else{
          alert('Please fill all the field !');
      }
  });
});
</script>