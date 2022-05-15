<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = Size::all();
      return view('admin.sizes.sizes',['title' =>'Sizes Listing','sizes'=>$sizes]);
   
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add New Size";
        return view('admin.sizes.add_size_form',["title" => $title ] );
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
		 
            'size_title' => 'required',
            ];

        $customMessages = 
                [
                'required' => 'Size Title can not be blank.',
                ];

        $this->validate($request, $rules, $customMessages);
        $model = new Size();
        
        
		$msg = 'Size Added Successfully';
        $model->size_status = 1;
		$model->size_title = $request->post('size_title');
		
		$model->save();
		
	    $request->session()->flash('size_add_msg',$msg);
        
		return redirect('sizes');
        
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
    public function edit(Size $size)
    {
        $title = "Edit Size"; 
        return view('admin.sizes.edit_size_form',["title" => $title , "size" => $size] );
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
        $model = Size::find($id);
        $rules = [ 'size_title' => 'required'];
         
        $customMessages = [
            'required' => 'Size Title can not be blank.',
            
             ];

             $this->validate($request, $rules, $customMessages);
        
        $model->size_title = $request->size_title;
       
        $msg = 'Size Updated Successfully';
           
		
                $model->save();
                
                $request->session()->flash('size_add_msg',$msg);
                return redirect('sizes');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , Size $size)
    {
        $size->delete();
        $msg = "Size Deleted Successfully .";
        $request->session()->flash('size_add_msg',$msg);
                return redirect('sizes');
    }

    public function sizeStatus( $id , $status , Request $request)
    {
        $model = Size::find($id);
        $model->where('size_id', $id)->update(['size_status'=> $status]);
        $msg = "Size Status Updated Successfully .";
        $request->session()->flash('size_add_msg',$msg);
                return redirect('sizes');
    }
}
