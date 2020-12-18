<?php

class ProductFlow_Admin extends ProductFlow_Base_Class {
	public function __construct(){
		//Hooks
		add_action( 'woocommerce_admin_order_data_after_order_details', array($this, 'add_productflow_fields_after_order_details'), 10, 1 );

		add_filter( 'woocommerce_admin_shipping_fields' , array($this, 'productflow_additional_admin_shipping_fields' ));
	}

	function add_productflow_fields_after_order_details($order){

		if(get_post_meta( $order->get_id(), parent::PREFIX . '_external_identifier', true ) != null){
			echo '<h4 style="float:left">ProductFlow</h4>';
			echo '<p class="form-field form-field-wide"><strong>Marketplace name:</strong><br>' . get_post_meta( $order->get_id(), parent::PREFIX . '_marketplace_name', true ) . '</p>';
			echo '<p class="form-field form-field-wide"><strong>External identifier:</strong><br>' . get_post_meta( $order->get_id(), parent::PREFIX . '_external_identifier', true ) . '</p>';

			$trackTrace = get_post_meta($order->get_id(), '_shipping_productflow_track_and_trace', true);
			if(!empty($trackTrace)) {
				$trackTraceValue = $trackTrace;
			}else{
				$trackTraceValue = 'No Track & Trace set<br>Enter Track & Trace information at "Shipping Details" and "update"';
			}
			echo '<p class="form-field form-field-wide"><strong>Track & trace:</strong><br>' . $trackTraceValue . '</p>';

		}
	}

	function productflow_additional_admin_shipping_fields( $fields ) {
		$fields['productflow_shipping_method'] = array(
			'type' => 'select',
			'label' => __( 'ProductFlow - Shipping Method', 'woocommerce' ),
			'placeholder' => 'Shipping method',
			'options' => array(
				"" => "--Shipping Method--",
				"PostNL" => "PostNL",
				"DHL" => "DHL",
				"DPD" => "DPD",
				"GLS" => "GLS",
				"UPS" => "UPS",
				"Briefpost" => "Briefpost",
				"Other" => "Other"
			)
		);

		$fields['productflow_track_and_trace'] = array(
			'type' => 'text',
			'label' => __( 'ProductFlow - Track & Trace', 'woocommerce' ),
			'placeholder' => 'Track & trace'
		);

		return $fields;
	}
}