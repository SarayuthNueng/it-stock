<?php session_start(); ?>
<?php
include "db/connect-db.php";

$sql = "SELECT * FROM type_stock";
$type = $conn->query($sql);

?>

<?php

if (!$_SESSION["user_id"]) {  //check session

    Header("Location: index.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 

} else { ?>
    <?php include 'components/head.php' ?>
    <!-- page container area start -->
    <div class="page-container">

        <?php include 'components/sidebar.php' ?>

        <!-- main content area start -->
        <div class="main-content">
            <?php include 'components/header.php' ?>
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">เพิ่มวัสดุ</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="home.php">หน้าหลัก</a></li>
                                <li><span>เพิ่มวัสดุ</span></li>
                            </ul>
                        </div>
                    </div>
                    <?php include 'components/username.php' ?>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="header-title">เพิ่มวัสดุ</h4>
                                </div>
                            </div>
                            <form action="manage-tool-addsave.php" method="POST" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-lg-4">
                                        <label class="col-form-label">ชื่อวัสดุ</label>
                                        <input type="text" id="m_name" name="m_name" class="form-control" placeholder="ชื่อวัสดุ" required>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="col-form-label">ราคา</label>
                                        <input type="text" id="m_price" name="m_price" class="form-control" placeholder="ราคา" required>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="col-form-label">ประเภทวัสดุ</label>
                                        <select class="custom-select" name="m_s_id" id="m_s_id">
                                            <option selected="selected">กรุณาเลือก</option>
                                            <?php foreach ($type as $ty) : ?>
                                                <option value="<?= $ty['s_id']; ?>"><?= $ty['s_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="row mt-3">
                                    <div class="col-lg-4">
                                        <label class="col-form-label">จำนวน</label>
                                        <input type="text" class="form-control" id="m_number" name="m_number" placeholder="จำนวน" required>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="col-form-label">วันที่รับเข้า</label>
                                        <input type="date" id="m_date" name="m_date" class="form-control" placeholder="วันที่รับเข้า" required>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="col-form-label">เวลาที่รับเข้า</label>
                                        <input type="time" id="m_time" name="m_time" class="form-control" placeholder="เวลาที่รับเข้า" required>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-lg-6">
                                        <label class="col-form-label">รายละเอียด</label>
                                        <textarea class="form-control" type="text" name="m_detail" placeholder="รายละเอียด" id="m_detail" rows="2"></textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="col-form-label">รูปภาพ</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary" type="button">อัพโหลดรูปภาพ</button>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="m_image" onchange="readURL(this)" accept="image/jpeg, image/jpg, image/png">
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
                                            <div id="imgControl" class="d-none">
                                                <img id="imgUpload" class="my-3 w-50" alt="">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row justify-content-center mb-5 mt-3">
                                    <div class="col-md-2">
                                        <button type="button" onclick="history.back(-1)" class="btn btn-secondary btn-block"><i class="fa fa-times"></i> ย้อนกลับ</button>
                                    </div>
                                    <div class="col-md-2">
                                        <button name="submit" type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> บันทึก</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main content area end -->

        <?php include 'components/footer.php' ?>

    <?php } ?>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                document.querySelector('#imgControl').classList.replace("d-none", "d-block");
                reader.onload = function(e) {
                   let element = document.querySelector('#imgUpload');
                   element.setAttribute("src", e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>