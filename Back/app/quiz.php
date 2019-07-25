<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.1.css">
</head>

<body style="background-color: #000;">
    <div class="page-lay-new left-right-gap">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <?php if(isset($_GET['quiz'])){echo '<div class="apester-media apester-element" data-media-id="'.$_GET['quiz'].'">
                    <apester-layer class="apester-active apester-layer apester-layout" id="APESTER_1">
                        <div class="apester-loading-container apester-hidden"><img src="https://static.apester.com/./js/assets/loader_100x100.gif"
                                class="interaction-loader"></div><iframe frameborder="0" allowtransparency="true"
                            scrolling="no" data-interaction-id="'.$_GET['quiz'].'" name="http://www.wingxp.com/login/student_panel/new_design/student_dashboard_final.php"
                            class="apester-fill-content" src="about:blank"></iframe>
                    </apester-layer>
                </div>';}else{echo '<h1 style="color: white;">Content Not Available</h1>';}?>
                <script async="" src="https://static.apester.com/js/sdk/latest/apester-sdk.js"></script>
            </div>
        </div>
    </div>

</body>

</html>