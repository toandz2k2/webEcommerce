<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/database.php');
include_once($filepath.'/../helpers/format.php');
?>

<?php
/**
 * 
 */
class Brand
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_brand($name_brand)
    {
        $name_brand = $this->fm->validation($name_brand); //gọi ham validation từ file Format để ktra
        $name_brand = mysqli_real_escape_string($this->db->link, $name_brand);
        //mysqli gọi 2 biến. (catName and link) biến link -> gọi conect db từ file db

        if (empty($name_brand)) {
            $alert = "Tên thương không được để trống";
            return $alert;
        } else {
            $query = "INSERT INTO t_brand(name_brand) VALUES('$name_brand') ";
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
    public function show_brand()
    {
        $query = "SELECT * FROM t_brand order by id_brand ASC";
        $result = $this->db->select($query);
        return $result;
    }
    public function getcatbyid($id_brand)
		{
			$query = "SELECT * FROM t_brand where id_brand = '$id_brand' ";
			$result = $this->db->select($query);
			return $result;
		}
    public function update_brand($name_brand, $id_brand){
        $name_brand = $this->fm->validation($name_brand); //gọi ham validation từ file Format để ktra
        $name_brand = mysqli_real_escape_string($this->db->link, $name_brand);
        $id_brand = mysqli_real_escape_string($this->db->link, $id_brand);
        //mysqli gọi 2 biến. (name_brand and link) biến link -> gọi conect db từ file db

        if (empty($name_brand)) {
            $alert = "Tên danh mục không được để trống";
            return $alert;
        } else {
            $query = "UPDATE t_brand SET  name_brand='$name_brand' WHERE id_brand='$id_brand'";
            $result = $this->db->update($query);
            if ($result) {
                $alert = "Sửa thành công";
                return $alert;
            } else {
                $alert = "Sửa không thành công ";
                return $alert;
            }
        }
    }
    public function del_brand($id_brand){
        $query = "DELETE FROM t_brand where id_brand = '$id_brand' ";
			$result = $this->db->delete($query);
			if($result){
				$alert = "Đã xóa thành công";
				return $alert;
			}else {
				$alert = "Xóa không thành công";
				return $alert;
			}
    }
    public function get_brand_new(){
        $query = "SELECT * FROM t_brand";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_product_by_brand($id_brand){
        $query = "SELECT * FROM t_product WHERE id_brand = '$id_brand' ORDER BY id_brand DESC LIMIT 6";
        $result = $this->db->select($query);
        return $result;
    }
}
?>