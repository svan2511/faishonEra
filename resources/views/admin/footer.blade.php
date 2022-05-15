<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('admin_assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('admin_assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('admin_assets/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('admin_assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('admin_assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin_assets/dist/js/adminlte.min.js')}}"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('admin_assets/plugins/chart.js/Chart.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin_assets/dist/js/demo.js')}}"></script>
<!-- Page specific script -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('admin_assets/dist/js/pages/dashboard3.js')}}"></script>
<!-- Page specific script -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
    selector: '#full_desc',
   
  });
 
  tinymce.init({
    selector: '#shrt_desc',
    
  });
  tinymce.init({
    selector: '#tech_spec',
    
  });

  $('#is_discounted').bind('change',function()
  {
    if($(this).val()=='1')
    {
      $('.disc_price').removeAttr('disabled');
     
     
    }
    else
    {
      $('.disc_price').attr('disabled', 'disabled'); 
    }
  });
  
  </script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
 $(document).ready(function(){ 

  <?php $urlmy = request()->route()->getAction();
    if($urlmy['as'] == "products.edit")
    { ?>
    let sub_cat_id = <?php echo $product->product_sub_cat_id; ?>;
    update_subcat_onload( sub_cat_id );
    <?php }
    ?>

$('.custom-lable-image').bind('change' , show_image_name_on_lable); 

function show_image_name_on_lable()
{
  var p =  document.getElementById(event.target.id).files[0].name;
	  $('.custom-file-label').text(p);
}


$('#prod_test_box').bind('change' , update_product_aatr_image);

function update_product_aatr_image()
{

  var product_attr_image =  document.getElementById("image_"+event.target.getAttribute('data-actionid')).files[0].name;
	  $('#att_img_change_'+event.target.getAttribute('data-actionid')).text(product_attr_image);
}
  
  $('#pro_form').bind('change', update_subcat);

  function update_subcat() {
  if( event.target.id == "product_cat_id" )
  {
    var my_data = 
		{
		"cat_id": $('#product_cat_id').val(),
	    _token: '{{csrf_token()}}'
		}

            
    $.ajax({
            type: "POST",
            url: "{{url('change_subcat')}}",
            data: my_data,
            success: function(dataResponse)
            {
                //console.log(dataResponse);
               $('#subcat_id').html(dataResponse);

			}		  
	
       });
  }
   }


   function update_subcat_onload( sub_cat_id ) {

     
    
    var my_data = 
		{
		"cat_id": $('#product_cat_id').val(),
    "sub_cat_id": sub_cat_id,
	    _token: '{{csrf_token()}}'
		}

            
    $.ajax({
            type: "POST",
            url: "{{url('change_subcat')}}",
            data: my_data,
            success: function(dataResponse)
            {
               // console.log(dataResponse);
               $('#subcat_id').html(dataResponse);

			}		  
	
       });

   }

   

function add_more_att(){

let loop_iterate = $('#loop_iterate').val();

loop_count = parseInt(loop_iterate) + 1;

  var html = '<div class="row" id="add_row_id_'+loop_count+'" style="margin-top:50px;margin-bottom:50px;">';
html+= '<div class="col-md-4"><div class="form-group"><input type="hidden" name="hidden_attr_id[]"><label for="exampleInputEmail1">SKU Number</label><input type="text" required name="sku_number[]" class="form-control" id="sku_number" placeholder="Enter SKU"></div></div>';

html+= '<div class="col-md-4"><div class="form-group"><label for="exampleInputEmail1">MRP</label><input type="text" required name="reg_price[]" class="form-control" id="reg_price" placeholder="Enter Regular Price"></div></div>';

html+= '<div class="col-md-4"><div class="form-group"><label for="exampleInputEmail1">Disconted Price</label><input type="text" required name="disc_price[]" class="form-control disc_price" id="disc_price"  placeholder="Enter Discounted Price" disabled></div></div>';

html+= '<div class="col-md-4"><div class="form-group"><label for="exampleInputEmail1">QTY</label><input type="text" required  name="qty[]" class="form-control" id="qty" placeholder="Enter QTY"></div></div>';

var size_box_html = $('#size_id').html();
size_box_html = size_box_html.replace("selected", "");
var color_box_html = $('#color_id').html();
color_box_html = color_box_html.replace("selected", "");

html+= '<div class="col-md-4"><div class="form-group"><label>Select Size</label><select class="custom-select" name="size_id[]" class="form-control" id="size_id">'+size_box_html+' </select></div></div>';

html+= '<div class="col-md-4"><div class="form-group"><label>Select Color</label><select class="custom-select" name="color_id[]" class="form-control" id="color_id">'+color_box_html+'</select></div></div>';

html+= '<div class="col-md-4"><div class="form-group"> <div class="custom-file"><input type="file" required name="attr_image[]" class="prod_att_image" data-actionId ="'+loop_count+'" id="image_'+loop_count+'" ><label class="prod_att_image_label" id="att_img_change_'+loop_count+'" for="customFile">Select Image</label></div></div></div>';

html+= '<div class="col-md-4"><div class="form-group test" ><a href="javascript:void(0)" class="btn btn-block bg-gradient-danger" id="'+loop_count+'"><i class="fas fa-minus-circle"></i> &nbsp;Remove Attributes</a></div>';

html+= '</div></div> <hr class="solid">';

$('#prod_test_box').append(html);
 $('#loop_iterate').val(loop_count);

}
 
$('#add_more_attr').bind('click', add_more_att);

$('#prod_test_box').bind('click', remove_row);
function remove_row ()
{
  
  if(!isNaN(event.target.id))
  {
    $('#add_row_id_'+event.target.id).remove();
  }
  
	
}



  });

 

</script>




</body>
</html>
