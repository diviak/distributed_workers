$(function () {
    var $select = $(".jtt-dropdown-select");
    $select.select2({
        theme: "classic",
        width: "100%",
        matcher: function (params, data) {
            if ($.trim(params.term) === '') {
                return data;
            }

            var pattern = params.term.split("").reduce(function(a,b){ return a+".*"+b; });
            if ((new RegExp(pattern, 'i')).test(data.text)) {
                return data;
            }

            return null;
        }
    });

    $select.data('select2').$container.addClass('jtt-select2');
    $select.data('select2').$results.addClass('jtt-select2-results');

    $select
        .on("select2:close", function () {
            $('.jtt-dropdown').addClass('jtt-hidden');
        })
        .on("select2:select", function (e) {
            var selectedTable = e.params.data.text;
            var $tableLink = $('#tables a[href$="select=' + selectedTable + '"]').get(0);

            $tableLink.click();
        });
});

Mousetrap.bind('o', function () {
    var $select = $(".jtt-dropdown-select");
    $('.jtt-dropdown').removeClass('jtt-hidden');
    $select.select2('open');
});

Mousetrap.bind('d d', function () {
    var $wholeResult = $('input[type="checkbox"][name="all"]');
    if ($wholeResult.length && !$wholeResult.is(':checked')) {
        $wholeResult.trigger('click');
    }
    $('input[name="delete"]').trigger('click');
});

Mousetrap.bind('esc', function () {
    $('.jtt-dropdown').addClass('jtt-hidden');
});