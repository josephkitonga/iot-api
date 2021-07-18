<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Maintenance_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const USER_TYPE_TABLE = 'user_type';
    const USER_RIGHTS_TABLE  = 'user_rights';
    const TABLE_CLIENT  = 'client';
    const TABLE_AMENITY  = 'amenity';
    const TABLE_MEDIA  = 'media';
    const TABLE_UNIT_AMENITY  = 'unit_amenity';
    const TABLE_BOOKING  = 'booking';
    const MODULE_TABLE  = 'maintenance_module';
    


    public function getClient($where = NULL) {
        $this->db->select('*');
        $this->db->from(self::TABLE_CLIENT);
        $result = $this->db->get()->result();
        
        return $result;
    
    }
   
    
    public function getUserType($where = NULL) {
        $this->db->select('*');
        $this->db->from(self::USER_TYPE_TABLE);
        if ($where !== NULL) {
            if (is_array($where)) {
                foreach ($where as $field=>$value) {
                    $this->db->where($field, $value);
                }
            } else {
                $this->db->where("user_type_id",$where);
            }
        }
        $result = $this->db->get()->result();
        
        return $result;
    
    }

     public function getUserRights($where = NULL) {
        $this->db->select('*');
        $this->db->from(self::USER_RIGHTS_TABLE);
        if ($where !== NULL) {
            if (is_array($where)) {
                foreach ($where as $field=>$value) {
                    $this->db->where($field, $value);
                }
            } else {
                $this->db->where("id", $where);
            }
        }
        $result = $this->db->get()->result();
       return $result;
    }

    public function getModule($where = NULL) {
        $this->db->select('*');
        $this->db->from(self::MODULE_TABLE);
        $this->db->order_by('id', 'asc');
        if ($where !== NULL) {
            if (is_array($where)) {
                foreach ($where as $field=>$value) {
                    $this->db->where($field, $value);
                }
            } else {
                $this->db->where("module_id", $where);
            }
        }

         $result = $this->db->get()->result();
       return $result;
    }
    
    public function getAmenity($where = NULL) {
        $this->db->select('*');
        $this->db->from(self::TABLE_AMENITY);
        $this->db->order_by('id', 'asc');
        if ($where !== NULL) {
            if (is_array($where)) {
                foreach ($where as $field=>$value) {
                    $this->db->where($field, $value);
                }
            } else {
                    $this->db->where("amenity_id", $where);
            }
        }

         $result = $this->db->get()->result();
       return $result;
    }


    public function getSpeakers($where = NULL) {

        $this->db->select('*');
        $this->db->from("speakers");
        $this->db->order_by('id', 'asc');
        if ($where !== NULL) {
            if (is_array($where)) {
                foreach ($where as $field=>$value) {
                    $this->db->where($field, $value);
                }
            } else {
                    $this->db->where("speaker_id", $where);
            }
        }

         $result = $this->db->get()->result();
       return $result;
    }



    public function getAmenitySpecific($where = NULL) {
        $this->db->select('*');
        $this->db->distinct();
        $this->db->from(self::TABLE_AMENITY);
        $this->db->order_by('id', 'asc');
        $this->db->where_in('amenity_id', $where);
        $result = $this->db->get()->result();
       return $result;
    }



    public function getMedia($where = NULL) {
        $this->db->select('*');
        $this->db->from(self::TABLE_MEDIA);
        $this->db->order_by('id', 'asc');
        if ($where !== NULL) {
            if (is_array($where)) {
                foreach ($where as $field=>$value) {
                    $this->db->where($field, $value);
                }
            } else {
                    $this->db->where("parent_id", $where);
            }
        }

         $result = $this->db->get()->result();
       return $result;
    }


    public function getUnitAmenity($where = NULL) {

        $this->db->select('*');
        $this->db->from(self::TABLE_UNIT_AMENITY);
        $this->db->order_by('id', 'asc');
        if ($where !== NULL) {
            if (is_array($where)) {
                foreach ($where as $field=>$value) {
                    $this->db->where($field, $value);
                }
            } else {
                    $this->db->where("id", $where);
            }
        }

         $result = $this->db->get()->result();
       return $result;
    }


    public function getUnitSpeakers($where = NULL) {

        $this->db->select('*');
        $this->db->from("unit_speakers");
        $this->db->order_by('id', 'asc');
        if ($where !== NULL) {
            if (is_array($where)) {
                foreach ($where as $field=>$value) {
                    $this->db->where($field, $value);
                }
            } else {
                    $this->db->where("id", $where);
            }
        }

         $result = $this->db->get()->result();
       return $result;
    }


      public function getBooking($where = NULL) {

        $this->db->select('*');
        $this->db->from(self::TABLE_BOOKING);
        $this->db->order_by('id', 'asc');
        if ($where !== NULL) {
            if (is_array($where)) {
                foreach ($where as $field=>$value) {
                    $this->db->where($field, $value);
                }
            } else {
                    $this->db->where("id", $where);
            }
        }

         $result = $this->db->get()->result();
       return $result;
    }


    



    /**
     * Inserts new data into database
     *
     * @param Array $data Associative array with field_name=>value pattern to be inserted into database
     * @return mixed Inserted row ID, or false if error occured
     */
    
  
    public function insertUserType(Array $data) {
        if ($this->db->insert(self::USER_TYPE_TABLE, $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    
    public function insertUserRights(Array $data)
    {
        if ($this->db->insert(self::USER_RIGHTS_TABLE, $data)) {
        return $this->db->insert_id();
        } else {
        return false;
        }
    }

    public function insertAmenity(Array $data)
    {
        if ($this->db->insert(self::TABLE_AMENITY, $data)) {
        return $this->db->insert_id();
        } else {
        return false;
        }
    }


    public function insertSpeaker(Array $data)
    {
        if ($this->db->insert('speakers', $data)) {
        return $this->db->insert_id();
        } else {
        return false;
        }
    }

    
     public function insertMedia(Array $data)
     {
        if ($this->db->insert(self::TABLE_MEDIA, $data)) {
        return $this->db->insert_id();
        } else {
        return false;
        }
     }


     public function insertUnitAmenity(Array $data)
     {
        if ($this->db->insert(self::TABLE_UNIT_AMENITY, $data)) {
        return $this->db->insert_id();
        } else {
        return false;
        }
     } 

     public function insertUnitSpeaker(Array $data)
     {
        if ($this->db->insert("unit_speakers", $data)) {
        return $this->db->insert_id();
        } else {
        return false;
        }
     }  


     public function insertBooking(Array $data)
     {
        if ($this->db->insert(self::TABLE_BOOKING, $data)) {
        return $this->db->insert_id();
        } else {
        return false;
        }
     }  

     


    /**
     * Updates selected record in the database
     *
     * @param Array $data Associative array field_name=>value to be updated
     * @param Array $where Optional. Associative array field_name=>value, for where condition. If specified, $id is not used
     * @return int Number of affected rows by the update query
     */
    

    public function updateUserType(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array('user_type_id' => $where);
            }
        $this->db->update(self::USER_TYPE_TABLE, $data, $where);
        return $this->db->affected_rows();
    }

    public function updateAmenity(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array('amenity_id' => $where);
            }
        $this->db->update(self::TABLE_AMENITY, $data, $where);
        return $this->db->affected_rows();
    }

    public function updateSpeakers(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array('speaker_id' => $where);
            }
        $this->db->update("speakers", $data, $where);
        return $this->db->affected_rows();
    }


    /**
     * Deletes specified record from the database
     *
     * @param Array $where Optional. Associative array field_name=>value, for where condition. If specified, $id is not used
     * @return int Number of rows affected by the delete query
     */
    public function delete($where = array()) {
        if (!is_array()) {
            $where = array(self::PRI_INDEX => $where);
        }
        $this->db->delete(self::TABLE_NAME, $where);
        return $this->db->affected_rows();
    }

    public function deleteUserRight($where = array()) {
        if (!is_array($where)) {
            $where = array('id' => $where);
        }
        $this->db->delete(self::USER_RIGHTS_TABLE, $where);
        return $this->db->affected_rows();
    }

    public function deleteUnitAmenity($unit_id='')
    {
        if (!is_array($where)) {
            $where = array('unit_id' => $unit_id);
        }
        $this->db->delete(self::TABLE_UNIT_AMENITY, $where);
        return $this->db->affected_rows();
    }


    public function deletMedea($where='')
    {
        if (!is_array($where)) {
            $where = array('id' => $where);
        }
        $this->db->delete(self::TABLE_MEDIA, $where);
        return $this->db->affected_rows();
    }

    
}
        



?>
