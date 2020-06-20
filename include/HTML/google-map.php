<style>
    table tr th {
        display: none;
    }
    .short_codes{
        display: flex;
        width: 50%;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
</style>
<h1>Google Map settings</h1>

<div class="wrap">
    <form action="options.php" method="POST">
        <?php settings_fields('map_options_group')?>
        <?php do_settings_sections('google_map')?>
        <?php submit_button('Save Settings');?>
    </form>
</div>
<div title="Copy & Paste this shortcode to your page or post" class="short_codes">
    <h2>Sortcode: </h2>
    <div>
        [dev_google_map]
    </div>
</div>
<div class="mapouter">
    <div class="gmap_canvas">
    <?php
$location_value = get_option('map_location') ? get_option('map_location') : 'university%20of%20san%20francisco';
$location_string = "https://maps.google.com/maps?q=" . $location_value . "&t=&z=13&ie=UTF8&iwloc=&output=embed";
?>

        <iframe class="iframe"
        width="600"
        height="500"
        id="gmap_canvas"
        src="<?php echo $location_string ?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
        </iframe>
    </div>
    <style>
        .mapouter {
            position: relative;
            text-align: right;
            height: 500px;
            width: 900px;
            left: -10%
        }

        .gmap_canvas {
            overflow: hidden;
            background: none !important;
            height: 100%;
            width: 100%;
        }
    </style>
</div>
<?php

?>
<script src="<?php echo plugins_url('/dev_plugin/assets/JS/map.js') ?>"></script>