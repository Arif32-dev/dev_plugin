var script = document.querySelector('#scirpt')
const create_url = script.getAttribute('data-cpt-create')
const update_url = script.getAttribute('data-cpt-update')
const delete_url = script.getAttribute('data-cpt-delete')
jQuery(document).ready(function($) {
        // sending data for creating cpt
        $('form').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.when(
                    $.ajax({
                            url: create_url,
                            data: formData,
                            type: 'POST'
                        }

                    )).then((res) => {
                        console.log(res);

                        if (res == "success") {
                            $('#wpbody-content > div.notice.notice-success').children('p').text('Successfully Created');
                            $('#wpbody-content > div.notice.notice-success').slideDown().delay(2000).slideUp();

                            setTimeout(() => {
                                location.reload()
                            }, 3000);
                        }
                    }

                    , (err) => {
                        console.log(err);
                        console.log('res from err');
                    }

                )
            }

        ) // sending data for deleting or updating cpt

        $('.update_btn').on('click', function() {
                var data_obj = {
                    id: $(this).attr('id'),
                    cpt_name: '',
                    cpt_s_name: '',
                    cpt_dashicon: '',
                    cpt_title: '',
                    cpt_editor: '',
                    cpt_excerpt: '',
                    cpt_thumbnail: ''
                }

                ;
                var id = $(this).attr('id')
                var parent_row = $(this).parent().parent()
                var all_input = $(parent_row).find('input:not(.checkbox-toggle)');

                data_obj.cpt_name = all_input[0].value
                data_obj.cpt_s_name = all_input[1].value
                data_obj.cpt_dashicon = all_input[2].value
                data_obj.cpt_title = $(all_input[3]).prop('checked') == true ? 1 : 0
                data_obj.cpt_editor = $(all_input[4]).prop('checked') == true ? 1 : 0
                data_obj.cpt_excerpt = $(all_input[5]).prop('checked') == true ? 1 : 0
                data_obj.cpt_thumbnail = $(all_input[6]).prop('checked') == true ? 1 : 0
                $.ajax({

                        url: update_url,
                        data: data_obj,
                        type: 'POST',
                        success: function(res) {
                            if (res == 1) {
                                $('#wpbody-content > div.notice.notice-success').children('p').text('Successfully Updated');
                                $('#wpbody-content > div.notice.notice-success').slideDown().delay(2000).slideUp();
                            } else {
                                $('#wpbody-content > div.notice.notice-success').children('p').text('Nothing changed to update');
                                $('#wpbody-content > div.notice.notice-success').slideDown().delay(2000).slideUp();
                            }

                        }
                    }

                )
            }

        )
        $('.delete_btn').on('click', function() {
                var id = $(this).attr('id')
                var parant_tr = $(this).parents('tr')
                $.ajax({

                        url: delete_url,
                        data: {
                            id: id
                        },
                        type: 'POST',
                        success: function(res) {
                            if (res = 'success') {
                                $('#wpbody-content > div.notice.notice-success').children('p').text('Successfully Deleted')
                                $('#wpbody-content > div.notice.notice-success').slideDown().delay(2000).slideUp();
                                parant_tr.fadeOut(500).slideUp(2000);
                            } else {
                                $('#wpbody-content > div.notice.notice-success').children('p').text('Something Went Wrong')
                                $('#wpbody-content > div.notice.notice-success').slideDown().delay(2000).slideUp();
                            }
                        }
                    }

                )
            }

        )
    }

)