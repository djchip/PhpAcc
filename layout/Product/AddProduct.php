<?php
if (!function_exists('create_slug')) {
    function create_slug($string)
    {
        $search = array(
            '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
            '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
            '#(ì|í|ị|ỉ|ĩ)#',
            '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
            '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
            '#(ỳ|ý|ỵ|ỷ|ỹ)#',
            '#(đ)#',
            '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
            '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
            '#(Ì|Í|Ị|Ỉ|Ĩ)#',
            '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
            '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
            '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
            '#(Đ)#',
            "/[^a-zA-Z0-9\-\_]/",
        );
        $replace = array(
            'a',
            'e',
            'i',
            'o',
            'u',
            'y',
            'd',
            'A',
            'E',
            'I',
            'O',
            'U',
            'Y',
            'D',
            '-',
        );
        $string = preg_replace($search, $replace, $string);
        $string = preg_replace('/(-)+/', '-', $string);
        $string = strtolower($string);
        return $string;
    }
}
?>
<?php
        include "../connectSQL.php";
        
        // thêm product
        $productName = $_POST['productName'];
        $productPrice = $_POST['productPrice'];
        $short_desc = $_POST['short_desc'];
        $long_desc = $_POST['long_desc'];
        //hinh anh

        $name_img = stripslashes($_FILES['productImage']['name']);
        $source_img = $_FILES['productImage']['tmp_name'];
        $path_img = "../../img/" . $name_img;

        $productActive = $_POST['productActive'];
        $productHot = $_POST['productHot'];
        $productQuantity = $_POST['productQuantity'];
        $categoryId = $_POST['categoryName'];
        $slug = create_slug($productName);
        if(isset($_POST['save'])){
            $sql = "INSERT INTO products (name ,price, short_desc, long_desc, thumb, active, slug, hot, quantity, category_id) VALUES ('$productName',$productPrice,'$short_desc','$long_desc','$name_img',$productActive,'$slug',$productHot,$productQuantity, $categoryId)";
            //move_uploaded_file($hinhanh_tmp,'uploads/' .$hinhanh);
            move_uploaded_file($source_img, $path_img);
            $qr = mysqli_query($conn, $sql);
        }
        $sql_category = "select * from categories";
        $query_category = mysqli_query($conn, $sql_category);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/AddCategories.css">
    <link rel="stylesheet" href="../../css/Dasboard.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
</head>
<body>
    <?php  include '../common/header.php'?>
    <main>
    <?php  include '../common/left.php '?>
        <div class="right">
            <h1>Add Product</h1>
            <h2><a href="#">Dasboard</a>/Add Product</h2>
            <div class="content_basic">
                <p>Basic info</p>
                <hr/>
                <form method ="POST" action="" enctype = "multipart/form-data">
                    <label for="CategoryName">Tên sản phẩm : </label><br/>
                    <input type="text" name="productName" class="col-6"><br/>
                    <label for="CategoryName">Giá : </label><br/>
                    <input type="text" name="productPrice" class="col-6"><br/>
                    <label for="CategoryName">Mô tả ngắn : </label><br/>
                    <input type="text" name="short_desc" class="col-6"><br/>
                    <label for="CategoryName">Mô tả dài : </label><br/>
                    <input type="text" name="long_desc" class="col-6"><br/><br>
                    <label for="CategoryName">Hình ảnh : </label>
                    <input type="file" name="productImage" accept="image/*" class="col-6"><br/>
                    <label for="CategoryName">Trạng thái : </label>
                    <input checked="checked" name="productActive" type="radio" value="1" />Có
                    <input name="productActive" type="radio" value="0" />Không <br>
                    <label for="CategoryName">Sản phẩm hot : </label>
                    <input checked="checked" name="productHot" type="radio" value="1" />Có
                    <input name="productHot" type="radio" value="0" />Không <br>
                    <label for="CategoryName">Số lượng : </label><br/>
                    <input type="text" name="productQuantity" class="col-6"><br/>
                    <label for="danhmuc">Danh mục : </label><br>
                    <select name = "categoryName">
                        <?php
                            while($row_category = $query_category->fetch_assoc()){
                        ?>
                            <option value="<?php echo $row_category['id'] ?>"><?php echo $row_category['name'] ?></option>
                        <?php } ?>
                    </select>
                    <br><input type="submit" name="save" value="Lưu" class="end text-right" style="height:30px;line-height:30px;">
                </form>
            </div>
        </div>
    </main>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="./../../../bai9_jquery/bai9_jquery/js/jquery.min.js"></script>
<script src="./../../script/Dasboard.js"></script>

</html>

