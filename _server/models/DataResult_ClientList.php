<?php
    require_once ('_server/libs/db_connect.php');
    require_once ('_server/libs/paginavigator.php');

    // result data of login 
    class DataResult_ClientList extends Paginator {

        public $err_msg;
        public $data;

        public function __construct($key = null,$val = null) {//private constructor: 
            parent::__construct();
            //using mysql to find out total records
            $totalRecords = dbCon::GetConnection()->query("Select count(*) from client");
            $count = $totalRecords->fetchColumn();
            $this->total = ceil($count / $this->itemsPerPage);
            $this->textNav = true;
            parent::paginate();

            $szQuery = 'Select ';
            $szQuery .= 'cid as `no` ';
            $szQuery .= ',u_uid ';
            $szQuery .= ',first_name ';
            $szQuery .= ',last_name ';
            $szQuery .= ',email as `Email` ';
            $szQuery .= ',tel as `Tel` ';
            $szQuery .= ' from client ';
            switch($key) {
                case 'name':
                    $szQuery .= ' where `first_name` like  "%'.$val.'%" ';
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