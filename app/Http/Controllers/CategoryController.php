<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       //function to fetch 
        try{
            $categories = Category::OrderByDesc('created_at')->paginate(20);//select * from categories
            return CategoryResource::collection($categories);

        }catch(\Throwable $error){
            return response()->json(['message'=>$error->getMessage()],500);
        }
        

    }

  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        try{
            $valid =Validator::make($request->all(),[
                'name'=>'required|string|min:3|max:255',
                'type'=>'required|string|min:3|max:255'
            ]);

            if($valid->fails()){
                return response()->json(['error'=>$valid->errors()->all()],422);
            }
            $input=Category::create([
                    ...$request->all()
                ]);
            return CategoryResource::make($input);
               
            

        }catch(\Throwable $error)
        {
            return response()->json(['message'=>$error->getMessage()],500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
        $single = Category::find($id);
        if(!$single){
            return response()->json(['oops!'=>'No data Found,try another Id']);
        }
        return $single;
        //return CategoryResource::collection($single);

        }catch(\Throw $error)
        {
            return response()->json(['message'=>$error->getMessage()],500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            //find the data to update
            $categor = Category::find($id);
            if(!$categor){
                return response()->json(['oops!'=>'No data Found,try another Id']);
            }
            //then validate, that means you can't save empty data
            $valid =Validator::make($request->all(),[
                'name'=>'required|string|min:3|max:255',
                'type'=>'required|string|min:3|max:255'
            ]);
            //check data if is valid
            if($valid->fails()){
                return response()->json(['error'=>$valid->errors()->all()],422);
            }
            //data object to update once found
            $categor->update($request->all());
            return CategoryResource::make($categor);

        }catch(\throw $error){
            return response()->json(['message'=>$error->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $delt = Category::find($id);
            //check if data is present
            if(!$delt){
                return response()->json(['oops!'=>'No data Found,try another Id']);
            }
            $delt->delete();
            return response()->json(['message'=>'data deleted successfully'],200);

        }catch(\throw $error){
        return response()->json(['message'=>$error->getMessage()],500); 
        }
    }
}
