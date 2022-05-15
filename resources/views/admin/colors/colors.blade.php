@extends('admin/master_layout')
  
  @section('select_color','active')
  @section('main_content')
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
		  @if ( Session::has('color_add_msg') )

          <div class="alert alert-success alert-dismissible">
                 <h5><i class="icon fas fa-check"></i>{{ Session::get('color_add_msg') }}</h5>
                </div>
@endif
            <h1></h1>
			<a href="{{ route('colors.create')}}" class="btn btn-info btn-sm">Add New Color</a>
          </div>
          <div class="col-sm-6">
            <h3>All Colors</h3>
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
                    <th>Color Name</th>
                   
                   
                    <th>Actions</th>
                    
                  </tr>
                  </thead>
                  <tbody>
				  @foreach( $colors as $single)
                  <tr>
                    <td>{{ $single->color_name }}</td>
                    
						<td><a href="{{route('colors.edit' , $single->color_id )}}"><button type="button" class="btn btn-success"><i class="far fa-edit"></i> &nbsp;Edit</button></a>
	
            <a onclick="if(confirm('Are You Sure to Delete This Color !')){ $('#del_cat_data_{{$single->color_id}}').submit(); }" href="javascript:void(0)"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i> </button></a>
            
          
            @if($single->color_status==1)
						<a href="{{url('admin/colorStatus')}}/{{$single->color_id}}/0"><button type="button" class="btn btn-success"><i class="icon fas fa-check"></i> &nbsp;Active</button></a>
						@else
						<a href="{{url('admin/colorStatus')}}/{{$single->color_id}}/1"><button type="button" class="btn btn-danger"><i class="icon fas fa-ban"></i> &nbsp;Expire</button></a>	
							@endif
						</td><form method="POST" id="del_cat_data_{{$single->color_id}}" action="{{route('colors.destroy' , $single->color_id )}}" >
				  @csrf
          @method('delete')
            </form>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                   <th>Color Name</th>
                    
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

  