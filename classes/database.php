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
}