<?php
/*
Plugin Name: فیلد اختصاصی
Plugin URI: https://github.com/mhmmdq/custom-fields-to-checkout-woocomerce-gender
Description: افزونه افزودن فیلد تعیین جنسیت به صفحه تسوبه حساب
Author: Mhmmdq
Version: 0.1.0
Author URI: https://mhmmdq.ir
*/

if ( ! defined( 'ABSPATH' ) )
	exit;




add_filter( 'woocommerce_default_address_fields' , 'mhmmdq_woocommerce_default_address_fields' );

function mhmmdq_woocommerce_default_address_fields ( $address_fields )
{
    $address_fields['gender'] = array(
        'label'     => __('جنسیت', 'woocommerce'),
        'required'  => true,
        'class'     => array('form-row-wide'),
        'type'  => 'select',
        'options'   => array('اقا' => __('اقا', 'woocommerce'), 'خانم' => __('خانم', 'woocommerce'), 'نمیخواهم اعلام کنم' => __('نمیخواهم اعلام کنم', 'woocommerce'))
    );

    return $address_fields;
}

add_filter('woocommerce_admin_billing_fields', 'mhmmdq_add_extra_customer_field');
add_filter('woocommerce_admin_shipping_fields', 'mhmmdq_add_extra_customer_field');

function mhmmdq_add_extra_customer_field( $fields ){
    
    $fields = mhmmdq_woocommerce_default_address_fields( $fields );
  
    
    global $wdm_ext_fields;
    
    if(is_array($wdm_ext_fields)){
        
        foreach($wdm_ext_fields as $wef){
            $fields[$wef]['show'] = false; 
        }
    }

    return $fields;
}
?>