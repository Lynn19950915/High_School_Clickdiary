﻿<!DOCTYPE html>
<html>
  <head>
    <title>Google Apps Script API Quickstart</title>
    <meta charset="utf-8" />
  </head>
  <body>
    <p>Google Apps Script API Quickstart</p>

    <!--Add buttons to initiate auth sequence and sign out-->
    <button id="authorize_button" style="display: none;">Authorize</button>
    <button id="signout_button" style="display: none;">Sign Out</button>

    <pre id="content" style="white-space: pre-wrap;"></pre>

    <script type="text/javascript">
      // Client ID and API key from the Developer Console
      var CLIENT_ID = '483835944355-tfuasp4o0sul83pljtjon4b4ouau9s95.apps.googleusercontent.com';
      var API_KEY = 'AIzaSyCgwpr_GkuTsvjf9VJE_98D60z-0dbFygY';

      // Array of API discovery doc URLs for APIs used by the quickstart
      var DISCOVERY_DOCS = ["https://script.googleapis.com/$discovery/rest?version=v1"];

      // Authorization scopes required by the API; multiple scopes can be
      // included, separated by spaces.
      var SCOPES = 'https://www.googleapis.com/auth/script.projects';

      var authorizeButton = document.getElementById('authorize_button');
      var signoutButton = document.getElementById('signout_button');

      /**
       *  On load, called to load the auth2 library and API client library.
       */
      function handleClientLoad() {
        gapi.load('client:auth2', initClient);
      }

      /**
       *  Initializes the API client library and sets up sign-in state
       *  listeners.
       */
      function initClient() {
        gapi.client.init({
          apiKey: API_KEY,
          clientId: CLIENT_ID,
          discoveryDocs: DISCOVERY_DOCS,
          scope: SCOPES
        }).then(function () {
          // Listen for sign-in state changes.
          gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);

          // Handle the initial sign-in state.
          updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
          authorizeButton.onclick = handleAuthClick;
          signoutButton.onclick = handleSignoutClick;
        }, function(error) {
          appendPre(JSON.stringify(error, null, 2));
        });
      }

      /**
       *  Called when the signed in status changes, to update the UI
       *  appropriately. After a sign-in, the API is called.
       */
      function updateSigninStatus(isSignedIn) {
        if (isSignedIn) {
          authorizeButton.style.display = 'none';
          signoutButton.style.display = 'block';
          callAppsScript();
        } else {
          authorizeButton.style.display = 'block';
          signoutButton.style.display = 'none';
        }
      }

      /**
       *  Sign in the user upon button click.
       */
      function handleAuthClick(event) {
        gapi.auth2.getAuthInstance().signIn();
      }

      /**
       *  Sign out the user upon button click.
       */
      function handleSignoutClick(event) {
        gapi.auth2.getAuthInstance().signOut();
      }

      /**
       * Append a pre element to the body containing the given message
       * as its text node. Used to display the results of the API call.
       *
       * @param {string} message Text to be placed in pre element.
       */
      function appendPre(message) {
        var pre = document.getElementById('content');
        var textContent = document.createTextNode(message + '\n');
        pre.appendChild(textContent);
      }

      /**
       * Shows basic usage of the Apps Script API.
       *
       * Call the Apps Script API to create a new script project, upload files
       * to the project, and log the script's URL to the user.
       */
      function callAppsScript() {
        gapi.client.script.projects.create({
          resource: {
            title: 'My Script'
          }
        }).then((resp) => {
          return gapi.client.script.projects.updateContent({
            scriptId: resp.result.scriptId,
            resource: {
              files: [{
                name: 'hello',
                type: 'SERVER_JS',
                source: 'function helloWorld() {\n  console.log("Hello, world!");\n}'
              }, {
                name: 'appsscript',
                type: 'JSON',
                source: "{\"timeZone\":\"America/New_York\",\"" +
                   "exceptionLogging\":\"CLOUD\"}"
              }]
            }
          });
        }).then((resp) => {
          let result = resp.result;
          if (result.error) throw result.error;
          console.log(`https://script.google.com/d/${result.scriptId}/edit`);
        }).catch((error) => {
          // The API encountered a problem.
          return console.log(`The API returned an error: ${error}`);
        });
      }

    </script>

    <script async defer src="https://apis.google.com/js/api.js"
      onload="this.onload=function(){};handleClientLoad()"
      onreadystatechange="if (this.readyState === 'complete') this.onload()">
    </script>
  </body>
</html>
