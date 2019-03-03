<?php
    /**
     * Created by PhpStorm.
     * User: Martin
     * Date: 11.02.2019
     * Time: 14:00
     */

    require_once("DatabaseObject.php");


    class Warum implements DatabaseObject
    {

        private $id;
        private $desc;

        /**
         * Warum constructor.
         * @param $id
         * @param $desc
         */
        public function __construct($id, $desc)
        {
            $this->id = $id;
            $this->desc = $desc;
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
        public function getDesc()
        {
            return $this->desc;
        }

        /**
         * @param mixed $desc
         */
        public function setDesc($desc)
        {
            $this->desc = $desc;
        }




        /**
         * Creates a new object in the database
         * @return integer ID of the newly created object (lastInsertId)
         */
        public function create()
        {
            $db = Database::connect();
            $sql = "INSERT INTO tbl_beschreibung_warum (pk_beschreibung_warum, name) VALUES (?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($this->id, $this->desc));
            $lastId = $db->lastInsertId();
            Database::disconnect();
            return $lastId;
        }

        public static function createNew($desc)
        {
            $db = Database::connect();
            $sql = "INSERT INTO tbl_beschreibung_warum (name) values (?)";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($desc));
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
            $sql = "UPDATE tbl_beschreibung_warum set name = ? where pk_beschreibung_warum = ?";
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
            $sql = "Select * from tbl_beschreibung_warum where pk_beschreibung_warum = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            $b = $stmt->fetch(PDO::FETCH_NUM);
            Database::disconnect();

            return $b == null ? null : new Warum($b[0], $b[1]);
        }

        /**
         * Get an array of objects from database
         * @return array array of objects or empty array
         */
        public static function getAll()
        {
            $db = Database::connect();
            $sql = "Select * from tbl_beschreibung_warum order by name asc";
            $stmt = $db->prepare($sql);
            $stmt->execute(array());
            $b = $stmt->fetchAll(PDO::FETCH_NUM);
            Database::disconnect();
            $data = [];
            if ($b == null) {
                return null;
            }else {



                foreach ($b as $item) {


                    $data[] = new Warum($item[0], $item[1]);
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
            $sql = "DELETE FROM tbl_beschreibung_warum WHERE pk_beschreibung_warum = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            Database::disconnect();
        }

        public static function getWarumByDesc($desc)
        {
            if (!is_string($desc)) {
                return null;
            }

            $desc = strtolower($desc);
            $db = Database::connect();
            $sql = "Select * from tbl_beschreibung_warum where lower(name) = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($desc));
            $w = $stmt->fetch(PDO::FETCH_NUM);
            Database::disconnect();

            return $w == null ? null : new Warum($w[0], $w[1]);

        }

        public static function exists($warum)
        {
            $res = self::getWarumByDesc($warum);
            if ($res == null) {
                return false;
            }else{
                return true;
            }
        }
    }