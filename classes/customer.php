<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * 
 */
class Customer
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_customer($data)
    {
        //thoát các ký tự đặc biệt trong chuỗi để sd trong 1 câu lệnh sql
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if ($name == "" || $address == "" || $city == "" || $country == "" || $zipcode == "" || $phone == "" || $email == "" || $password == "") {
            $alert = "<span style='color:var(--bg-primary);'>Không được để trống</span>";
            return $alert;
        } else {
            $check_email = "SELECT * FROM t_customer WHERE email='$email' LIMIT 1";
            $result_check = $this->db->select($check_email);
            if ($result_check) {
                $alert = "<span style='color:var(--bg-primary);'>email đã tồn tại </span>";
                return $alert;
            } else {
                $query = "INSERT INTO t_customer(name,address,city,country,zipcode,phone,email,password) VALUES ('$name','$address','$city','$country','$zipcode','$phone','$email','$password') ";
                $result = $this->db->insert($query);
                if ($result) {
                    $alert = "<span style='color:var(--bg-primary);''>Tạo tài khoản thành công</span>";
                    return $alert;
                } else {
                    $alert = "<span style='color:var(--bg-primary);'>Tạo chưa thành công</span>";
                    return $alert;
                }
            }
        }
    }
    public function login_customer($data)
    {
        //thoát các ký tự đặc biệt trong chuỗi để sd trong 1 câu lệnh sql
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        if ($email == '' || $password == '') {
            $alert = "<span style='color:var(--bg-primary)'>không được để trống</span>";
            return $alert;
        } else {
            $check_login = "SELECT * FROM t_customer WHERE email='$email' AND password='$password' ";
            $result_check = $this->db->select($check_login);
            if ($result_check != false) {
                $value = $result_check->fetch_assoc();
                Session::set('customer_login', true);
                Session::set('id_customer', $value['id_customer']);
                Session::set('customer_name', $value['name']);
                header('Location:index.php');
            } else {
                $alert = "<span style='color:var(--bg-primary)'>Tài khoản hoặc mật khẩu không đúng</span>";
                return $alert;
            }
        }
    }
    public function show_customer($id_customer)
    {
        $query = "SELECT * FROM t_customer WHERE id_customer='$id_customer'";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_customer_admin()
    {
        $query = "SELECT * FROM t_customer";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_customer($data, $id_customer)
    {
        //thoát các ký tự đặc biệt trong chuỗi để sd trong 1 câu lệnh sql 
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);

        if ($name == "" || $address == "" || $city == "" || $country == "" || $zipcode == "" || $phone == "" || $email == "") {
            $alert = "<span style='color:var(--bg-primary);'>Không được để trống</span>";
            return $alert;
        } else {
            $query = "UPDATE t_customer SET name='$name',address = '$address', city = '$city',country = '$country', zipcode = '$zipcode', phone = '$phone', email = '$email' WHERE id_customer = '$id_customer'";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span style='color:var(--bg-primary);''>Cập nhật thành công</span>";
                return $alert;
            } else {
                $alert = "<span style='color:var(--bg-primary);'>Cập nhật chưa thành công</span>";
                return $alert;
            }
        }
    }
    public function del_customer($id_customer){
        $query = "DELETE FROM t_customer WHERE id_customer = '$id_customer' ";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "Đã xóa thành công";
            return $alert;
        } else {
            $alert = "Xóa không thành công";
            return $alert;
        }
    }
    public function count_customer(){
        $query = "SELECT COUNT('id_customer') FROM t_customer" ;
        $result = $this->db->select($query);
        return $result;
    }
}

?>