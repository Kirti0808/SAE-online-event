<?php
require 'includes/common.php';
$uid=$_SESSION['id'];
$sel="Select submit1 from users where id='$uid'";
$sel_res=mysqli_query($con,$sel) or die(mysqli_error($con));
$arr=mysqli_fetch_array($sel_res);
if($arr[0]==1)
    header('Location:../index.php');

?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
 <title>ROADRANGERS</title>

  
  
  
      <link rel="stylesheet" href="css2/style.css">
       <script src="auto_submit.js"></script>
     <style>
.button {
    background-color: #008CBA; /* Green */
    border: none;
    color: white;
    padding: 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}

.button1 {border-radius: 2px;}
.button2 {border-radius: 4px;}
.button3 {border-radius: 8px;}
.button4 {border-radius: 12px;}
.button5 {border-radius: 50%;}
</style>

  
</head>
<body>
   
	 <div>
             <button class="button button3" onclick="location.href='shop.php'">Find items</button>
          
    <table>			
        <thead>
        <tr>
								<th>Item Number</th>
								<th >Item Name</th>
								<th>Type</th>
								<th>Cost</th>
                                                                <th></th>
        </tr>
                                            </thead>
                                            <tbody>
							
						
                                                             <?php
 $user_id=$_SESSION['id'];
    $select_query="Select * from items_users where userid='$user_id'";
    $select_query_1="Select * from items i inner join items_users iu on i.id=iu.itemid where userid='$user_id'";
    $select_query_2="Select *from users u inner join items_users iu on u.id=iu.userid";
    $select_query_res=mysqli_query($con,$select_query_1) or die(mysqli_error($con));
    $no_of_rows= mysqli_num_rows($select_query_res);
    if($no_of_rows==0)
    {
        ?>
        <br />
        <br />
        <?php
        echo "<h3>Add items to list first</h3>";
    }
    else{
        $sum=0;
        $c=0;
       
        while($row= mysqli_fetch_array($select_query_res))
    {
        $sum=$sum+$row[3];
        
        $c+=1;
        ?>
								<tr>
									<td><?php echo $c; ?></td>
                                                                    <td><?php echo $row[1]; ?></td>
									<td><?php echo $row[2];   ?></td>
                                                                        <td><?php echo $row[3]; ?></td>
    <td>Confirmed!</td><?php } ?>
								</tr>
                                                                <tr>
									<td></td>
									<td></td>
									<td>Total</td>
									<td><?php echo $sum; } ?></td>
                                                                        
                                                                          
                                                                        
               
                                                                </tr>
                   
					</tbody>
    </table>
      
    <?php
       
        $upd="Update users set points1='$r' where id='$user_id'";
        $upd_q=mysqli_query($con,$upd) or die(mysqli_error($con));
         $sel="Select totalpoints,points1,points2,points3,points4,balance,submit1 from users where id='$user_id'";
        $sel_res=mysqli_query($con,$sel) or die(mysqli_error($con));
        $arr=mysqli_fetch_array($sel_res);
        $balance=$arr[5];
        $tp=$arr[1]+$arr[2]+$arr[3]+$arr[4];
        $upd="Update users set totalpoints='$tp' where id='$user_id'";
        $upd_q=mysqli_query($con,$upd) or die(mysqli_error($con));
        if($arr['submit1']==0){
        $upd="Update users set bal1='$balance' where id='$user_id'";
        $upd_q=mysqli_query($con,$upd) or die(mysqli_error($con));}
         $upd="Update users set submit1='1' where id='$user_id'";
        $upd_q=mysqli_query($con,$upd) or die(mysqli_error($con));
        ?>
         <?php
       
         $sel="Select * from users order by points1 desc";
         $sel_q=mysqli_query($con,$sel) or die(mysqli_error($con));
         $uid=$_SESSION['id'];
        
         $i=1;
         $k=0;
         
         $sel1="Select balance,bal1 from users where id='$uid'";
                     $sel_q1=mysqli_query($con,$sel1) or die(mysqli_error($con));
                     $arr=mysqli_fetch_array($sel_q1);
         while($row=mysqli_fetch_array($sel_q))
         {
             
             
                 if($_SESSION['id']==$row['id']){
                     $k=1;
                     $sel="Select balance,bal1 from users where id='$uid'";
                     $sel_q=mysqli_query($con,$sel) or die(mysqli_error($con));
                     $arr=mysqli_fetch_array($sel_q);
                     if($i==1){
                        $bal=$arr[1]+25;
                        break;
                     }
                     else if($i==2){
                         $bal=$arr[1]+20;
                         break;
                     }
                    
                 }
                 $i+=1;
         }
                     $upd="Update users set balance='$bal' where id='$uid'";
                     $upd_q=mysqli_query($con,$upd) or die(mysqli_error($con));
                     
                    
                 ?>
        
        <button class="button button3" onclick="location.href='../round2/shop2.php'">Round 2</button>
    </body>
  </html>
  
  
