@extends('admin/master_layout')
@section('select_tax','active')
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
				Add New Tax
				</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('taxes.store') }}"  >
				  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tax Discription </label>
                    <input type="text" name="tax_desc" class="form-control" id="tax_desc" placeholder="Enter Tax Description">
					@error('tax_desc')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
                  </div>


                  <div class="form-group">
                    <label for="exampleInputEmail1">Tax Value </label>
                    <input type="text" name="tax_val" class="form-control" id="tax_val" placeholder="Enter Tax Value">
					@error('tax_val')
					 <div class="alert alert-danger">{{ $message }}</div>
					@enderror
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