<?php
    require_once ('_server/libs/db_connect.php');

    // NewMember Model Data
    class MemberDoc {

        const FormArgs = array(
                "uuid",
                "type",
                "first_name",
                "last_name",
                "email",
                "password",
                "businessName",
                "tel",
                "status",
                "address",
                "services", // array
                "desc_service",
                "user_id",

                "prod_company",
                "model_info",
                "plate_number"
            );

        public static $err_msg;

        // Search Client List Data
        public static function ReqData_ClientList($keyType = null, $keyword = null) {

            require_once ('_server/models/DataResult_ClientList.php');
            return new DataResult_ClientList($keyType, $keyword);
        }

        //Get Client Detail Information
        public static function GetDataResult_ClientDetail($u_uid = null) {

            require_once ('_server/models/DataResult_ClientDetail.php');
            return new DataResult_ClientDetail($u_uid);
        }
        //Get Member Information
        public static function ReqData_MemberInfo($u_uid = null) {

            require_once ('_server/models/DataResult_MemberInfo.php');
            return new DataResult_MemberInfo($u_uid);
        }

        // check user id
        public static function IsExistId($user_id) {
            // insert query
            $szQuery = "select count(*) from account ";
            $szQuery .= " where user_id = '".$user_id."'";

            $res = dbCon::GetConnection()->query($szQuery);
            return ($res->fetchColumn() > 0);
        }

       // add member
        public static function Add($dataForm) {
            if(empty($dataForm) || count($dataForm) < 1) {
                self::$err_msg = 'Error User id is empty';
                return false;
            }
            if(null == $dataForm['user_id'])
                $dataForm['user_id'] = $dataForm['email'];
            /* Begin a transaction, turning off autocommit */
            if(!dbCon::beginTransaction()) {
                self::$err_msg = 'Failed : beginTransaction';
                return false;
            }

            try {

                // check unique id 
                if(self::IsExistId($dataForm['user_id']))
                    throw new Exception('Already exist Email');

                $lastId = self::InsertAccount($dataForm);

                // client
                switch($dataForm['type']) {
                    case 1: // client
                        if(!self::InsertClient($lastId,$dataForm)) {
                            dbCon::rollback();
                            return false;
                        }
                        if(!self::InsertVehicle($lastId,$dataForm)) {
                            dbCon::rollback();
                            return false;
                        }
                        break;
                    case 2: // Business
                        if(!self::InsertBuisness($lastId,$dataForm)) {
                            dbCon::rollback();
                            return false;
                        }
                        if(!self::InsertServices($lastId,$dataForm['services'])) {
                            dbCon::rollback();
                            return false;
                        }
                        break;
                    case 3: // Admin
                        break;
                }
                
                dbCon::commit();
            }
            catch(Exception $e)  {  //Some error occured. (i.e. violation of constraints)
                self::$err_msg = 'Error : '.$e->getMessage();
                GlobalData::SetDebug($e);
                dbCon::rollback();
                return false;
            }


            return true;
        }

       // add member
        public static function Update($dataForm) {
            if(empty($dataForm) || count($dataForm) < 1) {
                self::$err_msg = 'Error User id is empty';
                return false;
            }
            /* Begin a transaction, turning off autocommit */
            if(!dbCon::beginTransaction()) {
                self::$err_msg = 'Failed : beginTransaction';
                return false;
            }

            try {
                self::UpdateAccount($dataForm['uuid'],$dataForm);
                // client
                switch($dataForm['type']) {
                    case 1: // client
                        self::UpdateClient($dataForm['uuid'],$dataForm);
                        break;
                    case 2: // Business
                        self::UpdateBusiness($dataForm['uuid'],$dataForm);
                        break;
                    case 3: // Admin
                        break;
                }
                
                dbCon::commit();
            }
            catch(Exception $e)  {  //Some error occured. (i.e. violation of constraints)
                self::$err_msg = 'Error : '.$e->getMessage();
                GlobalData::SetDebug($e);
                dbCon::rollback();
                return false;
            }

            return true;
        }

        // Update Account
        private static function UpdateAccount($u_uid,$dataForm) {
            // insert query
            $szQuery = "UPDATE account set ";
            $szQuery .= "password = '".$dataForm['password']."'";
            $szQuery .= " where uid = '".$u_uid."'";

            //echo $szQuery;
            try {
                $res = dbCon::GetConnection()->exec($szQuery);
                if(!empty($res)) 
                   return true;
            }
            catch(Exception $e)  {  //Some error occured. (i.e. violation of constraints)
                self::$err_msg = $e;
                echo $e;
            }
            return false;
        }

        // Update Client
        private static function UpdateClient($u_uid,$dataForm) {
            // insert query
            $szQuery = "UPDATE client set ";
            $szQuery .= "first_name = '".$dataForm['first_name']."'";
            $szQuery .= ",last_name = '".$dataForm['last_name']."'";
            $szQuery .= ",email = '".$dataForm['email']."'";
            $szQuery .= ",tel = '".$dataForm['tel']."'";
            $szQuery .= ",address = '".$dataForm['address']."'";
            $szQuery .= " where u_uid = '".$u_uid."'";

            //echo $szQuery;
            try {
                $res = dbCon::GetConnection()->exec($szQuery);
                if(!empty($res)) 
                   return true;
            }
            catch(Exception $e)  {  //Some error occured. (i.e. violation of constraints)
                self::$err_msg = $e;
                echo $e;
            }
            return false;
        }

        // Update Business
        private static function UpdateBusiness($u_uid,$dataForm) {
            // insert query
            $szQuery = "UPDATE Business set ";
            $szQuery .= "first_name = '".$dataForm['first_name']."'";
            $szQuery .= ",last_name = '".$dataForm['last_name']."'";
            $szQuery .= ",email = '".$dataForm['email']."'";
            $szQuery .= ",tel = '".$dataForm['tel']."'";
            $szQuery .= ",address = '".$dataForm['address']."'";
            $szQuery .= " where u_uid = '".$u_uid."'";

            //echo $szQuery;
            try {
                $res = dbCon::GetConnection()->exec($szQuery);
                if(!empty($res)) 
                   return true;
            }
            catch(Exception $e)  {  //Some error occured. (i.e. violation of constraints)
                self::$err_msg = $e;
                echo $e;
            }
            return false;
        }

        // insert Account
        private static function InsertAccount($dataForm) {
            // insert query
            $szQuery = "INSERT into account (";
            $szQuery .= "u_guid";
            $szQuery .= ",user_id";
            $szQuery .= ",password";
            $szQuery .= ",type";
            $szQuery .= ",status";
            $szQuery .= ",name";
            $szQuery .= ",expire_date";
            $szQuery .= ") VALUES (?,?,?,?,?,?,?)";

            //echo 'query='.$szQuery;

            switch($dataForm['type']) {
                case 1: // client
                case 3: // Admin
                    $dataForm['status'] = 1;
                    break;
                case 2: // Business
                default:
                    $dataForm['status'] = 0;
                    break;
            }            

            try {
                // first of all, add client 
                $stmt = dbCon::GetConnection()->prepare($szQuery);

                if (!$stmt) {
                    echo "\nPDO::errorInfo():\n";
                    print_r($dbCon::GetConnection()->errorInfo());
                }

                $stmt->bindValue(1, $dataForm['uuid'], PDO::PARAM_STR);
                $stmt->bindValue(2, $dataForm['user_id'], PDO::PARAM_STR);
                $stmt->bindValue(3, $dataForm['password'], PDO::PARAM_STR);
                $stmt->bindValue(4, $dataForm['type'], PDO::PARAM_INT);
                $stmt->bindValue(5, $dataForm['status'], PDO::PARAM_INT);
                $stmt->bindValue(6, $dataForm['first_name'], PDO::PARAM_STR);
                $stmt->bindValue(7, date("Y-m-d H:i:s",strtotime('+1 years')), PDO::PARAM_STR);


                $res = $stmt->execute();
                if(!$res) {
                    //var_dump( dbCon::GetConnection()->errorInfo() );
                    //var_dump( $dataForm );
                    throw new PDOException('failed Insert Account');
                } 
            }
            catch(Exception $e)  {  //Some error occured. (i.e. violation of constraints)
                GlobalData::SetDebug($szQuery);
                throw $e;
            }
            catch(PDOException $e) {
                GlobalData::SetDebug($szQuery);
                if(stripos($e->getMessage(), 'DATABASE IS LOCKED') !== false) {
                    // This should be specific to SQLite, sleep for 0.25 seconds
                    // and try again.  We do have to commit the open transaction first though
                    usleep(250000);
                } else {
                    GlobalData::SetDebug(dbCon::GetConnection()->errorInfo());
                    throw $e;
                }
                return -1;
            }
            return dbCon::GetConnection()->lastInsertId();
        }

        // insert Client
        private static function InsertClient($lastId,$dataForm) {
            // insert query
            $szQuery = "INSERT into client (";
            $szQuery .= "u_uid";
            $szQuery .= ",first_name";
            $szQuery .= ",last_name";
            $szQuery .= ",email";
            $szQuery .= ",tel";
            $szQuery .= ",address";
            $szQuery .= ") VALUES (?,?,?,?,?,?)";

            //echo 'query='.$szQuery;

            try {
                // first of all, add client 
                $stmt = dbCon::GetConnection()->prepare($szQuery);

                $stmt->bindValue(1, $lastId, PDO::PARAM_INT);
                $stmt->bindValue(2, $dataForm['first_name'], PDO::PARAM_STR);
                $stmt->bindValue(3, $dataForm['last_name'], PDO::PARAM_STR);
                $stmt->bindValue(4, $dataForm['email'], PDO::PARAM_STR);
                $stmt->bindValue(5, $dataForm['tel'], PDO::PARAM_STR);
                $stmt->bindValue(6, $dataForm['address'], PDO::PARAM_STR);

                $res = $stmt->execute();
                if(!$res) 
                    throw new PDOException('failed Insert Client');
            }
            catch(Exception $e)  {  //Some error occured. (i.e. violation of constraints)
                GlobalData::SetDebug($szQuery);
                throw $e;
            }
            catch(PDOException $e) {
                GlobalData::SetDebug($szQuery);
                if(stripos($e->getMessage(), 'DATABASE IS LOCKED') !== false) {
                    // This should be specific to SQLite, sleep for 0.25 seconds
                    // and try again.  We do have to commit the open transaction first though
                    usleep(250000);
                } else {
                    GlobalData::SetDebug($szQuery);
                    throw $e;
                }
                return false;
            }
            return true;
        }

        // related in Business 
        private static function InsertBuisness($lastId,$dataForm) {
            // insert query
            $szQuery = "INSERT into business (";
            $szQuery .= "u_uid";
            $szQuery .= ",first_name";
            $szQuery .= ",last_name";
            $szQuery .= ",email";
            $szQuery .= ",tel";
            $szQuery .= ",address";
            $szQuery .= ",b_name";
            $szQuery .= ",b_desc";
            $szQuery .= ") VALUES (?,?,?,?,?,?,?,?)";

            try {
                // first of all, add client 
                $stmt = dbCon::GetConnection()->prepare($szQuery);

                $stmt->bindValue(1, $lastId, PDO::PARAM_INT);
                $stmt->bindValue(2, $dataForm['first_name'], PDO::PARAM_STR);
                $stmt->bindValue(3, $dataForm['last_name'], PDO::PARAM_STR);
                $stmt->bindValue(4, $dataForm['email'], PDO::PARAM_STR);
                $stmt->bindValue(5, $dataForm['tel'], PDO::PARAM_STR);
                $stmt->bindValue(6, $dataForm['address'], PDO::PARAM_STR);
                $stmt->bindValue(7, $dataForm['businessName'], PDO::PARAM_STR);
                $stmt->bindValue(8, $dataForm['desc_service'], PDO::PARAM_STR);

                $res = $stmt->execute();
                if(!$res) 
                    throw new PDOException('failed Insert Buisness');
            }
            catch(Exception $e)  {  //Some error occured. (i.e. violation of constraints)
                GlobalData::SetDebug($szQuery);
                throw $e;
            }
            catch(PDOException $e) {
                GlobalData::SetDebug($szQuery);
                if(stripos($e->getMessage(), 'DATABASE IS LOCKED') !== false) {
                    // This should be specific to SQLite, sleep for 0.25 seconds
                    // and try again.  We do have to commit the open transaction first though
                    usleep(250000);
                } else {
                    GlobalData::SetDebug($szQuery);
                    throw $e;
                }
                return false;
            }
            return true;
        }

        // related in vehicles 
        private static function InsertVehicle($lastId,$dataForm) {
            // insert query
            $szQuery = "INSERT into vehicles (";
            $szQuery .= "v_owner_uid";
            $szQuery .= ",v_company";
            $szQuery .= ",v_model";
            $szQuery .= ",v_plate_no";
            $szQuery .= ") VALUES (?,?,?,?)";

            //echo 'query='.$szQuery;

            try {
                // first of all, add Vechicle 
                $stmt = dbCon::GetConnection()->prepare($szQuery);

                $stmt->bindValue(1, $lastId, PDO::PARAM_INT);
                $stmt->bindValue(2, $dataForm['prod_company'], PDO::PARAM_STR);
                $stmt->bindValue(3, $dataForm['model_info'], PDO::PARAM_STR);
                $stmt->bindValue(4, $dataForm['plate_number'], PDO::PARAM_STR);
                
                $res = $stmt->execute();
                if(!$res) 
                    throw new PDOException('failed Insert Vehicle');
            }
            catch(Exception $e)  {  //Some error occured. (i.e. violation of constraints)
                GlobalData::SetDebug($szQuery);
                throw $e;
            }
            catch(PDOException $e) {
                GlobalData::SetDebug($szQuery);
                if(stripos($e->getMessage(), 'DATABASE IS LOCKED') !== false) {
                    // This should be specific to SQLite, sleep for 0.25 seconds
                    // and try again.  We do have to commit the open transaction first though
                    usleep(250000);
                } else {
                    GlobalData::SetDebug($szQuery);
                    throw $e;
                }
                return false;
            }
            return true;
        }

        // related in Services 
        private static function InsertServices($lastId,$dataServices) {
            // check count
            if(count($dataServices) < 1)
                return true;

            // insert query
            $szQuery = "INSERT into services (";
            $szQuery .= "s_owner_uid";
            $szQuery .= ",s_type";
            $szQuery .= ") VALUES (?,?)";

            //echo 'query='.$szQuery;

            try {
                // first of all, add Vechicle 
                $stmt = dbCon::GetConnection()->prepare($szQuery);
                foreach( $dataServices as $val) {
                    $stmt->bindValue(1, $lastId, PDO::PARAM_INT);
                    $stmt->bindValue(2, $val, PDO::PARAM_INT);
                   
                    $res = $stmt->execute();
                    if(!$res) 
                        throw new PDOException('failed Insert Services');
                }
            }
            catch(Exception $e)  {  //Some error occured. (i.e. violation of constraints)
                GlobalData::SetDebug($szQuery);
                throw $e;
            }
            catch(PDOException $e) {
                GlobalData::SetDebug($szQuery);
                if(stripos($e->getMessage(), 'DATABASE IS LOCKED') !== false) {
                    // This should be specific to SQLite, sleep for 0.25 seconds
                    // and try again.  We do have to commit the open transaction first though
                    usleep(250000);
                } else {
                    GlobalData::SetDebug($szQuery);
                    throw $e;
                }
                return false;
            }
            return true;
        }


        // delete user account
        public static function DeleteUserById($user_id) {
            if(strlen(trim($user_id) < 1)) {
                self::$err_msg = 'need a userid';
                return false;
            }
            $szQuery = "delete from account where user_id = '".$user_id."'";
            
            try {
                $res = dbCon::GetConnection()->exec($szQuery);
                if(!empty($res) && $res > 0)
                   return true;
                self::$err_msg = 'not exist userid';
            }
            catch(Exception $e) { //Some error occured. (i.e. violation of constraints)
                echo $e;
            }
            return false;
        }

        public static function DeleteUserByUid($uid) {
            if(strlen(trim($uid) < 1)) {
                self::$err_msg = 'need a uid';
                return false;
            }
            $szQuery = "delete from account where uid = ".$uid;
            
            try {
                $res = dbCon::GetConnection()->exec($szQuery);
                if(!empty($res) && $res > 0)
                   return true;
                self::$err_msg = 'not exist uid';
            }
            catch(Exception $e) { //Some error occured. (i.e. violation of constraints)
                echo $e;
            }
            return false;
        }
    }



?>