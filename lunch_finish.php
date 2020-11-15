<?php ob_start(); 
error_reporting( error_reporting() & ~E_NOTICE );
error_reporting(E_ALL);
include_once("functions.php");
    include_once("functions_connect.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<link href="default.css" rel="stylesheet" type="text/css" media="screen"/>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-5552245-8"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-5552245-8');
	</script>
	<?php

// Convert all post and get data 
foreach ($_REQUEST as $param_name => $param_val) {
		if($param_name == "PHPSESSID"){continue;}
    $$param_name = $param_val;
}
$ip=$_SERVER['HTTP_CLIENT_IP']." ".$_SERVER['REMOTE_ADDR']." localip=".$_SERVER['HTTP_X_FORWARDED_FOR'];;
$txt = print_r($_REQUEST, true)." ".date('m/d/Y')." ipaddress=".$ip;
$myfile = file_put_contents('request_dump_logs.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
print "<pre>";
      print_r($_REQUEST);
      print "</pre>";

  switch ($action){
  	  //---------------------------------------------- add lunch order -------------------------------------------
  		case "add_lunch_order":
  		
  				    $db = connect_pdo();$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				    
				    	$sql = "INSERT INTO lunch_order (date,food,person,comments) VALUES (:date, :food, :person, :comments)";
						  $stmt = $db->prepare($sql) ;
							$stmt->execute(array(
											'date' => $selected_date,
							        'food' => $food,
							        'person' => $person,
							        'comments' => $comments
							
							    ));
					header("Location: index.php?action=lunch_order&selected_date=$date");
          exit;
      break;
			//------------------------------------------------- delete lunch order ---------------------------------------
			case "delete_lunch_order":
						$db = connect_pdo();$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				    if($id != ''){
				    	$sql = "DELETE from lunch_order where id = :id";
				    	$stmt = $db->prepare($sql);
				      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
				      $stmt->execute();	
				    }
			header("Location: index.php?action=lunch_order&selected_date=$selected_date");
          exit;
      break;
			
			    	
  	
      case "update_lunch":
      //--------------------------------------------- update_lunch ------------------------------------------------------------
       	
          
         $db = connect_pdo("checkout");
         $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = "UPDATE lunch_order SET food=:food, person=:person, comments=:comments WHERE id=:id"; 
				$stmt = $db->prepare($sql); 
				$result = $stmt->execute( 
				    array( 
				        ':food'   => $food,
				        ':person' => $person,
				        ':comments' => $comments, 
				        ':id'    => $id
				    ) 
				); 
          
         
          header("Location: index.php?action=lunch_order&selected_date=$selected_date");
          exit;
      break;
      
      //----------------------------------------- add_restaurant -------------------
      case "add_res":
         $db = connect_pdo("checkout");
         $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = "INSERT into restaurant SET res=:res"; 
				 $stmt = $db->prepare($sql); 
				 $result = $stmt->execute( 
				    array( 
				        ':res'   => $res
				    ) 
				); 
      
      header("Location: index.php?action=res&edit=y");
      break;
      
      //------------------------------------------ update restaurant ---------------
      case "add_menu":
      $db = connect_pdo("checkout");
         $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = "UPDATE restaurant SET menu=:menu WHERE id=:id"; 
				$stmt = $db->prepare($sql); 
				$result = $stmt->execute( 
				    array( 
				        ':menu'   => $menu,
				        ':id'    => $res_id
				    ) 
				); 
        
          header("Location: index.php?action=res&edit=y");
          exit;
      break;
      //------------------------------------------ update restaurant ---------------
      case "update_res":
      $db = connect_pdo("checkout");
         $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = "UPDATE restaurant SET res=:res WHERE id=:id"; 
				$stmt = $db->prepare($sql); 
				$result = $stmt->execute( 
				    array( 
				        ':res'   => $res,
				        ':id'    => $id
				    ) 
				); 
        
          header("Location: index.php?action=res&edit=y");
          exit;
      break;
      		//---------------------------------- delete res -----------------------
      case "delete_res":
      				$db = connect_pdo("checkout");
         			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      				$sql = "DELETE from restaurant where id = :id";
				    	$stmt = $db->prepare($sql);
				      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
				      $stmt->execute();	
				       header("Location: index.php?action=res&edit=y");
				       exit;
				       break;
				       
		//------------------------------------- choose res -------------------
		case "choose_res":
							$nowdate = date("Y-m-d");
							$db = connect_pdo("checkout");
         			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         			$sql = "INSERT into restaurant_record (res_id,date_chosen) VALUES (:res_id, :date_chosen)";
         			//$sql = "INSERT INTO lunch_order (date,food,person,comments) VALUES (:date, :food, :person, :comments)";
							$stmt = $db->prepare($sql); 
							$result = $stmt->execute( 
							    array( 
							        ':res_id'   => $res_id,
							        ':date_chosen'    => $nowdate
							    ) 
							); 
							$sql = "SELECT * FROM restaurant where id = '$res_id'";
					    $stmt = $db->query($sql);
					    $rows = $stmt->fetchAll();
					    $row = $rows[0];
							?>
							<div style="margin:50px 0 0 50px;">
										<h2>You Have Chosen</h2><br>	
      							<div style="font-weight:bold;font-size:31px;color:green;"><?=$row['res'];?></div>
      							<br>
      							<h2>For today <?=$nowdate;?></h2>
      				</div>
      				<br><br>
      				<a class="button" style="font-size:16px;margin-left:30px;" href="index.php?action=res&edit=y">Return to List</a> 
      				<?php			
      				exit;
      				break;
      				
     //------------------------------------- choose res -------------------
		case "choose":
							$nowdate = date("Y-m-d");
							$db = connect_pdo("checkout");
         			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         			$sql = "INSERT into restaurant_record (res_id,date_chosen) VALUES (:res_id, :date_chosen)";
         			//$sql = "INSERT INTO lunch_order (date,food,person,comments) VALUES (:date, :food, :person, :comments)";
							$stmt = $db->prepare($sql); 
							$result = $stmt->execute( 
							    array( 
							        ':res_id'   => $res_id,
							        ':date_chosen'    => $nowdate
							    ) 
							); 
							header("Location: index.php?action=res&edit=y");
				       exit;
				      			
      				break;
      				
       //------------------------------------- choose res -------------------
		case "unchoose":
							$nowdate = date("Y-m-d");
							$db = connect_pdo("checkout");
         			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         			$sql = "DELETE from restaurant_record where res_id=:res_id and date_chosen=:nowdate";
         			
							$stmt = $db->prepare($sql); 
							$result = $stmt->execute( 
							    array( 
							        ':res_id'   => $res_id,
							        ':nowdate'    => $nowdate
							    ) 
							); 
							header("Location: index.php?action=res&edit=y");
				       exit;
			//------------------------------------- edit_rest_record -----------------
			case "edit_rest_record":
					$db = connect_pdo("checkout");
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "UPDATE restaurant_record SET date_chosen=:date_chosen WHERE id=:id"; 
				 $stmt = $db->prepare($sql); 
				 $result = $stmt->execute( 
				    array( 
				        ':date_chosen'   => $date_chosen,
				        ':id'    => $id
				    ) 
				); 
			
			header("Location: index.php?action=res&edit=y");
				       exit;
			//---------------------------- add_res_record --------------------
			case "add_res_record":
							$nowdate = date("Y-m-d");
							$db = connect_pdo("checkout");
         			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         			$sql = "INSERT into restaurant_record (res_id,date_chosen) VALUES (:res_id, :date_chosen)";
         			
							$stmt = $db->prepare($sql); 
							$result = $stmt->execute( 
							    array( 
							        ':res_id'   => $res_id,
							        ':date_chosen'    => $date_chosen
							    ) 
							); 
			
			header("Location: index.php?action=res&edit=y");
				       exit;
		//------------------------------- delete_res_record ------------------
		case "delete_res_record":
							$db = connect_pdo("checkout");
         			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         			$sql = "DELETE from restaurant_record where id=:id ";
         			
							$stmt = $db->prepare($sql); 
							$result = $stmt->execute( 
							    array( 
							        ':id'   => $id
							    ) 
							); 
							header("Location: index.php?action=res&edit=y");
				       exit;
	  } 
  