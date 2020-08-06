<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use DB;
use Bitly;

class qrController extends Controller
{
   public function index()
   {
    $data = DB::table('student_session')
    ->leftjoin('students','students.id','=','student_session.student_id')
    ->leftjoin('classes','classes.id','=','student_session.class_id')
    ->leftjoin('sections','sections.id','=','student_session.section_id')
    ->select('students.*','classes.class','sections.section','student_session.*','students.id as stu_id')
    ->orderby('student_session.id','desc')->get();
   
    return view('welcome',['data'=>$data]);

   }
   public function sendqr($id)
   {
      $data = DB::table('students')->where('id',$id)->select('students.*')->get(); 
     $value= json_encode($data);
     $qr = QrCode::size(300)->generate($value);
    
return response()->json($qr);

    
   }

   public function read()
   {

         $data = DB::table('students')->where('id',$code)->select('students.*')->get();
          return view('read', ['data'=>$data]);
   }


   public function submit(Request $request)
   {
         $data1 = array('add_no' =>$request->post('add_no'),
          'fname'=>$request->post('fname'),
           'mname'=>$request->post('mname'));
         $data = DB::table('history')->insert($data1);
         echo "submitted sucessfully";
         
   }
    public function upload_submit(Request $request)
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

                $result = DB::table('leave')->insert($record);
                return $result;
} 



 public function disciplinehome(Request $request)
   {  
    $datas = DB::table('sch_settings')->select('sch_settings.*')->get();
    
 
          $cdate =  date('Y-m-d');
          $classdata = DB::table('classes')->select('classes.*')->get();
          $sessiondata = DB::table('sessions')->select('sessions.*')->get();
          $sectiondata = DB::table('sections')->select('sections.*')->get();
          $class = $request->query('class', '');
          $date = $request->query('date', '');
          $section = $request->query('section', '');
          $session = $request->query('session', '');

          /*$pop = DB::table('students')
          ->leftjoin('student_session', 'student_session.student_id','=', 'students.id')
          ->leftjoin('classes', 'student_session.class_id', '=', 'classes.id')
          ->leftjoin('sections', 'sections.id', '=', 'student_session.section_id')
          ->leftjoin('sessions', 'sessions.id', '=', 'student_session.session_id')
          ->leftjoin('discipline', 'discipline.stu_id', '=', 'students.id')
          ->where('student_session.session_id', $datas[0]->session_id)
          ->where('student_session.class_id', $class)
          ->where('student_session.section_id', $section)
          ->where('discipline.card_issued', '!=','')
          ->select('students.*','students.id as stu_id','student_session.*','classes.class','sections.section','sessions.session','discipline.*')->get();*/
         
         
          $query1 = DB::table('students')
          ->leftjoin('student_session', 'student_session.student_id','=', 'students.id')
          ->leftjoin('classes', 'student_session.class_id', '=', 'classes.id')
          ->leftjoin('sections', 'sections.id', '=', 'student_session.section_id')
          ->leftjoin('sessions', 'sessions.id', '=', 'student_session.session_id')
          ->where('student_session.session_id', $datas[0]->session_id)
          ->select('students.*','students.id as stu_id','student_session.*','classes.class','sections.section','sessions.session');
          if ($class != '') {
            $query1->where('student_session.class_id', $class);
          }
          if ($section != '') {
            $query1->where('student_session.section_id', $section);
          }
       
          $query2 = $query1->get();
       
          $data = array();
          $i = 0;
        $c=0;
          foreach ($query2 as $key => $value) {

            $query3 = DB::table('discipline')
          ->where('stu_id',$value->stu_id)
          ->where('date', $date)
          ->select('discipline.*')->get();

        
           $countdata = DB::table('discipline')
          ->where('stu_id', $value->stu_id)
          ->select('discipline.*')
          ->get();

          /*foreach ($countdata as $cntdata) {
              if($cntdata->card_issued != '')
              {
                $c++;
              }
          }*/
      

            $data1['detail'] = $value;
            $data1['discipline'] = $query3;
            //$data1['count'] = $c;
            $data[$key] = $data1;
           
          }      
           
    $count = DB::table('discipline')->leftjoin('students','students.id','=','discipline.stu_id')->select('discipline.*','students.firstname', 'students.lastname')->orderby('discipline.date','DESC')->get();

   
    return view('discipline',['data'=>$data, 'sessiondata'=>$sessiondata, 'sectiondata'=>$sectiondata, 'classdata'=>$classdata, 'count'=>$count]);
  

}
  
   public function insert_disciplines(Request $request)
      {
       $datas = DB::table('sch_settings')->select('sch_settings.*')->get();
          $sessiondata = DB::table('sessions')
          ->where('sessions.id',$datas[0]->session_id)
           ->select('sessions.session')
           ->get();
           $date =  $request->post('datedata');
           $discipline = DB::table('discipline')->where('date',$date)->select('discipline.*')->get();
        
       $stu_idd=$request->post('stu_idd');
       $datanew=array();
  if(!empty($discipline[0]))
   {
  foreach($stu_idd as $std)
  {
   $datanew['stu_id']=$std;
   if($request->post('stu_name'.$std) != '')
   {
   $datanew['stu_name']=$request->post('stu_name'.$std);  
   }
   else
   {
    $datanew['stu_name']="";   
   }

   if($request->post('session'.$std) != '')
   {
   $datanew['session']=$request->post('session'.$std);  
   }
   else
   {
    $datanew['session']=""; 
   }
   
   if($request->post('class'.$std) != '')
   {
   $datanew['class']=$request->post('class'.$std);  
   }
   else
   {
    $datanew['class']="";   
   }

   if($request->post('section'.$std) != '')
   {
   $datanew['section']=$request->post('section'.$std);  
   }
   else
   {
    $datanew['section']="";   
   }
   if($request->post('late'.$std) != '')
   {
   $datanew['late']="Yes";  
   }
   else
   {
    $datanew['late']="No";   
   }
   if($request->post('dress'.$std) != '')
   {
   $datanew['dress']="Yes";  
   }
   else
   {
    $datanew['dress']="No";   
   }
   if($request->post('socks'.$std) != '')
   {
   $datanew['socks']="Yes";  
   }
   else
   {
    $datanew['socks']="No";   
   }

   if($request->post('shoes'.$std) != '')
   {
   $datanew['shoes']="Yes";  
   }
   else
   {
    $datanew['shoes']="No";   
   }
   if($request->post('belt'.$std) != '')
   {
   $datanew['belt']="Yes";  
   }
   else
   {
    $datanew['belt']="No";   
   }

   if($request->post('handkerchief'.$std) != '')
   {
   $datanew['handkerchief']="Yes";  
   }
   else
   {
    $datanew['handkerchief']="No";   
   }
   if($request->post('icard'.$std) != '')
   {
   $datanew['icard']="Yes";  
   }
   else
   {
    $datanew['icard']="No";   
   }
   if($request->post('tie'.$std) != '')
   {
   $datanew['tie']="Yes";  
   }
   else
   {
    $datanew['tie']="No";   
   }

   if($request->post('blazer'.$std) != '')
   {
   $datanew['blazer']="Yes";  
   }
   else
   {
    $datanew['blazer']="No";   
   }
   if($request->post('hygiene'.$std) != '')
   {
   $datanew['hygiene']="Yes";  
   }
   else
   {
    $datanew['hygiene']="No";   
   }
   if($request->post('hair'.$std) != '')
   {
   $datanew['hair']="Yes";  
   }
   else
   {
    $datanew['hair']="No";   
   }
   if($request->post('nails'.$std) != '')
   {
   $datanew['nails']="Yes";  
   }
   else
   {
    $datanew['nails']="No";   
   }

   if($request->post('argumentative'.$std) != '')
   {
   $datanew['argumentative']="Yes";  
   }
   else
   {
    $datanew['argumentative']="No";   
   }
   if($request->post('abusive_lang'.$std) != '')
   {
   $datanew['abusive_lang']="Yes";  
   }
   else
   {
    $datanew['abusive_lang']="No";   
   }
   if($request->post('missconduct_teacher'.$std) != '')
   {
   $datanew['missconduct_teacher']="Yes";  
   }
   else
   {
    $datanew['missconduct_teacher']="No";   
   }

   if($request->post('missconduct_students'.$std) != '')
   {
   $datanew['missconduct_students']="Yes";  
   }
   else
   {
    $datanew['missconduct_students']="No";   
   }

   if($request->post('fights'.$std) != '')
   {
   $datanew['fights']="Yes";  
   }
   else
   {
    $datanew['fights']="No";   
   }
   if($request->post('defying_orders'.$std) != '')
   {
   $datanew['defying_orders']="Yes";  
   }
   else
   {
    $datanew['defying_orders']="No";   
   }
   if($request->post('class_bunk'.$std) != '')
   {
   $datanew['class_bunk']="Yes";  
   }
   else
   {
    $datanew['class_bunk']="No";   
   }

   if($request->post('card_issued'.$std) != '')
   {
   $datanew['card_issued']=$request->post('card_issued'.$std);  
   }
   else
   {
    $datanew['card_issued']="";   
   }

   if($request->post('remedial_measure'.$std) != '')
   {
   $datanew['remedial_measure']= $request->post('remedial_measure'.$std);  
   }
   else
   {
    $datanew['remedial_measure']="";   
   }

   if($request->post('remark'.$std) != '')
   {
   $datanew['remark']=$request->post('remark'.$std);  
   }
   else
   {
    $datanew['remark']="";   
   }

   if($request->post('date'.$std) != '')
   {
   $datanew['date']=$request->post('date'.$std);  
   }
   else
   {
    
    $datanew['date']=''; 
   }
  $result = DB::table('discipline')->where('stu_id',$std)->update($datanew);
  }
}else{
  foreach($stu_idd as $std)
  {
  $datanew['stu_id']=$std;
   if($request->post('stu_name'.$std) != '')
   {
   $datanew['stu_name']=$request->post('stu_name'.$std);  
   }
   else
   {
    $datanew['stu_name']="";   
   }

   if($request->post('session'.$std) != '')
   {
   $datanew['session']=$request->post('session'.$std);  
   }
   else
   {
    $datanew['session']=""; 
   }
   
   if($request->post('class'.$std) != '')
   {
   $datanew['class']=$request->post('class'.$std);  
   }
   else
   {
    $datanew['class']="";   
   }
   if($request->post('section'.$std) != '')
   {
   $datanew['section']=$request->post('section'.$std);  
   }
   else
   {
    $datanew['section']="";   
   }
   if($request->post('late'.$std) != '')
   {
   $datanew['late']="Yes";  
   }
   else
   {
    $datanew['late']="No";   
   }
   if($request->post('dress'.$std) != '')
   {
   $datanew['dress']="Yes";  
   }
   else
   {
    $datanew['dress']="No";   
   }
   if($request->post('socks'.$std) != '')
   {
   $datanew['socks']="Yes";  
   }
   else
   {
    $datanew['socks']="No";   
   }
   if($request->post('shoes'.$std) != '')
   {
   $datanew['shoes']="Yes";  
   }
   else
   {
    $datanew['shoes']="No";   
   }
   if($request->post('belt'.$std) != '')
   {
   $datanew['belt']="Yes";  
   }
   else
   {
    $datanew['belt']="No";   
   }

   if($request->post('handkerchief'.$std) != '')
   {
   $datanew['handkerchief']="Yes";  
   }
   else
   {
    $datanew['handkerchief']="No";   
   }
   if($request->post('icard'.$std) != '')
   {
   $datanew['icard']="Yes";  
   }
   else
   {
    $datanew['icard']="No";   
   }
   if($request->post('tie'.$std) != '')
   {
   $datanew['tie']="Yes";  
   }
   else
   {
    $datanew['tie']="No";   
   }

   if($request->post('blazer'.$std) != '')
   {
   $datanew['blazer']="Yes";  
   }
   else
   {
    $datanew['blazer']="No";   
   }
   if($request->post('hygiene'.$std) != '')
   {
   $datanew['hygiene']="Yes";  
   }
   else
   {
    $datanew['hygiene']="No";   
   }
   if($request->post('hair'.$std) != '')
   {
   $datanew['hair']="Yes";  
   }
   else
   {
    $datanew['hair']="No";   
   }
   if($request->post('nails'.$std) != '')
   {
   $datanew['nails']="Yes";  
   }
   else
   {
    $datanew['nails']="No";   
   }

   if($request->post('argumentative'.$std) != '')
   {
   $datanew['argumentative']="Yes";  
   }
   else
   {
    $datanew['argumentative']="No";   
   }
   if($request->post('abusive_lang'.$std) != '')
   {
   $datanew['abusive_lang']="Yes";  
   }
   else
   {
    $datanew['abusive_lang']="No";   
   }
   if($request->post('missconduct_teacher'.$std) != '')
   {
   $datanew['missconduct_teacher']="Yes";  
   }
   else
   {
    $datanew['missconduct_teacher']="No";   
   }

   if($request->post('missconduct_students'.$std) != '')
   {
   $datanew['missconduct_students']="Yes";  
   }
   else
   {
    $datanew['missconduct_students']="No";   
   }

   if($request->post('fights'.$std) != '')
   {
   $datanew['fights']="Yes";  
   }
   else
   {
    $datanew['fights']="No";   
   }
   if($request->post('defying_orders'.$std) != '')
   {
   $datanew['defying_orders']="Yes";  
   }
   else
   {
    $datanew['defying_orders']="No";   
   }
   if($request->post('class_bunk'.$std) != '')
   {
   $datanew['class_bunk']="Yes";  
   }
   else
   {
    $datanew['class_bunk']="No";   
   }

   if($request->post('card_issued'.$std) != '')
   {
   $datanew['card_issued']=$request->post('card_issued'.$std);  
   }
   else
   {
    $datanew['card_issued']="";   
   }

   if($request->post('remedial_measure'.$std) != '')
   {
   $datanew['remedial_measure']= $request->post('remedial_measure'.$std);  
   }
   else
   {
    $datanew['remedial_measure']="";   
   }

   if($request->post('remark'.$std) != '')
   {
   $datanew['remark']=$request->post('remark'.$std);  
   }
   else
   {
    $datanew['remark']="";   
   }

   if($request->post('date'.$std) != '')
   {
   $datanew['date']=$request->post('date'.$std);  
   }
   else
   {
    
    $datanew['date']=''; 
   }
    $result = DB::table('discipline')->insert($datanew);
  }
 } 
return redirect()->back();        
}

  public function update_disciplines(Request $request)
   {
           
   }

   public function paymentHistory()
   {
        
          return view('paymentHistory');
         
   }

