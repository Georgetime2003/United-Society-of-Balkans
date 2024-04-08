importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
   
firebase.initializeApp({
    apiKey: "AIzaSyA4HXAh025iWSPFHwFrbI-6CrVzHgcfuvU",
    projectId: "usob-387217",
    messagingSenderId: "567094647866",
    appId: "1:567094647866:web:6943ea3d04f54af238a903"
});
  
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});