<?php
if (get_option('watermark')) {

    new Watermark();
} else {
    return;
}

class Watermark
{
    /**
     * images from media upload
     * @param array|string
     */
    private $image_files;

    /**
     * watermark image
     * @param string
     */
    private $water_image;

    /**
     * watermark image
     * @param string
     */
    private $upload_path;

    public function __construct()
    {
        $this->upload_path = wp_upload_dir();
        if (wp_get_attachment_image_src(get_option('water_image_id'))) {

            $this->water_image = imagecreatefrompng(wp_get_attachment_image_src(get_option('water_image_id'))[0]);
        } else {
            return;
        }

        add_filter('wp_generate_attachment_metadata', array($this, 'apply_watermark'), 10, 2);
    }

    public function apply_watermark($metadata, $attachment_id)
    {

        /*attach watermark to post image that should be displyed in post */
        $this->add_watermark_main_img($metadata);

        /* Create water mark for other image file */
        $this->add_watermark_to_other_img($metadata);

        wp_update_attachment_metadata(
            $attachment_id,
            $metadata
        );
        imagedestroy($this->water_image);

        return $metadata;
    }

    /**
     * this method is going to apply watermark to main image
     * @return void
     */

    public function add_watermark_main_img($metadata)
    {
        $this->image_files = $this->upload_path['basedir'] . '/' . $metadata['file'];

        $created_image = imagecreatefromjpeg($this->image_files);
        imagecopy(
            $created_image,
            $this->water_image,
            (imagesx($created_image) * (50 / 100)) - (imagesx($this->water_image) * (50 / 100)),
            (imagesy($created_image)) - (imagesy($this->water_image)),
            0,
            0,
            100,
            100,
        );
        imagejpeg($created_image, $this->image_files);
        imagedestroy($created_image);

    }

    /**
     * this method is going to apply watermark to media library all other different sizes
     * @return void
     */

    public function add_watermark_to_other_img($metadata)
    {
        $this->image_files = $metadata['sizes'];

        foreach ($this->image_files as $size) {
            $created_image = imagecreatefromjpeg($this->upload_path['path'] . '/' . $size['file']);
            imagecopy(
                $created_image,
                $this->water_image,
                (imagesx($created_image) * (50 / 100)) - (imagesx($this->water_image) * (50 / 100)),
                (imagesy($created_image)) - (imagesy($this->water_image)),
                0,
                0,
                100,
                100,
            );
            imagejpeg($created_image, $this->upload_path['path'] . '/' . $size['file']);
        }
        imagedestroy($created_image);
    }

}