public function dispersalList(Request $request)
   {
   
    $classdata = DB::table('classes')->select('classes.*')->get();
          $sessiondata = DB::table('sessions')->select('sessions.*')->get();
          $sectiondata = DB::table('sections')->select('sections.*')->get();
          $class_id = $request->query('class_id', '');
          $date = $request->query('date', '');
          $section_id = $request->query('section_id', '');
          $session_id = $request->query('session_id', '');

  $result = DB::table('dispersal')
  ->leftjoin('student_session','student_session.id','=','dispersal.student_session_id')
  ->leftjoin('delegates','delegates.delegate_id','=','dispersal.delegate_id')
  ->leftjoin('students','students.id','=','student_session.student_id')
  ->leftjoin('staff','staff.id','=','dispersal.dispersed_by')
  ->select('dispersal.*','students.*','staff.*','delegates.first_name','delegates.last_name','students.father_name as fname', 'students.mother_name as mname');
if ($class_id != '') {
            $result->where('student_session.class_id', $class_id);
          }
          if ($section_id != '') {
            $result->where('student_session.section_id', $section_id);
          }

         
          if ($date != '') {
            $result->where('dispersal.dispersed_on', $date);
          }

          $data = $result->paginate(10);


  return view('dispersal/list',['result'=>$data, 'classdata'=>$classdata, 'sessiondata'=>$sessiondata, 'sectiondata'=>$sectiondata]);

}

