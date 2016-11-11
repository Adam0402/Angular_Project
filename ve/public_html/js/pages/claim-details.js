$(document).ready(function () {
    // Javascript to enable link to tab
    var url = document.location.toString();
    if (url.match('#')) {
        $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
    }

    if (location.hash) {
        setTimeout(function() {

            window.scrollTo(0, 0);
        }, 1);
    };

    $('#photos').on('click', '.rotate-claim-photo', function(){
        var scope = $(this),
            photoId = scope.attr('data-id');

        scope.addClass('fa-spin');
        $.ajax({
            url: '/v1/data/rotate-image',
            type: 'POST',
            data: {id: photoId},
            dataType: 'JSON',
            success: function(response){
                if (response.success){
                    var img = $('.claim-thumb-'+photoId);
                    img.attr('src', img.attr('src')+'?'+Math.random());
                } else {
                    alert(response.message)
                }
            }
        });
        scope.removeClass('fa-spin');
    });
});