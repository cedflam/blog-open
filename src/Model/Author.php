<?php

class Author
{

    //Propriétés
    private $id_pk_author;
    private $firstName;
    private $lastName;
    private $hash;
    private $email;
    private $role;
    private $valid;

    /**
     * Constructeur
     *
     * @param int $id
     */
    function __construct($id){
        //Variable globale qui permet de se connecter à la bdd 
        global $db;
        //Requete préparée
        $reqAuthor = $db->prepare(
            'SELECT * 
            FROM author 
            WHERE id_pk_author = ?'
        );
        //J'exécute la requete
        $reqAuthor->execute([$id]);
        // Je stocke le résultat dans une variable 
        $data = $reqAuthor->fetch();

        //Je paramètre les propriétés du nouvel objet
        $this->id_pk_author = $id;
        $this->firstName = $data['firstName'];
        $this->lastName = $data['lastName'];
        $this->hash = $data['hash'];
        $this->email = $data['email'];
        $this->role = $data['role'];
        $this->valid = $data['valid'];
    }


    /**
     * Get the value of firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of hash
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set the value of hash
     *
     * @return  self
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of id_pk_author
     */
    public function getId_pk_author()
    {
        return $this->id_pk_author;
    }

    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of valid
     */
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * Set the value of valid
     *
     * @return  self
     */
    public function setValid($valid)
    {
        $this->valid = $valid;

        return $this;
    }
}
