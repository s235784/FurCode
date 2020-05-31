<?php
/**
 * 下载界面
 * User: nuotian <s235784@gmail.com>
 * Date: 2020/5/30
 * Time: 17:58
 */

if (empty($_GET['source'])) {
    header("Location: index.php?status=sourceNull");
} else if ($_GET['source'] == null) {
    header("Location: index.php?status=sourceNull");
} else {
    $source = $_GET['source'];
}
?>
<!--
     _   _             _______  _
    | \ | |           |__   __|(_)
    |  \| | _   _   ___  | |    _   __ _  _ __
    | . ` || | | | / _ \ | |   | | / _` || '_ \
    | |\  || |_| || (_) || |   | || (_| || | | |
    |_| \_| \__,_| \___/ |_|   |_| \__,_||_| |_|

    Author: NuoTian (https://nuotian.furry.pro)

-->

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>兽码云 - 下载</title>
    <meta charset="utf-8">
    <meta name="Keywords" content="静态资源,下载站,诺天,兽人,JavaScript,CSS,FurryCafe,Furry,NuoTian,s235784"/>
    <meta name="description" content="静态资源和其他资源下载站"/>
    <meta name="theme-color" content="#0288D1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="https://cafe.furcode.cn/favicon_32.ico">
    <link href="styles.css" rel="stylesheet">
    <link href="https://code.furcode.cn/prism/css/prism.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://res.furcode.cn/iconicfont/1.3.0/css/iconmonstr-iconic-font.min.css" rel="stylesheet"/>
    <link href="https://res.furcode.cn/materialize/0.97.8/css/materialize.css" media="screen,projection" rel="stylesheet"/>
    <script type="text/javascript" src="https://res.furcode.cn/jquery/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://res.furcode.cn/materialize/0.97.8/js/materialize.min.js"></script>
    <script type="text/javascript" src="https://res.furcode.cn/jquery/lazyload/1.9.5/lazyload.min.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-149898603-4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-149898603-4');
    </script>
</head>
<body>
<div class="parallax-container">
    <div class="parallax"><img alt="img_index_parallax" src="https://code.furcode.cn/images/parallax_index.jpg"></div>
    <nav class="index_nav">
        <div class="nav-wrapper">
            <a class="brand-logo hide-on-large-only" href="/">Furcode</a>
            <a class="brand-logo hide-on-med-and-down logo-large" href="/">Furcode</a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="index.php?ContextInfo=index">主页</a></li>
                <li><a href="index.php?ContextInfo=about">关于</a></li>
            </ul>
            <ul class="side-nav ul-mobile" id="mobile-demo">
                <li><a class="waves-effect" href="index.php?ContextInfo=index">主页</a></li>
                <li><a class="waves-effect" href="index.php?ContextInfo=about">关于</a></li>
            </ul>
        </div>
    </nav>
    <br><br><br><br><br><br>
    <h3 class="white-text center">兽码云</h3>
    <p class="white-text center">静态资源和其他资源存放地</p>
</div>
<main>
    <br>
    <div class="container">
        <div class="row" style="margin-bottom: 0">
            <div class="col s12 m9 l10">
                <div id="download-source" class="section scrollspy">
                    <h4>下载资源</h4>
                    <div class="divider" style="margin: 0 8px;"></div>
                    <div style="margin: 12px 20px;">
                        <div id="div-loading">
                            <div class="progress" id="progress-loading">
                                <div class="indeterminate"></div>
                            </div>
                            <p>获取下载链接中，请稍后……</p>
                        </div>
                        <div id="div-failed">
                            <p>很抱歉，加载链接时出现了错误，请稍后再试……</p>
                        </div>
                        <div id="div-succeed">
                            <h5 style="margin-bottom: 0; margin-top: 15px" id="div-succeed-title"></h5>
                            <p>点击下方任意按钮开始下载</p>
                            <p id="div-succeed-intro"></p>
                            <div id="div-succeed-source"></div>
                        </div>
                    </div>
                    <div class="right">
                        <a class="waves-effect waves-light btn download-btn" href="index.php#<?php echo 'div-'.$source; ?>">返回主页</a>
                    </div>
                </div>
            </div>
            <div class="col hide-on-small-only m3 l2">
                <div class="tabs-wrapper">
                    <div style="height: 1px;">
                        <ul class="section table-of-contents">
                            <li>
                                <a href="index.php?ContextInfo=index" class="table-of-contents-first">主页</a>
                            </li>
                            <li><a href="#download-source">下载资源</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<br>
<?php include_once('content/footer.html');?>
</body>
<script>
    $(function () {
        $("img.lazy").lazyload();
        $(".button-collapse").sideNav();
        $('.parallax').parallax();
        $('.scrollspy').scrollSpy();
        $('.tabs-wrapper').pushpin({
            top: 600,
            bottom: Infinity,
            offset: 0
        });

        getLink("<?php echo 'https://code.furcode.cn/dl/source/'. $source .'.xml'; ?>")
    });


    const source_list = [];

    function getLink(url) {
        $("#div-failed").hide();
        let request;
        try {
            request = new XMLHttpRequest();
        } catch(e) {
            try {
                request = new ActiveXObject('Msxml2.XMLHTTP');
            } catch(e) {
                request = new ActiveXObject('Microsoft.XMLHTTP');
            }
        }
        request.onreadystatechange = function() {
            if (request.readyState === 4) {
                $("#div-loading").hide();
                if (request.status === 200) {
                    const xml = $.parseXML(request.responseText)

                    $(xml).find("source").each(function (i) {
                        const source_name = $(this).children("name").text();
                        const source_url = $(this).children("url").text();
                        const source_passwd = $(this).children("passwd").text();

                        let source_map = new Map();
                        source_map.set("url", source_url);
                        source_map.set("passwd", source_passwd);
                        source_list[i] = source_map;

                        let val = '<a class="waves-effect waves-teal btn-flat btn-blue-text" style="margin-top: 10px" index="'
                            + i + '" onclick="startDL(this)">' + source_name + '</a><br>';
                        $("#div-succeed-source").append(val);
                    });

                    const file_name = $(xml).find("file").children("name").text();
                    const file_intro = $(xml).find("file").children("intro").text();
                    $("#div-succeed-title").text(file_name);
                    $("#div-succeed-intro").text(file_intro);
                } else {
                    Materialize.toast('获取内容失败，错误' + request.status, 4000);
                    $("#div-failed").show();
                    $("#div-succeed").hide();
                }
            }
        };
        request.open('GET', url, true);
        request.send();
    }

    function startDL(param) {
        console.log(source_list);
        const index = param.getAttribute("index");
        const source_map = source_list[index];
        const url = source_map.get("url");
        const passwd = source_map.get("passwd");
        if (passwd == null || typeof(passwd) == 'undefined' || passwd === '') {
            openDownloadPage(url);
        } else {
            openDLPageWithPasswd(url, passwd);
        }
    }

    function openDLPageWithPasswd(url ,passwd) {
        const aux = document.createElement("input");
        aux.setAttribute("value", passwd);
        document.body.appendChild(aux);
        aux.select();
        document.execCommand("copy");
        document.body.removeChild(aux);

        Materialize.toast('将在4秒后打开界面', 4000, '', function () {
            openDownloadPage(url);
        });
        setTimeout(function () {
            Materialize.toast('提取码为：' + passwd + '（已复制）', 4000);
        }, 500);
    }

    function openDownloadPage(url) {
        const windowOpen = window.open(url, '_blank');
        if (windowOpen == null || typeof(windowOpen) == 'undefined') {
            $('#modal-voice-open').attr('href', url);
            $('#modal-voice-dl').modal('open');
        }
    }
</script>

<div id="modal-voice-dl" class="modal">
    <div class="modal-content">
        <h4>打开失败</h4>
        <p>您的浏览器似乎阻止了新窗口的弹出，点击“打开“弹出新窗口，点击“关闭”关闭窗口</p>
    </div>
    <div class="modal-footer">
        <a id="modal-voice-open" class="modal-action modal-close waves-effect waves-green btn-flat">打开</a>
        <a class="modal-action modal-close waves-effect waves-green btn-flat">关闭</a>
    </div>
</div>

</html>
