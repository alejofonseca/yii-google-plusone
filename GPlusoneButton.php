<?php
/**
 * ActivityFeed class file.
 *
 * @author Alejandro Fonseca <alejandrofonseca - AT - gmx - DOT - com>
 * @link https://github.com/alejofonseca/yii-google-plusone
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3
 *
 */

require_once 'GPluginBase.php';

/**
 * The Plusone button lets visitors recommend your content on Google Search and
 * share it on Google+
 *
 * @see http://www.google.com/webmasters/+1/button/
 */

class GplusoneButton extends GPluginBase
{
	/**
	 * @var string This attribute explicitly defines the +1 target URL.
	 */
	public $href;
	
	/**
	 * @var integer If annotation is set to "inline", the width in pixels
	 * to use for the button and its inline annotation.
	 */
	public $width;

	/**
	 * @var string The annotation to display next to the button. 
	 */
	public $annotation;
	
	/**
	 * @var string The language to use.
	 */
	public $lang;
	
	public function run()
	{
		parent::run();
		$params = $this->getParams();
		$this->renderTag('plusone', $params);
		$script = "window.___gcfg = {lang: '".$params['lang']."'};	
				  (function() {
				  var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				  po.src = 'https://apis.google.com/js/plusone.js';
				  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
				  })();";
		Yii::app()->getClientScript()->registerScript('fb-async-callback', $script, CClientScript::POS_END);
	}
}
?>