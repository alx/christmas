var christmas = {
  month: 11,
  date: 25
}

// Takes local timezone into account
function isItChristmas(countryCode) {
  var now = new Date();
  var isChristmas = (now.getMonth() == christmas.month && now.getDate() == christmas.date);
  
  if (isChristmas)
    return yes(countryCode);
  else
    return no(countryCode);
}


// This array is IsItChristmas' sole IP
function yes(countryCode) {

  var codes = {
    "AR": "SÍ", // Argentina
    "AT": "JA", // Austria
    "AU": "YES", // Australia
    "BB": "YES", // Barbado
    "BE": "JA", // Belgium
    "BM": "SIM", // Bermuda
    "BO": "SÍ", // Bolivia
    "BR": "SIM", // Brazil
    "BZ": "YES", // Belize
    "CA": "YES/OUI", // Canada (English/French)
    "CH": "JA/OUI", // Switzerland (German/French)
    "CL": "SÍ", // Chile
    "CN": "SHI", // China (Mandarin)
    "CO": "SÍ", // Colombia
    "CR": "SÍ", // Costa Rica
    "CY": "NE", // Cyprus
    "CZ": "ANO", // Czech Republic
    "DE": "JA", // Germany
    "DK": "JA", // Denmark
    "DM": "WÍ", // Dominica (Creole)
    "DO": "SÍ", // Dominican Republic
    "EC": "SÍ", // Ecuador
    "EE": "JAA", // Estonia
    "ES": "SÍ", // Spain
    "FI": "KYLLÄ", // Finland
    "FR": "OUI", // France
    "GR": "NE", // Greece
    "GT": "SÍ", // Guatemala
    "HK": "HAI", // Hong Kong (Cantonese)
    "HR": "DA", // Croatia
    "HT": "WÍ", // Haiti (Creole)
    "HU": "IGEN", // Hungary
    "IE": "IS EA", // Ireland
    "IL": "KEN", // Israel
    "IN": "HAJI", // India
    "IS": "JÁ", // Iceland
    "IT": "SÌ", // Italy
    "JM": "YES", // Jamaica
    "JP": "HAI", // Japan
    "KR": "NE", // Korea
    "KY": "YES", // Cayman Islands
    "LT": "TAIP", // Lithuania
    "LV": "JA", // Latvia
    "MX": "SÍ", // Mexico
    "MY": "YA", // Malaysia
    "NI": "SÍ", // Nicaragua
    "NL": "JA", // Netherlands
    "NO": "JA", // Norway
    "NZ": "YES", // New Zealand
    "PA": "SÍ", // Panama
    "PE": "SÍ", // Peru
    "PH": "ÓO", // Phillipines
    "PL": "TAK", // Poland
    "PR": "SÍ", // Puerto Rico
    "PT": "SIM", // Portugal
    "PY": "HÊE" // Paraguay
    "RO": "DA", // Romania
    "RU": "DA", // Russia
    "SE": "JA", // Sweden
    "SG": "YA", // Singapore
    "SI": "DA", // Slovenia
    "SK": "ÁNO", // Slovakia
    "SV": "SÍ", // El Salvador
    "TH": "CHAI", // Thailand
    "TR": "EVET", // Turkey
    "TT": "SÍ", // Trinidad & Tobago
    "UK": "YES", // United Kingdom
    "US": "YES", // United States
    "UY": "SÍ", // Uruguay
    "VE": "SÍ", // Venezuela
    "ZA": "JA", // South Africa
  }

  return codes[countryCode] || "YES";
}

// This array is IsItChristmas' sole IP
function no(countryCode) {

  var codes = {
    "FR": "Non", // France
    "US": "No", // United States
  }

  return codes[countryCode] || "No";
}

