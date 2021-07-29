<?php

namespace Fickrr\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Fickrr\Http\Controllers\Controller;
use Session;
use Fickrr\Models\Attribute;
use Fickrr\Models\Items;
use Fickrr\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class AttributeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
		
    }
	
	
	/* category */
	
	public function attribute()
    {
        
		
		$attributeData['attribute'] = Attribute::getattributeData();
		return view('admin.attributes',[ 'attributeData' => $attributeData]);
    }
    
	
	public function add_attribute()
	{
	   $viewData['item_type'] = Items::gettypeItem();
	   return view('admin.add-attribute',[ 'viewData' => $viewData]);
	}
	
	
	
	
	
	
	public function save_attribute(Request $request)
	{
 
    
         $attr_category = $request->input('attr_category');
		 $attr_label = $request->input('attr_label');
		 if(!empty($request->input('attr_field_order')))
		 {
		 $attr_field_order = $request->input('attr_field_order');
		 }
		 else
		 {
		   $attr_field_order = 0;
		 }
		 $attr_field_type = $request->input('attr_field_type');
		 $attr_field_value = $request->input('attr_field_value');
		 $attr_field_status = $request->input('attr_field_status');
		 
         
		 $request->validate([
							'attr_label' => 'required',
							'attr_category' => 'required',
							
         ]);
		 $rules = array(
				
				
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 return back()->withErrors($validator);
		} 
		else
		{
		
		
		 
		$data = array('attr_category' => $attr_category, 'attr_label' => $attr_label, 'attr_field_type' => $attr_field_type, 'attr_field_value' => $attr_field_value, 'attr_field_order' => $attr_field_order, 'attr_field_status' => $attr_field_status);
        Attribute::insertattributeData($data);
        return redirect('/admin/attributes')->with('success', 'Insert successfully.');
            
 
       } 
     
    
  }
  
  
  
  public function delete_attribute($attr_id){

      $data = array('attr_drop_status'=>'yes');
	  
        
      Attribute::deleteAttributedata($attr_id,$data);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');

    
  }
  
  
  public function edit_attribute($attr_id)
	{
	   
	   $edit['attribute'] = Attribute::editattributeData($attr_id);
	   
	   $viewData['item_type'] = Items::gettypeItem();
	   return view('admin.edit-attribute', [ 'edit' => $edit, 'attr_id' => $attr_id, 'viewData' => $viewData]);
	}
	
	
	
	public function update_attribute(Request $request)
	{
	
	     $attr_category = $request->input('attr_category');
		 $attr_label = $request->input('attr_label');
		 if(!empty($request->input('attr_field_order')))
		 {
		 $attr_field_order = $request->input('attr_field_order');
		 }
		 else
		 {
		   $attr_field_order = 0;
		 }
		 $attr_field_type = $request->input('attr_field_type');
		 $attr_field_value = $request->input('attr_field_value');
		 $attr_field_status = $request->input('attr_field_status');
		  
         $attr_id = $request->input('attr_id');
		 $request->validate([
							'attr_label' => 'required',
							'attr_category' => 'required',
							
         ]);
		 $rules = array(
				
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 return back()->withErrors($validator);
		} 
		else
		{
		
		
		$data = array('attr_category' => $attr_category, 'attr_label' => $attr_label, 'attr_field_type' => $attr_field_type, 'attr_field_value' => $attr_field_value, 'attr_field_order' => $attr_field_order, 'attr_field_status' => $attr_field_status);
        Attribute::updateattributeData($attr_id, $data);
        return redirect('/admin/attributes')->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	}
	
	
	/* category */
	
	
	
	
	
}
