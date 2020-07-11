<?php
$d->reset();
$sql="select ten_$lang as ten,tenkhongdau,id from #_product_list where hienthi=1 and noibat = 1 and type='product' order by stt,id desc";
$d->query($sql);
$splist_tab=$d->result_array();  
?>
<script type="text/javascript">
$(window).load(function() {
    $('.tab-list li a').click(function() {
        var id = $(this).attr('rel');
        var idl = $(this).data("idl")
        $("#tab-show").load("ajax/tab_show.php", "id=" + id + "&idl=" + idl, function() {});
        return false;
    });
});
</script>
<script>
$().ready(function() {
    $(".tab-list a.listpro").click(function() {
        // $id = $(this).attr("href");
        $root = $(this).parents(".tab-wrap");
        setTimeout(function() {
            $root.find(".tab-list li").removeClass("activetab");
        }, 200);
        $(".tab-list a.listpro").removeClass("activetab");
        $(this).addClass("activetab");
        return false;
    });
});
</script>
<article class="tab-wrap">
    <ul class="tab-list flexbox">
        <?php for ($i=0; $i <count($splist_tab) ; $i++) { ?>
        <li>
            <a data-idl="<?=$splist_tab[$i]['id']?>" rel="<?=$splist_tab[$i]['id']?>" class="listpro">
                <?=$splist_tab[$i]['ten']?>
            </a>
        </li>
        <?php } ?>
    </ul>
    <div id="tab-show">
        <div class="tab-box flexbox">
            <?php
            $d->reset();
            $sql = "select ten_$lang as ten,tenkhongdau,id,photo,giacu,dientich,diachi from #_product where hienthi=1 and type='product' and noibat = 1 order by stt asc limit 0,8";
            $d->query($sql);
            $sanpham_show = $d->result_array();
            if (count($sanpham_show)>0) { 
                foreach ($sanpham_show as $key => $value) { echo product($value,'sanpham-col','san-pham',$thumb_product); } 
                }else echo '<p class="notice"> Nội dung đang cập nhật</p>';  ?>
        </div>
    </div>
</article>