$(document).ready(function(){

    
    		fetch_client_complaints();

    		

    		setInterval(function(){
    			fetch_client_complaints();  update_chat_history_data();
    		}, 15000);
//fetch new complaints every 15 secs

    		function fetch_client_complaints(){
    			$.ajax({
    				url:"fetch_client_complaints.php",
    				method:"POST",
    				success:function(data){
    					$('#complaints').html(data);
    				}
    			})
    		}


			function make_chat_dialog_box(to_user_id, to_user_name)
			{
				var modal_content = '<div display: "flex" id="user_dialog_'+to_user_id+'" class="user_dialog" title="Conversation with '+to_user_name+'">';
				modal_content += '<div style="height:300px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
				modal_content += fetch_user_chat_history(to_user_id);
				modal_content += '</div>';
				modal_content += '<div class="form-group">';
				modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control chat_message"></textarea>';
				modal_content += '</div><div class="form-group" align="right">';
				modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button></div></div>';
				$('#chatbox').html(modal_content);
			}



			$(document).on('click', '.start_chat', function(){
			  var to_user_id = $(this).data('touserid');
			  var to_user_name = $(this).data('tousername');
			  make_chat_dialog_box(to_user_id, to_user_name);
			  $("#user_dialog_"+to_user_id).dialog({
			   autoOpen:false,
			   width:400,

			  });


	
			  $('#user_dialog_'+to_user_id).dialog('open');
			  // $('#chat_message_'+to_user_id).emojioneArea({
			  //  pickerPosition:"top",
			  //  toneStyle: "bullet"
			  // });
 			});


			//resolve client complaint


 			$(document).on('click','.resolvebtn',function(){
 				var comp_id = $(this).attr('data');
 				$.ajax({
 					url:"resolveclientComplaint.php",
 					method:"POST",
 					data:{
 						complaint_id:comp_id
 					},
 					success:function(data)
 					{
 						$(this).html(data) //need a way to prevent accidental resolve
 						fetch_client_complaints();
 						

 					}
 				})
 			});


 			 $(document).on('click', '.send_chat', function(){
				var to_user_id = $(this).attr('id');
				var chat_message = $('#chat_message_'+to_user_id).val();
				$.ajax({
				url:"../../modules/insert_chat.php",
				method:"POST",
				data:{to_user_id:to_user_id, chat_message:chat_message},
				success:function(data)
				{
				//$('#chat_message_'+to_user_id).val('');
				// var element = $('#chat_message_'+to_user_id).emojioneArea();
				// element[0].emojioneArea.setText('');
				$('#chat_history_'+to_user_id).html(data);
				}
				})
			});




			 function fetch_user_chat_history(to_user_id)
			 {
			  $.ajax({
			   url:"../../modules/fetch_user_chat_history.php",
			   method:"POST",
			   data:{to_user_id:to_user_id},
			   success:function(data){
			    $('#chat_history_'+to_user_id).html(data);
			   }
			  })
			 }

			function update_chat_history_data()
			{
				  $('.chat_history').each(function(){
				   var to_user_id = $(this).data('touserid');
				   fetch_user_chat_history(to_user_id);
				  });
			}

				



    	});