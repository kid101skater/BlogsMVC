<?php
class HomePageUser
{
    protected $UserID;
    protected $UserName;
    protected $Bio;
    protected $ProfilePic;
    protected $PostID;
    protected $PostTitle;
    protected $Excerpt;
    protected $PostDate;
    
    function __construct($UserID, $UserName, $Bio, $ProfilePic, $PostID, $PostTitle, $Excerpt, $PostDate)
    {
        $this->UserID = $UserID;
        $this->UserName = $UserName;
        $this->Bio = $Bio;
        $this->ProfilePic = $ProfilePic;
        $this->PostID = $PostID;
        $this->PostTitle = $PostTitle;
        $this->Excerpt = $Excerpt;
        $this->PostDate = $PostDate;
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
    
    function getPostID()
    {
        return $this->PostID;
    }
    
    function getPostTitle()
    {
        return $this->PostTitle;
    }
    
    function getPostExcerpt()
    {
        $db = new Database();
        return $db->getLatestExcerpt($this->getUserID());
    }
    
    function getPostDate()
    {
        return $this->PostDate;
    }
    
    function getPostCount()
    {
        $db = new Database();
        return $db->getUsersPostCount($this->UserID);
    }
}