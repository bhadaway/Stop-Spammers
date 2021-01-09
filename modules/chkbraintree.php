<?php
// Allow List - returns false if not found
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// last updated from https://developers.braintreepayments.com/reference/general/braintree-ip-addresses on 12/22/20
class chkbraintree extends be_module {
	public $searchname = 'braintree';
	public $searchlist = array(
// IP ranges
			'63.146.102.0/26',
			'64.4.245.128/25',
			'159.242.240.0/21',
			'184.105.251.192/26',
			'204.109.13.0/24',
			'205.219.64.0/26',
			'209.117.187.192/26',
// IP addresses
			'13.248.139.42',
			'76.223.13.31',
			'52.66.18.94',
			'18.229.102.52',
			'3.130.159.200',
			'52.221.19.209',
			'3.218.50.40',
			'35.181.21.132',
			'63.34.151.32',
			'35.178.25.114',
			'54.70.36.105',
			'3.105.225.84',
			'13.48.38.150',
			'18.162.218.223',
			'54.65.200.10',
			'52.60.193.121',
			'15.164.55.113',
			'52.29.159.59',
			'52.52.235.125',
			'13.233.180.218',
			'18.229.82.242',
			'3.13.64.186',
			'52.76.166.57',
			'3.217.221.47',
			'15.188.4.140',
			'52.30.228.26',
			'3.9.133.153',
			'52.40.39.250',
			'13.236.192.223',
			'13.53.88.233',
			'18.162.224.24',
			'52.69.177.228',
			'35.183.202.164',
			'15.164.202.144',
			'18.194.163.26',
			'54.67.109.178',
			'13.126.248.203',
			'18.229.69.211',
			'18.222.16.129',
			'3.1.92.221',
			'3.210.51.78',
			'15.188.16.231',
			'52.209.170.6',
			'3.9.186.87',
			'52.32.253.174',
			'3.105.10.183',
			'13.48.111.53',
			'18.162.215.56',
			'52.194.155.214',
			'99.79.109.197',
			'15.164.12.242',
			'3.122.176.248',
			'13.52.145.159',
			'13.235.148.10',
			'18.229.111.65',
			'3.17.123.234',
			'18.139.74.101',
			'3.219.134.92',
			'15.188.24.51',
			'99.81.230.153',
			'52.56.231.179',
			'52.40.66.148',
			'52.65.178.175',
			'13.53.120.56',
			'18.162.208.141',
			'52.68.103.138',
			'52.60.116.34',
			'52.79.62.245',
			'35.156.167.229',
			'13.52.67.79',
			'13.211.112.155',
			'13.211.117.176',
			'13.211.192.202',
			'13.236.11.12',
			'13.54.238.102',
			'13.55.63.152',
			'18.188.244.16',
			'18.218.170.239',
			'18.218.187.221',
			'18.218.200.181',
			'18.218.201.60',
			'18.220.242.19',
			'18.221.85.197',
			'34.192.200.124',
			'34.195.226.113',
			'34.197.204.88',
			'34.225.73.127',
			'34.234.41.83',
			'35.164.249.2',
			'50.16.129.106',
			'52.1.126.16',
			'52.15.105.255',
			'52.15.99.49',
			'52.22.114.134',
			'52.25.70.37',
			'52.34.5.147',
			'52.36.170.61',
			'52.62.203.27',
			'52.71.211.185',
			'52.86.247.11',
			'54.148.177.103',
			'54.153.161.29',
			'54.165.160.187',
			'54.186.103.127',
			'54.186.37.102',
			'54.66.191.243',
			'54.69.207.108',
			'54.69.92.135',
			'54.87.125.20',
// sandbox
			'13.248.141.30',
			'76.223.15.98',
			'52.10.180.37',
			'3.113.229.112',
			'35.158.212.12',
			'13.48.80.201',
			'18.162.131.120',
			'15.164.54.187',
			'18.232.5.12',
			'54.207.12.197',
			'3.104.56.150',
			'35.183.169.117',
			'3.9.84.180',
			'13.235.118.29',
			'13.52.191.162',
			'3.14.35.212',
			'34.243.143.250',
			'35.181.122.216',
			'13.251.190.251',
			'35.162.23.35',
			'52.194.11.6',
			'35.158.30.247',
			'13.53.79.19',
			'18.162.128.255',
			'52.78.198.71',
			'54.161.46.43',
			'54.94.132.38',
			'52.65.33.215',
			'99.79.148.201',
			'35.177.65.248',
			'13.235.150.220',
			'54.67.105.20',
			'18.223.103.77',
			'34.255.174.44',
			'35.181.137.42',
			'18.136.77.216',
			'52.39.201.194',
			'3.113.200.9',
			'52.57.216.246',
			'13.48.88.154',
			'18.162.72.201',
			'15.164.168.254',
			'34.237.133.134',
			'18.229.101.222',
			'13.55.21.210',
			'35.182.81.213',
			'18.130.160.231',
			'13.234.174.91',
			'54.183.158.200',
			'3.13.92.194',
			'99.81.241.232',
			'35.180.84.175',
			'18.142.0.145',
			'54.148.237.196',
			'52.193.225.73',
			'3.120.119.75',
			'13.53.202.200',
			'18.162.67.12',
			'15.164.15.215',
			'3.220.238.198',
			'18.231.9.255',
			'13.236.156.3',
			'99.79.135.217',
			'35.178.128.157',
			'13.127.189.236',
			'54.67.53.148',
			'18.217.209.3',
			'18.200.142.157',
			'35.181.161.116',
			'3.0.254.180',
			'34.198.68.22',
			'34.196.141.71',
			'54.209.200.157',
			'34.239.18.213',
			'52.6.121.4',
			'34.195.20.44',
			'52.2.64.153',
			'34.228.0.223',
			'54.210.199.181',
			'54.87.37.91',
			'54.88.250.189',
			'18.221.164.159',
			'18.220.47.193',
			'52.15.99.174',
			'18.191.121.37',
			'52.15.201.121',
			'52.15.36.79',
			'18.188.76.181',
			'13.59.120.45',
			'18.188.236.32',
			'52.33.44.190',
			'35.164.62.53',
			'52.10.175.22',
			'54.71.166.31',
			'54.148.85.238',
			'54.201.233.164',
			'34.210.211.84',
			'35.166.182.53',
			'35.162.22.163',
			'52.65.177.197',
			'54.79.110.115',
			'13.54.132.116',
			'54.206.36.176',
			'54.79.63.55',
			'13.54.72.101',
			'54.153.144.111',
			'54.206.35.233',
			'13.236.141.214',
			'50.18.50.113',
			'52.52.171.44',
			'54.241.91.115',
			'184.169.137.109',
			'54.177.221.126',
			'54.176.193.158',
			'54.193.128.216',
			'204.236.187.5',
			'54.176.192.159',
			'184.72.16.50',
			'54.177.106.232',
			'50.18.225.62',
			'184.169.160.115',
			'52.9.201.213'
		);
}

?>
