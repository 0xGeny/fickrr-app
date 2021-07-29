<?php

namespace Fickrr\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Fickrr\Http\Controllers\Controller;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Mail;
use Excel;
use Fickrr\Models\ExportProduct;
use Fickrr\Models\ImportProduct;


class ImportExportController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
		
    }
	
	public function view_products_import_export()
    {
        
		return view('admin.products-import-export');
		
    }
	
	public function download_products_export($type)
    {
	   $filename = "products_".uniqid().'.'.$type;
	   return Excel::download(new ExportProduct, $filename);
		
    }
	
	public function products_import(Request $request){
        /*if($request->hasFile('import_file')){
            $path = $request->file('import_file')->getRealPath();
            $data = Excel::import($path)->get();
            if($data->count()){
                foreach ($data as $key => $value) {
                    $arr[] = ['name' => $value->name, 'details' => $value->details];
                }
                if(!empty($arr)){
                    DB::table('product')->insert($arr);
                    dd('Insert Record successfully.');
                }
            }
        }
		
        dd('Request data does not have any files to import.');*/ 
		Excel::import(new ImportProduct, $request->file('import_file'));
		return redirect()->back()->with('success', 'Imported successfully.');   
    } 
	
	
	
}
