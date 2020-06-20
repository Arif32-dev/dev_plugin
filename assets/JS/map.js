jQuery(document).ready(function($) {

    class Map {
        constructor() {
            this.timeout;
            this.input = $("#wpbody-content > div.wrap > form > table > tbody > tr > td > div > input[type=text]")
            this.map_val = $('.iframe');
            this.events();
        }
        events() {
            this.input.on('keyup', this.get_value.bind(this));
        }
        get_value(e) {
            var val = $(e.currentTarget).val().replace(/ /g, '+');
            clearTimeout(this.timeout);
            this.timeout = setTimeout(() => {
                this.set_value(val)
            }, 1000);
        }
        set_value(val) {
            var location = `https://maps.google.com/maps?q=${val}&t=&z=13&ie=UTF8&iwloc=&output=embed`;
            this.map_val.attr('src', location);
        }
    }
    new Map;
})