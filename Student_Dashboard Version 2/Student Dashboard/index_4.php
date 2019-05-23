

<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="owl.carousel.min.css" />
  <link rel="stylesheet" href="owl.carousel.default.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <title>Student Dashboard - Live CBSE</title>
</head>
<body>
  <section class="navigation">
    <div class="nav-container">
      <div class="brand">
        <a href="index_d.php">
          <img alt="LiveCBSE" height="35px" src="livecbse_logo.png" />
        </a>
      </div>
      <nav>
        <div class="nav-mobile">
          <a href="#!" id="nav-toggle"><span></span></a>
        </div>
        <ul class="nav-list">
          <li>
            <a href="index_d.php"> <i class="fas fa-home nav-listIcons"></i> Home</a>
          </li>
          <li>
            <a href="downloads.php?club=club_18&topic=" id="download_link"><i class="fas fa-download nav-listIcons"></i> Downloads</a>
          </li>
          <li>
            <a href="ask_experts.php"><i class="fas fa-question nav-listIcons"></i> Ask Experts</a>
          </li>
          <li>
            <a href="favourite_d.php"> <i class="fas fa-heart nav-listIcons"></i> Favourites</a>
          </li>
          <li>
            <a href="#!">Select Club</a>
            <ul class="nav-dropdown" id="clubNav">
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </section>
<div class="wrapper">
    <div class="topic__wrapper">
      <h1 class="topic__header" id="topic_name"></h1>
      <div class="select_wrap">
        <select id="topics" onchange="change_topic()" class="select_topic">
          <option value="" disabled="" selected>Change Topic</option>
        </select>
      </div>
   </div>
</div>

<div class="owl-carousel owl-theme" id="videoCarousel"></div>

<div class="wrapper">
<h1 class="section__header">Articles</h1>
   <div class="product-carousel owl-carousel owl-theme" id="articleCarousel">
   </div>

<div class="box box_effect">
    <h1 class="tags__header">Filter by category / collection</h1>
    <div class="tags__div owl-carousel owl-theme" id="tags">
    </div>
</div>

<h1 class="section__header">Quiz</h1>
      <div class="product-carousel owl-carousel owl-theme " id="quizCarousel">
      <div class='product'>
        <div class='product-top'>
      <div class='product-image' style='background-color:#f7f5c4fa ;height: 200px;width: auto' />
      <div class="product_info">
        <h1>AI Quiz</h1>
        <div class="div_start">
        <a class="openPopup" onclick="get_quiz()" id="quiz_26" data-toggle="modal" data-href="get_quiz.php?quiz_id=&quot;quiz_26&quot;">Start Quiz</a>
        </div>
      </div>
    </div>
  </div>
  <div class='product'>
        <div class='product-top'>
      <div class='product-image' style='background-color:#f7f5c4fa ;height: 200px;width: auto' />
      <div class="product_info">
        <h1>AI Quiz</h1>
        <div class="div_start">
          <a href="#">Start Quiz</a>
        </div>
      </div>
    </div>
  </div>
  <div class='product'>
        <div class='product-top'>
      <div class='product-image' style='background-color:#f7f5c4fa ;height: 200px;width: auto' />
      <div class="product_info">
        <h1>AI Quiz</h1>
        <div class="div_start">
          <a href="#">Start Quiz</a>
        </div>
      </div>
    </div>
  </div>
  <div class='product'>
        <div class='product-top'>
      <div class='product-image' style='background-color:#f7f5c4fa ;height: 200px;width: auto' />
      <div class="product_info">
        <h1>AI Quiz</h1>
        <div class="div_start">
          <a href="#">Start Quiz</a>
        </div>
      </div>
    </div>
  </div>
       </div>    
       </div>  
       </div>  
       </div>  
       </div>  
</section>


<footer>
    <div id="footer_sub">
      <ul class="footer_sub-list">
        <li> <a href="">About Us </a> </li>
        <li> <a href=""> Franchise </a></li>
        <li> <a href=""> Join Us</a></li>
        <li> <a href="">© 2012 All Rights Reserved with domain Edutech Pvt. Ltd.<br> <img src="livecbse_logo.png" alt=""
              height="30"></a>
        </li>
        <li> <a href=""> Privacy Policy</a></li>
        <li> <a href="">Disclaimer</a></li>
      </ul>
    </div>
  </footer>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
               <h1>Demo</h1>
            </div>
        </div>
</div>
  <script src="owl.carousel.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>

<script>
    (function ($) {
      $(function () {
        $("nav ul li > a:not(:only-child)").click(function (e) {
          $(this)
            .siblings(".nav-dropdown")
            .toggle();
          $(".nav-dropdown")
            .not($(this).siblings())
            .hide();
          e.stopPropagation();
        });
        $("html").click(function () {
          $(".nav-dropdown").hide();
        });
      });
      document
        .querySelector("#nav-toggle")
        .addEventListener("click", function () {
          this.classList.toggle("active");
        });
      $("#nav-toggle").click(function () {
        $("nav ul").toggle();
      });
    })(jQuery);
