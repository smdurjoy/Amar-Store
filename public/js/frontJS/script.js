function validation(form, rules, messages) {
    $(form).validate({
        rules: rules,
        messages: messages,
    });
}

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#sort").on("change", function() {
        const sort = $(this).val();
        const url = $("#url").val();
        const fabric = getFilters('fabric');
        const sleeve = getFilters('sleeve');
        const pattern = getFilters('pattern');
        const occasion = getFilters('occasion');
        const fit = getFilters('fit');
        $.ajax({
            method: 'post',
            url: url,
            data: {sort: sort, url: url, occasion: occasion, fabric: fabric, fit: fit, pattern: pattern, sleeve: sleeve},
            success:function(data) {
                $("#filter_products").html(data);
            }
        })
    });

    $('.fabric').on('click', function () {
        const sort = $('#sort option:selected').val();
        const url = $("#url").val();
        const fabric = getFilters('fabric');
        const sleeve = getFilters('sleeve');
        const pattern = getFilters('pattern');
        const occasion = getFilters('occasion');
        const fit = getFilters('fit');
        $.ajax({
            method: 'post',
            url: url,
            data: {sort: sort, url: url, occasion: occasion, fabric: fabric, fit: fit, pattern: pattern, sleeve: sleeve},
            success:function(data) {
                $("#filter_products").html(data);
            }
        })
    })

    $('.sleeve').on('click', function () {
        const sort = $('#sort option:selected').val();
        const url = $("#url").val();
        const fabric = getFilters('fabric');
        const sleeve = getFilters('sleeve');
        const pattern = getFilters('pattern');
        const occasion = getFilters('occasion');
        const fit = getFilters('fit');
        $.ajax({
            method: 'post',
            url: url,
            data: {sort: sort, url: url, occasion: occasion, fabric: fabric, fit: fit, pattern: pattern, sleeve: sleeve},
            success:function(data) {
                $("#filter_products").html(data);
            }
        })
    })

    $('.pattern').on('click', function () {
        const sort = $('#sort option:selected').val();
        const url = $("#url").val();
        const fabric = getFilters('fabric');
        const sleeve = getFilters('sleeve');
        const pattern = getFilters('pattern');
        const occasion = getFilters('occasion');
        const fit = getFilters('fit');
        $.ajax({
            method: 'post',
            url: url,
            data: {sort: sort, url: url, occasion: occasion, fabric: fabric, fit: fit, pattern: pattern, sleeve: sleeve},
            success:function(data) {
                $("#filter_products").html(data);
            }
        })
    })

    $('.fit').on('click', function () {
        const sort = $('#sort option:selected').val();
        const url = $("#url").val();
        const fabric = getFilters('fabric');
        const sleeve = getFilters('sleeve');
        const pattern = getFilters('pattern');
        const occasion = getFilters('occasion');
        const fit = getFilters('fit');
        $.ajax({
            method: 'post',
            url: url,
            data: {sort: sort, url: url, occasion: occasion, fabric: fabric, fit: fit, pattern: pattern, sleeve: sleeve},
            success:function(data) {
                $("#filter_products").html(data);
            }
        })
    })

    $('.occasion').on('click', function () {
        const sort = $('#sort option:selected').val();
        const url = $("#url").val();
        const fabric = getFilters('fabric');
        const sleeve = getFilters('sleeve');
        const pattern = getFilters('pattern');
        const occasion = getFilters('occasion');
        const fit = getFilters('fit');
        $.ajax({
            method: 'post',
            url: url,
            data: {sort: sort, url: url, occasion: occasion, fabric: fabric, fit: fit, pattern: pattern, sleeve: sleeve},
            success:function(data) {
                $("#filter_products").html(data);
            }
        })
    })

    function getFilters(className) {
        let filters = [];
        $('.'+className+':checked').each(function () {
            filters.push($(this).val());
        })
        return filters;
    }

    $('#getPrice').on('change', function () {
        const id = $(this).data('id');
        const size = $(this).val();
        if(size == "") {
            alert('Please Select Size');
            return false;
        }
        $.ajax({
            url: '/getProductPrice',
            data: {id: id, size: size},
            type: 'post',
            success:function (response) {
                console.log(response)
                if(response['discount'] > 0) {
                    $('.productPrice').html('Tk.<del>'+response['product_price']+'</del> '+response['final_price'])
                }else {
                    $('.productPrice').html('Tk.'+response['product_price'])
                }
            },
            error:function () {
                alert('Error')
            }
        })
    });

    $(document).on('click', '.cartItemUpdate', function() {
        if($(this).hasClass('qtyMinus')) {
            let quantity = $(this).prev().val();
            if(quantity <= 1) {
                alert('Item quantity must be 1 or greater !');
                return false;
            }else {
                new_qty = parseInt(quantity) - 1;
            }
        }
        if($(this).hasClass('qtyPlus')) {
            let quantity = $(this).prev().prev().val();
            new_qty = parseInt(quantity) + 1;
        }
        const cartId = $(this).data('id');
        $.ajax({
            data: {'qty': new_qty, 'cartId': cartId},
            url: '/update-cart-qty',
            type: 'post',
            success:function(response) {
                if(response.status == false) {
                    alert('Product stock is not available !')
                } else {
                    $('#appendCartItems').html(response.view);
                    $('.totalCartItems').html(response.totalCartItems);
                }
            },
            error:function() {
                alert('error')
            }
        })
    });

    $(document).on('click', '.cartItemDelete', function() {
        const id = $(this).data('id');
        const result = confirm('Are you sure you want to remove this item ?')
        if(result) {
            $.ajax({
                data: {id: id},
                url: '/delete-cart-item',
                type: 'post',
                success:function(response) {
                    $('#appendCartItems').html(response.view);
                    $('.totalCartItems').html(response.totalCartItems);
                },
                error:function() {
                    alert('error')
                }
            });
        }
    });

    $(document).on('keyup', '#currentPassword', function() {
        let currentPass = $(this).val();
        $.ajax({
            type: 'post',
            url: '/check-current-pass',
            data: {currentPass},
            success:function (res) {
                if ( res == "false" ) {
                    $("#chkCurrentPass").html("<font color='red'>Password is incorrect.</font>");
                } else if ( res == "true" ) {
                    $("#chkCurrentPass").html("<font color='green'>Password is correct.</font>");
                }
            },
            error:function (err) {
                alert(err.messages);
            }
        });
    });

    // Apply coupon
    $('#applyCoupon').on('submit', function(e) {
        e.preventDefault();
        const user = $(this).attr('user');
        if(user == 1) {
            // do nothing
        }else {
            alert('Please login to apply coupon.');
            return false;
        }
        const code = $("#couponCode").val();
        $.ajax({
            type: "post",
            data:{code},
            url: "/apply-coupon",
            success: function(response) {
                if(response.message !== "") {
                    alert(response.message)
                    $('#applyCoupon').trigger('reset');
                }
                $('#appendCartItems').html(response.view);
                $('.totalCartItems').html(response.totalCartItems);
                if(response.couponAmount > 0) {
                    $('.couponAmount').text("Tk."+response.couponAmount);
                    $('.grandTotal').text("Tk."+response.grandTotal);
                } 
            },
            error: function() { 
                alert("Something Went Wrong !");
            }
        })
    });

    // Common delete method for all action !!
    $(document).on('click', '.confirmDelete', function() {
        const record = $(this).attr("record");
        const recordId = $(this).attr("recordId");
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
                window.location.href = "/delete-"+record+"/"+recordId;
            }
        });
    });
});
