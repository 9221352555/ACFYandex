<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

abstract class acfyandex_common extends acf_field
{
    public $YandexKey;
    public function __construct( $settings )
    {
        $this->name = 'yandex';
        $this->label = __('Yandex map','acfyandex');
        $this->category = 'jQuery';
        $this->settings = $settings;
        $values = get_option('acfyandex_data');
        $this->YandexKey = sanitize_text_field(array_key_exists('acfyandex_data_apikey', $values)?$values['acfyandex_data_apikey']:'');
        $this->ZoomDefault = (int)sanitize_text_field(array_key_exists('acfyandex_data_zoom', $values)?$values['acfyandex_data_zoom']:'');

        parent::__construct();
    }


    public function update_value( $value, $post_id, $field ){return $value;}

    public function load_value( $value, $post_id, $field )
    {
        if( empty( $value ) ) {$value = 0;}
        return $value;
    }
    
    

}