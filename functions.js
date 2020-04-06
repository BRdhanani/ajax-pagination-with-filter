var page = 2;

$(document).ready(function () {
    $('select').change(function () { 
        $valueOf = $(':selected').val();
        page = 1;
        ajaxCall();   
    });
    $('body').on('click', '.loadmore', function() {
        ajaxCall();   
    });
    ajaxCall = () =>{
        $valueOf = $(':selected').val();
        var data = {
            'action': 'load_posts_by_ajax',
            'page': page,
            'valueOf': $valueOf,
        };
 
        $.post(ajax_var.url, data, function(response) {
            if( Number(response)!=0){
                (page == 1) ? $(".my-posts").html(response) : $(".my-posts").append(response);
                $(".loadmore").attr("disabled",false);
                $(".loadmore").text("Load More");
            } else{
                $(".loadmore").attr("disabled",true);
                $(".loadmore").text("No more posts");
            }
            page++;
        });
    }
});
