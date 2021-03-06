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
        
    </style>
</head>
<body>
    <?php include '../common/header.php'?>
    <main>
        <?php include '../common/left.php'?>
        <div class="right">
            <h1>List Products</h1>
            <h2><a href="#">Dasboard</a>/List Products</h2>
            <div class="bang">
                <p><i class="fas fa-clipboard-list"></i> All Listings</p>
                <table class="table table-bordered" >
                    <thead>
                        <th width=50px>STT</th>
                        <th width=200px>Product's Name</th>
                        <th>Image</th>
                        <th width=65px>Active</th>
                        <th width=50px>Hot</th>
                        <th width=90px>Quantity</th>
                        <th width=200px>Category Name</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                            include "../connectSQL.php";
                            $sql = "select * from products inner join categories on products.category_id = categories.id order by products.id desc ";
                            $query = $conn->query($sql);
                            $i = 0;
                            while($row = $query->fetch_row()) {
                                $i++;
                                echo "
                                <tr>
                                    <td>".$i."</td>
                                    <td>".$row[1]."</td>
                                    <td>
                                        <img width=90px src='../../img/".$row[5]."'>
                                    </td>
                                    <td>".$row[6]."</td>
                                    <td>".$row[8]."</td>
                                    <td>".$row[9]."</td>
                                    <td>".$row[12]."</td>
                                    <td> 
                                        <button>
                                            <a href='./EditProduct.php?id=".$row[0]."'>S???a</a>
                                        </button>
                                        <button '>
                                            <a href='./DeleteProduct.php?id=".$row[0] ."'onclick='return XacNhanXoa()'>X??a</a>
                                        </button>
                                        <button>
                                            <a href='../ProductImages/Details.php?id=".$row[0]."'>Images</a>
                                        </button>
                                    </td>
                                </tr>";
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
       return confirm("B???n c?? ch???c ch???c mu???n x??a danh m???c nay hay kh??ng ?");
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