jQuery(document).ready(function($){
jQuery("#likepost").click(function(){

    like = jQuery(this);

    // Retrieve post ID from data attribute
    //post_id = like.data("post_id");
    var post_id= $(this).parent().parent().parent().parent().data('post_id');
   // Ajax call
    jQuery.ajax({
        type: "post",
        url: ajax_var.url,
        data: "action=post-like&nonce="+ajax_var.nonce+"&post_like=true&post_id="+post_id,
        success: function(count){
            // If vote successful
            if(count != "already")
            {
                $(like).find('img').attr('class','disabled');
                $(like).find('div').text(count);
                console.log(like)
            }else{
              // setInterval(function(){
              // 	$('#likepost').addElement('div').text('you have already liked!')
              // }, 3000);
              alert('you have already voted!')
            }
        }
    });

  //  return false;
})
})
