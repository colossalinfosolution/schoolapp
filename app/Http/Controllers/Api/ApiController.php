<?php

namespace App\Http\Controllers\Api;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use DB;
use Bitly;

class ApiController extends Controller
{

  public function iHaveArrived(Request $request)
   {
     $dates = date('Y-m-d');
         $data1 = array('student_session_id' =>$request->post('student_session_id'),
          'parent_id'=>$request->post('parent_id'),
          'teacher'=>$request->post('teacher_id'),
          'date' =>$dates
        );
             
         $data = DB::table('i_have_arrived')->insert($data1);
  if(isset($data) && $data != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'item Found',
                                   'data'=>$data1]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not inserted']
                                   );  
            }
   }


   public function searchArrived(Request $request)
   {
         $date = date('Y-m-d');
          $user_id  = $request->post('parent_id');
         $data = DB::table('i_have_arrived')
         ->where('date',$date)
         ->where('parent_id', $user_id)
         ->select('i_have_arrived.*')
         ->get();
        
        if(!empty($data && $data != ''))
         {
            
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'item Found',
                                   'data'=>$data]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not found']
                                   );  
            }
   }


    public function genarateQrCode(Request $request)
   {
      $qr_code_id = Str::random(6);
     $data1 = array('student_session_id' =>$request->post('student_session_id'),
          'parent_id'=>$request->post('parent_id'),
          'teacher_id'=>$request->post('teacher_id'),
          'student_id'=>$request->post('student_id'),
          'qr_code_id'=>$qr_code_id
        );    
      $data = DB::table('dispersal')->insert($data1);  
     
      $qr = QrCode::size(300)->generate($qr_code_id);
      $dataupload = file_put_contents('uploads/'. $qr_code_id . '.svg', $qr);

       if(!empty($dataupload && $dataupload != ''))
         {
          return response()->json(['status' => '200',//sample entry
   'message' => 'items found',
   'data'=>url('uploads/'. $qr_code_id . '.svg')]);  
        }
        else{
return response()->json(['status' => '404',//sample entry
   'message' => 'items not found']);  
        }
   }

  public function DispersalDetail(Request $request)
   {
         $qr_code_id = $request->post('qr_code_id');
          $data = DB::table('dispersal')->where('qr_code_id', $qr_code_id)
          ->select('dispersal.*')->get();
          $datas = DB::table('sch_settings')->select('sch_settings.*')->get();

          $data1 = DB::table('dispersal')
          ->leftjoin('students','students.id','=','dispersal.student_id')
          ->leftjoin('student_session','student_session.id','=','dispersal.student_session_id')
          ->leftjoin('classes','classes.id','=','student_session.class_id')
          ->leftjoin('sections','sections.id','=','student_session.section_id')
          ->where('dispersal.qr_code_id', $qr_code_id)
          ->select('students.*','classes.class','sections.section', 'students.id as stu_id')
          ->get();
         
        $data2 = DB::table('dispersal')
          ->leftjoin('delegates','delegates.delegate_id','=','dispersal.delegate_id')
          ->where('dispersal.qr_code_id', $qr_code_id)
          ->select('delegates.*')->get();

          
          if(!empty($data[0]) && $data[0] != '')
         {
          return response()->json(['status' => '200',//sample entry
   'message' => 'items found',
   'data'=>$data,
   'student'=>$data1,
   'delegates'=>$data2]);  
        }
        else{
return response()->json(['status' => '404',//sample entry
   'message' => 'items not found']);  
        }
   }

    public function disperseStudent(Request $request)
   {
         $date = date('Y-m-d H:i:s');
         $dispersal_id = $request->post('dispersal_id');
         $data1 = array(
          'dispersed_by'=>$request->post('dispersed_by'),
          'hondover_to'=>$request->post('hondover_to'),
           'dispersed_on'=>$date
         );
         $data = DB::table('dispersal')->where('dispersal_id', $dispersal_id)->update($data1);
         if(isset($data) && $data != '')
         {
           return response()->json(['status' => '200',//sample entry
   'message' => 'Notification will be sent to parent']);
         }
          return response()->json(['status' => '404',//sample entry
   'message' => 'Notification will not be sent to parent ']);
        
         
   }

    public function delegate(Request $request)
   {
    
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d h-i-s');
        $first_name = $request->post('first_name');
        $last_name = $request->post('last_name');
        $age = $request->post('age');
        $sex = $request->post('sex');
        $parent_id = $request->post('parent_id');
        $from_date = $request->post('from_date');
        $to_date = $request->post('to_date');
         $qr_code_id = Str::random(7);
                $validextensions = array("jpeg", "jpg", "png","pdf");
                $temporary1 = explode('.', $_FILES["image"]["name"]);
                $file_extension1 = end($temporary1);

               if ((($_FILES["image"]["type"] == "image/png") || ($_FILES["image"]["type"] == "image/jpg") || ($_FILES["image"]["type"] == "application/pdf") || ($_FILES["image"]["type"] == "image/jpeg")
                        ) && ($_FILES["image"]["size"] < 40000000) && in_array($file_extension1, $validextensions)){

                    $imageType1 = explode('.', $_FILES["image"]["name"]);

                    $image = 'image' . rand() . '.' . $imageType1[1];

                    $sourcePath1 = $_FILES['image']['tmp_name'];

                    $targetPath1 = base_path() . '/uploads/' . $image;

                    if (move_uploaded_file($sourcePath1, $targetPath1) )
                        $record['image'] = $image;
                }
              
                $record['first_name'] = $request->post('first_name');
                $record['last_name'] = $request->post('last_name');
                $record['age'] = $request->post('age');
                $record['sex'] = $request->post('sex');
                $record['from_date'] = $request->post('from_date');
                $record['to_date'] = $request->post('to_date');
                $record['created_a'] = $request->post('parent_id');
                $record['created_at'] = $date;
 

       $result = DB::table('delegates')->insert($record);
       $id = DB::getPdo()->lastInsertId();

       $data1 = array('student_session_id' =>$request->post('student_session_id'),
          'parent_id'=>$request->post('parent_id'),
          'teacher_id'=>$request->post('teacher_id'),
          'student_id'=>$request->post('student_id'),
          'delegate_id'=>$id,
          'qr_code_id'=>$qr_code_id,
          'created_on'=>$date
        );    

      $data2 = DB::table('dispersal')->insert($data1);
                   
                     $qr = QrCode::size(300)->generate($qr_code_id);

                     $dataupload = file_put_contents('uploads/'. $qr_code_id . '.svg', $qr);

      if(!empty($dataupload && $dataupload != ''))
         {
          return response()->json(['status' => '200',//sample entry
   'message' => 'items found',
   'data'=>url('uploads/'. $qr_code_id . '.svg')]);  
        }
        else{
return response()->json(['status' => '404',//sample entry
   'message' => 'items not found']);  
        }
              }
  public function teacher_schedule(Request $request)
   {
    $teacher_id = $request->post('teacher_id');
    $data = DB::table('staff')
  ->leftjoin('teacher_subjects','teacher_subjects.teacher_id','=','staff.id')
  ->leftjoin('timetables','timetables.teacher_subject_id','=','teacher_subjects.id')
  ->leftjoin('class_sections','class_sections.id','=','teacher_subjects.class_section_id')
  ->leftjoin('classes','classes.id','=','class_sections.class_id')
  ->leftjoin('sections','sections.id','=','class_sections.section_id')
  ->leftjoin('subjects','subjects.id','=','teacher_subjects.subject_id')
  ->leftjoin('subject_icons','subject_icons.subject_id','=','subjects.id')
  ->where('staff.id',$teacher_id )
  ->select('timetables.*','staff.name as teacher_name','classes.class', 'sections.section','subjects.name as subject_name','subject_icons.subject_icon','classes.id as class_id','sections.id as section_id')
  ->get();

     if(!empty($data[0]) && $data[0] != '')
         {
          return response()->json(['status' => '200',//sample entry
   'message' => 'items found',
   'data'=>$data]);  
        }
        else{
return response()->json(['status' => '404',//sample entry
   'message' => 'items not found']);  
        }

    
   }

   public function delegateLists($parent_id)
   {
    $datas = DB::table('sch_settings')->select('sch_settings.*')->get();
    $data = DB::table('delegates')
    ->leftjoin('students','students.id','=','delegates.student_id')
    ->leftjoin('student_session','student_session.student_id','=','students.id')
    ->leftjoin('classes','classes.id','=','student_session.class_id')
    ->leftjoin('sections','sections.id','=','student_session.section_id')
    ->where('student_session.session_id',$datas[0]->session_id)
    ->where('delegates.parent_id',$parent_id)
    ->select('delegates.*','classes.class','sections.section')->orderby('from_date','desc')->groupby('delegates.delegate_id')->get();
    if(!empty($data[0]) && $data[0] != '')
         {
          return response()->json(['status' => '200',//sample entry
   'message' => 'items found',
   'data'=>$data]);  
        }
        else{
return response()->json(['status' => '404',//sample entry
   'message' => 'items not found']);  
        }

   }

    public function InsertUpdateSubjectBooks(Request $request)
   {
    
        if (empty($request->post('id'))) {
        
               $record['subject_id'] = $request->post('subject_id');
                $record['class_id'] = $request->post('class_id');
                $record['book_name'] = $request->post('book_name');
                
                $result = DB::table('subject_books')->insert($record);
                 if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'item inserted',
                                   'data'=>$record]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not inserted']
                                   );  
            }
              }
                else
                {
                  
               $record['subject_id'] = $request->post('subject_id');
                $record['class_id'] = $request->post('class_id');
                $record['book_name'] = $request->post('book_name');
                
                $result = DB::table('subject_books')->where('subject_book_id',$request->post('id'))->update($record);
                 if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'items updated',
                                   'data'=>$record]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not updated']
                                   );  
            }
          }
       } 


   public function attendenceType(Request $request)
   {
    
        if (empty($request->post('id'))) {
         $validextensions = array("jpeg", "jpg", "png","pdf", "svg");
                $temporary1 = explode('.', $_FILES["image"]["name"]);
                $file_extension1 = end($temporary1);

                if($validextensions){

                    $imageType1 = explode('.', $_FILES["image"]["name"]);

                    $image = 'image' . rand() . '.' . $imageType1[1];

                    $sourcePath1 = $_FILES['image']['tmp_name'];

                    $targetPath1 = base_path() . '/uploads/' . $image;

                    if (move_uploaded_file($sourcePath1, $targetPath1) )
                        $record['image'] = $image;
                }
          $record['code'] = $request->post('code');
               $record['type'] = $request->post('type');
                $record['is_active'] = $request->post('is_active');
                
                $result = DB::table('attendence_type')->insert($record);
                 if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'item inserted',
                                   'data'=>$record]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not inserted']
                                   );  
            }
              }
                else
                {
                  $validextensions = array("jpeg", "jpg", "png","pdf", "svg");
                $temporary1 = explode('.', $_FILES["image"]["name"]);
                $file_extension1 = end($temporary1);

                if($validextensions){

                    $imageType1 = explode('.', $_FILES["image"]["name"]);

                    $image = 'image' . rand() . '.' . $imageType1[1];

                    $sourcePath1 = $_FILES['image']['tmp_name'];

                    $targetPath1 = base_path() . '/uploads/' . $image;

                    if (move_uploaded_file($sourcePath1, $targetPath1) )
                        $record['image'] = $image;
                }
                  //$record['id'] = $request->post('id');
                $record['code'] = $request->post('code');
                $record['type'] = $request->post('type');
                $record['is_active'] = $request->post('is_active');
                
                $result = DB::table('attendence_type')->where('id',$request->post('id'))->update($record);
                 if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'items updated',
                                   'data'=>$record]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not updated']
                                   );  
            }
          }
       }  

       public function leaveType(Request $request)
   {
    
        if (empty($request->post('id'))) {
        
         $imageType1 = explode('.', $_FILES["image"]["name"]);

                    $image = 'image' . rand() . '.' . $imageType1[1];

                    $sourcePath1 = $_FILES['image']['tmp_name'];

                    $targetPath1 = base_path() . '/uploads/' . $image;

                    if (move_uploaded_file($sourcePath1, $targetPath1))
                    $record['leave_icon'] = $image;
               $record['type'] = $request->post('type');
                $record['is_active'] = $request->post('is_active');
                
                $result = DB::table('leave_type')->insert($record);
                 if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'item inserted',
                                   'data'=>$record]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not inserted']
                                   );  
            }
              }
                else
                {
                   $imageType1 = explode('.', $_FILES["image"]["name"]);

                    $image = 'image' . rand() . '.' . $imageType1[1];

                    $sourcePath1 = $_FILES['image']['tmp_name'];

                    $targetPath1 = base_path() . '/uploads/' . $image;

                    if (move_uploaded_file($sourcePath1, $targetPath1))
                    $record['leave_icon'] = $image;
                  //$record['id'] = $request->post('id');
                $record['type'] = $request->post('type');
                $record['is_active'] = $request->post('is_active');
                
                $result = DB::table('leave_type')->where('id',$request->post('id'))->update($record);
                 if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'items updated',
                                   'data'=>$record]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not updated']
                                   );  
            }
          }
       }  


