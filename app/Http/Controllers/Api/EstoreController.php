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
       if(!empty($result[0]) && $result[0] != '')
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


 //used for insert category by using ulr ('/estore/insert-category')
public function insert_category(Request $request)
   {
                $record = array(
                'name' => $request->post('name'),
                'code' => $request->post('code'),
                'description' => $request->post('description')
                  );
                $result = DB::table('store_category')->insert($record);

               if(isset($result) && $result != '')
         {
          return response()->json(['status' => '200',//sample entry
   'message' => 'item inserted',
   'data'=>$record]);  
        }
        else{
return response()->json(['status' => '404',//sample entry
   'message' => 'items not inserted']);  
        }
         
   }

 //used for update category by using ulr ('/estore/update-category')
    public function update_category(Request $request)
   {
           $record = array(
                'name' => $request->post('name'),
                'code' => $request->post('code'),
                'description' => $request->post('description')
                  );
                $result = DB::table('store_category')->where('id',$request->post('id'))->update($record);

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


 //used for list items by using ulr ('/estore/items-list')

    public function items_list(Request $request)
   {

        $result = DB::table('store_items')->select('store_items.*')->get();
             if(!empty($result[0]) && $result[0] != '')
            {
             return response()->json(['status' => '200',//sample entry
                                  'message' => 'items found',
                                  'data'=>array($result)
                                  ]);  
             }

         else{
            return response()->json(['status' => '404',//sample entry
                                   'message' => 'items not found']
                                   );  
             }
   }

    public function items_list_category(Request $request)
   {

        $result = DB::table('store_items')->where('category_id',$request->post('category_id'))
        ->select('store_items.*')
        ->get();

        $allitems = DB::table('store_items')
        ->select('store_items.*')
        ->orderby('id', 'desc')
        ->limit(20)
        ->get();

        $dataall =array();
        $i = 0;
        foreach ($result as $value) {
         $cartdata = $result = DB::table('cart')
                ->where('parent_id',$request->post('parent_id'))
                ->where('item_id',$value->id)
                ->select('id as cart_id','quantity as cart_quantity')
                ->get();
                if(!empty($cartdata[0]) && $cartdata[0] != '')
            {
                $data1['in_cart'] ='yes';

                $data1['list'] = $value;
                $data1['cart_id'] = $cartdata;
                // $data1['allitems'] = $allitems;
                $dataall[$i]= $data1;
                $i++;
        }
        else{
          $data1['in_cart'] ='no';

                $data1['list'] = $value;
                $data1['cart_id'] = $cartdata;
               // $data1['allitems'] = $allitems;
                $dataall[$i]= $data1;
                $i++;
        }
      }
      
       if(!empty($dataall[0]) && $dataall[0] != '')
         {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'items found',
                                   'data'=>$dataall,
                                   'allitems'=>$allitems]
                                 );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not found']
                                   );  
            }
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

//used for add items in cart by using ulr ('/estore/add-to-cart')
   public function add_to_cart(Request $request)
   {

       $result = DB::table('cart')
                ->where('parent_id',$request->post('parent_id'))
                ->where('item_id',$request->post('item_id'))
                ->get();
            if(!empty($result[0]) && $result[0] != '')
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
                $result = DB::table('cart')->where('parent_id',$request->post('parent_id'))->where('item_id',$request->post('item_id'))->update($record);
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
                else
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
                $cart_id=DB::getPdo()->lastInsertId();
                 if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'items inserted',
                                   'data'=>$record,
                                   'cart_id'=>$cart_id]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not inserted']
                                   );  
            }
                }
              
         
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

//used for list items by userid in cart by using ulr ('/estore/list-cart/1')
   public function list_cart($parent_id)
   {
                
          $result = DB::table('cart')
          ->leftjoin('store_category', 'store_category.id','=', 'cart.category_id')
          ->leftjoin('store_items', 'store_items.id','=', 'cart.item_id')
          ->where('parent_id',$parent_id)
          ->select('cart.*','store_category.name as cate_name','store_items.image')->get();

            if(!empty($result[0]) && $result[0] != '')
         {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'items found',
                                   'data'=>$result]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not found']
                                   );  
            }
         
   }
