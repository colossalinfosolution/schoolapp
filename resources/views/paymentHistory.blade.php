
<link rel="stylesheet" href="http://34.93.37.73/plusone/backend/dist/css/style-main.css">
<section class="content">
<div class="row">
<div class="col-md-12">
<div class="box box-primary">

<div class="box-header with-border">
<h3 class="box-title"><i class="fa fa-search"></i> Select Criteria</h3>
</div>
<form id="form1" action="http://34.93.37.73/plusone/admin/stuattendence/index" method="post" accept-charset="utf-8">
<div class="box-body">

<input type="hidden" name="ci_csrf_token" value="">                            <div class="row">
<div class="col-md-4">
<div class="form-group">
<label for="exampleInputEmail1">Class</label><small class="req"> *</small>
<select autofocus="" id="class_id" name="class_id" class="form-control" autocomplete="off">
<option value="">Select</option>
<option value="1">Class 1</option>
<option value="2" selected="selected">Class 2</option>
<option value="3">3</option>
</select>
<span class="text-danger"></span>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="exampleInputEmail1">Section</label><small class="req"> *</small>
<select id="section_id" name="section_id" class="form-control"><option value="">Select</option><option value="1" selected="selected">A</option><option value="2">B</option><option value="3">C</option><option value="4">D</option></select>
<span class="text-danger"></span>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="exampleInputEmail1">
Attendance                                            Date                                        </label>
<input id="date" name="date" placeholder="" type="text" class="form-control" value="04/14/2020" readonly="readonly">
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
<div class="box box-info">
<div class="box-header with-border">
<h3 class="box-title"><i class="fa fa-users"></i> Student List</h3>
<div class="box-tools pull-right">
</div>
</div>
<div class="box-body">
<div class="alert alert-success">Attendance Already Submitted You Can Edit Record</div>
<form action="http://34.93.37.73/plusone/admin/stuattendence/index" method="post">
<input type="hidden" name="ci_csrf_token" value="">                                    <div class="mailbox-controls">
<span class="button-checkbox">
<button type="button" class="btn btn-sm btn-primary" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Mark As Holiday</button>
<input type="checkbox" id="checkbox1" class="hidden" name="holiday" value="checked">
</span>
<div class="pull-right">
<button type="submit" name="search" value="saveattendence" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-save"></i> Save Attendance </button>
</div>
</div>
<input type="hidden" name="class_id" value="2">
<input type="hidden" name="section_id" value="1">
<input type="hidden" name="date" value="04/14/2020">
<div class="table-responsive ptt10">
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"><table class="table table-hover table-striped example dataTable no-footer" id="DataTables_Table_0" role="grid"> 
<thead>
<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" style="width: 30px;">#</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Admission Number: activate to sort column ascending" style="width: 166px;">Admission Number</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Roll Number: activate to sort column ascending" style="width: 114px;">Roll Number</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 123px;">Name</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Attendance: activate to sort column ascending" style="width: 387px;">Attendance</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Note: activate to sort column ascending" style="width: 199px;">Note</th></tr>
</thead>
<tbody>










<tr role="row" class="odd">
<td class="sorting_1">
<input type="hidden" name="student_session[]" value="15">
<input type="hidden" value="332" name="attendendence_id15">
1                                                        </td>

<td>
00002                                                        </td>
<td>
00002sdfgn
</td>

<td>
Ravi Kumar                                                        </td>
<td>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype15-0" value="1" name="attendencetype15">
<label for="attendencetype15-0">
Present 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype15-1" value="3" name="attendencetype15">
<label for="attendencetype15-1">
Late 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype15-2" value="4" name="attendencetype15">
<label for="attendencetype15-2">
Absent 
</label>
</div>
<div class="radio radio-info radio-inline">
<input checked="" type="radio" id="attendencetype15-3" value="6" name="attendencetype15">
<label for="attendencetype15-3">
Half Day 
</label>
</div>

</td>

<td><input type="text" name="remark15" value="Personal emergency"></td>
</tr><tr role="row" class="even">
<td class="sorting_1">
<input type="hidden" name="student_session[]" value="16">
<input type="hidden" value="333" name="attendendence_id16">
2                                                        </td>

