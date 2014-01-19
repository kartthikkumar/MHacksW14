<?php

$mysqlServer	= "localhost";
$mysqlDB		= "XXXXXXXXX";
$mysqlUser		= "XXXXXXXXX";
$mysqlPass		= "XXXXXXXXX";

// Create connection
$connect = mysql_connect($mysqlServer, $mysqlUser, $mysqlPass);
if (!$connect) {
    die('Could not connect: ' . mysql_error());
}

//select a database to work with
$selected = mysql_select_db($mysqlDB, $connect) or die("Could not select DB");

////////////////

function print_arr($arr){
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}

function getChoices(){
	$choices = array();
	$choices[] = getNewWord(4);
	$choices[] = getNewWord(5);
	$choices[] = getNewWord(6);
	$choices[] = getNewWord(7);
	
	return $choices;
}

function getNewWord($numLetters){
	global $connect;
	$result = mysql_query("SELECT word,hint FROM words WHERE LENGTH(word)='$numLetters' ORDER BY RAND() LIMIT 1");
	while($row = mysql_fetch_array($result)){
		$newWord['word'] = $row['word'];
		$newWord['scrambled'] = scrambleWord($row['word']);
		$newWord['hint'] = $row['hint'];
	}
	return $newWord;
}

function scrambleWord($word){
	return str_shuffle ($word);
}

function ping($user){
	global $connect;
	$i = 0;
	$result = mysql_query("SELECT * FROM challenges WHERE time IS NULL AND target='$user'");
	$challenges = array();
	
	while($row = mysql_fetch_array($result)){
		$challenges[$i]['cID'] = $row['cID'];
		$challenges[$i]['user'] = $row['user'];
		$challenges[$i]['word'] = $row['word'];
		$challenges[$i]['scrambled'] = $row['scrambled'];
		$i++;
	}
	
	return $challenges;
}

function fetchChallenge($cID){
	global $connect;
	$result = mysql_query("SELECT * FROM challenges WHERE time IS NULL AND cID='$cID'");
	$challenge = array();
	
	$row = mysql_fetch_array($result);
	$challenge['cID'] = $row['cID'];
	$challenge['user'] = $row['user'];
	$challenge['word'] = $row['word'];
	$challenge['scrambled'] = $row['scrambled'];
	
	return $challenge;
}

function challengeCompleted($cID, $time){
	$result = mysql_query("UPDATE challenges SET time='$time' WHERE cID='$cID'");
}

function newChallenge($user, $target, $word, $scrambled){
	$result = mysql_query("INSERT IGNORE INTO challenges (cID, user, target, word, scrambled) VALUES ('', '$user', '$target', '$word', '$scrambled');");
	
}
?>