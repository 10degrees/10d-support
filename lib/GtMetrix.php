<?php

use Entrecore\GTMetrixClient\GTMetrixClient;
use Entrecore\GTMetrixClient\GTMetrixTest;

/**
 *
 */
class Td_GT_Metrix
{

    public $client;

    public $website;

    function __construct()
    {
        $this->website = $this->website();

        $this->client = new GTMetrixClient();

        // Fetch credentials from options instead of hardcoded
        $username = get_option('td_gtmetrix_username', '');
        $api_key = get_option('td_gtmetrix_api_key', '');

        $this->client->setUsername($username);
        $this->client->setAPIKey($api_key);

        $this->client->getLocations();
        $this->client->getBrowsers();
    }

    private function website()
    {
        if ($this->isLocal()) {
            return 'https://10degrees.uk';
        }

        return site_url();
    }

    private function isLocal()
    {
        return end(explode(".", parse_url(site_url(), PHP_URL_HOST))) == 'local';
    }

    public function test()
    {
        $test = $this->client->startTest($this->website);

        //Wait for result
        while (
            $test->getState() != GTMetrixTest::STATE_COMPLETED &&
            $test->getState() != GTMetrixTest::STATE_ERROR
        ) {

            $this->client->getTestStatus($test);
            sleep(10);
        }

        return array(
            'timeStamp' => time(),
            'reportUrl' => $test->getReportUrl(),
            'pagespeedScore' => $test->getPagespeedScore(),
            'fullyLoadedTime' => $test->getFullyLoadedTime(),
        );
    }
}
