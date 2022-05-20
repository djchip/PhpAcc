<?php 
    include "../connectSQL.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $sql_up = "select * from products";
    $query_up = $conn->query($sql_up);
    //var_dump($query);
    $row_up = mysqli_fetch_assoc($query_up);
    $sql = "select * from products where id = $id";
    $query = $conn->query($sql);
    //var_dump($query);
    $row = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/Dasboard.css">
    <link rel="stylesheet" href="../../css/ListCategories.css">
    <style>
        .blue{
            background-color: #ff6f0c;
            border-style: none;
            padding: 10px 15px;
            border-radius: 5px;
        }
        .blue a{
            color: white;
        }
    </style>
</head>
<body>
    <?php include '../common/header.php'?>
    <main>
        <?php include '../common/left.php'?>
        <div class="right">
            <h1>Details Product Images</h1>

            <h2><a href="#">Dasboard</a>/Details Product Images</h2>
            <div><button class="blue"><a href='./AddproductImages.php'>Thêm ảnh</a></button></div>
            <br>
            <div class="bang">
                <table class="table table-bordered" >
                <h3>Product Images: <?php echo $row['name'] ?></h3>
                    <thead>
                        <th width = 100px>STT</th>
                        <th>Images</th>
                        <th width = 100px>Action</th>
                    </thead>
                    <tbody>
                        <?php
                            
                            $sql = "select * from product_images join products on product_images.product_id = products.id where product_images.product_id = $id";
                            $query = $conn->query($sql);
                            $i = 0;
                            while($row = $query->fetch_row()) {
                                $i++;
                                echo "
                                <tr>
                                <td width = 100px>".$i."</td>
                                <td><img width=90px src='../../img/".$row[1]."'></td>
                                <td width = 100px> <button><a href='./DeleteImage.php?id=".$row[0]."'onclick='return XacNhanXoa()'>Xóa</a></button></td>
                                </tr>
                            ";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <footer>
        <span>Copyright @ Your website 2021</span>
        <span>Privacy policy . Term conditions</span>
    </footer>
</body>
<script>
    function XacNhanXoa(){
       return confirm("Bạn có chắc chắc muốn xóa danh mục nay hay không ?");
    }
</script>
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