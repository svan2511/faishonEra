<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $categories = Category::all();
      return view('admin.categories.categories',['title' =>'Categories Listing','categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add New Category";
        return view('admin.categories.add_cat_form',["title" => $title ] );
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
		 
            'cat_name' => 'required',
            'cat_image' => 'mimes:jpg,jpeg,png',
            ];

        $customMessages = 
                [
                'required' => 'Category Name can not be blank.',
                'mimes' => 'Image should be only in JPG , JPEG and PNG formate.',

                ];

        $this->validate($request, $rules, $customMessages);
        $model = new Category();
        if($request->post('is_home') == 'on')
		{
			$model->is_home = 1;
		}
		else
		{
			$model->is_home = 0;
		}

        if($request->hasFile('cat_image'))
		{
			
			$image = $request->file('cat_image');
			$ext = $image->extension();
			$cat_image_name = time().".".$ext;
			
			$image->storeAs('/public/admin_assets/category' ,$cat_image_name );
			
			$model->cat_image = $cat_image_name;
		}
		$msg = 'Category Added Successfully';
        $model->cat_status = 1;
		$model->cat_name = $request->post('cat_name');
		$model->cat_slug = createSlug($model->cat_name);
		
	
		$model->save();
		
	    $request->session()->flash('cat_add_msg',$msg);
        
		return redirect('categories');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $title = "Edit category"; 
        $categories = Category::all();
        return view('admin.categories.edit_cat_form',["title" => $title ,"categories" => $categories, "category" => $category] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $model = Category::find($id);
        $rules = [ 'cat_name' => 'required'];
         if($request->cat_image!="")
        {
            $rules+= ['cat_image' => 'mimes:jpg,jpeg,png'];
        }
        $customMessages = [
            'required' => 'Category Name can not be blank.',
            'unique'  => 'Category Slug has been taken already.',
            'mimes' => 'Image should be only in JPG , JPEG and PNG formate.',
             ];

             $this->validate($request, $rules, $customMessages);
        if($request->hasFile('cat_image'))
                {
                    
                    $image = $request->file('cat_image');
                    $ext = $image->extension();
                    $cat_image_name = time().".".$ext;
                    
                    $image->storeAs('/public/admin_assets/category' ,$cat_image_name );
                    
                    $model->cat_image = $cat_image_name;
                }

        
        $model->cat_name = $request->cat_name;
        $model->cat_slug = createSlug($request->cat_name);
        
        if($request->is_home == 'on')
		{
			$model->is_home = 1;
		}
		else
		{
			$model->is_home = 0;
		}

        $msg = 'Category Updated Successfully';
           
		
                $model->save();
                
                $request->session()->flash('cat_add_msg',$msg);
                return redirect('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , Category $category)
    {
        $category->delete();
        $msg = "Category Deleted Successfully .";
        $request->session()->flash('cat_add_msg',$msg);
                return redirect('categories');
    }

    public function catStatus( $id , $status , Request $request)
    {
        $model = Category::find($id);
        $model->where('cat_id', $id)->update(['cat_status'=> $status]);
        $msg = "Category Status Updated Successfully .";
        $request->session()->flash('cat_add_msg',$msg);
                return redirect('categories');
    }
}
