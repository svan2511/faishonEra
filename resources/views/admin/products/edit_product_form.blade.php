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
			
				Edit Product
				</h3>
			
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('products.update', $product->product_id)}}" enctype="multipart/form-data" id="pro_form" >
				  @csrf
                  @method('put')
                <div class="card-body">
                 
                    <div class="row">
                      <div class="col-md-6">
					    <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input type="text" value="<?= $product->product_title; ?>"  name="product_title" class="form-control" id="product_title" placeholder="Enter Product Title">
					@error('product_title')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                  </div>
				  </div>
				  <div class="col-md-6">
				

						<div class="form-group">
                        <label>Select Brand</label>
                        <select class="custom-select"  name="product_brand" class="form-control" id="product_brand">
						<option value="">Select...</option>
						@foreach($brands as $single)
					
						<option value="{{$single->brand_id}}" <?php if( $single->brand_id == $product->product_brand ) { echo "selected"; } ?> >{{$single->brand_name}}</option>
						
						
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
					
						<option value="{{$single->cat_id}}" <?php if( $single->cat_id == $product->product_cat_id ) { echo "selected"; } ?> >{{$single->cat_name}}</option>
						
						
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
						<option value="" >Select...</option>
					
                         </select>
						 @error('product_sub_cat_id')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                      </div>
				  </div>
				
					
				 </div>
				 
				 
				  
				  
				 
				  <div class="form-group">
                        <label>Product Description</label>
                        <textarea class="form-control" rows="3" name="full_desc" class="form-control" id="full_desc" placeholder="Enter Product Description" ><?=$product->full_desc; ?></textarea>
                     @error('full_desc')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                      </div>
					  
					   <div class="form-group">
                        <label>Short Description</label>
                        <textarea class="form-control" rows="3" name="shrt_desc" class="form-control" id="shrt_desc" placeholder="Enter Short Description" ><?= $product->shrt_desc; ?></textarea>
						 @error('shrt_desc')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                      </div>
					  
				       <div class="form-group">
                        <label>Technical Specification</label>
                        <textarea class="form-control" rows="3" name="tech_spec" class="form-control" id="tech_spec" placeholder="Enter Technical Specification" ><?= $product->tech_spec; ?></textarea>
                      </div>
				  
				  
				 
				    <div class="row">
					
                      
                
				  
				   <div class="col-md-4">
					   <div class="form-group">
                        <label>Is Featured</label>
                        <select class="custom-select" name="is_featured" class="form-control" id="is_featured">
						<option value="0" <?php if( $product->is_featured == "0" ) { echo "selected"; } ?> >No</option>
						<option value="1" <?php if( $product->is_featured == "1" ) { echo "selected"; } ?> >Yes</option>
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
					
						<option value="{{$single->tax_id}}" <?php if( $product->tax_id == $single->tax_id ) { echo "selected"; } ?>> {{$single->tax_desc}}</option>
						
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
						<option value="0" <?php if( $product->is_discounted == "0" ) { echo "selected"; } ?> >No</option>
						<option value="1" <?php if( $product->is_discounted == "1" ) { echo "selected"; } ?> >Yes</option>
                         </select>
						 @error('is_discounted')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                      </div>
				  </div>
					
				 </div>

				 
				 <div class="form-group">
		
		<div class="row">
		<div class="col-md-6">
				 <div class="custom-file">
		<input type="file" name="product_image" class="custom-file-input" id="product_image">
		<label class="custom-file-label" for="customFile">Select Image</label>
		@error('product_image')
	   <div class="alert alert-danger">{{ $message }}</div>
	   @enderror
	  
	  </div>
			 </div>

            <div class="col-md-6">
                         @if( $product->product_image!="" )
							 <label for="exampleInputEmail1">Previous Image</label>
					<img src="{{ asset('storage/admin_assets/products') }}/{{ $product->product_image }}"  height="40" width="80" />
				@endif
                           </div>

	 
		  
   </div>

	  
   
	</div>
				 
				 
                </div>
                <!-- /.card-body -->


                 <!-- /Product Attributes Start Here -->
                 <div class="card card-primary" >
              <div class="card-header">
               <h3 class="card-title">Product Attributes</h3>
			  
              </div>
              <div class="card-body" id="prod_test_box">
              <?php $i=1;?>

              @foreach( $product->productAttributes as $attribute )
              
             
			 
		   
				  
				   <div class="row" id="add_row_id_{{$i}}">
                     
               
					 <div class="col-md-4">
					     <div class="form-group">  
						 <input type="hidden" name="hidden_attr_id[]" value="{{$attribute->attr_id}}">
                    <label for="exampleInputEmail1">SKU Number</label>
                    <input type="text" required value="{{$attribute->sku_number}}" name="sku_number[]"  class="form-control" id="sku_number" placeholder="Enter SKU">
					
                  </div>
				  </div>
				  
                

				<div class="col-md-4">
					     <div class="form-group">
                    <label for="exampleInputEmail1">Regular Price</label>
                    <input type="text" required value="{{$attribute->reg_price}}" name="reg_price[]"  class="form-control" id="reg_price" placeholder="Enter MRP">
					
                  </div>
				  </div>
				 
				 
				 <div class="col-md-4">
					     <div class="form-group">
                    <label for="exampleInputEmail1">Discounted Price</label>
                    <input type="text" value="{{$attribute->disc_price}}"  name="disc_price[]" class="form-control disc_price" id="disc_price" placeholder="Enter Discounted Price" <?php if($attribute->disc_price ==0){ echo "disabled"; }?>>
					</div>
				  </div>
				 
				 
				
				 
				 
                     
                <div class="col-md-4">
					     <div class="form-group">
                    <label for="exampleInputEmail1">QTY</label>
                    <input type="text"  required value="{{$attribute->qty}}" name="qty[]"  class="form-control" id="qty" placeholder="Enter QTY">
					
                  </div>
				  </div>
					 <div class="col-md-4">
				    <div class="form-group">
                        <label>Select Size</label>
                        <select class="custom-select" name="size_id[]" class="form-control" id="size_id">
				<option value="">Select.....</option>
						@foreach($sizes as $single)
					
						<option value="{{$single->size_id}}" <?php if( $single->size_id == $attribute->size_id ) { echo "selected"; } ?> >{{$single->size_title}}</option>
					
						
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
					
						<option value="{{$single->color_id}}" <?php if( $single->color_id == $attribute->color_id ) { echo "selected"; } ?>>{{$single->color_name}}</option>
						
						
						@endforeach
						</select>
						
                      </div>
					  </div>
					    
					 
					  <div class="col-md-4">
				    <div class="form-group">
                      <div class="custom-file">
					  

                    <input type="file" name="attr_image[]" class="prod_att_image" id="image_1" onchange="att_image(1)">
                      <label class="prod_att_image_label" id="att_img_change_1" for="customFile">Select Image</label>
					  
                    </div>
						@error('image.*')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                      </div>
					  </div>

            <div class="col-md-4">
                         @if( $attribute->attr_image!="" )
							 <label for="exampleInputEmail1">Previous Image</label>
					<img src="{{ asset('storage/admin_assets/products/attr') }}/{{ $attribute->attr_image }}"  height="40" width="80" />
				@endif
                           </div>
					
					
					<div class="col-md-4">
						 <div class="form-group">
            @if($i==1)
						<a href="javascript:void(0)" id="add_more_attr" class="btn btn-block bg-gradient-success" ><i class="fas fa-plus-circle"></i>&nbsp; Add More Attributes</a>

            @else
            <a href="{{url('attributes')}}/{{$attribute->attr_id}}/{{$product->product_id}}" class="btn btn-block bg-gradient-danger" ><i class="fas fa-minus-circle"></i> &nbsp;Remove Attributes</a>
            @endif
                      </div>
                      </div>
					  
			  </div>   
			   <hr class="solid">
				  
				   
					  
            <?php $i++ ;?>
           
          @endforeach <input type="hidden" value="{{$i}}" id="loop_iterate">
          </div>
          </div>

            <!-- /Product Attributes End Here -->



				
                <div class="card-footer">
				
			
				  <button type="submit" class="btn btn-info btn-block btn-lg" >Update Product</button>       
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

