<!-- sidebar menu area start -->
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="dashboard.php">
                <h4 style="color:white; font-size: 30px;">ระบบวัสดุคงคลัง IT</h4>
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <?php if ($_SESSION['ulevel'] == 'admin') { ?>
                        <!-- admin level -->
                        <li class="">
                            <a href="home.php" aria-expanded="true"><i class="ti-dashboard"></i><span>หน้าหลัก</span></a>
                        </li>
                        <li>
                            <a href="manage-member.php" aria-expanded="true"><i class="ti-user"></i><span>จัดการบุคคลากร</span></a>
                        </li>
                        <li>
                            <a href="manage-office.php" aria-expanded="true"><i class="ti-pin-alt"></i><span>จัดการหน่วยงาน</span></a>
                        </li>
                        <li class="">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>แดชบอร์ด</span></a>
                            <ul class="collapse">
                                <li><a href="dashboard_admin.php">ดูแดชบอร์ด</a></li>
                                <li><a href="graph.php">ดูรายงานกราฟ</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-printer"></i><span>วัสดุ</span></a>
                            <ul class="collapse">
                                <li><a href="manage-tool.php">จัดการวัสดุ</a></li>
                                <li><a href="manage-tool-type.php">จัดการประเภทวัสดุ</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-printer"></i><span>รายงานเบิก - จ่าย</span></a>
                            <ul class="collapse">
                                <li><a href="history-report.php">ประวัติการเบิก - จ่าย</a></li>
                                <li><a href="report.php">รายงานเบิก - จ่าย /รายเดือน</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="logout.php" aria-expanded="true"><i class="ti-power-off"></i><span>ออกจากระบบ</span></a>
                        </li>
                        <!-- admin level -->
                    <?php } else if ($_SESSION['ulevel'] == 'member') { ?>
                        <!-- member level -->
                        <li class="">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>แดชบอร์ด</span></a>
                            <ul class="collapse">
                                <li><a href="dashboard_admin.php">ดูแดชบอร์ด</a></li>
                                <li><a href="graph.php">ดูรายงานกราฟ</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-printer"></i><span>รายงานเบิก - จ่าย</span></a>
                            <ul class="collapse">
                                <li><a href="history-report.php">ประวัติการเบิก - จ่าย</a></li>
                                <li><a href="report.php">รายงานเบิก - จ่าย /รายเดือน</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="logout.php" aria-expanded="true"><i class="ti-power-off"></i><span>ออกจากระบบ</span></a>
                        </li>
                        <!-- member level -->
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->