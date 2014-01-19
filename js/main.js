var dirtyUsername = "demo";
//var serverURL = "http://localhost/mhacks/";
var serverURL = "http://www.cryous.com/mhacks/";
var arrChoices = [];
var numChallenges = 0;
var answerWord = "";

function tempLoginOnclick(){
	var tempUser = $("#login").val();
	if(tempUser==""){
		dirtyUsername = "demo";
	} else {
		dirtyUsername = tempUser;
	}
}

function ping(){
	$.getJSON( serverURL+"data.php?user="+dirtyUsername+"&action=ping", function( data ) {
		var i = 0;
		numChallenges = 0;
		numChallenges = data.length;
		if(numChallenges > 0){
			// Show extra button with Complete a Challenge
			
			// When button is clicked it starts the challenge gameboard.
		}
		
		//$.each( data, function( key, val ) {
		//	alert( "Word: " + val['word'] );
		//	i++;
		//});
	});
}

function startSinglePlayerMode(){
	$("#homepageContainer").fadeOut();
	
	var newWord = [];
	$.ajax({
	    type: 'GET',
	    url: serverURL+"data.php?user="+dirtyUsername+"&action=getNewWord",
	    dataType: 'json',
	    success: function(data) {
	    	newWord['word'] = data['word'];
			newWord['scrambled'] = data['scrambled'];
			newWord['hint'] = data['hint'];
			console.log(newWord['word']);
	    },
	    async: false
	});
	
	// Render the gameboard
	for (var i = 0, len = newWord['scrambled'].length; i < len; i++) {
		$("#sortable").append('<div id = "draggable'+i+'" class="ui-state-default">'+newWord['scrambled'][i]+'</div>');
	}
	
	// Set the Hint Text
	$("#hintBtn").attr('onclick','alert("'+newWord['hint']+'")');
	
	// Show the gameboard
	$(".gameBoardContainer").fadeIn();
	
	// Initialize sortable
	$("#sortable").sortable({
        revert: true
    }); 
	
}

function startMultiplayerMode(){
	window.location = 'game.html';
	
	// Show 4 different words that the user can choose to scramble
	$.getJSON( serverURL+"data.php?user="+dirtyUsername+"&action=getChoices", function( data ) {
		var i = 0;
		arrChoices = [];
		
		$.each( data, function( key, val ) {
			arrChoices[i]['word'] = val['word'];
			arrChoices[i]['scrambled'] = val['scrambled'];
			arrChoices[i]['hint'] = val['hint'];
			
			$("#wordChoice"+i).text(val['word']);
			i++;
		});
	});
	
	// Once the word is chosen, render the scrambleBoard
	
	// Once scrambled, select a friend to send it to.
	
	// Show Alert that the challenge was sent and take the user back to the main menu.	
}

function submitAnswer(){
	// Check answers
	
	// If this was a challenge and the answer was correct, ajax back a time value to mark challenge completed.
	
}
