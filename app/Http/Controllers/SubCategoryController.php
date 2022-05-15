<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $subcategories = SubCategory::all();
      return view('admin.subcategories.subcategories',['title' =>'Sub Categories Listing','subcategories'=>$subcategories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add New Sub Category";
        $categories = Category::all();
        return view('admin.subcategories.add_subcat_form',["title" => $title , "categories" => $categories] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
		 
            'subcat_name' => 'required',
            'subcat_image' => 'mimes:jpg,jpeg,png',
            ];

        $customMessages = 
                [
                'required' => 'Sub Category Name can not be blank.',
                'mimes' => 'Image should be only in JPG , JPEG and PNG formate.',

                ];

        $this->validate($request, $rules, $customMessages);
        $model = new SubCategory();
        
        if($request->hasFile('subcat_image'))
		{
			
			$image = $request->file('subcat_image');
			$ext = $image->extension();
			$cat_image_name = time().".".$ext;
			
			$image->storeAs('/public/admin_assets/subcategory' ,$cat_image_name );
			
			$model->subcat_image = $cat_image_name;
		}
		$msg = 'Sub Category Added Successfully';
        $model->subcat_status = 1;
		$model->subcat_name = $request->post('subcat_name');
        $model->parent_cat_id = $request->post('parent_cat_id');
		$model->subcat_slug = createSlug($model->subcat_name);
		
	
		$model->save();
		
	    $request->session()->flash('subcat_add_msg',$msg);
        
		return redirect('subcategories');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subcategory)
    {
        $title = "Edit Sub category"; 
        $categories = Category::all();
        return view('admin.subcategories.edit_subcat_form',["title" => $title ,"categories" => $categories, "subcategory" => $subcategory] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = SubCategory::find($id);
        $rules = [ 'subcat_name' => 'required'];
         if($request->subcat_image!="")
        {
            $rules+= ['subcat_image' => 'mimes:jpg,jpeg,png'];
        }
        $customMessages = [
            'required' => 'Sub Category Name can not be blank.',
            'mimes' => 'Image should be only in JPG , JPEG and PNG formate.',
             ];

             $this->validate($request, $rules, $customMessages);
        if($request->hasFile('subcat_image'))
                {
                    
                    $image = $request->file('subcat_image');
                    $ext = $image->extension();
                    $cat_image_name = time().".".$ext;
                    
                    $image->storeAs('/public/admin_assets/subcategory' ,$cat_image_name );
                    
                    $model->subcat_image = $cat_image_name;
                }

        
        $model->subcat_name = $request->subcat_name;
        $model->subcat_slug = createSlug($request->subcat_name);
        $model->parent_cat_id = $request->parent_cat_id;

        $msg = 'Sub Category Updated Successfully';
           
		
                $model->save();
                
                $request->session()->flash('subcat_add_msg',$msg);
                return redirect('subcategories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , SubCategory $subcategory)
    {
        $subcategory->delete();
        $msg = "Sub Category Deleted Successfully .";
        $request->session()->flash('subcat_add_msg',$msg);
                return redirect('subcategories');
    }

    public function catStatus( $id , $status , Request $request)
    {
        $model = SubCategory::find($id);
        $model->where('subcat_id', $id)->update(['subcat_status'=> $status]);
        $msg = "Sub Category Status Updated Successfully .";
        $request->session()->flash('subcat_add_msg',$msg);
                return redirect('subcategories');
    }
}
