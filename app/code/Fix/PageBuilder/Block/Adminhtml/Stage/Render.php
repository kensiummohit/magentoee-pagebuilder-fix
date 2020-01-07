<?php

namespace Fix\PageBuilder\Block\Adminhtml\Stage;

use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\Asset\Minification;
use Magento\Framework\View\Element\Template\Context;
use Magento\PageBuilder\Block\Adminhtml\Stage\Render as ParentRender;
use Magento\PageBuilder\Model\Stage\Config;
use Magento\RequireJs\Model\FileManager;

/**
 * Class Render
 */
class Render extends ParentRender
{
    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * @var Minification
     */
    private $minification;

    /**
     * Class constructor
     *
     * @param Context $context
     * @param FileManager $fileManager
     * @param Config $config
     * @param Json $json
     * @param Minification $minification
     * @param array $data
     */
    public function __construct(
        Context $context,
        FileManager $fileManager,
        Config $config,
        Json $json,
        Minification $minification,
        array $data = []
    ) {
        parent::__construct($context, $fileManager, $config, $json, $data);

        $this->fileManager = $fileManager;
        $this->minification = $minification;
    }

    /**
     * Check that js minification is enabled
     *
     * @return boolean
     */
    public function isJsMinificationEnabled()
    {
        return $this->minification->isEnabled('js');
    }

    /**
     * Get min resolver asset url
     *
     * @return string
     */
    public function getMinResolverAssetUrl()
    {
        $minResolver = $this->fileManager->createMinResolverAsset();
        $url = $minResolver ? $minResolver->getUrl() : '';

        return $url;
    }
}
