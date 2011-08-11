<?php
/**
 * Confirguration file contains all configuration information for this application
 * 
 */
//MySQL Settings
define("DB_HOST","localhost");
define("DB_USER","upload_user");
define("DB_PASS","israel123");
define("DB_NAME","upload");

//LDAP Settings
define("LDAP_HOST","auth.igb.uiuc.edu");
define("LDAP_PORT","389");
define("LDAP_PEOPLE","ou=people,dc=igb,dc=uiuc,dc=edu");
define("LDAP_GROUP","ou=group,dc=igb,dc=uiuc,dc=edu");
define("LDAP_SSL",0);
define("LDAP_ADMINS","cnrg");

//Data Storage
define("UPLOAD_PATH","/uploads");

//E-Mail Templates
define("EMAIL_INVITE",1);
define("INVITE_MESSAGE","IGB File Sharing Request.\nYou have been invited to share files with %USERNAME%.\n\nPlease click the following link to create a sharing account:\n%INVITEKEY%");
define("INVITE_SUBJECT","IGB File Sharing Request");

//URL for website
define("URL","http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']);

//From e-mail
define("FROM_EMAIL","nevoband@igb.uiuc.edu");
define("FROM_NAME","IGB File Sharing");

//Upload session expiration time (seconds)
define("SESSION_EXPIRE",86400); //

//File expiration to auto delete (seconds)
define("FILES_EXPIRE",864000);

//Key used to verify the person who runs the cron job
define("CRON_KEY","306a5a4f2c72355c5b3676765d");

?>