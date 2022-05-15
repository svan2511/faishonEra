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
				Add New Sub Category
			</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('subcategories.store') }}"  enctype="multipart/form-data" >
				  @csrf
                <div class="card-body">
			
				
                 <div class="row">
                      <div class="col-md-12">
				 <div class="form-group">
                    <label for="exampleInputEmail1">Sub Category Name</label>
                    <input type="text" name="subcat_name" class="form-control" id="subcat_name" placeholder="Enter Sub Category Name">
					@error('subcat_name')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                  </div>
				  </div>
				  
			
				  <div class="col-md-12">
					   <div class="form-group">
                        <label>Select Parent Category</label>
                        <select class="custom-select" name="parent_cat_id" class="form-control" id="parent_cat_id">
						<option value="">Select...</option>
						@foreach($categories as $single)
					
						<option value="{{$single->cat_id}}"  >{{$single->cat_name}}</option>
						
						
						@endforeach
                         </select>
						 @error('parent_cat_id')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                      </div>
				  </div>
				  
				  
				   <div class="col-md-12">
					   <div class="form-group">
                        <div class="custom-file custom-lable-image">
                      <input type="file" name="subcat_image" class="custom-file-input" id="subcat_image">
                      <label class="custom-file-label" for="customFile">Select Image</label>
					  @error('subcat_image')
					 <div class="alert alert-danger">{{ $message }}</div>
					 @enderror
					
                    </div>
                      </div>
				  </div>
				 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
				
			
				  <button type="submit" class="btn btn-primary">Insert</button>       
							
                  
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
