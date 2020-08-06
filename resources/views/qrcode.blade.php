<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
           .items-list {
box-shadow: -2px 1px 14px #e5e6e8;
list-style-type: none;
margin-left:0px;
padding-left:0px;
margin-bottom:15px;
width:100%;
}


@media only screen and (max-width:400px)  {
.items-list {
height:110px;
}
.items-list .kmtext {
  padding-bottom:6px;
}
.items-list img
{
float:left;
 width:40%;
 height:100%;
 margin-right:7px;
}
.items-list .righttxt {
 width:100%;
padding: 5px;
}
}
@media only screen and (min-width:401px) and (max-width:500px)  {
.items-list {
height:200px;
}
.items-list .kmtext {
  padding-bottom:20px;
}
.items-list img
{
float:left;
 width:45%;
 height:100%;
 margin-right:7px;
}
.items-list .righttxt {
 width:100%;
padding: 15px;
}
}

@media only screen and (min-width:501px) and (max-width:700px)   {
.items-list {
height:250px;
}
.items-list .kmtext {
  padding-bottom:20px;
}
.items-list img
{
float:left;
 width:45%;
 height:100%;
 margin-right:7px;
}
.items-list .righttxt {
 width:100%;
padding: 40px;
}
}
@media only screen and (min-width:701px) and (max-width:1399px)  {
.items-list {
height:300px;
}
.items-list .kmtext {
  padding-bottom:20px;
}
.items-list img
{
float:left;
 width:25%;
 height:100%;
 margin-right:65px;
}
.items-list .righttxt {
 width:100%;
padding: 50px;
}
}
@media only screen and (min-width:1400px) {
.items-list {
height:330px;
}
.items-list .kmtext {
  padding-bottom:20px;
}
.items-list img
{
float:left;
 width:45%;
 height:100%;
 margin-right:7px;
}
.items-list .righttxt {
 width:100%;
padding: 60px;
}
}
.items-list img
{
 object-fit: initial;
border-right: 5px solid;
border-image:   linear-gradient(to bottom, #86DF7B 50%,#7BAADF 50%) 2;
}

.items-list .kmtext {
  color:#26b7a1;
  font-size:80%;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    line-height: 21px;
    max-height: 48px;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
}
.items-list .pricetext {
  color:#020202;
  font-weight:bold;
  padding-bottom:6px;
  font-size:120%;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    line-height: 21px;
    max-height: 48px;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
}
.items-list .titletext {
  color:#919396;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    line-height: 21px;
    max-height: 48px;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}
.button {
    display: block;
    width: 115px;
    height: 25px;
    background: #4E9CAF;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    color: white;
    font-weight: bold;
}
        </style>
    </head>
    <body>
       <ul>
       
<li class="items-list">
    <h3>QR Code</h3>
       <?php echo $qr ?>
</div>
</div>
</li>
</ul>
<form action="{{url('read')}}" method="GET" style="margin-left: 43px;">
 
  <label for="code">Enter Code Here:</label><br>
  <input type="text" id="code" name="code" value="" style="display: flex;margin-top: 10px;height: 28px;margin-bottom: -11px;"><br>

  <input type="submit" class="button" value="Submit" style="height: 38px;">
</form> 
 
    </body>
</html>
