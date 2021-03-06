
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
<h3 class="box-title">Edit Leave Type</h3>
@else
<h3 class="box-title">Add Leave Type</h3>
@endif
</div><!-- /.box-header -->
<!-- form start -->
<form id="form1" action="{{url('insertUpdateleaveTypes')}}" name="form1" method="post" enctype="multipart/form-data">
<div class="box-body">
@csrf
@if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
       
        @endif

<input id="id" name="id" placeholder="" type="hidden" class="form-control" value="@if(!empty($result1[0]->id)){{$result1[0]->id}}@endif">
<h3 id="success" class="" style="color: green;" hidden>Leave Type Inserted successfully</h3>
<div class="form-group">
<label for="exampleInputEmail1">Leave type</label><small class="req"> *</small>
<input autofocus="" id="type" name="type" placeholder="" type="text" class="form-control" value="@if(!empty($result1[0]->type)){{$result1[0]->type}}@endif" autocomplete="off">
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

<div class="form-group">
<label for="image">Icon</label><br>
<input type="file" name="image" id="image" value="@if(!empty($result1[0]->leave_icon)){{$result1[0]->leave_icon}}@endif" style="margin: 1px; opacity: 1;">
@if(!empty($result1[0]->leave_icon))
<img src="{{asset('uploads/'.$result1[0]->leave_icon)}}" style="height: 65; width: 75; margin: 14px;">
@endif
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
<h3 class="box-title titlefix">Leave type list</h3>
</div><!-- /.box-header -->
<div class="box-body">
<div class="mailbox-controls">
<div class="pull-right">
</div><!-- /.pull-right -->
</div>
<div class="table-responsive mailbox-messages">
<div class="download_label">Leave type</div>
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
   
            <table class="table table-striped table-bordered table-hover example dataTable no-footer dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 715px;">
<thead>
<tr role="row"><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 181px;" aria-label="Room Number / Name: activate to sort column ascending">Type</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 181px;" aria-label="Room Number / Name: activate to sort column ascending">Icon</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 65px;" aria-label="Hostel: activate to sort column ascending">Status</th><th class="text-right no-print sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 48px;text-align: center;" aria-label="Action: activate to sort column ascending">Action</th></tr>
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
    <td valign="top" class=""><img src="{{asset('uploads/'.$data->leave_icon)}}" width="80" height="80"><br><br>
    </td>
     <td valign="top"  class="">{{$data->is_active}} 
    </td>
     
    <td>
        <a href="{{url('/editleaveType/'.$data->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Edit" style="border: 0px solid transparent !important;"><i class="fa fa-pencil"></i>
      </a>
      <a href="{{url('/deleteleaveType/'.$data->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" style="border: 0px solid transparent !important;" title="Delete" onclick="return confirm('Delete Confirm?');"><i class="fa fa-remove"></i>
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


