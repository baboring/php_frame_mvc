<?php
    require_once ('_server/libs/db_connect.php');
    // result data of Client 
    class DataResult_AvailableServices {

        public $err_msg;
        public $data;

        public function __construct($u_uid = null) {//private constructor: 
            // verify if matching id & pass
            if(empty($u_uid)) {
                $this->err_msg = 'Error u_uid is empty'; 
                return false;
            }
            $szQuery = 'Select A.s_uid,A.s_type, B.s_code, B.s_name ';
            $szQuery .= 'from services as A ';
            $szQuery .= 'inner join service_type as B ';
            $szQuery .= 'on A.s_type = B.s_code ';
            $szQuery .= 'where A.s_owner_uid = '.$u_uid;

            $res =  dbCon::GetConnection()->query($szQuery);
            if($res->rowCount() < 1) {
                $this->err_msg = 'Not exist uid';
                return false;
            }

            $this->data = $res->fetchAll();

            return true;
             
        }

    }

?>