public function delegateList(Request $request)
   {
      
    $classdata = DB::table('classes')->select('classes.*')->get();
          $sessiondata = DB::table('sessions')->select('sessions.*')->get();
          $sectiondata = DB::table('sections')->select('sections.*')->get();
          $class_id = $request->query('class_id', '');
          $date = $request->query('date', '');
          $section_id = $request->query('section_id', '');
          $session_id = $request->query('session_id', '');

  $result = DB::table('delegates')
  ->leftjoin('dispersal','dispersal.delegate_id','delegates.delegate_id')
  ->leftjoin('student_session','student_session.id','=','dispersal.student_session_id')
  ->leftjoin('students','students.id','=','student_session.student_id')
  ->leftjoin('staff','staff.id','=','dispersal.dispersed_by')
  ->select('dispersal.*','students.*','staff.*','delegates.*','delegates.image as d_image','students.father_name as fname', 'students.mother_name as mname');

if ($class_id != '') {
            $result->where('student_session.class_id', $class_id);
          }
          if ($section_id != '') {
            $result->where('student_session.section_id', $section_id);
          }

         if ($session_id != '') {
            $result->where('student_session.session_id', $session_id);
          }
          if ($date != '') {
            $result->where('delegates.from_date', $date);
          }
          $data = $result->paginate(10);

  return view('delegate/list',['result'=>$data, 'classdata'=>$classdata, 'sessiondata'=>$sessiondata, 'sectiondata'=>$sectiondata]);

}

