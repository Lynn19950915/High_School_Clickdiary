<!DOCTYPE html>
<html>
  <head>
    <title>Google Calendar API</title>
    <meta charset="utf-8" />
    <meta name="description" content="享資道curelshare.com測試Google Calendar API code">
  </head>
  <body>
    <p>Google Calendar API</p>

    <script src="https://apis.google.com/js/api.js"></script>   

	<button id="authButton">登入</button>
	<button onclick="execute()">新增事件</button>

	<br>
	<a href="https://calendar.google.com/calendar/r/month/2020/4/1?tab=rc" target="_blank">Google行事曆</a>

	<script type="text/javascript">

		var CLIENT_ID = '***.apps.googleusercontent.com';
    	var API_KEY = '***';

    	var authParams = {
		  	'response_type' : 'token', // Retrieves an access token only
		  	'client_id' : CLIENT_ID, // Client ID from Cloud Console
		  	'immediate' : false, // For the demo, force the auth window every time
		 	'scope' : ['https://www.googleapis.com/auth/calendar https://www.googleapis.com/auth/calendar.events']  // Array of scopes
		};

    	//init
		gapi.load("client:auth2", function() {
		 	gapi.auth2.init({client_id: CLIENT_ID});
		});

		//登入btn
		document.getElementById('authButton').onclick = function(){
	  		gapi.auth.authorize(authParams, myCallback)
		};

		//登入結果,設定token
		function myCallback(authResult){
	  		if (authResult && authResult['access_token']) {
			    
		    	gapi.auth.setToken(authResult);
		    	console.log(authResult)

		     	loadClient();
	  		} else {
	    		// Authorization failed or user declined
	  		}
		}

		//連API
		function loadClient() {
		    gapi.client.setApiKey( API_KEY );
		    return gapi.client.load("https://content.googleapis.com/discovery/v1/apis/calendar/v3/rest")
		        .then(function() { console.log("GAPI client loaded for API"); },
		        	function(err) { console.error("Error loading GAPI client for API", err); });
		}

		// 新增事件
		function execute() {
			var events = [ {
		      	'summary': '記得完成點日記唷！',
		      	'description': 'https://studiary.tw/',
		      	'start': {
		          	'date': '2021-03-02',
		          	'timeZone': 'Asia/Taipei'
		      	},
		      	'end': {
		         	'date': '2021-03-02',
		          	'timeZone': 'Asia/Taipei'
		      	}
	  		}];


			//多筆事件
			var batch = gapi.client.newBatch();
			events.map((r, j)=> {
	  			batch.add(gapi.client.calendar.events.insert({
	    			'calendarId': 'primary',
	    			'resource': events[j]
	  			}))
			})

			batch.then(function(){
			  console.log('all jobs now dynamically done!!!')
			});
		}
	</script>

  </body>
</html>
