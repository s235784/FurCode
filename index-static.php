<?php
/**
 * 静态资源界面
 * User: nuotian <s235784@gmail.com>
 * Date: 2020/1/21
 * Time: 17:01
 */

if (!defined('IN_SYS')) {
    header("Location: index.php?status=inaccessible");
    exit();
}
?>
<main id="main">
    <div class="container" id="main-container">
        <div class="col s12 m9 l10">
            <br>
            <div>
                <h4>静态资源</h4>
                <div class="divider" style="margin: 0 8px;"></div>
                <?php include_once('content/main-static.html');?>
            </div>
    </div>
</main>
