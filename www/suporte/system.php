<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	// The purpose of this file is to run any updates and global
	// checks.  For instance, we will put auto upgrade checks in here

	// border theme, must be located at your pics/frames/<color> directory
	// available: black, blue, tan, green (others will result in NO color)
	$FRAME = "dark_blue" ;

	// crypt key is used to generate an encoded mysql password
	$CRYPTKEY = "PHP Live! Powered (www.osicodes.com)" ;

	// when a call is transferred, let's give a future time of 2 minutes so
	// the visitor does not see a "Party has left" message.  it is giving
	// the operator 2 minutes to pickup or reject.
	$TRANSFER_BUFFER = 120 ;	// seconds

	// take it minus 20 because the admin window refreshes every
	// 5 seconds.  we use 15 to give it some buffer times of when
	// admin opens up multiple windows... thus, there could be up to
	// 20 seconds during someone request chat to admin and he/she is not there.
	$admin_idle_value = 20 ;
	$admin_idle = time() - $admin_idle_value ;

	// chat_timeout: seconds before chat session says "Party has left chat" message.
	// the chat session is refreshed every 2.5 seconds... and also, there is an exit
	// button.  so keep this value high (default 35) so it doesn't give a false
	// message if visitor or yourself launches app or connection breaks for short time.
	// we have noticed 10 seconds is cutting it, but with fast LAN network, it's ok.
	// if you have visitors who will request chat via modem, keep this at 35 or more.
	$chat_timeout = 35 ;

	// FOOTPRINT_IDLE: buffer time to tell if a visitor is idle or has left.
	// let's use 15 because the tracking image is refreshed every 10 seconds.  so 15
	// is plenty of time to give for buffer.
	$FOOTPRINT_IDLE = 20 ;	// seconds










	/************ DO NOT MODIFY BELOW THIS POINT *************/
	/*********************************************************/
	// DO NOT MODIFY... this is for time zone
	$TIMEZONE = 0 ; $TIMEZONE_FORMAT = "h" ; $TIMEZONE_AMPM = " a" ;
	if ( isset( $COMPANY_NAME ) && $COMPANY_NAME )
	{
		if ( preg_match( "/<:>/", $COMPANY_NAME ) )
		{
			LIST( $COMPANY_NAME_TEMP, $TIMEZONE ) = EXPLODE( "<:>", $COMPANY_NAME ) ;
			$TIMEZONE_FORMAT = substr( $TIMEZONE, 0, 1 ) ;
			$TIMEZONE = substr( $TIMEZONE, 1, strlen( $TIMEZONE ) ) ;
			$TIMEZONE_AMPM = ( $TIMEZONE_FORMAT == "H" ) ? "" : " a" ;
		}
		else
			$COMPANY_NAME_TEMP = $COMPANY_NAME ;
	}
?>