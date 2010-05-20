<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Date Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/date_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Convert MySQL's DATETIME (YYYY-MM-DD hh:mm:ss) to a MySQL's DATE (YYYY-MM-DD)
 *
 * Returns a substring of a MySQL datetime
 *
 * @author 	Jim Wardlaw
 * @access	public
 * @return	string
 */
function mysqldatetime_to_mysqldate($date)
{
	return substr($date, 0, 10);
}

/**
 * Increment a MySQL date by day/month/year
 *
 * Returns the new MySQL date
 *
 * @author 	Jim Wardlaw
 * @access	public
 * @return	string
 */
function sum_date($date, $what=FALSE, $value, $return_format='mysql') {
	
	list($year, $month, $day) = split("-", $date);
	      
    if ($what!='day' && $what!='month' && $what!='year') return false;
	
	if ($what=='day') 	$day 	= $day + intval($value); 
	if ($what=='month') 	$month 	= $month + intval($value);
	if ($what=='year') 	$year 	= $year + intval($value);
	
	$date_tmp = mktime(0, 0, 0, $month, $day, $year);    
	    
	if ($return_format=='mysql') {
		$date_tmp = date('Y-m-d', $date_tmp);
	} elseif (!$return_format=='timestamp') {
		return false;   
	}
	               
	return $date_tmp;
	
}

/**
 * Decrement a MySQL date by day/month/year
 *
 * Returns the new MySQL date
 *
 * @author 	Jim Wardlaw
 * @access	public
 * @return	string
 */
function subtract_date($date, $what=FALSE, $value, $return_format='mysql') {
	
	list($year, $month, $day) = split("-", $date);
	   
	if ($what!='day' && $what!='month' && $what!='year') return false;    
	
	if ($what=='day') 	$day 	= $day - intval($value); 
	if ($what=='month') 	$month 	= $month - intval($value);
	if ($what=='year') 	$year 	= $year - intval($value);
	
	$date_tmp = mktime(0, 0, 0, $month, $day, $year);    
	
	if ($return_format=='mysql') {
		$date_tmp = date('Y-m-d', $date_tmp);
	} elseif (!$return_format=='timestamp') {
		return false;   
	}
	               
	return $date_tmp;
	
	}

/**
 * Convert MySQL's DATE (YYYY-MM-DD) or DATETIME (YYYY-MM-DD hh:mm:ss) to timestamp
 *
 * Returns the timestamp equivalent of a given DATE/DATETIME
 *
 * @todo add regex to validate given datetime
 * @author Clemens Kofler <clemens.kofler@chello.at>
 * @access    public
 * @return    integer
 */
function mysqldatetime_to_timestamp($datetime = "")
{
  // function is only applicable for valid MySQL DATETIME (19 characters) and DATE (10 characters)
  $l = strlen($datetime);
    if(!($l == 10 || $l == 19))
      return 0;

    //
    $date = $datetime;
    $hours = 0;
    $minutes = 0;
    $seconds = 0;

    // DATETIME only
    if($l == 19)
    {
      list($date, $time) = explode(" ", $datetime);
      list($hours, $minutes, $seconds) = explode(":", $time);
    }

    list($year, $month, $day) = explode("-", $date);

    return mktime($hours, $minutes, $seconds, $month, $day, $year);
}

/**
 * Convert MySQL's DATE (YYYY-MM-DD) or DATETIME (YYYY-MM-DD hh:mm:ss) to date using given format string
 *
 * Returns the date (format according to given string) of a given DATE/DATETIME
 *
 * @author Clemens Kofler <clemens.kofler@chello.at>
 * @access    public
 * @return    integer
 */
function mysqldatetime_to_date($datetime = "", $format = "d.m.Y, H:i:s")
{
	//log_message('error', 'mysqldatetime_to_date('.$datetime.', '.$format.')');

    return date($format, mysqldatetime_to_timestamp($datetime));
}

/**
 * Convert timestamp to MySQL's DATE or DATETIME (YYYY-MM-DD hh:mm:ss)
 *
 * Returns the DATE or DATETIME equivalent of a given timestamp
 *
 * @author Clemens Kofler <clemens.kofler@chello.at>
 * @access    public
 * @return    string
 */
function timestamp_to_mysqldatetime($timestamp = "", $datetime = true)
{
  if(empty($timestamp) || !is_numeric($timestamp)) $timestamp = time();

    return ($datetime) ? date("Y-m-d H:i:s", $timestamp) : date("Y-m-d", $timestamp);
} 

/**
 * Convert timestamp to Human Date
 *
 * Returns the date (format according to given string) of a given timestamp
 *
 * @author    Cleiton Francisco V. Gomes <http://www.cleitonfco.com.br/>
 * @access    public
 * @param     string
 * @param     string
 * @return    string
 */
function timestamp_to_date($timestamp = "", $format = "d/m/Y H:i:s")
{
  if(empty($timestamp) || !is_numeric($timestamp)) $timestamp = time();
  return date($format, $timestamp);
}

/**
 * Convert Human Date to Timestamp
 *
 * Returns the timestamp equivalent of a given HUMAN DATE/DATETIME
 *
 * @author    Cleiton Francisco V. Gomes <http://www.cleitonfco.com.br/>
 * @access    public
 * @param     string
 * @return    integer
 */
function date_to_timestamp($datetime = "")
{
  if (!preg_match("/^(\d{1,2})[.\- \/](\d{1,2})[.\- \/](\d{2}(\d{2})?)( (\d{1,2}):(\d{1,2})(:(\d{1,2}))?)?$/", $datetime, $date))
    return FALSE;
    
  $day = $date[1];
  $month = $date[2];
  $year = $date[3];
  $hour = (empty($date[6])) ? 0 : $date[6];
  $min = (empty($date[7])) ? 0 : $date[7];
  $sec = (empty($date[9])) ? 0 : $date[9];

  return mktime($hour, $min, $sec, $month, $day, $year);
}

/**
 * Convert HUMAN DATE to MySQL's DATE or DATETIME (YYYY-MM-DD hh:mm:ss)
 *
 * Returns the DATE or DATETIME equivalent of a given HUMAN DATE/DATETIME
 *
 * @author    Cleiton Francisco V. Gomes <http://www.cleitonfco.com.br/>
 * @access    public
 * @param     string
 * @param     boolean
 * @return    string
 */
function date_to_mysqldatetime($date = "", $datetime = TRUE)
{
  return timestamp_to_mysqldatetime(date_to_timestamp($date), $datetime);
}

/* End of file date_helper.php */
/* Location: ./system/helpers/MY_date_helper.php */