<?php

/**
 * SEF CPANEL for Joomla!
 * Originally written for Mambo as 404SEF by W. H. Welch.
 *
 * @author      $Author: shumisha $
 * @copyright   Yannick Gaultier - 2007
 * @package     sh404SEF
 * {shSourceVersionTag: V 1.2.4.q - 2007-06-10}
 */


/** ensure this file is being included by a parent file */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

function displayCPanelHTML( $sefCount, $Count404, $customCount) {
global $sefConfig;
?>

<table class="adminform">

   <tr>

      <td width="50%" valign="top">

         <table width="100%">
         <tr>
            <td colspan="3"><table class="adminform"><tr>
            <td width = "8%"><?php echo _COM_SEF_SH_REDIR_TOTAL.':'; ?>
            </td>
            <td align="left" width = "12%" style="font-weight: bold"><?php echo $sefCount+$Count404+$customCount; ?>
            </td>
            <td width = "8%"><?php echo _COM_SEF_SH_REDIR_SEF.':'; ?>
            </td>
            <td align="left" width = "12%" style="font-weight: bold"><?php echo $sefCount; ?>
            </td>
            <td width = "8%"><?php echo _COM_SEF_SH_REDIR_404.':'; ?>
            </td>
            <td align="left" width = "12%" style="font-weight: bold"><?php echo $Count404; ?>
            </td>
            <td width = "8%"><?php echo _COM_SEF_SH_REDIR_CUSTOM.':'; ?>
            </td>
            <td align="left" width = "12%" style="font-weight: bold"><?php echo $customCount; ?>
            </td>
            </tr></table>
           </td> 
         </tr>
         <tr>

            <td align="center" height="90" width="90">

            <a href="index2.php?option=com_sef&task=showconfig" style="text-decoration:none;" title="<?php echo _COM_SEF_CONFIG_DESC;?>">

            <img src="components/com_sef/images/config.png" width="48" height="48" align="middle" border="0"/>

            <br />

            <?php echo _COM_SEF_CONFIG;?>

            </a>

            </td>



            <td align="center" height="90" width="90">

            <a href="index2.php?option=com_sef&task=import_export" style="text-decoration:none;" title="<?php echo _COM_SEF_IMPORT_EXPORT;?>">

            <img src="components/com_sef/images/help.png" width="48" height="48" align="middle" border="0"/>

            <br />

            <?php echo _COM_SEF_IMPORT_EXPORT;?>

            </a>

            </td>



            <td align="center" height="90" width="90">

            <a href="index2.php?option=com_sef&task=info" style="text-decoration:none;" title="<?php echo _COM_SEF_INFODESC;?>">

            <img src="components/com_sef/images/info.png" width="48" height="48" align="middle" border="0"/>

            <br />

            <?php echo _COM_SEF_INFO;?>

            </a>

            </td>

         </tr>

         <tr>

            <td align="center" height="90" width="90">

            <a href="index2.php?option=com_sef&task=view&viewmode=0" style="text-decoration:none;" title="<?php echo _COM_SEF_VIEWURLDESC;?>">

            <img src="components/com_sef/images/url.png" width="48" height="48" align="middle" border="0"/>

            <br />

            <?php echo _COM_SEF_VIEWURL ;?>

            </a>

            </td>



            <td align="center" height="90" width="90">

            <a href="index2.php?option=com_sef&task=view&viewmode=1" style="text-decoration:none;" title="<?php echo _COM_SEF_VIEW404DESC;?>">

            <img src="components/com_sef/images/logs.png" width="48" height="48" align="middle" border="0"/>

            <br />

            <?php echo _COM_SEF_VIEW404 ;?>

            </a>

            </td>



            <td align="center" height="90" width="90">

            <a href="index2.php?option=com_sef&task=view&viewmode=2" style="text-decoration:none;" title="<?php echo _COM_SEF_VIEWCUSTOMDESC;?>">

            <img src="components/com_sef/images/redirect.png" width="48" height="48" align="middle" border="0"/>

            <br />

            <?php echo _COM_SEF_VIEWCUSTOM ;?>

            </a>

            </td>



         </tr>

         <tr>

            <td align="center" height="90" width="90">

            <a href="index2.php?option=com_sef&task=purge&viewmode=0&confirmed=0" style="text-decoration:none;" title="<?php echo _COM_SEF_PURGEURLDESC;?>">

            <img src="components/com_sef/images/cut-url.png" width="48" height="48" align="middle" border="0"/>

            <br />

            <?php echo _COM_SEF_PURGEURL ;?>

            </a>

            </td>



            <td align="center" height="90" width="90">

            <a href="index2.php?option=com_sef&task=purge&viewmode=1&confirmed=0" style="text-decoration:none;" title="<?php echo _COM_SEF_PURGE404DESC;?>">

            <img src="components/com_sef/images/cut-logs.png" width="48" height="48" align="middle" border="0"/>

            <br />

            <?php echo _COM_SEF_PURGE404 ;?>

            </a>

            </td>



            <td align="center" height="90" width="90">

            <a href="index2.php?option=com_sef&task=purge&viewmode=2&confirmed=0" style="text-decoration:none;" title="<?php echo _COM_SEF_PURGECUSTOMDESC;?>">

            <img src="components/com_sef/images/cut-redirect.png" width="48" height="48" align="middle" border="0"/>

            <br />

            <?php echo _COM_SEF_PURGECUSTOM ;?>

            </a>

            </td>



         </tr>         </table>

      </td>

      <td width="50%" valign="top" align="center">

      <table border="1" width="100%" class="adminform">

         <tr>

            <th class="cpanel" colspan="2">sh404SEF</th></td>

         </tr>

         <tr><td bgcolor="#D3D3D1" colspan="2"><br />

      <div style="width=100%" align="center">

      <img src="components/com_sef/images/logo.gif" align="middle" alt="404SEF logo"/ border="0" /></a>

      <br /><br /></div>

      </td></tr>

         <tr>

            <td width="120" bgcolor="#EFEFEF"><?php echo _COM_SEF_INSTALLED_VERS ;?></td>

            <td bgcolor="#EFEFEF"><?php if (!empty($sefConfig)) echo $sefConfig->version;
                    else echo 'Please review and save configuration first'; ?></td>

         </tr>

         <tr>

            <td bgcolor="#F4F4F4"><?php echo _COM_SEF_COPYRIGHT ;?></td>

            <td bgcolor="#F4F4F4">&copy; 2004-2007 WHW3.COM, ARTIO.NET, Yannick Gaultier</td>

         </tr>

         <tr>

            <td bgcolor="#EFEFEF"><?php echo _COM_SEF_LICENSE ;?></td>

            <td bgcolor="#EFEFEF"><a href="http://www.gnu.org/copyleft/gpl.html" target="_blank">GNU GPL</a></td>

         </tr>

      </table>

      </td>

   </tr>

</table>

<?php } ?>
<!--

            </td>

            <td align="center" height="100px" width="10">

            &nbsp;

            </td>

-->

