<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::all();
      return view('admin.colors.colors',['title' =>'Colors Listing','colors'=>$colors]);
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add New Color";
        return view('admin.colors.add_color_form',["title" => $title ] );
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
		 
            'color_name' => 'required',
            ];

        $customMessages = 
                [
                'required' => 'Color Name can not be blank.',
                ];

        $this->validate($request, $rules, $customMessages);
        $model = new Color();
        
        
		$msg = 'Color Added Successfully';
        $model->color_status = 1;
		$model->color_name = $request->post('color_name');
		
		$model->save();
		
	    $request->session()->flash('color_add_msg',$msg);
        
		return redirect('colors');
        
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
    public function edit(Color $color)
    {
        $title = "Edit Color"; 
        return view('admin.colors.edit_color_form',["title" => $title , "color" => $color] );
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
        $model = Color::find($id);
        $rules = [ 'color_name' => 'required'];
         
        $customMessages = [
            'required' => 'Color Name can not be blank.',
            
             ];

             $this->validate($request, $rules, $customMessages);
        
        $model->color_name = $request->color_name;
       
        $msg = 'Color  Updated Successfully';
           
		
                $model->save();
                
                $request->session()->flash('color_add_msg',$msg);
                return redirect('colors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , Color $color)
    {
        $color->delete();
        $msg = "Color Deleted Successfully .";
        $request->session()->flash('color_add_msg',$msg);
                return redirect('colors');
    }

    public function colorStatus( $id , $status , Request $request)
    {
        $model = Color::find($id);
        $model->where('color_id', $id)->update(['color_status'=> $status]);
        $msg = "Color Status Updated Successfully .";
        $request->session()->flash('color_add_msg',$msg);
                return redirect('colors');
    }
}
