$(document).ready(function(){
  var $grid =  $('.grid').isotope({
  // options
 // itemSelector: '.2',
//  layoutMode: 'fitRows'
});


  var defaultId = $('#default-id').val();

  if(defaultId) {
    index = parseInt(defaultId.substring(6));

    $('.category-button').removeClass('category-list-active');

    $grid.isotope({filter: '.' + defaultId});
  }


    $('.category-button').click(function(){
        id = $(this).attr('id');
        $('.category-button').removeClass('category-list-active');
        $(this).addClass('category-list-active');

        if(id != 'all') {
            $grid.isotope({filter: '.' + id});
        } else {
            $grid.isotope({ filter: '*' });
        }
    });
    
});