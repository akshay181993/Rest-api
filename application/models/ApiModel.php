<?php 

class ApiModel extends CI_Model
{
    // To insert record in databse and return customer data to controller.
    public function Save($data)
    {
        $query = $this->db->insert('customers_list_tbl',$data);
        $data['id'] = $this->db->insert_id();
        if($query)
        {
            return array('status' => 200,'message' => 'success','data' => $data);
        }else{
            return false;
        }
    }

    // To update record in databse and return customer data to controller.
    public function Update($data,$id)
    {
        $chkid = $this->ChkRecord($id);
        if($chkid){
            $this->db->where('id',$id);
            $query = $this->db->update('customers_list_tbl',$data);
            $data['id'] = $id;
            return array('status' => 200,'message' => 'success','data' => $data);
        }else{
            return array('status' => 404,'message' => 'No Data Found');
        }
    }

    // To display all customer records from databse and return data to controller.
    public function GetAllCustomer()
    {  
        $this->db->select(['cl.*','c.country_name','al.name as admin_name']);
        $this->db->join('country_list_tbl c','c.id = cl.country_id','left');
        $this->db->join('admins_list_tbl al','al.id = cl.admin_id','left');
        $query = $this->db->get('customers_list_tbl cl')->result();
        
        if($query){
            return array('status' => 200,'data' => $query);
        }else{
            return FALSE;
        } 
    }

    // Delete customer record
    public function DeleteCustomer($id)
    {
        $chkid = $this->ChkRecord($id);
        if($chkid){
            $this->db->delete('customers_list_tbl', array('id' => $id));
            return array('status' => 200,'message' => 'success');
        }else{
            return array('status' => 404,'message' => 'No Data Found');
        }
        
    }

    // To check whether record is exist in system or not
    public function ChkRecord($id){
        $this->db->select('id');
        $this->db->from('customers_list_tbl');
        $this->db->where('id',$id);
        $query = $this->db->get();
        
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

  }
    
 ?>