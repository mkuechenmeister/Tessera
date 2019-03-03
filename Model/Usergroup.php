<?php
    /**
     * Created by PhpStorm.
     * User: Martin
     * Date: 11.02.2019
     * Time: 21:13
     */

    require_once("DatabaseObject.php");


    class Usergroup implements DatabaseObject
    {
        private $id;
        private $name;

        /**
         * Usergroup constructor.
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
            $sql = "INSERT INTO tbl_user_group (pk_User_group_id, name) VALUES (?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($this->id, $this->name));
            $lastId = $db->lastInsertId();
            Database::disconnect();
            return $lastId;
        }

        public static function createNew($name)
        {
            $db = Database::connect();
            $sql = "INSERT INTO tbl_user_group (name) values (?)";
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
            $sql = "UPDATE tbl_user_group set name = ? where pk_User_group_id = ?";
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
            $sql = "Select * from tbl_user_group where pk_User_group_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            $b = $stmt->fetch(PDO::FETCH_NUM);
            Database::disconnect();

            return $b == null ? null : new Usergroup($b[0], $b[1]);
        }

        /**
         * Get an array of objects from database
         * @return array array of objects or empty array
         */
        public static function getAll()
        {
            $db = Database::connect();
            $sql = "Select * from tbl_user_group order by name asc";
            $stmt = $db->prepare($sql);
            $stmt->execute(array());
            $ug = $stmt->fetchAll(PDO::FETCH_NUM);
            Database::disconnect();
            $data = [];
            if ($ug == null) {
                return null;
            }else {



                foreach ($ug as $item) {


                    $data[] = new Usergroup($item[0], $item[1]);
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
            $sql = "DELETE FROM tbl_user_group WHERE pk_User_group_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            Database::disconnect();
        }

        public static function getUsergroupByName($name)


        {
            if (!is_string($name)) {
                return null;
            }

            $name = strtolower($name);
            $db = Database::connect();
            $sql = "Select * from tbl_user_group where lower(name) = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($name));
            $ug = $stmt->fetch(PDO::FETCH_NUM);
            Database::disconnect();

            return $ug == null ? null : new Usergroup($ug[0], $ug[1]);

        }

        public static function exists($name)
        {
            $res = self::getUsergroupByName($name);
            return $res == null ? false : true;
        }

    }