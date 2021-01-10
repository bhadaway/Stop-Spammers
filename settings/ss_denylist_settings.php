<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // just in case

if ( ! current_user_can( 'manage_options' ) ) {
	die( __( 'Access Denied', 'stop-spammer-registrations-plugin' ) );
}

ss_fix_post_vars();
$now     = date( 'Y/m/d H:i:s', time() + ( get_option( 'gmt_offset' ) * 3600 ) );
$options = ss_get_options();
extract( $options );
$nonce   = '';

if ( array_key_exists( 'ss_stop_spammers_control', $_POST ) ) {
	$nonce = $_POST['ss_stop_spammers_control'];
}

if ( ! empty( $nonce ) && wp_verify_nonce( $nonce, 'ss_stopspam_update' ) ) {
	if ( array_key_exists( 'blist', $_POST ) ) {
		$blist = $_POST['blist'];
		if ( empty( $blist ) ) {
			$blist = array();
		} else {
			$blist = explode( "\n", $blist );
		}
		$tblist = array();
		foreach ( $blist as $bl ) {
			$bl = trim( $bl );
			if ( ! empty( $bl ) ) {
				$tblist[] = $bl;
			}
		}
		$options['blist'] = $tblist;
		$blist            = $tblist;
	}
	if ( array_key_exists( 'spamwords', $_POST ) ) {
		$spamwords = $_POST['spamwords'];
		if ( empty( $spamwords ) ) {
			$spamwords = array();
		} else {
			$spamwords = explode( "\n", $spamwords );
		}
		$tblist = array();
		foreach ( $spamwords as $bl ) {
			$bl = trim( $bl );
			if ( ! empty( $bl ) ) {
				$tblist[] = $bl;
			}
		}
		$options['spamwords'] = $tblist;
		$spamwords            = $tblist;
	}
	if ( array_key_exists( 'denyurlshortners', $_POST ) ) {
		$denyurlshortners = $_POST['denyurlshortners'];
		if ( empty( $denyurlshortners ) ) {
			$denyurlshortners = array();
		} else {
			$denyurlshortners = explode( "\n", $denyurlshortners );
		}
		$tblist = array();
		foreach ( $denyurlshortners as $bl ) {
			$bl = trim( $bl );
			if ( ! empty( $bl ) ) {
				$tblist[] = $bl;
			}
		}
		$options['denyurlshortners'] = $tblist;
		$denyurlshortners            = $tblist;
	}
	if ( array_key_exists( 'badTLDs', $_POST ) ) {
		$badTLDs = $_POST['badTLDs'];
		if ( empty( $badTLDs ) ) {
			$badTLDs = array();
		} else {
			$badTLDs = explode( "\n", $badTLDs );
		}
		$tblist = array();
		foreach ( $badTLDs as $bl ) {
			$bl = trim( $bl );
			if ( ! empty( $bl ) ) {
				$tblist[] = $bl;
			}
		}
		$options['badTLDs'] = $tblist;
		$badTLDs            = $tblist;
	}
	if ( array_key_exists( 'badagents', $_POST ) ) {
		$badagents = $_POST['badagents'];
		if ( empty( $badagents ) ) {
			$badagents = array();
		} else {
			$badagents = explode( "\n", $badagents );
		}
		$tblist = array();
		foreach ( $badagents as $bl ) {
			$bl = trim( $bl );
			if ( ! empty( $bl ) ) {
				$tblist[] = $bl;
			}
		}
		$options['badagents'] = $tblist;
		$badagents            = $tblist;
	}
// check box setting
	$optionlist = array(
		'chkspamwords',
		'chkbluserid',
		'chkagent'
	);
	foreach ( $optionlist as $check ) {
		$v = 'N';
		if ( array_key_exists( $check, $_POST ) ) {
			$v = $_POST[ $check ];
			if ( $v != 'Y' ) {
				$v = 'N';
			}
		}
		$options[ $check ] = $v;
	}
	ss_set_options( $options );
	extract( $options );
	$msg = '<div class="notice notice-success is-dismissible"><p>' . __( 'Options Updated', 'stop-spammer-registrations-plugin' ) . '</p></div>';
}
$nonce = wp_create_nonce( 'ss_stopspam_update' );
?>
<div id="ss-plugin" class="wrap">
	<h1 class="ss_head">Stop Spammers — <?php __( 'Block Lists', 'stop-spammer-registrations-plugin' ); ?></h1>
	<br />
	<br />
	<?php if ( ! empty( $msg ) ) {
		echo "$msg";
	} ?>
	<form method="post" action="">
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="ss_stop_spammers_control" value="<?php echo $nonce; ?>" />
	<div class="mainsection"><?php __( 'Personalised Block List', 'stop-spammer-registrations-plugin' ); ?>
	<sup class="ss_sup"><a href="https://stopspammers.io/block-list/#blocklist" target="_blank"><i class="fa fa-question-circle fa-2x tooltip"></i></a></sup></div>
			<p><?php __( 'Add IP addresses or emails here that you want blocked.', 'stop-spammer-registrations-plugin' ); ?></p>
