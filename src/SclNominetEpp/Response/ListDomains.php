<?php

namespace SclNominetEpp\Response;

use SclNominetEpp\Response;

/**
 * This class interprets XML for a Nominet EPP list command response.
 *
 * @author Merlyn Cooper <merlyn.cooper@hotmail.co.uk>
 */
class ListDomains extends Response
{
    //put your code here
    protected $domains = array();

    protected function processData($xml)
    {
        if ($this->xmlInvalid($xml)) {
            return;
        }
        
        $ns = $xml->getNamespaces(true);

        $domains = $xml->response->resData->children($ns['list'])->listData;

        $this->domains = array();

        foreach ($domains->domainName as $domain) {
            $this->domains[] = (string) $domain;
        }
    }

    public function xmlInvalid($xml)
    {
        if (!isset($xml->response->resData)) {
            return;
        }
    }
    
    public function getDomains()
    {
        return $this->domains;
    }
}
