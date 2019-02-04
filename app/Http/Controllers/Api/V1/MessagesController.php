<?php

namespace FacebookBot\Http\Controllers\Api\V1;

use FacebookBot\Http\Controllers\ApiControllerTrait;
use FacebookBot\Http\Controllers\Controller;
use FacebookBot\Message;
use FacebookBot\Product;
use Illuminate\Http\Request;

class MessagesController extends Controller
{

    use ApiControllerTrait;

    protected $model;

    public function __construct(Message $model)
    {
        $this->model = $model;
    }
    
    public function product(Request $request, $id)
    {
        $product = Product::find($request->input('product_id'));
        $message = Message::find($id);
        $message->products()->attach($product);
        
        return response()->json(['status' => 'success']);
    }
    
    public function getProduct($id)
    {
        $message = Message::find($id);        
        return response()->json($message->products);
    }
    
    public function deleteProduct($id, $product_id)
    {
        $product = Product::find($product_id);
        $message = Message::find($id);
        $message->products()->detach($product);
        
        return response()->json(['status' => 'success']);
    }

}
