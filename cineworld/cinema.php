<?php
include 'cineworld.php';
?>

<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
<title>Cineworld Listings For
<?php
if (isset($_GET["CINEMA"])) {
    $cinema_name = get_cinema_name($_GET["CINEMA"]);
    print $cinema_name;
}
?>
</title>
<link title="style" type="text/css" rel="stylesheet" href="iphone.css"/>

<?php
if (isset($_GET["CINEMA"])) {
    get_films($_GET["CINEMA"]);
?>

<script type="text/javascript">
<!--
function renderEntries()
{
    var output = document.getElementById("listings");
    //document.writeln("length: " + entries.films.length);
    /*
    document.writeln("length: " + testEntries.prefs.length + "<br>");
    for(var i = 0; i < testEntries.prefs.length; i++) {
        document.writeln("title: " + testEntries.prefs[i].title + "<br>");
        document.writeln("director: " + testEntries.prefs[i].director + "<br>");
    }
    */
        
    if (entries.length == 0)
    {
        var li = document.createElement("li");
        li.appendChild(document.createTextNode("There are no films for this cinema."));
        output.appendChild(li);
    }
    else
    {
        var li;
        var img;        
        for(var i = 0; i < entries.films.length; i++) {
            ul = document.createElement("ul");
            li = document.createElement("li");
            
            table = document.createElement("table");
            td = document.createElement("td");
            td.valign = "top";
            
            img = document.createElement("img");
            img.src = "http://www.cineworld.co.uk" + entries.films[i].image_location;
            td.appendChild(img);
            
            td2 = document.createElement("td");
            bTitle = document.createElement("b");
            bTitle.appendChild(document.createTextNode(entries.films[i].title));
            
            td2.appendChild(bTitle);
            td2.appendChild(document.createElement("br"));
            td2.appendChild(document.createTextNode(entries.films[i].director));
            td2.appendChild(document.createElement("br"));
            
            for(var y = 0; y < entries.films[i].starring.length; y++) {
                td2.appendChild(document.createTextNode(entries.films[i].starring[y] + " "));                
            }
            td2.appendChild(document.createElement("br"));
            
            for(var z = 0; z < entries.films[i].times.length; z++) {
                td2.appendChild(document.createTextNode(entries.films[i].times[z] + " "));                
            }
            td2.appendChild(document.createElement("br"));
            
            tr = document.createElement("tr");
            tr.appendChild(td);
            tr.appendChild(td2);            
            table.appendChild(tr);            
            li.appendChild(table);           
            ul.appendChild(li);   
            output.appendChild(ul);
        }
    }    
}
//--!>
</script>

</head>
<body onload="javascript:renderEntries()">
<h1>Cineworld Listings For <?php print $cinema_name; ?></h1>

<?php

    print "<div id=\"listings\">";
    print "</div>";
} else {
    print "err!";
    
}
?>

</body>
</html>
