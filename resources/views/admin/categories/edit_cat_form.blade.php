@extends('admin/master_layout')
@section('select_cat','active')
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
			Edit Category
			</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('categories.update' , $category['cat_id']) }}"  enctype="multipart/form-data" >
				  @csrf
          @method('put')
                <div class="card-body">
			
				
                 <div class="row">
                      <div class="col-md-12">
				 <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input type="text" value="<?= $category->cat_name; ?>" name="cat_name" class="form-control" id="catgry_name" placeholder="Enter Category Name">
					@error('cat_name')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                  </div>
				  </div>
				 
				 
				  
				  
				   <div class="col-md-6">
					   <div class="form-group">
                        <div class="custom-file">
                      <input type="file" name="cat_image" class="custom-file-input" id="cat_image">
                      <label class="custom-file-label" for="customFile">Select Image</label>
					  @error('cat_image')
					 <div class="alert alert-danger">{{ $message }}</div>
					 @enderror
					
                    </div>
                      </div>
				  </div>
				 
          <div class="col-md-6">
                         @if( $category->cat_image!="" )
							 <label for="exampleInputEmail1">Previous Image</label>
					<img src="{{ asset('storage/admin_assets/category') }}/{{ $category->cat_image }}"  height="40" width="80" />
				@endif
                           </div>


				  
				  <div class="col-md-4">
						   <div class="form-check">
                    <input type="checkbox" <?php if($category->is_home == 1) { echo 'checked'; }?>  name= "is_home" class="form-check-input" id="is_home">
                    <label class="form-check-label" for="exampleCheck1">Show on Home Page</label>
                  </div>
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