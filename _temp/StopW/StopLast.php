<html>
<head>
<script>
var clsStopwatch = function () {

var startAt = 0;
var lapTime = 0;

var now = function () {
    return (new Date()).getTime();
};

this.start = function () {
    startAt = startAt ? startAt : now();
};

this.stop = function () {
    lapTime = startAt ? lapTime + now() - startAt : lapTime;
    startAt = 0;
};

this.time = function () {
    return lapTime + (startAt ? now() - startAt : 0);
};
};

var x = new clsStopwatch();
var $time;
var clocktimer;

function pad(num, size) {
var s = "0000" + num;
return s.substr(s.length - size);
}

function formatTime(time) {
var h = m = s = ms = 0;
var newTime = '';

m = Math.floor(time / (60 * 1000));
time = time % (60 * 1000);
s = Math.floor(time / 1000);
ms = time % 1000;

newTime = pad(m, 2) + ':' + pad(s, 2) + ':' + pad(ms, 2);
return newTime;
}

function show() {
$time = document.getElementById('time');
update();
}

function update() {
$time.innerHTML = formatTime(x.time());
}

function start() {
clocktimer = setInterval("update()", 1);
x.start();
}

function stop() {
x.stop();
document.getElementById('counter').value = formatTime(x.time());
clearInterval(clocktimer);

}
</script>
</head>

<body onload="show();">

<form action="highscore.php" method="post"/>

name:<br/>
<input type="text" name="name"/><br/>

company:<br/>
<input type="text" name="company"/><br/>

email:<br/>
<input type="text" name="email"/><br/>


Time: <span id="time"></span><br/>
<!--<input type="text" name-"time">-->
<input type="button" value="start" onclick="start();">
<input type="button" value="stop" onclick="stop();">

<input type="submit" value="submit" ">
<input type="hidden" value="" id="counter" name="counter" />
<br/><br/>

</form>

</body>

<html>