public function uploadicons(Request $request)
   {

        
                $validextensions = array("jpeg", "jpg", "png","pdf","svg");
                $temporary1 = explode('.', $_FILES["image"]["name"]);
                $file_extension1 = end($temporary1);

               if ((($_FILES["image"]["type"] == "image/png") || ($_FILES["image"]["type"] == "image/jpg") || ($_FILES["image"]["type"] == "image/svg") || ($_FILES["image"]["type"] == "application/pdf") || ($_FILES["image"]["type"] == "image/jpeg")
                        ) && ($_FILES["image"]["size"] < 40000000) && in_array($file_extension1, $validextensions)){

                    $imageType1 = explode('.', $_FILES["image"]["name"]);

                    $image = 'image' . rand() . '.' . $imageType1[1];

                    $sourcePath1 = $_FILES['image']['tmp_name'];

                    $targetPath1 = base_path() . '/uploads/icons/' . $image;

                    if (move_uploaded_file($sourcePath1, $targetPath1) )
                        $record['image'] = $image;
                }   
              
       $result = DB::table('icons')->insert($record);
             if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'item inserted',
                                   'data'=>$record]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not inserted']
                                   );  
            }

     }

 public function InsertUpdateSubjectIcon(Request $request)
   {
    
        if (empty($request->post('id'))) {
        
               $record['subject_icon'] = $request->post('image');
                $record['subject_id'] = $request->post('subject_id');

                $result = DB::table('subject_icons')->insert($record);
                 if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'item inserted',
                                   'data'=>$record]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not inserted']
                                   );  
            }
              }
                else
                {
               $record['subject_icon'] = $request->post('image');
                $record['subject_id'] = $request->post('subject_id');
                
                $result = DB::table('subject_icons')->where('id',$request->post('id'))->update($record);
                 if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'items updated',
                                   'data'=>$record]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not updated']
                                   );  
            }
          }
       }  

       public function galleryUploads(Request $request)
    {
      
         $targetDir = "uploads/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
     
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES['files']['name']); 
    if(!empty($fileNames)){ 
        foreach($_FILES['files']['name'] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
             
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                    // Image db insert sql 
                    $insertValuesSQL .= "".$fileName.","; 
                }else{ 
                    $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                } 
            }else{ 
                $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            } 
        } 
        if(!empty($insertValuesSQL)){ 
            $insertValuesSQL = trim($insertValuesSQL, ','); 
            $record['photos'] = $insertValuesSQL;
            $record['class'] = $request->post('class');
        $record['section'] = $request->post('section');
        $record['session'] = $request->post('session');
        $record['date'] = $request->post('date');
        $record['title'] = $request->post('title');
        $record['description'] = $request->post('description');
        
        $record['videos'] = $request->post('videos_url');
            // Insert image file name into database 
            $insert =  DB::table('gallery')->insert($record);
            if(isset($insert) && $insert != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'item inserted',
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
        }
      
         
    


     public function galleryupdate(Request $request)
    {

      $id=$request->post('id');
       

                $targetDir = "uploads/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
     
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES['files']['name']); 
    if(!empty($fileNames)){ 
        foreach($_FILES['files']['name'] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
             
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                    // Image db insert sql 
                    $insertValuesSQL .= "".$fileName.","; 
                }else{ 
                    $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                } 
            }else{ 
                $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            } 
        } 
        if(!empty($insertValuesSQL)){ 
            $insertValuesSQL = trim($insertValuesSQL, ','); 
            $record['photos'] = $insertValuesSQL;
            $record['class'] = $request->post('class');
        $record['section'] = $request->post('section');
        $record['session'] = $request->post('session');
        $record['date'] = $request->post('date');
        $record['title'] = $request->post('title');
        $record['description'] = $request->post('description');
        
        $record['videos'] = $request->post('videos_url');

         $data = DB::table('gallery')->where('id',$id)->update($record);
  if(isset($data) && $data != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'item updated',
                                   'data'=>$data]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not updated']
                                   );  
            }
         
    }
  }
}
    public function listGallery()
   {

      $data = DB::table('gallery')
  ->select('gallery.*')
  ->get();
  
     if(!empty($data[0]) && $data[0] != '')
         {
          return response()->json(['status' => '200',//sample entry
   'message' => 'items found',
   'data'=>$data]);  
        }
        else{
return response()->json(['status' => '404',//sample entry
   'message' => 'items not found']);  
        }

    
   }

   public function listLeaveType()
   {

      $data = DB::table('leave_type')
  ->select('leave_type.*')
  ->get();
  
     if(!empty($data[0]) && $data[0] != '')
         {
          return response()->json(['status' => '200',//sample entry
   'message' => 'items found',
   'data'=>$data]);  
        }
        else{
return response()->json(['status' => '404',//sample entry
   'message' => 'items not found']);  
        }

    
   }

