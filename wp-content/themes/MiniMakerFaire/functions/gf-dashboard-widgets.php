<?php
////////////////////////////////////////////////////////////////////
// Remove unwanted dashboard widgets for relevant users
////////////////////////////////////////////////////////////////////

  function remove_dashboard_widgets() {
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );

  }
  add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );


////////////////////////////////////////////////////////////////////
// Add new dashboard widget
////////////////////////////////////////////////////////////////////
  function add_dashboard_widgets() {
    //add_meta_box( 'dashboard_welcome', 'Welcome! Let’s get started:', 'add_welcome_widget', 'dashboard', 'normal', 'high' );
    add_meta_box('rg_forms_dashboard','Forms',array( 'RGForms', 'dashboard' ),'dashboard','side' );
  }

  /*function add_welcome_widget(){ ?>

<img style="float:right;" src="https://makerfaire.com/wp-content/uploads/2015/03/MF-Relations_Icon_SetUp.jpg" alt="MF-Relations_Icon_SetUp" width="75" height="75" align="left" hspace="10" />

The left navigation bar is your control center for your site.
 <ol>
    <li><strong>General Site Setup</strong></li>
  <p>Go to Appearance &gt; Customize</p>
       <ul style="list-style: none;">
            <li>Add / Update your logo</li>
            <li>Update your Main Menu / Header</li>
            <li>Add CTA (Call to Action) button to the right of the Main Menu</li>
            <li>Update your Footer</li>
            <li>...and more - look around!</li>
        </ul>
  <p></p>
    <li><strong>Specific Page Setup</strong></li>
 <p>Go to Pages &gt; All Pages</p>
       <ul style="list-style: none;">
            <li>Add, remove, or update pages</li>
            <li>The Homepage it built with panels. Click on Pages &gt; Home to view, edit add or remove panels. You can also drag and drop what order they appear in. </li>
  <p></p>
  <p>TIP: Explore panels and see how they work. You can use them throughout most your site. They are easy to use and will make your site look great!</p>
  <p></p>
            <li>Some pages have pre-loaded templates (Contact, News, Meet the Makers, Schedule, etc). Each one is a little different. You can&rsquo;t add panels to these pages because they are pre-designed to look good.</li>
            <li>The remainder of the pages are blank. You can choose to add panels or whatever text or image you would like. There are simple visual editors or HTML editing. These pages are wide open for you to use as needed. You can add more, by going to Pages &gt; Add New.</li>
  </ul>
  <p></p>
    <li><strong>Header and Footer, including site navigation (aka: menus)</strong></li>
       <ul style="list-style: none;">
            <li>Menus can be edited in two places: </li>
               <ul>
                    <li>Appearance &gt; Customize</li>
                    <p>or</p>
                    <li>Appearance &gt; Menu </li>
               </ul>
             <li>There are 2 Menus</li>
                <ul>
                    <li>Main Menu (at the top in the Header)</li>
                    <ul>
                         <li>Add up to 6 main menu items</li>
                         <li>Create as many submenu items as you choose</li>
                    </ul>
                    <li>Footer Menu (at the bottom, on the left side of the footer.)</li>
                    <ul>
                         <li>Add up to 4 footer menu items</li>
                         <li>Social icons are updated in Appearance &gt; Customize &gt; Footer Social Media Links</li>
                    </ul>
                 </ul>
            </ul>
  <p></p>
    <li><strong>Media Library (Images and Files)</strong></li>
       <ul style="list-style: none;">
           <li>Optional: If you have a previous WordPress site, you can export your Media Library and Import into this site. <a href="https://codex.wordpress.org/Tools_Export_Screen" target="_blank">Export instructions</a> and <a href="https://codex.wordpress.org/Tools_Import_Screen" target="_blank">Import instructions</a>(works best if you export everything all together in the export screen, then import that file).</li>
           <li>If you don&rsquo;t have images from previous faires to use on your site, you can use any image in <a href="https://www.dropbox.com/sh/4mul17k070tts66/AAAqx9W6k8dNY3YsJN7--Tfda" target="_blank">this Dropbox:</a></li>
       </ul>
  <p></p>
     <li><strong>News (aka: Posts or Blog)</strong></li>
       <ul style="list-style: none;">
           <li>To create news, go to Posts &gt; All Posts. </li>
           <li>We have one sample post in there: Hello world! </li>
           <li>To see how posts will look, check out the test site at <a href="http://global.makerfaire.com/">http://global.makerfaire.com/</a>. Click on News in the Header.</li>
           <li>Optional: If you have a previous WordPress site, you can export your Posts and Import them into this site. <a href="https://codex.wordpress.org/Tools_Export_Screen" target="_blank">Export instructions</a> and <a href="https://codex.wordpress.org/Tools_Import_Screen" target="_blank">Import instructions</a>(works best if you export everything all together in the export screen, then import that file).</li>
           <li>Once you start creating blog posts, add the &ldquo;News&rdquo; Panel to your Homepage (Pages &gt; Home &gt; Post Feed) and a dynamic panel will start populating your News onto your Homepage. You can also see a sample of this here: <a href="http://global.makerfaire.com/">http://global.makerfaire.com/</a>.</li>
         </ul>
  <p></p>
     <li><strong>Call for Makers Form</strong></li>
       <ul style="list-style: none;">
            <li>Your site comes with a Form creator and editor to create your Call for Makers Form. Go to Forms &gt; Forms</li>
            <li>We&rsquo;ve provided a Sample Call for Makers Form you can copy and edit. </li>
            <li>There are handful of fields we&rsquo;ve locked, because there&rsquo;s logic used in the site to display those fields dynamically on pages.</li>
            <li>All of the other fields you can edit.</li>
            <li>Feel free to add questions that are specific to your event or remove questions that are not relevant. </li>
            <li>Many of the fields (questions) are conditional and appear only when the maker selects specific answers to questions in the form. To adjust conditional settings, in your form click on a question and go to the &ldquo;Advanced&rdquo; tab.</li>
            <li>You can hide fields from the public (but still use them in the admin view) by marking them &ldquo;Admin Only&rdquo;. Click on a question and go to the &ldquo;Advanced&rdquo; tab.</li>
         </ul>
  <p></p>
  <p>TIP 1: To view the live version of your form go to Pages &gt; Call for Makers Form &gt; View Page. (You can keep the page Private until your form is ready.)</p>
  <p></p>
  <p>TIP 2: Dive in. There&rsquo;s SO much you can do with Gravity Forms. The best way to learn is to start.</p>
  <p></p>
    <li><strong>Reviewing Entries / Entry UI</strong></li>
       <ul style="list-style: none;">
           <li>Go to Forms &gt; Forms &gt; Entries</li>
           <li>The first view that appears is your Entry List.</li>
  <p></p>
  <p>TIP: Modify the columns that appear in your List View by clicking the gear icon at the top right of the list. We recommend these columns: Project Name or Title, Project Photo, Entry ID, Status, Type of Proposal, Maker 1 First Name, Maker 1 Last Name, Group Name, Entry Date</p>
  <p></p>
           <li>Click on the Project Name or Title to view the specific entry details.</li>
         </ul>
    <p></p>
  <p>Important:&nbsp;Additional Entry UI features are coming within the next two weeks! Status updates, Rating entries, Comments, and more&hellip;. Stay tuned</p>
  <p></p>
    <li><strong>Exporting Entries / Reports</strong></li>
       <ul style="list-style: none;">
           <li>To Export Entries, go to Forms &gt; Import / Export</li>
           <li>This feature will download a complete report of all entry fields.</li>
         </ul>
  </ol>
  <p></p>
  <p>Look around and start clicking.<br />
  There&rsquo;s a lot you can do to customize your site. <br />
  Get started!</p>
  <img style="width:100%;height:auto;" src="/wp-content/themes/MiniMakerFaire/img/makey_panel-br.png" />

  <?php }*/
  add_action( 'wp_dashboard_setup', 'add_dashboard_widgets' );