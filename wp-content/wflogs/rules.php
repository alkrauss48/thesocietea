<?php
if (!defined('WFWAF_VERSION')) {
	exit('Access denied');
}
/*
	This file is generated automatically. Any changes made will be lost.
*/

$this->failScores['sqli'] = 100;
$this->failScores['xss'] = 100;
$this->failScores['rce'] = 100;

$this->variables['sqliRegex'] = new wfWAFRuleVariable($this, 'sqliRegex', '/(?:[^\\w<]|\\/\\*\\![0-9]*|^)(?:
@@HOSTNAME|
ALTER|ANALYZE|ASENSITIVE|
BEFORE|BENCHMARK|BETWEEN|BIGINT|BINARY|BLOB|
CALL|CASE|CHANGE|CHAR|CHARACTER|CHAR_LENGTH|COLLATE|COLUMN|CONCAT|CONDITION|CONSTRAINT|CONTINUE|CONVERT|CREATE|CROSS|CURRENT_DATE|CURRENT_TIME|CURRENT_TIMESTAMP|CURRENT_USER|CURSOR|
DATABASE|DATABASES|DAY_HOUR|DAY_MICROSECOND|DAY_MINUTE|DAY_SECOND|DECIMAL|DECLARE|DEFAULT|DELAYED|DELETE|DESCRIBE|DETERMINISTIC|DISTINCT|DISTINCTROW|DOUBLE|DROP|DUAL|DUMPFILE|
EACH|ELSE|ELSEIF|ELT|ENCLOSED|ESCAPED|EXISTS|EXIT|EXPLAIN|EXTRACTVALUE|
FETCH|FLOAT|FLOAT4|FLOAT8|FORCE|FOREIGN|FROM|FULLTEXT|
GRANT|GROUP|HAVING|HEX|HIGH_PRIORITY|HOUR_MICROSECOND|HOUR_MINUTE|HOUR_SECOND|
IFNULL|IGNORE|INDEX|INFILE|INNER|INOUT|INSENSITIVE|INSERT|INTERVAL|ISNULL|ITERATE|
JOIN|KILL|LEADING|LEAVE|LIMIT|LINEAR|LINES|LOAD|LOAD_FILE|LOCALTIME|LOCALTIMESTAMP|LOCK|LONG|LONGBLOB|LONGTEXT|LOOP|LOW_PRIORITY|
MASTER_SSL_VERIFY_SERVER_CERT|MATCH|MAXVALUE|MEDIUMBLOB|MEDIUMINT|MEDIUMTEXT|MID|MIDDLEINT|MINUTE_MICROSECOND|MINUTE_SECOND|MODIFIES|
NATURAL|NO_WRITE_TO_BINLOG|NULL|NUMERIC|OPTION|ORD|ORDER|OUTER|OUTFILE|
PRECISION|PRIMARY|PRIVILEGES|PROCEDURE|PROCESSLIST|PURGE|
RANGE|READ_WRITE|REGEXP|RELEASE|REPEAT|REQUIRE|RESIGNAL|RESTRICT|RETURN|REVOKE|RLIKE|ROLLBACK|
SCHEMA|SCHEMAS|SECOND_MICROSECOND|SELECT|SENSITIVE|SEPARATOR|SHOW|SIGNAL|SLEEP|SMALLINT|SPATIAL|SPECIFIC|SQLEXCEPTION|SQLSTATE|SQLWARNING|SQL_BIG_RESULT|SQL_CALC_FOUND_ROWS|SQL_SMALL_RESULT|STARTING|STRAIGHT_JOIN|SUBSTR|
TABLE|TERMINATED|TINYBLOB|TINYINT|TINYTEXT|TRAILING|TRANSACTION|TRIGGER|
UNDO|UNHEX|UNION|UNLOCK|UNSIGNED|UPDATE|UPDATEXML|USAGE|USING|UTC_DATE|UTC_TIME|UTC_TIMESTAMP|
VALUES|VARBINARY|VARCHAR|VARCHARACTER|VARYING|WHEN|WHERE|WHILE|WRITE|YEAR_MONTH|ZEROFILL)(?=[^\\w]|$)/ix');
$this->variables['xssRegex'] = new wfWAFRuleVariable($this, 'xssRegex', '/(?:
#tags
(?:\\<|\\+ADw\\-|\\xC2\\xBC)(script|iframe|svg|object|embed|applet|link|style|meta|\\/\\/|\\?xml\\-stylesheet)(?:[^\\w]|\\xC2\\xBE)|
#protocols
(?:^|[^\\w])(?:(?:\\s*(?:&\\#(?:x0*6a|0*106)|j)\\s*(?:&\\#(?:x0*61|0*97)|a)\\s*(?:&\\#(?:x0*76|0*118)|v)\\s*(?:&\\#(?:x0*61|0*97)|a)|\\s*(?:&\\#(?:x0*76|0*118)|v)\\s*(?:&\\#(?:x0*62|0*98)|b)|\\s*(?:&\\#(?:x0*65|0*101)|e)\\s*(?:&\\#(?:x0*63|0*99)|c)\\s*(?:&\\#(?:x0*6d|0*109)|m)\\s*(?:&\\#(?:x0*61|0*97)|a)|\\s*(?:&\\#(?:x0*6c|0*108)|l)\\s*(?:&\\#(?:x0*69|0*105)|i)\\s*(?:&\\#(?:x0*76|0*118)|v)\\s*(?:&\\#(?:x0*65|0*101)|e))\\s*(?:&\\#(?:x0*73|0*115)|s)\\s*(?:&\\#(?:x0*63|0*99)|c)\\s*(?:&\\#(?:x0*72|0*114)|r)\\s*(?:&\\#(?:x0*69|0*105)|i)\\s*(?:&\\#(?:x0*70|0*112)|p)\\s*(?:&\\#(?:x0*74|0*116)|t)|\\s*(?:&\\#(?:x0*6d|0*109)|m)\\s*(?:&\\#(?:x0*68|0*104)|h)\\s*(?:&\\#(?:x0*74|0*116)|t)\\s*(?:&\\#(?:x0*6d|0*109)|m)\\s*(?:&\\#(?:x0*6c|0*108)|l)|\\s*(?:&\\#(?:x0*6d|0*109)|m)\\s*(?:&\\#(?:x0*6f|0*111)|o)\\s*(?:&\\#(?:x0*63|0*99)|c)\\s*(?:&\\#(?:x0*68|0*104)|h)\\s*(?:&\\#(?:x0*61|0*97)|a)|\\s*(?:&\\#(?:x0*64|0*100)|d)\\s*(?:&\\#(?:x0*61|0*97)|a)\\s*(?:&\\#(?:x0*74|0*116)|t)\\s*(?:&\\#(?:x0*61|0*97)|a)(?!(?:&\\#(?:x0*3a|0*58)|\\:)(?:&\\#(?:x0*69|0*105)|i)(?:&\\#(?:x0*6d|0*109)|m)(?:&\\#(?:x0*61|0*97)|a)(?:&\\#(?:x0*67|0*103)|g)(?:&\\#(?:x0*65|0*101)|e)(?:&\\#(?:x0*2f|0*47)|\\/)(?:(?:&\\#(?:x0*70|0*112)|p)(?:&\\#(?:x0*6e|0*110)|n)(?:&\\#(?:x0*67|0*103)|g)|(?:&\\#(?:x0*62|0*98)|b)(?:&\\#(?:x0*6d|0*109)|m)(?:&\\#(?:x0*70|0*112)|p)|(?:&\\#(?:x0*67|0*103)|g)(?:&\\#(?:x0*69|0*105)|i)(?:&\\#(?:x0*66|0*102)|f)|(?:&\\#(?:x0*70|0*112)|p)?(?:&\\#(?:x0*6a|0*106)|j)(?:&\\#(?:x0*70|0*112)|p)(?:&\\#(?:x0*65|0*101)|e)(?:&\\#(?:x0*67|0*103)|g)|(?:&\\#(?:x0*74|0*116)|t)(?:&\\#(?:x0*69|0*105)|i)(?:&\\#(?:x0*66|0*102)|f)(?:&\\#(?:x0*66|0*102)|f)|(?:&\\#(?:x0*73|0*115)|s)(?:&\\#(?:x0*76|0*118)|v)(?:&\\#(?:x0*67|0*103)|g)(?:&\\#(?:x0*2b|0*43)|\\+)(?:&\\#(?:x0*78|0*120)|x)(?:&\\#(?:x0*6d|0*109)|m)(?:&\\#(?:x0*6c|0*108)|l))(?:(?:&\\#(?:x0*3b|0*59)|;)(?:&\\#(?:x0*63|0*99)|c)(?:&\\#(?:x0*68|0*104)|h)(?:&\\#(?:x0*61|0*97)|a)(?:&\\#(?:x0*72|0*114)|r)(?:&\\#(?:x0*73|0*115)|s)(?:&\\#(?:x0*65|0*101)|e)(?:&\\#(?:x0*74|0*116)|t)(?:&\\#(?:x0*3d|0*61)|=)[\\-a-z0-9]+)?(?:(?:&\\#(?:x0*3b|0*59)|;)(?:&\\#(?:x0*62|0*98)|b)(?:&\\#(?:x0*61|0*97)|a)(?:&\\#(?:x0*73|0*115)|s)(?:&\\#(?:x0*65|0*101)|e)(?:&\\#(?:x0*36|0*54)|6)(?:&\\#(?:x0*34|0*52)|4))?(?:&\\#(?:x0*2c|0*44)|,)))\\s*(?:&\\#(?:x0*3a|0*58)|\\:)|
#css expression
(?:^|[^\\w])(?:(?:\\\\0*65|\\\\0*45|e)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*78|\\\\0*58|x)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*70|\\\\0*50|p)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*72|\\\\0*52|r)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*65|\\\\0*45|e)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*73|\\\\0*53|s)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*73|\\\\0*53|s)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*69|\\\\0*49|i)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*6f|\\\\0*4f|o)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*6e|\\\\0*4e|n))[^\\w]*?(?:\\\\0*28|\\()|
#css properties
(?:^|[^\\w])(?:(?:(?:\\\\0*62|\\\\0*42|b)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*65|\\\\0*45|e)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*68|\\\\0*48|h)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*61|\\\\0*41|a)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*76|\\\\0*56|v)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*69|\\\\0*49|i)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*6f|\\\\0*4f|o)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*72|\\\\0*52|r)(?:\\/\\*.*?\\*\\/)*)|(?:(?:\\\\0*2d|\\\\0*2d|-)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*6d|\\\\0*4d|m)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*6f|\\\\0*4f|o)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*7a|\\\\0*5a|z)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*2d|\\\\0*2d|-)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*62|\\\\0*42|b)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*69|\\\\0*49|i)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*6e|\\\\0*4e|n)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*64|\\\\0*44|d)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*69|\\\\0*49|i)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*6e|\\\\0*4e|n)(?:\\/\\*.*?\\*\\/)*(?:\\\\0*67|\\\\0*47|g)(?:\\/\\*.*?\\*\\/)*))[^\\w]*(?:\\\\0*3a|\\\\0*3a|:)[^\\w]*(?:\\\\0*75|\\\\0*55|u)(?:\\\\0*72|\\\\0*52|r)(?:\\\\0*6c|\\\\0*4c|l)|
#properties
(?:^|[^\\w])(?:on(?:abort|activate|afterprint|afterupdate|autocomplete|autocompleteerror|beforeactivate|beforecopy|beforecut|beforedeactivate|beforeeditfocus|beforepaste|beforeprint|beforeunload|beforeupdate|blur|bounce|cancel|canplay|canplaythrough|cellchange|change|click|close|contextmenu|controlselect|copy|cuechange|cut|dataavailable|datasetchanged|datasetcomplete|dblclick|deactivate|drag|dragend|dragenter|dragleave|dragover|dragstart|drop|durationchange|emptied|encrypted|ended|error|errorupdate|filterchange|finish|focus|focusin|focusout|formaction|formchange|forminput|hashchange|help|input|invalid|keydown|keypress|keyup|languagechange|layoutcomplete|load|loadeddata|loadedmetadata|loadstart|losecapture|message|mousedown|mouseenter|mouseleave|mousemove|mouseout|mouseover|mouseup|mousewheel|move|moveend|movestart|mozfullscreenchange|mozfullscreenerror|mozpointerlockchange|mozpointerlockerror|offline|online|page|pagehide|pageshow|paste|pause|play|playing|popstate|progress|propertychange|ratechange|readystatechange|reset|resize|resizeend|resizestart|rowenter|rowexit|rowsdelete|rowsinserted|scroll|search|seeked|seeking|select|selectstart|show|stalled|start|storage|submit|suspend|timer|timeupdate|toggle|unload|volumechange|waiting|webkitfullscreenchange|webkitfullscreenerror|wheel)|data\\-bind|ev:event)[^\\w]
)/ix');

