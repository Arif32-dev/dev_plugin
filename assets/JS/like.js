jQuery(document).ready(function($) {
    class Like {
        constructor() {
            this.obj;
            this.likebtn = $('#container_main > div> .bottom_like');
            this.dislikebtn = $('#container_main > div> .bottom_dislike');
            this.events();
        }
        events() {
            this.likebtn.on('click', this.like_functionality.bind(this));
            this.dislikebtn.on('click', this.dislike_functionality.bind(this));
        }

        like_dislike_obj(e) {

            this.obj = {
                action: $(e.currentTarget).attr('data-action'),
                user_status: $(e.currentTarget).attr('data-user_status'),
                user_id: $(e.currentTarget).attr('data-user_id'),
                post_id: $(e.currentTarget).attr('data-post_id'),
                time_stamp: $(e.currentTarget).attr('data-current_time'),

            }

        }

        // Functionnality for creating and deleting like
        like_functionality(e) {
            this.like_dislike_obj(e);
            this.create_delete(e);
        }

        // Functionnality for creating and deleting dislike
        dislike_functionality(e) {
            this.like_dislike_obj(e)
            this.create_delete(e)
        }

        create_delete(event) {
            if (this.obj.user_status.trim() == "logged_in") {

                $.ajax({
                    url: page_url.url,
                    data: this.obj,
                    type: 'POST',
                    success: function(res) {
                        const respond = JSON.parse(res)
                        console.log(respond)
                        var like_value;
                        var dislike_value;
                        switch (respond.respond) {

                            case 'like_created':
                                like_value = parseInt($(event.currentTarget).children('span').html());
                                $(event.currentTarget).children('span').html(like_value += 1);
                                $(event.currentTarget).addClass('liked')
                                $(event.currentTarget).siblings('.social_container').addClass('active');
                                setTimeout(() => {
                                    $(event.currentTarget).siblings('.social_container').removeClass('active');
                                }, 3000);
                                break;

                            case 'like_deleted':
                                like_value = parseInt($(event.currentTarget).children('span').html());
                                $(event.currentTarget).children('span').html(like_value -= 1);
                                $(event.currentTarget).removeClass('liked');
                                $(event.currentTarget).siblings('.social_container').removeClass('active');
                                break;

                            case 'dislike_created':
                                dislike_value = parseInt($(event.currentTarget).children('span').html());
                                $(event.currentTarget).children('span').html(dislike_value += 1);
                                $(event.currentTarget).addClass('disliked');

                                break;

                            case 'dislike_deleted':
                                dislike_value = parseInt($(event.currentTarget).children('span').html());
                                $(event.currentTarget).children('span').html(dislike_value -= 1);
                                $(event.currentTarget).removeClass('disliked')
                                break;

                            case 'dislike_updated':
                                dislike_value = parseInt($(event.currentTarget).parent().siblings('.dislike_container').children('span').children('span').html());
                                $(event.currentTarget).parent().siblings('.dislike_container').children('span').children('span').html(dislike_value -= 1);
                                $(event.currentTarget).parent().siblings('.dislike_container').children('span').removeClass('disliked');
                                like_value = parseInt($(event.currentTarget).children('span').html());
                                $(event.currentTarget).children('span').html(like_value += 1);
                                $(event.currentTarget).addClass('liked');
                                $(event.currentTarget).siblings('.social_container').addClass('active');
                                setTimeout(() => {
                                    $(event.currentTarget).siblings('.social_container').removeClass('active');
                                }, 3000);
                                break;

                            case 'like_updated':
                                like_value = parseInt($(event.currentTarget).parent().siblings('.like_container').children('span').children('span').html());
                                $(event.currentTarget).parent().siblings('.like_container').children('span').children('span').html(like_value -= 1);
                                $(event.currentTarget).parent().siblings('.like_container').children('span').removeClass('liked');
                                dislike_value = parseInt($(event.currentTarget).children('span').html());
                                $(event.currentTarget).children('span').html(dislike_value += 1);
                                $(event.currentTarget).addClass('disliked');
                                $(event.currentTarget).parent().siblings('.like_container').children('.social_container').removeClass('active');
                                break;

                            default:
                                false;
                        }

                    }
                })
            } else {
                let login_msg = $($(event.currentTarget).parents('#container_main')).siblings('.login_alert');
                login_msg.slideDown(500).delay(2000).slideUp(500);
            }
        }

    }
    new Like();
    (function(d) {
        var f = d.getElementsByTagName('SCRIPT')[0],
            p = d.createElement('SCRIPT');
        p.type = 'text/javascript';
        p.async = true;
        p.src = '//assets.pinterest.com/js/pinit.js';
        f.parentNode.insertBefore(p, f);
    }(document));
})