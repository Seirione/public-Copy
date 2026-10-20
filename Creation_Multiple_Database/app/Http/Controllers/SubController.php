<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategoryModel;
use Illuminate\Support\Facades\DB; // 1. Added DB Facade Import

class SubController extends Controller
{
    public function home()
    {
        $category = SubCategoryModel::all();
        return view('SubCategory.sub_home', compact('category'));
    }

    public function insert(Request $request)
    {
        // Validation handles error redirections automatically
            $check_validation = $request->validate([
            // Format: unique:table_name,column_name
            'category' => 'required|min:3|unique:sub_category_tb,Category' 
        ]);
        try {
            // 2. Executing transactional database queries
            DB::transaction(function() use ($check_validation) {
                $category = new SubCategoryModel();
                $category->Category = $check_validation['category'];
                $category->save();
            });

            // 3. Moved return statements OUTSIDE the transaction closure block
            return redirect()->route('sub_home')->with('success', 'Category inserted successfully!');

        } catch (\Throwable $e) {
            // 4. Safely redirect back with a custom error message on DB failure
            return back()->withInput()->withErrors(['db_error' => 'Error Inserting: ' . $e->getMessage()]);
        }
    }

    public function update($id){
        $category_update = SubCategoryModel::find($id);
        return view('SubCategory.sub_update_page', compact('category_update'));
    }

    public function updating(Request $request, $id){
         // Validation handles error redirections automatically
          $check_validation = $request->validate([
                'category' => 'required|min:3|unique:sub_category_tb,Category,' . $id . ',sub_category_pk' 
            ]);
        
               $categoryName = $check_validation['category'];
          try {
            // 2. Executing transactional database queries
            DB::transaction(function() use ($categoryName, $id) {
            $category_update = SubCategoryModel::find($id);
            $category_update->Category =  $categoryName;
            $category_update-> save();
        });
          return redirect()->route('sub_home')->with('success', 'Update Successfully');
           } catch (\Throwable $e) {
            // 4. Safely redirect back with a custom error message on DB failure
            return back()->withInput()->withErrors(['db_error' => 'Error Updating: ' . $e->getMessage()]);
        }
    }
}
