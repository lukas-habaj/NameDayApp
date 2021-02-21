require('./bootstrap');

function urlifyString(str)
{
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
}

$(function(){

    // ###### ajax solution start ######
    // default ajax solution - less code but worse UX
    // $('#search').autoComplete({
    //     autoSelect: false
    // });
    // ###### ajax solution end ######


    // ###### no-ajax solution start ######
    // faster, so I'm going with it
    var allNames = $('#search').data('all-names');
    var allNamesUrlified = [];

    jQuery.each(allNames, function (k, v) {
        allNamesUrlified.push(urlifyString(v));
    });

    $('#search').autoComplete({
        autoSelect: false,
        resolver: 'custom',
        events: {
            search: function (qry, callback) {
                var options = [];

                jQuery.grep(allNamesUrlified, function( n, i ) {
                    if (n.indexOf(qry.toLowerCase()) !== -1) {
                        options.push(allNames[i]);
                    }
                });

                callback(options);
            }
        }
    });
    // ###### no-ajax solution end ######

    $('#search').on('autocomplete.select', function (evt, name) {
        location.href = '/namedays/' + urlifyString(name);
    });
});
