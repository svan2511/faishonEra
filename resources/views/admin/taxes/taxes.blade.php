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
		  @if ( Session::has('tax_add_msg') )

          <div class="alert alert-success alert-dismissible">
                 <h5><i class="icon fas fa-check"></i>{{ Session::get('tax_add_msg') }}</h5>
                </div>
@endif
            <h1></h1>
			<a href="{{ route('taxes.create')}}" class="btn btn-info btn-sm">Add New Tax</a>
          </div>
          <div class="col-sm-6">
            <h3>All Taxes</h3>
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
                    <th>Tax Discription</th>
                    <th>Tax Value</th>
                   
                    <th>Actions</th>
                    
                  </tr>
                  </thead>
                  <tbody>
				  @foreach( $taxes as $single)
                  <tr>
                    <td>{{ $single->tax_desc }}</td>
                    <td>{{ $single->tax_val }}</td>
                    
						<td><a href="{{route('taxes.edit' , $single->tax_id  )}}"><button type="button" class="btn btn-success"><i class="far fa-edit"></i> &nbsp;Edit</button></a>
	
            <a onclick="if(confirm('Are You Sure to Delete This Tax !')){ $('#del_cat_data_{{$single->tax_id }}').submit(); }" href="javascript:void(0)"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i> </button></a>
            
      
						</td><form method="POST" id="del_cat_data_{{$single->tax_id }}" action="{{route('taxes.destroy' , $single->tax_id  )}}" >
				  @csrf
          @method('delete')
            </form>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Tax Discription</th>
                    <th>Tax Value</th>
                   
                    
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

  