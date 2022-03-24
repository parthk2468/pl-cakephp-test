# pl-cakephp

# Database Configuration

username => 'root'
password => ''
database => pl-cakephp

# API Endpoints 

Contacts Data

GET = http://localhost/pl-cakephp/contacts/index

GET = http://localhost/pl-cakephp/contacts/index?page=2 ( For Next Page Contents )

Contacts Data With Company Info

GET = http://localhost/pl-cakephp/contacts/index_ext

GET = http://localhost/pl-cakephp/contacts/index_ext?page=2 ( For Next Page Contents )

Insert Contact Data

POST = http://localhost/pl-cakephp/contacts/add

Body = FORM Data with all required fields 
( first_name,last_name,phone_number,address,notes,add_notes,internal_notes,comments )
