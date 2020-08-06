<?php

namespace App\Http\Controllers\Api;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  SimpleSoftwareIO\QrCode\Facades\QrCode;
use DB;

class LeaveController extends Controller
{
   
    //used for submit leave by using ulr ('/leave-submit')
    public function leave_insert(Request $request)
   {

                $validextensions = array("jpeg", "jpg", "png","pdf");
                $temporary1 = explode('.', $_FILES["file"]["name"]);
                $file_extension1 = end($temporary1);

                if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "application/pdf") || ($_FILES["file"]["type"] == "image/jpeg")
                        ) && ($_FILES["file"]["size"] < 40000000) && in_array($file_extension1, $validextensions)){

                    $imageType1 = explode('.', $_FILES["file"]["name"]);

                    $file = 'file' . rand() . '.' . $imageType1[1];

                    $sourcePath1 = $_FILES['file']['tmp_name'];

                    $targetPath1 = base_path() . '/uploads/' . $file;

                    if (move_uploaded_file($sourcePath1, $targetPath1) )
                        $record['file'] = $file;
                }

                $record['stu_id'] = $request->post('stu_id');
                $record['fname'] = $request->post('fname');
                $record['lname'] = $request->post('lname');
                $record['class'] = $request->post('class');
                $record['section'] = $request->post('section');
                $record['status'] = $request->post('status');
                $record['comments'] = $request->post('comments');
                $record['reason'] = $request->post('reason');
                $record['start_date'] = $request->post('start_date');
                $record['end_date'] = $request->post('end_date');

                $data = DB::table('leaves')->insert($record);

        if(isset($data) && $data != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'item Found',
                                   'data'=>$record]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not inserted']
                                   );  
            }
         
   }


 //used for update leave by using ulr ('/leave-update')
public function leave_update(Request $request)
   {
                $id = $request->post('id'); //column id
                $validextensions = array("jpeg", "jpg", "png","pdf");
                $temporary1 = explode('.', $_FILES["file"]["name"]);
                $file_extension1 = end($temporary1);

                if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "application/pdf") || ($_FILES["file"]["type"] == "image/jpeg")
                        ) && ($_FILES["file"]["size"] < 40000000) && in_array($file_extension1, $validextensions)){

                    $imageType1 = explode('.', $_FILES["file"]["name"]);

                    $file = 'file' . rand() . '.' . $imageType1[1];

                    $sourcePath1 = $_FILES['file']['tmp_name'];

                    $targetPath1 = base_path() . '/uploads/' . $file;

                    if (move_uploaded_file($sourcePath1, $targetPath1) )
                        $record['file'] = $file;
                }
              
                $record['stu_id'] = $request->post('stu_id');
                $record['fname'] = $request->post('fname');
                $record['lname'] = $request->post('lname');
                $record['class'] = $request->post('class');
                $record['section'] = $request->post('section');
                $record['status'] = $request->post('status');
                $record['comments'] = $request->post('comments');
                $record['reason'] = $request->post('reason');
                $record['start_date'] = $request->post('start_date');
                $record['end_date'] = $request->post('end_date');

                $data = DB::table('leaves')->where('id', $id)->update($record);

        if(isset($data) && $data != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'item Found',
                                   'data'=>$record]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not found']
                                   );  
            }
         
   }

 //used for list of leave by using ulr ('/leave-list')

    public function leave_list()
   {

      $data = DB::table('leaves')->select('leaves.*')->get();
                
       if(!empty($data && $data != ''))
         {
            
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'item Found',
                                   'data'=>$data]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not inserted']
                                   );  
            }
   }

         
   
 //used for list of leave by student id using ulr ('/leave-list-parent/1 ('1' is the id of student)')

   public function leave_list_parent($student_id)
   {
     
      $data = DB::table('leaves')->where('stu_id', $student_id)->select('leaves.*')->get();
                
        if(!empty($data && $data != ''))
         {
            
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'item Found',
                                   'data'=>$data]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not inserted']
                                   );  
            }
   }

         
   


    public function leave_type()
   {

      $data = DB::table('leave_type')->select('leave_type.*')->get();
                
        if(!empty($data && $data != ''))
         {
            
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'item Found',
                                   'data'=>$data]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not inserted']
                                   );  
            }
   }

         
   


} 