<?php
    class Image {
                
        private $id;
        private $desc;
        private $titre;
        private $type;
        private $binary;
        
        private $img;
        private $src_h;
        private $src_w;
        private $h;
        private $w;
        
        private $illustre;
        private $nbIllustre;
        
        private $Bob;
        private static $maxId = 0;
        
        public function getImage() { $this->initImage(); return $this->img; }
        public function getHeight() { $this->initImage(); return $this->h; }
        public function setHeight($h) { $this->initImage(); $this->h = $h; }
        public function getWidth() { $this->initImage(); return $this->w; }
        public function setWidth($w) { $this->initImage();$this->w = $w; }
        
        public function getId() { return $this->id; }
        public function getDesc() { return $this->desc; }
        public function getTitre() { return $this->titre; }
        public function getType() { return $this->type; }
        public function getBin() { return $this->binary; }
        public function getUsing() { return $this->nbIllustre; }
        public function used() { return $this->nbIllustre != 0; }
        
        public function __construct($Bob, $titre, $type, $desc, $bin, $id = 0)
        {
            $this->Bob = $Bob;
            $this->titre = $titre;
            $this->type = $type;
            $this->desc = $desc;
            $this->binary = $bin;
            
            $this->img = null;
                        
            if($id == 0) $id = self::$maxId + 1;
            $this->id = $id;
            if($id > self::$maxId) self::$maxId = $id;
            
            $this->illustre = null;
            $this->nbIllustre = 0;
        }
        
        public function ajouteCible($cible)
        {
            $this->illustre[$this->nbIllustre] = $cible;
            $this->nbIllustre++;
        }
        
        private function initImage()
        {
            if($this->img != null)
                return false;
                
            $this->img = $this->createImage();
            if($this->img) {
                $this->w = imagesx($this->img);
                $this->h = imagesy($this->img);
                $this->src_w = $this->w;
                $this->src_h = $this->h;
                
                return true;
            }
            
            return false;
        }
        
        private function createImage()
        {
            if($this->type != "image/jpeg"  &&
               $this->type != "image/png"  &&
               $this->type != "image/gif"     )
            {
                return null;
            }
               
            return imagecreatefromstring($this->getBin());            
        }
        
        private function headers()
        {
            header("Content-type: ".$this->type);
            header('Content-transfer-encoding: binary');
        }
            
        public function getNewImage()
        {
            $this->initImage();
            if($this->img == null)
                return null;
        
            if($this->w == $this->src_w && $this->h == $this->src_h)
            {
                return $this->img;
            }
            
            $dst = imagecreatetruecolor($this->w, $this->h);                    
            if(!imagecopyresampled($dst, $this->img , 0, 0, 0, 0 , $this->w , $this->h , $this->src_w , $this->src_h ))
            {
                die(print("erreur"));
                return $this->img;
            }        
            
            return $dst;            
        }
        
        public function generer() 
        {                    
            $dst = $this->getNewImage();
            if($dst == NULL)
            {
                die(print("Erreur lors de la recuperation de l'image"));
            }
                                
            switch($this->type)
            {
                case "image/jpeg":
                    $this->headers();
                    die(imagejpeg($dst));
                break;
                case "image/gif":
                    $this->headers();
                    die(imagegif($dst));
                break;
                case "image/png":
                    $this->headers();
                    die(imagepng($dst));
                break;
                default:
                    die(print("Extension non supportée"));
                break;
            }            
        }
    }
?>
