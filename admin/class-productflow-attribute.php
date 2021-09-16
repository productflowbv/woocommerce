<?php

add_action( 'woocommerce_after_edit_attribute_fields', 'action_woocommerce_after_edit_attribute_fields', 10, 0 );
add_action( 'woocommerce_attribute_added', 'add_productflow_attribute_my_field' );
add_action( 'woocommerce_attribute_updated', 'add_productflow_attribute_my_field' );

add_filter( 'woocommerce_rest_prepare_product_attribute', 'productflow_add_custom_data_to_attribute', 10, 3 );

function action_woocommerce_after_edit_attribute_fields() {
	$id      = isset( $_GET['edit'] ) ? absint( $_GET['edit'] ) : 0;
	$value   = $id ? get_option( "wc_attribute_freely_fillable_field-$id" ) : '';
	$checked = $value ? 'checked' : '';

	?>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="freely_fillable">Freely fillable</label>
        </th>
        <td>
            <input type="checkbox" id="freely_fillable" name="freely_fillable" <?php echo $checked ?>>
        </td>
    </tr>
	<?php
}

function add_productflow_attribute_my_field( $id ) {
	if ( is_admin() && isset( $_POST['freely_fillable'] ) ) {
		$option = "wc_attribute_freely_fillable_field-$id";
		update_option( $option, sanitize_text_field( $_POST['freely_fillable'] ) );
	} else {
		delete_option( "wc_attribute_freely_fillable_field-$id" );
	}
}

function productflow_add_custom_data_to_attribute( $response, $attribute, $request ) {
	$id    = $attribute->attribute_id ?? null;
	$value = $id ? get_option( "wc_attribute_freely_fillable_field-$id" ) : '';

	$response->data['freely_fillable'] = $value ? true : false;

	return $response;
}