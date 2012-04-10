<?php defined ('SYSPATH') or die ('Restricted access.');

/**
 * Session Class
 *
 * This class handle all session stuff
 *
 * @package		Wakuwakuw 2.0
 * @subpackage	Desktop Client
 * @category	Class
 * @author		Taufan Aditya
 */

class Session {
	
	protected $_iphelper;
	
	protected $_sess_name;

	protected $_sess_data;

	protected $_systemdata;

	protected $_userdata;
	
	/**
	 * Constructor
	 * 
	 * @param   void
	 */
	function __construct()
	{
		$this->_iphelper = new Iphelper;

		if ( ! $_SESSION['dump'])
		{
			$_SESSION['dump'] = array(

				'ip' => $this->_iphelper->get_ip_address(),

			);
		}

		$this->_sess_name = 'wakuwakuw_session';

		$this->_systemdata = array(

			'sess_id'     => session_id (),

			'browser'     => $_SERVER['HTTP_USER_AGENT'],

			'ip'          => $this->_iphelper->get_ip_address(),

			'lang'        => 'en',

		);

		$this->_userdata = array();

		$this->_sess_data = serialize(array('_systemdata' => $this->_systemdata, '_userdata' => $this->_userdata));

		$this->_sess_start($this->_sess_data);
	}
	
	
	/**
	 * Read Userdata
	 * 
	 * @param   void
	 * @return  array
	 */
	public function read_userdata($key='', $default = NULL)
	{
		return $key == '' ? $this->_sess_read('_userdata') : Arr::get($this->_sess_read('_userdata'),$key, $default);
	}
	
	/**
	 * Set Userdata
	 * 
	 * @param   array
	 * @return  void
	 */
	public function set_userdata($userdata = array())
	{
		empty($userdata) or $this->_sess_update(array('_userdata' => $userdata));
	}
	
	/**
	 * Unset Userdata
	 * 
	 * @param   void
	 * @return  void
	 */
	public function unset_userdata()
	{
		$this->_sess_update(array('_userdata' => array()));
	}
	
	/**
	 * Read Systemdata
	 * 
	 * @param   void
	 * @return  array
	 */
	public function read_systemdata($key='')
	{
		return $key == '' ? $this->_sess_read('_systemdata') : Arr::get($this->_sess_read('_systemdata'), $key);
	}
	
	/**
	 * Set Systemdata
	 * 
	 * @param   array
	 * @return  void
	 */
	public function set_systemdata($systemdata = array())
	{
		empty($systemdata) or $this->_sess_update(array('_systemdata' => $systemdata));
	}
	
	/**
	 * _sess_start
	 * 
	 * Check session state everytime class loaded
	 * 
	 * @param   string (serialized data)
	 * @return  void
	 */
	private function _sess_start($sess_data = '')
	{
		if ( ! ($_SESSION[$this->_sess_name]))
		{
			$this->_sess_write($sess_data);
		}
	}
	
	/**
	 * _sess_read
	 * 
	 * Read session section
	 * 
	 * @param   string (serialized data)
	 * @return  array
	 */
	private function _sess_read($section = '')
	{
		if ($section != '')
		{
			$raw_data = $_SESSION[$this->_sess_name];

			$semi_data = unserialize($raw_data);

			return Arr::get($semi_data, $section);
		}
	}
	
	/**
	 * _sess_write
	 * 
	 * Write session data
	 * 
	 * @param   string (serialized data)
	 * @return  void
	 */
	private function _sess_write($sess_data = '')
	{
		if ($sess_data != '')
		{
			$_SESSION[$this->_sess_name] = $sess_data;
		}
	}
	
	/**
	 * _sess_update
	 * 
	 * Update session data
	 * 
	 * @param   array
	 * @return  void
	 */
	private function _sess_update($sess_data = array())
	{
		if ( ! empty($sess_data))
		{
			$raw_data = $_SESSION[$this->_sess_name];
		}
		else
		{
			$raw_data = $this->_sess_data;
		}

		$old_data = unserialize($raw_data);

		$new_data = $old_data;
		
		foreach ($sess_data as $item_data_key => $item_data_val)
		{
			if (array_key_exists($item_data_key, $old_data)) 
			{
				if (is_array($item_data_val) && ! empty($item_data_val))
				{
					foreach ($item_data_val as $key => $val) $new_data[$item_data_key][$key] = $val;
				}
				else
				{
					$new_data[$item_data_key] = $item_data_val;
				}
			}
		}

		$this->_sess_write(serialize($new_data));
	}
}