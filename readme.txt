---FOLDER & FILE NAMING

- folder names and inc. files are in camelCase

- all other file names are with "_" between words


---FUNCTIONS

- functions that are related to database operation have names with "_" beetween words

- php functions (that are NOT related to database functions) named using camelCase


---PRIVATE & PUBLIC 

- private directory is for all files that are required for initial setup and development (e.g. db scripts)

- public directory is for files that gonna be visible for the user on the page (html, css etc.)


---SHARED & COMPONENTS FOLDERS

- shared folder contains parts of html pages (with PHP) that are shared among multiple pages on the website

- components folder contains pieces (components which are similar to structure in React) that are atomic and small, so that they can be 
combined together in order to make bigger parts which will be located within shared folder

- components are located in folders because in some cases there are mobile version of component; single components located in folders
as well for sake of consistency
