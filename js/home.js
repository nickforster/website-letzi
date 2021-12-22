// Sechseläuten Countdown
var countDownDate = new Date("Apr 25, 2022 18:00:00").getTime();

var countdownFunction = setInterval(() => {
    var now = new Date().getTime();
    var distance = countDownDate - now;
    
    var tage = Math.floor(distance / (1000 * 60 * 60 * 24));
    var stunden = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minuten = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var sekunden = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById('tage').innerHTML = tage;
    document.getElementById('stunden').innerHTML = stunden;
    document.getElementById('minuten').innerHTML = minuten;
    document.getElementById('sekunden').innerHTML = sekunden;

    if (distance < 0) {
        clearInterval(countdownfunction);
        //was gemacht wird
    }
}, 1000);