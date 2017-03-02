<style type="text/css">
    div.docs,
    div.docs p,
    div.docs ul li,
    div.docs ol li {
        text-align: left;
        font-weight: lighter;
        font-family: Tahoma, Arial, Verdana;
    }
    div.docs h1 {
        text-align: center;
    }
	div.docs h4,
	span.h4 {
		color: #CC0000;
	}
	div.docs p {
		padding-left: 3em;
		font-weight: lighter;
	}
	div.docs .small {
	    color: #666666;
		font-size: 90%;
	}
	div.docs h5, span.h5 {
        font-weight: bold;
    }
</style>
<div class="docs">
    <p style="text-align: right;"><span class="small">Updated: June 10, 2007</span></p>
    <h1>sh404SEF Documentation</h1>
    <p style="text-align: center;">for Joomla 1.0.x</p>
    <h2>Support site</h2
    <br />
    You will find up to date information and support at <a href="http://extensions.siliana.com">extensions.Siliana.com</a>. Please also check our forum at <a href="http://extensions.siliana.com/forum.html">extensions.Siliana.com/forum.html</a><br /><br />
    <h2>Summary</h2>
    <p>Allows Search Engine Friendly URLs for Apache (and possibly but unsupported, IIS), returns proper
        404 status code for missing content, provides logging of 404 errors,
        and creation of special &quot;shortcut&quot; URLs that allow the user
        to redirect to the new URL.</p>
        <p>sh404SEF works well with Joomfish, and a Virtuemart plugin comes along, that seems also to work well. If you use Joomfish, please take a look at the bottom of this document for a fix to allow translation of content element Alias. If you use Virtuemart, please read the special note at the end of this document, where you will find a couple of fixes for Virtuemart 1.0.10 : one to work with Joomfish (comes from the Virtuemart forum), the other to allow smooth operation when using SSL mode (comes from <a href="http://www.netshinesoftware.com">NetshineSoftware</a>).</p>
        <p>It now has a caching system, to reduce database queries and enhance page loading time when using URL rewriting.</p>
        <p> As before, you can also setup your own, custom URLs if you don't like those automatically built.</p>
        <p>When you are done with your URLs, you should also check <span class=h5>shCustomTags</span>. This is a module that will rewrite Title, Description, Keywords and Robots meta tags to your liking, on any page of your site. It has a plugin system to accomodate any component, and a Virtuemart plugin is also included to automatically generate these tags. Plus, you'll be able to manually set any tags you like on a page by page basis (a page is identified by its URL). Plus you'll be able to set text replacement operations not only on content, but on any module output as well.</p>
        <p>There is no hack of Joomla, just a module. You need to download from <a href="http://joomlacode.org/gf/project/shcustomtags/frs/">Joomlacode.org</a> and install separately. </p>
        <p>Both sh404SEF and shCustomTags have been tested only using Joomla 1.012 and VirtueMart 1.0.10 (should work with previous version of Joomla - don't know about previous versions of VirtueMart).</p>
        <p>Many thanks to all previous contributors to 404SEF, 404SEFx and Artio 404SEF 1.2.4. A big thank you also to the guys at <a href="http://wiki.4theweb.nl/w/JoomlaLib">who makes the Joomlalib library, and its so useful logging component</a>!</p>
 <h2>Documentation</h2>
 
 <p><h4>IMPORTANT</h4> <span class=h5>BEFORE</span> making any attempt to activate this component and use its URL rewriting functions, <span class=h5>your Joomla installation should already be compatible with URL rewriting</span>.<br />Remember : if you are having difficulties with this, it is unlikely to be a joomla problem, but most likely something related to your server setup. For instance, many times, you will be faced with 404 errors or Internal server errors 500 display. This indicates that there is something in your .htacces file that is not compatible with your apache server setup.<br />
If you face this kind of errors, I will suggest you contact your hosting company for assistance.  
If your .htaccess is not compatible with your apache server, or hosting company, there is no point in trying to use sh404SEF - or any other similar component like ARTIO Joomsef, OpenSEF or Advanced SEF - as they will simply not work. You will have first to fix your installation, paying particular attention to the existence and the content of your .htaccess file. However, one of the first thing to control : verify that mod_rewrite is loaded by PHP. To do this, in Joomla backend, go to System menu, then System information. On the PHP tab, just run a search for the word 'rewrite'. If you don't find anything, then mod_rewrite is not loaded and nothing will work. You need to change your Apache web server httpd.conf file, or contact your system administrator or shared host company to do this for you.</p>

<p>More advice on .htaccess, a very tricky issue on many occasions :</p>
<ul>
<li>Joomla standard .htaccess is very <span class=h5>FINE</span>. It will work with most hosting companies. You should use it unmodified, at least to start with. Just remember it comes named as htaccess.txt, so you need to <span class=h5>rename</span> it to .htaccess before anything.</li>
<li>Joomla standard .htaccess comes configured for Joomla standard SEF system (which makes sense!). To use it with sh404SEF (or OpenSEF, Artio JoomSEF, SEF Advance), you must open it up in an editor, and make the few changes explained in it:<br />
If you scroll down towards the end of the file, you'll see two sections, one marked <span class=h5>Begin - Joomla! core SEF Section</span>, and just next to it another marked : <span class=h5>########## Begin - 3rd Party SEF Section</span><br />
Now the tricky part : you should type # at the beginning of each line of the first section, and remove those # in front of those in the second section, so that the whole things looks like :<br />
<i>########## Begin - Joomla! core SEF Section<br />
############# Use this section if using ONLY Joomla! core SEF<br />
## ALL (RewriteCond) lines in this section are only required if you actually<br />
## have directories named 'content' or 'component' on your server<br />
## If you do not have directories with these names, comment them out.<br />
#<br />
#RewriteCond %{REQUEST_FILENAME} !-f<br />
#RewriteCond %{REQUEST_FILENAME} !-d<br />
#RewriteCond %{REQUEST_URI} ^(/component/option,com) [NC,OR] 		##optional - see notes##<br />
#RewriteCond %{REQUEST_URI} (/|\.htm|\.php|\.html|/[^.]*)$  [NC]<br />
#RewriteRule ^(content/|component/) index.php<br />
#<br />
########## End - Joomla! core SEF Section<br />
<br />
<br />

########## Begin - 3rd Party SEF Section<br />
############# Use this section if you are using a 3rd party (Non Joomla! core) SEF extension - e.g. OpenSEF, 404_SEF, 404SEFx, SEF Advance, etc<br />
#<br />
RewriteCond %{REQUEST_URI} ^(/component/option,com) [NC,OR] 		##optional - see notes##<br />
RewriteCond %{REQUEST_URI} (/|\.htm|\.php|\.html|/[^.]*)$  [NC]<br />
RewriteCond %{REQUEST_FILENAME} !-f<br />
RewriteCond %{REQUEST_FILENAME} !-d<br />
RewriteRule (.*) index.php<br />
#<br />
########## End - 3rd Party SEF Section</i><br />
<br />
Note : this is from the .htaccess that comes with Joomla 1.0.12. If you are using a more recent version of Joomla, in the 1.0.x series, use the latest version of the file instead of this one.<br />
<br />
</li>
<li>If you get 404 errors or Internal error 500, or similar, when clicking on a rewritten URL, then you should try adding another # at the beginning of this line (near the top of the file): <br />
Options FollowSymLinks <br />
so that it looks like: <br />
#Options FollowSymLinks <br />
</li>
<li>If that does not work, and if your Joomla site is in a sub-directory, you should look for the line that looks like: <br />
#RewriteBase /<br />
and replace it with : 
RewriteBase /sub_directory_of_your_joomla_install<br />
</li>
<li>On some servers, even if your site is not in a sub-directory, you may want to try replacing<br />
#RewriteBase /<br />
by <br />
RewriteBase /<br />
</li>
<li>One little thing more : try changing only one thing at a time, and check the result before moving to next step</li>
</ul> 
    <ol style="list-style-type: upper-roman;">
        <li>
            <h3>Introduction</h3>
            <p>Here are the main information bits required to use sh404SEF. You can view this documentation again by selecting the 'sh404SEF Documentation' button from the sh404SEF Control Panel.</p>
            <p>Please note that I cannot support IIS installation in any way. sh404SEF may well work on such machines, but it is not tested at all.</p>
        </li>
        <li>
            <h3>Installation Instructions</h3>
            <p>You can view installation instructions below by clicking the appropriate
                arrow.</p>
            <ol style="list-style-type: decimal;" id="collapsibleList">
                <li>
                    <script type="text/javascript">
					document.writeln('<img id="imgInstall" src="components/com_sef/images/up.png" width="15" height="8" alt="Open list" onClick="toggle(\'imgInstall\',\'install\');">');
				</script>
                    <span class="h4">Installation</span><br />
                    <ul id="install" style="list-style: none;">
                        <li>
                            <ol>
                                <li>Upload the zip file to Joomla using
                                    the component installer in the usual way.</li>
                                <li>For apache, the .htaccess file that comes with Joomla is FINE!!<br />
                                There is just one line I would suggest you add to it: <br />
                                # Rule for duplicate content removal : www.domain.com vs domain.com<br />
RewriteCond %{HTTP_HOST} ^mydomain\.com [NC]<br />
RewriteRule (.*) http://www.mydomain.com/$1 [R=301,L,NC]<br />
What this will do is rewrite all page requests starting with mydomain.com to www.mydomain.com. This way, you will avoid some duplicate contents issues (even though that is not really a problem nowadays, at least with Google), and also improve the way many editors, including JCE, will behave.<br />
You should <span class=h5>replace mydomain\.com on the first line and www.mydomain.com by your own domain information of course</span>. <br />
Also, you should place these 3 lines just after the RewriteBase line in Joomla standard .htaccess file.<br />
Lastly, you can also do it the other way around, that is rewrite www.mydomain.com to mydomain.com. To do this, simply use :<br />
# Rule for duplicate content removal : domain.com vs wwwdomain.com<br />
RewriteCond %{HTTP_HOST} ^www.mydomain\.com [NC]<br />
RewriteRule (.*) http://mydomain.com/$1 [R=301,L,NC]<br />
<br />
                                </li>
                                <li>For IIS, see Configuring IIS..</li>
                                <li>Ensure that SEF is enabled under Global Configuration
                                    in the Joomla backend.</li>
                                <li> Edit the 404 SEF configuration, Change Enable
                                    to yes and save.<br />
                                    This is neccessary to ensure the default
                                    404 document gets saved to the Joomla
                                    database. </li>
                            </ol>
                        </li>
                    </ul>
                </li>
                <li>
                    <script type="text/javascript">document.writeln('<img id="imgIIS" src="components/com_sef/images/up.png" width="15" height="8" alt="Open list" onClick="toggle(\'imgIIS\',\'iis\');">');
				</script>
                    <span class="h4">Configuring IIS</span><br />
                    <ul id="iis" style="list-style: none">
                        <li>
                            <ol>
                                <li>
                                    <h4>Install ActiveScript</h4>
                                    After installing PHP, you should download
                                    the ActiveScript DLL (php4activescript.dll)
                                    and place it in the main PHP folder (e.g.
                                    C:\php).<br/>
                                    <br/>
                                    After having all the files needed, you must
                                    register the DLL on your system. To achieve
                                    this, open a Command Prompt window (located
                                    in the Start Menu). Then go to your PHP directory
                                    by typing something like cd C:\php. To register
                                    the DLL just type
                                    <pre>regsvr32 php4activescript.dll</pre>
                                </li>
                                <li>
                                    <h4>Install .NET framework 1.1</h4>
                                    To the best of my limited knowledge of IIS,
                                    this is required for web.config to work,
                                    so install it<br/>
                                    <br/>
                                </li>
                                <li>
                                    <h4>Create/Modify web.config</h4>
                                    <span style="color: red; font-weight: bold;">NOTE:
                                    in the example below, Joomla/Mambo is installed
                                    in the virtual directory 'joomla'.</span><br/>
                                    <br/>
                                    Create C:\Inetpub\wwwroot\web.config and
                                    add the content below:<br />
                                    <pre>&lt;?xml version=&quot;1.0&quot; encoding=&quot;utf-8&quot;?&gt;
        &lt;configuration&gt;
        	&lt;system.web&gt;
        		&lt;compilation defaultLanguage=&quot;PHP4Script&quot; debug=&quot;true&quot; /&gt;
        		&lt;customerrors mode=&quot;On&quot; defaultRedirect=&quot;/joomla/index.php&quot; /&gt;
        	&lt;/system.web&gt;
        &lt;/configuration&gt;</pre>
                                </li>
                                <li>
                                    <h4>Configure the Custom Errors</h4>
                                    <span style="color: red; font-weight: bold;">NOTE:
                                    in the example below, Joomla/Mambo is installed
                                    in the virtual directory Joomla</span>
                                    <pre>Using the Internet Services Manager, right-click the directory in which Joomla is installed.
							Select properties >> Custom Error
							set the 404 to URL:/mambo/index.php
							set the 405 to URL:/mambo/index.php</pre>
                                </li>
                            </ol>
                        </li>
                    </ul>
                </li>
                <li>
                    <script type="text/javascript">document.writeln('<img id="imgUninstall" src="components/com_sef/images/up.png" width="15" height="8" alt="Open list" onClick="toggle(\'imgUninstall\',\'uninstall\');">');
				</script>
                    <span class="h4">Uninstall</span><br />
                    <ul id="uninstall" style="list-style: none;">
                        <li>
                            <ol>
                                <li>Uninstall the component using the component
                                    unistaller in the usual way.</li>
                                </li>
                                <li>For IIS, remove C:\Inetpub\wwwroot\web.config
                                    and<br />
                                    the Custom Errors you created with the Internet
                                    Services Manager<br />
                                </li>
                            </ol>
                        </li>
                    </ul>
                </li>
            </ol>
        </li>
        <li>
            <h3>Useful Tips For Using sh404SEF</h3>
            <ul style="list-style: none;">
            <li>
            <h4>Configuration</h4>
            
            <p>Using sh404SEF configuration is fairly straightforward for most of it.
                For more information on each item hover your mouse over the blue
                (i) images when you are in the configuration screen.</p>
            <p>When you save the configuration it will remove all your URL's
                from the database. If you have a high traffic site it may be
                wise to put it offline before saving sh404SEF config
                or purging the database. <span class=h5>After doing that, you should use an
                online tool to build automatically a sitemap</span>. The side effect
                of doing this is that this software will go through all of 
                your site, and therefore all of your links, so they will be
                all automatically placed in the cache, thus speeding access for your next visitors.<br>
                The caching system of sh404SEF is transparent,and will be rebuild automatically whenever
                required. Using the cache will
                vastly speed up the page load time, by dramatically reducing 
                the number of database queries. Beware that URL caching uses 
                up a lot of memory though. Its size can be limited using the appropriate parameter, and it can also be turned off completely.
                <span class=h5>I estimate that 10 000 URLs eats up around 2 Mb, but that is per visitor to your site.</span></p>
                <p>Well, 10 000 URLs, that's already a sizable site!</p>
                <p></p>
                <p>If you have a multi-lingual site, you can turn on or off URL translation. Normally, URL elements will be translated into the user language. However, it sometimes better not to translate, such as when using non-latin characters based languages. On such occasions, default site language will always be used/p>
                <p></p>
                
            <p>You may want to purge the 404 log before creating fresh urls.</p>
            </li>
            <li>
            <h4>Modifying URL's</h4>
            <p>You can modify URL's to your liking. Go into sh404SEF
                Control Panel and click ' View/Edit SEF Urls'. Select the URL
                you wish to modify. If you click the check box labeled 'Save
                as Custom Redirect' it will place this URL into the 'Custom Redirect'
                area which you can navigate to from the sh404SEF Control
                Panel. When you click 'View/Edit Custom Redirects' you will see
                your URL in here now instead. These urls will not be removed
                when you save the config. You can modify these and save them
                as you wish.
            <p>This is particularly useful if you are updating from an old site
                because any URL's that are no longer availble will be logged.
                You can view these URL's by clicking 'View/Edit 404 Logs' in
                the sh404SEF Control Panel. You can redirect visitors to
                the new page by selecting the URL you wish to modify and entering
                the new url.</p>
            </li>
            <li>
            <h4>Backing up your URL's</h4>
            <p>It is recommended to backup your database before doing this.</p>
            <p>You can also import and export URL's from the Custom Redirect
                area. To do this click the 'Import/Export Custom URLS' link above
                the table of URL's. To backup your URL's click the 'Backup Custom
                URLS' button and you will be presented with a file named 'sh404SEF_custom_urls.sql' to download.</p>
            <p>If you want to import your urls browse to the file and click the
                'Import Custom URLS' button.</p>
                </ul>
            </li>
        </li>
    </ol>       
        
    <h2>Changelog</h2>
	<p>
	<h4>v1.2.4.q - beta</h4>
	  <p> <span class="small">1st june 2007</span>
		<ul> 
		  <li>Added a tabbed interface in the backend, for better user interface</li>
		  <li>Reworked backend navigation to be more user friendly</li>
      <li>Added a search field in URL display pages, useful when many URL (Dan's idea)</li>
      <li>Added display of number of SEF, 404 and custom URl in backedn control panel</li>
      <li>Added parameter to force url to stay non sef when site switches to SSL (https). Should allow working with most shared SSL servers</li>
		  <li>Added automatic transfer of configuration file when upgrading from prev. version (Custom URLs still must be backed up and reimported manually, using the import/export button on control panel</li>
		  <li>Added prompt to let user decide if URL cache should be erased when saving configuration file. Normally cache should be erased and rebuilt, but if only minor parameters have been changed, it can be left untouched</li>
		  <li>NEW: Russian translation by Dmitry Afanaciev</li>
		  <li>Updated and completed German translation by Sven Hurt</li>
		  <li>Updated and completed Italian translation by Roberto Cacciapuoti</li>
		  <li>Updated and completed Hungarian translation by Jozsef Tamas Herczeg</li>
		  <li>Improved export function : now Import/export button on custom URL page will only export custom URL, whereas Import/export button on main control panel will export all URLs, custom and automatic</li>
		  <li>Added : optional url encoding, switched on/off in backend</li>
		  <li>Fixed and improved : search results on homepage and with multiple pages results are now fine. Before, homepage was not amlways detected, and Itemid was not always best choice. Also, url are now translated as they should (but displayed text is not, as this is a limitation of Joomla com_search</li>
		  <li>Improved : handling of multipages display (blog of cat., blogof section) when shown on frontpage. Working both with com_frontpage or simple link to a blog cat or blog section</li>
		  <li>Fixed : sometimes trailing / was missing on homepage</li>
		  <li>Changed : config file is now located in a sub-dir of its own, easier to manage for me</li>
		  <li>Fixed : task=section, task=category, task=blogsection, task=blogcategory are now working</li>
		  <li>Fixed : url produced by SEF Advanced sef_ext files were not cleaned as per sh404SEF backend params. Still not working for OpenSEF sef_ext (and won't work)</li>
		  <li>Fixed bug in plugins com_search and com_letterman : $sh_LANG was not declared as global</li>
		  <li>Fixed bug preventing home page recognition when first mainmenu item did not have ordering=1</li>
		  <li>Fixed uninitialised variables, that were causing Notices errors. Many bug fixes!</li>
		  <li>Fixed : sometimes automatic URL could be recorded as custom (if accessed just after clearing the URL cache</li>
		</ul>
		<h4>v1.2.4.p - beta</h4>
	  <p> <span class="small">26 May 2007</span>
		<ul>
		  <li>Changes to be able to use sef_ext files from OpenSef or SEF Advanced. Used only for the first encoding of an URL into SEF. Decoding is still done by sh404SEF mechanism, and additional encodings rely on sh404SEF in ram and in DB caching, so should be faster than when used with OpenSEF or SEF Advanced. Done some tests with Sobi2, Bookmarks, alphacontent and iJoomla Magazine. Search fonction of Sobi 2 does not work, but seems like a problem in sef_ext. Need to talk to author.</li>
		  <li>Adde parameter to control if component own sef_ext file should be overriden by sh404SEF plugin (if any exists), or used instead to encode URL. Done on a component by component basis.</li>
		  <li>Updated Spanish translation, thanks to follonman</li>
		  <li>Updated German translation, thanks to Sven Hurt</li>
		  <li>Updated Hungarian translation, thanks to Jozsef Tamas Herczeg</li>
		  <li>URL translation and insertion of language ISO code is now done on a component by component basis. Before, there was a global switch.</li>
      <li>Removed automatic install of shCustomTags module. Becomes a completely separate solution, before a better integration is designed and done</li>
      <li>Added a com_wrapper plugin, to allow proper operation if Insert Itemid in Url param is set to Off</li>
      <li>Added a com_letterman plugin, handling basic operations</li>
      <li>Added a Fireboard plugin</li>
		  <li>Added parameter for Virtuemart plugin to include flypage id in URL or not</li>
		  <li>Added parameter to decide whether to 301 redirect <b>Joomla</b> SEF URL to their sh404SEF equivalent</li>
		  <li>Changed behavior of Redirect <b>non-sef</b> to sef function : it is now disabled when using Joomfish, because at the time this redirect happens, Joomfish is not initialized, and thus cannot translate anything. Still working though if language is default language</li>
		  <li>Added parameter : insert language code in URL, except for default language. Before was always on. Code is still added on homepage, as we would otherwise be unable to switch language</li>
		  <li>Added parameter in CB plugin : insert user pseudo instead of user name in URL</li>
		  <li>Fixed bug in content URL, when Insert category in URL was off, reported by vent40</li>
		  <li>Fixed bug in com_login handling, could not login through component</li>
		  <li>Fixed bug in anchor processing, including on homepage</li>
		  <li>Fixed bug in Community Builder plugin : would not display multiple list when selected from drop-down list</li>
		  <li>Fixed bug in Virtuemart plugin, vmcchk parameter was still showing in URL (did not harm, just showing)</li>
		  <li>Fixed bug in Virtuemart plugin : categories were not always properly translated when using Sort by feature (static $tree must be indexed on $mosConfig_lang)</li>
		  <li>Fixed bug in Virtuemart plugin : better processing of manufacturer_id and category_id variables, reduce queries count</li>
		  <li>Fixed bug in Virtuemart plugin : was loosing language information when applying a sort to product page. Fixed by changing 301 redirect behavior as stated above. Joomfish issue, no possible solution</li>
		  <li>Fixed bug in Virtuemart plugin : name of manufacturer was not always inserted as requested</li>
		  <li>Fixed bug in all plugins (except legacy plugins) : did not always comply to TranslateURL parameter</li>
		  <li>Fixed bug in Search plugin : was not properly passing limit and limitstart param</li>
		  <li>Changed class name from SEF_config to SEFConfig for Joomlatwork SEF patch extended compatibility</li>
		  <li>Fixed bug in content plugin : success message when voting on item was not showing</li>
		  <li>Fixed buf in registration plugin when auto-redirecting from non-sef to sef : was breaking email account activation</li>
		  <li>Fixed bug : Numerical id was not inserted if All categories was selected. Needed to select each category individually</li>
		  <li>Fixed bug in shCache.php : missing '' around function name was causing notice display</li>
		  <li>Fixed bug in shCache.php : undeclared global was causing to reload cache several times from disk</>
		  <li>Fixed bug : non-sef to sef 301 redirect would not work if spaces in URL</li>
		  <li>Changed plugins language files organization, grouped them all in one directory, for easier translation</li>
		  
		</ul></p>
	<h4>v1.2.4.l - beta</h4>
	  <p> <span class="small">30 April 2007</span>
		<ul>
		  <li>Started support site at <a href="http://extensions.Siliana.com">extensions.Siliana.com</a> (French/English)</li>
		  <li>Added 301 automatic redirect from standard Joomla URL to their SEF equivalent. So if you are using standard SEF on your site today, you can switch to pretty URl now, while requests for your past URL will be automatically redirected to new URL, and Google should like it.</li>
		  <li>Modified import/export function : now there is an import/export button on the main control panel. Using it, you will be able to export ALL urls (automatic, custom, 404) to a CSV file, so that you can easily get them in a text editor or in Excel</li>
		  <li>Updated standard SEF decode function to current</li>
		  <li>Added rd_rss plugin</li>
		  <li>Fixed bug in URL translation mechanism - bug identified and fix supplied by alataka</li>
		</ul></p>
	<h4>v1.2.4.k - beta</h4>
	  <p> <span class="small">25 April 2007</span>
		<ul>
		  <li>Added Community Builder plugin : basic functions covered : userprofile, userdetails, useravatar, lists, login, lostpassword, register, sendemail, about</li>
		  <li>Added alpha version of iJoomla magazine plugin - untested</li>
		  <li>Fixed bug where frontpage was not handled properly if com_frontpage was not in first position in menu</li>
		  <li>Bug fix in automatic 301 redirect </li>
		  <li>Added parameter to enable/disable 404 errors logging (before, was always on)</li>
		  <li>Joomla/Virtuemart : added info about Joomla hack to make SSL switch work properly. Info found at <a href="http://www.netshinesoftware.com">www.netshinesoftware.com</a></li>
		  <li>Virtuemart plugin : added processing of shop.registration URLs</li>
		  <li>Virtuemart plugin : added parameter to make additional text when browsing categories optional</li>
		  <li>Changed readme.inc to show sessionCookieName function hack </li>
		</ul></p>
	 <h4>v1.2.4.j - beta</h4>
	  <p> <span class="small">21 April 2007</span>
		<ul>
		  <li>Added parameter : secure live site : used to configure $mosConfig_live_site when switching to SSL. Will override Joomla 1.0.12 own fix in index.php, which does not work with Shared SSL, and is slightly better than Soeren fix found on VM forum, which does not work when Joomla is installed in a sub-directory </li>
		  <li>Added feature : automatic 301 redirect for non-sef url. Non-sef url will now be 301-redirected to their sef counterpart if it exists in the DB. If sef counterpart does not exists, it will be created on the fly (except if there are some POST variables, in which case it is safer to do nothing), then redirection will take place.</li>
		  <li>Fixed security flaw</li>
      <li>Removed SSL switch management : useless and too complicated</li>
      <li>Fixed bug in Virtuemart plugin : sharedSSL</li>
      <li>Added possible insert of unique numerical Id in sef URL of content elements (Google news style)</li>
      <li>Changed behavior in function titleToLocation() : single quotes are now replaced by replacement character instead of being removed, as this would otherwise make some words loose meaning in some languages</li>
      <li>Added a com_registration plugin to have nicer URL for lostPassword and Register functions</li>
      <li>Fixed bug in URL cache system : was never called</li>
      <li>Changed default state of lower case switch to false : may break things in Virtuemart, and probably other components</li>
      <li>Changed readme.inc (this file) to reflect needed bug fixes in Virtuemart,as per forum posts</li>
		</ul></p>
	  <h4>v1.2.4h - beta</h4>
	  <p> <span class="small">8 April 2007</span>
		<ul>
		  <li>Fixed bug in shCache() : would not work if Joomfish was not installed</li>
      <li>Fixed old bug in sefGetLocation() : prevented sef URL longer than around 100 char - length of domain name</li>
		  <li>Added hungarian translation by Jozsef Tamas Herczeg</li>
		  <li>Fixed bug in install file (sef.xml). oldurl and newurl were mixed up when I increased size at last release. oldurl is sef url, whereas newurl is non-Sef url!</li>
		</ul></p>
		  <h4>v1.2.4g - beta</h4>
	  <p> <span class="small">7 April 2007</span>
		<ul>
		  <li>Fixed bug in Virtuemart plugin : product name or sku was not inserted in AddToCart URL</li>
		  <li>Fixed bug in Virtuemart plugin : would always use french text string on some items</li>
		  <li>Fixed bug in com_Content plugin : was using global itemid to find menu title instead of own URL Itemid</li>
      <li>Fixed bug in shJoomfish module : only ul-images (flags) option was processed. Now all languages display options are processed</li>
      <li>Added a plugin for com_contact : will display name of contact in url</li>
      <li>Added processing of download url in Virtuemart plugin</li>
      <li>Changed max length in DB of non-sef URL to 150 char. and sef-url to 255 char.</li>
      <li>Added in Virtuemart plugin : support for 'more images' links processing, even though Vm does not call sefRelTOAbs() on these!</li>
		</ul></p>
	  <h4>v1.2.4f - beta</h4>
	  <p> <span class="small">3rd April 2007</span>
		<ul>
		  <li>Added possibility to use product SKU instead of product name in URL. Switched on/off through backend parameter. </li>
		  <li>Integrated shJoomfish module. Before was a separate download and install. Now this module is installed automatically when sh404SEF installs. You have to display your site modules list and publish it. if you are already using the standard Joomfish language selection module, you should unpublish it. As a reminder, the standard Joomfish module does not handle properly switching back to default language when using SEF url.</li>
		  <li>Itemid management : added another backend parameter to force addition of Itemid to SEF URL. There was already a parameter to force addition of menu name. But it is possible to have on the same site two menu items with same name, linking to same content, but with different Itemid (like one in main menu and one in top menu for instance). Default is off. Itemid is appended to URL, as in ..../menu-id-234.html</li>
		  <li>Added a backend parameter : replacement character list : a table to allow custom character replacements in URL, for instance for accented or non-latin characters. Before was hard-coded </li>
		  <li>Fixed bug in Virtuemart plugin : parameter flypage was not passed in product_details page. Added language strings for existing flypages format : flypage, flypage_lite_pdf, flypage_new, garden_flypage</li>
		  <li>Fixed bug in Virtuemart plugin : parameter root was not passed in account.billing page</li>
		  <li>Fixed bug in Virtuemart plugin : parameter next_page was not passed in account.billing page</li>
		  <li>Small changes in Virtuemart plugin just in case no name would be entered for a product, a category or a manufacturer : then name is replaced by product-($product_id), category-($category_id) or manufacturer-($manufacturer_id)</li>
      <li>Updated language files for new parameters </li>
		</ul></p>
	  <h4>v1.2.4e - beta</h4>
	  <p> <span class="small">6 April 2007</span>
		<ul>
		  <li>All parameters are now set through the backend, removed configuration files. </li>
		  <li>Updated translations : English : component+doc, French: component, Spanish, Italian, German : partial component</li>
		  <li>changes to standard com_content plugin to improve Itemid handling (at least for regular content). Added 4 parameters to control the way URLs are built: <br />
      <span class=h5>shInsertGlobalItemidIfNone</span> = true;  will add Itemid of current menu item to non-sef string if none
                                       already exists. This matches J! 1.0.12 behavior, ie : contents gets
                                       itemid of current menu item (getting Itemid means that modules 
                                       associated with this menu item will show when content is displayed).<br />
  <span class=h5>shInsertTitleIfNoItemid</span> = true;     will add title of current menu item (or alias) to sef-string if
                                       there is no Itemid in the non-sef string  <br />                                       
  <span class=h5>shAlwaysInsertMenuTitle</span> = false;     will always insert current menu item title (or alias) in the sef-url
                                       Menu item title will be first in URL, just after domain name<br />                       
  <span class=h5>shDefaultMenuItemName</span> = '';          if non-empty, this text will be used instead of the current menu 
                                        item title to be inserted in the non-sef string (when
                                        either $shInsertTitleIfNoItemid or $shAlwaysInsertMenuTitle is true)<br /> 
      <br />
      </li>
      <li>added sorting of non-sef URL parameters, to avoid having them twice in cache when parameters are not sent in the same order ie: <br />index.php?option=com_virtuemart&category_id=3&Itemid=2&lang=fr<br />
            Vs index.php?category_id=3&option=com_virtuemart&Itemid=2&lang=fr</li> 
      <li>added backend global parameter to allow URL translation. If set to true, all URLs elements will be translated, if a translation is available (this is default behavior). If set to false, URL elements will be using the site default language</li>
      <li>small changes in language file of VM plugin </li>
		 </ul></p>
	 <h4>v1.2.4d - beta</h4>
	  <p> <span class="small">1st April 2007</span>
		<ul>
		  <li>bug fix in VM plugin for cart display (product_id parameter was not passed) </li>
		  <li>added a couple of language strings in language file of VM plugin </li>
      <li>VM plugin : added ability to prepend id category, manufacturer or product when used in URL, in case their names are not unique. Added parameters in VM plugin config file to turn on or off. Default is now on for all 3, so URLS will look like :<br />
      mysite.com/little-shop/3-category-three-name/6-product-six-name.html </li> 
      <li>added backend parameter to enable/disable cache, and set its maximum size </li>
		 </ul></p>
		  <h4>v1.2.4c - beta</h4>
	  <p> <span class="small">30 march 2007</span>
		<ul>
		  <li>added config file to virtuemart plugin, to control the way URLs are built </li>
		  <li>bug fix in VM plugin for SSL switch (cartReset parameter was not passed) </li>
		  <li>added a cache size control. Look for $maxURLInCache variable in file /components/com_sef/shCache.php<br />Default value is 10000, and is a number of URL, not kilo or mega bytes. Each URL couple (sef+nonSef)should account for around 200 bytes on average. May vary with how long your titles are. So 10000 urls is around 2 Mb of RAM. </li>
		 </ul></p> 
	  <h4>v1.2.4b - beta</h4>
	  <p> <span class="small">29 march 2007</span>
		<ul>
		  <li>added URL caching </li>
		  <li>fix for multipages content items handling </li>
		  <li>fix for table-category and table-section pages, with variable number of elements per page, as per user selection in front-end</li> 
		</p> </ul> 
		<h4>v1.2.4a</h4>  
		<p> <span class="small">21st september 2006</span><ul/
			<li>Improved Joomfish handling. URLS are now xx/sec/cat/title.html where xx is ISO language code. sec, cat and title.html are translated to appropriatre language (if title has been translated. Works also with alias, however requires that alias are translated in Joomfish, which is not the case with default contentelements file<br />
      To fix this, locate and open administrator/components/com_joomfish/contentelements/content.xml<br />
      Find the line that looks like :<br />
      &lt;field type=&quot;text&quot; name=&quot;title_alias&quot; translate=&quot;0&quot;&gt;Title Alias&lt;/field&gt;<br />
      and change it to <br />
      &lt;field type=&quot;text&quot; name=&quot;title_alias&quot; translate=&quot;<span class=h5>1</span>&quot;&gt;Title Alias&lt;/field&gt;<br />
      </li>
			<li>Default language URLs are left untouched</li>
			<li>Homepage handling : www.mydomain.tld, www.mydomain.tld/xx, where xx is ISO language code. Both in menus and pathway (and Joomfish language selection)</li>
			<li>Bug fix in inclusion of component-specific sef_ext file</li>
			<li>Requires a modified Joomfish language selection module to work properly (supplied separately)</li>
			<li>added French translation file</>
		</ul>
		</p>
		<h4>v1.2.4</h4>
		<p> <span class="small">31st August 2006</span>
		<ul>
			<li>Documentation update.</li>
			<li>Prevented loadClass error problem with older Joomla! versions.</li>
		</ul>
		</p>
		<h4>v1.2.3</h4>
		<p> <span class="small">29th August 2006</span>
		<ul>
			<li>Compatibility fix with URLs using numeric entities (e.g. generated
				by JCE WYSIWG editor).</li>
		</ul>
		</p>
		<h4>v1.2.2</h4>
		<p> <span class="small">28th August 2006</span>
		<ul>
			<li>Security fixes to match Joomla 1.0.11 requirements and minor bugs
				coorections.</li>
		</ul>
		</p>
		<h4>v1.2b</h4>
		<p> <span class="small">15th August 2006</span>
		<ul>
			<li>Fixed pagination problems.</li>
			<li>Integrated JoomFish and DocMan support.</li>
			<li>Ported from 404SEFx.</li>
		</ul>
		</p>
	</p>
	
	<h2>Joomfish</h2>
	<p>Special note for Joomfish users : it is usually more handy to use content elements Alias in URL, instead of Title. However, Aliase are not translated by Joomfish, as per default settings. <br />To have alias translated as well :</p
<br />
      Locate and open administrator/components/com_joomfish/contentelements/content.xml<br />
      Find the line that looks like :<br />
      &lt;field type=&quot;text&quot; name=&quot;title_alias&quot; translate=&quot;0&quot;&gt;Title Alias&lt;/field&gt;<br />
      and change it to <br />
      &lt;field type=&quot;text&quot; name=&quot;title_alias&quot; translate=&quot;<span class=h5>1</span>&quot;&gt;Title Alias&lt;/field&gt;<br />
	
	<h2>Virtuemart</h2>
	<p>Special note for Virtuemart users: This component has only been tested with Virtuemart 1.0.10 (as of date of this release : april 21st, 2007.</p>
<h4>There is a bug in VM 1.0.10 with respect to Joomfish</h4><span class=h5>see topic #26943 on VirtueMart forum</span>.
	<p><span class=h5>File : /components/com_virtuemart/virtuemart_parser.php</span></p>
  
  <span class=h5>line 40</span>: insert code, so that result is as follow :<br /><br />
  $option = mosGetParam( $_REQUEST, 'option' );<br />
<br />
// shumisha fix for Joomfish, as per post on forum topic = 26943.0<br />
global $mosConfig_lang;<br />
$jFishLang = $mosConfig_lang;<br />
// end of fix<br />
<br />
if( !defined( '_VM_PARSER_LOADED' )) {<br />
<br />
  <span class=h5>line 60</span> : insert code, so that result is as follow :<br /><br />
  // the configuration file for the Shop<br />
	require_once( $mosConfig_absolute_path. "/administrator/components/com_virtuemart/virtuemart.cfg.php" );<br />

  // fix for Joomfish, as per post on forum topic = 26943.0<br />
  $mosConfig_lang = $jFishLang;<br />
  // end of fix<br />
	// The abstract language class<br />
	require_once( CLASSPATH."language.class.php" );	<br /><br />

<h4>Joomla hack to allow SSL operation with Virtuemart (and others as well)</h4>
<br />
    Find and open file : /includes/joomla.php<br />
    Locate the text : function sessionCookieName(). Replace the next lines to make it as follows:<br />
   <br /> 
	function sessionCookieName() {<br />
		global $mainframe;<br />
<br />
		//return md5( 'site' . $mainframe->getCfg( 'live_site' ) );<br />
		// shumisha : found at http://www.netshinesoftware.com/security/using-an-ssl-certificate-with-your-joomla-website.html<br />
		return md5( 'site' . str_replace('http://', '', str_replace('https://', '', $mainframe->getCfg( 'live_site' ))) );<br />
	}<br />
<br />
<br />
    
    <script type="text/javascript">
		document.getElementById('collapsibleList').style.listStyle="none"; // remove list markers
		document.getElementById('install').style.display="none"; // collapse list
		document.getElementById('iis').style.display="none"; // collapse list
		document.getElementById('uninstall').style.display="none"; // collapse list
		// this function toggles the status of a list
		function toggle(image,list){
			var listElementStyle=document.getElementById(list).style;
			if (listElementStyle.display=="none"){
				listElementStyle.display="block"; document.getElementById(image).src="components/com_sef/images/down.png";
				document.getElementById(image).alt="Close list";
			}
			else{
				listElementStyle.display="none";
				document.getElementById(image).src="components/com_sef/images/up.png";
				document.getElementById(image).alt="Open list";
			}
		}
	</script>
    <div class="small" style="text-align: center;">
        Copyright &copy; 2004-2007 Yannick Gaultier, ARTIO s.r.o., W.H.Welch<br />
        Distributed under the terms of the GNU General Public License.
    </div>
</div>
