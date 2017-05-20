<?php
require("../../../other/config.php");
class Database
{

// get the total count of posts for a specific user id
function getUsersPostCount($userID)
{
    try
        {
            // get the db obj
            $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        }
        catch(PDOException $e)
        {
             echo $e->getMessage();
        }
        $sql = "SELECT jt_PostID FROM `User_Posts_JT` WHERE jt_UserID = :id";
        $statement = $dbh->prepare($sql);
        $statement->bindParam(':id', $userID, PDO::PARAM_STR);
        $statement->execute();
        $total = $statement->rowCount();
   
        return $total;
}

function GetUserFromID($id)
{
        try
        {
            // get the db obj
            $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        }
        catch(PDOException $e)
        {
             echo $e->getMessage();
        }
        $sql = "SELECT * FROM Users WHERE UserID = :id";
        $statement = $dbh->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_STR);
        $row = $statement->fetchObject();
        $userID = $row->UserID;
        $userName = $row->Username;
        $bio = $row->Bio;
        $profilePic = $row->ProfilePic;
        $statement->debugDumpParams();
        $User = new User($userID, $userName, $bio, $profilePic);
        return $User;
}

function getUserFromUserName($uName)
{
    try
        {
            // get the db obj
            $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        }
        catch(PDOException $e)
        {
             echo $e->getMessage();
        }
        $sql = "SELECT * FROM Users WHERE Username = :username";
        
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':username', $uName, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach($result as $row){
        $userName = $row['Username'];
        $userID = $row['UserID'];
        $bio = $row['Bio'];
        $profilePic = $row['ProfilePic'];
        }
        $User = new User($userID, $userName, $bio, $profilePic);
        return $User;
}

function getUsersBlogPosts($userID)
{
    try
        {
            // get the db obj
            $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        }
        catch(PDOException $e)
        {
             echo $e->getMessage();
        }
        $sql = "SELECT Users.UserID, Users.Username, Users.Bio, Users.ProfilePic,Posts.PostID, Posts.Title, Posts.PostData, Posts.Excerpt, Posts.PostDate FROM Users, Posts NATURAL JOIN User_Posts_JT WHERE User_Posts_JT.jt_UserID = Users.UserID AND User_Posts_JT.jt_PostID = Posts.PostID AND Users.UserID = :userID ORDER BY Posts.PostID DESC";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        $BlogPosts[] = new BlogPosts(null, null, null, null, null);
        $counter = 0;
        foreach($result as $row){
            $PostID = $row['PostID'];
            $Title = $row['Title'];
            $PostData = $row['PostData'];
            $Excerpt= $row['Excerpt'];
            $PostDate = $row['PostDate'];
            $BlogPosts[$counter] = new BlogPosts($PostID, $Title, $Excerpt, $PostData, $PostDate);
            $counter = $counter + 1;
        }
        
        if($counter == 0)
        {
            return null;
        }
        return $BlogPosts;
}

function getBlogPostFromID($postID)
{
    try
        {
            // get the db obj
            $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        }
        catch(PDOException $e)
        {
             echo $e->getMessage();
        }
    $sql = "SELECT Users.UserID, Users.Username, Users.Bio, Users.ProfilePic,Posts.PostID, Posts.Title, Posts.Excerpt, Posts.PostData, Posts.PostDate FROM Users, Posts NATURAL JOIN User_Posts_JT WHERE User_Posts_JT.jt_UserID = Users.UserID AND User_Posts_JT.jt_PostID = Posts.PostID AND Posts.PostID = :postid";
    $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':postid', $postID, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $counter = 0;
        foreach($result as $row){
            $PostID = $row['PostID'];
            $Title = $row['Title'];
            $PostData = $row['PostData'];
            $Excerpt= $row['Excerpt'];
            $PostDate = $row['PostDate'];
            $BlogPost = new BlogPosts($PostID, $Title, $Excerpt, $PostData, $PostDate);
            $counter = $counter + 1;
        }
        if($counter == 0)
        {
            return null;
        }
        
        return $BlogPost;
}

function getUserFromBlogPost($postID)
{
    try
        {
            // get the db obj
            $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        }
        catch(PDOException $e)
        {
             echo $e->getMessage();
        }
    $sql = "SELECT Users.UserID, Users.Username, Users.Bio, Users.ProfilePic,Posts.PostID, Posts.Title, Posts.Excerpt, Posts.PostData, Posts.PostDate FROM Users, Posts NATURAL JOIN User_Posts_JT WHERE User_Posts_JT.jt_UserID = Users.UserID AND User_Posts_JT.jt_PostID = Posts.PostID AND Posts.PostID = :postid";
    $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':postid', $postID, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $counter = 0;
        foreach($result as $row){
        $userName = $row['Username'];
        $userID = $row['UserID'];
        $bio = $row['Bio'];
        $profilePic = $row['ProfilePic'];
            $user = new User($userID, $userName, $bio, $profilePic);
            $counter = $counter + 1;
        }
        if($counter == 0)
        {
            return null;
        }
        
        return $user;
}
}
?>