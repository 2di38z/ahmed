<?php
include('config.php'); // الاتصال بقاعدة البيانات

if (isset($_POST['update'])) {
    // التحقق من أن `id` موجود وغير فارغ ويحتوي على رقم صحيح
    if (!isset($_POST['id']) || empty($_POST['id']) || !ctype_digit($_POST['id'])) {
        die("<script>alert('❌ خطأ: رقم المنتج غير صحيح!')</script>");
    }

    $ID = intval($_POST['id']); // تحويل `id` إلى عدد صحيح

    // التحقق من أن `id` ليس صفرًا أو عددًا غير صالح
    if ($ID <= 0) {
        die("<script>alert('❌ خطأ: رقم المنتج غير صالح!')</script>");
    }

    // جلب البيانات الأخرى وتعقيمها
    $NAME = isset($_POST['name']) ? trim($_POST['name']) : "";
    $PRICE = isset($_POST['price']) ? floatval($_POST['price']) : 0;

    // التحقق من أن `name` غير فارغ
    if (empty($NAME)) {
        die("<script>alert('❌ خطأ: اسم المنتج لا يمكن أن يكون فارغًا!')</script>");
    }

    // تنظيف `name` لمنع XSS
    $NAME = htmlspecialchars($NAME, ENT_QUOTES, 'UTF-8');

    // التحقق من أن `price` رقم موجب
    if ($PRICE <= 0) {
        die("<script>alert('❌ خطأ: السعر يجب أن يكون رقمًا موجبًا!')</script>");
    }

    // التحقق من رفع الصورة (إذا تم إرسال صورة جديدة)
    $image_up = ""; 
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif']; // الامتدادات المسموحة
        $image_name = basename($_FILES['image']['name']);
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

        // التحقق من امتداد الصورة
        if (!in_array($image_ext, $allowed_extensions)) {
            die("<script>alert('❌ خطأ: امتداد الصورة غير مسموح به!')</script>");
        }

        // التحقق من حجم الصورة (يجب أن يكون أقل من 5MB)
        if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
            die("<script>alert('❌ خطأ: حجم الصورة كبير جدًا! الحد الأقصى 5MB.')</script>");
        }

        // تحديد اسم جديد للملف لمنع التعارض
        $new_image_name = uniqid("img_", true) . "." . $image_ext;
        $image_up = "images/" . $new_image_name;

        // نقل الصورة إلى المجلد المحدد
        if (!move_uploaded_file($image_tmp, $image_up)) {
            die("<script>alert('❌ خطأ: فشل رفع الصورة!')</script>");
        }
    }

    // تحديث البيانات باستخدام استعلام محضر لمنع SQL Injection
    if ($image_up) {
        $query = "UPDATE prod SET name=?, price=?, image=? WHERE id_prod=?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "sdsi", $NAME, $PRICE, $image_up, $ID);
    } else {
        $query = "UPDATE prod SET name=?, price=? WHERE id_prod=?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "sdi", $NAME, $PRICE, $ID);
    }

    // تنفيذ الاستعلام والتحقق من نجاحه
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('✅ تم تحديث المنتج بنجاح!'); window.location.href='index.php';</script>";
        exit();
    } else {
        die("<script>alert('❌ خطأ في التحديث: " . mysqli_error($con) . "')</script>");
    }
}
?>
