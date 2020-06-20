var script = document.querySelector('#scirpt');
const create_url = script.getAttribute('data-create-tax');
const update_url = script.getAttribute('data-update-tax')
const delete_url = script.getAttribute('data-delete-tax')

jQuery(document).ready(function($) {

        // sending data for creating Taxonomies
        $('form').on('submit', function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.when($.ajax({
                        url: create_url,
                        data: formData,
                        type: 'POST'
                    }

                )).then((res) => {
                        if (res == "success") {
                            $('#wpbody-content > div.notice.notice-success').children('p').text('Successfully Created')
                            $('#wpbody-content > div.notice.notice-success').slideDown().delay(2000).slideUp();

                            setTimeout(() => {
                                location.reload()
                            }, 3000);
                        }
                    }

                    , (err) => {
                        console.log(err);
                    }

                )
            }

        )
        // sending data for updating Taxonomies

        $('.update_btn').on('click', function() {
                var id = $(this).attr('id');
                var data_obj = {
                    id: $(this).attr('id'),
                    tax_name: '',
                    hierarchical: '',
                    public: ''

                };

                var parent_row = $(this).parent().parent();
                var all_input = $(parent_row).find('input');

                data_obj.tax_name = all_input[0].value;
                data_obj.hierarchical = $(all_input[1]).prop('checked') == true ? 1 : 0;
                data_obj.public = $(all_input[2]).prop('checked') == true ? 1 : 0;
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
        // sending data for updating Taxonomies

        $('.delete_btn').on('click', function() {
                var id = $(this).attr('id');
                var parant_tr = $(this).parents('tr');
                $.ajax({

                        url: delete_url,
                        data: {
                            id: id
                        },
                        type: 'POST',
                        success: function(res) {
                            if (res = 'success') {
                                $('#wpbody-content > div.notice.notice-success').children('p').text('Successfully Deleted');
                                $('#wpbody-content > div.notice.notice-success').slideDown().delay(2000).slideUp();
                                parant_tr.fadeOut(500).slideUp(2000);
                            } else {
                                $('#wpbody-content > div.notice.notice-success').children('p').text('Something Went Wrong');
                                $('#wpbody-content > div.notice.notice-success').slideDown().delay(2000).slideUp();
                            }
                        }
                    }

                )
            }

        )
    }

)