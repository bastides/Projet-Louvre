$(function() {
    var daysToDisable = ['1/5', '1/11', '25/12'];
    
    $.datepicker.setDefaults( $.datepicker.regional[ 'fr' ] );
    
    $("#total_order_ticket_ticket_dayBook").datepicker({
        minDate: 0,
        beforeShowDay: disableSpecificDates
    });
    
    function disableSpecificDates(date) {
        var day = date.getDate();
        var month = date.getMonth();
        
        for (i = 0; i < daysToDisable.length; i++) {
            if ($.inArray(day + '/' + (month + 1), daysToDisable) != -1) {
                return [false, '', 'Unavailable'];
            } else {
                return disabledays(date);
            }
        }
    }
    
    function disabledays(date) {
        if (date.getDay() == 2) { 
                return [false, ''];
            } else {
                return [true, ''];
            }
    }
});