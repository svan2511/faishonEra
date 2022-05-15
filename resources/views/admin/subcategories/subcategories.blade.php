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
		  @if ( Session::has('subcat_add_msg') )

          <div class="alert alert-success alert-dismissible">
                 <h5><i class="icon fas fa-check"></i>{{ Session::get('subcat_add_msg') }}</h5>
                </div>
@endif
            <h1></h1>
			<a href="{{ route('subcategories.create')}}" class="btn btn-info btn-sm">Add New Sub Category</a>
          </div>
          <div class="col-sm-6">
            <h3>All Sub Categories</h3>
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
                    <th>ID</th>
                    <th>Sub Category Name</th>
                    <th>Sub Category Slug</th>
                    <th>Parent Category</th>
                    <th>Actions</th>
                    
                  </tr>
                  </thead>
                  <tbody>
				  @foreach($subcategories as $single)
                  <tr>
                    <td>{{ $single->subcat_id }}</td>
                    <td>{{ $single->subcat_name }}</td>
					<td>{{ $single->subcat_slug }}</td>
					<td>{{$single->category->cat_name}}</td>
						<td><a href="{{route('subcategories.edit' , $single->subcat_id )}}"><button type="button" class="btn btn-success"><i class="far fa-edit"></i> </button></a>
	
						<a onclick="if(confirm('Are You Sure to Delete This Category !')){ $('#del_cat_data_{{$single->subcat_id}}').submit(); }" href="javascript:void(0)"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i> </button></a>
            
          
            @if($single->subcat_status==1)
						<a href="{{url('admin/subcatStatus')}}/{{$single->subcat_id}}/0"><button type="button" class="btn btn-success"><i class="icon fas fa-check"></i> &nbsp;Active</button></a>
						@else
						<a href="{{url('admin/subcatStatus')}}/{{$single->subcat_id}}/1"><button type="button" class="btn btn-danger"><i class="icon fas fa-ban"></i> &nbsp;Expire</button></a>	
							@endif
						</td><form method="POST" id="del_cat_data_{{$single->subcat_id}}" action="{{route('subcategories.destroy' , $single->subcat_id )}}" >
				  @csrf
          @method('delete')
            </form>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>ID</th>
                    <th>Sub Category Name</th>
                    <th>Sub Category Slug</th>
                    <th>Parent Category</th>
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

  