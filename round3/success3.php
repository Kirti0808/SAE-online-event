<?php
require 'includes/common.php';
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Responsive Table</title>
  
  
  
      <link rel="stylesheet" href="css2/style.css">
      <script>
      (function(window, location) {
history.replaceState(null, document.title, location.pathname+"#!/history");
history.pushState(null, document.title, location.pathname);

window.addEventListener("popstate", function() {
  if(location.hash === "#!/history") {
    history.replaceState(null, document.title, location.pathname);
    setTimeout(function(){
      location.replace("../index.php");
    },0);
  }
}, false);
}(window, location));
</script>
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
        $r=0;
       
        while($row= mysqli_fetch_array($select_query_res))
    {
            $sum=$sum+$row[3];
        $r=$r+$row['rating3'];
        
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
      <h3 class="text-danger">Your rating for this round is: <?php echo $r; ?></h3>
        <?php
       
        $upd="Update users set points3='$r' where id='$user_id'";
        $upd_q=mysqli_query($con,$upd) or die(mysqli_error($con));
         $sel="Select totalpoints,points1,points2,points3,points4,balance,submit3 from users where id='$user_id'";
        $sel_res=mysqli_query($con,$sel) or die(mysqli_error($con));
        $arr=mysqli_fetch_array($sel_res);
        $balance=$arr[5];
        $tp=$arr[1]+$arr[2]+$arr[3]+$arr[4];
        $upd="Update users set totalpoints='$tp' where id='$user_id'";
        $upd_q=mysqli_query($con,$upd) or die(mysqli_error($con));
        if($arr['submit3']==0){
        $upd="Update users set bal3='$balance' where id='$user_id'";
        $upd_q=mysqli_query($con,$upd) or die(mysqli_error($con));}
         $upd="Update users set submit3='1' where id='$user_id'";
        $upd_q=mysqli_query($con,$upd) or die(mysqli_error($con));
        ?>
        <?php
         $sel="Select * from users order by totalpoints desc";
         $sel_q=mysqli_query($con,$sel) or die(mysqli_error($con));
         $uid=$_SESSION['id'];
        
         $i=0;
         $k=0;
         while($row=mysqli_fetch_array($sel_q))
         {
             
             if($i==3)
                 break;
             else{
                 if($_SESSION['id']==$row['id']){
                     $k=1;
                 ?>
         
      <div class="container">
         <div class="jumbotron">
             <h3 class="text-danger">Congratulations! You've qualified for next round! </h3>
             <?php
             $upd="Update users set qual3=1 where id='$uid'";
         $upd_q=mysqli_query($con,$upd) or die(mysqli_error($con));
         ?>
             <button class="button button3" onclick="location.href='../round4/shop4.php'">Round 4</button>
         </div>
         <?php 
                break;
             }
             $i+=1;
             }
             
         }
         ?>
<?php         if($k!=1){
    ?>
      </div>
         <div class="container">
         <div class="jumbotron" >
        <h3 class="text-danger">
            Sorry! You've been eliminated!
        </h3>
</div>
         <?php
}
         ?>
    </div>
        
        
        </div>
     <?php
       
         $sel="Select * from users order by points3 desc";
         $sel_q=mysqli_query($con,$sel) or die(mysqli_error($con));
         $uid=$_SESSION['id'];
        
         $i=1;
         $k=0;
          $sel1="Select balance,bal3 from users where id='$uid'";
                     $sel_q1=mysqli_query($con,$sel1) or die(mysqli_error($con));
                     $arr=mysqli_fetch_array($sel_q1);
         $bal=$arr[0];
         while($row=mysqli_fetch_array($sel_q))
         {
             
             
                 if($_SESSION['id']==$row['id']){
                     $k=1;
                     $sel="Select balance,bal3 from users where id='$uid'";
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
        
    </body>
  </html>