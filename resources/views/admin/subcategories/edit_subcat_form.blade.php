@extends('admin/master_layout')
@section('select_subcat','active')
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
	<?php // "<pre>"; print_r($category);die;?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
               <h3 class="card-title">
			Edit Sub Category
			</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('subcategories.update' , $subcategory['subcat_id']) }}"  enctype="multipart/form-data" >
				  @csrf
          @method('put')
                <div class="card-body">
			
				
                 <div class="row">
                      <div class="col-md-6">
				 <div class="form-group">
                    <label for="exampleInputEmail1">Sub Category Name</label>
                    <input type="text" value="<?= $subcategory->subcat_name; ?>" name="subcat_name" class="form-control" id="subcatgry_name" placeholder="Enter Sub Category Name">
					@error('subcat_name')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                  </div>
				  </div>
				 
				  
				  <div class="col-md-6">
					   <div class="form-group">
                        <label>Select Parent Category</label>
                        <select class="custom-select" name="parent_cat_id" class="form-control" id="parent_cat_id">
						<option value="">Select...</option>
						@foreach($categories as $single)
					
						<option value="{{$single->cat_id}}" <?php if($single->cat_id == $subcategory->parent_cat_id) { echo 'selected'; } ?> >{{$single->cat_name}}</option>
					
						
						@endforeach
                         </select>
						 @error('parent_cat_id')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                      </div>
				  </div>
				  
				  
				   <div class="col-md-6">
					   <div class="form-group">
                        <div class="custom-file">
                      <input type="file" name="subcat_image" class="custom-file-input" id="subcat_image">
                      <label class="custom-file-label" for="customFile">Select Image</label>
					  @error('subcat_image')
					 <div class="alert alert-danger">{{ $message }}</div>
					 @enderror
					
                    </div>
                      </div>
				  </div>
				 
          <div class="col-md-6">
                         @if( $subcategory->subcat_image!="" )
							 <label for="exampleInputEmail1">Previous Image</label>
					<img src="{{ asset('storage/admin_assets/subcategory') }}/{{ $subcategory->subcat_image }}"  height="40" width="80" />
				@endif
                           </div>


                </div>
                <!-- /.card-body -->
                <div class="card-footer">
				
			
				  <button type="submit" class="btn btn-primary">Update</button>       
							
                  
                </div>
				</form>
			 
			  
			  
			 
			  
			  
			  
			  
            </div>
            <!-- /.card -->
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
  

@endsection