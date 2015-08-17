$(function(){
	var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    var $myStart2 = $('#date');

    var checkin = $myStart2.datepicker({
      onRender: function(date) {
        return date.valueOf() < now.valueOf() ? 'am-disabled' : '';
      }
    }).data('amui.datepicker');

});