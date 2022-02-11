<?php session_start(); 
require_once('connection.php');
require_once('header.php');

#print_r($_SESSION);

if(isset($_POST['create_offer']) && $_POST['create_offer'] == 'yes')
{ 
    $user_id = $_POST['user_id']; 
    $offer_amount = $_POST['offer_amount']; 
    $start_date = $_POST['start_date']; 
    $offered_date = $_POST['offered_date']; 
    $comments = $_POST['comments']; 
    $offered_by  = $_SESSION['user_id']; 
 
    #echo '<pre>'; print_r($_POST); die();

    if($_POST['action'] == 'Add')
    {
      $sql = "INSERT INTO offers (user_id, offer_amount, start_date, offered_date, comments, offered_by) VALUES ($user_id, '$offer_amount', $start_date, $offered_date, '$comments', $offered_by)";

      $res = mysqli_query($link, $sql); 
       $_SESSION['success'] = 'Offer Added Success'; 
       header('Location: list_offers.php');


    }
    elseif($_POST['action'] == 'Edit')
    {
      $offer_id = $_POST['offer_id'];
        $sql = "UPDATE offers SET user_id = '".  $user_id ."',  offer_amount = '".  $offer_amount ."',  start_date = '".  $start_date ."',  offered_by = '".  $offered_by ."',  offered_date = '".  $offered_date ."',  comments = '".  $comments ."'  WHERE offer_id = ". $offer_id;
        mysqli_query($link, $sql);
       $_SESSION['success'] = 'Offer Updated Success'; 
       header('Location: list_offers.php');
    }
    
}
elseif(isset($_GET['action']) && $_GET['action'] == 'edit' && $_SESSION['is_admin'] == 'Y')
{
  $offer_id = $_GET['id'];

  $sql = "SELECT offer_id, user_id, offer_amount, comments, start_date, offered_date FROM offers WHERE offer_id = " . $offer_id;

  if ($res = mysqli_query($link, $sql)) 
  {
    if (mysqli_num_rows($res) > 0) 
    {  
        $row = mysqli_fetch_array($res, MYSQLI_ASSOC); 
        //echo '<pre>'; print_r($row); die();
    }
  }
  $action = 'Edit';
  $action_label = 'Update Offer';
}
else
{
  
    $row['offer_id'] = '';
    $row['user_id'] = '';
    $row['offer_amount'] = '';
    $row['comments'] = '';
    $row['start_date'] = '';
    $row['offered_date'] = ''; 
    $action = 'Add';
$action_label = 'Add Offer';
}





$sql = "SELECT user_id, full_name FROM users WHERE is_admin = 'N'";
if ($res = mysqli_query($link, $sql)) 
{
    if (mysqli_num_rows($res) > 0) 
    { 
        $users = mysqli_fetch_all($res, MYSQLI_ASSOC); 
        #echo '<pre>'; print_r($users); die();
    }
    else 
    {
        $_SESSION['error'] = 'First Add Users';
        header('Location: index.php');
    }
}
else 
{
    die("ERROR: Could not able to execute $sql. " .mysqli_error($link));
}  
?>  
 

 <form action="create_offer.php" method="POST">
 	<input type="hidden" name="create_offer" value="yes"> 
  <input type="hidden" name="action" value="<?php echo $action; ?>">
  <input type="hidden" name="offer_id" value="<?php echo $row['offer_id']; ?>">

  <div class="mb-3">
    <label for="offer_amount" class="form-label">Offer For</label>
    <select name="user_id">
      <?php 
    foreach($users as $key => $user)
    { 
      $selected = '';
      if($user['user_id'] == $row['user_id']) $selected = 'selected="selected"';
      ?>
      <option value="<?php echo $user['user_id'];?>" <?php echo $selected;?>><?php echo $user['full_name'];?></option><?php
        }
        ?>
    </select>
  </div>


  <div class="mb-3">
    <label for="offer_amount" class="form-label">Offer Amount</label>
    <input type="text" name="offer_amount" class="form-control" id="offer_amount" aria-describedby="" value="<?=$row['offer_amount'];?>" required> 
  </div>
  
  <div class="mb-3">
    <label for="start_date" class="form-label">Offer Start Date</label>
    <input type="date" name="start_date" class="form-control" id="start_date" aria-describedby="" value="<?=$row['start_date'];?>" required> 
  </div>
  
  <div class="mb-3">
    <label for="offered_date" class="form-label">Offered Date</label>
    <input type="date" name="offered_date" class="form-control" id="offered_date" aria-describedby="" value="<?=$row['offered_date'];?>" required> 
  </div>
  
  <div class="mb-3">
    <label for="comments" class="form-label">Comments</label>
    <textarea name="comments" class="form-control" id="comments" rows="3" cols="3"><?=$row['comments'];?></textarea> 
  </div>

  <button type="submit" class="btn btn-primary"><?php echo $action_label; ?></button>
</form> 
<?php require_once('footer.php'); ?>

