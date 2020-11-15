<?php  ob_start(); session_start(); 
header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', '1');
 ?>

  <head>
   	<meta name="viewport" content="width=1480">
    <meta http-equiv="Content-Type" content="text/html; charset="utf-8">
    <link href="default.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="default_print.css" rel="stylesheet" type="text/css" media="print"/>
    <script src="js/jquery-2.1.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/jquery-ui-1.10.4.custom.js" type="text/javascript" charset="utf-8"></script>
    <link href="jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css" />
 		<style type="text/css">
		  .ui-datepicker-div, .ui-datepicker-inline, #ui-datepicker-div {font-size:0.7em}
		  .ui-datepicker {margin-left:70px;}
		  .ui-widget {font-size:12px;border-radius:0;}
  	</style>

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-5552245-8"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-5552245-8');
		</script>
   
	
  <script language="javascript" type="text/javascript">
  function deletechecked(){
        var answer = confirm("Really Delete")
        if (answer){
            document.messages.submit();
        }
        return false;  
    }
    </script>
		<script type="text/javascript">
              
      $(document).ready(function() {	
      	
      	$(".datepicker").datepicker({ 
          dateFormat: 'yy-mm-dd',
          changeMonth: true,
    			changeYear: true,
    			showButtonPanel: true,
          yearRange: "-20:+20",
          onSelect: function (dateText, inst) {
    				$(this).closest('form').submit();
    			}
          
           });
          
       
          
        $('.edit').click(
			    function() {
			    	openForm=$(this).parent(this).parent(this).next('.individual_edit');
			      $(openForm).toggle(500);
			    }
			  );
			});
      		        /*
			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	 				window.location.assign("m.index.php");
			}
                         */
    </script>
    <?php
    //checklogin();
    $action = 'res';
    $selected_date = '';
    $selected_date_old = '';
    $food = '';
    $person = '';
    $comments = '';
    $delete = '';
    $id = '';
    
    $edit = 'y';
    foreach ($_REQUEST as $param_name => $param_val) {
		if($param_name == "PHPSESSID"){continue;}
    $$param_name = $param_val;
		} 
 
    include_once("functions.php");
    include_once("functions_connect.php");
   
    if($selected_date_old <> ''){$selected_date = $selected_date_old;}
     
   
    ?>
    <body id="outer" style="background-color: <?=$background;?>;">
    
    <?php
    //------------------------ Choose an action ---------------------
    /*
    if($action == ''){
		     	?>
		     	<div style="margin:20px 0 0 20px;">
				     	<a href="?action=res&edit=y" class="button">Restaurant List</a>
				     	
				     	<a href="?action=lunch_order" class="button">Lunch Order</a>
		    	</div>
		     	<?php
		     	
		    }
		  */
    //--------------------------------- Luch order --------------------------------
    if($action=='lunch_order'){
				    	?>
				    
				    <title>Lunch Order</title>
				    <div style="margin:20px 0 0 20px;">
				     	<a href="?action=res&edit=y" class="button">Restaurant List</a>
				     	
				     	<a href="?action=lunch_order" class="button_green">Lunch Order</a>
		    		</div>
				    
				    <?php
				    $db = connect_pdo();$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				    
				      
				    $nowdate=date('Y-m-d');
				    //echo "selected_date=".$selected_date."<br>";
				    if($selected_date == ''){$selected_date = $nowdate;}
				    
				    ?>
				    
				    <!-- Selecte a date -->
				    <form method="post" action="index.php?action=lunch_order" style="margin:10px;">
				    	<div style="float:left;width:300px;">
						    	<h2 style="display:inline;">Selected Date</h2><br>
						    	<input class="datepicker" type="text" name="selected_date" value="<?=$selected_date;?>" onChange="this.form.submit();" style="width:100px;">
						  </div>
				   
						   <div style="float:left;margin-left:30px;" class="screen_only">
						   		<h2 style="display:inline;">Old Dates</h2><br>
						   		<select name="selected_date_old"  onChange="this.form.submit();">
						   			<option></option>
						   			<?php
						   			if($selected_date_old <> ''){
						   				?>
						   				<option value="<?=$selected_date_old;?>" selected='selected'><?=$selected_date_old;?></option>
						   				<?php
						   			}
						   		
						   				$sql = "SELECT * FROM lunch_order group by date";
									    $stmt = $db->query($sql);
									    $rows = $stmt->fetchAll();
									    foreach($rows as $row){
									    		?> <option value='<?php echo $row['date'];?>'><?=$row['date'];?></option>
									    		<?php	
									    }
									    ?>
						   		</select>
						  </div>
					  	<div style="float:left;width:150px;margin-top:18px;margin-left:150px;">
					   		
					   		<span class="button screen_only" title="Print the List" onClick="window.print()" style="font-size:16px;">Print List</span>
					    </div>
					    
				  		<div class="clear"></div>
				  	</form>
				   
				    <!-- Add an entry -->
				    <form method="post" action="lunch_finish.php?action=add_lunch_order" style="margin:5px 5px 5px 10px;border:1px solid black;padding:10px;width:670px;" class="screen_only" autocomplete="off">
				    	<h2>Add an entry</h2>
				    	<span style="margin-left:10px;">Name</span><span style="margin-left:160px;">Food Order</span><span style="margin-left:130px;">Comments</span><br>
				    	<input type="text" name="person" style="width:100px;" autocomplete="off">
				    	<input name="food" style="margin-left:10px;width:280px;">
				    	<input name="comments" style="margin-left:10px;">
				    	<input type="submit" value="Enter" style="margin-left:10px;">
				    	<input type="hidden" name="selected_date" value="<?=$selected_date;?>">
				    </form>
				    
		    		<!-- table with list -->
				    <table  class="food_table">
				    	<tr>
				    			<th style="width:150px;">Name</th>
						    	<th style="width:180px;">Food Order</th>
						    	<th style="width:250px;">Comments</th>
						    	<th></th>
						    	<th></th>
				    	</tr>
				    	<?php
				     	$sql = "SELECT * FROM lunch_order where date='$selected_date'";
					    $stmt = $db->query($sql);
					    $rows = $stmt->fetchAll();
					    if($rows){
							    foreach($rows as $row){
								  ?>
								  	<tr>
								  		
									    	<td><?=$row['person'];?></td>
									    	<td><?=$row['food'];?></td>
									    	<td><?=$row['comments'];?></td>
									    	<td><span class="edit button screen_only" title="Edit this entry">Edit</span></td>
									    	<td><span class="button_red screen_only" title="Delete this entry"><a href="lunch_finish.php?action=delete_lunch_order&id=<?=$row['id'];?>&selected_date=<?=$selected_date;?>" onClick="return deletechecked();">Del</a></span></td>
									   
												
										
							 	 </tr>
							 	 <tr class="individual_edit">
							 	 	<td colspan="5" style="padding-top:10px;">
							 	 			<form class="individual_item_form" method="post" action="lunch_finish.php?action=update_lunch" autocomplete="off">
								    	
									    	<input type="text" name="person" style="width:150px;" value="<?=$row['person'];?>">
									    	<input type="text" name="food" style="width:280px;" value="<?=$row['food'];?>">
									    	<input type="text" name="comments" value="<?=$row['comments'];?>">
									    	<input type="hidden" name="selected_date" value="<?=$row['date'];?>">
												<input type="hidden" name="id" value="<?=$row['id'];?>">
												<input type="submit" value="Enter">
										   
							 	 		</form>
							 	 	</td>
							 	</tr>
						   	<?php
						    
						  	}
						 }
				     else {
				     ?>
				     <span>No entries for selected date</span>	
				     <?php
				    }
				   	?>
				 		</table>
						
				 		<?php  
				    
				    
				      
				}
				//------------------------- pick a restaurant -----------------------------
				
				//echo "action=".$action." edit=".$edit;
				if($action == 'res' ){
						?>
						<div style="margin:20px 0 0 20px;">
				     	<a href="?action=res&edit=y" class="button_green">Restaurant List</a>
				     	
				     	<a href="?action=lunch_order" class="button">Lunch Order</a>
		    	</div>
		    	<?php
						//------ edit list ---------
						if($edit == 'y'){
							?>
							<!-- Add an entry -->
				    <form method="post" action="lunch_finish.php?action=add_res" style="margin:5px 5px 5px 10px;border:1px solid black;padding:10px;width:670px;" class="screen_only">
				    	<h2>Add an entry</h2>
				    	<span style="margin-left:10px;">Restaurant</span><br>
				    	<input autocomplete="off" type="text" name="res">
				    	
				    	<input type="submit" value="Enter" style="margin-left:10px;">
				    	
				    </form>
				    Green background = Chosen for today
		    		<!-- table with list -->
				    <table  class="food_table">
				    	<tr>
				    			<th style="width:150px;">Restaurant</th>
						    	<th>Days</th>
						    	<th></th>
						    	<th></th>
						    	<th></th>
						    	<th>Menu</th>
						    	<th></th>
				    	</tr>
				    	<?php
				    	$db = connect_pdo();$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				     	$sql = "SELECT * FROM restaurant order by res";
					    $stmt = $db->query($sql);
					    $rows = $stmt->fetchAll();
					    if($rows){
							    foreach($rows as $row){
								  ?>
								  	<tr>
								  			<?php if (check_if_today($row['id'])){$background = "#52DC6A";}else{$background = '';} ?>
									    	<td style="background:<?=$background;?>;"><?=$row['res'];?></td>
									    	<td style="text-align:center;"><?=days_since($row['id']);?></td>
									    	<td><a class="edit button screen_only" title="Choose for today" href="lunch_finish.php?action=choose&res_id=<?=$row['id'];?>">Choose Today</a></td>
									    	<td><a class="edit button screen_only" title="Remove Chosen for today" href="lunch_finish.php?action=unchoose&res_id=<?=$row['id'];?>">UnChoose</a></td>
									    	<td><span class="edit button screen_only" title="Edit this entry">Edit</span></td>
									    	<td><?php if($row['menu'] != ''){?><a class="button screen_only" title="Menu Link" href="<?=$row['menu'];?>" target="_blank">Menu</a><?php }?></td>
									    	<td><span class="button_red screen_only" title="Delete this entry"><a href="lunch_finish.php?action=delete_res&id=<?=$row['id'];?>" onClick="return deletechecked();">Del</a></span></td>
									   
												
										
							 	 </tr>
							 	 <tr class="individual_edit">
							 	 	<td colspan="5" style="padding-top:10px;">
							 	 			<form class="individual_item_form" method="post" action="lunch_finish.php?action=update_res" autocomplete="off">
								    	
									    	<input type="text" name="res" value="<?=$row['res'];?>">
									    	
												<input type="hidden" name="id" value="<?=$row['id'];?>">
												<input type="submit" value="Change Name">
												
											</form>
											<form method="post" action="lunch_finish.php?action=add_res_record&res_id=<?=$row['id'];?>"  style="display:inline;">
													<input type="text" name="date_chosen" class="datepicker" style="width:100px;" autocomplete="off">
													<input type="submit" value="Add a date">
											</form>
											<form method="post" action="lunch_finish.php?action=add_menu&res_id=<?=$row['id'];?>" style="display:inline;">
													<input type="text" value="<?=$row['menu'];?>" name="menu"  style="width:200px;" autocomplete="off">
													<input type="submit" value="Add Menu Link">
											</form>
											<br>
												<?php 
												$res_id = $row['id'];
												$sql="SELECT * from restaurant_record where res_id = '$res_id'";
												$stmt = $db->query($sql);
					    					$rows_rec = $stmt->fetchAll();
					    					if($rows_rec){
					    					?>	
					    					<!-- edit past dates -->
					    					Past Dates<br>				    						
												<table>
													<?php
													foreach($rows_rec as $row_rec){?>
													<tr>
														<td>
															<form method="post" action="lunch_finish.php?action=edit_rest_record&id=<?=$row_rec['id'];?>" style="margin:0;">
																<input class="datepicker" type="text" name="date_chosen" value="<?=$row_rec['date_chosen'];?>" style="width:100px;">
															</form>
														</td>
														<td><span class="button_red screen_only" title="Delete this entry"><a href="lunch_finish.php?action=delete_res_record&id=<?=$row_rec['id'];?>" onClick="return deletechecked();">Del</a></span></td>
									   
													</tr>
												<?php }
												?>
												</table>
												<?php
											}
											?>
										   
							 	 		
							 	 	</td>
							 	</tr>
						   	<?php
						    
						  	}
						  	?>
								</table>
								<br>
								<a href="?action=res&edit=" class="button" style="font-size:16px;margin-left:10px;">Choose Random Resaurant</a>
								<?php
						}
							
						}
						//--------- show random restaurant ----
						else {
								?>
								
								<div style="margin:50px 0 0 50px;">
										<h2>Randomly Selected restaurant</h2><br>			
									
								<?php
							 //$date_spread = ( strtotime(date("Y-m-d"))- strtotime($row['date']) ) / 86400;
								$db = connect_pdo();$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$sql = "SELECT * FROM restaurant order by RAND() limit 1";
									    $stmt = $db->query($sql);
									    $rows = $stmt->fetchAll();
									    if($rows){
											    $row = $rows[0];
											    ?>
											    <div style="font-weight:bold;font-size:31px;color:green;"><?=$row['res'];?></div>
											<?php    
											}
											    	
											    	
									
									
								
				    		?>
				    		<br><br>
				       	<a href="" class="button" style="font-size:16px;">Try again</a>	 
				       	<a href="lunch_finish.php?action=choose_res&res_id=<?=$row['id'];?>" class="button" style="font-size:22px;margin-left:40px;background:#52DC6A;">Choose this for today</a>	     
		      		</div>
		      		<?php
		      		
		      	}
		      	
		     }
		     
		     
		     
		     function check_if_today($res){
		     		$nowdate=date('Y-m-d');
		     		$db = connect_pdo();$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$sql = "SELECT * FROM restaurant_record where res_id = '$res' and date_chosen = '$nowdate'";
						$stmt = $db->query($sql);
						$rows = $stmt->fetchAll();
						if($rows){return true;}
						else{return false;}
		     	
		    }
		    function days_since($res){
		    		$nowdate=date('Y-m-d');
		     		$db = connect_pdo();$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$sql = "SELECT * FROM restaurant_record where res_id = '$res' order by date_chosen DESC limit 1";
						$stmt = $db->query($sql);
						$rows = $stmt->fetchAll();
						if($rows){
							$row = $rows[0];
							$date_chosen  = strtotime($row['date_chosen']);
							$date_chosen_array = explode('-',$row['date_chosen']);
							$date_chosen = gregoriantojd($date_chosen_array[1],$date_chosen_array[2],$date_chosen_array[0]);
							$now = gregoriantojd(date('m'),date('d'),date('Y')); 
							
							
							$datediff = $now - $date_chosen;
							
							//return round($datediff / (60 * 60 * 24));
							return $datediff;
							
						}
						else return 0;
		    	
		    	
		    }
		    function checklogin() {

       if ($_SESSION['lunch_logged_in'] != "true") { echo "Not logged in";	header("Location: login.php"); }

       return ; 

}
		    
		      		?>  
      		      
      



   </body>
   </html>
