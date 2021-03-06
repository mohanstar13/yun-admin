<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roles_Model extends Yun_Model{

    function __construct() {
        parent::__construct();
        $this->tb_role=$this->db->dbprefix('admin_role');
    }

    public function get_roles($limit = 0, $start = 0) {
        $this->db->from($this->tb_role);
        $this->db->order_by('id', 'asc');
        if ($limit) {
            $this->db->limit($limit);
        }
        if ($start) {
            $this->db->offset($start);
        }
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function get_role($id){
        $this->db->where('id',$id);
        $this->db->from($this->tb_role);
        $query=$this->db->get();
        return $query->row_array();

    }
    public function set_roles($models = NULL, $id = FALSE) {
        $data['models'] = $models;
        if ($this->input->post('name')) {
            $data['name'] = $this->input->post('name');
        }
        if ($id) {
            $where = array('id' => $id);
            return $this->db->update($this->tb_role, $data, $where);
        } else {
            return $this->db->insert($this->tb_role, $data);
        }
    }

    public function del_roles($ids) {
        $ids = implode(',', $ids);
        $strSql = 'delete from ' . $this->tb_role . ' where id in (' . $ids . ')';
        $this->db->query($strSql);
        return;
    }
}