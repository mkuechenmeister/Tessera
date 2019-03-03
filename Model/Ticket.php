<?php
    /**
     * Created by PhpStorm.
     * User: Martin
     * Date: 13.02.2019
     * Time: 19:28
     */

    require_once("DatabaseObject.php");
    class Ticket implements DatabaseObject
    {
        private $id;
        private $absender;
        private $ticketstatus;
        private $location;
        private $was;
        private $wo;
        private $warum;
        private $empfaenger;
        private $bearbeiter;
        private $timecreated;
        private $kommentar;
        private $from;
        private $till;
        private $upload;

        /**
         * Ticket constructor.
         * @param $id
         * @param $absender
         * @param $ticketstatus
         * @param $location
         * @param $was
         * @param $wo
         * @param $warum
         * @param $empfaenger
         * @param $bearbeiter
         * @param $timecreated
         * @param $kommentar
         * @param $from
         * @param $till
         * @param $upload
         */
        public function __construct($id, $absender, $ticketstatus, $location, $was, $wo, $warum, $empfaenger, $bearbeiter, $timecreated, $kommentar, $from, $till, $upload)
        {
            $this->id = $id;
            $this->absender = $absender;
            $this->ticketstatus = $ticketstatus;
            $this->location = $location;
            $this->was = $was;
            $this->wo = $wo;
            $this->warum = $warum;
            $this->empfaenger = $empfaenger;
            $this->bearbeiter = $bearbeiter;
            $this->timecreated = $timecreated;
            $this->kommentar = $kommentar;
            $this->from = $from;
            $this->till = $till;
            $this->upload = $upload;
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
        public function getAbsender()
        {
            return $this->absender;
        }

        /**
         * @param mixed $absender
         */
        public function setAbsender($absender)
        {
            $this->absender = $absender;
        }

        /**
         * @return mixed
         */
        public function getTicketstatus()
        {
            return $this->ticketstatus;
        }

        /**
         * @param mixed $ticketstatus
         */
        public function setTicketstatus($ticketstatus)
        {
            $this->ticketstatus = $ticketstatus;
        }

        /**
         * @return mixed
         */
        public function getLocation()
        {
            return $this->location;
        }

        /**
         * @param mixed $location
         */
        public function setLocation($location)
        {
            $this->location = $location;
        }

        /**
         * @return mixed
         */
        public function getWas()
        {
            return $this->was;
        }

        /**
         * @param mixed $was
         */
        public function setWas($was)
        {
            $this->was = $was;
        }

        /**
         * @return mixed
         */
        public function getWo()
        {
            return $this->wo;
        }

        /**
         * @param mixed $wo
         */
        public function setWo($wo)
        {
            $this->wo = $wo;
        }

        /**
         * @return mixed
         */
        public function getWarum()
        {
            return $this->warum;
        }

        /**
         * @param mixed $warum
         */
        public function setWarum($warum)
        {
            $this->warum = $warum;
        }

        /**
         * @return mixed
         */
        public function getEmpfaenger()
        {
            return $this->empfaenger;
        }

        /**
         * @param mixed $empfaenger
         */
        public function setEmpfaenger($empfaenger)
        {
            $this->empfaenger = $empfaenger;
        }

        /**
         * @return mixed
         */
        public function getBearbeiter()
        {
            return $this->bearbeiter;
        }

        /**
         * @param mixed $bearbeiter
         */
        public function setBearbeiter($bearbeiter)
        {
            $this->bearbeiter = $bearbeiter;
        }

        /**
         * @return mixed
         */
        public function getTimecreated()
        {
            return $this->timecreated;
        }

        /**
         * @param mixed $timecreated
         */
        public function setTimecreated($timecreated)
        {
            $this->timecreated = $timecreated;
        }

        /**
         * @return mixed
         */
        public function getKommentar()
        {
            return $this->kommentar;
        }

        /**
         * @param mixed $kommentar
         */
        public function setKommentar($kommentar)
        {
            $this->kommentar = $kommentar;
        }

        /**
         * @return mixed
         */
        public function getFrom()
        {
            return $this->from;
        }

        /**
         * @param mixed $from
         */
        public function setFrom($from)
        {
            $this->from = $from;
        }

        /**
         * @return mixed
         */
        public function getTill()
        {
            return $this->till;
        }

        /**
         * @param mixed $till
         */
        public function setTill($till)
        {
            $this->till = $till;
        }

        /**
         * @return mixed
         */
        public function getUpload()
        {
            return $this->upload;
        }

        /**
         * @param mixed $upload
         */
        public function setUpload($upload)
        {
            $this->upload = $upload;
        }




        public function create()
        {
            $db = Database::connect();
            $sql = "INSERT INTO tbl_ticket (pk_ticket_id, fk_absender, fk_ticket_status, fk_location, fk_was, fk_wo, fk_warum,
                                            fk_empfaenger, fk_bearbeiter, timeCreated, kommentar, von, bis, upload)
                                            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($this->id, $this->absender, $this->ticketstatus, $this->location, $this->was, $this->wo, $this->warum, $this->empfaenger, $this->bearbeiter, $this->timecreated, $this->kommentar, $this->from, $this->till, $this->upload));
            $lastId = $db->lastInsertId();
            Database::disconnect();
            return $lastId;
        }

        public static function createNew($absender, $ticketstatus, $location, $was, $wo, $warum, $empfaenger, $bearbeiter, $kommentar, $from, $till, $upload)
        {
            $db = Database::connect();
            $sql = "INSERT INTO tbl_ticket (fk_absender, fk_ticket_status, fk_location, fk_was, fk_wo, fk_warum,
                                            fk_empfaenger, fk_bearbeiter, kommentar, von, bis, upload) 
                                            VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($absender, $ticketstatus, $location, $was, $wo, $warum, $empfaenger, $bearbeiter, $kommentar, $from, $till, $upload));
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
            $sql = "UPDATE tbl_ticket set  fk_absender = ?, fk_absender = ?, fk_ticket_status = ?, fk_location = ?, fk_was = ?,
                                           fk_wo = ?, fk_warum = ?, fk_empfaenger = ?, fk_bearbeiter = ?, timeCreated = ?,
                                           kommentar = ?, von = ?, bis = ?, upload = ?
                                           where pk_ticket_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($this->bearbeiter, $this->absender, $this->ticketstatus, $this->location, $this->was,
                $this->wo, $this->warum, $this->empfaenger, $this->bearbeiter, $this->timecreated,
                $this->kommentar, $this->from, $this->till, $this->upload,
                $this->id));
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
            $sql = "Select * from tbl_ticket where pk_ticket_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            $e = $stmt->fetch(PDO::FETCH_NUM);
            Database::disconnect();

            return $e == null ? null : new Ticket($e[0], $e[1], $e[2], $e[3], $e[4], $e[5], $e[6], $e[7], $e[8], $e[9], $e[10], $e[11], $e[12], $e[13]);
        }

        /**
         * Get an array of objects from database
         * @return array array of objects or null
         */
        public static function getAll()
        {
            $db = Database::connect();
            $sql = "Select * from tbl_ticket order by timeCreated asc";
            $stmt = $db->prepare($sql);
            $stmt->execute(array());
            $aT = $stmt->fetchAll(PDO::FETCH_NUM);
            Database::disconnect();
            $data = [];

            if ($aT == null) {
                return null;
            }else {



                foreach ($aT as $item):


                    $data[] = new Ticket($item[0], $item[1], $item[2], $item[3], $item[4], $item[5], $item[6], $item[7], $item[8], $item[9], $item[10], $item[11], $item[12], $item[13]);
                endforeach;

                return $data;
            }
        }

        /**
         * Get an array of objects from database
         * @return array array of objects or null
         */
        public static function getAllUnassigned()
        {
            $db = Database::connect();
            $sql = "Select * from tbl_ticket where fk_bearbeiter is null order by timeCreated asc";
            $stmt = $db->prepare($sql);
            $stmt->execute(array());
            $aT = $stmt->fetchAll(PDO::FETCH_NUM);
            Database::disconnect();
            $data = [];

            if ($aT == null) {
                return null;
            }else {



                foreach ($aT as $item):


                    $data[] = new Ticket($item[0], $item[1], $item[2], $item[3], $item[4], $item[5], $item[6], $item[7], $item[8], $item[9], $item[10], $item[11], $item[12], $item[13]);
                endforeach;

                return $data;
            }
        }

        /**
         * Get an array of objects from database
         * @return array array of objects or null
         */
        public static function getAllwithStatusID($statusID)
        {
            if (!is_numeric($statusID)) {
                return null;
            }

            $db = Database::connect();
            $sql = "Select * from tbl_ticket where fk_ticket_status is ? order by timeCreated asc";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($statusID));
            $aT = $stmt->fetchAll(PDO::FETCH_NUM);
            Database::disconnect();
            $data = [];

            if ($aT == null) {
                return null;
            }else {



                foreach ($aT as $item):


                    $data[] = new Ticket($item[0], $item[1], $item[2], $item[3], $item[4], $item[5], $item[6], $item[7], $item[8], $item[9], $item[10], $item[11], $item[12], $item[13]);
                endforeach;

                return $data;
            }
        }

        /**
         * Get an array of objects from database
         * @return array array of objects or null
         */
        public static function getAllAssignedToID($agentID)
        {
            if (!is_numeric($agentID)) {
                return null;
            }

            $db = Database::connect();
            $sql = "Select * from tbl_ticket where fk_bearbeiter is ? order by timeCreated asc";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($agentID));
            $aT = $stmt->fetchAll(PDO::FETCH_NUM);
            Database::disconnect();
            $data = [];

            if ($aT == null) {
                return null;
            }else {



                foreach ($aT as $item):


                    $data[] = new Ticket($item[0], $item[1], $item[2], $item[3], $item[4], $item[5], $item[6], $item[7], $item[8], $item[9], $item[10], $item[11], $item[12], $item[13]);
                endforeach;

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
            $sql = "DELETE FROM tbl_ticket WHERE pk_ticket_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            Database::disconnect();
        }










    }