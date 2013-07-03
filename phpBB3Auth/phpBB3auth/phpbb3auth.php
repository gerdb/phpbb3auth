<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Authentication.phpbb3auth
 *
 * @copyright   Copyright (C) 2013 Gerd Bartelt. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * phpBB3 Authentication Plugin
 *
 * @package     Joomla.Plugin
 * @subpackage  Authentication.phpbb3auth
 * @since       1.5
 */
class PlgAuthenticationPhpbb3auth extends JPlugin
{

    // configuration parameters
    public $table_prefix = '';
    
     /**
     * Constructor
     *
     * For php4 compatability we must not use the __constructor as a constructor for plugins
     * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
     * This causes problems with cross-referencing necessary for the observer design pattern.
     *
     * @param object $subject The object to observe
     * @param array  $config An array that holds the plugin configuration 
     * @since 1.5
     */
    function PlgAuthenticationPhpbb3auth(& $subject, $config) {
        parent::__construct($subject, $config);
        $this->table_prefix = json_decode($config['params'])->phpbb3_table_prefix;
    }

	/**
	* Encode hash
	*/
	private function _hash_encode64($input, $count, &$itoa64)
	{
		$output = '';
		$i = 0;

		do
		{
			$value = ord($input[$i++]);
			$output .= $itoa64[$value & 0x3f];

			if ($i < $count)
			{
				$value |= ord($input[$i]) << 8;
			}

			$output .= $itoa64[($value >> 6) & 0x3f];

			if ($i++ >= $count)
			{
				break;
			}

			if ($i < $count)
			{
				$value |= ord($input[$i]) << 16;
			}

			$output .= $itoa64[($value >> 12) & 0x3f];

			if ($i++ >= $count)
			{
				break;
			}

			$output .= $itoa64[($value >> 18) & 0x3f];
		}
		while ($i < $count);

		return $output;
	}

	/**
	* The crypt function/replacement
	*/
	private function _hash_crypt_private($password, $setting, &$itoa64)
	{
		$output = '*';

		// Check for correct hash
		if (substr($setting, 0, 3) != '$H$' && substr($setting, 0, 3) != '$P$')
		{
			return $output;
		}

		$count_log2 = strpos($itoa64, $setting[3]);

		if ($count_log2 < 7 || $count_log2 > 30)
		{
			return $output;
		}

		$count = 1 << $count_log2;
		$salt = substr($setting, 4, 8);

		if (strlen($salt) != 8)
		{
			return $output;
		}

		/**
		* We're kind of forced to use MD5 here since it's the only
		* cryptographic primitive available in all versions of PHP
		* currently in use.  To implement our own low-level crypto
		* in PHP would result in much worse performance and
		* consequently in lower iteration counts and hashes that are
		* quicker to crack (by non-PHP code).
		*/
		if (PHP_VERSION >= 5)
		{
			$hash = md5($salt . $password, true);
			do
			{
				$hash = md5($hash . $password, true);
			}
			while (--$count);
		}
		else
		{
			$hash = pack('H*', md5($salt . $password));
			do
			{
				$hash = pack('H*', md5($hash . $password));
			}
			while (--$count);
		}

		$output = substr($setting, 0, 12);
		$output .= $this->_hash_encode64($hash, 16, $itoa64);

		return $output;
	}
	 
	/**
	* Check for correct password
	*
	* @param string $password The password in plain text
	* @param string $hash The stored password hash
	*
	* @return bool Returns true if the password is correct, false if not.
	*/
	private function phpbb_check_hash($password, $hash)
	{
		$itoa64 = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		if (strlen($hash) == 34)
		{
			return ($this->_hash_crypt_private($password, $hash, $itoa64) === $hash) ? true : false;
		}

		return (md5($password) === $hash) ? true : false;
	}
	
	 
	public function onUserAuthenticate($credentials, $options, &$response)
	{
		// Joomla does not like blank passwords
		if (empty($credentials['password']))
		{
			$response->status = JAuthentication::STATUS_FAILURE;
			$response->error_message = JText::_('JGLOBAL_AUTH_EMPTY_PASS_NOT_ALLOWED');
			return false;
		}

		// Get a database object
		$db		= JFactory::getDbo();

		$result = $db->getTableList();
		if (!in_array($this->table_prefix . 'users', $result)) {
			$response->status = JAuthentication::STATUS_FAILURE;
			$response->error_message = "Table ".$this->table_prefix . 'users'." does not exist";
			return false;
		}

		$query	= $db->getQuery(true)
			->select('username, user_password, user_email, user_type')
			->from($this->table_prefix . 'users')
			->where('username=' . $db->quote($credentials['username']));

		$db->setQuery($query);
		$result = $db->loadObject();

		if ($result)
		{
			if (
				// Check password 
				$this->phpbb_check_hash($credentials['password'],$result->user_password) &&
				// only active users
				( ($result->user_type == 0) || ($result->user_type == 3) )
				)
			{
				// Use the phpBB3 email
				$response->email = $result->user_email;
				$response->username = $credentials['username'];
				$response->fullname = $credentials['username'];

				$response->status = JAuthentication::STATUS_SUCCESS;
				$response->error_message = '';

			} else {
				$response->status = JAuthentication::STATUS_FAILURE;
				$response->error_message = JText::_('JGLOBAL_AUTH_INVALID_PASS');
			}
		}
		else
		{
			$response->status = JAuthentication::STATUS_FAILURE;
			$response->error_message = JText::_('JGLOBAL_AUTH_NO_USER');
		}

		$response->type = 'phpBB3'; 

	}
}
