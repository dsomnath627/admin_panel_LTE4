<?php

// db connection constants

$hostname = 'localhost';
$username = 'root';
$dbname = 'adminpanel1';
$password = '';


// current date and time
date_default_timezone_set("Asia/Calcutta");
$date_added = date("Y-m-d H:i:s");


class Operations
{

    protected $db;

    function __construct()
    {
        global $db;
        global $hostname;
        global $username;
        global $dbname;
        global $password;

        try {
            $db = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            // print_r($db);
            // echo "Connected to $dbname at $host successfully.";
        } catch (PDOException $pe) {
            die("Could not connect to the db $dbname :" . $pe->getMessage());
        }
    }

    public function getAll($table)
    {

        global $db;

        $sel  =  $db->query("select * from " . $table . "");
        return $sel->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getDistinct($table, $column)
    {

        global $db;

        $sel  =  $db->query("select DISTINCT " . $column . " from " . $table . "");
        return $sel->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCounts($table, $where)
    {

        global $db;

        $sel  =  $db->query("select count(*) from " . $table . " WHERE " . $where);
        // $sel  =  $db->query("select count(*) from `businessloans` WHERE status=0");
        // select count(*) from `businessloans` WHERE status=0;

        return $number_of_rows = $sel->fetchColumn();
        // echo $number_of_rows = $sel->fetchColumn();

        // print_r($number_of_rows);
    }

    public function getrowCount($table)
    {

        global $db;

        $sel  =  $db->query("select count(*) from " . $table . " ");

        return $number_of_rows = $sel->fetchColumn();
    }


    // RANGE
    public function getDateRange($table, $date1, $date2)
    {

        global $db;

        $sel  =  $db->query("select * from " . $table . " WHERE date_field BETWEEN " . $date1 . " AND " . $date2 . "");

        return $number_of_rows = $sel->fetchColumn();
    }




    // registration
    public function insert($table, $data)
    {

        global $db;

        $fields = array_keys($data);

        // echo "<pre/>";
        // print_r($fields);



        $sql = "INSERT INTO " . $table . "(" . implode(',', $fields) . ")";

        // insert into register (fname,lname)

        $sets = array();

        foreach ($data as $column => $value) {
            $sets[] =  ":" . $column;
        }


        //echo "<pre/>";
        // print_r($sets);




        $sql .= "values(" . implode(', ', $sets) . ")";  // values($fname,$lname)

        $stmt = $db->prepare($sql);

        //$data['f_name'];

        $final_bind = array();



        foreach ($data as $column => $value) {

            $final_bind[] =  $value;
        }

        $stmt->execute($final_bind);

        $id = $db->lastInsertId();
        return $id;
    }






    // login
    public function getSingle($table, $where)
    {

        global $db;


        $sel  =  $db->query("select * from " . $table . " where " . $where);

        return $sel->fetch(PDO::FETCH_ASSOC);
    }

    public function getLogin($table, $where)
    {

        global $db;

        $sel  =  $db->query("select * from " . $table . "  where " . $where);

        return $number_of_rows = $sel->fetchColumn();
        
    }




    // Update
    public function update($table, $data, $id)
    {

        global $db;

        $sql = "UPDATE " . $table . " SET ";

        // loop and build the column /
        $sets = array();

        foreach ($data as $column => $value) {
            $sets[] = $column . " = :" . $column;
        }

        $sql .= implode(', ', $sets);

        $sql .= '  where id = :id';

        $stmt = $db->prepare($sql);
        $final_bind = array();

        foreach ($data as $column => $value) {

            $final_bind[] =  $value;
        }

        $ids =  array('id' => $id);

        $final_bind = array_merge($final_bind, $ids);

        $stmt->execute($final_bind);
        // print_r($stmt);
    }



    public function walletUpdate($table, $data, $id)
    {

        global $db;

        $sql = "UPDATE " . $table . " SET ";

        // loop and build the column /
        $sets = array();

        foreach ($data as $column => $value) {
            $sets[] = $column . " = :" . $column;
        }

        $sql .= implode(', ', $sets);

        $sql .= '  where emp_id = :emp_id';

        $stmt = $db->prepare($sql);
        $final_bind = array();

        foreach ($data as $column => $value) {

            $final_bind[] =  $value;
        }

        $ids =  array('emp_id' => $id);

        $final_bind = array_merge($final_bind, $ids);

        $stmt->execute($final_bind);
        // print_r($stmt);
    }



    public function loan_update($table, $data, $id)
    {

        global $db;

        $sql = "UPDATE " . $table . " SET ";

        // loop and build the column /
        $sets = array();

        foreach ($data as $column => $value) {
            $sets[] = $column . " = :" . $column;
        }

        $sql .= implode(', ', $sets);

        $sql .= '  where customer_id = :customer_id';

        $stmt = $db->prepare($sql);
        $final_bind = array();

        foreach ($data as $column => $value) {

            $final_bind[] =  $value;
        }

        $ids =  array('customer_id' => $id);

        $final_bind = array_merge($final_bind, $ids);

        $stmt->execute($final_bind);
    }



    //IpAddress
    public function getUserIP()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }




    // DELETE
    public function delete($table, $id)
    {

        global $db;

        $sql = "delete from " . $table . " where id =:id";

        $stmt = $db->prepare($sql);

        $stmt->execute(array(':id' => $id));
    }



    public function getJoin($table)
    {

        global $db;

        $table2 = 'employees_profile';

        $sel  =  $db->query("SELECT employees.id , employees_profile.employee_id
            FROM ((" . $table . "
            INNER JOIN employees ON " . $table . ".id = employees.id)
            INNER JOIN employees_profile ON " . $table2 . ".employee_id = employees_profile.employee_id)");

        return $sel->fetchAll(PDO::FETCH_ASSOC);
    }

    public function join_records()
    {


        global $db;

        $select = $db->query("SELECT * FROM customers LEFT JOIN loans ON customers.customer_id = loans.id ORDER BY customers.customer_id");

        return $select->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getList($table, $where)
    {

        global $db;

        $sel  =  $db->query("select * from " . $table . " where " . $where);

        //echo "select * from ".$table . "  " .$where;

        return $sel->fetchAll(PDO::FETCH_ASSOC);
    }

    public function convertToUnixTimestamp($value)
    {

        list($date, $time) = explode(' ', $value);
        list($year, $month, $day) = explode('-', $date);
        list($hour, $minutes, $seconds) = explode(':', $time);

        $unit_timestamp = mktime($hour, $minutes, $seconds, $month, $day, $year);

        return $unit_timestamp;
    }

    public function convertToAgoFormat($timestamp)
    {
        $differentBtwCurrentTimeandTimestamp = time() - $timestamp;
        $periodsString = ["sec", "min", "hr", "day", "week", "month", "year", "decade"];
        $periodsNumber = ["60", "60", "24", "7", "4.35", "12", "10"];

        for ($iterator = 0; $differentBtwCurrentTimeandTimestamp >= $periodsNumber[$iterator]; $iterator++)
            $differentBtwCurrentTimeandTimestamp /= $periodsNumber[$iterator];
        $differentBtwCurrentTimeandTimestamp = round($differentBtwCurrentTimeandTimestamp);

        if ($differentBtwCurrentTimeandTimestamp != 1) $periodsString[$iterator] .= "s";

        $output = "$differentBtwCurrentTimeandTimestamp $periodsString[$iterator]";

        return "Posted " . $output . " ago.";
    }

    public function convertToTimeFormat($timestamp)
    {
        $differentBtwCurrentTimeandTimestamp = time() - $timestamp;
        $periodsString = ["sec", "min", "hr", "day", "week", "month", "year", "decade"];
        $periodsNumber = ["60", "60", "24", "7", "4.35", "12", "10"];

        for ($iterator = 0; $differentBtwCurrentTimeandTimestamp >= $periodsNumber[$iterator]; $iterator++)
            $differentBtwCurrentTimeandTimestamp /= $periodsNumber[$iterator];
        $differentBtwCurrentTimeandTimestamp = round($differentBtwCurrentTimeandTimestamp);

        if ($differentBtwCurrentTimeandTimestamp != 1) $periodsString[$iterator] .= "s";

        $output = "$differentBtwCurrentTimeandTimestamp $periodsString[$iterator]";

        // return "Posted " . $output . " ago.";
        return $output;
    }

    public function getLatest($table)
    {

        global $db;

        $sel  =  $db->query("select * from " . $table . " ORDER BY id DESC LIMIT 1");
        return $sel->fetch(PDO::FETCH_ASSOC);
    }

    public function getTotalAmount($table, $where)
    {
        global $db;

        try {
            // Prepare the SQL query using the correct column name 'lead_loan_amt'
            $query = "SELECT SUM(lead_loan_amt) as total_amount FROM $table WHERE $where";

            // Prepare the statement
            $stmt = $db->prepare($query);

            // Execute the statement
            $stmt->execute();

            // Fetch the result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Return the total amount or 0 if no amount is found
            return isset($result['total_amount']) ? $result['total_amount'] : 0;
        } catch (PDOException $e) {
            // Handle any errors
            echo "Error: " . $e->getMessage();
            return 0; // Return 0 in case of an error
        }
    }
}
