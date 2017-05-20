<!DOCTYPE html>
<html>
    <head>
        <title><?= $PageTitle ?></title>
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        
        <!-- Custom style sheet -->
        <link rel="stylesheet" href="styles/Style.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
    </head>
<body>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 side_nav">
                <?php echo $this->render($sidenav,NULL,get_defined_vars(),0); ?> 
            </div>
            <div class="col-sm-9">
                <!-- show about section -->
                        <div class="container-fluid">
                            <div class="col-sm-12">
                                <div class="aboutContainer">
                                    <p class="aboutTitle"><center><?= $_user->getUserName() ?> Blogs</center></p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="container-fluid">
                            <div class="col-sm-8">
                                <?php if ($hasPosts == 'true'): ?>
                                    
                                        <div class="blogContainer">
                                        <div>
                                            <h3><a href="<?= $BASE ?>/Post/<?= $posts[0]->getPostID() ?>">My Most Recent blog:</a></h3>
                                            <?= $posts[0]->getPostData().PHP_EOL ?>
                                        </div>
                                        </div>
                                        <br>
                                        <div class="blogContainer">
                                            <p>My Blogs:</p>
                                            <!-- start blogs loop at 1 so we can skip the latest posted above -->
                                            <?php for ($i=1;$i < count($posts);$i++): ?>
                                            <a href="<?= $BASE ?>/Post/<?= $posts[$i]->getPostID() ?>"><?= $posts[$i]->getPostTitle() ?></a> - word count <?= $posts[$i]->getPostWordCount ?> <?= $posts[$i]->getPostDate().PHP_EOL ?>
                                            <hr class="about">
                                            <?= $posts[$i]->getPostExcerpt() ?><br/>
                                            <?php endfor; ?>
                                        </div>
                                    
                                    <?php else: ?>
                                        <div class="col-sm-8 blogContainer">
                                            <p><?= $_user->getUserName() ?> Does not have any blog posts to show :( </p>
                                        </div>
                                    
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-4">
                                    <center><img src="profilephotos/<?= $_user->getProfilePic() ?>" class="img-responsive" alt="Profile Pic"></center>
                                    <div class="aboutContent">
                                        <center><?= $_user->getUserName() ?></center>
                                        <hr class="about">
                                        Bio: <?= $_user->getBio().PHP_EOL ?>
                                        </div>
                            </div>
                            
                            
                        </div>
            </div>
        </div>
    </div>

</body>