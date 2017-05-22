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

function getUsersWithPosts()
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
    $sql = "SELECT Users.UserID, Users.Username, Users.Bio, Users.ProfilePic,MAX(Posts.PostID), Posts.Title, Posts.Excerpt, Posts.PostDate FROM Users, Posts NATURAL JOIN User_Posts_JT WHERE User_Posts_JT.jt_UserID = Users.UserID AND User_Posts_JT.jt_PostID = Posts.PostID GROUP BY Users.UserID";

    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    $users[] = new HomePageUser(null, null, null, null, null, null, null, null);
    $counter = 0;
    foreach($result as $row)
    {
        //$UserID, $UserName, $Bio, $ProfilePic, $PostID, $PostTitle, $PostData, $PostDate
        $users[$counter] = new HomePageUser($row['UserID'], $row['Username'], $row['Bio'], $row['ProfilePic'], $row['PostID'], $row['Title'], $row['Excerpt'], $row['PostDate']);
        //print_r($row);
        $counter = $counter + 1;
    }
    
    return $users;
}
function getLatestExcerpt($userID)
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
    $sql = "SELECT Posts.Excerpt FROM Posts WHERE Posts.PostID = (SELECT MAX(User_Posts_JT.jt_PostID) FROM User_Posts_JT WHERE User_Posts_JT.jt_UserID = :userID )";
    $statement = $dbh->prepare($sql);
    $statement->bindParam(':userID', $userID, PDO::PARAM_STR);
    $statement->execute();
    $row = $statement->fetch();
        return $row['Excerpt'];   

}

function getUsersWithoutPosts()
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
    $sql = "SELECT Users.UserID, Users.Username, Users.Bio, Users.ProfilePic FROM Users WHERE Users.UserID NOT IN (SELECT User_Posts_JT.jt_UserID FROM User_Posts_JT)";
    $statement = $dbh->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    $Users[] = new User(null, null, null, null);
        $counter = 0;
    foreach($result as $row){
        $userName = $row['Username'];
        $userID = $row['UserID'];
        $bio = $row['Bio'];
        $profilePic = $row['ProfilePic'];
        $Users[$counter] = new User($userID, $userName, $bio, $profilePic);
        $counter = $counter + 1;
        }
        
        return $Users;
        
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

function Authenticate($user, $password)
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
        $sql = "SELECT * FROM `Users` WHERE Username = :user AND Password = :password";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':user', $user, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->rowCount(); //  if 1 then we are authenticated
        
}

function RegisterUser($user, $password, $email, $bio, $pic)
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
    $sql = "INSERT INTO `klocke_Blogs`.`Users` (`Username`, `Password`, `Email`, `Bio`, `ProfilePic`) VALUES (:username, :password, :email, :bio, :pic);";
    $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':username', $user, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
        $stmt->bindParam(':pic', $pic, PDO::PARAM_STR);
        $stmt->execute();
}

function CreatePost($title, $entry, $userID)
{
    $excerpt = substr($entry, 0, 100);
    try
        {
            // get the db obj
            $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        }
        catch(PDOException $e)
        {
             echo $e->getMessage();
        }
    $sql = "INSERT INTO `Posts`(`Title`, `PostData`, `Excerpt`) VALUES (:title,:entry,:excerpt)";
    $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':entry', $entry, PDO::PARAM_STR);
        $stmt->bindParam(':excerpt', $excerpt, PDO::PARAM_STR);
        $stmt->execute();
        $sql_PostID = "SELECT PostID FROM Posts ORDER BY `PostID` DESC LIMIT 1";
        $stmt = $dbh->prepare($sql_PostID);
        $stmt->execute();
        $row = $stmt->fetch();
        $postID = $row['PostID'];
    $sql_JT = "INSERT INTO `User_Posts_JT`(`jt_UserID`, `jt_PostID`) VALUES (:userID, :postID)";
    $stmt = $dbh->prepare($sql_JT);
    $stmt->bindParam(':userID', $userID, PDO::PARAM_STR);
    $stmt->bindParam(':postID', $postID, PDO::PARAM_STR);
    $stmt->execute();
}

function UpdatePost($postID, $title, $entry)
{
    $excerpt = substr($entry, 0, 100);
    try
        {
            // get the db obj
            $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        }
        catch(PDOException $e)
        {
             echo $e->getMessage();
        }
        $sql = "UPDATE Posts SET PostID = :postid, Title = :title, PostData = :entry, Excerpt = :excerpt WHERE PostID = :postid";
            $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':postid', $postID, PDO::PARAM_STR);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':entry', $entry, PDO::PARAM_STR);
        $stmt->bindParam(':excerpt', $excerpt, PDO::PARAM_STR);
        $stmt->execute();
}

function DeletePost($PostID, $UserID)
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
    $sql = "DELETE FROM `klocke_Blogs`.`Posts` WHERE `Posts`.`PostID` = :postID; DELETE FROM `klocke_Blogs`.`User_Posts_JT` WHERE `User_Posts_JT`.`jt_UserID` = :userID AND `User_Posts_JT`.`jt_PostID` = :postID";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':userID', $UserID, PDO::PARAM_STR);
    $stmt->bindParam(':postID', $PostID, PDO::PARAM_STR);
    $stmt->execute();
}
}
?>