<?php
        include "../connectSQL.php";
        $productId = $_POST['productName'];
        foreach($_FILES['img_file']['name'] as $name => $value){
            $name_img = stripslashes($_FILES['img_file']['name'][$name]);
            $source_img = $_FILES['img_file']['tmp_name'][$name];
            $path_img = "uploads/" . $name_img;
            if(isset($_POST['save'])){
                $sql = "INSERT INTO product_images (image_url, product_id) VALUES ('$name_img',$productId)";
                move_uploaded_file($source_img, $path_img);
                $qr = mysqli_query($conn, $sql);
                }
        }
        $sql_productName = "select * from products";
        $query_productName = mysqli_query($conn, $sql_productName);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/AddCategories.css">
    <link rel="stylesheet" href="../../css/Dasboard.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <style>
        .progress{
            padding: 2px; border: 1px solid #e5e5e5; border-radius: 4px; margin-bottom: 10px; display: none;
        }
        .progress-bar{
            background-color: #428bca; color: #fff; text-align: center; border-radius: 4px; padding: 2px 0; width: 0;
        }
        input[type=file] {display: block; font-size: 14px;}
        button.btn-reset {background-color: #fff; border: 2px solid #ccc; color: #444;}
        .output {display: none; background-color: #d9534f; color: #fff; padding: 7px; border-radius: 4px; margin-top: 10px;}
        .success {background-color: #5cb85c;}
        .box-preview-img {margin-top: 10px; display: none;}
        .box-preview-img p {font-weight: bold;}
        .box-preview-img img {width: 90px; height: 90px; border: 1px solid #e5e5e5; margin-right: 5px; margin-top: 5px;}
    </style>
</head>
<body>
    <?php  include '../common/header.php'?>
    <main>
    <?php  include '../common/left.php '?>
        <div class="right">
            <h1>Add Product Images</h1>
            <h2><a href="#">Dasboard</a>/Add Product Images</h2>
            <div class="content_basic">
                <p>Basic info</p>
                <hr/>
                <form method ="POST" id="formUpload" action="" enctype = "multipart/form-data">
                <label for="danhmuc">Tên sản phẩm : </label><br>
                    <select name = "productName">
                        <?php
                            while($row_productName = $query_productName->fetch_assoc()){
                        ?>
                            <option value="<?php echo $row_productName['id'] ?>"><?php echo $row_productName['name'] ?></option>
                        <?php } ?>
                    </select>
                <br>
                <div class="progress">
                    <div class="progress-bar"></div>
                </div>
                    <label for="">Chọn ảnh: </label><br/>
                    <input type="file" id="img_file" name="img_file[]" multiple="true" accept="image/*" onchange="previewImg(event);" class="col-6"><br/>
                    <div class="box-preview-img"></div>
                    <button type="reset" class="btn-reset">Bỏ chọn tất cả</button>
                    <br>
                    <input type="submit" class="btn-submit" name="save" value="Lưu" class="end text-right" style="height:30px;line-height:30px;">
                    <div class="output"></div>
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
<script>
    // Xem hình ảnh trước khi upload
    function previewImg(event) {
        // Gán giá trị các file vào biến files
        var files = document.getElementById('img_file').files;
        // Show khung chứa ảnh xem trước
        $('#formUpload .box-preview-img').show();
        // Thêm chữ "Xem trước" vào khung
        $('#formUpload .box-preview-img').html('<p>Xem trước</p>');
        // Dùng vòng lặp for để thêm các thẻ img vào khung chứa ảnh xem trước
        for (i = 0; i < files.length; i++)
        {
            // Thêm thẻ img theo i
            $('#formUpload .box-preview-img').append('<img src="" id="' + i +'" width=90px >');
            // Thêm src vào mỗi thẻ img theo id = i
            $('#formUpload .box-preview-img img:eq('+i+')').attr('src', URL.createObjectURL(event.target.files[i]));
        }   
    }
    // Nút reset form upload
    $('#formUpload .btn-reset').on('click', function() {
        // Làm trống khung chứa hình ảnh xem trước
        $('#formUpload .box-preview-img').html('');
    
        // Hide khung chứa hình ảnh xem trước
        $('#formUpload .box-preview-img').hide();
    
        // Hide khung hiển thị kết quả
        $('#formUpload .output').hide();
    });
// Xử lý ảnh và upload
$('#formUpload .btn-submit').on('click', function() {
    // Gán giá trị của nút chọn tệp vào var img_file
    $img_file = $('#formUpload #img_file').val();
 
    // Cắt đuôi của file để kiểm tra
    $type_img_file = $('#formUpload #img_file').val().split('.').pop().toLowerCase();
 
    // Nếu không có ảnh nào
    if ($img_file == '')
    {
        // Show khung kết quả
        $('#formUpload .output').show();
 
        // Thông báo lỗi
        $('#formUpload .output').html('Vui lòng chọn ít nhất một file ảnh.');
    }
    // Ngược lại nếu file ảnh không hợp lệ với các đuôi bên dưới
    else if ($.inArray($type_img_file, ['png', 'jpeg', 'jpg', 'gif']) == -1)
    {
        // Show khung kết quả
        $('#formUpload .output').show();
 
        // Thông báo lỗi
        $('#formUpload .output').html('File ảnh không hợp lệ với các đuôi .png, .jpeg, .jpg, .gif.');
    }
    // Ngược lại
    else
    {
        // Tiến hành upload 
        $('#formUpload').ajaxSubmit({ 
            // Trước khi upload
            beforeSubmit: function() {
                target:   '#formUpload .output',
 
                // Ẩn khung kết quả
                $('#formUpload .output').hide();
 
                // Show thanh tiến trình
                $("#formUpload .progress").show();
 
                // Đặt mặc định độ dài thanh tiến trình là 0
                $("#formUpload .progress-bar").width('0');
            },
 
            // Trong quá trình upload
            uploadProgress: function(event, position, total, percentComplete){ 
                // Kéo dãn độ dài thanh tiến trình theo % tiến độ upload
                $("#formUpload .progress-bar").css('width', percentComplete + '%');
 
                // Hiển thị con số % trên thanh tiến trình
                $("#formUpload .progress-bar").html(percentComplete + '%');
            },
            // Sau khi upload xong
            success: function() {    
                // Show khung kết quả 
                $('#formUpload .output').show();
 
                // Thêm class success vào khung kết quả
                $('#formUpload .output').addClass('success');
 
                // Thông báo thành công
                $('#formUpload .output').html('Upload ảnh thành công.');
            },
            // Nếu xảy ra lỗi
            error : function() {
                // Show khung kết quả
                $('#formUpload .output').show();
 
                // Thông báo lỗi
                $('#formUpload .output').html('Không thể upload ảnh vào lúc này, hãy thử lại sau.');
            }
        }); 
        return false; 
    }
});
</script>
</html>

