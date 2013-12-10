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

	    	if(clickedCode != null && clickedCode != code) {
	    		isMapClicked = true;
	    		clickedCode = code;
	    		bindMouseToCountry();
	    	} else if(isMapClicked == true) {
	    		isMapClicked = false;
	    		unbindMouseToCountry();
	    	} else {
	    		isMapClicked = true;
	    		clickedCode = code;
	    		bindMouseToCountry();
	    	}

	    },
	    onRegionOver: function(event, code) {
	    }
	});



});

function bindMouseToCountry() {
	$('#map').one('mousemove', function(event) {
		var offset = $('#map').offset();
        mouseX = event.pageX - (offset.top) + 20;
        mouseY = event.pageY - (offset.top) - 25;
        console.log(mouseX+" "+mouseY);
	});
}

function unbindMouseToCountry() {
	$('#map').unbind('mousemove');
}