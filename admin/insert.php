<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>

<body>
    <?php
    include_once "../lib/function.php";
    $user = new xuly();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['submit'])) {

            $error = array();

            //kiểm tra giá và số lượng là số dương
            if ($_POST['product_price'] < 0) {
                $error['product_price'] = 'Nhập > 0';
            }
            if ($_POST['product_quantity'] < 0) {
                $error['product_quantity'] = 'Nhập > 0';
            }

            //kiểm tra các trường
            if (empty($_POST['product_name'])) {
                $error['product_name'] = 'Không đc để trống';
            }
            if (empty($_POST['description'])) {
                $error['description'] = 'Không đc để trống';
            }

            //kiểm tra ảnh
            if (isset($_FILES['image'])) {
                if ($_FILES['image']['error'] > 0) {
                } else {
                    $image = $_FILES['image']['name'];
                    $img_tmp = $_FILES['image']['tmp_name'];
                    move_uploaded_file($img_tmp, '../img/' . $image);
                }
            }

            //nếu không có lỗi thì chèn vào bảng
            if (empty($error)) {
                $user->insert($_POST['product_name'], $_POST['product_price'], $_POST['product_quantity'], $image, $_POST['description']);
            }
        }
    }


    ?>
    <div class="container">

        <form action="" enctype="multipart/form-data" method="post">

            <label for="">product_name</label>
            <input type="text" name="product_name" class="form-control">
            <!-- //hiển thị lỗi ra màn hình -->
            <?php if (isset($error['product_name'])) { ?>
                <span style="color: red;"> <?php echo $error['product_name'] ?> </span>
            <?php } ?><br>

            <label for="">product_price</label>
            <input type="number" name="product_price" class="form-control">
            <!-- //hiển thị lỗi ra màn hình -->
            <?php if (isset($error['product_price'])) { ?>
                <span style="color: red;"> <?php echo $error['product_price'] ?> </span>
            <?php } ?><br>

            <label for="">product_quantity</label>
            <input type="number" name="product_quantity" class="form-control">
            <!-- //hiển thị lỗi ra màn hình -->
            <?php if (isset($error['product_quantity'])) { ?>
                <span style="color: red;"> <?php echo $error['product_quantity'] ?> </span>
            <?php } ?><br>

            <label for="">product_image</label>
            <input type="file" name="image" class="form-control">
            <!-- //hiển thị lỗi ra màn hình -->
            <?php  if (isset($_FILES['image']['error']) > 0) { ?>
                <span style="color: red;"> <?php echo "Không đc để trống" ?> </span>
            <?php } ?><br>

            <label for="">description</label>
            <input type="text" name="description" class="form-control">
            <!-- //hiển thị lỗi ra màn hình -->
            <?php if (isset($error['description'])) { ?>
                <span style="color: red;"> <?php echo $error['description'] ?> </span>
            <?php } ?><br>

            <button type="submit" name="submit" class="btn btn-dark">Insert</button>
        </form>
    </div>
</body>

</html>