$this->blacklistedParams['request.queryString[action]'][] = '/\\/wp\\-admin[\\/]+admin\\-ajax\\.php/i';
$this->blacklistedParams['request.queryString[img]'][] = '/\\/wp\\-admin[\\/]+admin\\-ajax\\.php/i';
$this->blacklistedParams['request.body[action]'][] = '/\\/wp\\-admin[\\/]+admin\\-ajax\\.php/i';
$this->blacklistedParams['request.body[img]'][] = '/\\/wp\\-admin[\\/]+admin\\-ajax\\.php/i';
$this->blacklistedParams['request.body[nsextt]'][] = '/.*/';
$this->blacklistedParams['request.fileNames[Filedata]'][] = '/\\/uploadify\\.php$/i';
$this->blacklistedParams['request.fileNames[yiw_contact]'][] = '/.*/';
$this->blacklistedParams['request.fileNames[filename]'][] = '/\\/license\\.php$/i';
$this->blacklistedParams['request.fileNames[update_file]'][] = '/\\/wp\\-admin[\\/]+admin\\-ajax\\.php$/i';
$this->blacklistedParams['request.fileNames[Filedata]'][] = '/tiny_mce[\\/]+plugins[\\/]+tinybrowser[\\/]+upload_file\\.php$/i';
$this->blacklistedParams['request.fileNames[upload]'][] = '/elfinder[\\/]+php[\\/]+connector\\.minimal\\.php$/i';