public function leaveListAdmin(Request $request)
   {
    
    $classdata = DB::table('classes')->select('classes.*')->get();
          $sessiondata = DB::table('sessions')->select('sessions.*')->get();
          $sectiondata = DB::table('sections')->select('sections.*')->get();
          $class_id = $request->query('class_id', '');
          $date = $request->query('date', '');
          $section_id = $request->query('section_id', '');
          $session_id = $request->query('session_id', '');

  $result = DB::table('student_leaves')
  ->leftjoin('student_session','student_session.id','=','student_leaves.student_session_id')
  ->leftjoin('students','students.id','=','student_session.student_id')
  ->select('student_leaves.*','students.*','student_session.*');


if ($class_id != '') {
            $result->where('student_session.class_id', $class_id);
          }
          if ($section_id != '') {
            $result->where('student_session.section_id', $section_id);
          }

          if ($date != '') {
            $result->where('student_leaves.leave_from', $date);
          }
          $result->orderby('student_leaves.id','DESC');
          $data = $result->paginate(10);

  return view('leave/list',['result'=>$data, 'classdata'=>$classdata, 'sessiondata'=>$sessiondata, 'sectiondata'=>$sectiondata]);

}


public function icons()
   {
    $data = DB::table('icons')->select('icons.*')->paginate(10);
    return view('icons/add-icons',['result'=>$data]);
   
   }
    public function deleteIcon($id)
   {
    
        $result1 = DB::table('icons')
        ->where('id',$id)
        ->select('icons.*')->delete();
          return redirect()->back();
         
   }

   public function uploadicon(Request $request)
   {
                

                    $imageType1 = explode('.', $_FILES["image"]["name"]);

                    $image = 'image' . rand() . '.' . $imageType1[1];

                    $sourcePath1 = $_FILES['image']['tmp_name'];

                    $targetPath1 = base_path() . '/uploads/icons' . $image;

                    if (move_uploaded_file($sourcePath1, $targetPath1))
                        $record['icons'] = $image;
                        $result = DB::table('icons')->insert($record);
                
              
              
     
             return redirect()->back();

     }

public function store_category()
   {
        $result = DB::table('store_category')->select('store_category.*')->paginate(10);
          return view('store-category/category',['result'=>$result]);
         
   }

    public function edit_store_category($id)
   {
    $result = DB::table('store_category')->select('store_category.*')->paginate(10);
        $result1 = DB::table('store_category')
        ->where('id',$id)
        ->select('store_category.*')->get();
          return view('/store-category/category-edit',['result'=>$result, 'result1'=>$result1]);
         
   }
 public function deleteCategory($id)
   {
    
        $result1 = DB::table('store_category')
        ->where('id',$id)
        ->select('store_category.*')->delete();
          return redirect()->back();
         
   }


public function subjectBook(Request $request)
   {
    $subjects = DB::table('subjects')->select('subjects.*')->get();
   $class = DB::table('classes')->select('classes.*')->get();
  $result = DB::table('subject_books')
    ->leftjoin('subjects','subjects.id','=','subject_books.subject_id')
    ->leftjoin('classes','classes.id','=','subject_books.class_id')
    ->select('subject_books.*','subjects.name','classes.class')->paginate(20);

  return view('subjectBooks',['result'=>$result, 'subject'=>$subjects, 'class'=>$class]);

}
public function editSubjectBook($id)
   {
    $subjects = DB::table('subjects')->select('subjects.*')->get();
   $class = DB::table('classes')->select('classes.*')->get();
    $result = DB::table('subject_books') 
    ->leftjoin('subjects','subjects.id','=','subject_books.subject_id')
    ->leftjoin('classes','classes.id','=','subject_books.class_id')
    ->select('subject_books.*','subjects.name','classes.class')->paginate(20);

    $result1 = DB::table('subject_books')
      ->leftjoin('subjects','subjects.id','=','subject_books.subject_id')
    ->leftjoin('classes','classes.id','=','subject_books.class_id')
    ->where('subject_book_id', $id)
    ->select('subject_books.*','subjects.name','classes.class')->get();

  return view('subjectBooks',['result1'=>$result1, 'result'=>$result, 'subject'=>$subjects, 'class'=>$class]);

}

public function deleteSubjectBook($id)
   {
  $data = DB::table('subject_books')->where('subject_book_id', $id)->select('subject_books.*')->delete();

  return redirect()->back();

  }

public function attendenceList(Request $request)
   {
  $result = DB::table('attendence_type')->select('attendence_type.*')->paginate(20);

  return view('attendence-type/list',['result'=>$result]);

}


public function editAttendenceList($id)
   {
    $result = DB::table('attendence_type')->select('attendence_type.*')->paginate(20);
  $result1 = DB::table('attendence_type')->where('id', $id)->select('attendence_type.*')->get();

  return view('attendence-type/list',['result1'=>$result1, 'result'=>$result]);

}

public function deleteAttendenceList($id)
   {
  $data = DB::table('attendence_type')->where('id', $id)->select('attendence_type.*')->delete();

  return redirect()->back();

  }


public function staffAttendenceList(Request $request)
   {
  $result = DB::table('staff_attendance_type')->select('staff_attendance_type.*')->paginate(20);

  return view('staff-attendence-type/list',['result'=>$result]);

}