//used for delete items in cart by id using ulr ('/estore/delete-cart-item/1')

  public function delete_cart_item(Request $request)
   {      
           $parent_id= $request->post('parent_id');
           $item_id= $request->post('item_id');
                $result = DB::table('cart')
                ->where('parent_id',$parent_id)
                ->where('item_id',$item_id)
                ->delete();
            
            if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'items deleted']
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not found']
                                   );  
            }
   }

    public function placeOrder(Request $request)
   {
                $record['userid'] = $request->post('userid');
                $record['item_id'] = $request->post('item_id');
                $record['session_id'] = $request->post('session_id');
                $record['first_name'] = $request->post('first_name');
                $record['last_name'] = $request->post('last_name');
                $record['number'] = $request->post('number');
                $record['email'] = $request->post('email');
                $record['city'] = $request->post('city');
                $record['post_code'] = $request->post('post_code');
                $record['address'] = $request->post('address');
                $record['payment_method'] = $request->post('payment_method');
                $record['total_cost'] = $request->post('total_cost');
                $record['total_item'] = $request->post('total_item');
                $record['razorpay_payment_id'] = $request->post('razorpay_payment_id');

                $result = DB::table('order_placed')->insert($record);
                $id = DB::getPdo()->lastInsertId();

                $newcart = DB::table('cart')->where('parent_id',$request->post('userid'))->select('cart.*')->get();
                foreach ($newcart as $value) {
                    $cartdata['item_id'] = $value->item_id;
                    $cartdata['parent_id'] = $value->parent_id;
                    $cartdata['qnt'] = $value->quantity;
                    $cartdata['order_id'] = $id;
                    $resultcart = DB::table('cart_item')->insert($cartdata);
                  
                }
                


                $delete = DB::table('cart')->where('parent_id',$request->post('userid'))->delete();
                if(isset($result) && $result != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'items inserted',
                                   'data'=>$record]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'items not inserted']
                                   );  
            }
         
   }
 


 public function itemStatus(Request $request)
   {
                $result = DB::table('cart')
                ->where('parent_id',$request->post('parent_id'))
                ->where('item_id',$request->post('item_id'))
                ->get();
            if(!empty($result[0]) && $result[0] != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'item found',
                                   'cart_item'=>'1']
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'item not found',
                                    'cart_item' => '0']
                                   );  
            }
         
   }
public function addUpdateSupplier(Request $request)
   {

        if (empty($request->post('id'))) {
        
               $record['name'] = $request->post('name');
                $record['email'] = $request->post('email');
                 $record['phone'] = $request->post('phone');
                $record['address'] = $request->post('address');
                $record['contact_person_name'] = $request->post('contact_person_name');
                $record['contact_person_email'] = $request->post('contact_person_email');
                $record['description'] = $request->post('description');
                $record['contact_person_phone'] = $request->post('contact_person_phone');
                
                $result = DB::table('store_item_supplier')->insert($record);
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
                  
               $record['name'] = $request->post('name');
                $record['email'] = $request->post('email');
                 $record['phone'] = $request->post('phone');
                $record['address'] = $request->post('address');
                $record['contact_person_name'] = $request->post('contact_person_name');
                $record['contact_person_email'] = $request->post('contact_person_email');
                $record['description'] = $request->post('description');
                $record['contact_person_phone'] = $request->post('contact_person_phone');
                $result = DB::table('store_item_supplier')->where('id',$request->post('id'))->update($record);
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

   public function PlacedOrderList(Request $request)
   {
    
  $result = DB::table('order_placed')
  ->where('userid', $request->post('parent_id'))
  ->select('order_placed.*')
  //->groupby('userid')
  ->get();
  $i=0;
  $data = array();
  
  foreach ($result as  $value) {
    $items = DB::table('cart_item')->leftjoin('store_items','store_items.id','=','cart_item.item_id')
    ->where('cart_item.parent_id',$request->post('parent_id'))
    ->where('cart_item.order_id',$value->id)
    ->select('store_items.*','cart_item.qnt as cart_item_quantity','cart_item.created_at as date')->get();
    $record['orderdetail'] = $value;
    
    $record['itemlist'] = $items;
    $data[$i] = $record;
    
    $i++;
  }


  
    if(!empty($data) && $data != '')
            {
            return response()->json(['status' => '200',//sample entry
                                   'message' => 'item found',
                                   'data'=>$data]
                                   );  
            }
        else{
            return response()->json(['status' => '404',//sample entry
                                    'message' => 'item not found'
                                    ]
                                   );  
            }

}


} 