<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'qrController@index');

Route::get('qrcode/{id}', 'qrController@sendqr');
Route::get('read', 'qrController@read');
Route::post('upload-submit', 'qrController@upload_submit');
Route::get('upload', 'qrController@upload');
Route::post('submit', 'qrController@submit');
Route::post('insertDisciplines', 'qrController@insert_disciplines');
Route::post('updateDisciplines', 'qrController@update_disciplines');
Route::post('insertUpdateleaveTypes', 'qrController@insertUpdateleaveTypes');

Route::get('discipline', 'qrController@disciplinehome');
Route::get('paymentHistory', 'qrController@paymentHistory');


Route::get('paywithrazorpay/{student_id}', 'RazorpayController@payWithRazorpay')->name('paywithrazorpay');
// Post Route For Makw Payment Request
Route::post('payment', 'RazorpayController@payment')->name('payment');


Route::get('categoryList', 'qrController@store_category');
Route::get('editCategory/{id}', 'qrController@edit_store_category');
Route::get('deleteCategory/{id}', 'qrController@deleteCategory');

Route::get('dispersalList', 'qrController@dispersalList');
Route::get('delegateList', 'qrController@delegateList');
Route::get('leaveList', 'qrController@leaveListAdmin');

Route::post('attendenceTypeInsert', 'qrController@attendenceTypeInsert');
Route::get('attendenceList', 'qrController@attendenceList');
Route::get('editAttendenceType/{id}', 'qrController@editAttendenceList');
Route::get('deleteAttendenceType/{id}', 'qrController@deleteAttendenceList');


Route::post('staffAttendenceTypeInsert', 'qrController@staffAttendenceTypeInsert');
Route::get('staffAttendenceList', 'qrController@staffAttendenceList');
Route::get('editStaffAttendenceType/{id}', 'qrController@editStaffAttendenceList');
Route::get('deleteStaffAttendenceType/{id}', 'qrController@deleteStaffAttendenceList');

Route::get('subjectBook', 'qrController@subjectBook');
Route::get('editSubjectBook/{id}', 'qrController@editSubjectBook');
Route::get('deleteSubjectBook/{id}', 'qrController@deleteSubjectBook');

Route::get('leaveTypeList', 'qrController@leaveTypeList');
Route::get('editleaveType/{id}', 'qrController@editleaveType');
Route::get('deleteleaveType/{id}', 'qrController@deleteleaveType');

Route::get('icons', 'qrController@icons');
Route::post('uploadicon', 'qrController@uploadicon');
Route::get('deleteIcon/{id}', 'qrController@deleteIcon');

Route::get('subjectIcons', 'qrController@subjectIcons');
Route::get('deleteSubjectIcon/{id}', 'qrController@deleteSubjectIcon');
Route::get('editSubjectIcons/{id}', 'qrController@editSubjectIcons');

Route::post('galleryUploads', 'Api\ApiController@galleryUploads');
Route::post('galleryupdate', 'Api\ApiController@galleryupdate');
Route::get('listGallery', 'Api\ApiController@listGallery');


Route::get('itemsList', 'qrController@store_items');
Route::get('editItems/{id}', 'qrController@edit_store_items');
Route::get('deleteItems/{id}', 'qrController@deleteItems');
Route::post('/estore/insertItem', 'qrController@insertItem');
Route::post('/estore/updateItem', 'qrController@updateItem');


Route::get('gallery', 'qrController@upload');
Route::post('insertgalleryUpload', 'qrController@insertGallery')->name('gallery.upload');
Route::get('deleteGallery/{id}', 'qrController@deleteGallery');
Route::get('editGallery/{id}', 'qrController@editGallery');
Route::post('updateGallery', 'qrController@updateGallery');
Route::get('parentGallery', 'qrController@parentGallery');



Route::get('supplier', 'qrController@supplier');
Route::get('supplier/{id}', 'qrController@editSupplier');
Route::get('deleteSupplier/{id}', 'qrController@deleteSupplier'); 

Route::get('orderHistory', 'qrController@orderHistory');
Route::post('updateOrderStatus', 'qrController@updateOrderStatus');
Route::get('editOrderStatus/{id}', 'qrController@editOrderStatus');
Route::get('teacher_perf/{homeworkid}/{class_id}/{section_id}/{staff_id}', 'qrController@teacher_perf');

Route::post('InsertUpdateSubjectBook', 'qrController@InsertUpdateSubjectBook');

Route::get('poll', 'qrController@pole');
Route::get('poll/{id}', 'qrController@editPole');
Route::get('deletePoll/{id}', 'qrController@deletePole');

Route::get('pollAnswer', 'qrController@poleAns');
Route::get('pollAnswer/{id}', 'qrController@editPoleAns');
Route::get('deletePollAnswer/{id}', 'qrController@deletePoleAns');
Route::get('pollResult/{id}', 'qrController@poleResults');

Route::get('reportCard/{id}', 'qrController@reportCard');

