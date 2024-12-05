<div class="topbar">
    <button type="button" class="btn btn-icon btn-light topbar-sidebar-toggle" data-sidebar-toggle><i class="ri-menu-line"></i></button>
    <div class="topbar-search-wrapper">
        <button type="button" class="btn btn-icon btn-light topbar-search-back" data-dismiss="topbar-search">
            <i class="ri-arrow-left-line"></i>
        </button>
        <form class="topbar-search" onsubmit="return false;">
            <input type="text" id="search-input" class="form-control" placeholder="Search..." />
            <span class="topbar-search-icon"><i class="ri-search-line"></i></span>
            <ul id="search-results"></ul>
        </form>
    </div>
    <div class="topbar-right">
        <div>
            <h4><?=$_SESSION['user']?></h4>
        </div>
        <button type="button" class="btn btn-icon btn-light topbar-right-item-search" data-toggle="topbar-search">
            <i class="ri-search-line"></i>
        </button>
        <div class="dropdown">
            <button type="button" class="btn btn-icon btn-light topbar-right-item">
                <img src="https://flagsapi.com/ID/shiny/64.png" class="topbar-right-item-image" />
            </button>
        </div>
        <div class="dropdown">
            <button type="button" class="btn btn-icon btn-light topbar-right-item" data-toggle="dropdown">
                <i class="ri-notification-3-line"></i>
                <span class="topbar-right-item-total">2</span>
            </button>
            <div class="dropdown-menu-wrapper">
                <div class="dropdown-content">
                    <div class="dropdown-content-header">
                        <p class="dropdown-content-title">Notification</p>
                    </div>
                    <div class="dropdown-content-body">
                        <div class="dropdown-notification-wrapper">
                            <a href="#" class="dropdown-notification-item">
                                <span class="dropdown-notification-item-icon primary-soft">
                                    <i class="ri-history-line"></i>
                                </span>
                                <p class="dropdown-notification-item-title">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                <p class="dropdown-notification-item-time">4 days ago</p>
                            </a>
                            <a href="#" class="dropdown-notification-item">
                                <span class="dropdown-notification-item-icon danger-soft">
                                    <i class="ri-history-line"></i>
                                </span>
                                <p class="dropdown-notification-item-title">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                <p class="dropdown-notification-item-time">4 days ago</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dropdown">
            <button type="button" class="btn btn-icon btn-light topbar-right-item" data-toggle="dropdown">
                <img src="<?=base_url()?>storage/blank-pp.jpg" alt="" class="topbar-right-item-user-image" />
            </button>
            <div class="dropdown-menu-wrapper">
                <ul class="dropdown-menu">
                    <li class="dropdown-menu-item">
                        <a href="<?=base_url()?>profile.php" class="dropdown-menu-item-link">
                            <span class="dropdown-menu-item-link-icon"><i class="ri-user-line"></i></span>
                            <span class="dropdown-menu-item-link-text">Profile</span>
                        </a>
                    </li>
                    <li class="dropdown-menu-item">
                        <a href="<?=base_url()?>logout.php" class="dropdown-menu-item-link">
                            <span class="dropdown-menu-item-link-icon"><i class="ri-logout-circle-line"></i></span>
                            <span class="dropdown-menu-item-link-text">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>