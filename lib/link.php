<?php
/**
 * 获取资源的下载链接
 * User: nuotian <s235784@gmail.com>
 * Date: 2020/5/1
 * Time: 17:01
 * @param $url string xml文件的下载地址
 */

if (!defined('IN_SYS')) {
    header("Location: index.php?status=inaccessible");
    exit();
}

function getDownloadLink($url) { ?>
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
    <script>
        function getDlLink(param) {
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
                $(param).addClass('disabled');
                if (request.readyState === 4) {
                    if (request.status === 200) {
                        $(param).removeClass('disabled');
                        const type = param.getAttribute('type');
                        const source = param.getAttribute('source');
                        const link = $(request.responseText).find(type).find(source).children('url').text();
                        if (link == null) {
                            Materialize.toast('获取内容失败，错误' + "： link is null", 4000);
                            return;
                        }
                        const passwd = $(request.responseText).find(type).find(source).children('passwd').text();
                        if (passwd == null || typeof(passwd) == 'undefined' || passwd === '') {
                            openDownloadPage(link);
                        } else {
                            openDLPageWithPasswd(link, passwd);
                        }
                    } else {
                        Materialize.toast('获取内容失败，错误' + request.status, 4000);
                    }
                }
            };
            request.open('GET', '<?php echo $url; ?>', true);
            request.send();
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
<?php }