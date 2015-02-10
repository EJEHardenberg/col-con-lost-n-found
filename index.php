<?php 
$pageTitle = '- Welcome';
include dirname(__FILE__) . '/shared/core.php';
include dirname(__FILE__) . '/shared/header.php';

?>
			<div class="view-wrap">
				<h1>How to use this tool</h1>
				<p>
					If you have any issues or find any bugs please report them to 
					me on <a href="https://github.com/EdgeCaseBerg/col-con-lost-n-found">github here</a>
				</p>
				<ul>
					<li><a href="#start">Where to start</a></li>
					<li><a href="#report-items">Reporting an item</a></li>
					<li><a href="#searching">Searching the inventory</a></li>
					<li><a href="#advsearch">Advance Search</a></li>
				</ul>	
				<div>
					<h2 id="start">Where to start</h2>
					<p>
						This Lost &amp; Found tool is intended to assist at 
						raves, conventions, and other events. To start, you'll 
						need to <a href="criteria.php">create an event location</a>. 
					</p>
					<p>
						Once you've created a location, you can start defining 
						properties of items that might get lost, this application 
						comes with a few generic terms pre-defined, but you can 
						add more using the <a href="criteria.php">Manage Criteria</a>
						page.
					</p>
					<p>
						After that you're ready to go!
					</p>
				</div>
				<div>
				<div>
					<h2 id="report-items">Reporting an item</h2>
					<p>
						To report an item (lost or found), navigate to
						the <a href="report-item.php">Report page</a>
						and fill out the form.  
					</p>
					<img src="/images/lost.png" width="600px" />
					<p>
						If you have access to the server configuration
						files, you can shut off the sidebar navigation
						on the page via the REPORT_ITEM_NO_BAR define.
						Setting this to true will remove the sidebar. 
						If you don't have access, contact your system
						administrator.
					</p>
					<p>
						In most web browsers, the page can be maximized
						via the F11 key. Doing this with no sidebar will
						give your form a more kiosk-like appearance. For
						most users this will likely be desireable.
					</p>
				</div>
				<div>
					<h2 id="searching">Searching the inventory</h2>
					<p>
						The <a href="/inventory.php">inventory screen</a> 
						is where you can perform simple text searches 
						against the name and description of the various
						items. 
					</p>
					<img src="/images/inventory.png" width="600px">
					<p>
						When you are in this screen, or the search results 
						screen, click an item name to be taken to the 
						item's page.
					</p>
					<img src="/images/item.png" width="600px">
				</div>
				<div>
					<h2 id="advsearch">Advanced Search</h2>
					<p>
						If the text search on name and description fields
						is not enough to find an item, you can use the 
						advanced search page to find items with specific 
						features. 
					</p>
					<img src="/images/advsearch.png" width="600px">
					<p>
						This can be helpful since someone may mark down 
						the colors (for example) of an object while 
						describing specifics that doesn't fit your precreated 
						features in the description.
					</p>
					
				</div>
			</div>
		</div><!-- end what was started in the header -->
		<link rel="stylesheet" type="text/css" href="flakes/bower_components/prism/themes/prism.css">
        <link rel="stylesheet" type="text/css" href="flakes/bower_components/gridforms/gridforms/gridforms.css">

        <script src="/flakes/bower_components/jquery/dist/jquery.js"></script>
        <script src="/flakes/bower_components/snapjs/snap.js"></script>
        <script src="/flakes/bower_components/responsive-elements/responsive-elements.js"></script>
        <script src="/flakes/bower_components/gridforms/gridforms/gridforms.js"></script>

        <script src="/flakes/js/base.js"></script>
        <script src="/flakes/js/utils.js"></script>

	</body>
</html>
