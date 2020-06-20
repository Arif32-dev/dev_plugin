jQuery(document).ready(function($) {
    class Media {
        constructor() {
            this.upload_btn = $('.media_uploader_btn');
            this.img_url_field;
            this.file_frame;
            this.save_btn;
            this.events();
        }

        events() {
            $(document).on('click', '.media_uploader_btn', this.open_media.bind(this))

        }
        open_media(e) {
            // e.preventDefault();
            this.file_frame = wp.media.frames.file_frame = wp.media({
                multiple: false,
                title: 'Select Media',
                library: {
                    type: 'image'
                },

                button: {
                    text: 'Select'
                },
            });
            this.file_frame.open();
            this.file_frame.on('select', this.get_media_val.bind(this))
            var parent_form = $(e.currentTarget).parent().parent().parent();
            this.save_btn = $(parent_form.find('input'))[9];
            this.img_url_field = $(e.currentTarget).parent().parent().find('.img_link')
        }
        get_media_val() {
            var attachment = this.file_frame.state().get('selection').first();
            console.log(attachment)
            let img_url = attachment.attributes.url;
            this.img_url_field.val(img_url)
            this.save_btn.removeAttribute("disabled")
        }
    }
    $obj = new Media();
})