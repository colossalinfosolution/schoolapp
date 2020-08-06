
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
<div class="col-md-3">
<!-- Horizontal Form -->
<div class="box box-primary">
<div class="box-header with-border">
@if(!empty($result1[0]->subject_book_id))
<h3 class="box-title">Edit Books</h3>
@else
<h3 class="box-title">Add Books</h3>
@endif
</div><!-- /.box-header -->
<!-- form start -->
<form id="form1" action="{{url('InsertUpdateSubjectBook')}}" name="employeeform" method="post" enctype="multipart/form-data">
<div class="box-body">
@csrf
@if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
       
        @endif
<input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
<input id="id" name="id" placeholder="" type="hidden" class="form-control" value="@if(!empty($result1[0]->subject_book_id)){{$result1[0]->subject_book_id}}@endif">

<div class="form-group">
<label for="subject_id">Subject</label>
              <select class="form-control" name="subject_id" id="subject_id">
                @if(!empty($result1[0]->subject_id))
                <option value="{{$result1[0]->subject_id}}" selected>{{$result1[0]->name}}</option>
                @foreach($subject as $subjects)
                <option value="{{$subjects->id}}">{{$subjects->name}}</option>
                @endforeach
               @else
                <option value="" selected>Select Subject</option>
                @foreach($subject as $subjects)
                <option value="{{$subjects->id}}">{{$subjects->name}}</option>
                @endforeach
                @endif
                
                    
                </select>
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="class_id">Class</label>
              <select class="form-control" name="class_id" id="class_id">
                @if(!empty($result1[0]->class))
                <option value="{{$result1[0]->class_id}}" selected>{{$result1[0]->class}}</option>
                @foreach($class as $classess)
                <option value="{{$classess->id}}">{{$classess->class}}</option>
                @endforeach
               @else
                <option value="" selected>Select Class</option>
                @foreach($class as $classess)
                <option value="{{$classess->id}}">{{$classess->class}}</option>
                @endforeach
                @endif
                
                    
                </select>
<span class="text-danger"></span>
</div>
<div class="form-group">
<label for="book_name">Book name</label>
<input autofocus="" id="book_name" name="book_name" placeholder="" type="text" class="form-control" value="@if(!empty($result1[0]->book_name)){{$result1[0]->book_name}}@endif" autocomplete="off">
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="book_name">Author name</label>
<input autofocus="" id="author" name="author" placeholder="" type="text" class="form-control" value="@if(!empty($result1[0]->author)){{$result1[0]->author}}@endif" autocomplete="off">
<span class="text-danger"></span>
</div>
<div class="form-group">
<label for="book_name">Attachment</label>
<input autofocus="" id="attachment" name="attachment" placeholder="" type="file" class="form-control" value="@if(!empty($result1[0]->attachment)){{$result1[0]->attachment}}@endif" autocomplete="off" style="opacity:1;">@if(!empty($result1[0]->attachment)){{$result1[0]->attachment}}@endif
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
<h3 class="box-title titlefix">Books List</h3>
</div><!-- /.box-header -->
<div class="box-body">
<div class="mailbox-controls">
<div class="pull-right">
</div><!-- /.pull-right -->
</div>
<div class="table-responsive mailbox-messages">
<div class="download_label">Books</div>
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
 <table class="table table-striped table-bordered table-hover example dataTable no-footer dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 715px;">
<thead>
<tr role="row">
  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Room Number / Name: activate to sort column ascending">Subjects</th>

  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Room Number / Name: activate to sort column ascending">Class</th>

  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Hostel: activate to sort column ascending">Book Name</th>
  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 140px;" aria-label="Hostel: activate to sort column ascending">Author Name</th>

  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Hostel: activate to sort column ascending">Action</th>
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
    <td valign="top"  class="">{{$data->name}}</td>
     <td valign="top"  class="">{{$data->class}}</td>
    <td valign="top"  class="">{{$data->book_name}}</td>
    <td valign="top"  class="">{{$data->author}}</td>
     
    <td>
<a href="{{url('/editSubjectBook/'.$data->subject_book_id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Edit" style="border: 0px solid transparent !important;"><i class="fa fa-pencil"></i></a>
      <a href="{{url('/deleteSubjectBook/'.$data->subject_book_id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" style="border: 0px solid transparent !important;" title="Delete" onclick="return confirm('Delete Confirm?');">
                                                        <i class="fa fa-remove"></i>
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


