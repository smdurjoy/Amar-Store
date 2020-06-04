$(document).ready(function () {
//check admin password is correct or not
    $("#currentPass").keyup(function () {
        let currentPass = $("#currentPass").val();
        $.ajax({
            type: 'post',
            url: '/admin/checkCurrentPass',
            data: {currentPass:currentPass},
            success:function (response) {
                if ( response == "false" ) {
                    $("#chkCurrentPass").html("<font color='red'>Password is incorrect</font>");
                } else if ( response == "true" ) {
                    $("#chkCurrentPass").html("<font color='green'>Password is correct</font>");
                }
            },
            error:function () {
                alert("error!");
            }
        });
    });

    $(".updateSectionStatus").click(function () {
        let status = $(this).text();
        let section_id = $(this).attr("section_id");
        $.ajax({
            type: 'post',
            url: '/admin/updateSectionStatus',
            data: {status:status, section_id:section_id},
            success:function (response) {
                // alert(response['status']);
                // alert(response['section_id']);
                if(response['status'] == 0) {
                    $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)\'> Inactive </a>");
                } else if(response['status'] == 1) {
                    $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)\'> Active </a>");
                }
            },
            error:function () {
                alert("Error!");
            }
        });
    });
});