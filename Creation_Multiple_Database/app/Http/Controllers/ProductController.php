<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategoryModel;
use App\Models\ProductModel;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{


public function product_home()
{
    $sub = SubCategoryModel::all();
    
    // Fetch all products along with their linked category names
    $products = ProductModel::with('category')->get();
    
    // Pass both variables to your view
    return view('Categories.product_home', compact('sub', 'products'));
}


    public function insert_product(Request $request)
    {
        // 1. Validate form fields
        $validatedData = $request->validate([
            'products_name'   => 'required|string|max:255',
            'products_amount' => 'required|numeric|min:0',
            'SKU'             => 'required|string|unique:products_tb,SKU',
            'sub_categories'  => 'required|exists:sub_category_tb,sub_category_pk' // Ensures valid FK relation
        ]);

        try {
            // 2. Perform safe atomic database insertion
            DB::transaction(function() use ($validatedData) {
                $product = new ProductModel();
                $product->products_name         = $validatedData['products_name'];
                $product->products_amount       = $validatedData['products_amount'];
                $product->SKU                   = $validatedData['SKU'];
                
                
            
                $product->products_category_fk  = $validatedData['sub_categories'];
                
                $product->save();
            });

            return redirect()->route('product_home')->with('success', 'Product inserted successfully with foreign key assignment!');

        } catch (\Throwable $e) {
            return back()->withInput()->withErrors(['db_error' => 'Database Placement Failed: ' . $e->getMessage()]);
        }
    }
}
