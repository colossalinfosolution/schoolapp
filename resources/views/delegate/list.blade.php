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
<div class="col-md-12">
<div class="box box-primary">

<div class="box-header with-border">
<h3 class="box-title"><i class="fa fa-search"></i> Select Criteria</h3>
</div>
<form id="form1" action="{{url('/delegateList')}}" method="get" accept-charset="utf-8">
<div class="box-body">
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label for="exampleInputEmail1">Class</label><small class="req"> *</small>
<select autofocus="" id="class_id" name="class_id" class="form-control" autocomplete="off">
   
<option value="">Select</option>
@foreach($classdata as $classdt) 
<option value="{{$classdt->id}}">{{$classdt->class}}</option>
@endforeach
</select>
<span class="text-danger"></span>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="exampleInputEmail1">Section</label><small class="req"> *</small>
<select id="section_id" name="section_id" class="form-control">
    
<option value="">Select</option>
 @foreach($sectiondata as $sectiondt) 
<option value="{{$sectiondt->id}}">{{$sectiondt->section}}</option>
@endforeach
</select>
<span class="text-danger"></span>
</div>
</div>


<div class="col-md-2">
<div class="form-group">
<label for="exampleInputEmail1">
Date</label>
<input id="date" name="date" placeholder="" type="date" class="form-control" value="">
<span class="text-danger"></span>
</div>
</div>
</div>
</div>
<div class="box-footer">
<button type="submit" name="search" value="search" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> Search</button>
</div>
</form>
</div>
</div>
<section class="content">
<div class="row">

<div class="col-md-12">

<div class="box box-primary" id="hroom">
<div class="box-header ptbnull">
<h3 class="box-title titlefix">Delegate List</h3>
</div>
<div class="box-body">
<div class="mailbox-controls">
<div class="pull-right">
</div>
</div>
<div class="table-responsive mailbox-messages">
<div class="download_label">Delegate List</div>
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
   
            <table class="table table-striped table-bordered table-hover example dataTable no-footer dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 715px;">
<thead>
<tr role="row"><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Room Number / Name: activate to sort column ascending">Admission No.</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Hostel: activate to sort column ascending">Student Name</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Room Type: activate to sort column ascending">Father Name</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Room Type: activate to sort column ascending">Mother Name</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Room Type: activate to sort column ascending">Gardian Name</th>

<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Room Type: activate to sort column ascending">Delegate Person</th>
<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 140px;" aria-label="Room Type: activate to sort column ascending">Delegate Person image</th>
<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Room Type: activate to sort column ascending">Delegte From</th>
<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Room Type: activate to sort column ascending">Delegte To</th>
</tr>
</thead>
<tbody>
@if(empty($result[0]))
<tr class="odd">
    <td valign="top" colspan="10" class="dataTables_empty">No data available in table <br> <br>
        <img src="https://smart-school.in/ssappresource/images/addnewitem.svg" width="150"><br><br> 
        <span class="text-success bolds"><i class="fa fa-arrow-left">
            
        </i> Add new record or search with different criteria.</span>
    </td>
</tr>
@else
@foreach($result as $data)
<tr class="odd">
    <td valign="top"  class="">{{$data->admission_no}} 
    </td>
     <td valign="top"  class="">{{$data->firstname}} {{$data->lastname}}</td>

    <td valign="top" class="">{{$data->fname}} 
    </td>
    <td valign="top" class="">{{$data->mname}} 
    </td>
    <td valign="top" class="">{{$data->guardian_name}} 
    </td>

    <td valign="top" class="">{{$data->first_name}} {{$data->last_name}}
    </td>
    <td valign="top" class=""><img src="http://demo.plusonetech.in/plusone/uploads/student_leaves/{{$data->d_image}}" width="80" height="80"><br><br>
    </td>
    
    <td valign="top" class="">{{$data->from_date}} 
    </td>
    <td valign="top" class="">{{$data->to_date}} 
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


