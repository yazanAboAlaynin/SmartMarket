importScripts("https://www.gstatic.com/firebasejs/7.14.0/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/7.14.0/firebase-messaging.js");

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
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function (payload) {
   console.log('blahblah',payload);

   var notificationTitle = 'BackGround title';
   var notificationOptions = {
       body : 'bg m body',
       icon : '/firebase-logo.png'
   };
   return self.registration.showNotification(notificationTitle,notificationOptions);

});

