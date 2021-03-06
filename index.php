<?php
// Created by Userlg
include "core.php";
head();
?>
	<div class="col-md-8">
<?php
$mt3_i = "";
$run   = mysqli_query($connect, "SELECT * FROM `posts` WHERE active='Yes' AND featured='Yes' ORDER BY id DESC");
$count = mysqli_num_rows($run);
if ($count > 0) {
    $i = 0;
    $mt3_i = "mt-3";
?>
<div id="carouselExampleCaptions" class="col-md-12 carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
<?php
    while ($row = mysqli_fetch_assoc($run)) {
        $active1 = "";
        if ($i == 0) {
            $active1 = 'class="active" aria-current="true"';
        }
        
        echo '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="' . $i . '" '. $active1 .' aria-label="' . $row['title'] . '"></button>
        ';
        
        $i++;
    }
?>
  </div>
  <div class="carousel-inner rounded">
<?php
    $j = 0;
    $run2 = mysqli_query($connect, "SELECT * FROM `posts` WHERE active='Yes' AND featured='Yes' ORDER BY id DESC");
    while ($row2 = mysqli_fetch_assoc($run2)) {
        $active = "";
        if ($j == 0) {
            $active = " active";
        }
        
        $image = "";
        if($row2['image'] != "") {
            $image = '<img src="' . $row2['image'] . '" alt="' . $row2['title'] . '" class="d-block w-100" style="height: 400px;">';
        } else {
            $image = '<svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="' . $row2['title'] . '" preserveAspectRatio="xMidYMid slice" focusable="false">
            <title>' . $row2['title'] . '</title>
            <rect width="100%" height="100%" fill="#555"></rect>
            <text x="40%" y="50%" fill="#333" dy=".3em">' . $row2['title'] . '</text></svg>';
        }

        echo '
        <div class="carousel-item'. $active .'">
            <a href="post.php?id=' . $row2['id'] . '">' . $image . '</a>
            <div class="carousel-caption d-none d-md-block">
                <h5><a href="post.php?id=' . $row2['id'] . '" class="text-light">' . $row2['title'] . '</a></h5>
                <p class="text-light"><i class="fas fa-calendar"></i> ' . $row2['date'] . ', ' . $row2['time'] . '</a></p>
            </div>
        </div>
        ';
        
        $j++;
    }
?>
  </div>
  
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<?php
}
?>
            <div class="row <?php echo $mt3_i; ?>">
                <h5><i class="fa fa-list"></i> Latest Posts</h5>
