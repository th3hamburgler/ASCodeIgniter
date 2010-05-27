<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* CodeIgniter
*
* An open source application development framework for PHP 4.3.2 or newer
*
* @package        CodeIgniter
* @author        ExpressionEngine Dev Team
* @copyright    Copyright (c) 2006, EllisLab, Inc.
* @license        http://codeigniter.com/user_guide/license.html
* @link        http://codeigniter.com
* @since        Version 1.0
* @filesource
*/

// ------------------------------------------------------------------------

/**
 * CodeIgniter HTML Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/date_helper.html
 * @version		1.0
 *
 * Changes
 * -------
 * 1.0			- First Release
 */

// ------------------------------------------------------------------------

if ( ! function_exists('div'))
{
   /**
	* Div
	*
	* Generates an HTML div element
	*
	* @author	Jim Wardlaw
	* @access   public
	* @param    string
	* @param    array
	* @return   string
	* @version  1.0
	*/ 
	function div($contents, $attributes = NULL)
    {
    	// Were any attributes submitted?  If so generate a string
		if (is_array($attributes))
		{
			$atts = '';
			foreach ($attributes as $key => $val)
			{
				$atts .= ' ' . $key . '="' . $val . '"';
			}
			$attributes = $atts;
		}
		
    	return "<div".$attributes.">".$contents."</div>";
    }
}

if ( ! function_exists('clear'))
{
   /**
	* Clear
	*
	* Generates an HTML clearing div element
	*
	* @author	Jim Wardlaw
	* @access   public
	* @return   string
	* @version  1.0
	*/ 
	function clear()
    {
    	return div('&nbsp;', array('class' => 'clear'));
    }
}

/**
* Definition List
*
* Generates an HTML definition list from an associative array.  Use "dt"
* and "dd" as keys and set the value as an array.
*
* @author   Jim Wardlaw
* @access   public
* @param    array
* @param    mixed
* @return   string
* @version  1.0
*/    
if ( ! function_exists('dlist'))
{
    function dlist($list, $attributes = '')
    {
        // If an array wasn't submitted there's nothing to do...
		if ( ! is_array($list))
		{
			return $list;
		}
		
		$out='';
		
		// Were any attributes submitted?  If so generate a string
		if (is_array($attributes))
		{
			$atts = '';
			foreach ($attributes as $key => $val)
			{
				$atts .= ' ' . $key . '="' . $val . '"';
			}
			$attributes = $atts;
		}
		
		// Write the opening list tag
		$out .= "<dl".$attributes.">\n";
		
		// Cycle through the list elements.  If an array is 
		foreach ($list as $title => $definition)
		{	
			// write the definition title tag
			$out .= "<dt>".$title."</dt>";
			
			// is definition an array?
			if(is_array($definition))
			{
				// loop through definitions
				foreach($definition as $d)
				{
					// add definition
					$out .= "<dd>".$d."</dd>";
				}
			}
			else
			{
				// add definition
				$out .= "<dd>".$definition."</dd>";
			}
		}
	
		// Write the closing list tag
		$out .= "</dl>\n";

		return $out;
    }
}

/* End of file MY_html_helper.php */
/* Location: ./system/application/helpers/MY_html_helper.php */