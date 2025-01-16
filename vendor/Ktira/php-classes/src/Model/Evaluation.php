<?php
  namespace Ktira\Model;

  use \Ktira\DB\Sql;

  class Evaluation{
    private $id;
    private $rating;
    private $title;
    private $comment;
    private $person;
    private $product;


    public function setDadosForm($post){
        $this->setRating($post["numRating"]);
        $this->setComment($post["txtComment"]);
        $this->setTitle($post["txtTitle"]);
    }
    
    public function save(){
        $sql = new Sql();
         $sql->select("CALL spEvaluationSave(:title, :rating, :comment, :person, :product)",
        array(":title"=>$this->getTitle(),":rating"=>$this->getRating(), ":comment"=>$this->getComment(),
        ":person"=>$this->getPerson(), ":product"=>$this->getProduct()));
    }

    public function getEvaluationProduct(){
        $sql = new Sql();
        return $sql->select("SELECT *, u.txtName as avaliador  from tblEvaluation e inner join tblProducts p on p.idProducts = e.fkProduct 
        inner join tblUsers u on u.idUsers = e.fkPerson where p.idProducts = :produto;",
        array(":produto"=>$this->getProduct()));
    }

    public function getEvaluationAvg(){
        $sql= new Sql();
        return $sql->select("SELECT count(*) as total, avg(numRatings) as media from tblEvaluation WHERE fkProduct = :produto group by fkProduct;",
        array(":produto"=>$this->getProduct()));
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
     */ 
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the value of rating
     */ 
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set the value of rating
     */ 
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * Get the value of comment
     */ 
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     */ 
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the value of person
     */ 
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set the value of person
     */ 
    public function setPerson($person)
    {
        $this->person = $person;
    }

    /**
     * Get the value of product
     */ 
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set the value of product
     */ 
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     */ 
    public function setTitle($title)
    {
        $this->title = $title;
    }
  }
?>