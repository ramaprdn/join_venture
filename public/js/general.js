function toggle_comment(post_id){
    var class_name = $('#toggle-comment' + post_id).attr('style');
    if(class_name == 'display: none;'){
        $('#toggle-comment'+post_id).attr('style', '');    
    }else{
        $('#toggle-comment'+post_id).attr('style', 'display: none;');
    }
}