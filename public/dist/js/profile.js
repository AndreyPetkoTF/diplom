$(document).ready(function(){

    $('.mobile-menu').hide();

    $('.hamburger').click(function(){
        $('.mobile-menu').slideToggle();
    });

    $('.social-item').hover(function(){
        src = $(this).find('img').attr('src');
        src = src.substring(0, src.length - 4);
        src = src + '-act.png';
        $(this).find('img').attr('src', src);
    }, function(){
        src = $(this).find('img').attr('src');
        src = src.substring(0, src.length - 8);
        src = src + '.png';
        $(this).find('img').attr('src', src);
    });



    $('#file').change(function(){
        var filename = $('#file').val().split('\\').pop();
        $('#file-label').html(filename);
    });

});