<?php

namespace App\Http\Controllers\Api;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  SimpleSoftwareIO\QrCode\Facades\QrCode;
use DB;

class DisciplineController extends Controller
{
   public function discipline()
   {
    $data = DB::table('discipline')->select('discipline.*')->get();
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
  
   public function search(Request $request)
   {
          $class = $request->query('class', '');
          $date = $request->query('date', '');
          $section = $request->query('section', '');
          $session = $request->query('session', '');

          $query = DB::table('discipline')->select('discipline.*');

          if ($class != '') {
            $query->where('class', $class);
          }
          if ($section != '') {
            $query->where('section', $section);
          }

         if ($session != '') {
            $query->where('session', $session);
          }

          if ($date != '') {
            $query->where('date', $date);
          }

          $data = $query->paginate(50);
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

    public function insert_discipline(Request $request)
   {

    $std_id=$request->post('stu_id');
    $datanew=array();
    foreach($std_id as $std)
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
$result = DB::table('discipline')->insert($datanew);
}



        if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'items inserted',
                                   'data'=>$datanew]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not inserted']
                                   );  
            }


                 /*   $data = array(
                                'stu_id' => $request->post('stu_id'),
                                 'stu_name' => $request->post('stu_name'),
                                'dress' => $request->post('dress'),
                                'socks' => $request->post('socks'),
                                'shoes' => $request->post('shoes'),
                                'belt' => $request->post('belt'),
                                'handkerchief' => $request->post('handkerchief'),
                                'icard' => $request->post('icard'),
                                'tie' => $request->post('tie'),
                                'hygiene' => $request->post('hygiene'),
                                'blazer' => $request->post('blazer'),
                                'hair' => $request->post('hair'),
                                'nails' => $request->post('nails'),
                                'argumentative' => $request->post('argumentative'),
                                'abusive_lang' => $request->post('abusive_lang'),
                                'missconduct_teacher' => $request->post('missconduct_teacher'),
                                'missconduct_students' => $request->post('missconduct_students'),
                                'fights' => $request->post('fights'),
                                'defying_orders' => $request->post('defying_orders'),
                                'class_bunk' => $request->post('class_bunk'),
                                'card_issued' => $request->post('card_issued'),
                                'remedial_measure' => $request->post('remedial_measure'),
                                'remark' => $request->post('remark'),
                                'date' => $request->post('date')
                            );*/

        
         
   }


    public function update_discipline(Request $request)
   {
          $id = $request->post('id');
                    $std_id=$request->post('stu_id');
    $datanew=array();
    foreach($std_id as $std)
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
$result = DB::table('discipline')->where('id',$id)->update($datanew);
}

if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'items updated',
                                   'data'=>$datanew]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not updated']
                                   );  
            }
         
   }


   public function parent_child_discipline($id)
   {
        $record = DB::table('discipline')->where('stu_id',$id)->select('class','section','date','card_issued','remedial_measure','remark')->get();

        

        if(!empty($record[0]) && $record[0] != '')
         {
          return response()->json(['status' => '200',//sample entry
   'message' => 'items found',
   'data'=>$record]);  
        }
        else{
return response()->json(['status' => '404',//sample entry
   'message' => 'items not found']);  
        }
         
   }

   public function parent_child_discipline_monthly(Request $request)
   {

        $student_id=$request->post('student_id');
        $date=$request->post('date');
        $record = DB::table('discipline')
        ->where('stu_id',$student_id)
        ->where('date', 'like', '%' . $date . '%')
        ->select('discipline.*')->get();

        if(!empty($record[0]) && $record[0] != '')
         {
          return response()->json(['status' => '200',//sample entry
   'message' => 'items found',
   'data'=>$record]);  
        }
        else{
return response()->json(['status' => '404',//sample entry
   'message' => 'items not found']);  
        }
         
   }


} 