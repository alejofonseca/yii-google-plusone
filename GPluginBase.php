<?php
/**
 * Registration class file.
 *
 * @author Alejandro Fonseca <alejandrofonseca - AT - gmx - DOT - com>
 * @link https://github.com/alejofonseca/yii-google-plusone
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3
 *
 */

/**
 * This is the base class for the plusone google button plugin. Collects
 * the parameters for the div tag and echo the button.
 *
 */
abstract class GPluginBase extends CWidget
{
	/**
	 * Grabs public properties of the child class for passing to the plugin creator.
	 * @return array Associative array
	 */
	protected function getParams()
	{
		$ref = new ReflectionObject($this);
		$props = $ref->getProperties(ReflectionProperty::IS_PUBLIC);

		$params = array();
		foreach ($props as $k => $v) {
			$name = $v->name;
			if ($this->$name !== null && !is_array($this->$name)) {
				if (is_bool($this->$name)) {
					$value = ($this->$name === true) ? 'true' : 'false';
				}
				else {
					$value = $this->$name;
				}
				$params[$name] = $value;
			}
		}
		return $params;
	}
	
	/**
	 * Elaborates the proper name for the div tag.
	 * 
     * @param $name 'plusone'
     * @param $params the parameters for the Plusone Plugin
     * @return void
     */
	protected function renderTag($name, $params){
		$this->makeHtml5Tag('g-'.$name,$params);
    }
    
    /**
     * @param $class the name of the Plusone Plugin
     * @param $params the parameters for the Plusone Plugin
     * @return void
     */
	protected function makeHtml5Tag($class, $params) {
        $newParams = array();
        foreach($params as $key=>$data) {
            $newParams["data-".$key] = $data;
        }
        $newParams['class'] = $class;
        echo CHtml::openTag('div', $newParams), CHtml::closeTag('div');
    }
}
?>