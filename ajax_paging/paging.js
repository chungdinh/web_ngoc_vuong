// PHƯƠNG THỨC SHOW HÌNH LOADING
function loading_show() {
    $('#loading').html("<img src='images/image-loading-animation.gif'/>").fadeIn('fast');
}

// PHƯƠNG THỨC ẨN HÌNH LOADING
function loading_hide() {
    $('#loading').fadeOut('fast');
}

function goToByScroll(id) {
    $('html,body').animate({
        scrollTop: ($(id).offset().top - 70)
    }, 500);
}

// PHƯƠNG THỨC LOAD KẾT QUẢ 
function loadData(element, page, id_list, id_cat, loai) {
    $.ajax({
        type: "POST",
        url: "ajax_paging/index.php",
        data: { id_list: id_list, page: page, id_cat: id_cat, loai: loai },
        success: function(msg) {
            $(element).html(msg);
            $(element + ' .pagination li.active').click(function(event) {
                var page = $(this).attr('p');
                goToByScroll(element);
                loadData(element, page, id_list, id_cat, loai);

            });
        }
    });
}