public function editStaffAttendenceList($id)
   {
    $result = DB::table('staff_attendance_type')->select('staff_attendance_type.*')->paginate(20);
  $result1 = DB::table('staff_attendance_type')->where('id', $id)->select('staff_attendance_type.*')->get();

  return view('staff-attendence-type/list',['result1'=>$result1, 'result'=>$result]);

}

public function deleteStaffAttendenceList($id)
   {
  $data = DB::table('staff_attendance_type')->where('id', $id)->select('staff_attendance_type.*')->delete();

  return redirect()->back();

  }

  public function staffAttendenceTypeInsert(Request $request)
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
           return redirect()->back()->with('success','Attendance type successfully inserted.');
            }
        else{
             return redirect()->back()->with('success','Not inserted.');
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
                  $record['code'] = $request->post('code');
                  $record['key_value'] = $request->post('key_value');
                $record['type'] = $request->post('type');
                $record['is_active'] = $request->post('is_active');
                
                $result = DB::table('staff_attendance_type')->where('id',$request->post('id'))->update($record);
                 if(isset($result) && $result != '')
            {
           return redirect()->back()->with('success','Attendance type successfully updated.');
            }
        else{
             return redirect()->back()->with('success','Not updated.');
            }
          }
       } 



  public function leaveTypeList(Request $request)
   {
  $result = DB::table('leave_type')->select('leave_type.*')->paginate(20);

  return view('leave-type/list',['result'=>$result]);

}


public function editleaveType($id)
   {
    $result = DB::table('leave_type')->select('leave_type.*')->paginate(20);
  $result1 = DB::table('leave_type')->where('id', $id)->select('leave_type.*')->get();

  return view('leave-type/list',['result1'=>$result1, 'result'=>$result]);

}

public function deleteleaveType($id)
   {
  $data = DB::table('leave_type')->where('id', $id)->select('leave_type.*')->delete();

  return redirect()->back();

  }


  public function subjectIcons()
   {
    $data = DB::table('icons')->select('icons.*')->get();
     $data2 = DB::table('subject_icons')->leftjoin('subjects','subjects.id','=','subject_icons.subject_id')->select('subject_icons.*','subjects.*','subject_icons.id as sub_id')->paginate(20);
    $data1 = DB::table('subjects')->select('subjects.*')->get();
    return view('subject-icon/subject-icon',['icons'=>$data, 'subject'=>$data1, 'result'=>$data2]);
   
   }

public function editSubjectIcons($id)
   {
   $data = DB::table('icons')->select('icons.*')->get();
     $data2 = DB::table('subject_icons')
     ->leftjoin('subjects','subjects.id','=','subject_icons.subject_id')
     ->select('subject_icons.*','subjects.*','subject_icons.id as sub_id')->paginate(20);

     $data3 = DB::table('subject_icons')
     ->leftjoin('subjects','subjects.id','=','subject_icons.subject_id')
     ->where('subject_icons.id', $id)
     ->select('subject_icons.*','subjects.*','subject_icons.id as sub_id')->paginate(20);

    $data1 = DB::table('subjects')->select('subjects.*')->get();
    return view('subject-icon/subject-icon',['icons'=>$data, 'subject'=>$data1, 'result'=>$data2, 'result1'=>$data3]);

}

public function deleteSubjectIcon($id)
   {
    $data = DB::table('subject_icons')->where('id', $id)->select('subject_icons.*')->delete();

    return redirect()->back();

  }

public function insertUpdateleaveTypes(Request $request)
   {
    
        if (empty($request->post('id'))) {
        
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
                        $record['leave_icon'] = $image;
                }
               $record['type'] = $request->post('type');
                $record['is_active'] = $request->post('is_active');
                
                $result = DB::table('leave_type')->insert($record);
                 if(isset($result) && $result != '')
            {
            return redirect()->back()->with('success','Item Successfully Inserted.');
            }
        else{
            return redirect()->back()->with('success','Item Not Inserted.');
            }
              }
                else
                {
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
                        $record['leave_icon'] = $image;
                }
                  //$record['id'] = $request->post('id');
                $record['type'] = $request->post('type');
                $record['is_active'] = $request->post('is_active');
                
                $result = DB::table('leave_type')->where('id',$request->post('id'))->update($record);
                 if(isset($result) && $result != '')
            {
            return redirect()->back()->with('success','Item Successfully Updated.');
            }
        else{
          return redirect()->back()->with('success','Item not updated.');
            }
          }
       }  

public function upload(Request $request)
   {
    
    $classdata = DB::table('classes')->select('classes.*')->get();
    $datas = DB::table('sch_settings')->select('sch_settings.*')->get();
          $sessiondata = DB::table('sessions')
          ->where('sessions.id',$datas[0]->session_id)
           ->select('sessions.session')
           ->get();
          $sectiondata = DB::table('sections')->select('sections.*')->get();
  $data = DB::table('gallery')->select('gallery.*')->get();
  
$data1 = array();
$i = 0;
foreach ($data as $value) {

  $exploded = explode(",",$value->photos);

  $detail['gallery'] = $value;
  $detail['image'] = $exploded;

  $data1[$i] = $detail;
  $i++;

}

  return view('gallery/Add-gallery',['data1'=>$data1, 'classdata'=>$classdata, 'sessiondata'=>$sessiondata, 'sectiondata'=>$sectiondata]);
}

