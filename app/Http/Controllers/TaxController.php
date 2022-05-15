<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxes = Tax::all();
      return view('admin.taxes.taxes',['title' =>'Taxes Listing','taxes'=>$taxes]);
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add New Tax";
        return view('admin.taxes.add_tax_form',["title" => $title ] );
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
		 
            'tax_desc' => 'required',
            ];

        $customMessages = 
                [
                'required' => 'Tax Description can not be blank.',
                ];

        $this->validate($request, $rules, $customMessages);
        $model = new Tax();
        
        
		$msg = 'Tax Added Successfully';
        
		$model->tax_desc = $request->post('tax_desc');
        $model->tax_val = $request->post('tax_val');
		
		$model->save();
		
	    $request->session()->flash('tax_add_msg',$msg);
        
		return redirect('taxes');
        
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
    public function edit(Tax $tax)
    {
        $title = "Edit Tax"; 
        return view('admin.taxes.edit_tax_form',["title" => $title , "tax" => $tax] );
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
        $model = Tax::find($id);
        $rules = [ 'tax_desc' => 'required'];
         
        $customMessages = [
            'required' => 'Tax Description can not be blank.',
            
             ];

             $this->validate($request, $rules, $customMessages);
        
        $model->tax_desc = $request->tax_desc;
        $model->tax_val = $request->tax_val;
       
        $msg = 'Tax Updated Successfully';
           
		
                $model->save();
                
                $request->session()->flash('Tax_add_msg',$msg);
                return redirect('taxes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , Tax $tax)
    {
        $tax->delete();
        $msg = "Tax Deleted Successfully .";
        $request->session()->flash('tax_add_msg',$msg);
                return redirect('taxes');
    }

    
}
