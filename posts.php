<?php include("include/DB.php"); ?>
<?php include("include/function.php"); ?>
<?php include("include/session.php"); ?>

<!DOCTYPE html>
<html>

<head>
    <title>Posts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/syles.css" />
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

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
                        <a href="myProfile.php" class="nav-link"><i class="fa fa-user text-success" aria-hidden="true"></i> MyProfile</a>
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
                    <h1><i class='fas fa-blog' style="color:#27aae1;"></i>Blog Posts</h1>
                </div>
                <div class="col-lg-3 mb-2">
                    <a href="AddNewPost.php" class="btn btn-primary btn-block">
                        <i class="fas fa-edit"></i>Add New Post
                    </a>
                </div>

                <div class="col-lg-3 mb-2">
                    <a href="Categories.php" class="btn btn-info btn-block">
                        <i class="fas fa-folder-plus"></i>Add New Catecory
                    </a>
                </div>

                <div class="col-lg-3 mb-2">
                    <a href="Admins.php" class="btn btn-warning btn-block">
                        <i class="fas fa-user-plus"></i>Add New Admin
                    </a>
                </div>

                <div class="col-lg-3 mb-2">
                    <a href="Comments.php" class="btn btn-success btn-block">
                        <i class="fas fa-check"></i>Approve Comments
                    </a>
                </div>


            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- main area -->
    <section class="container py-2 mb-4">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date&Time</th>
                            <th>Author</th>
                            <th>Banner</th>
                            <th>Comments</th>
                            <th>Action</th>
                            <th>Live preview</th>
                        </tr>
                    </thead>

                    <?php
                    global $connectingDB;
                    $sql = "SELECT * FROM posts";
                    $stmt = $connectingDB->query($sql);
                    $sr = 0;
                    while ($DataRows = $stmt->fetch()) {
                        $Id = $DataRows["id"];
                        $DateTime = $DataRows["datetimee"];
                        $PostTitle = $DataRows["title"];
                        $Author = $DataRows["author"];
                        $Category = $DataRows["category"];
                        $Image = $DataRows["image"];
                        $PostText = $DataRows["post"];
                        $sr++;
                    ?>
                        <tbody>
                            <tr>
                                <td><?php echo $sr; ?></td>
                                <td>
                                    <?php
                                    if (strlen($PostTitle) > 20) {
                                        $PostTitle = substr($PostTitle, 0, 18) . '..';
                                    }
                                    echo $PostTitle;
                                    ?>
                                </td>
                                <td><?php
                                    if (strlen($Category) > 8) {
                                        $Category = substr($Category, 0, 8) . '..';
                                    }
                                    echo $Category;
                                    ?>
                                </td>
                                <td><?php
                                 if (strlen($DateTime) > 9) {
                                    $DateTime = substr($DateTime, 0, 9) . '..';
                                }
                                 echo $DateTime; ?></td>
                                <td><?php echo $Author; ?></td>
                                <td><img src="Upload/<?php echo $Image; ?>" width="170px;"></td>
                                <td>Commets</td>
                                <td>
                                    <a href="#"><span class="btn btn-warning">Edit</span></a>
                                    <a href="#"><span class="btn btn-danger">Delete</span></a>

                                </td>
                                <td>
                                    <a href="#"><span class="btn btn-primary">Live preview</span></a>
                                </td>
                            </tr>
                        </tbody>

                    <?php  } ?>
                </table>

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