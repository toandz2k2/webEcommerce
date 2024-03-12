<?php
$filepath = realpath(dirname(__FILE__));
include($filepath.'/../lib/session.php');
Session::checkLogin(); // gọi hàm check login để ktra session

include_once($filepath.'/../lib/database.php');
include_once($filepath.'/../helpers/format.php');
?>

<?php
/**
 * 
 */
class adminlogin
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function login_admin($user_admin, $pass_admin)
    {
        $user_admin = $this->fm->validation($user_admin); //gọi ham validation từ file Format để ktra
        $pass_admin = $this->fm->validation($pass_admin);

        $user_admin = mysqli_real_escape_string($this->db->link, $user_admin);
        $pass_admin = mysqli_real_escape_string($this->db->link, $pass_admin); //mysqli gọi 2 biến. (user_admin and link) biến link -> gọi conect db từ file db

        if (empty($user_admin) || empty($pass_admin)) {
            $alert = "User and Pass không nhập rỗng";
            return $alert;
        } else {
            $query = "SELECT * FROM t_admin WHERE user_admin = '$user_admin' AND pass_admin = '$pass_admin' LIMIT 1 ";
            $result = $this->db->select($query);

            if ($result != false) {
                //session_start();
                // $_SESSION['login'] = 1;
                //$_SESSION['user'] = $user;
                $value = $result->fetch_assoc();
                Session::set('adminlogin', true); // set adminlogin đã tồn tại
                // gọi function Checklogin để kiểm tra true.
                Session::set('id_admin', $value['id_admin']);
                Session::set('user_admin', $value['user_admin']);
                Session::set('name_admin', $value['name_admin']);
                header("Location:index.php");
            } else {
                $alert = "Tài khoản và mật khẩu không đúng";
                return $alert;
            }
        }
    }
}
?>