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
		  @if ( Session::has('pro_add_msg') )

          <div class="alert alert-success alert-dismissible">
                 <h5><i class="icon fas fa-check"></i>{{ Session::get('pro_add_msg') }}</h5>
                </div>
@endif
            <h1></h1>
			<a href="{{ route('products.create')}}" class="btn btn-info btn-sm">Add New Product</a>
          </div>
          <div class="col-sm-6">
            <h3>All Products</h3>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           

            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>

                    <th>Product Image</th>
				          	<th>Product Name</th>
                    <th>Category</th>
					           <th>Brand</th>
                    <th>Sub Category</th>
                    <th>Actions</th>
                    
                  </tr>
                  </thead>
                  <tbody>
				   @foreach($products as $single)
                  <tr>
				  <td><img src="{{ asset('storage/admin_assets/products') }}/{{ $single->product_image }}"  height="40" width="80" /></td>
                    <td>{{ substr($single->product_title,0,15) }}...</td>
                    <td>{{ $single->category->cat_name }}</td>
					<td>{{ $single->brand->brand_name	 }}</td>
					<td>{{ $single->subCategory->subcat_name }}</td>
						<td><a href="{{route('products.edit' , $single->product_id )}}"><button type="button" class="btn btn-success"><i class="far fa-edit"></i> &nbsp;Edit</button></a>
	
						<a onclick="return confirm('Are You Sure to Delete This Product !')" href="{{url('admin/products/delete_product')}}/{{$single->id}}"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i> &nbsp;Delete</button></a>
            @if($single->pro_status==1)
						<a href="{{url('admin/prodStatus')}}/{{$single->product_id}}/0"><button type="button" class="btn btn-success"><i class="icon fas fa-check"></i> &nbsp;Active</button></a>
						@else
						<a href="{{url('admin/prodStatus')}}/{{$single->product_id}}/1"><button type="button" class="btn btn-danger"><i class="icon fas fa-ban"></i> &nbsp;Expire</button></a>	
							@endif
						</td><form method="POST" id="del_cat_data_{{$single->product_id}}" action="{{route('products.destroy' , $single->product_id )}}" >
				  @csrf
          @method('delete')
            </form>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                   <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
					  <th>Brand</th>
                    <th>Model</th>
                    <th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- End content-wrapper -->
  <script>
  </script>
@endsection

  