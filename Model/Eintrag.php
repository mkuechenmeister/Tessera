<?php
    /**
     * Created by PhpStorm.
     * User: Martin
     * Date: 13.02.2019
     * Time: 18:13
     */

    require_once("DatabaseObject.php");


    class Eintrag implements DatabaseObject
    {

        private $id;
        private $bearbeiter;
        private $ticket;
        private $eintragsstatus;
        private $eintrag;
        private $timeCreated;

        /**
         * Eintrag constructor.
         * @param $id
         * @param $bearbeiter
         * @param $ticket
         * @param $eintragsstatus
         * @param $eintrag
         * @param $timeCreated
         */
        public function __construct($id, $bearbeiter, $ticket, $eintragsstatus, $eintrag, $timeCreated)
        {
            $this->id = $id;
            $this->bearbeiter = $bearbeiter;
            $this->ticket = $ticket;
            $this->eintragsstatus = $eintragsstatus;
            $this->eintrag = $eintrag;
            $this->timeCreated = $timeCreated;
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
        public function getTicket()
        {
            return $this->ticket;
        }

        /**
         * @param mixed $ticket
         */
        public function setTicket($ticket)
        {
            $this->ticket = $ticket;
        }

        /**
         * @return mixed
         */
        public function getEintragsstatus()
        {
            return $this->eintragsstatus;
        }

        /**
         * @param mixed $eintragsstatus
         */
        public function setEintragsstatus($eintragsstatus)
        {
            $this->eintragsstatus = $eintragsstatus;
        }

        /**
         * @return mixed
         */
        public function getEintrag()
        {
            return $this->eintrag;
        }

        /**
         * @param mixed $eintrag
         */
        public function setEintrag($eintrag)
        {
            $this->eintrag = $eintrag;
        }

        /**
         * @return mixed
         */
        public function getTimeCreated()
        {
            return $this->timeCreated;
        }

        /**
         * @param mixed $timeCreated
         */
        public function setTimeCreated($timeCreated)
        {
            $this->timeCreated = $timeCreated;
        }



        public function create()
        {
            $db = Database::connect();
            $sql = "INSERT INTO tbl_eintrag (pk_eintrag_id, fk_bearbeiter, fk_ticket, fk_status, eintrag, timeCreated) VALUES (?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($this->id, $this->bearbeiter, $this->ticket, $this->eintragsstatus, $this->eintrag, $this->timeCreated));
            $lastId = $db->lastInsertId();
            Database::disconnect();
            return $lastId;
        }

        public static function createNew($bearbeiter, $ticket, $status, $eintrag)
        {
            $db = Database::connect();
            $sql = "INSERT INTO tbl_eintrag (fk_bearbeiter, fk_ticket, fk_status, eintrag) VALUES (?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($bearbeiter, $ticket, $status, $eintrag));
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
            $sql = "UPDATE tbl_eintrag set fk_bearbeiter = ?, fk_ticket = ?, fk_status = ?, eintrag = ?, timeCreated = ? where pk_eintrag_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($this->bearbeiter, $this->ticket, $this->eintragsstatus, $this->eintrag, $this->timeCreated, $this->id));
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
            $sql = "Select * from tbl_eintrag where pk_eintrag_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            $e = $stmt->fetch(PDO::FETCH_NUM);
            Database::disconnect();

            return $e == null ? null : new Eintrag($e[0], $e[1], $e[2], $e[3], $e[4], $e[5]);
        }

        /**
         * Get an array of objects from database
         * @return array array of objects or null
         */
        public static function getAll()
        {
            $db = Database::connect();
            $sql = "Select * from tbl_eintrag order by timeCreated asc";
            $stmt = $db->prepare($sql);
            $stmt->execute(array());
            $aE = $stmt->fetchAll(PDO::FETCH_NUM);
            Database::disconnect();
            $data = [];

            if ($aE == null) {
                return null;
            }else {



                foreach ($aE as $item):


                    $data[] = new Eintrag($item[0], $item[1], $item[2], $item[3], $item[4], $item[5]);
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
            $sql = "DELETE FROM tbl_eintrag WHERE pk_eintrag_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            Database::disconnect();
        }

        public static function getEintraegeByBearbeiter($id)

        {
            if (!is_numeric($id)) {
                return null;
            }


            $db = Database::connect();
            $sql = "Select * from tbl_eintrag where fk_bearbeiter = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            $aE = $stmt->fetchAll(PDO::FETCH_NUM);
            Database::disconnect();
            $data = [];

            if ($aE == null) {
                return null;
            } else {


                foreach ($aE as $item):


                    $data[] = new Eintrag($item[0], $item[1], $item[2], $item[3], $item[4], $item[5]);

                endforeach;

                return $data;
            }
        }

            public static function getEintraegeByTicketID($id)
        {
            if (!is_numeric($id)) {
                return null;
            }


            $db = Database::connect();
            $sql = "Select * from tbl_eintrag where fk_ticket = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            $aE = $stmt->fetchAll(PDO::FETCH_NUM);
            Database::disconnect();
            $data = [];

            if ($aE == null) {
                return null;
            }else {



                foreach ($aE as $item):


                    $data[] = new Eintrag($item[0], $item[1], $item[2], $item[3], $item[4], $item[5]);

                endforeach;

                return $data;
            }

        }





    }