$this->whitelistedParams['request.body[excerpt]'][] = '/.*/';
$this->whitelistedParams['request.body[comment]'][] = array (
  'url' => '/wp-comments-post\\.php$/i',
  'rules' => 
  array (
    0 => '3',
    1 => '12',
  ),
);
$this->whitelistedParams['request.body[content]'][] = '/\\/wp-admin\\/admin-ajax\\.php$/i';
$this->whitelistedParams['request.body[data]'][] = '/\\/wp-admin\\/admin-ajax\\.php$/i';
$this->whitelistedParams['request.body[params][files]'][] = array (
  'url' => '/\\/wp\\-load\\.php$/i',
  'rules' => 
  array (
    0 => '9',
  ),
);
$this->whitelistedParams['request.queryString[s]'][] = '/\\/wp-admin\\/(?:network\\/)?(?:plugin(?:s|-install)|edit)\\.php$/i';
$this->whitelistedParams['request.body[whitelistedPath]'][] = '/\\/wp-admin\\/admin-ajax\\.php$/i';
$this->whitelistedParams['request.body[whitelistedParam]'][] = '/\\/wp-admin\\/admin-ajax\\.php$/i';
$this->whitelistedParams['request.body[oldWhitelistedPath]'][] = '/\\/wp-admin\\/admin-ajax\\.php$/i';
$this->whitelistedParams['request.body[oldWhitelistedParam]'][] = '/\\/wp-admin\\/admin-ajax\\.php$/i';
$this->whitelistedParams['request.body[newWhitelistedPath]'][] = '/\\/wp-admin\\/admin-ajax\\.php$/i';
$this->whitelistedParams['request.body[newWhitelistedParam]'][] = '/\\/wp-admin\\/admin-ajax\\.php$/i';
$this->whitelistedParams['request.body[bannedURLs]'][] = '/\\/wp-admin\\/admin-ajax\\.php$/i';
$this->whitelistedParams['request.body[scan_include_extra]'][] = '/\\/wp-admin\\/admin-ajax\\.php$/i';
$this->whitelistedParams['request.body[newcontent]'][] = '/\\/wp-admin\\/(?:network\\/)?(?:plugin|theme)-editor\\.php$/i';
$this->whitelistedParams['request.body[widget-text]'][] = '/\\/wp-admin\\/admin-ajax\\.php$/i';
$this->whitelistedParams['request.queryString[_wp_http_referer]'][] = '/.{0,1}/';
$this->whitelistedParams['request.queryString[plugin]'][] = '/\\/wp-admin\\/(?:network\\/)?plugins\\.php$/i';
$this->whitelistedParams['request.queryString[action]'][] = '/\\/wp-admin\\/(?:network\\/)?plugins\\.php$/i';
$this->whitelistedParams['request.queryString[checked]'][] = '/\\/wp-admin\\/(?:network\\/)?plugins\\.php$/i';
$this->whitelistedParams['request.body[action]'][] = '/\\/wp-admin\\/(?:network\\/)?plugins\\.php$/i';
$this->whitelistedParams['request.body[checked]'][] = '/\\/wp-admin\\/(?:network\\/)?plugins\\.php$/i';
$this->whitelistedParams['request.body[submit]'][] = '/\\/wp-admin\\/(?:network\\/)?plugins\\.php$/i';
$this->whitelistedParams['request.body[blogname]'][] = '/\\/wp-admin\\/options\\.php$/i';
$this->whitelistedParams['request.body[blogdescription]'][] = '/\\/wp-admin\\/options\\.php$/i';
$this->whitelistedParams['request.body[siteurl]'][] = '/\\/wp-admin\\/options\\.php$/i';
$this->whitelistedParams['request.body[home]'][] = '/\\/wp-admin\\/options\\.php$/i';
$this->whitelistedParams['request.body[admin_email]'][] = '/\\/wp-admin\\/options\\.php$/i';
$this->whitelistedParams['request.body[moderation_keys]'][] = '/\\/wp-admin\\/options\\.php$/i';
$this->whitelistedParams['request.body[blacklist_keys]'][] = '/\\/wp-admin\\/options\\.php$/i';
$this->whitelistedParams['request.body[permalink_structure]'][] = '/\\/wp-admin\\/options\\.php$/i';
$this->whitelistedParams['request.body[category_base]'][] = '/\\/wp-admin\\/options\\.php$/i';
$this->whitelistedParams['request.body[tag_base]'][] = '/\\/wp-admin\\/options\\.php$/i';
$this->whitelistedParams['request.queryString[s]'][] = '/\\/wp-admin\\/edit-comments\\.php$/i';
$this->whitelistedParams['request.body[log]'][] = '/\\/wp-login\\.php$/i';
$this->whitelistedParams['request.body[pwd]'][] = '/\\/wp-login\\.php$/i';
$this->whitelistedParams['request.body[redirect_to]'][] = '/\\/wp-login\\.php$/i';
$this->whitelistedParams['request.queryString[s]'][] = '/\\/wp-admin\\/network\\/(?:user|site)s\\.php$/i';
$this->whitelistedParams['request.body[blog]'][] = '/\\/wp-admin\\/network\\/site-new\\.php$/i';
$this->whitelistedParams['request.body[deletedWhitelistedPath]'][] = '/\\/wp-admin\\/admin-ajax\\.php$/i';
$this->whitelistedParams['request.body[deletedWhitelistedParam]'][] = '/\\/wp-admin\\/admin-ajax\\.php$/i';
$this->whitelistedParams['request.body[itsec_global][log_location]'][] = '/\\/wp-admin\\/options\\.php$/i';
$this->whitelistedParams['request.body[itsec_backup][location]'][] = '/\\/wp-admin\\/options\\.php$/i';
$this->whitelistedParams['request.body[dir]'][] = '/\\/wp-admin\\/admin-ajax\\.php$/i';
$this->whitelistedParams['request.body[sql_query]'][] = '/(?:lint|import)\\.php$/i';
$this->whitelistedParams['request.body[divi_integration_body]'][] = '/\\/wp-admin\\/admin-ajax\\.php$/i';
$this->whitelistedParams['request.body[divi_integration_head]'][] = '/\\/wp-admin\\/admin-ajax\\.php$/i';
$this->whitelistedParams['request.body[options][modules][ga_code]'][] = array (
  'url' => '#wp\\-admin/+options\\-general.php$#i',
  'rules' => 
  array (
    0 => '9',
  ),
);
$this->whitelistedParams['request.fileNames'][] = array (
  'url' => '#importbuddy\\.php$#i',
  'rules' => 
  array (
    0 => '76',
  ),
);

