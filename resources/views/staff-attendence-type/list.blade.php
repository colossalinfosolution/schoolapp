
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
<h3 class="box-title">Edit Attendance Type</h3>
@else
<h3 class="box-title">Add Attendance Type</h3>
@endif
</div><!-- /.box-header -->
<!-- form start -->
<form id="form1" action="{{url('staffAttendenceTypeInsert')}}" name="employeeform" method="post" enctype="multipart/form-data">
<div class="box-body">
@csrf
@if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
       
        @endif
  
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
<input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
<input id="id" name="id" placeholder="" type="hidden" class="form-control" value="@if(!empty($result1[0]->id)){{$result1[0]->id}}@endif">

<div class="form-group">
<label for="exampleInputEmail1">Attendance type</label>
<input autofocus="" id="type" name="type" placeholder="" type="text" class="form-control" value="@if(!empty($result1[0]->type)){{$result1[0]->type}}@endif" autocomplete="off">
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Colour code</label>
<input id="code" name="code" placeholder="" type="text" class="form-control" value="@if(!empty($result1[0]->code)){{$result1[0]->code}}@endif" autocomplete="off">
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Key value</label>
<input autofocus="" id="key_value" name="key_value" placeholder="" type="text" class="form-control" value="@if(!empty($result1[0]->key_value)){{$result1[0]->key_value}}@endif" autocomplete="off">
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="image">Image</label><small class="req"> *</small>
<input type="file" id="image" name="image" class="form-control" value="@if(!empty($result1[0]->image)){{$result1[0]->image}}@endif" style="opacity:1 !important;">

@if(!empty($result1[0]->image))

<img src="{{asset('uploads/'.$result1[0]->image)}}" style="height: 90; width: 90;">
@endif

<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="is_active">Status</label><small class="req"> *</small>
              <select class="form-control" name="is_active" id="is_active">
                @if(!empty($result1[0]->is_active))
                <option value="{{$result1[0]->is_active}}" selected>{{$result1[0]->is_active}}</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
               @else
                <option value="yes" selected>Yes</option>
                <option value="no">No</option>
                @endif
                
                    
                </select>
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
<h3 class="box-title titlefix">Attendence type list</h3>
</div><!-- /.box-header -->
<div class="box-body">
<div class="mailbox-controls">
<div class="pull-right">
</div><!-- /.pull-right -->
</div>
<div class="table-responsive mailbox-messages">
<div class="download_label">Attendence type</div>
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
   
            <table class="table table-striped table-bordered table-hover example dataTable no-footer dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 715px;">
<thead>
<tr role="row">
  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 200px;" aria-label="Room Number / Name: activate to sort column ascending">Type</th>
  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 140px;" aria-label="Room Number / Name: activate to sort column ascending">Image</th>
  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 167px;" aria-label="Room Number / Name: activate to sort column ascending">Color Code</th>
  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 167px;" aria-label="Room Number / Name: activate to sort column ascending">key Value</th>
  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 124px;" aria-label="Hostel: activate to sort column ascending">Status</th>
  <th class="text-right no-print sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 66px;" aria-label="Action: activate to sort column ascending">Action</th>
</tr>
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
    <td valign="top"  class="">{{$data->type}} 
    </td>
    <td valign="top" class="" ><img src="{{asset('uploads/'.$data->image)}}" width="50" height="50"><br><br>
    </td>
    <td valign="top"  class="">{{$data->code}} 
    </td>
    <td valign="top"  class="">{{$data->key_value}} 
    </td>
     <td valign="top"  class="">{{$data->is_active}} 
    </td>
     
    <td>
      <a href="{{url('/editStaffAttendenceType/'.$data->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Edit" style="border: 0px solid transparent !important;"><i class="fa fa-pencil"></i>
      </a>
      <a href="{{url('/deleteStaffAttendenceType/'.$data->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" style="border: 0px solid transparent !important;" title="Delete" onclick="return confirm('Delete Confirm?');"><i class="fa fa-remove"></i>
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