public function editGallery($id)
   {
    $classdata = DB::table('classes')->select('classes.*')->get();
    $datas = DB::table('sch_settings')->select('sch_settings.*')->get();
          $sessiondata = DB::table('sessions')
          ->where('sessions.id',$datas[0]->session_id)
           ->select('sessions.session')
           ->get();
          $sectiondata = DB::table('sections')->select('sections.*')->get();
    $data = DB::table('gallery')->select('gallery.*')->get();

$data1 = array();
$i = 0;
foreach ($data as $value) {

  $exploded = explode(",",$value->photos);

  $detail['gallery'] = $value;
  $detail['image'] = $exploded;

  $data1[$i] = $detail;
  $i++;

}
        $result = DB::table('gallery')
        ->where('id',$id)
        ->select('gallery.*')->get();
          $result1 = array();
$i = 0;
foreach ($result as $value) {

  $exploded = explode(",",$value->photos);

  $detail['gallery'] = $value;
  $detail['image'] = $exploded;

  $result1[$i] = $detail;
  $i++;

}
      

          return view('/gallery/edit-gallery',['data1'=>$data1, 'result1'=>$result1, 'classdata'=>$classdata, 'sessiondata'=>$sessiondata, 'sectiondata'=>$sectiondata]);
         
   }

public function deleteGallery($id)
   {
    
        $result1 = DB::table('gallery') ->where('id',$id)->select('gallery.*')->delete();
   
          return redirect()->back();
         
   }
   

   public function insertGallery(Request $request)
   {
    // File upload configuration 
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
        
        $record['videos'] = $request->post('videos');
            // Insert image file name into database 
            $insert =  DB::table('gallery')->insert($record);
            if($insert){ 
                $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
                $statusMsg = "Files are uploaded successfully.".$errorMsg; 
            }else{ 
                $statusMsg = "Sorry, there was an error uploading your file."; 
            } 
        } 
    }else{ 
        $statusMsg = 'Please select a file to upload.'; 
    } 
     
    // Display status message 
  return redirect()->back()->with('success','Item Successfully Inserted.');
}

  
  public function updateGallery(Request $request)
   {
    // File upload configuration 
    $id = $request->post('id');
    $targetDir = "uploads/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
     
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES['files']['name']); 
  
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
          }
        $record['class'] = $request->post('class');
        $record['section'] = $request->post('section');
        $record['session'] = $request->post('session');
        $record['date'] = $request->post('date');
        $record['title'] = $request->post('title');
        $record['description'] = $request->post('description');
        
        $record['videos'] = $request->post('videos');
            // Insert image file name into database 
            $insert =  DB::table('gallery')->where('id', $id)->update($record);
            if($insert){ 
                $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
                $statusMsg = "Files are uploaded successfully.".$errorMsg; 
            }else{ 
                $statusMsg = "Sorry, there was an error uploading your file."; 
            } 
        
     
    // Display status message 
  return redirect()->back()->with('success','Item Successfully Updated.');
}     

         
   


    public function store_items()
   {
        if(!empty($_GET['id']))
        {
           $result = DB::table('store_items')
           ->where('id', $_GET['id'])
           ->select('store_items.*')->paginate(20);
        }
        else{
          $result = DB::table('store_items')->select('store_items.*')->paginate(20);
        }
        
        $item_cat = DB::table('store_category')->select('store_category.*')->get();
         $supplier_id = DB::table('store_item_supplier')->select('store_item_supplier.*')->get();
          return view('store-items/item-list',['result'=>$result, 'supplier_id'=>$supplier_id, 'item_cat'=>$item_cat]);
         
   }

    public function edit_store_items($id)
   {
     $result = DB::table('store_items')->select('store_items.*')->paginate(10);
        $item_cat = DB::table('store_category')->select('store_category.*')->get();
        $supplier_id = DB::table('store_item_supplier')->select('store_item_supplier.*')->get();
        $result1 = DB::table('store_items')
        ->leftjoin('store_item_supplier','store_items.supplier_id', '=', 'store_item_supplier.id')
        ->where('store_items.id',$id)
        ->select('store_items.*','store_item_supplier.name as supplier_name')->get();
          return view('/store-items/item-edit',['result'=>$result, 'result1'=>$result1, 'supplier_id'=>$supplier_id, 'item_cat'=>$item_cat]);
         
   }
 public function deleteItems($id)
   {
    
        $result1 = DB::table('store_items')
        ->where('id',$id)
        ->select('store_items.*')->delete();
          return redirect()->back();
         
   }

   public function insertItem(Request $request)
   {
               
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
                $record['supplier_id'] = $request->post('supplier_id');
                $record['category_id'] = $request->post('category_id');
                $record['item_name'] = $request->post('item_name');
                $record['code'] = $request->post('code');
                $record['description'] = $request->post('description');
                $record['quantity'] = $request->post('quantity');
                $record['item_category'] = $request->post('item_category');
                $record['size'] = $request->post('size');
                $record['age'] = $request->post('age');
                $record['color'] = $request->post('color');
                $record['price'] = $request->post('price');
                $record['bookbyclass'] = $request->post('bookbyclass');
                $record['publisher'] = $request->post('publisher');
                $record['setofbooks'] = $request->post('setofbooks');

                $result = DB::table('store_items')->insert($record);
          return redirect()->back()->with('success','Successfully inserted.');

         
   }

   public function updateItem(Request $request)
   {
               $id = $request->post('id');
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
                $record['category_id'] = $request->post('category_id');
                $record['supplier_id'] = $request->post('supplier_id');
                $record['item_name'] = $request->post('item_name');
                $record['code'] = $request->post('code');
                $record['description'] = $request->post('description');
                $record['quantity'] = $request->post('quantity');
                $record['item_category'] = $request->post('item_category');
                $record['size'] = $request->post('size');
                $record['age'] = $request->post('age');
                $record['color'] = $request->post('color');
                $record['price'] = $request->post('price');
                $record['bookbyclass'] = $request->post('bookbyclass');
                $record['publisher'] = $request->post('publisher');
                $record['setofbooks'] = $request->post('setofbooks');

        $result = DB::table('store_items')->where('id',$id)->update($record);

       return redirect()->back()->with('success','Successfully updated.');
         
   }

 

