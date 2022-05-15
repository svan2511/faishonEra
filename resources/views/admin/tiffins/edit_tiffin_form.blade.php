@extends('admin/master_layout')
@section('select_tiff','active')
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
				Add New Tiffin
			</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('tiffins.update' , $single_tiffin['tif_id'] ) }}"  enctype="multipart/form-data" >
				  	 @csrf
					@method('put')
                <div class="card-body">
			
				
                 <div class="row">
				 
				 
                      <div class="col-md-12">
				 <div class="form-group">
                    <label for="exampleInputEmail1">Tiffin Title</label>
                    <input type="text"  value="<?= $single_tiffin['tif_title']; ?>" name="tif_title" class="form-control" id="tif_title" placeholder="Enter Title">
					@error('tif_title')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                  </div>
				  </div>
				  
				   <div class="col-md-12">
					   <div class="form-group">
                        <label>Select Tiffin Category</label>
                        <select class="custom-select" name="tiff_cat" class="form-control" id="tiff_cat">
						<option value="">Select...</option>
          
						@foreach($categories as $single)
					
					<?php if($single->cat_id != $single_tiffin['tif_id'] )  { ?>
						<option value="{{$single->cat_id }}" <?php if($single->cat_id == $single_tiffin['tiff_cat']) { echo 'selected'; } ?> >{{$single->cat_name}}</option>
						<?php } ?>
						
						
						@endforeach
                         </select>
						 @error('tiff_cat')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                      </div>
				  </div>
				  
				 
				  
				 
          <div class="col-md-12">
				 <div class="form-group">
                    <label for="exampleInputEmail1">Tiffin Price</label>
                    <input type="text" value="<?= $single_tiffin['tif_price']; ?>" name="tif_price" class="form-control" id="tif_price" placeholder="Enter Price">
					@error('tif_price')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                  </div>
				  </div>
				 
				  @if( $single_tiffin['tiff_img']!="" )
				  
				  <div class="col-md-6">
					   <div class="form-group">
                        <div class="custom-file">
                      <input type="file" name="tiff_img" class="custom-file-input" id="tiff_img">
                      <label class="custom-file-label" for="customFile">Select Image</label>
					  @error('tiff_img')
					 <div class="alert alert-danger">{{ $message }}</div>
					 @enderror
					
                    </div>
                      </div>
				  </div>
				  <div class="col-md-6">
                         
							 <label for="exampleInputEmail1">Previous Image</label>
					<img src="{{ asset('storage/admin_assets/tiffin') }}/{{ $single_tiffin['tiff_img'] }}"  height="40" width="80" />
				
                           </div>
				  @else
				  
				  <div class="col-md-12">
					   <div class="form-group">
                        <div class="custom-file">
                      <input type="file" name="tiff_img" class="custom-file-input" id="tiff_img">
                      <label class="custom-file-label" for="customFile">Select Image</label>
					  @error('tiff_img')
					 <div class="alert alert-danger">{{ $message }}</div>
					 @enderror
					
                    </div>
                      </div>
				  </div>
				  
				  @endif
				  
				  
				   
				 
						
				
				
				 <div class="col-md-12">
                   <div class="form-group">
                    <label for="exampleInputEmail1">Tiffin Description</label>
                    <textarea class="form-control" rows="3" name="tif_discrp" class="form-control" id="tif_discrp" placeholder="Enter Tiffin Description" ><?= $single_tiffin['tif_discrp']; ?></textarea>
					@error('tif_discrp')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                  </div></div> </div>
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