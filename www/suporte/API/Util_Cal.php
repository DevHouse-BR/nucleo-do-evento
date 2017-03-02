<?
	if ( ISSET( $_OFFICE_UTIL_CAL_LOADED ) == true )
		return ;

	$_OFFICE_UTIL_CAL_LOADED = true ;

	/*****  Util_Cal_DrawCalendar  ********************************
	 *
	 *  Parameters:
	 *	$m				// month
	 *	$y				// year
	 *	$href			// target when clicked
	 *	$href_self		// script that called this function
	 *	$href_month		// target when clicked on the month
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$output ( array )
	 *	false ( failure )
	 *
	 *  History:
	 *	Yim Cho					Dec 15, 2001
	 *
	 *****************************************************************/
	function Util_Cal_DrawCalendar( $dbh,
						$m,
						$y,
						$href,
						$href_self,
						$href_month,
						$action )
	{
		if ( ( !$m ) || ( !$y ) )
		{ 
			$m = date( "m",mktime() ) ;
			$y = date( "Y",mktime() ) ;
		}
		$today_m = date( "m",mktime() ) ;
		$today_y = date( "Y",mktime() ) ;
		$today_d = date( "j",mktime() ) ;

		// get the weekday of the first
		$tmpd = getdate( mktime( 0,0,0,$m,1,$y ) ) ;
		$month = $tmpd["month"]; 
		$firstwday= $tmpd["wday"];
		$lastday = LastDayOfMonth( $m, $y ) ;
	?>
	<table cellpadding=1 cellspacing=2 border=0 width="180">
	<tr class="altcolor1"><td colspan=7>
		<table cellpadding=3 cellspacing=0 border=0 width="100%">
			<tr>
				<th width="30">
					<a href="<?=$href_self?>&m=<?=(($m-1)<1) ? 12 : $m-1 ?>&y=<?=(($m-1)<1) ? $y-1 : $y ?>&d=1&action=<?= $action ?>" class="nav">&lt;&lt;</a> &nbsp;
					<a href="<?=$href_self?>&m=<?=$m?>&y=<?=((($m-1)<1) ? $y-1 : $y)-1?>&d=1&action=<?= $action ?>" class="nav">&lt;</a></th>
				<th align="center">
				<? if ( $href_month ): ?>
				<a href="<?="$href_month&m=$m&y=$y"?>" class="nav"><?="$month $y"?></a></font>
				<? else: ?>
				<?="$month $y"?></font>
				<? endif ; ?>
				</th>
				<th width="30" align="right">
					<a href="<?=$href_self?>&m=<?=$m?>&y=<?=((($m+1)>12) ? $y+1 : $y)+1 ?>&d=1&action=<?= $action ?>" class="nav">&gt;</a> &nbsp;
					<a href="<?=$href_self?>&m=<?=(($m+1)>12) ? 1 : $m+1 ?>&y=<?=(($m+1)>12) ? $y+1 : $y ?>&d=1&action=<?= $action ?>" class="nav">&gt;&gt;</a>
				</th>
			</tr>
		</table>
	</td></tr>
	<tr align="center" class="altcolor1"><td><strong>Su</td><td><strong>M</td>
		<td><strong>T</td><td><strong>W</td>
		<td><strong>Th</td><td><strong>F</td>
		<td><strong>Sa</td></tr>
	<? 
		$d = 1;
		$wday = $firstwday;
		$firstweek = true;

		// loop through days of the week
		while ( $d <= $lastday ) 
		{
			// put blank fillers for the first week exmptys
			if ( $firstweek )
			{
				print "<tr align=\"center\">" ;
				for ( $i=1; $i <= $firstwday; $i++ ) 
					print "<td><font size=2>&nbsp;</font></td>";
				$firstweek = false;
			}

			// each sunday, (0), we place a new row
			if ( $wday == 0 )
				print "<tr align=\"center\">" ;

			$class = "class=\"altcolor2\"" ;
			$time_begin = mktime( 0, 0, 0, $m, $d, $y ) ;
			$time_end = mktime( 23, 59, 59, $m, $d, $y ) ;

			if ( ( $today_d == $d ) && ( $today_m == $m ) && ( $today_y == $y ) )
				$class = "class=\"altcolor1\"" ;

			// the ouput of calendar
			print "
				<td $class><a href=\"$href&m=$m&d=$d&y=$y\">$d</a></td>
			" ;

			// end the <tr> on a Saturday
			if ( $wday == 6 )
				print "</tr>\n" ;

			$wday++;
			$wday = $wday % 7;
			$d++;
		}
	?>
	</tr></table>
	<?
	} 

	function LastDayOfMonth( $mon, $year )
	{
		return date( "d", mktime( 23,59,59,$mon+1,0,$year ) ) ;
	}
?>