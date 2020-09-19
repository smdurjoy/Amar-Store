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

    // Common delete method for all action !!
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

    // Common status update method for all action !!
    $(".updateStatus").click(function () {
        const status = $(this).text();
        const record = $(this).attr("record");
        const record_id = $(this).attr("record_id");
        $.ajax({
            type: 'post',
            url: '/admin/update-'+record+'-status',
            data: {status:status, record_id:record_id},
            success:function (response) {
                if(response['status'] == 0) {
                    $("#"+record+'-'+record_id).text("Inactive");
                } else if(response['status'] == 1) {
                    $("#"+record+'-'+record_id).text("Active");
                }
            },
            error:function () {
                alert("Error!!");
            }
        });
    })

    // Add or remove products attribute fields
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div class="d-flex"><input class="form-control mx-1" style="width:125px" type="text" name="size[]" id="size" placeholder="Size" required/><input class="form-control mx-1" style="width:125px" type="text" name="sku[]" id="sku" placeholder="SKU" required/><input class="form-control mx-1" style="width:125px" type="text" name="price[]" id="price" placeholder="Price" required/><input class="form-control mx-1" style="width:125px" type="text" name="stock[]" id="stock" placeholder="Stock" required/><a href="javascript:void(0);" class="remove_button btn btn-danger btn-sm">Delete</a></div>'; //New input field html 
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
});
