
function chatUpdate()
{
	var req = new XMLHttpRequest();
	req.onreadystatechange = function()
	{
		if(req.readyState == 4 && req.status == 200)
			{
				document.getElementById('chatbox').innerHTML = req.responseText;
			}
	}
	req.open('POST', 'chat.php', true); 
	req.send();
}
setInterval(function(){chatUpdate()}, 1000)

