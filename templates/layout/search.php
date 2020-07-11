<?php  ?>
<!-- search-normal -->
<div id="form-search" class="animated fadeInDown">
    <form id="form-timkiem" class="flexbox" action="search.html" method="GET" accept-charset="utf-8" autocomplete="off">
        <input type="text" name="txt_keywords" class="txt_keywords" placeholder="Nhập từ khóa.... ">
        <button type="submit">
            <i class="fa fa-search" aria-hidden="true"></i>
        </button>
    </form>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $("#form-timkiem").submit(function(event) {
        event.preventDefault();
        window.location = 'search.html&keywords=' + $(".txt_keywords").val();
    });
});
</script>
<!--  end search-normal -->
<?php /* ?>
<!-- search-in-out -->
<li class="search_menu">
    <a href="javascript:void(0);" class="search">
        <img src="images/icon-search.png" />
    </a>
</li>
<div class="search-form" style="width: 0px; opacity: 0;">
    <div class="form-row-search">
        <form action="search.html" method="GET" name="frm_search" id="frm_search" onsubmit="return false;">
            <input id="keyword" name="keyword" type="text" class="search-field" placeholder="Nhập từ khóa...">
            <input id="de   faultvalue" type="hidden" class="search-field" value="Nhập từ khóa...">
            <input type="hidden" id="href_search" value="search.html" />
        </form>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    var show = 0;
    $('a.search').click(function() {
        if (show == 1) {
            $('.form-row-search').css({ 'width': 0 });
            $('.search-form').css({ 'width': 0, 'opacity': 0 });
            $('a.search').removeClass('active');
            show = 0;
            execSearch();
        } else {
            $('.form-row-search').css({ 'width': '100%' });
            if ($(window).width() <= 1100) {
                $('.search-form').css({ 'width': 270, 'opacity': 1 });
            } else {
                $('.search-form').css({ 'width': 200, 'opacity': 1 });
            }
            $('a.search').addClass('active');
            document.getElementById("frm_search").reset();
            show = 1;
        }
    });
    $('#keyword').keydown(function(e) {
        if (e.keyCode == 13) {
            execSearch();
        }
    });
    $("#form-timkiem").submit(function(event) {
        event.preventDefault();
        window.location = 'search.html&keywords=' + $(".txt_keywords").val();
    });
})

function execSearch() {
    var keyword = $('#keyword').val();
    var href_search = $('#href_search').val();
    var defaultvalue = $('#defaultvalue').val();
    if (keyword == defaultvalue)
        return false;
    if (keyword != '') {
        var url = href_search + '&keywords=' + encodeURIComponent(keyword)
        window.location = url;
        return false;
    }
}
</script>
<?php */ ?>