<?php
// returns false if the IP is valid - returns reason if IP is invalid

if ( !defined( 'ABSPATH' ) ) {
	http_response_code( 404 );
	die();
}

class chkvalidip {
	/**
	 * Check for a fake IP
	 *
	 * @param string $ip Client IP
	 * @param string $host Client Host [optional]
	 *
	 * @return  boolean         TRUE if fake IP
	 * @since   2.0
	 * @change  2.6.2
	 *
	 */
	private static function _is_fake_ip( $client_ip ) {
		$client_host = "";
		/* Remote Host */
		$host_by_ip = gethostbyaddr( $client_ip );
		/* IPv6 special */
		if ( self::_is_ipv6( $client_ip ) ) {
			if ( self::_is_ipv6( $host_by_ip )
			     && inet_pton( $client_ip ) === inet_pton( $host_by_ip )
			) {
// no domain
				return false;
			} else {
// has domain
				$record = dns_get_record( $host_by_ip, DNS_AAAA );
				if ( empty( $record ) || empty( $record[0]['ipv6'] ) ) {
// no reverse entry
					return true;
				} else {
					return inet_pton( $client_ip )
					       !== inet_pton( $record[0]['ipv6'] );
				}
			}
		}
		/* IPv4 / Comment */
		if ( empty( $client_host ) ) {
			$ip_by_host = gethostbyname( $host_by_ip );
			if ( $ip_by_host === $host_by_ip ) {
				return false;
			}
			/* IPv4 / Trackback */
		} else {
			if ( $host_by_ip === $client_ip ) {
				return true;
			}
			$ip_by_host = gethostbyname( $client_host );
		}
		if ( strpos( $client_ip, $this->_cut_ip( $ip_by_host ) ) === false ) {
			return true;
		}
		return false;
	}
// checking for fake IP

	/**
	 * Check for an IPv6 address
	 *
	 * @param string $ip IP to validate
	 *
	 * @return  boolean  TRUE if IPv6
	 * @since   2.6.2
	 * @change  2.6.2
	 *
	 */
	private static function _is_ipv6( $ip ) {
//return !$this->_is_ipv4( $ip );
		return filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6 )
		       !== false;
	}

	/**
	 * Check for an IPv4 address
	 *
	 * @param string $ip IP to validate
	 *
	 * @return  integer  TRUE if IPv4
	 * @since   2.4
	 * @change  2.6.2
	 *
	 */
	private static function _is_ipv4( $ip ) {
//return preg_match( '/^\d{1,3}( \.\d{1,3} ){3,3}$/', $ip );
		return filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )
		       !== false;
	}

	public function process(
		$ip, &$stats = array(), &$options = array(), &$post = array()
	) {
		if ( empty( $ip ) ) {
			_e( 'Invalid IP: ', 'stop-spammer-registrations-plugin' ) . $ip;
		}
		if ( strpos( $ip, ':' ) === false && strpos( $ip, '.' ) === false ) {
			_e( 'Invalid IP: ', 'stop-spammer-registrations-plugin' ) . $ip;
		}
		if ( defined( 'AF_INET6' ) && strpos( $ip, ':' ) !== false ) {
			try {
				if ( !@inet_pton( $ip ) ) {
					_e( 'Invalid IP: ', 'stop-spammer-registrations-plugin' ) . $ip;
				}
			} catch ( Exception $e ) {
				_e( 'Invalid IP: ', 'stop-spammer-registrations-plugin' ) . $ip;
			}
		}
// check IPv4 for local private IP addresses
		if ( $ip == '127.0.0.1' ) {
			_e( 'Accessing Site Through localhost', 'stop-spammer-registrations-plugin' );
		}
		$priv = array(
			array( '100000000000', '100255255255' ),
			array( '172016000000', '172031255255' ),
			array( '192168000000', '192168255255' )
		);
		$ip2  = be_module::ip2numstr( $ip );
		foreach ( $priv as $ips ) {
			if ( $ip2 >= $ips[0] && $ip2 <= $ips[1] ) {
				_e( 'Local IP Address: ', 'stop-spammer-registrations-plugin' ) . $ip;
			}
			if ( $ip2 < $ips[1] ) {
				break;
			} // sorted so we can bail
		}
// use the experimental check fake IP routine
// doesn't work on older PHPs or some servers without IPv6 support enables
		/*
		try {
		if ( $this->_is_fake_ip( $ip ) ) {
		return "Fake IP (experimental) $ip";
		}
		} catch ( Exception $e ) {
		return $e;
		}
		*/
// check for IPv6
		$lip = "127.0.0.1";
		if ( substr( $ip, 0, 2 ) == 'FB' || substr( $ip, 0, 2 ) == 'fb' ) {
			__( 'Local IP Address: ', 'stop-spammer-registrations-plugin' ) . $ip;
		}
// see if server and browser are running on same server
		if ( array_key_exists( 'SERVER_ADDR', $_SERVER ) ) {
			$lip = $_SERVER["SERVER_ADDR"];
			if ( $ip == $lip ) {
				_e( 'IP Same as Server: ', 'stop-spammer-registrations-plugin' ) . $ip;
			}
		} else if ( array_key_exists( 'LOCAL_ADDR', $_SERVER ) ) { // IIS 7?
			$lip = $_SERVER["LOCAL_ADDR"];
			if ( $ip == $lip ) {
				_e( 'IP Same as Server: ', 'stop-spammer-registrations-plugin' ) . $ip;
			}
		} else { // IIS 6 no server address use a gethost by name? hope we never get here
			try {
				$lip = @gethostbyname( $_SERVER['SERVER_NAME'] );
				if ( $ip == $lip ) {
					_e( 'IP Same as Server: ', 'stop-spammer-registrations-plugin' ) . $ip;
				}
			} catch ( Exception $e ) {
// can't make this work - ignore
			}
		}
// we can do this with IPv4 addresses - check if same /24 subnet
		$j = strrpos( $ip, '.' );
		if ( $j === false ) {
			return false;
		}
		$k = strrpos( $lip, '.' );
		if ( $k === false ) {
			return false;
		}
		if ( substr( $ip, 0, $j ) == substr( $lip, 0, $k ) ) {
			_e( 'IP same /24 subnet as server ', 'stop-spammer-registrations-plugin' ) . $ip;
		}
		return false;
	}
}

?>