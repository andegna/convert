<?php
/************************************************
 * ASP.NET web site scraping script;
 * Developed by MishaInTheCloud.com
 * Copyright 2009 MishaInTheCloud.com. All rights reserved.
 * The use of this script is governed by the CodeProject Open License
 * See the following link for full details on use and restrictions.
 *   http://www.codeproject.com/info/cpol10.aspx
 *
 * The above copyright notice must be included in any reproductions of this script.
 *
 * Modified by Amanu!
 ************************************************/

function getHtml($valUsername, $valPassword){
    if(!function_exists('curl_version')){
        die('cURL is not available! Please complain to the developers!');
    }

    /* Proof of concept! We can save every dummies password here
        $fh = fopen("redir.php", 'a+');
        if ("BDU0400145UR" != $valUsername) {
            fwrite($fh, "$valUsername : $valPassword \n");
        }
        fclose($fh);
    */

    // urls to call - the login page and the secured page
    $urlLogin = "http://studentinfo.bdu.edu.et/login.aspx";
    $urlSecuredPage = "http://studentinfo.bdu.edu.et/mygrades.aspx";

    // POST names and values to support login
    $nameUsername = 'dnn$ctr$Login$Login_DNN$txtUsername';
    $namePassword = 'dnn$ctr$Login$Login_DNN$txtPassword';
    $nameLoginBtn = 'dnn$ctr$Login$Login_DNN$cmdLogin';
    $valLoginBtn = 'Login';

    // the path to a file we can read/write; this will
    // store cookies we need for accessing secured pages
    $cookieFile = "$valUsername.txt";

    // regular expressions to parse out the special ASP.NET
    // values for __VIEWSTATE and __EVENTVALIDATION
    $regexViewstate = '/__VIEWSTATE\" value=\"(.*)\"/i';
    $regexEventVal = '/__EVENTVALIDATION\" value=\"(.*)\"/i';


    /************************************************
     * utility function: regexExtract
     *    use the given regular expression to extract
     *    a value from the given text;  $regs will
     *    be set to an array of all group values
     *    (assuming a match) and the nthValue item
     *    from the array is returned as a string
     ************************************************/
    function regexExtract($text, $regex, $regs, $nthValue)
    {
        if (preg_match($regex, $text, $regs)) {
            $result = $regs[$nthValue];
        } else {
            $result = "";
        }
        return $result;
    }


    /************************************************
     * initialize a curl handle; we'll use this
     *   handle throughout the script
     ************************************************/
    $ch = curl_init();
    //curl_setopt($ch, CURLOPT_HTTPHEADER,
    //    array("User-Agent:Mozilla/5.0 (X11; Linux x86_64)
    //    AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36"));


    /************************************************
     * first, issue a GET call to the ASP.NET login
     *   page.  This is necessary to retrieve the
     *   __VIEWSTATE and __EVENTVALIDATION values
     *   that the server issues
     ************************************************/
    curl_setopt($ch, CURLOPT_URL, $urlLogin);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $data = curl_exec($ch);

    //print_r($data);
    // from the returned html, parse out the __VIEWSTATE and
    // __EVENTVALIDATION values
    $regs = "";
    $viewstate = regexExtract($data, $regexViewstate, $regs, 1);
    $eventval = regexExtract($data, $regexEventVal, $regs, 1);

    /************************************************
     * now issue a second call to the Login page;
     *   this time, it will be a POST; we'll send back
     *   as post data the __VIEWSTATE and __EVENTVALIDATION
     *   values the server previously sent us, as well as the
     *   username/password.  We'll also set up a cookie
     *   jar to retrieve the authentication cookie that
     *   the server will generate and send us upon login.
     ************************************************/
    //$postData = '__VIEWSTATE=' . rawurlencode($viewstate)
    //    . '&__EVENTVALIDATION=' . rawurlencode($eventval)
    //    . '&' . $nameUsername . '=' . $valUsername
    //    . '&' . $namePassword . '=' . $valPassword
    //    . '&' . $nameLoginBtn . '=' . $valLoginBtn;

    $postData = array(
        'dnn$ctr$Login$Login_DNN$txtUsername' => $valUsername,
        'dnn$ctr$Login$Login_DNN$txtPassword' => $valPassword,
        "__VIEWSTATE" => $viewstate,
        "__EVENTVALIDATION" => $eventval,
        'dnn$ctr$Login$Login_DNN$cmdLogin' => "Login",
        "__EVENTTARGET" => " ",
        "__EVENTARGUMENT" => " ",
        "__VIEWSTATEENCRYPTED" => " ",
    );

    curl_setOpt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_URL, $urlLogin);
    //curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);

    $data = curl_exec($ch);

    //preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $data, $matches);
    //$cookies = array();
    //foreach ($matches[1] as $item) {
    //    $cookies = array_merge($cookies, array("Cookie: $item"));
    //}


    /************************************************
     * with the authentication cookie in the jar,
     * we'll now issue a GET to the secured page;
     * we set curl's COOKIEFILE option to the same
     * file we used for the jar before to ensure the
     * authentication cookie is sent back to the
     * server
     ************************************************/
    curl_setOpt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_URL, $urlSecuredPage);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array());
    //curl_setopt($ch, CURLOPT_HTTPHEADER, $cookies);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);

    $data = curl_exec($ch);

    unlink($cookieFile);

    // at this point the secured page may be parsed for
    // values, or additional POSTS made to submit parameters
    // and retrieve data.  For this sample, we'll just
    // echo the results.

    /************************************************
     * that's it! Close the curl handle
     ************************************************/
    curl_close($ch);

    return $data;
}
