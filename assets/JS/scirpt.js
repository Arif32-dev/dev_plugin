jQuery(document).ready(function($) {
    var cpt = $('.input_box')[0];
    var tax = $('.input_box')[1];
    var tax_overlay = $(tax).children('.overlay');
    tax_overlay.click(function() {

        if ($($(cpt).find('input')).prop('checked') == false) {
            $('#wpbody-content > div.notice.notice-success').children('p').text('Please activate CPT in order to active this functionality')
            $('#wpbody-content > div.notice.notice-success').slideDown().delay(2000).slideUp();
        }
    });

    $(".input_box > .overlay").on("click", function(e) {
        if ($(e.target).siblings("input").prop("checked") == false) {
            $(e.target)
                .siblings("input")
                .prop("checked", true);

        } else {
            $(e.target)
                .siblings("input")
                .prop("checked", false);
        }
    });

    $("table label").click(function() {
        $ul = $(this).siblings("ul");
        $checkbox = $(this).siblings(".checkbox-toggle");
        if ($checkbox.prop("checked") == false) {
            $checkbox.prop("checked", true);
        } else {
            $checkbox.prop("checked", false);
        }
    });

    $('#wpbody-content > div.notice.notice-success').hide();


    class Watermark {
        constructor() {
            this.watermark_btn = $('#watermark_upload_btn');
            this.image_id = $('#water_image_id');
            this.file_frame;
            this.events();
        }
        events() {
            this.watermark_btn.on('click', this.add_media_uploader.bind(this));
        }
        add_media_uploader() {
            this.file_frame = wp.media.frames.file_frame = wp.media({
                multiple: false,
                title: 'Select Water Mark',
                library: {
                    type: 'image'
                },

                button: {
                    text: 'Add Water Mark'
                },
            });
            this.file_frame.open();
            this.file_frame.on('select', this.get_media_val.bind(this))
        }
        get_media_val() {
            var attachment = this.file_frame.state().get('selection').first();
            let water_mark_id = attachment.attributes.id;
            this.image_id.val(water_mark_id);

        }
    }

    new Watermark();
});