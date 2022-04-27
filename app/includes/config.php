<?php
/**
 * fichier de configuration qui déclare toutes les constantes utilisées dans les classes
**/

// global
const SITE_ROOT 	= 'http://localhost:3000';

// mysql
// base de données
const BDD_SGBD = 'mysql';
const BDD_DATABASE	= 'cineticbd';
const BDD_HOST 		= 'db';
const BDD_PASSWORD	= '1234';
const BDD_USER		= 'root';

// tables principales
const TABLE_USERS = 'users';
const TABLE_LIKES = 'likes';
const TABLE_MESSAGES = 'messages';
const TABLE_COMMENTS = 'comments';
const TABLE_STATUS = 'status';
const TABLE_POSTS = 'posts';
const TABLE_FRIENDS = 'friends';


// expéditeur mail
const EXP_MAIL		= 'admin@e-cine.xyz'; //kT7@zdmzTK

// avatar par défaut
const AVATAR_DEFAULT = '/public/img/user/avatar.png';
const REP_AVATAR = '/public/img/user/';
const REP_POST = '/public/img/post/';

// liste des status
const ACTIVE = 1;
const STANDBY = 2;
const DELETE = 3;


//BOOL
CONST V_TRUE =1;
const V_FALSE = 0;


?>
