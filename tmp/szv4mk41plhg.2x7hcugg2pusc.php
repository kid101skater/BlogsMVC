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
            <div class="col-sm-7">
                <!-- show about section -->
                <div class="aboutContainer">
                        <div class="container-fluid">
                            <div class="col-sm-9">
                                <div class="aboutHeader">
                                    <p class="aboutTitle">Become a Blogger!</p>
                                    <small>Create a new account below</small>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <img src="<?= $BASE ?>/images/writing.png" class="img-responsive" alt="blog site login icon">
                            </div>
                        </div>
                </div>
                        <br>
                <!-- Show content below header -->
                <div class="container-fluid aboutContent">
                    <center>
                        <form class="form-inline" method="POST" enctype="multipart/form-data">
                        <div class="container-fluid">
                            <div class="col-sm-6">
                                <div class="register-left">
                                    <label for="user">Username</label>
                                    <input type="text" id="user" name="user" class="" value="<?= $Username ?>">
                                    <br>
                                    <label for="email">Email</label>
                                    <input type="text" id="email" name="email" class="" value="<?= $Email ?>">
                                </div>
                                     
                                <div class="register-left">
                                    <label for="pword">Password</label>
                                    <input type="password" id="pword" name="pword" class="" value="<?= $Password ?>"><br>
                                    <label for="verify">Verify</label>
                                    <input type="password" id="verify" name="verify" class="" value="<?= $Password ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <input type="file" name="fileToUpload" id="fileToUpload""><br>
                                <center>Quick Bio</center>
                                <textarea name="bio" class="registerbio" rows="4" name="bio"><?= $Bio ?></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                        <br>
                        </form>
                        <br>
                    </center>
                </div>
            </div>
            <div class="col-sm-2">
                <!-- spacer -->
            </div>
        </div>
    </div>

</body>