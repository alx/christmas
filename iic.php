<?php

require 'hostip.php';


// Accepts: A time
// Returns: Whether or not it is Christmas
function isItChristmas($time = null) {
  // May as well uncomment this from 12/27 through 12/23
  // return "NO";
  
  // set Christmas
  $christmas = "12/25";
  $ip = getIp(); 
  
  // debug: 
  // $ip = "193.51.208.14"; // French IP
  // $christmas = "12/24";
  
  $location = null;
  
  if ($ip) {
    // db credentials, see db.php.example
    require 'db.php';
    DBconnect($server, $username, $password, $database);
    
    $location = ipRoughLocate($ip);
    
    // if we don't know the country, let's assume eastern time (mediocre)
    if ($location["countryName"] == "(Unknown Country?)")
      $local_time = easternTime($time);
    else
      $local_time = trueLocalTime($time, $location["lng"]);
  }
  else {
    $local_time = easternTime($time);
  }
  
  $isit = (strftime("%m/%d", $local_time) == $christmas);
  
  return $isit ? yes($location) : no($location);
}

// used to produce a country code for the JS to work with
function getCountryCode() {
  
  $ip = getIp(); 
  // debug: 
  // $ip = "193.51.208.14"; // French IP
  // $ip = "71.164.115.181"; // US IP
  
  $location = null;
  if ($ip) {
    // db credentials, see db.php.example
    require 'db.php';
    DBconnect($server, $username, $password, $database);
    
    $location = ipRoughLocate($ip);
  }
  
  if (!$location || !$location["countryCode"] || $location["countryName"] == "(Unknown Country?)")
    return "US";
  else
    return $location["countryCode"];
}


// Helper functions

function trueLocalTime($time, $longitude) {

  // establish the GMT time we're talking about
  if (!$time) 
    $time = gmmktime();
  else
    $time = gmmktime() - (time() - $time);
  $time += (8 * 3600); // Dreamhost's box thinks PST is GMT, awesome

  // estimate time zone from longitude (an hour for every 15 degrees from GMT)
  $offset = floor($longitude / 15);
  $true_local_time = $time + ($offset * 3600);

  return $true_local_time;
}

function easternTime($time) {
  if (!$time) $time = time();
  $time += (3 * 3600); // Dreamhost is in PST, no matter what you say
  return $time;
}

function yes($location) {
  if (!$location || !$location["countryCode"] || $location["countryName"] == "(Unknown Country?)")
    return "YES";
    
  $code = $location["countryCode"];
  
  // This array is IsItChristmas' sole IP
  $codes = array(
    "AR" => "SÍ", // Argentina
    "AT" => "JA", // Austria
    "AU" => "YES", // Australia
    "BB" => "YES", // Barbado
    "BE" => "JA", // Belgium
    "BM" => "SIM", // Bermuda
    "BO" => "SÍ", // Bolivia
    "BR" => "SIM", // Brazil
    "BZ" => "YES", // Belize
    "CA" => "YES/OUI", // Canada (English/French)
    "CH" => "JA/OUI", // Switzerland (German/French)
    "CL" => "SÍ", // Chile
    "CN" => "SHI", // China (Mandarin)
    "CO" => "SÍ", // Colombia
    "CR" => "SÍ", // Costa Rica
    "CY" => "NE", // Cyprus
    "CZ" => "ANO", // Czech Republic
    "DE" => "JA", // Germany
    "DK" => "JA", // Denmark
    "DM" => "WÍ", // Dominica (Creole)
    "DO" => "SÍ", // Dominican Republic
    "EC" => "SÍ", // Ecuador
    "EE" => "JAA", // Estonia
    "ES" => "SÍ", // Spain
    "FI" => "KYLLÄ", // Finland
    "FR" => "OUI", // France
    "GR" => "NE", // Greece
    "GT" => "SÍ", // Guatemala
    "HK" => "HAI", // Hong Kong (Cantonese)
    "HR" => "DA", // Croatia
    "HT" => "WÍ", // Haiti (Creole)
    "HU" => "IGEN", // Hungary
    "IE" => "IS EA", // Ireland
    "IL" => "KEN", // Israel
    "IN" => "HAJI", // India
    "IS" => "JÁ", // Iceland
    "IT" => "SÌ", // Italy
    "JM" => "YES", // Jamaica
    "JP" => "HAI", // Japan
    "KR" => "NE", // Korea
    "KY" => "YES", // Cayman Islands
    "LT" => "TAIP", // Lithuania
    "LV" => "JA", // Latvia
    "MX" => "SÍ", // Mexico
    "MY" => "YA", // Malaysia
    "NI" => "SÍ", // Nicaragua
    "NL" => "JA", // Netherlands
    "NO" => "JA", // Norway
    "NZ" => "YES", // New Zealand
    "PA" => "SÍ", // Panama
    "PE" => "SÍ", // Peru
    "PH" => "ÓO", // Phillipines
    "PL" => "TAK", // Poland
    "PR" => "SÍ", // Puerto Rico
    "PT" => "SIM", // Portugal
    "PY" => "HÊE", // Paraguay
    "RO" => "DA", // Romania
    "RU" => "DA", // Russia
    "SE" => "JA", // Sweden
    "SG" => "YA", // Singapore
    "SI" => "DA", // Slovenia
    "SK" => "ÁNO", // Slovakia
    "SV" => "SÍ", // El Salvador
    "TH" => "CHAI", // Thailand
    "TR" => "EVET", // Turkey
    "TT" => "SÍ", // Trinidad & Tobago
    "UK" => "YES", // United Kingdom
    "US" => "YES", // United States
    "UY" => "SÍ", // Uruguay
    "VE" => "SÍ", // Venezuela
    "ZA" => "JA", // South Africa
  );

  if (!$codes[$code])
    return "YES";
  else
    return $codes[$code];
}


function no($location) {
  if (!$location || !$location["countryCode"] || $location["countryName"] == "(Unknown Country?)")
    return "No";
    
  $code = $location["countryCode"];
  
  // This array is IsItChristmas' sole IP
  $codes = array(
    "ES" => "No", // Spain
    "FR" => "Non", // France
    "UK" => "No", // United Kingdom
    "US" => "No", // United States
  );

  if (!$codes[$code])
    return "No";
  else
    return $codes[$code];
}

?>
