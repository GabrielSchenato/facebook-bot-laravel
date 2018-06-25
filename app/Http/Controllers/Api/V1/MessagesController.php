<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiControllerTrait;
use App\Http\Controllers\Controller;
use App\Message;
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
        $product = \App\Product::find($request->input('product_id'));
        $message = Message::find($id);
        $message->products()->attach($product);
        
        return response()->json(['status' => 'success']);
    }
    
    public function getProduct($id)
    {
        $message = Message::find($id);        
        return response()->json($message);
    }
    
    public function deleteProduct($id, $product_id)
    {
        $product = \App\Product::find($product_id);
        $message = Message::find($id);
        $message->products()->detach($product);
        
        return response()->json(['status' => 'success']);
    }

}
