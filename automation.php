<?php

// Why are you thinking in 
// touch this golden file?
// DO NOT!
//
// ------------------------
// ------------------------


include 'config.php';
$git_command = ($reset) ? "git reset --hard HEAD &&" : ""; 
$git_command   .= " git pull origin {$branch}";

function send_mail($log_filename, $mail_to, $branch, $hostname){
	$mail_from     = "support@guruhub.com.uy";
	$mail_subject  = "[AutoGit] pull on branch {$branch}@{$hostname}"; 
	$mail_prepend  = "Hi, <br />  this is GuruHub automation script. <br />";
	$mail_prepend .= "I made a pull on branch {$branch}@{$hostname}";
	$mail_prepend .= "Command output :";
	$mail_append   = "<br />good luck!, <br /> If any question, you can reply this email";


	$headers = "From: support@guruhub.com.uy [AutoGit - guruhub]\r\n";
	$headers .= "MIME-Version: 1.0\r\n" .
		"Content-type: text/html\r\n";

	$body = file_get_contents($log_filename);
	$body = "<pre>{$body}</pre>";
	mail($mail_to, $mail_subject, $mail_prepend.$body.$mail_append, $headers);
}


if ($_POST['payload']){
	if($_GET['password'] == $password){
		$log_filename = "/tmp/autogit_".date("dmY_hms").".log";
		exec("cd {$repo_path} && {$git_command} > {$log_filename} 2>&1");
		error_log("cd {$repo_path} && {$git_command} > {$log_filename} 2>&1");
		send_mail($log_filename, $mail_to, $branch, $hostname);
	}else{
		throw new Exception("Payload received, but wrong password");
	}

}else{
	throw new Exception("Script called without payload");
}
?>
