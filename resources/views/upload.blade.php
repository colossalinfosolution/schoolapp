<form action="{{url('upload-submit')}}" method="post" enctype="multipart/form-data">
@csrf
<input type="file" name="file" size="50" />
<input type="text" id="stu_id" name="stu_id" value="" style="display: flex;margin-top: 10px;height: 28px;margin-bottom: -11px;"><br>
<input type="text" id="fname" name="fname" value="" style="display: flex;margin-top: 10px;height: 28px;margin-bottom: -11px;"><br>
<input type="text" id="lname" name="lname" value="" style="display: flex;margin-top: 10px;height: 28px;margin-bottom: -11px;"><br>
<input type="text" id="class" name="class" value="" style="display: flex;margin-top: 10px;height: 28px;margin-bottom: -11px;"><br>
<input type="text" id="section" name="section" value="" style="display: flex;margin-top: 10px;height: 28px;margin-bottom: -11px;"><br>
<input type="text" id="status" name="status" value="" style="display: flex;margin-top: 10px;height: 28px;margin-bottom: -11px;"><br>
<input type="text" id="comments" name="comments" value="" style="display: flex;margin-top: 10px;height: 28px;margin-bottom: -11px;"><br>
<input type="text" id="reason" name="reason" value="" style="display: flex;margin-top: 10px;height: 28px;margin-bottom: -11px;"><br>

<input type="date" id="start_date" name="start_date" value="" style="display: flex;margin-top: 10px;height: 28px;margin-bottom: -11px;"><br>

<input type="date" id="end_date" name="end_date" value="" style="display: flex;margin-top: 10px;height: 28px;margin-bottom: -11px;"><br>

<br />

<input type="submit" value="Upload" />

</form>