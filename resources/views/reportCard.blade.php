<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>

    <style>
      body{
  background-color: #ececec;
}

.student_profile tr{
    border-top: hidden;
}

.part1 td{
  padding: 10px;
  line-height: 1;
}

    </style>


</head>
<body>

        <nav class="navbar navbar-expand-lg" style="background-color: #357fac;">
            <!-- <a class="navbar-brand" href="#">Navbar</a> -->
            <img src="./logo.png" style="width: 50px;" alt="">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active" style="text-align: center;">
                  <h3 style="color: white; padding-left: 10px;">{{$datas[0]->name}}</h3>
                  <h6 style="color: white; padding-left: 10px; margin-top: -10px;">{{$datas[0]->address}}</h6>
                </li>
              </ul>
            </div>
          </nav>


          <div style="margin-top: 20px;">
            <div class="" style="text-align: center;">              
                <i class="fa fa-graduation-cap" aria-hidden="true" style="display: inline; zoom: 1.4"></i>
                <p style="display: inline-block; font-size: 20px;">Report Card (Session : {{$query1[0]->session}})</p>
                <p style="font-size: 20px;">Issued by {{$datas[0]->name}}</p>
                <p style="font-size: 20px;">Class : {{$query1[0]->class}} {{$query1[0]->section}}</p>
            </div>
          </div>

              <div class="card" style="border-top: solid 2px black; padding: 10px; margin: 10px;">
                <div class="card-content" style="line-height: 0.5;">
                  <div style="border: solid 1px black;">
                  <p style="font-size: 18px; font-weight: 600; margin: 10px 0px 0px 5px; color: #357fac;"> Student Profile</p>
                    <div class="row">
                      <div class="col-sm">
                        <table class="table student_profile" style="display: inline; width: 100%">
                          <!-- <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">First</th>
                              <th scope="col">Last</th>
                              <th scope="col">Handle</th>
                            </tr>
                          </thead> -->
                          <tbody>
                            <tr>
                              <th scope="row">Name</th>
                              <td>{{$query1[0]->firstname}} {{$query1[0]->lastname}}</td>
                            </tr>
                            <tr>
                              <th scope="row">Class & Section</th>
                              <td>{{$query1[0]->class}} {{$query1[0]->section}}</td>
                            </tr>
                            <tr>
                              <th scope="row">D.O.Birth</th>
                              <td colspan="2">{{$query1[0]->dob}}</td>
                            </tr>
                            <tr>
                              <th scope="row">Father's Name</th>
                              <td colspan="2">{{$query1[0]->father_name}}</td>
                            </tr>
                            <tr>
                              <th scope="row">Mother's Name</th>
                              <td colspan="2">{{$query1[0]->mother_name}}</td>
                            </tr>
                            <tr>
                              <th scope="row">Current Address</th>
                              <td colspan="2">{{$query1[0]->current_address}}</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="col-sm">
                        <table class="table student_profile" style="display: inline; width: 100%;">
                          <tbody>
                            <tr>
                              <th scope="row">Roll No.</th>
                              <td colspan="2">{{$query1[0]->roll_no}}</td>
                            </tr>
                            <tr>
                              <th scope="row">Admission No.</th>
                              <td colspan="2">{{$query1[0]->admission_no}}</td>
                            </tr>
                           
                            <tr>
                              <th scope="row">Contact NO.</th>
                              <td colspan="2">{{$query1[0]->mobileno}}</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="col-sm">
                        <div style="text-align: center;">
                          <img src="http://demo.plusonetech.in/plusone/{{$query1[0]->image}}" style="width: 150px; height: 150px; margin-top: 10px; border: solid 1px black; border-radius: 10px; background-color: #ececec;" alt="student_image"></div>
                        </div>
                      </div>
                    </div>

                    <br>
                    

                    <div class="part1" style="border: solid 1px black;">
                      <p style="font-size: 18px; font-weight: 600; color: #357fac; padding: 5px;"> Part-1: Scholastic Area</p>
                      <table class="table" border="1" style="overflow-x: scroll; display: block;">
                        <tbody>
                        <tr style="background-color: #357fac;">
                          <td rowspan="2">Subject code</td>
                          <td rowspan="2">Subject Details</td>
                          <td colspan="3">Peridic Test 1</td>
                          <td colspan="3">Half Yearly</td>
                          <td colspan="3">Periodic Test2</td>
                          <td colspan="3">Annual</td>
                          <td colspan="2">overall Total</td>
                        </tr>

                        <tr style="background-color: #357fac;">
                          <td>Max Marks</td>
                          <td>obtain Marks</td>
                          <td>out of 10</td>
                          <td>Max Marks</td>
                          <td>obtain Marks</td>
                          <td>out of 30</td>
                          <td>Max Marks</td>
                          <td>obtain Marks</td>
                          <td>out of 10</td>
                          <td>Max Marks</td>
                          <td>obtain Marks</td>
                          <td>TH Out of 100/85 PR. Out of 15</td>
                          <td>TH Out of 100/85 PR. Out of 15</td>
                          <td>Grand Total</td>
                        </tr>

                        <tr>
                          <td>301</td>
                          <td>English</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>

                        <tr>
                          <td>041</td>
                          <td>Mathematics</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>

                        <tr>
                          <td>043</td>
                          <td>Physics</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>

                        <tr>
                          <td>042</td>
                          <td>chemistry</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>

                        <tr>
                          <td colspan="2" style="background-color: #357fac;">Total</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>

                        <tr>
                          <td colspan="2" style="background-color: #357fac;">Percentage (%)</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>

                        <tr>
                          <td colspan="2" style="background-color: #357fac;">Grades</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                      </tbody>
                      </table>
                    </div>
                  
                    <p style="font-size: 15px; padding: 5px; line-height: 1;"> <b>Note:</b> student obtain below 33% Marks in any subjects indicates <b>'F'</b> that means fail in that subject.</p>
                  <br>

                  <div style="border: solid 1px black; padding: 10px 0px 10px 0px;">
                    <p style="font-size: 18px; font-weight: 600; color: #357fac; padding: 5px; line-height: 1;"> Part-2: Co-Scholastic Activities (to be on a 5 point scale)</p>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col" style="background-color: #357fac; text-align: center; width: 500px;">Activities</th>
                          <th scope="col" style="background-color: #357fac; text-align: center;">Grade</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Work Education</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Games</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Health & Fitness</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Sewa</td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  
                  <br>

                  <div style="border: solid 1px black; padding: 10px 0px 10px 0px;">
                    <p style="font-size: 18px; font-weight: 600; color: #357fac; padding: 5px;"> Attendance</p>
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <td style="background-color: #357fac; width: 200px;">Attendance</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td style="background-color: #357fac; width: 200px;">Result</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td style="background-color: #357fac; width: 200px;">Remarks</td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  
                  <br>

                  <div style="border: solid 1px black;">
                    <div class="row" style="text-align: center;">
                      <div class="col-sm" style=" padding-top: 50px">
                        <p>Class Teacher</p>
                      </div>
                      <div class="col-sm" style=" padding-top: 50px">
                        <p>Examination C</p>
                      </div>
                      <div class="col-sm" style=" padding-top: 50px">
                        <p>Pricipal</p>
                      </div>
                    </div>
                  </div>

                  <table class="table table-bordered" style="margin-top: 20px;">
                    <tbody>
                      <tr>
                        <td style="background-color: #357fac; width: 200px;">Exam Result</td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                  
                  <div style="border: solid 1px black;">
                    <p style="font-size: 18px; font-weight: 600; color: #357fac; padding: 5px;"> Grading System</p>

                    <div class="row">
                      <div class="col-sm">
                        <table class="table table-bordered">
                          <tbody>
                            <p style="background-color: #357fac; padding: 10px; margin-bottom: -2px; text-align: center;">Scholastic Areas Grading</p>
                            <tr style="background-color: #357fac;">
                              <th scope="col">Grade</th>
                              <th scope="col">Marks Range</th>
                            </tr>
                            <tr>
                              <td>A1</td>
                              <td>91-100</td>
                            </tr>
                            <tr>
                              <td>A1</td>
                              <td>91-100</td>
                            </tr>
                            <tr>
                              <td>A1</td>
                              <td>91-100</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="col-sm">
                        <table class="table table-bordered">
                          <tbody>
                            <p style="background-color: #357fac; padding: 10px; margin-bottom: -2px; text-align: center;">Co-Scholastic Activities (Grading on 5 Points Scale)</p>
                            <tr style="background-color: #357fac;">
                              <th scope="col">Grade</th>
                              <th scope="col">Grade Points</th>
                            </tr>
                            <tr>
                              <td>A</td>
                              <td>5</td>
                            </tr>
                            <tr>
                              <td>B</td>
                              <td>4</td>
                            </tr>
                            <tr>
                              <td>C</td>
                              <td>3</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                  </>
              </div>



    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>


    <script type="text/javascript">

      $("#file-1").fileinput({

          theme: 'fa',

          // uploadUrl: "/imageUpload.php",

          allowedFileExtensions: ['jpg', 'png', 'gif'],

          overwriteInitial: false,

          maxFileSize:2000,

          maxFilesNum: 10,

          // slugCallback: function (filename) {

          //     return filename.replace('(', '_').replace(']', '_');

          // }

      });

  </script>

</body>
</html>