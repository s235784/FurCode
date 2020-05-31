<?php
/**
 * 其他资源界面
 * User: nuotian <s235784@gmail.com>
 * Date: 2020/1/21
 * Time: 17:02
 */

if (!defined('IN_SYS')) {
    header("Location: index.php?status=inaccessible");
    exit();
}
?>
<main id="main">
    <br>
    <div class="container" id="main-container">
        <br>
        <div>
            <h4>其他资源</h4>
            <div class="divider" style="margin: 0 8px;"></div>
            <?php include_once('content/main-others.html');?>
        </div>
    </div>
    <br>
</main>