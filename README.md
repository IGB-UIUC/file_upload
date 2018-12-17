# Upload Files Program
## written by Nevo Band

## Actor Goal List:
* IGB User: Login
* IGB User: Send upload request activation
* IGB User: Delete request
* IGB User: Delete files
* IGB User: Download file

* Other User: Create temporary account
* Other User: Upload file
* Other User: Delete file
* Other User: Change Password

* System: Create folder for IGB user upon login
* System: Create profile in database upon IGB user login
* System: Send login token to Other User
* System: Send E-Mail on new file uploads to IGB User

## Classes:
* user (object contains user info)
* mysql (mysql queries/updates)
* ldap (queries user/password on igb ldap)
* auth (Authenticates users either ldap or mysql)
* invite (sends invites via e-mail / check for conflicts)
*upload (move file to storage location renames based on file ID in database
* generate random set of digits for direct download no authentication URL path)







