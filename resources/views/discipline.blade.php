<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>
<body>

   <style type="text/css">
     .modal-backdrop {
   
    height: 0px !important;
  }
  .modal{
    padding-bottom: 60px;
 transform: rotate(90deg) !important;
     left: -65px;
}
.table-bordered td, .table-bordered th {
    border: none;
}


   </style>     

<form action="">
          <div style="margin-top: 10px;">
            <div class="" style="text-align: start; padding-left: 20px;">              
                <i class="fa fa-graduation-cap" aria-hidden="true" style="display: inline; zoom: 1.4"></i>
                <p style="display: inline; font-size: 20px;">Student Discipline</p>
            </div>
              <div class="card" style="border-top: solid 2px black; padding: 10px; margin: 10px;">
                <div class="card-content">
                <div class="grid">
                  <div class="row">
                    
                    <div class="col-sm">
                      <div class="form-group">
                        <label for="" style="font-size: 13.3px; font-weight: 500; padding-left: 8px;">Class*</label>
 <select name="class" class="form-control" style="height: 30px; font-size: 13.3px;">
                          <!-- <option selected hidden>Class</option> -->
                          @if(!empty($_GET['class']) && $_GET['class'] != '')
                          @foreach($classdata as $cdata1)
                          
                         @if($cdata1->id == $_GET['class'])
                          <option value="{{$cdata1->id}}" selected="">{{$cdata1->class}}</option>
                         @endif
                         @endforeach
                          @else
                          <option>Select Class</option>
                          @endif
                         
                          @foreach($classdata as $cdata)
                          @if($cdata->class != '')
                          <option value="{{$cdata->id}}">{{$cdata->class}}</option>
                          @endif

                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="form-group">
                        <label for="" style="font-size: 13.3px; font-weight: 500; padding-left: 8px;">Section*</label>
                        <select name="section" class="form-control" style="height: 30px; font-size: 13.3px;">
                           @if(!empty($_GET['section']) && $_GET['section'] != '')
                          @foreach($sectiondata as $secn)
                          
                         @if($secn->id == $_GET['section'])
                          <option value="{{$secn->id}}" selected="">{{$secn->section}}</option>
                         @endif
                         @endforeach
                          @else
                         <option>Select Section</option>
                          @endif
                          
                         
                          @foreach($sectiondata as $scdata)
                          @if($scdata->section != '')
                          <option value="{{$scdata->id}}">{{$scdata->section}}</option>
                          @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="row">
                        
                        <div class="col-sm">
                          <label for="" style="font-size: 13.3px; font-weight: 500; padding-left: 10px;">Date*</label>
                         
                             <input class="form-control" type="date" id="date" name="date" value="@if(!empty($_GET['date']) && $_GET['date'] != ''){{$_GET['date']}}@endif" style="width: 171px;height: 30px;"  >

                                                  </div>
                        <div class="col-sm" style="text-align: end;">
                          <button class="btn btn-sm" style="background-color: black; color: white; margin-top: 35px;"><i class="fa fa-search"></i> Search</button>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="col-2">
                      <button class="btn btn-sm" style="background-color: black; color: white; margin-top: 35px;"><i class="fa fa-search"></i> Search</button>
                    </div> -->
                  </div>
                </div>
                <p style="font-style: italic;">Instructions: Please select the checkbox which student has failed to comply for each corresponding section.</p>
                </div>
              </div>
            </div>
        </form>

