<?php

class BaseModel {

    private $db;
	

	
	public function __construct(){

		//var_dump($dbConf);
		$this->dsn =  "mysql:dbname=".DBNAME.";host=".DBHOST;
		$this->username = DBUSER;
		$this->password = DBPASS;
	}

    public function conn() {
        if (!$this->db instanceof PDO) {
			
            $this->db
                    = new PDO($this->dsn, $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
        }
    }


    public function getAffectedRows() {
        return $this->stmt->rowCount();
    }



    public function selectAll($columns = '*', $where = NULL, $orderby = NULL, $limit = NULL, $start = NULL, $params = NULL
    ) {
        try {
            $columns = is_array($columns) ? implode(",", $columns) : $columns;


            $where = is_null($where) ? '' : " where " . implode(" and ", $where);
            $orderby = is_null($orderby) ? '' : " order by " . implode(', ', $orderby);
            $limit = is_numeric($limit) ? " limit " . (is_numeric($start) ? "$start, " : " ") . $limit : "";


            $sql = "SELECT $columns FROM " . $this->table . " $where $orderby $limit";
            $this->conn();

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);


            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        } catch (Exception $err) {
            throw $err;
        }
        return TRUE;
    }

    public function selectOne($columns = '*', $where = NULL, $params = NULL) {
        try {

            $columns = is_array($columns) ? implode(",", $columns) : $columns;
            $where = is_null($where) ? '' : " where " . implode(" and ", $where);


            $sql = "SELECT $columns FROM " . $this->table . " $where";
            
            $this->conn();
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (Exception $err) {
            throw $err;
        }
        return TRUE;
    }

    public function update($values, $where = NULL, $params = NULL, $limit = NULL) {
        try {
            $this->conn();
            $values = self::quoteArrayParams($values);
            foreach ($values as $key => &$value) {
                $value = "$key = $value";
            }
            $values = implode(', ', $values);
            $where = is_null($where) ? '' : " where " . implode(" and ", $where);
            $sql = "UPDATE " . $this->table . " SET $values $where $limit";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $rowcount = $stmt->rowCount();
            return $rowcount;
        } catch (Exception $err) {
            throw $err;
        }
        return TRUE;
    }

    private function quoteArrayParams($values) {
        foreach ($values as &$value) {
            if (is_null($value)) {
                $value = 'NULL';
            } elseif (is_numeric($value)) {
                if (substr($value, 0, 1) == '0' && substr($value, 0, 1) !== FALSE) {
                    $value = $this->db->quote($value);
                } else {
                    $value = $value;
                }
            } elseif (!is_numeric($value)) {
                $value = $this->db->quote($value);
            }
        }
        
        return $values;
    }

    public function runQuery($sql, $params = NULL) {
        try {
            $this->conn();
            $stmt = $this->db->query($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO :: FETCH_ASSOC);
        } catch (Exception $err) {
            throw $err;
        }
        return TRUE;
    }

    public function runSQL($sql, $params = NULL) {
        try {
            $this->conn();
            $stmt = $this->db->query($sql);
        } catch (Exception $err) {
            throw $err;
        }
    }



    public function insert($values = array(), $ignore = NULL, $params = NULL) {
        if ($ignore) {
            $ignore = 'IGNORE';
        }
        try {
            $this->conn();
            $values = self::quoteArrayParams($values);
            $keys = implode(', ', array_keys($values));
            $values = implode(', ', $values);
            $sql = "INSERT $ignore INTO " . $this->table . " ($keys) VALUES ($values)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $id = $this->db->lastInsertId();
            return $id;
        } catch (Exception $err) {
            throw $err;
        }
        return TRUE;
    }






    public function replace($values = array(), $params = NULL) {
          try {
            $this->conn();
            $values = self::quoteArrayParams($values);
            $keys = implode(', ', array_keys($values));
            $values = implode(', ', $values);
            $sql = "REPLACE INTO `" . $this->table . "` ($keys) VALUES ($values)";
	        $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $id = $this->db->lastInsertId();
            return $id;
        } catch (Exception $err) {
            throw $err;
        }
        return TRUE;
    }



    public function delete($where = NULL, $params = NULL, $inlist = NULL) {
        try {
            $where = is_null($where) ? '' : " where " . implode(" and ", $where);
            $inlist = is_null($inlist) ? '' : self::in_list($inlist);
            $sql = "DELETE FROM " . $this->table . " $where $inlist";
            $this->conn();
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $rowcount = $stmt->rowCount();
            return $rowcount;
        } catch (Exception $err) {
            throw $err;
        }
        return TRUE;
    }

    public function count($count = '*', $where = null, $params = null)
    {
        try {
            $where = is_null($where) ? '' : " where " . implode(" and ", $where);
            $sql = "SELECT count($count) as total FROM " . $this->table . " $where";
			$this->conn();
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);
            return $rows['total'];
        } catch (Exception $err) {
            throw $err;
        }
        return true;
    }



    public function in_list($data = array()) {
        $output = ' in(';

        foreach ((array) $data as $value) {
            $output .= self :: getInstance()->quote($value) . ',';
        }
        return rtrim($output, ',') . ')';
    }

}