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
});

$('.fa-trash').on('click', function(){
    var data = {
        review_id: $(this).attr("review_id"),
        action: 'delete'
      };
      $.ajax({
        type: 'POST',
        url: 'my-reviews.php',
        data: data,
        success: function(response) {
            $("#card-"+ data.review_id).hide()
        },
        error: function(xhr, status, error) {
            console.log('Error: ' + error);
          }

    });
});

$('.fa-edit').on('click', function(){
    var id = $(this).attr("review_id");
    var cardTitle = $('#card-title-'+id);
    $('#editReview').modal();
    $('#editReviewText').val(cardTitle.text());
    $('#editReviewId').val(id);
});

$('#submitReview').on('click', function(){
    var data = {
        review_id: $('#editReviewId').val(),
        review: $('#editReviewText').val(),
        action: 'edit'
      };

      $.ajax({
        type: 'POST',
        url: 'my-reviews.php',
        data: data,
        success: function(response) {
            var cardTitle = $('#card-title-'+data.review_id);
            debugger;
            cardTitle.text(data.review);
            $('#editReviewText').val('');
            $('#editReviewId').val('');
            $('#editReview').modal('hide');
        },
        error: function(xhr, status, error) {}
      });

})
  
  
  
  
  
  