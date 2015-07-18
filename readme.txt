
Tabula Rasa Theme
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
The Tabula Rasa Theme is a WordPress theme that has very little style applied to it, nor any extra mark-up that doesn't directly support the content or functionality of the the theme. It does, however, support multiple menus using WordPress' menu function.

This theme does not come with any type of warranty or guarantee however. If you run into problems, let me know, I will certainly do my best to help out, I just can't guarantee this theme will work for your specific intended purpose. 



Settings, Defaults and Customization
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Tabula Rasa uses a variety of sidebar widgets to help customize content pages and posts. To help optimize these features, please make these adjustments in Settings > Media BEFORE uploading any images to the Media Library

•Set Thumbnail size to Width:150 (for 4 channel box templates) or 100 (for 3 channel box templates)
 Height:0 and uncheck the crop feature
•Set Medium size Max Width:235  Max Height:0
•Set Large size Max Width:0  Max Height:0 (Theme already creates a max width of 610 for video embeds)
•Uncheck "Organize my uploads into month- and year-based folders" (this helps with Header Customization, which is explained below)

All of these can be adjusted of course, but bear in mind you will need to reflect these adjustments in CSS.


Header Customization
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
The Header can be customized in a variety of ways. First of course, is  the standard Header Admin page under Appearance. This excellent tool provides a handy way to crop any image and set as the global header for the site. However, you can also add a Custom Field to create custom headers on a per page or post basis. If you do not see the Custom Field on an Edit Page, select the Screen Options tab and select the Custom Field checkbox. 

•First upload an image to the Media Library (Media > Add New) that is exactly the same width and height in pixels as the current default header (in Appearance > Header). When uploaded, copy the name of the file including suffix.

•Second, add a Custom Field on the page or post that is getting the custom header called
page-banner and paste in the name of the new image (including suffix) into the Value field.

There are a few caveats with using the page-banner Custom Field. You must upload an image first.  And, the image must be the exact dimensions of the current header or it will distort.



Portal or Channel Boxes
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
These Channel boxes on each homepage template use the Excerpt feature to get their content. If you do not see the Excerpt box on an Edit Page, select the Screen Options tab and select the Excerpt checkbox. Channel Boxes utilize Featured Images which can be added in the Edit Page or Post page.

To assign which page or post goes in which Channel Box, you will be adding a Custom Field to the appropriate page.

•Go to Edit Page or Post, and add a Custom Field Key called channel-box and add a 1, 2, 3, or 4 for the appropriate sequence value.



Custom CSS
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Pages and Posts can get further customization with CSS that adds or overwrites the current CSS.

•Go to Appearance Editor for the parent stylesheet, and select under Styles one of the ten blank css stylesheets. Make your necessary css edits and save the stylesheet. Make a note of its name.

•Go to Edit Page or Post, and add a Custom Field Key called css and add the stylesheet name (without suffix) for the value.



Menus
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Tabula Rasa uses multiple menu "channels" that provide a portal-type experience for  the user. When setting up your site, you will need to create menus (Appearance > Menus) and assign those menus in the Theme Locations area of Menus. You can add classes to individual menu items by enabling Classes with the Screen Options Tab. Class names to use include ch-menu-first (for channel menus) and footernavfirst (for the footer menu). By adding these classes to the first menu item for any of the Channel menus or Footer menu, you will avoid the doubling up of left hand borders.



Widgets
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Tabula Rasa uses nine areas for widgets. They include Header, Home Info, Extras, Channels 1-4, and Footer. In addition to the default widgets. Tabula Rasa also uses a Featured Image Widget, that takes the featured image applied to a page and renders it in a widget.




Change Log
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
1.0 Released
1.1 Added 3rd Level to Dropdown menus.




For more information please visit http://www.banyanstudio.net/