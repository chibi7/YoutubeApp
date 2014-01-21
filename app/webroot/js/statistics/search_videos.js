$(document).ready(function() {

	$('.toggle').toggles({
	    drag: true, // can the toggle be dragged
	    click: true, // can it be clicked to toggle
	    text: {
	      on: 'ON', // text for the ON position
	      off: 'OFF' // and off
	    },
	    on: false, // is the toggle ON on init
	    animate: 250, // animation time
	    transition: 'ease-in-out', // animation transition,
	    checkbox: null, // the checkbox to toggle (for use in forms)
	    clicker: null, // element that can be clicked on to toggle. removes binding from the toggle itself (use nesting)
	    width: 90, // width used if not set in css
	    height: 35, // height if not set in css
	    type: 'compact' // if this is set to 'select' then the select style toggle will be used
	  });

	var inputs = $('input.powerRanger');
	inputs.powerRangeIt({
		scale_factor: 60,
		cutoff_length: 7,
		cutoff_size: 0
	});
	inputs.trigger('change');

	$('.toggle').on('toggle', function (e, active) {
	    if(active) {
	        $(this).next("input[type=checkbox]").prop('checked', true);   
	    }else {
	        $(this).next("input[type=checkbox]").prop('checked', false);   
	    }
	});

});