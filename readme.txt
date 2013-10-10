readme.txt

Documentation for the Widgeon Starting Point empty WordPress theme by Jesse Smith.
Version 1.4 was released on an unsuspecting world on July 23, 2013.
Visit jesse-smith.net for downloads and more information. 

A readme.txt is required by the ThemeCheck validator plugin, so I wrote one.

About this theme:

GPL licensed PHP source code

CSS is triple licensed under the GPL, MIT and "nobody cares" licenses.

Disclaimer: These files are provided "as-is" with the express understanding that they are not fit for any use or purpose, much less merchantability.  Use them at your own risk.    
Unfortunately, I am unable to provide free technical support for this theme.  However, your constructive feedback is welcome.  


Editing the sidebars to suit your layout.

By default, the Widgeon Starting Point comes with sidebars enabled on both sides of the main content area.  Just create and save your menus, and add menus and widgets to your sidebars, as you would normally.  
If you only want one sidebar, or if you do not want any sidebars, edit the file functions.php.
For  example, imagine you only want a sidebar on the right-hand side.  
First, look within functions.php for the function named “widgeon_sidebar_registration.”  There, you will delete or comment out the entire function call to register_sidebar where the array contains the id, “sideNavLeft.”  
Next, find the function named “wpfme_has_sidebar” and delete or comment out the line that adds the left-hand sidebar id to the body classes array:
$classes[] = "hasLeftNav";
That’s it!  Those pesky sidebars will be gone from your layout.
