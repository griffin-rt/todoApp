<?php
/**
 * Functions to process a cross domain request
 *
 * @author Pawan Raj Murarka <pawanrajmurarka@gmail.com>
 */

namespace McMaklerBundle\Utility;

class ApiCaller
{

    /**
     * Function used to request data from an external system
     *
     * @param string $url
     * @param string $method
     * @param string $content
     * @return array
     */
    public function execute($url, $method, $content, $headers = array())
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $r = curl_exec($ch);

        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlErrno = curl_errno($ch);

        if ($httpStatus != 200 || $curlErrno != 0) {
            $response = array('success' => false, 'response' => $r);
        } else {
            $response = array('success' => true, 'response' => $r);
        }

        return $response;
    }

}
