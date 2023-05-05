$(document).ready(function() {
        $(".li-title").on("click auxclick", function(e){
                //alert("clicked");
                //e.preventDefault();
                var bookmarkID = $(this).data("bookmark-id");
                $.ajax({
                    url: 'action-addvisit.php',
                    type: 'POST',
                    data: {bookmark_id: bookmarkID},
                    success: function(response) {
                        location.reload();
                    },
                    error: function(error){
                        alert(error);
                    }
                });
        });
    });