</script>  
  
  <script>
      var video_carousel=$("#videoCarousel").owlCarousel({
      center: true,
      loop: true,
      margin: 10,
      responsive: {
        1200: {
          items: 2,
        },
        800: {
          items: 1,
        },
        600: {
          items: 1,
        },
        300: {
          items: 1,
        }
      }
     }); 

      var article_carousel=$("#articleCarousel").owlCarousel({
        loop: false,
        margin: 10,
        responsive: {
          1600: {
            items: 5,
          },
          1200: {
            items: 4,
          },
          800: {
            items: 3,
          },
          600: {
            items: 2,
          },
          300: {
            items: 1,
          }
        }
      });

     var quiz_carousel=$("#quizCarousel").owlCarousel({
        loop: false,
        margin: 10,
        responsive: {
          1600: {
            items: 5,
          },
          1200: {
            items: 4,
          },
          800: {
            items: 3,
          },
          600: {
            items: 2,
          },
          300: {
            items: 1,
          }
        }
      });
   
    var tag_carousel=$('#tags').owlCarousel({
        loop: false,
        margin: 10,
        dots: true,
        responsive: {
          1600: {
            items: 5,
          },
          1200: {
            items: 8,
          },
          800: {
            items: 6,
          },
          600: {
            items: 4,
          },
          300: {
            items: 2,
          }
        }
      });

  
    $.post("../app_livecbse/student_panel_mobile.php", {
      user: '9460394714',
      club: 'club_18',
               
    }).done(
      function (post_data) { 
        console.log(post_data);
        var clubs = []; //Clubs  
        var topics = []; //Topics 
        var videos = []; //Videos
        var articles = []; //Articles
        var tags = []; //Tags
        var quiz = []; //Quiz   
        var data = JSON.parse(post_data);

        $('#topic_name').html(data.theme.name); 
        
        $.each(data.clubs, function (key, data) {
          clubs.push("<li><a href='?club=" + data.id + "'>" + data.name + "</a></li>");
        });
        $('#clubNav').append(clubs);
        
        //Insert Topics
        $.each(data.topics, function (key, data) {
          topics.push(`<option value='${data.topic_id}'>${data.topic_name}</option>`);
        });
        $('#topics').append(topics);
        
        //Insert Videos
        $.each(data.videos, function (key, data) {  
             var video_link="https://www.youtube.com/embed/"+data.video_key; 
            video_carousel.trigger('add.owl.carousel',[jQuery('<div><iframe src="'+video_link+'"></iframe></div>')]);
        });
  
        //Insert Articles
        $.each(data.articles, function (key, data) {
           var icon=data.icon;
           var title=data.name;   
           article_carousel.trigger('add.owl.carousel',[jQuery('<div class=\'product\'><div class=\'product-top\'><div class=\'product-image\' style=\'background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0, #181818 100%),url("'+data.icon+'");background-size: contain;height: 200px;width: auto\' /><div class=\'click\'><span class=\'far fa-heart\' onclick=\'set_fav("'+data.article_id+'","'+data.status+'")\'></span></div><div class=\'inner_product\'><h1 class=\'inner_productTitle\'>Article</h1><p class=\'inner_productDescription\'>"'+data.name+'"</p></div></div></div></div>')]); 
        });
  
        //Insert Quiz
           $.each(data.quiz, function (key, data) {
             var quiz_link=data.quiz_link;
             var quiz_id=data.quiz_id;
             var quiz_title=data.quiz_title;
             quiz_carousel.trigger('add.owl.carousel',[jQuery('<div class=\'product\'><div class=\'product-top\'><div class=\'product-image\' style=\'background-color:#f7f5c4fa ;height: 200px;width: auto\'><div class=\'product_info\'><h1>'+quiz_title+'</h1><div class=\'div_start\'><a class=\'openPopup\' data-toggle=\'modal\'  href=\'javascript:void(0);\' data-href=\'get_quiz.php?quiz_id="'+quiz_id+'"\'>Start Quiz</a></div></div></div></div></div>')]); 
          });

        //Insert Tags
       /* $.each(data.tags, function (key, data) {
          tags.push(`
        <div class="tags__divInner" id="${data.tag_id}">
        <h1 onclick="get_tag(\'${data.tag_id}\')" style="cursor:pointer">${data.tag_name}</h1>
        <h1><i class="fas fa-times-circle close__icon"></i></h1>
      </div>      
        `);
        }); */

          $.each(data.tags, function (key, data) { 
            var tag_id=data.tag_id;
            var tag_name=data.tag_name;
            tag_carousel.trigger('add.owl.carousel',[jQuery('<div class=\'tags__divInner\' id="'+tag_id+'"><h1 onclick=\'get_tag("'+tag_id+'")\' style=\'cursor:pointer\'>"'+tag_name+'"</h1><h1><i class=\'fas fa-times-circle close__icon\'></i></h1></div>')]);
          });


      //  $('#tags').append(tags); 
            tag_carousel.trigger('refresh.owl.carousel');
            video_carousel.trigger('refresh.owl.carousel'); 
            article_carousel.trigger('refresh.owl.carousel'); 
            quiz_carousel.trigger('refresh.owl.carousel'); 
      });
  </script>


<script>

$(document).ready(function(){
    $('.openPopup').on('click',function(){
        var dataURL = $(this).attr('data-href');
        $('.modal-content').load(dataURL,function(){
            $('#exampleModal').modal({show:true});
        });
    }); 
});


</script>


<script>
     function get_tag(tag_id)
     {
        window.location = "https://www.livecbse.com/livecbse_site/cbse_360/student_dashboard/tag.php?tag_id="+tag_id;
     }
                 
     function set_fav(p,q)
     {
       $.post("../app_livecbse/student_pin.php", {
        user_id: 'ST_5',
        topic_id: $('#topics').val(),
        type:'article',
        status:q,
        activity_id:p,
       }).done(
       function (post_data) { 
             var data = JSON.parse(post_data);
            if(data.response_status == 'Submitted')
             {
                  if(q == 1)
                   {
                       alert('Added to fav.');
                   } 
                  if(q == 0)
                   {
                       alert('Removed from Fav.');
                   }
             }
       }); 
     }

function change_topic()
{
   var topic=$('#topics').val();
   var club="club_18";
   window.location = "https://www.livecbse.com/livecbse_site/cbse_360/student_dashboard/index_d.php?club="+club+"&topic="+topic; 
}
</script>
</body>
</html>