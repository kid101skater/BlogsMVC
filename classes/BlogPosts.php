<?php
class BlogPosts
{
    protected $PostID;
    protected $PostTitle;
    protected $Excerpt;
    protected $PostData;
    protected $PostDate;
    
    function __construct($PostID, $PostTitle, $Excerpt, $PostData, $PostDate)
    {
        $this->PostID = $PostID;
        $this->PostTitle = $PostTitle;
        $this->Excerpt = $Excerpt;
        $this->PostData = $PostData;
        $this->PostDate = $PostDate;
    }
    
    function getPostID()
    {
        return $this->PostID;
    }
    
    function getPostWordCount()
    {
        return str_word_count($this->PostData);
    }
    
    function getPostTitle()
    {
        return $this->PostTitle;
    }
    
    function getPostExcerpt()
    {
        return $this->Excerpt;
    }
    
    function getPostData()
    {
        return $this->PostData;
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
?>