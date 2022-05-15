<option value="">Select...</option>
    @foreach($subcategories->subCategory as $single)
	<option value="{{$single->subcat_id}}" <?php if( $sub_cat_id == $single->subcat_id) { echo "selected" ;} ?> > {{$single->subcat_name}}</option>
	@endforeach