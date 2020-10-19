$(document).ready(function() {
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
});
