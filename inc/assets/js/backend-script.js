/**
 * File backend-script.js.
 */

// Welcome Page Menu Tab
jQuery( function($) {
    $('ul.about-theme-tab-nav li').click(function () {
        var tab_id = $(this).attr('data-tab');

        $('ul.about-theme-tab-nav li').removeClass('active');
        $('.about-theme-tab').removeClass('active');

        $(this).addClass('active');
        $("#" + tab_id).addClass('active');
    });

    // Add Active class with anchor actions click.
    $('.about-theme-tab .actions').click(function () {
        var status_id = $(this).attr('href').split('#');
        $('ul.about-theme-tab-nav li').removeClass('active');
        $('.about-theme-tab').removeClass('active');
        $('ul.about-theme-tab-nav li[data-tab="'+status_id[1]+'"]').addClass('active');
        $("#" + status_id[1]).addClass('active');
    });
});