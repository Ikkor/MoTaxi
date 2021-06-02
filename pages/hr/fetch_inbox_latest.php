
<?php 
			session_start();
			 // OLD QUERY "SELECT * FROM chat_message, user WHERE to_user_id = '".$_SESSION['user_id']."'AND from_user_id = id order by timestamp desc"

			$output = '<table class="table">
						  <thead>
						    <tr>

						      <th style="padding-left: 10px;" scope="col">From</th>
						      <th style="padding-left: 10px;" scope="col">UID</th>
						      <th style="column-width: 220px;"scope="col>">Message</th>
						      <th style="column-width: 20px;" scope="col">Date</th>
						      <th style="column-width:10px;"scope="col"> </th>
     
						    </tr>
						  </thead>
						  <tbody>';

			require '../../includes/db_connect.php';
			$query = "SELECT * FROM chat_message, user m1 WHERE timestamp = (SELECT max(timestamp) from chat_message where from_user_id = m1.id and to_user_id = '".$_SESSION['user_id']."') order by timestamp desc";
				//display the latest messages only.


			$stmt=$pdo->prepare($query);
			$stmt->execute();
			$details = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			foreach($details as $row){
				
				$output.=
				"<tr>
				<td >".$row['name']."</td>
				<td>".$row['from_user_id']."</td>
				<td style = 'font-size: 10px;'><strong>".$row['chat_message']."</strong></td>
				<td style='padding-right: -100px;'>".$row['timestamp']."</td>

				<td><button type='button' class='btn btn-warning btn-sm start_chat' data-touserid=".$row['from_user_id']." data-tousername=".$row['name'].">Open Chat</button></td>

				
				</tr>";

			


			}

			$output.='</tbody></table>';
			echo $output;
 		?>

  