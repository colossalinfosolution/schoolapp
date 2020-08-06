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
 @if(empty($result1[0]->id))
<div class="col-md-12">
<div class="box box-primary">

<div class="box-header with-border">
<h3 class="box-title"><i class="fa fa-search"></i> Select Criteria</h3>
</div>
<form id="form1" action="{{url('/orderHistory')}}" method="get" accept-charset="utf-8">
<div class="box-body">
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label for="class_id">Class</label><small class="req"> *</small>
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
<label for="section_id">Section</label><small class="req"> *</small>
<select id="section_id" name="section_id" class="form-control">
    
<option value="">Select</option>
 @foreach($sectiondata as $sectiondt) 
<option value="{{$sectiondt->id}}">{{$sectiondt->section}}</option>
@endforeach
</select>
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
@endif
<section class="content">
<div class="row">
	 @if(!empty($result1[0]->id))
	<div class="col-md-4">
<!-- Horizontal Form -->
<div class="box box-primary">
<div class="box-header with-border">
 
<h3 class="box-title">Edit Order Status</h3>

</div><!-- /.box-header -->
<!-- form start -->
<form id="form1" action="{{url('updateOrderStatus')}}" name="form1" method="post" enctype="multipart/form-data">
<div class="box-body">
@csrf
@if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
       
        @endif

<input id="id" name="id" placeholder="" type="hidden" class="form-control" value="@if(!empty($result1[0]->id)){{$result1[0]->id}}@endif">

<div class="form-group">
<label for="status">Status</label><small class="req"> *</small>
              <select class="form-control" name="status" id="status">
                @if(!empty($result1[0]->status))
                <option value="{{$result1[0]->status}}" selected>{{$result1[0]->status}}</option>
                <option value="success">Success</option>
                <option value="pending">Pending</option>
               @else
                <option value="pending" selected>Pending</option>
                <option value="success">Success</option>
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

</div>

@endif

<!--/.col (right) -->
<!-- left column -->
 
	<div class="col-md-12">

<!-- general form elements -->
<div class="box box-primary" id="hroom">
<div class="box-header ptbnull">
<h3 class="box-title titlefix">Order List</h3>
</div><!-- /.box-header -->
<div class="box-body">
<div class="mailbox-controls">
<div class="pull-right">
</div><!-- /.pull-right -->
</div>
<div class="table-responsive mailbox-messages">
<div class="download_label">Order List</div>
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
   
            <table class="table table-striped table-bordered table-hover example dataTable no-footer dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 715px;">
<thead>
<tr role="row"><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Hostel: activate to sort column ascending"> Name</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 135px;" aria-label="Room Type: activate to sort column ascending">Student Name</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Room Type: activate to sort column ascending">Class</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Room Type: activate to sort column ascending">Section</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 120px;" aria-label="Room Type: activate to sort column ascending">Phone Number</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Room Type: activate to sort column ascending">Order Id</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Room Type: activate to sort column ascending">Address</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Room Type: activate to sort column ascending">Item Name</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Room Type: activate to sort column ascending">Item Image</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 94px;" aria-label="Room Type: activate to sort column ascending">Total Cost</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 90px;" aria-label="Room Type: activate to sort column ascending">Total Item</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Room Type: activate to sort column ascending">Status</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 65px;" aria-label="Room Type: activate to sort column ascending">Action</th></tr>
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
    <td valign="top"  class="">{{$data->first_name}} {{$data->last_name}}</td>
  <td valign="top"  class="">{{$data->firstname}} {{$data->lastname}}</td>
    <td valign="top" class="">{{$data->class}} 
    </td>
    <td valign="top" class="">{{$data->section}} 
    </td>
    <td valign="top" class="">{{$data->number}} 
    </td>
    
    <td valign="top" class="">{{$data->razorpay_payment_id}} 
    </td>
    <td valign="top" class="">{{$data->address}} 
    </td>
    <td valign="top" data-toggle="modal" data-target="#exampleModalCenter_{{$data->item_id}}" class="">{{$data->item_name}} 
    </td>
     <td valign="top" class="" data-toggle="modal" data-target="#exampleModalCenter_{{$data->item_id}}"><img src="{{asset('uploads/'.$data->image)}}" width="80" height="80"><br><br>
    </td>
    <td valign="top" class="">{{$data->total_cost}} 
    </td>
    <td valign="top" class="">{{$data->total_item}} 
    </td>
    
    @if($data->status == 'pending')
     <td valign="top" style="background-color:#fb090994 !important;" class="">{{$data->status}} 
    </td>
    @else
    <td valign="top" style="background-color:#008000ad !important;" class="">{{$data->status}} 
    </td>
    @endif
    <td>
             <a href="{{url('/editOrderStatus/'.$data->ord_id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Edit" style="border: 0px solid transparent !important;"><i class="fa fa-pencil"></i>
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

    @foreach($store_items as $s_item)
  <div class="modal fade" id="exampleModalCenter_{{$s_item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                 <div class="modal-header" style="background-color: #1ca0e0; color: white;">
                  <h5 class="modal-title" id="exampleModalLongTitle">Item</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                      <thead style="text-align: center;">
                       
                         <tr>
                          <th scope="col">Item Image: </th>
                          <th scope="col"><img src="{{asset('uploads/'.$s_item->image)}}" width="80" height="80"></th>
                        </tr>
                        <tr>
                          <th scope="col">Item name: </th>
                          <th scope="col">{{$s_item->item_name}}</th>
                        </tr>
                        @if(!empty($s_item->name))
                        <tr>
                          <th scope="col">Item Category: </th>
                          <th scope="col">{{$s_item->name}}</th>
                        </tr>
                        @endif
                        <tr>
                          <th scope="col">Item Code: </th>
                          <th scope="col">{{$s_item->code}}</th>
                        </tr>
                        <tr>
                          <th scope="col">Description: </th>
                          <th scope="col">{{$s_item->description}}</th>
                        </tr>
                        @if(!empty($s_item->size))
                         <tr>
                          <th scope="col">Size: </th>
                          <th scope="col">{{$s_item->size}}</th>
                        </tr>
                        @endif
                        @if(!empty($s_item->color))
                         <tr>
                          <th scope="col">Color: </th>
                          <th scope="col">{{$s_item->color}}</th>
                        </tr>
                        @endif
                        @if(!empty($s_item->publisher))
                         <tr>
                          <th scope="col">Publisher: </th>
                          <th scope="col">{{$s_item->publisher}}</th>
                        </tr>
                        @endif
                         @if(!empty($s_item->setofbooks))
                         <tr>
                          <th scope="col">Set of books: </th>
                          <th scope="col">{{$s_item->setofbooks}}</th>
                        </tr>
                       @endif
                        <tr>
                          <th scope="col">Price: </th>
                          <th scope="col">{{$s_item->price}}</th>
                        </tr>
                       
                       
                      </thead>
                    </table>
                    
                  </div>
                 
                  <!-- <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
              </div>
            </div>
          </div>
          @endforeach