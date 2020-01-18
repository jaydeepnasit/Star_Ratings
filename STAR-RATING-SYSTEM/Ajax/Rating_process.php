<?php

session_start();

require_once '../Config/Functions.php';
$Fun_call = new Functions();

$json_arr = array();

if(!isset($_SESSION['user_name']) && !isset($_SESSION['user_uni_no'])){
    header('Location:../index.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if((isset($_POST['blog_no']) && is_numeric($_POST['blog_no'])) && (isset($_POST['user_no']) && is_numeric($_POST['user_no'])) && (isset($_POST['rating']) && is_numeric($_POST['rating']) && ($_POST['rating'] >= 0 && $_POST['rating'] <= 5))){

        $blog_no = $Fun_call->validate($_POST['blog_no']);
        $user_no = $Fun_call->validate($_POST['user_no']);
        $rating = $Fun_call->validate($_POST['rating']);

        $condition['ur_u_uni_no'] = $user_no;
        $condition['ur_b_uni_no'] = $blog_no;

        $check_rec = $Fun_call->select_assoc('user_rating', $condition);

        if($check_rec){

            $field_data['ur_u_uni_no'] = $user_no;
            $field_data['ur_b_uni_no'] = $blog_no;
            $field_data['ur_score'] = $rating;

            $update_rec = $Fun_call->update('user_rating', $field_data, $condition);

            if($update_rec){

                $json_arr['status'] = 401;
                $json_arr['msg'] = 'Rating Updated';

            }
            else{

                $json_arr['status'] = 402;
                $json_arr['msg'] = 'Updation Failed';

            }

        }
        else{

            $field_data['ur_u_uni_no'] = $user_no;
            $field_data['ur_b_uni_no'] = $blog_no;
            $field_data['ur_score'] = $rating;
            $field_data['ur_uni_no'] = rand(1000000000000000, 10000000000000000);

            $Rating_ins = $Fun_call->insert('user_rating', $field_data);

            if($Rating_ins){

                $json_arr['status'] = 403;
                $json_arr['msg'] = 'Rating Inserted';

            }
            else{

                $json_arr['status'] = 404;
                $json_arr['msg'] = 'Insert Faild';

            }
            

        }

    }
    else{

        if(!(isset($_POST['blog_no']) && is_numeric($_POST['blog_no']))){

            $json_arr['status'] = 405;
            $json_arr['msg'] = 'Invalid Blog Data';
            
        }
        if(!(isset($_POST['user_no']) && is_numeric($_POST['user_no']))){

            $json_arr['status'] = 406;
            $json_arr['msg'] = 'Invalid User Data';
            
        }
        if(!(isset($_POST['rating']) && is_numeric($_POST['rating']) && ($_POST['rating'] >= 0 && $_POST['rating'] <= 5))){
   
            $json_arr['status'] = 407;
            $json_arr['msg'] = 'Invalid Rating';

        }

    }

}
else{

    $json_arr['status'] = 408;
    $json_arr['msg'] = 'Invalid Request';

}

echo json_encode($json_arr);

?>

