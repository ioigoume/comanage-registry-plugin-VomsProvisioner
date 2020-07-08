<?php

/*
 * List of SIMPLE HTTP calls: https://github.com/italiangrid/voms-admin-client/blob/037b8fb3bf9e89c5bc14bb017b9c4d84f4044175/src/VOMSAdmin/VOMSCommands.py
 * - create User
 * - create Group
 * - get User stats
 * - get Suspended users
 * - get Expired Users
 * - suspend User
 * - restore User
 * - restore All Suspended Users
*/
/*
 * LIST of SOAP Calls: https://github.com/italiangrid/voms-admin-client/blob/037b8fb3bf9e89c5bc14bb017b9c4d84f4044175/src/VOMSAdmin/VOMSAdminService.py
 * - delete User
 * - create Role
 * - add Member to group
 * - delete Role
*/

// XXX We need to clarify what deprovisioning means in order to understand what action is needed?

$host = 'voms2.hellasgrid.gr';
$port = '8443';
$vo = 'checkin-integration';
$action = 'getUser';

//$dn = 'CN=Ioannis Igoumenos 3aRVXSXXqXM1ysaG,O=EGI Foundation,OU=AAI-Pilot,O=EGI'; // GRNET
$dn = ' CN=IOANNIS IGOUMENOS IPYuCDUQz9Pd0Fzn,O=EGI Foundation,OU=AAI-Pilot,O=EGI '; // LINKEDIN
$ca = '/O=EGI/OU=AAI-Pilot/CN=EGI Simple Demo CA';

$base_url = 'https://' . $host . ':' . $port . '/voms/' . $vo . '/services/VOMSAdmin';
// XXX i should make these configuration
// 1. Upload as files
// 2. Parse and store in database
// 3. Load to tmp files and use
$user_cert = "-----BEGIN CERTIFICATE-----
MIIFgzCCBGugAwIBAgIQDC4Idmu8T9+Y+kF4O2tH8zANBgkqhkiG9w0BAQsFADBy
MQswCQYDVQQGEwJOTDEWMBQGA1UECBMNTm9vcmQtSG9sbGFuZDESMBAGA1UEBxMJ
QW1zdGVyZGFtMQ8wDQYDVQQKEwZURVJFTkExJjAkBgNVBAMTHVRFUkVOQSBlU2Np
ZW5jZSBQZXJzb25hbCBDQSAzMB4XDTE5MDcxODAwMDAwMFoXDTIwMDgxNzEyMDAw
MFowgZ8xEzARBgoJkiaJk/IsZAEZFgNvcmcxFjAUBgoJkiaJk/IsZAEZFgZ0ZXJl
bmExEzARBgoJkiaJk/IsZAEZFgN0Y3MxCzAJBgNVBAYTAkdSMS4wLAYDVQQKEyVH
cmVlayBSZXNlYXJjaCBhbmQgVGVjaG5vbG9neSBOZXR3b3JrMR4wHAYDVQQDDBVS
b2JvdCAtIGZhYWlAZ3JuZXQuZ3IwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEK
AoIBAQCwHouuyo96s+LK0LNyTbxXh4daneOpi2x/2JF4uXwwxqeyWFehZWLdSlB2
wm+QS4LKJLKtcXOHinVmVEfkw84I9Aqy4TMeI82FqioF0Iyw3xOKZI4/9e3qr4Iw
w5OycOjZ3agmzo8LQ/woiS6cFy0UiWNWFj98M6AAvBDt7l6E1Fopft0ChIXJGHPl
LScZoXsBKd3gdS37RU/7bHP4DNFoZtDj6LoqEqBmcgSGdPMSKfwvXeEc5jhWolM6
oElcO2HtKCx9xV7j+OTY17Qpmd5dwYEL762woLWK1yhNFRSun0jjroQIgEua7mjP
abhgh0jQ+QXsDO3fTlrLXntXlV+dAgMBAAGjggHlMIIB4TAfBgNVHSMEGDAWgBSM
nxEu5uN6BKUeVYtGCASm7ZdwpjAdBgNVHQ4EFgQUw6yBkwdn0WUo2+s106DEF3aw
Vl8wDAYDVR0TAQH/BAIwADAYBgNVHREEETAPgQ1mYWFpQGdybmV0LmdyMA4GA1Ud
DwEB/wQEAwIEsDAdBgNVHSUEFjAUBggrBgEFBQcDAgYIKwYBBQUHAwQwQwYDVR0g
BDwwOjAMBgoqhkiG90wFAgIBMA0GCyqGSIb3TAUCAwMBMA0GCyqGSIb3TAUCAwEC
MAwGCmCGSAGG/WwTHwEwgYUGA1UdHwR+MHwwPKA6oDiGNmh0dHA6Ly9jcmwzLmRp
Z2ljZXJ0LmNvbS9URVJFTkFlU2NpZW5jZVBlcnNvbmFsQ0EzLmNybDA8oDqgOIY2
aHR0cDovL2NybDQuZGlnaWNlcnQuY29tL1RFUkVOQWVTY2llbmNlUGVyc29uYWxD
QTMuY3JsMHsGCCsGAQUFBwEBBG8wbTAkBggrBgEFBQcwAYYYaHR0cDovL29jc3Au
ZGlnaWNlcnQuY29tMEUGCCsGAQUFBzAChjlodHRwOi8vY2FjZXJ0cy5kaWdpY2Vy
dC5jb20vVEVSRU5BZVNjaWVuY2VQZXJzb25hbENBMy5jcnQwDQYJKoZIhvcNAQEL
BQADggEBAJ3d/LL5dpDevNfjRZ0Qns68qTbrPdXC2Oqe1Gw6YHqtHo0Gv9c5Pz2g
K3O6mAkC2QUXrFJgiq5FqC2903H4RZAAUHdYESWPSg06fsdvojgVAeZnlYLLMKFb
eEbavAFNaWnu2r6KDRCG3uc1PEqvR8s0UhbVYnPqPNNWqsiU0fKBZghIjbVLzBRN
tPhTqpSXNvg6ZlLUfigr26iyGjGdxGwGcPhAveoRLmyfl5e/nRFALU72A5Cwcj3m
4/ZjNknLJ0QI18ssYc7R8imE0lsyYlqwHvTMe3JoZKMiy1LVlTY5eqqLw+HHijnu
2DB8geVPi25qnAol991SJ1Borwt+fEY=
-----END CERTIFICATE-----";

