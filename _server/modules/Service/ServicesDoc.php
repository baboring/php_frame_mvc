<?php
    require_once ('_server/libs/db_connect.php');

    // Services Model Data
    class ServicesDoc {

        const FormArgs = array(
                "r_uid",
                "v_uid",
                "u_uid",
                "s_uid",
                "r_desc",
                "services", // array
            );

        public static $err_msg;

        public static function GetDataResult_ServiceTypes() {
            require_once ('_server/models/DataResult_ServiceTypes.php');

            return new DataResult_ServiceTypes();
        }
        public static function GetDataResult_RecordList() {
            require_once ('_server/models/DataResult_RecordList.php');

            return new DataResult_RecordList();
        }

        // add record
        public static function AddRecord($dataForm) {

            try {
                if(empty($dataForm) || count($dataForm) < 1)
                    throw new PDOException('Error : User id is empty');

                /* Begin a transaction, turning off autocommit */
                if(!dbCon::beginTransaction()) 
                    throw new PDOException('Failed : beginTransaction');
               
                // insert service record
                $lastId = self::InsertRecord($dataForm);

                // insert tasks
                self::InsertTasks($lastId, $dataForm);

                dbCon::commit();
            }
            catch(Exception $e)  {  //Some error occured. (i.e. violation of constraints)
                self::$err_msg = 'Error : '.$e->getMessage();
                GlobalData::SetDebug($e);
                return false;
            }
            catch(PDOException $e) {
                self::$err_msg = 'Error : '.$e->getMessage();
                GlobalData::SetDebug($e);
                if(stripos($e->getMessage(), 'DATABASE IS LOCKED') !== false) {
                    // This should be specific to SQLite, sleep for 0.25 seconds
                    // and try again.  We do have to commit the open transaction first though
                    usleep(250000);
                } else {
                    throw $e;
                }
                dbCon::rollback();
                return false;
            }

            return true;
        }

        // Insert Service Record
        private static function InsertRecord($dataForm) {
            // insert query
            $szQuery = "INSERT into records (";
            $szQuery .= "u_uid";
            $szQuery .= ",s_uid";
            $szQuery .= ",r_desc";
            $szQuery .= ") VALUES (?,?,?)";

            //echo 'query='.$szQuery;

            try {
                // first of all, add client 
                $stmt = dbCon::GetConnection()->prepare($szQuery);

                if (!$stmt) {
                    echo "\nPDO::errorInfo():\n";
                    print_r($dbCon::GetConnection()->errorInfo());
                }

                $stmt->bindValue(1, $dataForm['u_uid'], PDO::PARAM_INT);
                $stmt->bindValue(2, $dataForm['s_uid'], PDO::PARAM_INT);
                $stmt->bindValue(3, $dataForm['r_desc'], PDO::PARAM_STR);


                $res = $stmt->execute();
                if(!$res) {
                    //var_dump( dbCon::GetConnection()->errorInfo() );
                    var_dump( $dataForm );
                    throw new PDOException('failed Insert Record :<br>'.$szQuery);
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

        // Insert Service Tasks
        private static function InsertTasks($lastId, $dataForm) {
            // insert query
            $szQuery = "INSERT into task (";
            $szQuery .= "r_uid";
            $szQuery .= ",v_uid";
            $szQuery .= ",s_uid";
            $szQuery .= ",t_desc";
            $szQuery .= ") VALUES (?,?,?,?)";

            //echo 'query='.$szQuery;

            $v_uid = $dataForm['v_uid'];
            $t_desc = '';
            $dataServices = $dataForm['services'];

            try {
                // first of all, add client 
                //var_dump($dataServices);
                $stmt = dbCon::GetConnection()->prepare($szQuery);
                foreach( $dataServices as $val) {
                    $stmt->bindValue(1, $lastId, PDO::PARAM_INT);
                    $stmt->bindValue(2, $v_uid, PDO::PARAM_INT);
                    $stmt->bindValue(3, $val, PDO::PARAM_INT);
                    $stmt->bindValue(4, $t_desc, PDO::PARAM_STR);// $val['t_desc'], PDO::PARAM_STR);

                    $res = $stmt->execute();
                    if(!$res) 
                        throw new PDOException('failed Insert Tasks :<br>'.$szQuery.'['.$lastId.','.$v_uid.','.$val.','.$t_desc.']');
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
    }

?>