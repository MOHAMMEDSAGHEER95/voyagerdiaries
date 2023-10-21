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
  if(data.user_id == '0'){
    // if user not logged in default value is 0 and we identify it as a guest user and 
    //redirect to login
    window.location.href = '/login.php'
  }
  
  $.ajax({
    type: 'POST',
    url: 'liked.php',
    data: data,
    success: function(response) {
      if(response == "liked"){
      element.siblings()[2].innerHTML = parseInt(element.siblings()[2].innerHTML) + 1;
      element.css('color', '#2d7ce6');
      element.attr("action", "unlike");
      }
      else {
        element.css('color', '#000000');
        element.attr("action", "like");
        element.siblings()[2].innerHTML = parseInt(element.siblings()[2].innerHTML) - 1;
      }
    },
    error: function(xhr, status, error) {
      console.log('Error: ' + error);
    }
  });
});

$('.action_dislike').on('click', function(){
  var data = {
      review_id: $(this).attr("review_id"),
      user_id: $(this).attr("user_id"),
      action: $(this).attr("action"),
    };
    var element = $(this);
    debugger
    if(data.user_id == '0'){
      // if user not logged in default value is 0 and we identify it as a guest user and 
      //redirect to login
      window.location.href = '/login.php'
    }
    
    $.ajax({
      type: 'POST',
      url: 'disliked.php',
      data: data,
      success: function(response) {
        if(response == "disliked"){
        element.siblings()[4].innerHTML = parseInt(element.siblings()[4].innerHTML) + 1;
        element.css('color', 'red');
        element.attr("action", "undislike");
        }
        else {
          element.css('color', '#000000');
          element.attr("action", "dislike");
          element.siblings()[4].innerHTML = parseInt(element.siblings()[4].innerHTML) - 1;
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
  
  
  
  
  
  