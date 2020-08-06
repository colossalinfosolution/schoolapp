<?php

namespace App\Http\Controllers\Api;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  SimpleSoftwareIO\QrCode\Facades\QrCode;
use DB;

class EstoreController extends Controller
{
   
    //used for list category by using ulr ('/estore/category-list')
    public function category_list(Request $request)
   {
        $result = DB::table('store_category')->select('store_category.*')->get();
        return response()->json($result);
   }


 //used for insert category by using ulr ('/estore/insert-category')
public function insert_category(Request $request)
   {
                $record = array(
                'name' => $request->post('name'),
                'code' => $request->post('code'),
                'description' => $request->post('description')
                  );
                $result = DB::table('store_category')->insert($record);

                return response()->json($result);
         
   }

 //used for update category by using ulr ('/estore/update-category')
    public function update_category(Request $request)
   {
           $record = array(
                'name' => $request->post('name'),
                'code' => $request->post('code'),
                'description' => $request->post('description')
                  );
                $result = DB::table('store_items')->where('id',$request->post('id'))->update($record);

        return response()->json($result);
         
   }


 //used for list items by using ulr ('/estore/items-list')

    public function items_list(Request $request)
   {

        $result = DB::table('store_items')->select('store_items.*')->get();
        return response()->json($result);
   }

    public function items_list_category($category_id)
   {

        $result = DB::table('store_items')->where('category_id', $category_id)->select('store_items.*')->get();
        return response()->json($result);
   }


 //used for insert items by using ulr ('/estore/insert-items')
public function insert_items(Request $request)
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
                return response()->json($result);
         
   }

 //used for update items by using ulr ('/estore/update-items')
    public function update_items(Request $request)
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

        $record1 = DB::table('store_items')->where('id',$id)->select('store_items.*')->get();
        return response()->json($record1);
         
   }

//used for add items in cart by using ulr ('/estore/add-to-cart')
   public function add_to_cart(Request $request)
   {
               $record['item_id'] = $request->post('item_id');
                $record['student_id'] = $request->post('student_id');
                 $record['parent_id'] = $request->post('parent_id');
                $record['category_id'] = $request->post('category_id');
                $record['item_name'] = $request->post('item_name');
                $record['code'] = $request->post('code');
                $record['description'] = $request->post('description');
                $record['quantity'] = $request->post('quantity');
                $record['size'] = $request->post('size');
                $record['age'] = $request->post('age');
                $record['color'] = $request->post('color');
                $record['price'] = $request->post('price');
                $record['bookbyclass'] = $request->post('bookbyclass');
                $record['publisher'] = $request->post('publisher');
                $record['setofbooks'] = $request->post('setofbooks');
                $result = DB::table('cart')->insert($record);
                return response()->json($result);
         
   }

//used for update items in cart by using ulr ('/estore/update-cart')

   public function update_cart(Request $request)
   {
                $record['id'] = $request->post('id');
                $record['item_id'] = $request->post('item_id');
                $record['student_id'] = $request->post('student_id');
                $record['parent_id'] = $request->post('parent_id');
                $record['category_id'] = $request->post('category_id');
                $record['item_name'] = $request->post('item_name');
                $record['code'] = $request->post('code');
                $record['description'] = $request->post('description');
                $record['quantity'] = $request->post('quantity');
                $record['size'] = $request->post('size');
                $record['age'] = $request->post('age');
                $record['color'] = $request->post('color');
                $record['price'] = $request->post('price');
                $record['bookbyclass'] = $request->post('bookbyclass');
                $record['publisher'] = $request->post('publisher');
                $record['setofbooks'] = $request->post('setofbooks');
                $result = DB::table('cart')->where('id',$request->post('id'))->update($record);
                return response()->json($result);
         
   }

//used for list items by userid in cart by using ulr ('/estore/list-cart/1')
   public function list_cart($parent_id)
   {
                
                $result = DB::table('cart')
                ->leftjoin('store_category','store_category.id','=','cart.category_id')
                ->leftjoin('store_items','store_items.id','=','cart.item_id')
                ->where('parent_id',$parent_id)
                ->select('cart.*','store_category.name as category_name','store_items.item_name','store_items.image as item_image')->get();
                return response()->json($result);
         
   }
//used for delete items in cart by id using ulr ('/estore/delete-cart-item/1')

  public function delete_cart_item($id)
   {      
                $result = DB::table('cart')->where('id',$id)->delete();
                return response()->json($result);
   }
 



} 