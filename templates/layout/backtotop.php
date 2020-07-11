<div class="b2t" style="display: none;">
    <a>
        <div class="b2t-icon">
            <i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i>
        </div>
    </a>
</div>
<script type="text/javascript">
$(document).ready(function() {
    var top = $('.b2t');
    $(window).scroll(function() {
        if ($(window).scrollTop() > 300) {
            top.fadeIn(200);
        } else {
            top.fadeOut(300);
        }
    });
    $('.b2t a div,#arrow_cp').on('click', function() {
        $('html, body').animate({ scrollTop: 0 }, 'slow');
    });
});
</script>