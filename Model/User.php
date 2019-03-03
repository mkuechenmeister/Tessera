<?php
    /**
     * Created by PhpStorm.
     * User: Martin
     * Date: 11.02.2019
     * Time: 17:12
     */

    require_once("DatabaseObject.php");


    class User implements DatabaseObject
    {
        private $id;
        private $department;
        private $firstname;
        private $lastname;
        private $username;
        private $mail;
        private $hashedPassword;
        private $userstatus;
        private $usergroup;

        //LDAP-Anbindung

        /**
         * User constructor.
         * @param $id
         * @param $department
         * @param $username
         * @param $firstname
         * @param $lastname
         * @param $hashedPassword
         * @param $status
         * @param $usergroup
         */
        public function __construct($id, $department, $firstname, $lastname, $username, $mail, $hashedPassword, $status, $usergroup)
        {
            $this->id = $id;
            $this->department = $department;
            $this->username = $username;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->mail = $mail;
            $this->hashedPassword = $hashedPassword;
            $this->userstatus = $status;
            $this->usergroup = $usergroup;
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
        public function getDepartment()
        {
            return $this->department;
        }

        /**
         * @param mixed $department
         */
        public function setDepartment($department)
        {
            $this->department = $department;
        }

        /**
         * @return mixed
         */
        public function getUsername()
        {
            return $this->username;
        }

        /**
         * @param mixed $username
         */
        public function setUsername($username)
        {
            $this->username = $username;
        }

        /**
         * @return mixed
         */
        public function getFirstname()
        {
            return $this->firstname;
        }

        /**
         * @param mixed $firstname
         */
        public function setFirstname($firstname)
        {
            $this->firstname = $firstname;
        }

        /**
         * @return mixed
         */
        public function getLastname()
        {
            return $this->lastname;
        }

        /**
         * @param mixed $lastname
         */
        public function setLastname($lastname)
        {
            $this->lastname = $lastname;
        }

        /**
         * @return mixed
         */
        public function getMail()
        {
            return $this->mail;
        }

        /**
         * @param mixed $mail
         */
        public function setMail($mail)
        {
            $this->mail = $mail;
        }



        /**
         * @return mixed
         */
        public function getHashedPassword()
        {
            return $this->hashedPassword;
        }

        /**
         * @param mixed $hashedPassword
         */
        public function setHashedPassword($hashedPassword)
        {
            $this->hashedPassword = $hashedPassword;
        }

        /**
         * @return mixed
         */
        public function getUserstatus()
        {
            return $this->userstatus;
        }

        /**
         * @param mixed $userstatus
         */
        public function setUserstatus($userstatus)
        {
            $this->userstatus = $userstatus;
        }

        /**
         * @return mixed
         */
        public function getUsergroup()
        {
            return $this->usergroup;
        }

        /**
         * @param mixed $usergroup
         */
        public function setUsergroup($usergroup)
        {
            $this->usergroup = $usergroup;
        }

        public function create()
        {
            $db = Database::connect();
            $sql = "INSERT INTO tbl_user (pk_user_id, fk_department, first_name, last_name, username, email, password, fk_user_status, fk_user_group) VALUES (?,?,?,?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($this->id, $this->department, $this->firstname, $this->lastname, $this->username,$this->mail , $this->hashedPassword, $this->userstatus, $this->usergroup));
            $lastId = $db->lastInsertId();
            Database::disconnect();
            return $lastId;
        }

        public static function createNew($department, $firstname, $lastname, $username, $mail, $hashedPassword, $userstatus, $usergroup)
        {
            $db = Database::connect();
            $sql = "INSERT INTO tbl_user (fk_department, first_name, last_name, username, email, password, fk_user_status, fk_user_group) VALUES (?,?,?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($department, $firstname, $lastname, $username,$mail, $hashedPassword, $userstatus, $usergroup));
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
            $sql = "UPDATE tbl_user set fk_department = ?, first_name = ?, last_name = ?, username = ?, email=?, password = ?, fk_user_status = ?, fk_user_group = ? where pk_user_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($this->department, $this->firstname, $this->lastname, $this->username, $this->mail, $this->hashedPassword, $this->userstatus, $this->usergroup, $this->id ));
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
            $sql = "Select * from tbl_user where pk_user_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            $u = $stmt->fetch(PDO::FETCH_NUM);
            Database::disconnect();

            return $u == null ? null : new User($u[0], $u[1], $u[2], $u[3], $u[4], $u[5], $u[6], $u[7], $u[8]);
        }

        /**
         * Get an array of objects from database
         * @return array array of objects or null
         */
        public static function getAll()
        {
            $db = Database::connect();
            $sql = "Select * from tbl_location order by name asc";
            $stmt = $db->prepare($sql);
            $stmt->execute(array());
            $u = $stmt->fetchAll(PDO::FETCH_NUM);
            Database::disconnect();
            $data = [];

            if ($u == null) {
                return null;
            }else {



                foreach ($u as $item) {


                    $data[] = new User($item[0], $item[1], $item[2], $item[3], $item[4], $item[5], $item[6], $item[7], $u[8]);
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
            $sql = "DELETE FROM tbl_user WHERE pk_user_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            Database::disconnect();
        }

        public static function getUserByUsername($username)

        {
            if (!is_string($username)) {
                return null;
            }

            $username = strtolower($username);
            $db = Database::connect();
            $sql = "Select * from tbl_user where lower(username) = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($username));
            $u = $stmt->fetch(PDO::FETCH_NUM);
            Database::disconnect();

            return $u == null ? null : new User($u[0], $u[1], $u[2], $u[3], $u[4], $u[5], $u[6], $u[7], $u[8]);

        }

        public function checkPassword($pwd)
        {
          return  password_verify($pwd, $this->getHashedPassword());
        }




    }