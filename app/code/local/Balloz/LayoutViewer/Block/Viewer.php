<?php

class Balloz_LayoutViewer_Block_Viewer extends Mage_Core_Block_Template
{	
	protected function _buildEntries(&$entries, $block, $alias, $level) {		
		$extras = array();
		$extras[] = count($block->getChild()) ? count($block->getChild()) : "-";
		$extras[] = $block->getType();

		if ($block->getType() === 'cms/block') {
			$extras[] = $block->getBlockId();
		} elseif ($block->getType() == 'cms/page') {
			$extras[] = $block->getPage()->getIdentifier();
		} else if ($template = $block->getTemplate()) {
			$extras[] = $template;
		} else {
			$extras[] = '-';
		}
	
		// sprintf("$offset%s %s\n", $alias, $this->_colorize($extraString, self::COLOR_DARK_GRAY))

		$entries[] = array(
			'alias' => $alias,
			'level' => $level,
			'extras' => $extras
		);
		
		foreach ($block->getChild() as $alias => $childBlock) {
			$this->_buildEntries($entries, $childBlock, $alias, $level + 1);
		}
	}
	
	public function getBlockEntries() {
		$layout = Mage::app()->getLayout();
		$root = $layout->getBlock('root');
		$entries = array();
		
		$this->_buildEntries($entries, $root, 'root', '', 0);
		
		return $entries;
	}
}