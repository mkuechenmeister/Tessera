<?php
    /**
     * Created by PhpStorm.
     * User: Martin
     * Date: 11.02.2019
     * Time: 21:36
     */

    require_once("DatabaseObject.php");


    class Userstatus implements DatabaseObject
    {
        private $id;
        private $name;

        /**
         * Userstatus constructor.
         * @param $id
         * @param $name
         */
        public function __construct($id, $name)
        {
            $this->id = $id;
            $this->name = $name;
        }

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * @param mixed $name
         */
        public function setName($name)
        {
            $this->name = $name;
        }

        public function create()
        {
            $db = Database::connect();
            $sql = "INSERT INTO tbl_user_status (pk_user_status_id, name) VALUES (?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($this->id, $this->desc));
            $lastId = $db->lastInsertId();
            Database::disconnect();
            return $lastId;
        }

        public static function createNew($name)
        {
            $db = Database::connect();
            $sql = "INSERT INTO tbl_user_status (name) values (?)";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($name));
            $lastId = $db->lastInsertId();
            Database::disconnect();
            return $lastId;
        }

        /**
         * Update an existing object in the database
         * @return boolean true on success
         */
        public function update()
        {
            $db = Database::connect();
            $sql = "UPDATE tbl_user_status set name = ? where pk_user_status_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($this->name, $this->id));
            Database::disconnect();
        }

        /**
         * Get an object from database
         * @param integer $id
         * @return object single object or null
         */
        public static function get($id)
        {

            if (!is_numeric($id)) {
                return null;
            }

            $db = Database::connect();
            $sql = "Select * from tbl_user_status where pk_user_status_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            $ust = $stmt->fetch(PDO::FETCH_NUM);
            Database::disconnect();

            return $ust == null ? null : new Userstatus($ust[0], $ust[1]);
        }

        /**
         * Get an array of objects from database
         * @return array array of objects or empty array
         */
        public static function getAll()
        {
            $db = Database::connect();
            $sql = "Select * from tbl_user_status order by name asc";
            $stmt = $db->prepare($sql);
            $stmt->execute(array());
            $ust = $stmt->fetchAll(PDO::FETCH_NUM);
            Database::disconnect();
            $data = [];
            if ($ust == null) {
                return null;
            }else {



                foreach ($ust as $item) {


                    $data[] = new Userstatus($item[0], $item[1]);
                }
                return $data;
            }
        }

        /**
         * Deletes the object from the database
         * @param integer $id
         * @return returns null if unable to perform operation
         */
        public static function delete($id)
        {

            if (!is_numeric($id)) {
                return null;
            }
            $db = Database::connect();
            $sql = "DELETE FROM tbl_user_status WHERE pk_user_status_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            Database::disconnect();
        }

        public static function getUserstatusByName($name)


        {
            if (!is_string($name)) {
                return null;
            }

            $name = strtolower($name);
            $db = Database::connect();
            $sql = "Select * from tbl_user_status where lower(name) = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($name));
            $us = $stmt->fetch(PDO::FETCH_NUM);
            Database::disconnect();

            return $us == null ? null : new Userstatus($us[0], $us[1]);

        }

        public static function exists($name)
        {
            $res = self::getUserstatusByName($name);
            return $res == null ? false : true;
        }


    }