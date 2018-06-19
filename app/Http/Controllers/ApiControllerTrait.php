<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

trait ApiControllerTrait
{
    public function index(Request $request)
    {
        $data= $request->all();
        $limit = $data['limit'] ?? 20;
        $order = $data['order'] ?? null;
        
        if($order){
            $order = explode(',', $order);
        }
        $order[0] = $order[0] ?? 'id';
        $order[1] = $order[1] ?? 'asc';
        
        $where = $data['where'] ?? [];
        $like = $data['like'] ?? null;
        
        if($like){
            $like = explode(',', $like);
            $like[1] = '%' . $like[1] . '%';
        }
        $users = $this->model
                ->orderBy($order[0], $order[1])
                ->where(function ($query) use ($like){                
                    if($like){
                        return $query->where($like[0], 'like', $like[1]);
                    }
                    return $query;
                })
                ->where($where)
                ->paginate($limit);
        return response()->json($users);
    }
    
    public function show($id)
    {
        $result = $this->model->findOrFail($id);
        return response()->json($result);
    }
    
    public function store(Request $request)
    {
        $result = $this->model->create($request->all());
        return response()->json($result);
    }
    
    public function update(Request $request)
    {
        $result = $this->model->findOrFail($id);
        $result->update($request->all());
        return response()->json($result);
    }
    
    public function delete($id)
    {
        $result = $this->model->findOrFail($id);
        $result->delete();
        return response()->json($result);
    }
}
