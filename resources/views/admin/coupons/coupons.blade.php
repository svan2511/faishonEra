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
		  @if ( Session::has('coupon_add_msg') )

          <div class="alert alert-success alert-dismissible">
                 <h5><i class="icon fas fa-check"></i>{{ Session::get('coupon_add_msg') }}</h5>
                </div>
@endif
            <h1></h1>
			<a href="{{ route('coupons.create')}}" class="btn btn-info btn-sm">Add New Coupon</a>
          </div>
          <div class="col-sm-6">
            <h3>All Coupons</h3>
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
                    <th>Coupon Title</th>
                    <th>Coupon Code</th>
                    <th>Coupon Value</th>
                    <th>Coupon Type</th>
                    <th>Actions</th>
                    
                  </tr>
                  </thead>
                  <tbody>
				  @foreach($coupons as $single)
                  <tr>
                    <td>{{ $single->title }}</td>
                    <td>{{ $single->code }}</td>
					<td>{{ $single->value	 }}</td>
          <td>{{ $single->type	 }}</td>
					<td><a href="{{route('coupons.edit' , $single->id )}}"><button type="button" class="btn btn-success"><i class="far fa-edit"></i> &nbsp;Edit</button></a>
	
            <a onclick="if(confirm('Are You Sure to Delete This Coupon !')){ $('#del_cat_data_{{$single->id}}').submit(); }" href="javascript:void(0)"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i> </button></a>
            
          
            @if($single->status==1)
						<a href="{{url('admin/couponStatus')}}/{{$single->id}}/0"><button type="button" class="btn btn-success"><i class="icon fas fa-check"></i> &nbsp;Active</button></a>
						@else
						<a href="{{url('admin/couponStatus')}}/{{$single->id}}/1"><button type="button" class="btn btn-danger"><i class="icon fas fa-ban"></i> &nbsp;Expire</button></a>	
							@endif
						</td><form method="POST" id="del_cat_data_{{$single->id}}" action="{{route('coupons.destroy' , $single->id )}}" >
				  @csrf
          @method('delete')
            </form>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                   <th>Coupon Title</th>
                    <th>Coupon Code</th>
                    <th>Coupon Value</th>
                    <th>Coupon Type</th>
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

  