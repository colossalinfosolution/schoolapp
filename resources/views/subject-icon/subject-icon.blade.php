
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
@if(!empty($result1[0]->id))
<h3 class="box-title">Edit Subject Icon</h3>
@else
<h3 class="box-title">Add Subject Icon</h3>
@endif
</div><!-- /.box-header -->
<!-- form start -->
<form id="form1" action="JavaScript:void(0)" name="employeeform" method="post" enctype="multipart/form-data" >
<div class="box-body">

<input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
<input id="id" name="id" placeholder="" type="hidden" class="form-control" value="@if(!empty($result1[0]->sub_id)){{$result1[0]->sub_id}}@endif">
<h3 id="success" class="" style="color: green;" hidden>Item Inserted successfully</h3>

<div class="form-group">
<label for="exampleInputEmail1">Subjects</label><small class="req"> *</small>
              <select class="form-control" name="subject_id" id="subject_id"> 
                @if(!empty($result1[0]->name))
                <option value="{{$result1[0]->id}}" selected>{{$result1[0]->name}}</option>
                @else
                    <option value="" selected>Select subject</option>
                    @endif
                    @foreach($subject as $sub)
                    <option value="{{$sub->id}}">{{$sub->name}}</option>
                    @endforeach
                   
                </select>
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="image">Icon</label><br>
@foreach($icons as $icon)

<input type="radio" name="image" id="image" value="{{$icon->icons}}" style="margin: 1px;" @if($result[0]->subject_icon == $icon->icons) checked @endif>
&nbsp;
<img src="{{asset('uploads/icons'.$icon->icons)}}" style="height: 70; width: 95; margin: 14px;">


@endforeach

<span class="text-danger"></span>
</div>

<div class="box-footer">
<button type="submit" id="butsave" class="btn btn-info pull-right">Save</button>
</div>
</div>
</form>
</div>

</div><!--/.col (right) -->
<!-- left column -->
<div class="col-md-8">
<!-- general form elements -->
<div class="box box-primary" id="hroom">
<div class="box-header ptbnull">
<h3 class="box-title titlefix">Subject icon</h3>
</div><!-- /.box-header -->
<div class="box-body">
<div class="mailbox-controls">
<div class="pull-right">
</div><!-- /.pull-right -->
</div>
<div class="table-responsive mailbox-messages">
<div class="download_label">Subject icon</div>
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
   
            <table class="table table-striped table-bordered table-hover example dataTable no-footer dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 715px;">
<thead>
<tr role="row"><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 181px;" aria-label="Room Number / Name: activate to sort column ascending">Subject</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 65px;" aria-label="Hostel: activate to sort column ascending">Icon</th><th class="text-right no-print sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 48px;" aria-label="Action: activate to sort column ascending">Action</th></tr>
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
    <td valign="top" class=""><img src="{{asset('uploads/icons'.$data->subject_icon)}}" width="80" height="80"><br><br>
    </td>
     
    <td>
           <a href="{{url('/editSubjectIcons/'.$data->sub_id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Edit" style="border: 0px solid transparent !important;"><i class="fa fa-pencil"></i>
      </a>
      <a href="{{url('/deleteSubjectIcon/'.$data->sub_id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" style="border: 0px solid transparent !important;" title="Delete" onclick="return confirm('Delete Confirm?');"><i class="fa fa-remove"></i>
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
      var radio1=$('input[type="radio"]:checked').val();
  var image = $('input[name=image]:checked').val();

      
      var subject_id = $('#subject_id').val();
            var id = $('#id').val();
     
      if(image!="" && subject_id!=""){
        //   $("#butsave").attr("disabled", "disabled");
          $.ajax({
              url: "{{url('/api/InsertUpdateSubjectIcon')}}",
              type: "POST",
              data: {
                  _token: $("#csrf").val(),
                  image: image,
                  subject_id: subject_id,
                  id: id
                 
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