<td>
00004                                                        </td>
<td>
00004sdfgn
</td>

<td>
Shankar Kumar                                                        </td>
<td>
<div class="radio radio-info radio-inline">
<input checked="" type="radio" id="attendencetype16-0" value="1" name="attendencetype16">
<label for="attendencetype16-0">
Present 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype16-1" value="3" name="attendencetype16">
<label for="attendencetype16-1">
Late 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype16-2" value="4" name="attendencetype16">
<label for="attendencetype16-2">
Absent 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype16-3" value="6" name="attendencetype16">
<label for="attendencetype16-3">
Half Day 
</label>
</div>

</td>

<td><input type="text" name="remark16" value=""></td>
</tr><tr role="row" class="odd">
<td class="sorting_1">
<input type="hidden" name="student_session[]" value="17">
<input type="hidden" value="334" name="attendendence_id17">
3                                                        </td>

<td>
00005                                                        </td>
<td>
00005sdfgn
</td>

<td>
Ramesh Khanna                                                        </td>
<td>
<div class="radio radio-info radio-inline">
<input checked="" type="radio" id="attendencetype17-0" value="1" name="attendencetype17">
<label for="attendencetype17-0">
Present 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype17-1" value="3" name="attendencetype17">
<label for="attendencetype17-1">
Late 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype17-2" value="4" name="attendencetype17">
<label for="attendencetype17-2">
Absent 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype17-3" value="6" name="attendencetype17">
<label for="attendencetype17-3">
Half Day 
</label>
</div>

</td>

<td><input type="text" name="remark17" value=""></td>
</tr><tr role="row" class="even">
<td class="sorting_1">
<input type="hidden" name="student_session[]" value="18">
<input type="hidden" value="335" name="attendendence_id18">
4                                                        </td>

<td>
00006                                                        </td>
<td>
00006sdfgn
</td>

<td>
Yuvraj Singh                                                        </td>
<td>
<div class="radio radio-info radio-inline">
<input checked="" type="radio" id="attendencetype18-0" value="1" name="attendencetype18">
<label for="attendencetype18-0">
Present 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype18-1" value="3" name="attendencetype18">
<label for="attendencetype18-1">
Late 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype18-2" value="4" name="attendencetype18">
<label for="attendencetype18-2">
Absent 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype18-3" value="6" name="attendencetype18">
<label for="attendencetype18-3">
Half Day 
</label>
</div>

</td>

<td><input type="text" name="remark18" value=""></td>
</tr><tr role="row" class="odd">
<td class="sorting_1">
<input type="hidden" name="student_session[]" value="19">
<input type="hidden" value="336" name="attendendence_id19">
5                                                        </td>

<td>
00007                                                        </td>
<td>
00007sdfgn
</td>

<td>
Virat Kohli                                                        </td>
<td>
<div class="radio radio-info radio-inline">
<input checked="" type="radio" id="attendencetype19-0" value="1" name="attendencetype19">
<label for="attendencetype19-0">
Present 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype19-1" value="3" name="attendencetype19">
<label for="attendencetype19-1">
Late 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype19-2" value="4" name="attendencetype19">
<label for="attendencetype19-2">
Absent 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype19-3" value="6" name="attendencetype19">
<label for="attendencetype19-3">
Half Day 
</label>
</div>

</td>

<td><input type="text" name="remark19" value=""></td>
</tr><tr role="row" class="even">
<td class="sorting_1">
<input type="hidden" name="student_session[]" value="20">
<input type="hidden" value="337" name="attendendence_id20">
6                                                        </td>

<td>
00008                                                        </td>
<td>
00008sdfgn
</td>

<td>
Sachin Kumar                                                        </td>
<td>
<div class="radio radio-info radio-inline">
<input checked="" type="radio" id="attendencetype20-0" value="1" name="attendencetype20">
<label for="attendencetype20-0">
Present 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype20-1" value="3" name="attendencetype20">
<label for="attendencetype20-1">
Late 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype20-2" value="4" name="attendencetype20">
<label for="attendencetype20-2">
Absent 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype20-3" value="6" name="attendencetype20">
<label for="attendencetype20-3">
Half Day 
</label>
</div>

