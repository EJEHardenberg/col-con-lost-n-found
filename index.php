<?php 
$pageTitle = '- Welcome';
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
					<li><a href="#lost-items">Submitting a lost item</a></li>
					<li><a href="#found-items">Submitting a found item</a></li>
					<li><a href="#searching">Searching the inventory</a></li>
				</ul>	
				<div>
					<h2 id="start">Where to start</h2>
					<p>
						This Lost &amp; Found tool is intended to assist at 
						raves, conventions, and other events. To start, you'll 
						need to <a href="locations.html">create an event location</a>. 
					</p>
					<p>
						Once you've created a location, you can start defining 
						properties of items that might get lost, this application 
						comes with a few generic terms pre-defined, but you can 
						add more using the <a href="criteria.html">Manage Criteria</a>
						page.
					</p>
					<p>
						After that you're ready to go!
					</p>
				</div>
				<div>
				<div>
					<h2 id="lost-items">Submitting a lost item</h2>
					<p><!-- TODO: Fill out with screen shots and etc --></p>
				</div>
				<div>
					<h2 id="found-items">Submitting a found item</h2>
					<p><!-- TODO: Fill out with screen shots and etc --></p>
				</div>
				<div>
					<h2 id="searching">Searching the inventory</h2>
					<p><!-- TODO: Fill out with screen shots and etc --></p>
				</div>
			</div>
		</div><!-- end what was started in the header -->

