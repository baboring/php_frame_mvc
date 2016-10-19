<?php
    require_once ('_server/libs/db_connect.php');
    require_once ('_server/libs/paginavigator.php');

    // result data of login 
    class DataResult_BusinessList extends Paginator {

        public $err_msg;
        public $data;

        public function __construct($key = null,$val = null) {//private constructor: 
            parent::__construct();
            //using mysql to find out total records
            $totalRecords = dbCon::GetConnection()->query("Select count(*) from business");
            $this->textNav = true;
            parent::paginate($totalRecords->fetchColumn());

            $szQuery = 'Select ';
            $szQuery .= 'bid as `no` ';
            $szQuery .= ',u_uid ';
            $szQuery .= ',b_name as `Business Name` ';
            $szQuery .= ',email as `Email` ';
            $szQuery .= ',tel as `Tel` ';
            $szQuery .= ' from business ';
            switch($key) {
                case 'name':
                    $szQuery .= ' where `b_name` like  "%'.$val.'%" ';
                    break;
                case 'email':
                    $szQuery .= ' where `email` like  "%'.$val.'%" ';
                    break;
            }
            $szQuery .= ' LIMIT '.parent::beginNumber().','.$this->itemsPerPage;
            //echo $szQuery;
            //get record from database and show
            $records = dbCon::GetConnection()->query($szQuery);
            $this->data = $records->fetchAll(PDO::FETCH_ASSOC);
        }

    }

?>