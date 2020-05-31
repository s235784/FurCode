<?php
/**
 * 主页
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
        <div class="row" style="margin-bottom: 0">
            <div class="col s12 m9 l10">
                <br>
                <div id="game-resource" class="section scrollspy">
                    <h4>游戏资源</h4>
                    <div class="divider" style="margin: 0 8px;"></div>
                    <?php include_once('content/main-game.html');?>
                </div>

                <div id="static-resource" class="section scrollspy">
                    <h4>静态资源</h4>
                    <div class="divider" style="margin: 0 8px;"></div>
                    <?php include_once('content/main-static.html');?>
                </div>

                <div id="others-resource" class="section scrollspy">
                    <h4>其他资源</h4>
                    <div class="divider" style="margin: 0 8px;"></div>
                    <?php include_once('content/main-others.html');?>
                </div>
            </div>
            <div class="col hide-on-small-only m3 l2">
                <div class="tabs-wrapper">
                    <div style="height: 1px;">
                        <ul class="section table-of-contents">
                            <li><a href="#game-resource">游戏资源</a></li>
                            <li><a href="#static-resource">静态资源</a></li>
                            <li><a href="#others-resource">其他资源</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <br>

    </div>
</main>