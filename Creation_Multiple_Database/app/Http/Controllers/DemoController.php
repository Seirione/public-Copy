<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategoryModel;
use App\Models\ProductModel;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
class DemoController extends Controller
{
    public function demo_home(){
        Artisan::call('db:download-database');
        $car = SubCategoryModel::all();
        return view('Demo.demo', compact('car'));
    }
    public function insert(Request $request){
        $products_name = $request->products_name;
        $products_amount= $request->products_amount;
        $SKU= $request->SKU;
        $take_the_id = $request->input('products_category_fk');
        
        //instatiate
        $p = new ProductModel();
        $p->products_name = $products_name;
        $p-> products_amount = $products_amount;
        $p->SKU = $SKU;
        $p-> products_category_fk = $take_the_id;

        $p->save();
        return redirect()->route('demo_home');

    }



    public function downloadETLDatabase(){
     // call the command
    Artisan::call('db:DatabaseExtract');
    $files = Storage::disk('public')->files('exports');
    $latestFile = end($files);

    if($latestFile){
        return Storage::disk('public')->download($latestFile);
    }

   return redirect()->route('demo_home');
    }


   public function downloadDatabase()
{
    // 1. Runs your exact mysqldump command
    Artisan::call('db:download-database');

    // 2. Grabs the exported file from storage/app/public/exports
   $files = Storage::disk('local')->files('exports');
    $latestFile = end($files);

    // 3. Triggers the browser download / "Save As" window
    if ($latestFile) {
      return Storage::disk('local')->download($latestFile);
    }

    return redirect()->route('demo_home');
}
}
