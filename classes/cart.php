<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * 
 */
class Cart
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function add_to_cart($quantity, $proid)
    {
        $quantity = $this->fm->validation($quantity);
        //thoát các ký tự đặc biệt trong chuỗi để sd trong 1 câu lệnh sql
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $proid = mysqli_real_escape_string($this->db->link, $proid);
        $sid = session_id();

        $query = "SELECT * FROM t_product WHERE id_product = '$proid'";
        $result = $this->db->select($query)->fetch_assoc();

        $name_product = $result["name_product"];
        $price = $result["price"];
        $image = $result["image"];
        $query_cart = "SELECT * FROM t_cart WHERE id_product ='$proid' AND sid = '$sid'";
        $check_cart =  $this->db->select($query_cart);
        if ($check_cart) {
            $msg = "Sản phẩm này đã có trong giỏ hàng";
            return $msg;
        } else {
            $query_insert = "INSERT INTO t_cart(id_product, sid, name_product, price , quantity, image) 
    VALUES('$proid', '$sid', '$name_product','$price', $quantity, '$image' )";
            $insert_cart = $this->db->insert($query_insert);
            if ($insert_cart) {
                header('location:cart.php');
            } else {
                header('location:404.php');
            }
        }
    }
    public function get_product_cart()
    {
        $sid = session_id();
        $query = "SELECT * FROM t_cart WHERE sid = '$sid'";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_quantity_cart($quantity, $id_cart)
    {
        //thoát các ký tự đặc biệt trong chuỗi để sd trong 1 câu lệnh sql
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $id_cart = mysqli_real_escape_string($this->db->link, $id_cart);
        $query = "UPDATE t_cart SET
                quantity = '$quantity'
                WHERE id_cart = '$id_cart'";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "<span style='color:var(--bg-primary);''>Cập nhật thành công</span>";
            return $msg;
        } else {
            $msg = "<span style='color:var(--bg-primary);''>Cập nhật không thành công</span>";
            return $msg;
        }
    }
    public function del_product_cart($id_cart)
    {
        //thoát các ký tự đặc biệt trong chuỗi để sd trong 1 câu lệnh sql
        $id_cart = mysqli_real_escape_string($this->db->link, $id_cart);
        $query = "DELETE FROM t_cart WHERE id_cart = '$id_cart' ";
        $result = $this->db->delete($query);
        if ($result) {
            header('location:cart.php');
        } else {
            $msg = "<span style='color:var(--bg-primary);''>Xoá không thành công</span>";
            return $msg;
        }
    }
    public function check_cart()
    {
        $sid = session_id();
        $query = "SELECT * FROM t_cart WHERE sid = '$sid'";
        $result = $this->db->select($query);
        return $result;
    }
    public function check_order($id_customer)
    {
        $sid = session_id();
        $query = "SELECT * FROM t_order WHERE id_customer = '$id_customer'";
        $result = $this->db->select($query);
        return $result;
    }
    public function del_all_data_cart()
    {
        $sid = session_id();
        $query = "DELETE FROM t_cart WHERE sid = '$sid'";
        $result = $this->db->select($query);
        return $result;
    }
    public function insert_order($id_customer)
    {
        $sid = session_id();
			$query = "SELECT * FROM t_cart WHERE sid = '$sid'";
			$get_product = $this->db->select($query);
			if($get_product){
				while($result = $get_product->fetch_assoc()){
					$id_product = $result['id_product'];
					$name_product = $result['name_product'];
					$quantity = $result['quantity'];
					$price = $result['price'] * $quantity;
					$image = $result['image'];
					$id_customer = $id_customer;
                    echo $id_customer;
					$query_order = "INSERT INTO t_order(id_product,name_product,quantity,price,image,id_customer) VALUES('$id_product','$name_product','$quantity','$price','$image','$id_customer')";
					$insert_order = $this->db->insert($query_order);
				}
                
			}
    }
    public function get_cart_order($id_customer){
        $query = " SELECT * FROM t_order WHERE id_customer = '$id_customer'";
        $get_cart_order = $this->db->select($query);
        return $get_cart_order;
    }
    public function del_order_cart($id_order)
    {
        //thoát các ký tự đặc biệt trong chuỗi để sd trong 1 câu lệnh sql
        $id_order = mysqli_real_escape_string($this->db->link, $id_order);
        $query = "DELETE FROM t_order WHERE id = '$id_order' ";
        $result = $this->db->delete($query);
        if ($result) {
            header('location:orderdetail.php');
        } else {
            $msg = "<span style='color:var(--bg-primary);''>Xoá không thành công</span>";
            return $msg;
        }
    }
    public function get_inbox_cart(){
        $query = " SELECT * FROM t_order INNER JOIN t_customer ON t_order.id_customer = t_customer.id_customer ORDER BY date";
        $get_inbox_cart = $this->db->select($query);
        return $get_inbox_cart;
    }
    public function shiftid($id, $time, $price){
        //thoát các ký tự đặc biệt trong chuỗi để sd trong 1 câu lệnh sql
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "UPDATE t_order SET
                status = '1'
                WHERE id = '$id' AND date='$time' AND price='$price'";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "<span style='color:var(--bg-primary);''>Cập nhật thành công</span>";
            return $msg;
        } else {
            $msg = "<span style='color:var(--bg-primary);''>Cập nhật không thành công</span>";
            return $msg;
        }
    }
    public function del_shiftid($id, $time, $price){
        //thoát các ký tự đặc biệt trong chuỗi để sd trong 1 câu lệnh sql
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "DELETE FROM t_order 
                WHERE id = '$id' AND date='$time' AND price='$price'";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "<span style='color:var(--bg-primary);''>Xoá thành công</span>";
            return $msg;
        } else {
            $msg = "<span style='color:var(--bg-primary);''>Xoá không thành công</span>";
            return $msg;
        }
    }
    public function shiftid_confirmid($id, $time, $price){
        //thoát các ký tự đặc biệt trong chuỗi để sd trong 1 câu lệnh sql
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "UPDATE t_order SET
                status = '2'
                WHERE id_customer = '$id' AND date='$time' AND price='$price'";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "<span style='color:var(--bg-primary);''>Cập nhật thành công</span>";
            return $msg;
        } else {
            $msg = "<span style='color:var(--bg-primary);''>Cập nhật không thành công</span>";
            return $msg;
        }
    }
}
?>