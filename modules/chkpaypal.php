<?php
// Allow List - returns false if not found

if ( !defined( 'ABSPATH' ) ) {
	http_response_code( 404 );
	die();
}

// last updated from https://www.paypal.com/us/smarthelp/article/what-are-the-ip-addresses-for-live-paypal-servers-ts1056 on 12/22/20
class chkpaypal extends be_module {
	public $searchname = 'PayPal';
	public $searchlist = array(
			'173.0.88.66',
			'173.0.88.98',
			'173.0.84.66',
			'173.0.84.98',
			'66.211.168.91',
			'66.211.168.123',
			'173.0.88.67',
			'173.0.88.99',
			'173.0.84.99',
			'173.0.84.67',
			'66.211.168.92',
			'66.211.168.124',
			'173.0.88.69',
			'173.0.88.101',
			'173.0.84.69',
			'173.0.84.101',
			'66.211.168.126',
			'66.211.168.194',
			'173.0.88.68',
			'173.0.88.100',
			'173.0.84.68',
			'173.0.84.100',
			'66.211.168.125',
			'66.211.168.195',
			'173.0.81.1',
			'173.0.81.33',
			'66.211.170.66',
			'216.113.188.100',
			'66.211.168.93',
			'173.0.80.0/20',
			'64.4.240.0/20',
			'66.211.160.0/19',
			'118.214.15.186',
			'118.215.103.186',
			'118.215.119.186',
			'118.215.127.186',
			'118.215.15.186',
			'118.215.151.186',
			'118.215.159.186',
			'118.215.167.186',
			'118.215.199.186',
			'118.215.207.186',
			'118.215.215.186',
			'118.215.231.186',
			'118.215.255.186',
			'118.215.39.186',
			'118.215.63.186',
			'118.215.7.186',
			'118.215.79.186',
			'118.215.87.186',
			'118.215.95.186',
			'202.43.63.186',
			'69.192.31.186',
			'72.247.111.186',
			'88.221.43.186',
			'92.122.143.186',
			'92.123.151.186',
			'92.123.159.186',
			'92.123.163.186',
			'92.123.167.186',
			'92.123.179.186',
			'92.123.183.186',
			'92.123.199.186',
			'92.123.203.186',
			'92.123.207.186',
			'92.123.211.186',
			'92.123.215.186',
			'92.123.219.186',
			'92.123.247.186',
			'92.123.255.186',
			'95.100.31.186',
			'96.16.199.186',
			'96.16.23.186',
			'96.16.247.186',
			'96.16.255.186',
			'96.16.39.186',
			'96.16.55.186',
			'96.17.47.186',
			'96.6.239.186',
			'96.6.79.186',
			'96.7.175.186',
			'96.7.191.186',
			'96.7.199.186',
			'96.7.231.186',
			'96.7.247.186',
			'216.113.188.64',
			'216.113.188.34',
			'173.0.84.178',
			'173.0.84.212',
			'173.0.88.178',
			'173.0.88.212',
			'66.211.168.136',
			'66.211.168.66',
			'173.0.88.203',
			'173.0.84.171',
			'173.0.84.203',
			'173.0.88.171',
			'66.211.168.142',
			'66.211.168.150',
			'173.0.84.76',
			'173.0.88.76',
			'173.0.84.108',
			'173.0.88.108',
			'66.211.168.158',
			'66.211.168.180',
			'118.214.15.186',
			'118.215.103.186',
			'118.215.119.186',
			'118.215.127.186',
			'118.215.15.186',
			'118.215.151.186',
			'118.215.159.186',
			'118.215.167.186',
			'118.215.199.186',
			'118.215.207.186',
			'118.215.215.186',
			'118.215.231.186',
			'118.215.255.186',
			'118.215.39.186',
			'118.215.63.186',
			'118.215.7.186',
			'118.215.79.186',
			'118.215.87.186',
			'118.215.95.186',
			'202.43.63.186',
			'69.192.31.186',
			'72.247.111.186',
			'88.221.43.186',
			'92.122.143.186',
			'92.123.151.186',
			'92.123.159.186',
			'92.123.163.186',
			'92.123.167.186',
			'92.123.179.186',
			'92.123.183.186',
			'92.123.199.186',
			'92.123.203.186',
			'92.123.207.186',
			'92.123.211.186',
			'92.123.215.186',
			'92.123.219.186',
			'92.123.247.186',
			'92.123.255.186',
			'95.100.31.186',
			'96.16.199.186',
			'96.16.23.186',
			'96.16.247.186',
			'96.16.255.186',
			'96.16.39.186',
			'96.16.55.186',
			'96.17.47.186',
			'96.6.239.186',
			'96.6.79.186',
			'96.7.175.186',
			'96.7.191.186',
			'96.7.199.186',
			'96.7.231.186',
			'96.7.247.186',
// sandbox
			'173.0.82.75',
			'173.0.82.91',
			'173.0.82.77',
			'173.0.82.78',
			'173.0.82.79',
			'173.0.82.75',
			'173.0.82.126',
			'173.0.82.83',
			'173.0.82.84',
			'173.0.82.86',
			'173.0.82.89',
			'173.0.82.101',
// latest using a range
			'173.0.82.0/24',
			'173.0.83.0/24',
			'173.0.81.0/24'
		);
}

?>