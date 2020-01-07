<?php

namespace Fix\PageBuilder\Controller\Magento\PageBuilder\Adminhtml\Stage;


class Render extends \Magento\PageBuilder\Controller\Adminhtml\Stage\Render
{

    public function execute()
    {
        $layout = $this->_view->getLayout();
        $requireJs = $layout->createBlock(
            \Magento\Backend\Block\Page\RequireJs::class,
            'require.js'
        );
        $requireJs->setTemplate('Magento_Backend::page/js/require_js.phtml');
        /* @var \Magento\PageBuilder\Block\Adminhtml\Stage\Render $renderBlock */
        $renderBlock = $layout->createBlock(
            \Fix\PageBuilder\Block\Adminhtml\Stage\Render::class,
            'stage_render'
        );
        $renderBlock->setTemplate('Fix_PageBuilder::stage/render.phtml');
        $babelPolyfill = $layout->createBlock(
            \Magento\PageBuilder\Block\Adminhtml\Html\Head\BabelPolyfill::class,
            'pagebuilder.babel.polyfill'
        );
        $babelPolyfill->setTemplate('Magento_PageBuilder::html/head/babel_polyfill.phtml');
        $this->getResponse()->setBody($requireJs->toHtml() . $babelPolyfill->toHtml() . $renderBlock->toHtml());
        $this->getResponse()->sendResponse();
    }

}

	