<html>

<head>
<script type="text/javascript">
var duration = 0;

// Javascript to compute elapsed time between "Start" and "Finish" button clicks
function timestamp_class(this_current_time, this_start_time, this_end_time, this_time_difference) { 
        this.this_current_time = this_current_time;
        this.this_start_time = this_start_time;
        this.this_end_time = this_end_time;
        this.this_time_difference = this_time_difference;
        this.GetCurrentTime = GetCurrentTime;
        this.StartTiming = StartTiming;
        this.EndTiming = EndTiming;
    }

    //Get current time from date timestamp
    function GetCurrentTime() {
    var my_current_timestamp;
        my_current_timestamp = new Date();              //stamp current date & time
        return my_current_timestamp.getTime();
        }

    //Stamp current time as start time and reset display textbox
    function StartTiming() {
        this.this_start_time = GetCurrentTime();        //stamp current time
        document.TimeDisplayForm.TimeDisplayBox.value = 0;      //init textbox display to zero
        }

    //Stamp current time as stop time, compute elapsed time difference and display in textbox
    function EndTiming() {
        this.this_end_time = GetCurrentTime();          //stamp current time
        this.this_time_difference = (this.this_end_time - this.this_start_time) / 1000; //compute elapsed time
        document.TimeDisplayForm.TimeDisplayBox.value = this.this_time_difference;      //set elapsed time in display box
        }

var time_object = new timestamp_class(0, 0, 0, 0);  //create new time object and initialize it

//-->

function assignDuration()
{
   document.stopform.duration.value = duration;
}
</script>
</head>

<body>
    <form>
        <input type="button" value="Start" onClick="time_object.StartTiming()"; name="StartButton">
    </form>
    <form>
        <input type="button" value="Finish" onClick="time_object.EndTiming()"; name="EndButton">
    </form>

<form name="stopform" action="process-form.php" method="POST">
   <input type="hidden" name="duration" value="0"/>
   <input type="submit" name="dostop" onClick="assignDuration()" value="Stop"/>
</form>

</body>

</html>