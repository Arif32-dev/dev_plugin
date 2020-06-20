<?php
class Shortcode
{
    private $value;
    public function __construct()
    {
        $this->value = get_option('map_location') ?
        "https://maps.google.com/maps?q=" . get_option('map_location') . "&t=&z=13&ie=UTF8&iwloc=&output=embed" :
        "https://maps.google.com/maps?q=university%20of%20san%20francisco&t=&z=13&ie=UTF8&iwloc=&output=embed";

        add_shortcode('dev_google_map', array($this, 'google_map'));
    }
    public function google_map($value)
    {
        ?>

            <style>
        .mapouter {
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


            <?php

        $value = "<div class='mapouter'>
                    <div class='gmap_canvas'>
                        <iframe class='iframe'
                        width='600'
                        height='500'
                        id='gmap_canvas'
                        src='" . $this->value . "' frameborder='0' scrolling='no' marginheight='0' marginwidth='0'>
                        </iframe>
                    </div>
                </div>";
        return $value;
    }
}
if (get_option('activate_google_map')) {

    new Shortcode();
} else {
    return;
}