<div class="checkbox switcher">
	  <label id="ss_subhead" for="chkbluserid">
			<input class="ss_toggle" type="checkbox" id="chkbluserid" name="chkbluserid" value="Y" <?php if ( $chkbluserid == 'Y' ) {
					echo "checked=\"checked\"";
} ?> /><span><small></small></span>
		  <small><span style="font-size:16px!important;"><?php __( 'Enable Block by User ID', 'stop-spammer-registrations-plugin' ); ?></span></small></label></div>
			 <br />
			<textarea name="blist" cols="40" rows="8"><?php
				foreach ( $blist as $p ) {
					echo $p . "\r\n";
				}
				?></textarea>
		<br />
	<div class="mainsection"><?php __( 'Spam Words List', 'stop-spammer-registrations-plugin' ); ?>
	<sup class="ss_sup"><a href="https://stopspammers.io/block-list/#spamwords" target="_blank"><i class="fa fa-question-circle fa-2x tooltip"></i></a></sup></div>				
<div class="checkbox switcher">
	  <label id="ss_subhead" for="chkspamwords">
			<input class="ss_toggle" type="checkbox" id="chkspamwords" name="chkspamwords" value="Y" <?php if ( $chkspamwords == 'Y' ) {
					echo "checked=\"checked\"";
} ?> /><span><small></small></span>
		  <small><span style="font-size:16px!important;"><?php __( 'Check Spam Words', 'stop-spammer-registrations-plugin' ); ?></span></small></label></div>
				<br />
			<textarea name="spamwords" cols="40" rows="8"><?php
				foreach ( $spamwords as $p ) {
					echo $p . "\r\n";
				}
				?></textarea>
		<br />
	<div class="mainsection"><?php __( 'URL Shortening Services List', 'stop-spammer-registrations-plugin' ); ?>
	<sup class="ss_sup"><a href="https://stopspammers.io/block-list/#urlshortening" target="_blank"><i class="fa fa-question-circle fa-2x tooltip"></i></a></sup></div>			
		<div class="checkbox switcher">
			<label id="ss_subhead" for="chkurlshort">
				<input class="ss_toggle" type="checkbox" id="chkurlshort" name="chkurlshort" value="Y" <?php if ( $chkurlshort == 'Y' ) { echo 'checked="checked"'; } ?> />
				<span><small></small></span>
				<small>
					<span style="font-size:16px!important;"><?php __( 'Check URL Shorteners', 'stop-spammer-registrations-plugin' ); ?></span></small></label></div>
		<br />
		<textarea name="denyurlshortners" cols="40" rows="8"><?php
			foreach ( $denyurlshortners as $p ) {
				echo $p . "\r\n";
			}
		?></textarea>
        <br />
	<div class="mainsection"><?php __( 'Bad User Agents List', 'stop-spammer-registrations-plugin' ); ?>
	<sup class="ss_sup"><a href="https://stopspammers.io/block-list/#badagents" target="_blank"><i class="fa fa-question-circle fa-2x tooltip"></i></a></sup></div>	
<div class="checkbox switcher">
	  <label id="ss_subhead" for="chkagent">
			<input class="ss_toggle" type="checkbox" id="chkagent" name="chkagent" value="Y" <?php if ( $chkagent == 'Y' ) {
					echo "checked=\"checked\"";
} ?> /><span><small></small></span>
		  <small><span style="font-size:16px!important;"><?php __( 'Check Agents', 'stop-spammer-registrations-plugin' ); ?></span></small></label></div>
				<br />
			<textarea name="badagents" cols="40" rows="8"><?php
				foreach ( $badagents as $p ) {
					echo $p . "\r\n";
				}
				?></textarea>
			<br />
		<br />
	<div class="mainsection"><?php __( 'Blocked TLDs', 'stop-spammer-registrations-plugin' ); ?>
	<sup class="ss_sup"><a href="https://stopspammers.io/block-list/#blockedtlds" target="_blank"><i class="fa fa-question-circle fa-2x tooltip"></i></a></sup></div>					
			<?php __( '
			<p>Enter the TLD name including the '.' e.g. .XXX
			 A TLD is the last part of a domain like .COM or .NET.</p>
			', 'stop-spammer-registrations-plugin' ); ?>
			<textarea name="badTLDs" cols="40" rows="8"><?php
				foreach ( $badTLDs as $p ) {
					echo $p . "\r\n";
				}
				?></textarea><br />
		<br />
		<p class="submit"><input class="button-primary" value="<?php __( 'Save Changes', 'stop-spammer-registrations-plugin' ); ?>" type="submit" /></p>
	</form>
</div>