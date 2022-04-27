<?php
class Helper {


	public function __construct()
	{

	}
	// 
	public function logout()
	{
		unset($_SESSION);
		session_destroy();
		session_start();

		return true;
	}
	// fonction pour hasher le mdp
	public function cryptPass($pass) {
		return hash("sha512", $pass);
	}
	//fonction pour formater le mail
	public function verifMail($email) {
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	public function checkYoutubeVideo($url) {
		$url_parsed_arr = parse_url($url);
		if ($url_parsed_arr['host'] == "www.youtube.com" && $url_parsed_arr['path'] == "/watch" && substr($url_parsed_arr['query'], 0, 2) == "v=" && substr($url_parsed_arr['query'], 2) != "") {
			return true;
		} else {
			return false;
		}
	}

	public function echappe($string)
	{
		return str_replace("'","''",$string);
	}
	// pour formater le texte
	public function text($string) {
		$searched = array('&lt;','&gt;');
		$replaced = array('<','>');

		$string = htmlspecialchars(trim($string), ENT_QUOTES, "UTF-8");
		$string = str_replace($searched,$replaced,$string);

		return $string;
	}

	//redirectionner & renommer une image
	
	public function uploadFile($file,$destination){

		$dest = dirname(__FILE__).'/..'.$destination;
		$extre = explode('.',$file['name']);
		$verif = array('png','jpg','jpeg','PNG','svg','SVG','JPG','JPEG','mp4','webm','webp','ogg','MP4','WEBM','OGG');

		 if(in_array(end($extre),$verif)){
			$fichier = round(microtime(true)).'.'.end($extre);
			move_uploaded_file($file['tmp_name'], $dest . $fichier);
			return $destination.$fichier;
		 }
		 else{
			return false;
		 }
		
	}	

	public function sizeImage($file,$t){
		$taille = $file['size'];
		$autorise = 1024*$t;
		if($taille<=$autorise){
			return true;
		}
		else{
			return false;
		}
	}	
}
?>