public function listContents()
   {

      $data = DB::table('contents')
  ->select('contents.*')
  ->get();
  
     if(!empty($data[0]) && $data[0] != '')
         {
          return response()->json(['status' => '200',//sample entry
   'message' => 'items found',
   'data'=>$data]);  
        }
        else{
return response()->json(['status' => '404',//sample entry
   'message' => 'items not found']);  
        }

    
   }

   public function listAttendance()
   {

      $data = DB::table('attendence_type')
  ->select('attendence_type.*')
  ->get();
  
     if(!empty($data[0]) && $data[0] != '')
         {
          return response()->json(['status' => '200',//sample entry
   'message' => 'items found',
   'data'=>$data]);  
        }
        else{
return response()->json(['status' => '404',//sample entry
   'message' => 'items not found']);  
        }

    
   }

   public function subjectIcon()
   {
    
     $data = DB::table('subject_icons')->leftjoin('subjects','subjects.id','=','subject_icons.subject_id')->select('subject_icons.*', 'subjects.*', 'subject_icons.id as subicon_id')->get();
    
    if(!empty($data[0]) && $data[0] != '')
         {
          return response()->json(['status' => '200',//sample entry
   'message' => 'items found',
   'data'=>$data]);  
        }
        else{
return response()->json(['status' => '404',//sample entry
   'message' => 'items not found']);  
        }

   
   }

   public function uploadContents(Request $request)
   {
               if (empty($request->post('id'))) {
                $validextensions = array("jpeg", "jpg", "png","pdf");
                $temporary1 = explode('.', $_FILES["file"]["name"]);
                $file_extension1 = end($temporary1);

                if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "application/pdf") || ($_FILES["file"]["type"] == "image/jpeg")
                        ) && ($_FILES["file"]["size"] < 40000000) && in_array($file_extension1, $validextensions)){

                    $imageType1 = explode('.', $_FILES["file"]["name"]);

                    $image = 'file' . rand() . '.' . $imageType1[1];

                    $sourcePath1 = $_FILES['file']['tmp_name'];

                    $targetPath1 = base_path() . '/uploads/' . $image;

                    if (move_uploaded_file($sourcePath1, $targetPath1) )
                        $record['file'] = $image;
                }
              
                $record['title'] = $request->post('title');
                $record['type'] = $request->post('type');
                $record['is_public'] = $request->post('is_public');
                $record['class_id'] = $request->post('class_id');
                $record['cls_sec_id'] = $request->post('cls_sec_id');
                $record['note'] = $request->post('note');
                $record['is_active'] = $request->post('is_active');
                $record['date'] = $request->post('date');
                $record['created_by'] = $request->post('created_by');
               
                $result = DB::table('contents')->insert($record);
            
            if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'item inserted',
                                   'data'=>$record]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not inserted']
                                   );  
            }
          }
            else{

              $validextensions = array("jpeg", "jpg", "png","pdf");
                $temporary1 = explode('.', $_FILES["file"]["name"]);
                $file_extension1 = end($temporary1);

                if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "application/pdf") || ($_FILES["file"]["type"] == "image/jpeg")
                        ) && ($_FILES["file"]["size"] < 40000000) && in_array($file_extension1, $validextensions)){

                    $imageType1 = explode('.', $_FILES["file"]["name"]);

                    $image = 'file' . rand() . '.' . $imageType1[1];

                    $sourcePath1 = $_FILES['file']['tmp_name'];

                    $targetPath1 = base_path() . '/uploads/' . $image;

                    if (move_uploaded_file($sourcePath1, $targetPath1) )
                        $record['file'] = $image;
                }
              
                $record['title'] = $request->post('title');
                $record['type'] = $request->post('type');
                $record['is_public'] = $request->post('is_public');
                $record['class_id'] = $request->post('class_id');
                $record['cls_sec_id'] = $request->post('cls_sec_id');
                $record['note'] = $request->post('note');
                $record['is_active'] = $request->post('is_active');
                $record['date'] = $request->post('date');
                $record['created_by'] = $request->post('created_by');
               
        $result = DB::table('contents')->where('id',$request->post('id'))->update($record);
            
            if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'item updated',
                                   'data'=>$record]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not inserted']
                                   );  
            }
            }
         
   }
   public function pdf($id)
{
  $data = DB::table('student_fees_master')
    ->leftjoin('fee_session_groups', 'fee_session_groups.id','=','student_fees_master.fee_session_group_id')
    ->leftjoin('fee_groups_feetype', 'fee_groups_feetype.fee_session_group_id','=','fee_session_groups.id')
    ->leftjoin('fee_groups', 'fee_groups.id','=','fee_groups_feetype.fee_groups_id')
    ->leftjoin('feetype', 'feetype.id','=','fee_groups_feetype.feetype_id')
    ->leftjoin('student_fees_deposite', 'student_fees_deposite.student_fees_master_id','=','student_fees_master.id')
    ->leftjoin('student_session','student_session.id','student_fees_master.student_session_id')
    ->leftjoin('students','students.id','student_session.student_id')
    ->where('student_session.id', $id)
    ->select('student_fees_master.*','fee_session_groups.*','fee_groups_feetype.*','fee_groups.*','feetype.*','student_fees_deposite.*','students.firstname','students.lastname')->get();
 return response()->json(['status' => '200',//sample entry
                                   'message' => 'item updated',
                                   'data'=>$data]
                                   );  
}


