<?php 
include_once "../../assets/Users.php";
$database = new Database();
$db = $database->getConnection();
session_start();
$_SESSION['club_id']='club_18';
$club_id=$_SESSION['club_id'];

$articles= 'SELECT article_id,name,link from article where 
topic_id = (select topic_id from topic where club_id="'.$club_id.'" and 
status=1 and end_date > CURRENT_DATE() order by end_date ASC LIMIT 1)
and status =1 order by date_added DESC '; 

$videos= 'SELECT video_id,title,link from video where
topic_id = (select topic_id from topic where club_id="'.$club_id.'" and 
status=1 and end_date > CURRENT_DATE() order by end_date ASC LIMIT 1) 
and status =1 order by date_added DESC';

$quiz='SELECT quiz_id,quiz_title,link from quiz where topic_id = 
(select topic_id from topic where club_id="'.$club_id.'" and 
status=1 and end_date > CURRENT_DATE() order by end_date ASC LIMIT 1)
 and status =1 order by date_added DESC';

$learning_videos='SELECT video_id,title,link from learning_video where 
topic_id = (select topic_id from topic where club_id="'.$club_id.'" and 
status=1 and end_date > CURRENT_DATE() order by end_date ASC LIMIT 1) 
and status ="1" order by date_added DESC';

$webinar ='SELECT webinar_id,title,speaker,date from webinar where 
topic_id = (select topic_id from topic where club_id="'.$club_id.'" and
 status=1 and end_date > CURRENT_DATE() order by end_date ASC LIMIT 1) 
 and status = "1" order by date DESC';

$sample_work='SELECT sample_work_id,title,link,last_date,media_type from 
sample_work where topic_id = (select topic_id from topic where club_id="'.$club_id.'"
 and status=1 and end_date > CURRENT_DATE() order by end_date ASC LIMIT 1) 
 and status ="1" order by date_added ASC';

$get_fetaured='select * from featured_content where status="1" order by datetime DESC';
$featured_res=$db->query($get_fetaured);
while($row=$featured_res->fetch_array()){
  $featured[$row['type']][]=$row['id'];
}
$art_res=$db->query($articles);
$vid_res=$db->query($videos);
$quiz_res=$db->query($quiz);
$lv_res=$db->query($learning_videos);
$sw_res=$db->query($sample_work);
$web_res=$db->query($webinar);

$sample_article='SELECT name,link,icon from article where article_id="'.$featured['article'][0].'"';
$res_art=$db->query($sample_article);
while($row=$res_art->fetch_array()){
  $art_name=$row['name'];
  $link=$row['link'];
  $icon=$row['icon'];
}

$sample_webinar='SELECT title,image,link from webinar where webinar_id="'.$featured['webinar'][0].'"';
$res_web=$db->query($sample_webinar);
while($row=$res_web->fetch_array()){
  $web_name=$row['title'];
  $web_link=$row['link'];
  $web_icon=$row['image'];
}

$sample_video='SELECT title,link from video where video_id="'.$featured['video'][0].'"';
$res_vid=$db->query($sample_video);
while($row=$res_vid->fetch_array()){
  $vid_name=$row['title'];
  $vid_link=$row['link'];
  $video_id = explode("/embed/", $vid_link); 
}

