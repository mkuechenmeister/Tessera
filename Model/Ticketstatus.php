<?php
    /**
     * Created by PhpStorm.
     * User: Martin
     * Date: 11.02.2019
     * Time: 16:50
     */

    require_once("DatabaseObject.php");


    class Ticketstatus implements DatabaseObject
    {
        private $id;
        private $name;

        /**
         * Status constructor.
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
            $sql = "INSERT INTO tbl_ticket_status (pk_ticket_status_id, name) VALUES (?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($this->id, $this->name));
            $lastId = $db->lastInsertId();
            Database::disconnect();
            return $lastId;
        }

        public static function createNew($name)
        {
            $db = Database::connect();
            $sql = "INSERT INTO tbl_ticket_status (name) values (?)";
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
            $sql = "UPDATE tbl_ticket_status set name = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($this->name));
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
            $sql = "Select * from tbl_ticket_status where pk_ticket_status_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            $d = $stmt->fetch(PDO::FETCH_NUM);
            Database::disconnect();

            return $d == null ? null : new Status($d[0], $d[1]);
        }

        /**
         * Get an array of objects from database
         * @return array array of objects or empty array
         */
        public static function getAll()
        {
            $db = Database::connect();
            $sql = "Select * from tbl_ticket_status order by name asc";
            $stmt = $db->prepare($sql);
            $stmt->execute(array());
            $s = $stmt->fetchAll(PDO::FETCH_NUM);
            Database::disconnect();
            $data = [];
            if ($s == null) {
                return null;
            }else {



                foreach ($s as $item) {


                    $data[] = new Status($item[0],$item[1]);
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
            $sql = "DELETE FROM tbl_ticket_status WHERE pk_ticket_status_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            Database::disconnect();
        }

        /**
         * @param $name
         * @return null if unable to find name|Status if name was found
         */
        public static function getStatusByName($name)

        {
            if (!is_string($name)) {
                return null;
            }
            $name = strtolower($name);
            $db = Database::connect();
            $sql = "Select * from tbl_ticket_status where lower(name) = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($name));
            $l = $stmt->fetch(PDO::FETCH_NUM);
            Database::disconnect();

            return $l == null ? null : new Status($l[0], $l[1]);

        }

        public static function exists($name)
        {
            $res = self::getStatusByName($name);
            return $res == null ? false : true;
        }

    }