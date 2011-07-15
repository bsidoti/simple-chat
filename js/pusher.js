/**
	
*/

var pusher = new Pusher('58f74697ee6b3d475dc2');
var channel = pusher.subscribe('chat_channel');
channel.bind('new-message', function(data){
	$('#chat-box').append("<div class='message-box'>"+
									"<span class='msg-name'>"+
										data['username']+
									"</span>"+
									"<span class='msg-timestamp'>"+
										data['created_at']+
									"</span>"+
									"<span class='message'>"+
										data['message']+
									"</span>"+
								"</div>");
	$("#chat-box").scrollTop($("#chat-box")[0].scrollHeight); 
});	
Pusher.channel_auth_endpoint = 'pusher_user_list.php';
var presenceChannel = pusher.subscribe('presence-users');
presenceChannel.bind('pusher:subscription_succeeded', function(users) {
	var my_name = $('#username-my-info').html();
	users.each(function(user){
		if(user.info.name != my_name)
			$('#other-users-list').append('<li name="' + user.info.name + '">'+user.info.name+'</li>');
	});
});
presenceChannel.bind('pusher:member_added', function(user) {
	$('#other-users-list').append('<li name="'+user.info.name +'">'+user.info.name+'</li>');
});
presenceChannel.bind('pusher:member_removed', function(user) {
	$('#other-users-list li[name="'+ user.info.name + '"]').remove();
});

