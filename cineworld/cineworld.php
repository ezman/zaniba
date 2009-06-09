<?php 

function getCinemaArray() {
    $cinemas = array( 45 => "Bexleyheath",
                      10 => "Chelsea",
                      22 => "Enfield",
                      25 => "Feltham",
                      26 => "Fulham Road",
                      30 => "Hammersmith",
                      32 => "Haymarket",
                      37 => "Ilford",
                      53 => "Shaftesbury Avenue",
                      60 => "Staples Corner",
                      65 => "Wandsworth",
                      66 => "West India Quay",
                      70 => "Wood Green");    
    return $cinemas;
}


function getAllCinemaArray() {
    $cinemas = array ( 1 => "Aberdeen",
            12 => "Ashford",
            23 => "Ashton-Under-Lyne",
            34 => "Bedford",
            45 => "Bexleyheath",
            56 => "Birmingham Broad Street",
            67 => "Boldon Tyne and Wear",
            72 => "Bolton",
            73 => "Bradford",
            2 => "Braintree",
            3 => "Brighton",
            4 => "Bristol",
            5 => "Burton On Trent",
            6 => "Bury St Edmunds",
            7 => "Cambridge",
            8 => "Cardiff",
            9 => "Castleford",
            10 => "Chelsea",
            11 => "Cheltenham",
            13 => "Chester",
            14 => "Chesterfield",
            15 => "Chichester",
            16 => "Crawley",
            17 => "Didcot",
            18 => "Didsbury",
            75 => "Dublin",
            19 => "Dundee",
            20 => "Eastbourne",
            21 => "Edinburgh",
            22 => "Enfield",
            24 => "Falkirk",
            25 => "Feltham",
            26 => "Fulham Road",
            27 => "Glasgow Parkhead",
            28 => "Glasgow Renfrew Street",
            29 => "Gloucester",
            30 => "Hammersmith",
            31 => "Harlow",
            76 => "Haverhill",
            32 => "Haymarket",
            33 => "High Wycombe",
            35 => "Hull",
            36 => "Huntingdon",
            37 => "Ilford",
            38 => "Ipswich",
            39 => "Isle Of Wight",
            40 => "Jersey",
            41 => "Liverpool",
            42 => "Llandudno",
            43 => "Luton",
            44 => "Middlesbrough",
            46 => "Milton Keynes",
            47 => "Newport Wales",
            48 => "Northampton",
            49 => "Nottingham",
            50 => "Rochester",
            51 => "Rugby",
            52 => "Runcorn",
            53 => "Shaftesbury Avenue",
            54 => "Sheffield",
            55 => "Shrewsbury",
            57 => "Solihull",
            58 => "Southampton",
            59 => "St Helens",
            60 => "Staples Corner",
            61 => "Stevenage",
            62 => "Stockport",
            63 => "Swindon",
            65 => "Wandsworth",
            64 => "Wakefield",
            66 => "West India Quay",
            68 => "Weymouth",
            69 => "Wolverhampton",
            70 => "Wood Green",
            71 => "Yeovil");
    return $cinemas;
}


function list_cinemas() {
    $html = "<ul>";
    foreach (getCinemaArray() as $key=>$value) {
        $html .= "<li><a href=\"index.php?CINEMA=" . $key . "\">" . $value . "</a></li>";
    }   
    $html .= "</ul>";
    return $html;
}

function get_cinema_name($id) {
    foreach (getCinemaArray() as $key=>$value) {
        if($key == $id)
            return $value;
    }   
    return "Unknown Cinema!";
}

function domNodeList_to_string($DomNodeList) {
    $output = '';
    $doc = new DOMDocument;
    $i = 0;
    while ( $node = $DomNodeList->item($i) ) {
        // import node
        $domNode = $doc->importNode($node, true);
        // append node
        $doc->appendChild($domNode);
        $i++;
    }
    $output = $doc->saveXML();
    $output = print_r($output, 1);
    // I added this because xml output and ajax do not like each others
    // $output = htmlspecialchars($output);
    return $output;
}

function debug_print($str) {
    $debug = false;
    if($debug) {
        print $str . "\n<br>";
    }
}

class FilmInfo
{    
    var $cinema_id = "";
    var $title = "";
    var $certificate = "";
    var $image_location = "";
    var $director = "";
    var $starring = array();
    var $times = array();
    
    public function __construct($id, $t, $c, $i, $d, $s, $ts) {
        $this->cinema_id = $id;
        $this->title = $t;
        $this->certificate = $c;
        $this->image_location = $i;
        $this->director = $d;
        $this->starring = $s;
        $this->times = $ts;
    }   
}

function getCinemaHtml($target_url) {
	
	$userAgent = 'Googlebot/2.1 (http://www.googlebot.com/bot.html)';
		
	$c = curl_init($target_url);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($c, CURLOPT_USERAGENT, $userAgent);
	$html = curl_exec($c);
	curl_close($c);	
	if (!$html) {
		return -1;
	}
	return $html;	
}

function records_to_xml($xml, $cinemas)
{
  $xml .= '<?xml version="1.0" encoding="iso-8859-1" ?>' . "\n";
  $xml .= "<cineworld>\n";
  $xml .= "<cinema>\n";
  while ( TRUE )
  {
    $xml .= "<$recordname>\n";
    foreach ($row as $key => $value)
    {
      $xml .= "<$key>$value</$key>\n";
    }
    $xml .= "</$recordname>\n";
  }
  $xml .= "</cinema>";
  $xml .= "</cineworld>";
  return $xml;
}