$user_key = "-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCwHouuyo96s+LK
0LNyTbxXh4daneOpi2x/2JF4uXwwxqeyWFehZWLdSlB2wm+QS4LKJLKtcXOHinVm
VEfkw84I9Aqy4TMeI82FqioF0Iyw3xOKZI4/9e3qr4Iww5OycOjZ3agmzo8LQ/wo
iS6cFy0UiWNWFj98M6AAvBDt7l6E1Fopft0ChIXJGHPlLScZoXsBKd3gdS37RU/7
bHP4DNFoZtDj6LoqEqBmcgSGdPMSKfwvXeEc5jhWolM6oElcO2HtKCx9xV7j+OTY
17Qpmd5dwYEL762woLWK1yhNFRSun0jjroQIgEua7mjPabhgh0jQ+QXsDO3fTlrL
XntXlV+dAgMBAAECggEATBd2bDdyFCaCNvRCg4EYfYy9qyYKRadKYlYUS99/y6cY
rxJCEiY2t7sy1oydHO+y+1ktpYgdzRLCNEr3oNwEOZQOx0hLCJuZYUWq0EZRct1+
mM1nNDUx7LKVgjINrwvfXrnIu7OE0+40lOLoM2JEBNpzA6+rECNR3t9iRRo21hYd
XRmh5XncCuCFyv1i+0Nzd0S17q3JcYoG2pn5DG6/rLNscTwpYQjWSWCp1Q59uo3Z
15t6Xw6JUVgfCmYycvokHv0HeaykJKh4FOeM+rGvEOIqfvSP7yW/p2U1E+GSckUG
TQSyIhATpQrioH/lZ8lXxoBL/JfVXJ3S+GNDUl/2tQKBgQDig/mJPI+iLJQfdwEk
EBZ7BIp2a0/tfXqZWdK+v/OqB1k7hVv2eGPmvr0ca5xuMsfm0dyZN86AvHqwatzU
gFOm4uqtG6xTZOMVFVBswJNNQ7LvaHJj9vd+XqNk3gVY2LW5qRhD2Ev2UR2AKbtC
ll19x5+ZrGlwKANiq0ya4piOBwKBgQDHC0B1++X1Hg/210FpmmoTFZDKtS+9EPyJ
HMmevTse1MdgsI5+qcUCPEe98tOl1hDF2nER/JwH7L3g1EE6rXuNbR8yT2QBthFi
Prn0ouj8gWUkulhK6YlmyoOOaB77sdMrH/qWhjzxZpSGpZF5nfH+wNazmi/0Z3CV
iemS8QU8OwKBgQDMz1m8bcbNcxNHU/nzGpzJBHUR17wAV3mX2PDFypfOADD9sXpS
Y86on4Qsg1yBA2deXBjjbONJ4aHpi+Y6OgHpHrnkZeYtzUXKFWiPvJwzu2e6Mq1j
l7V2TKnelSUujVvbEHrBNXyRrgxHivQno//Kr8muUIdRgsx01cBBN2uK1wKBgH7z
pkGaUKluazA9SvNYEZ/qeVdRCQnF88xgGBivCS44+JGrCrevAIDUgc2dO3DigAAx
uzyFqd9EGDd2KcSLMeqaVvN3v4l33s6Sw3hND909io1KbVYabhCpyg7iSiCu4sj2
tJWdOPGfQ8w9ffPb0aVyyX30MfHop945AElAgN5RAoGAb6aPiA3u+aIcF5GH/gXo
/OoWxl6HNhYOMhtIzYM3gIwTnOyvxC14Rxs5mJ3ALm83EwIvRBtDSDzSApiWFk/f
wIRjjvkrE2Z6YIAkeVDrNnUZoQUirIHmgReHOTGNNk25cVaWaL4taEOb/8gjRWkS
Rm95YjoCJJJHzV3Fqt7zXsQ=
-----END PRIVATE KEY-----";

