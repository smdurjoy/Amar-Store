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


    //update seciton status
    $(".updateSectionStatus").click(function () {
        let status = $(this).text();
        let section_id = $(this).attr("section_id");
        $.ajax({
            type: 'post',
            url: '/admin/updateSectionStatus',
            data: {status:status, section_id:section_id},
            success:function (response) {
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


    //update category status
    $(".updateCategoryStatus").click(function () {
        let status = $(this).text();
        let category_id = $(this).attr("category_id");
        $.ajax({
            type: 'post',
            url: '/admin/catStatus',
            data: {status:status, category_id:category_id},
            success:function (response) {
                if(response['status'] == 0) {
                    $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)'> Inactive </a>");
                } else if(response['status'] == 1) {
                    $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)'> Active </a>");
                }
            },
            error:function () {
                alert("Error!!");
            }
        });
    });


    //Append category level
    $("#section_id").change(function () {
        let section_id = $(this).val();
        $.ajax({
            type: 'post',
            url: '/admin/categoriesLevel',
            data: {section_id:section_id},
            success:function (response) {
                $("#categoriesLevel").html(response);
            },
            error:function () {
                alert("error!")
            }
        })
    })

    //delete method
    // $(".confirmDelete").click(function () {
    //     let name = $(this).attr("name");
    //     if(confirm("Are you sure you want to delete this "+name+"?")) {
    //         return true;
    //     }
    //     return false;
    // })

    //delete with sweetaleart2
    $(".confirmDelete").click(function () {
        let record = $(this).attr("record");
        let recordId = $(this).attr("recordId");
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = "/admin/delete-"+record+"/"+recordId;
            }
        });
    })
});
