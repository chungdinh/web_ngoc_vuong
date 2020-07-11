<?php
session_start();
$session=session_id();
@define ( '_template' , './templates/');
@define ( '_source' , './sources/');
@define ( '_lib' , './libraries/');
include_once _lib."config.php";
include_once _lib."constant.php";
include_once _lib."functions.php";
include_once _lib."functions_share.php";
include_once _lib."class.database.php";
include_once _source."lang_$lang.php";
include_once _lib."functions_giohang.php";
include_once _lib."file_requick.php";
include_once _lib."counter.php";
$count_online = count_online();
if($_GET['lang']!=''){
    $_SESSION['lang_demo']=$_GET['lang'];
    header("location:".$url_web."");
} else {
    $_SESSION['links']=getCurrentPageURL();
}
if($_REQUEST['command']=='add' && $_REQUEST['productid']>0)
{
    $pid=$_REQUEST["productid"];
    $q=isset($_GET['quality']) ? ($_GET['quality']) : "1";
    addtocart($pid,$q);
    redirect("http://$config_url/gio-hang.html");
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang ?>" itemtype="https://schema.org/WebPage">

<head>
    <meta charset="UTF8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="csrf-token" content="<?php echo $token; ?>">
    <base href="<?php echo $url_web ?>/">
    <link rel="canonical" href="<?= getCurrentPageURL() ?>" />
    <!-- dns prefetch -->
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <link rel="dns-prefetch" href="<?php echo $url_web ?>">
    <link rel="dns-prefetch" href="//facebook.com/">
    <link rel="dns-prefetch" href="//www.google-analytics.com/">
    <link rel="dns-prefetch" href="//www.youtube.com/">
    <link rel="dns-prefetch" href="//s7.addthis.com/">
    <link id="favicon" rel="shortcut icon" href="<?=_upload_hinhanh_l.$favicon['thumb']?>" type="image/x-icon" />
    <title>
        <?php if($title_bar!='') echo $title_bar; else echo $row_setting['title_'.$lang]; ?>
    </title>
    <meta name="format-detection" content="telephone=no">
    <meta name="description" content="<?php if($description_bar!='') echo $description_bar; else echo $row_setting['description_'.$lang]; ?>">
    <meta name="keywords" content="<?php if($keywords_bar!='') echo $keywords_bar; else echo $row_setting['keywords_'.$lang]; ?>">
    <!-- <meta name="viewport" content="width=1366"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noodp,index,follow" />
    <meta name="google" content="notranslate" />
    <meta name='revisit-after' content='1 days' />
    <meta name="ICBM" content="<?=$row_setting['toado']?>">
    <meta name="geo.position" content="<?=$row_setting['toado']?>">
    <meta name="geo.placename" content="<?=$row_setting['diachi_'.$lang]?>">
    <meta name="author" content="<?=$row_setting['ten_'.$lang]?>">
    <script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="bonus/fancybox3/jquery.fancybox.min.css">
    <link rel="stylesheet" href="bonus/simplyscroll/jquery.simplyscroll.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/bonus.css?v=<?php echo time(); ?>">
    <?php   if ($template != 'index') { ?>
    <link rel="stylesheet" type="text/css" href="css/pagein.css?v=<?php echo time(); ?>">
    <?php } ?>
    <link rel="stylesheet" type="text/css" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/responsive.css?v=<?php echo time(); ?>">
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "url": "<?php echo $url_web ?>"
    }
    </script>
    <?php
    echo $row_setting['meta'];
    echo $row_setting['scripttop']; 
    echo $share_facebook;
    echo $php_link;
    ?>
    <script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=1072122606213107";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>
    <?=$row_setting['analytics']?>
    <title>Google reCAPTCHA v3</title>
    <script src="https://www.google.com/recaptcha/api.js?render=<?=$sitekey?>"></script>
    <script>
    grecaptcha.ready(function() {
        grecaptcha.execute('<?=$sitekey?>', { action: 'contact' }).then(function(token) {
            var recaptchaResponse_contact = document.getElementById('recaptchaResponse_contact');
            recaptchaResponse_contact.value = token;
        });
    });
    </script>
    <script>
    grecaptcha.ready(function() {
        grecaptcha.execute('<?=$sitekey?>', { action: 'mail' }).then(function(token) {
            var recaptchaResponse_mail = document.getElementById('recaptchaResponse_mail');
            recaptchaResponse_mail.value = token;
        });
    });
    </script>
</head>
<?php /* ?>
<!-- Gio hang -->
<script language="javascript" type="text/javascript">
function addtocart(pid) {
    document.form1.productid.value = pid;
    document.form1.command.value = 'add';
    document.form1.submit();
}
</script>
<form name="form1" action="index.php">
    <input type="hidden" name="productid" />
    <input type="hidden" name="command" />
</form>
<!-- end gio hang -->
<?php */ ?>

<body style="position: relative; min-height: 100%; top: 0px;">
    <div class="body-box">
        <header <?php if ($template !='index' ){ echo 'class="notindex"' ;} ?>>
            <h1 style="display: none;">
                <?php if($title_bar!='') echo $title_bar; else echo $row_setting['title_vi']; ?>
            </h1>
            <h2 style="display: none;">
                <?php if($title_bar!='') echo $title_bar; else echo $row_setting['title_vi']; ?>
            </h2>
            <h3 style="display: none;">
                <?php if($title_bar!='') echo $title_bar; else echo $row_setting['title_vi']; ?>
            </h3>
            <h4 style="display: none;">
                <?php if($title_bar!='') echo $title_bar; else echo $row_setting['title_vi']; ?>
            </h4>
            <h5 style="display: none;">
                <?php if($title_bar!='') echo $title_bar; else echo $row_setting['title_vi']; ?>
            </h5>
            <h6 style="display: none;">
                <?php if($title_bar!='') echo $title_bar; else echo $row_setting['title_vi']; ?>
            </h6>
            <?php include _template."layout/header.php"; ?>
            <?php 
            include _template."layout/menu.php";
            include _template."layout/menu_m.php"; ?>
        </header><!-- /header -->
        <main id="body">
            <?php 
            if ($template == 'index') { include _template."layout/slider.php"; }
            include _template.$template."_tpl.php";                     
            ?>
        </main>
        <!-- /body -->
        <footer <?php if ($template !='index' ){ echo 'class="notindex"' ;}?>>
            <?php
            include _template."layout/footer.php";
            include _template."layout/backtotop.php";
            //include _template."layout/messenger.php";
            include _template."layout/quick-tools.php";
            // include _template."layout/popup.php";
            include _template."layout/fix-toolbar.php";
            ?>
        </footer><!-- /footer -->
        <?php 
        echo $row_setting['scriptbottom'];
        echo $row_setting['vchat'];
        ?>
        <script src="bonus/simplyscroll/jquery.simplyscroll.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="bonus/fancybox3/jquery.fancybox.min.js"></script>
        <script type="text/javascript" src="js/slick/slick.min.js"></script>
        <script type="text/javascript" src="js/wow/wow.min.js"></script>
        <script type="text/javascript" src="js/myscript.js?v=<?=time()?>"></script>
        <script type="text/javascript">
        $().ready(function() {
            $("img").each(function(index, el) {
                if (!$(this).attr('alt') || $(this).attr('alt') == undefined) {
                    $(this).attr('alt', '<?= $row_setting["ten_$lang"]?>');
                }
            });
        })
        </script>
    </div>
</body>

</html>