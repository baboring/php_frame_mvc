<?php
    require_once ('_server/libs/db_connect.php');
    require_once ('_server/libs/paginavigator.php');

    // List of Record 
    class DataResult_RecordList extends Paginator  {

        public $err_msg;
        public $data;

        public function __construct($u_uid = null,$sort = 'r_date', $limit = 10) {//private constructor: 

            parent::__construct();
            //using mysql to find out total records
            $szCount = "Select count(*) from records";
            if(null != $u_uid)
                $szCount .= " where u_uid = '".$u_uid."' "; 
            $totalRecords = dbCon::GetConnection()->query($szCount);
            if($limit != null)
                $this->itemsPerPage = $limit;
            $this->total = $totalRecords->fetchColumn() / $this->itemsPerPage;
            $count = $totalRecords->fetchColumn();
            $this->total = ceil($count / $this->itemsPerPage);
            $this->textNav = true;
            parent::paginate();
        
            // look up records
            $szQuery = "select R.r_uid, concat(C.first_name,' ',C.last_name) as `Name`, R.s_uid, R.r_desc, R.r_status, R.r_date ";
            $szQuery .= ' from records as R ';
            $szQuery .= ' inner join client as C ';
            $szQuery .= ' on R.u_uid = C.u_uid ';

            if(null != $u_uid)
                $szQuery .= " where R.u_uid = '".$u_uid."' "; 
            if(null != $sort)
                $szQuery .= " order by ".$sort." desc "; 
                
            $szQuery .= " limit ".parent::beginNumber().','.$this->itemsPerPage; 

                
            //echo $szQuery;
            $res =  dbCon::GetConnection()->query($szQuery);
            $this->data = $res->fetchAll(PDO::FETCH_ASSOC);

            return true;
             
        }

    }

?>