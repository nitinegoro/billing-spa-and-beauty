function count_time(selector, time) {
	var end = new Date(time);
    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;
    function showRemaining() 
    {
        var now = new Date();
        var distance = end - now;
        if (distance < 10) 
        {
            clearInterval(timer);
            $(selector).addClass('text-danger');
            return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);

        $(selector).html(hours + '&nbsp;:&nbsp;' + minutes+'&nbsp;:&nbsp;' + seconds);

        // if (!hours) {
        //     $(selector).html(minutes + '&nbsp;:&nbsp;' + seconds);
        // } else if(!minutes && !hours) {
        // 	$(selector).html(seconds);
        //     $(selector).html(seconds + '&nbsp;Menutes');
        // } else {
        // 	$(selector).html(hours + '&nbsp;:&nbsp;' + minutes+'&nbsp;:&nbsp;' + seconds);
        // }
    }
    timer = setInterval(showRemaining, 1000);
}

window.paceOptions = {
    ajax: {
        trackMethods: ['GET', 'POST', 'PUT', 'DELETE', 'REMOVE']
    }
};