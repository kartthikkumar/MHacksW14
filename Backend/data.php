<?php
include("database.php");
include("functions.php");

if( isset($_GET['action']) && isset($_GET['user']) ){
	$action = $_GET['action'];
	$user	= $_GET['user'];
	
	if($action=="ping"){
		// Check if user has any incoming challenges
		$challenges = ping($user);
		echo json_encode($challenges);
		
	} else if($action=="challenge"){
		if(isset($_GET['cID'])){
			if(isset($_GET['time'])){
				// challenge was completed
				challengeCompleted($_GET['cID'], $_GET['time']);
			} else {
				// NON-completed challenge. Send Challenge data
				$challenge = fetchChallenge($_GET['cID']);
				print_arr($challenge);
			}
		} else if( isset($_GET['new']) && isset($_GET['target']) && isset($_GET['word']) && isset($_GET['scrambled']) ){
			// New Challenge
			newChallenge($_GET['user'], $_GET['target'], $_GET['word'], $_GET['scrambled']);
		}
		
	} else if($action=="getNewWord"){
		// GET RANDOM WORD
		$newWord = getNewWord( rand(4, 7) );
		echo json_encode($newWord);
		
	} else if($action=="getChoices"){
		$choices = getChoices();
		echo json_encode($choices);
	}
	
}

?>