<?php session_start();
require_once('login_check.php');
require_once('connection.php');



if(isset($_POST['decline_selected']) && $_POST['decline_selected'] == 'decline_selected' && $_SESSION['is_admin'] == 'Y')
{
    #echo '<pre>'; print_r($_POST); #die();
    $status = "Declined";
    $offer_ids_selected = implode(',', $_POST['offer_ids_selected']);

    // We can also check if id is present and also offer given to logged in user for url tampering
    #echo 
    $sql = "UPDATE offers SET offer_status = '".  $status ."' WHERE offer_id IN (". $offer_ids_selected .")"; #die();
    mysqli_query($link, $sql);
    $_SESSION['success'] = 'Offer Updated Success'; 

}



if(isset($_GET['action']) && $_GET['action'] == 'delete' && $_SESSION['is_admin'] == 'Y')
{
  $offer_id = $_GET['id'];

  $sql = "DELETE FROM offers WHERE offer_id = " . $offer_id; 
  $res = mysqli_query($link, $sql);


       $_SESSION['success'] = 'Offer Deleted Success'; 
       //header('Location: list_offers.php');
  
}


if($_SESSION['is_admin'] == 'N')
{
  // Note a lot of checks and validations required here for core php like numeric id check, url tampering, 
  if(isset($_GET['id']) && !empty($_GET['id']))
  {
    $status = $_GET['action'];
    // We can also check if id is present and also offer given to logged in user for url tampering
    $sql = "UPDATE offers SET offer_status = '".  $status ."' WHERE offer_id = ". $_GET['id'];
    mysqli_query($link, $sql);
    $_SESSION['success'] = 'Offer Updated Success'; 
  }
}


$conditions = " 1 = 1 ";

if($_SESSION['is_admin'] == 'N')
{
    $conditions .= " AND u1.user_id = " . $_SESSION['user_id'];
}

$sql = "SELECT u1.full_name, u2.full_name AS offered_by_user, offer_id, offer_amount, comments, start_date, offer_status, offered_date FROM offers AS o INNER JOIN users AS u1 ON o.user_id = u1.user_id INNER JOIN users AS u2 ON o.offered_by = u2.user_id WHERE " . $conditions;

if ($res = mysqli_query($link, $sql)) 
{
    if (mysqli_num_rows($res) > 0) 
    { 
        $dataFound = TRUE;
        $row = mysqli_fetch_all($res, MYSQLI_ASSOC); 

        #echo '<pre>'; print_r($row); die();
         
        //mysqli_free_res($res); 
    }
    else 
    {
      $dataFound = FALSE;
      $_SESSION['error'] = 'There are no records found'; 
    }
}
else 
{
    $_SESSION['error'] = "ERROR: Could not able to execute $sql. " .mysqli_error($link); 
    header('Location: index.php');
}
mysqli_close($link);
require_once('header.php');
if($dataFound === TRUE)
 ?>  

<form action="list_offers.php" method="POST">
<table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Offer Amount</th>
      <th scope="col">Offered By</th>
      <th scope="col">Comments</th>
      <th scope="col">Offered Date</th>
      <th scope="col">Offer Start Date</th>
      <th scope="col">Status</th> 
      <th scope="col" colspan="2">Action</th> 
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 0;
    foreach($row as $key => $data)
    {
      $i++;
      ?>
      <tr>
        <th>
          <?php
        if($data['offer_status'] != 'Declined' && $_SESSION['is_admin'] == 'Y') {
        ?>

          <input class="form-check-input" type="checkbox" value="<?=$data['offer_id'];?>" id="offer_ids_selected" name="offer_ids_selected[]"><?php
        }
        ?></th>
        <th scope="row"><?=$i;?></th>
        <td><?=$data['full_name'];?></td> 
        <td><?=$data['offer_amount'];?></td> 
        <td><?=$data['offered_by_user'];?></td> 
        <td><?=$data['comments'];?></td> 
        <td><?=$data['offered_date'];?></td> 
        <td><?=$data['start_date'];?></td> 
        <td><?=$data['offer_status'];?></td> 
        <?php
        if($data['offer_status'] == 'Open' && $_SESSION['is_admin'] == 'N') {
        ?>
        <td><a href="list_offers.php?id=<?=$data['offer_id'];?>&action=Accepted" class="btn btn-primary">Accept</a></td>
        <td><a href="list_offers.php?id=<?=$data['offer_id'];?>&action=Declined" class="btn btn-danger">Decline</a></td>
        <?php
        }
        elseif($_SESSION['is_admin'] == 'Y') {
          ?>
        <td><a href="create_offer.php?id=<?=$data['offer_id'];?>&action=edit" class="btn btn-primary">Edit</a></td>
        <td><a href="list_offers.php?id=<?=$data['offer_id'];?>&action=delete" class="btn btn-danger">Delete</a></td>
        <?php
        }
        ?>
      </tr>
      <?php
    }
    ?> 
  </tbody>
</table>

<?php
        if($data['offer_status'] != 'Declined' && $_SESSION['is_admin'] == 'Y') {
        ?>

          <div class="col-12">
    <button type="submit" class="btn btn-primary" name="decline_selected" value="decline_selected">Decline Selected</button>
  </div> <?php
        }
        ?>

        

</form>
<?php require_once('footer.php'); ?>

