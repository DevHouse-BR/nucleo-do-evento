<?
	/*****  CleanFiles::util  ************************************
	 *
	 *  $Id: Util_CleanFiles.php,v 1.2 2004/08/26 00:28:59 osicodes Exp $
	 *
	 *  Purpose:
	 *	[PURPOSE HERE]
	 *
	 *  Functions:
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_UTIL_CleanFiles_LOADED ) == true )
		return ;

	$_OFFICE_UTIL_CleanFiles_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  CleanFiles_util_CleanChatSessionFiles  *******************
	 *
	 *  History:
	 *	Kyle Hicks				Nov 13, 2002
	 *
	 *****************************************************************/
	FUNCTION CleanFiles_util_CleanChatSessionFiles( )
	{
		global $DOCUMENT_ROOT ;

		$chatsessions_dir = "$DOCUMENT_ROOT/web/chatsessions" ;
		$time_to_delete = time() - (60*60*24) ;
		if ( $dir = @opendir( $chatsessions_dir ) )
		{
			while( $file = readdir( $dir ) )
			{
				if ( preg_match( "/(.txt)/", $file ) )
				{
					$mod_time = filemtime( "$chatsessions_dir/$file" ) ;
					if ( $mod_time < $time_to_delete )
					unlink( "$chatsessions_dir/$file" ) ;
				}
			}
			closedir($dir) ;
		}
		return true ;
	}

	/*****  CleanFiles_util_CleanSurveySessionFiles  *******************
	 *
	 *  History:
	 *	Kyle Hicks				Nov 13, 2002
	 *
	 *****************************************************************/
	FUNCTION CleanFiles_util_CleanSurveySessionFiles( )
	{
		global $DOCUMENT_ROOT ;

		$surveysessions_dir = "$DOCUMENT_ROOT/web/chatrequests" ;
		$time_to_delete = time() - (60*15) ;
		if ( $dir = @opendir( $surveysessions_dir ) )
		{
			while( $file = readdir( $dir ) )
			{
				if ( preg_match( "/(.s)/", $file ) )
				{
					$mod_time = filemtime( "$surveysessions_dir/$file" ) ;
					if ( $mod_time < $time_to_delete )
					unlink( "$surveysessions_dir/$file" ) ;
				}
			}
			closedir($dir) ;
		}
		return true ;
	}
?>