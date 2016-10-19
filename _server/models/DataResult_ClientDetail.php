<?php
    require_once ('_server/libs/db_connect.php');
    // result data of Client 
    class DataResult_ClientDetail {

        public $err_msg;
        public $data;

        public function __construct($u_uid = null) {//private constructor: 
            // verify if matching id & pass
            if(empty($u_uid)) {
                $this->err_msg = 'Error u_uid is empty'; 
                return false;
            }
 
            $szQuery = "select first_name, last_name, email, tel, address from client where u_uid = '".$u_uid."' limit 1"; 
            $res =  dbCon::GetConnection()->query($szQuery);
            if($res->rowCount() < 1) {
                $this->err_msg = 'Not exist uid';
                return false;
            }
            $this->data = $res->fetch();

            // look up vehicles
            $szQuery = "select v_uid, v_company, v_model, v_plate_no from vehicles where v_owner_uid = '".$u_uid."'"; 
            $res =  dbCon::GetConnection()->query($szQuery);
            $this->data['vehicles'] = $res->fetchAll();

            // look up records
            $szQuery = "select r_uid, s_uid, r_desc, r_status, r_date from records where u_uid = '".$u_uid."' limit 5"; 
            $res =  dbCon::GetConnection()->query($szQuery);
            $this->data['records'] = $res->fetchAll(PDO::FETCH_ASSOC);

            return true;
             
        }

    }

?>