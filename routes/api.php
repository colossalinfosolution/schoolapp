<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('iHaveArrived', 'Api\ApiController@iHaveArrived');
Route::post('searchArrived', 'Api\ApiController@searchArrived');
Route::post('generateQrCode', 'Api\ApiController@genarateQrCode');
Route::post('dispersalDetail', 'Api\ApiController@DispersalDetail');
Route::post('disperseStudent', 'Api\ApiController@disperseStudent');
Route::post('delegate', 'Api\ApiController@delegate');
Route::get('delegateList/{parent_id}', 'Api\ApiController@delegateLists');

Route::post('teacherSchedule', 'Api\ApiController@teacher_schedule');
Route::post('InsertUpdateAttendenceType', 'Api\ApiController@attendenceType');
Route::post('insertUpdateStaffAttendenceType', 'Api\ApiController@staffAttendenceType');
Route::get('getStaffAttendenceType', 'Api\ApiController@getStaffAttendenceType');
Route::post('InsertUpdateSubjectBooks', 'Api\ApiController@InsertUpdateSubjectBooks');
Route::post('InsertUpdateLeaveType', 'Api\ApiController@leaveType');
Route::post('uploadicons', 'Api\ApiController@uploadicons');
Route::post('InsertUpdateSubjectIcon', 'Api\ApiController@InsertUpdateSubjectIcon');

Route::post('addUpdatePole', 'Api\ApiController@addUpdatePole');
Route::post('addUpdatePoleAns', 'Api\ApiController@addUpdatePoleAns');

Route::post('uploadContents', 'Api\ApiController@uploadContents');
Route::post('staffTimeline', 'Api\ApiController@staffTimeline');

Route::get('listLeaveType', 'Api\ApiController@listLeaveType');
Route::get('listContents', 'Api\ApiController@listContents');
Route::get('listAttendance', 'Api\ApiController@listAttendance');
Route::get('subjectIcon', 'Api\ApiController@subjectIcon');
Route::get('pdf/{id}', 'Api\ApiController@pdf');
Route::post('changePassword', 'Api\ApiController@changePassword');
//Route::post('read', 'Api\ApiController@readcode');
Route::post('submit', 'Api\ApiController@submit');
Route::post('child_of_parent', 'Api\ApiController@child_of_parent');
Route::post('subjectBooks', 'Api\ApiController@subjectBooks');
Route::post('addTimeline', 'Api\ApiController@addTimelines');
Route::post('showTimeline', 'Api\ApiController@showTimeline');
Route::post('teacherPerformance', 'Api\ApiController@teacherPerformance');

Route::post('galleryUploads', 'Api\ApiController@galleryUploads');
Route::post('galleryupdate', 'Api\ApiController@galleryupdate');
Route::get('listGallery', 'Api\ApiController@listGallery');

Route::post('getPole', 'Api\ApiController@getPole');
Route::post('addPoleVotes', 'Api\ApiController@addPoleVotes');

Route::post('addtodo', 'Api\ApiController@addtodo');
Route::post('todoList', 'Api\ApiController@todoList');
Route::post('updateTodo', 'Api\ApiController@updateTodo');
Route::get('deleteTodo/{id}', 'Api\ApiController@deleteTodo');


Route::post('search', 'Api\DisciplineController@search');
Route::post('updateDiscipline', 'Api\DisciplineController@update_discipline');
Route::post('insertDiscipline', 'Api\DisciplineController@insert_discipline');
Route::get('childDiscipline/{id}', 'Api\DisciplineController@parent_child_discipline');
Route::post('childDisciplineByMonth', 'Api\DisciplineController@parent_child_discipline_monthly');


Route::post('leaveSubmit', 'Api\LeaveController@leave_insert');
Route::post('leaveUpdate', 'Api\LeaveController@leave_update');
Route::get('leaveList', 'Api\LeaveController@leave_list');
Route::get('leaveListParent/{student_id}', 'Api\LeaveController@leave_list_parent');
Route::get('leave_type', 'Api\LeaveController@leave_type');



//Estore Urls//
Route::get('estore/categoryList', 'Api\EstoreController@category_list');
Route::post('estore/insertCategory', 'Api\EstoreController@insert_category');
Route::post('estore/updateCategory', 'Api\EstoreController@update_category');

Route::post('estore/itemsList', 'Api\EstoreController@items_list_category');
//Route::post('estore/itemsList', 'Api\EstoreController@item_list_category');
Route::post('estore/insertItems', 'Api\EstoreController@insert_items');
Route::post('estore/updateItems', 'Api\EstoreController@update_items' );
//Route::get('estore/itemsList', 'Api\EstoreController@items_list');

Route::post('estore/addToCart', 'Api\EstoreController@add_to_cart');
Route::post('estore/updateCIart', 'Api\EstoreController@update_cart');
Route::get('estore/listCart/{parent_id}', 'Api\EstoreController@list_cart');
Route::post('estore/deleteCartItem', 'Api\EstoreController@delete_cart_item');

Route::post('estore/placeOrder', 'Api\EstoreController@placeOrder');
Route::post('estore/itemStatus', 'Api\EstoreController@itemStatus');
Route::post('estore/addUpdateSupplier', 'Api\EstoreController@addUpdateSupplier');
Route::post('estore/PlacedOrderList', 'Api\EstoreController@PlacedOrderList');