$sample_work='SELECT title,image from sample_work where sample_work_id="'.$featured['sample_work'][0].'"';
$res_sw=$db->query($sample_work);
while($row=$res_sw->fetch_array()){
  $sw_name=$row['title'];
  $sw_icon = $row['image'];
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" />
    <title>Set Featured</title>
  </head>
  <body>
  <div class="jumbotron">
    <h1 class="display-4">Panel to Set Featured Content on Student Panel</h1>
    <p class="lead">Use Tabs to Navigate Content and click to set as featured</p>
    <hr class="my-4">
    <p>Only one Item of particular Content type can be set as featured</p>
    <button type="button" class="btn btn-primary m-1">Featured</button>
    <button type="button" class="btn btn-outline-secondary m-1">Regular</button>
  </div>
    <div class="container">    
      <div class="alert alert-danger alert-dismissible" id="error-msg" style="display:none;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error!</strong> in the system, please contact Admin.
      </div>
        <nav class="mt-5">
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-article-tab" data-toggle="tab" href="#nav-article" role="tab" aria-controls="nav-article" aria-selected="true">Article</a>
            <a class="nav-item nav-link" id="nav-video-tab" data-toggle="tab" href="#nav-video" role="tab" aria-controls="nav-video" aria-selected="false">Video</a>
            <a class="nav-item nav-link" id="nav-learning-video-tab" data-toggle="tab" href="#nav-learning-video" role="tab" aria-controls="nav-learning-video" aria-selected="false">Learning Video</a>
            <a class="nav-item nav-link" id="nav-webinar-tab" data-toggle="tab" href="#nav-webinar" role="tab" aria-controls="nav-webinar" aria-selected="false">Webinar</a>
            <a class="nav-item nav-link" id="nav-sample-work-tab" data-toggle="tab" href="#nav-sample-work" role="tab" aria-controls="nav-sample-work" aria-selected="false">Sample Work</a>
            <a class="nav-item nav-link" id="nav-quiz-tab" data-toggle="tab" href="#nav-quiz" role="tab" aria-controls="nav-quiz" aria-selected="false">Quiz</a>
            <a class="nav-item nav-link" id="nav-grid-tab" data-toggle="tab" href="#nav-grid" role="tab" aria-controls="nav-panel" aria-selected="false">Panel View</a>
          </div>
        </nav>
      <div class="tab-content pt-5" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-article" role="tabpanel" aria-labelledby="nav-article-tab">  
              <div class="list-group">
                <?php while($row=$art_res->fetch_assoc()){?>
                  <a href="#" id="<?php echo $row['article_id']; ?>" class="list-group-item list-group-item-action <?php if(in_array($row['article_id'],$featured['article'])){echo 'active';} ?>" onclick="set_featured('article','<?php echo $row['article_id']; ?>')"><?php echo $row['name'];?></a>
                <?php } ?>  
            </div>  
          </div>
          <div class="tab-pane fade" id="nav-video" role="tabpanel" aria-labelledby="nav-video-tab">
              <div class="list-group">
                <?php while($row=$vid_res->fetch_assoc()){?>
                  <a href="#" id="<?php echo $row['video_id']; ?>" class="list-group-item list-group-item-action <?php if(in_array($row['video_id'],$featured['video'])){echo 'active';} ?>" onclick="set_featured('video','<?php echo $row['video_id']; ?>')"><?php echo $row['title'];?></a>
                <?php } ?>  
            </div> 
          </div>
          <div class="tab-pane fade" id="nav-learning-video" role="tabpanel" aria-labelledby="nav-learning-video-tab">
              <div class="list-group">
                <?php while($row=$lv_res->fetch_assoc()){?>
                  <a href="#" id="<?php echo $row['video_id']; ?>" class="list-group-item list-group-item-action <?php if(in_array($row['video_id'],$featured['learning_video'])){echo 'active';} ?>" onclick="set_featured('learning_video','<?php echo $row['video_id']; ?>')"><?php echo $row['title'];?></a>
                <?php } ?>  
            </div> 
          </div>
          <div class="tab-pane fade" id="nav-webinar" role="tabpanel" aria-labelledby="nav-webinar-tab">
              <div class="list-group">
                <?php while($row=$web_res->fetch_assoc()){?>
                  <a href="#" id="<?php echo $row['webinar_id']; ?>" class="list-group-item list-group-item-action <?php if(in_array($row['webinar_id'],$featured['webinar'])){echo 'active';} ?>" onclick="set_featured('webinar','<?php echo $row['webinar_id']; ?>')"><?php echo $row['title'];?></a>
                <?php } ?>  
            </div> 
          </div>
          <div class="tab-pane fade" id="nav-sample-work" role="tabpanel" aria-labelledby="nav-sample-work-tab">
              <div class="list-group">
                <?php while($row=$sw_res->fetch_assoc()){?>
                  <a href="#" id="<?php echo $row['sample_work_id']; ?>" class="list-group-item list-group-item-action <?php if(in_array($row['sample_work_id'],$featured['sample_work'])){echo 'active';} ?>" onclick="set_featured('sample_work','<?php echo $row['sample_work_id']; ?>')"><?php echo $row['title'];?></a>
                <?php } ?>  
            </div> 
          </div>
          <div class="tab-pane fade" id="nav-quiz" role="tabpanel" aria-labelledby="nav-quiz-tab">
            <div class="list-group">
                <?php while($row=$quiz_res->fetch_assoc()){?>
                  <a href="#" id="<?php echo $row['quiz_id']; ?>" class="list-group-item list-group-item-action <?php if(in_array($row['quiz_id'],$featured['quiz'])){echo 'active';} ?>" onclick="set_featured('quiz','<?php echo $row['quiz_id']; ?>')"><?php echo $row['quiz_title'] ;?></a>
                <?php }?>  
            </div> 
          </div> 
          <div class="tab-pane fade mb-5" id="nav-grid" role="tabpanel">
          <div class="td-container tdc-row ">
        <div class="td_block_wrap td_block_big_grid_3 td_uid_19_5c0febf1624bf_rand td-grid-style-1 td-hover-1 td-big-grids td-pb-border-top td_block_template_1"
            data-td-block-uid="td_uid_19_5c0febf1624bf">
            <div id="td_uid_19_5c0febf1624bf" class="td_block_inner">
                <div class="td-big-grid-wrapper ">
                    <div class="td_module_mx5 td-animation-stack td-big-grid-post-0 td-big-grid-post td-big-thumb article">
                        <div class="td-module-thumb" style="background-repeat:no-repeat;background-position: center;background-size:cover;background-image:
                                    url('../../assets/webinar/<?php if(isset($web_icon)){echo $web_icon;}?>);">
                            <a href="<?php if(isset($link)){echo $link;} ?>" rel="bookmark" class="td-image-wrap">
                            </a>
                        </div>
                        <div class="td-meta-info-container">
                            <div class="td-meta-align">
                                <div class="td-big-grid-meta">
                                    <a href="" class="td-post-category">Featured Article</a>
                                    <h3 class="entry-title td-module-title">
                                        <a href="<?php if(isset($link)){echo $link;} ?>" rel="bookmark" title="WordPress News Magazine Charts the Most Fashionable New York Women in 2018"><?php if(isset($art_name)){echo $art_name;}?>
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="td-big-grid-scroll">
                        <div class="td_module_mx11 td-animation-stack td-big-grid-post-1 td-big-grid-post td-medium-thumb">
                            <div class="td-module-thumb" style="background-repeat:no-repeat;background-position: center;background-size:cover;background-image:
                                    url(<?php if(isset($video_id)){echo 'https://img.youtube.com/vi/'.$video_id[1].'/maxresdefault.jpg';}?>);">
                                <a href="<?php if(isset($vid_link)){echo $vid_link;} ?>" rel="bookmark" class="td-image-wrap" title="<?php if(isset($vid_name)){echo $vid_name;}?>"></a>
                            </div>
                            <div class="td-meta-info-container">
                                <div class="td-meta-align">
                                    <div class="td-big-grid-meta">
                                        <a href="https://demo.tagdiv.com/newspaper/category/tagdiv-lifestyle/tagdiv-travel/"
                                            class="td-post-category">Featured Video</a>
                                        <h3 class="entry-title td-module-title">
                                            <a href="https://demo.tagdiv.com/newspaper/the-most-anticipated-charter-flights-in-the-canary-islands/"
                                                rel="bookmark" title="<?php if(isset($vid_name)){echo $vid_name;}?>"><?php if(isset($vid_name)){echo $vid_name;} ?></a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="td_module_mx6 td-animation-stack td-big-grid-post-2 td-big-grid-post td-small-thumb">
                            <div class="td-module-thumb" style="background-repeat:no-repeat;background-position: center;background-size:cover;background-image:
                                    url('../../assets/webinar/<?php if(isset($web_icon)){echo $web_icon;}?>);">
                                <a href="<?php if(isset($web_link)){echo $web_link;}?>"
                                    rel="bookmark" class="td-image-wrap" title="<?php if(isset($web_name)){echo $web_name;}?>"></a>
                            </div>
                            <div class="td-meta-info-container">
                                <div class="td-meta-align">
                                    <div class="td-big-grid-meta">
                                        <a href="<?php if(isset($web_link)){echo $web_link;}?>" class="td-post-category">Webinar</a>
                                        <h3 class="entry-title td-module-title">
                                            <a href="https://demo.tagdiv.com/newspaper/15-grooming-techniques-every-man-needs-to-know/"
                                                rel="bookmark" title="<?php if(isset($web_name)){echo $web_name;}?>"><?php if(isset($web_name)){echo $web_name;}?></a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="td_module_mx6 td-animation-stack td-big-grid-post-3 td-big-grid-post td-small-thumb">
                            <div class="td-module-thumb" style="background-repeat:no-repeat;background-position: center;background-size:cover;background-image:
                                    url(../../assets/sample_work/<?php if(isset($sw_icon)){echo $sw_icon;}?>);">
                                <a href=""
                                    rel="bookmark" class="td-image-wrap" title="<?php if(isset($sw_name)){echo $sw_name;}?>"><img
                                        width="265" height="198" class="entry-thumb td-animation-stack-type0-2" src="assets/images/vr.jpeg"
                                        alt="" title="<?php if(isset($sw_name)){echo $sw_name;}?>" /></a>
                            </div>
                            <div class="td-meta-info-container">
                                <div class="td-meta-align">
                                    <div class="td-big-grid-meta">
                                        <a href=""
                                            class="td-post-category">Activity</a>
                                        <h3 class="entry-title td-module-title">
                                            <a href="<?php if(isset($sw_link)){echo $sw_link;}?>"
                                                rel="bookmark" title="<?php if(isset($sw_name)){echo $sw_name;}?>"><?php if(isset($sw_name)){echo $sw_name;}?>
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
          </div>  
          <div></div>          
      </div>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script>
      function set_featured(type,id){
        event.preventDefault();
        $.get("action.php?action=featured&type="+type+"&id="+id, function(data){
          console.log(data);
          if(data=='success'){
            location.reload();
          }
          else{
            $('#error-msg').show();
          }
        });
      }
    </script>
  </body>
</html>