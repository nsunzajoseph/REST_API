<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
    */
    public function index()
    {
        try {
            //$products = Product::all();//select * FROM products;
            $products = Product::orderByDesc('created_at')->paginate(20);
            return ProductResource::collection($products);
        } catch (\Throwable $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->all()], 422);
            }
            $product = Product::create([
                ...$request->all()
            ]);
            return ProductResource::make($product);
            
        } catch (\Throwable $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
    */
    public function show(string $id)
    {
        try{
            $product = Product::find($id);
            if(!$product){
                return response()->json(['message'=>'Sorry! No data Found, please try another id']);
            }
            return $product;
        }catch(\throw $error){
            return response()->json(['error'=>$error->getMessage()],500);
        }
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //update data into the database
        try{
            $editprodct = Product::find($id);
            if(!$editprodct){
                return response()->json(['message'=>'No data found with this id, please try another Id']);
            }
            $validit = Validator::make($request->all(),[
                'name'=>'required|min:3|max:255',
                'description'=>'required|min:3|max:255'
            ]);
            if($validit->fails())
            {
                return response()->json(['error'=>$validit->errors()->all()],422);
            }
            $editprodct->update($request->all());
            return response()->json(['success'=>'Data updated successfully']);
            return ProductResource::make($editprodct);

        }catch(\throw $error){
            return response()->json(['error'=>$error->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete data from the database
        try{
            $deletd = Product::find($id);
            if(!$deletd){
                return response()->json(['message'=>'Sorry! No data Found, please try another id']);
            }
            $deletd->delete();
            return response()->json(['message'=>'Data deleted Successfully']);
        }
        catch(\throw $error){
            return response()->json(['error'=>$error->getMessage()],500);
        }
    }
}
