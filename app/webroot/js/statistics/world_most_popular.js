$(document).ready(function() {

	var isMapClicked = false;
	var clickedCode = null;

	$('#map').vectorMap(
	{
	    map: 'world_en',
	    backgroundColor: '',
	    borderColor: '#818181',
	    borderOpacity: 0.25,
	    borderWidth: 2,
	    color: '#f4f3f0',
	    enableZoom: true,
	    hoverColor: '#748626',
	    hoverOpacity: null,
	    normalizeFunction: 'polynomial',
	    scaleColors: ['#b6d6ff', '#005ace'],
	    selectedColor: '#666666',
	    selectedRegion: null,
	    showTooltip: true,
	    onRegionClick: function(element, code, region)
	    {

	    	if(isMapClicked && clickedCode != code) {
	    		isMapClicked = false;
	    		$('path.jvectormap-region').trigger('click');
	    	}
	    	clickedCode = code;
	    	// console.log(element);
	    	// $("#map").qtip({
		    //     content: {
		    //         text: "asdasd"
		    //     },
		    //     style: { classes: 'qtip-youtube qtip-rounded qtip-shadow' },
		    //     position: {
			   //      target: 'mouse'
			   //  }
		    //  });
	        // var message = 'You clicked "'
	        //     + region 
	        //     + '" which has the code: '
	        //     + code.toUpperCase();
	             
	        // alert(message);

	    },
	    onRegionOver: function(event, code) {
	    	// if(isMapClicked && code != clickedCode) {
	    	// 	unbindMouseToCountry();
	    	// } else if(isMapClicked && code == clickedCode) {
	    	// 	bindMouseToCountry();
	    	// }
	    }
	});

	$('path.jvectormap-region').click(function(e) {
		if(isMapClicked) {
			isMapClicked = false;
			return;
		}
		console.log('click');
	    // var offset = $('#map').offset();
	    // mouseX = (e.clientX - offset.left);
	    // mouseY = (e.clientY - offset.top);
	    // console.log(mouseX+" "+mouseY);
	    isMapClicked = true;
	});

});

// function bindMouseToCountry(isMapClicked) {
// 	$('path.jvectormap-region').click(function(e) {
// 		// if(isMapClicked) {
// 		// 	return;
// 		// }
// 	    var offset = $('#map').offset();
// 	    mouseX = (e.clientX - offset.left);
// 	    mouseY = (e.clientY - offset.top);
// 	    console.log(mouseX+" "+mouseY);
// 	});
// 	// $('path.jvectormap-region').click();
// }

// function unbindMouseToCountry() {
// 	$('path.jvectormap-region').unbind('click');
// }