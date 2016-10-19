<?php
    require_once ('_server/libs/db_connect.php');
    // result data of Client 
    class DataResult_MemberInfo {

        public $err_msg;
        public $data;

        public function __construct($u_uid = null) {//private constructor: 
            // verify if matching id & pass
            if(empty($u_uid)) {
                $this->err_msg = 'Error u_uid is empty'; 
                return false;
            }
 
            $szQuery = "select * from account where uid = ".$u_uid; 
            //echo $szQuery;
            $res =  dbCon::GetConnection()->query($szQuery);
            if($res->rowCount() < 1) {
                $this->err_msg = 'Not exist uid';
                return false;
            }
            $this->data = $res->fetch();
            //var_dump($this->data);
            // type case query
            if($this->data['type'] == 1) { // client
                // member info 
                $szQuery = "select * from client where u_uid = ".$u_uid; 
                $res =  dbCon::GetConnection()->query($szQuery);
                $this->data['member'] = $res->fetch();
                
                // look up vehicles
                $szQuery = "select v_uid, v_company, v_model, v_plate_no from vehicles where v_owner_uid = '".$u_uid."'"; 
                $res =  dbCon::GetConnection()->query($szQuery);
                $this->data['vehicles'] = $res->fetchAll();
            }
            else if($this->data['type'] == 2) { // business
                // member info 
                $szQuery = "select * from business where u_uid = ".$u_uid; 
                $res =  dbCon::GetConnection()->query($szQuery);
                $this->data['member'] = $res->fetch();

                // look up vehicles
                $szQuery = "select * from services where s_owner_uid = '".$u_uid."'"; 
                $res =  dbCon::GetConnection()->query($szQuery);
                $this->data['services'] = $res->fetchAll();
            }
            else if($this->data['type'] == 3) { // admin

            }

            return true;
             
        }

    }

?>