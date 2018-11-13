const webpush = require('web-push')

const vapidKeys = webpush.generateVAPIDKeys()

webpush.setGCMAPIKey('YOUR-SERVER-KEY-FROM-FIREBASE-CONSOLE')

webpush.setVapidDetails(
    'mailto:your@email.com',
    vapidKeys.publicKey,
    vapidKeys.privateKey
)

// Use your previously saved subscription information
const pushSubscription = {
    endpoint: '',
    keys: {
        auth: '',
        p256dh: ''
    }
}

// image & actions are optional
webpush.sendNotification(pushSubscription, JSON.stringify({
    title: 'Noty title',
    body: 'Noty body',
    icon: 'https://your-icon0-url.png',
    image: 'https://your-image-url.png',
    url: 'http://ned.im/noty/?ref=webPushTest',
    actions: [
        {action: 'actionYes', 'title': 'Yes', 'icon': 'https://your-icon1-url.png'},
        {action: 'actionNo', 'title': 'No', 'icon': 'https://your-icon2-url.png'}
    ]
}))