public function supplier(Request $request)
   {
  $result = DB::table('store_item_supplier')->select('store_item_supplier.*')->paginate(10);

  return view('store-item-supplier/add-supplier',['result'=>$result]);

}


public function editSupplier($id)
   {
    $result = DB::table('store_item_supplier')->select('store_item_supplier.*')->paginate(10);
  $result1 = DB::table('store_item_supplier')->where('id', $id)->select('store_item_supplier.*')->get();

  return view('store-item-supplier/add-supplier',['result1'=>$result1, 'result'=>$result]);

}

public function deleteSupplier(Request $request)
   {
  $data = DB::table('store_item_supplier')->where('id', $id)->select('store_item_supplier.*')->delete();

  return view('store-item-supplier/add-supplier',['data1'=>$data1]);

  }

  public function orderHistory(Request $request)
   {
    $classdata = DB::table('classes')->select('classes.*')->get();
      $store_items = DB::table('store_items')->leftjoin('store_category','store_category.id','=','store_items.category_id')->select('store_items.*','store_category.name')->get();
          $sectiondata = DB::table('sections')->select('sections.*')->get();
          $class_id = $request->query('class_id', '');
          
          $section_id = $request->query('section_id', '');
           
  $result = DB::table('order_placed')
  ->leftjoin('student_session','student_session.id','order_placed.session_id')
  ->leftjoin('classes','classes.id','student_session.class_id')
  ->leftjoin('sections','sections.id','student_session.section_id')
  ->leftjoin('students','students.id','student_session.student_id')
  ->leftjoin('store_items','store_items.id','order_placed.item_id')
  ->select('order_placed.*','students.*','order_placed.id as ord_id','store_items.*','classes.class','sections.section');
    if ($class_id != '') {
            $result->where('student_session.class_id', $class_id);
          }
          if ($section_id != '') {
            $result->where('student_session.section_id', $section_id);
          }
          $result->orderby('order_placed.id','DESC');
          $data = $result->paginate(10);

  return view('orderHistory',['result'=>$data, 'classdata'=>$classdata, 'sectiondata'=>$sectiondata, 'store_items'=>$store_items]);

}
 public function updateOrderStatus(Request $request)
   {

        $id = $request->post('id');     
        $record['status'] = $request->post('status');

        $result = DB::table('order_placed')->where('id',$id)->update($record);

       return redirect()->back()->with('success','Successfully updated.');

}
public function editOrderStatus($id)
   {
          
 $result = DB::table('order_placed')
  ->leftjoin('student_session','student_session.id','order_placed.session_id')
  ->leftjoin('classes','classes.id','student_session.class_id')
  ->leftjoin('sections','sections.id','student_session.section_id')
  ->leftjoin('students','students.id','student_session.student_id')
  ->leftjoin('store_items','store_items.id','order_placed.item_id')
  ->select('order_placed.*','students.*','order_placed.id as ord_id','store_items.*','classes.class','sections.section')
  ->orderby('order_placed.id','DESC')
  ->paginate(10);
   $result1 = DB::table('order_placed')
  ->where('id',$id)->select('order_placed.*')
  ->get();
  

  return view('orderHistory',['result'=>$result,'result1'=>$result1]);

}

public function teacher_perf($homeworkid, $class_id, $section_id, $staff_id)
{
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
      $atd_avg = '';
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
       echo "<pre>";

print_r($data1);die;
    }


    public function InsertUpdateSubjectBook(Request $request)
   {
    
        if (empty($request->post('id'))) {
           $validextensions = array("jpeg", "jpg", "png","pdf");
                $temporary1 = explode('.', $_FILES["attachment"]["name"]);
                $file_extension1 = end($temporary1);

                if ((($_FILES["attachment"]["type"] == "image/png") || ($_FILES["attachment"]["type"] == "image/jpg") || ($_FILES["attachment"]["type"] == "application/pdf") || ($_FILES["attachment"]["type"] == "image/jpeg")
                        ) && ($_FILES["attachment"]["size"] < 40000000) && in_array($file_extension1, $validextensions)){

                    $imageType1 = explode('.', $_FILES["attachment"]["name"]);

                    $attachment = 'attachment' . rand() . '.' . $imageType1[1];

                    $sourcePath1 = $_FILES['attachment']['tmp_name'];

                    $targetPath1 = base_path() . '/uploads/' . $attachment;

                    if (move_uploaded_file($sourcePath1, $targetPath1) )
                        $record['attachment'] = $attachment;
                }
          
               $record['subject_id'] = $request->post('subject_id');
                $record['class_id'] = $request->post('class_id');
                $record['book_name'] = $request->post('book_name');
                $record['author'] = $request->post('author');
                
                
                $result = DB::table('subject_books')->insert($record);
                 if(isset($result) && $result != '')
            {
            return redirect()->back()->with('success','Book successfully inserted.');
            }
            else{
               return redirect()->back()->with('success','Not inserted.');
            }
       
              }
                else
                {
                   $validextensions = array("jpeg", "jpg", "png","pdf");
                $temporary1 = explode('.', $_FILES["attachment"]["name"]);
                $file_extension1 = end($temporary1);

                if ((($_FILES["attachment"]["type"] == "image/png") || ($_FILES["attachment"]["type"] == "image/jpg") || ($_FILES["attachment"]["type"] == "application/pdf") || ($_FILES["attachment"]["type"] == "image/jpeg")
                        ) && ($_FILES["attachment"]["size"] < 40000000) && in_array($file_extension1, $validextensions)){

                    $imageType1 = explode('.', $_FILES["attachment"]["name"]);

                    $attachment = 'attachment' . rand() . '.' . $imageType1[1];

                    $sourcePath1 = $_FILES['attachment']['tmp_name'];

                    $targetPath1 = base_path() . '/uploads/' . $attachment;

                    if (move_uploaded_file($sourcePath1, $targetPath1) )
                        $record['attachment'] = $attachment;
                }
                 $record['author'] = $request->post('author'); 
               $record['subject_id'] = $request->post('subject_id');
                $record['class_id'] = $request->post('class_id');
                $record['book_name'] = $request->post('book_name');
                
                
                $result = DB::table('subject_books')->where('subject_book_id',$request->post('id'))->update($record);
                 if(isset($result) && $result != '')
            {
           return redirect()->back()->with('success','Book successfully updated.');
            }
        else{
             return redirect()->back()->with('success','Not updated.');
            }
          }
       } 
