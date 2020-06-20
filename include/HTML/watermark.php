<?php settings_errors();?>
<style>
    body{

        background-color: #DCDCDC;
    }
    .dev_img_container{
        position: relative !important;
        width: 400px;
        height: 300px;
    }
    .dev_img_container > img:nth-child(1){
        position: absolute;
        right: 0;
        bottom: 0;
        z-index: 3;
    }
</style>
<h1>Water Mark Settings</h1>
<button id="watermark_upload_btn">Upload Water Mark</button>
<div class="wrap">
    <form action="options.php" method="POST">
        <?php settings_fields('slider_options_group')?>
        <?php do_settings_sections('watermark')?>
        <?php submit_button('Save Settings');?>
    </form>
</div>

