// style for table header with script
var x = document.createElement("Style");
var t = document.createTextNode("#fileName, #fileAuthor, #fileSize, #fileDate, #fileLike {cursor: pointer}");
x.appendChild(t);
document.head.appendChild(x);


// text of table header with script
var para1 = document.getElementById("fileName").innerHTML;
var para2 = document.getElementById("fileAuthor").innerHTML;
var para3 = document.getElementById("fileSize").innerHTML;
var para4 = document.getElementById("fileDate").innerHTML;
var para5 = document.getElementById("fileLike").innerHTML;


// set column-titles with sort-buttons in start position
var sortTitles = [para1, para2, para3, para4, para5];
var sortTitleIds = ["fileName", "fileAuthor", "fileSize", "fileDate", "fileLike"];
for (var i = 0; i < sortTitles.length; i++) {
	document.getElementById(sortTitleIds[i]).innerHTML = sortTitles[i] + " &#9650; &#9660;";
}


/* the following function sortTable(column) is inspired by: https://www.w3schools.com/howto/howto_js_sort_table.asp
 * sort the given column ascending (asc, aufsteigend) or descedant (desc, absteigend)
 */
function sortTable(column) {

	var table, rows, switching, i, x, y, shouldSwitch, dir;
	var switchcount = 0;
	table = document.getElementById("verzeichnistable");
	switching = true;
	dir = "asc";

	// set column-titles with sort-buttons in start position
	for (var i = 0; i < sortTitles.length; i++) {
		document.getElementById(sortTitleIds[i]).innerHTML = sortTitles[i] + " &#9650; &#9660;";
	}

	// loop continue, if in the taken column already unsort rows
	while (switching) {
		switching = false;
		rows = table.rows;

		/* compare every taken row with the next row
		 * shouldSwitch = false, if the two rows be in right order
		 * shouldSwitch = true, if the two rows be in wrong order
		 */
		for (i = 1; i < (rows.length - 1); i++) {
			shouldSwitch = false;

			// get input as comperator from gruppenordner.php by TD-Tag with taken column
			x = rows[i].getElementsByTagName("TD")[column].dataset.sortData;
			y = rows[i + 1].getElementsByTagName("TD")[column].dataset.sortData;

			// seperate string and integer as input
			if (column == 0 || column == 1) {
				x = x.toLowerCase();
				y = y.toLowerCase();
			} else {
				x = parseInt(x);
				y = parseInt(y);
			}

			/*
			 * compare x and y with asc or desc
			 * if: shouldSwitch = true
			 */
			if (dir == "asc") {
				if (x > y) {
					shouldSwitch = true;
					document.getElementById(sortTitleIds[column]).innerHTML = sortTitles[column] + " &#9650;";
					break;
				}
			} else if (dir == "desc") {
				if (x < y) {
					shouldSwitch = true;
					document.getElementById(sortTitleIds[column]).innerHTML = sortTitles[column] + " &#9660;";
					break;
				}
			}
		}

		// switch the two rows if shouldSwitch = true
		if (shouldSwitch) {
			rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
			switching = true;
			switchcount++;
		} else {
			/*If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again.*/
			if (switchcount == 0 && dir == "asc") {
				dir = "desc";
				switching = true;
			}
		}
	}
}
