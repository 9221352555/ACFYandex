<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class acfyandex_version extends acfyandex_common
{
    public function render_field( $field )
    {
        $val = trim(esc_html($field['value']));
        if(strlen($val)>0){
            $val = explode(",", $val);
            foreach($val as $key=>$value){$val[$key] = filter_var($value,FILTER_VALIDATE_FLOAT);}
        }
        $field['value'] = (array_key_exists(0, $val)?$val[0]:"0").",".(array_key_exists(1, $val)?$val[1]:"0"); 
        ?>
        <input type="text" id="<?php echo $field['id'] ?>" class="acf_yandex"
                name="<?php echo esc_attr($field['name']) ?>"
                value="<?php echo esc_attr($field['value']) ?>"
        />
        <?=__('Find out the coordinates of points at','acfyandex')?>: <a href="http://dimik.github.io/ymaps/examples/location-tool/" target="_blank">http://dimik.github.io/ymaps/examples/location-tool/</a>&nbsp;&nbsp;&nbsp;<?=__('Record example: "55.753923,37.620690"','acfyandex')?>&nbsp;&nbsp;&nbsp;
        <p class="description">
            <?=__('Shortcode to publish','acfyandex')?>: <B>[yandexmap  _field=<?=$field['_name']?>]</B>. <?=__('For the shortcode to work, be sure to specify one of the two parameters "_field" or "point". You can find out more about shortcode parameters.','acfyandex')?> <a href="#" onclick="element=document.getElementById('acf_yandex_v5_shortcode_info'); if(element.style.display == 'none'){element.style.display = 'block';}else{element.style.display = 'none';}return false;"><?=__('here','acfyandex')?></a>.<BR><div id='acf_yandex_v5_shortcode_info' style='display:none; background-color:rgba(200,200,200,0.5); border: 1px solid #0085ba; padding:10px;'>
            <?=__('_field - name of the ACF field from which point <BR> values ​​will be substituted<BR>point - coordinates of the point (example of an entry: "55.76, 37.64")<BR>style_width, style_height - width and height of the map block <BR>class - connect css style to the map block<BR>zoom - map zoom, value from 1 to 19 (the default value can be configured in the <a href="./options-general.php?page=menu_acfyandex_plugin"> menu Settings => ACF-Yandex => Zoom by default </a>)<BR>title - signature for the point<BR>memo - description when pressing<BR>By default, a point is formed with the specified coordinates, the title of the post (page) is used as a signature, if the post or page contains a thumbnail and an excerpt, then this data will be inserted into the description when clicked. The data specified in the shortcode parameters are priority.','acfyandex')?>
        </div>
        </p>
         <div id="extendbox"></div><?php
    }
}