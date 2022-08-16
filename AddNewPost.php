<?php include("include/DB.php"); ?>
<?php include("include/function.php"); ?>
<?php include("include/session.php"); ?>
<?php
$target_dir = "";
$target_file = "";
$uploadOk = 1;


?>
<?php
if (isset($_POST["submit"])) {
  
    $PostTitle = $_POST["PostTitle"];
    $category = $_POST["category"];
    $image = $_FILES["image"]["name"];
    $target_dir = "Upload/";
    $target_file = $target_dir.basename($_FILES["image"]["name"]);
    // print_r($_FILES);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // $check = getimagesize($_FILES["image"]["tmp_name"]);
    $postDescription = $_POST["postDescription"];
    $Admin = "sonam";
    // for data and time
    date_default_timezone_set("Asia/Karachi");
    $CurrentTime = time();
    $DateTime = strftime("%B-%d-%y %H:%M:%S", $CurrentTime);

    if (empty($PostTitle)) {
        echo "post is emoty";
        $_SESSION["ErrorMessage"] = "Title cant be empty";
        Redirect_to("AddNewPost.php");
       
    } elseif (empty($image)) {
        $_SESSION["ErrorMessage"] = "Image cant be empty";
        Redirect_to("AddNewPost.php");
      }
    //  elseif ($check == false) {
    //    $_SESSION["ErrorMessage"] = "File is not image";
    //    Redirect_to("AddNewPost.php");
    // }
    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        $_SESSION["ErrorMessage"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed and images.";
        Redirect_to("AddNewPost.php");
        $uploadOk = 0;
  } 
        elseif ($_FILES["image"]["size"] > 5000) {
        $_SESSION["ErrorMessage"] = "Please Upload the image under 5Mb.";
        Redirect_to("AddNewPost.php");
        $uploadOk = 0;
    } 
    elseif(empty($postDescription)) {
        $_SESSION["ErrorMessage"] = "Post cant be empty";
        Redirect_to("AddNewPost.php");
    }
     elseif (strlen($postDescription) < 5) {
        $_SESSION["ErrorMessage"] = "Post Title should be greater than 5 character";
        Redirect_to("AddNewPost.php");
    } elseif (strlen($postDescription) > 999) {
        $_SESSION["ErrorMessage"] = "Post description should be less than 1000 character";
        Redirect_to("AddNewPost.php");
    }  
    else {
        //insert the post if everything is good
        $sql = "INSERT INTO posts(datetimee,title,category,author,image,post)";
        $sql .= "VALUES(:poatDateTime,:postTitle,:poatCategory,:postAuthor,:postImage,:Postname)";
        $stmt = $connectingDB->prepare($sql);
        $stmt->bindValue(':poatDateTime', $DateTime);
        $stmt->bindValue(':postTitle', $PostTitle);
        $stmt->bindValue(':poatCategory', $category);
        $stmt->bindValue(':postAuthor', $Admin);
        $stmt->bindValue(':postImage', $image);
        $stmt->bindValue(':Postname', $postDescription);
        $Execute = $stmt->execute();
        if ($Execute) {
            $_SESSION["successMessage"] = "Category with id:" . $connectingDB->lastInsertId() . "Category Added Successfully";
            Redirect_to("AddNewPost.php");
        }
        if (move_uploaded_file($_FILES["image"]["tmp_name"],$target_file)) {
            // print_r($target_file);
            $_SESSION["ErrorMessage"] = "something went wrong";
            Redirect_to("AddNewPost.php");
            $uploadOk = 0;
        }  
         else {
            $_SESSION["ErrorMessage"] = "something went wrong";
            Redirect_to("AddNewPost.php");
        }
    }
   }

?>


<!DOCTYPE html>
<html>