public function changePassword(Request $request)
{
  
   $record['password'] = $request->post('password');
    $record['passwordp'] = $request->post('password');
   $result = DB::table('users')->where('id',$request->post('id'))->update($record);

   if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'item updated',
                                   'data'=>$record]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not updated']
                                   );  
            }
            }
public function child_of_parent(Request $request)
{
   $datas = DB::table('sch_settings')->select('sch_settings.*')->get();
  $data = DB::table('students')
          ->leftjoin('student_session','student_session.student_id','=','students.id')
          ->leftjoin('classes','classes.id','=','student_session.class_id')
          ->leftjoin('sections','sections.id','=','student_session.section_id')
          ->where('students.parent_id',$request->post('parent_id'))
          ->where('student_session.session_id',$datas[0]->session_id)
          ->select('students.*','student_session.*','classes.class','sections.section')
          ->get();

   if(!empty($data[0]) && $data[0] != '')
         {
          return response()->json(['status' => '200',//sample entry
   'message' => 'items found',
   'data'=>$data]);  
        }
        else{
return response()->json(['status' => '404',//sample entry
   'message' => 'items not found']);  
        }
}

public function subjectBooks(Request $request)
   {
   
  $data = DB::table('subject_books')
    ->leftjoin('subjects','subjects.id','=','subject_books.subject_id')
    ->leftjoin('classes','classes.id','=','subject_books.class_id')
    ->where('subjects.id',$request->post('subject_id'))
    ->where('classes.id',$request->post('class_id'))
    ->select('subject_books.*','subjects.name','classes.class')->get();
if(!empty($data[0]) && $data[0] != '')
         {
          return response()->json(['status' => '200',//sample entry
   'message' => 'items found',
   'data'=>$data]);  
        }
        else{
return response()->json(['status' => '404',//sample entry
   'message' => 'items not found']);  
        }

}