@if(!empty($_GET['class']) && $_GET['class'] != '')
@if(!empty($_GET['section']) && $_GET['section'] != '')
@if(!empty($_GET['date']) && $_GET['date'] != '')
<form action="{{url('/insertDisciplines')}}" method="post">
  @csrf
          <div id="container" style="margin-top: 2%; margin: 10px;">
            <div id="container2">
              <div class="box one"><div>
                  <div class="card">
                    <div class="card-header" style="text-align: center; background-color: ;">
                      <!-- <button class="btn btn-lg" style="background-color: #1ca0e0; color: white;">Student Name</button> -->
                      <i class="fa fa-users" aria-hidden="true" style="display: inline;"></i>
                      <p style="font-size: 15px; display: inline; font-weight: 500;">Student Name</p>
                    </div>
                    <table class="table table-hover">

                      <thead class="thead-dark">
                         @foreach($classdata as $cls)
                         @if($cls->id == $_GET['class'])
                          @foreach($sectiondata as $sec)
                         @if($sec->id == $_GET['section'])
                          <td style="height: 45px; background-color: #b9dbec;">{{$cls->class}} {{$sec->section}}</td>
                          
                          <td style="height: 45px; background-color: #b9dbec;"></td>
                           @endif
                           @endforeach
                           @endif
                          
                          @endforeach
                          
                          <td style="height: 45px; background-color: #b9dbec;"></td>
                         
                      </thead>
                        <tbody style="line-height: 0.8;">
                          @foreach($data as $record)
                          <tr data-toggle="modal" data-target="#exampleModalCenter_{{$record['detail']->stu_id}}">
                            <td style="font-size: 15px;">{{$record['detail']->firstname}} {{$record['detail']->lastname}}</td>
                            <td>
                                <img src="{{asset('assets/images/search_logo.png')}}" style="width: 18px;" alt="">
                            </td>
                            <td></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      <tfoot>
                        <tr>
                          <button class="btn btn-sm" style="background-color: black; color: white;width: 100%;">Submit</button>
                        </tr>
                      </tfoot>
                  </div>
              </div></div>
              <div class="box two"><div>
                <div class="card">
                    <div class="card-header" style="text-align: center;">
                      <!-- <button class="btn btn-lg" style="background-color: #1ca0e0; color: white;">Uniform</button> -->
                      <img src="./tshirt-solid.svg" style="width: 22px; margin-bottom: 5px;" alt="">
                      <p style="font-size: 15px; display: inline; font-weight: 500;">Uniform</p>
                    </div>
                    <table class="table table-hover">
                        <thead class="thead" style="background-color: #b9dbec; font-size: 13.3px; font-weight: 500;">
                            <tr>
                              <td scope="col">Dress-Shirt/Pants</td>
                              <td scope="col">Socks</td>
                              <td scope="col">Shoes</td>
                              <td scope="col">Belt</td>
                              <td scope="col">Handkerchief</td>
                              <td scope="col">I-Card</td>
                              <td scope="col">Tie</td>
                              <td scope="col">Blazer</td>
                            </tr>
                        <tbody>
                          @foreach($data as $record1)
                          @if(!empty($record1['discipline'][0]) && $record1['discipline'][0] != '')
                           @foreach($record1['discipline'] as $descipline)
                          <tr>
                              <input type="hidden" name="stu_idd[]" value="{{$record1['detail']->stu_id}}">
                              
                            <input type="hidden" name="stu_name{{$record1['detail']->stu_id}}" value="{{$record1['detail']->firstname}}">
                            <input type="hidden" name="session{{$record1['detail']->stu_id}}" value="{{$record1['detail']->session}}">
                            <input type="hidden" name="class{{$record1['detail']->stu_id}}" value="{{$record1['detail']->class}}">
                  
                            <input type="hidden" name="date{{$record1['detail']->stu_id}}" value="@if(!empty($_GET['date'])) {{$_GET['date']}} @endif">
                            <input type="hidden" name="section{{$record1['detail']->stu_id}}" value="{{$record1['detail']->section}}">
                            <th scope="row">
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record1['detail']->stu_id}}" name="dress{{$record1['detail']->stu_id}}" value="yes" @if($descipline->dress == "Yes") checked @endif>
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </th>
                            <td>
                              
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record1['detail']->stu_id}}" name="socks{{$record1['detail']->stu_id}}" value="yes" @if($descipline->socks == "Yes") checked @endif>
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record1['detail']->stu_id}}" name="shoes{{$record1['detail']->stu_id}}" value="yes">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record1['detail']->stu_id}}" name="belt{{$record1['detail']->stu_id}}" value="yes" @if($descipline->belt == "Yes") checked @endif>
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record1['detail']->stu_id}}" name="handkerchief{{$record1['detail']->stu_id}}" value="yes" @if($descipline->handkerchief == "Yes") checked @endif>
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record1['detail']->stu_id}}" name="icard{{$record1['detail']->stu_id}}" value="yes">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record1['detail']->stu_id}}" name="tie{{$record1['detail']->stu_id}}" value="yes" @if($descipline->tie == "Yes") checked @endif>
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record1['detail']->stu_id}}" name="blazer{{$record1['detail']->stu_id}}" value="yes" @if($descipline->blazer == "Yes") checked @endif>
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                          </tr>
                          @endforeach
                          @else
                          <tr>
                              <input type="hidden" name="stu_idd[]" value="{{$record1['detail']->stu_id}}">
                            <input type="hidden" name="stu_name{{$record1['detail']->stu_id}}" value="{{$record1['detail']->firstname}}">
                            <input type="hidden" name="session{{$record1['detail']->stu_id}}" value="{{$record1['detail']->session}}">
                            <input type="hidden" name="class{{$record1['detail']->stu_id}}" value="{{$record1['detail']->class}}">
                  
                            <input type="hidden" name="date{{$record1['detail']->stu_id}}" value="@if(!empty($_GET['date'])) {{$_GET['date']}} @endif">
                            <input type="hidden" name="section{{$record1['detail']->stu_id}}" value="{{$record1['detail']->section}}">
                            <th scope="row">
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record1['detail']->stu_id}}" name="dress{{$record1['detail']->stu_id}}" value="yes">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </th>
                            <td>
                              
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record1['detail']->stu_id}}" name="socks{{$record1['detail']->stu_id}}" value="yes">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record1['detail']->stu_id}}" name="shoes{{$record1['detail']->stu_id}}" value="yes">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record1['detail']->stu_id}}" name="belt{{$record1['detail']->stu_id}}" value="yes">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record1['detail']->stu_id}}" name="handkerchief{{$record1['detail']->stu_id}}" value="yes">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record1['detail']->stu_id}}" name="icard{{$record1['detail']->stu_id}}" value="yes">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record1['detail']->stu_id}}" name="tie{{$record1['detail']->stu_id}}" value="yes">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record1['detail']->stu_id}}" name="blazer{{$record1['detail']->stu_id}}" value="yes">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                          </tr>
                          @endif
                            @endforeach
                        </tbody>
                      </table>
                  </div>
              </div>
            </div>
            <div class="box four"><div>
              <div class="card">
                  <div class="card-header" style="text-align: center;">
                    <!-- <button class="btn btn-lg" style="background-color: #1ca0e0; color: white;">Appearance</button> -->
                    <img src="./id-card-alt-solid.svg" style="width: 20px; margin-bottom: 5px;" alt="">
                    <p style="font-size: 15px; display: inline; font-weight: 500;">Late Comming</p>
                  </div>
                  <table class="table table-hover">
                      <thead class="thead" style="background-color: #b9dbec; font-size: 13.3px; font-weight: 500;">
                          <tr>
                            <td scope="col" style="text-align: center;">Late</td>
                            
                          </tr>
                      <tbody>
                      
                        @foreach($data as $recordLate)
                         @if(!empty($recordLate['discipline'][0]) && $recordLate['discipline'][0] != '')
                           @foreach($recordLate['discipline'] as $late)
                          <tr>
                            
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$recordLate['detail']->stu_id}}" name="late{{$recordLate['detail']->stu_id}}" value="yes"  @if($late->late == "Yes") checked @endif>
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                           
                          </tr>
                          @endforeach
                          @else
                          <tr>
                            
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$recordLate['detail']->stu_id}}" name="late{{$recordLate['detail']->stu_id}}" value="yes">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                           
                          </tr>
                          @endif
                          @endforeach
                        
                      </tbody>
                    </table>
                </div>
            </div>
          </div>

            <div class="box four"><div>
              <div class="card">
                  <div class="card-header" style="text-align: center;">
                    <!-- <button class="btn btn-lg" style="background-color: #1ca0e0; color: white;">Appearance</button> -->
                    <img src="./id-card-alt-solid.svg" style="width: 20px; margin-bottom: 5px;" alt="">
                    <p style="font-size: 15px; display: inline; font-weight: 500;">Appearance</p>
                  </div>
                  <table class="table table-hover">
                      <thead class="thead" style="background-color: #b9dbec; font-size: 13.3px; font-weight: 500;">
                          <tr>
                            <td scope="col">Nails</td>
                            <td scope="col">Hair</td>
                            <td scope="col">Hygiene</td>
                          </tr>
                      <tbody>
                      
                        @foreach($data as $record2)
                         @if(!empty($record2['discipline'][0]) && $record2['discipline'][0] != '')
                           @foreach($record2['discipline'] as $descipline1)
                          <tr>
                            
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record2['detail']->stu_id}}" name="nails{{$record2['detail']->stu_id}}" value="yes"  @if($descipline1->nails == "Yes") checked @endif>
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record2['detail']->stu_id}}" name="hair{{$record2['detail']->stu_id}}" value="yes"  @if($descipline1->hair == "Yes") checked @endif>
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <th scope="row">
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record2['detail']->stu_id}}" name="hygiene{{$record2['detail']->stu_id}}" value="yes"  @if($descipline->hygiene == "Yes") checked @endif>
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </th>
                          </tr>
                          @endforeach
                          @else
                          <tr>
                            
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record2['detail']->stu_id}}" name="nails{{$record2['detail']->stu_id}}" value="yes">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record2['detail']->stu_id}}" name="hair{{$record2['detail']->stu_id}}" value="yes">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <th scope="row">
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record2['detail']->stu_id}}" name="hygiene{{$record2['detail']->stu_id}}" value="yes">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </th>
                          </tr>
                          @endif
                          @endforeach
                        
                      </tbody>
                    </table>
                </div>
            </div>
          </div>

            <div class="box four">
              <div>
              <div class="card">
                  <div class="card-header" style="text-align: center;">
                    <!-- <button class="btn btn-lg" style="background-color: #1ca0e0; color: white;">Conduct Behaviour</button> -->
                    <img src="./accusoft-brands.svg" style="width: 20px; margin-bottom: 5px;" alt="">
                    <p style="font-size: 15px; display: inline; font-weight: 500;">Conduct Behaviour</p>
                  </div>
                  <table class="table table-hover">
                      <thead class="thead" style="background-color: #b9dbec; font-size: 13.3px; font-weight: 500;">
                          <tr>
                            <td scope="col">Argumentative</td>
                            <td scope="col">Abusive Language</td>
                            <td scope="col">Misconduct with teachers</td>
                            <td scope="col">Misconduct with Students</td>
                            <td scope="col">Fights/Quarrels with students</td>
                            <td scope="col">Defying intructions/orders</td>
                            <td scope="col">Class Bunk</td>
                          </tr>
                      <tbody>
                      
                      @foreach($data as $record3)
                       @if(!empty($record3['discipline'][0]) && $record3['discipline'][0] != '')
                           @foreach($record3['discipline'] as $descipline2)
                           
                          <tr>
                            <th scope="row">
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record3['detail']->stu_id}}" name="argumentative{{$record3['detail']->stu_id}}" value="yes" @if($descipline2->argumentative == "Yes") checked @endif>
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </th>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record3['detail']->stu_id}}" name="abusive_lang{{$record3['detail']->stu_id}}" value="yes" @if($descipline2->abusive_lang == "Yes") checked @endif>
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record3['detail']->stu_id}}" name="missconduct_teacher{{$record3['detail']->stu_id}}" value="yes" @if($descipline2->missconduct_teacher == "Yes") checked @endif>
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record3['detail']->stu_id}}" name="missconduct_students{{$record3['detail']->stu_id}}" value="yes" @if($descipline2->missconduct_students == "Yes") checked @endif>
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record3['detail']->stu_id}}" name="fights{{$record3['detail']->stu_id}}" value="yes" @if($descipline2->fights == "Yes") checked @endif>
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record3['detail']->stu_id}}" name="defying_orders{{$record3['detail']->stu_id}}" value="yes" @if($descipline2->defying_orders == "Yes") checked @endif>
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record3['detail']->stu_id}}" name="class_bunk{{$record3['detail']->stu_id}}" value="yes" @if($descipline2->class_bunk == "Yes") checked @endif>
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                          </tr>
                          @endforeach
                          @else
                          <tr>
                            <th scope="row">
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record3['detail']->stu_id}}" name="argumentative{{$record3['detail']->stu_id}}" value="yes">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </th>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record3['detail']->stu_id}}" name="abusive_lang{{$record3['detail']->stu_id}}" value="yes">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record3['detail']->stu_id}}" name="missconduct_teacher{{$record3['detail']->stu_id}}" value="yes">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record3['detail']->stu_id}}" name="missconduct_students{{$record3['detail']->stu_id}}" value="yes">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record3['detail']->id}}" name="fights{{$record3['detail']->id}}" value="yes">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record3['detail']->stu_id}}" name="defying_orders{{$record3['detail']->stu_id}}" value="yes">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="checkbox" id="{{$record3['detail']->stu_id}}" name="class_bunk{{$record3['detail']->stu_id}}" value="yes">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                          </tr>
                          @endif
                          @endforeach                  
                        
                      </tbody>
                    </table>
                </div>
            </div>
          </div>

              <div class="box three"><div>
                  <div class="card">
                    <div class="card-header" style="text-align: center;">
                      <!-- <button class="btn btn-lg" style="background-color: #1ca0e0; color: white;">Card Issued</button> -->
                      <img src="./box-tissue-solid.svg" style="width: 18px;" alt="">
                      <p style="font-size: 15px; display: inline; font-weight: 500;">Card Issued</p>
                    </div>
                    <table class="table table-hover">
                        <thead class="thead" style="background-color: #b9dbec; font-size: 13.3px; font-weight: 500;">
                            <tr>
                              <td scope="col">Yellow</td>
                              <td scope="col">Orange</td>
                              <td scope="col">Red</td>
                            </tr>
                        </thead>
                        <tbody>
                          
                           @foreach($data as $record4)
                           @if(!empty($record4['discipline'][0]) && $record4['discipline'][0] != '')
                           @foreach($record4['discipline'] as $descipline3)
                          <tr>
                            <th scope="row">
                              <label class="checkbox-label">
                                <input type="radio" id="{{$record4['detail']->stu_id}}" name="card_issued{{$record4['detail']->stu_id}}" value="yellow" @if($descipline3->card_issued == "yellow") checked @endif>
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </th>
                           
                            <td>
                              <label class="checkbox-label">
                                <input type="radio" id="{{$record4['detail']->stu_id}}" name="card_issued{{$record4['detail']->stu_id}}" value="orange" @if($descipline3->card_issued == "orange") checked @endif>
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            <td>
                              <label class="checkbox-label">
                                <input type="radio" id="{{$record4['detail']->stu_id}}" name="card_issued{{$record4['detail']->stu_id}}" value="red" @if($descipline3->card_issued == "red") checked @endif>
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                             
                          </tr>
                          @endforeach
                          @else
                           <tr>
                            <th scope="row">
                              <label class="checkbox-label">
                                <input type="radio" id="{{$record4['detail']->stu_id }}" name="card_issued{{$record4['detail']->stu_id }}" value="yellow">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </th>
                           
                            <td>
                              <label class="checkbox-label">
                                <input type="radio" id="{{$record4['detail']->stu_id}}" name="card_issued{{$record4['detail']->stu_id}}" value="orange">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>

                            <td>
                              <label class="checkbox-label">
                                <input type="radio" id="{{$record4['detail']->stu_id}}" name="card_issued{{$record4['detail']->stu_id}}" value="red">
                                <span class="checkbox-custom rectangular"></span>
                              </label>
                            </td>
                            
                          </tr>
                          @endif
                          @endforeach
                        
                        </tbody>
                      </table>
                  </div>
              </div>
            </div>
              <div class="box four"><div>
                <div class="card">
                    <div class="card-header" style="text-align: center;">
                      <!-- <button class="btn btn-lg" style="background-color: #1ca0e0; color: white;">Remedial Measures Taken</button> -->
                      <i class="fa fa-users" aria-hidden="true" style="display: inline;"></i>
                      <p style="font-size: 15px; display: inline; font-weight: 500;">Remedial Measures Taken</p>
                    </div>
                    <table class="table table-hover">
                      <thead class="thead" style="background-color: #b9dbec; font-size: 13.3px; font-weight: 500;">
                        <td style="height: 45px;"></td>
                        <td style="height: 45px;"></td>
                        <td style="height: 45px;"></td>
                    </thead>
                        <tbody>
                           @foreach($data as $record5)
                            @if(!empty($record5['discipline'][0]) && $record5['discipline'][0] != '')
                           @foreach($record5['discipline'] as $descipline4)
                          <tr>
                            <td>
                                <textarea  name="remedial_measure{{$record5['detail']->stu_id}}" id="{{$record5['detail']->stu_id}}"style="height: 18px;" type="text" class="form-control" placeholder="" value="{{$descipline4->remedial_measure}}">{{$descipline4->remedial_measure}}</textarea>
                            </td>
                          </tr>
                          @endforeach
                          @else
                          <tr>
                            <td>
                                <textarea  name="remedial_measure{{$record5['detail']->stu_id}}" id="{{$record5['detail']->stu_id}}"style="height: 18px;" type="text" class="form-control" placeholder=""></textarea>
                            </td>
                          </tr>
                          @endif
                          @endforeach
                         
                          
                        </tbody>
                      </table>
                  </div>
              </div></div>
              <div class="box four"><div>
                <div class="card">
                    <div class="card-header" style="text-align: center;">
                      <!-- <button class="btn btn-lg" style="background-color: #1ca0e0; color: white;">Remarks</button> -->
                      <img src="./poll-solid.svg" style="width: 18px;" alt="">
                      <p style="font-size: 15px; display: inline; font-weight: 500;">Remarks</p>
                    </div>
                    <table class="table table-hover">
                      <thead class="thead" style="background-color: #b9dbec; font-size: 13.3px; font-weight: 500;">
                        <td style="height: 45px;"></td>
                        <td style="height: 45px;"></td>
                        <td style="height: 45px;"></td>
                      </thead>
                        <tbody>
                           @foreach($data as $record6)
                           @if(!empty($record6['discipline'][0]) && $record6['discipline'][0] != '')
                           @foreach($record6['discipline'] as $descipline5)
                          <tr>
                            <td>
                                <textarea name="remark{{$record6['detail']->stu_id}}" id="{{$record6['detail']->stu_id}}" value="{{$descipline5->remark}}"  style="height: 18px;" type="text" class="form-control" placeholder="">{{$descipline5->remark}}</textarea>
                            </td>
                          </tr>
                          @endforeach
                          @else
                           <tr>
                            <td>
                                <textarea name="remark{{$record6['detail']->stu_id}}" id="{{$record6['detail']->stu_id}}"  style="height: 18px;" type="text" class="form-control" placeholder=""></textarea>
                            </td>
                          </tr>
                          @endif
                          @endforeach

                          
                        </tbody>
                      </table>
                  </div>
              </div>
            </div>
              
               <!-- <div class="box four"><div>Last</div></div>
              <div class="box four"><div>Last</div></div> -->
            </div>
            <div style="transform: rotate(90deg); margin: -30% 50% 0 0;">
              <!-- <button type="submit" class="btn btn-lg" style="background-color: grey; width: 100%; color: white;">Submit</button> -->
              <!--<button class="btn btn-sm" style="background-color: black; color: white; margin-top: 35px; width: 30%;">Submit</button>             </div>-->
          </div>



           @foreach($count as $data1)
            <div class="modal fade" id="exampleModalCenter_{{$data1->stu_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="width: 800px !important" >
              <div class="modal-content">
                <div class="modal-header" style="background-color: #1ca0e0; color: white;">
                  <h5 class="modal-title" id="exampleModalLongTitle">{{$data1->firstname}} {{$data1->lastname}} | {{$data1->class}} {{$data1->section}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                      <thead style="text-align: center;">
                        <tr>
                          <th scope="col" style="width:0px;">Card</th>
                          <th scope="col" style="width:165px;">Date</th>
                          <th scope="col" style="width:113px;">Reason</th>
                        
                          <th scope="col" style="width:200px;">Measures Taken</th>
                          <th scope="col">Remarks</th>
                        </tr>
                        @foreach($count as $data2)
                        @if($data2->stu_id == $data1->stu_id)
                        @if(!empty($data2->card_issued))
                        <tr>
                          

                          @if($data2->card_issued == 'red')
                          <td><img src="{{asset('assets/images/red.png')}}" width="30" height="30"></td>
                          <td>{{$data2->date}}</td>

                          <td>@if($data2->dress == 'Yes')dress, @endif @if($data2->socks == 'Yes')socks, @endif @if($data2->shoes == 'Yes')shoes, @endif @if($data2->belt == 'Yes')belt, @endif  @if($data1->handkerchief == 'Yes')handkerchief, @endif @if($data1->icard == 'Yes')icard, @endif @if($data1->tie == 'Yes')tie, @endif @if($data1->blazer == 'Yes')blazer, @endif @if($data1->hygiene == 'Yes')hygiene, @endif @if($data1->nails == 'Yes')nails, @endif @if($data1->hair == 'Yes')hair, @endif @if($data1->argumentative == 'Yes')argumentative, @endif @if($data1->abusive_lang == 'Yes')abusive language, @endif @if($data1->missconduct_teacher == 'Yes')misconduct with teachers, @endif @if($data1->missconduct_students == 'Yes')misconduct with students, @endif @if($data1->fights == 'Yes')fights/quarrels with students, @endif @if($data1->defying_orders == 'Yes')defying intructions/orders, @endif @if($data1->class_bunk == 'Yes')class bunk @endif</td>

                          <td>{{$data2->remedial_measure}}</td>
                          
                          <td>{{$data2->remark}}</td>
                          @endif

                          @if($data2->card_issued == 'yellow')
                         <td><img src="{{asset('assets/images/yellow.png')}}" width="30" height="30"></td>
                          <td>{{$data2->date}}</td>
                          <td>@if($data2->dress == 'Yes')dress, @endif @if($data2->socks == 'Yes')socks, @endif @if($data2->shoes == 'Yes')shoes, @endif @if($data2->belt == 'Yes')belt, @endif  @if($data1->handkerchief == 'Yes')handkerchief, @endif @if($data1->icard == 'Yes')icard, @endif @if($data1->tie == 'Yes')tie, @endif @if($data1->blazer == 'Yes')blazer, @endif @if($data1->hygiene == 'Yes')hygiene, @endif @if($data1->nails == 'Yes')nails, @endif @if($data1->hair == 'Yes')hair, @endif @if($data1->argumentative == 'Yes')argumentative, @endif @if($data1->abusive_lang == 'Yes')abusive language, @endif @if($data1->missconduct_teacher == 'Yes')misconduct with teachers, @endif @if($data1->missconduct_students == 'Yes')misconduct with students, @endif @if($data1->fights == 'Yes')fights/quarrels with students, @endif @if($data1->defying_orders == 'Yes')defying intructions/orders, @endif @if($data1->class_bunk == 'Yes')class bunk @endif</td>
                          <td>{{$data2->remedial_measure}}</td>
                          
                          <td>{{$data2->remark}}</td>
                          @endif

                          @if($data2->card_issued == 'orange')
                          <td><img src="{{asset('assets/images/orange.png')}}" width="30" height="30"></td>
                          <td>{{$data2->date}}</td>

                          <td>@if($data2->dress == 'Yes')dress, @endif @if($data2->socks == 'Yes')socks, @endif @if($data2->shoes == 'Yes')shoes, @endif @if($data2->belt == 'Yes')belt, @endif  @if($data1->handkerchief == 'Yes')handkerchief, @endif @if($data1->icard == 'Yes')icard, @endif @if($data1->tie == 'Yes')tie, @endif @if($data1->blazer == 'Yes')blazer, @endif @if($data1->hygiene == 'Yes')hygiene, @endif @if($data1->nails == 'Yes')nails, @endif @if($data1->hair == 'Yes')hair, @endif @if($data1->argumentative == 'Yes')argumentative, @endif @if($data1->abusive_lang == 'Yes')abusive language, @endif @if($data1->missconduct_teacher == 'Yes')misconduct with teachers, @endif @if($data1->missconduct_students == 'Yes')misconduct with students, @endif @if($data1->fights == 'Yes')fights/quarrels with students, @endif @if($data1->defying_orders == 'Yes')defying intructions/orders, @endif @if($data1->class_bunk == 'Yes')class bunk @endif</td>
                          <td>{{$data2->remedial_measure}}</td>
                          
                          <td>{{$data2->remark}}</td>
                          @endif
                          
                          
                        </tr>
                        @endif
                         @endif
                        @endforeach
                       
                        
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
              @endif
              @endif
               @endif
<script type="text/javascript">
  $(function () {
    $("#datepicker").datepicker({ 
          autoclose: true, 
          todayHighlight: true
    }).datepicker('update', new Date());
  });
  
</script>

</body>
</html>



















