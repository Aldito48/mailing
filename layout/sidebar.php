<div class="sidebar">
    <a href="<?=base_url()?>dashboard.php" class="sidebar-brand">
        <img src="<?=base_url()?>storage/blank-pp.jpg" alt="" class="sidebar-brand-image" />
        <span class="sidebar-brand-text"><?=strtoupper($_SESSION['role'])?></span>
    </a>
    <div class="sidebar-menu-wrapper">
        <ul class="sidebar-menu">
            <li class="sidebar-menu-title">
                <span class="sidebar-menu-title-expanded">MENU</span>
                <span class="sidebar-menu-title-collapsed"><i class="ri-more-fill"></i></span>
            </li>
            <?php
                $qMenu = "SELECT * FROM tbl_menu WHERE is_active = 'YES' ORDER BY sort ASC";
                $resMenu = mysqli_query($con, $qMenu) or die(mysqli_error($con));
                if (mysqli_num_rows($resMenu) > 0) {
                    while ($dataMenu = mysqli_fetch_array($resMenu)) {
                        $accessRoles = json_decode($dataMenu['access'], true);
                        if (in_array($_SESSION['role'], $accessRoles)) {
            ?>
                            <li class="sidebar-menu-item">
                                <a href="<?=base_url().$dataMenu['page']?>" class="sidebar-menu-item-link">
                                    <span class="sidebar-menu-item-link-icon">
                                        <i class="<?=$dataMenu['icon']?>"></i>
                                    </span>
                                    <span class="sidebar-menu-item-link-text"><?=$dataMenu['name']?></span>
                                </a>
                            </li>
            <?php
                        }
                    }
                }
            ?>
        </ul>
    </div>
    <footer class="sidebar-footer">
        <small>Powered by</small>
        <br>
        <span>- DITO -</span>
    </footer>
</div>
<div class="sidebar-overlay" data-sidebar-dismiss=""></div>