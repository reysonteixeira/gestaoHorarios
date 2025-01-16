<?php

    namespace Ktira\Model;

    use \Ktira\DB\Sql;

    class Slider{
        private $idSlider;
        private $name;
        private $active;
        private $link;
        
        public static function getAll(){
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblSlider");
        }

        public static function getAllActive(){
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblSlider WHERE boolActive = true");
        }


        public function get(){
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblSlider where idSlider = :id", array(
                        ":id"=>$this->getIdSlider()
                ))[0];
        }

        public function save(){
            $sql = new Sql();
            $sql->select("CALL spSliderSave(:name, :link)", array(":name"=>$this->getName(), 
            ":link"=>$this->getLink()));
        }

        public function uploadFiles($file){
            $destino = "res/_img/_slider/".$file["flFoto"]['name'];
            move_uploaded_file($file['flFoto']["tmp_name"],$destino);  
        }

        public function updateInformations(){
                $sql = new Sql();
                $sql->select("CALL spSliderUpdateInfo(:pId, :pActive, :pLink)", array(":pId"=>$this->getIdSlider(),
                ":pActive"=>$this->getActive(), ":pLink"=>$this->getLink()));
        }

        public function updateImage(){
                $sql = new Sql();
                $sql->select("CALL spSliderUpdateImage(:pId, :pImage)",
                array(":pId"=>$this->getIdSlider(), ":pImage"=>$this->getName()));
        }

        public function setDadosForm($post){
                $this->setLink($post["txtLink"]);
                if(isset($post["cbActive"])){
                        $this->setActive(1);
                }
                else{
                        $this->setActive(0);
                }
                
        }

        public function delete(){
                $sql = new Sql();
                $sql->select("CALL spSliderDelete(:pId)", array(":pId"=>$this->getIdSlider()));
        }

        /**
         * Get the value of idSlider
         */ 
        public function getIdSlider()
        {
                return $this->idSlider;
        }

        /**
         * Set the value of idSlider
         */ 
        public function setIdSlider($idSlider)
        {
                $this->idSlider = $idSlider;
        }

        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         */ 
        public function setName($name)
        {
                $this->name = $name;
        }

        /**
         * Get the value of active
         */ 
        public function getActive()
        {
                return $this->active;
        }

        /**
         * Set the value of active
         */ 
        public function setActive($active)
        {
                $this->active = $active;
        }

        /**
         * Get the value of link
         */ 
        public function getLink()
        {
                return $this->link;
        }

        /**
         * Set the value of link
         */ 
        public function setLink($link)
        {
                $this->link = $link;
        }
    }

?>