<head>
    <title>Categories</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/stylee.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
    <!-- NaVbar -->
    <div style="height: 10px; background: #27aae1"></div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="#" class="navbar-brand">WWW.COM</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarcollapseCMS">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="myProfile.php" class="nav-link"><i class="fa fa-user text-success" aria-hidden="true"></i> My
                            Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="Dashboard.php" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="posts.php" class="nav-link">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a href="Categories" class="nav-link">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a href="Admins.php" class="nav-link">Manage Admins</a>
                    </li>
                    <li class="nav-item">
                        <a href="Comments.php" class="nav-link">comments</a>
                    </li>
                    <li class="nav-item">
                        <a href="Blog.php" class="nav-link">live Blog</a>
                    </li>
                </ul>

                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="Logout.php" class="nav-link"><i class="fa fa-sign-out text-danger" aria-hidden="true"></i>
                            Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div style="height: 10px; background: #27aae1"></div>
    <!-- Navbar End -->

    <!-- header start -->
    <header class="bg-dark text-white py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><i class="fa fa-pencil-square-o" style="color:#27aae1;"></i>Add New Post</h1>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- main area start -->
    <section class="container py-2 mb-4">
        <div class="row">
            <div class=" offset-lg-1 col-lg-10" style="min-height:400px;">
                <?php
                echo ErrorMessage();
                echo successMessage();
                ?>
                <form class="" action="AddNewPost.php" method="post" enctype="multipart/form-data">
                    <div class="card bg-secondary text-light mb-3">

                        <!-- post title -->
                        <div class="card-body bg-dark">
                            <div class="form-group">
                                <label for="title"><span class="FieldInfo">Post:</span></label>
                                <input class="form-control" type="text" name="PostTitle" id="title" placeholder="Type title here" value="">
                            </div>
                            <!-- post title end -->

                            <!-- Choose category -->
                            <div class="form-group">
                                <label for="categoryTitle"><span class="FieldInfo"> Choose Category:</span></label>
                                <select class="form-control" id="categoryTitle" name="category">
                                    <?php
                                    //fetching all the categories from category table
                                    global $connectingDB;
                                    $sql = "SELECT id,title FROM category";
                                    $stmt = $connectingDB->query($sql);
                                    while ($DataRows = $stmt->fetch()) {
                                        $Id = $DataRows["id"];
                                        $CategoryName = $DataRows["title"];

                                    ?>
                                        <option> <?php echo $CategoryName; ?></option>
                                    <?php  } ?>
                                </select>
                            </div>
                            <!-- Choose category  end-->

                            <!-- image-start -->
                            <div class="form-group mb-4">
                                <label for="imageSelect"><span class="FieldInfo"> Select File:</span></label>
                                <div class="custom-file">
                                    <input class="custom-file-input" type="File" name="image"  id="imageSelect">
                                    <label for="imageSelect" class="custom-file-label"></label>
                                </div>
                            </div>
                            <!-- image-end -->

                            <!-- post-title -->
                            <div class="form-group">
                                <label for="post"> <span class="FieldInfo">Post Title:</span></label>
                                <textarea class="form-control" name="postDescription" rows="8" cols="80"></textarea>
                            </div>
                            <!-- post-title -->


                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fa fa-arrow-left">Back To Dashboard</i></a>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="submit" name="submit" class="btn btn-success btn-block">
                                        <i class="fa fa-check"></i>publish
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </section>
    <!-- main area end -->

    <!-- footer start -->
    <footer class="bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="lead text-center">
                        Theme By| Sonam Rajput |<span id="year"></span> &copy; ---All
                        right Reserved.
                    </p>
                    <p class="text-center small">
                        <a style="color: aliceblue; text-decoration: none; cursor: ponter" href="http://jazebakram.com/coupons" target="_blank">
                            This site is only used for study purpose jazebakram.com have you
                            all the rights. No one is allow to distribute copies other than
                            <br />&trade; jazebakram.com &trade; udemy ; &trade; skillshare
                            ; &trade; stackskills
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <div style="height: 10px; background: #27aae1"></div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $("#year").text(new Date().getFullYear());
    </script>
</body>

</html>