function printFilm($title, $certificate, $director, $stars, $times, $img) {
    print "TITLE : " . $title . "\n<br>";
    print "CERTIFICATE : " . $certificate . "\n<br>";
    print "DIRECTOR : " . $director . "\n<br>";
    print "STARRING : ";
    print_r($stars);
    print "\n<br>";
    print "TIMES : ";
    print_r($times);
    print "\n<br>";
    print "IMG : " . $img . "\n<br>";
}

function generateCinemaXML($cinema_id) {
	
    //$url = "http://www.cineworld.co.uk/reservation/ChoixResa.jgi?CINEMA=";
    $url = "http://www.cineworld.co.uk/cinemas/";
    $html = getCinemaHtml($url . $cinema_id);
    
    $html = @mb_convert_encoding($html, 'HTML-ENTITIES', 'utf-8');
    $dom = new DOMDocument();
    $dom->preserveWhiteSpace = false;
    @$dom->loadHTML($html);
	   
    $title = ""; 
    $certificate = "";
    $img = "";
    $director = "";
    $starring = "";
    $stars = array();
    $times = array();
    $info = array();
    $debug = false;
    $got_times = false;

    $alldivs = $dom->getElementsByTagName('li');
    foreach($alldivs as $adiv) {
        if( $adiv->hasAttribute("class") && ($adiv->getAttribute("class") == "film-detail") ) {
            
            debug_print($adiv->getAttribute("class"));
            
            $entries = $adiv->getElementsByTagName('div');
            foreach($entries as $entry) {                
                debug_print("TAG " . $entry->getAttribute("class"));

                $subentry = $adiv->getElementsByTagName("h3")->item(0);
                if($subentry->hasAttribute("class") && ($subentry->getAttribute("class") == "filmtitle")) {
                    $title = $subentry->nodeValue;
                    //$title = strtoupper($title);
                    debug_print("TITLE : " . $title . "\n");
                }

                $subentry = $adiv->getElementsByTagName("img")->item(1);
                $img = $subentry->getAttribute("src");
                if($img == "/assets/icons/recommended_rec.png" || $img == "/assets/icons/recommended_kids.png") {
                    $subentry = $adiv->getElementsByTagName("img")->item(2);
                    $img = $subentry->getAttribute("src");
                }
                debug_print("IMAGE : " . $img);                 
                            
                if( $entry->hasAttribute("class") && ($entry->getAttribute("class") == "clearfix") ) {
                    debug_print("CLASS : " . $entry->getAttribute("class"));
                    $subentries = $entry->getElementsByTagName("img");
                    foreach($subentries as $subentry) {
                        if($subentry->hasAttribute("alt")) {
                            debug_print("CERT : " . $subentry->getAttribute("alt"));
                            $certificate = $subentry->getAttribute("alt");
                        }                        
                    }
                
                    $subentries = $entry->getElementsByTagName("p");
                    $first = true;
                    $second = false;
                    $complete = false;
                    foreach($subentries as $subentry) {                                                                          
                        if($first == true) {
                            $director = substr($subentry->nodeValue, strlen("Director: "));
                            $director = trim($director);
                            debug_print("DIRECTOR : " . $director);
                            $first = false;                            
                        }
                        
                        if(($second == true) && ($complete != true)) {
                            $starring = substr($subentry->nodeValue, strlen("Starring: ")); 
                            $star = strtok($starring, ",");
                            array_push($stars, $star);
                            
                            while ($star !== false) {
                                $star = strtok(",");
                                if($star !== false && sizeof($star) != 2) {
                                    $star = trim($star);
                                    array_push($stars, $star);
                                }                                
                            }                            
                            debug_print("Stars : " . $stars );           
                            $second = false;
                            $complete = true;
                        }
                        
                        if( ($first == false) && ($second == false) ) {
                            $second = true;
                        }
                    }
                }
         
         
                if( $entry->hasAttribute("class") && ($entry->getAttribute("class") == "timetable") ) {                    
                    $subentries = $entry->getElementsByTagName("dd");                    
                    $subentry = $subentries->item(0);
                    $ssubentries = $subentry->getElementsByTagName("a");                        
                    foreach($ssubentries as $ssubentry) {    
                        if($ssubentry->hasAttribute("class") && ($ssubentry->getAttribute("class") == "reg") ) {                                
                            debug_print("GOT TIME <a> :");                                
                            $time = $ssubentry->nodeValue;
                            $time = trim($time);
                            $time = substr($time, 0, 5);                                
                            debug_print("FILM : " . $title . " TIME: " . $time);
                            array_push($times, $time);
                        }
                    }
                    $got_times = true;                    
                }
                
                // Need to check the times as well.
                if( ($title != "") && ($certificate != "") && ($img != "") && ($director != "") && $got_times ) {
                    $debug = false;
                    if($debug) {
                        printFilm($title, $certificate, $director, $stars, $times, $img);
                    }
                    
                    $f = new FilmInfo($cinema_id, $title, $certificate, $img, $director, $stars, $times);
                    array_push($info, $f);
                    debug_print("Size of $info " . sizeof($info) );
                    /* refresh state */
                    
                    $title="";
                    $certificate="";
                    $img="";
                    $director="";
                    $stars = array();
                    $times = array();
                    $got_times = false;
                }
            }
        }   
    }
    return $info;
  
}


function get_films($cinema_id) {
    $films = generateCinemaXML($cinema_id);
    $film_json = json_encode($films);
    
    print "<script type=\"text/javascript\">\n";
    print "<!--\n";
    print "var entries = {\"films\":" . $film_json . "};\n";
    print "//--!>\n";
    print "\n</script>";
    
}

?>