public function attendenceTypeInsert(Request $request)
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
           return redirect()->back()->with('success','Attendance type successfully inserted.');
            }
        else{
             return redirect()->back()->with('success','Not inserted.');
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
                  $record['code'] = $request->post('code');
                $record['type'] = $request->post('type');
                $record['is_active'] = $request->post('is_active');
                
                $result = DB::table('attendence_type')->where('id',$request->post('id'))->update($record);
                 if(isset($result) && $result != '')
            {
           return redirect()->back()->with('success','Attendance type successfully updated.');
            }
        else{
             return redirect()->back()->with('success','Not updated.');
            }
          }
       } 
  
public function pole(Request $request)
   {
 $classdata = DB::table('classes')->select('classes.*')->get();
  
  $sectiondata = DB::table('sections')->select('sections.*')->get();

  $result = DB::table('poll')->select('poll.*')->paginate(20);

  return view('pole',['result'=>$result, 'classdata'=>$classdata, 'sectiondata'=>$sectiondata]);

}


public function editPole($id)
   {
    $classdata = DB::table('classes')->select('classes.*')->get();
  $sectiondata = DB::table('sections')->select('sections.*')->get();
    $result = DB::table('poll')->select('poll.*')->paginate(20);
  $result1 = DB::table('poll')->where('poll_id', $id)->select('poll.*')->get();

  return view('pole',['result1'=>$result1, 'result'=>$result, 'classdata'=>$classdata, 'sectiondata'=>$sectiondata]);

}

public function deletePole($id)
   {
  $data = DB::table('poll')->where('poll_id', $id)->select('poll.*')->delete();

   return redirect()->back();

  }

  public function poleAns(Request $request)
   {
 $classdata = DB::table('classes')->select('classes.*')->get();
  
  $sectiondata = DB::table('sections')->select('sections.*')->get();

  $pole = DB::table('poll')->select('poll.*')->get();

    foreach ($pole as $key => $value) {
      $results = DB::table('poll_ans')->where('poll_ans.poll_id', $value->poll_id)->select('poll_ans.*')->get();
      $data['que']=$value;
      $data['ans']=$results;
      $result[$key]= $data;
    }
   

  

  return view('poleAns',['result'=>$result, 'classdata'=>$classdata, 'pole'=>$pole]);

}


public function editPoleAns($id)
   {
    $pole = DB::table('poll')->select('poll.*')->get();
    $classdata = DB::table('classes')->select('classes.*')->get();
  $sectiondata = DB::table('sections')->select('sections.*')->get();
     foreach ($pole as $key => $value) {
      $results = DB::table('poll_ans')->where('poll_ans.poll_id', $value->poll_id)->select('poll_ans.*')->paginate(20);
      $data['que']=$value;
      $data['ans']=$results;
      $result[$key]= $data;
    }
  $result1 = DB::table('poll_ans')->leftjoin('poll','poll.poll_id','=','poll_ans.poll_id')
  ->where('poll_ans.ans_id', $id)->select('poll_ans.*','poll.title as pole_title')->get();

  return view('poleAns',['result1'=>$result1, 'result'=>$result, 'classdata'=>$classdata, 'sectiondata'=>$sectiondata , 'pole'=>$pole]);

  }

public function deletePoleAns($id)
   {
  $data = DB::table('pole_answers')->where('id', $id)->select('pole_answers.*')->delete();

   return redirect()->back();

  }
  public function poleResults($id)
   {

    $pole = DB::table('poll')->where('poll_id',$id)->select('poll.*')->get();

   $total=0;
     foreach ($pole as $key => $value) {
      $results = DB::table('poll_ans')->where('poll_id', $value->poll_id)->select('poll_ans.*')->get();
      
     /* foreach ($results as $key1 => $value1) {
       $pollresult = DB::table('poll_user_ans')
       ->where('ans_id', $value1->ans_id)
       ->select('poll_user_ans.*')
       ->count();
       $pollcount = DB::table('poll_user_ans')
        ->where('poll_id', $value1->poll_id)
       ->select('poll_user_ans.*')
       ->count();
      
       $data1['result'] =$pollresult;
       
       $result2[$key1]= $data1;

      }*/
    
      $data['que']=$value;
      $data['ans']=$results;
      $result1[$key]= $data;
    }
        
  return view('poleResult',['result'=>$result1]);

  }
  public function reportCard($id)
  {
   $datas = DB::table('sch_settings')->select('sch_settings.*')->get();

   $query1 = DB::table('students')
          ->leftjoin('student_session', 'student_session.student_id','=', 'students.id')
          ->leftjoin('classes', 'student_session.class_id', '=', 'classes.id')
          ->leftjoin('sections', 'sections.id', '=', 'student_session.section_id')
          ->leftjoin('sessions', 'sessions.id', '=', 'student_session.session_id')
          ->where('student_session.id', $id)
          ->select('students.*','students.id as stu_id','student_session.*','classes.class','sections.section','sessions.session')->get();
          
    return view('reportCard', ['query1'=>$query1, 'datas'=>$datas]);
  }

}