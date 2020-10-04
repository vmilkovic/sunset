/**
 * @package sunsettheme
 * Custom Sunset Script
 */
jQuery(document).ready(function($){

    /**
     * Carousel
     */
    var carousels = '.sunset-carousel-thumb';

    function sunset_get_bs_thumbs(carousel){

        var activeThumb = $(carousel).find('.item.active');

        $(carousel).find('.carousel-control.left')
            .find('.thumbnail-container')
            .css({'background-image' : 'url(' + activeThumb.data('prev-image') + ')'});
        $(carousel).find('.carousel-control.right')
            .find('.thumbnail-container')
            .css({'background-image' : 'url(' + activeThumb.data('next-image') + ')'});
    }

    $(carousels).each(function(index, carousel){
        sunset_get_bs_thumbs(carousel)
    });

    $(carousels).on('slid.bs.carousel', function(){
        sunset_get_bs_thumbs(this);
    });

    /**
     * Ajax Functions
     */
    $(document).on('click', '.sunset-load-more:not(.loading)', function(){

        var that = $(this);
        var page = that.data('page');
        var newPage = page+1;
        var ajax_url = that.data('url');

        that.addClass('loading').find('.text').slideUp(320);
        that.find('.sunset-icon').addClass('spin');

        $.ajax({
            url: ajax_url,
            type: 'post',
            data: {
                page: page,
                action: 'sunset_load_more'
            },
            error: function(response){
                console.log(response)
            },
            success: function(response){
                that.data('page', newPage);

                setTimeout(function(){
                    $('.sunset-posts-container').append(response);
                    that.removeClass('loading').find('.text').slideDown(320);
                    that.find('.sunset-icon').removeClass('spin');
                }, 1000)
            }
        });

    });
})