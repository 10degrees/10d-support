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

    function __construct() {

        $this->website = $this->website();

        $this->client = new GTMetrixClient();
        $this->client->setUsername('tom@10degrees.uk');
        $this->client->setAPIKey('49ecea6961d2a267ac442e23d5ef0635');

        $this->client->getLocations();
        $this->client->getBrowsers();

    }

    private function website()
    {
        if ($this->isLocal())
        {
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
        while ($test->getState() != GTMetrixTest::STATE_COMPLETED &&
        $test->getState() != GTMetrixTest::STATE_ERROR) {

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



// var_dump($test);
//


//
// object(Entrecore\GTMetrixClient\GTMetrixTest)#7
// (24) {
//    ["id":protected]=> string(8) "vZBJTqOq"
//    ["pollStateUrl":protected]=> string(42) "https://gtmetrix.com/api/0.1/test/vZBJTqOq"
//    ["state":protected]=> string(9) "completed"
//    ["error":protected]=> string(0) ""
//    ["reportUrl":protected]=> string(50) "https://gtmetrix.com/reports/10degrees.uk/dMUl5PfR"
//    ["pagespeedScore":protected]=> int(87)
//    ["yslowScore":protected]=> int(78)
//    ["htmlBytes":protected]=> int(24046)
//    ["htmlLoadTime":protected]=> int(117)
//    ["pageBytes":protected]=> int(2196327)
//    ["pageLoadTime":protected]=> int(1300)
//    ["pageElements":protected]=> int(54)
//    ["redirectDuration":protected]=> int(66)
//    ["connectDuration":protected]=> int(26)
//    ["backendDuration":protected]=> int(25)
//    ["firstPaintTime":protected]=> int(813)
//    ["domInteractiveTime":protected]=> int(840)
//    ["domContentLoadedTime":protected]=> int(840)
//    ["domContentLoadedDuration":protected]=> NULL
//    ["onloadTime":protected]=> int(1300)
//    ["onloadDuration":protected]=> int(0)
//    ["fullyLoadedTime":protected]=> int(1491)
//    ["rumSpeedIndex":protected]=> int(813)
//    ["resources":protected]=> array(7) {
//      ["report_pdf"]=> string(53) "https://gtmetrix.com/api/0.1/test/vZBJTqOq/report-pdf"
//      ["pagespeed"]=> string(52) "https://gtmetrix.com/api/0.1/test/vZBJTqOq/pagespeed"
//      ["har"]=> string(46) "https://gtmetrix.com/api/0.1/test/vZBJTqOq/har"
//      ["pagespeed_files"]=> string(58) "https://gtmetrix.com/api/0.1/test/vZBJTqOq/pagespeed-files"
//      ["report_pdf_full"]=> string(60) "https://gtmetrix.com/api/0.1/test/vZBJTqOq/report-pdf?full=1"
//      ["yslow"]=> string(48) "https://gtmetrix.com/api/0.1/test/vZBJTqOq/yslow"
//      ["screenshot"]=> string(53) "https://gtmetrix.com/api/0.1/test/vZBJTqOq/screenshot"
//    }
//  }
