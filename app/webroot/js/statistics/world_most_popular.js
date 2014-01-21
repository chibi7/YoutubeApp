$(document).ready(function() {

	var isMapClicked = false;
	var clickedCode = null;
	var globalIsSelected = false;
	var sendedCode = null;
	var xPosition, yPosition;


	$("#map").vectorMap({
		map: 'world_mill_en',
		backgroundColor: '',
		normalizeFunction: 'polynomial',
		regionsSelectable: true,
		regionsSelectableOne: true,
		regionStyle: {
	      initial: {
	        fill: '#ffffff'
	      },
	      selected: {
	        fill: '#666666'
	      },
	      hover: {
	      	fill: '#748626'
	      }
	    },
	    onRegionClick: function(event, code) {
	    	if(code == clickedCode && globalIsSelected == true) {
	    		globalIsSelected = false;
	    		var mapObject = $("#map").vectorMap('get', 'mapObject');
	    		mapObject.clearSelectedRegions();
	    		event.preventDefault();
	    	} else {
	    		clickedCode = code;
	    		globalIsSelected = true;
	    	}

	    	
	    },
	    onRegionSelected: function(event, code, isSelected, selectedRegions) {
	    	console.log('regionSelected '+code+" "+isSelected);
	    	if(isSelected) {
	    		if(sendedCode != code) {
	    			sendRequest(code);
	    			sendedCode = code;
	    		}
	    	} else {
	    		$('#map').qtip('hide');
	    	}
	    }
	});

	$('#map').qtip({
		content: {
			text: ''
		},
		style: {
		    classes: 'qtip-youtube qtip-shadow qtip-rounded'
		},
		show: {
			event: 'click',
			solo: true,
			modal: true
		},
		hide: false,
		events: {
            show: function(event) {
            	// event.preventDefault();
                $('#map').qtip('option', 'position.target', [xPosition, yPosition]);
            }
        }
	});

	$("#map").on('click', function(event) {
		var offset = $('#map').offset();
        xPosition = event.pageX;
        yPosition = event.pageY;
	});

});


function sendRequest(code) {
	var reqData = {};
	reqData.country_code = code;
	$('#map').qtip('option', 'content.text', function(event, api) {
        $.ajax({
           	type: "POST",
		    url: "get_world_most_popular",
		    data: { "country_code": code }
        })
        .then(function(content) {
        	api.set('content.text', content);
        	initMostPopularPopup();
        	createHint();
        }, function(xhr, status, error) {
        	console.log('ajax error');
            api.set('content.text', status + ': ' + error);
        });

        return 'Loading...';
    });
}

function createHint() {
	$(".viewContainer").addClass('hint--top  hint--info').attr('data-hint', 'Total views');

	$(".commentContainer").addClass('hint--top  hint--info').attr('data-hint', 'Total comments');

	$(".ratingContainer").addClass('hint--top  hint--info').attr('data-hint', 'Official rating')

	$(".likeContainer").addClass('hint--top  hint--info').attr('data-hint', 'Users likes');
}