
<link rel="stylesheet" href="<?php echo plugins_url('/dev_plugin/assets/Design/CSS/style.min.css') ?>">

<h1>Theme Settings</h1>
<?php
class Dashboard_page extends Dashboard
{
    public function __construct(Type $var = null)
    {
        parent::__construct('Features', 'About Plugin', 'Author');
    }
    public function inner_html_sec1()
    {
        ?>
            <div class="wrap">
                <form action="options.php" method="POST">
                    <?php settings_fields('dev_options_group')?>
                    <?php do_settings_sections('dev_plugin')?>
                    <?php submit_button('Save Settings');?>
                </form>
            </div>
       <?php

    }

}
new Dashboard_page();
