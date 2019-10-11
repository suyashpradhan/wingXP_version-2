<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Admin Panel - CBSE 360</title>
    <!--style sheet-->
    <script language="javascript" src="../fancybox/ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" media="screen" href="main.css" />
    <script type="text/javascript" src="../fancybox/jquery.min.js"></script>
    <script type="text/javascript" src="../fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
    <script type="text/javascript" src="../fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="../fancybox/jquery.fancybox-1.3.4.css" />
    <script type="text/javascript" src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
    </script>
    <link rel="stylesheet" href="https://www.testune.com/spacedtimes/fancybox/jquery-ui.css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Google+Sans:400|Roboto:400,400italic,500,500italic,700,700italic|Roboto+Mono:400,500,700|Material+Icons">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Google+Sans:400|Roboto:400,400italic,500,500italic,700,700italic|Roboto+Mono:400,500,700|Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script>
        var $j = jQuery.noConflict(true);
    </script>
    <script>
        $j(function () {
            dateFormat: "yy-mm-dd"
            $j("#datepicker,#start,#end").datepicker({
                dateFormat: "yy-mm-dd"
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("a.pop2").fancybox({
                'overlayColor': '#000',
                'overlayOpacity': 0.9
            });
            $("a.pop").fancybox({
                'type': 'iframe',
                'autoScale': true,
                'autoDimensions': true,
                //'title'	  : 'By domain E',
                'fitToView': true,
                //  'width'	: 'auto',
                //'height'	: 'auto',
                //  'overlayShow'	: true,
                //'transitionIn'	: 'elastic',
                //'transitionOut'	: 'elastic'
            });
            $("a.view_faculty_detail").fancybox({
                'type': 'iframe',
                'width': 1200,
                'height': 800,
                'href': this.href,
                'showCloseButton': true,
                'hideOnOverlayClick': false,
                'hideOnContentClick': false,
            });
            $("a.view_comment").fancybox({
                'type': 'iframe',
                'width': 570,
                'height': 100,
                'href': this.href,
                'showCloseButton': true,
                'hideOnOverlayClick': false,
                'hideOnContentClick': false,
            });
            $("a.preview").fancybox({
                'type': 'iframe',
                'width': 700,
                'height': 700,
                'href': this.href,
                'showCloseButton': true,
                'hideOnOverlayClick': false,
                'hideOnContentClick': false,
            });
        });
    </script>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<!DOCTYPE html>
<html lang="en">

<body>

    <!-- <div class="navbar navbar-shadow" style="height: 100px;margin: 0">
        <div class="newnavigationBar">
             <img src="images/logo.png" alt="" style="margin:10px; height: 70px;"></a> 
            <div class="menu-wrapper">
                <a href="?q=logout" class="fancy-button bg-gradient2 logout-nav-link"><span>Logout</span></a>
            </div>
        </div>
    </div> -->

    <div class="navbar navbar-shadow" style="height:70px;margin: 0">
        <div class="newnavigationBar_2">
            <a href="index.php" style=" text-decoration:none;">
                <span
                    style="color: #17a2b8 !important; font-weight:1000; font-size: 32px;margin: 0;padding: 0 20px; text-decoration:none;">CBSE
                    360</span>
                <div class="menu-wrapper">
                    <a href="?q=logout" class="fancy-button bg-gradient2 logout-nav-link"><span>Logout</span></a>
                </div>
        </div>
    </div>

    <div class="page-color" style="background: #e2e1e0;">
        <div class="page-description">
            <div class="page-container">
                <h1 class="description_header">Store Manager Functions</h1>
                <hr>
            </div>
        </div>
        <div class="first-section">
            <div class="page-container">
                <h1 class="first__section-header">Club Section</h1>
                <div class="first-column-wrapper">
                    <div class="inner-first gap box">
                        <a href="add_club_category.php" class="inner-link">
                            <i class="fas fa-plus inner-icons"></i>
                            <h1 class="inner-header">Add Club Category</h1>
                        </a>
                    </div>
                    <div class="inner-second gap box">
                        <a href="update_club_category.php" class="inner-link">
                            <i class="fas fa-pencil-alt inner-icons"></i>
                            <h1 class="inner-header">View/Update Club Category</h1>
                        </a>
                    </div>
                    <div class="inner-third gap box">
                        <a href="add_clubs.php" class="inner-link">
                            <i class="fas fa-plus inner-icons"></i>
                            <h1 class="inner-header">Add Clubs</h1>
                        </a>
                    </div>
                    <div class="inner-fourth gap box">
                        <a href="update_clubs.php" class="inner-link">
                            <i class="fas fa-pencil-alt inner-icons"></i>
                            <h1 class="inner-header">View/Update Clubs </h1>
                        </a>
                    </div>
                    <div class="inner-third gap box">
                        <a href="add_topic.php" class="inner-link">
                            <i class="fas fa-plus inner-icons"></i>
                            <h1 class="inner-header">Add Topic</h1>
                        </a>
                    </div>
                    <div class="inner-fourth gap box">
                        <a href="view_topics.php" class="inner-link">
                            <i class="fas fa-pencil-alt inner-icons"></i>
                            <h1 class="inner-header">View/Update Topic </h1>
                        </a>
                    </div>
                    <div class="inner-fourth gap box">
                        <a href="assign_topic_club.php" class="inner-link">
                            <i class="fas fa-pencil-alt inner-icons"></i>
                            <h1 class="inner-header">Assign Default Club to Topic </h1>
                        </a>
                    </div>
                    <div class="inner-fourth gap box">
                        <a href="assign_channel_wing.php" class="inner-link">
                            <i class="fas fa-pencil-alt inner-icons"></i>
                            <h1 class="inner-header">Assign Channel to Wing</h1>
                        </a>
                    </div>
                </div>
                <h1 class="first__section-header">Activities / School Section</h1>
                <div class="first-column-wrapper">
                    <div class="inner-first gap box">
                        <a href="add_activities.php" class="inner-link">
                            <i class="fas fa-plus inner-icons"></i>
                            <h1 class="inner-header">Add Activities</h1>
                        </a>
                    </div>
                    <div class="inner-second gap box">
                        <a href="update_activities.php" class="inner-link">
                            <i class="fas fa-pencil-alt inner-icons"></i>
                            <h1 class="inner-header">View/Update Activities</h1>
                        </a>
                    </div>
                    <div class="inner-third gap box">
                        <a href="add_school.php" class="inner-link">
                            <i class="fas fa-plus inner-icons"></i>
                            <h1 class="inner-header">Add Schools</h1>
                        </a>
                    </div>
                    <div class="inner-fourth gap box">
                        <a href="view_institute_detail.php" class="inner-link">
                            <i class="fas fa-pencil-alt inner-icons"></i>
                            <h1 class="inner-header">View/Update School Details </h1>
                        </a>
                    </div>
                    <div class="inner-third gap box">
                        <a href="add_tag.php" class="inner-link">
                            <i class="fas fa-plus inner-icons"></i>
                            <h1 class="inner-header">Add Tags</h1>
                        </a>
                    </div>
                    <div class="inner-fourth gap box">
                        <a href="view_tag.php" class="inner-link">
                            <i class="fas fa-pencil-alt inner-icons"></i>
                            <h1 class="inner-header">View/Update Tags </h1>
                        </a>
                    </div>
                </div>
                <h1 class="first__section-header">Vendor / Content Section</h1>
                <div class="first-column-wrapper">
                    <div class="inner-first gap box">
                        <a href="add_content_manager.php" class="inner-link">
                            <i class="fas fa-plus inner-icons"></i>
                            <h1 class="inner-header">Add Content Manager</h1>
                        </a>
                    </div>
                    <div class="inner-second gap box">
                        <a href="update_content_manager.php" class="inner-link">
                            <i class="fas fa-pencil-alt inner-icons"></i>
                            <h1 class="inner-header">View/Update Content Manager</h1>
                        </a>
                    </div>
                    <div class="inner-third gap box">
                        <a href="add_vendors.php" class="inner-link">
                            <i class="fas fa-plus inner-icons"></i>
                            <h1 class="inner-header">Add Vendors</h1>
                        </a>
                    </div>
                    <div class="inner-fourth gap box">
                        <a href="update_vendors.php" class="inner-link">
                            <i class="fas fa-pencil-alt inner-icons"></i>
                            <h1 class="inner-header">View/Update Vendors </h1>
                        </a>
                    </div>
                </div>
                <h1 class="first__section-header">VIEW REQUEST/REPORTS</h1>
                <div class="gap box" style="width: 275px">
                    <a href="userforms.php" class="inner-link">
                        <i class="fas fa-pencil-alt inner-icons"></i>
                        <h1 class="inner-header">View Request Received</h1>
                    </a>
                </div>
                <div class="gap box" style="width: 275px">
                    <a href="experts.php" class="inner-link">
                        <i class="fas fa-pencil-alt inner-icons"></i>
                        <h1 class="inner-header">View Expert Request </h1>
                    </a>
                </div>
                <div class="gap box" style="width: 275px">
                    <a href="reports.php" class="inner-link">
                        <i class="fas fa-pencil-alt inner-icons"></i>
                        <h1 class="inner-header">Reports</h1>
                    </a>
                </div>
                <h1 class="first__section-header">SEND SMS</h1>
                <div class="gap box" style="width: 275px">
                    <a href="mailer.php" class="inner-link">
                        <i class="fas fa-share-square inner-icons"></i>
                        <h1 class="inner-header">Send Bulk SMS</h1>
                    </a>
                </div>
                <h1 class="first__section-header">Webinar Management</h1>
                <div class="gap box" style="width: 275px">
                    <a href="webinar_management/index.php" class="inner-link">
                        <i class="fas fa-share-square inner-icons"></i>
                        <h1 class="inner-header">Webinar</h1>
                    </a>
                </div>
                <h1 class="first__section-header">Ask Expert Section</h1>
                <div class="gap box" style="width: 275px">
                    <a href="expert.php" class="inner-link">
                        <i class="fas fa-share-square inner-icons"></i>
                        <h1 class="inner-header">Ask Expert Question and Solutions</h1>
                    </a>
                </div>
                <div class="gap box" style="width: 275px">
                    <a href="student_comments.php" class="inner-link">
                        <i class="fas fa-share-square inner-icons"></i>
                        <h1 class="inner-header">Student Comments</h1>
                    </a>
                </div>
                <div class="gap box" style="width: 275px">
                    <a href="student_feedback.php" class="inner-link">
                        <i class="fas fa-share-square inner-icons"></i>
                        <h1 class="inner-header">Student Feedback</h1>
                    </a>
                </div>
                <h1 class="first__section-header">Notifications</h1>
                <div class="gap box" style="width: 275px">
                    <a href="send_notification.php" class="inner-link">
                        <i class="far fa-bell inner-icons"></i>
                        <h1 class="inner-header">Send Notification</h1>
                    </a>
                </div>
                <div class="gap box" style="width: 275px">
                    <a href="view_notification.php" class="inner-link">
                        <i class="fas fa-share inner-icons"></i>
                        <h1 class="inner-header">View Notification</h1>
                    </a>
                </div>
                <h1 class="first__section-header">Assign Clubs To Classes</h1>
                <div class="gap box" style="width: 275px">
                    <a href="#" class="inner-link">
                    <i class="fas fa-plus inner-icons"></i>
                        <h1 class="inner-header">Assign</h1>
                    </a>
                </div>
            </div>
        
        </div>

        <!--copyright starts-->
        <div class="footer" style=" position: absolute;
    bottom: 0;
    width: 100%;
    height: 60px; 
    background:#000;">
            <div class="left-footer" style="padding: 15px; padding: 15px 0;
        font-size: 20px;
        color: #fff;
        float: none;
        text-align: center;">
                &copy; Copyright – CBSE360 2018
            </div>
        </div>
        <!--copyright ends-->
</body>

</html>