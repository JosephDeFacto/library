<?php 

function redirectTo($path) {

	header("Location: $path");
}
/*
function redirectTo($path) {

	header("Location: " . $path . ".php");
}
*/