
 <link rel="stylesheet" href="http://demo.plusonetech.in/plusone/backend/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://demo.plusonetech.in/plusone/backend/dist/css/style-main.css">
        <link rel="stylesheet" href="http://demo.plusonetech.in/plusone/backend/dist/themes/blue/skins/skin-darkblue.css">
    <link rel="stylesheet" href="http://demo.plusonetech.in/plusone/backend/dist/themes/blue/ss-main-darkblue.css">
        <link rel="stylesheet" href="demo.plusonetech.in/plusone/backend/dist/css/jquery.mCustomScrollbar.min.css">
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
            <i class="fa fa-object-group"></i> Poll</h1>
    </section>
<section class="content">
<div class="row">
<div class="col-md-4">
<!-- Horizontal Form -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">Add/edit Poll</h3>
</div><!-- /.box-header -->
<!-- form start -->
<form id="form1" action="JavaScript:void(0)" name="employeeform" method="post" accept-charset="utf-8">

  <input type="hidden" name="id" id="id" value="@if(!empty($result1[0]->poll_id)){{$result1[0]->poll_id}}@endif">
<div class="box-body">
<input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
@if(!empty($result1[0]->id))
<h4 id="pole" class="" style="color: green;" hidden>Record Updated successfully</h4>
@else
<h4 id="pole" class="" style="color: green;" hidden>Record Inserted successfully</h4>
@endif

<!--<div class="form-group">
<label for="exampleInputEmail1">Class</label>
<select name="class_id" id="class_id" class="form-control" style="height: 30px; font-size: 13.3px;">
                          @if(isset($result1[0]->class_id) && $result1[0]->class_id != '')
                          
                          <option value="{{$result1[0]->class_id}}">{{$result1[0]->class_id}}</option>
                          @else
                          <option>Select Class</option>
                          @endif
                            
                        <option value="all">All class</option>
                          @foreach($classdata as $cdata)
                          @if($cdata->class != '')
                          <option value="{{$cdata->class}}">{{$cdata->class}}</option>
                          @endif
                          @endforeach
                        </select>
<span class="text-danger"></span>
</div>-->

<!--<div class="form-group">
<label for="exampleInputEmail1">Section</label>
<select name="section_id" id="section_id" class="form-control" style="height: 30px; font-size: 13.3px;">
                            @if(isset($result1[0]->section_id) && $result1[0]->section_id != '')
                         
                           <option value="{{$result1[0]->section_id}}" selected>{{$result1[0]->section_id}}</option>
                          @else
                          <option>Select Section</option>
                          @endif
                          <option value="all">All secions</option>
                          @foreach($sectiondata as $scdata)
                          @if($scdata->section != '')
                          <option value="{{$scdata->section}}">{{$scdata->section}}</option>
                          @endif
                          @endforeach
                        </select>
<span class="text-danger"></span>
</div>-->



<div class="form-group">
<label for="exampleInputEmail1">Title</label>
<input autofocus="" id="title" name="title" placeholder="" type="text" class="form-control" value="@if(!empty($result1[0]->title)){{$result1[0]->title}}@endif" autocomplete="off">
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Is Parent</label>
<select name="is_parent" id="is_parent" class="form-control" style="height: 30px; font-size: 13.3px;">
                            @if(isset($result1[0]->is_parent) && $result1[0]->is_parent != '')
                         
                           <option value="{{$result1[0]->is_parent}}" selected>{{$result1[0]->is_parent}}</option>
                          @else
                          <option>Select</option>
                          @endif
                          <option value="0">No</option>
                          <option value="1">Yes</option>
                         
                        </select>
<span class="text-danger"></span>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Is Teacher</label>
<select name="is_teacher" id="is_teacher" class="form-control" style="height: 30px; font-size: 13.3px;">
                            @if(isset($result1[0]->is_teacher) && $result1[0]->is_teacher != '')
                         
                           <option value="{{$result1[0]->is_teacher}}" selected>{{$result1[0]->is_teacher}}</option>
                          @else
                          <option>Select</option>
                          @endif
                          <option value="0">No</option>
                          <option value="1">Yes</option>
                         
                        </select>
<span class="text-danger"></span>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Is Student</label>
<select name="is_student" id="is_student" class="form-control" style="height: 30px; font-size: 13.3px;">
                            @if(isset($result1[0]->is_student) && $result1[0]->is_student != '')
                         
                           <option value="{{$result1[0]->is_student}}" selected>{{$result1[0]->is_student}}</option>
                          @else
                          <option>Select</option>
                          @endif
                          <option value="0">No</option>
                          <option value="1">Yes</option>
                         
                        </select>
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
<h3 class="box-title titlefix">Poll List</h3>
</div><!-- /.box-header -->
<div class="box-body">
<div class="mailbox-controls">
<div class="pull-right">
</div><!-- /.pull-right -->
</div>
<div class="table-responsive mailbox-messages">
<div class="download_label">Poll List</div>
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">

 <table class="table table-striped table-bordered table-hover example dataTable no-footer dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 715px;">
<thead>
<tr role="row"><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Room Number / Name: activate to sort column ascending">Title</th><th class="text-right no-print sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 50px;text-align: center;" aria-label="Action: activate to sort column ascending">Action</th></tr>
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
    <td valign="top"  class="">{{$data->title}}</td>
  
   
    <td>
          <a href="{{url('/poll/'.$data->poll_id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Edit" style="border: 0px solid transparent !important;"><i class="fa fa-pencil"></i>
      </a>
      <a href="{{url('/deletePoll/'.$data->poll_id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" style="border: 0px solid transparent !important;" title="Delete" onclick="return confirm('Delete Confirm?');"><i class="fa fa-remove"></i>
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
      var title = $('#title').val();
      var id = $('#id').val();
      var is_teacher = $('#is_teacher').val();
       var is_student = $('#is_student').val();
        var is_parent = $('#is_parent').val();
     
     
        //   $("#butsave").attr("disabled", "disabled");
          $.ajax({
              url: "{{url('/api/addUpdatePole')}}",
              type: "POST",
              data: {
                  _token: $("#csrf").val(),
                  title: title,
                  is_teacher: is_teacher,
                  id: id,
                  is_student: is_student,
                  is_parent: is_parent   
              },
              cache: false,
              success: function(dataResult){
                  console.log(dataResult);
              
                    $('#pole').fadeIn(); 
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