<!-- OLD STUFF BELOW HERE FOR NOW -->

		<section>
			<h2>Search Criteria</h2>
			<p>
				Narrow down the search by typing key words below (try a color or 3, an item type)
			</p>
			<form>
				<!-- Search Options Here... enable once spreadsheet data loads -->
				<label>
					<input type="checkbox" id="features">
				</label>
				<label title="Check the box to apply the filter">
					<input type="checkbox" id="show-found-apply" />
					Show list items marked as 
				</label>
				<select id="show-found">
					<option>No</option>
					<option>Yes</option>
				</select>
				<br/>
				<label>
					<input type="checkbox" id="item-type-apply" />
					Item type?
				</label>
				<select id="item-type">
					<option>Other</option>
					<option>Badge</option>
					<option>Camera</option>
					<option>Bag</option>
					<option>Phone</option>
					<option>Clothing</option>
				</select>

				<fieldset>
					<legend>Colors</legend>
						<label>
							<input type="checkbox" name="colors" value="Black" />
							Black
						</label>
						<label>
							<input type="checkbox" name="colors" value="White" />
							White
						</label>
						<label>
							<input type="checkbox" name="colors" value="Blue" />
							Blue
						</label>
						<label>
							<input type="checkbox" name="colors" value="Yellow" />
							Yellow
						</label>
						<label>
							<input type="checkbox" name="colors" value="Green" />
							Green
						</label>
						<label>
							<input type="checkbox" name="colors" value="Red" />
							Red
						</label>
						<label>
							<input type="checkbox" name="colors" value="Purple" />
							Purple
						</label>	
						<label>
							<input type="checkbox" name="colors" value="Grey" />
							Grey
						</label>
				</fieldset>
				<fieldset>
					<legend>Lost in</legend>
					<label>
						<input type="checkbox" name="locations" value="Dealers Room">
						Dealers Room
					</label>
					<label>
						<input type="checkbox" name="locations" value="Main Event Room">
						Main Event Room
					</label>
					<label>
						<input type="checkbox" name="locations" value="Panel Room">
						Panel Room
					</label>
					<label>
						<input type="checkbox" name="locations" value="Artist Alley">
						Artist Alley
					</label>
					<label>
						<input type="checkbox" name="locations" value="Bathrooms">
						Bathrooms
					</label>
					<label>
						<input type="checkbox" name="locations" value="Hallways">
						Hallways
					</label>
					<label>
						<input type="checkbox" name="locations" value="Other">
						Other:
					</label>
					<input type="text" id="locations-other">
				</fieldset>

				<fieldset>
					<legend>Which day was it lost</legend>
					<label>
						<input type="checkbox" name="day-lost" value="Thursday" />
						Thursday
					</label>
					<label>
						<input type="checkbox" name="day-lost" value="Friday" />
						Friday
					</label>
					<label>
						<input type="checkbox" name="day-lost" value="Saturday" />
						Saturday
					</label>
					<label>
						<input type="checkbox" name="day-lost" value="Sunday" />
						Sunday
					</label>
				</fieldset>

				<button id="search" type="button">Search</button>
			</form>
		</section>

		<section>
			<h2>Lost Items</h2>
			<table class="widefat" id="lost-items"></table>
		</section>

		<section>
			<h2>Found Items</h2>
			<table class="widefat" id="found-items"></table>
		</section>

		<script type="text/javascript">

			document.getElementById("search").onclick = function(){
				var iType = document.getElementById("item-type").value
				var lostTable = document.getElementById("lost-items").tBodies[0].rows
				var foundTable = document.getElementById("found-items").tBodies[0].rows
				var showFound = document.getElementById("show-found").value

				/*Clear Previous Filters and then search*/
				for (var i = lostTable.length - 1; i >= 0; i--) {
					lostTable[i].className = ""
				};
				for (var i = foundTable.length - 1; i >= 0; i--) {
					foundTable[i].className = ""
				};

				if( document.getElementById("show-found-apply").checked )
					filterLostThatHaveBeenFound(showFound)
				
				if( document.getElementById("item-type-apply").checked )
					filterType(iType)

				var colorInputs = document.getElementsByName("colors")
				var colors = []
				for (var i = colorInputs.length - 1; i >= 0; i--) {
					if( colorInputs[i].checked )
						colors.push( colorInputs[i].value )
				};
				if(colors.length > 0)
					filterColor(colors.sort())

				/* Optimization that could be done: use object and check 
				 * properties instead of using an indexOf O(n) to O(1) 
				 * time
				 */
				var locationInputs = document.getElementsByName("locations")
				var locations = []
				for (var i = 0; i < locationInputs.length; i++) {
					if( locationInputs[i].checked )
						locations.push( locationInputs[i].value )
				};
				if( locations.length > 0)
					filterLocations(locations)

				var dayLostInputs = document.getElementsByName("day-lost")
				var dayLosts = []
				for (var i = 0; i < dayLostInputs.length; i++) {
					if( dayLostInputs[i].checked ) 
						dayLosts.push( dayLostInputs[i].value )
				};
				if( dayLosts.length > 0)
					filterByDayLost(dayLosts)
			}

			/* If it's not a match by some filter than toss it! */
			function getHideClass(currentClass, desiredClass){
				if(currentClass == desiredClass)
					return desiredClass
				if(currentClass == "match")
					return currentClass
				return desiredClass
			}

			function filterByDayLost(dayLosts){
				var lostRows = document.getElementById("lost-items").tBodies[0].rows
				var foundRows = document.getElementById("found-items").tBodies[0].rows

				var lostLocationColumn = 8
				var foundLocationColumn = 7

				for (var i = 0; i < lostRows.length; i++) {
					var cellDay = lostRows[i].cells[lostLocationColumn].textContent
					if ( dayLosts.indexOf(cellDay) == -1 ) //no matches
						lostRows[i].className = getHideClass(lostRows[i].className,"hide")
					else
						lostRows[i].className = getHideClass(lostRows[i].className, "match")
				};
				for (var i = 0; i < foundRows.length; i++) {
					var cellDay = foundRows[i].cells[foundLocationColumn].textContent
					if ( dayLosts.indexOf(cellDay) == -1 ) //no matches
						foundRows[i].className = getHideClass(foundRows[i].className,"hide")
					else
						foundRows[i].className = getHideClass(foundRows[i].className, "match")
					
					
				};


			}

			function filterLocations(locations){
				var lostRows = document.getElementById("lost-items").tBodies[0].rows
				var foundRows = document.getElementById("found-items").tBodies[0].rows

				var lostLocationColumn = 6
				var foundLocationColumn = 2

				var otherSearch = locations.indexOf("Other") != -1;
				var otherVal = document.getElementById("locations-other").value
				
				if(otherSearch)
					delete locations[locations.indexOf("Other")]
				

				for (var i = 0; i < lostRows.length; i++) {
					var location = lostRows[i].cells[lostLocationColumn].textContent
					if(otherSearch){
						if ( location.toUpperCase().search(otherVal.toUpperCase()) == -1 ) //no matches
							lostRows[i].className = getHideClass(lostRows[i].className,"hide")
						else
							lostRows[i].className = getHideClass(lostRows[i].className, "match")
					}
					if ( locations.indexOf(location) == -1 ) //no matches
						lostRows[i].className = getHideClass(lostRows[i].className,"hide")
					else
						lostRows[i].className = getHideClass(lostRows[i].className, "match")
				};
				for (var i = 0; i < foundRows.length; i++) {
					var location = foundRows[i].cells[foundLocationColumn].textContent
					if(otherSearch){
						if ( location.toUpperCase().search(otherVal.toUpperCase()) == -1 ) //no matches
							foundRows[i].className = getHideClass(foundRows[i].className,"hide")
						else
							foundRows[i].className = getHideClass(foundRows[i].className, "match")
					}
					if ( locations.indexOf(location) == -1 ) //no matches
						foundRows[i].className = getHideClass(foundRows[i].className,"hide")
					else
						foundRows[i].className = getHideClass(foundRows[i].className, "match")		
				};
			}

			function filterLostThatHaveBeenFound(yesNo){
				var lostRows = document.getElementById("lost-items").tBodies[0].rows			
				var lostFoundColumn = 10

				for (var i = 0; i < lostRows.length; i++) {
					var rowColors = lostRows[i].cells[lostFoundColumn].textContent.split(",")
					

					if ( lostRows[i].cells[lostFoundColumn].textContent == yesNo ) //no matches
						lostRows[i].className = getHideClass(lostRows[i].className,"match")
					else
						lostRows[i].className = getHideClass(lostRows[i].className, "hide")
					
				};
			}

			/* Note: Requires sorted arrays */
			function array_intersection(a, b){
			  var ai=0, bi=0;
			  var result = new Array();

			  while( ai < a.length && bi < b.length ){
			     if      (a[ai] < b[bi] ){ ai++; }
			     else if (a[ai] > b[bi] ){ bi++; }
			     else /* they're equal */{
			       result.push(a[ai]);
			       ai++;
			       bi++;
			     }
			  }

			  return result;
			}

			function filterColor(colors){
				var lostTable = document.getElementById("lost-items")
				var foundTable = document.getElementById("found-items")
				var lostRows = lostTable.tBodies[0].rows
				var foundRows = foundTable.tBodies[0].rows

				var lostColorColumn = 4
				var foundColorColumn = 5

				for (var i = 0; i < lostRows.length; i++) {
					var rowColors = lostRows[i].cells[lostColorColumn].textContent.split(",")
					for (var j = rowColors.length - 1; j >= 0; j--) {
						rowColors[j] = rowColors[j].trim()
					};

					if ( array_intersection(colors, rowColors).length == 0 ) //no matches
						lostRows[i].className = getHideClass(lostRows[i].className,"hide")
					else
						lostRows[i].className = getHideClass(lostRows[i].className, "match")
					
				};
				for (var i = 0; i < foundRows.length; i++) {
					var rowColors = foundRows[i].cells[foundColorColumn].textContent.split(",")
					for (var j = rowColors.length - 1; j >= 0; j--) {
						rowColors[j] = rowColors[j].trim()
					};
					if ( array_intersection(colors, rowColors).length == 0 ) //no matches
						foundRows[i].className = getHideClass(foundRows[i].className,"hide")
					else
						foundRows[i].className = getHideClass(foundRows[i].className, "match")
					
				};
			}
 
 			/* Filter by item type */
			function filterType(val){
				var lostTable = document.getElementById("lost-items")
				var foundTable = document.getElementById("found-items")

				var lostRows = lostTable.tBodies[0].rows
				var foundRows = foundTable.tBodies[0].rows

				/* The 4th Column for Lost Rows is for type */
				var lostTypeColumn = 3 //4th column
				var foundTypeColumn = 6 //7th column

				if( val == "Other" ){
					/* Loop through table rows hiding anything not an 'other' */
					for (var i = lostRows.length - 1; i >= 0; i--) {
						var lType = lostRows[i].cells[lostTypeColumn].textContent
						switch ( lType ){
							case "Badge": case "Camera": case "Bag": case "Phone": case "Clothing":
							lostRows[i].className = getHideClass(lostRows[i].className,"hide")
							break;
							default:
							lostRows[i].className = getHideClass(lostRows[i].className, "match")
						}
					};
					for (var i = foundRows.length - 1; i >= 0; i--) {
						var lType = foundRows[i].cells[foundTypeColumn].textContent
						switch ( lType ){
							case "Badge": case "Camera": case "Bag": case "Phone": case "Clothing":
							foundRows[i].className = getHideClass(foundRows[i].className,"hide")
							break;
							default:
							foundRows[i].className = getHideClass(foundRows[i].className, "match")
						}
					};
				}else{
					for (var i = lostRows.length - 1; i >= 0; i--) {
						var lType = lostRows[i].cells[lostTypeColumn].textContent
						switch ( lType ){
							case val:
								lostRows[i].className = getHideClass(lostRows[i].className, "match")
							break;
							default:
								lostRows[i].className = getHideClass(lostRows[i].className,"hide")
						}
					};
					for (var i = foundRows.length - 1; i >= 0; i--) {
						var lType = foundRows[i].cells[foundTypeColumn].textContent
						switch ( lType ){
							case val:
								foundRows[i].className = getHideClass(foundRows[i].className, "match")
							break;
							default:
								foundRows[i].className = getHideClass(foundRows[i].className ,"hide")
						}
					};
				}
			}


			document.getElementById("load-lost").onclick = function loadDataButton(evt){

				var lostFormLink = "https://docs.google.com/spreadsheet/pub?key=0ApyDdTxMT4sPdEgtaFdyY25oM0lLeVZvZE54Q052V2c&single=true&gid=0&output=csv&alt=json-in-script&callback=loadLostData"

				var xmlHttp = null
				var ref = this;
		    	xmlHttp = new XMLHttpRequest()
		    	xmlHttp.onreadystatechange = function(){
		    		if( xmlHttp.readyState == 4 ){
		    			loadData(xmlHttp.response, "lost-items")
		    		}
		    	}
		    	xmlHttp.open( "GET", lostFormLink , true )
		    	xmlHttp.send( null )


				var foundFormLink = "https://docs.google.com/spreadsheet/pub?key=0ApyDdTxMT4sPdGpuQWt5YXFGa19mWEhSeUZPdE5kMmc&single=true&gid=0&output=csv&alt=json-in-script&callback=loadFoundData"

				var xmlHttp2 = null
				var ref = this;
		    	xmlHttp2 = new XMLHttpRequest()
		    	xmlHttp2.onreadystatechange = function(){
		    		if( xmlHttp2.readyState == 4 ){
		    			loadData(xmlHttp2.response,"found-items")
		    		}
		    	}
		    	xmlHttp2.open( "GET", foundFormLink , true )
		    	xmlHttp2.send( null )
			}

			/* Load the data via callback into the two DOM elements */
			function loadData(csv,id){
				var data = CSVToArray(csv,",")
				var lostColorColumn = 4
				var foundColorColumn = 5
				var sortCol
				if(id == "lost-items")
					sortCol = lostColorColumn
				else
					sortCol = foundColorColumn

				/* Create the lost table that we'll search through */
				var table = document.getElementById(id)
				
				/* Table Head */
				var thead = document.createElement("thead")
				var theadTr = document.createElement("tr")
				for (var i = 0; i < data[0].length; i++) {
					var th = document.createElement("th")
					var text = document.createTextNode(data[0][i])
					th.appendChild(text)
					theadTr.appendChild(th)
				};
				thead.appendChild(theadTr)

				/* Table Row Data */
				var tbody = document.createElement("tbody")
				for (var i = 1; i < data.length; i++) {
					var tr = document.createElement("tr")
					for (var j = 0; j < data[i].length; j++) {
						/*Sort the text if colors column*/
						if(j == sortCol)
							data[i][j] = data[i][j].split(",").map(function(item){return item.trim()}).sort().join(",")
						var td = document.createElement("td")
						var text = document.createTextNode(data[i][j])
						td.appendChild(text)
						tr.appendChild(td)
					};
					tbody.appendChild(tr)
				};

				
				table.innerHTML = ""
				table.appendChild(thead)
				table.appendChild(tbody)
			}

			// This will parse a delimited string into an array of
		    // arrays. The default delimiter is the comma, but this
		    // can be overriden in the second argument.
		    function CSVToArray( strData, strDelimiter ){
		    	strDelimiter = (strDelimiter || ",");
		    	var objPattern = new RegExp((
		    			// Delimiters.
		    			"(\\" + strDelimiter + "|\\r?\\n|\\r|^)" +
		    			// Quoted fields.
		    			"(?:\"([^\"]*(?:\"\"[^\"]*)*)\"|" +
		    			// Standard fields.
		    			"([^\"\\" + strDelimiter + "\\r\\n]*))"),"gi");
		    	var arrData = [[]];
		    	var arrMatches = null;
		    	while (arrMatches = objPattern.exec( strData )){
		    		var strMatchedDelimiter = arrMatches[ 1 ];
		    		if (
		    			strMatchedDelimiter.length &&
		    			(strMatchedDelimiter != strDelimiter)
		    			){
		    			arrData.push( [] );
		    		}
		    		if (arrMatches[ 2 ]){
		    			var strMatchedValue = arrMatches[ 2 ].replace(
		    				new RegExp( "\"\"", "g" ),"\"");
		    		} else {
		    			var strMatchedValue = arrMatches[ 3 ];
		    		}
		    		arrData[ arrData.length - 1 ].push( strMatchedValue );
		    	}
		    	return( arrData );
		    }

		</script>
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
