<?php
class User
{
    protected $UserID;
    protected $UserName;
    protected $Bio;
    protected $ProfilePic;
    
    function __construct($UserID, $UserName, $Bio, $ProfilePic)
    {
        $this->UserID = $UserID;
        $this->UserName = $UserName;
        $this->Bio = $Bio;
        $this->ProfilePic = $ProfilePic;
    }
    
    function getUserID()
    {
        return $this->UserID;
    }
    
    function getUserName()
    {
        return $this->UserName;
    }
    
    function getBio()
    {
        return $this->Bio;
    }
    
    function getProfilePic()
    {
        return $this->ProfilePic;
    }
}