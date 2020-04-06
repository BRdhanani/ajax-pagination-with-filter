var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
var page = 2;

$(document).ready(function () {
    $('select').change(function () { 
        $valueOf = $(':selected').val();
        page = 1;
        $("#button").empty();
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
            $response=$(response);
            if($response.length){
                (page == 1) ? $(".my-posts").html($response) : $(".my-posts").append($response);
                $(".loadmore").attr("disabled",false);
            } else{
                $(".loadmore").attr("disabled",true);
            }
            page++;
        });
    }
});
