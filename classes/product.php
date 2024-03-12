<?php

use LDAP\Result;

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * 
 */
class Product
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_product($data, $files)
    {
        $name_product = mysqli_real_escape_string($this->db->link, $data['name_product']);
        $quantity_product = mysqli_real_escape_string($this->db->link, $data['quantity_product']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $desc_product = mysqli_real_escape_string($this->db->link, $data['desc_product']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        //kiem tra hinh anh va lay hinh anh cho vào folder uploads
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploadss/" . $unique_image;
        if ($name_product == "" || $quantity_product == "" || $category == "" || $brand == "" || $desc_product == "" || $type == "" || $price == "" || $file_name == "") {
            $alert = "Tên sản phẩm không được để trống";
            return $alert;
        } else {

            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO t_product(name_product, quantity_product, id_cat, id_brand, desc_product, type, price, image) 
    VALUES('$name_product', '$quantity_product', '$category', '$brand', '$desc_product', '$type', '$price', '$unique_image') ";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "Thêm thành công";
                return $alert;
            } else {
                $alert = "Thêm không thành công ";
                return $alert;
            }
        }
    }
    public function show_product()
    {
        $query = "SELECT t_product.*, t_category.name_cat, t_brand.name_brand FROM t_product
        INNER JOIN t_category ON t_product.id_cat = t_category.id_cat
        INNER JOIN t_brand ON t_product.id_brand = t_brand.id_brand 
         order by t_product.id_product DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function getproductbyid($id_product)
    {
        $query = "SELECT * FROM t_product where id_product = '$id_product' ";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_product($data, $files, $id_product)
    {
        //thoát các ký tự đặc biệt trong chuỗi để sd trong 1 câu lệnh sql
        $name_product = mysqli_real_escape_string($this->db->link, $data['name_product']);
        $quantity_product = mysqli_real_escape_string($this->db->link, $data['quantity_product']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $desc_product = mysqli_real_escape_string($this->db->link, $data['desc_product']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        //kiem tra hinh anh va lay hinh anh cho vào folder uploads
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploadss/" . $unique_image;

        if ($name_product == "" || $quantity_product == "" || $category == ""  || $brand == "" || $desc_product == "" || $type == "" || $price == "") {
            $alert = "Các trường không được để trống";
            return $alert;
        } else {

            if (!empty($file_name)) {
                if (!empty($file_name)) {
                    if ($file_size > 2048) {
                        $alert = "Kích thước hình ảnh phải nhỏ hơn 2MB";
                    } elseif (in_array($file_ext, $permited) == false) {
                        $alert = "<span class='error>Bạn chỉ có thể uploads file: " . implode(',', $permited) . " </span>";
                        return $alert;
                    }
                }
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE t_product SET
                name_product = '$name_product',
                quantity_product = '$quantity_product',
                id_cat = '$category',
                id_brand = '$brand',
                desc_product = '$desc_product',
                type = '$type',
                price = '$price',
                image = '$unique_image'
                 WHERE id_product = '$id_product'";
            } else {
                $query = "UPDATE t_product SET
                name_product = '$name_product',
                quantity_product = '$quantity_product',
                id_cat = '$category',
                id_brand = '$brand',
                desc_product = '$desc_product',
                type = '$type',
                price = '$price'
                WHERE id_product = '$id_product'";
            }
            $result = $this->db->update($query);
            if ($result) {
                $alert = "Cập nhật thành công";
                return $alert;
            } else {
                $alert = "Chưa được cập nhật";
                return $alert;
            }
        }
    }
    public function del_product($id_product)
    {
        $query = "DELETE FROM t_product WHERE id_product = '$id_product' ";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "Đã xóa thành công";
            return $alert;
        } else {
            $alert = "Xóa không thành công";
            return $alert;
        }
    }
    //end backend

    public function getproduct_feathered()
    {
        $query = "SELECT * FROM t_product WHERE TYPE = '0'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getproduct_feathered1()
    {
        $query = "SELECT * FROM t_product WHERE TYPE = '1'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getproduct_feathered2()
    {
        $query = "SELECT * FROM t_product WHERE TYPE = '2'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getproduct_feathered3()
    {
        $query = "SELECT * FROM t_product WHERE TYPE ='3' LIMIT 6";
        $result = $this->db->select($query);
        return $result;
    }
    public function getproduct_recoment()
    {
        $query = "SELECT * FROM t_product ORDER BY id_product DESC LIMIT 3";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_product_details($proid)
    {
        $query = "SELECT t_product.*, t_category.name_cat, t_brand.name_brand FROM t_product
        INNER JOIN t_category ON t_product.id_cat = t_category.id_cat
        INNER JOIN t_brand ON t_product.id_brand = t_brand.id_brand WHERE t_product.id_product = '$proid'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getproduct_new()
    {
        $sp_tungtrang = 6;
        if (!isset($_GET['trang'])) {
            $trang = 1;
        } else {
            $trang = $_GET['trang'];
        }
        $tungtrang = ($trang - 1) * $sp_tungtrang;
        $query = "SELECT * FROM t_product ORDER BY id_product DESC LIMIT  $tungtrang, $sp_tungtrang";
        //$query = "SELECT * FROM t_product ORDER BY id_product ASC LIMIT 9";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_all_product()
    {
        $query = "SELECT * FROM t_product";
        $result = $this->db->select($query);
        return $result;
    }
    public function search_product($key)
    {
        $query = "SELECT * FROM t_product WHERE name_product LIKE '%" . $key . "%' LIMIT 9 ";
        $result = $this->db->select($query);
        return $result;
    }
}
?>