// XXX what about AUP data?
$get_user_data = array(

  'certificateSubject' => $dn,
  'caSubject' => $ca,
);

// Get user test
do_curl($base_url, $action, $get_user_data, $user_cert, $user_key);

function do_curl($base_url, $action, $post_fields, $user_cert, $user_key)
{
  $user_fcert = tempnam("/tmp", "user_cert_tmpfile");
  $handle_fcert = fopen($user_fcert, "w");
  fwrite($handle_fcert, $user_cert);
  fclose($handle_fcert);


  $user_fkey = tempnam("/tmp", "user_key_tmpfile");
  $handle_fkey = fopen($user_fkey, "w");
  fwrite($handle_fkey, $user_key);
  fclose($handle_fkey);
  chmod($user_fkey, 0644);

  // build xml envelope
  $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
  <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
  <' . $action . ' xmlns="http://glite.org/wsdl/services/org.glite.security.voms.service.admin">
  <in0>' . $post_fields['certificateSubject'] . '</in0> 
  <in1>' . $post_fields['caSubject'] . '</in1> 
  </' . $action . '>
  </soap:Body>
  </soap:Envelope>';

  //  I realized the header was not sent when it was empty. If you want to set an empty header, try to use \"\"
  $http_headers = array(
    'X-VOMS-CSRF-GUARD: ""',
  );

  if (!empty($post_fields)) {
    $http_headers[] = 'Content-Type: text/xml;charset="utf-8"';
    $http_headers[] = 'Accept: text/xml';
    $http_headers[] = 'Cache-Control: no-cache';
    $http_headers[] = 'Pragma: no-cache';
    $http_headers[] = 'Accept: text/xml';
    $http_headers[] = 'Content-length: ' . strlen($xml_post_string);
    $http_headers[] = 'SOAPAction: ""';
  }

  $response_headers = [];

  $ch = curl_init();
  // Construct the action url
  $url = $base_url;

  // set the url, number of POST vars, POST data
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, count($post_fields));
  curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $http_headers);
  curl_setopt($ch, CURLOPT_SSLCERT, $user_fcert);
  curl_setopt($ch, CURLOPT_SSLKEY, $user_fkey);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
  curl_setopt($ch, CURLOPT_VERBOSE, true);
  curl_setopt($ch, CURLOPT_TIMEOUT, 5000);

  // execute post
  $response = curl_exec($ch);
  
  $error = "";
  if (empty($response)) {
    // probably connection error
    $error = curl_error($ch);
    echo $error;
  } else
    echo $response;
  $info = curl_getinfo($ch);
  if ($info["http_code"] !== 200) {
    $error = curl_error($ch);
    echo $error;
    echo $response;
  }

  // close connection
  curl_close($ch);
}
