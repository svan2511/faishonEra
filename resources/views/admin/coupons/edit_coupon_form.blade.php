@extends('admin/master_layout')
@section('select_coupon','active')
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
				Edit Coupon
			</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('coupons.update' , $coupon['id']) }}"  >
				  @csrf
          @method('put')
                <div class="card-body">
				
				<div class="row">
                      <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Coupon Title</label>
                    <input type="text" value="<?= $coupon->title; ?>"  name="title" class="form-control" id="title" placeholder="Enter Coupon Title">
					@error('title')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                  </div>
				  </div>
				   <div class="col-md-6">
                   <div class="form-group">
                    <label for="exampleInputEmail1">Coupon Code</label>
                    <input type="text" value="<?= $coupon->code; ?>" name="code" class="form-control" id="code" placeholder="Enter Coupon Code">
					@error('code')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                  </div> </div>
				  <div class="col-md-6">
				  <div class="form-group">
                    <label for="exampleInputEmail1">Coupon Value</label>
                    <input type="text" value="<?= $coupon->value; ?>" name="value" class="form-control" id="value" placeholder="Enter Coupon Value">
					@error('value')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                  </div> </div>
				  <div class="col-md-6">
				  <div class="form-group">
                    <label for="exampleInputEmail1">Minimum Cart Value</label>
                    <input type="text" value="<?= $coupon->min_cart_value; ?>"  name="min_cart_value" class="form-control" id="min_cart_value" placeholder="Enter Minimum Cart Value">
					@error('min_cart_value')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                  </div> </div>
				  
				  
				  <div class="col-md-6">
				  <div class="form-group">
                        <label>Coupon Type</label>
                        <select class="custom-select" name="type" class="form-control" id="type" >
						<option value="fixed" <?php if( $coupon->min_cart_value == "fixed" ) { echo "selected"; } ?> >Fixed</option>
						<option value="perc" <?php if( $coupon->min_cart_value == "perc" ) { echo "selected"; } ?>>Percentage</option>
                         </select>
						 @error('type')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                      </div> </div>
				  
				  
				  
				  
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