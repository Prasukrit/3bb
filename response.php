
<?php
	//include connection file 

	
	include_once("connection.php");
	 
	/*
     * @param (string) SQL Query
     * @return multidim array containing data array(array('column1'=>value2,'column2'=>value2...))
     *
     */
    function getData($sql){
        global $conn ;//we use connection already opened
        $query = mysqli_query($conn, $sql) OR DIE ("Can't get Data from DB , check your SQL Query " );
        $data = array();
        foreach ($query as $row ) {
            $data[] = $row ;
        }
        return $data;
    }

    /* Useful $_POST Variables coming from the plugin */
    $draw = $_POST["draw"];//counter used by DataTables to ensure that the Ajax returns from server-side processing requests are drawn in sequence by DataTables
    $orderByColumnIndex  = $_POST['order'][0]['column'];// index of the sorting column (0 index based - i.e. 0 is the first record)
    $orderBy = $_POST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
    $orderType = $_POST['order'][0]['dir']; // ASC or DESC
    $start  = $_POST["start"];//Paging first record indicator.
    $length = $_POST['length'];//Number of records that the table can display in the current draw
    /* END of POST variables */

    $recordsTotal = count(getData("SELECT * FROM ".MyTable));

    /* SEARCH CASE : Filtered data */
    if(!empty($_POST['search']['value'])){

        /* WHERE Clause for searching */
        for($i=0 ; $i<count($_POST['columns']);$i++){
            $column = $_POST['columns'][$i]['data'];//we get the name of each column using its index from POST request
            $where[]="$column like '%".$_POST['search']['value']."%'";
        }
        $where = "WHERE ".implode(" OR " , $where);// id like '%searchValue%' or name like '%searchValue%' ....
        /* End WHERE */

        $sql = sprintf("SELECT * FROM %s %s", MyTable , $where);//Search query without limit clause (No pagination)

        $recordsFiltered = count(getData($sql));//Count of search result

        /* SQL Query for search with limit and orderBy clauses*/
        $sql = sprintf("SELECT * FROM %s %s ORDER BY %s %s limit %d , %d ", MyTable , $where ,$orderBy, $orderType ,$start,$length  );
        $data = getData($sql);
    }
    /* END SEARCH */
    else {
        $sql = sprintf("SELECT * FROM %s ORDER BY %s %s limit %d , %d ", MyTable ,$orderBy,$orderType ,$start , $length);
        $data = getData($sql);

        $recordsFiltered = $recordsTotal;
    }

    /* Response to client before JSON encoding */
    $response = array(
        "draw" => intval($draw),
        "recordsTotal" => $recordsTotal,
        "recordsFiltered" => $recordsFiltered,
        "data" => $data
    );

    $RAW_SQL_QUERY="select * from project where status = 1";
 
	$r=$db ->sql($RAW_SQL_QUERY)->fetchAll();
	$arr=array("data"=>$r,"options"=>'',"files"=>'');//DATATABLE CLIENT SIDE PARSES
	echo json_encode($arr);
	exit();


    echo json_encode($response);

?>
