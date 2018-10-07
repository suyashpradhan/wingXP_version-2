<?php
     include("home_header.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>

<body>
    <nav>
        <ul class="nav__main">
            <li class="logo-list">SPACEDTIMES</li>
            <li class="admin_name dropdown">Suyash Pradhan <i class="fas fa-angle-down secondary-icons"></i>
                <div class="dropdown-content">
                    <a href="#" class="logout-link">Logout</a>
                </div>
            </li>
            <li class="menu"><i class="fas fa-bars menu-icons"></i></li>
        </ul>
    </nav>
    <div class="page-description-header">
        <div class="page-container">
            <h1 class="page-description-text">NEW CLUB CATEGORY</h1>
        </div>
    </div>
    <div class="page-middle-wrapper">
        <form action="#" class="page-form" id="fileUploadForm" enctype="multipart/form-data">
            <input type="text" name="club_category_name" id="club_category_name" placeholder="Club Category Name" class="form-field"
                required="true"><br>
            <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Club Category Description" class="form-textarea" required="true"></textarea><br>
            <input type="button" name="submit" value="SUBMIT" id="sub" name="sub" onclick="check_form()" class="submit__btn">
        </form>
    </div>
    <?php
    include("admin_footer.php");
?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
        crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script language="javascript">
        $(function () {
            $("#password").keyup(function (event) {
                if (event.keyCode == 13) {
                    login();
                }
            });
        });


        function check_form() {
            var club_name = $('#club_category_name').val();
            var desc = $('#desc').val();
            if (club_name === '' || desc === '') {
                alert('Please make sure all fields are filled.');
            }
            else {
                add_image();
            }
        }

        function add_image() {
            //stop submit the form, we will post it manually.
            event.preventDefault();
            // Get form
            var form = $('#fileUploadForm')[0];
            // Create an FormData object 
            var data = new FormData(form);
            // If you want to add an extra field for the FormData
            data.append("CustomField", "This is some extra data, testing");

            // disabled the submit button
            $("#sub").prop("disabled", true);

            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "club_category_back.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    $("#result").text(data);
                    document.getElementById('msg').innerHTML = data;
                    $("#sub").prop("disabled", false);
                },
                error: function (e) {
                    $("#result").text(e.responseText);
                    document.getElementById('msg').innerHTML = 'Rename File or upload smaller file!';
                    $("#sub").prop("disabled", false);
                }
            });
        }
    </script>
</body>

</html>