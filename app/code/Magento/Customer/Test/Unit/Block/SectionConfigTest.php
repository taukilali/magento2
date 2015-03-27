<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Customer\Block;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager as ObjectManagerHelper;

class blockTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Magento\Customer\Block\block */
    protected $block;

    /** @var ObjectManagerHelper */
    protected $objectManagerHelper;

    /** @var \Magento\Framework\View\Element\Template\Context|\PHPUnit_Framework_MockObject_MockObject */
    protected $context;

    /** @var \Magento\Framework\Config\DataInterface|\PHPUnit_Framework_MockObject_MockObject */
    protected $sectionConfig;

    /** @var \Magento\Framework\Json\EncoderInterface|\PHPUnit_Framework_MockObject_MockObject */
    protected $encoder;

    protected function setUp()
    {
        $this->context = $this->getMock('Magento\Framework\View\Element\Template\Context', [], [], '', false);
        $this->sectionConfig = $this->getMock('Magento\Framework\Config\DataInterface');
        $this->encoder = $this->getMock('Magento\Framework\Json\EncoderInterface');

        $this->objectManagerHelper = new ObjectManagerHelper($this);
        $this->block = $this->objectManagerHelper->getObject(
            'Magento\Customer\Block\SectionConfig',
            [
                'context' => $this->context,
                'sectionConfig' => $this->sectionConfig,
                'jsonEncoder' => $this->encoder
            ]
        );
    }

    public function testGetSections()
    {
        $this->sectionConfig->expects($this->once())->method('get')->with('sections')->willReturn(['data']);
        $this->encoder->expects($this->once())->method('encode')->with(['data'])
            ->willReturn('encoded-data');

        $this->assertEquals('encoded-data', $this->block->getSections());
    }
}
