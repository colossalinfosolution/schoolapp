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

<section class="content">
<div class="row">
<div class="col-md-4">
<!-- Horizontal Form -->
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">Add Gallery</h3>
</div><!-- /.box-header -->
<!-- form start -->
<form id="form1" action="{{ route('gallery.upload') }}" name="employeeform" method="post" enctype="multipart/form-data">
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
        
<div class="form-group">
<label for="exampleInputEmail1">Class</label><small class="req"> *</small>
<select autofocus="" id="class_id" name="class" class="form-control" autocomplete="off">
   
<option value="">Select</option>
@foreach($classdata as $classdt) 
<option value="{{$classdt->class}}">{{$classdt->class}}</option>
@endforeach
</select>
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Section</label><small class="req"> *</small>
<select id="section_id" name="section" class="form-control">
    
<option value="">Select</option>
 @foreach($sectiondata as $sectiondt) 
<option value="{{$sectiondt->section}}">{{$sectiondt->section}}</option>
@endforeach
</select>
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Session</label><small class="req"> *</small>
<select id="session_id" name="session" class="form-control">
    

 @foreach($sessiondata as $sessiondt) 
<option value="{{$sessiondt->session}}">{{$sessiondt->session}}</option>
@endforeach
</select>
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Date</label><small class="req"> *</small>
<input id="date" name="date" placeholder="" type="date" class="form-control" value="">
<span class="text-danger"></span>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Title</label><small class="req"> *</small>
<input id="title" name="title" placeholder="" type="text" class="form-control" value="">
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Description</label>
<textarea class="form-control" id="description" name="description" placeholder="" rows="3"></textarea>
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="exampleInputEmail1">video url</label><small class="req"> *</small>
<input id="videos" name="videos" placeholder="" type="text" class="form-control" value="">
<span class="text-danger"></span>
</div>


<div class="form-group">
<label for="image">Image</label><small class="req"> *</small>
<input type="file" id="file" name="files[]" class="form-control" value="" style="opacity:1 !important;" multiple>
<span class="text-danger"></span>
</div>

</div><!-- /.box-body -->
<div class="box-footer">
<button type="submit" id="itemsave" class="btn btn-info pull-right">Save</button>
</div>
</form>
</div>

</div><!--/.col (right) -->
<!-- left column -->
<div class="col-md-8">
<!-- general form elements -->
<div class="box box-primary" id="hroom">
<div class="box-header ptbnull">
<h3 class="box-title titlefix">Gallery List</h3>
</div><!-- /.box-header -->
<div class="box-body">
<div class="mailbox-controls">
<div class="pull-right">
</div><!-- /.pull-right -->
</div>
<div class="table-responsive mailbox-messages">
<div class="download_label">Gallery List</div>
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
   
            <table class="table table-striped table-bordered table-hover example dataTable no-footer dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 715px;">
<thead>
<tr role="row"><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Room Type: activate to sort column ascending">Title</th>
    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Room Type: activate to sort column ascending">Images</th>
    <th class="text-right no-print sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 61px;" aria-label="Action: activate to sort column ascending">Action</th></tr>
</thead>
<tbody>
@if(empty($data1))
<tr class="odd">
    <td valign="top" colspan="6" class="dataTables_empty">No data available in table <br> <br>
        <img src="https://smart-school.in/ssappresource/images/addnewitem.svg" width="150"><br><br> 
        <span class="text-success bolds"><i class="fa fa-arrow-left">
            
        </i> Add new record or search with different criteria.</span>
    </td>
</tr>
@else
@foreach($data1 as $image)
<tr class="odd">
    
     <td valign="top" class="">{{$image['gallery']->title}}</td>
     <td>    
    @foreach($image['image'] as $photos)
    <img src="{{asset('uploads/'.$photos)}}" style="width: 40px; height: 30px;">
    @endforeach
</td>
    

    <td>
        <a href="{{url('/editGallery/'.$image['gallery']->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Edit" style="border: 0px solid transparent !important;"><i class="fa fa-pencil"></i>
      </a>
      <a href="{{url('/deleteGallery/'.$image['gallery']->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" style="border: 0px solid transparent !important;" title="Delete" onclick="return confirm('Delete Confirm?');"><i class="fa fa-remove"></i>
     </a>

    </td>
</tr>


@endforeach

@endif
</tbody>
</table>


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


