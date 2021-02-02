<?php


include_once("includes/header.php");
include("includes/db.php");
?>


<!-- Navbar -->
<?php
include("includes/navbar.php");

?>
<!-- Navbar -->

<?php

if (isset($_GET['id'])) {

    $Getpost = "SELECT * FROM posts WHERE post_id = ?";
    $Getpost = $conn->prepare($Getpost);
    $Getpost->bind_param('i', $_GET['id']);
    $Getpost->execute();
    $GetpostResults = $Getpost->get_result();
    $row = mysqli_fetch_assoc($GetpostResults);
    $post_Author = $row['post_author'];
}



?>



<?php
function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    $string = array('y' => 'year', 'm' => 'month', 'w' => 'week', 'd' => 'day', 'h' => 'hour', 'i' => 'minute', 's' => 'second');
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

// This function will populate the comments and comments replies using a loop
// $comments -> all comments
// $parent_id -> id of the post 
function show_comments($comments, $parent_id = -1)
{
    $html = '';
    if ($parent_id != -1) {
        // If the comments are replies sort them by the "submit_date" column
        array_multisort(array_column($comments, 'comment_date'), SORT_ASC, $comments);
    }
    // Iterate the comments using the foreach loop
    foreach ($comments as $comment) {
        if ($comment['comment_parent_id'] == $parent_id) {
            // Add the comment to the $html variable






            $html .=  '<div class="media d-block d-md-flex mt-3 ">
            <img class="d-flex mb-3 mx-auto " src="https://mdbootstrap.com/img/Photos/Avatars/img (27).jpg" alt="Generic placeholder image">
            <div class="media-body text-center text-md-left ml-md-3 ml-0">
                <h5 class="mt-0 font-weight-bold">' . htmlspecialchars($comment['comment_author'], ENT_QUOTES) . ' 
                    <a href="#" class="pull-right reply_comment_btn" data-commeent-id="' . $comment['comment_id'] . ' ">
                        <i class="fas fa-reply"></i>
                    </a>' . show_write_comment_form($comment['comment_id']) . '
                </h5>
                <span>' .  time_elapsed_string($comment['comment_date']) . ' </span>
                ' . time_elapsed_string($comment['comment_content']) . '
                <div class="replies">
            ' . show_comments($comments, $comment['comment_id']) . '
            </div>
            </div>
                </div>';
        }
    }
    return $html;
}
// This function is the template for the write comment form
function show_write_comment_form($parent_id = -1)
{



    $html = '
    <div class="write_comment" data-comment-id="' . $parent_id . '">
        <form>
            <input name="parent_id" type="hidden" value="' . $parent_id . '">
            <input name="name" type="text" value="' . $_SESSION['username']  . '" placeholder="Your Name" required>
            <textarea name="content" placeholder="Write your comment here..." required></textarea>
            <button type="submit">Submit Comment</button>
        </form>
    </div>
    ';
    return $html;
}

// Page ID needs to exist, this is used to determine which comments are for which page
if (isset($_GET['id'])) {
    // Check if the submitted form variables exist
    if (isset($_POST['name'], $_POST['content'])) {
        // POST variables exist, insert a new comment into the MySQL comments table (user submitted form)
        $stmt = $pdo->prepare('INSERT INTO comments (comment_post_id, comment_parent_id, comment_author, comment_content, comment_date) VALUES (?,?,?,?,NOW())');
        $stmt->execute([$_GET['id'], $_POST['parent_id'], $_POST['name'], $_POST['content']]);
        exit('Your comment has been submitted!');
    }
    // Get all comments by the Page ID ordered by the submit date
    $stmt = $pdo->prepare('SELECT * FROM comments WHERE comment_post_id = ? ORDER BY comment_date DESC');
    $stmt->execute([$_GET['id']]);
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Get the total number of comments
    $stmt = $pdo->prepare('SELECT COUNT(*) AS total_comments FROM comments WHERE comment_post_id = ?');
    $stmt->execute([$_GET['id']]);
    $comments_info = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    exit('No page ID specified!');
}
?>





</header>
<!--Main Navigation-->

