<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/style_index.css" />
</head>
<body>

<div class="container">
					<div class="header">
<div class = "logo">
<a href="index.php">Get a Life</a>
 <!-- end .logo --></div>
 	<!-- end .header --></div>
  <div class="sidebar1">

    <p> The above links demonstrate a basic navigational structure using an unordered list styled with CSS. Use this as a starting point and modify the properties to produce your own unique look. If you require flyout menus, create your own using a Spry menu, a menu widget from Adobe's Exchange or a variety of other javascript or CSS solutions.</p>
    <p>If you would like the navigation along the top, simply move the ul.nav to the top of the page and recreate the styling.</p>
    <!-- end .sidebar1 --></div>
  <div class="content">
    <h1>Instructions</h1>
    <p>Be aware that the CSS for these layouts is heavily commented. If you do most of your work in Design view, have a peek at the code to get tips on working with the CSS for the fixed layouts. You can remove these comments before you launch your site. To learn more about the techniques used in these CSS Layouts, read this article at Adobe's Developer Center - <a href="http://www.adobe.com/go/adc_css_layouts">http://www.adobe.com/go/adc_css_layouts</a>.</p>
    <h2>Clearing Method</h2>
    <p>Because all the columns are floated, this layout uses a clear:both declaration in the .footer rule. This clearing technique forces the .container to understand where the columns end in order to show any borders or background colors you place on the .container. If your design requires you to remove the .footer from the .container, you'll need to use a different clearing method. The most reliable will be to add a &lt;br class=&quot;clearfloat&quot; /&gt; or &lt;div  class=&quot;clearfloat&quot;&gt;&lt;/div&gt; after your final floated column (but before the .container closes). This will have the same clearing effect.</p>
    <h3>Logo Replacement</h3>
    <p>An image placeholder was used in this layout in the .header where you'll likely want to place  a logo. It is recommended that you remove the placeholder and replace it with your own linked logo. </p>
    <p> Be aware that if you use the Property inspector to navigate to your logo image using the SRC field (instead of removing and replacing the placeholder), you should remove the inline background and display properties. These inline styles are only used to make the logo placeholder show up in browsers for demonstration purposes. </p>
    <p>To remove the inline styles, make sure your CSS Styles panel is set to Current. Select the image, and in the Properties pane of the CSS Styles panel, right click and delete the display and background properties. (Of course, you can always go directly into the code and delete the inline styles from the image or placeholder there.)</p>
    <!-- end .content --></div>
<? include("footer.php");?>
  <!-- end .container --></div>
</body>
</html>