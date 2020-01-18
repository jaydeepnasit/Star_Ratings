<?php

session_start();

require_once 'Config/Functions.php';
$Fun_call = new Functions();
global $blog_no;

$field['u_uni_no'] = $_SESSION['user_uni_no'];
$sel_user_img = $Fun_call->select_assoc('user',$field);

if(!isset($_SESSION['user_name']) && !isset($_SESSION['user_uni_no'])){
    header('Location:index.php');
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    if(isset($_GET['blog_uni_no']) && is_numeric($_GET['blog_uni_no'])){

        $blog_no = $Fun_call->validate($_GET['blog_uni_no']);

        $condition['b_uni_no'] = $blog_no;
        $fetch_blog = $Fun_call->select_assoc('blogs', $condition);

        if(!$fetch_blog){
            header('Location:Blog.php');
        }

    }
    else{
        header('Location:Blog.php');  
    }

}
else{
    header('Location:Blog.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page OverView</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script defer src="https://friconix.com/cdn/friconix.js"></script>
    <link rel="stylesheet" href="CSS/Stylesheet.css">
</head>
<body>
    
    <div class="container mt-2 mb-2">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#"><b>RATING SYSTEM</b></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="form-inline ml-auto">
                    <div class="user-area">
                        <img src="IMAGES/user/<?php echo $sel_user_img['u_image']; ?><?php  ?>" alt="User Image">
                    </div>
                    <a href="logout.php" class="logout my-2 my-sm-0"><i class="fi-xnsuxl-sign-out-solid" style="font-size: 30px;"></i></a>
                </form>
            </div>
        </nav>
    </div>


    <div class="container" >
        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <div class="con-box">
                        <a href="#"><?php echo $fetch_blog['b_id']; ?></a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $fetch_blog['b_title']; ?></h5>
                        <p class="card-text mb-0"><?php echo $fetch_blog['b_text']; ?></p>
                        <div class="star">
                            <?php $j = 5; for($i=1; $i <= 5; $i++) { 

                                $ch_con['ur_u_uni_no'] = $_SESSION['user_uni_no'];
                                $ch_con['ur_b_uni_no'] = $blog_no;
                                $fetch_user_r = $Fun_call->select_assoc('user_rating', $ch_con);
                                
                            ?>
                                
                                <input type="radio" name="rating" id="star-<?php echo $i; ?>" <?php if($fetch_user_r){ if($fetch_user_r['ur_score'] == $j ){ echo "checked"; }} ?> > <label for="star-<?php echo $i; ?>" data-star_r="<?php echo $j; $j--; ?>"></label>
                                
                            <?php } ?>    
                        </div>                                 
                    </div>
                    <div class="card-body">
                        <div class="rating-al-box" id="load_status">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    


    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"> </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"> </script>

    <script type="text/javascript">

        $(document).ready(function(){

            $blog_no = "<?php echo $blog_no; ?>";
            $user_no = "<?php echo $_SESSION['user_uni_no']; ?>";

            $("#load_status").load("Ajax/Live_status.php", { 'blog_uni_no' : $blog_no });

            $(".star > label").on("click", function(){
                $rating = $(this).data("star_r");
                $.ajax({
                    type: "POST",
                    url: "Ajax/Rating_process.php",
                    data: { 
                        'blog_no' : encodeURIComponent($blog_no),
                        'user_no' : encodeURIComponent($user_no),
                        'rating' : encodeURIComponent($rating) },
                    success: function (response) {
                        $r_status = JSON.parse(response);
                        if($r_status.status = 401 ){
                            console.log($r_status.msg);
                            $("#load_status").load("Ajax/Live_status.php", { 'blog_uni_no' : $blog_no });
                        }
                        else if($r_status.status = 403){
                            console.log($r_status.msg);
                            $("#load_status").load("Ajax/Live_status.php", { 'blog_uni_no' : $blog_no });
                        }
                        else{
                            console.log($r_status.msg);
                        }
                    }
                });
            });

        });

    </script>

</body>
</html>