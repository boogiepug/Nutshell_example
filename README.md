# Nutshell_example
This is a repository to store example project made for Nutshell Apps, by Szymon Kosowski

Website is made to clone the functionalities of websites like allrecipes.co.uk and other recipes websites
Project was done in HTML, CSS, JavaScript, and PHP. Each of these elements have been written by hand, while parts that have not been
are visibly linked to the source link. The site has following functionalitis:

All recipes list - On left side present is a list of all recipes stored in database. This list is created dynamically using PHP and locally stored database.
Above the list there is a text input box that allows for real time filtering of the list by the name, or tags.
Clicking on any option will bring it to the main recipe area.
Hovering over the options will smoothly highlight them as well.

Try now!! side track - Rightmost animated track is the most eye-catching functionality of the website. Images are scrolling from top to bottom,
and clicking on any item will bring it to the main recipe area. Hovering over any option will highlight it as well.
Images as well as titles of the dishes are dynamically created using PHP, and supplied from local database.

Main recipe area - Upon clicking on any recipe, it will be brought to this section to further be expanded and supplied with details and photo
When this occurs, an API request is sent. Details about this are in the API.php file.

Background and effects - Background is subtle gradient
