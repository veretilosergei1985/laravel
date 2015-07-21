$( document ).ready(function() {
  
    $('.comment-block').on('click', function (e) {
        console.log(e.target);
        var commentId = $(e.target).closest('.comment-block').attr('comment_id');

        if ($('form[comment_id="'+commentId+'"]').length == 0) {
            var postId = $(this).attr('post_id');            
            $.ajax({
            url: "/comment/addform/" + commentId,
            type: "POST",
            data: { postId : postId },
            beforeSend: function(request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function(data){
                res = jQuery.parseJSON(data);
                if (res.success == true) {
                    $('.comment-block[post_id="'+postId+'"][comment_id="'+commentId+'"]').append(res.html);
                }
                //alert(data);
              }
            });
        }
 
    });
    
    $('.comment-block').on('click', 'input[type="submit"]', function (e) {
        e.preventDefault();
        var commentId = $(this).attr('comment_id');
        var url = $('.answer-comment-form[comment_id="' + commentId + '"]').attr('action');
        var postId = $(this).closest('.comment-block').attr('post_id');
        $.ajax({
            type: "POST",
            url: url,
            data: $('form[comment_id="' + commentId + '"]').serialize() + "&postId=" + postId, // serializes the form's elements.
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf_token"]').attr('content');
                if (token) {
                    return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
            success: function (data)
            {
                res = jQuery.parseJSON(data);
                if (res.success == true) {
                    $('form[comment_id="' + commentId + '"]').replaceWith(res.html);
                }
            }
        });
        return false;
    });
    
    
    
});




