$(document).ready(function() {
    $(".delete-link").click(function(e) {
        var bookmarkId = $(this).data("bookmark-id");
        var user = $(this).data("user-id");
        $.ajax({
            url: "action-deletebookmark.php",
            type: "POST",
            data: 
            {
                bookmark_id: bookmarkId,
                user_id: user
            },
            success: function(response) {
                $("body").html(response);
            },
            error: function() {
                alert("Error deleting bookmark!");
            }
        });
    });
});