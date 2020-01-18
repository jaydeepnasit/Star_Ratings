<?php

session_start();

require_once '../Config/Functions.php';
$Fun_call = new Functions();

$field['u_uni_no'] = $_SESSION['user_uni_no'];
$sel_user_img = $Fun_call->select_assoc('user',$field);

$error = array();

if(!isset($_SESSION['user_name']) && !isset($_SESSION['user_uni_no'])){
    header('Location:../index.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['blog_uni_no']) && is_numeric($_POST['blog_uni_no'])){

       $blog_no = $Fun_call->validate($_POST['blog_uni_no']);

       $N_O_R = 0;
       $r_condition['ur_b_uni_no'] = $blog_no;
       $count_r = $Fun_call->select_count('user_rating', $r_condition);
       $N_O_R = $count_r['NumberOfRatings'];
   
       $fetch_ratings = $Fun_call->select_order_where('user_rating', $r_condition, 'ur_id');
       $AV_rating = $t_rat = 0;
       if($fetch_ratings){
   
           foreach($fetch_ratings as $ratings){
               $t_rat = $t_rat + $ratings['ur_score'];
           }
           $AV_rating = $t_rat / $N_O_R;
   
       }

    }
    else{
        $error['status'] = 505;
        $error['msg'] = "Invalid Data";
    
    }

}
else{
    $error['status'] = 506;
    $error['msg'] = "Invalid Request";
}

json_encode($error);

?>

<div class="r-al-b">Overall Rating :- <span><?php echo @$AV_rating; ?></span></div>
<div class="r-al-b">Total Ratings :- <span><?php echo @$N_O_R; ?></span></div>