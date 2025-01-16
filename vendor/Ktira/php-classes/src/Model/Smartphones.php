<?php

    namespace Ktira\Model;

    use \Ktira\DB\Sql;

    class Smartphones{
        private $id;
        private $name;
        private $brand;
        private $status;
        private $description;
        private $color;
        private $launch;
        private $weight;
        private $image11;
        private $image12;
        private $image21;
        private $image22;
        private $image31;
        private $image32;
        private $backCamera;
        private $frontCamera;
        private $video;
        private $operacionalSystem;
        private $operacionalSystemVersion;
        private $screenSize;
        private $screenDimension;
        private $screenType;
        private $processor;
        private $processorFrequency;
        private $ram;
        private $inStorage;
        private $outStorage;
        private $batery;
        private $simType;
        private $simQty;
        private $nfc;
        private $usb;
        private $price;
        private $offer;

        public function setDadosForm($post, $file){
            $this->setName($post["txtName"]);
            $this->setBrand($post["cbBrand"]);
            $this->setStatus($post["cbStatus"]);
            $this->setDescription($post["txtDescription"]);
            $this->setColor($post["txtColor"]);
            $this->setLaunch($post["txtLaunch"]);
            $this->setWeight($post["txtWeigth"]);
            $this->setImage11($file["flFoto1"]["name"]);
            $this->setImage12($file["flFoto2"]["name"]);
            $this->setImage21($file["flFoto3"]["name"]);
            $this->setImage22($file["flFoto4"]["name"]);
            $this->setImage31($file["flFoto5"]["name"]);
            $this->setImage32($file["flFoto6"]["name"]);    
            $this->setBackCamera($post["txtBackCamera"]);
            $this->setFrontCamera($post["txtFrontCamera"]);
            $this->setVideo($post["txtVideo"]);
            $this->setOperacionalSystem($post["cbOS"]);
            $this->setOperacionalSystemVersion($post["txtOSVersion"]);
            $this->setScreenSize($post["txtScreenSize"]);
            $this->setScreenDimension($post["txtScreenDimension"]);
            $this->setScreenType($post["txtScreenType"]);
            $this->setProcessor($post["txtProcessor"]);
            $this->setProcessorFrequency($post["txtProcessorFrequency"]);
            $this->setRam($post["txtRam"]);
            $this->setInStorage($post["txtInStorage"]);
            $this->setOutStorage($post["txtOutStorage"]);
            $this->setBatery($post["txtBatery"]);
            $this->setSimType($post["cbChip"]);
            $this->setSimQty($post["txtSIMQty"]);
            $this->setUsb($post["cbUSB"]);
            $this->setPrice($post["numPrice"]);
            if(isset($post["cbNFC"])){
                    if($post["cbNFC"] == 1){
                            $this->setNfc(1);
                    }
                    else
                    {
                        $this->setNfc(0); 
                    }
            }
        }

        public function setDadosFormUpdate($post){
                $this->setName($post["txtName"]);
                $this->setBrand($post["cbBrand"]);
                $this->setStatus($post["cbStatus"]);
                $this->setDescription($post["txtDescription"]);
                $this->setColor($post["txtColor"]);
                $this->setLaunch($post["txtLaunch"]);
                $this->setWeight($post["txtWeigth"]);   
                $this->setBackCamera($post["txtBackCamera"]);
                $this->setFrontCamera($post["txtFrontCamera"]);
                $this->setVideo($post["txtVideo"]);
                $this->setOperacionalSystem($post["cbOS"]);
                $this->setOperacionalSystemVersion($post["txtOSVersion"]);
                $this->setScreenSize($post["txtScreenSize"]);
                $this->setScreenDimension($post["txtScreenDimension"]);
                $this->setScreenType($post["txtScreenType"]);
                $this->setProcessor($post["txtProcessor"]);
                $this->setProcessorFrequency($post["txtProcessorFrequency"]);
                $this->setRam($post["txtRam"]);
                $this->setInStorage($post["txtInStorage"]);
                $this->setOutStorage($post["txtOutStorage"]);
                $this->setBatery($post["txtBatery"]);
                $this->setSimType($post["cbChip"]);
                $this->setSimQty($post["txtSIMQty"]);
                $this->setUsb($post["cbUSB"]);
                $this->setPrice($post["numPrice"]);
                if(isset($post["cbNFC"])){
                        if($post["cbNFC"] == 1){
                                $this->setNfc(1);
                        }
                        else
                        {
                            $this->setNfc(0); 
                        }
                }
            }


        public function setDados($name, $brand, $status, $description,$color, $launch, $weight, $image11, 
        $image12,$image21,$image22, $image31, $image32, $backCamera, $frontCamera, $video, 
        $operacionalSystem, $operacionalSystemVersion, $screenSize, $screenDimension, $screenType, 
        $processor, $processorFrequency, $ram, $inStorage, $outStorage, $batery,
        $simType, $simQty, $nfc, $usb, $price){
            $this->setName($name);
            $this->setBrand($brand);
            $this->setStatus($status);
            $this->setDescription($description);
            $this->setColor($color);
            $this->setLaunch($launch);
            $this->setWeight($weight);
            $this->setImage11($image11);
            $this->setImage12($image12);
            $this->setImage21($image21);
            $this->setImage22($image22);
            $this->setImage31($image31);
            $this->setImage32($image32);
            $this->setBackCamera($backCamera);
            $this->setFrontCamera($frontCamera);
            $this->setVideo($video);
            $this->setOperacionalSystem($operacionalSystem);
            $this->setOperacionalSystemVersion($operacionalSystemVersion);
            $this->setScreenSize($screenSize);
            $this->setScreenDimension($screenDimension);
            $this->setScreenType($screenType);
            $this->setProcessor($processor);
            $this->setProcessorFrequency($processorFrequency);
            $this->setRam($ram);
            $this->setInStorage($inStorage);
            $this->setOutStorage($outStorage);
            $this->setBatery($batery);
            $this->setSimType($simType);
            $this->setSimQty($simQty);
            $this->setNfc($nfc);
            $this->setUsb($usb);
            $this->setPrice($price);
        }
        
        public static function listAll(){
                $sql = new Sql();
                return $sql->select("select * from tblSmartphones s INNER JOIN tblBrand b ON b.idtblBrand = s.numBrand;");
        }

        public static function count(){
                $sql = new Sql();
                return $sql->select("SELECT count(*) as total FROM tblSmartphones;");
            }

        public function find($busca){
                $sql = new Sql();
                return $sql->select("SELECT * FROM tblSmartphones s INNER JOIN tblBrand b ON b.idtblBrand = s.numBrand 
                 WHERE s.numEstoque >0 and (s.txtName like :busca or b.txtBrandName like :busca)", array(":busca"=>"%$busca%"));  
        }

        public function save(){
                $sql = new Sql();
                $results = $sql->select("CALL sp_smartphones_save(:name, :brand, :status, :description,:color, :launch, :weight, 
                :image11,:image12, :image21,:image22, :image31,:image32, :backCamera, :frontCamera, 
                :video, :operacionalSystem, :operacionalSystemVersion,:screenSize, :screenDimension, 
                :screenType, :processor, :processorFrequency, :ram, 
                :inStorage, :outStorage, :batery, :simType, :simQty, :nfc, :usb, :price)",
                
                array(

                ":name"=>$this->getName(),
                ":brand"=>$this->getBrand(), 
                ":status"=>$this->getStatus(), 
                ":description"=>$this->getDescription(),
                ":color"=>$this->getColor(),
                ":launch"=>$this->getLaunch(), 
                ":weight"=>$this->getWeight(), 
                ":image11"=>$this->getImage11(),
                ":image12"=>$this->getImage12(), 
                ":image21"=>$this->getImage21(),
                ":image22"=>$this->getImage22(), 
                ":image31"=>$this->getImage31(),
                ":image32"=>$this->getImage32(), 
                ":backCamera"=>$this->getBackCamera(), 
                ":frontCamera" =>$this->getFrontCamera(),
                ":video"=>$this->getVideo(), 
                ":operacionalSystem"=>$this->getOperacionalSystem(), 
                ":operacionalSystemVersion"=>$this->getOperacionalSystemVersion(),
                ":screenSize"=>$this->getScreenSize(), 
                ":screenDimension"=>$this->getScreenDimension(), 
                ":screenType"=>$this->getScreenType(), 
                ":processor"=>$this->getProcessor(), 
                ":processorFrequency"=>$this->getProcessorFrequency(), 
                ":ram"=>$this->getRam(), 
                ":inStorage"=>$this->getInStorage(), 
                ":outStorage"=>$this->getOutStorage(),
                ":batery"=>$this->getBatery(), 
                ":simType"=>$this->getSimType(), 
                ":simQty"=>$this->getSimQty(), 
                ":nfc"=>$this->getNfc(), 
                ":usb"=>$this->getUsb(),
                ":price"=>$this->getPrice()));
        }

        public function get($id){
                $sql= new Sql();
                return $sql->select("SELECT * FROM tblSmartphones s INNER JOIN tblBrand b ON b.idtblBrand = s.numBrand WHERE idtblProducts = :id",
                array(":id"=>$id));
        }

        public function getAll($id){
                $sql= new Sql();
                return $sql->select("SELECT * FROM tblSmartphones s INNER JOIN tblBrand b ON b.idtblBrand = s.numBrand WHERE s.idtblProducts = :id;" , array(":id"=>$id))[0];
        }

        public function delete($id){
                $sql = new Sql();
                $sql->query("DELETE FROM tblSmartphones WHERE idtblProducts = :id", array(":id"=> $id));
        }

        public function update(){
                $sql = new Sql();

                $results = $sql->select("CALL sp_smartphonesupdate_save(:id, :name, :brand, :status, 
                :description,:color, :launch, :weight, :backCamera, :frontCamera, 
                :video, :operacionalSystem, :operacionalSystemVersion,:screenSize, :screenDimension, 
                :screenType, :processor, :processorFrequency, :ram, 
                :inStorage, :outStorage, :batery, :simType, :simQty, :nfc, :usb, :price)",
                
                array(
                ":id"=>$this->getId(),
                ":name"=>$this->getName(),
                ":brand"=>$this->getBrand(), 
                ":status"=>$this->getStatus(), 
                ":description"=>$this->getDescription(),
                ":color"=>$this->getColor(),
                ":launch"=>$this->getLaunch(), 
                ":weight"=>$this->getWeight(), 
                ":backCamera"=>$this->getBackCamera(), 
                ":frontCamera" =>$this->getFrontCamera(),
                ":video"=>$this->getVideo(), 
                ":operacionalSystem"=>$this->getOperacionalSystem(), 
                ":operacionalSystemVersion"=>$this->getOperacionalSystemVersion(),
                ":screenSize"=>$this->getScreenSize(), 
                ":screenDimension"=>$this->getScreenDimension(), 
                ":screenType"=>$this->getScreenType(), 
                ":processor"=>$this->getProcessor(), 
                ":processorFrequency"=>$this->getProcessorFrequency(), 
                ":ram"=>$this->getRam(), 
                ":inStorage"=>$this->getInStorage(), 
                ":outStorage"=>$this->getOutStorage(),
                ":batery"=>$this->getBatery(), 
                ":simType"=>$this->getSimType(), 
                ":simQty"=>$this->getSimQty(), 
                ":nfc"=>$this->getNfc(), 
                ":usb"=>$this->getUsb(),
                ":price"=>$this->getPrice()));

        }

        public function uploadFotos($fotos){
                $destino = "res/_img/produtos/".$fotos["flFoto1"]['name'];
                move_uploaded_file($fotos['flFoto1']["tmp_name"],$destino);     
                $destino = "res/_img/produtos/".$fotos["flFoto2"]['name'];
                move_uploaded_file($fotos['flFoto2']["tmp_name"],$destino);
                $destino = "res/_img/produtos/".$fotos["flFoto3"]['name'];
                move_uploaded_file($fotos['flFoto3']["tmp_name"],$destino);
                $destino = "res/_img/produtos/".$fotos["flFoto4"]['name'];
                move_uploaded_file($fotos['flFoto4']["tmp_name"],$destino);
                $destino = "res/_img/produtos/".$fotos["flFoto5"]['name'];
                move_uploaded_file($fotos['flFoto5']["tmp_name"],$destino);
                $destino = "res/_img/produtos/".$fotos["flFoto6"]['name'];
                move_uploaded_file($fotos['flFoto6']["tmp_name"],$destino);
        }

        public function addHighlights(){
                $sql = new Sql();
                $sql->select("call sp_addHighlights(:product)", array(":product"=>$this->getId()));  
        }

        public function removeHighlights(){
                $sql = new Sql();
                $sql->select("call sp_removeHighlights()");
        }

        public function addOffer(){
                $sql = new Sql();
                $sql->select("call sp_addOffer(:pproduct, :poffer)", array(":pproduct"=> $this->getId(), 
                ":poffer"=>$this->getOffer()));
        }

        public function removeOffer(){
                $sql = new Sql();
                $sql->select("call sp_removeOffer(:product)", array(":product"=>$this->getId()));
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
         * Get the value of brand
         */ 
        public function getBrand()
        {
                return $this->brand;
        }

        /**
         * Set the value of brand

         */ 
        public function setBrand($brand)
        {
                $this->brand = $brand;
        }

        /**
         * Get the value of status
         */ 
        public function getStatus()
        {
                return $this->status;
        }

        /**
         * Set the value of status
         */ 
        public function setStatus($status)
        {
                $this->status = $status;
        }

        /**
         * Get the value of description
         */ 
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Set the value of description
         */ 
        public function setDescription($description)
        {
                $this->description = $description;
        }

        /**
         * Get the value of launch */ 
        public function getLaunch()
        {
                return $this->launch;
        }

        /** Set the value of launch */ 
    
        public function setLaunch($launch)
        {
                $this->launch = $launch;

                return $this;
        }

        /**
         * Get the value of weight
         */ 
        public function getWeight()
        {
                return $this->weight;
        }

        /**
         * Set the value of weight
         *
         * @return  self
         */ 
        public function setWeight($weight)
        {
                $this->weight = $weight;

                return $this;
        }

        /**
         * Get the value of image1
         */ 
        public function getImage1()
        {
                return $this->image1;
        }

        /**
         * Set the value of image1*/ 
        public function setImage1($image1)
        {
                $this->image1 = $image1;
        }

        /**
         * Get the value of image2
         */ 
        public function getImage2()
        {
                return $this->image2;
        }

        /*** Set the value of image2 */ 
        public function setImage2($image2)
        {
                $this->image2 = $image2;
        }

        /**
         * Get the value of image3
         */ 
        public function getImage3()
        {
                return $this->image3;
        }

        /**
         * Set the value of image3
         */ 
        public function setImage3($image3)
        {
                $this->image3 = $image3;
        }

        /**
         * Get the value of backCamera
         */ 
        public function getBackCamera()
        {
                return $this->backCamera;
        }

        /**Set the value of backCamera*/ 
        public function setBackCamera($backCamera)
        {
                $this->backCamera = $backCamera;
        }

        /** Get the value of frontCamera*/ 
        public function getFrontCamera()
        {
                return $this->frontCamera;
        }

        /**
         * Set the value of frontCamera

         */ 
        public function setFrontCamera($frontCamera)
        {
                $this->frontCamera = $frontCamera;
        }

        /**
         * Get the value of video
         */ 
        public function getVideo()
        {
                return $this->video;
        }

        /**
         * Set the value of video
         */ 
        public function setVideo($video)
        {
                $this->video = $video;
        }

        /**
         * Get the value of operacionalSystem
         */ 
        public function getOperacionalSystem()
        {
                return $this->operacionalSystem;
        }

        /**
         * Set the value of operacionalSystem
         */ 
        public function setOperacionalSystem($operacionalSystem)
        {
                $this->operacionalSystem = $operacionalSystem;
        }

        /**
         * Get the value of operacionalSystemVersion
         */ 
        public function getOperacionalSystemVersion()
        {
                return $this->operacionalSystemVersion;
        }

        /**
         * Set the value of operacionalSystemVersion
         */ 
        public function setOperacionalSystemVersion($operacionalSystemVersion)
        {
                $this->operacionalSystemVersion = $operacionalSystemVersion;
        }

        /**
         * Get the value of screenSize
         */ 
        public function getScreenSize()
        {
                return $this->screenSize;
        }

        /**
         * Set the value of screenSize
         */ 
        public function setScreenSize($screenSize)
        {
                $this->screenSize = $screenSize;
        }

        /**
         * Get the value of screenDimension
         */ 
        public function getScreenDimension()
        {
                return $this->screenDimension;
        }

        /**
         * Set the value of screenDimension
         */ 
        public function setScreenDimension($screenDimension)
        {
                $this->screenDimension = $screenDimension;
        }
        /**
         * Get the value of screenType
         */ 
        public function getScreenType()
        {
                return $this->screenType;
        }

        /**
         * Set the value of screenType
         */ 
        public function setScreenType($screenType)
        {
                $this->screenType = $screenType;
        }

        /**
         * Get the value of processor
         */ 
        public function getProcessor()
        {
                return $this->processor;
        }

        /**
         * Set the value of processor
         */ 
        public function setProcessor($processor)
        {
                $this->processor = $processor;
        }

        /**
         * Get the value of processorFrequency
         */ 
        public function getProcessorFrequency()
        {
                return $this->processorFrequency;
        }

        /**
         * Set the value of processorFrequency
         */ 
        public function setProcessorFrequency($processorFrequency)
        {
                $this->processorFrequency = $processorFrequency;
        }

        /**
         * Get the value of ram
         */ 
        public function getRam()
        {
                return $this->ram;
        }

        /**
         * Set the value of ram
         */ 
        public function setRam($ram)
        {
                $this->ram = $ram;
        }

        /**
         * Get the value of inStorage
         */ 
        public function getInStorage()
        {
                return $this->inStorage;
        }

        /**
         * Set the value of inStorage
         */ 
        public function setInStorage($inStorage)
        {
                $this->inStorage = $inStorage;
        }

        /**
         * Get the value of outStorage
         */ 
        public function getOutStorage()
        {
                return $this->outStorage;
        }

        /**
         * Set the value of outStorage

         */ 
        public function setOutStorage($outStorage)
        {
                $this->outStorage = $outStorage;
        }

        /**
         * Get the value of batery
         */ 
        public function getBatery()
        {
                return $this->batery;
        }

        /**
         * Set the value of batery
         */ 
        public function setBatery($batery)
        {
                $this->batery = $batery;
        }

        /**
         * Get the value of simType
         */ 
        public function getSimType()
        {
                return $this->simType;
        }

        /**
         * Set the value of simType
         */ 
        public function setSimType($simType)
        {
                $this->simType = $simType;
        }

        /**
         * Get the value of simQty
         */ 
        public function getSimQty()
        {
                return $this->simQty;
        }

        /**
         * Set the value of simQty
         */ 
        public function setSimQty($simQty)
        {
                $this->simQty = $simQty;
        }

        /**
         * Get the value of nfc
         */ 
        public function getNfc()
        {
                return $this->nfc;
        }

        /**Set the value of nfc*/ 
        public function setNfc($nfc)
        {
                $this->nfc = $nfc;
        }

        /**
         * Get the value of usb
         */ 
        public function getUsb()
        {
                return $this->usb;
        }

        /**Set the value of usb*/ 
        public function setUsb($usb)
        {
                $this->usb = $usb;
        }

        /**
         * Get the value of color
         */ 
        public function getColor()
        {
                return $this->color;
        }

        /**
         * Set the value of color
         */ 
        public function setColor($color)
        {
                $this->color = $color;
        }

        /**
         * Get the value of image11
         */ 
        public function getImage11()
        {
                return $this->image11;
        }

        /**
         * Set the value of image11
         */ 
        public function setImage11($image11)
        {
                $this->image11 = $image11;
        }

        /**
         * Get the value of image12
         */ 
        public function getImage12()
        {
                return $this->image12;
        }

        /**
         * Set the value of image12
         *
         * @return  self
         */ 
        public function setImage12($image12)
        {
                $this->image12 = $image12;

                return $this;
        }

        /**
         * Get the value of image21
         */ 
        public function getImage21()
        {
                return $this->image21;
        }

        /**
         * Set the value of image21
         *
         * @return  self
         */ 
        public function setImage21($image21)
        {
                $this->image21 = $image21;

                return $this;
        }

        /**
         * Get the value of image22
         */ 
        public function getImage22()
        {
                return $this->image22;
        }

        /**
         * Set the value of image22
         *
         * @return  self
         */ 
        public function setImage22($image22)
        {
                $this->image22 = $image22;

                return $this;
        }

        /**
         * Get the value of image31
         */ 
        public function getImage31()
        {
                return $this->image31;
        }

        /**
         * Set the value of image31
         *
         * @return  self
         */ 
        public function setImage31($image31)
        {
                $this->image31 = $image31;

                return $this;
        }

        /**
         * Get the value of image32
         */ 
        public function getImage32()
        {
                return $this->image32;
        }

        /**
         * Set the value of image32
         *
         * @return  self
         */ 
        public function setImage32($image32)
        {
                $this->image32 = $image32;

                return $this;
        }

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;
        }

        /**
         * Get the value of price
         */ 
        public function getPrice()
        {
                return $this->price;
        }

        /**
         * Set the value of price
         *
         * @return  self
         */ 
        public function setPrice($price)
        {
                $this->price = $price;

                return $this;
        }

        /**
         * Get the value of offer
         */ 
        public function getOffer()
        {
                return $this->offer;
        }

        /**
         * Set the value of offer
         */ 
        public function setOffer($offer)
        {
                $this->offer = $offer;
        }
    }
?>
