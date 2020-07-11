<aside class="block-aside">
    <div class="container-aside">
        <div class="aside-title">
            <span>Danh mục sản phẩm</span>
        </div>
        <div class="aside-box">
            <div class="menu">
                <div class="menu-body">
                    <nav class="side-menu">
                        <?php if (count($array_list)>0): ?>
                        <ul class="menu-list-s">
                            <?php foreach ($array_list as $key => $value): ?>
                            <li <?php if ($value['id']==$id_active): ?>
                                class="active"
                                <?php endif ?>>
                                <a href="<?php echo $value['link'] ?>" title="<?php echo $value['ten'] ?>">
                                    <?php echo $value['ten'] ?></a>
                                <?php if (count($value['cat']) > 0): ?>
                                <ul class="menu-cat-s">
                                    <?php foreach ($value['cat'] as $key2 => $value2): ?>
                                    <li>
                                        <a href="<?php echo $value2['link'] ?>" title="<?php echo $value2['ten'] ?>">
                                            <?php echo $value2['ten'] ?></a>
                                    </li>
                                    <?php endforeach ?>
                                </ul>
                                <?php endif ?>
                            </li>
                            <?php endforeach ?>
                        </ul>
                        <?php endif ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</aside>