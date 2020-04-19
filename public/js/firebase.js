const firebaseConfig = {
    apiKey: "AIzaSyDl3TZAzsrdJ3r8ywAgbATQl3hQMlJoOzo",
    authDomain: "notifications-6fee7.firebaseapp.com",
    databaseURL: "https://notifications-6fee7.firebaseio.com",
    projectId: "notifications-6fee7",
    storageBucket: "notifications-6fee7.appspot.com",
    messagingSenderId: "583757827174",
    appId: "1:583757827174:web:782c33314b694004afb1a7",
    measurementId: "G-Z0SJWLTJ90"
};

firebase.initializeApp(firebaseConfig);

// Retrieve Firebase Messaging object.
// Retrieve Firebase Messaging object.
const messaging = firebase.messaging();
messaging.requestPermission().then(function() {
    console.log('Notification permission granted.');
    // TODO(developer): Retrieve an Instance ID token for use with FCM.
    // ...
}).catch(function(err) {
    console.log('Unable to get permission to notify.', err);
});
// Get Instance ID token. Initially this makes a network call, once retrieved
// subsequent calls to getToken will return from cache.
messaging.getToken().then(function(currentToken) {
    if (currentToken) {
        $('#device_token').val(currentToken);
      //  alert(currentToken);
       // document.getElementById("device_token").innerHTML = currentToken;
        console.log('token',currentToken);

    } else {
        // Show permission request.
        console.log('No Instance ID token available. Request permission to generate one.');
        // Show permission UI.
        updateUIForPushPermissionRequired();
        setTokenSentToServer(false);
    }
}).catch(function(err) {
    console.log('An error occurred while retrieving token. ', err);

    setTokenSentToServer(false);
});

messaging.onMessage(function(payload){
    console.log('onMessage:', payload);
});

function setTokenSentToServer(sent) {
    window.localStorage.setItem('sentToServer', sent ? '1' : '0');
}

