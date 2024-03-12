<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/database.php');
include_once($filepath.'/../helpers/format.php');
?>

<?php
/**
 * 
 */
class Category
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_category($name_cat)
    {
        $name_cat = $this->fm->validation($name_cat); //gọi ham validation từ file Format để ktra
        $name_cat = mysqli_real_escape_string($this->db->link, $name_cat);
        //mysqli gọi 2 biến. (catName and link) biến link -> gọi conect db từ file db

        if (empty($name_cat)) {
            $alert = "Tên danh mục không được để trống";
            return $alert;
        } else {
            $query = "INSERT INTO t_category(name_cat) VALUES('$name_cat') ";
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
    public function show_category()
    {
        $query = "SELECT * FROM t_category order by id_cat ASC";
        $result = $this->db->select($query);
        return $result;
    }
    public function getcatbyid($id_cat)
		{
			$query = "SELECT * FROM t_category where id_cat = '$id_cat' ";
			$result = $this->db->select($query);
			return $result;
		}
    public function update_category($name_cat, $id_cat){
        $name_cat = $this->fm->validation($name_cat); //gọi ham validation từ file Format để ktra
        $name_cat = mysqli_real_escape_string($this->db->link, $name_cat);
        $id_cat = mysqli_real_escape_string($this->db->link, $id_cat);
        //mysqli gọi 2 biến. (name_cat and link) biến link -> gọi conect db từ file db

        if (empty($name_cat)) {
            $alert = "Tên danh mục không được để trống";
            return $alert;
        } else {
            $query = "UPDATE t_category SET  name_cat='$name_cat' WHERE id_cat='$id_cat'";
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
    public function del_category($id_cat){
        $query = "DELETE FROM t_category where id_cat = '$id_cat' ";
			$result = $this->db->delete($query);
			if($result){
				$alert = "Đã xóa thành công";
				return $alert;
			}else {
				$alert = "Xóa không thành công";
				return $alert;
			}
    }
    public function get_cat_new(){
        $query = "SELECT * FROM t_category";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_product_by_cat($catid){
        $query = "SELECT * FROM t_product WHERE id_cat = '$catid' ORDER BY id_cat DESC LIMIT 6";
        $result = $this->db->select($query);
        return $result;
    }
}
?>