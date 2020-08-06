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
<h3 class="box-title">Add E-Store Items</h3>
</div><!-- /.box-header -->
<!-- form start -->
<form id="form1" action="{{url('/estore/insertItem')}}" name="employeeform" method="post" enctype="multipart/form-data">
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
        @endif<div class="form-group">
<label for="exampleInputEmail1">Item Name</label><small class="req"> *</small>
<input autofocus="" id="item_name" name="item_name" placeholder="" type="text" class="form-control" value="" autocomplete="off">
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Item Code</label><small class="req"> *</small>
<input id="code" name="code" placeholder="" type="text" class="form-control" value="">
<span class="text-danger"></span>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Description</label>
<textarea class="form-control" id="description" name="description" placeholder="" rows="3"></textarea>
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Item Category</label><small class="req"> *</small>
              <select class="form-control" name="category_id">
                    <option value="" selected>Select Item Category</option>
                    @foreach($item_cat as $cat)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                    
                </select>
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Item supplier</label><small class="req"> *</small>
              <select class="form-control" name="supplier_id">
               
                    <option value="" selected>Select Item supplier</option>
                   
                    @foreach($supplier_id as $cat1)
                    <option value="{{$cat1->id}}">{{$cat1->name}}</option>
                    @endforeach
                   
                </select>
<span class="text-danger"></span>
</div>
<div class="form-group">
<label for="image">Image</label><small class="req"> *</small>
<input type="file" id="image" name="image" class="form-control" value="" style="opacity:1 !important;">
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Quantity</label><small class="req"> *</small>
<input id="quantity" name="quantity" placeholder="" type="number" class="form-control" value="">
<span class="text-danger"></span>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Size</label><small class="req"> *</small>
<input id="size" name="size" placeholder="" type="text" class="form-control" value="">
<span class="text-danger"></span>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Age</label><small class="req"> *</small>
<input id="age" name="age" placeholder="" type="number" class="form-control" value="">
<span class="text-danger"></span>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Color</label><small class="req"> *</small>
<input id="color" name="color" placeholder="" type="text" class="form-control" value="">
<span class="text-danger"></span>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Price</label><small class="req"> *</small>
<input id="price" name="price" placeholder="" type="number" class="form-control" value="">
<span class="text-danger"></span>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Bookbyclass</label><small class="req"> *</small>
<input id="bookbyclass" name="bookbyclass" placeholder="" type="text" class="form-control" value="">
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Publisher</label><small class="req"> *</small>
<input id="publisher" name="publisher" placeholder="" type="text" class="form-control" value="">
<span class="text-danger"></span>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Setofbooks</label><small class="req"> *</small>
<input id="setofbooks" name="setofbooks" placeholder="" type="text" class="form-control" value="">
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
<h3 class="box-title titlefix">Items List</h3>
</div><!-- /.box-header -->
<div class="box-body">
<div class="mailbox-controls">
<div class="pull-right">
</div><!-- /.pull-right -->
</div>
<div class="table-responsive mailbox-messages">
<div class="download_label">Items List</div>
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
   
            <table class="table table-striped table-bordered table-hover example dataTable no-footer dtr-inline" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="width: 715px;">
<thead>
<tr role="row"><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 65px;" aria-label="Hostel: activate to sort column ascending">Item Code</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 65px;" aria-label="Hostel: activate to sort column ascending">Item Name</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="Room Type: activate to sort column ascending">Price</th><th class="text-right no-print sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 48px;" aria-label="Action: activate to sort column ascending">Action</th></tr>
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
    <td valign="top"  class="">{{$data->code}} 
    </td>
     <td valign="top"  class="">{{$data->item_name}} 
    </td>
     <td valign="top" class="">{{$data->price}} 
    </td>
    <td <a href="{{url('/editItems/'.$data->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Edit" style="border: 0px solid transparent !important;"><i class="fa fa-pencil"></i>
      </a>
      <a href="{{url('/deleteItems/'.$data->id)}}" class="btn btn-default btn-xs" data-toggle="tooltip" style="border: 0px solid transparent !important;" title="Delete" onclick="return confirm('Delete Confirm?');"><i class="fa fa-remove"></i>
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


