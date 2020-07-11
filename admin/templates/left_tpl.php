<?php 
$logo_setting = _fetch_array("SELECT photo_$lang as photo,hienthi FROM table_photo WHERE type like 'logo' LIMIT 0,1");
 ?>
<div class="logo">
    <a href="#" target="_blank" onclick="return false;">
        <img src="../thumb/100x100/2/<?=_upload_hinhanh_l.$logo_setting['photo']?>" alt="logo">
    </a>
</div>
<div class="sidebarSep mt0"></div>
<!-- Left navigation -->
<ul id="menu" class="nav">
    <li class="dash" id="menu1">
         <a <?php if ($_GET['com']==''){echo 'class="active"';} ?> title="Trang chủ" href="index.php">
            <span>Trang chủ</span>
        </a>
    </li>
    <li class="setting_li<?php if(($_GET['com']=='setting' || $_GET['com']=='newsletter' || $_GET['com']=='option' || $_GET['com']=='yahoo'|| $_GET['com']=='bannerqc')) echo ' activemenu' ?>" id="menu_setting">
         <a href="#" title="" class="exp <?php if ($_GET['com']=='setting'|| $_GET['com']=='bannerqc'|| $_GET['com']=='option'|| $_GET['com']=='newsletter'|| $_GET['com']=='yahoo'){echo 'active';} ?>">
            <span>Setting</span>
        </a>
        <ul class="sub">
            <li <?php if($_GET['type']=='setting' ) echo 'class="this"' ?>><a href="index.php?com=setting&act=capnhat&type=setting" title="Thông Tin Chung">Thông Tin Chung</a></li>
            <li <?php if($_GET['type']=='favicon' ) echo 'class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=favicon" title="Favicon">Favicon</a></li>
            <li <?php if($_GET['type']=='logo' ) echo 'class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=logo" title="Logo">Logo</a></li>
            <!-- <li <?php if($_GET['type']=='banner' ) echo 'class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=banner" title="Banner">Banner</a></li> -->
            <!-- <li <?php if($_GET['type']=='title' ) echo 'class="this"' ?>><a href="index.php?com=option&act=man&type=title" title="Title">Title</a></li> -->
            <li <?php if($_GET['type']=='email' ) echo 'class="this"' ?>><a href="index.php?com=newsletter&act=man&type=email" title="Email Đăng ký">Email Đăng ký</a></li>
            <!-- <li <?php if($_GET['type']=='support' ) echo 'class="this"' ?>><a href="index.php?com=yahoo&act=man&type=support" title="Hỗ trợ">Hỗ trợ</a></li> -->
        </ul>
    </li>
    <li class="template_li <?php if($_GET['com']=='baiviet' && $_GET['type']!='giaiphap'|| $_GET['com']=='info') echo ' activemenu' ?>" id="menu_baiviet"><a href="" title="" class="exp <?php if (($_GET['com']=='info'|| $_GET['com']=='baiviet') && $_GET['type']!='giaiphap'){echo 'active';} ?>"><span>Bài Viết</span></a>
        <ul class="sub">
            <li <?php if($_GET['type']=='gioithieu' ) echo 'class="this"' ?>><a href="index.php?com=info&act=capnhat&type=gioithieu">Giới Thiệu</a></li>
            <!-- <li <?php if($_GET['type']=='gioithieu' ) echo 'class="this"' ?>><a href="index.php?com=baiviet&act=man&type=gioithieu">Giới Thiệu</a></li> -->
            <li <?php if($_GET['type']=='tintuc' ) echo 'class="this"' ?>><a href="index.php?com=baiviet&act=man&type=tintuc">Tin Tức</a></li>
            <li <?php if($_GET['type']=='dichvu' ) echo 'class="this"' ?>><a href="index.php?com=baiviet&act=man&type=dichvu">Dịch Vụ</a></li>
            <li <?php if($_GET['type']=='chinhsach' ) echo 'class="this"' ?>><a href="index.php?com=baiviet&act=man&type=chinhsach">Chính Sách</a></li>
            <!-- <li <?php if($_GET['type']=='popup' ) echo 'class="this"' ?>><a href="index.php?com=info&act=capnhat&type=popup">Popup</a></li> -->
            <!-- <li <?php if($_GET['type']=='footer' ) echo 'class="this"' ?>><a href="index.php?com=info&act=capnhat&type=footer">Footer</a></li> -->
            <li <?php if($_GET['type']=='lienhe' ) echo 'class="this"' ?>><a href="index.php?com=info&act=capnhat&type=lienhe">Liên Hệ</a></li>
        </ul>
    </li>
    <li class="template_li <?php if($_GET['type']=='giaiphap') echo ' activemenu' ?>" id="menu_baiviet"><a href="" title="" class="exp <?php if ($_GET['com']=='baiviet' && $_GET['type']=='giaiphap'){echo 'active';} ?>"><span>Giải Pháp</span></a>
        <ul class="sub">
            <li <?php if($_GET['com']=='baiviet' && $_GET['type']=='giaiphap' && ($_GET['act']=='man_list' || $_GET['act']=='edit_list' || $_GET['act']=='add_list' )) echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man_list&type=giaiphap">Danh mục cấp 1</a></li>
            <li <?php if($_GET['com']=='baiviet' && $_GET['type']=='giaiphap' && ($_GET['act']=='man_cat' || $_GET['act']=='edit_cat' || $_GET['act']=='add_cat' )) echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man_cat&type=giaiphap">Danh mục cấp 2</a></li>
            <!-- <li <?php if($_GET['com']=='baiviet' && $_GET['type']=='giaiphap' && ($_GET['act']=='man_item' || $_GET['act']=='edit_item' || $_GET['act']=='add_item' )) echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man_item&type=giaiphap">Danh mục cấp 3</a></li> -->
            <!-- <li <?php if($_GET['com']=='baiviet' && $_GET['type']=='giaiphap' && ($_GET['act']=='man_sub' || $_GET['act']=='edit_sub' || $_GET['act']=='add_sub' )) echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man_sub&type=giaiphap">Danh mục cấp 4</a></li> -->
            <li <?php if($_GET['com']=='baiviet' && $_GET['type']=='giaiphap' && ($_GET['act']=='man' || $_GET['act']=='edit' )) echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man&type=giaiphap">Tất Cả Giải Pháp</a></li>
        </ul>
    </li>
    <li class="album_li <?php if($_GET['com']=='album' || $_GET['type']=='duan') echo ' activemenu' ?>" id="menu_album"><a href="" title="" class="exp <?php if ($_GET['com']=='album'){echo 'active';} ?>"><span>Dự Án</span></a>
        <ul class="sub">
            <!-- <li <?php if($_GET['type']=='album' && ($_GET['act']=='man_list' || $_GET['act']=='edit_list' || $_GET['act']=='add_list' )) echo ' class="this"' ?>><a href="index.php?com=album&act=man_list&type=album">Danh mục</a></li> -->
            <li <?php if($_GET['type']=='duan' && ($_GET['act']=='man' || $_GET['act']=='edit' )) echo ' class="this"' ?>><a href="index.php?com=album&act=man&type=duan">Tất Cả Dự Án</a></li>
        </ul>
    </li>
    <li class="product_li <?php if($_GET['type']=='product' || $_GET['com']=='order') echo ' activemenu' ?>" id="menu_product"><a href="" title="" class="exp <?php if ($_GET['com']=='product' || $_GET['com']=='order' || $_GET['com']=='tags'){echo 'active';} ?>"><span>Sản phẩm</span></a>
        <ul class="sub">
            <li <?php if($_GET['com']=='product' && $_GET['type']=='product' && ($_GET['act']=='man_list' || $_GET['act']=='edit_list' || $_GET['act']=='add_list' )) echo ' class="this"' ?>><a href="index.php?com=product&act=man_list&type=product">Danh mục cấp 1</a></li>
            <li <?php if($_GET['com']=='product' && $_GET['type']=='product' && ($_GET['act']=='man_cat' || $_GET['act']=='edit_cat' || $_GET['act']=='add_cat' )) echo ' class="this"' ?>><a href="index.php?com=product&act=man_cat&type=product">Danh mục cấp 2</a></li>
            <li <?php if($_GET['com']=='product' && $_GET['type']=='product' && ($_GET['act']=='man_item' || $_GET['act']=='edit_item' || $_GET['act']=='add_item' )) echo ' class="this"' ?>><a href="index.php?com=product&act=man_item&type=product">Danh mục cấp 3</a></li>
            <!-- <li <?php if($_GET['com']=='product' && $_GET['type']=='product' && ($_GET['act']=='man_sub' || $_GET['act']=='edit_sub' || $_GET['act']=='add_sub' )) echo ' class="this"' ?>><a href="index.php?com=product&act=man_sub&type=product">Danh mục cấp 4</a></li> -->
            <li <?php if($_GET['com']=='product' && $_GET['type']=='product' && ($_GET['act']=='man' || $_GET['act']=='edit' )) echo ' class="this"' ?>><a href="index.php?com=product&act=man&type=product">Tất cả sản phẩm</a></li>
            <!-- <li <?php if($_GET['com']=='tags' && $_GET['type']=='product' && ($_GET['act']=='man' || $_GET['act']=='edit' )) echo ' class="this"' ?>><a href="index.php?com=tags&act=man&type=product">Tag sản phẩm</a></li> -->
            <!-- <li <?php if($_GET['com']=='order' && $_GET['type']=='product' && ($_GET['act']=='man' || $_GET['act']=='edit' )) echo ' class="this"' ?>><a href="index.php?com=order&act=man&type=product">Đơn hàng</a></li> -->
        </ul>
    </li>
    <li class="media_li<?php if($_GET['com']=='photo' || $_GET['com']=='video') echo ' activemenu' ?>" id="menu_media"><a href="#" title="" class="exp <?php if ($_GET['com']=='photo' || $_GET['com']=='video'){echo 'active';} ?>"><span>Media</span></a>
        <ul class="sub">
            <li <?php if($_GET['type']=='slider' ) echo ' class="this"' ?>><a href="index.php?com=photo&act=man_photo&type=slider" title="">Slider</a></li>
            <!-- <li <?php if($_GET['type']=='doitac' ) echo ' class="this"' ?>><a href="index.php?com=photo&act=man_photo&type=doitac" title="">Đối Tác</a></li> -->
            <!-- <li <?php if($_GET['type']=='quangcao' ) echo ' class="this"' ?>><a href="index.php?com=photo&act=man_photo&type=quangcao" title="">Quảng Cáo</a></li> -->
            <li <?php if($_GET['type']=='video' && $_GET['type']=='video' ) echo ' class="this"' ?>><a href="index.php?com=video&act=man&type=video" title="">Video</a></li>
        </ul>
    </li>
    <li class="social_li<?php if($_GET['com']=='lkweb') echo ' activemenu' ?>" id="menu_lkweb"><a href="#" title="" class="exp <?php if ($_GET['com']=='lkweb'){echo 'active';} ?>"><span>Mạng Xã Hội</span></a>
        <ul class="sub">
            <li <?php if($_GET['com']=='lkweb' && $_GET['type']=='socialheader' ) echo ' class="this"' ?>><a href="index.php?com=lkweb&act=man&type=socialheader" title="">MXH Header </a></li>
            <li <?php if($_GET['com']=='lkweb' && $_GET['type']=='socialbody' ) echo ' class="this"' ?>><a href="index.php?com=lkweb&act=man&type=socialbody" title="">MXH Body </a></li>
            <!-- <li <?php if($_GET['com']=='lkweb' && $_GET['type']=='socialfooter' ) echo ' class="this"' ?>><a href="index.php?com=lkweb&act=man&type=socialfooter" title="">MXH Footer</a></li> -->
        </ul>
    </li>
    <li class="gallery_li<?php if($_GET['com']=='background') echo ' activemenu' ?>" id="menu_background"><a href="#" title="" class="exp <?php if ($_GET['com']=='background'){echo 'active';} ?>"><span>Background</span></a>
        <ul class="sub">
            <li <?php if($_GET['com']=='background' && $_GET['type']=='bgheader' ) echo ' class="this"' ?>><a href="index.php?com=background&act=capnhat&type=bgheader" title="">Background Header</a></li>
            <!-- <li <?php if($_GET['com']=='background' && $_GET['type']=='bgbody' ) echo ' class="this"' ?>><a href="index.php?com=background&act=capnhat&type=bgbody" title="">Background Body</a></li> -->
            <li <?php if($_GET['com']=='background' && $_GET['type']=='bgfooter' ) echo ' class="this"' ?>><a href="index.php?com=background&act=capnhat&type=bgfooter" title="">Background Footer</a></li>
            <li <?php if($_GET['com']=='background' && $_GET['type']=='bgpagein' ) echo ' class="this"' ?>><a href="index.php?com=background&act=capnhat&type=bgpagein" title="">Background Trang Trong</a></li>
        </ul>
    </li>
</ul>