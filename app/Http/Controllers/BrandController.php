<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $brands = Brand::all();
      return view('admin.brands.brands',['title' =>'Brands Listing','brands'=>$brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add New Brand";
        return view('admin.brands.add_brand_form',["title" => $title ] );
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
		 
            'brand_name' => 'required',
            ];

        $customMessages = 
                [
                'required' => 'Brand  Name can not be blank.',
                

                ];

        $this->validate($request, $rules, $customMessages);
        $model = new Brand();
        
		$msg = 'Brand Added Successfully';
		$model->brand_name = $request->post('brand_name');
	
		$model->save();
		
	    $request->session()->flash('brand_add_msg',$msg);
        
		return redirect('brands');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        $title = "Edit Brand"; 
        $brands = Brand::all();
        return view('admin.brands.edit_brand_form',["title" => $title ,"brands" => $brands, "brand" => $brand] );
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
       $model = Brand::find($id);
        $rules = [ 'brand_name' => 'required'];
         
        $customMessages = [
            'required' => 'Brand Name can not be blank.',
            
             ];

             $this->validate($request, $rules, $customMessages);
        
        
        $model->brand_name = $request->brand_name;
        
        $msg = 'Brand Updated Successfully';
           
		
                $model->save();
                
                $request->session()->flash('brand_add_msg',$msg);
                return redirect('brands');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , Brand $brands)
    {
        $brands->delete();
        $msg = "Brand Deleted Successfully .";
        $request->session()->flash('brand_add_msg',$msg);
                return redirect('brands');
    }

}
