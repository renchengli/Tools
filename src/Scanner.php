<?php
namespace Myself\Tools\Url;

class Scanner
{
    /**
     * @var array 一个由url组成的数组
     */
    protected $urls;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * 构造方法
     * @param array $urls 一个要扫描的url数组
     */
    public function __construct(array $urls)
    {
        $this->urls = $urls;
        $this->httpClient = new \GuzzleHttp\Client();
    }

    /**
     * 获取死链
     * @return array
     */
    public function getInvalidUrls()
    {
        $invalidUrls = [];
        foreach ($this->urls as $url) {
            try {
                $statusCode = $this->getStatusCodeForUrl($url);
            } catch (\Exception $e) {
                $statusCode = 500;
            }

            if ($statusCode >= 400) {
                array_push($invalidUrls, [
                    'url' => $url,
                    'status' => $statusCode
                ]);
            }
        }

        return $invalidUrls;
    }


    public function getStatusCodeForUrl($url)
    {
        $httpResponse = $this->httpClient->options($url);
        return $httpResponse->getStatusCode();
    }
}
