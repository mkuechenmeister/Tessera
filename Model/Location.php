<?php
    /**
     * Created by PhpStorm.
     * User: Martin
     * Date: 11.02.2019
     * Time: 16:24
     */

    require_once("DatabaseObject.php");


    class Location implements DatabaseObject
    {
        private $id;
        private $name;
        private $description;

        /**
         * Location constructor.
         * @param $id
         * @param $name
         * @param $description
         */
        public function __construct($id, $name, $description)
        {
            $this->id = $id;
            $this->name = $name;
            $this->description = $description;
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
         * @return mixed
         */
        public function getDescription()
        {
            return $this->description;
        }

        /**
         * @param mixed $description
         */
        public function setDescription($description)
        {
            $this->description = $description;
        }

        public function create()
        {
            $db = Database::connect();
            $sql = "INSERT INTO tbl_location (pk_location_id, name , beschreibung) VALUES (?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($this->id, $this->name, $this->description));
            $lastId = $db->lastInsertId();
            Database::disconnect();
            return $lastId;
        }

        public static function createNew($name, $description)
        {
            $db = Database::connect();
            $sql = "INSERT INTO tbl_location (name, beschreibung) values (?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($name, $description));
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
            $sql = "UPDATE tbl_location set name = ?, beschreibung = ?  where pk_location_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($this->desc, $this->description, $this->id));
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
            $sql = "Select * from tbl_location where pk_location_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            $d = $stmt->fetch(PDO::FETCH_NUM);
            Database::disconnect();

            return $d == null ? null : new Location($d[0], $d[1], $d[2]);
        }

        /**
         * Get an array of objects from database
         * @return array array of objects or empty array
         */
        public static function getAll()
        {
            $db = Database::connect();
            $sql = "Select * from tbl_location order by name asc";
            $stmt = $db->prepare($sql);
            $stmt->execute(array());
            $l = $stmt->fetchAll(PDO::FETCH_NUM);
            Database::disconnect();
            $data = [];
            if ($l == null) {
                return null;
            }else {



                foreach ($l as $item) {


                    $data[] = new Location($item[0],$item[1],$item[2]);
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

        public static function getLocationByName($name)

        {
            if (!is_string($name)) {
                return null;
            }
            $name = strtolower($name);
            $db = Database::connect();
            $sql = "Select * from tbl_location where lower(name) = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($name));
            $l = $stmt->fetch(PDO::FETCH_NUM);
            Database::disconnect();

            return $l == null ? null : new Location($l[0], $l[1], $l[2]);

        }

        public static function exists($name)
        {
            $res = self::getLocationByName($name);
            return $res == null ? false : true;
        }



    }