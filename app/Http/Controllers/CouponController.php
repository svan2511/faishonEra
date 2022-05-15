<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::all();
      return view('admin.coupons.coupons',['title' =>'Coupons Listing','coupons'=>$coupons]);
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add New Coupon";
        return view('admin.coupons.add_coupon_form',["title" => $title ] );
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
		 
            'title' => 'required',
            'code' => 'required|unique:coupons',
            'value' => 'required',
            'min_cart_value' => 'required',
            'type' => 'required',
            ];

        $customMessages = 
                [
                'required' => 'This Field can not be blank.',
                'unique' => 'This Coupon Code Already Exist.',

                ];

        $this->validate($request, $rules, $customMessages);
        $model = new Coupon();
        
		$msg = 'Coupon Added Successfully';
       
		$model->title = $request->post('title');
        $model->status = 1;
		$model->code = $request->post('code');
        $model->value = $request->post('value');
		$model->min_cart_value = $request->post('min_cart_value');
        $model->type = $request->post('type');
	
		$model->save();
		
	    $request->session()->flash('coupon_add_msg',$msg);
        
		return redirect('coupons');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        $title = "Edit Coupon"; 
        $coupons = Coupon::all();
        return view('admin.coupons.edit_coupon_form',["title" => $title ,"coupons" => $coupons, "coupon" => $coupon] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = Coupon::find($id);

        
        $rules = [
		 
            'title' => 'required',
            
            'value' => 'required',
            'min_cart_value' => 'required',
            'type' => 'required',
            ];

            if($request->code!= $model->code)
            {
                $rules+= ['code' => 'required|unique:coupons'];
            }
            else
            {
                $rules+= ['code' => 'required'];
            }

        $customMessages = 
                [
                'required' => 'This Field can not be blank.',
                'unique' => 'This Coupon Code Already Exist.',

                ];

             $this->validate($request, $rules, $customMessages);
        
        
             $model->title = $request->post('title');
             $model->code = $request->post('code');
             $model->value = $request->post('value');
             $model->min_cart_value = $request->post('min_cart_value');
             $model->type = $request->post('type');

             $msg = 'Coupon Updated Successfully';
           
		
                $model->save();
                
                $request->session()->flash('coupon_add_msg',$msg);
                return redirect('coupons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , Coupon $coupon)
    {
        $coupon->delete();
        $msg = "Coupon Deleted Successfully .";
        $request->session()->flash('coupon_add_msg',$msg);
                return redirect('coupons');
    }

    public function couponStatus( $id , $status , Request $request)
    {
        $model = Coupon::find($id);
        $model->where('id', $id)->update(['status'=> $status]);
        $msg = "Coupon Status Updated Successfully .";
        $request->session()->flash('coupon_add_msg',$msg);
                return redirect('coupons');
    }
}