<?php
$run   = mysqli_query($connect, "SELECT * FROM `posts` WHERE active='Yes' ORDER BY id DESC LIMIT 8");
$count = mysqli_num_rows($run);
if ($count <= 0) {
    echo '<div class="alert alert-info">There are no published posts</div>';
} else {
    while ($row = mysqli_fetch_assoc($run)) {
        
        $image = "";
        if($row['image'] != "") {
            $image = '<img src="' . $row['image'] . '" alt="' . $row['title'] . '" style="width: 100%; height: 180px;">';
        } else {
            $image = '<svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
            <title>No Image</title><rect width="100%" height="100%" fill="#55595c"/>
            <text x="40%" y="50%" fill="#eceeef" dy=".3em">No Image</text></svg>';
        }
        
        echo '
                    <div class="col-md-6 mb-3"> 
                        <div class="card shadow-sm">
                            <a href="post.php?id=' . $row['id'] . '">
                                '. $image .'
                            </a>
                            <div class="card-body">
                                <a href="post.php?id=' . $row['id'] . '"><h6 class="card-title">' . $row['title'] . '</h6></a>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="category.php?id=' . $row['category_id'] . '"><span class="badge bg-primary">' . post_category($row['category_id']) . '</span></a>
                                    <small><i class="fas fa-comments"></i> Comments: 
                                        <a href="post.php?id=' . $row['id'] . '#comments" class="blog-comments"><b>' . post_commentscount($row['id']) . '</b></a>
                                    </small>
                                </div>
                                <p class="card-text">' . short_text(strip_tags(html_entity_decode($row['content'])), 100) . '</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="fas fa-user-edit"></i> ' . post_author($row['author_id']) . '</div>
                                    <small class="text-muted"><i class="far fa-calendar-alt"></i> ' . $row['date'] . ', ' . $row['time'] . '</small>
                                </div>
                            </div>
                        </div>
                    </div>
';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic Page -->
    <meta charset="UTF-8">
    <title>Bn News - Multipurpose Modern Bootstrap 4</title>

    <!-- Mobile Specific -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">

    <!-- Owl Slider Styles -->
    <link rel="stylesheet" href="assets/css/vendor/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/css/vendor/owl.carousel.min.css">

    <!-- Magnific Styles -->
    <link rel="stylesheet" href="assets/css/vendor/magnific-popup.css">

    <!-- Animate Styles -->
    <link rel="stylesheet" href="assets/css/vendor/animate.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/css/vendor/fontawesome.min.css">

    <!-- Colorbox -->
    <link rel="stylesheet" href="assets/css/vendor/colorbox.css">

    <!-- Main Styles -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Spaces Styles -->
    <link rel="stylesheet" href="assets/css/spaces.css">

    <!-- Responsive Styles -->
    <link rel="stylesheet" href="assets/css/responsive.css">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="assets/js/vendor/html5shiv.js"></script>
      <script src="assets/js/vendor/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <!-- Start Top Section -->
    <div class="bn-top">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="bn-breaking-title">
                            <span class="bn-breaking-title-text">Breaking News</span>
                        </div>
                        <div id="bn-breaking-news">
                            <ul class="fade">
                                <li>
                                    <div class="breaking-news-item">
                                    <a href="#">The worth of a man lies in what he does well</a>
                                </div>
                                </li>
                                <!-- Breaking News Item 1 End -->
                                <li>
                                    <div class="breaking-news-item">
                                    <a href="#">Better have a wise enemy than a foolish friend</a>
                                </div>
                                </li>
                                <!-- Breaking News Item 2 End -->
                                <li>
                                    <div class="breaking-news-item">
                                    <a href="#">The fear of God is the beginning of wisdom</a>
                                </div>
                                </li>
                                <!-- Breaking News Item 3 End -->
                                <li>
                                    <div class="breaking-news-item">
                                    <a href="#">It wasn???t raining when Noah built the ark</a>
                                </div>
                                </li>
                                <!-- Breaking News Item 4 End -->
                            </ul>
                        </div>
                        <!-- Breaking News End -->
                    </div>
                    <!-- Row End -->
                </div>
                <!-- Col End -->
                <div class="col-md-3">
                    <div class="bn-social-icons">
                        <ul>
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <!-- Social Icons Item 1 End -->
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <!-- Social Icons Item 2 End -->
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <!-- Social Icons Item 3 End -->
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <!-- Social Icons Item 4 End -->
                            <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                            <!-- Social Icons Item 5 End -->
                        </ul>
                    </div>
                    <!-- Social Icons End -->
                </div>
                <!-- Col End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Top Section End -->
    <!-- Start Header Section -->
    <header class="bn-header">
        <div class="bn-header-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="bn-logo">
                            <a href="index.html">
                                <img src="assets/images/header-logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- Logo Col End -->
                    <div class="col-md-9">
                        <div class="bn-top-ad">
                            <a href="#">
                                <img class="img-fluid" src="assets/images/728x90.png" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- Ad col End -->
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Header Content End -->
    </header>
    <!-- Header Section End -->
    <!-- Start Main Navigation Section -->
    <div class="main-nav clearfix bn-sticky">
        <div class="container">
            <div class="row justify-content-between">
                <nav class="navbar navbar-expand-lg col-lg-8">
                    <div class="site-nav-inner float-left">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
                            <span class="fa fa-bars"></span>
                        </button>
                        <!-- Navbar Toggler End -->
                        <div id="navbarSupportedContent" class="navbar-collapse navbar-responsive-collapse collapse">
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.html">Home</a>
                                </li>
                                <!-- Nav Item 1 End -->
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link menu-dropdown" data-toggle="dropdown">Category <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu fade-up" role="menu">
                                        <li><a class="dropdown-item" href="category-grid.html">Grid Layout</a></li>
                                        <li><a class="dropdown-item" href="category-list.html">List Layout</a></li>
                                        <li><a class="dropdown-item" href="category-classic.html">Classic Layout</a></li>
                                    </ul>
                                    <!-- Dropdown End -->
                                </li>
                                <!-- Nav Item 2 End -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link menu-dropdown" href="#" data-toggle="dropdown">Posts <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu fade-up" role="menu">
                                        <li><a class="dropdown-item" href="single.html">Single Post #1</a></li>
                                        <li><a class="dropdown-item" href="single-2.html">Single Post #2</a></li>
                                    </ul>
                                    <!-- Dropdown End -->
                                </li>
                                <!-- Nav Item 3 End -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link menu-dropdown" href="#" data-toggle="dropdown">Pages <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu fade-up" role="menu">
                                        <li><a class="dropdown-item" href="author.html">Author Page</a></li>
                                        <li><a class="dropdown-item" href="404.html">404</a></li>
                                        <li><a class="dropdown-item" href="contact.html">Contact</a></li>
                                    </ul>
                                    <!-- Dropdown End -->
                                </li>
                                <!-- Nav Item 4 End -->
                            </ul>
                            <!-- Nav UL End -->
                        </div>
                        <!-- Navbar Collapse End -->
                    </div>
                    <!-- Site Nav Inner End -->
                </nav>
                <!-- Navbar End -->
                <div class="col-lg-4 text-right nav-search-wrap">
                    <div class="nav-search">
                        <a href="#search-popup" class="bn-modal-popup">
                            <i class="fas fa-search"></i>
                        </a>
                    </div>
                    <!-- Search End -->
                    <div class="zoom-anim-dialog mfp-hide modal-searchPanel bn-search-form" id="search-popup">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="bn-search-panel">
                                    <form class="bn-search-group">
                                        <div class="input-group">
                                            <input type="search" class="form-control" name="s" placeholder="Search" value="">
                                            <button class="input-group-btn search-button">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                </div>
                <!-- Col End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Menu Nav End -->
    <div class="bn-gap-30"></div>
    <!-- Start Featured Section -->
    <section class="bn-featured-section no-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-7 col-md-12">
                            <div class="bn-slide bn-post-overaly-style post-lg" style="background-image:url(assets/images/800x693.png)">
                                <a href="#" class="bn-image-link">&nbsp;</a>
                                <div class="bn-category">
                                    <a class="bn-post-category" href="#">Tech</a>
                                </div>
                                <div class="bn-overlay-post-content featured-post">
                                    <div class="bn-post-content">
                                        <h2 class="bn-post-title title-lg">
                                            <a href="#">It wasn???t raining when Noah built the ark</a>
                                        </h2>
                                        <div class="bn-post-meta bn-mb-7">
                                            <ul>
                                                <li class="bn-post-author"><a href="#"><i class="fa fa-user"></i> James Bond</a></li>
                                                <li class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</li>
                                                <li class="bn-post-views"><i class="fab fa-gripfire"></i> 450K</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Post Content End -->
                                </div>
                                <!-- Overlay Post Content -->
                            </div>
                            <!-- Big Slide End -->
                        </div>
                        <!-- Col End -->
                        <div class="col-lg-5 col-md-12">
                            <div class="row">
                                <div class="col-md-12 bn-mrb-30">
                                    <div class="bn-post-overaly-style post-extra-sm" style="background-image:url(assets/images/800x467.png)">
                                        <a href="#" class="bn-image-link">&nbsp;</a>
                                        <div class="bn-category">
                                            <a class="bn-post-category" href="#">Tech</a>
                                        </div>
                                        <div class="bn-overlay-post-content">
                                            <div class="bn-post-content">
                                                <h2 class="bn-post-title title-md">
                                                    <a href="#">Do not give up. The beginning is always the hardest</a>
                                                </h2>
                                                <div class="bn-post-meta bn-mb-7">
                                                    <ul>
                                                        <li class="bn-post-author"><a href="#"><i class="fa fa-user"></i> James Bond</a></li>
                                                        <li class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- Post Content End -->
                                        </div>
                                        <!-- Overlay Post Content -->
                                    </div>
                                    <!-- Small Slide End -->
                                </div>
                                <!-- Col End -->
                                <div class="col-md-12">
                                    <div class="bn-post-overaly-style post-extra-sm" style="background-image:url(assets/images/800x467.png)">
                                        <a href="#" class="bn-image-link">&nbsp;</a>
                                        <div class="bn-category">
                                            <a class="bn-post-category" href="#">Tech</a>
                                        </div>
                                        <div class="bn-overlay-post-content">
                                            <div class="bn-post-content">
                                                <h2 class="bn-post-title title-md">
                                                    <a href="#">If patience is bitter, the consequences are sweet</a>
                                                </h2>
                                                <div class="bn-post-meta bn-mb-7">
                                                    <ul>
                                                        <li class="bn-post-author"><a href="#"><i class="fa fa-user"></i> James Bond</a></li>
                                                        <li class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- Post Content End -->
                                        </div>
                                        <!-- Overlay Post Content -->
                                    </div>
                                    <!-- Small Slide End -->
                                </div>
                                <!-- Col End -->
                            </div>
                            <!-- Row End -->
                        </div>
                        <!-- Col End -->
                    </div>
                    <!-- Row End -->
                </div>
                <!-- Col End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </section>
    <!-- Featured Section End -->
    <!-- Start Carousel Section -->
    <section class="carousel-section pb-0">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h2 class="bn-block-title">Trending Now</h2>
                </div>
                <div class="col-12">
                    <div id="trending-carousel" class="owl-carousel owl-theme">
                        <div class="bn-item">
                            <div class="bn-post-block-style">
                                <div class="bn-post-thumb position-relative thumb-overlay">
                                    <a href="#"><img class="img-fluid" src="assets/images/800x520.png" alt=""></a>
                                    <div class="bn-category">
                                        <a class="bn-post-category" href="#">Tech</a>
                                    </div>
                                </div>
                                <!-- Post Thumb End -->
                                <div class="bn-post-content">
                                    <h2 class="bn-post-title title-sm"><a href="#">The worth of a man lies in what he does well</a></h2>
                                    <div class="bn-post-meta bn-mb-7">
                                        <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                    </div>
                                </div>
                                <!-- Post Content End -->
                            </div>
                            <!-- Post Block Style End -->
                        </div>
                        <!-- Item 1 End -->
                        <div class="bn-item">
                            <div class="bn-post-block-style">
                                <div class="bn-post-thumb position-relative thumb-overlay">
                                    <a href="#"><img class="img-fluid" src="assets/images/800x520.png" alt=""></a>
                                    <div class="bn-category">
                                        <a class="bn-post-category" href="#">Tech</a>
                                    </div>
                                </div>
                                <!-- Post Thumb End -->
                                <div class="bn-post-content">
                                    <h2 class="bn-post-title title-sm"><a href="#">A man is known by the company he keeps</a></h2>
                                    <div class="bn-post-meta bn-mb-7">
                                        <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                    </div>
                                </div>
                                <!-- Post Content End -->
                            </div>
                            <!-- Post Block Style End -->
                        </div>
                        <!-- Item 2 End -->
                        <div class="bn-item">
                            <div class="bn-post-block-style">
                                <div class="bn-post-thumb position-relative thumb-overlay">
                                    <a href="#"><img class="img-fluid" src="assets/images/800x520.png" alt=""></a>
                                    <div class="bn-category">
                                        <a class="bn-post-category" href="#">Tech</a>
                                    </div>
                                </div>
                                <!-- Post Thumb End -->
                                <div class="bn-post-content">
                                    <h2 class="bn-post-title title-sm"><a href="#">Better have a wise enemy than a foolish friend</a></h2>
                                    <div class="bn-post-meta bn-mb-7">
                                        <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                    </div>
                                </div>
                                <!-- Post Content End -->
                            </div>
                            <!-- Post Block Style End -->
                        </div>
                        <!-- Item 3 End -->
                        <div class="bn-item">
                            <div class="bn-post-block-style">
                                <div class="bn-post-thumb position-relative thumb-overlay">
                                    <a href="#"><img class="img-fluid" src="assets/images/800x520.png" alt=""></a>
                                    <div class="bn-category">
                                        <a class="bn-post-category" href="#">Tech</a>
                                    </div>
                                </div>
                                <!-- Post Thumb End -->
                                <div class="bn-post-content">
                                    <h2 class="bn-post-title title-sm"><a href="#">The fear of God is the beginning of wisdom</a></h2>
                                    <div class="bn-post-meta bn-mb-7">
                                        <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                    </div>
                                </div>
                                <!-- Post Content End -->
                            </div>
                            <!-- Post Block Style End -->
                        </div>
                        <!-- Item 4 End -->
                        <div class="bn-item">
                            <div class="bn-post-block-style">
                                <div class="bn-post-thumb position-relative thumb-overlay">
                                    <a href="#"><img class="img-fluid" src="assets/images/800x520.png" alt=""></a>
                                    <div class="bn-category">
                                        <a class="bn-post-category" href="#">Tech</a>
                                    </div>
                                </div>
                                <!-- Post Thumb End -->
                                <div class="bn-post-content">
                                    <h2 class="bn-post-title title-sm"><a href="#">Don???t talk unless you can improve the silence</a></h2>
                                    <div class="bn-post-meta bn-mb-7">
                                        <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                    </div>
                                </div>
                                <!-- Post Content End -->
                            </div>
                            <!-- Post Block Style End -->
                        </div>
                        <!-- Item 5 End -->
                        <div class="bn-item">
                            <div class="bn-post-block-style">
                                <div class="bn-post-thumb position-relative thumb-overlay">
                                    <a href="#"><img class="img-fluid" src="assets/images/800x520.png" alt=""></a>
                                    <div class="bn-category">
                                        <a class="bn-post-category" href="#">Tech</a>
                                    </div>
                                </div>
                                <!-- Post Thumb End -->
                                <div class="bn-post-content">
                                    <h2 class="bn-post-title title-sm"><a href="#">It wasn???t raining when Noah built the ark</a></h2>
                                    <div class="bn-post-meta bn-mb-7">
                                        <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                    </div>
                                </div>
                                <!-- Post Content End -->
                            </div>
                            <!-- Post Block Style End -->
                        </div>
                        <!-- Item 6 End -->
                        <div class="bn-item">
                            <div class="bn-post-block-style">
                                <div class="bn-post-thumb position-relative thumb-overlay">
                                    <a href="#"><img class="img-fluid" src="assets/images/800x520.png" alt=""></a>
                                    <div class="bn-category">
                                        <a class="bn-post-category" href="#">Tech</a>
                                    </div>
                                </div>
                                <!-- Post Thumb End -->
                                <div class="bn-post-content">
                                    <h2 class="bn-post-title title-sm"><a href="#">It wasn???t raining when Noah built the ark</a></h2>
                                    <div class="bn-post-meta bn-mb-7">
                                        <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                    </div>
                                </div>
                                <!-- Post Content End -->
                            </div>
                            <!-- Post Block Style End -->
                        </div>
                        <!-- Item 7 End -->
                        <div class="bn-item">
                            <div class="bn-post-block-style">
                                <div class="bn-post-thumb position-relative thumb-overlay">
                                    <a href="#"><img class="img-fluid" src="assets/images/800x520.png" alt=""></a>
                                    <div class="bn-category">
                                        <a class="bn-post-category" href="#">Tech</a>
                                    </div>
                                </div>
                                <!-- Post Thumb End -->
                                <div class="bn-post-content">
                                    <h2 class="bn-post-title title-sm"><a href="#">You will succeed because most people are lazy</a></h2>
                                    <div class="bn-post-meta bn-mb-7">
                                        <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                    </div>
                                </div>
                                <!-- Post Content End -->
                            </div>
                            <!-- Post Block Style End -->
                        </div>
                        <!-- Item 8 End -->
                    </div>
                    <!-- Carousel End -->
                </div>
                <!-- Col End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </section>
    <!-- Carousel Section End -->
    <!-- Start Block Wrap -->
    <section class="bn-block-wrap">
        <div class="container">
            <div class="row bn-gutter-30">
                <div class="col-lg-8 col-md-12">
                    <!-- Start Block Style 1 -->
                    <div class="bn-block-style-1">
                        <h2 class="bn-block-title">WEEKLY POPULAR</h2>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="bn-post-block-style clearfix">
                                    <div class="bn-post-thumb">
                                        <a href="#"><img class="img-fluid" src="assets/images/800x520.png" alt=""></a>
                                        <div class="bn-category">
                                            <a class="bn-post-category" href="#">Tech</a>
                                        </div>
                                    </div>
                                    <!-- Post Thumb End -->
                                    <div class="bn-post-content">
                                        <h2 class="bn-post-title title-md"><a href="#">It wasn???t raining when Noah built the ark</a></h2>
                                        <p class="post-text">True friendship is perhaps the only relation that survives the trials and tribulations of time and remains unconditional.</p>
                                        <div class="bn-post-meta bn-mb-7">
                                            <span class="bn-post-author"><a href="#"><i class="fa fa-user"></i> James Bond</a></span>
                                            <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                        </div>
                                    </div>
                                    <!-- Post Content End -->
                                </div>
                                <!-- Post Block Style End -->
                            </div>
                            <!-- Col End -->
                            <div class="col-lg-6 ">
                                <div class="bn-list-post-block">
                                    <ul class="bn-list-post">
                                        <li>
                                            <div class="bn-post-block-style media">
                                                <div class="bn-post-thumb">
                                                    <a href="#">
                                                        <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                    </a>
                                                </div>
                                                <!-- Post Thumb End -->
                                                <div class="bn-post-content media-body">
                                                    <div class="bn-grid-category">
                                                        <a class="bn-post-cat" href="#">Sports</a>
                                                    </div>
                                                    <h2 class="bn-post-title">
                                                        <a href="#">The worth of a man lies in what he does well</a>
                                                    </h2>
                                                    <div class="bn-post-meta bn-mb-7">
                                                        <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                    </div>
                                                </div>
                                                <!-- Post Content End -->
                                            </div>
                                            <!-- Post Block Style End -->
                                        </li>
                                        <!-- LI 1 End -->
                                        <li>
                                            <div class="bn-post-block-style media">
                                                <div class="bn-post-thumb">
                                                    <a href="#">
                                                        <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                    </a>
                                                </div>
                                                <!-- Post Thumb End -->
                                                <div class="bn-post-content media-body">
                                                    <div class="bn-grid-category">
                                                        <a class="bn-post-cat" href="#">Sports</a>
                                                    </div>
                                                    <h2 class="bn-post-title">
                                                        <a href="#">Better have a wise enemy than a foolish friend</a>
                                                    </h2>
                                                    <div class="bn-post-meta bn-mb-7">
                                                        <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                    </div>
                                                </div>
                                                <!-- Post Content End -->
                                            </div>
                                            <!-- Post Block Style End -->
                                        </li>
                                        <!-- LI 2 End -->
                                        <li>
                                            <div class="bn-post-block-style media">
                                                <div class="bn-post-thumb">
                                                    <a href="#">
                                                        <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                    </a>
                                                </div>
                                                <!-- Post Thumb End -->
                                                <div class="bn-post-content media-body">
                                                    <div class="bn-grid-category">
                                                        <a class="bn-post-cat" href="#">Sports</a>
                                                    </div>
                                                    <h2 class="bn-post-title">
                                                        <a href="#">The fear of God is the beginning of wisdom</a>
                                                    </h2>
                                                    <div class="bn-post-meta bn-mb-7">
                                                        <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                    </div>
                                                </div>
                                                <!-- Post Content End -->
                                            </div>
                                            <!-- Post Block Style End -->
                                        </li>
                                        <!-- LI 3 End -->
                                        <li>
                                            <div class="bn-post-block-style media">
                                                <div class="bn-post-thumb">
                                                    <a href="#">
                                                        <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                    </a>
                                                </div>
                                                <!-- Post Thumb End -->
                                                <div class="bn-post-content media-body">
                                                    <div class="bn-grid-category">
                                                        <a class="bn-post-cat" href="#">Sports</a>
                                                    </div>
                                                    <h2 class="bn-post-title">
                                                        <a href="#">It wasn???t raining when Noah built the ark</a>
                                                    </h2>
                                                    <div class="bn-post-meta bn-mb-7">
                                                        <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                    </div>
                                                </div>
                                                <!-- Post Content End -->
                                            </div>
                                            <!-- Post Block Style End -->
                                        </li>
                                        <!-- LI 4 End -->
                                    </ul>
                                    <!-- List Post End -->
                                </div>
                                <!-- List Post Block End -->
                            </div>
                            <!-- Col End -->
                        </div>
                        <!-- Row End -->
                    </div>
                    <!-- Block Style 1 End -->
                    <!-- Start Block Style 2 -->
                    <div class="bn-block-style-2">
                        <div class="row">
                            <div class="col-md-6">
                                <h2 class="bn-block-title">MOST READ</h2>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="bn-post-block-style clearfix">
                                            <div class="bn-post-thumb">
                                                <a href="#">
                                                    <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                </a>
                                                <div class="bn-category">
                                                    <a class="bn-post-category" href="#">Tech</a>
                                                </div>
                                            </div>
                                            <!-- Post Thumb End -->
                                            <div class="bn-post-content">
                                                <div class="bn-post-meta bn-mb-7 bn-mt-10">
                                                    <span class="bn-post-author"><a href="#"><i class="fa fa-user"></i> James Bond</a></span>
                                                    <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                </div>
                                                <h2 class="bn-post-title title-md"><a href="#">Do not give up. The beginning is always the hardest</a></h2>
                                            </div>
                                            <!-- Post Content End -->
                                        </div>
                                        <!-- Post Block Style End -->
                                    </div>
                                    <!-- Col End -->
                                </div>
                                <!-- Row End -->
                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <div class="bn-list-post-block">
                                            <ul class="bn-list-post">
                                                <li>
                                                    <div class="bn-post-block-style media">
                                                        <div class="bn-post-thumb">
                                                            <a href="#">
                                                                <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                            </a>
                                                        </div>
                                                        <!-- Post Thumb End -->
                                                        <div class="bn-post-content media-body">
                                                            <div class="bn-grid-category">
                                                                <a class="bn-post-cat" href="#">Sports</a>
                                                            </div>
                                                            <h2 class="bn-post-title">
                                                                <a href="#">The fear of God is the beginning of wisdom</a>
                                                            </h2>
                                                            <div class="bn-post-meta bn-mb-7">
                                                                <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                            </div>
                                                        </div>
                                                        <!-- Post Content End -->
                                                    </div>
                                                    <!-- Post Block Style End -->
                                                </li>
                                                <!-- LI 1 End -->
                                                <li>
                                                    <div class="bn-post-block-style media">
                                                        <div class="bn-post-thumb">
                                                            <a href="#">
                                                                <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                            </a>
                                                        </div>
                                                        <!-- Post Thumb End -->
                                                        <div class="bn-post-content media-body">
                                                            <div class="bn-grid-category">
                                                                <a class="bn-post-cat" href="#">Sports</a>
                                                            </div>
                                                            <h2 class="bn-post-title">
                                                                <a href="#">It wasn???t raining when Noah built the ark</a>
                                                            </h2>
                                                            <div class="bn-post-meta bn-mb-7">
                                                                <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                            </div>
                                                        </div>
                                                        <!-- Post Content End -->
                                                    </div>
                                                    <!-- Post Block Style End -->
                                                </li>
                                                <!-- LI 2 End -->
                                            </ul>
                                            <!-- List Post End -->
                                        </div>
                                        <!-- List Post Block End -->
                                    </div>
                                    <!-- Col End -->
                                </div>
                                <!-- Row End -->
                            </div>
                            <!-- Col End -->
                            <div class="col-md-6">
                                <h2 class="bn-block-title">Hot Topics</h2>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="bn-post-block-style clearfix">
                                            <div class="bn-post-thumb">
                                                <a href="#">
                                                    <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                </a>
                                                <div class="bn-category">
                                                    <a class="bn-post-category" href="#">Tech</a>
                                                </div>
                                            </div>
                                            <!-- Post Thumb End -->
                                            <div class="bn-post-content">
                                                <div class="bn-post-meta bn-mb-7 bn-mt-10">
                                                    <span class="bn-post-author"><a href="#"><i class="fa fa-user"></i> James Bond</a></span>
                                                    <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                </div>
                                                <h2 class="bn-post-title title-md"><a href="#">It wasn???t raining when Noah built the ark</a></h2>
                                            </div>
                                            <!-- Post Content End -->
                                        </div>
                                        <!-- Post Block Style End -->
                                    </div>
                                    <!-- Col End -->
                                </div>
                                <!-- Row End -->
                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <div class="bn-list-post-block">
                                            <ul class="bn-list-post">
                                                <li>
                                                    <div class="bn-post-block-style media">
                                                        <div class="bn-post-thumb">
                                                            <a href="#">
                                                                <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                            </a>
                                                        </div>
                                                        <!-- Post Thumb End -->
                                                        <div class="bn-post-content media-body">
                                                            <div class="bn-grid-category">
                                                                <a class="bn-post-cat" href="#">Sports</a>
                                                            </div>
                                                            <h2 class="bn-post-title">
                                                                <a href="#">It wasn???t raining when Noah built the ark</a>
                                                            </h2>
                                                            <div class="bn-post-meta bn-mb-7">
                                                                <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                            </div>
                                                        </div>
                                                        <!-- Post Content End -->
                                                    </div>
                                                    <!-- Post Block Style End -->
                                                </li>
                                                <!-- LI 1 End -->
                                                <li>
                                                    <div class="bn-post-block-style media">
                                                        <div class="bn-post-thumb">
                                                            <a href="#">
                                                                <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                            </a>
                                                        </div>
                                                        <!-- Post Thumb End -->
                                                        <div class="bn-post-content media-body">
                                                            <div class="bn-grid-category">
                                                                <a class="bn-post-cat" href="#">Sports</a>
                                                            </div>
                                                            <h2 class="bn-post-title">
                                                                <a href="#">Don???t talk unless you can improve the silence</a>
                                                            </h2>
                                                            <div class="bn-post-meta bn-mb-7">
                                                                <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                            </div>
                                                        </div>
                                                        <!-- Post Content End -->
                                                    </div>
                                                    <!-- Post Block Style End -->
                                                </li>
                                                <!-- LI 2 End -->
                                            </ul>
                                            <!-- List Post End -->
                                        </div>
                                        <!-- List Post Block End -->
                                    </div>
                                    <!-- Col End -->
                                </div>
                                <!-- Row End -->
                            </div>
                            <!-- Col End -->
                        </div>
                        <!-- Row End -->
                    </div>
                    <!-- Block Style End -->
                    <!-- Start Block Style 3 -->
                    <div class="bn-block-style-3">
                        <div class="col-lg-12 col-md-12">
                            <div class="row">
                                <h2 class="bn-block-title">RECENT NEWS</h2>
                                <div class="bn-post-block-style">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <div class="bn-post-thumb">
                                                <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                <div class="bn-category">
                                                    <a class="bn-post-category" href="#">Tech</a>
                                                </div>
                                            </div>
                                            <!-- Post Thumb End -->
                                        </div>
                                        <!-- Col End -->
                                        <div class="col-md-6">
                                            <div class="bn-post-content">
                                                <h2 class="bn-post-title title-md">
                                                    <a href="#">Do not give up. The beginning is always the hardest</a>
                                                </h2>
                                                <div class="bn-post-meta bn-mb-7">
                                                    <span class="bn-post-author"><a href="#"><i class="fa fa-user"></i> James Bond</a></span>
                                                    <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                </div>
                                                <p>Different people have different definitions of friendship. For some, it is the trust in an individual that he won???t hurt you.</p>
                                            </div>
                                            <!-- Post Content End -->
                                        </div>
                                        <!-- Col End -->
                                    </div>
                                    <!-- Row End -->
                                </div>
                                <!-- Post Block Style End -->
                                <div class="bn-gap-30"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="bn-list-post-block">
                                            <ul class="bn-list-post">
                                                <li>
                                                    <div class="bn-post-block-style media">
                                                        <div class="bn-post-thumb">
                                                            <a href="#">
                                                                <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                            </a>
                                                        </div>
                                                        <!-- Post Thumb End -->
                                                        <div class="bn-post-content media-body">
                                                            <div class="bn-grid-category">
                                                                <a class="bn-post-cat" href="#">Tech</a>
                                                            </div>
                                                            <h2 class="bn-post-title">
                                                                <a href="#">Don???t talk unless you can improve the silence</a>
                                                            </h2>
                                                            <div class="bn-post-meta bn-mb-7">
                                                                <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                            </div>
                                                        </div>
                                                        <!-- Post Content End -->
                                                    </div>
                                                    <!-- Post Block Style End -->
                                                </li>
                                                <!-- LI 1 End -->
                                                <li>
                                                    <div class="bn-post-block-style media">
                                                        <div class="bn-post-thumb">
                                                            <a href="#">
                                                                <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                            </a>
                                                        </div>
                                                        <!-- Post Thumb End -->
                                                        <div class="bn-post-content media-body">
                                                            <div class="bn-grid-category">
                                                                <a class="bn-post-cat" href="#">Travel</a>
                                                            </div>
                                                            <h2 class="bn-post-title">
                                                                <a href="#">It wasn???t raining when Noah built the ark</a>
                                                            </h2>
                                                            <div class="bn-post-meta bn-mb-7">
                                                                <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                            </div>
                                                        </div>
                                                        <!-- Post Content End -->
                                                    </div>
                                                    <!-- Post Block Style End -->
                                                </li>
                                                <!-- LI 2 End -->

                                            </ul>
                                            <!-- List Post End -->
                                        </div>
                                        <!-- List Post Block End -->
                                    </div>
                                    <!-- Col End -->
                                    <div class="col-md-6">
                                        <div class="bn-list-post-block">
                                            <ul class="bn-list-post">
                                                <li>
                                                    <div class="bn-post-block-style media">
                                                        <div class="bn-post-thumb">
                                                            <a href="#">
                                                                <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                            </a>
                                                        </div>
                                                        <!-- Post Thumb End -->
                                                        <div class="bn-post-content media-body">
                                                            <div class="bn-grid-category">
                                                                <a class="bn-post-cat" href="#">Tech</a>
                                                            </div>
                                                            <h2 class="bn-post-title">
                                                                <a href="#">You will succeed because most people are lazy</a>
                                                            </h2>
                                                            <div class="bn-post-meta bn-mb-7">
                                                                <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                            </div>
                                                        </div>
                                                        <!-- Post Content End -->
                                                    </div>
                                                    <!-- Post Block Style End -->
                                                </li>
                                                <!-- LI 1 End -->
                                                <li>
                                                    <div class="bn-post-block-style media">
                                                        <div class="bn-post-thumb">
                                                            <a href="#">
                                                                <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                            </a>
                                                        </div>
                                                        <!-- Post Thumb End -->
                                                        <div class="bn-post-content media-body">
                                                            <div class="bn-grid-category">
                                                                <a class="bn-post-cat" href="#">Travel</a>
                                                            </div>
                                                            <h2 class="bn-post-title">
                                                                <a href="#">Content lodges oftener in cottages than palaces</a>
                                                            </h2>
                                                            <div class="bn-post-meta bn-mb-7">
                                                                <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                            </div>
                                                        </div>
                                                        <!-- Post Content End -->
                                                    </div>
                                                    <!-- Post Block Style End -->
                                                </li>
                                                <!-- LI 2 End -->
                                            </ul>
                                            <!-- List Post End -->
                                        </div>
                                        <!-- List Post Block End -->
                                    </div>
                                    <!-- Col End -->
                                </div>
                                <!-- Row End -->
                            </div>
                            <!-- Content Col End -->
                        </div>
                        <!-- Col End -->
                    </div>
                    <!-- Block Style 3 End -->
                </div>
                <!-- Col End -->
                <div class="col-lg-4 col-md-12">
                    <!-- Start Sidebar -->
                    <div class="bn-sidebar">
                        <div class="bn-sidebar-widget">
                            <div class="bn-widget-header">
                                <h2 class="bn-widget-title">Follow Us</h2>
                            </div>
                            <div class="bn-widget-content">
                                <div class="bn-block-wrap bn-block-social-counter bn-social-style bn-social-boxed bn-pb-border-top">
                                    <div class="bn-social-list">
                                        <div class="bn-social-type bn-pb-margin-side bn-social-facebook">
                                            <div class="bn-social-box">
                                                <div class="bn-sp bn-sp-facebook">
                                                    <i class="fab fa-facebook-f"></i>
                                                </div>
                                                <span class="bn-social-info">283</span>
                                                <span class="bn-social-info bn-social-info-name">Fans</span>
                                                <span class="bn-social-button">
                                                    <a href="#" target="_blank">Like</a>
                                                </span>
                                            </div>
                                            <!-- Social Box End -->
                                        </div>
                                        <!-- Social Type End -->
                                        <div class="bn-social-type bn-pb-margin-side bn-social-linkedin">
                                            <div class="bn-social-box">
                                                <div class="bn-sp bn-sp-linkedin">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </div>
                                                <span class="bn-social-info">26</span>
                                                <span class="bn-social-info bn-social-info-name">Followers</span>
                                                <span class="bn-social-button">
                                                    <a href="#" target="_blank">Follow</a>
                                                </span>
                                            </div>
                                            <!-- Social Box End -->
                                        </div>
                                        <!-- Social Type End -->
                                        <div class="bn-social-type bn-pb-margin-side bn-social-instagram">
                                            <div class="bn-social-box">
                                                <div class="bn-sp bn-sp-instagram">
                                                    <i class="fab fa-instagram"></i>
                                                </div>
                                                <span class="bn-social-info">144</span>
                                                <span class="bn-social-info bn-social-info-name">Followers</span>
                                                <span class="bn-social-button">
                                                    <a href="#" target="_blank">Follow</a>
                                                </span>
                                            </div>
                                            <!-- Social Box End -->
                                        </div>
                                        <!-- Social Type End -->
                                        <div class="bn-social-type bn-pb-margin-side bn-social-rss">
                                            <div class="bn-social-box">
                                                <div class="bn-sp bn-sp-twitter">
                                                    <i class="fas fa-rss"></i>
                                                </div>
                                                <span class="bn-social-info">240</span>
                                                <span class="bn-social-info bn-social-info-name">Followers</span>
                                                <span class="bn-social-button">
                                                    <a href="#" target="_blank">Follow</a>
                                                </span>
                                            </div>
                                            <!-- Social Box End -->
                                        </div>
                                        <!-- Social Type End -->
                                        <div class="bn-social-type bn-pb-margin-side bn-social-twitter">
                                            <div class="bn-social-box">
                                                <div class="bn-sp bn-sp-twitter">
                                                    <i class="fab fa-twitter"></i>
                                                </div>
                                                <span class="bn-social-info">176</span>
                                                <span class="bn-social-info bn-social-info-name">Followers</span>
                                                <span class="bn-social-button">
                                                    <a href="#" target="_blank">Follow</a>
                                                </span>
                                            </div>
                                            <!-- Social Box End -->
                                        </div>
                                        <!-- Social Type End -->
                                        <div class="bn-social-type bn-pb-margin-side bn-social-youtube">
                                            <div class="bn-social-box">
                                                <div class="bn-sp bn-sp-youtube">
                                                    <i class="fab fa-youtube"></i>
                                                </div>
                                                <span class="bn-social-info">16</span>
                                                <span class="bn-social-info bn-social-info-name">Subscribe</span>
                                                <span class="bn-social-button">
                                                    <a href="#" target="_blank">Follow</a>
                                                </span>
                                            </div>
                                            <!-- Social Box End -->
                                        </div>
                                        <!-- Social Type End -->
                                    </div>
                                    <!-- Social List End -->
                                </div>
                                <!-- Social Content End -->
                            </div>
                            <!-- Widget Content End -->
                        </div>
                        <!-- Widget End -->
                        <div class="bn-sidebar-widget">
                            <div class="bn-widget-header">
                                <h2 class="bn-widget-title">Weather</h2>
                            </div>
                            <div class="bn-widget-content">
                                <div class="row d-flex justify-content-center">
                                    <div class="bn-weather text-center">
                                        <h4 class="city">Amman</h4>
                                        <h5 class="country">Jordan</h5>
                                        <h2 class="large-font">24<sup>???</sup></h2>
                                        <div class="big-symbol">
                                            <img src="assets/images/weather/day.svg" alt="">
                                        </div>
                                        <!-- Country and City End -->
                                        <div class="row d-flex">
                                            <div class="day d-flex flex-column">
                                                <h2 class="day-name">MON</h2>
                                                <div class="symbol-img text-center">
                                                    <img src="assets/images/weather/night.svg" alt="">
                                                </div>
                                                <h6 class="small-font">30<sup>???</sup></h6>
                                            </div>
                                            <!-- Day End -->
                                            <div class="day d-flex flex-column">
                                                <h2 class="day-name">TUE</h2>
                                                <div class="symbol-img text-center">
                                                    <img src="assets/images/weather/cloudy-day-1.svg" alt="">
                                                </div>
                                                <h6 class="small-font">29<sup>???</sup></h6>
                                            </div>
                                            <!-- Day End -->
                                            <div class="day d-flex flex-column">
                                                <h2 class="day-name">WED</h2>
                                                <div class="symbol-img text-center">
                                                    <img src="assets/images/weather/cloudy-day-1.svg" alt="">
                                                </div>
                                                <h6 class="small-font">34<sup>???</sup></h6>
                                            </div>
                                            <!-- Day End -->
                                            <div class="day d-flex flex-column">
                                                <h2 class="day-name">THU</h2>
                                                <div class="symbol-img text-center">
                                                    <img src="assets/images/weather/cloudy-day-1.svg" alt="">
                                                </div>
                                                <h6 class="small-font">30<sup>???</sup></h6>
                                            </div>
                                            <!-- Day End -->
                                            <div class="day d-flex flex-column">
                                                <h2 class="day-name">FRI</h2>
                                                <div class="symbol-img text-center">
                                                    <img src="assets/images/weather/cloudy-day-1.svg" alt="">
                                                </div>
                                                <h6 class="small-font">30<sup>???</sup></h6>
                                            </div>
                                            <!-- Day End -->
                                        </div>
                                        <!-- Row End -->
                                    </div>
                                    <!-- Weather End -->
                                </div>
                                <!-- Row End -->
                            </div>
                            <!-- Widget Content End -->
                        </div>
                        <!-- Widget End -->
                        <div class="sidebar-widget">
                            <div class="widget-header">
                            </div>
                            <div class="widget-content">
                                <ul class="nav nav-tabs" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="pills-latest-tab" data-toggle="pill" href="#pills-latest" role="tab" aria-controls="pills-latest" aria-selected="true">Latest</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="pills-popular-tab" data-toggle="pill" href="#pills-popular" role="tab" aria-controls="pills-popular" aria-selected="false">Popular</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="pills-comments-tab" data-toggle="pill" href="#pills-comments" role="tab" aria-controls="pills-comments" aria-selected="false">Comments</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane animated fadeInRight active" id="pills-latest" role="tabpanel" aria-labelledby="pills-latest-tab">
                                        <div class="bn-list-post-block">
                                            <ul class="bn-list-post">
                                                <li>
                                                    <div class="bn-post-block-style media">
                                                        <div class="bn-post-thumb">
                                                            <a href="#">
                                                                <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                            </a>
                                                        </div>
                                                        <!-- Post Thumb End -->
                                                        <div class="bn-post-content media-body">
                                                            <div class="bn-grid-category">
                                                                <a class="bn-post-cat" href="#">Sports</a>
                                                            </div>
                                                            <h2 class="bn-post-title">
                                                                <a href="#">The worth of a man lies in what he does well</a>
                                                            </h2>
                                                            <div class="bn-post-meta bn-mb-7">
                                                                <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                            </div>
                                                        </div>
                                                        <!-- Post Content End -->
                                                    </div>
                                                    <!-- Post Block Style End -->
                                                </li>
                                                <!-- LI 1 End -->
                                                <li>
                                                    <div class="bn-post-block-style media">
                                                        <div class="bn-post-thumb">
                                                            <a href="#">
                                                                <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                            </a>
                                                        </div>
                                                        <!-- Post Thumb End -->
                                                        <div class="bn-post-content media-body">
                                                            <div class="bn-grid-category">
                                                                <a class="bn-post-cat" href="#">Sports</a>
                                                            </div>
                                                            <h2 class="bn-post-title">
                                                                <a href="#">A man is known by the company he keeps</a>
                                                            </h2>
                                                            <div class="bn-post-meta bn-mb-7">
                                                                <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                            </div>
                                                        </div>
                                                        <!-- Post Content End -->
                                                    </div>
                                                    <!-- Post Block Style End -->
                                                </li>
                                                <!-- LI 2 End -->
                                                <li>
                                                    <div class="bn-post-block-style media">
                                                        <div class="bn-post-thumb">
                                                            <a href="#">
                                                                <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                            </a>
                                                        </div>
                                                        <!-- Post Thumb End -->
                                                        <div class="bn-post-content media-body">
                                                            <div class="bn-grid-category">
                                                                <a class="bn-post-cat" href="#">Sports</a>
                                                            </div>
                                                            <h2 class="bn-post-title">
                                                                <a href="#">Better have a wise enemy than a foolish friend</a>
                                                            </h2>
                                                            <div class="bn-post-meta bn-mb-7">
                                                                <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                            </div>
                                                        </div>
                                                        <!-- Post Content End -->
                                                    </div>
                                                    <!-- Post Block Style End -->
                                                </li>
                                                <!-- LI 3 End -->
                                                <li>
                                                    <div class="bn-post-block-style media">
                                                        <div class="bn-post-thumb">
                                                            <a href="#">
                                                                <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                            </a>
                                                        </div>
                                                        <!-- Post Thumb End -->
                                                        <div class="bn-post-content media-body">
                                                            <div class="bn-grid-category">
                                                                <a class="bn-post-cat" href="#">Sports</a>
                                                            </div>
                                                            <h2 class="bn-post-title">
                                                                <a href="#">The fear of God is the beginning of wisdom</a>
                                                            </h2>
                                                            <div class="bn-post-meta bn-mb-7">
                                                                <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                            </div>
                                                        </div>
                                                        <!-- Post Content End -->
                                                    </div>
                                                    <!-- Post Block Style End -->
                                                </li>
                                                <!-- LI 4 End -->
                                            </ul>
                                            <!-- List Post End -->
                                        </div>
                                        <!-- List Post Block End -->
                                    </div>
                                    <!-- Tab Pane 1 End -->
                                    <div class="tab-pane animated fadeInRight" id="pills-popular" role="tabpanel" aria-labelledby="pills-popular-tab">
                                        <div class="bn-list-post-block">
                                            <ul class="bn-list-post">
                                                <li>
                                                    <div class="bn-post-block-style media">
                                                        <div class="bn-post-thumb">
                                                            <a href="#">
                                                                <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                            </a>
                                                        </div>
                                                        <!-- Post Thumb End -->
                                                        <div class="bn-post-content media-body">
                                                            <div class="bn-grid-category">
                                                                <a class="bn-post-cat" href="#">Sports</a>
                                                            </div>
                                                            <h2 class="bn-post-title">
                                                                <a href="#">It wasn???t raining when Noah built the ark</a>
                                                            </h2>
                                                            <div class="bn-post-meta bn-mb-7">
                                                                <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                            </div>
                                                        </div>
                                                        <!-- Post Content End -->
                                                    </div>
                                                    <!-- Post Block Style End -->
                                                </li>
                                                <!-- LI 1 End -->
                                                <li>
                                                    <div class="bn-post-block-style media">
                                                        <div class="bn-post-thumb">
                                                            <a href="#">
                                                                <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                            </a>
                                                        </div>
                                                        <!-- Post Thumb End -->
                                                        <div class="bn-post-content media-body">
                                                            <div class="bn-grid-category">
                                                                <a class="bn-post-cat" href="#">Sports</a>
                                                            </div>
                                                            <h2 class="bn-post-title">
                                                                <a href="#">It wasn???t raining when Noah built the ark</a>
                                                            </h2>
                                                            <div class="bn-post-meta bn-mb-7">
                                                                <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                            </div>
                                                        </div>
                                                        <!-- Post Content End -->
                                                    </div>
                                                    <!-- Post Block Style End -->
                                                </li>
                                                <!-- LI 2 End -->
                                                <li>
                                                    <div class="bn-post-block-style media">
                                                        <div class="bn-post-thumb">
                                                            <a href="#">
                                                                <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                            </a>
                                                        </div>
                                                        <!-- Post Thumb End -->
                                                        <div class="bn-post-content media-body">
                                                            <div class="bn-grid-category">
                                                                <a class="bn-post-cat" href="#">Sports</a>
                                                            </div>
                                                            <h2 class="bn-post-title">
                                                                <a href="#">You will succeed because most people are lazy</a>
                                                            </h2>
                                                            <div class="bn-post-meta bn-mb-7">
                                                                <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                            </div>
                                                        </div>
                                                        <!-- Post Content End -->
                                                    </div>
                                                    <!-- Post Block Style End -->
                                                </li>
                                                <!-- LI 3 End -->
                                                <li>
                                                    <div class="bn-post-block-style media">
                                                        <div class="bn-post-thumb">
                                                            <a href="#">
                                                                <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                            </a>
                                                        </div>
                                                        <!-- Post Thumb End -->
                                                        <div class="bn-post-content media-body">
                                                            <div class="bn-grid-category">
                                                                <a class="bn-post-cat" href="#">Sports</a>
                                                            </div>
                                                            <h2 class="bn-post-title">
                                                                <a href="#">Don???t talk unless you can improve the silence</a>
                                                            </h2>
                                                            <div class="bn-post-meta bn-mb-7">
                                                                <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                            </div>
                                                        </div>
                                                        <!-- Post Content End -->
                                                    </div>
                                                    <!-- Post Block Style End -->
                                                </li>
                                                <!-- LI 4 End -->
                                            </ul>
                                            <!-- List Post End -->
                                        </div>
                                        <!-- List Post Block End -->
                                    </div>
                                    <!-- Tab pane 2 End -->
                                    <div class="tab-pane animated fadeInRight" id="pills-comments" role="tabpanel" aria-labelledby="pills-comments-tab">
                                        <div class="bn-list-post-block">
                                            <ul class="bn-list-post">
                                                <li>
                                                    <div class="bn-post-block-style media">
                                                        <div class="bn-post-thumb">
                                                            <a href="#">
                                                                <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                            </a>
                                                        </div>
                                                        <!-- Post Thumb End -->
                                                        <div class="bn-post-content media-body">
                                                            <div class="bn-grid-category">
                                                                <a class="bn-post-cat" href="#">Sports</a>
                                                            </div>
                                                            <h2 class="bn-post-title">
                                                                <a href="#">Content lodges oftener in cottages than palaces</a>
                                                            </h2>
                                                            <div class="bn-post-meta bn-mb-7">
                                                                <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                            </div>
                                                        </div>
                                                        <!-- Post Content End -->
                                                    </div>
                                                    <!-- Post Block Style End -->
                                                </li>
                                                <!-- LI 1 End -->
                                                <li>
                                                    <div class="bn-post-block-style media">
                                                        <div class="bn-post-thumb">
                                                            <a href="#">
                                                                <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                            </a>
                                                        </div>
                                                        <!-- Post Thumb End -->
                                                        <div class="bn-post-content media-body">
                                                            <div class="bn-grid-category">
                                                                <a class="bn-post-cat" href="#">Sports</a>
                                                            </div>
                                                            <h2 class="bn-post-title">
                                                                <a href="#">The worth of a man lies in what he does well</a>
                                                            </h2>
                                                            <div class="bn-post-meta bn-mb-7">
                                                                <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                            </div>
                                                        </div>
                                                        <!-- Post Content End -->
                                                    </div>
                                                    <!-- Post Block Style End -->
                                                </li>
                                                <!-- LI 2 End -->
                                                <li>
                                                    <div class="bn-post-block-style media">
                                                        <div class="bn-post-thumb">
                                                            <a href="#">
                                                                <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                            </a>
                                                        </div>
                                                        <!-- Post Thumb End -->
                                                        <div class="bn-post-content media-body">
                                                            <div class="bn-grid-category">
                                                                <a class="bn-post-cat" href="#">Sports</a>
                                                            </div>
                                                            <h2 class="bn-post-title">
                                                                <a href="#">A man is known by the company he keeps</a>
                                                            </h2>
                                                            <div class="bn-post-meta bn-mb-7">
                                                                <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                            </div>
                                                        </div>
                                                        <!-- Post Content End -->
                                                    </div>
                                                    <!-- Post Block Style End -->
                                                </li>
                                                <!-- LI 3 End -->
                                                <li>
                                                    <div class="bn-post-block-style media">
                                                        <div class="bn-post-thumb">
                                                            <a href="#">
                                                                <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                            </a>
                                                        </div>
                                                        <!-- Post Thumb End -->
                                                        <div class="bn-post-content media-body">
                                                            <div class="bn-grid-category">
                                                                <a class="bn-post-cat" href="#">Sports</a>
                                                            </div>
                                                            <h2 class="bn-post-title">
                                                                <a href="#">Better have a wise enemy than a foolish friend</a>
                                                            </h2>
                                                            <div class="bn-post-meta bn-mb-7">
                                                                <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                            </div>
                                                        </div>
                                                        <!-- Post Content End -->
                                                    </div>
                                                    <!-- Post Block Style End -->
                                                </li>
                                                <!-- LI 4 End -->
                                            </ul>
                                            <!-- List Post End -->
                                        </div>
                                        <!-- List Post Block End -->
                                    </div>
                                    <!-- Tab Pane 3 End -->
                                </div>
                                <!-- Tab Content End -->
                            </div>
                            <!-- Widget Content End -->
                        </div>
                        <!-- Widget End -->

                    </div>
                    <!-- Sidebar End -->
                </div>
                <!-- Col End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </section>
    <!-- Block Wrap End -->
    <!-- Start Trending Slider -->
    <section class="trending-slider full-width no-padding">
        <div id="trending-slider" class="owl-carousel owl-theme">
            <div class="bn-item bn-post-overaly-style post-lg" style="background-image:url(assets/images/800x971.png)">
                <a href="#" class="bn-image-link">&nbsp;</a>
                <div class="bn-category">
                    <a class="bn-post-category" href="#">Tech</a>
                </div>
                <div class="bn-overlay-post-content">
                    <div class="bn-post-content">
                        <h2 class="bn-post-title title-md">
                            <a href="#">It wasn???t raining when Noah built the ark</a>
                        </h2>
                        <div class="bn-post-meta bn-mb-7">
                            <ul>
                                <li><a href="#"><i class="fa fa-user"></i> James Bond</a></li>
                                <li class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Post Content End -->
                </div>
                <!-- Overlay Post Content -->
            </div>
            <!-- Item 1 End -->
            <div class="bn-item bn-post-overaly-style post-lg" style="background-image:url(assets/images/800x971.png)">
                <a href="#" class="bn-image-link">&nbsp;</a>
                <div class="bn-category">
                    <a class="bn-post-category" href="#">Tech</a>
                </div>
                <div class="bn-overlay-post-content">
                    <div class="bn-post-content">
                        <h2 class="bn-post-title title-md">
                            <a href="#">Do not give up. The beginning is always the hardest</a>
                        </h2>
                        <div class="bn-post-meta bn-mb-7">
                            <ul>
                                <li><a href="#"><i class="fa fa-user"></i> James Bond</a></li>
                                <li class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Post Content End -->
                </div>
                <!-- Overlay Post Content -->
            </div>
            <!-- Item 2 End -->
            <div class="bn-item bn-post-overaly-style post-lg" style="background-image:url(assets/images/800x971.png)">
                <a href="#" class="bn-image-link">&nbsp;</a>
                <div class="bn-category">
                    <a class="bn-post-category" href="#">Tech</a>
                </div>
                <div class="bn-overlay-post-content">
                    <div class="bn-post-content">
                        <h2 class="bn-post-title title-md">
                            <a href="#">Nothing is impossible when God is by your side.</a>
                        </h2>
                        <div class="bn-post-meta bn-mb-7">
                            <ul>
                                <li><a href="#"><i class="fa fa-user"></i> James Bond</a></li>
                                <li class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Post Content End -->
                </div>
                <!-- Overlay Post Content -->
            </div>
            <!-- Item 3 End -->
            <div class="bn-item bn-post-overaly-style post-lg" style="background-image:url(assets/images/800x971.png)">
                <a href="#" class="bn-image-link">&nbsp;</a>
                <div class="bn-category">
                    <a class="bn-post-category" href="#">Tech</a>
                </div>
                <div class="bn-overlay-post-content">
                    <div class="bn-post-content">
                        <h2 class="bn-post-title title-md">
                            <a href="#">If patience is bitter, the consequences are sweet</a>
                        </h2>
                        <div class="bn-post-meta bn-mb-7">
                            <ul>
                                <li><a href="#"><i class="fa fa-user"></i> James Bond</a></li>
                                <li class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Post Content End -->
                </div>
                <!-- Overlay Post Content -->
            </div>
            <!-- Item 4 End -->
            <div class="bn-item bn-post-overaly-style post-lg" style="background-image:url(assets/images/800x971.png)">
                <a href="#" class="bn-image-link">&nbsp;</a>
                <div class="bn-category">
                    <a class="bn-post-category" href="#">Tech</a>
                </div>
                <div class="bn-overlay-post-content">
                    <div class="bn-post-content">
                        <h2 class="bn-post-title title-md">
                            <a href="#">It wasn???t raining when Noah built the ark</a>
                        </h2>
                        <div class="bn-post-meta bn-mb-7">
                            <ul>
                                <li><a href="#"><i class="fa fa-user"></i> James Bond</a></li>
                                <li class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Post Content End -->
                </div>
                <!-- Overlay Post Content -->
            </div>
            <!-- Item 5 End -->
            <div class="bn-item bn-post-overaly-style post-lg" style="background-image:url(assets/images/800x971.png)">
                <a href="#" class="bn-image-link">&nbsp;</a>
                <div class="bn-category">
                    <a class="bn-post-category" href="#">Tech</a>
                </div>
                <div class="bn-overlay-post-content">
                    <div class="bn-post-content">
                        <h2 class="bn-post-title title-md">
                            <a href="#">Do not give up. The beginning is always the hardest</a>
                        </h2>
                        <div class="bn-post-meta bn-mb-7">
                            <ul>
                                <li><a href="#"><i class="fa fa-user"></i> James Bond</a></li>
                                <li class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Post Content End -->
                </div>
                <!-- Overlay Post Content -->
            </div>
            <!-- Item 6 End -->
            <div class="bn-item bn-post-overaly-style post-lg" style="background-image:url(assets/images/800x971.png)">
                <a href="#" class="bn-image-link">&nbsp;</a>
                <div class="bn-category">
                    <a class="bn-post-category" href="#">Tech</a>
                </div>
                <div class="bn-overlay-post-content">
                    <div class="bn-post-content">
                        <h2 class="bn-post-title title-md">
                            <a href="#">Nothing is impossible when God is by your side</a>
                        </h2>
                        <div class="bn-post-meta bn-mb-7">
                            <ul>
                                <li><a href="#"><i class="fa fa-user"></i> James Bond</a></li>
                                <li class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Post Content End -->
                </div>
                <!-- Overlay Post Content -->
            </div>
            <!-- Item 7 End -->
            <div class="bn-item bn-post-overaly-style post-lg" style="background-image:url(assets/images/800x971.png)">
                <a href="#" class="bn-image-link">&nbsp;</a>
                <div class="bn-category">
                    <a class="bn-post-category" href="#">Tech</a>
                </div>
                <div class="bn-overlay-post-content">
                    <div class="bn-post-content">
                        <h2 class="bn-post-title title-md">
                            <a href="#">If patience is bitter, the consequences are sweet</a>
                        </h2>
                        <div class="bn-post-meta bn-mb-7">
                            <ul>
                                <li><a href="#"><i class="fa fa-user"></i> James Bond</a></li>
                                <li class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Post Content End -->
                </div>
                <!-- Overlay Post Content -->
            </div>
            <!-- Item 8 End -->
        </div>
        <!-- Owl Slider End -->
    </section>
    <!-- Trending Slider End -->
    <!-- Start Block Wrap -->
    <section class="bn-block-wrap">
        <div class="container">
            <div class="row bn-gutter-30">
                <div class="col-lg-8 col-md-12">
                    <!-- Start Block Style 4 -->
                    <div class="bn-block-style-4">
                        <h2 class="bn-block-title">DON???T MISS</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="bn-post-block-style clearfix">
                                    <div class="bn-post-thumb">
                                        <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                        <div class="bn-category">
                                            <a class="bn-post-category" href="#">Tech</a>
                                        </div>
                                    </div>
                                    <!-- Post Thumb End -->
                                    <div class="bn-post-content">
                                        <h2 class="bn-post-title title-md">
                                            <a href="#">Do not give up. The beginning is always the hardest</a>
                                        </h2>
                                        <p class="font-medium d-none d-lg-block">True friendship is perhaps the only relation that survives the trials and tribulations of time and remains unconditional.</p>
                                        <div class="bn-post-meta bn-mb-7">
                                            <span class="bn-post-author"><a href="#"><i class="fa fa-user"></i> James Bond</a></span>
                                            <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                        </div>
                                    </div>
                                    <!-- Post Content End -->
                                </div>
                                <!-- Post Block Style End -->
                            </div>
                            <!-- Col End -->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="bn-post-block-style">
                                            <div class="bn-post-thumb">
                                                <a href="#">
                                                    <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                </a>
                                            </div>
                                            <!-- Post Thumb End -->
                                            <div class="bn-post-content media-body">
                                                <h2 class="bn-post-title"><a href="#">The fear of God is the beginning of wisdom</a></h2>
                                                <div class="bn-post-meta bn-mb-7">
                                                    <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                </div>
                                            </div>
                                            <!-- Post Content End -->
                                        </div>
                                        <!-- Post Block Style End -->
                                    </div>
                                    <!-- Col End -->
                                    <div class="col-md-6">
                                        <div class="bn-post-block-style">
                                            <div class="bn-post-thumb">
                                                <a href="#">
                                                    <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                </a>
                                            </div>
                                            <!-- Post Thumb End -->
                                            <div class="bn-post-content media-body">
                                                <h2 class="bn-post-title"><a href="#">It wasn???t raining when Noah built the ark</a></h2>
                                                <div class="bn-post-meta bn-mb-7">
                                                    <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                </div>
                                            </div>
                                            <!-- Post Content End -->
                                        </div>
                                        <!-- Post Block Style End -->
                                    </div>
                                    <!-- Col End -->
                                    <div class="col-md-6">
                                        <div class="bn-post-block-style">
                                            <div class="bn-post-thumb">
                                                <a href="#">
                                                    <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                </a>
                                            </div>
                                            <!-- Post Thumb End -->
                                            <div class="bn-post-content media-body">
                                                <h2 class="bn-post-title"><a href="#">You will succeed because most people are lazy</a></h2>
                                                <div class="bn-post-meta bn-mb-7">
                                                    <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                </div>
                                            </div>
                                            <!-- Post Content End -->
                                        </div>
                                        <!-- Post Block Style End -->
                                    </div>
                                    <!-- Col End -->
                                    <div class="col-md-6">
                                        <div class="bn-post-block-style">
                                            <div class="bn-post-thumb">
                                                <a href="#">
                                                    <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                </a>
                                            </div>
                                            <!-- Post Thumb End -->
                                            <div class="bn-post-content media-body">
                                                <h2 class="bn-post-title"><a href="#">Don???t talk unless you can improve the silence</a></h2>
                                                <div class="bn-post-meta bn-mb-7">
                                                    <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                </div>
                                            </div>
                                            <!-- Post Content End -->
                                        </div>
                                        <!-- Post Block Style End -->
                                    </div>
                                    <!-- Col End -->
                                </div>
                                <!-- Row End -->
                            </div>
                            <!-- Col End -->
                        </div>
                        <!-- Row End -->
                    </div>
                    <!-- Block Style 4 End -->
                    <div class="bn-gap-30"></div>
                    <!-- Start Block Style 5 -->
                    <div class="bn-block-style-5">
                        <h2 class="bn-block-title">RECENT POSTS</h2>
                        <div class="row bn-gutter-30">
                            <div class="col-md-6">
                                <div class="bn-post-block-style">
                                    <div class="bn-post-thumb">
                                        <a href="#">
                                            <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                        </a>
                                        <div class="bn-category">
                                            <a class="bn-post-category" href="#">Tech</a>
                                        </div>
                                    </div>
                                    <!-- Post Thumb End -->
                                    <div class="bn-post-content">
                                        <h2 class="bn-post-title title-md">
                                            <a href="#">It wasn???t raining when Noah built the ark</a>
                                        </h2>
                                        <div class="bn-post-meta bn-mb-7">
                                            <span class="bn-post-author"><a href="#"><i class="fa fa-user"></i> James Bond</a></span>
                                            <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                        </div>
                                    </div>
                                    <!-- Post Content End -->
                                </div>
                                <!-- Post Block Style End -->
                            </div>
                            <!-- Col End -->
                            <div class="col-md-6">
                                <div class="bn-post-block-style">
                                    <div class="bn-post-thumb">
                                        <a href="#">
                                            <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                        </a>
                                        <div class="bn-category">
                                            <a class="bn-post-category" href="#">Tech</a>
                                        </div>
                                    </div>
                                    <!-- Post Thumb End -->
                                    <div class="bn-post-content">
                                        <h2 class="bn-post-title title-md">
                                            <a href="#">Do not give up. The beginning is always the hardest</a>
                                        </h2>
                                        <div class="bn-post-meta bn-mb-7">
                                            <span class="bn-post-author"><a href="#"><i class="fa fa-user"></i> James Bond</a></span>
                                            <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                        </div>
                                    </div>
                                    <!-- Post Content End -->
                                </div>
                                <!-- Post Block Style End -->
                            </div>
                            <!-- Col End -->
                            <div class="col-md-6">
                                <div class="bn-post-block-style">
                                    <div class="bn-post-thumb">
                                        <a href="#">
                                            <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                        </a>
                                        <div class="bn-category">
                                            <a class="bn-post-category" href="#">Tech</a>
                                        </div>
                                    </div>
                                    <!-- Post Thumb End -->
                                    <div class="bn-post-content">
                                        <h2 class="bn-post-title title-md">
                                            <a href="#">Nothing is impossible when God is by your side</a>
                                        </h2>
                                        <div class="bn-post-meta bn-mb-7">
                                            <span class="bn-post-author"><a href="#"><i class="fa fa-user"></i> James Bond</a></span>
                                            <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                        </div>
                                    </div>
                                    <!-- Post Content End -->
                                </div>
                                <!-- Post Block Style End -->
                            </div>
                            <!-- Col End -->
                            <div class="col-md-6">
                                <div class="bn-post-block-style">
                                    <div class="bn-post-thumb">
                                        <a href="#">
                                            <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                        </a>
                                        <div class="bn-category">
                                            <a class="bn-post-category" href="#">Tech</a>
                                        </div>
                                    </div>
                                    <!-- Post Thumb End -->
                                    <div class="bn-post-content">
                                        <h2 class="bn-post-title title-md">
                                            <a href="#">If patience is bitter, the consequences are sweet</a>
                                        </h2>
                                        <div class="bn-post-meta bn-mb-7">
                                            <span class="bn-post-author"><a href="#"><i class="fa fa-user"></i> James Bond</a></span>
                                            <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                        </div>
                                    </div>
                                    <!-- Post Content End -->
                                </div>
                                <!-- Post Block Style End -->
                            </div>
                            <!-- Col End -->
                        </div>
                        <!-- Row End -->
                        <div class="bn-gap-30"></div>
                        <div class="row">
                            <div class="col-12">
                                <div class="load-more-btn text-center">
                                    <button class="btn"> Load More </button>
                                </div>
                            </div>
                            <!-- Col End -->
                        </div>
                        <!-- Row End -->
                    </div>
                    <!-- Block Style 5 End -->
                </div>
                <!-- Col End -->
                <!-- Start Sidebar -->
                <div class="col-lg-4 col-md-12">
                    <div class="bn-sidebar">
                        <div class="bn-sidebar-widget">
                            <div class="bn-widget-header">
                                <h2 class="bn-widget-title">Latest News</h2>
                            </div>
                            <div class="widget-content">
                                <div class="bn-list-post-block">
                                    <ul class="bn-list-post">
                                        <li>
                                            <div class="bn-post-block-style media">
                                                <div class="bn-post-thumb">
                                                    <a href="#">
                                                        <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                    </a>
                                                </div>
                                                <!-- Post Thumb End -->
                                                <div class="bn-post-content media-body">
                                                    <div class="bn-grid-category">
                                                        <a class="bn-post-cat" href="#">Sports</a>
                                                    </div>
                                                    <h2 class="bn-post-title">
                                                        <a href="#">The worth of a man lies in what he does well</a>
                                                    </h2>
                                                    <div class="bn-post-meta bn-mb-7">
                                                        <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                    </div>
                                                </div>
                                                <!-- Post Content End -->
                                            </div>
                                            <!-- Post Block Style End -->
                                        </li>
                                        <!-- LI 1 End -->
                                        <li>
                                            <div class="bn-post-block-style media">
                                                <div class="bn-post-thumb">
                                                    <a href="#">
                                                        <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                    </a>
                                                </div>
                                                <!-- Post Thumb End -->
                                                <div class="bn-post-content media-body">
                                                    <div class="bn-grid-category">
                                                        <a class="bn-post-cat" href="#">Sports</a>
                                                    </div>
                                                    <h2 class="bn-post-title">
                                                        <a href="#">A man is known by the company he keeps</a>
                                                    </h2>
                                                    <div class="bn-post-meta bn-mb-7">
                                                        <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                    </div>
                                                </div>
                                                <!-- Post Content End -->
                                            </div>
                                            <!-- Post Block Style End -->
                                        </li>
                                        <!-- LI 2 End -->
                                        <li>
                                            <div class="bn-post-block-style media">
                                                <div class="bn-post-thumb">
                                                    <a href="#">
                                                        <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                    </a>
                                                </div>
                                                <!-- Post Thumb End -->
                                                <div class="bn-post-content media-body">
                                                    <div class="bn-grid-category">
                                                        <a class="bn-post-cat" href="#">Sports</a>
                                                    </div>
                                                    <h2 class="bn-post-title">
                                                        <a href="#">Better have a wise enemy than a foolish friend</a>
                                                    </h2>
                                                    <div class="bn-post-meta bn-mb-7">
                                                        <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                    </div>
                                                </div>
                                                <!-- Post Content End -->
                                            </div>
                                            <!-- Post Block Style End -->
                                        </li>
                                        <!-- LI 3 End -->
                                        <li>
                                            <div class="bn-post-block-style media">
                                                <div class="bn-post-thumb">
                                                    <a href="#">
                                                        <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                    </a>
                                                </div>
                                                <!-- Post Thumb End -->
                                                <div class="bn-post-content media-body">
                                                    <div class="bn-grid-category">
                                                        <a class="bn-post-cat" href="#">Sports</a>
                                                    </div>
                                                    <h2 class="bn-post-title">
                                                        <a href="#">The fear of God is the beginning of wisdom</a>
                                                    </h2>
                                                    <div class="bn-post-meta bn-mb-7">
                                                        <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                    </div>
                                                </div>
                                                <!-- Post Content End -->
                                            </div>
                                            <!-- Post Block Style End -->
                                        </li>
                                        <!-- LI 4 End -->
                                    </ul>
                                    <!-- List Post End -->
                                </div>
                                <!-- List Post Block End -->
                            </div>
                        </div>
                        <!-- Widget End -->
                        <div class="bn-sidebar-widget">
                            <div class="bn-widget-header">
                                <h2 class="bn-widget-title">AD</h2>
                            </div>
                            <div class="widget-content">
                                <div class="bn-ad-image">
                                    <a href="#">
                                        <img class="img-fluid" src="assets/images/350x272.png" alt="">
                                    </a>
                                </div>
                                <!-- Ad End -->
                            </div>
                            <!-- Widget Content End -->
                        </div>
                        <!-- Widget End -->
                    </div>
                    <!-- Sidebar End -->
                </div>
                <!-- Col End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </section>
    <!-- Block Wrap End -->
    <!-- Ad Banner start-->
    <div class="bn-block-wrap no-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="bn-banner-img">
                        <a href="#">
                            <img class="img-fluid" src="assets/images/920x149.png" alt="">
                        </a>
                    </div>
                    <!-- Ad End -->
                </div>
                <!-- Col End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Ad Banner End -->
    <div class="bn-gap-50"></div>
    <!-- Newsletter Section Start -->
    <div class="bn-newsletter-section">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-7 col-md-6">
                    <div class="bn-newsletter-content">
                        <h2 class="bn-newsletter-heading">NEWSLETTER SIGNUP</h2>
                        <p>By subscribing to our mailing list you will always be update with the latest news from us.</p>
                    </div>
                </div>
                <!-- Col End -->
                <div class="col-lg-5 col-md-6">
                    <div class="bn-footer-newsletter">
                        <form action="#" method="post">
                            <div class="bn-email-form-group">
                                <input type="email" name="EMAIL" class="bn-newsletter-email" placeholder="Your email" required="">
                                <input type="submit" class="bn-newsletter-submit" value="Subscribe">
                            </div>
                        </form>
                        <!-- Form End -->
                    </div>
                    <!-- Footer Newsletter End -->
                </div>
                <!-- Col End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Newsletter Section End -->
    <!-- Start Footer Section -->
    <div class="bn-footer">
        <div class="container">
            <div class="row justify-content-lg-between justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="bn-footer-widget">
                        <div class="bn-widget-header">
                            <h2 class="bn-widget-title">Follow us</h2>
                        </div>
                        <div class="bn-widget-content">
                            <div class="bn-footer-logo">
                                <img class="img-fluid text-center" src="assets/images/footer-logo.png" alt="">
                            </div>
                            <div class="bn-footer-about-text">
                                <p class="text-muted">Here , write the complete address of the Registered office address along with telephone number.</p>
                            </div>
                            <div class="bn-footer-social-icons">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="twitter"><i class="fab fa-2x fa-twitter"></i></a>
                                    </li>
                                    <!-- Social Icons Item 1 End -->
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="facebook"><i class="fab fa-2x fa-facebook-f"></i></a>
                                    </li>
                                    <!-- Social Icons Item 2 End -->
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="instagram"><i class="fab fa-2x fa-instagram"></i></a>
                                    </li>
                                    <!-- Social Icons Item 3 End -->
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="pinterest"><i class="fab fa-2x fa-youtube"></i></a>
                                    </li>
                                    <!-- Social Icons Item 4 End -->
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="vimeo"><i class="fab fa-2x fa-google"></i></a>
                                    </li>
                                    <!-- Social Icons Item 5 End -->
                                </ul>
                            </div>
                            <!-- Social Icons End -->
                        </div>
                        <!-- Footer Widget Content End -->
                    </div>
                    <!-- Footer Widget End -->
                </div>
                <!-- Col End -->
                <div class="col-lg-4 col-md-6">
                    <div class="bn-footer-widget">
                        <div class="bn-post-widget">
                            <div class="bn-widget-header">
                                <h2 class="bn-widget-title">Most Viewed Posts</h2>
                            </div>
                            <div class="bn-widget-content">
                                <div class="bn-list-post-block">
                                    <ul class="bn-list-post">
                                        <li>
                                            <div class="bn-post-block-style media">
                                                <div class="bn-post-thumb">
                                                    <a href="#">
                                                        <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                    </a>
                                                </div>
                                                <!-- Post Thumb End -->
                                                <div class="bn-post-content media-body">
                                                    <h4 class="bn-post-title">
                                                        <a href="#">The worth of a man lies in what he does well</a>
                                                    </h4>
                                                    <div class="bn-post-meta bn-mb-7">
                                                        <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                    </div>
                                                </div>
                                                <!-- Post Content End -->
                                            </div>
                                            <!-- Post Block Style End -->
                                        </li>
                                        <!-- LI 1 End -->
                                        <li>
                                            <div class="bn-post-block-style media">
                                                <div class="bn-post-thumb">
                                                    <a href="#">
                                                        <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                    </a>
                                                </div>
                                                <!-- Post Thumb End -->
                                                <div class="bn-post-content media-body">
                                                    <h4 class="bn-post-title">
                                                        <a href="#">A man is known by the company he keeps</a>
                                                    </h4>
                                                    <div class="bn-post-meta bn-mb-7">
                                                        <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                    </div>
                                                </div>
                                                <!-- Post Content End -->
                                            </div>
                                            <!-- Post Block Style End -->
                                        </li>
                                        <!-- LI 2 End -->
                                        <li>
                                            <div class="bn-post-block-style media">
                                                <div class="bn-post-thumb">
                                                    <a href="#">
                                                        <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                    </a>
                                                </div>
                                                <!-- Post Thumb End -->
                                                <div class="bn-post-content media-body">
                                                    <h4 class="bn-post-title">
                                                        <a href="#">It wasn???t raining when Noah built the ark</a>
                                                    </h4>
                                                    <div class="bn-post-meta bn-mb-7">
                                                        <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                    </div>
                                                </div>
                                                <!-- Post Content End -->
                                            </div>
                                            <!-- Post Block Style End -->
                                        </li>
                                        <!-- LI 3 End -->
                                    </ul>
                                    <!-- List Post End -->
                                </div>
                                <!-- List Post Block End -->
                            </div>
                            <!-- Widget Content End -->
                        </div>
                        <!-- Post Widget End -->
                    </div>
                    <!-- Footer Widget End -->
                </div>
                <!-- Col End -->
                <div class="col-lg-4 col-md-6">
                    <div class="bn-footer-widget">
                        <div class="bn-post-widget">
                            <div class="bn-widget-header">
                                <h2 class="bn-widget-title">Most Viewed Posts</h2>
                            </div>
                            <div class="bn-widget-content">
                                <div class="bn-list-post-block">
                                    <ul class="bn-list-post">
                                        <li>
                                            <div class="bn-post-block-style media">
                                                <div class="bn-post-thumb">
                                                    <a href="#">
                                                        <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                    </a>
                                                </div>
                                                <!-- Post Thumb End -->
                                                <div class="bn-post-content media-body">
                                                    <h4 class="bn-post-title">
                                                        <a href="#">The fear of God is the beginning of wisdom</a>
                                                    </h4>
                                                    <div class="bn-post-meta bn-mb-7">
                                                        <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                    </div>
                                                </div>
                                                <!-- Post Content End -->
                                            </div>
                                            <!-- Post Block Style End -->
                                        </li>
                                        <!-- LI 1 End -->
                                        <li>
                                            <div class="bn-post-block-style media">
                                                <div class="bn-post-thumb">
                                                    <a href="#">
                                                        <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                    </a>
                                                </div>
                                                <!-- Post Thumb End -->
                                                <div class="bn-post-content media-body">
                                                    <h4 class="bn-post-title">
                                                        <a href="#">You will succeed because most people are lazy</a>
                                                    </h4>
                                                    <div class="bn-post-meta bn-mb-7">
                                                        <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                    </div>
                                                </div>
                                                <!-- Post Content End -->
                                            </div>
                                            <!-- Post Block Style End -->
                                        </li>
                                        <!-- LI 2 End -->
                                        <li>
                                            <div class="bn-post-block-style media">
                                                <div class="bn-post-thumb">
                                                    <a href="#">
                                                        <img class="img-fluid" src="assets/images/800x520.png" alt="">
                                                    </a>
                                                </div>
                                                <!-- Post Thumb End -->
                                                <div class="bn-post-content media-body">
                                                    <h4 class="bn-post-title">
                                                        <a href="#">Do it with passion, or not at all</a>
                                                    </h4>
                                                    <div class="bn-post-meta bn-mb-7">
                                                        <span class="bn-post-date"><i class="far fa-clock"></i> 26 Jan, 2021</span>
                                                    </div>
                                                </div>
                                                <!-- Post Content End -->
                                            </div>
                                            <!-- Post Block Style End -->
                                        </li>
                                        <!-- LI 3 End -->
                                    </ul>
                                    <!-- List Post End -->
                                </div>
                                <!-- List Post Block End -->
                            </div>
                            <!-- Widget Content End -->
                        </div>
                        <!-- Post Widget End -->
                    </div>
                    <!-- Footer Widget End -->
                </div>
                <!-- Col End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Footer Section End -->
    <!-- Start Copyrights Section -->
    <div class="bn-copyright">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-6">
                    <p>?? Copyright 2021, All Rights Reserved</p>
                </div>
                <!-- Col End -->
                <div class="col-md-6">
                    <div class="bn-copyright-menu">
                        <ul>
                            <li><a href="#">Terms of Service</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Sitemap</a></li>
                        </ul>
                    </div>
                    <!-- Copyrights Menu End -->
                </div>
                <!-- Col End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Copyrights Section End -->
    <!-- To Top Button Start-->
    <div class="bn-back-to-top-btn">
        <div class="bn-back-to-top" style="display: block;">
            <a href="#" class="fas fa-angle-up" aria-hidden="true"></a>
        </div>
    </div>
    <!-- To Top Button End -->

    <!-- Javascript Files
    ================================================== -->

    <!-- Initialize jQuery Library -->
    <script src="assets/js/vendor/jquery.js"></script>
    <!-- Popper jQuery -->
    <script src="assets/js/vendor/popper.min.js"></script>
    <!-- Bootstrap jQuery -->
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <!-- jQuery Pop-up Search -->
    <script src="assets/js/vendor/jquery.magnific-popup.min.js"></script>
    <!-- Breaking News jQuery -->
    <script src="assets/js/vendor/inewsticker.js"></script>
    <!-- Owl Slider -->
    <script src="assets/js/vendor/owl.carousel.min.js"></script>
    <!-- Color box -->
    <script src="assets/js/vendor/jquery.colorbox.js"></script>
    <!-- Template Custom -->
    <script src="assets/js/main.js"></script>

</body>

</html>



            </div>
            <a href="blog.php" class="btn btn-primary col-12"><i class="fas fa-arrow-alt-circle-right"></i> See All</a>
        </div>
<?php
sidebar();
footer();
?>