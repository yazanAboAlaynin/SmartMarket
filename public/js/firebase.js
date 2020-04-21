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
messaging.requestPermission()
    .then(function(){
        console.log('I am in here');
        //You must return the token
        return  messaging.getToken()
            .then(function(currentToken) {
                $('#device_token').val(currentToken);
                console.log(currentToken);
            })
            .catch(function(err) {
                console.log('An error occurred while retrieving token. ', err);
                showToken('Error retrieving Instance ID token. ', err);
                setTokenSentToServer(false);
            })});

messaging.onMessage(function(payload){
    console.log('onMessage:', payload);

    $('.number-alert').empty().html(payload.data['gcm.notification.badge']);
    $('.number-message').empty().html('You have '+ payload.data['gcm.notification.badge'] +' messages');

});


function setTokenSentToServer(sent) {
    window.localStorage.setItem('sentToServer', sent ? '1' : '0');
}
