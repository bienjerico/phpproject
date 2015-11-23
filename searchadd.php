<?php 
session_start();

/* if session logged in is empty or 0 , redirect to index.php */
if(empty($_SESSION['logged_in']) || $_SESSION['logged_in']==0){
	header("location: index.php");
	exit();
}

include 'config/db.php';


$user_id = $_SESSION['user_id'];
$search_id = strtolower($_GET['search_id']);
$search_name = strtolower($_GET['search_name']);

$query_cnt 	= "SELECT count(*) as cnt FROM users_friends WHERE user_id = '$user_id' and friend_id = '$search_id' LIMIT 1";
$result_cnt = mysqli_query($db,$query_cnt);
$row_cnt	= mysqli_fetch_assoc($result_cnt);
$cnt 		= $row_cnt['cnt'];

$message = "";

if($cnt==0){

    $query = "INSERT INTO users_friends (`user_id`,`friend_id`,`requested_at`,`created_at`) VALUES ('$user_id','$search_id',now(),now())";
    mysqli_query($db,$query);
    $id = mysqli_insert_id($db);

    if(!empty($id) && $id>0){
        $message = "Successfully Added.";
    }else{
        $message = "Something is Wrong.";
    }
}else{
    $message = "Already Added.";
}
?>


<br/>
<a href="logout.php">Logout</a>
<br/>


<a href="home.php">HOME</a>
<a href="profile.php">PROFILE</a>
<form method="get" action="search.php">
Search Name: <input type="text" id="search_name" name="search_name" value="<?php echo $_GET['search_name']; ?>"> <button type="submit">Find</button>
</form>


<?php echo $message; ?>
<!--<a href="search.php?search_name=<?php echo $search_name; ?>"><button>Back to Search</button></a>-->