</td>

<td><input type="text" name="remark20" value=""></td>
</tr><tr role="row" class="odd">
<td class="sorting_1">
<input type="hidden" name="student_session[]" value="21">
<input type="hidden" value="338" name="attendendence_id21">
7                                                        </td>

<td>
00009                                                        </td>
<td>
00009sdfgn
</td>

<td>
Kapil Singh                                                        </td>
<td>
<div class="radio radio-info radio-inline">
<input checked="" type="radio" id="attendencetype21-0" value="1" name="attendencetype21">
<label for="attendencetype21-0">
Present 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype21-1" value="3" name="attendencetype21">
<label for="attendencetype21-1">
Late 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype21-2" value="4" name="attendencetype21">
<label for="attendencetype21-2">
Absent 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype21-3" value="6" name="attendencetype21">
<label for="attendencetype21-3">
Half Day 
</label>
</div>

</td>

<td><input type="text" name="remark21" value=""></td>
</tr><tr role="row" class="even">
<td class="sorting_1">
<input type="hidden" name="student_session[]" value="22">
<input type="hidden" value="339" name="attendendence_id22">
8                                                        </td>

<td>
00010                                                        </td>
<td>
00010sdfgn
</td>

<td>
Salim Khan                                                        </td>
<td>
<div class="radio radio-info radio-inline">
<input checked="" type="radio" id="attendencetype22-0" value="1" name="attendencetype22">
<label for="attendencetype22-0">
Present 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype22-1" value="3" name="attendencetype22">
<label for="attendencetype22-1">
Late 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype22-2" value="4" name="attendencetype22">
<label for="attendencetype22-2">
Absent 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype22-3" value="6" name="attendencetype22">
<label for="attendencetype22-3">
Half Day 
</label>
</div>

</td>

<td><input type="text" name="remark22" value=""></td>
</tr><tr role="row" class="odd">
<td class="sorting_1">
<input type="hidden" name="student_session[]" value="23">
<input type="hidden" value="340" name="attendendence_id23">
9                                                        </td>

<td>
00011                                                        </td>
<td>
00011sdfgn
</td>

<td>
Salman Khan                                                        </td>
<td>
<div class="radio radio-info radio-inline">
<input checked="" type="radio" id="attendencetype23-0" value="1" name="attendencetype23">
<label for="attendencetype23-0">
Present 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype23-1" value="3" name="attendencetype23">
<label for="attendencetype23-1">
Late 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype23-2" value="4" name="attendencetype23">
<label for="attendencetype23-2">
Absent 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype23-3" value="6" name="attendencetype23">
<label for="attendencetype23-3">
Half Day 
</label>
</div>

</td>

<td><input type="text" name="remark23" value=""></td>
</tr><tr role="row" class="even">
<td class="sorting_1">
<input type="hidden" name="student_session[]" value="24">
<input type="hidden" value="341" name="attendendence_id24">
10                                                        </td>

<td>
00012                                                        </td>
<td>
00012sdfgn
</td>

<td>
Andrew Simon                                                        </td>
<td>
<div class="radio radio-info radio-inline">
<input checked="" type="radio" id="attendencetype24-0" value="1" name="attendencetype24">
<label for="attendencetype24-0">
Present 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype24-1" value="3" name="attendencetype24">
<label for="attendencetype24-1">
Late 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype24-2" value="4" name="attendencetype24">
<label for="attendencetype24-2">
Absent 
</label>
</div>
<div class="radio radio-info radio-inline">
<input type="radio" id="attendencetype24-3" value="6" name="attendencetype24">
<label for="attendencetype24-3">
Half Day 
</label>
</div>

</td>

<td><input type="text" name="remark24" value=""></td>
</tr></tbody>
</table></div>
</div>
</form>
</div>
</div>
</div>
</div>
</section>