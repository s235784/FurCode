<?php
/**
 *
 * User: nuotian <s235784@gmail.com>
 * Date: 2020/1/21
 * Time: 15:53
 */
if (empty($_GET['ContextInfo'])) {
    $ContextInfo = "index";
} else if ($_GET['ContextInfo'] == null) {
    $ContextInfo = "index";
} else {
    $ContextInfo = $_GET['ContextInfo'];
}
switch ($ContextInfo) {
    case 'index':
        $Title = "FurCode";
        break;
    case 'static':
        $Title = "静态资源";
        break;
    case 'game':
        $Title = "游戏资源";
        break;
    case 'others':
        $Title = "其他资源";
        break;
    case 'about':
        $Title = "关于";
        break;
    default :
        include_once('404.html');
        return;
        break;
}
?>
<!--
     _   _             _______  _
    | \ | |           |__   __|(_)
    |  \| | _   _   ___  | |    _   __ _  _ __
    | . ` || | | | / _ \ | |   | | / _` || '_ \
    | |\  || |_| || (_) || |   | || (_| || | | |
    |_| \_| \__,_| \___/ |_|   |_| \__,_||_| |_|

    Author: NuoTian (https://github.com/s235784)

-->

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>兽码云 - <?php echo $Title ?></title>
    <meta charset="utf-8">
    <meta name="Keywords" content="静态资源,下载站,兽人,JavaScript,CSS,FurryCafe,Furry"/>
    <meta name="description" content="静态资源和其他资源下载站"/>
    <meta name="theme-color" content="#0288D1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="https://cafe.furcode.cn/favicon_32.ico">
    <link href="styles.css" rel="stylesheet">
    <link href="https://code.furcode.cn/prism/css/prism.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://res.furcode.cn/iconicfont/1.3.0/css/iconmonstr-iconic-font.min.css" rel="stylesheet"/>
    <link href="https://res.furcode.cn/materialize/0.97.8/css/materialize.css" media="screen,projection" rel="stylesheet"/>
    <script type="text/javascript" src="https://res.furcode.cn/jquery/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://res.furcode.cn/materialize/0.97.8/js/materialize.min.js"></script>
    <script type="text/javascript" src="https://res.furcode.cn/jquery/lazyload/1.9.5/lazyload.min.js"></script>
    <script type="text/javascript" src="https://code.furcode.cn/prism/js/prism.js"></script>
</head>
<body>
<!--侧滑栏和顶部图片-->
<div class="parallax-container">
    <div class="parallax"><img alt="img_index_parallax" src="https://code.furcode.cn/images/parallax_index.jpg"></div>
    <nav  class="index_nav">
        <div class="nav-wrapper">
            <a class="brand-logo hide-on-large-only" href="/">Furcode</a>
            <a class="brand-logo hide-on-med-and-down logo-large" href="/">Furcode</a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="?ContextInfo=index">主页</a></li>
                <li><a href="?ContextInfo=about">关于</a></li>
                <li><a class="dropdown-button" href="javascript:void(0);" data-activates="dropdown1">分类<i class="material-icons right">arrow_drop_down</i></a></li>
                <li>
                    <ul id="dropdown1" class="dropdown-content">
                        <li><a href="?ContextInfo=static">静态资源</a></li>
                        <li><a href="?ContextInfo=game">游戏资源</a></li>
                        <li><a href="?ContextInfo=others">其他资源</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="side-nav ul-mobile" id="mobile-demo">
                <li <?php if ($ContextInfo == 'index') echo 'class="active"'; ?>><a class="waves-effect" href="?ContextInfo=index">主页</a></li>
                <li <?php if ($ContextInfo == 'about') echo 'class="active"'; ?>><a class="waves-effect" href="?ContextInfo=about">关于</a></li>
                <li><div class="divider" style="margin-bottom: 8px"></div></li>
                <li>
                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                            <a class="collapsible-header waves-effect waves-teal <?php if ($ContextInfo != 'index' && $ContextInfo != 'about') echo 'active'; ?>">分类</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li <?php if ($ContextInfo == 'static') echo 'class="active"'; ?>><a href="?ContextInfo=static">静态资源</a></li>
                                    <li <?php if ($ContextInfo == 'game') echo 'class="active"'; ?>><a href="?ContextInfo=game">游戏资源</a></li>
                                    <li <?php if ($ContextInfo == 'others') echo 'class="active"'; ?>><a href="?ContextInfo=others">其他资源</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <br><br><br><br><br><br>
    <h3 class="white-text center">兽码云</h3>
    <p class="white-text center">静态资源和其他资源存放地</p>
</div>
<?php
switch ($ContextInfo) {
    case 'index':
        include_once('index-main.php');
        break;
    case 'about':
        include_once('index-about.html');
        break;
    case 'static':
        include_once('index-static.php');
        break;
    case 'game':
        include_once('index-game.php');
        break;
    case 'others':
        include_once('index-others.php');
        break;
}
?>
<?php include_once('footer.html');?>
</body>
<script>
    $(function () {
        $("img.lazy").lazyload();
        $(".button-collapse").sideNav();
        $(".collapsible").collapsible();
        $('.parallax').parallax();
        $('.scrollspy').scrollSpy();
        $('.tabs-wrapper').pushpin({
            top: 600,
            bottom: Infinity,
            offset: 0
        });
    });
</script>
</html>

