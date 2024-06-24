<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Product;


class TestController extends Controller
{
    public function index()
    {$products = Product::all();
        return response()->json([
            'success' =>true,
            'message' => 'Product List',
            "data" =>$products
        ]);

    }

    public function store(Request $request)
    {

        $input  = $request->all();

        $validator = Validator::make($input,[
            'name' => 'required',
            'details' => 'required',
        ]);
        if($validator->fails()){

            return response()->json([
                'fail' =>false,
                'message' => 'Sorry not stored',
                "data" =>$validator->error()
            ]);

        }else{

            $product = Product::create($input);

            return response()->json([
                'success' =>true,
                'message' => 'Product created succeeded ',
                "data" =>$product
            ]);

        }




    }

    public function show($id)
    {

        $product = Product::find($id);



        if(is_null($product)){

            return response()->json([
                'fail' =>false,
                'message' => 'Sorry not found'
            ]);

        }else{



            return response()->json([
                'success' =>true,
                'message' => 'Product fetched succeeded ',
                "data" =>$product
            ]);

        }




    }
    //hello


    public function update(Request $request, Product $product)
    {

        $input  = $request->all();

        $validator = Validator::make($input,[
            'name' => 'required',
            'details' => 'required',
        ]);
        if($validator->fails()){

            return response()->json([
                'fail' =>false,
                'message' => 'Sorry not stored',
                "data" =>$validator->error()
            ]);

        }else{


            $product->name = $input['name'];
            $product->details = $input['details'];
            $product->save();



            return response()->json([
                'success' =>true,
                'message' => 'Product has been updated succeeded ',
                "data" =>$product
            ]);

        }




    }


    public function destroy(Product $product)
    {

        $product->delete();



        return response()->json([
            'success' =>true,
            'message' => 'Product has been deleted',
            "data" =>$product
        ]);

    }

}
