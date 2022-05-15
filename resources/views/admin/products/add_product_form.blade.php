@extends('admin/master_layout')
@section('select_product','active')
@section('main_content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
          <div class="col-sm-6">
           
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">@if ( Session::has('pro_att_del_msg') )

          <div class="alert alert-success">
                 <h6>{{ Session::get('pro_att_del_msg') }}</h6>
                </div>
				@endif
				@if ( Session::has('sku_error') )

          <div class="alert alert-danger">
                 <h6>{{ Session::get('sku_error') }}</h6>
                </div>
				@endif
              <div class="card-header">
               <h3 class="card-title">
			
				Add New Product
				</h3>
			
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('products.store')}}" enctype="multipart/form-data" id="pro_form" >
				  @csrf
                <div class="card-body">
                 
                    <div class="row">
                      <div class="col-md-6">
					    <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input type="text"  name="product_title" class="form-control" id="product_title" placeholder="Enter Product Title">
					@error('product_title')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                  </div>
				  </div>
				  <div class="col-md-6">
				

						<div class="form-group">
                        <label>Select Brand</label>
                        <select class="custom-select" name="product_brand" class="form-control" id="product_brand">
						<option value="">Select...</option>
						@foreach($brands as $single)
					
						<option value="{{$single->brand_id}}" >{{$single->brand_name}}</option>
						
						
						@endforeach
                         </select>
						 @error('product_brand')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                      </div>

				</div>
                  
				 </div>
				  
				 
				 
	
				  <div class="row">
                      <div class="col-md-6">
					   <div class="form-group">
                        <label>Select Category</label>
                        <select class="custom-select" name="product_cat_id" class="form-control" id="product_cat_id">
						<option value="">Select...</option>
						@foreach( $categories as $single )
					
						<option value="{{$single->cat_id}}" >{{$single->cat_name}}</option>
						
						
						@endforeach
                         </select>
						 @error('product_cat_id')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                      </div>
				  </div>
				  <div class="col-md-6">
					  <div class="form-group">
                        <label>Select Sub Category</label>
                        <select class="custom-select" name="product_sub_cat_id" class="form-control" id="subcat_id" >
						<option value="">Select...</option>
					
                         </select>
						 @error('product_sub_cat_id')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                      </div>
				  </div>
				
					
				 </div>
				 
				 
				  
				  
				 
				  <div class="form-group">
                        <label>Product Description</label>
                        <textarea class="form-control" rows="3" name="full_desc" class="form-control" id="full_desc" placeholder="Enter Product Description" ></textarea>
                     @error('full_desc')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                      </div>
					  
					   <div class="form-group">
                        <label>Short Description</label>
                        <textarea class="form-control" rows="3" name="shrt_desc" class="form-control" id="shrt_desc" placeholder="Enter Short Description" ></textarea>
						 @error('shrt_desc')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                      </div>
					  
				       <div class="form-group">
                        <label>Technical Specification</label>
                        <textarea class="form-control" rows="3" name="tech_spec" class="form-control" id="tech_spec" placeholder="Enter Technical Specification" ></textarea>
                      </div>
				  
				  
				 
				    <div class="row">
					
                      
                
				  
				   <div class="col-md-4">
					   <div class="form-group">
                        <label>Is Featured</label>
                        <select class="custom-select" name="is_featured" class="form-control" id="is_featured">
						<option value="0">No</option>
						<option value="1">Yes</option>
                         </select>
						 @error('is_featured')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                      </div>
				  </div>
				  <div class="col-md-4">
					  <div class="form-group">
                        <label>Add Tax</label>
                        <select class="custom-select" name="tax_id" class="form-control" id="tax_id" >
						<option value="">Select...</option>
						@foreach($taxes as $single)
					
						<option value="{{$single->id}}" > {{$single->tax_desc}}</option>
						
						@endforeach
                         </select>
						 @error('tax_id')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                      </div>
				  </div>
				  
				   <div class="col-md-4">
					   <div class="form-group">
                        <label>Is Discounted</label>
                        <select class="custom-select" name="is_discounted" class="form-control" id="is_discounted">
						<option value="0">No</option>
						<option value="1">Yes</option>
                         </select>
						 @error('is_discounted')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                      </div>
				  </div>
					
				 </div>

				 
				 <div class="form-group">
		
		<div class="row">
		<div class="col-md-12">
				 <div class="custom-file custom-lable-image">
		<input type="file" name="product_image" class="custom-file-input" id="product_image">
		<label class="custom-file-label" for="customFile">Select Image</label>
		@error('product_image')
	   <div class="alert alert-danger">{{ $message }}</div>
	   @enderror
	  
	  </div>
			 </div>


	 
		  
   </div>

	  
   
	</div>
				 
				 
                </div>
                <!-- /.card-body -->

                <!-- /Product Attributes Start Here -->
                <div class="card card-primary" >
              <div class="card-header">
               <h3 class="card-title">Product Attributes</h3>
			  
              </div><div class="card-body" id="prod_test_box">
			 
		   
				  
				   <div class="row" id="add_row_id_1">
                     
               
					 <div class="col-md-4">
					     <div class="form-group">  
						 
                    <label for="exampleInputEmail1">SKU Number</label>
                    <input type="text" required  name="sku_number[]"  class="form-control" id="sku_number" placeholder="Enter SKU">
					
                  </div>
				  </div>
				  
                

				<div class="col-md-4">
					     <div class="form-group">
                    <label for="exampleInputEmail1">Regular Price</label>
                    <input type="text" required name="reg_price[]"  class="form-control" id="reg_price" placeholder="Enter MRP">
					
                  </div>
				  </div>
				 
				 
				 <div class="col-md-4">
					     <div class="form-group">
                    <label for="exampleInputEmail1">Discounted Price</label>
                    <input type="text" name="disc_price[]" class="form-control disc_price" id="disc_price" placeholder="Enter Disconted Price" disabled>
					</div>
				  </div>
				 
				 
				
				 
				 
                     
                <div class="col-md-4">
					     <div class="form-group">
                    <label for="exampleInputEmail1">QTY</label>
                    <input type="text"  required name="qty[]"  class="form-control" id="qty" placeholder="Enter QTY">
					
                  </div>
				  </div>
					 <div class="col-md-4">
				    <div class="form-group">
                        <label>Select Size</label>
                        <select class="custom-select" name="size_id[]" class="form-control" id="size_id">
				<option value="">Select.....</option>
						@foreach($sizes as $single)
					
						<option value="{{$single->size_id}}" >{{$single->size_title}}</option>
					
						
						@endforeach
						</select>
						
                      </div>
					  </div>
					  <div class="col-md-4">
				    <div class="form-group">
                        <label>Select Color</label>
                        <select class="custom-select" name="color_id[]" class="form-control" id="color_id">
						<option value="">Select.....</option>
						@foreach($colors as $single)
					
						<option value="{{$single->color_id}}" >{{$single->color_name}}</option>
						
						
						@endforeach
						</select>
						
                      </div>
					  </div>
					    
					 
					  <div class="col-md-4">
				    <div class="form-group">
                      <div class="custom-file">
					  

                    <input type="file" required name="attr_image[]" class="prod_att_image" data-actionId ="1" id="image_1">
                      <label class="prod_att_image_label" id="att_img_change_1" for="customFile">Select Image</label>
					  
                    </div>
						@error('image.*')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                      </div>
					  </div>
					
					
					<div class="col-md-4">
						 <div class="form-group">
             <input type="hidden" value="1" id="loop_iterate">
						<a href="javascript:void(0)" id="add_more_attr" class="btn btn-block bg-gradient-success" ><i class="fas fa-plus-circle"></i>&nbsp; Add More Attributes</a>
                      </div>
                      </div>
					  
			  </div>   
			   <hr class="solid">
				  
				   
					  </div> </div>

            <!-- /Product Attributes End Here -->
				
                <div class="card-footer">
				
			
				  <button type="submit" class="btn btn-info btn-block btn-lg" >Insert Records</button>       
	 </div>
			
            </div>
			
			
            <!-- /.card -->
			</form>
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <style>
hr.solid {
  border-top: 1px solid #bbb;
}
.prod_att_image {
    position: relative;
    z-index: 2;
    width: 100%;
    height: calc(2.25rem + 2px);
    margin: 0;
    overflow: hidden;
    opacity: 0;
cursor: pointer;
}

.prod_att_image_label {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    z-index: 1;
    height: calc(2.25rem + 2px);
    padding: .375rem .75rem;
    overflow: hidden;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    box-shadow: none;
	cursor: pointer;
	}
</style> 

@endsection

