$(document).ready(function() {
        $(".li-title").on("click auxclick", function(e){
                var bookmarkID = $(this).data("bookmark-id");
                $.ajax({
                    url: 'action-addvisit.php',
                    type: 'POST',
                    data: {bookmark_id: bookmarkID},
                    success: function() {
                        location.reload();
                    },
                    error: function(error){
                        alert(error);
                    }
                });
        });
    });
