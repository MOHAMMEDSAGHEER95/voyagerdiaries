$('.menu_avatar').on('click', function(){
    $('.dropdown-menu').show();
    
});


$('.action_like').on('click', function(){
var data = {
    review_id: $(this).attr("review_id"),
    user_id: $(this).attr("user_id"),
    action: $(this).attr("action"),
  };
  var element = $(this);
  
  $.ajax({
    type: 'POST',
    url: 'liked.php',
    data: data,
    success: function(response) {
      if(response == "liked"){
      element.css('color', '#2d7ce6');
      element.attr("action", "unlike");
      }
      else {
        element.css('color', '#000000');
        element.attr("action", "like");
      }
    },
    error: function(xhr, status, error) {
      console.log('Error: ' + error);
    }
  });
})

// $('.card-body').hover(
//     function() {
//       $(this).animate({ height: '300px' }, 300);
//     }, function() {
//       $(this).animate({ height: '200px' }, 300);
//     }
//   );  
  
  
  
  
  
  