public function showTimeline(Request $request)
   {
   
  $data = DB::table('student_timeline')
    ->where('student_id',$request->post('student_id'))
    ->select('student_timeline.*')->get();
if(!empty($data[0]) && $data[0] != '')
         {
          return response()->json(['status' => '200',//sample entry
   'message' => 'items found',
   'data'=>$data]);  
        }
        else{
return response()->json(['status' => '404',//sample entry
   'message' => 'items not found']);  
        }

}

public function addTimelines(Request $request)
{
 $validextensions = array("jpeg", "jpg", "png","pdf");
                $temporary1 = explode('.', $_FILES["document"]["name"]);
                $file_extension1 = end($temporary1);

                if ((($_FILES["document"]["type"] == "image/png") || ($_FILES["document"]["type"] == "image/jpg") || ($_FILES["document"]["type"] == "application/pdf") || ($_FILES["document"]["type"] == "image/jpeg")
                        ) && ($_FILES["document"]["size"] < 40000000) && in_array($file_extension1, $validextensions)){

                    $imageType1 = explode('.', $_FILES["document"]["name"]);

                    $attachment = 'document' . rand() . '.' . $imageType1[1];

                    $sourcePath1 = $_FILES['document']['tmp_name'];

                    $targetPath1 = base_path() . '/uploads/' . $attachment;

                    if (move_uploaded_file($sourcePath1, $targetPath1) )
                        $record['document'] = $attachment;
                }
  
  $record['student_id'] = $request->post('student_id');
    $record['timeline_date'] = $request->post('timeline_date');
  $record['title'] = $request->post('title');
  $record['description'] = $request->post('description');
  $record['date'] = date('Y-m-d');
  $record['status'] = $request->post('status');
  $result = DB::table('student_timeline')->insert($record);
            
            if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'item inserted',
                                   'data'=>$record]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not inserted']
                                   );  
            }

                
}
public function staffTimeline(Request $request)
   {
   
  $data = DB::table('staff_timeline')
    ->where('staff_id',$request->post('staff_id'))
    ->select('staff_timeline.*')->get();
if(!empty($data[0]) && $data[0] != '')
         {
          return response()->json(['status' => '200',//sample entry
   'message' => 'items found',
   'data'=>$data]);  
        }
        else{
return response()->json(['status' => '404',//sample entry
   'message' => 'items not found']);  
        }

}
public function teacherPerformance(Request $request)
{
    $staff_id = $request->post('staff_id');
    $homeworkid = $request->post('homeworkid');
    $class_id = $request->post('class_id');
    $section_id = $request->post('section_id');
    $attendance = DB::table('staff_attendance')
    ->leftjoin('staff_attendance_type','staff_attendance_type.id','=','staff_attendance.staff_attendance_type_id')
    ->leftjoin('staff','staff.id','=','staff_attendance.staff_id')
    ->where('staff.id',$staff_id)
    ->select('staff_attendance.*','staff_attendance.id as stf_atd_id','staff.*','staff_attendance_type.*')
    ->get();
    $staff = DB::table('staff')
    ->where('staff.id',$staff_id)
    ->select('staff.*')
    ->get();
    $data= array();
    $present=0;
    $absent=0;
    $i=0;
  
    foreach ($attendance as $key => $value) {

      if ($value->staff_attendance_type_id == '1') {
       $present++;
       $i++;
      }
      elseif ($value->staff_attendance_type_id == '2') {
        $present++;
         $i++;
      }
       elseif ($value->staff_attendance_type_id == '3') {
        $absent++;
         $i++;
      }
      elseif ($value->staff_attendance_type_id == '4') {
        $present++;
         $i++;
      }
      
    }
    if(!empty($present))
    {
    $atd_avg = ($present / $i)  * 100;
     }else{
      $atd_avg = 0;
     }

     $homework = DB::table('staff')
     ->leftjoin('homework','staff.id','=','homework.staff_id')
     ->leftjoin('subjects','subjects.id','homework.subject_id')
     ->leftjoin('classes','classes.id','homework.class_id')
     ->leftjoin('sections','sections.id','homework.section_id')
     ->leftjoin('homework_evaluation','homework_evaluation.homework_id','=','homework.id')
     ->leftjoin('students','students.id','=','homework_evaluation.student_id')
     ->where('homework.id',$homeworkid)
     ->where('staff.id',$staff_id)
     ->where('homework.class_id',$class_id)
     ->where('homework.section_id',$section_id)
     ->select('homework.*','staff.name as stf_name','subjects.name as sub_name','students.firstname as stu_name','homework.id as homework_id','classes.class','sections.section','students.id as stu_id','homework_evaluation.date as eval_date')
     ->get();
     
     $data=0;
     $empty_eval = 0;
     $sub = 0;
     $k=0;
    
     foreach ($homework as $value1) {
      if($value1->eval_date != 0)
      {
        $eval_date = str_replace('-', '', $value1->eval_date);
      $evaluate = substr($eval_date, -3);
      $submit_date = str_replace('-', '',$value1->submit_date);
      $submission = substr($submit_date, -3);
     
      $sub = (int)$evaluate - (int)$submission;
    
      $data = (int)$data + (int)$sub;
      
      $k++;
      }
      elseif ($value1->eval_date == 0) {
        $empty_eval++;
       $k++;
      }

     }
     if(!empty($data))
     {
      $final2 = $data / $k;
     }
     else{
      $final2 = '';
     }

     $data_uncheck = DB::table('staff')
     ->leftjoin('homework','staff.id','=','homework.staff_id')
     ->where('staff.id',$staff_id)
     ->select('homework.*','staff.*')
     ->get();
     $uncheck_eval =0;
     $m=0;
     foreach ($data_uncheck as $value4) {
        if ($value4->evaluated_by == '0') {
         $uncheck_eval++;
        }
        $m++;
     }
     $total_uncheck = $m / $uncheck_eval ;
    
      $data1['unchecked_work'] = $total_uncheck;
      $data1['avg_evaluation'] = $final2;
       $data1['present'] = $present;
       $data1['absent'] = $absent;
       $data1['avg_atd'] = $atd_avg;
       $data1['staff'] = $staff;
       $data1['homework'] = $homework;
      if(!empty($data1['staff'][0]) && $data1['staff'][0] != '')
         {
          return response()->json(['status' => '200',//sample entry
   'message' => 'items found',
   'data'=>$data1]);  
        }
        else{
return response()->json(['status' => '404',//sample entry
   'message' => 'items not found']);  
        }
    }

    public function addUpdatePole(Request $request)
   {
        if (empty($request->post('id'))) {
        
               $record['title'] = $request->post('title');    
                 $record['is_teacher'] = $request->post('is_teacher');
                $record['is_parent'] = $request->post('is_parent');
                $record['is_student'] = $request->post('is_student');
                
                $result = DB::table('poll')->insert($record);
                 if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'item inserted',
                                   'data'=>$record]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not inserted']
                                   );  
            }
              }
                else
                {
                  
                $record['title'] = $request->post('title');
               
                 $record['is_teacher'] = $request->post('is_teacher');
                $record['is_parent'] = $request->post('is_parent');
                $record['is_student'] = $request->post('is_student');
                $result = DB::table('poll')->where('poll_id',$request->post('id'))->update($record);
                 if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'items updated',
                                   'data'=>$record]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not updated']
                                   );  
            }
                }
              
         
   }

   public function addUpdatePoleAns(Request $request)
   {
        if (empty($request->post('id'))) {
              $record['ans'] = $request->post('title');
               $record['poll_id'] = $request->post('pole_id');
                
                $result = DB::table('poll_ans')->insert($record);
                 if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'item inserted',
                                   'data'=>$record]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not inserted']
                                   );  
            }
              }
                else
                {
                  
                $record['ans'] = $request->post('title');
               $record['poll_id'] = $request->post('pole_id');
                $result = DB::table('poll_ans')->where('ans_id',$request->post('id'))->update($record);
                 if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'items updated',
                                   'data'=>$record]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not updated']
                                   );  
            }
                }
              
         
   }

   public function getPole(Request $request)
   {


  $pole = DB::table('pole')->select('pole.*')->paginate(2);

    foreach ($pole as $key => $value) {
      $results = DB::table('pole_answers')->where('pole_answers.pole_id', $value->id)->select('pole_answers.*')->get();
      $data['que']=$value;
      $data['ans']=$results;
      $result[$key]= $data;
    }

   if(!empty($result) && $result != '')
         {
          return response()->json(['status' => '200',//sample entry
   'message' => 'items found',
   'data'=>$result]);  
        }
        else{
return response()->json(['status' => '404',//sample entry
   'message' => 'items not found']);  
        }

}
 public function addPoleVotes(Request $request)
   {

                    $set = DB::table('pole_answers')->where('id',$request->post('id'))->get();
                    
                    $total = $set[0]->votes + 1;
                    $record['votes'] = $total;

                $result = DB::table('pole_answers')->where('id',$request->post('id'))->update($record);
                 if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'items updated',
                                   'data'=>$record]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not updated']
                                   );  
            }
   }

   public function staffAttendenceType(Request $request)
   {
    
        if (empty($request->post('id'))) {
         $validextensions = array("jpeg", "jpg", "png","pdf", "svg");
                $temporary1 = explode('.', $_FILES["image"]["name"]);
                $file_extension1 = end($temporary1);

                if($validextensions){

                    $imageType1 = explode('.', $_FILES["image"]["name"]);

                    $image = 'image' . rand() . '.' . $imageType1[1];

                    $sourcePath1 = $_FILES['image']['tmp_name'];

                    $targetPath1 = base_path() . '/uploads/' . $image;

                    if (move_uploaded_file($sourcePath1, $targetPath1) )
                        $record['image'] = $image;
                }
          $record['code'] = $request->post('code');
          $record['key_value'] = $request->post('key_value');
               $record['type'] = $request->post('type');
                $record['is_active'] = $request->post('is_active');
                
                $result = DB::table('staff_attendance_type')->insert($record);
                 if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'item inserted',
                                   'data'=>$record]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not inserted']
                                   );  
            }
              }
                else
                {
                  $validextensions = array("jpeg", "jpg", "png","pdf", "svg");
                $temporary1 = explode('.', $_FILES["image"]["name"]);
                $file_extension1 = end($temporary1);

                if($validextensions){

                    $imageType1 = explode('.', $_FILES["image"]["name"]);

                    $image = 'image' . rand() . '.' . $imageType1[1];

                    $sourcePath1 = $_FILES['image']['tmp_name'];

                    $targetPath1 = base_path() . '/uploads/' . $image;

                    if (move_uploaded_file($sourcePath1, $targetPath1) )
                        $record['image'] = $image;
                }
                  //$record['id'] = $request->post('id');
                 $record['key_value'] = $request->post('key_value');
                $record['code'] = $request->post('code');
                $record['type'] = $request->post('type');
                $record['is_active'] = $request->post('is_active');
                
                $result = DB::table('staff_attendance_type')->where('id',$request->post('id'))->update($record);
                 if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'items updated',
                                   'data'=>$record]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not updated']
                                   );  
            }
          }
       } 

        public function getStaffAttendenceType(Request $request)
   {


  $pole = DB::table('staff_attendance_type')->select('staff_attendance_type.*')->get();


   if(!empty($pole) && $pole != '')
         {
          return response()->json(['status' => '200',//sample entry
   'message' => 'items found',
   'data'=>$pole]);  
        }
        else{
return response()->json(['status' => '404',//sample entry
   'message' => 'items not found']);  
        }

}

   }