<!--Main layout-->
<main class="mt-5 pt-5">
    <div class="container">

        <!--Section: Post-->
        <section class="mt-4">

            <!--Grid row-->
            <div class="row">

                <!--Grid column-->
                <div class="col-md-8 mb-4">
                    <?php
                    $postIdd = $row['post_id'];
                    $query = $conn->prepare('SELECT * FROM images WHERE post_id = ? LIMIT 1');
                    $query->bind_param('s', $postIdd);
                    $query->execute();
                    $results1 = $query->get_result();
                    $row1 = mysqli_fetch_assoc($results1);

                    ?>
                    <!--Featured Image-->
                    <div class="card mb-4 wow fadeIn">

                        <img src="admin/images/<?php echo $row1['name'] ?>" class="img-fluid" alt="">

                    </div>
                    <!--/.Featured Image-->



                    <!--Card-->
                    <div class="card mb-4 wow fadeIn">

                        <!--Card content-->
                        <div class="card-body">

                            <p class="h5 my-4"><?php echo $row['post_title'] ?></p>




                            <p><?php echo $row['post_content'] ?></p>



                        </div>

                    </div>

                    <?php
                    $postIdd = $row['post_id'];
                    $query = $conn->prepare('SELECT * FROM images WHERE post_id = ?');
                    $query->bind_param('s', $postIdd);
                    $query->execute();
                    $results1 = $query->get_result();
                    while ($row1 = mysqli_fetch_assoc($results1)) {
                    ?>
                        <!--/.Card-->
                        <!--Featured Images-->
                        <div class="card mb-4 wow fadeIn">

                            <img src="admin/images/<?php echo $row1['name'] ?>" class="img-fluid" alt="">

                        </div>
                        <!--/.Featured Images-->
                        <!--Card-->
                    <?php
                    }


                    ?>

                    <div class="card mb-4 wow fadeIn">

                        <div class="card-header font-weight-bold">
                            <span>Autor</span>
                            <span class="pull-right">
                                <a href="">
                                    <i class="fab fa-facebook-f mr-2"></i>
                                </a>
                                <a href="">
                                    <i class="fab fa-twitter mr-2"></i>
                                </a>
                                <a href="">
                                    <i class="fab fa-instagram mr-2"></i>
                                </a>
                                <a href="">
                                    <i class="fab fa-linkedin-in mr-2"></i>
                                </a>
                            </span>
                        </div>

                        <!--Card content-->
                        <div class="card-body">
                            <?php
                            $user_id = $post_Author;
                            $getPostAuthor = $conn->prepare('SELECT * FROM users WHERE user_id = ?');
                            $getPostAuthor->bind_param('i', $user_id);
                            $getPostAuthor->execute();
                            $getPostAuthorName = $getPostAuthor->get_result();
                            $row2 = mysqli_fetch_assoc($getPostAuthorName);

                            ?>
                            <div class="media d-block d-md-flex mt-3">
                                <img class="d-flex mb-3 mx-auto z-depth-1" src="userImages/<?php echo $row2['user_image'] ?>" alt="Generic placeholder image" style="width: 100px;">
                                <div class="media-body text-center text-md-left ml-md-3 ml-0">
                                    <h5 class="mt-0 font-weight-bold"><?php echo $row2['username'] ?>
                                    </h5>

                                </div>
                            </div>

                        </div>

                    </div>




                    <!--/.Card-->
                    <!--Reply-->
                    <div class="card mb-3 wow fadeIn">
                        <div class="card-header font-weight-bold comment_header">Leave a reply</div>
                        <div class="card-body">

                            <!-- Default form reply -->
                            <form method="post" id="comment_form">

                                <!-- Comment -->
                                <div class="form-group">
                                    <label for="replyFormComment">Your comment</label>
                                    <textarea name="comment_content" class="form-control" id="replyFormComment" rows="5"></textarea>
                                </div>
                                <input type="hidden" name="comment_name" value="<?php echo $_SESSION['username'] ?>">



                                <div class="text-center mt-4">
                                    <button class="btn btn-info btn-md" name="submit" id="submit" type="submit">Post</button>
                                </div>
                            </form>
                            <span id="comment_message"></span>
                            <!-- Default form reply -->



                        </div>
                    </div>
                    <!--/.Reply-->
                    <!--Comments-->
                    <div class="card card-comments mb-3 wow fadeIn">
                        <div class="card-header font-weight-bold"><?= $comments_info['total_comments'] ?> comments</span></div>
                        <div class="card-body card-body-comments">

                            <?php
                            show_write_comment_form();

                            show_comments($comments);

                            ?>

                            <div class="media d-block d-md-flex mt-4">
                                <img class="d-flex mb-3 mx-auto " src="https://mdbootstrap.com/img/Photos/Avatars/img (20).jpg" alt="Generic placeholder image">
                                <div class="media-body text-center text-md-left ml-md-3 ml-0">
                                    <h5 class="mt-0 font-weight-bold">Miley Steward
                                        <a href="" class="pull-right">
                                            <i class="fas fa-reply"></i>
                                        </a>
                                    </h5>
                                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                    pariatur. Excepteur sint occaecat
                                    cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

                                    <div class="media d-block d-md-flex mt-3">
                                        <img class="d-flex mb-3 mx-auto " src="https://mdbootstrap.com/img/Photos/Avatars/img (27).jpg" alt="Generic placeholder image">
                                        <div class="media-body text-center text-md-left ml-md-3 ml-0">
                                            <h5 class="mt-0 font-weight-bold">Tommy Smith
                                                <a href="" class="pull-right">
                                                    <i class="fas fa-reply"></i>
                                                </a>
                                            </h5>
                                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                            laudantium, totam rem aperiam, eaque
                                            ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta
                                            sunt explicabo.
                                        </div>
                                    </div>

                                    <!-- Quick Reply -->
                                    <div class="form-group mt-4">
                                        <label for="quickReplyFormComment">Your comment</label>
                                        <textarea class="form-control" id="quickReplyFormComment" rows="5"></textarea>

                                        <div class="text-center">
                                            <button class="btn btn-info btn-sm" type="submit">Post</button>
                                        </div>
                                    </div>


                                    <div class="media d-block d-md-flex mt-3">
                                        <img class="d-flex mb-3 mx-auto " src="https://mdbootstrap.com/img/Photos/Avatars/img (21).jpg" alt="Generic placeholder image">
                                        <div class="media-body text-center text-md-left ml-md-3 ml-0">
                                            <h5 class="mt-0 font-weight-bold">Sylvester the Cat
                                                <a href="" class="pull-right">
                                                    <i class="fas fa-reply"></i>
                                                </a>
                                            </h5>
                                            Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,
                                            sed quia non numquam eius modi
                                            tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="media d-block d-md-flex mt-3">
                                <img class="d-flex mb-3 mx-auto " src="https://mdbootstrap.com/img/Photos/Avatars/img (30).jpg" alt="Generic placeholder image">
                                <div class="media-body text-center text-md-left ml-md-3 ml-0">
                                    <h5 class="mt-0 font-weight-bold">Caroline Horwitz
                                        <a href="" class="pull-right">
                                            <i class="fas fa-reply"></i>
                                        </a>
                                    </h5>
                                    At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                                    deleniti atque corrupti
                                    quos dolores et quas molestias excepturi sint occaecati cupiditate non provident,
                                    similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum
                                    fuga.
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--/.Comments-->



                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-4 mb-4">

                    <!--Card: Jumbotron-->
                    <div class="card blue-gradient mb-4 wow fadeIn">

                        <!-- Content -->
                        <div class="card-body text-white text-center">

                            <h4 class="mb-4">
                                <strong>Learn Bootstrap 4 with MDB</strong>
                            </h4>
                            <p>
                                <strong>Best & free guide of responsive web design</strong>
                            </p>
                            <p class="mb-4">
                                <strong>The most comprehensive tutorial for the Bootstrap 4. Loved by over 500 000 users. Video
                                    and written versions available. Create your own, stunning website.</strong>
                            </p>
                            <a target="_blank" href="https://mdbootstrap.com/education/bootstrap/" class="btn btn-outline-white btn-md">Start
                                free tutorial
                                <i class="fas fa-graduation-cap ml-2"></i>
                            </a>

                        </div>
                        <!-- Content -->
                    </div>
                    <!--Card: Jumbotron-->

                    <!--Card : Dynamic content wrapper-->
                    <div class="card mb-4 text-center wow fadeIn">

                        <div class="card-header">Do you want to get informed about new articles?</div>

                        <!--Card content-->
                        <div class="card-body">

                            <!-- Default form login -->
                            <form>

                                <!-- Default input email -->
                                <label for="defaultFormEmailEx" class="grey-text">Your email</label>
                                <input type="email" id="defaultFormLoginEmailEx" class="form-control">

                                <br>

                                <!-- Default input password -->
                                <label for="defaultFormNameEx" class="grey-text">Your name</label>
                                <input type="text" id="defaultFormNameEx" class="form-control">

                                <div class="text-center mt-4">
                                    <button class="btn btn-info btn-md" type="submit">Sign up</button>
                                </div>
                            </form>
                            <!-- Default form login -->

                        </div>

                    </div>
                    <!--/.Card : Dynamic content wrapper-->

                    <!--Card-->
                    <div class="card mb-4 wow fadeIn">

                        <div class="card-header">Related articles</div>

                        <!--Card content-->
                        <div class="card-body">

                            <ul class="list-unstyled">
                                <li class="media">
                                    <img class="d-flex mr-3" src="https://mdbootstrap.com/img/Photos/Others/placeholder7.jpg" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <a href="">
                                            <h5 class="mt-0 mb-1 font-weight-bold">List-based media object</h5>
                                        </a>
                                        Cras sit amet nibh libero, in gravida nulla (...)
                                    </div>
                                </li>
                                <li class="media my-4">
                                    <img class="d-flex mr-3" src="https://mdbootstrap.com/img/Photos/Others/placeholder6.jpg" alt="An image">
                                    <div class="media-body">
                                        <a href="">
                                            <h5 class="mt-0 mb-1 font-weight-bold">List-based media object</h5>
                                        </a>
                                        Cras sit amet nibh libero, in gravida nulla (...)
                                    </div>
                                </li>
                                <li class="media">
                                    <img class="d-flex mr-3" src="https://mdbootstrap.com/img/Photos/Others/placeholder5.jpg" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <a href="">
                                            <h5 class="mt-0 mb-1 font-weight-bold">List-based media object</h5>
                                        </a>
                                        Cras sit amet nibh libero, in gravida nulla (...)
                                    </div>
                                </li>
                            </ul>

                        </div>

                    </div>
                    <!--/.Card-->

                </div>
                <!--Grid column-->

            </div>
            <!--Grid row-->

        </section>
        <!--Section: Post-->

    </div>
</main>
<!--Main layout-->


<!--Footer-->
<?php

include_once("includes/footer.php");
?>