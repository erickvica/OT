<?php

class DB_Functions {

    private $db;

    //put your code here
    // constructor
    function __construct() {
        include_once 'db_connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }

    // destructor
    function __destruct() {
        
    }

    /**
     * Storing new user
     * returns user details
     */
    public function storeUser( $gcm_regid, $iduser) {
        // insert user into database
        $result = mysql_query("INSERT INTO gcm_users( gcm_regid, id_usuario) VALUES('$gcm_regid','$iduser');");
//        $result ="INSERT INTO gcm_users( gcm_regid, id_usuario) VALUES('$gcm_regid','$iduser')";
        // check for successful store
        if ($result) {
            // get user details
            $id = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM gcm_users WHERE id = $id") or die(mysql_error());
            // return user details
            if (mysql_num_rows($result) > 0) {
                return mysql_fetch_array($result);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function initUser($idUser) {
        // insert user into database
        $result = mysql_query("INSERT INTO history_init(idUser) VALUES('$idUser')");
        // check for successful store
        if ($result) {
            // get user details
            $id = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM history_init WHERE id = $id") or die(mysql_error());
            // return user details
            if (mysql_num_rows($result) > 0) {
                return mysql_fetch_array($result);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    /**
     * Storing new gps
     * returns user details
     */
    public function storeUserGPS($latitud, $longitud, $gcm_regid) {
        // insert user into database
        $result = mysql_query("INSERT INTO gps_users(latitud, longitud, gcm_regid, created_at) VALUES('$latitud', '$longitud', '$gcm_regid', NOW())");
        // check for successful store
        if ($result) {
            // get user details
            $id = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM gps_users WHERE id = $id") or die(mysql_error());
            // return user details
            if (mysql_num_rows($result) > 0) {
                return mysql_fetch_array($result);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Get user by exp and password
     */
    public function getUserByExp($exp) {
        $result = mysql_query("SELECT * FROM gcm_users WHERE exp = '$exp' LIMIT 1");
        return $result;
    }

    /**
     * Getting all users
     */
    public function getAllUsers() {
        $result = mysql_query("select * FROM gcm_users");
        return $result;
    }

/**
     * Getting all gcms
     */
    public function getAllGcmIds() {
        $result = mysql_query("select gcm_regid from gcm_users");
        return $result;
    }

/**
     * Getting all channels
     */
    public function getAllChannels() {
        $result = mysql_query("select * from canal");
        return $result;
    }
    public function getIdOT($iduser){
        $resultb=1;
        $result = mysql_query("SELECT id_usuario FROM gcm_users WHERE id_usuario = $iduser");
        if(mysql_num_rows($result) > 0)
            $resultb=0;
        return $resultb;
    }


    /**
     * Check user is existed or not
     */
    public function isUserExisted($exp) {
        $result = mysql_query("SELECT exp from gcm_users WHERE exp = '$exp'");
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed
            return true;
        } else {
            // user not existed
            return false;
        }
    }

}
?>
