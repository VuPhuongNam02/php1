<?php include_once "../config/config.php" ?>

<?php

class xuly extends database
{

    //lấy và hiển thị sản phẩm
    public function getData()
    {
        $data = null;
        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }

    //thêm sản phẩm
    public function insert($product_name, $product_price, $product_quantity, $product_image, $description)
    {
        $sql = "INSERT INTO products (product_name,product_price,product_quantity,product_image,description)
                VALUES ('$product_name','$product_price','$product_quantity','$product_image','$description') ";
        $result = $this->conn->query($sql);
        header('location:table.php');
    }

    //lấy sản phẩm cần sửa
    public function edit($id)
    {
        $data = null;
        $sql = "SELECT * FROM products WHERE product_id = '$id'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }

    //sửa sản phẩm
    public function update($id, $product_name, $product_price, $product_quantity, $product_image, $description)
    {
        $sql = "UPDATE products SET product_name = '$product_name',
                                    product_price = '$product_price',
                                    product_quantity= '$product_quantity',
                                    product_image= '$product_image',
                                    description  = '$description'
                                WHERE product_id = '$id'";
        $result = $this->conn->query($sql);
        header('location:table.php');
    }

    //xóa sản phẩm
    public function delete($id)
    {
        $sql = "DELETE FROM products WHERE product_id = '$id'";
        $result = $this->conn->query($sql);
        header('location:table.php');
    }
}



?>