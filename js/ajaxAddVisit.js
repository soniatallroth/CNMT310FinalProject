function addVisit() {
    $(document).ready(function() {
        $("a.li-title").on("click", function(){
            var bookmarkID = $(this).attr("id");
            $.ajax({
                url: 'action-addvisit.php',
                type: 'POST',
                data: {bookmarkID: bookmarkID},
                success: function(response) {
                    $("body").html(response);
                },
                error: function(error){
                    alert(error);
                }
            });
        });
    });
}