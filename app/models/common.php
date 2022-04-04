<?php
class Common {


	public function __construct()
	{

	}

	public function logout()
	{
		unset($_SESSION);
		session_destroy();
		session_start();

		return true;
	}

	public function echappe($string)
	{
		return str_replace("'","''",$string);
	}

	public function text($string) {
		$searched = array('&lt;','&gt;');
		$replaced = array('<','>');

		$string = htmlspecialchars($string, ENT_QUOTES, "UTF-8");
		$string = str_replace($searched,$replaced,$string);

		return $string;
	}

	//redirectionner & renommer une image
	
	public function uploadFile($file,$destination){
		// $destination = dirname(__DIR__).$destination_dir;
		 $extre = explode('.',$file['name']);
		$verif = array('png','jpg','jpeg','PNG','JPG','JPEG','mp4','webm','ogg','MP4','WEBM','OGG');
		 if(in_array(end($extre),$verif)){
			$fichier = round(microtime(true)).'.'.end($extre);
			move_uploaded_file($file['tmp_name'], $destination . $fichier);
			return $fichier;
		 }
		 else{
			return false;
		 }
		
	}	

	public function sizeImage($file,$t){
		// $destination = dirname(__DIR__).$destination_dir;
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
