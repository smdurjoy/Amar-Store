$(document).ready(function() {
    $("#sort").on("change", function() {
        const sort = $(this).val();
        const url = $("#url").val();
        // this.form.submit();
        $.ajax({
            method: 'post',
            url: url,
            data: {sort: sort, url: url},
            success:function(data) {
                $("#filter_products").html(data);
            }
        }) 
    });
});