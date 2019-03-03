<?php
    /**
     * Created by PhpStorm.
     * User: Martin
     * Date: 11.02.2019
     * Time: 16:16
     */
    require_once("DatabaseObject.php");

    class Department implements DatabaseObject
    {

        private $id;
        private $name;

        /**
         * Department constructor.
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

        /**
         * Creates a new object in the database
         * @return integer ID of the newly created object (lastInsertId)
         */
        public function create()
        {
            $db = Database::connect();
            $sql = "INSERT INTO tbl_department (pk_department_id, name) VALUES (?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($this->id, $this->desc));
            $lastId = $db->lastInsertId();
            Database::disconnect();
            return $lastId;
        }

        public static function createNew($name)
        {
            $db = Database::connect();
            $sql = "INSERT INTO tbl_department (name) values (?)";
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
            $sql = "UPDATE tbl_department set name = ? where pk_department_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($this->desc, $this->id));
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
            $sql = "Select * from tbl_department where pk_department_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            $d = $stmt->fetch(PDO::FETCH_NUM);
            Database::disconnect();

            return $d == null ? null : new Department($d[0], $d[1]);
        }

        /**
         * Get an array of objects from database
         * @return array array of objects or empty array
         */
        public static function getAll()
        {
            $db = Database::connect();
            $sql = "Select * from tbl_department order by name asc";
            $stmt = $db->prepare($sql);
            $stmt->execute(array());
            $d = $stmt->fetchAll(PDO::FETCH_NUM);
            Database::disconnect();
            $data = [];
            if ($d == null) {
                return null;
            }else {



                foreach ($d as $item) {


                    $data[] = new Department($item[0], $item[1]);
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
            $sql = "DELETE FROM tbl_department WHERE pk_department_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            Database::disconnect();
        }

        public static function getDepartmentByName($name)
        {
            if (!is_string($name)) {
                return null;
            }
            $name = strtolower($name);
            $db = Database::connect();
            $sql = "Select * from tbl_department where lower(name) = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($name));
            $d = $stmt->fetch(PDO::FETCH_NUM);
            Database::disconnect();

            return $d == null ? null : new Department($d[0], $d[1]);

        }

        public static function exists($name)
        {
            $res = self::getDepartmentByName($name);

            return $res == null ? false : true;
        }


    }