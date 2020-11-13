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
                if(response['discounted_price'] > 0) {
                    $('.productPrice').html('Tk.<del>'+response['product_price']+'</del> '+response['discounted_price'])
                }else {
                    $('.productPrice').html('Tk.'+response['product_price'])
                }
            },
            error:function () {
                alert('Error')
            }
        })
    });
});