$this->rules[18] = wfWAFRule::create($this, 18, NULL, 'priv-esc', NULL, 'User Roles Manager Privilege Escalation <= 4.24', 0, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'notEquals', '', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'ure_other_roles',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'match', '#/wp\\-admin/(network/)?(profile|user-new)\\.php#i', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
))))));
$this->rules[66] = wfWAFRule::create($this, 66, NULL, 'dos', NULL, 'WordPress Core <= 4.5.3 - DoS', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '#/wp\\-admin/admin\\-ajax\\.php$#i', array(wfWAFRuleComparisonSubject::create($this, 'server.script_filename', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'equals', 'update-plugin', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'match', '/(^|\\/|\\\\|%2f|%5c)\\.\\.(\\\\|\\/|%2f|%5c)/i', array(wfWAFRuleComparisonSubject::create($this, 'request.body', array (
)),
wfWAFRuleComparisonSubject::create($this, 'request.queryString', array (
))))));
$this->rules[1] = wfWAFRule::create($this, 1, NULL, 'whitelist', NULL, 'Whitelisted URL', 1, 'allow', new wfWAFRuleComparisonGroup(new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '#/wp\\-admin/(network/)?(post|profile|user-new|settings)\\.php$#i', array(wfWAFRuleComparisonSubject::create($this, 'server.script_filename', array (
))))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '#/wp\\-admin/admin\\-ajax\\.php$#i', array(wfWAFRuleComparisonSubject::create($this, 'server.script_filename', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'equals', 'wordfence_loadLiveTraffic', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'equals', 'wordfence_ticker', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'currentUserIs', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'equals', 'install-plugin', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'equals', 'update-plugin', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'equals', 'delete-plugin', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'equals', 'search-plugins', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'equals', 'search-install-plugins', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'equals', 'activate-plugin', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'equals', 'update-theme', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'equals', 'delete-theme', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'equals', 'install-theme', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
))))))))));
$this->rules[2] = wfWAFRule::create($this, 2, NULL, 'lfi', NULL, 'Slider Revolution: Local File Inclusion', 0, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '#/wp\\-admin/admin\\-ajax\\.php$#i', array(wfWAFRuleComparisonSubject::create($this, 'server.script_filename', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparisonGroup(new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'equals', 'revslider_show_image', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'equals', 'nopriv_revslider_show_image', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
))))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'match', '/\\.php$/i', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'img',
), array (
))))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'equals', 'revslider_show_image', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'equals', 'nopriv_revslider_show_image', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
))))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'match', '/\\.php$/i', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'img',
), array (
))))))));
$this->rules[60] = wfWAFRule::create($this, 60, NULL, 'file_upload', NULL, 'Slider Revolution: Arbitrary File Upload', 0, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '#/wp\\-admin/admin\\-ajax\\.php$#i', array(wfWAFRuleComparisonSubject::create($this, 'server.script_filename', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparisonGroup(new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'equals', 'revslider_ajax_action', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'equals', 'nopriv_revslider_ajax_action', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
))))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'equals', 'update_plugin', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'client_action',
), array (
))))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'equals', 'revslider_ajax_action', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'equals', 'nopriv_revslider_ajax_action', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
))))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'equals', 'update_plugin', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'client_action',
), array (
)))))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
))))));
$this->rules[15] = wfWAFRule::create($this, 15, NULL, 'xss', NULL, 'dzs-videogallery 8.80 XSS HTML injection in inline JavaScript', 0, 'blockXSS', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/dzs\\-videogallery[\\/]+admin[\\/]+(?:playlist|tag)seditor[\\/]+popup\\.php/', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'contains', '\'', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'initer',
), array (
))))));
$this->rules[16] = wfWAFRule::create($this, 16, NULL, 'sqli', NULL, 'Simple Ads Manager <= 2.9.4.116 - SQL Injection', 0, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/simple-ads-manager[\\/]+sam-ajax-loader\\.php/', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'match', new wfWAFRuleVariable($this, 'sqliRegex', NULL), array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'wc',
), array (
  0 => 'base64decode',
))))));
$this->rules[17] = wfWAFRule::create($this, 17, NULL, 'rfi', NULL, 'Gwolle Guestbook <= 1.5.3 - Remote File Inclusion', 0, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/gwolle\\-gb[\\/]+frontend[\\/]+captcha[\\/]+ajaxresponse\\.php/', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'match', '/.*/', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'abspath',
), array (
))))));
$this->rules[19] = wfWAFRule::create($this, 19, NULL, 'sde', NULL, 'Yoast Wordpress SEO <= 3.1.2 - Sensitive Data Exposure', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/\\/wp\\-admin[\\/]+admin\\-ajax\\.php/i', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'md5Equals', '9074dbf9b7e456eb88fbc7230567f54b', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
))))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'editor', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'author', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'contributor', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'md5Equals', '49e2f0e45d9672ef2125965277c49344', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '32d93c4d8c0a9367f2da487238b141cc', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
)))))))));
$this->rules[20] = wfWAFRule::create($this, 20, NULL, 'auth-bypass', NULL, 'WordPress Core <= 4.5.0 - Authentication Bypass', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/\\/wp\\-admin[\\/]+admin\\-ajax\\.php/i', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'md5Equals', '5c9fefc9f24ecfd74addc2eaff8481fc', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'editor', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'author', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'contributor', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))))));
$this->rules[21] = wfWAFRule::create($this, 21, NULL, 'file_upload', NULL, 'Ninja Forms <= 2.9.42 - Arbitrary File Upload', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/\\/wp\\-admin[\\/]+admin\\-ajax\\.php/i', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'equals', 'nf_async_upload', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
))))));
$this->rules[22] = wfWAFRule::create($this, 22, NULL, 'auth-bypass', NULL, 'Ninja Forms <= 2.9.42: Missing Authentication Check', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'notEquals', '', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'nf2to3',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'notEquals', '', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'update_ninja_forms_settings',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'notEquals', '', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'ninja_forms',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
))))));
$this->rules[23] = wfWAFRule::create($this, 23, NULL, 'auth-bypass', NULL, 'Ninja Forms <= 2.9.42: Missing Authentication Check', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'notEquals', '', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'nf2to3',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'notEquals', '', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'nf_export_form',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'nf_export_form',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'equals', 'nf_import_form', array(wfWAFRuleComparisonSubject::create($this, 'request.fileNames', array (
))))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
))))));
$this->rules[24] = wfWAFRule::create($this, 24, NULL, 'sde', NULL, 'Caldera Forms <= 1.3.5 - Sensitive Data Exposure', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/\\/wp\\-admin[\\/]+admin\\-ajax\\.php/i', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'match', '/^CF[0-9a-f]+$/i', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'form',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'md5Equals', '91718ce4540ea4492190efd99f7fa6c2', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', 'ab202c0ef9012b9b64798d6361419609', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
)))))));
$this->rules[25] = wfWAFRule::create($this, 25, NULL, 'auth-bypass', NULL, 'WP Fastest Cache <= 0.8.5.6 - Authorization Bypass', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/\\/wp\\-admin[\\/]+admin\\-ajax\\.php/i', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'md5Equals', '82268713c6ea5aec38c946035be94678', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
))))));
$this->rules[26] = wfWAFRule::create($this, 26, NULL, 'auth-bypass', NULL, 'WP Fastest Cache <= 0.8.5.6 - Authorization Bypass', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/\\/wp\\-admin[\\/]+admin\\-ajax\\.php/i', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'md5Equals', '2d46446beaeec1c0fd44fbbe228b0c21', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
))))));
$this->rules[27] = wfWAFRule::create($this, 27, NULL, 'xss', NULL, 'HDW Player Plugin <= 3.4 - Reflected XSS', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/\\/wp\\-admin[\\/]+admin\\.php/i', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'md5Equals', '8fe5104833b48c11b4c6a3e611e3f544', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'page',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'lengthGreaterThan', '0', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'page',
), array (
))))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'md5Equals', 'd2cb1ebf7e72e3749053af2966d8946c', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'page',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'lengthGreaterThan', '0', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'page',
), array (
))))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'md5Equals', '2767cc3ede7592a47bd6657e3799565c', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'page',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'lengthGreaterThan', '0', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'page',
), array (
))))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'md5Equals', 'cce3df80f07d36b56db4376a4802d6c2', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'page',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'lengthGreaterThan', '0', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'page',
), array (
))))))));
$this->rules[28] = wfWAFRule::create($this, 28, NULL, 'sqli', NULL, 'Google SEO Pressor Snippet Plugin <= 1.2.6 - SQL Injection', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/\\/wp\\-admin[\\/]+admin\\-ajax\\.php/i', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'md5Equals', '69301e541e806abf94827302f94bb4cc', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'notMatch', '/^[0-9]+$/', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'post_id',
), array (
))))));
$this->rules[29] = wfWAFRule::create($this, 29, NULL, 'xss', NULL, 'WPMain Stored XSS <= 3.1.2', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'equals', 'mainwp-setup', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'page',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'page',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
))))));
$this->rules[31] = wfWAFRule::create($this, 31, NULL, 'file_upload', NULL, 'EWWW Image Optimizer <= 2.8.0 [Remote Command Execution]', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'lengthGreaterThan', '0', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.md5Body',
  1 => '3448147ad57606b48fc7a2d1bf946c3f',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'notMatch', '/^\\d+$/', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.md5Body',
  1 => '3448147ad57606b48fc7a2d1bf946c3f',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'lengthGreaterThan', '0', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.md5Body',
  1 => '64adec2d588253e23e718034b1ad140d',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'notMatch', '/^\\d+$/', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.md5Body',
  1 => '64adec2d588253e23e718034b1ad140d',
), array (
))))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'lengthGreaterThan', '0', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.md5Body',
  1 => 'ab494af1a5663f82e0b8b11723b87867',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'notMatch', '/^\\d+$/', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.md5Body',
  1 => 'ab494af1a5663f82e0b8b11723b87867',
), array (
))))))));
$this->rules[32] = wfWAFRule::create($this, 32, NULL, 'xss', NULL, 'Customize Admin Stored XSS <= 1.6.6', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/\\/wp\\-admin[\\/]+options\\.php/i', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'notMatch', '/^#?[0-9a-f]+$/i', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.md5Body',
  1 => '9b5354ddf005f69745b19155d2b64725',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'lengthGreaterThan', '0', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.md5Body',
  1 => '9b5354ddf005f69745b19155d2b64725',
), array (
))))));
$this->rules[33] = wfWAFRule::create($this, 33, NULL, 'sqli', NULL, 'Kento Post View Counter SQLi <= 2.8', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/\\/wp\\-admin[\\/]+admin\\-ajax\\.php/i', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'md5Equals', '46f5a89acb206a7f58db187e45fa2a4d', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'notMatch', '/^(?:country|city)$/ix', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.md5Body',
  1 => '5fc75f82e79d75efb9716109034a3209',
), array (
))))))));
$this->rules[34] = wfWAFRule::create($this, 34, NULL, 'xss', NULL, 'Kento Post View Counter Reflected XSS <= 2.8', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/\\/wp\\-admin[\\/]+admin\\-ajax\\.php/i', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'md5Equals', 'b33c30f8f27dd4a25de0da3f7be5afad', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'match', '/[^-:0-9]/', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.md5Body',
  1 => '1e3c6aaf636066719ec996aca10b440c',
), array (
))))))));
$this->rules[35] = wfWAFRule::create($this, 35, NULL, 'xss', NULL, 'Kento Post View Counter Stored XSS <= 2.8', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'equals', 'Y', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'kentopvc_hidden',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'notMatch', '/^1?$/', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'kento_pvc_hide',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'notMatch', '/^1?$/', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'kento_pvc_uniq',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'match', new wfWAFRuleVariable($this, 'xssRegex', NULL), array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'kento_pvc_today_text',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'match', new wfWAFRuleVariable($this, 'xssRegex', NULL), array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'kento_pvc_total_text',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'match', new wfWAFRuleVariable($this, 'xssRegex', NULL), array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'kento_pvc_numbers_lang',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'notMatch', '/^1?$/', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'kento_pvc_posttype',
), array (
)))))));
$this->rules[36] = wfWAFRule::create($this, 36, NULL, 'file_upload', NULL, 'WP Mobile Detector <= 3.5 - Arbitrary File Upload', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '#/wp\\-mobile\\-detector[/]+resize\\.php#i', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'match', '#/wp\\-mobile\\-detector[/]+timthumb\\.php#i', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
))))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'lengthGreaterThan', '0', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'src',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'notMatch', '/\\.(?:png|gif|jpg|jpeg|jif|jfif|svg)$/i', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'src',
), array (
))))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'lengthGreaterThan', '0', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'src',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'notMatch', '/\\.(?:png|gif|jpg|jpeg|jif|jfif|svg)$/i', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'src',
), array (
))))))));
$this->rules[37] = wfWAFRule::create($this, 37, NULL, 'sqli', NULL, 'Double Opt-In for Download <= 2.0.9 - SQL Injection', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/\\/wp\\-admin[\\/]+admin\\-ajax\\.php/i', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'lengthGreaterThan', '0', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'id',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'notMatch', '/^[0-9]+$/', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'id',
), array (
)))))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'equals', 'populate_download_edit_form', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
))))));
$this->rules[38] = wfWAFRule::create($this, 38, NULL, 'sde', NULL, 'WP Maintenance Mode <= 2.0.3 - Sensitive Data Exposure', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/\\/wp\\-admin[\\/]+admin\\-ajax\\.php/i', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'md5Equals', '9082302c5211de15622f1cfab357f521', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
))))));
$this->rules[39] = wfWAFRule::create($this, 39, NULL, 'sde', NULL, 'WP Maintenance Mode <= 2.0.3 - Auth Bypass', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/\\/wp\\-admin[\\/]+admin\\-ajax\\.php/i', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'md5Equals', '002138689cdae4fcd6e725bf66e38b7e', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
))))));
$this->rules[40] = wfWAFRule::create($this, 40, NULL, 'rce', NULL, 'WP Maintenance Mode <= 2.0.3 - Remote Code Execution', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '#wp\\-admin/+options\\-general.php$#i', array(wfWAFRuleComparisonSubject::create($this, 'server.script_filename', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'md5Equals', 'dab0846b692865a1f9885ed20d7fd2f7', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'page',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'page',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'match', '/["\\$]/', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.md5Body',
  1 => '93da65a9fd0004d9477aeac024e08e15',
  2 => '0eb9b3af2e4a00837a1b1a854c9ea18c',
  3 => '03ae7ca473a366eb6398f7d6239152fa',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.md5QueryString',
  1 => '93da65a9fd0004d9477aeac024e08e15',
  2 => '0eb9b3af2e4a00837a1b1a854c9ea18c',
  3 => '03ae7ca473a366eb6398f7d6239152fa',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'md5Equals', 'c4ca4238a0b923820dcc509a6f75849b', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.md5Body',
  1 => '93da65a9fd0004d9477aeac024e08e15',
  2 => '0eb9b3af2e4a00837a1b1a854c9ea18c',
  3 => '5d0bebf298375c590cd3d8f06528d232',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.md5QueryString',
  1 => '93da65a9fd0004d9477aeac024e08e15',
  2 => '0eb9b3af2e4a00837a1b1a854c9ea18c',
  3 => '5d0bebf298375c590cd3d8f06528d232',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'md5Equals', '0eb9b3af2e4a00837a1b1a854c9ea18c', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.md5Body',
  1 => 'e7f8cbd87d347be881cba92dad128518',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.md5QueryString',
  1 => 'e7f8cbd87d347be881cba92dad128518',
), array (
))))));
$this->rules[41] = wfWAFRule::create($this, 41, NULL, 'auth-bypass', NULL, 'Robo Gallery <= 2.0.14 - Auth Bypass', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '#/wp\\-admin/admin\\-ajax\\.php$#i', array(wfWAFRuleComparisonSubject::create($this, 'server.script_filename', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'equals', 'rbs_gallery', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'editor', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'author', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'contributor', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
))))));
$this->rules[42] = wfWAFRule::create($this, 42, NULL, 'file-download', NULL, 'Memphis Documents Library <= 3.4.5 - Unauthenticated Arbitrary File Download', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '#/wp\\-admin[/]+admin\\-ajax\\.php#i', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'md5Equals', '53ce229902e6621b2723cbb0908123f7', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'md5Equals', '0c0c8667d3d4f9c86cbc49e0e345e206', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'type',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'type',
), array (
))))));
$this->rules[43] = wfWAFRule::create($this, 43, NULL, 'lfi', NULL, 'SEO by SQUIRRLY <= 6.1.0 - Local File Inclusion', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'lengthGreaterThan', '0', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.md5QueryString',
  1 => '932d0cf39a5aa4fc1c3faddaf42e8325',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'notMatch', '/^[0-9]*$/', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.md5QueryString',
  1 => '58f627ddac2040609edf8ccd8c406fef',
), array (
))))));
$this->rules[44] = wfWAFRule::create($this, 44, NULL, 'auth-bypass', NULL, 'SEO by SQUIRRLY <= 6.1.0 - Auth Bypass', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '#/wp\\-admin/#i', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'md5Equals', 'c12e6c914ed9a7bbeca851684096ac94', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', 'eadf52d0c96eb78634b8d939a66fb96f', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', 'affcac9194a01c0146937eac49f5bd9f', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
)))))));
$this->rules[45] = wfWAFRule::create($this, 45, NULL, 'auth-bypass', NULL, 'DELUCKS SEO <= 1.3.9 - Unauthorized Options Update', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'identical', '', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.md5Body',
  1 => 'c4e0bb93e05f5345cde016b6825a904c',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'lengthGreaterThan', '0', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.md5Body',
  1 => 'c4e0bb93e05f5345cde016b6825a904c',
), array (
)))))));
$this->rules[46] = wfWAFRule::create($this, 46, NULL, 'auth-bypass', NULL, 'WiziApp - All in One mobile suite <= 4.1.2 - Auth Bypass', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/\\/wp\\-admin[\\/]+admin\\-ajax\\.php/i', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'md5Equals', '44a896976080543c93e1cf8ac2c3c49f', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', 'a15a50b6c91bb753e728ffa0cc2911de', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
)))))));
$this->rules[47] = wfWAFRule::create($this, 47, NULL, 'priv-esc', NULL, 'Profile Builder <= 2.4.0 - Privilege Escalation', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '#/wp\\-admin/admin\\-ajax\\.php$#i', array(wfWAFRuleComparisonSubject::create($this, 'server.script_filename', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'md5Equals', 'df4b4806fa32e25f927721199f290e61', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
))))));
$this->rules[48] = wfWAFRule::create($this, 48, NULL, 'xss', NULL, 'All in One SEO Pack 2.3.6.1 - Persistent XSS', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/Abonti|aggregator|AhrefsBot|asterias|BDCbot|BLEXBot|BuiltBotTough|Bullseye|BunnySlippers|ca\\-crawler|CCBot|Cegbfeieh|CheeseBot|CherryPicker|CopyRightCheck|cosmos|Crescent|discobot|DittoSpyder|DotBot|Download Ninja|EasouSpider|EmailCollector|EmailSiphon|EmailWolf|EroCrawler|Exabot|ExtractorPro|Fasterfox|FeedBooster|Foobot|Genieo|grub\\-client|Harvest|hloader|httplib|HTTrack|humanlinks|ieautodiscovery|InfoNaviRobot|IstellaBot|Java\\/1\\.|JennyBot|k2spider|Kenjin Spider|Keyword Density\\/0\\.9|larbin|LexiBot|libWeb|libwww|LinkextractorPro|linko|LinkScan\\/8\\.1a Unix|LinkWalker|LNSpiderguy|lwp\\-trivial|magpie|Mata Hari|MaxPointCrawler|MegaIndex|Microsoft URL Control|MIIxpc|Mippin|Missigua Locator|Mister PiX|MJ12bot|moget|MSIECrawler|NetAnts|NICErsPRO|Niki\\-Bot|NPBot|Nutch|Offline Explorer|Openfind|panscient\\.com|PHP\\/5\\.\\{|ProPowerBot\\/2\\.14|ProWebWalker|Python\\-urllib|QueryN Metasearch|RepoMonkey|RMA|SemrushBot|SeznamBot|SISTRIX|sitecheck\\.Internetseer\\.com|SiteSnagger|SnapPreviewBot|Sogou|SpankBot|spanner|spbot|Spinn3r|suzuran|Szukacz\\/1\\.4|Teleport|Telesoft|The Intraformant|TheNomad|TightTwatBot|Titan|toCrawl\\/UrlDispatcher|True_Robot|turingos|TurnitinBot|UbiCrawler|UnisterBot|URLy Warning|VCI|WBSearchBot|Web Downloader\\/6\\.9|Web Image Collector|WebAuto|WebBandit|WebCopier|WebEnhancer|WebmasterWorldForumBot|WebReaper|WebSauger|Website Quester|Webster Pro|WebStripper|WebZip|Wotbox|wsr\\-agent|WWW\\-Collector\\-E|Xenu|Zao|Zeus|ZyBORG|coccoc|Incutio|lmspider|memoryBot|SemrushBot|serf|Unknown|uptime files/i', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.headers',
  1 => 'User-Agent',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'match', new wfWAFRuleVariable($this, 'xssRegex', NULL), array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.headers',
  1 => 'User-Agent',
), array (
))))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/semalt\\.com|kambasoft\\.com|savetubevideo\\.com|buttons\\-for\\-website\\.com|sharebutton\\.net|soundfrost\\.org|srecorder\\.com|softomix\\.com|softomix\\.net|myprintscreen\\.com|joinandplay\\.me|fbfreegifts\\.com|openmediasoft\\.com|zazagames\\.org|extener\\.org|openfrost\\.com|openfrost\\.net|googlsucks\\.com|best\\-seo\\-offer\\.com|buttons\\-for\\-your\\-website\\.com|www\\.Get\\-Free\\-Traffic\\-Now\\.com|best\\-seo\\-solution\\.com|buy\\-cheap\\-online\\.info|site3\\.free\\-share\\-buttons\\.com|webmaster\\-traffic\\.co/i', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.headers',
  1 => 'Referer',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'match', new wfWAFRuleVariable($this, 'xssRegex', NULL), array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.headers',
  1 => 'Referer',
), array (
)))))));
$this->rules[49] = wfWAFRule::create($this, 49, NULL, 'xss', NULL, 'All in One SEO Pack <= 2.3.7 - Unauthenticated Stored XSS', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/sitemap_.*?<.*?(:?_\\d+)?\\.xml(:?\\.gz)?/i', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
))))));
$this->rules[50] = wfWAFRule::create($this, 50, NULL, 'auth-bypass', NULL, 'Fluid Responsive Slideshow <= 2.2.26 - Unauthorized Content Modification', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '#/wp\\-admin/admin\\-ajax\\.php$#i', array(wfWAFRuleComparisonSubject::create($this, 'server.script_filename', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'equals', 'frs_save', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'editor', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
))))));
$this->rules[52] = wfWAFRule::create($this, 52, NULL, 'file_upload', NULL, 'File Manager <= 3.0.0 - Arbitrary File Upload/Download', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '#/wp\\-admin/admin\\-ajax\\.php$#i', array(wfWAFRuleComparisonSubject::create($this, 'server.script_filename', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'lengthGreaterThan', '0', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.md5Body',
  1 => 'dfff0a7fa1a55c8c1a4966c19f6da452',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.md5QueryString',
  1 => 'dfff0a7fa1a55c8c1a4966c19f6da452',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'md5Equals', '266e0d3d29830abfe7d4ed98b47966f7', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
))))));
$this->rules[53] = wfWAFRule::create($this, 53, NULL, 'file_upload', NULL, 'Levo Slideshow <= 2.3 - Arbitrary File Upload', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'match', '/^(?:lvo_admin_head|lvo_add_new_album|lvo_delete_album|reset_albums|save_lvo_settings|lvo_single_image_upload|lvo_resize_image_and_add|lvo_delete_image|lvo_get_albums_table|lvo_get_albums_images_table|activate|deactivate|lvo_get_album|lvo_get_album_images|get_image|lvo_delete_cache|lvo_reorder_image|lvo_reorder_album|lvo_bulk_delete_albums|lvo_bulk_disable_albums|lvo_bulk_enable_albums|delete_image|lvo_bulk_delete_images|lvo_bulk_disable_images|lvo_bulk_enable_images|lvo_disable_album|lvo_enable_album|lvo_disable_image|lvo_enable_image)$/i', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'task',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'task',
), array (
))))));
$this->rules[55] = wfWAFRule::create($this, 55, NULL, 'auth-bypass', NULL, 'Form Lightbox <= 2.1 - Unauthenticated Options Update', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '#/form\\-lightbox/ajax\\.php$#i', array(wfWAFRuleComparisonSubject::create($this, 'server.script_filename', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
))))));
$this->rules[56] = wfWAFRule::create($this, 56, NULL, 'auth-bypass', NULL, 'WordPress Social Stream <= 1.5.15 - Authenticated Unauthorized Options Update', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '#/wp\\-admin/admin\\-ajax\\.php$#i', array(wfWAFRuleComparisonSubject::create($this, 'server.script_filename', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'equals', 'dcwss_update', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
))))));
$this->rules[57] = wfWAFRule::create($this, 57, NULL, 'priv-esc', NULL, 'Ultimate Product Catalogue <= 3.8.1 - Privilege Escalation', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'md5Equals', '8c2e1c2817e3de18e2140498bdd4f7fa', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', 'e12a2417ffbd0ae4010210b596a3f230', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', 'df33bf68ad0288e1547139e02c1e096b', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', 'c000b32f92bbd81b6cbbddd101073e54', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', 'cc61a84091dcc8b9bd6ae35cf48d71ab', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', 'c80c9038bbb5910385decc276e42061e', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', 'b81e270701125a0024db04bebdbcfc2a', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '2e563359c1b268da0041c5bf822857a1', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '4ba84dbaaafd4e7d98f55e9f093fe65a', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '1deb089a44f2962f92c678a451e61142', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '6ffa8f3e70a6279866e4b2c16fe18729', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', 'aa1c4fd7fb193a2cd1b0cc9150131b31', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '91e590bfc230eb3971ef1bb6b97ef974', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', 'd0e980fd7bc681b3c3085b1ac31024d6', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '069dde6f8ea27c8618cc8f6c6703a7c7', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '819900411c0d5c99c116bbce137ee04b', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '097d5401a3ae688b669f29351b9667de', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '81f1bbc03176c4525b8801b0058b309a', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', 'a8072b3a87b49ffea18548f35c6abd8c', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '364409901cb1fce968104dce4bf7e4fe', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '246c8343383408c8644f31b1f42617ce', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '66d87c0a0e2c02192c322c61d9d6990a', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '67bfe619d00425b51276ae083ae271a5', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '4aaddae320d8aaa8241ffd22693dd546', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '141f5901534f2b3092be526cac250bb6', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '2b7efaffcb87e027a011c33125585db7', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '979e32726f541a1e568557e9eb6554aa', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', 'c252a9eb30d304ba6079376ef5231aad', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '75b0967858cf244d4e2654e69b33d2f1', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '9cfad494bbf947c2ce316fe96eac396d', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', 'a4a148b325f286e07d9f24e3654e2672', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '3863850b63dc41d4e6e8cee097644d18', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '8fb62eed357b03c7be735352ab247bbe', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', 'a0380a8020e3a09257a6c67a1fe14627', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', 'b0f145120ec76e700969f63c5af3e8f4', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '52f6fc037a9e97f93309b1115882c080', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', 'f2a2c32747d2d49ddf682158eb9a510e', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '5caa7c3d6bba5a36798619b0ac4747bb', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', 'a0793408acebd97af0414d46b6705a65', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', 'f605a16b247f81f2eb2fdc097e1e1a19', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', 'ea7348459bf68bf881facb0e5d18ccd7', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', 'c747677e1903fdfffd4108f3347cf5ab', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', '05c0ea3ee2df67b6bc2f3921c3fe2180', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'md5Equals', 'd986eb29534241e46402c30e678af902', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'Action',
), array (
)))))));
$this->rules[58] = wfWAFRule::create($this, 58, NULL, 'file_upload', NULL, '360 Product Rotation <= 1.2.1 - Arbitrary File Upload', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '#includes\\/+plugin\\-media\\-upload\\.php$#i', array(wfWAFRuleComparisonSubject::create($this, 'server.script_filename', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'editor', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'author', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'contributor', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
))))));
$this->rules[59] = wfWAFRule::create($this, 59, NULL, 'xss', NULL, 'WordPress Activity Log <= 2.3.1 - Persistent XSS', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', new wfWAFRuleVariable($this, 'xssRegex', NULL), array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.headers',
  1 => 'Client-IP',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.headers',
  1 => 'X-Forwarded-For',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.headers',
  1 => 'X-Forwarded',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.headers',
  1 => 'X-Cluster-Client-IP',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.headers',
  1 => 'Forwarded-For',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.headers',
  1 => 'Forwarded',
), array (
))))));
$this->rules[61] = wfWAFRule::create($this, 61, NULL, 'sqli', NULL, 'User Meta Manager <= 3.4.6 - SQL Injection', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '#/wp\\-admin/admin\\-ajax\\.php$#i', array(wfWAFRuleComparisonSubject::create($this, 'server.script_filename', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'match', new wfWAFRuleVariable($this, 'sqliRegex', NULL), array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'umm_user',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'umm_user',
), array (
))))));
$this->rules[64] = wfWAFRule::create($this, 64, NULL, 'rce', NULL, 'TimThumb <= 2.8.13 - Remote Code Execution', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/\\/(?:timthumb\\.php|img\\.php)/i', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'match', '/[^A-Za-z0-9\\-\\.\\_:\\/\\?\\&\\+\\;\\=]/', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'src',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'lengthGreaterThan', '0', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'webshot',
), array (
))))));
$this->rules[63] = wfWAFRule::create($this, 63, NULL, 'rfd', NULL, 'TimThumb <= 1.33 - Remote File Download', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/\\/(?:timthumb\\.php|img\\.php)/i', array(wfWAFRuleComparisonSubject::create($this, 'request.path', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'notMatch', '_^[^\\?]+?\\.(?:jpg|jpeg|gif|png)(?:\\?[a-z0-9\\-\\_\\.\\~%\\!\\$&\'\\(\\)\\*\\+,;\\=\\:@\\/\\?]*)?$_iu', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'src',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'lengthGreaterThan', '0', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'src',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'lengthLessThan', '1', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'webshot',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'equals', '0', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'webshot',
), array (
)))))));
$this->rules[65] = wfWAFRule::create($this, 65, NULL, 'file_upload', NULL, 'MailPoet <= 2.6.7 - Arbitrary File Upload', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'match', '/^(?:wysija_)+campaigns/i', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'page',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'page',
), array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'equals', 'themes', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
)))), new wfWAFRuleLogicalOperator('OR'), new wfWAFRuleComparison($this, 'equals', 'themeupload', array(wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.body',
  1 => 'action',
), array (
)),
wfWAFRuleComparisonSubject::create($this, array (
  0 => 'request.queryString',
  1 => 'action',
), array (
)))))));
$this->rules[68] = wfWAFRule::create($this, 68, NULL, 'file_upload', NULL, 'Malicious File Upload (Patterns)', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'editor', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'author', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'filePatternsMatch', '', array(wfWAFRuleComparisonSubject::create($this, 'request.fileNames', array (
))))));
$this->rules[76] = wfWAFRule::create($this, 76, NULL, 'file_upload', NULL, 'Malicious File Upload (PHP)', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'editor', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'author', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'fileHasPHP', '', array(wfWAFRuleComparisonSubject::create($this, 'request.fileNames', array (
))))));
$this->rules[3] = wfWAFRule::create($this, 3, NULL, 'sqli', '40', 'SQL Injection', 1, 'failSQLi', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'matchCount', new wfWAFRuleVariable($this, 'sqliRegex', NULL), array(wfWAFRuleComparisonSubject::create($this, 'request.body', array (
)),
wfWAFRuleComparisonSubject::create($this, 'request.queryString', array (
))))));
$this->rules[9] = wfWAFRule::create($this, 9, NULL, 'xss', '100', 'XSS: Cross Site Scripting', 1, 'failXSS', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'matchCount', new wfWAFRuleVariable($this, 'xssRegex', NULL), array(wfWAFRuleComparisonSubject::create($this, 'request.body', array (
)),
wfWAFRuleComparisonSubject::create($this, 'request.queryString', array (
))))));
$this->rules[11] = wfWAFRule::create($this, 11, NULL, 'file_upload', NULL, 'Malicous File Upload', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/\\.(p(h(p|tml)[0-9]?|l|y)|(j|a)sp|aspx|sh|shtml|html?|cgi|htaccess|user\\.ini)($|\\.)/i', array(wfWAFRuleComparisonSubject::create($this, 'request.fileNames', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
))))));
$this->rules[67] = wfWAFRule::create($this, 67, NULL, 'lfi', NULL, 'Directory Traversal - wp-config.php', 0, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/(^|\\/|\\\\)(\\.\\.?(\\\\|\\/)+)+wp\\-config\\.php/i', array(wfWAFRuleComparisonSubject::create($this, 'request.body', array (
)),
wfWAFRuleComparisonSubject::create($this, 'request.queryString', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
))))));
$this->rules[12] = wfWAFRule::create($this, 12, NULL, 'lfi', NULL, 'Directory Traversal', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/(^|\\/|\\\\)\\.\\.(\\\\|\\/)/', array(wfWAFRuleComparisonSubject::create($this, 'request.body', array (
)),
wfWAFRuleComparisonSubject::create($this, 'request.queryString', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
))))));
$this->rules[13] = wfWAFRule::create($this, 13, NULL, 'lfi', NULL, 'LFI: Local File Inclusion', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/^\\/(?:\\.\\/)*(?:var|home|usr|mnt|media|etc|tmp|dev|proc)\\//i', array(wfWAFRuleComparisonSubject::create($this, 'request.body', array (
)),
wfWAFRuleComparisonSubject::create($this, 'request.queryString', array (
)))), new wfWAFRuleLogicalOperator('AND'), new wfWAFRuleComparison($this, 'currentUserIsNot', 'administrator', array(wfWAFRuleComparisonSubject::create($this, 'server.empty', array (
))))));
$this->rules[14] = wfWAFRule::create($this, 14, NULL, 'xxe', NULL, 'XXE: External Entity Expansion', 1, 'block', new wfWAFRuleComparisonGroup(new wfWAFRuleComparison($this, 'match', '/<\\!(?:DOCTYPE|ENTITY)\\s+(?:%\\s*)?\\w+\\s+SYSTEM/i', array(wfWAFRuleComparisonSubject::create($this, 'request.body', array (
)),
wfWAFRuleComparisonSubject::create($this, 'request.queryString', array (
))))));
?>