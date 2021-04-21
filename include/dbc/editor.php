<?php
/** Adminer Editor - Compact database editor
* @link https://www.adminer.org/
* @author Jakub Vrana, https://www.vrana.cz/
* @copyright 2009 Jakub Vrana
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
* @version 4.7.8
*/error_reporting(6133);$rc=!preg_match('~^(unsafe_raw)?$~',ini_get("filter.default"));if($rc||ini_get("filter.default_flags")){foreach(array('_GET','_POST','_COOKIE','_SERVER')as$X){$Kg=filter_input_array(constant("INPUT$X"),FILTER_UNSAFE_RAW);if($Kg)$$X=$Kg;}}if(function_exists("mb_internal_encoding"))mb_internal_encoding("8bit");function
connection(){global$h;return$h;}function
adminer(){global$b;return$b;}function
version(){global$ca;return$ca;}function
idf_unescape($t){$Cd=substr($t,-1);return
str_replace($Cd.$Cd,$Cd,substr($t,1,-1));}function
escape_string($X){return
substr(q($X),1,-1);}function
number($X){return
preg_replace('~[^0-9]+~','',$X);}function
number_type(){return'((?<!o)int(?!er)|numeric|real|float|double|decimal|money)';}function
remove_slashes($Te,$rc=false){if(function_exists("get_magic_quotes_gpc")&&get_magic_quotes_gpc()){while(list($x,$X)=each($Te)){foreach($X
as$td=>$W){unset($Te[$x][$td]);if(is_array($W)){$Te[$x][stripslashes($td)]=$W;$Te[]=&$Te[$x][stripslashes($td)];}else$Te[$x][stripslashes($td)]=($rc?$W:stripslashes($W));}}}}function
bracket_escape($t,$Ia=false){static$wg=array(':'=>':1',']'=>':2','['=>':3','"'=>':4');return
strtr($t,($Ia?array_flip($wg):$wg));}function
min_version($Xg,$Od="",$i=null){global$h;if(!$i)$i=$h;$Cf=$i->server_info;if($Od&&preg_match('~([\d.]+)-MariaDB~',$Cf,$_)){$Cf=$_[1];$Xg=$Od;}return(version_compare($Cf,$Xg)>=0);}function
charset($h){return(min_version("5.5.3",0,$h)?"utf8mb4":"utf8");}function
script($Lf,$vg="\n"){return"<script".nonce().">$Lf</script>$vg";}function
script_src($Pg){return"<script src='".h($Pg)."'".nonce()."></script>\n";}function
nonce(){return' nonce="'.get_nonce().'"';}function
target_blank(){return' target="_blank" rel="noreferrer noopener"';}function
h($Q){return
str_replace("\0","&#0;",htmlspecialchars($Q,ENT_QUOTES,'utf-8'));}function
nl_br($Q){return
str_replace("\n","<br>",$Q);}function
checkbox($A,$Y,$Xa,$zd="",$qe="",$bb="",$_d=""){$J="<input type='checkbox' name='$A' value='".h($Y)."'".($Xa?" checked":"").($_d?" aria-labelledby='$_d'":"").">".($qe?script("qsl('input').onclick = function () { $qe };",""):"");return($zd!=""||$bb?"<label".($bb?" class='$bb'":"").">$J".h($zd)."</label>":$J);}function
optionlist($B,$xf=null,$Tg=false){$J="";foreach($B
as$td=>$W){$ve=array($td=>$W);if(is_array($W)){$J.='<optgroup label="'.h($td).'">';$ve=$W;}foreach($ve
as$x=>$X)$J.='<option'.($Tg||is_string($x)?' value="'.h($x).'"':'').(($Tg||is_string($x)?(string)$x:$X)===$xf?' selected':'').'>'.h($X);if(is_array($W))$J.='</optgroup>';}return$J;}function
html_select($A,$B,$Y="",$pe=true,$_d=""){if($pe)return"<select name='".h($A)."'".($_d?" aria-labelledby='$_d'":"").">".optionlist($B,$Y)."</select>".(is_string($pe)?script("qsl('select').onchange = function () { $pe };",""):"");$J="";foreach($B
as$x=>$X)$J.="<label><input type='radio' name='".h($A)."' value='".h($x)."'".($x==$Y?" checked":"").">".h($X)."</label>";return$J;}function
select_input($Da,$B,$Y="",$pe="",$Ke=""){$eg=($B?"select":"input");return"<$eg$Da".($B?"><option value=''>$Ke".optionlist($B,$Y,true)."</select>":" size='10' value='".h($Y)."' placeholder='$Ke'>").($pe?script("qsl('$eg').onchange = $pe;",""):"");}function
confirm($Wd="",$yf="qsl('input')"){return
script("$yf.onclick = function () { return confirm('".($Wd?js_escape($Wd):lang(0))."'); };","");}function
print_fieldset($s,$Ed,$ah=false){echo"<fieldset><legend>","<a href='#fieldset-$s'>$Ed</a>",script("qsl('a').onclick = partial(toggle, 'fieldset-$s');",""),"</legend>","<div id='fieldset-$s'".($ah?"":" class='hidden'").">\n";}function
bold($Qa,$bb=""){return($Qa?" class='active $bb'":($bb?" class='$bb'":""));}function
odd($J=' class="odd"'){static$r=0;if(!$J)$r=-1;return($r++%2?$J:'');}function
js_escape($Q){return
addcslashes($Q,"\r\n'\\/");}function
json_row($x,$X=null){static$sc=true;if($sc)echo"{";if($x!=""){echo($sc?"":",")."\n\t\"".addcslashes($x,"\r\n\t\"\\/").'": '.($X!==null?'"'.addcslashes($X,"\r\n\"\\/").'"':'null');$sc=false;}else{echo"\n}\n";$sc=true;}}function
ini_bool($jd){$X=ini_get($jd);return(preg_match('~^(on|true|yes)$~i',$X)||(int)$X);}function
sid(){static$J;if($J===null)$J=(SID&&!($_COOKIE&&ini_bool("session.use_cookies")));return$J;}function
set_password($Wg,$O,$V,$F){$_SESSION["pwds"][$Wg][$O][$V]=($_COOKIE["adminer_key"]&&is_string($F)?array(encrypt_string($F,$_COOKIE["adminer_key"])):$F);}function
get_password(){$J=get_session("pwds");if(is_array($J))$J=($_COOKIE["adminer_key"]?decrypt_string($J[0],$_COOKIE["adminer_key"]):false);return$J;}function
q($Q){global$h;return$h->quote($Q);}function
get_vals($G,$e=0){global$h;$J=array();$I=$h->query($G);if(is_object($I)){while($K=$I->fetch_row())$J[]=$K[$e];}return$J;}function
get_key_vals($G,$i=null,$Ff=true){global$h;if(!is_object($i))$i=$h;$J=array();$I=$i->query($G);if(is_object($I)){while($K=$I->fetch_row()){if($Ff)$J[$K[0]]=$K[1];else$J[]=$K[0];}}return$J;}function
get_rows($G,$i=null,$o="<p class='error'>"){global$h;$mb=(is_object($i)?$i:$h);$J=array();$I=$mb->query($G);if(is_object($I)){while($K=$I->fetch_assoc())$J[]=$K;}elseif(!$I&&!is_object($i)&&$o&&defined("PAGE_HEADER"))echo$o.error()."\n";return$J;}function
unique_array($K,$v){foreach($v
as$u){if(preg_match("~PRIMARY|UNIQUE~",$u["type"])){$J=array();foreach($u["columns"]as$x){if(!isset($K[$x]))continue
2;$J[$x]=$K[$x];}return$J;}}}function
escape_key($x){if(preg_match('(^([\w(]+)('.str_replace("_",".*",preg_quote(idf_escape("_"))).')([ \w)]+)$)',$x,$_))return$_[1].idf_escape(idf_unescape($_[2])).$_[3];return
idf_escape($x);}function
where($Z,$q=array()){global$h,$w;$J=array();foreach((array)$Z["where"]as$x=>$X){$x=bracket_escape($x,1);$e=escape_key($x);$J[]=$e.($w=="sql"&&is_numeric($X)&&preg_match('~\.~',$X)?" LIKE ".q($X):($w=="mssql"?" LIKE ".q(preg_replace('~[_%[]~','[\0]',$X)):" = ".unconvert_field($q[$x],q($X))));if($w=="sql"&&preg_match('~char|text~',$q[$x]["type"])&&preg_match("~[^ -@]~",$X))$J[]="$e = ".q($X)." COLLATE ".charset($h)."_bin";}foreach((array)$Z["null"]as$x)$J[]=escape_key($x)." IS NULL";return
implode(" AND ",$J);}function
where_check($X,$q=array()){parse_str($X,$Va);remove_slashes(array(&$Va));return
where($Va,$q);}function
where_link($r,$e,$Y,$se="="){return"&where%5B$r%5D%5Bcol%5D=".urlencode($e)."&where%5B$r%5D%5Bop%5D=".urlencode(($Y!==null?$se:"IS NULL"))."&where%5B$r%5D%5Bval%5D=".urlencode($Y);}function
convert_fields($f,$q,$M=array()){$J="";foreach($f
as$x=>$X){if($M&&!in_array(idf_escape($x),$M))continue;$_a=convert_field($q[$x]);if($_a)$J.=", $_a AS ".idf_escape($x);}return$J;}function
cookie($A,$Y,$Hd=2592000){global$aa;return
header("Set-Cookie: $A=".urlencode($Y).($Hd?"; expires=".gmdate("D, d M Y H:i:s",time()+$Hd)." GMT":"")."; path=".preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]).($aa?"; secure":"")."; HttpOnly; SameSite=lax",false);}function
restart_session(){if(!ini_bool("session.use_cookies"))session_start();}function
stop_session($xc=false){$Sg=ini_bool("session.use_cookies");if(!$Sg||$xc){session_write_close();if($Sg&&@ini_set("session.use_cookies",false)===false)session_start();}}function&get_session($x){return$_SESSION[$x][DRIVER][SERVER][$_GET["username"]];}function
set_session($x,$X){$_SESSION[$x][DRIVER][SERVER][$_GET["username"]]=$X;}function
auth_url($Wg,$O,$V,$m=null){global$Jb;preg_match('~([^?]*)\??(.*)~',remove_from_uri(implode("|",array_keys($Jb))."|username|".($m!==null?"db|":"").session_name()),$_);return"$_[1]?".(sid()?SID."&":"").($Wg!="server"||$O!=""?urlencode($Wg)."=".urlencode($O)."&":"")."username=".urlencode($V).($m!=""?"&db=".urlencode($m):"").($_[2]?"&$_[2]":"");}function
is_ajax(){return($_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest");}function
redirect($Jd,$Wd=null){if($Wd!==null){restart_session();$_SESSION["messages"][preg_replace('~^[^?]*~','',($Jd!==null?$Jd:$_SERVER["REQUEST_URI"]))][]=$Wd;}if($Jd!==null){if($Jd=="")$Jd=".";header("Location: $Jd");exit;}}function
query_redirect($G,$Jd,$Wd,$df=true,$cc=true,$jc=false,$lg=""){global$h,$o,$b;if($cc){$Rf=microtime(true);$jc=!$h->query($G);$lg=format_time($Rf);}$Of="";if($G)$Of=$b->messageQuery($G,$lg,$jc);if($jc){$o=error().$Of.script("messagesPrint();");return
false;}if($df)redirect($Jd,$Wd.$Of);return
true;}function
queries($G){global$h;static$Xe=array();static$Rf;if(!$Rf)$Rf=microtime(true);if($G===null)return
array(implode("\n",$Xe),format_time($Rf));$Xe[]=(preg_match('~;$~',$G)?"DELIMITER ;;\n$G;\nDELIMITER ":$G).";";return$h->query($G);}function
apply_queries($G,$T,$Zb='table'){foreach($T
as$R){if(!queries("$G ".$Zb($R)))return
false;}return
true;}function
queries_redirect($Jd,$Wd,$df){list($Xe,$lg)=queries(null);return
query_redirect($Xe,$Jd,$Wd,$df,false,!$df,$lg);}function
format_time($Rf){return
lang(1,max(0,microtime(true)-$Rf));}function
relative_uri(){return
str_replace(":","%3a",preg_replace('~^[^?]*/([^?]*)~','\1',$_SERVER["REQUEST_URI"]));}function
remove_from_uri($Be=""){return
substr(preg_replace("~(?<=[?&])($Be".(SID?"":"|".session_name()).")=[^&]*&~",'',relative_uri()."&"),0,-1);}function
pagination($D,$wb){return" ".($D==$wb?$D+1:'<a href="'.h(remove_from_uri("page").($D?"&page=$D".($_GET["next"]?"&next=".urlencode($_GET["next"]):""):"")).'">'.($D+1)."</a>");}function
get_file($x,$_b=false){$oc=$_FILES[$x];if(!$oc)return
null;foreach($oc
as$x=>$X)$oc[$x]=(array)$X;$J='';foreach($oc["error"]as$x=>$o){if($o)return$o;$A=$oc["name"][$x];$sg=$oc["tmp_name"][$x];$pb=file_get_contents($_b&&preg_match('~\.gz$~',$A)?"compress.zlib://$sg":$sg);if($_b){$Rf=substr($pb,0,3);if(function_exists("iconv")&&preg_match("~^\xFE\xFF|^\xFF\xFE~",$Rf,$ef))$pb=iconv("utf-16","utf-8",$pb);elseif($Rf=="\xEF\xBB\xBF")$pb=substr($pb,3);$J.=$pb."\n\n";}else$J.=$pb;}return$J;}function
upload_error($o){$Td=($o==UPLOAD_ERR_INI_SIZE?ini_get("upload_max_filesize"):0);return($o?lang(2).($Td?" ".lang(3,$Td):""):lang(4));}function
repeat_pattern($He,$Fd){return
str_repeat("$He{0,65535}",$Fd/65535)."$He{0,".($Fd%65535)."}";}function
is_utf8($X){return(preg_match('~~u',$X)&&!preg_match('~[\0-\x8\xB\xC\xE-\x1F]~',$X));}function
shorten_utf8($Q,$Fd=80,$Yf=""){if(!preg_match("(^(".repeat_pattern("[\t\r\n -\x{10FFFF}]",$Fd).")($)?)u",$Q,$_))preg_match("(^(".repeat_pattern("[\t\r\n -~]",$Fd).")($)?)",$Q,$_);return
h($_[1]).$Yf.(isset($_[2])?"":"<i>â€¦</i>");}function
format_number($X){return
strtr(number_format($X,0,".",lang(5)),preg_split('~~u',lang(6),-1,PREG_SPLIT_NO_EMPTY));}function
friendly_url($X){return
preg_replace('~[^a-z0-9_]~i','-',$X);}function
hidden_fields($Te,$ad=array(),$Oe=''){$J=false;foreach($Te
as$x=>$X){if(!in_array($x,$ad)){if(is_array($X))hidden_fields($X,array(),$x);else{$J=true;echo'<input type="hidden" name="'.h($Oe?$Oe."[$x]":$x).'" value="'.h($X).'">';}}}return$J;}function
hidden_fields_get(){echo(sid()?'<input type="hidden" name="'.session_name().'" value="'.h(session_id()).'">':''),(SERVER!==null?'<input type="hidden" name="'.DRIVER.'" value="'.h(SERVER).'">':""),'<input type="hidden" name="username" value="'.h($_GET["username"]).'">';}function
table_status1($R,$kc=false){$J=table_status($R,$kc);return($J?$J:array("Name"=>$R));}function
column_foreign_keys($R){global$b;$J=array();foreach($b->foreignKeys($R)as$Ac){foreach($Ac["source"]as$X)$J[$X][]=$Ac;}return$J;}function
enum_input($U,$Da,$p,$Y,$Ub=null){global$b;preg_match_all("~'((?:[^']|'')*)'~",$p["length"],$Qd);$J=($Ub!==null?"<label><input type='$U'$Da value='$Ub'".((is_array($Y)?in_array($Ub,$Y):$Y===0)?" checked":"")."><i>".lang(7)."</i></label>":"");foreach($Qd[1]as$r=>$X){$X=stripcslashes(str_replace("''","'",$X));$Xa=(is_int($Y)?$Y==$r+1:(is_array($Y)?in_array($r+1,$Y):$Y===$X));$J.=" <label><input type='$U'$Da value='".($r+1)."'".($Xa?' checked':'').'>'.h($b->editVal($X,$p)).'</label>';}return$J;}function
input($p,$Y,$Gc){global$Fg,$b,$w;$A=h(bracket_escape($p["field"]));echo"<td class='function'>";if(is_array($Y)&&!$Gc){$ya=array($Y);if(version_compare(PHP_VERSION,5.4)>=0)$ya[]=JSON_PRETTY_PRINT;$Y=call_user_func_array('json_encode',$ya);$Gc="json";}$jf=($w=="mssql"&&$p["auto_increment"]);if($jf&&!$_POST["save"])$Gc=null;$Hc=(isset($_GET["select"])||$jf?array("orig"=>lang(8)):array())+$b->editFunctions($p);$Da=" name='fields[$A]'";if($p["type"]=="enum")echo
h($Hc[""])."<td>".$b->editInput($_GET["edit"],$p,$Da,$Y);else{$Oc=(in_array($Gc,$Hc)||isset($Hc[$Gc]));echo(count($Hc)>1?"<select name='function[$A]'>".optionlist($Hc,$Gc===null||$Oc?$Gc:"")."</select>".on_help("getTarget(event).value.replace(/^SQL\$/, '')",1).script("qsl('select').onchange = functionChange;",""):h(reset($Hc))).'<td>';$ld=$b->editInput($_GET["edit"],$p,$Da,$Y);if($ld!="")echo$ld;elseif(preg_match('~bool~',$p["type"]))echo"<input type='hidden'$Da value='0'>"."<input type='checkbox'".(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?" checked='checked'":"")."$Da value='1'>";elseif($p["type"]=="set"){preg_match_all("~'((?:[^']|'')*)'~",$p["length"],$Qd);foreach($Qd[1]as$r=>$X){$X=stripcslashes(str_replace("''","'",$X));$Xa=(is_int($Y)?($Y>>$r)&1:in_array($X,explode(",",$Y),true));echo" <label><input type='checkbox' name='fields[$A][$r]' value='".(1<<$r)."'".($Xa?' checked':'').">".h($b->editVal($X,$p)).'</label>';}}elseif(preg_match('~blob|bytea|raw|file~',$p["type"])&&ini_bool("file_uploads"))echo"<input type='file' name='fields-$A'>";elseif(($ig=preg_match('~text|lob|memo~i',$p["type"]))||preg_match("~\n~",$Y)){if($ig&&$w!="sqlite")$Da.=" cols='50' rows='12'";else{$L=min(12,substr_count($Y,"\n")+1);$Da.=" cols='30' rows='$L'".($L==1?" style='height: 1.2em;'":"");}echo"<textarea$Da>".h($Y).'</textarea>';}elseif($Gc=="json"||preg_match('~^jsonb?$~',$p["type"]))echo"<textarea$Da cols='50' rows='12' class='jush-js'>".h($Y).'</textarea>';else{$Vd=(!preg_match('~int~',$p["type"])&&preg_match('~^(\d+)(,(\d+))?$~',$p["length"],$_)?((preg_match("~binary~",$p["type"])?2:1)*$_[1]+($_[3]?1:0)+($_[2]&&!$p["unsigned"]?1:0)):($Fg[$p["type"]]?$Fg[$p["type"]]+($p["unsigned"]?0:1):0));if($w=='sql'&&min_version(5.6)&&preg_match('~time~',$p["type"]))$Vd+=7;echo"<input".((!$Oc||$Gc==="")&&preg_match('~(?<!o)int(?!er)~',$p["type"])&&!preg_match('~\[\]~',$p["full_type"])?" type='number'":"")." value='".h($Y)."'".($Vd?" data-maxlength='$Vd'":"").(preg_match('~char|binary~',$p["type"])&&$Vd>20?" size='40'":"")."$Da>";}echo$b->editHint($_GET["edit"],$p,$Y);$sc=0;foreach($Hc
as$x=>$X){if($x===""||!$X)break;$sc++;}if($sc)echo
script("mixin(qsl('td'), {onchange: partial(skipOriginal, $sc), oninput: function () { this.onchange(); }});");}}function
process_input($p){global$b,$n;$t=bracket_escape($p["field"]);$Gc=$_POST["function"][$t];$Y=$_POST["fields"][$t];if($p["type"]=="enum"){if($Y==-1)return
false;if($Y=="")return"NULL";return+$Y;}if($p["auto_increment"]&&$Y=="")return
null;if($Gc=="orig")return(preg_match('~^CURRENT_TIMESTAMP~i',$p["on_update"])?idf_escape($p["field"]):false);if($Gc=="NULL")return"NULL";if($p["type"]=="set")return
array_sum((array)$Y);if($Gc=="json"){$Gc="";$Y=json_decode($Y,true);if(!is_array($Y))return
false;return$Y;}if(preg_match('~blob|bytea|raw|file~',$p["type"])&&ini_bool("file_uploads")){$oc=get_file("fields-$t");if(!is_string($oc))return
false;return$n->quoteBinary($oc);}return$b->processInput($p,$Y,$Gc);}function
fields_from_edit(){global$n;$J=array();foreach((array)$_POST["field_keys"]as$x=>$X){if($X!=""){$X=bracket_escape($X);$_POST["function"][$X]=$_POST["field_funs"][$x];$_POST["fields"][$X]=$_POST["field_vals"][$x];}}foreach((array)$_POST["fields"]as$x=>$X){$A=bracket_escape($x,1);$J[$A]=array("field"=>$A,"privileges"=>array("insert"=>1,"update"=>1),"null"=>1,"auto_increment"=>($x==$n->primary),);}return$J;}function
search_tables(){global$b,$h;$_GET["where"][0]["val"]=$_POST["query"];$_f="<ul>\n";foreach(table_status('',true)as$R=>$S){$A=$b->tableName($S);if(isset($S["Engine"])&&$A!=""&&(!$_POST["tables"]||in_array($R,$_POST["tables"]))){$I=$h->query("SELECT".limit("1 FROM ".table($R)," WHERE ".implode(" AND ",$b->selectSearchProcess(fields($R),array())),1));if(!$I||$I->fetch_row()){$Re="<a href='".h(ME."select=".urlencode($R)."&where[0][op]=".urlencode($_GET["where"][0]["op"])."&where[0][val]=".urlencode($_GET["where"][0]["val"]))."'>$A</a>";echo"$_f<li>".($I?$Re:"<p class='error'>$Re: ".error())."\n";$_f="";}}}echo($_f?"<p class='message'>".lang(9):"</ul>")."\n";}function
dump_headers($Xc,$be=false){global$b;$J=$b->dumpHeaders($Xc,$be);$ze=$_POST["output"];if($ze!="text")header("Content-Disposition: attachment; filename=".$b->dumpFilename($Xc).".$J".($ze!="file"&&!preg_match('~[^0-9a-z]~',$ze)?".$ze":""));session_write_close();ob_flush();flush();return$J;}function
dump_csv($K){foreach($K
as$x=>$X){if(preg_match("~[\"\n,;\t]~",$X)||$X==="")$K[$x]='"'.str_replace('"','""',$X).'"';}echo
implode(($_POST["format"]=="csv"?",":($_POST["format"]=="tsv"?"\t":";")),$K)."\r\n";}function
apply_sql_function($Gc,$e){return($Gc?($Gc=="unixepoch"?"DATETIME($e, '$Gc')":($Gc=="count distinct"?"COUNT(DISTINCT ":strtoupper("$Gc("))."$e)"):$e);}function
get_temp_dir(){$J=ini_get("upload_tmp_dir");if(!$J){if(function_exists('sys_get_temp_dir'))$J=sys_get_temp_dir();else{$pc=@tempnam("","");if(!$pc)return
false;$J=dirname($pc);unlink($pc);}}return$J;}function
file_open_lock($pc){$Ec=@fopen($pc,"r+");if(!$Ec){$Ec=@fopen($pc,"w");if(!$Ec)return;chmod($pc,0660);}flock($Ec,LOCK_EX);return$Ec;}function
file_write_unlock($Ec,$xb){rewind($Ec);fwrite($Ec,$xb);ftruncate($Ec,strlen($xb));flock($Ec,LOCK_UN);fclose($Ec);}function
password_file($sb){$pc=get_temp_dir()."/adminer.key";$J=@file_get_contents($pc);if($J||!$sb)return$J;$Ec=@fopen($pc,"w");if($Ec){chmod($pc,0660);$J=rand_string();fwrite($Ec,$J);fclose($Ec);}return$J;}function
rand_string(){return
md5(uniqid(mt_rand(),true));}function
select_value($X,$z,$p,$jg){global$b;if(is_array($X)){$J="";foreach($X
as$td=>$W)$J.="<tr>".($X!=array_values($X)?"<th>".h($td):"")."<td>".select_value($W,$z,$p,$jg);return"<table cellspacing='0'>$J</table>";}if(!$z)$z=$b->selectLink($X,$p);if($z===null){if(is_mail($X))$z="mailto:$X";if(is_url($X))$z=$X;}$J=$b->editVal($X,$p);if($J!==null){if(!is_utf8($J))$J="\0";elseif($jg!=""&&is_shortable($p))$J=shorten_utf8($J,max(0,+$jg));else$J=h($J);}return$b->selectVal($J,$z,$p,$X);}function
is_mail($Rb){$Aa='[-a-z0-9!#$%&\'*+/=?^_`{|}~]';$Ib='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';$He="$Aa+(\\.$Aa+)*@($Ib?\\.)+$Ib";return
is_string($Rb)&&preg_match("(^$He(,\\s*$He)*\$)i",$Rb);}function
is_url($Q){$Ib='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';return
preg_match("~^(https?)://($Ib?\\.)+$Ib(:\\d+)?(/.*)?(\\?.*)?(#.*)?\$~i",$Q);}function
is_shortable($p){return
preg_match('~char|text|json|lob|geometry|point|linestring|polygon|string|bytea~',$p["type"]);}function
count_rows($R,$Z,$qd,$Ic){global$w;$G=" FROM ".table($R).($Z?" WHERE ".implode(" AND ",$Z):"");return($qd&&($w=="sql"||count($Ic)==1)?"SELECT COUNT(DISTINCT ".implode(", ",$Ic).")$G":"SELECT COUNT(*)".($qd?" FROM (SELECT 1$G GROUP BY ".implode(", ",$Ic).") x":$G));}function
slow_query($G){global$b,$ug,$n;$m=$b->database();$mg=$b->queryTimeout();$If=$n->slowQuery($G,$mg);if(!$If&&support("kill")&&is_object($i=connect())&&($m==""||$i->select_db($m))){$yd=$i->result(connection_id());echo'<script',nonce(),'>
var timeout = setTimeout(function () {
	ajax(\'',js_escape(ME),'script=kill\', function () {
	}, \'kill=',$yd,'&token=',$ug,'\');
}, ',1000*$mg,');
</script>
';}else$i=null;ob_flush();flush();$J=@get_key_vals(($If?$If:$G),$i,false);if($i){echo
script("clearTimeout(timeout);");ob_flush();flush();}return$J;}function
get_token(){$Ze=rand(1,1e6);return($Ze^$_SESSION["token"]).":$Ze";}function
verify_token(){list($ug,$Ze)=explode(":",$_POST["token"]);return($Ze^$_SESSION["token"])==$ug;}function
lzw_decompress($Na){$Gb=256;$Oa=8;$db=array();$lf=0;$mf=0;for($r=0;$r<strlen($Na);$r++){$lf=($lf<<8)+ord($Na[$r]);$mf+=8;if($mf>=$Oa){$mf-=$Oa;$db[]=$lf>>$mf;$lf&=(1<<$mf)-1;$Gb++;if($Gb>>$Oa)$Oa++;}}$Fb=range("\0","\xFF");$J="";foreach($db
as$r=>$cb){$Qb=$Fb[$cb];if(!isset($Qb))$Qb=$jh.$jh[0];$J.=$Qb;if($r)$Fb[]=$jh.$Qb[0];$jh=$Qb;}return$J;}function
on_help($ib,$Gf=0){return
script("mixin(qsl('select, input'), {onmouseover: function (event) { helpMouseover.call(this, event, $ib, $Gf) }, onmouseout: helpMouseout});","");}function
edit_form($a,$q,$K,$Ng){global$b,$w,$ug,$o;$cg=$b->tableName(table_status1($a,true));page_header(($Ng?lang(10):lang(11)),$o,array("select"=>array($a,$cg)),$cg);if($K===false)echo"<p class='error'>".lang(12)."\n";echo'<form action="" method="post" enctype="multipart/form-data" id="form">
';if(!$q)echo"<p class='error'>".lang(13)."\n";else{echo"<table cellspacing='0' class='layout'>".script("qsl('table').onkeydown = editingKeydown;");foreach($q
as$A=>$p){echo"<tr><th>".$b->fieldName($p);$Ab=$_GET["set"][bracket_escape($A)];if($Ab===null){$Ab=$p["default"];if($p["type"]=="bit"&&preg_match("~^b'([01]*)'\$~",$Ab,$ef))$Ab=$ef[1];}$Y=($K!==null?($K[$A]!=""&&$w=="sql"&&preg_match("~enum|set~",$p["type"])?(is_array($K[$A])?array_sum($K[$A]):+$K[$A]):$K[$A]):(!$Ng&&$p["auto_increment"]?"":(isset($_GET["select"])?false:$Ab)));if(!$_POST["save"]&&is_string($Y))$Y=$b->editVal($Y,$p);$Gc=($_POST["save"]?(string)$_POST["function"][$A]:($Ng&&preg_match('~^CURRENT_TIMESTAMP~i',$p["on_update"])?"now":($Y===false?null:($Y!==null?'':'NULL'))));if(preg_match("~time~",$p["type"])&&preg_match('~^CURRENT_TIMESTAMP~i',$Y)){$Y="";$Gc="now";}input($p,$Y,$Gc);echo"\n";}if(!support("table"))echo"<tr>"."<th><input name='field_keys[]'>".script("qsl('input').oninput = fieldChange;")."<td class='function'>".html_select("field_funs[]",$b->editFunctions(array("null"=>isset($_GET["select"]))))."<td><input name='field_vals[]'>"."\n";echo"</table>\n";}echo"<p>\n";if($q){echo"<input type='submit' value='".lang(14)."'>\n";if(!isset($_GET["select"])){echo"<input type='submit' name='insert' value='".($Ng?lang(15):lang(16))."' title='Ctrl+Shift+Enter'>\n",($Ng?script("qsl('input').onclick = function () { return !ajaxForm(this.form, '".lang(17)."â€¦', this); };"):"");}}echo($Ng?"<input type='submit' name='delete' value='".lang(18)."'>".confirm()."\n":($_POST||!$q?"":script("focus(qsa('td', qs('#form'))[1].firstChild);")));if(isset($_GET["select"]))hidden_fields(array("check"=>(array)$_POST["check"],"clone"=>$_POST["clone"],"all"=>$_POST["all"]));echo'<input type="hidden" name="referer" value="',h(isset($_POST["referer"])?$_POST["referer"]:$_SERVER["HTTP_REFERER"]),'">
<input type="hidden" name="save" value="1">
<input type="hidden" name="token" value="',$ug,'">
</form>
';}if(isset($_GET["file"])){if($_SERVER["HTTP_IF_MODIFIED_SINCE"]){header("HTTP/1.1 304 Not Modified");exit;}header("Expires: ".gmdate("D, d M Y H:i:s",time()+365*24*60*60)." GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: immutable");if($_GET["file"]=="favicon.ico"){header("Content-Type: image/x-icon");echo
lzw_decompress("\0\0\0` \0„\0\n @\0´C„è\"\0`EãQ¸àÿ‡?ÀtvM'”JdÁd\\Œb0\0Ä\"™ÀfÓˆ¤îs5›ÏçÑAXPaJ“0„¥‘8„#RŠT©‘z`ˆ#.©ÇcíXÃşÈ€?À-\0¡Im? .«M¶€\0È¯(Ì‰ıÀ/(%Œ\0");}elseif($_GET["file"]=="default.css"){header("Content-Type: text/css; charset=utf-8");echo
lzw_decompress("\n1Ì‡“ÙŒŞl7œ‡B1„4vb0˜Ífs‘¼ên2BÌÑ±Ù˜Şn:‡#(¼b.\rDc)ÈÈa7E„‘¤Âl¦Ã±”èi1Ìs˜´ç-4™‡fÓ	ÈÎi7†³¹¤Èt4…¦ÓyèZf4°i–AT«VVéf:Ï¦,:1¦Qİ¼ñb2`Ç#ş>:7Gï—1ÑØÒs°™L—XD*bv<ÜŒ#£e@Ö:4ç§!fo·Æt:<¥Üå’¾™oâÜ\niÃÅğ',é»a_¤:¹iï…´ÁBvø|Nû4.5Nfi¢vpĞh¸°l¨ê¡ÖšÜO¦‰î= £OFQĞÄk\$¥Óiõ™ÀÂd2Tã¡pàÊ6„‹ş‡¡-ØZ€ƒ Ş6½£€ğh:¬aÌ,£ëî2#8Ğ±#’˜6nâî†ñJˆ¢h«t…Œ±Šä4O42ô½okŞ¾*r ©€@p@†!Ä¾ÏÃôş?Ğ6À‰r[ğLÁğ‹:2Bˆj§!HbóÃPä=!1V‰\"ˆ²0…¿\nSÆÆÏD7ÃìDÚ›ÃC!†!›à¦GÊŒ§ È+’=tCæ©.C¤À:+ÈÊ=ªªº²¡±å%ªcí1MR/”EÈ’4„© 2°ä± ã`Â8(áÓ¹[WäÑ=‰ySb°=Ö-Ü¹BS+É¯ÈÜı¥ø@pL4Ydã„qŠøã¦ğê¢6£3Ä¬¯¸AcÜŒèÎ¨Œk‚[&>ö•¨ZÁpkm]—u-c:Ø¸ˆNtæÎ´pÒŒŠ8è=¿#˜á[.ğÜŞ¯~ mËy‡PPá|IÖ›ùÀìQª9v[–Q•„\n–Ùrô'g‡+áTÑ2…­VÁõzä4£8÷(	¾Ey*#j¬2]­•RÒÁ‘¥)ƒÀ[N­R\$Š<>:ó­>\$;–> Ì\r»„ÎHÍÃTÈ\nw¡N åwØ£¦ì<ïËGwàöö¹\\Yó_ Rt^Œ>\r}ŒÙS\rzé4=µ\nL”%Jã‹\",Z 8¸™i÷0u©?¨ûÑô¡s3#¨Ù‰ :ó¦ûã½–ÈŞE]xİÒs^8£K^É÷*0ÑŞwŞàÈŞ~ãö:íÑiØşv2w½ÿ±û^7ãò7£cİÑu+U%{PÜ*4Ì¼éLX./!¼‰1CÅßqx!H¹ãFdù­L¨¤¨Ä Ï`6ëè5®™f€¸Ä†¨=Høl ŒV1“›\0a2×;Ô6†àöş_Ù‡Ä\0&ôZÜS d)KE'’€nµ[X©³\0ZÉŠÔF[P‘Ş˜@àß!‰ñYÂ,`É\"Ú·Â0Ee9yF>ËÔ9bº–ŒæF5:üˆ”\0}Ä´Š‡(\$Ó‡ë€37Hö£è M¾A°²6R•ú{Mqİ7G ÚC™Cêm2¢(ŒCt>[ì-tÀ/&C›]êetGôÌ¬4@r>ÇÂå<šSq•/åú”QëhmšÀĞÆôãôLÀÜ#èôKË|®™„6fKPİ\r%tÔÓV=\" SH\$} ¸)w¡,W\0F³ªu@Øb¦9‚\rr°2Ã#¬DŒ”Xƒ³ÚyOIù>»…n†Ç¢%ãù'‹İ_Á€t\rÏ„zÄ\\1˜hl¼]Q5Mp6k†ĞÄqhÃ\$£H~Í|Òİ!*4ŒñòÛ`Sëı²S tíPP\\g±è7‡\n-Š:è¢ªp´•”ˆl‹B¦î”7Ó¨cƒ(wO0\\:•Ğw”Áp4ˆ“ò{TÚújO¤6HÃŠ¶rÕ¥q\n¦É%%¶y']\$‚”a‘ZÓ.fcÕq*-êFWºúk„zƒ°µj‘°lgáŒ:‡\$\"ŞN¼\r#ÉdâÃ‚ÂÿĞscá¬Ì „ƒ\"jª\rÀ¶–¦ˆÕ’¼Ph‹1/‚œDA) ²İ[ÀknÁp76ÁY´‰R{áM¤Pû°ò@\n-¸a·6şß[»zJH,–dl B£ho³ìò¬+‡#Dr^µ^µÙeš¼E½½– ÄœaP‰ôõJG£zàñtñ 2ÇXÙ¢´Á¿V¶×ßàŞÈ³‰ÑB_%K=E©¸bå¼¾ßÂ§kU(.!Ü®8¸œüÉI.@KÍxnş¬ü:ÃPó32«”míH		C*ì:vâTÅ\nR¹ƒ•µ‹0uÂíƒæîÒ§]Î¯˜Š”P/µJQd¥{L–Ş³:YÁ2b¼œT ñÊ3Ó4†—äcê¥V=¿†L4ÎĞrÄ!ßBğY³6Í­MeLŠªÜçœöùiÀoĞ9< G”¤Æ•Ğ™Mhm^¯UÛNÀŒ·òTr5HiM”/¬nƒí³T [-<__î3/Xr(<‡¯Š†®Éô“ÌuÒ–GNX20å\r\$^‡:'9è¶O…í;×k¼†µf –N'a¶”Ç­bÅ,ËV¤ô…«1µïHI!%6@úÏ\$ÒEGÚœ¬1(mUªå…rÕ½ïßå`¡ĞiN+Ãœñ)šœä0lØÒf0Ã½[UâøVÊè-:I^ ˜\$Øs«b\re‡‘ugÉhª~9Ûßˆb˜µôÂÈfä+0¬Ô hXrİ¬©!\$—e,±w+„÷ŒëŒ3†Ì_âA…kšù\nkÃrõÊ›cuWdYÿ\\×={.óÄ˜¢g»‰p8œt\rRZ¿vJ:²>ş£Y|+Å@À‡ƒÛCt\r€jt½6²ğ%Â?àôÇñ’>ù/¥ÍÇğÎ9F`×•äòv~K¤áöÑRĞW‹ğz‘êlmªwLÇ9Y•*q¬xÄzñèSe®İ›³è÷£~šDàÍá–÷x˜¾ëÉŸi7•2ÄøÑOİ»’û_{ñú53âút˜›_ŸõzÔ3ùd)‹C¯Â\$?KÓªP%ÏÏT&ş˜&\0P×NA^­~¢ƒ pÆ öÏœ“Ôõ\r\$ŞïĞÖìb*+D6ê¶¦ÏˆŞíJ\$(ÈolŞÍh&”ìKBS>¸‹ö;z¶¦xÅoz>íœÚoÄZğ\nÊ‹[Ïvõ‚ËÈœµ°2õOxÙVø0fû€ú¯Ş2BlÉbkĞ6ZkµhXcdê0*ÂKTâ¯H=­•Ï€‘p0ŠlVéõèâ\r¼Œ¥nm¦ï)( ú");}elseif($_GET["file"]=="functions.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("f:›ŒgCI¼Ü\n8œÅ3)°Ë7œ…†81ĞÊx:\nOg#)Ğêr7\n\"†è´`ø|2ÌgSi–H)N¦S‘ä§\r‡\"0¹Ä@ä)Ÿ`(\$s6O!ÓèœV/=Œ' T4æ=„˜iS˜6IO G#ÒX·VCÆs¡ Z1.Ğhp8,³[¦Häµ~Cz§Éå2¹l¾c3šÍés£‘ÙI†bâ4\néF8Tà†I˜İ©U*fz¹är0EÆÀØy¸ñfY.:æƒIŒÊ(Øc·áÎ‹!_l™í^·^(¶šN{S–“)rËqÁY“–lÙ¦3Š3Ú\n˜+G¥Óêyºí†Ëi¶ÂîxV3w³uhã^rØÀº´aÛ”ú¹cØè\r“¨ë(.ÂˆºChÒ<\r)èÑ£¡`æ7£íò43'm5Œ£È\nPÜ:2£P»ª‹q òÿÅC“}Ä«ˆúÊÁê38‹BØ0hR‰Èr(œ0¥¡b\\0ŒHr44ŒÁB!¡pÇ\$rZZË2Ü‰.Éƒ(\\5Ã|\nC(Î\"€P…ğø.ĞNÌRTÊÎ“Àæ>HN…8HPá\\¬7Jp~„Üû2%¡ĞOC¨1ã.ƒ§C8Î‡HÈò*ˆj°…á÷S(¹/¡ì¬6KUœÊ‡¡<2‰pOI„ôÕ`Ôäâ³ˆdOH Ş5-üÆ4ŒãpX25-Ò¢òÛˆ°z7£¸\"(°P \\32:]UÚèíâß…!]¸<·AÛÛ¤’ĞßiÚ°‹l\rÔ\0v²Î#J8«ÏwmíÉ¤¨<ŠÉ æü%m;p#ã`XDŒø÷iZøN0Œ•È9ø¨å Áè`…wJD¿¾2Ò9tŒ¢*øÎyìËNiIh\\9ÆÕèĞ:ƒ€æáxï­µyl*šÈˆÎæY Ü‡øê8’W³â?µŞ›3ÙğÊ!\"6å›n[¬Ê\r­*\$¶Æ§¾nzxÆ9\rì|*3×£pŞï»¶:(p\\;ÔËmz¢ü§9óĞÑÂŒü8N…Áj2½«Î\rÉHîH&Œ²(Ãz„Á7iÛk£ ‹Š¤‚c¤‹eòı§tœÌÌ2:SHóÈ Ã/)–xŞ@éåt‰ri9¥½õëœ8ÏÀËïyÒ·½°VÄ+^WÚ¦­¬kZæY—l·Ê£Œ4ÖÈÆ‹ª¶À¬‚ğ\\EÈ{î7\0¹p†€•D€„i”-TæşÚû0l°%=Á ĞËƒ9(„5ğ\n\n€n,4‡\0èa}Üƒ.°öRsï‚ª\02B\\Ûb1ŸS±\0003,ÔXPHJspåd“Kƒ CA!°2*WŸÔñÚ2\$ä+Âf^\n„1Œ´òzEƒ Iv¤\\äœ2É .*A°™”E(d±á°ÃbêÂÜ„Æ9‡‚â€ÁDh&­ª?ÄH°sQ˜2’x~nÃJ‹T2ù&ãàeRœ½™GÒQTwêİ‘»õPˆâã\\ )6¦ôâœÂòsh\\3¨\0R	À'\r+*;RğHà.“!Ñ[Í'~­%t< çpÜK#Â‘æ!ñlßÌğLeŒ³œÙ,ÄÀ®&á\$	Á½`”–CXš‰Ó†0Ö­å¼û³Ä:Méh	çÚœGäÑ!&3 D<!è23„Ã?h¤J©e Úğhá\r¡m•˜ğNi¸£´’†ÊNØHl7¡®v‚êWIå.´Á-Ó5Ö§ey\rEJ\ni*¼\$@ÚRU0,\$U¿E†¦ÔÔÂªu)@(tÎSJkáp!€~­‚àd`Ì>¯•\nÃ;#\rp9†jÉ¹Ü]&Nc(r€ˆ•TQUª½S·Ú\08n`«—y•b¤ÅLÜO5‚î,¤ò‘>‚†xââ±fä´’âØ+–\"ÑI€{kMÈ[\r%Æ[	¤eôaÔ1! èÿí³Ô®©F@«b)RŸ£72ˆî0¡\nW¨™±L²ÜœÒ®tdÕ+íÜ0wglø0n@òêÉ¢ÕiíM«ƒ\nA§M5nì\$E³×±NÛál©İŸ×ì%ª1 AÜûºú÷İkñrîiFB÷Ïùol,muNx-Í_ Ö¤C( fél\r1p[9x(i´BÒ–²ÛzQlüº8CÔ	´©XU Tb£İIİ`•p+V\0î‹Ñ;‹CbÎÀXñ+Ï’sïü]H÷Ò[ák‹x¬G*ô†]·awnú!Å6‚òâÛĞmSí¾“IŞÍKË~/Ó¥7ŞùeeNÉòªS«/;dåA†>}l~Ïê ¨%^´fçØ¢pÚœDEîÃa·‚t\nx=ÃkĞ„*dºêğT—ºüûj2ŸÉjœ\n‘ É ,˜e=‘†M84ôûÔa•j@îTÃsÔänf©İ\nî6ª\rdœ¼0ŞíôYŠ'%Ô“íŞ~	Ò¨†<ÖË–Aî‹–H¿G‚8ñ¿Îƒ\$z«ğ{¶»²u2*†àa–À>»(wŒK.bP‚{…ƒoı”Â´«zµ#ë2ö8=É8>ª¤³A,°e°À…+ìCè§xõ*ÃáÒ-b=m‡™Ÿ,‹a’Ãlzkï\$Wõ,mJiæÊ§á÷+‹èı0°[¯ÿ.RÊsKùÇäXçİZLËç2`Ì(ïCàvZ¡ÜİÀ¶è\$×¹,åD?H±ÖNxXôó)’îM¨‰\$ó,Í*\nÑ£\$<qÿÅŸh!¿¹S“âƒÀŸxsA!˜:´K¥Á}Á²“ù¬£œRşšA2k·Xp\n<÷ş¦ıëlì§Ù3¯ø¦È•VV¬}£g&Yİ!†+ó;<¸YÇóŸYE3r³Ùñ›Cío5¦Åù¢Õ³Ïkkş…ø°ÖÛ£«Ït÷’Uø…­)û[ıßÁî}ïØu´«lç¢:DŸø+Ï _oãäh140ÖáÊ0ø¯bäK˜ã¬’ öşé»lGª„#ªš©ê†¦©ì|Udæ¶IK«êÂ7à^ìà¸@º®O\0HÅğHiŠ6\r‡Û©Ü\\cg\0öãë2BÄ*eà\n€š	…zr!nWz& {H–ğ'\$X  w@Ò8ëDGr*ëÄİHå'p#Ä®€¦Ô\ndü€÷,ô¥—,ü;g~¯\0Ğ#€Ì²EÂ\rÖI`œî'ƒğ%EÒ. ]`ÊĞ›…î%&Ğîm°ı\râŞ%4S„vğ#\n fH\$%ë-Â#­ÆÑqBâíæ ÀÂQ-ôc2Š§‚&ÂÀÌ]à™ èqh\rñl]à®s ĞÑhä7±n#±‚‚Ú-àjE¯Frç¤l&dÀØÙåzìF6¸ˆÁ\" “|¿§¢s@ß±®åz)0rpÚ\0‚X\0¤Ùè|DL<!°ôo„*‡D¶{.B<Eª‹‹0nB(ï |\r\nì^©à h³!‚Öêr\$§’(^ª~èŞÂ/pq²ÌB¨ÅOšˆğú,\\µ¨#RRÎ%ëäÍdĞHjÄ`Â ô®Ì­ Vå bS’d§iE‚øïoh´r<i/k\$-Ÿ\$o”¼+ÆÅ‹ÎúlÒŞO³&evÆ’¼iÒjMPA'u'Î’( M(h/+«òWD¾So·.n·.ğn¸ìê(œ(\"­À§hö&p†¨/Ë/1DÌŠçjå¨¸EèŞ&â¦€,'l\$/.,Äd¨…‚W€bbO3óB³sH :J`!“.€ª‚‡Àû¥ ,FÀÑ7(‡ÈÔ¿³û1Šlås ÖÒ‘²—Å¢q¢X\rÀš®ƒ~Ré°±`®Òó®Y*ä:R¨ùrJ´·%LÏ+n¸\"ˆø\r¦ÎÍ‡H!qb¾2âLi±%ÓŞÎ¨Wj#9ÓÔObE.I:…6Á7\0Ë6+¤%°.È…Ş³a7E8VSå?(DG¨Ó³Bë%;ò¬ùÔ/<’´ú¥À\r ì´>ûMÀ°@¶¾€H DsĞ°Z[tH£Enx(ğŒ©R xñû@¯şGkjW”>ÌÂÚ#T/8®c8éQ0Ëè_ÔIIGII’!¥ğŠYEdËE´^tdéthÂ`DV!Cæ8¥\r­´Ÿb“3©!3â@Ù33N}âZBó3	Ï3ä30ÚÜM(ê>‚Ê}ä\\Ñtê‚f fŒËâI\r®€ó337 XÔ\"tdÎ,\nbtNO`Pâ;­Ü•Ò­ÀÔ¯\$\n‚ßäZÑ­5U5WUµ^hoıàætÙPM/5K4Ej³KQ&53GX“Xx)Ò<5D…\rûVô\nßr¢5bÜ€\\J\">§è1S\r[-¦ÊDuÀ\rÒâ§Ã)00óYõÈË¢·k{\nµÄ#µŞ\r³^·‹|èuÜ»Uå_nïU4ÉUŠ~YtÓ\rIšÃ@ä³™R ó3:ÒuePMSè0TµwW¯XÈòòD¨ò¤KOUÜà•‡;Uõ\n OYéYÍQ,M[\0÷_ªDšÍÈW ¾J*ì\rg(]à¨\r\"ZC‰©6uê+µYóˆY6Ã´0ªqõ(Ùó8}ó3AX3T h9j¶jàfõMtåPJbqMP5>ğÈø¶©Y‡k%&\\‚1d¢ØE4À µYnÊí\$<¥U]Ó‰1‰mbÖ¶^Òõš ê\"NVéßp¶ëpõ±eMÚŞ×WéÜ¢î\\ä)\n Ë\nf7\n×2´õr8‹—=Ek7tVš‡µ7P¦¶LÉía6òòv@'‚6iàïj&>±â;­ã`Òÿa	\0pÚ¨(µJÑë)«\\¿ªnûòÄ¬m\0¼¨2€ôeqJö­PôtŒë±fjüÂ\"[\0¨·†¢X,<\\Œî¶×â÷æ·+md†å~âàš…Ñs%o°´mn×),×„æÔ‡²\r4¶Â8\r±Î¸×mE‚H]‚¦˜üÖHW­M0Dïß€—å~Ë˜K˜îE}ø¸´à|fØ^“Ü×\r>Ô-z]2s‚xD˜d[s‡tS¢¶\0Qf-K`­¢‚tàØ„wT¯9€æZ€à	ø\nB£9 Nb–ã<ÚBşI5o×oJñpÀÏJNdåË\rhŞÃ2\"àxæHCàİ–:øı9Yn16Æôzr+z±ùş\\’÷•œôm Ş±T öò ÷@Y2lQ<2O+¥%“Í.Óƒhù0AŞñ¸ŠÃZ‹2R¦À1£Š/¯hH\r¨X…ÈaNB&§ ÄM@Ö[xŒ‡Ê®¥ê–â8&LÚVÍœvà±*šj¤ÛšGHåÈ\\Ù®	™²¶&sÛ\0Qš \\\"èb °	àÄ\rBs›Éw‚	ÙáBN`š7§Co(ÙÃà¨\nÃ¨“¨1š9Ì*E˜ ñS…ÓU0Uº tš'|”m™°Ş?h[¢\$.#É5	 å	p„àyBà@Rô]£…ê@|„§{™ÀÊP\0xô/¦ w¢%¤EsBd¿§šCUš~O×·àPà@Xâ]Ô…¨Z3¨¥1¦¥{©eLY‰¡ŒÚ¢\\’(*R` 	à¦\n…ŠàºÌQCFÈ*¹¹àéœ¬Úp†X|`N¨‚¾\$€[†‰’@ÍU¢àğ¦¶àZ¥`Zd\"\\\"…‚¢£)«‡Iˆ:ètšìoDæ\0[²¨à±‚-©“ gí³‰™®*`hu%£,€”¬ãIµ7Ä«²Hóµm¤6Ş}®ºNÖÍ³\$»MµUYf&1ùÀ›e]pz¥§ÚI¤Åm¶G/£ ºw Ü!•\\#5¥4I¥d¹EÂhq€å¦÷Ñ¬kçx|Úk¥qDšb…z?§º‰>úƒ¾:†“[èLÒÆ¬Z°Xš®:¹„·ÚÇjßw5	¶Y¾0 ©Â“­¯\$\0C¢†dSg¸ë‚ {@”\n`	ÀÃüC ¢·»Mºµâ»²# t}xÎN„÷º‡{ºÛ°)êûCƒÊFKZŞj™Â\0PFY”BäpFk–›0<Ú>ÊD<JE™šg\rõ.“2–ü8éU@*Î5fkªÌJDìÈÉ4•TDU76É/´è¯@·‚K+„ÃöJ®ºÃÂí@Ó=ŒÜWIOD³85MšNº\$Rô\0ø5¨\ràù_ğªœìEœñÏI«Ï³Nçl£Òåy\\ô‘ˆÇqU€ĞQû ª\n@’¨€ÛºÃpš¬¨PÛ±«7Ô½N\rıR{*qmİ\$\0R”×Ô“ŠÅåqĞÃˆ+U@ŞB¤çOf*†CË¬ºMCä`_ èüò½ËµNêæTâ5Ù¦C×»© ¸à\\WÃe&_XŒ_Øhå—ÂÆBœ3ÀŒÛ%ÜFW£û|™GŞ›'Å[¯Å‚À°ÙÕV Ğ#^\rç¦GR€¾˜€P±İFg¢ûî¯ÀYi û¥Çz\nâ¨Ş+ß^/“¨€‚¼¥½\\•6èßb¼dmh×â@qíÕAhÖ),J­×W–Çcm÷em]ÓeÏkZb0ßåşYñ]ymŠè‡fØe¹B;¹ÓêOÉÀwŸapDWûŒÉÜÓ{›\0˜À-2/bN¬sÖ½Ş¾Ra“Ï®h&qt\n\"ÕiöRmühzÏeø†àÜFS7µĞPPòä–¤âÜ:B§ˆâÕsm¶­Y düŞò7}3?*‚túòéÏlTÚ}˜~€„€ä=cı¬ÖŞÇ	Ú3…;T²LŞ5*	ñ~#µA•¾ƒ‘sx-7÷f5`Ø#\"NÓb÷¯G˜Ÿ‹õ@Üeü[ïø¤Ìs‘˜€¸-§˜M6§£qqš h€e5…\0Ò¢À±ú*àbøISÜÉÜFÎ®9}ıpÓ-øı`{ı±É–kP˜0T<„©Z9ä0<Õš\r­€;!Ãˆgº\r\nKÔ\n•‡\0Á°*½\nb7(À_¸@,îe2\rÀ]–K…+\0Éÿp C\\Ñ¢,0¬^îMĞ§šº©“@Š;X\r•ğ?\$\r‡j’+ö/´¬BöæP ½‰ù¨J{\"aÍ6˜ä‰œ¹|å£\n\0»à\\5“Ğ	156ÿ† .İ[ÂUØ¯\0dè²8Yç:!Ñ²‘=ºÀX.²uCªŠŒö!Sº¸‡o…pÓBİüÛ7¸­Å¯¡Rh­\\h‹E=úy:< :u³ó2µ80“si¦ŸTsBÛ@\$ Íé@Çu	ÈQº¦.ô‚T0M\\/ê€d+Æƒ\n‘¡=Ô°dŒÅëA¢¸¢)\r@@Âh3€–Ù8.eZa|.â7YkĞcÀ˜ñ–'D#‡¨Yò@Xq–=M¡ï44šB AM¤¯dU\"‹Hw4î(>‚¬8¨²ÃC¸?e_`ĞÅX:ÄA9Ã¸™ôp«GĞä‡Gy6½ÃF“Xr‰¡l÷1¡½Ø»B¢Ã…9Rz©õhB„{€™\0ëå^‚Ã-â0©%Dœ5F\"\"àÚÜÊÂ™úiÄ`ËÙnAf¨ \"tDZ\"_àV\$Ÿª!/…D€áš†ğ¿µ‹´ˆÙ¦¡Ì€F,25Éj›Tëá—y\0…N¼x\rçYl¦#‘ÆEq\nÍÈB2œ\nìà6·…Ä4Ó×”!/Â\nóƒ‰Q¸½*®;)bR¸Z0\0ÄCDoŒË48À•´µ‡Ğe‘\nã¦S%\\úPIk‡(0ÁŒu/™‹G²Æ¹ŠŒ¼\\Ë} 4Fp‘Gû_÷G?)gÈotº[vÖ\0°¸?bÀ;ªË`(•ÛŒà¶NS)\nãx=èĞ+@êÜ7ƒjú0—,ğ1Ã…z™“­>0ˆ‰GcğãL…VXôƒ±ÛğÊ%À…Á„Q+øéoÆFõÈéÜ¶Ğ>Q-ãc‘ÚÇl‰¡³¤wàÌz5G‘ê‚@(h‘cÓHõÇr?ˆšNbş@É¨öÇø°îlx3‹U`„rwª©ÔUÃÔôtØ8Ô=Àl#òõlÿä¨‰8¥E\"Œƒ˜™O6\n˜Â1e£`\\hKf—V/Ğ·PaYKçOÌı éàx‘	‰Oj„ór7¥F;´êB»‘ê£íÌ’‡¼>æĞ¦²V\rÄ–Ä|©'Jµz«¼š”#’PBä’Y5\0NC¤^\n~LrR’Ô[ÌŸRÃ¬ñgÀeZ\0x›^»i<Qã/)Ó%@Ê’™fB²HfÊ{%Pà\"\"½ø@ªş)ò’‘“DE(iM2‚S’*ƒyòSÁ\"âñÊeÌ’1Œ«×˜\n4`Ê©>¦Q*¦Üy°n”’¥TäuÔâä”Ñ~%+W²XK‹Œ£Q¡[Ê”àlPYy#DÙ¬D<«FLú³Õ@Á6']Æ‹‡û\rFÄ`±!•%\n0cĞôÀË©%c8WrpGƒ.TœDo¾UL2Ø*é|\$¬:èœr˜½@æñè&Ò4‹HŠ> ‘ %0*ŒZc(@Ü]óÌQ:*¬“â(&\"x'JO³1¹º`>7	#Ù\"O4PXü±”|B4»é‰[Ê˜éÙ˜\$nïˆ1`ôêGSAõÖËAH» \"†)ğà©ãS¨ûf”É¦Áº-\"ËWú+É–º\0s-[”foÙ§ÍD«ğxóæ¸õ¾=Cš.õ“9³­ÎfïÀcÁ\0Â‹7¡?Ã“95´Ö¦ZÇ0­îfì­¨àøëH?R'q>oÚÊ@aDŸùG[;G´D¹BBdÄ¡—q –¥2¤|1¹ìq™²äÀÎå²w<Ü#ª§EY½^š§ ­Q\\ë[XñåèÅ>?vï[ ‡æŠIÉÍÑ „™œÌg\0Ç)´…®g…uŒĞg42jÃº'óTä„‹Ívy,u’ÛD†=pH\\ƒ”^bäìqØ„ÄitÃÅğX…À£FPÉ@Pú¥TŠ¾i2#°g€—Dá®™ñ%9™@‚");}elseif($_GET["file"]=="jush.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress('');}else{header("Content-Type: image/gif");switch($_GET["file"]){case"plus.gif":echo'';break;case"cross.gif":echo'';break;case"up.gif":echo'';break;case"down.gif":echo'';break;case"arrow.gif":echo'';break;}}exit;}if($_GET["script"]=="version"){$Ec=file_open_lock(get_temp_dir()."/adminer.version");if($Ec)file_write_unlock($Ec,serialize(array("signature"=>$_POST["signature"],"version"=>$_POST["version"])));exit;}global$b,$h,$n,$Jb,$Ob,$Wb,$o,$Hc,$Lc,$aa,$kd,$w,$ba,$Bd,$oe,$Je,$Vf,$Pc,$ug,$yg,$Fg,$Mg,$ca;if(!$_SERVER["REQUEST_URI"])$_SERVER["REQUEST_URI"]=$_SERVER["ORIG_PATH_INFO"];if(!strpos($_SERVER["REQUEST_URI"],'?')&&$_SERVER["QUERY_STRING"]!="")$_SERVER["REQUEST_URI"].="?$_SERVER[QUERY_STRING]";if($_SERVER["HTTP_X_FORWARDED_PREFIX"])$_SERVER["REQUEST_URI"]=$_SERVER["HTTP_X_FORWARDED_PREFIX"].$_SERVER["REQUEST_URI"];$aa=($_SERVER["HTTPS"]&&strcasecmp($_SERVER["HTTPS"],"off"))||ini_bool("session.cookie_secure");@ini_set("session.use_trans_sid",false);if(!defined("SID")){session_cache_limiter("");session_name("adminer_sid");$E=array(0,preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]),"",$aa);if(version_compare(PHP_VERSION,'5.2.0')>=0)$E[]=true;call_user_func_array('session_set_cookie_params',$E);session_start();}remove_slashes(array(&$_GET,&$_POST,&$_COOKIE),$rc);if(function_exists("get_magic_quotes_runtime")&&get_magic_quotes_runtime())set_magic_quotes_runtime(false);@set_time_limit(0);@ini_set("zend.ze1_compatibility_mode",false);@ini_set("precision",15);$Bd=array('en'=>'English','ar'=>'Ø§Ù„Ø¹Ø±Ø¨ÙŠØ©','bg'=>'Ğ‘ÑŠĞ»Ğ³Ğ°Ñ€ÑĞºĞ¸','bn'=>'à¦¬à¦¾à¦‚à¦²à¦¾','bs'=>'Bosanski','ca'=>'CatalÃ ','cs'=>'ÄŒeÅ¡tina','da'=>'Dansk','de'=>'Deutsch','el'=>'Î•Î»Î»Î·Î½Î¹ÎºÎ¬','es'=>'EspaÃ±ol','et'=>'Eesti','fa'=>'ÙØ§Ø±Ø³ÛŒ','fi'=>'Suomi','fr'=>'FranÃ§ais','gl'=>'Galego','he'=>'×¢×‘×¨×™×ª','hu'=>'Magyar','id'=>'Bahasa Indonesia','it'=>'Italiano','ja'=>'æ—¥æœ¬èª','ka'=>'áƒ¥áƒáƒ áƒ—áƒ£áƒšáƒ˜','ko'=>'í•œêµ­ì–´','lt'=>'LietuviÅ³','ms'=>'Bahasa Melayu','nl'=>'Nederlands','no'=>'Norsk','pl'=>'Polski','pt'=>'PortuguÃªs','pt-br'=>'PortuguÃªs (Brazil)','ro'=>'Limba RomÃ¢nÄƒ','ru'=>'Ğ ÑƒÑÑĞºĞ¸Ğ¹','sk'=>'SlovenÄina','sl'=>'Slovenski','sr'=>'Ğ¡Ñ€Ğ¿ÑĞºĞ¸','sv'=>'Svenska','ta'=>'à®¤â€Œà®®à®¿à®´à¯','th'=>'à¸ à¸²à¸©à¸²à¹„à¸—à¸¢','tr'=>'TÃ¼rkÃ§e','uk'=>'Ğ£ĞºÑ€Ğ°Ñ—Ğ½ÑÑŒĞºĞ°','vi'=>'Tiáº¿ng Viá»‡t','zh'=>'ç®€ä½“ä¸­æ–‡','zh-tw'=>'ç¹é«”ä¸­æ–‡',);function
get_lang(){global$ba;return$ba;}function
lang($t,$ke=null){if(is_string($t)){$Me=array_search($t,get_translations("en"));if($Me!==false)$t=$Me;}global$ba,$yg;$xg=($yg[$t]?$yg[$t]:$t);if(is_array($xg)){$Me=($ke==1?0:($ba=='cs'||$ba=='sk'?($ke&&$ke<5?1:2):($ba=='fr'?(!$ke?0:1):($ba=='pl'?($ke%10>1&&$ke%10<5&&$ke/10%10!=1?1:2):($ba=='sl'?($ke%100==1?0:($ke%100==2?1:($ke%100==3||$ke%100==4?2:3))):($ba=='lt'?($ke%10==1&&$ke%100!=11?0:($ke%10>1&&$ke/10%10!=1?1:2)):($ba=='bs'||$ba=='ru'||$ba=='sr'||$ba=='uk'?($ke%10==1&&$ke%100!=11?0:($ke%10>1&&$ke%10<5&&$ke/10%10!=1?1:2)):1)))))));$xg=$xg[$Me];}$ya=func_get_args();array_shift($ya);$Cc=str_replace("%d","%s",$xg);if($Cc!=$xg)$ya[0]=format_number($ke);return
vsprintf($Cc,$ya);}function
switch_lang(){global$ba,$Bd;echo"<form action='' method='post'>\n<div id='lang'>",lang(19).": ".html_select("lang",$Bd,$ba,"this.form.submit();")," <input type='submit' value='".lang(20)."' class='hidden'>\n","<input type='hidden' name='token' value='".get_token()."'>\n";echo"</div>\n</form>\n";}if(isset($_POST["lang"])&&verify_token()){cookie("adminer_lang",$_POST["lang"]);$_SESSION["lang"]=$_POST["lang"];$_SESSION["translations"]=array();redirect(remove_from_uri());}$ba="en";if(isset($Bd[$_COOKIE["adminer_lang"]])){cookie("adminer_lang",$_COOKIE["adminer_lang"]);$ba=$_COOKIE["adminer_lang"];}elseif(isset($Bd[$_SESSION["lang"]]))$ba=$_SESSION["lang"];else{$qa=array();preg_match_all('~([-a-z]+)(;q=([0-9.]+))?~',str_replace("_","-",strtolower($_SERVER["HTTP_ACCEPT_LANGUAGE"])),$Qd,PREG_SET_ORDER);foreach($Qd
as$_)$qa[$_[1]]=(isset($_[3])?$_[3]:1);arsort($qa);foreach($qa
as$x=>$We){if(isset($Bd[$x])){$ba=$x;break;}$x=preg_replace('~-.*~','',$x);if(!isset($qa[$x])&&isset($Bd[$x])){$ba=$x;break;}}}$yg=$_SESSION["translations"];if($_SESSION["translations_version"]!=1443184115){$yg=array();$_SESSION["translations_version"]=1443184115;}function
get_translations($Ad){switch($Ad){case"en":$g="A9D“yÔ@s:ÀGà¡(¸ffƒ‚Š¦ã	ˆÙ:ÄS°Şa2\"1¦..L'ƒI´êm‘#Çs,†KƒšOP#IÌ@%9¥i4Èo2ÏÆó €Ë,9%ÀPÀb2£a¸àr\n2›NCÈ(Şr4™Í1C`(:Ebç9AÈi:‰&ã™”åy·ˆFó½ĞY‚ˆ\r´\n– 8ZÔS=\$Aœ†¤`Ñ=ËÜŒ²‚0Ê\nÒãdFé	ŒŞn:ZÎ°)­ãQ¦ÕÈmwÛø€İO¼êmfpQËÎ‚‰†qœêaÊÄ¯±#q®–w7SX3” ‰œŠ˜o¢\n>Z—M„ziÃÄs;ÙÌ’‚„_Å:øõğ#|@è46ƒÃ:¾\r-z| (j*œ¨Œ0¦:-hæé/Ì¸ò8)+r^1/Ğ›¾Î·,ºZÓˆKXÂ9,¢pÊ:>#Öã(Ş6ÅqCŠ´Iú|³©È¢,(y ¸,	%b{K²ğ³Âƒ’)BƒßŒPŞµ\rÒªü6¹’2šK‹pÊ;„ÂÂ†\$#òÎ!,Û7Ã#Ì2¥A b„œøµ,N1\0S˜<ğÔ=RZÛ#b×Ğ(½%&…³LÌÚÔ£Ô2Òâè¸Ğ‘£a	Šr4³9)ÔÈÂ“1OAHÈ<ÄN)ËY\$ÉóÕWÊúØ%¸\$	Ğš&‡B˜¦cÍ¬<‹´ÈÚŒ’Í[K)¬Úâ\rƒÄÄïàÌ3\r‹[G@Lhå-è*ò*\rèÔÀ7(Úø:Œc’9ŒÃ¨ØLØXËÅ	ÏY»+Z~­“;^_Õ!‚àøJù…Âë¡ˆM.ÍaŠÃ«:Ã/c°Ãv¤\"¦)Ì¸Ş5ÈÁpAVµŒ¼\0’,é†NµÉ2İìƒàç‚`É@¨Åº©ğÍ?.@ Œ™bı…µĞ É\n‡‰Ğ€ŒÁèD4Tã€æáxï¹…É¼î¬ã8_#ê:)IÁxDoÌã†ã|Ò`p+²§J2ahíñäXv ”%JŒ*÷iòÄÈòyöÊÅmVØ:mÛ†åºn×vğ9o[ä‹#ğ!€	+/UœG£ş7¤,ÄÁM/l¿0ÙŸÇiSÙâ¿*l9´O˜© C\r%êé6íÃ–®9F‰Â33£–™iù-â_+ÿ¡ C˜Â\0criˆ4³3`]¸sqÅ¸ı¤#üĞÏIë/äÔ\0ZH‚€\nI\$LÈ“\"PÍy¿|g5\$e ¤A©¤¥ÂbLÉ©(f,Ì4šØl (l0Ï‚FÏse/ñ”‡\\d¹ò\n\$4¨GŠZ[b·3Ä1†ò»ÉQ,%ÄÁ–†Ô8üì70P’œpÈOŠ{&°æ\nŸcÆZà—HÀˆB]É	çWMÿšM™Q\$Šy­µ×dÿÈc#ÇB“ãÜeZ’ùVå¦\n„ğ¦!àgÁHš°·(KŠB~Qà€Ÿx˜[	%9ÁÉÃóÈä•!±1¤ ÄhºvHá\$ŠM†v~Ba\$AFL‘„`©aº,O\\¼H´f®—‰~‡Ft˜²|±O!ÇEpä½MÅk7Ã*¹#‹Šr™¸fôZW&ì¿×¼¬TİVÓ÷†isUëÍ,+ÜOÅ×?ŞğCB°É(ªÒÙ\$lÈ68Z^@iËô¼ ’pK¤SÛbAT*`Zé®.ç4”+š'Œà%°Ê€Rã	A\$éb3N	½â&LÁ}\\0¸£òSFhØ\nlaÍÃ†¥ l–¥ğ°ròOµLe®ˆ<ª¿d¨ ¢†Í¤Ì:1—aKD‚§¥c£TŠˆ\n\ná 7“‚B*l0F€ÒõY8”‘5Aôš!‘z§‡A(­Zb]E.o|ÑU\no^¤A~_¥=R2è(ÂZ¼Vd´k8ìñ!´\0¸";break;case"ar":$g="ÙC¶P‚Â²†l*„\r”,&\nÙA¶í„ø(J.™„0Se\\¶\r…ŒbÙ@¶0´,\nQ,l)ÅÀ¦Âµ°¬†Aòéj_1CĞM…«e€¢S™\ng@ŸOgë¨ô’XÙDMë)˜°0Œ†cA¨Øn8Çe*y#au4¡ ´Ir*;rSÁUµdJ	}‰ÎÑ*zªU@¦ŠX;ai1l(nóÕòıÃ[Óy™dŞu'c(€ÜoF“±¤Øe3™Nb¦ êp2NšS¡ Ó³:LZúz¶PØ\\bæ¼uÄ.•[¶Q`u	!Š­Jyµˆ&2¶(gTÍÔSÑšMÆxì5g5¸K®K¦Â¦àØ÷á—0Ê€(ª7\rm8î7(ä9\rã’f\"7NÂ9´£ ŞÙ4Ãxè¶ã„xæ;Á#\"¸¿…Š´¥2É°W\"J\nî¦¬Bê'hkÀÅ«b¦Diâ\\@ªêÊp¬•êyf ­’9ÊÚV¨?‘TXW¡‰¡FÃÇ{â¹3)\"ªW9Ï|Á¨eRhU±¬Òªû1ÆÁPˆ>¨ê„\"o{ì\"7î^¥¶pL\n7OM*˜OÔÊ<7cpæ4ôRflN°SJ²‚›DÅ‹ï#Åô³ğ‡Jrª >³J­ÓHsŞœ:îšã•ÊÃ°ÃUlK¦‰Ö,nÈR„*hı¡ª¬›ºÈ’,2 …B€ÌÃËd4àPH…á gj†)¥”›kR<ñ‘Jº\"É£\r/hùPš&ÒÓ¨RØ‘3ÂûÅ—K!TÕöRN•ó°Æ'ÈÏYI«²ƒËx:²[IÏl~È!U9H>ª}á=ëÌœßën2)vF<ê1êäQa@	¢ht)Š`PÔ5ãhÚ‹ct0‹µúÚ[_Óz?rb\0Pä:\r€S<Ğ#“J7ŒÃ0Øõ¹4VÈJ•õT­U·ôX“È@P¨7µhÂ7!\0ëE£ÆÙc0ê6`Ş3½C˜XÚ[HÂ3Œ/PAÁ¶@Úõ­ØP9…*zN†–A\0†)ŠB2ª#é*ˆê¡uL†ÄÒaŒ*ô’„¿‹dLT¦Z	+ëê3Všæ@êv2’Æ¯«g;±4Pf3OÃ­õ„ÉÃĞ6ö1Ñ´XÉàÂĞéÃ0z\r è8aĞ^ÿ(\\0ùz¤ŒáxÊ7ğ•\0:QŸ€D~MÓÔ3‡xÂ˜±˜ %‚ä†ÀŒ*â…’–À]zX/J}V;u^®„&a5›°äjPò K!C‡\0ÒÓ‘Õzá¡ì½·º÷ßã|¡İó¾—šúÃ“í}ï¹D>õ£Ax\")€ø\$†ĞàkÃkïõÿ§ÀAMèoYÖ'†ÖiCJ@Í™æ†àèSÏÙ>:âÊ’“ö×Lh¸EĞ ±’LÂ h4¡„1¿E¹®nˆÒ‡ñ”IY„3Aä0Û›ƒrnÙ¼ HòoM¤r#a†\$‚\0Ç\n\"Pi!°9£ÔlKñn*¤•…\"uŒ¿Ïâ7k@Ô†€àçÑiû0d5ÖJ'2e1d (!¨×›_Ù´5¨Öã`VBhæÌß¡T/&Û°w™=¡—ôWN^QE„«É´»(,7®ĞëophŞÅ€ÜL h}Çƒ|ÃDO\r!î‚ù\$M(c/ª—v(¿Hs½+bÊBBDèB¯ Å¢”särÔŠºsÒŒ­#5^Iã4O„Ì\$‘ ògÁ\0d\r+ Ó¡t ¢™¾6m88‡Sd…Ã2\r¯&=IÚvBFf¡Ób£ÈlaVD6l\0Â¡\"3U×,CFÔŠYEíHÆ\"ˆA	±8S¨’¤’ég+yÏ«+\$l\"ª[%ÑR'^ZDâP·Ñ]o-³aÒ…\0í( HÛ·gĞ¸bŸ`€)…˜4Æµë„`¨,E0pq\r¸:qNˆÚ4ˆ)©Òl,	ú¯XlX»5:~´(6­aZÛJŒšò&ëúÚHÀ‹h³M6²XPò‚ëÜp¤Ì!‡@ä]A\r!Œ5¨DõÃ´›¦Ó\n'Å Ò›LY&aÉ×Œ…çû‚\n¡P#ĞpŸŞ…*=v¸)õín—ë… ‡¼[×²:³9#sE±z×¬PLA6ï^75ëiæ%I!Š#¥Ì–²›\$Wt²…¸ GU**ĞDBÒæ‘M\\Ïä»	¾Ã†Ô„Ph\nÆo¡ı“BŠJg\n[.jÅÌ§GËíÈ\\xq8ß¢ç	!ç¦¾:Ì„˜§ÅvXX—(¢—Q‘k‚ÚF\"®×…^`\nº&˜'5D¯”M°Ä¶É€ ";break;case"bg":$g="ĞP´\r›EÑ@4°!Awh Z(&‚Ô~\n‹†faÌĞNÅ`Ñ‚şDˆ…4ĞÕü\"Ğ]4\r;Ae2”­a°µ€¢„œ.aÂèúrpº’@×“ˆ|.W.X4òå«FPµ”Ìâ“Ø\$ªhRàsÉÜÊ}@¨Ğ—pÙĞ”æB¢4”sE²Î¢7fŠ&EŠ, Ói•X\nFC1 Ôl7còØMEo)_G×ÒèÎ_<‡GÓ­}†Íœ,kë†ŠqPX”}F³+9¤¬7i†£Zè´šiíQ¡³_a·–—ZŠË*¨n^¹ÉÕS¦Ü9¾ÿ£YŸVÚ¨~³]ĞX\\Ró‰6±õÔ}±jâ}	¬lê4v±ø=ˆè†3	´\0ù@D|ÜÂ¤‰³[€’ª’^]#ğs.Õ3d\0*ÃXÜ7ãp@2CŞ9(‚ Â:#Â9Œ¡\0È7Œ£˜Aˆèê8\\z8Fc˜ïŒ‹ŠŒä—m XúÂÉ4™;¦rÔ'HS†˜¹2Ë6A>éÂ¦”6Ëÿ5	êÜ¸®kJ¾®&êªj½\"Kºüª°Ùß9‰{.äÎ-Ê^ä:‰*U?Š+*>SÁ3z>J&SKêŸ&©›ŞhR‰»’Ö&³:ŠãÉ’>I¬J–ªLãHƒHç‘ªÜEq8İZVÑÕs[Œ£Àè2Ã˜Ò7Ø«ŠùÎ­j¶/ËhŠC¨ù?CÕ´KTÖQ	¡k¦hL¦X7&‰\n¯=¨ÕpƒK*Âi¼Y-Šú±UËD02!­RÒ‰!-ùE_êÚ>ı#ğ˜H…¡ g††¨ùD¾	\"±x´\$Ò©SŠ£è:Úºw£Ğ8°JóÊn¸6ú¼˜²Ğ–@\"…£hÂ4ˆù<‰âKŸkB9¢i3Yğl¢¨/©Ä'%”Š–•ÑJª¯(2ì¥+n©ÁvÙ%úÒ\\Ë4ü’éšã^bÊíÈhR8th(Äææ€” P¶®³Ûèº´Åç\0Ùİ9““šJšs¾²cîõD6ƒ•˜'ÓÌ¼ŸÍò²ebÚïiJÎäğ¤ûÄ!øºT†©nÓ=ª8	“jÉKì¯>h§në!¬FãÉıÅ Ë‹÷ÊŞÎ8A¨4ËF­ëÖÿN¦i§Z¯uëÏeCv³:ä÷0'xí÷å§ƒğxx+¾“xé'Såy‹´ƒ÷Sê±*¼¸ş.ŸL‰ú\\ÊI˜‰!¤Å&ˆâhˆj×|ğ¦’%¥Û;Z:\n°è¹„:nÓÚMåAïšƒ´§‹Š5hXïAF¨^ˆ;³\$æ`¢@ĞQ\n:Êä:¬`ÜÁ\0A´4†äP“ÃÈXÁ‘\0xA\0hA”3ĞD tÌğ^âÀ.0î¢€\\ŠÃ8/X€½«°è±Ãp/@ú2¢øzÁà/ ùeôÊÙlk	`Şñ`İa^ƒO›¾ò§ÖÂ„\nÌ“rx¥—[ÿMîô‘'8ôNP[ù6dòDx“âlOŠ1N*Åx³áä>E‘‚1F•‚°Ö,hE¸:ªUÄqo-hLğ«f?DøG–SätÙ{ÅPÆm<™³JBäâÖ]„ÅJÑ£ÉàbÅ\$ˆ-“†jé\r˜pTÛ•3ğUšAéP¹†ÇÖ@ ìğ6\0ÄC‚(†aÈ6†UøC2ÃHø1†4rÃ0u¡°7†x{<ƒHt\r\0‚‰#Ug?A\0c‰q7FpÂ™Ì8g=0™iĞ™]S04H\\¯9tÁ2Øø´sª”ï-Ã¢@P¤¨=ş¨”Îi\0(-À¤¼És@yZ;]A\rdCéßè oÀ9ìÏ(gŸÕM!#¥dÃz=£ô0;Ïçí&T¶j)|ã-¸ø“PQ1vçè”¦xZB5«ñ 9¤J(}°¸8T†‘R8r_Ü4ÇDáàgŠÙØ Æa¨eIFÑ§©Oæ)ã’Bæµ¯i –ZÓ÷@E]ÍÔ–]DzO0iÄÕ´x([i	õØAW,ÖA•6¦¬ğ¦'Ä¥Wy½+–¤©C˜¹*	Ö5\nz\\@ôÒ…±{[.(óT2Òîj»(*å½2¢ûÊtuÎ­Æ×S^CI\nìz–İïµVÄx/lĞxidR|í¥HNo[˜8\$a Ñ¾i§¢q %RÒ|(¥yRßGtˆIhÄÖ›%—_l \naD&rèZÉ¡Æà€#Jt'Ù%å-)MWtÚNú_r®tÁ9û¼4«ï_öH§k}Û[…Ç ´\$Í‘aZ^QP}3dÇ“Íª·´Pms§vÇ‰Œ~«ízä,ŸKò4èK7Iƒ=˜šóÌQ¹9‹äVÉ—f\nš,½­¶°†äC`+/§L˜¯¾½.Ñ^(E:í&›£0=¡kJ©¤aÔÙ‰Í<Ş4³ƒHÄè¨TÀ´@9¦™YK4(@ãEû”R†4PìW›q{œWæ­lÂÇ;¶k=u¦»Ùí»IÑziƒˆ2ú,–K®yçM-q¹©²|­¿‘ |L!îÆj<‹†Ø¢k¡ü÷}¬È'ú‰Ğ\"×GígàEpÁ^‡\rÆ8Êé~´²T—åÅ¶d¤r­¶\rqÍ\$øğ=şÊ…\nˆ»‹9·ãTûÍ›hŒzô&°TàÊih³t5ş<ãwe¢ÖÄ|Mó“Oõ³*B¥\"25ôÒµ—6bLQ¶œ	Â¯s·Ñ‹h]Ü:ĞJEâ‹@Ù/6Té¶®ûÚåqÆ2ó";break;case"bn":$g="àS)\nt]\0_ˆ 	XD)L¨„@Ğ4l5€ÁBQpÌÌ 9‚ \n¸ú\0‡€,¡ÈhªSEÀ0èb™a%‡. ÑH¶\0¬‡.bÓÅ2n‡‡DÒe*’D¦M¨ŠÉ,OJÃ°„v§˜©”Ñ…\$:IK“Êg5U4¡Lœ	Nd!u>Ï&¶ËÔöå„Òa\\­@'Jx¬ÉS¤Ñí4ĞP²D§±©êêzê¦.SÉõE<ùOS«éékbÊOÌafêhb\0§Bïğør¦ª)—öªå²QŒÁWğ²ëE‹{K§ÔPP~Í9\\§ël*‹_W	ãŞ7ôâÉ¼ê 4NÆQ¸Ş 8'cI°Êg2œÄO9Ôàd0<‡CA§ä:#Üº¸%3–©5Š!n€nJµmk”Åü©,qŸÁî«@á­‹œ(n+Lİ9ˆx£¡ÎkŠIÁĞ2ÁL\0I¡Î#VÜ¦ì#`¬æ¬‡B›Ä4Ã:Ğ ª,X‘¶í2À§§Î,(_)ìã7*¬\n£pÖóãp@2CŞ9.¢#ó\0Œ#›È2\rï‹Ê7‰ì8Móèá:c¼Ş2@LŠÚ ÜS6Ê\\4ÙGÊ‚\0Û/n:&Ú.Ht½·Ä¼/­”0˜¸2î´”ÉTgPEtÌ¥LÕ,L5HÁ§­ÄLŒ¶G«ãjß%±ŒÒR±t¹ºÈÁ-IÔ04=XK¶\$Gf·Jzº·R\$a`(„ªçÙ+b0ÖÈˆÿ@/râùMóXİv¼”íãNŒ£Ãô7cHß~Q(L¬\$±Œ>–Ä(]x€WË}ÁYT¶ºğW5b£oôH¢*|NKÕ…DJ”ª®3 !ØşCmGêõh·e4“Ú5¶Z@£c%=kàHKC-¹´9r/ˆóA l¦ ´mœ¢N)ò\"‘J:k^H¶[qŠñ#¯\né‘	Û‘JW7D]ív¾c°­Êğ‹É\0EïK	«ërÜY)ù-dÖö­Ñ™“ö4S—BVaŠ¸¥ÙgèrÜĞpKPP€dtN_…1ÊÙË8»2ƒoÖJ5hRgÚòSs•bUÏ”İ£Ñô¸G+°&YM·¶ıs¶§ÑÍ\$\$	Ğš&‡B˜¦pÚcW´5ª~ÃKìMÑºh;¼mGÇ»8Ø:@SºïŒ#“È7ŒÃ0Ù&´J£Ò²ÍHÇ\0%‚™†¸Ğ¨Ï8m!¸<‚\0ê¿¨cgÄ9†`ê\0l\rá&0X|Ã”\r!œ0¤ÀA	œÈmIÔı€æ\nTI[T\"œD`@Â˜RË\rE¸ƒzSK2¯R¢¸•¾Tféú/\n¥•\nhVš•8…tÂED@ÔÁnxÑ,§CÂ™f^!Õ~¤Ğ@C\$*\rÉ²†5ş¿C\"l\0ğ0äè\"\rĞ:\0æx/òÒş‚oà¼2†à^˜t_Ò8é ~R`g€¼0ƒçômÔÛe6ìEÚ¼4TˆHqVBİá<GZQàüˆÄÙ”ÀgŸAJ\$@ÆÔê~ƒ‘èPŠ93¥òKòQÎ:†ˆïcÜ}òA‡y!ã\\‰R.FÈÅõ#Wêÿàˆ¹à’Cî\r²4:I¹:»Áë?½IâCYä\r*	6@¨Ö«#-Ên\\Îù3%eåEÈ †bÛĞ¹«ÑhÊ¤¾lŒd^<„1É%ş¹íƒˆòÙƒ”ëgA„3Lı ¤ƒj&ªB˜h<Ì0Î°@æTì\r!„65tŸ:¡¥F,©¦ÀøÑÑ6gP(€ ´ĞÁ…¡LÄ²¨ÖØjj× €€'z)!xci²a?TYNkş5ÑÙ2|Ï9é=g´÷†Vt t>Gù=§Ú‰ƒ½~Q&yİÄ‚ğÅâÃ0¢†.\0ª4ü¡9ò¡ÍAÁ8Nšäú\rÁÂL æ¡T= ?¡Œ4OÒãØ ¤”äò0ÃÉO†Eu(šÂˆªäA]	ZÉ­\"ThCv*Åa!‘EÔ‘\0†L	˜ĞÓW2Á!Î†-¨të.t-µ1„ TÈ\\ğC†¸€\nUÍÕ—Pü§’>Nğ ¥dúƒtõ?§Éùê|SèfMÁ¶3ÍˆåhSPcƒIÚœØE|JÈJ% ÙAL/\0P	áL*ì<^Ô\\ÄÅ²¶ TCP£15&Âù!›ÁB_-êQå(³³@³U•c8íÌ¢ÎïaÆR·ÀìK”®ûéüÓ¤7È`AC¯L(„À@«à =‘Ô#J¯ÙĞi\nàœHaãN)˜¸Æ‚ÍŒ1!É@€<h‚¬‘=ŠìWºüè@3³5(„=K*ĞL½o»(S-	wt3AÎ¶GE)]”h1h×6S(´.	­uz_>İâœæT¹\rÓZ#Nœñ§İ2•5oûYWX^0\no°6¼\$Ck~:‡j‰ëÄñ¤3@Ùö]B6a\r±‘>Û8LB F áyFëö“K®°RÉK-‚î5§hÕÍ°…B4”¹º:VÈèS¶ìVñ@¬nøï¿¼ÜÓj3‡|_-÷¥¶®)õ„Ü³\\Ü¢u-ãT*üòÖÅ42Æİ§µj–ºmZY¶ØöQÒáåñI„±'IóİOwÇ] Ğ†¶â:¿Dk&(¢ŠˆŠV‚U¤`L®‘t\nÀÆª §ÌªÎƒjoNéÌui\r&X®IffÔ,½ÛrH‘·üÍo.2ƒ.JŠµœ^/øãÙ7x´d’Ou¯Ü¤Â¥c§ÍÔQ…*</·©í7·(7X«.*^¹È,-_©ñ3oåû§z¡ÈÄšñ}ãÑ‹ÇHÒš¤˜\0";break;case"bs":$g="D0ˆ\r†‘Ìèe‚šLçS‘¸Ò?	EÃ34S6MÆ¨AÂt7ÁÍpˆtp@u9œ¦Ãx¸N0šÆV\"d7Æódpİ™ÀØˆÓLüAH¡a)Ì….€RL¦¸	ºp7Áæ£L¸X\nFC1 Ôl7AG‘„ôn7‚ç(UÂlŒ§¡ĞÂb•˜eÄ“Ñ´Ó>4‚Š¦Ó)Òy½ˆFYÁÛ\n,›Î¢A†f ¸-†“±¤Øe3™NwÓ|œáH„\r]øÅ§—Ì43®XÕİ£w³ÏA!“D‰–6eào7ÜY>9‚àqÃ\$ÑĞİiMÆpVÅtb¨q\$«Ù¤Ö\n%Üö‡LITÜk¸ÍÂ)Èä¹ªúş0hèŞÕ4	\n\n:\nÀä:4P æ;®c\"\\&§ƒHÚ\ro’4 á¸xÈĞ@‹ó,ª\nl©E‰šjÑ+)¸—\nŠšøCÈr†5 ¢°Ò¯/û~¨°Ú;.ˆã¼®Èjâ&²f)|0B8Ê7±ƒ¤›,¢şÓÅ­Zæş'íº¦Ä£”Êş8Ü9#|æ—	› *²f!\"Ò81âè9ÇÄl:âÉâbr¢ª€P¡/²ÀP¨¶J3F53ÒÀœ7²È,UF„±8Ä˜€MBTcRıSTU%9,#ÀR¬¨\\u¸b—QìjÚ3ËLÖŒã\"9G.nbc,­¨pÇ,#XÆÃË\"şş±\"(ØFJü	ã\"_%ƒµº%ƒÓ(\rïJî®\"1<:Å‰]¸¬[ÊZ®¬£+ğ]VFƒ•è„^ÖéClÚ°í#ã-ÿSŞw­·ƒD)6~¥ Pæ0ÜB@	¢ht)Š`PÉ\r£h\\-9hò.°cÕ®ºFŠBF\r’ó0Í'ŒÃ2«7/êf9\\53I\ríhÚ)<æ:ŒcT9ŒÃ¨Ø\rã:Š9…‹èå¨Œ6Šâ¿u;7¨8P9…)pœ2²Ò³¼‚b˜¤#C‘5¹GßŒ;)_k‚vË˜Ú:¥ÂªR2½*4ML2ÑÃ:ûµ|LÜ”(£8@ Œ›[û°Œs´èîÍÁâ42c0z\r è8aĞ^ıÈ]tC\\¹Œá{œ§	ûé;á}â£üèxŒ!ò\\+7r\nÕZ‘=\rhÎÃK¹8GNc\"lRşÂ#œ'\nÎ€ÒÉÂÁTÎu½cÙö½¿r;÷}\nŠ]ørx/2§œ@\") ø\$†ĞàiÌ`n=è¦ôº1¬\r<‘œT Jƒ“O*ĞI—6‰Ck]¤ÕB°‘é\rfm™=tèG±!ãŸ°îišÙ€4GõÍÄNC1MÌ%ªµv²ÖÉc^‡È€4ĞĞBÙŒøãè]Ã™./Eğœ€Â£Bs‚#ÇîÂøb•ÈtU\n (tL€‘a%@Ä¢\\Ó±V‡v\r3JiÍJò.aĞÕ›D„¹,æQ¹7Gª/ò'Dñ‡)(®Ïäq%0ííŸ³e)Cƒm}/¬9\"pîlÃU0ÁØªƒcâØa%u^´óÒsÔŒéÑ§†Âª4v“dôç˜ªV	é‚`¡³zw•\"kŒ'”Š‡–xJ'.A†äNl¤q“!ÔÕ!\0ÌĞÛ w±Z`2Xb´\r–^2‚{ˆ P	áL*3Xğ·ÁmD\$x‚Â\"¸ˆa|x8¤\r#\"lªˆBLEÀƒ7ĞÜˆQ‡iÔ«wŞTÏ¡ŸEÌìÍ¬óöƒ	cgª …\0¦Bcˆ4Ôd4Œ#©Dèi!@â'ƒ×MÜ©òIƒHz<éˆŸÔÓ<‹*…pG>ª‘zœ›É4£—õuSœ€íV!ÒV!¼&Y ë	gµ¨º,Ö[Ôù\$Ò^µ¬Ö2Òğlot÷\"€AFåBÖ¨cœã\0PF§pl”!„ÙÂ¨TÀ´&‡K8.TïÂ`Ívì˜z'~ˆÍÚi1UXğUö”™Úv2ÜàÜ*(ä¨³0Ê†Í±+§”Â“ã çÙ\rP¬ï´š8blm[1'ÅAŸK^á¥¼«DøÍ©Ê2“L¥Š+¦(¡¢2†ÃRí4¿(Ğ«yQPa\rµyf¥†/FÔÀ\nilÉ]†rG×ı–ÄÊeV«2<äh¸„Ja[\rù„'aèÅa5Î¯¤¼.áÒ™»‚FZz’Zäd#(«ÀPA®˜@¾†à";break;case"ca":$g="E9j˜€æe3NCğP”\\33AD“iÀŞs9šLFÃ(€Âd5MÇC	È@e6Æ“¡àÊr‰†´Òdš`gƒI¶hp—›L§9¡’Q*–K¤Ì5LŒ œÈS,¦W-—ˆ\rÆù<òe4&\"ÀPÀb2£a¸àr\n1e€£yÈÒg4›Œ&ÀQ:¸h4ˆ\rC„à ’M†¡’Xa‰› ç+âûÀàÄ\\>RñÊLK&ó®ÂvÖÄ±ØÓ3ĞñÃ©Âpt0Y\$lË1\"Pò ƒ„ådøé\$ŒÄš`o9>UÃ^yÅ==äÎ\n)ínÔ+OoŸŠ§M|°õ*›u³¹ºNr9]xé†ƒ{d­ˆ3j‹P(àÿcºê2&\"›: £ƒ:…\0êö\rrh‘(¨ê8‚Œ£ÃpÉ\r#{\$¨j¢¬¤«#Ri*úÂ˜ˆhû´¡B Ò8BDÂƒªJ4²ãhÄÊn{øè°K« !/28,\$£Ã #Œ¯@Ê:.Îj0·Ñ`@º¤ëÔÊ¨Ìé4ÙÄèÌU¦Pê¿&ˆ®bë\$À ç#.ÀP‡Ló´<²HÜ4ŒcJhÅ Ê2a–o\$4ÒZ‚0ÎĞèË´©@Ê¡9Á(ÈCËpÔÕEU1â¶¨^u¸cA%ì(š20ØƒÃzR6\rƒxÆ	ã’Œ½&FZ›SâÇFÒ”²9kÅ6…üµ\r·0e•e¸ P‚Œ¨«qu\$	9B(Ü×2˜NÍ;WÄVŒk«)q£ÉsQp}0oµûG_õ>pH59\\·<è’²@	¢ht)Š`PÈ2ãhÚ‹c\\0‹¶Öy¯Pu&“\0Ñ´©*:7ŒÃ4;NÂ){]\0Nz‡€ÔîÈ\nƒz¸Ÿ\rÃÌ4É¶½\$31A’¼2PÌÁ«#8Â¼¸ÏµZ›\rĞØÊaJc¨nĞ@!Šb´È;ˆåšÆw½“(ã2ê6±R;¥ÅTêyLâl¦Ÿ¹á£ZÅ\$Ğ£¼#&Ø—Ã:b2£\$Áâh42ƒ0z\r è8aĞ^ıÈ\\ôi‚ê3…îĞ_\0¯OdT„A÷ˆş;Áà^0‡ÉŠgH£ÁfÓ+£€Ò9?›ëÂm4gÓº»	¯óp“AhÄg{>ØËÀuL[×ö=ŸkÛ÷#¿vè‹É/Îıà†ç‚‰Òr€Àˆ¨ƒâ(…•yÏA3#tÕ8tja…ºœd¦Ôé#Gì,:PÏa	0%\09¡PACb~HOR'@¨èa`Ëts^JC…p¡*pÂŸZkDa®,pŞØ!é,\r\"`ÂPŒÙ”Yç°½§DraÓ„	zÆ\\Á“a¡š#+©ÅnP \rè!'”b\n\n\nˆ)@Ô‹(³|‹=¸3›3VkMy~f¬º‡B\nJĞo@¥íd‡wæ\"ÑÚQ±u¾7âo\r¡Á”8Äš4Èëh7R¤7\$ƒz§æ\0001Å2lİŠ¨71TÂ¡C~xÙ4A‹–rRVÒT¢'B€ØfaHª-\n(1™EHIa1	\$D<šHö©Ğ\"‘\rĞdİ‚)	ˆ	*?39Ğ»Ø¨İƒÉ?æêH ³bô‘8À€(ğ¦2”>ÄøŒ@Î÷.Iù‡S•§Ñ²+…æjÁF£Ê+ò‡aÙ™´TJÈKÜ[\\¨š)¼aO±µY\$|*‚î˜Q	… ğ0T*qS“Ôf(fjD9‚a0Ò5‹Q¯uE5ĞŒÁ#Ìa!äjzª&hé’òIUêqšô–¤˜0IY…b3‹FÃá5¬õ¤şOVItÆÈ‘7tÀ\\ñQ”¶¾ÑÅ’û\nÈm®j0’‚Õ’LB4‰&¨QÄÒ¨TÀ´&–c¤%[:\$VF×UZg‘ª`7ì.`Ÿj}ik]¨4mZGª™H:Ûf„•¯CbßEs,™¥¨¶¨a‹f‰5ù˜óÔ‡õM;K 0Œ1NŸnm#SDšÅêèIƒè@¶ı ßK,T¢6æ@&^{@wÂ‹Záp=Ä{\$‘\"ÃœÅÅUô›iÈE©2Š±SÛ+T“B›7‘A,• CÅ?Q6‘™\0†¯J+7M-xÙ[ôxVE¯S˜Ahh+h:\0";break;case"cs":$g="O8Œ'c!Ô~\n‹†faÌN2œ\ræC2i6á¦Q¸Âh90Ô'Hi¼êb7œ…À¢i„ği6È†æ´A;Í†Y¢„@v2›\r&³yÎHs“JGQª8%9¥e:L¦:e2ËèÇZt¬@\nFC1 Ôl7APèÉ4TÚØªùÍ¾j\nb¯dWeH€èa1M†³Ì¬«šN€¢´eŠ¾Å^/Jà‚-{ÂJâpßlPÌDÜÒle2bçcèu:F¯ø×\rÈbÊ»ŒP€Ã77šàLDn¯[?j1F¤»7ã÷»ó¶òI61T7r©¬Ù{‘FÁE3i„õ­¼Ç“^0òbbâ©îp@c4{Ì2²&·\0¶£ƒr\"‰¢JZœ\r(æŒ¥b€ä¢¦£k€:ºCPè)Ëz˜=\n Ü1µc(Ö*\nšª99*Ó^®¯ÀÊ:4ƒĞÆ2¹î“Yƒ˜Öa¯£ ò8 QˆF&°XÂ?­|\$ß¸ƒ\n!\r)èäÓ<i©ŠRB8Ê7±xä4Æ‚ĞÂ5¢¥ô/jºPà'#dÎ¬Âãpô§Í0×¼c+è0²ŠÔ¶#”jÈFê\$AHÈ(\"ÃHĞï”#›z9Æ‚ äÖ;ëèáFÑé´.âsVğ¢MÄÈ„\0Ä0ÂÀHKTÕp°óWV`è¹CÜ7PÁpHXA‹İGµ@Ö2DIĞÒ;O(°Ã@Bb`Èˆ#\\f÷›Ğ\"…¯*0	ö`æšm\rF-@ÚÒ1weĞ7¿7%Ít±bò6‘\rÑ%R2Ü#\n07ĞØ<ß·¾†UîN\nŒ0¸Mö_Ğ^\0b8%Äì•é\\.bô8	¢ht)Š`PÈ\r¡p¶9fƒ»n[Î»üMÔ”£3Ã0Ì¡@J˜ËKè÷µ;H²7‘Z¡;A\0Û]Ò\$5£šç~¦ôå!O´Á`@=kü>\\6ßâ#l¢Ø6ÀN¨'Úé«8:Î·«kÔñCP»É¬ÌíÇ]Û^©mñö¹:íª¸.÷®¢ú^Àšğ[/´qVÛÆ³Hğš»8Ö¦)ÁpArŒ®Òw3ŒÉHÚÁSÄÏµ%w/5¿´É¼14”z4;8»)¬?‰«	±·è”(Ü¦¡\0‚2mĞ—±ú@2ŒÁèD4ƒ¥ºáxï÷…ÖŸ»£…ÉHÎŒc˜^2\rèğè_è/@ùM‘pæ\r\" ğ†|GN Ã¤ä54`æ¤Ÿé?GáÉO®–ÅTré;IJ<d +P“iq(5Ó”RH£È¦rˆ%#A¢OØ |( 9>GÌúPs}¹ø?\$¢ı³øIÀA€İ\0Š€>	!´8´º‘Z9©\"ò&S\nƒb02*šÒ0FŠ12°Z'BeŞiKƒRk/d1A\"HN	Ò \$­l£5TVd&(0\0@0ÅÔ4‡h¸!(@ğÜ!¨\\5:†Üæ!	'1¡Ó!ÅÑ\rA¤•—’÷Pxz;IYv¥B ñ_á[ÄÇÊtxØÎ\0d@§Ô€@@P¦UŠÒ-\$AAP(5F‘ Ô¨ÅÅDdg‘€Êåä‘Ä¥[Šô\$€,x'jíÒÆPéd|\"“f²N“i(£Z‹xêe	ÒæcÈäu¡Ñ±O‚šGaç\"’5(’8—S™%l)Ì\"\$qaå%æp™½™Ä¨I¢ÜWdƒ°y„dp€Ât\$ƒyU!©³'DŒzÓ hˆ«‘\$ŒP¥ÃÛ~d	±ôFkÜ1F\$3E¬=@í1Ğ¼Ì+¡È“â€`ÏP	áL*(_èüWSé«›ôìÚ)\r#AM]šô:ÿC0iáÔáˆÙ`aèkô…4°¬PQÛ©\naD&RNU§°¯Ÿ	œEGho €#I„oÉ‚6(Ş±¶28¥AKA¤èè‹äÈª—Ù¿g”=0ö¢ìá³áŠĞ›êäC	BS@YµLJ… ]\$üÜËOC\rYB4F‘€±J(SÛ1bÌ-~UhÍ+U7ä±VÆ.uÃ4¬ré–Ò=`IXCÈ6³¼Pî…„z´tVœBˆØ«“G–çá¦põÃqŠDÕı;µÎM§Ñ\$yˆìY¿ÀìÀÈU\nƒŠ¾Á‘›–ÑÅİK¾ÂSÂAÊÉ°ü+w“åÖbøF*a<4nãcÄ€‡ 2(£HÌ’¤+tã›3Ö\0PZ¿EJK+ cÑ^¡ÔÄc\"Èå÷¸†¿#ÇÕKxoGÈM\n¦r&™æD Y:¢?PÙÑÙ;dÚ®ü¾H±9â\nw€*zlNË°­A Á\"Y¨DJ ËT³(ˆ•¦}3\nÍˆ¼àÈÕÀOOt@¸\0 –F\\BßHE=(ƒÊÈªõXÿŒmT	øAPÀct1DÁ˜W§%Szƒ€";break;case"da":$g="E9‡QÌÒk5™NCğP”\\33AAD³©¸ÜeAá\"©ÀØo0™#cI°\\\n&˜MpciÔÚ :IM’¤Js:0×#‘”ØsŒB„S™\nNF’™MÂ,¬Ó8…P£FY8€0Œ†cA¨Øn8‚†óh(Şr4™Í&ã	°I7éS	Š|l…IÊFS%¦o7l51Ór¥œ°‹È(‰6˜n7ˆôé13š/”)‰°@a:0˜ì\n•º]—ƒtœe²ëåæó8€Íg:`ğ¢	íöåh¸‚¶B\r¤gºĞ›°•ÀÛ)Ş0Å3Ëh\n!¦pQTÜk7Îô¸WXå'\"h.¦Şe9ˆ<:œtá¸=‡3½œÈ“».Ø@;)CbÒœ)ŠXÂˆ¤bDŸ¡MBˆ£©*ZHÀ¾	8¦:'«ˆÊì;Møè<øœ—9ã“Ğ\rî#j˜ŒÂÖÂEBpÊ:Ñ Öæ¬‘ºĞÇ)ëªğ¡¾+<!#\n#ˆ€ÉC(ğšÈ0ß(¤âbšÅKÛ|…-näß­ƒ°Ü‰éü	*×ŠS\"‹Í\n>µLbpòĞ¶º2î2!,ù?&£˜5 R.5A l„ @ P¦;ƒ@ì³k#4ŸºmÂÿ+\r£K\$2C\$àŠÌ Øî¡k\"’B0åDŠ•2|\nËàĞÂÎš•ĞJefÏ(èP3ã`0¦è-‡eÑC¨\$	Ğš&‡B˜¦z^-˜e-Ës”¢íyW6£#Ô\rà,è ÂÒã0ÍUª”²ESKj:Æ\" ßÍãÊ9(£Æøc0êÏNkXæ&–0Œö‚–µ¨såJ7©¨P9…)8ª3#c|Ğˆb˜¤#«¥…¡^7MvLøÛN{[48°\\»,e¨*\r’VÛHÃª¸„É‘¡XÀÇ) É!\0ĞŒÁèD42ã€æáxï·…É°ó¬ã8^¥ã\$¦Ğ\r2˜^ÛÒØ˜®!à^0‡ĞÖ!¾Î\nb‚\r‰ÒìĞç87@Ã<5£,BN”ªZ5Ì£+ıñÈåUÉFápA°l[&Í´›VÙ·n’Ö¼î»¸İ»ÉêT¥ß„J |\$¨ó`¥K7„zÆ‘jcã 3íÎ4©Cè,—™Å~\nû?˜Ö¶Àq¢09ò%/PÎ¤úb00ŒiŒ¦é”úF@9éñ¥‡ÎÃ˜ƒb†Ñ?Ğè	š ¡„ç‚\0Æo^`i-¡Ì“—êƒ°iAå\0Ã—6Œõ«^'èË™°@@P¬Â2„\n\n )u&uíŠd<æWèCJd]ü¥Ò`‹N¨i„%à¹'ÃîÉ>'ÌÏš³Ä_S,eÅø'3ŒŸy!Í!ãÎŸ±¥)æ|‚Ÿ¦q ‰-aÁ’Ÿ“öC’|á 4†8 ©LÉ¡.ÑÆ¤¿IIN%¤¼ÉGØ‰ğtL& 7°Õ¡¢Õ9„hP™o\"!åz(D|ƒyôXpF5“ĞâO¡ÇX—µfçJXc#ç¶Æ³ô\\œù*>!@'…0¨@S©’¤*K™µ–Ó\r(A´Ñ†rD‚ˆŠî‘Å0Õ”%0AIÉ;'¨A¤GF”É gªİı'ĞAYK#¤|”–N0S\n!0 Ô\0F\nA—’¨és–m„ &\0R‰8E\r¤]<àÉªÔ¢TRe	´ThÕ©6‹¾IÖ*y€–‡\"²ÖjÆ\"ä8RÀÓKh\nhp6°ÖƒYù\\¯AŠhò^«Ù4Pø2P–†R\ra}fz¢Æ @B FÔ2†s¾™Rí(O†(SÇRh<P¤1bÖC@J•iKä%™\"3Yª*¯#8ÕÀ0Ä1¤Cá˜¶ÍrD‹Ù3¥üŞ—äT—Íá|±ÀµUÔ±IM#\\‹Šª_`ér\"˜ø¢›6»Ëƒ«´‡B!öºsA>#ôú¯@ÓÙ¼1d&˜ÖâŠ‚±mæ%‘ôÆI\\O0Ï\"å	¿6›\rH¯…Ü¿…Bê®Â”õEVÁH@";break;case"de":$g="S4›Œ‚”@s4˜ÍSü%ÌĞpQ ß\n6L†Sp€ìo‘'C)¤@f2š\r†s)Î0a–…À¢i„ği6˜M‚ddêb’\$RCIœäÃ[0ÓğcIÌè œÈS:–y7§a”ót\$Ğt™ˆCˆÈf4†ãÈ(Øe†‰ç*,t\n%ÉMĞb¡„Äe6[æ@¢”Âr¿šd†àQfa¯&7‹Ôªn9°Ô‡CÑ–g/ÑÁ¯* )aRA`€êm+G;æ=DYĞë:¦ÖQÌùÂK\n†c\n|j÷']ä²C‚ÿ‡ÄâÁ\\¾<,å:ô\rÙ¨U;IzÈd£¾g#‡7%ÿ_,äaäa#‡\\ç„Î\n£pÖ7\rãº:†Cxäª\$kğÂÚ6#zZ@Šxæ:„§xæ;ÁC\"f!1J*£nªªÅ.2:¨ºÏÛ8âQZ®¦,…\$	˜´î£0èí0£søÎHØÌ€ÇKäZõ‹C\nTõ¨m{ÇìS€³C'¬ã¤9\r`P2ãlÂº±ªš¿-ê€æAIàİ8 Ñ„ë£Ã„\$šf&GXŠÙSõ#Frğ¡Dè	ƒxÎ€TxçÃh;Úï1“\0ê†(I89¤cÒˆCÊH„µe\\–CPÂ/tÀHÁ i^†.Øêä1‹øØ­J*å\$¯lc\n£#ÈÜÿˆ-èÒFµ2:Î¨­\">Æ¡jj4€P­l0££†3ÀP‚7\rÕ§6ˆ#\\4!-3X„\rÆ¯Éeï|¬‚7\$ç€¥¨V™SõI‰@t&‰¡Ğ¦)K\0ÚcVD5¶Ëİ°û5)±ƒeÔí«H:÷e½³è`ì¸Ş³PØ±‚Ót;+SŠ3\réXØ7Â­.7¢²¹pAHh0áÙ(cHĞBh\n ‰¨øƒ@ˆRx€§#`\\èHöŠƒhúHÏ¥é´²¨êv«k\n¶7ë®;°N{ù²Ñ&Ò4mcvÚ™ˆb˜¤# ß}9ã;#—(¼Jƒ6H0\r£ª3\$ÛIãèş7w¶1ßIzÀ÷]¤%n½@C+Z2CÈ&b ŒƒjR&2:Ñ/é@-\rÖ„Jøè8aĞ^ÿ\\yKÜáz7õ\$	®7á|î M ïr\rƒ\\Ó5\rÁxÃ>fõi‡7ˆ¨Î«'Ä 7Õ’Ö]q{v…É;„hH“™5<ÁÈ©¥8¤8v\$²œG¦õCC×{)\rî=çÀøŸ#Ë|áÉô¾´úŸß{ñ* ø\$†Ğà[ßâ9kÁ¹ÿÀŒéŠ0	©„4ò6kR²8ÁÈœ¬ÒnA9X„Í\0BœdVg\$æDê…\0hS%ª\0ÌE–RÂÖ³D+d½0¨BÍØcG\$€è¿„b\"›HŠ”†Ìu:Ãq¬3: @ÒÚ|}BIePš\0c8m“¥eZıGHÅÃüi	N'K­ÊölU!á‹ÁĞÈ™ÆO£@E”gNS/2:\n\nˆ)„%8 £DıLC\$î=Ä¢dth…¼–44¤œJsB¦ìÀ Y	›ŸG\$°.ö|FÁhI\rÒœÇµ›ñLajxüÂ;%anÁ©µ\"@ÃºømO(3•øÿ>ae&y7brMÛk®'Å\0ƒ.ğô”‰Ú)XDdKør^åÑ¬½'S™^\"Ø…˜0®G;1t¨Aw†cï9\né«˜¤uä>W˜KHáyær0VŠS_¦FÌƒF©JLÂ€O\naP™vdt\"ÁF\rå)«—rJ‰#”r’RÓ¥gpÒ³T“¿å¥ğ6*4ÉKáÔûÎã>ÌCYH\rË5ÈjµRH Q	•USh§FÂ P4\$\\•£HxHÄ°sØF åZá>Cu„Á™uPg|#`‚…îX2§U6¥\$Ø`Ê¼‘M°´Ê¥{Tİ&pe=!Ø/À‚¤ƒI¦'eıu3XåPla-c»@@nM…;ñ!:æI\$øDf(ÙÔ©°@B F àÒÄäu	3_–îÔ[ëkhf¼BRM¾ù­£2fÌí´hâÑ•·lÊC½–T¾¬dâJ	S%æLaˆGêwÀQ~<Ët\0£RFgqë:æ\"î(´X«ˆ Pˆ\në¥kµ‰%*(©‰Îï’ÒgáJ¥däe )K,våánbD‘3ĞÂN¡,Et9ª¼ulŒãÉæ`Í#5ÜÊI`wel¹6İB@¡ƒÅù´€*æ(†°Dùs&ØÁ\0¬`}±Ê˜6¯À^\0";break;case"el":$g="ÎJ³•ìô=ÎZˆ &rÍœ¿g¡Yè{=;	EÃ30€æ\ng%!åè‚F¯’3–,åÌ™i”¬`Ìôd’L½•I¥s…«9e'…A×ó¨›='‡‹¤\nH|™xÎVÃeH56Ï@TĞ‘:ºhÎ§Ïg;B¥=\\EPTD\r‘d‡.g2©MF2AÙV2iì¢q+–‰Nd*S:™d™[h÷Ú²ÒG%ˆÖÊÊ..YJ¥#!˜Ğj62Ö>h\n¬QQ34dÎ%Y_Èìı\\RkÉ_®šU¬[\n•ÉOWÕx¤:ñXÈ +˜\\­g´©+¶[JæŞyó\"Šİô‚Eb“w1uXK;rÒÊàh›ÔŞs3ŠD6%ü±œ®…ï`şY”J¶F((zlÜ¦&sÒÂ’/¡œ´•Ğ2®‰/%ºA¶[ï7°œ[¤ÏJXë¦	ÃÄ‘®KÚº‘¸mëŠ•!iBdABpT20Œ:º%±#š†ºq\\¾5)ªÂ”¢*@I¡‰âªÀ\$Ğ¤·‘¬6ï>Îr¸™Ï¼gfyª/.JŒ®?ˆ*ÃXÜ7ãp@2CŞ9)B Â:#Â9Œ¡\0È7Œ£˜A5ˆğê8\n8Oc˜ï9ŒŒ)A\"‰\\=.‘ÈQ®èZä§¾Pä¾ªÚ*¨Šô\0ª¹‹\\N—J«(ì*k[Â°ëbÜÆ(lŠ²Ê1Q#\nM)Æ¥™äl–Ìh¤ÊªÂFtŠ.KM@\$ºË@Jyn”ÅÑ¼™/Jîò`•¼ğ3N¡•Š¶B¡òÛzö,/ƒƒHç<“ëNsxİ~_ÔŒ£Àè2Ã˜Ò7á¬)6Tª¼`€8&tR®8Ø«ñ‹¦«Úg6vv+h“N…ÓXµ¸¹Gd¥,s{3Äâ¾œSğÚM—‘¹Š¯š«4L¡Î}*gË.J2ó…:^›§Ğ)ş–5\rj\\A j„ÀÂp)lûÚ\\\$É'jª F©k£†¹ªı½µ\$\rm©x ®9%NS\$¹p|¡hÚ0#dcU\$ÂÌ§¹&v_x'ú§ª+ÿŠ ª¹-jC/Æ\r•NYt|+²j:gMÅñ½VgÖp¼-;0¤ŠRg/Ò©Rg!Ñ‰“~2DJ\$ùn¬¥à^-¤iï¬.ğJÏ³Ï\"\\‘±Ï¯8˜C`è9\$“ª…Ê=\n¾]Oú-g©Æeµ;·dK|JŸÜÇÜù ¯Ôó3ô¦Æ\nÉ;CnÍW:Å‰Ñ)7¯h×+¶(n\nññ*Šı˜ U #÷B\$X=óêiYÊ³{ÌhºXußzÿtpLÖ;`[ºz%™%*èÊÑ‘2ÇXÔÁ¢L7¦â³æf†á\$&AĞ¥ŠS‡¡yùÉ×’+*YV\$Hø£tŠII-aL)`\\ÎÏ!Kª™h¡M\nã”\$Ñ\\”ÆUÄ-\\ôÂ²Â ¢ï-È¸¥@ĞSJ‚Ì:°àÜÁ\0A´4†äá	CaÁ‘8\0xA\0hA”3ĞD tÌğ^åÀ.2nN§\0\\œÃ8/a€½?°0èÃÃp/@úb§y:Áà/ øÂ‰tA Ié/6ÅÌ¨Ã¤S	[bWAÄ­LMxX¢¦…‘`Âˆˆf}‘I&,Œ¥e7² «™IìeqàAFùO*e\\­•òÆYËYo.eÜœ“ÉÒ`L)’ÂX[\r™(Áæú’‘Z¡>¥ÉgŸ¹£4Ğ\nÈXú¾¶ Š’%=Åí·d+ ”†fçÙP)\"¸w\nÉÙ¥oÀİ\$Ãq\n•>Ğ6Ò\$8¯U?\rìáÔr61\\9‚9Ş€©ŸCc˜ì@wêC}	ÂI‡ ÚZ`aÌ,9(`ÆÔsÁÕÔ†ÀŞäí]\r!Ğ4\nøŸWİgUÊ@İ1ÃlfÙ›X.I9~&Lü«R@±	YO\\(±U ZB}I êu½‹fíOâ\\ˆ\$kºÊ+K>@P\0 Á—¾x\nCWG+¤•–“¸^YÈ·)A\rˆIêµ3ëğoÀ9ìãC(g­-E(%ô Ãz…±5Ø;Öƒ~UÌä¤eü“\$Jàâ©‘ õ-*ÈĞĞœí×•ÍFW\0A^kı÷\rÁÀ:¨µ£Ã“Lá 4†:û'<°i©öü†0Ã%C)…¦HîBîÚ•9Q.,U\"Ú£˜VÈ¤4HTÿ©Cìµˆ¨!VHÇ·zI”™‰7eÒr¢Åàpèì1±m”’È\$@~ã’,GôÖ :`\\z³„Ó#I™yBçòF•×1GÜ/Q÷¤0À¸RPc…Š’@NäÉÛx\nÿ`y{\n<)…HŞÍI9ÔÊè–Sš¤UÔŞ#,EÍãhYHJĞ@dñsÑ–Š+=Å1+r@Í!É–òC‚zOÕ™WY¥S´C&èÌA•-à€)…™†J ‰*[)Æ‡ÉMGEæ˜ãôûòZ«(O}ıšWû£*TÕ~\r+´Œµ_ÛF²‰eo›Í„Hö#Gi/ÁÌ­²‹UNÍ!?Ol¤°}á‘Ù!gà£í›¿n’…VE¶™´æÒ>ğÚÈ•=ÒH÷\\CÄ•©o\r½±äı\$\nL¹[÷¼ß8laŒ6`P×—=*U…—>—çy4ÄTù¡Z8~O\"¸*Æ&…{JƒG:UÓ¥Õ>¶¾AD¡İ³ ª0-(4Ë*v³.³m•\r»¥Ïé»óè[‘sRvaNı.1–è—\"…±é@{gÕb´“ŒÜ¨¤+”k™Åh)±ºŒé„9r©¡[E®\"Ä‚ *€ÇKÊ.:dSš³š…Çó›n~‘8…ªUİ–çx9›‹\"n1Æû'î:i÷ñ›=Å(¦´­š´mÉ50w'C³,Ïxı! íCÎ%è\$Ö±#ËĞ1dº‹§zÄÕÂ«İwg©›°Ê}Üˆ ¬v9s{r–/½^Ş|nxg,Oz‘;/5Z\$>óØáÛîŒ.ŸxèãÂèÙÏÅ£ÃÓı?IÈ©ƒ}K1nı'sö;ˆíÿ®ÄƒN:@NhÃfYCæ ";break;case"es":$g="Â_‘NgF„@s2™Î§#xü%ÌĞpQ8Ş 2œÄyÌÒb6D“lpät0œ£Á¤Æh4âàQY(6˜Xk¹¶\nx’EÌ’)tÂe	Nd)¤\nˆr—Ìbæè¹–2Í\0¡€Äd3\rFÃqÀän4›¡U@Q¼äi3ÚL&È­V®t2›„‰„ç4&›Ì†“1¤Ç)Lç(N\"-»ŞDËŒMçQ Âv‘U#vó±¦BgŒŞâçSÃx½Ì#WÉĞu”ë@­¾æR <ˆfóqÒÓ¸•prƒqß¼än£3t\"O¿B7›À(§Ÿ´™æ¦É%ËvIÁ›ç ¢©ÏU7ê‡{Ñ”å9Mšó	Šü‘9ÍJ¨: íbMğæ;­Ã\"h(-Á\0ÌÏ­Á`@:¡¸Ü0„\n@6/Ì‚ğê.#R¥)°ÊŠ©8â¬4«	 †0¨pØ*\r(â4¡°«Cœ\$É\\.9¹**a—CkìB0Ê—ÃĞ· P„óHÂ“”Ş¯PÊ:F[*ˆ‘ƒú„\nPA¯3:E5B3R­£Î#0&F	@æš¹ksÙ\"%20†âLúw*‰ƒzâ7:\ròTá¸£•XÊ¢pê2¨òÓ+09á(ÈCÊğÓÕDŒCÍP¶¨^uxbPnk4˜eç9©*‰ã”jÄOhÒîˆ#Ç\\W@SË1*rÓB ÊÄÈ+ ŒƒPëmOb(ÜÒ±(Ëi¥‹ÍÈçÕ%?sŒ-25u\r1¢:š2\$	@t&‰¡Ğ¦)C È£h^-Œ8hÂ.B´`Ü<ƒÓHDcKœ\r“2Í¥¬dÖ3Ï Ü¬»Ï³Jç7bíI%HB=\\Ñ‚ ŞŒ#sƒoÈ–R29ŒÃªX6QKHçLÂ3Ş+ÒÓ4Óö0Ü:¯@æ¦™°ÖÉb˜¤#:ƒ²\nò]\0­Kƒ´9\\wªU¢Gmz;Œ©`Ì·\rº™å9u	.X¬iR†T¨¦ø*3ÏŠ5»¥PÃÂ[š“íRò†•àĞÆÁèD4ƒ à9‡Ax^;õtiË?+pÎ¯!}x×Ä£p^İ»ŒµxÂ&‚š3f/L8È:ùC- Âi“’9Œk{ı¸QAº1¾	«òğ•A#œ²€ÒÆAÁ:ÎôIÓuWX;õÃ'`v]§tœËÊuw@ˆ¥à’II\nJ8¯á¦’4’ƒ¢SSî(–¶HĞAö',œâŸ ÊŒ‘%¨Ï#L±ÜDi™;’2ÖCADgâ\0îi‰d #gÙÈ\$¥>C3ã@¬ùó4†ÑKÔ7‚&Å_”pŸaÜ^¡°Ìó<p`\$f„Tğ­ô8‡¡Z\"€0¸\08o@ğ¤‚”\nJA Æ9‘ÂĞHBµdğÍÉÁ@ài\r1	9Dl·B4Œèo@…Í¢s”MjE\"áä‘pÆö2dd‹–“†}Òy(†Ø‘H„9C›:‘0ê¨FĞRXPØ˜ø*\\\" \$PD‘t0Ê(x“f×!÷ÎN1®j\$ü’Eù{‘Ô;Kd¯p@„	SÑB!„:À£`Š\0PI\"aåLIAÍ62 Æ.@Ğ‘\r®Qı“íKp—fÊX„Â˜TC§ñº’<½‹g%´òÃÑ‡HDàÄÖKféÜ\$H¾¹BLfqÂ8†…)%–Í q43FpÃ—£XÑ¡-TÀ0¢h\\€€#HÑBÉ%°bx¢Ê±4SIä†³Ê†×`\n©fX˜#a—µJ!507¦¦Œ}‰EQ\\Ğ\$îx(jÊî%k²‘ªÏ×±˜i€6¹.a£HbdMÔ6¦ˆù	J.9d¥¢@ `ª@é§…P¨h8#¸á˜2ÔM)”«•5®ÊÕfª¤‡¨G]“CjQÑM ¬§roèá´J¦Á†`òÁHÌ›VÔj©7YS\0PmªÆÃ›°ªq\$ª¯…åJ¤<r•½(A*HÉ†RæX²‰Ğ™{€¥Ln\"5Ä¢ïôhx@PP ª-*¤†:PmêDc´ áÀ„¾§Tı S–~­ÚSkKÀdV\r›¹ƒÏ=£„iY\\Zâ—™z¶Iì*&t«TÔâá°d©Å#ğ";break;case"et":$g="K0œÄóa”È 5šMÆC)°~\n‹†faÌF0šM†‘\ry9›&!¤Û\n2ˆIIÙ†µ“cf±p(ša5œæ3#t¤ÍœÎ§S‘Ö%9¦±ˆÔpË‚šN‡S\$ÔX\nFC1 Ôl7AGHñ Ò\n7œ&xTŒØ\n*LPÚ| ¨Ôê³jÂ\n)šNfS™Òÿ9àÍf\\U}:¤“RÉ¼ê 4NÒ“q¾Uj;FŒ¦| €é:œ/ÇIIÒÍÃ ³RœË7…Ãí°˜a¨Ã½a©˜±¶†t“áp­Æ÷Aßš¸'#<{ËĞ›Œà¢]§†îa½È	×ÀU7ó§sp€Êr9Zf¤CÆ)2ô¹Ó¤WR•Oèà€cºÒ½Š	êö±jx²¿©Ò2¡nóv)\nZ€Ş£~2§,X÷#j*D(Ò2<pÂß,…â<1E`Pœ:£Ô  Îâ†88#(ìç!jD0´`P„¶Œ#+%ãÖ	èéJAH#Œ£xÚñ‹Rş\"0K’ KKÜ7LÉJSCÜ<5ƒrt7ÎÉ¨™F¢’œ4òr7ÃrL³Á/Š	ƒzØŠ°L%8-ã¬ƒËèjFL¨@Ò9\rC* ƒÃÊÔˆÈè³, ÎA l¥hBxèLĞ2ÀIc\0´ÄkP(\r4úÿ4ƒ²2@PŠ¥nP—#!£¥2¦HMŒ›Ê4zÚ¤ÊI`*”õ@:‡PÂö7#ÈôX\$	Ğš&‡B˜¦*£h\\-8ò.ÉéxÆ’üj6L S*ËÉ©HŞ3ÈÚzÚ=ìÜFÑéqH67Ë€ŞÏ\r¬`òAjÆ1°ƒ˜Ì:‹Å…acL9dãÎŒ½¨UÜâ¡O0ÊaKh7Æ™*¦b˜¤#fĞÙ¥C|TÃ4\0ì´¹@êİ)¬¡·Ãffë%)xÜ°ª4NÌ½(Í5(ÈPÎ8JP9fÃğ!“ˆxßÊ3¡Ğ:ƒ€æáxïÉ…É&Ğ9ËHÎÂ{ó6UsÀ^Üûë»xÂcHÓ‘½³ÀA\$ğZ©¨ÁOnÌ¶k*ÁH1#*j›°¯zUK°ğ8Sè0\\plÇ\rÄq\\gÈr\\§-½ó.§87s“¤);ü	#hà‚ËãpéÔõs”¾×\rè;Nâ§	J¤•=ù*zûjwO­ş¢H@ßaÏC§Ôª6òRC¡=¡Ü3æÿ“sI|ƒ†Ìk‹*e†%—³vÏ ¡®4ÊüŠ†¾†!¸4“ æMB)P)åè¼”(ñ€c(´Î„\r4ëp „=BhUâ˜T¨R0\niàÁìiŒğp4ˆÒt\0®Á‚ñÙ†ÆÌŞrÒCÁ¬´¸`Ö®Ìsƒ9ÃF’oÃše‘¤öšçôƒæxæ%ä‚\0îYƒhhÅ‚/!¡€a\\Oœ¦JO	iÁdÙ‡\$†Gˆ)†/O=µ3ÚPŠ\$?gIº€ ’EÉ–”ƒÆÃBá\\jpÁÅ¯Å`Ì|Zëyrğ­\nCÌ`æE–dÔ(ğ¦lzX¥’ÉWdFá«?ÅV;–´pUù–nÌ…°¢K‰„ãpÓ©¬¦ğà€-0kœ:ItÌc(}a¾›ôhİÂ˜Q	€€3&µ\rA\0F\n‘E„F—Ô±#Iı˜éxŠÄ70›i†mtZ¶³vÛ€PUkóª‘¶¦ØTå¨KSê…7»\"L\\â:¬›ğÔy¢jêT(­vª†ÄpN0›‡ä¢–˜˜C`+\rdÌ8ÜCJ]8ÑZ³àª0-	­¿S´M_J\0\$ª­Ÿ–¢ü‰Ë‘\r#†HÒ0Ê‡©u'\"Á5ú†Ì@Q‹n	™- ¦—L,8ÅP¿¶:’¸-L0U9Ô\"yK!)ê‚)‚Ò~©Q¤‘»(ÀÊ¯Ã\\¨;f„˜p¨pP™3]%Mö.\$Xªn0åÒ£Ğ–Ù“ÂÒ'5¨³Ö”YÕÑ:!\n9ˆNÚîHÉÑÊ.%Ì·…\$VKåŒ!¼4";break;case"fa":$g="ÙB¶ğÂ™²†6Pí…›aTÛF6í„ø(J.™„0SeØSÄ›aQ\n’ª\$6ÔMa+XÄ!(A²„„¡¢Ètí^.§2•[\"S¶•-…\\J§ƒÒ)Cfh§›!(iª2o	D6›\n¾sRXÄ¨\0Sm`Û˜¬›k6ÚÑ¶µm­›kvÚá¶¹6Ò	¼C!ZáQ˜dJÉŠ°X¬‘+<NCiWÇQ»Mb\"´ÀÄí*Ì5o#™dìv\\¬Â%ZAôüö#—°g+­…¥>m±c‘ùƒ[—ŸPõvræsö\r¦ZUÍÄs³½/ÒêH´r–Âæ%†)˜NÆ“qŸGXU°+)6\r‡*«’<ª7\rcpŞ;Á\0Ê9Cxä ƒè0ŒCæ2„ Ş2a:#c¨à8APàá	c¼2+d\"ı„‚”™%e’_!ŒyÇ!m›‹*¹TÚ¤%BrÙ ©ò„9«jº²„­S&³%hiTå-%¢ªÇ,:É¤%È@¥5ÉQbü<Ì³^‡&	Ù\\ğªˆzĞÉë\" Ã7‰2”ç¡JŠ&Y¹â Ò9Âd(¡„T7P43CPƒ(ğ:£pæ4ô”RÊHR@Í7Lóx–¤hìn¨²ú–Ë¾©‹;»¦ò¤ÌœÇYIìÒG'¤³2B°%vıT®	^Ÿ\"Ã#ÉO@HKc>¶C“Õ¤;æ»@PH…¡ gl†¬còÉêXÌiN +L!LÂt\n;ú²×ì	rë‰ÚBUKQô€“#±¤¤§¦ó~XÆÑqR¦‹M3¿¶“®°–Ì›\0l—É²ÃÓW;\\†ª%Šß+Ä,—°‰ÄêŸÙVc<€dõF@âJÉû;Ñ°\$	Ğš&‡B˜¦cÎŒ<‹¡hÚ6…£ É~Íƒ\\¥xˆ9ƒc`Ù\$¥¬›«¨<™%I\nìˆæÉæ°Ìm®Ö±VÛ~\"®¬õ#@£ÉK¸ÚFWŠDF(VcúA&ÄPó‘•I+Å[4‡7N{@\\Ö‹.:ÔÔx¾AoLşø£oü\rrp¼=‡Ä´I+õÆ·œzºäB¦)Á\0è7tê‚<×Z(¡ÁwF°ìµ½^†—)–qØY²fïÒ\"%RK©8¥bKšö Ğ0ÀÈÍC´›Ú# Úö@á`@1Ò´˜É„àÂ\rÊ3¡Ğ:ƒ€æx/ğÌúZ\nà½H‚ô,¢¢”\rÀ¼èƒ`g€¼0ƒâ¶Ò³FŠy¢ÓnWÑp\r€•w†³^1‘U	@Ø’Ô`XAo¦ ÈCÊ™«‡\$)Iá+rÂoT\";~/Íú¿wòşßëÿ€0;ÀX8.P2	¨å ¤ ”(`ùŒ/¤pIYS\"nªcŠÄ]QÆ\rxàÖ¨HUÚ0%ÉÉ0êCÈ‹e èÀ£\"£HrÇSØ™«B—Í\"fÏi\nÇT¨ á¤6À@ p@ï|9ĞÊ±ƒfRÉ†0Æ†˜f²x6ğÎ{\$Ği¡Û„( %3ë~Ï¼7AÂD~O‡\rˆ;²ïUJâEÄ!0eƒ!X!4*“1,7@ ‚3äîA§\0ÊÉ@((`¥çVeÛ&œïØ±€Ô¬X’ğeÛğ@i=j3ÊyşˆPÊCA½Lyjå9ÊK©¡â¸´øÅc˜0“>Š2%° ¡OÌ9¢9_H,»B‡°8TD‰0rXÁÜ4Ç/8gr}\nR§Ö_e9KÈ&šâÑúej¤Ì¬£†èA1S6‰Yâ¥æVğ¡b,‰1ØÂM£voQÃ°	\$h<†ğê…CJÆCdmH¬iwBŸ°q¨ad_\$W~©†9j„åí\nDt¡™%‚™£ƒ(d-â‹\"Zm\"# ,vª’„ÀT]`b)²BcŒuÈúf\$•n9:˜ÊâJYi\$ìBBÃè§¬Ñ\ny†Å769Î~‹\n=³‰(¯€¦Be’&Ë®M‚j\nóœÁRpÃÈDí}È<7µÇ¨ŒS’äouÆyæ+ç¢@ñ/^Ç5xI“o¬8û#jP\"MŞJöPñÕvGy®ú¥ ˆüÔ{ÈË[]¼÷è€ßÂ˜ïïzÏGf¦·<ªI-Õ…i6Ğ“Öluú›µM ãé\\‡2\$ı²vÊ‘‚¨TÀ´,sxì0	<4ä’ì™‹şäñ‰¦»æí_b<Õ]ù'Uèõ¨’´„°Œy8Äåb'#µWÕSÉ)ĞÎŸRtØêœÉöÀüHeòW„1J79m½ªšŸƒjû\$lV€´Y®Uã;Ë·9P]Tm!ù+<ËíÎÇõBxÎ—A4˜±°bI ­9ñÍ·dò“rÂşSÆ“ÜqbËcF–jıêdx‚´ˆuF3‡á)6âVi1©”]¦8ûœJjÑ…ˆtÎüÆ¯2n·µ³\"ÆOMäìç’Ùa ";break;case"fi":$g="O6N†³x€ìa9L#ğP”\\33`¢¡¤Êd7œÎ†ó€ÊiƒÍ&Hé°Ã\$:GNaØÊl4›eğp(¦u:œ&è”²`t:DH´b4o‚Aùà”æBšÅbñ˜Üv?Kš…€¡€Äd3\rFÃqÀät<š\rL5 *Xk:œ§+dìÊnd“©°êj0ÍI§ZA¬Âa\r';e²ó K­jI©Nw}“G¤ø\r,Òk2h«©ØÓ@Æ©(vÃ¥²†a¾p1IõÜİˆ*mMÛqzaÇM¸C^ÂmÅÊv†Èî;¾˜cšã„å‡ƒòù¦èğP‘F±¸´ÀK¶u¶Ò¡ÔÜt2Â£sÍ1ÈĞe¨Å£xo}Zö:Œ©êL9Œ-»fôS\\5\réJv)ÁjL0M°ê5nKf©(ÈÚ–3ˆÂ9ÀŒæâ0`İ¼ïKPR2iâĞ<\r8'©å\n\r+Ò9·á\0ÂÏ±vÔ§Nâğ+Dè #Œ£zd:'LCÁ\r\\\\a–ÈÓ\\§5ìÚS,ÅÍim.'œ*İ²ÁBšj&@\n_£#N7§QlÆ)ˆÒ›%‘\nñ#“\0:Œƒ¨\$%’x8#˜ò×\rtM »‹»*Í«Ûõ\0!£#^; HKS%5C5.cA jpÑãÊ0Ìı2–9Bd(Ó¾)BÂD™\rÑ¨É_ŠÉcNê¦ÁhàªPbbØûĞp‚4¾ìHÓd¨o LpJ‰[òÑmm£CKL2Ş­pÙv>\n\0òUWH4^W¢‰{ß-U÷ HĞšÏU\$Bhš\nb˜8sŠc¶D; UªŸº¡PÄ\r’ € JXÌ3&àZ¢@q((%‰vjóÓM…/¨ÍÌ4À¡\0Ú¦Lc(à¶)ƒs’÷4S2é-ƒu3E6\n‘K'KD¼R’Ê³©Å¦ñi5^”Ë´Pzà¿(\r–\0Åi	æ–ş£ÚyI¨êcvªêíNµ ´QË<ì4«×²©;Dµ_	NÛS9ânz®í“Q/ºf»'‚¦)ÁjñGQ@\\[ØcÖ\r’ÂĞh”bgtÉ¨«Úzİ7ÅIPş¤£JjòOcŸ ÷L“ûX#'2¹+fÊ;\$C @#£@ä2ŒÁèD4(€æáxï÷…É?®9ÓàÎ®áz0Û¨Š`^ñğ\r‘}Ô÷P¹ÕFE±±ƒÀ^Añ5	/ ÷R¹ïjÑÈ8††åc¼0HŒø Z‡3Ea\0—sRHIŠ#D¯}ğ¾7ÊùßKë}¯¼;¿¬]Ÿ£ö¹üƒàËşE8DhIL‚	Ä¥0Şˆ‘w(a”Ğ5ø¸†A”RÁØ¶!‡” šœ#eL¡ò°«M!ÓŠÈÊENĞğs0„î´˜oK`l4İç¢	ñÊuK.!¯âzÒÃIÌ#©i?³&§f’Nåµ¹gzcİ¡‡Mnñ\0 šiÜ1CN¯\$ñ\0 ‚”HZ3JĞPSL+D/Dõ0âØi‘!l&¡eôPò´Şñ0†~(0ç’zÛIÙr ò?#Ş—p Ÿ”\0MB³¡]'0Å³„×\\Rõ*aĞÊ‡òsÜ3rmK%Åú¥N’PÆİÔBAÈ4’*\\[øÎË¹@\"Äòn,‚„]Éˆm.¡Î‰G\"èj•‰§aËü´FAÓ{„t§P”gŞak€õ±¼zè¬aÇ½.=H~w	Ñâl±è6!SV))ŠU	ÍsÇâpN¥pO\naP²º*[(»¯\n,ÛæVGS†t€Ò\"8œ[0nÁ¤3“’EAŠ!S(óöp=ÙBÊÈ•G‹AL(„ÆnQJ¡L*\0tçêc7Å+¸H´†S²“g¤¼˜’òR~fR[g%‡.y>TŠ\r’4´j…»!fSÑ5…Ïpß\0Ú™ mÕ¦Ì¯ˆDB]§OO\"Õ*ÅFºN©w&¡\r*ÀVmßS]«¡Ê‘´¢phİ¹ÕC6A×£Öz§qX3!T*:qL!FgM¸ÈŸôe˜Ü^ÏdÕXKIeÍ~?ĞÀ e¬rŒ¢1°»†WVQ	°u˜«¨á˜SŸQª¿§Ã¡\"vŠ\rqÃpw%|³Xkªñ³XÎYÚ¸_UÌI'8x›/ei¬k¤´Å( ¼J.êªT×tÇ2sNh;µ)—şpĞ•{ZbƒR«šób†¡±YwqSrç\nìÌa53ÖòŸ¢dğ ’\$*†(TœÀd”‡(ºæa  |O‘ó>€èúŸcî~Ê ?PäıßÉ+Dİ>Gÿ\\=qJ€";break;case"fr":$g="ÃE§1iØŞu9ˆfS‘ĞÂi7\n¢‘\0ü%ÌÂ˜(’m8Îg3IˆØeæ™¾IÄcIŒĞi†DÃ‚i6L¦Ä°Ã22@æsY¼2:JeS™\ntL”M&Óƒ‚  ˆPs±†LeCˆÈf4†ãÈ(ìi¤‚¥Æ“<B\n LgSt¢gMæCLÒ7Øj“–?ƒ7Y3™ÔÙ:NŠĞxI¸Na;OB†'„™,f“¤&Bu®›L§K¡†  õØ^ó\rf“Îˆ¦ì­ôç½9¹g!uz¢c7›‘¬Ã'Œíöz\\Î®îÁ‘Éåk§ÚnñóM<ü®ëµÒ3Œ0¾ŒğÜ3» Pªí›*ÃXÜ7ìÊ±º€Pˆ0°írP2\rêT¨³£‚B†µpæ;¥Ã#D2ªNÕ°\$®;	©C(ğ2#K²„ªŠº²¦+ŠòŠç­\0P†4&\\Â£¢ ò8)Qj€ùÂ‘C¢'\rãhÄÊ£°šëD¬2Bü4Ë€P¤Î£êìœ²É¬IÄ%*,á¨%ÊğÜä*hLû=ÆÑÂIªïš˜dKÁ+@Qpç*·\0S¨©1\nG20#¤Äí1©¬)>í>í«U²Ö!Š\níL’ÀêÔ&62o°è‹Œ“àÆ€HK^õûv ãH¾ j„ ÍC*l†Zî‹L–CòøŞa— P¨9+‰ÚXÚS•ıH\nu½¬ğÌ+¢!¸w Ê6BS ¦:MØ(\r&P…¡.Â¼h0òÇØat‘Œ#:PÎŒœı…2au…^áô%A;U±R:bÃ(İŒ#št¡àóûî\$	Ğš&‡B˜¦\rCP^6¡x¶0èºÀ?*b`Ø%.ÈÜÉáû¢Ñ¡±UEÌ)s^¾0©Ğ¦†54¨ˆÉ»ŒmuÜcxà©!ZVÇäI²¦ab½ˆam[~AuœÚ:¥##=câl»=3°°ª.Ù°\ryRîH'ºÖÎòÔÍÛîÿ†¼\nƒx×“¦)Ï:Ë©.¨­EMS5“aZ:²—\r¬òÊ§LfƒM\0CqIJ3O¨B 3„ÉÎŞ[–Â’)*èx¨Ì„CCx8aĞ^ÿ(\\0ùè‚r—á~LÃıà„A÷ãQ¿áà^0‡Ú×\$©pM\r1¹5×bjÈ3QMÊy“*„‚İÜ»{GÌ87©‚PkTØ '¨Ú±Ru^ºa{OqïGÀøŸ#æ}Aõ‡'ÚûÔ+&Pá¹ú@|GÃ‚¸*èÕ?§øLIèmN5L§°ÂMÊ™&FT7(.«[ô\rDè¤ »#övÍJ0)AÍÿ¨‡ˆÄ×R«è¨(@r7Jö#\"ºgCa˜ÏŞ_LÌcSÄù1ÀÂnˆQ•)*€£²£¤á”\0,%Y¨\0`‘™R)ò!¶À ¨x—2GBAAT\"†˜¯˜ÀæHCq%9)µ.£şOƒy¬\\…Ü“±%z·HIóoV\rQ4ŠT¯ÚãC«Lt	ˆÊ–Oe9û%B>M0ÜjšDh”rnM˜q|{Ñ”ÃGĞÆ›¢äAijf”2ŠîCkh=Ä€§œòRdàÁ’ƒà×ÅDWƒ¨g‡…u®ÀÒ I¥4æ¤ÕÁ†.ÃË8©|Ê‡’ÔÑ¤Ø—O:&äQÚ±3U®Ê‰Áv\"‘B#Jn\0€(ğ¦	ñcláœ97â’Êk!‘ÅÃV	é?Š²I¤¯VAè®Ê P‚•›B{ø×“ÖÂM5˜ÊfK…Di\radvRl6÷ĞL  ¦„ˆ¥•²`ÂˆLD%t#I2y¡’)KèÅnIÒ`RhÑ¯%p95Ô\":·W06\r2)=&òäˆP|Ø‘S•Õb¢¦\nÂhÆl­Š‡p6#Xæ,D'Ô'L6ÑY–(ÈØ°m1j…Œ±¶Ef k *6nÎÛFRN‚b\r€¬1 Z,ìŒé]’.®¨tam™°å(­ĞälCxi5,„aµ9šÉÀd3‰øP¨h8µjõ†sf­…œ¯¤6e[kÚ“åÜ¾%€–ßI>N¡Á\"\$‰åLÏ¢O[Ï'Ò8ÅYåD¼\0Uâ!ŒÙ±î—ºª2 *Ù`ä¤ªa(@®aÕBCa7öé£v—îa¸¸	\"rÔTËñir}#cF\$®—ı'Â\$2T°#*šŒá4	øí°ËØÖ-öÊuvÙuŞ©1ØeÌ¤jÊ¼¤:İ1ø—0¶VËš°D\$Ã›Å#‚fSAZ§â³ZWp‘úE ";break;case"gl":$g="E9jÌÊg:œãğP”\\33AADãy¸@ÃTˆó™¤Äl2ˆ\r&ØÙÈèa9\râ1¤Æh2šaBàQ<A'6˜XkY¶x‘ÊÌ’l¾c\nNFÓIĞÒd•Æ1\0”æBšM¨³	”¬İh,Ğ@\nFC1 Ôl7AF#‚º\n7œ4uÖ&e7B\rÆƒŞb7˜f„S%6P\n\$› ×£•ÿÃ]EFS™ÔÙ'¨M\"‘c¦r5z;däjQ…0˜Î‡[©¤õ(°Àp°% Â\n#Ê˜ş	Ë‡)ƒA`çY•‡'7T8N6âBiÉR¹°hGcKÀáz&ğQ\nòrÇ“;ùTç*›uó¼Z•\n9M†=Ó’¨4Êøè‚£‚Kæ9ëÈÈš\nÊX0Ğêä¬\nákğÒ²CI†Y²J¨æ¬¥‰r¸¤*Ä4¬‰ †0¨mø¨4£pê†–Ê{Z‰\\.ê\r/ œÌ\rªR8?i:Â\rË~!;	DŠ\nC*†(ß\$ƒ‘†V·â\$`0£é\n¬•%,ĞDÓdâ±Dê+OSt9Lbš¼Otˆòh¬ÃJ£`BÃ+dÇŠ\nRsFŒjP@1¢´sA#\rğªÂI#pèò£ @1-(RÔõK8# R¾7A j„p¼°¸ÆÇ¢ª¢\r¦®4ÜÊ‰“˜ïˆ#ÇD€P¦2¤tŠ¾²¢*rÕIƒ( ³µÈ ŒƒÄ3QÏ‚(ÜÔ±õ`Ëm‹\rÖ4Æƒx]UÔ×xÂÕC¬Ø¨OÏ)B@	¢ht)Š`PÈ2ãhÚ‹c,0‹¶•©GYè«páİ\0S>Ê´i»MLQªGZZc“R¨2´Š^Ü ÈîWn§(íë»ÌĞ©¤9D_•…‰EŸ*B¯ÓÌ«S)ƒpëQ\"%õ`4AŸªšUh¹íE¤è˜•éÕf£©Éb Ş5éÂ¦)Ú0ì‘ğ\\][¹Zª›:U?j –/#k=+^ÀVe(ÂéšÚ¶P‹•*Fš\nŒ#åŒĞ²:À„&¢¥h¹B:¡¥!ã\n43c0z\r è8aĞ^ıè]tïÊò3…ì\0^¨/ªr*„A÷ş=aà^0‡Ñ”h:Ó¨AÉ³œ®Š’ÂpªRØÒ®Ë³ÅEÑ®­;±gÁ7~2{xë½õÒ‡cÙö½¿rîİèwwá‘à‚ç†ñCsÅCæ;@DUğI\$Š¤='¨J>*Ã¦´zš•H%\$¥&|YVúrŒ­PÄÓŒá'%&1£‡á0{fÉk‚\0îj—Œ/„„¥¥§¶)È{\nU†c<g;ø¦†‚ozIRæl¡ª%èÃ%Dy:¹R&zĞÉ„*h*2@Ç*‡B€H\n7 tiAV&äŞ4`FÉÙ\$ÈŠ©Bœéî5\$€3ÄdÏê{a± ‡t´Œ¢á€Yëí‚„†ã/~Ê]C‡Ø#ÙØnâ…¼°rRºrh%J´h®uÃppjf¹ ÓƒB*ƒ!¤3»UNHC¤:WîDÅ‡‡ÊSÌ)^I	*“ò‚ÙUù\$GêH¦£äN‰)ÈQ	ê¨M*&&‹M³ü½\n2ı7E\$§,öVĞ‰!%n˜ì)f}=Ã‚PÄÂ‡	¬_Rc…<)…F€ÎW£‡ç¢|Íô²ı\r»ƒlşQÎiĞä£ñ›‡Ù\r´*KHAèÈ’u8àŞPáPu†¤¥¢’ŒWA\0S\n!1²Ñ3ÄMÃ	9'd­¿PŒ#™×›D˜º´©ó›/P¼µìr[D\\DĞ&ÒğÒQj¼úSë½Ÿ8Ó\"dÓ‘ƒntò¬MuZ‘!„3)¥ê½ëd\\RÊº¨ù\\¢Óla¼†8èŒÜ¤‰”Áô\\sêj(+e•Æ0âI\r%*`Æ”Uë)°U\nƒ‚©‰hl0¤;:ñj\rTlµ…äĞ £DTHÊ9D„ƒ-V:¶Ù†7¦\$UÛ:KŒ}0R³å£¥…¨lNÂ|KF8Êê@ŞC8aSÜª]:VE¬t«Öy6–@AbËËÖWd”“áBŒ(ÚKFw¬ñ ¡AÍù˜3åçÓ?gÔÄªÓ¢›T¾02\ncVú34‚¶èxÆV	a5zÕù)dµ§Ã|Ÿ¡‡¸Ø§Äf‹@";break;case"he":$g="×J5Ò\rtè‚×U@ Éºa®•k¥Çà¡(¸ffÁPº‰®œƒª Ğ<=¯RÁ”\rtÛ]S€FÒRdœ~kÉT-tË^q ¦`Òz\0§2nI&”A¨-yZV\r%ÏS ¡`(`1ÆƒQ°Üp9ª'“˜ÜâKµ&cu4ü£ÄQ¸õª š§K*u\rÎ×u—I¯ĞŒ4÷ MHã–©|õ’œBjsŒ¼Â=5–â.ó¤-ËóuF¦}ŠƒD 3‰~G=¬“`1:µFÆ9´kí¨˜)\\÷‰ˆN5ºô½³¤˜Ç%ğ (ªn5›çsp€Êr9ÎBàQÂt0˜Œ'3(€Èo2œÄ£¤dêp8x¾§YÌîñ\"O¤©{Jé!\ryR… îi&›£ˆJ º\nÒ”'*®”Ã*Ê¶¢-Â Ó¯HÚvˆ&j¸\nÔA\n7t®.|—£Ä¢6†'©\\h-,JökÅ(;’†Æ)ˆˆ4oHØö©aÄï\rÒt ùJrˆÊ<ƒ(Ü9#|¿2‹[W!£Ëƒ‚× ±[¨—DËZvœGPŒB†1r„¹³Â†k”Íz{	1†»¡“48£\$„ÆM\n6 A b„0£nk TÇl9-ğıÃ°)šğºJaÀnk–š¢€D­¡Ò6ª±\$‚6’¡”,×Ğ3T+S%é.ŠQÈâ šÕÉ¯Z U½FÁÙ1	*¥¨òö\$	Ğš&‡B˜¦cÍÔ<‹¡hÚ6…£ ÉPÖITˆ8°øä:\rŒ{&…H“\"û\\µOPJV„”èÚz½5‚zšÅIZw‡°lê[|§p:V–Û\$¨X©0x ÕtF É­K!ä	´¡ˆs›iai5òNälM”»\$ÎBƒ%è\"ÀÏs¼D„2T\n@¹³­šÀğ4…!ahÂ2\r£HÜïä‘ö‰¢x0„@ä2ŒÁèD4ƒ à9‡Ax^;ïv·®ëïÄ3…òğ^÷Ê£¤Â7á|˜!,Y:ã}!3kNœ1\nV´™ê±NÓî\"ä\$ó‹Œ×ÚMš¡Íí\r\"![>Óµí»~ã¹î»¾ó½ëÎø]¿ğ<D·.Ëü?¥ñzJJÄP‰ÙGÈrYNdœasÿ6Üä–“O¤~' [P¸s‰í¯ï0P:¥ø0¨4=£ÇÃLA\0î4ƒ`@1=£ƒ¾mª80†dº°cgÄ9†`êşƒ`oíyûè=©6\0ÆÚÃ\"^pÁ„64]3ÍâŒ×Û\n… \n (\0PRÁI¦Tì!¦&¾üÚğgƒ!¼\0äC³ø¡ÄSô|’aó\rçÖAï\0Ğ‡I©¤º\$òØÉ™CÅm÷óÛ[@s?,AH5Cpp§ìşŸğä£ƒ¸h\r!5ĞÎÜÙíáŒ0‡SØ€ˆ	3[Éüœ#\\@IzÔu&¼µ#À\\ƒb!Dp™“U®@ÉK0É´ =™6¶Yº“Op„¸ï`A_æØ’ÖÊŸÉÜatg40XtIÃßDN’e¯0V™<^Ò¡¬…\0Â¤—#„”‡‰@öLÁkZIZ™)Š÷fÄœ™1|€ÙD`Ô×1äuW´Ä2°KZm ´#HjIˆ–‘Ûd›S¡‰a-Õ`ÉÁÍa¯‘\$ĞvT`˜5Q^n\rsNbaiÈ…2Ç^¢'%îqm“šJ_˜r@­?œÒz V‘%©øÛ˜³l_XÛ/ŒÈ§´d6õ‹Y“3hšæh8Y5Ö0C²ô-l É2ˆ½™‰D§tÙ8“YëËù“HÔ­ÎÊ¸‚z@…­¢º2Š’Ikê1(ñ™^¯”×#”àİâ<bÊø¤,dÂ:ôdCˆ…§f¬I˜edI¨‰-Zí\$ˆ(ü^èõmO*íX¤šÊKÉiĞŒ9@+ITë¯­S\"m :¬‘”-¯N¶h“\$:\\éˆ";break;case"hu":$g="B4†ó˜€Äe7Œ£ğP”\\33\r¬5	ÌŞd8NF0Q8Êm¦C|€Ìe6kiL Ò 0ˆÑCT¤\\\n ÄŒ'ƒLMBl4Áfj¬MRr2X)\no9¡ÍD©±†©:OF“\\Ü@\nFC1 Ôl7AL5å æ\nL”“LtÒn1ÁeJ°Ã7)£F³)Î\n!aOL5ÑÊíx‚›L¦sT¢ÃV\r–*DAq2QÇ™¹dŞu'c-LŞ 8'cI³'…ëÎ§!†³!4Pd&é–nM„J•6şA»•«ÁpØ<W>do6N›è¡ÌÂ\næõº\"a«}Åc1Å=]ÜÎ\n*JÎUn\\tó(;‰1º(6B¨Ü5Ãxî73ãä7I¸ˆß8ãZ’7*”9·c„¥àæ;Áƒ\"nı¿¯ûÌ˜ĞR¥ £XÒ¬L«çŠzdš\rè¬«jèÀ¥mcŞ#%\rTJŸ˜eš^•£€ê·ÈÚˆ¢D<cHÈÎ±º(Ù-âCÿ\$Mğ#Œ©*’Ù;â\"‚â6Ñ`A3ãtàÖ©“˜å9£Â²7cHß@&âb‚íÇìäÂFräˆ6HÃÓı\$`P””0ÒK”*ãƒ¢£kèÂCĞ@9\"’™†M\rI\n®¬À(Èƒ&ƒ YVŠ%m\\U¨û­ğ(ÁpHXÁˆ%®#?^”#ĞìGğ`Ä˜©ræÅ¾£\\«#£Àb–-cmq	m›şş Ní@£jQãÉM>6ˆÎ<B¼‰óGe­ƒeîú×-áyG)@×‚Œ`][ÖxUâÚ³ãf^`Ø–(ÏáxÆˆb@PÚ‚\\RL’€t6ÊbØó™\"è\\6…Ã#à0NØØ’IKÓ5ãZ7ŒÃ2€…0SXÇ]/¥<úŠƒ{_x´a\0ë@£ÆÂc0ëçã:î9…‰ä<¦=å.ê]f6®ãª²aJna‘#ì«´u‚b˜¤#&Õ‚3	Qf^!Y¼£’b0Ô×#æ0ÃQ¬~®Y¡]©:)¸¨Õ@jé'½Á\0‚Ğ®èÖÒ1Ğt\nç=‡‰ˆĞ¤ÁèD4ƒ à9‡Ax^;ùuíº!Pl3…è@^’NÃ¥7á}ê7ÏpxŒ!ó­c\$…)M°Õ/›K*Û9Õ%Lƒ¼…ĞÕË8ïä`ØCÑ\0äÅCÀp\r%!rj]ã¾x	â<gŞS°y ¹ç½°ŸSúPod¦à’C¶|áÑï¾ädŒÑ7\$èÂ^lÓX9(Ø6¾GÌB\nHe@è7†ÀõÑYåÈ«’´k(l„ 7“Œ|Ù0oYA‚\0îmQËô#!È3 Ã\$¬Ãfha¯6ÄÙ{fA\\ÍZwŒ pä†Â™7	ÅÜ¼º\$^F‘’í>±ìÈõöÆJºÒ3†x½²vÜ@Ş \n (Gäa N°()ˆ¬9‘ònÔ\nŠn´›dm\r´CVhiS„…‰€lgáÜ¹7¶úßÅK2È!{àŞ9q…Ä˜‡4:×ár3F´»¤ä8ÿQV8!Œ4 ÒŞèÑÈ0¤øNW‰<'Å\0È•£:¦Ro)Jp£•˜\n’	(nfLÏ˜#Ò,&á\$ˆ‡“N\"Z5È\\„+34pŠ@q¦¥dH{Ì#Q¹6'NÂC±\rÓÄrEƒY0’A<)…B`oC !p‹8[³sƒœ`TÒô¥brŸh Á†CŸál¹£r çü«“ºçš\$ÜAíŸ¯jD¦¸ \naD&#jkM¡1ÁRJ†µ¡…Ô6‡‚	:ßˆÒ6§¡WePK)9­hæ‡œfY*y®g¡L˜ÚvMÕÅ{‘%Ü¬¼'`U}l°g8¤£V?`Š=„±²|:0WEƒHc¤1T˜Ó°ÙBá[' !™¶\"ònª¹Iå)ú7ª0-	ÕÚPÜì³\"ÉìÊÂö+û·u‚ßû‚®.½Cw¿‘Ò>HI%ÍüŸ®Ã·i{/©XğpÓi\0Qy%t¸„%À¤§c\r*hé¨³ª~—b“`ÔŠö¨ÉAN\r;‹xÅ‘YÖ`D‰9T„‰‹2I]ËÚÎ+L=(PßS™9H @ÌmyØ7¨»…œ¥F–gL‚šDv­QÛÁ'~ä Ë…‹±ië2ÑL¹,²¬,Ğ(zT\r€¨?qRAYk4ñ“´¸Z×\rÇÀŠÓ¾Ì3?¯bJÌ¢¯±Ï ";break;case"id":$g="A7\"É„Öi7ÁBQpÌÌ 9‚Š†˜¬A8N‚i”Üg:ÇÌæ@€Äe9Ì'1p(„e9˜NRiD¨ç0Çâæ“Iê*70#d@%9¥²ùL¬@tŠA¨P)l´`1ÆƒQ°Üp9Íç3||+6bUµt0ÉÍ’Òœ†¡f)šNf“…×©ÀÌS+Ô´²o:ˆ\r±”@n7ˆ#IØÒl2™æü‰Ôá:c†‹Õ>ã˜ºM±“p*ó«œÅö4Sq¨ë›7hAŸ]ªÖl¨7»İ÷c'Êöû£»½'¬D…\$•óHò4äU7òz äo9KH‘«Œ¯d7æò³xáèÆNg3¿ È–ºC“¦\$sºáŒ**J˜ŒHÊ5mÜ½¨éb\\š©Ïª’­Ë èÊ,ÂR<ÒğÏ¹¨\0Î•\"IÌO¸A\0îƒA©rÂBS»Â8Ê7£°úÔ\"/M;¤@@HĞ¬’™É(ñ	/k,,õŒË€ä£ Ò:=\0P¡Erµ	©Xê5SKê‹D£Úœ£Òàİ!\$Éê…Œ‰4¾æ)€ÈA b„Bq/#‰Êê5¢¨äÛ¯Îºàˆ¢h12ãHĞ×£Ê6O[)£ ëT	ƒV4ÀMh—Z5Sâ!RÔé äÅ¯cbvƒ²ƒjZñº\"@t&‰¡Ğ¦)BØói\"èZ6¡hÈ2TJJĞ9£d>0ìJdÇ\rã0Ì´Ã*è”1²Ø—S©’\$7²3›t\$/¨Æ1¦˜ÍW„`Ş3¡˜X§CÊ„‘¡\"Ï£jÛŒ¡@æ¥¢ Ş5£Á\0†)ŠB2¶\"	 \\Vö-øÚá\0Ìô\rµ}h¥¥.deêô¢L[Â›æi›ªŞ„É‹]£–1ÊÈ¢PˆÑSÁèD4ƒ à9‡Ax^;ìr‡¦%sĞ3…èğ^ø@Ê‚Ê„Aöà7¡à^0‡×|(ÅŒKÖ`ÀôŒß‚Œ8B[74)›ôş?ÒXğ8Vƒ+ÿªjÚÆµ®kÛÅ²û6–„m;^Ú7m²š=*õ	-[0Ü›Öù'H#@ß>ÌA‰?)EôTÖ¤n`4±SÒo\r#6:41ÃÇ¹(#»/a\$ì’Q¢£³èÃ,êwö\0ıàv\r„{2úJÑ±ÉŠ:u0Éâ\r0L,\"Â§˜TnKõÕ¼À 8'IyW¢t\n\n@)dğª(ÒÊ»^»Hw¦LÊ™s2åŒ‘ø&æ”ù” ØÁƒ»–%¡¸\0T‰ˆhzd ÇRÈË\0bEøC³¨~I[Iô;š@ÆIX°gk„Ğ§½GèNªîTˆm‚†W·Ã¨mA@K”äæ„\rTYLÅ/Ò~NYZ@h4†²€…IhI!áäÄ´û	C™w†›ª`âIÇœ6´—FÓbk!l<ÄÔHâb‘ë.\0€(ğ¦\ny((¬øšÒË*.y‹€¡œI<'j˜5•Xƒpf\r\$!Ba£¨c6&yƒ2„Ÿ™ˆS\n!1™Aà@eˆF\n\$œ§Ó€~2„Ax6”ìC:XIxÅGöÌ¢¾›DîT' ÒKB,à\r)\"l’¶v—!|(µŠ\$¹Õ&C’%GŠ^(Ô>\\‹\r!Œ‹Y~L€3„qİ½—ÉhF˜ÌÕÄÆ\"B F â{5¼Gç¢}0fP›ÎÕ‚Næ{@î%Ö,·1rM´43nU)!AISÎà}S¹Ğ;h7™5\$QUİAG…»&²8‰ƒ©ƒ\$¡¸Ë†˜B'8\n	¾_ÓĞ{ÏeZ«”|ß\"Š¾€S Æ‘-…5é?jÁWTŒ½åN^»–T­Oçù±>émGNHQ•1Tè¶™zHwê \rHŒ9€";break;case"it":$g="S4˜Î§#xü%ÌÂ˜(†a9@L&Ó)¸èo¦Á˜Òl2ˆ\rÆóp‚\"u9˜Í1qp(˜aŒšb†ã™¦I!6˜NsYÌf7ÈXj\0”æB–’c‘éŠH 2ÍNgC,¶Z0Œ†cA¨Øn8‚ÇS|\\oˆ™Í&ã€NŒ&(Ü‚ZM7™\r1ã„Išb2“M¾¢s:Û\$Æ“9†ZY7Dƒ	ÚC#\"'j	¢ ‹ˆ§!†© 4NzØS¶¯ÛfÊ  1É–³®Ïc0ÚÎx-T«E%¶ šü­¬Î\n\"›&V»ñ3½Nwâ©¸×#;ÉpPC”´‰¦¹Î¤&C~~Ft†hÎÂts;Ú’ŞÔÃ˜#Cbš¨ª‰¢l7\r*(æ¤©j\n ©4ëQ†P%¢›”ç\r(*\r#„#ĞCvŒ­£`N:Àª¢Ş:¢ˆˆó®MºĞ¿N¤\\)±P2è¤.¿SZ¨ÁĞ¨-ƒ›\"Èò(Ê<@©ªI¥ÍTT\"¯H¸äìÅ0Ğ û¿#È1B*İ¯£Ô\r	ƒzÔ’r7LğĞœ²ÈÂ62¦k0J2òª3ıAª PóD¤`PH…á gH†(s¾¬ëÜ8°ĞŸ1:’¨Ú•ÃBÔ›µóİN¶:jrÅëğ3³Ã¢Ì ÀC+İ¯ãs8¿PÃ-\\0£á×_®Au@XUz9c-2ª(Òv7B@	¢ht)Š`PÈ2ãhÚ‹cÍÔ<‹ P¬Õ7®ô=@\r3\n69@S É\"	Ş3Î”é\n°L´¶\"°ØŞŒNcËÄc3¨àÙ78Ac@9aÃµØÉ-\rQÓ0P9…)h¨7h¨@!ŠbŒ§\$­“¤öÁqh&b`ˆŒmLÇ;,\$b2àÈèŞÆ-ÊKˆbV¾TÊ;ÍXÍ#¥p@ Œ™#iÉª49â`4Z@z\r°à9‡Ax^;îu«¯<«@Î¢¡{Ø¶7i ^Ûıì7áà^0‡Ø\"w5¡‹èÉ8ĞÃ3\"Èäš¦)ğ7®éÒ©²>ÉÜÃföÒıì»>Ò3m{hé·î;ë»­l]½oƒvù(\"²—|(Áğ’6	ûÅqPA\rËA†9mŒúÎCè‹%¢bBáñé\$>2Ï,ÃÁ\$+š>•ÚZŸÒ1ğ)(î£‹£2Ájã’)@#7F|X‹b ‹¦ğ@üÃ h5|‰’ÆêÓ:Ñ\r‰Q„%‚Ipm'\rÌ˜bvÉò¹AğYñ\0 ñÌ9#N\n\n0)&!Ìù €ÄPIhC\$‰Ñø5£BfƒIœ\$y@BÀèjÍQN>”7‡pÊ~Èt\rÉ¨¶Á‚ÍƒI}Í¥c²a\rd0-‡PfSú€æ¥ ¼óÛT	!09Ëœ6TA!Z	/¯ 4³ `ˆé•-¥&uú‚ŠI&D˜¨ŞCª€1%´©ÄGH mkmuÜ¶HæIC8f¢\$Ÿc=Ã|yDˆ_Â`Â£9\nQdÅÄ>½’0 réöC³âbÚU´A@è’àÎ@Ã\n«H‰Q}›‡´hHoZ²é@˜À@ÂˆL(6V„`©\n^Ò€&QëÉ„{\$“%§E>&tôt™!¦tAåNét­	°rpÎv'ĞŞ‘NÄ%…ü6+ˆÃaJÇ‘,ÉêE\0	)F,Ä/‰änŒk‡›²Z–#/9A°ÊÏ‰ÇÚA¿vÈKÉ{sL^ àÚJƒödT*`ZA¹/N –¨bÒL'ô=*£Fó‚ò*QT`„‚eB|\\‹¢&dÅ’‚T\\€Qx/A˜<®#‹\$S¨\nGùU˜ZaXÈ“E©XµÒŠßL‹í.yôÄ¾Hy,TÈÅ,m/vi(\na\r-`M«Tç\0¤¾›Ëõ&EøÀ:21A¨²~Pe˜°Î†UI ~<‡1uXÂ\"5”ª´¿5/VË¬r.vÅ\rÛ:µZªua¯„HĞ\"‚.";break;case"ja":$g="åW'İ\nc—ƒ/ É˜2-Ş¼O‚„¢á™˜@çS¤N4UÆ‚PÇÔ‘Å\\}%QGqÈB\r[^G0e<	ƒ&ãé0S™8€r©&±Øü…#AÉPKY}t œÈQº\$‚›Iƒ+ÜªÔÃ•8¨ƒB0¤é<†Ìh5\rÇSRº9P¨:¢aKI ĞT\n\n>ŠœYgn4\nê·T:Shiê1zR‚ xL&ˆ±Îg`¢É¼ê 4NÆQ¸Ş 8'cI°Êg2œÄMyÔàd05‡CA§tt0˜¶ÂàS‘~­¦9¼ş†¦s­“=”×O¡\\‡£İõë• ït\\‹…måŠt¦T™¥BĞªOsW«÷:QP\n£pÖ×ãp@2CŞ99‚#‚äŒ#›X2\ríËZ7\0æß\\28B#˜ïŒbB ÄÒ>Âh1\\se	Ê^§1ReêLr?h1Fë ÄzP ÈñB*š¨*Ê;@‘‡1.”%[¢¯,;L§¤±­’ç)Kª…2şAÉ‚\0MåñRr“ÄZzJ–zK”§12Ç#„‚®ÄeR¨›iYD#…|Î­N(Ù\\#åR8ĞèáU8NB#Œä¶ÒHAÀãu8Ö*4øåO£Ã„7cHßVDÔ\n>\\£„E°d:?EüË3–Ç) Fª„gD¯äª%ä`«–ié`\\;‡95J¨å›gÉÄ¢t”)ÎM•ÑtxNÄA ‰ú«ÖÊÌNÈñ:\r[ˆ\\wØj”„áÎZNiv]œÄ!GGDcC¯\$Am‹ÉJÜàQÒ@—1üÒvIV¼–åqÊC—G!t¼(%…bÅ¹vrdÂ9&(ÊFFtœPİ—qJaêQ%gÅúC-4:b\"s‘åô±JSÌöÏaÔÄCHÂ4-;ò.…ÃhÚƒ\"©]aÈı|6ƒ“HÓäÖ\rã0Ì6\r#pË)vM×m#öâRALØ€¨7µãhÂ7!\0ëV£ÆÜc0ê6`Ş3ï£˜Xİ\\ˆÂ3Œ;èAÕ·hÛ¾®P9….cÖFœÅl~@•B¦)Õ­larÄn‘ŸºÄÌ@ÈDˆ@ÈØ¯	g%ÿ[\nLİÕ\0ëVÃ8@ Œ~ü9tc_VŒ@@-Fî3¡Ğ:ƒ€æx/ğÒßP@.Aaœ†PÜĞ¢¢Šº‚ }N}àğ†|àÙ*#âÜ7Š QxœçÄH&%t ˆ)zëp¤Bq.¸Å£ÍyïEé½PP‰ÂTè€9¢\$HÃÀp\r-İ¿7ê»ùoõÿÀà,}p(9@ÈUTUª¼‚\"¢‚HmØ6Ààé ò§7®Óxpk5¥ ‡ßƒpt„ˆABA	‰1>'™Z-–™ÒE^otÖÇÕx æÕÎ#XCáQµv†ÍÓ•rñÍ9Ç<è4›8†ì4Àæch q27Â™ÌFÉ#dp’3Æ€²bx@PjˆÅ£Tn:ÉD‡“9’ ¡\n…xB”Î!X’a„yëbfš0†«Ûô—ƒFì×›fmM¸e]¨t9Ctqº—îx;Ï§l.Ãº ÊH—8U ¤£wuféú‡4@åİZ8‘ì7bl\n#K´;œPÆ#ÀiïìIéhka|mü¼ŠäØ›‡(óbd\n¢|P\n7Wlˆ™dèI‡@¶4\n!¦–!>ñ•)&¢ˆ„%°X¤ƒÒ’KÔÆ€ ’EƒËt¥všä2„ƒtv8¦é»‡ênPÈfAAµóÅ§åFĞ0csÈJZP@n`P	áL*ÆØLUéƒ(\$Ô@“qCKoÃ&q~GÊbNBê©¢‘‰H´@ˆµ<:@­MuJ ØÔƒ­}Zz‹ÌÒšzbó€ÍÖ–Ò @ÂˆLš|hıB0T\n\rÖ´º¸Ô‡]q®hi´Æ—\nã\\¢ISŞ|IL,•:ì.%É\"DØ´ÂYgŞ'šDJŠà¼×lIc,fmã ×ÁvŞ‹Õ{/ÍïA\r¸†ÀW^ƒHc\rj}?Pí/ë|ôÔ4†g#`F¸¡µñ¡š\\ê‚¨TÀ´*İXß)Ìu €Í’e GêÉ©…Šı\"Gómf¬]Æ6ÇXù4&Æ&g4^î˜Ğ™yB€Ê‘,(qæ@ÉE,ñúŠ»™LÈ™2GÓ‘ÜÈwpû’ñ/Ç@¾&9œÍ\n¬Íš3Qç¬ö‘ÄTÛTy='ãœZ˜âô*3àÂxN46Æ˜ãÃ˜\\/¢¨n:Z\$|°hõ ñ:ÑĞ×c&×e¤K`iRÑ',p²qã#3uX'qDšÇ(€€";break;case"ka":$g="áA§ 	n\0“€%`	ˆj‚„¢á™˜@s@ô1ˆ#Š		€(¡0¸‚\0—ÉT0¤¶Vƒš åÈ4´Ğ]AÆäÒÈıC%ƒPĞjXÎPƒ¤Éä\n9´†=A§`³h€Js!Oã”éÌÂ­AG¤	‰,I#¦Í 	itA¨gâ\0PÀb2£a¸às@U\\)ó›]'V@ôh]ñ'¬IÕ¹.%®ªÚ³˜©:BÄƒÍÎ èUM@TØëzøÆ•¥duS­*w¥ÓÉÓyØƒyOµÓd©(æâOÆNoê<©h×t¦2>\\r˜ƒÖ¥ôú™Ï;‹7HP<6Ñ%„I¸m£s£wi\\Î:®äì¿\r£Pÿ½®3ZH>Úòó¾Š{ªA¶É:œ¨½P\"9 jtÍ>°Ë±M²s¨»<Ü.ÎšJõlóâ»*-;.«£JØÒAJKŒ· èáZÿ§mÎO1K²ÖÓ¿ê¢2mÛp²¤©ÊvK…²^ŞÉ(Ó³.ÎÓä¯´êO!Fä®L¦ä¢Úª¬R¦´íkÿºj“AŠŠ«/9+Êe¿ó|Ï#Êw/\nâ“°Kå+·Ê!LÊÉn=,ÔJ\0ïÍ­u4A¿‰Ìğİ¥N:<ô ÉL a.¯sZ’Â*ªÍ(+õ‘9X?I<Å[R²óLÇ(•Cœ¾);¿R®ÒíJÇMœxİ¯š: H”Š³ÓñbœÖ¤2œê%/üõ¬öJ«=‘•Û•£š7R“*Œ‰,f§Ô´üÑk´€PH…Á g‚†*ıj]°Ÿ\0ÜŠ‚‰)VO‹ù!BTR9pÕ3¥Ü¬Rpm§OÎôÛgdcĞ§vdJ\$ªì§T¶2NÖÙt Vö•§Üïå\0ºë^b´Ã´BU?ŒÊnçizEA)Mkœ¯_(êĞÛpØ•Xu­%ûİxÑI…ÔƒÄ-ì›>âVªVÿÄƒ`è9nÉm{©÷Š—ÖYÅ+ ê‰=´ôêw94:Š•oÃ¶6©puœª¥|¿õ\r[£•{gQ¸×>†»¿ú4{GvÍ§#!y‚ã£q¬îS5!4î¾J¥äı}!Šb*yÉÃèïlìY­›¨’ßè÷t„Ê6Üİ“[ş¦#š·ÉIVß¿Èmj'MÁ×+v¤ûNkOs¾)	?HóŒ|TÀ !6†ÜC“Ì€.İiº'Xk”»·,Æ´êÇÄºû(7o¼¼–Šràa 9PÌAhĞ80tÁxw†@¸0ÀH\rpoAœ†PÜÃ o\rÁ„:˜„Á>toÍJ›¢<Nàûê2àğ†|ãOúã?.“1#vöà{×uê1Y<2<n¹¿‚Î1˜¤ ƒ±Ït…›¿'ªSÚs¸)ë€0¸ûÉ%vEUÚ'ãĞëĞDl:Äİú’faa%„ğ¦ÂØ_aœ5€°9C˜waøeÒ8Á_‰Oô—b<“^‰eŠ‘X¤ô¸ëËa_g“–iƒ¥«¾}±xAGÄ¼&v<FÁ-Èµ<IN¹¸Y\$–W©T§bÔgåØï”˜4°»)ÑAÆ/5Å&“Ô-\$ö€SëïCeUsªT½S,uy®¢G—0\"Y9)1€I\$‚8¯Î<·aÁišVúqÅSİ¡&õh­¨0ÍÛˆ™ò(ì-:8ä\\)ì-/5pPWÁI§[4j\n4™Ó;à{ESò}ª³šIMÑ­EëIGs®j_bÕ[?uÓ+Ã¢®©”­iò{)šÚ¢b•\$T:••Aê©á¼ê‚@åÚ,#Ì,ûÀù~NP|İa±‰ØÈIà¹‹÷RMÄœÏ„*)Ÿ•öVS¦r§sÄ~ys•3BIMú•Œ¡\0‰	vª£É;Œ\n½02ë¦R.Ï™Øc¾ûÚueñ1wlämUp\nIÈ\"d»ƒ4Ëj\$ƒèA¸sËhÓğ Â˜T->¢v¹çü¿rõÛ¨é©Şš,}3ıÕ¾ò°¨åù'´2±Ä•XÀQíıÁ¸fá™OB9?ëe×§„AËÇ‹M]]˜wiXx.9JL“A†Í28©iiÇyÊ¼#@ óÍ=œ4	×“‘\$ø“<¶R¯¾Â^Êh¿SıM-rùÃN­n!¹JÅy”óRæ&Ñµ^x‹\ruTg-DB¬Èb10®qQJ·k\$ñŸò<k#š_ÈÛ¯Lmgç&õ•6·ÅŒ’ƒ`€!·°Ø\nÔ'?˜²0@ÊajNºaM\$5_R_åÚû¬{Ë`U\n,_f¤RVÌwT³O!áÆ.iÌñÆ£Iö]²=y)¥ÈXµñÏÒ,SJ7y\0×,eÿ_Ê•¾B]½â<½©´R]Î®,²‰|WqÂ˜&àWœBµ Œ†]£% Ü™ hæPrÁ†Æø—ˆÂah³J.„.ë’¤7ºâÇ}Sëf ÀH\"LrIö™OJg¡É>Ë\$¥ |…­†rQ½gƒgIw”i‹ĞòvË'Á@ÒêWVS/e¬NÒpaZÛqŸ’ŸĞ8sL.„ËIP5h3Aî\rÙ¸Ù™";break;case"ko":$g="ìE©©dHÚ•L@¥’ØŠZºÑh‡Rå?	EÃ30Ø´D¨Äc±:¼“!#Ét+­Bœu¤Ódª‚<ˆLJĞĞøŒN\$¤H¤’iBvrìZÌˆ2Xê\\,S™\n…%“É–‘å\nÑØVAá*zc±*ŠD‘ú°0Œ†cA¨Øn8È¡´R`ìM¤iëóµXZ:×	JÔêÓ>€Ğ]¨åÃ±N‘¿ —µô,Š	v%çqU°Y7Dƒ	ØÊ 7Ä‘¤ìi6LæS˜€é²:œ†¦¼èh4ïN†æ‚ìP +ê[ÿG§bu,æİ”#±êô“Ê^ÇhA?“IRéòÙ(êX E=i¤ÜgÌ«z	Ëú[*KŒÉXvEH*Ã[b;Á\0Ê9Cxä ˆ#˜0mxÈ7·€Ş:›‚8BQ\0ác¼\$22KÙ„¨È12Jºa X/…*RP\n± ÑN„ÁH©jºˆĞ¬I^\\#ÄñÇ­lˆu•Œ©<H40	ÙÀ…J¾ö:¤bv“ªşDsÿ!¾\"ÿ&²Ó‘ÖB DS*M‘‡jœƒM Tn±PPˆä¹ÌBPpİDµê¥9Qc(ğâÃ˜Ò7Ó*	ÖU)q:¿½gY(J¤!aL3´u”Ó±rBo‰ÖYAq+¥çQnÊ“µÜŠ@E¬P'a8^%É›_XÚVÓåKÎS‘‰‰I£##ÎX1’iÛ=CËx6 PH…¡ gv†´dédL®U	‰@ê’§Y@V:²!*^Íè¿…ÚAÔgYSp—’¹fÄR„¾V0dfj¯å•ò[)‰±ˆx™ÖA–àKoaØ„w’±\$¦Ò2\nDL;«=8’e±#é¶<éÈº£hZ2’¹X+UMV6ƒ“NÔ„ä×ã0Ì6>Ã+B&”í^×ë3ºM`P¨7¶ChÂ7!\0ëL£ÆŞc0ê6`Ş3¾Ã˜Xß[ÈÂ3Œ/°AÉea\0Úû®(P9….{	O—gY ™ˆb˜¤# Ä6@–sÎ€¡O>M”…PEÈR\$OmŒ©+·î\"£Y·£5:ÓO¸@ Œœ¸İñc9Mx@-^¾3¡Ğ:ƒ€æáxïó…Ã›²ÂpÎŒ£p_\rÑã¥7ùA÷èâ>Ã8xÃ>læTB“‘Ö¶X£¸ô\$3ÎïI0¸Hà…\$VlPÁÅRˆœ9¢”VƒƒÀp\r-}=w²Ûİ{ï…ñ¾WÎßKëyï´9>÷âü»ñSJp‚\"¨‚Hmä6¿èÿà\n‹ˆ§7­ã~åƒk5á¥ öìóÃpt€c²£¶.˜`›¹‚ÅáğÂß²œÜÜ8@ÄkÃ‚xÁÊ\"­àÂ Ò!o­ş¸'áœB\r‡ßƒ^ÃED`ÒC`s2HÍ£trh\rT4Á@\$d PŸÊ`¹ˆ„ ¢”Ë!,òi+58óãCı7ÆÈÚcpnƒ*ŞDÈ:Ó’‡‘pÁŞ`¹éV*£ä-¶¬å!šû“7¯d9¢vşäĞiÇŠa¸89“fŠPr[ÁÜä0ĞåƒHg{à‚7ÈS^ÃÈlËğ“™LH93))»òc@‰Àë¢ğ²/3'©T \$ŠCä«È\n\$8Æ‚I-p2•¼lQ\rÑ8äÖ¾C©¼D™†×—´âA¡Ã!™1Ñ9»(!@'…0¨yÚ›UUR˜óˆBÖ+\nÚ~¦”ÈÔ†¨¸•QM)åF‹‘áHwRhê(á¨±Ù*f%TeXQÈÄîÚÙªŸ4à¸gÔ×g¤ñL(„À@¥ø 6ïd#I<İÖğiˆH•ÉÓ:jˆPy®Beéj*¼ Ğ ”FZ3e¦µQÙğ\$…	j%U²’³öXN’¤¾fÄğ…³ŒÒŠWWm¤¶tLÓ6²]<\r!Œ5¨ÄöC´¦2íËDĞÒ›ÌT(!À†×ˆ'«’\n¡P#Ğp£•%>öÙo1hO‰ĞbÂdÆ[CLaŒAŠ\\6¹„°±:AÉ°ì':÷%`›s®‚¤?B ş¡h á\"2†XÌ@qŸ…aÁf\\Àß]ÃjCH[\ná{Ä~š0+Å‘+Šy`  :öSëäI±d,(zİ Ì)†Ss&§í+²†`ÉÙIQPW¤P1dŒ·]I«H†/Eí|y‹3Ø©|/¬\$eL¸";break;case"lt":$g="T4šÎFHü%ÌÂ˜(œe8NÇ“Y¼@ÄWšÌ¦Ã¡¤@f‚\râàQ4Âk9šM¦aÔçÅŒ‡“!¦^-	Nd)!Ba—›Œ¦S9êlt:›ÍF €0Œ†cA¨Øn8‚©Ui0‚ç#IœÒn–P!ÌD¼@l2›‘³Kg\$)L†=&:\nb+ uÃÍül·F0j´²o:ˆ\r#(€İ8YÆ›œË/:E§İÌ@t4M´æÂHI®Ì'S9¾ÿ°Pì¶›hñ¤å§b&NqÑÊõ|‰J˜ˆPVãuµâo¢êü^<k49`¢Ÿ\$Üg,—#H(—,1XIÛ3&ğU7òçsp€Êr9Xä„C	ÓX 2¯k>Ë6ÈcF8,c @ˆc˜î±Œ‰#Ö:½®ÃLÍ®.X@º”0XØ¶#£rêY§#šzŸ¥ê\"Œá©*ZH*©Cü†ŠÃäĞ´#RìÓ(‹Ê)h\"¼°<¯ãı\r·ãb	 ¡¢ ì2C+ü³¦Ï\nÎ5ÉHh2ãl¤²)`Pˆ›5‹„J,o²ĞÖ²©ÔĞßÍÃ(ğ¹ÉHß:¤‚›–Å €Rò½m\nÈ—Q¬nÛ)KP§%ñŠ_\réª(,‰HÔ:»ëø  4#²]Ò£M.ï¥KT&¥¥ìPÂ®-A(È=.Ê€ÕÕ‚3 •¥_X‹°<³àS.ˆZv8jæŒªâ*¿³c˜ê9OÈÒ¿<¢bUYFƒ*9¥hh‚:<tÊ\"tU”1š¤B\näÅ»D¸J\r.<¸o+~FiÍ_%C’`\\ßëµû-è%œ‚`øIfáŒ8f	g1 RöôÚ‚@	¢ht)Š`P¶<åÈº£hZ2—É+¸ƒ\"“/DHj9j1ìŒlÊã0Ì6,ã,òûÉô®eKS:ş*\rè²V7!1ic>9ŒÃ¨Ø·ë4ê4ã–ªä,ğÛëZ«8ê¹…˜S	JVòRï¨\0†)ŠB3N7£KDLCÜ™ÂÌªS…8ƒ2Æ6é~m.®-RößÈ1»–’	F)V—¿ºc¿2£r’†(ã/!<,›â—ñÍú\\³Œá\0‚2mªå²sºR2>á\0yŠ0Ì„C@è:˜t…ã¿¤=ÆŠ9ËÎ®!{Ú´#³¸^ŞûûÚxÂhô·\"W\"•R¥õˆÎ¶%7UñÑq0Ú¸e˜j\$d•N<ƒöÀß¥ÔğÌ“Æy)æ<ç ôƒ»ÔzÎéì‡'¶÷S’tNÁ¹ñ“ |Chp.à:>—Ö™Òñ¨R-ü²4†ĞPp>íL¸‡GÚ¨‘Ù`¬<®N´ÈğbsÇŒ*6œPxh2¡„1¾êÌã_FV'b—•xaÅÌßµ†´ƒZë_\$MˆEƒPiâ‘)x3Œğ!,u†¶±XTˆHi\rå®>™e¼Á—Èv!\$´ºÂ€H\nz@\"\$v\n	ÓsA\r;”(ªí!¡™\r&lÎ—¤‚Iyª2è(– ïˆsu&ÎĞJ'DYœ€ rlà<ºÀ©2t0ˆµ¦Õ©g\r½u Ô•xw5!Œ4CRÊò••5T1›0æÑ”)¾0Œ’VKIyp\r!‘G–\0ÚÑ`l‡M„bMŸÓÕi\\ì¦×XHXy2êu D7Ü<p5G8‡S>‚ƒ1ù\r®Ú\r¼¶}C\"›ô(—‘<IƒÁ/fĞ\0Â¤ºfåÄÆ‚\0¦I\\í>3ö•9@İ=WÈk#\0•ÖMI­34ÄT7bÊçˆcTO½Ó1@éPÑ:1ÔnŸSFH­<V–—˜GÌá•3lT#I&á•y*AŞú\$CA÷\$†>J’¸ÌË”P0	v7’\"FŠ=z®•ô9¦å¤Öš3¤»0jª•b&*nÀ0»u+èi`öRÆ·›.bØÈC\\°ÑÒÃZh>¬T;Ê\r5ÍTì“ÚÃ\rIr\n‹s*…@ŒAÂjwµ3’K?a™#…1]4øGˆÅÊ#¬ã•ÄwtHÙşn„a©¥Ö*W)Ä.È¿‚J¤CM³TÄ_ÀÔJˆ°tµ¡É §àòW \nåñlâÆ[Ûm8§¾›Ì@Jàm80\n8\ni~ÕÁ›—.˜±©6‚`o«.B`šRÃ†gÑß^ä¹F%Tb\nU\nÉ—œ`ô×òîº¢…Yã5sŒÕğS#a–*—£ÌH°¡¤¢µ®èQ‘KPIY¢…g‘éwK%ã.h|KÍü1o*ö°j°ò„»Gˆèp9`";break;case"ms":$g="A7\"„æt4ÁBQpÌÌ 9‚‰§S	Ğ@n0šMb4dØ 3˜d&Áp(§=G#Âi„Ös4›N¦ÑäÂn3ˆ†“–0r5ÍÄ°Âh	Nd))WFÎçSQÔÉ%†Ìh5\rÇQ¬Şs7ÎPca¤T4Ñ fª\$RH\n*˜¨ñ(1Ô×A7[î0!èäi9É`J„ºXe6œ¦é±¤@k2â!Ó)ÜÃBÉ/ØùÆBk4›²×C%ØA©4ÉJs.g‘¡@Ñ	´Å“œoF‰6ÓsB–œïØ”èe9NyCJ|yã`J#h(…GƒuHù>©TÜk7Îû¾ÈŞr’‘\"¦ÑÌË:7™Nqs|[”8z,‚c˜î÷ªî*Œ<âŒ¤h¨êŞ7Î„¥)©Z¦ªÁ\"˜èÃ­BR|Ä ‰ğÎ3¼€Pœ7·ÏzŞ0°ãZİ%¼ÔÆp¤›Œê\nâÀˆã,Xç0àPˆÄ>ƒcî¥x@ŸI2[÷'Iƒ(ğçÉ‚ÒÄ¤Ò€äŒB*v:EÂsz4PŒB[æ(Ãb(À‰ƒzrä¯ÀTë;¯¨Û0 €P’ç¦Œ0ê…ŒŒ(òç!-1QoĞ›LhÖˆZtØjqÈÆ¨ÀZ–Í‚›¤ÉBBˆ)zÜ(\r+kˆ\"³”å\"ÕCÔ2Òâcz8\r2ûW\rÃ¤aDIõÈ@çÁéĞÒ4&öSà>Ê\rŒ3Õ¢@t&‰¡Ğ¦)BØós\"íN6…£ ÈV•²tùCd?X (ìİ'#xÌ3-£pÊ’Š*Œ›N“³/ƒ\"ƒ’ŞèN0šôê#sHä1¸Lûv6aSÂ7„')\nF\"ªŒ/S‚DË(­ìk©4HÚØ‰(¨7³\rØ†)ŠB54ª-àĞ\rœjY1ƒ\n÷Çm\0Ë(Ã;c=aLÄå¥'£’è›fÎ‚b¨)‚ÌXÈ8œMir„ Œ™9d˜³7‰Ç­’Ñ‡ˆĞ9£0z\r è8aĞ^üH\\¢mÎ€\\÷Œáz|Œ‹J*4­!xDlã# –‡xÂ6OÓ-h(ó€êÉ™\"aã“ã•?2ÒÚ’ÍÖVU«·c­”–Ùø7S9uš&òo{îÿÀğ|/Äü^ÚÔñÜ‡\$7rRº}-{”<hÃĞôa\0Ç rcBÑìã=€0Œ¨ÙgJBİ¾É„J9NV’\\B1€fÁ û†ÆBH êÔ“×öyœQ!„3ğäD¨cgè9†`êGİ‰©A¤:ˆJ}Ğ‰œ|ÍñÏ,’âáp.HPß“‚nIì5~à€(€ MZh()@¥i‚ÌNûACeY‚xr…Ù˜ ˆ\n Dƒ4LLéRËH“ø¬	yú‰&9´2ßá¯?kè‚Á³^ná<ou„ƒ dƒ@ie!™†waO¼q|çI£r\rÜ(N¢>0`Ê–™–ZŠ%EÄ½\0š+&gäà ‡C˜†\0PJ#D›˜Æ€cŸkHZÏí·,¢„l™‡\r±ÆÁw_ó«yÁ3›³`|SxP	áL*<øü‘úF\r%†PÆ­NawGÍ	‰8ENaÏYFÔ¤¥Ã@ÃoIQğŠb0F‰Rµh¡D&ERrOPŒW3 Ë`©Ñ¡´Š“Í9dÒÁÉ¹%PfAà­vAHm‹ôšHÅ¤fI¨5T	B\$ÊNØô_QÆ½BPWS•ùtK\r†ÀVËhcb°ÌÕc,úÈÙœmÄ	Î£8AÙd¼&‰¤Ò–dhB F à’Ñ³‰(¸iŸAÉš¯ ­V™B5†º-µ–¶uU¢ùMœ:p¢€\nc'ğ¦€ÂïÃÀÇÓ2KHÌojiÔ¢'	´×šÊj…Ô­Å\\Q•AkFK6†WXtŠ˜>ÉÈè´…™QÈˆT:[&Ö8`B)/@51A¨Íy l´šU7á(K­§;æˆ——R¯ÍPs";break;case"nl":$g="W2™N‚¨€ÑŒ¦³)È~\n‹†faÌO7Mæs)°Òj5ˆFS™ĞÂn2†X!ÀØo0™¦áp(ša<M§Sl¨Şe2³tŠI&”Ìç#y¼é+Nb)Ì…5!Qäò“q¦;å9¬Ô`1ÆƒQ°Üp9 &pQ¼äi3šMĞ`(¢É¤fË”ĞY;ÃM`¢¤şÃ@™ß°¹ªÈ\n,›à¦ƒ	ÚXn7ˆs±¦å©4'S’‡,:*R£	Šå5'œt)<_u¼¢ÌÄã”ÈåFÄœ¡†íöìÃ'5Æ‘¸Ã>2ããœÂvõt+CNñş6D©Ï¾ßÌG#©§U7ô~	Ê˜rš‘({S	ÎX2'ê›@m`à» cƒú9ë°Èš½OcÜ.Náãc¶™(ğ¢jğæ*ƒš°­%\n2Jç c’2DÌb’²O[Ú†JPÊ™ËĞÒa•hl8:#‚HÉ\$Ì#\"ı‰ä:À¼Œ:ô01p@,	š,' NK¿ãj»Œ Pˆ©6«”J.Ò|Ò–*³c8ÃÑ\0Ò±F\"b>’²\"(È4µC”k	G›¬0 P®0Œc@éÁÀP’7%ã;¶Ã£ÃR(çÈäÄ6€Pœ¯£º¢•Ñ!*R1)XU\$Ul<Èí\0¡hH×Aˆ-'îZêâ+è§!¬Š³#9@P‚1‘%ÚB(Z6Ê‹è¬Ş£3’8JCR…K¼#’±¹•€ËkÛ.=,I’iW¥7]°Ó*n%át&£pê	@t&‰¡Ğ¦)C Ék¡h¶5bPºÉK#r¦ÿ.V…’æ\rƒ¥Ì ®¢X7ŒÃ2<½¦¢šâB­JÒìkCl\rÃÊ	‹£Æ’c0ê6ªô9º8öl0Œò¢Š½*‰HÚ½©XP9…-Å:Ïã8@!ŠbŒŸ9apAr¤£¨êã èÌ»'hò6\nèËR¦¹pé˜8MCx3Áìc8øª{[:Ä4è@ Œšzö9:#ğ4¸Á\0xëpÌ„TpèİAx^;ôrcÅ!¡rì3…é˜_\0:ÖŠÄ„A÷X¡»áà^0‡Û­Lÿq\nXÙ¸‰|ŒšşÜÏn•J¨°)fğÃ&óãw°k‹„«ì\\š\rËs×9Ït¿EÄ¯]/OÔİL?-NÿhDª‡ÂHÚ—³Ü:vİÄÖ˜ˆo%&¨-‚©Í\rf„Ì:2–xˆ )?(‰\\2¨Å¢g’	#æ*pAŸˆ <f£@äà“)!˜•œt\nÎ™ã>h\r¢3bJ ğsQ°1¢åä´V*1/ç	:¿ËÊ)Ak\$°(€ ö±\$EJ4÷#qÁAUj (!–\"ö´ù>4FÓRÃt*fÍÁóÌK}#(¼<â6wÌbÄÖ¬’¢TÎ¸sALíæC‡~ƒƒQ4H-ëîl”l/\n:›x\\ e&¤Üœ“²z§JîT‘¢ãİ[\r\r5­RjH y3GIÈÚ‘I±6h¸8‡R1L'®!Òy,QC/?ĞàÙ ¢8MB€O\naPšâMÉQ,)e6T.PÖ\\šb•gd¾yk5»\$]ÁÊU‘³¤œ\n›\rÈô3¶wi&ŒÄ³h\\ÖòcÉxL(„ÉNi:á*Dò¶T_º0‘VVéT’¨gŒ5fúhÒœ#RÑ—òœMTy'íğš«\0ş`ù'¤gö¯ENşd2´š„6<\\ßBa¼8!Ó„âº¢¤È…M“bŒ¸F¡ì’ÂV˜B F á'¸äş§ii)2°Š‘Á†+èŒi 'Sc+QÒyµ´’´„ÕˆÑA#ä„ÁÚœÆ+EÇ0&À ÒƒÊÎdÕ™ª¤Gg¹\$iyA£yŞĞKÑ!VLÅ\$ØOja,©Q!Ú\">£©†	„Á§cş~ÀU«&'|”ËŠ,O€(+!’äÖL¡\$gä˜¡‘\nÄGëq2,©Œ’µB'èigd4W²²,’®¬m_¬…8OÜV?Æ0Ú‘Ğ®QÌ)(©ÙÃ”LÀ";break;case"no":$g="E9‡QÌÒk5™NCğP”\\33AAD³©¸ÜeAá\"a„ætŒÎ˜Òl‰¦\\Úu6ˆ’xéÒA%“ÇØkƒ‘ÈÊl9Æ!B)Ì…)#IÌ¦á–ZiÂ¨q£,¤@\nFC1 Ôl7AGCy´o9Læ“q„Ø\n\$›Œô¹‘„Å?6B¥%#)’Õ\nÌ³hÌZárºŒ&KĞ(‰6˜nW˜úmj4`éqƒ–e>¹ä¶\rKM7'Ğ*\\^ëw6^MÒ’a„Ï>mvò>Œät á4Â	õúç¸İjÍûŞ	ÓL‹Ôw;iñËy›`N-1¬B9{ÅSq¬Üo;Ó!G+D¤ˆa:]£Ñƒ!¼Ë¢óógY£œ8#Ã˜î´‰H¬Ö‹R>OÖÔìœ6Lb€Í¨ƒš¥)‰2,û¥\"˜èĞ8îü…ƒÈàÀ	É€ÚÀ=ë @å¦CHÈï­†LÜ	Ìè;!Nğ2¬¬ÒÇ*²óÆh\n—%#\n,›&£Â@7 Ã|°Ú*	¬¾8ÈRØ3ÄÏ¶Ãp(@0#rå·«dÔ(!LŠ.79Ãc–¶Bpòâ1hhÉ)\0Ğc\nûCPÂ\"ãHÁxH bÀ§nğĞ;-èÚÌ¨£ÿ0˜ÖÅ<£(\$2C\$¹P8Ù2¡hà7£àPŒÅB Ò›'õªú¼Œó#ÔĞJmw¨-HèPôËgËÈ*–2ZtƒMW‰Ğš&‡B˜¦zb-´×iJÓ¶5n>|,Dc(Z™hĞ-À²7 ƒ”3ÕšªÀ¡R¬&N\0ëS\nƒxŞNÓú*ıŒcî9ŒÃ¨ØOrÀXÏÏí°Â¶0ª%6­˜˜ÊaJR*ŒãÈØ¿.A\0†)ŠB5ö7¡*`ZYtä‚cPÊÈ°hÈÏ§6`Pª:OVLÆH\rˆò„0iH¨42Ik}‰ Ùè‚2f¸å“ŒrÒÆ !àÂ\r	ğÌ„CBl8aĞ^ü(\\Åí«ÒĞ3…êX^ú­©œ´„A÷ øLaà^0‡ÉI†L\rnv&6'cƒ£Şãt3ÁzÌâ‹ƒ†7P¶êV¨UÔÚ9ZÈGÒÚaí¼o[æü:p	Ãqg9qœt«+Ë#w(¢‡ÂHÚ8/1|ğ…s\\ä!¬ŒfÏ)Í#‡©§m[ÿÎ¬’—nóıZ&0áÑÓVÕXuŠ\rÙ\nVÄfPˆcrE0;“DFXr}!É¨0Â–ËcÁÍ2&HZàbÃ\rÊ0Â‹Á\0c8¯Ì4–ä4aË™LbaÙòƒ¢5„:µˆù‚€H\n\0¶ÃT.kAE%4€¯Æ¦RË›«aa\r-xÖÑ‘Û\r0Ñd×bPå›Ğ_Y»9gmm9:äÆÚ`™‘a©-@r¤FMwh2Ğé`pbnÅ\0 7x¸h\r!³\0Îß |\$#Œ0‡R‚JIYO%äÄÉbIIøtM07°è\nİ;\\)n­©Ô2JBI,#hÆÏÒÛ„‘ˆŸê}Îpf=„Åµ¸˜šfJ`cOE]š\$\0\\ÊA¤#æ2/W¼ß0ii9¨<Á%ŠÕ>3\\ÆæN^\n®öH\n†AhkKD˜3‡SÛ‘~'Î†-¶AY’#„x›’\"H]&™\naD&ÒLÈá£wÁP(#4âöÕCî.“\n=0Ò¤ÕB‘‹.…9‚@·iå‰ˆÌ‘Î\$P^ÌZR¤‡Àç'\"R¢4ĞĞ9•¦µiÉC€´òŸ†ˆÃ`+\rh\$„;†]q~lõ<ÔÑ¦ªRM“û4ïõ‘‰´B Fì2†sÊÙàg¦êÅ;Ò3F\rı/¨´¡•:à—–èK ERU+r0|M²AªªæÚÑL`\n/„v|6àqKùÖ<ˆâÛ\"M”Ø#LÒšu·Uüªw¤¥›JÆ'\nõ:nàÀÃPAH'ä`Ÿ°Ø|i:Í­µÎ‘`¬[ƒ:¦	ié5RZ®Íùp®ê¦WN&ï6¬è:ÁP»‹ol…&H¨2€";break;case"pl":$g="C=D£)Ìèeb¦Ä)ÜÒe7ÁBQpÌÌ 9‚Šæs‘„İ…›\r&³¨€Äyb âù”Úob¯\$Gs(¸M0šÎg“i„Øn0ˆ!ÆSa®`›b!ä29)ÒV%9¦Å	®Y 4Á¥°I°€0Œ†cA¨Øn8‚X1”b2„£i¦<\n!GjÇC\rÀÙ6\"™'C©¨D7™8kÌä@r2ÑFFÌï6ÆÕ§éŞZÅB’³.Æj4ˆ æ­UöˆiŒ'\nÍÊév7v;=¨ƒSF7&ã®A¥<éØ‰ŞĞçrÔèñZÊ–pÜók'“¼z\n*œÎº\0Q+—5Æ&(yÈõà7ÍÆü÷är7œ¦ÄC\rğÄ0c+D7 ©`Ş:#ØàüÁ„\09ïÈÈ©¿{–<eàò¤ m(Ü2ŒéZäüNxÊ÷! t*\nšªÃ-ò´‡«€P¨È Ï¢Ü*#‚°j3<‘Œ Pœ:±;’=Cì;ú µ#õ\0/J€9I¢š¤B8Ê7É# ä»0êÊú6@J€@ü¸ê\0Å4EƒœÖ9N.8ğƒÃ˜Ò7Ï)°˜¬¸@SÁ¿/c ¾ˆûÒ\$@	HŞİƒxÎãON[š0®®ZøÖ@#˜ÕK	Ï¢È2C\"&2\$ÌXè„µCş58Ue]U2£¸¾=)hÁpHWÁˆ)C¨ÖÅC8È=!ê0Ø¡½\"œÂSúê:H†ù¡2äc¦4Z#dŒ0±C¸Ç\"Æéí°Ù%&!)QM€®”i\r{iJ<§Õ-Æ0Ü¡p~_ÏœY€àw*kƒ7éán>‘&È::÷‰@t&‰¡Ğ¦)P˜Úo»î.B€ßp<·\r“Ê‚ èLÖ3É>›\nq:h9=T&Ã6M2•¥£«ÜŒcB92£A£>ğÂ#æªãAoœ‡Jxªêâ^\r¤ŒšZ®2éÈó“©kÅ­¬;¨ş·®ê›¶Á>Q)ËV„8êámjÚ˜éˆ~ã¨n›îïIk;Ö¸9î£ÿ±%«šƒÂpÃ¢l'!ìàÂ‡”pî)ÃZ b˜¤#Á\0§Ì¸İ^\$0Ãƒ3ò6£`Â÷!|Æ›^ûÆ)·Â~‡¿vc–’ o=PûÊ@ Œ›<O½Äêc©ğ±2ŠĞÈÁèD4ƒ à9‡Ax^;ÿuÑï?OÈÎÃ€læŒ Döx\"ÆŒ¾¡2xaÍ\0‚†¢‚êÃ:bmq)´e(P»ap\$Ôb·\nAJ\rh †rR­Pú!(Aæ»·júAë¯µ÷¿æı_»ùiY‚çı\0 eNäA='ÈTñ²\r!¶\0’â aT‚E	0Ü¼œ(e)Á‘•¸_Qùtğ€¥BXPcQ)„‹ÜÁ’€‡H2kLH:Á’1MHw@\$lB!'Â„¹Ca&@D09;àä’U@aÌi†0ÆAC˜fx-]I%i”¨@AÍL  Æd\$W.Á°9™‚ôcÃz%H]· 1EÚèCåÎ\\K©xŠd…C¼˜“2ì§×›sx«ÅyËÒ@¥_9r?áê04ù¤\n\n€)mñá3¬&NÄ\$¢y%\" H\rÅAÑZ¡ƒ8@Hrh\rNViHòKMzB*EŸ¤gJgCK©%DÑ™L7”Ş¤<‰2ÈG'Íğn5R&Œ–´ƒĞ‰“(A 4µ\nC;ğ’TnWÙ	‚(\rgá)8\nNIÙ='ñ€‘% ÅL©h‡=3œI°J!ğ×Î7V„WôrgF¬Œ&\$ø@‹“Üí)†ÓäMaNMgÈ7¡IvîØPz\$ó•·Mæ¢íBĞm+u7†%>&Jrİ)U¹©ÀêÕ¨ \$èÛR!Ä( 8š”R:ÃÈj± X+	\$Ê©©\naD&8RaS*8w#ğ¥GtšÅåÄ`¨œ»U	N) ¹æåH{'AHÈ¡\"æùKá)Cˆ© òM­â¥·ñÄA9àÖa	ğiSòä[Ó&š®Ì@sx›WGé³„TˆIµØkÀÂ¯Ö0W–ïÀv\0cïRµ&Á\r1ÀVÊ©5‡vÛ×¨ÎIÈ`98î”’lÌM¸³1Â–ÃRIĞál/„9> (îB F à›^›•vn\rÍ¶‘Q]Ee|-X¸˜AU†	‰-»yaøy	O\\A‹/¶Ø¹Vú€›Š#	â†\":‡+äÄ?Æ¼ØØcÉNƒ,Ğj>Ş<#N[°Ô\nªÖ3âHqÍ1¨¢¸\0ÛÎô8Ú_=ü¯0¥ä%#bäyË“æ²¾¬ÜpÑn\nuX \0¬Vùê=’ğ¡ö\"YßÆ†OŞ3&tmñ2Æí&H»¦“B!›*«P\"“¬v‚N0[ñb¬{ö€ƒ¾† Ú&“d¼¬±®xKV’Ö¢ƒ£Œ¦“»Ó á\0";break;case"pt":$g="T2›DŒÊr:OFø(J.™„0Q9†£7ˆj‘ÀŞs9°Õ§c)°@e7&‚2f4˜ÍSIÈŞ.&Ó	¸Ñ6°Ô'ƒI¶2d—ÌfsXÌl@%9§jTÒl 7Eã&Z!Î8†Ìh5\rÇQØÂz4›ÁFó‘¤Îi7M‘ZÔ»	&))„ç8&›Ì†™X\n\$›py­ò1~4× \"‘–ï^Î&ó¨€Ğa’V#'¬¨Ù2œÄHÉÔàd0ÂvfŒÎÏ¯œÎ²ÍÁÈÂâK\$ğSy¸éxáË`†\\[\rOZãôx¼»ÆNë-Ò&À¢¢ğgM”[Æ<“‹7ÏES<ªn5›çstœä›IÀˆÜ°l0Ê)\r‹T:\"m²<„#¬0æ;®ƒ\"p(.\0ÌÔC#«&©äÃ/ÈK\$a–°R ©ªª`@5(LÃ4œcÈš)ÈÒ6Qº`7\r*Cd8\$­«õ¡jCŒ‹CjPå§ã”r!/\nê¹\nN ÊãŒ¯ˆÊñ%r‹2ßÀê‚\\–¥BÙC3R¹k‹\$œ	ŒËŠ¬[i%ÌPD:ÈãL’º<‰CNô¹Ò³Œ& +¥å Œš}‰ÃxìŒË¬ûh‡\0Ä<¡ HKPÔhJ(<¶ Sô¨^u˜b\n	°Æ:ÑÀPâá•ú\rƒ{½‰ã”n¼¸ÓÈÚ4¡ P‚ë;šJ2Œs³\"…©àÒ½ˆ’ø‚®rä Êä \"¥)[S¤öòL”%Q²oST(Ão¶W¢W!'ÎºG\"@	¢ht)Š`PÈ2ãhÚ‹c,0‹´K_l¹®Sq!CcÄ4m*Yã0Ìõİ)Å¬9%RRrƒÙöb&Ø¤(Âr7¨	èó2C¨Æƒ\$0ê“X«»\$6c–_oêğ§Ô9­2…˜Rœ\nƒxÖ”¦)Áğ;(OZeêğCK Û£¥‹‹T·IÎpË—gê9f±²1¾0nˆ9¦éËNü6C4;:Ã8@ Œ™ª¦pŒ”ƒa‡ˆ ĞÎŒÁèD4ƒ à9‡Ax^;õtmË@+ Î¥z¼¹îh^İ»ró‡xÂo‰ú®	¯¦AğÔ96Q°<o»ñ\"k\r¿Â))e/ŞK;ëMĞt]'MÔu]`ï×r«Âv] İÚ¤íİªğ’6\r~òÃMà'B~¨M¤-}³ Äˆà	é(„áq³wŒŠQèe\$„Ø˜#¤sËq‡qH0†7rCºß\$Æwà¡Ï`9´'Ñš@oi@‚ÀcvÏªN ¯~	°Ùˆ±—\rÅ9’†r\\‚rŠD\$Ü/×ë‘B\n\n ( Ô`¢¨ @’r¼ŒLXs#É\0’ÄhsWL&<æÌÕšÕ¾l_6Fôı Âô±C¹Ô'¾\"˜ĞÂµ»gm)0µÂfg[1²R¡Â v§¤°n\nì¡4+\rá2€…ÙÒ*\$&(aCÍì†s¤cÓ(%¢ÅDcŸá…®h\$tW1‹`\0Ô6¦Î’!‚I¦’\$M\"H(-›†èo\r‘XEy\rbå„??¡b¡øod g•@'…0¨ˆÒš7'‰Õ{\0Î•¦³{	t2RKñ<'ÄfhÊ§ÿ	&‘„Øæâ`Õä‡:æ]²I¢cé¶X¨Øª\"ì˜Q	ˆj;‚ê0T‹¤õP”X¿fë…;Ä‘\0€¥:ŠÙëp-®›êqQŒ&+ØœSs@šé”§‹Áh°Â“D_6'C*¢À\0PC<A°Î@Ò°©1\nAN 1I2[–)-’‰X“§àÂV*,5ğ ÈXÔÂ¨TÀ´pÜá[‘'ÀÎ©â3K‹¤`^öŸ÷.HBö‰ô§#ÄëY»[GH£É‰1a˜<°å°gC™oTöĞ-H0Š5£¨g*¨PôÊ!x\ruÙêÔK!zoä±<ú8Q¤¸0@(&\\kzBiHäa‹¦DQRá±hö(æ?Ã^§ìe†ªvœE¬ÆÈHd«+fñÏuƒÊàØ«ôÎKXüº/&ÊÏR)m=°Éğ9¬\$E\"…j&à";break;case"pt-br":$g="V7˜Øj¡ĞÊmÌ§(1èÂ?	EÃ30€æ\n'0Ôfñ\rR 8Îg6´ìe6¦ã±¤ÂrG%ç©¤ìoŠ†i„ÜhXjÁ¤Û2LSI´pá6šN†šLv>%9§\$\\Ön 7F£†Z)Î\r9†Ìh5\rÇQØÂz4›ÁFó‘¤Îi7M‘‹ªË„&)A„ç9\"™*RğQ\$Üs…šNXHŞÓfƒˆF[ı˜å\"œ–MçQ Ã'°S¯²ÓfÊs‚Ç§!†\r4gà¸½¬ä§‚»føæÎLªo7TÍÇY|«%Š7RA\\¾i”A€Ì_f³¦Ÿ·¯ÀÁDIA—›\$äóĞQTç”*›fãyÜÜ•M8äœˆóÇ;ÊKnØˆ³v¡‰9ëàÈœŠà@35ğĞêÌªz7­ÂÈƒ2æk«\nÚº¦„R†Ï43Êô¢â Ò· Ê30\n¢D%\rĞæ:¨kêôŒ—Cj‘=p3œ C!0Jò\nC,|ã+æ÷/²°ˆÏ¸ò°˜¦	\\ÒMpÔ×¥cšòË§\"c>Å\"ìŠ¤¾>²<´½\ni[\\®ŒªÍ‰ƒzşÿ©ã’z7%h207«òëJò¯A(ÈCÊÓÕDÛCÍPşA j„`BƒN1´Xš0I¢\rˆ	ã”|ÀÑŠ2¤2B	†S¬NÛÚ1Îì Š§£KöY©êè¯B\r(<JJZÊT¨8ÃmCcxÒ•%‰r’T”ıÕm72ø^:’ÇCÏ}B@	¢ht)Š`PÈ2ãhÚ‹c,0‹¶“kj:«{CcÊ5Mb^ï\rã0Ì60+Œ…¥ªK•u³b Ş §ÃÌBË£‘ŒÃªS`Ñã˜X‚YÖu¿ìáOª.šaJs›\riX@!ŠbŒï¥ŠYy„2\\ñİ´–…A¶+´œèåÏ:JŞÔ\r…2Mî®×?WÌ=;\rÃ8@ ŒšŠ£Œn„í&àÂÖ´c0z\r è8aĞ^üè\\0ğ¹l¾ázV©,\n¦èá}Ô·ÏHxŒ!ö^‘°« àÍtCpêa¢£([?›u+¸‰¬r˜œ+c0İÛG„w!ò|¯/Ìó|èïÏô4§F9t½<èËÎıj°	#hàÚíã§gÚÎ\rÄœ:(øèÎÉßAªEI©SŒnËá¿qæaÜ\"´zM·=æ´Å­£&¼ÉĞh;Á„1º³şÖÑ)1‰9/¥\$—\0aÏ=3ãnÚCQÍ:?Ã€wºN!/]J’àØÀÉ\rÍõ§c F2\"qè”Ã\"‚I\0P	A!AX\$¨³#3\$É	a\$Ä œ„3 ¥ éé7\$€Ù­£l§â±¸8Gñ˜%‚Òñ9>0õ 0Â³Ì)€ÍˆªöBÎñÂoD…6nØ€u€oI\0îpChD3¹Vë#ãòn!Dê\n¤ÙC(¨TGçäà!RHH˜<7‰f¢ŠC„Ü˜DòßÌz\"¡äÕ¢B¨ƒ±+ÇÜ5|YÙ§!ÃøÖƒÁDğá=ÎÜB€O\naQ%\$|OS³ #*–\\èd¤8˜œ5&P	‹&—íÂÌcFTË²\$;Î\$7\$\0Î®cúĞ3¨µ’LXüÍÚÁtô1à@ÂˆLCq¸.p@‚¤T'Ê|£Eh4OœÉD¬IàiÙ§]«½X®N)rš¦\$q}.ó|uaƒ>—©³Nšéë`<)œªU–B*L*=Ó©zTèœÚWåR¦ì\0!PØ\næÈiWÄX7†#G=K²Áz½Ç¥ã&V	9Ôp6¡ôÚpU\nƒ…àâL“©ª|ÑÔjx»ü¯!•Qzš*`i’&_”–Î¨€aHñ \$D’1’“0ÆÖ¬½ìÆÄ¬Cy’Áå‡PÆhÃ™\nn	pÆÈ«qï>¥N ²…€`YÖ2u­*É»RcéÕ‚Gz´—Äòè™G¬æôÅ\0¥èJµ(j=+1tÈŠ1zK©‘N£ü©²°–=NXÛNÈº…cd2\0 †°VBˆXÊ?øfÂÄÁ¤3n-!G&,ÆÛKŸCš¾Dr\nB/0";break;case"ro":$g="S:›†VBlÒ 9šLçS¡ˆƒÁBQpÌÍ¢	´@p:\$\"¸Üc‡œŒf˜ÒÈLšL§#©²>e„LÎÓ1p(/˜Ìæ¢i„ğiL†ÓIÌ@-	NdùéÆe9%´	‘È@n™hõ˜|ôX\nFC1 Ôl7AFsy°o9B&ã\rÙ†7FÔ°É82`uøÙÎZ:LFSa–zE2`xHx(’n9ÌÌ¹Äg’If;ÌÌÓ=,›ãfƒî¾oŞNÆœ©° :n§N,èh¦ğ2YYéNû;Ò¹ÆÎê ˜AÌføìë×2ær'-KŸ£ë û!†{Ğù:<íÙ¸Î\nd& g-ğ(˜¤0`P‚ŞŒ Pª7\rcpŞ;°)˜ä¼'¢#É-@2\ríü­1Ã€à¼+C„*9ëÀÈˆË¨Ş„ ¨:Ã/a6¡îÂò2¡Ä´J©E\nâ„›,Jhèë°ãPÂ¿#Jh¼ÂéÂV9#÷ŠƒJA(0ñèŞ\r,+‚¼´Ñ¡9P“\"õ òøÚ.ÒÈàÁ/q¸) „ÛÊ#Œ£xÚ2lÒ¦¹iÂ¤/Òø1G4=CÇc,zîiëş¬À¬Ã4¼L¬BpÌ8(Fë¨ÂÏ C“:&\rã<nœ	šŠ7RR;J¿´\rbºœANûJŒ”D­@6„Å Pò¬PP¡pHÚAˆ!¡é\r^»¯(éDÛş¦Ç 0(¦Ê¶¢(\ré„×vJĞxÜ4¥\r(ˆœ\r•8¡Z¦‰ô„ò#ŒŠ`ÅKÍÉˆ)lVÈaNMŒ¢·p £c6àb0¶&÷\rj×R¨ê6B@	¢ht)Š`PÉ£h\\-9Èò.ºW£6ôCe6(İ_DÃ0Ø½²ÙèäÍJ˜¼€P¨7·˜ó4¨Æ«c˜Ì¡•kàcšØÃWF1&ï a@æ§¢¦)Î\0Ş5ÒA‘¡#*O\nÍ'Ğä¢ª±nı©³A\0ÆÓëêÂz*6BÅFHKì*^˜9mÜzÃ«ÁâX4<ƒ0z\r è8aĞ^ıÈ\\¥)• ä/8_IğÂù/»xDxÌRö3‡xÂrûú†Ğ¡(|GCÀá'1[D3¡¸ìëô×nƒBñz‰°«öÄq(å`¬^ûÉ„P@ë+®vÉÚ;gpîã£xñá†ç†á	y ˆ©à’›Ìª OEé•œŸÎ8oX'ö·ÆüˆUaV„æ•€Òö‘Ê¡ˆ:“'Êz‰r°/Ü¹pĞN«È0!ÜŞc&MÃ“ŠOë0†gæcœ«aldÙ²†tc9À‡ä ¥'ö­CI}R¦™)‡»I”d+,ÚÆº÷dÜ)zNêáVÀ€&èµÎâ´JÏ=½ÒnĞ\"ÁCáÈ:ã’†Èàll¡Üğ“Ò4ŸÑÊ]T\r-QàæHÚ\"Aëö2˜°ÎyÊ¶‡Æ‰¿âXÑWoÆã“‚öHõDÀ€;œ€Æ\n!\nv&œKW%(\r–dä¤¡”RG’é%W&µ.Ô>½ã|@aÅe‚Ÿ\0\\ˆj/…Ç\$<EÃÉ²}«HİÎAN<Ä:Æ²ZƒÈó¡w¤Î-7ĞÆÙP±Ç9(ˆß?°CQC\n<)…IJ¬‘í<“|*1û¡¨µZ!vÚf/.:QEÕPİ1.!iQ†RfO\$ƒ'hş1´Y`Ne)OqÁ>@¦Ba[G&ì–`¨äïoÉ½ByîŸ‰ËO'€)\\H¬VR£%Œjn/#Fƒ™eª†«\$j³6ªáZšH(ÍV*ªjºUá…CÕ¶6|	™Š¬L6´”HDIq+ki¹¨e˜»ca¶¿Ø?a\rRº5ÍÕ@†ÀW?×Àk&ê búÚ:±U-ÎXÃ3c’\n9\r¡ÖnDtbB F áE³2}‰êÆSI`·øôÅ­Õ¼du.E™{í\$HqŸj?mÎQ“.Á6Æ‡–dV\reØFªq</ÔZ@Qá3Kl+YûChY.¯Ö|W£ÔäÈå	LeÀ!¨ B®ÓXğCÆ»RÖ`ØÆqU:¬)O<*H¬_\0Q5MÊ«•£È°‘Š&¤M`Ø[\$y.²3Rğ.³*°Ã\"×lªĞè„W¼ˆõL‘†t!Ê÷4®ŠìjÆHÊV9¦Wošgç\\à‡@";break;case"ru":$g="ĞI4QbŠ\r ²h-Z(KA{‚„¢á™˜@s4°˜\$hĞX4móEÑFyAg‚ÊÚ†Š\nQBKW2)RöA@Âapz\0]NKWRi›Ay-]Ê!Ğ&‚æ	­èp¤CE#©¢êµyl²Ÿ\n@N'R)û‰\0”	Nd*;AEJ’K¤–©îF°Ç\$ĞVŠ&…'AAæ0¤@\nFC1 Ôl7c+ü&\"IšIĞ·˜ü>Ä¹Œ¤¥K,q¡Ï´Í.ÄÈu’9¢ê †ì¼LÒ¾¢,&²NsDšM‘‘˜ŞŞe!_Ìé‹Z­ÕG*„r;i¬«9Xƒàpdû‘‘÷'ËŒ6ky«}÷VÍì\nêP¤¢†Ø»N’3\0\$¤,°:)ºfó(nB>ä\$e´\n›«mz”û¸ËËÃ!0<=›–”ÁìS<¡lP…*ôEÁióä¦–°;î´(P1 W¥j¡tæ¬EŒB¨Ü5Ãxî7(ä9\rã’\"# Â1#˜ÊƒxÊ9„hè‹£€á*Ìã„º9ò¨Èº“\nc³\n*JÒ\\ÇiT\$°ÉSè[ ³ŠÚ,¢D;Hdnú*Ë’êR-eÚ:hBÅª€Â0ÈS<Y1i«şå¸îfŒ®ï£8šºE<ÃÉv¶;A S»J\nşŒ’•“sA<Éxh‘õâˆä&„:Â±Ã•lDÆ9†&†¹=HíX¢ Ò9Ëcd¾¹¬¢7[¶üÉq\\(ğ:£pæ4÷sÿV×51pŒ¸ã„â@\$2L)Ö#Ì¼ª\$bd÷×Èj£bšıeRà­Kñ#\$óœ–¼1;G¼\nsY¬î¥båc½èĞ¹(ÈÕ§I¨•e‹ëõ—åfƒY™1/}ŒXdL`¡pHèAŠ3‡Y\nd†ôÕävl¼—‰U¬ÏG&„˜Põ.3jjèØÕ®/Ä(©#+A V¤Av’ïÖ*šÕjŸaªè¥Ñ×¢¢¯¶J¥4h§+í^Eèğ\ru_Z\$Š¨‘Ğ0óã¥\0¸æ®ÎQƒ)åğ\\šrÅÈOÏ¿)rÏw1ójrAÏô<z÷ÉU°[à†õY†Ní©Ê?y>YO3\\áÑ ¤“4\0P£(ùhuÅà\\-¯EŸª.È™´\rƒ å\"6Ö\nÅW\$o›ù`´p•ç!G³>8±yEÔÖ®¥@/\\Œl˜¶”lÍªô9\n¬ûœtú\r#¯%M!ÚªTŒÓéL=Ç\$‚,¤xw#ºkåLAœ±ìóQ‚é¨?x&õŸÑB#ÊÉÿ%\0¨‹€§'ñ`Û˜iyr‡\"•X\"P`™á‚¥†Á–kÈ|&Â.Çé	³®„îÍıÂ³•a”UĞœÃCúPÔ7pé½¨ b\\@dq’·Vë¤ITLõ\r6%>XQR4ÅŒ!…0¤l3„‡Ê1g&í£Ãƒ'\$”†,1J‘^Q\$¬ºgW¡\\rğÂGboó(€ ¨\nKL™qUŞƒ8 !6†Ü”` kÅw†D¤àa 9PÌAhĞ80tÁxwš@¸0ËIl”rUà½v‚ôÂ¹¢ğ\rÀ¼é¾–e°g€¼0ƒåF©`<u‡ÑÜš1Ã¶`Ê	ô\nçã‡.`â˜rğJ5¬x|qXéL”MØ‚—R’¢£A«Ğå1(§ğºmÓaÌY2f\\Í™óFiÍYk-Ò´Ú›“u.Åİ8§!rÃA|•š¨9	sµû˜ÃH\\Cœ¹ĞÍ#Ir‚GÎáDòAü¶ö.IDy`oIgÏ‚›>ĞÒ F˜ÕÂã¤x1QÏùÜéLøas…x‚\0îC`l‰/‡¥+m¬¬0†eØ“@ciŒ9†`ë\\ƒ`oòÚ·èKër½K©‹/ƒtá!°9—SªyR9'QˆuG•Xè„çé;.©'ä5Ô\r¡~–‘0*nÛĞÕH(hXú!ó¸°âÈ È”p†¼e½k6D7‚\0àƒHv®”3×»œ›\"ÛL¡½3Ù»ëİ!®œè*ö\rÔÓ^¶Ï‘X0ƒ•(ØZ‚|ôR2°R)Ò’_»S9¦ë,e’À¸8TÚ›ÓˆreaÜ4Çd%¨g™UÍ/à Æepe.ªô’™ãèõ£“9~ä„¥Ï—\\HX+ø½\$°ŸEwp	TP‰ĞY±“ú³jW¤\0·Äî’¡FQ*IÚn\"1>©\"2%Jd 1J±TâNèé´û*É¢Xv‰&¾JYÒyq•Ú¥~Ö)²l‰NĞ†¡¯ÈíB8JÓÓÆDQ‡ «Á¢\"›° \n<)…J&pœY‡\r!ú?8ÑOJr)¹ÖgyüÔc\rR…ĞúJbûq™(O·Ğô-lÏŒKÉ'8|Â6‘SNA²?¨ÛEùoH@’ºÅ×…3¦òº¦Å×½Ìâı3  \naD&H\nUIä*€uÙò)éİ¬(ÖGRÈl((yöDHnFD¹-sF”¿ÊlöøĞÜ'a¢ˆxş¾è.»­İ’q¸ÖP=j”Ly‹K«¢-‡­Aºäoº#~¹Ü{ÙØp,•ÁK9`>ZÅİp¥ê.8k²r<C£uÅwõVºÍñ°Kk¡ÂŞ\r€¬h\n˜ò² 3R…Åw\"æß˜1mdQãDGT&ãj-LÛTßƒrrP¤Ô®¬äÊd‡UØeWÚf2Õ±”„H0@B¤€	Ñ×mA\0‡:¡-Å®®~Ï^èÓ_½­v\"öÌ;)y“®Ã´À-ª‡os—î\"2Ñ¦z¥ÎÜ˜ìÂ,¤]Ò\${½*ÜÓwšHÿ&\\E#äî¥ê)É¶¢9¹˜“Üı9ÚÅC+ï¶mt|À6/ğùNóˆYês«eï-C:at×6ŸÊN‚„*ú'”Bâ0a½æKI_ Ä³Ã”\$b\$|F’,MWz|’bK!#x+]Ò@fÜS–4«b1%<†í8`§éºwµ¯‰4Ìİô™ÿ.ãËhíŞ(Œ‰¢ØÕ-¬½ÆÔmŒJîÎ¾O\$íInˆri\"‚!dñ£ö~mN9A\nn°&Í/¾jÏŞ8dˆ¬ƒB‰Ã¤";break;case"sk":$g="N0›ÏFPü%ÌÂ˜(¦Ã]ç(a„@n2œ\ræC	ÈÒl7ÅÌ&ƒ‘…Š¥‰¦Á¤ÚÃP›\rÑhÑØŞl2›¦±•ˆ¾5›ÎrxdB\$r:ˆ\rFQ\0”æB”Ãâ18¹”Ë-9´¹H€0Œ†cA¨Øn8‚)èÉDÍ&sLêb\nb¯M&}0èa1gæ³Ì¤«k02pQZ@Å_bÔ·‹Õò0 _0’’É¾’hÄÓ\rÒY§83™Nb¤„êp/ÆƒN®şbœa±ùaWw’M\ræ¹+o;I”³ÁCv˜Í\0­ñ¿!À‹·ôF\"<Âlb¨XjØv&êg¦0•ì<šñ§“—zn5èÎæá”ä9\"iHˆ0¶ãæ¦ƒ{T‹ã¢×£C”8@Ã˜î‰Œ‰H¡\0oÚ>ód¥«z’=\nÜ1¹HÊ5©£š¢£*Š»j­+€P¤2¤ï`Æ2ºŒƒÆä¶Iøæ5˜eKX<Èbæ6 Pˆ˜+Pú,ã@ÀP„º¦’à)ÅÌ`2ãhÊ:32³jÀ'ˆA¦mÂ˜§Nh¤ğ«¶Cpæ4óòR- I˜Û'£ ÒÖ@P ÏHElˆŸÀPÕ\$r<4\r‰„ş¢r¨¨994ì”ÒÓ”òsBs£MØ×*„£ @1 ƒ ZÖõÈó]ÖÕÀÔÖÀPòÕMÁpHYÁ‹æ4'ëã”\rc\$^7§éëåBM‘uÆ	‰u#XÆ½¾c„¥kˆ¡kÖB|?Œ²¤‹JÃq,Ô:SO@4I×²…*1‚o9Şò¢t^©µ°Ëy(ø\\áC`Ó†`ã\nu%W˜æ60¸Ân£xîéb/î(¹	Kd’T°	¢ht)Š`T26…ÂÛşÿ‹·mŞ¢’Äª6M€S:¤£ª`Ş3ØÒ0¨¿Éí{U%\r>ÉŠƒzBõÃÈ@:ÏÃ¨Çc˜Ì:@ºOÁcX9lÃÏŠ¿‹®Z6®£«daJR'#7ÖÖ8iÈ@!ŠbŒ3ÃDc2&6î@=4nJS®SºõV¦-c(Ä2Ó‰ìB+ØÈ5©H¨Ğ?\r_4Š³øÜ3„ÉÀ#–íOÃM´Šˆ²H2ŒÁèD4ƒ à9‡Ax^;ûrùâ?Ár&3…éÈ_¦c¥\0007á}ô@8xŒ!ö±¶ıqÖğ»ãìª)Y)Š…Ø!Ä<çİa%\$®D(ÛP¸rbAà8ä‰\\£Í=è½7ªõŞËÛ{¯|º¾Æù_b|')ı@¾Òœ‚Hmá5àèüßªr_á ¸À@zÃYLQnÀÿ6Br¼,?¦±ø~ïKÚ·%š“rr’]°h)„1¾¥¹n.®\"'vš•°aÌÍ¶³TÛ›ƒr\ríÒ0(°Ğk\"ÑM@€1Áuµ\r‹ØlFFQÙt\0	ã‚á¹Vä\\‰÷+AÂ's,SAˆDä1á†/Yd‡‘\"¶E0@\n\ns†A\r@‘ˆºyáñ¥4á”Ô«d\"\rYµAˆ8ï’\0ïk‰@‘:\0 i:ºÊa#ˆåÛŸè„jÈ°sBˆü7àéK¨ppNÁ\nÁlÍ£,pê+sfSaw¡””±˜\n‹ĞÆŠì@õ’Ò^L[+°[‚55Ï¢lN\\wV'Ê£ /O\n#-e\n”âRHXy3ÒEåK²NU´×—P\\8‡STƒƒ2\0Cï	ğI®ãƒ @ñâ]!CR†‹`­cG„)D’‚€O\naRH´ª\rO\n‹A\r(à“‚\$çè=	)ğ· Ò’Šƒ1s§~ª)ÃXtHmš‡4ê':Oá¯\$ğà«ræ˜Q	€‚¨§E‚0T\n7+b]-æ­ ¤T]R>ÉÌ‚³VäÜì‡“Ö@Ë²°\0‹\$¨pjÈu;á¤=IÛ_ÕaO8ì›¸®(IJ¼V'XÈ¢ûH˜v†aä;ŠJBl\r€¬5±£óP‰úS¢´ãíVHšI¡¢0õ\rL‘)Ä|¦9Â³9¦©ü\n¡P#ĞpQY<óµ…×r&±\$óWè¶¨f.ÆXİŞBVZá^;ÊT=çdóV]ûÙ(#½î.‚ø3‚(&‰4GYƒúhæL&İ Ì“¬©Y5åÀ+HJHÒq¯\$¦(Æ/×?\rJI²Xd†¦0èÙˆĞu:èŒ«4Q†1'%!07Ö@ÚDĞBJ¸Ğ¾r›	øJ¤i)¢V*×ÌŸ'’\" “ä¯ÎNXaÙL§”J\nÅ\nkä2ÅÔJ‚Y &0\"ÁK¾¡Œ·ZkT4ŠˆëÍ¾I„é_ü`Ò¨RÊ©8Ãá³€\nk( ";break;case"sl":$g="S:D‘–ib#L&ãHü%ÌÂ˜(6›à¦Ñ¸Âl7±WÆ“¡¤@d0\rğY”]0šÆXI¨Â ™›\r&³yÌé'”ÊÌ²Ñª%9¥äJ²nnÌSé‰†^ #!˜Ğj6 ¨!„ôn7‚£F“9¦<l‹I†”Ù/*ÁL†QZ¨v¾¤Çc”øÒc—–MçQ Ã3›àg#N\0Øe3™Nb	P€êp”@s†ƒNnæbËËÊfƒ”.ù«ÖÃèé†Pl5MBÖz67Q ­†»fnœ_îT9÷n3‚‰'£QŠ¡¾Œ§©Ø(ªp]/…Sq®ĞwäNG(Õ.St0œàFC~k#?9çü)ùÃâ9èĞÈ—Š`æ4¡c<ı¼MÊ¨é¸Ş2\$ğšRÁ÷%Jp@©*‰²^Á;ô1!¸Ö¹\r#‚øb”,0J`è:£¢øBÜ0H`& ©„#Œ£xÚ2ƒ’!*èËÃLÚ4Aòš+R¬°< #t7ÌMS¶\r¯~2Èú5ÄÏP4ÅL”2R@æP(Ò›0¤ğ*5£R<ÉÏì|h'\rğÊ2Œ’Xè‡Âƒb:!-+KŒ4Í65\$´ğAKTh<³@RĞ°\\•xbé:èJø5¨Ã’x8ˆÒKBBd’F‚ Êà(Î“¨õ/‚(Z6Œ#Jà'Œ€P´ÛM‘¤üğ<³À ”-ÂùoÏhZŠ£Âƒ-Ÿh®àMÈ6!iº©\r]7]¤«]ÉíàÙl•5,^ÉĞ]|Ü¨`ÑsŞ˜¡iQ©xô”\r@P\$Bhš\nb˜¡p¶õ½bí”º²ˆ,:% PÙ&LS *#0Ì*\rTš2ÈÎí©@\$Ï*\rì• 7,ôÄ:Œc49ŒÃ¨Ø\$lÅIº(Ã¶¥ÿ4ÃªaLG6.ÔÎ\rék!ŠbŒû¯q4C246éÒ\0@ë PxÖÖ#)@&ã¨æ8g\n<—ŠŒsÊÍîÒïè\r\"·=PPÇ2@ã#Ô‰»X2ŒÁèD4ƒ à9‡Ax^;ösm®=Ar43…ğx^ú#É,È„A÷x”ºà^0‡Ó2m„<	eá¸@©ì7ÁVå´PTFx€¥âkâ€Ë¯ğç\0@Rü\\½n‚ô½?SÕõ½cÙó—l9wĞË0AóÜğ\n@>	!´8t–ƒ£Æy	yI„&ÚĞ(„¦†ƒÜ\n}Bh0Ş/%F\n£\$„™%ğÎÈJYq Æï@wZM<ºÁPääRZ!™ğFÒŸMiíDÚC èÁâ9a…%‚\0Æ^ Ài#áÌ—„\"\noO¡¡CX©6xx!\$¬,¡u[ˆH\n\0€€RGI2‡Á¼Üò^Ó!P…îPÎs,fƒ&?†lÒŸp@GÉ\0wR\rŒœ¨ dÎ{J…g¨HUäšQÇ4rT7¼@ÏúHP;š@ÆÁÓHgu\nŒD˜œ\\1.&ÈšÒŒŞÅ\n2aˆV9›„X9à—Ï0‚Ÿ\"Dƒã³q@ÏMê¨Ùj¥ÒÙ/	\$L<˜²NP¡h?=\nDy\nACˆu3Dü3Â8å¢]‰' 1’ähä)ş3.	²¢xÉ¢ÔgDÜ(ğ¦€Zha¨ëÍ	q.‰øŒÈd’cÀLÑÚ  Dxå#(Ğ†ÙlÖk˜Ï’m!ágL(„À@–‘0Ü#HÖBĞ¢?dş\nNT” ƒ‘3~Éô½)&N¡”‰aºz)˜ó	ê*Rú¢SÅ ¤ŠCÅş¦¥Ê1È–ëıGÔgBWAõey6WT’ø¬\$n±Ëò(¿¥hI¥Ö°ËV%û«uÆ¤Æ‚M\r€¬5ÏcjNÑh'Ñ :›òQ‰xF¥0EÃøjm¨TÀ´%€ÜæËØnåâ9Ìu^ìA†£l*ÚQ}[—šÿ0–ªº\0›ZHm|_¬&Ù’Y%m­uyaÈÂÛæÇHÕw6uâÂè]“ÀMBa¤3’Èm‰Œ(©à)h\\ŸÃš+V5H4NIäY\n‡³@§Ùªåºõ™ÊUbIé%%á07Ñò2AJsX7öĞ\0lV±¶8(Ğ!—`@kCÓN.jNâZ¥;…mğiTVôÃ†\\7qL9Äº½H\0 –HbÀ:qÍÛtJU­Û¡L¢ö#OwƒC?¹ëÀ¾â\0Æq+²\$¡À";break;case"sr":$g="ĞJ4‚í ¸4P-Ak	@ÁÚ6Š\r¢€h/`ãğP”\\33`¦‚†h¦¡ĞE¤¢¾†Cš©\\fÑLJâ°¦‚şe_¤‰ÙDåeh¦àRÆ‚ù ·hQæ	™”jQŸÍĞñ*µ1a1˜CV³9Ôæ%9¨P	u6ccšUãPùíº/œAèBÀPÀb2£a¸às\$_ÅàTù²úI0Œ.\"uÌZîH‘™-á0ÕƒAcYXZç5åV\$Q´4«YŒiq—ÌÂc9m:¡MçQ Âv2ˆ\rÆñÀäi;M†S9”æ :q§!„éÁ:\r<ó¡„ÅËµÉ«èx­b¾˜’xš>Dšq„M«÷|];Ù´RT‰R×Ò”=q0ø!/kVÖ è‚NÚ)\nSü)·ãHÜ3¤<Å‰ÓšÚÆ¨2EÒH•2	»è×Š£pÖáãp@2CŞ9(B#¬ï#›‚2\rîs„7‰¦8Frác¼f2-dâš“²EâšD°ÌN·¡+1 –³¥ê§ˆ\"¬…&,ën² kBÖ€«ëÂÅ4 Š;XM ‰ò`ú&	Épµ”I‘u2QÜÈ§sÖ²>èk%;+\ry H±SÊI6!,¥ª,RÆÕ¶”ÆŒ#Lq NSFl\$„šd§@ä0¼–\0Pˆí»ÎX@´œ^7V®\rq]W(ğëÃ˜Ò7Ø«Z•+-íE4ı\"M»×AJ´*´²ÏƒT‡\$ŠR&ËŠHOÕéÌÍTó¾S­Êúİ\n#l¥Ğ…ÄŒˆ#>ó¡€Mñ}(³-ı|³Ø\n^ó\$’âH¹A j ­w#óW#égt3ì’€‚cikühôı¼õMÖ›C\$5ĞH&f]ÜĞ«Î³íc\"’¨(]:­ÄDÊ’ÒÚ†”\"*£qÃ	=¿d©„6¯ª}şº²*â‚,eŞ¬CRÂòºNÉâ\r6 Av k/jhºkºşË¡,H‚+¶lËikµjû)­)işå ìK6ñ¤­ª3¥ \$	Ğš&‡B˜¦’`Ú6…ÂØóÏ\"ëE›à¹Õ1FK‰Ş\rƒ äÜ·a\0Â98#xÌ3\rÊğ©Ää‹è’İa„\nƒ{ˆ6Œ#pò¶(ê1Œnpæ3£`@6\rã<\$9…€ååŒ#8Ã	%ş6ÂC«®aJÖ¢,s=O9Á\"¦)ÒœZkø²ì‚ÒÙ7n­`Æ•…²4D#&„TµŠ2xOb+¯íá›r„\rò*9á™]UŒ„Á\0A 7#ºÖBÆˆÀÀÂo] f ˆ4@è˜:à¼;ÃĞ\\aºFˆÌ3‚ğÊz<WÑcÄ€D¢QÖBAœğÂ‹[(CKĞˆšÂ\"Í£†DÅ¼²6wºOWzçC-Ô6D¨`1B	¨äë‡#Š’Pr_+8—h“!l/\rÆÃXoaÜ=ğş ÂX†¢,GˆË#¬eÁhÁ\$6‡–b8tŠ±][œù@vCzù: ä³‚R20y”7DšÉ›AtU‰<Še–LO‹¨\"ñm?ˆ2Tm'‘½€¨0pCc‰‹ s”õƒÁÂ)@¾Cf©	è='¨õÃÚEÓXì\0ĞpC˜a”\0€1ÇùBCle¬Ì!ò˜˜i\\C@¢LÈ—Rú[mŒ*tºMÄ( \n (Oú™Sƒ,lsı@R|—JCY–iE3 q1È9G02¯”ˆƒ¡Ï;hı Ï—°ékï&OÉ“Sjc\n’‚ó½Ú>SŸÃšGz/•™^ƒƒêáÍ\$¤¹ªvƒh•¤3ÃPA6gqÁa†;¶˜lÖÙ_CÄe,“SK@¦]i\$æ¹})ß\0ZyR%P±¨j\"Ø\n¡¡ ‰8§d¢JÃô_Õ5\0 ’HCË±¥|œ4‚ƒtª;G=Úês’fFA¶ÈØYS‘pc{êwS4sXª¥NIADQ Â¥u&p™µûºÒÅAU¼”À\"jê(	3[V…»ò•bÉ¨²T¤µP¨ôS…ì\"Röà38ßO‰½hOê*ÄÊR„nåcEÇMìDeWêà \naD&\0ÍJÁÉ…á*QW’¾CLH¯–ĞÚ2DŒ4=4`£µº6DŠ€±UäF‡›‚Kƒ†2Fşl,(pÁqW>ŸÛ¶ÒGWÊõ\\ø:1(Æ6Lİ}m-¯†Şİ¦4ÅëC7¼h}1Z	Áø¸·cH]plq”‰¤Äàn•hº…Ø†Lw†Öİ}€(#_€Û’\r`|T*`ZÜ(²hL¡/û§[Hyå¶oÌŒ·ÌS”¢ãwÎDË:lìl‰•?6ùÂÄg3Lâ¨%n—ŞáaÎU*R£ä‚‘PeHiÁäÇ—WÀeòÜ\r)§t9–\r[,Z˜N`'3£&BÚÃ™k¯2é”t	^©íg¸Ö¼î’'-Jİ\\šµöØ8-Œ²¬bù6—XLªô<¢í2ÌQ¶RŞ4ÏÃqk•æ¬B˜e9sJ–©:<”.èZ ‹sQŠ}g)4Îªy‚şËn7ÏVóJ6zÒIë84Pnf4 vxQ\$H_€";break;case"sv":$g="ÃB„C¨€æÃRÌ§!ø(J.™ À¢!”è 3°Ô°#I¸èeL†A²Dd0ˆ§€€Ìi6MÂàQ!†¶3œÎ’“¤ÀÙ:¥3£yÊbkB BS™\nhF˜L¥ÑÓqÌAÍ€¡€Äd3\rFÃqÀät7›ATSI:a6‰&ã<ğÂb2›&')¡HÊd¶ÂÌ7#q˜ßuÂ]D).hD‚š1Ë¤¤àr4ª6è\\ºo0\"ò³„¢?ŒÔ¡îñz™M\nggµÌf‰uéRh¤<#•ÿŒmõ­äw\rŠ7B'[m¦0ä\n*JL[îN^4kMÇhA¸È\n'šü±s5ç¡»˜Nu)ÔÜÉ¬H'ëo™ºŠ2&‚³Ê60#rBñ¼©\"¤0Êš~R<ËËæ9(A˜§ª02^7*¬Zş0¦nHè9<««®ñ<‚P9ƒÈà…Bpê6±€ˆĞÆmËvÖ/8„©C¤b„ƒ²ğã*Ò‹3JÁª`@¼¯h4ˆ‹Ô,«JŒì¤¯H@Î3¶ P˜4¨ºüÀL°ÊğÁS&¡\r£tÌ›¿¯üÌÃ±Hè(!cl@™\"èèÙ>\rÈèÏ(0Âğ© Ä<£àM\"Rhøæ\rLÜ2@PH…¡ gR†®Jnğ&ò3½HB›|ÁBÊ3Ä€çD®€Q†BˆÉH9<ğH6T\"-˜B4HRÎÈë7Çé0Î¢¹#XÒ1l.2Ùc`@É CÍ\"ãµn4!u-\\7'L\\ãMÓuÛ¯ºh7©¨	¢ht)Š`Póƒ!lh¤`Ud o€6Dh¢\nÖ\rã0ÍSí’WOsR:ÈB3>\r¨Ó+”M˜Ø<İº®7PóyŒñl9 å²‘·#l,’\r¨îIwdÙŞQ•1Z(ç—fÊACQS'œŒÌş{ŸÌ2Ó¡å—ãNš	ëv(¶„¦)ÁjĞ…&a\0§|%,0ä6°{‹Bë¬~/a„âT:f«¬\0ì6ætĞ8H\$Â(‚2h´øåœò&º—¼ŠSV³­\n.%#CŠ3¡ĞÑ˜t…ã¿d\$\\«¢ŒázdŒƒz„÷ÁxDw¼°Âã}iãO}y OØàÑòá3 p©J:«ï©¨ê;£#÷<Øˆ· ’¦şŸ%ÇÓõ=XéÖõıgÚ£½¸åÜ÷c(ğGÊ«Î\rÏ¦à’C1F¤xÁ<‡”–ÒšF¥ ’5–”èˆÁŸ%'İ,(G‘¤7Î,ƒWšïŒë)¤ècp–E)4Wë¥tËJ5q†Œ:Ac—1§‚\$•¨’&fáY»(/ê9=¦hÕK s4…º ˜ãù“Lf\$” ÃR€H\n\r¸Ÿ&'6ÚùõÁ«‚˜\nJK€‹+º9 ÂM.d‘&,‚.fLØi0LÈ8åækÊ<L\"”‡FÈÙ‰ê}‰ìÙEE\"Y|Èm‘b.KÒ eÁ„3•wĞ	‘ÿ\"Î`˜¢.·P4.5€˜†Fn™I±8:nÃ©Oäbk+‹šÇ@ÏY˜ƒ±c3F€jÅ°jKm‘¡8éº–ÛRˆpø3,òê†–zrnØqJ% §Õ¨l¸Í`sG¨€š\0Â£>ÖCâZà 	¤uuA·Ì—HĞšE1†“ŠÉêF‘ÌZt\"JIÙ,ˆi¥¹˜Izâ3D¤#@ lVf¢éÃ	C’®D!5ùÉÙn7ê`ßJh£ŠBä'˜Æód£Ò•B ¦Ò£âIMª\nó\\Ò\0öôcï¨v¡U5Ğâê¹&\r†ÀVĞ\"ìÉjO=hjH'ô¬&¦‰•«\n¡cÖ7¤P¨ÛAÅ (ª\n‰©z°ùÃM*E†\n£Uª±W‰¶.¢‡2hÜë2‘(¥dc^LVˆ„¨†#L„@Q~\$ÏË\0£Š›¢(A(zØˆ¢ƒÃsp„•É„Rùh˜L£(cp‰“93ÌO\"tMKÉ)8±IŠ-SŒY\"±Æ4ë…bàyÂZ‡(@(\"‡‹&iÌ¼êĞ)ª¶\"Nå1®¡\"ÏÚ›¸¯­d5´8\0";break;case"ta":$g="àW* øiÀ¯FÁ\\Hd_†«•Ğô+ÁBQpÌÌ 9‚¢Ğt\\U„«¤êô@‚W¡à(<É\\±”@1	| @(:œ\r†ó	S.WA•èhtå]†R&Êùœñ\\µÌéÓI`ºD®JÉ\$Ôé:º®TÏ X’³`«*ªÉúrj1k€,êÕ…z@%9«Ò5|–Udƒß jä¦¸ˆ¯CˆÈf4†ãÍ~ùL›âg²Éù”Úp:E5ûe&­Ö@.•î¬£ƒËqu­¢»ƒW[•è¬\"¿+@ñm´î\0µ«,-ô­Ò»[Ü×‹&ó¨€Ğa;Dãx€àr4&Ã)œÊs<´!„éâ:\r?¡„Äö8\nRl‰¬Êü¬Î[zR.ì<›ªË\nú¤8N\"ÀÑ0íêä†AN¬*ÚÃ…q`½Ã	&°BÎá%0dB•‘ªBÊ³­(BÖ¶nK‚æ*Îªä9QÜÄB›À4Ã:¾ä”ÂNr\$ƒÂÅ¢¯‘)2¬ª0©\n*Ã[È;Á\0Ê9Cxä¯³ü0oÈ7½ïŞ:\$\ná5O„à9óPÈàEÈŠ ˆ¯ŒR’ƒ´äZÄ©’\0éBnzŞéAêÄ¥¬J<>ãpæ4ãr€K)T¶±Bğ|%(D‹ëFF¸“\r,t©]T–jrõ¹°¢«DÉø¦:=KW-D4:\0´•È©]_¢4¤bçÂ-Ê,«W¨B¾G \rÃz‹Ä6ìO&ËrÌ¤Ê²pŞİñÕŠ€I‰´GÄÎ=´´:2½éF6JrùZÒ{<¹­î„CM,ös|Ÿ8Ê7£-ÕB#öÿ=‹ûá5LÃv8ñSÙ<2Ô-ERTN6ˆ¶iJéáÍ„J5ÊR²ÚUìD”8òÚ­hg·ìl\n³ˆåe®	?XÇJRR¥BÙ²JÉd—KªÒd[aß¥¶¨ßõ‘]¬‘v¡Yß[5Õ†ÁµM)WV+„£\$e}æ Nó½¥˜{ìhÌ/xòA j„Ÿ «îmÛè2§,6Š›MÄºÛ°\"7œ³ÓşŞı+¾Å\n^ÕêÜµ'R.\0§ôRŸ@Ş•*±<ºµıë[î|uhZÛn	píÙ]qm0Îw\\œ7gÃ«ïQW¹àx^'hµŞ?º².8G±!vığ÷Ñ¢àÄ>z»|÷¸úSf{ÅÅö7wŞˆ_ÀŒ8Ùï%B\0ÖQÑÍA \$ šAĞS\n`(2@^Ch/aæºåP‰¶¨y³óz¢JAJQ­\0006,€vÎèaGˆ7†`Ì@e8(ˆ‹B¬æ×XÉœğ´³<îÙó\r…«Ä@ŞyCha\rÁäUDCc=áÌ3PØ\ngIÌåg) GFşR@u>à 9‚’¼Â˜RÅ Ù˜e^á_×QnÉ‡›Òhç’ÈÉ„)—àÍ!£IÏL§8D¦‹Áh}hiµÉõiäbï%\$áW:D´”qH3åä·¥Âm+\"”*ˆ>U§ãNúa>™UF’A\0A‘à7&xÚÕ*£‰œÀÂw¡Øf ˆ4@è˜:à¼;ÎP\\QfbgÉ¨3‚öTÓ›\"Œ°‚ }<O²Hàğ†|€]Ø·ho¡Î­)´¢!Ëf‰V‹ùd[ÙŠ \"+vy6¸™“¡”\r]³6‡f¢(Ô§	©Àû‡#ÌŸÔroL 8˜v æ¬×\rfmÍÙ¿8gåóeÄ×;'pnÌ¥•ªYê`ğI4ç±Š†àé?'óTü†öô|ª˜a\rgˆ4§ÔÏfmN 2@‡Ğh*“jJ¤ùõ–c0A¥ğ›Q‡¼‰A^\n ñÇ<Õ( ç®3†#Ä<ÄLU½ÍISÌaŒq–3Æ˜é`ÏÉñ¯„€0±P@é{*a„68†¥ØJ¡P‡7¤¤¥TçXŞãr\0PP	@¤V‰\\UİÍÀAî¥K6g³-9€¶g^GÕ,Í¯óèøSÎzOYí­é=‡ è|ÚvO¡‡{¶°dµ¡&‡ ö_Z‘HV•ô\\ËlWfg«‡Âk‡4ı£ªe?5p7õIÃš€PVı0ÑTÃHg› ‚ÃY£ÄÃÆˆFÆØ¯'à«œä”™ ÓZÛë}ïÔD×6D.—k‚GWi–ôk\"—œ7¦ãD™3'äÙ;Eğ˜IÙ/\$£BawÙ0_”ñ/]Å9x«:¥“®'-øÒâbûçH2&+Á\$‡“¸ ioG‘<'İUÏÑğ‡aÄ:ôğ“Hm™4öfÒl™CCN6jğ§ãÜp!g{(Ş…h¥‰zÈÀP	áL*d”C(LVšXˆé‡‹ÙÉ¡p9z·¨œ­(LiUX\nC(•y*YôÉ0z°4Ò‰ ƒ6¡Ê|ØÓî™á¶hiKÔ!’ó\ry†ùŸ&R‚PÊ( šá‹‚\0¦B` ×,tõMpŒ-äZoA¤Ó§ÈëóÉ ‰“©,;xb1\\Jl²nC´Ò#\0ñ%ARKvÂç“ˆò*ëW0FQ½|{—ÙÕqpX—U—Ó€Ü¸/\nŞ+¬“îmš…ÉCä>Â÷Ô‘+ÍıTníşÎõ}’!:WÜõZõ\nX/Ì¤q\rßÇø¾”obKåà±9{ekğ ˆGõ^\r!Œ5‚5Ãµ¤Î·V©Õ`Ò¢å]+ÁìÕ9Œ0¬t\n¡P#ĞpÈf†iI<úiœºu+fÇÓ®qáúÅw-Şã.íGVÜcŠ±cOá²Kš-‹ÒƒÎ¥o\\İÇ–Öì_‡µ_©Wt:w¹ßJ~\"åç‰À“€236ëí.BÂc»‰L0w^\\§(z*Ù™›pÉh?TÈÑ‚oVë~[Ä~é²n6’'~øÛğyÚ1H2†Íz¨šbñşó¡:<\\»|‰g®üêóİE*È„mféZ(ªê¾şÛöÇê§%É\r–øî`¯ ¯ÂˆŞƒjjNI¸bŠŸF‚ÒïâmŠŞ6gª Ä\n4dt‚Fz©vZKÙFS\$ˆä\\ğâÎ:åª:eöÆ‡\nošªş»d–…'Îâ€†(išiçÉVî¯²úäñÍBû\n&‰Nğò£Óì²äV…B\"z‡>,ãBˆZs	Bğ0ˆ\\#rup:ñ>å¼”%8AEÔd¸şiúD¢";break;case"th":$g="à\\! ˆMÀ¹@À0tD\0†Â \nX:&\0§€*à\n8Ş\0­	EÃ30‚/\0ZB (^\0µAàK…2\0ª•À&«‰bâ8¸KGàn‚ŒÄà	I”?J\\£)«Šbå.˜®)ˆ\\ò—S§®\"•¼s\0CÙWJ¤¶_6\\+eV¸6r¸JÃ©5kÒá´]ë³8õÄ@%9«9ªæ4·®fv2° #!˜Ğj65˜Æ:ïi\\ (µzÊ³y¾W eÂj‡\0MLrS«‚{q\0¼×§Ú|\\Iq	¾në[­Rã|¸”é¦›©7;ZÁá4	=j„¸´Ş.óùê°Y7Dƒ	ØÊ 7Ä‘¤ìi6LæS˜€èù£€È0xè4\r/èè0ŒOËÚ¶í‘p—²\0@«-±p¢BP¤,ã»JQpXD1’™«jCb¹2ÂÎ±;èó¤…—\$3€¸\$\rü6¹ÃĞ¼J±¶+šçº.º6»”Qó„Ÿ¨1ÚÚå`P¦ö#pÎ¬¢ª²P.åJVİ!ëó\0ğ0@Pª7\roˆî7(ä9\rã’°\"@`Â9½ã Şş>xèpá8Ïã„î9óˆÉ»iúØƒ+ÅÌÂ¿¶)Ã¤Œ6MJÔŸ¥1lY\$ºO*U @¤ÅÅ,ÇÓ£šœ8nƒx\\5²T(¢6/\n5’Œ8ç» ©BNÍH\\I1rlãH¼àÃ”ÄY;rò|¬¨ÕŒIMä&€‹3I £hğ§¤Ë_ÈQÒB1£·,Ûnm1,µÈ;›,«dƒµE„;˜€&iüdÇà(UZÙb­§©!N’ P‰ÁÍ|N3hİŒ½ìF89cc(ñÃ˜Ò7å0{ÉRÉIéF¬Ü6S’í¹³•wÜ¨ìqp\\NM'1İR²Ÿ×påapÔ:5õ…Lií`³ºIüIKH‚¿Z c#Û‘Si©h,~­CN³*©œ£#¸VK·™/µÛ¬Œ‰3•\r%Êˆ<¿€Sâ¨^|8b¬ MŠ»]ß6úé;hÓ¥iõ‹³d01q¯-²ss­sòT8J+*gKn+´ê»¹£xt²ÂÅÃ¿c9©Û*¬á±q¤»»>ê)ÖJ®ôuRáÌE¥«¼öüÏtƒ‘•L›»u_;v±üÆSÙîúº®ØÄH\$	Ğš&‡B˜§xIÊì)c3ÕvˆP^-µeÁj]“>.))á@4Z‹Å(\n\rĞ9\0£Ğzƒr=á¼3`Ø•C)Å9¢,¡-Å¤ØaY{‰)Ş·®†ÈT\rçÈ6†ÜA\0ue!Ô1†3øÃ0u\r€€6ğÎ•C˜,?ÁÊÎR¨ ‰ •¼†ÔªP((`¦\r0FàÁÎúºVdõS0¦‚3z:¥Áë¤£`m\n©{Iï,rw©¼:H±Í¶\nmÕÊ„h®%@!9¿[„ıÍ¬”4G: ^o|¬CØšèfc¡Õ•%`@C\$N\rÉº!6XÊƒ\"n\0ğ0¸\$è\"\rĞ:\0æx/òÌ3’qà¼2†à^˜øterøé€¨g€¼0ƒâ°á¼ÃU-Ù­¢È¸@Şñ±ê¦?¹5 KQ-MQ³HÑL„s-ñò;£¸ò‚jw@¬‘C5¢“hx¦	(¹G)CD§•2®VÊùc,Ã¼µ–òn\\‡)w/eã'—¬©–ğDbğI\r¡Àü†Ùz&\\Ícty†öòÁ-\rg¼4¨TİdØn…cšƒš¶TéUhjäÁ	¡=¦\r¼0†9„Ë\0w?ì1ğà›¤r£Íä0†iæ !¤6ĞæÃØ~›*R?Õ\r@<ı£á¤0†Å~ñ'I9èj5ª×2¬á:®YY¹ºê¨Õ{pS¤ì­Æ €  ª—æ\\='mĞî.DÅO4&eT«€ †Ë\$İF™'øùCì~Ğeo*9Cú‚Sê­°ô;Ú¤Qdo*ŒéFXùâÍBMÔ°şÊPæ¡¡´JMˆ–àáš‡Q!É¼‡tÃE)\r!U‚\n›XÏxc2R»Æº\\ë³ÊYQ±XÇUa\\éaS©dª¬DXWKav8FÁ0¹ftsNÛ®›ÁG“•¸‘;ˆ]_€’ICÉé4·“âŸÓÀn¤è şÁ âOâÉÀ6Éz(®blpõ<V;`¡İ·Lvåq9ët£]6jÆÉN²¶WIí:)\"à»e¹€HR©&xõcÔ–@³zHd£‚ÔE{ËA*vp·?âÆâ³¥½JàÇ`¬VƒDŠÊ„óá+Ä›=–À‚R†+·O‚ˆLšÔï)B0T±0¹¼†š6¡\"V\"ÄŠ7ääÑÒC_V6úE¡™#ÃpCˆil¨ç:ËÜä|nš^m,^È›„×ÔDmëcS‘”Õ‘Ò1²/R•“°óÕN nG(jæ¶×fTBYDkD‚£\nX p06¼VCkÊD\0çÅˆq™ÉS+n4Ö•€ŸCl”O÷~\$…P¨h8cÒ{\n%b±ÑÛIªcJ=€s`,àØË:½ÙïdÛA[Ìï³ƒeÊ³“Â“Ìu±w9\r¹QÆ…JãîNV€ç¡Âº&¡ºg&zlRÊ<.5ê¢]²Îö™ÎgÓ¨\\iÔ\"m–âÙK/Ñ˜!-¸¿òñV+07ç0ÚœSÊu][L’²®Ñ£cKÁ²97PÜÁ;f°'x\"]æ”ƒ)ù¨Ö¨¬¡GA\rˆ³+8äï»R²Ww¾;êY¬Ú8ü˜JïÕ%¡uäó„æ7_åÜ‘¨9%p¹ò;€";break;case"tr":$g="E6šMÂ	Îi=ÁBQpÌÌ 9‚ˆ†ó™äÂ 3°ÖÆã!”äi6`'“yÈ\\\nb,P!Ú= 2ÀÌ‘H°€Äo<N‡XƒbnŸ§Â)Ì…'‰ÅbæÓ)ØÇ:GX‰ùœ@\nFC1 Ôl7ASv*|%4š F`(¨a1\râ	!®Ã^¦2Q×|%˜O3ã¥Ğßv§‡K…Ês¼ŒfSd†˜kXjyaäÊt5ÁÏXlFó:´Ú‰i–£x½²Æ\\õFša6ˆ3ú¬²]7›F	¸Óº¿™AE=é”É 4É\\¹KªK:åL&àQTÜk7Îğ8ñÊKH0ãFºfe9ˆ<8S™Ôàp’áNÃ™ŞJ2\$ê(@:NØèŸ\rƒ\n„ŸŒÚl4£î0@5»0J€Ÿ©	¢/‰Š¦©ã¢„îS°íBã†:/’B¹l-ĞPÒ45¡\n6»iA`ĞƒH ª`P2ê`éƒHæÆµĞJİ\rÒ‚ˆøÊpÊ<C£rài8™'C±z\$Ø/m Ò1ÈQ<,ŸEEˆ(AC|#BJÊÄ¦.8Ğô¨3¸³>Âq‘bÔ„£\"lÁ€ME-JšİÏìbé„°\\”Øc!¸`PĞÍã º#Èë– ­ƒ1 -JR²²ÎXÊÍ¯¡kğ9±’24#É‹Tà«ë’éˆõú:éÑã-tŠ1Œ‚7e¤x]GQCYgWvŠ3i¥ãe¬,£HÚç¹b˜t\"Ğæˆ‹cÍä<‹¡hÂ0…£8Î\nÉz![”àPÙ%F¦£÷:|²§Ãš}I8¦:ÃªŸ‚éğ×…¬Ø3Ãõ„zv9­ÈÂÍÇ°Ü‘>:,8A\"}kÑâ#ˆ4h¸æà¸a:5¸c–]58ØŒ€#È3Fb˜¤#!\0ÔÏØp@#\$£k2èSí\$â~O”Ñk,Ÿ9&~Ù;y±b“ˆ#\"—èĞ¤Q¹*xz|ÑÔ‰d:²ì\\ZİZx‹Ê3¡Ğ:ƒ€æáxïÍ…ÖÖîÉ(Î¦!zg*ƒK‚„Aó×¾–+*è0å,×—‹+\"È‡xÂl»;r9Å¹Š£;ƒ¨X\r‹Àè3CÚŠŒO=–g‡î’¨ArŒÜsŒø…çƒx÷ë­0#dà¡ÎÑæX³,ÚYÅ„oÈò|¯/Ìóc¿:İˆ tN7:D¸LRüE \"˜LŞKw®ı	¡S¶ö\0Sf¬ Ü‘ÕxJ™Ç3ç’†Äxú…‹r\$ÈùZ'–`º\\ÉÌ*`ØÉm¦¸õ¶¤ÛH»&ƒm¡•ŠvjÆŒcàh]‡#6Ø		eu\$|™0×É8U@¡¹¿êDƒC\$,¼…\0Dcu(¼Ò\n\n+UTfmSô>SŠR*±º”Ëc…\n,©¡hº|Œ9ŒA(-í:ñ>…±!°—EBFyÚ\\OM:Øhƒá¼9\r\$œ*…‚fO‹>?fLÌ0é)¥hp*íwŸàä¢ƒº£hà€†w&Mt¯5Ò\0:ÒNJIY’¤Àò6BÈÈº­|\n÷‚\0ÂÃŠâfà€&<ç @Ğz#Ñ±	 ¨»#	9Š•v‚êçÃ'ËI`(tOkI&Äñ'‡–BíÙéû‹¡¸“±èj^Éx3@'…0¨kHùys,<œvD[(³*\$]&ÅBHÙD¤	PòØ¤%AGÙ³I²ÜJÁR4@ÙI™ b¡)´`¦BcÇ)SV„‹Ã’g¡²§7çÕŠ”ô@Õ!®8†0áÔ™6h‰9¦0„@èÉFo±…#\"ğÉHÆ¸êÒ‡KG&¯ Ïk	º41k-‰¬k+…[„uÒ¯„%O8£´zOB~)™wâghB&¸!¤°Ø\nâéPÔ‰! @B F á	†ğÈ‚_sA°–“èU[”-qª1Ú©¶¹²Ü™ÂÙ¯\nÂÚº-ítÚnhÔ¸—3Úüšè‰ Ù ‚P²>H%• à.!|€O¯ë…†p\$Êè³		#Ğ3\roÏÁ½&ô0Dƒ\nd‰’L²éB‹àY¾	ôé#ü«›yn/\rb+…^T=v[F~Ô˜Emp@K\ráÀ‹'pˆÇ-tî·L”É£p¼.R.ÑŞêW†ƒ}`0’.ı>\"ğm¡\rØ@";break;case"uk":$g="ĞI4‚É ¿h-`­ì&ÑKÁBQpÌÌ 9‚š	Ørñ ¾h-š¸-}[´¹Zõ¢‚•H`Rø¢„˜®dbèÒrbºh d±éZí¢Œ†Gà‹Hü¢ƒ Í\rõMs6@Se+ÈƒE6œJçTd€Jsh\$g\$æG†­fÉj> ”CˆÈf4†ãÌj¾¯SdRêBû\rh¡åSEÕ6\rVG!TI´ÂV±‘ÌĞÔ{Z‚L•¬éòÊ”i%QÏB×ØÜvUXh£ÚÊZ<,›Î¢A„ìeâÈÒv4›¦s)Ì@tåNC	Ót4zÇC	‹¥kK´4\\L+U0\\F½>¿kCß5ˆAø™2@ƒ\$M›à¬4é‹TA¥ŠJ\\G¾ORú¾èò‚¶	‹.©%\nKş§B›Œ4Ã;\\’µ\r'¬²TÏSX5¢¨Ü5¹C¸Ü£ä7Iàˆî¼£æäƒ{ªäã¢0íä”8HC˜ï‹Y\"Õ–Š:’F\n*Xˆ#.h2¬B²Ù)¤7)¢ä¦©‹ŠQ\$¹¢D&jÊÆ,ÃšÖ¶¬Kzº¡%Ë»JÜ·s\$PhI*ÑS2g4MZ\rè‚\nô›BX#D£&Ï.i³%.Ô0£|LµTRöOI•@hhr@=”©\0®Á‚#ÄòºSèAGu€ä,öåa£Ã¼7cHßh-e\nO2¯‰ Ó!Q*€˜LÈÑ4ÈLí…,ÉèÑ>É«)ŒF#EThM¯…Ô˜—;ršFêöM+¡ÌÅJ´2•Ñê\n&2 Ä—!.aìö#‰á×¢_M@Uù2#Iq,¨\\y8c{±CV]#EŒ°£…´IjZÓ67Rí¤ZĞW	”ö‡Á†)^Djd¬ß±@Š£¢×SE¤Ô©©#ş¦æ4áQÑVÒ8•Ë+¢….6’¼­.	ÊºËÒÍ‰°÷›üª4:+KW¶);%OîX“ôËjªj<’oMÎù¿mjWİğ{Š“ğÖ¼6ßnüZÆ-iLa¦º5Z’aÑ Rõ}U¬P£Jahoà\\-«İÍv@ºL]¦CJZˆC`è9N†0N@Ş3Ãd@2Ú°z²ƒVõë\nƒ{—¨ÃÈ@:Ú¨Æ1º£˜Ì:\0Ø7Œñ\0ç0øÿÂ3êQ¼A¹„l@Nğ(`¤µ™§(ªË©\r`Á)… ŒgZãŸÄ±ÀtîHÊê•…rBM„I	@„¬[–²¤2%p	6§‚H¤¹6(I¡77pO¡ÅFgX3,@ê´Q !‘ÿär˜CÓZ!‘‚\0xN#ÍÀô€è€s@¼‡x¼ƒDzhõp^Cp/H«:-(Òôk;¨€3ƒÀ^AóÕ`\nñƒ¦E4KŒ‘Sm	¤F&\\‚ÌSåÕ/¦,¦‰ÓoƒIŠ)8jW+¥CHPA“ÀšòËJÍ)%Dp€iy©V'E\0Ñ¢¤V‹j.Eàï#FŒÊ3FˆÎ³£BÑZ`¼p|Chp:A¶4HíÌ<½†‡úCYÈ\r)=¾	›Š‰tî­•2È˜iOx-Ü”eÜçÈ„8\r 0†8Ú´Á\0w:/´1€àaèr™Œ00†iB’ß;é}oµ÷¿o>×d`0ÌÀ@å\\Í\r!„6'æfÍ¹üt°\\Ù«Fñı))¾…\0m\"NÉâ’Ï6\n8)‘Ğ„“”ç8ÆÓ<*9ˆÂ¢#ä2rQ&!J²\\IàCZq{GC®rÎiÏ:'L2°Äšƒ¡Ö<I!%QÇŞêì!ÇíÒ&5ŞCÄ±K&3¡\nTàSç’9›GZ(4 úû<h7\0sŠSL0;ÆèiñXOÚ\$ra‡ïQTÔÅ,Ë²ü …?C6ğQJ; †öƒz¹¤Qş\\È\"§“19 Á¾PMÈ9I ÔR`C,Èß.ôïRÑg'\$‹‡“„ ia‡)%\$0İ5O	Öy¡Ä:T”‘ØmˆRæ&Ø4nßzC¢U(CÑ\\ÛrjLD:¶èA	\0±_Jˆ^\0 Â˜Tf¨–\roKA%Ì¸ºI2›~†ü †}É›‰kn>\rKK]Ñ¯„®«•5!K|’™u„¤Hy8*hG8Ï³(Üí>øÂ\"€b²@€)…˜5[B(`¨1Å×°3%'X¿xHÂ98èõ«­tÑ:\\=Lp©Ï‘ûŞÂX44ô­Çüº/²şV(+&Cæ4Ä…IYqˆi+7ü+ñqp¬MÑf¡ãÛVn“Es<æwù&³h Z;fLñJóÜ}a,ß€ †ñÃ`+QEßVEQ[h°C\$5LeÙĞ4iáêC:¤¢u N‰ Í\0(#d ÛÒU–aT*`Z,Iº(„8grn›¸ºÌM±MãîW	ríóc+½ØvYJÙ®kh\"¢[—˜¹¸Úö°Ym’O¶öz»Ú*_:QöğH	õ×Í¥bÕülM/ÅÃE„Ù¨C0y1ûœ¡†É|	s¤Y/£tJVËV(•šÅì@	*e10Óuš·¶›ö}¦rÍ`ıW™µq6ĞŠMjC#©œp\n	¿†Ôx‘2æ›\r\rBšÎ…KäjÏÎnQ{ƒgÕ;6²¿	{ÜU-2n¢VÏVÚİa!ĞÊt§µ]\\YŒ»qe%m.ÜİDk•ìåÈÎû2Ú½°)„÷+ß&‰}ˆR4£p¦ú4mP(ƒy×x^À»İG\0";break;case"vi":$g="Bp®”&á†³‚š *ó(J.™„0Q,ĞÃZŒâ¤)vƒ@Tf™\nípj£pº*ÃV˜ÍÃC`á]¦ÌrY<•#\$b\$L2–€@%9¥ÅIÄô×ŒÆÎ“„œ§4Ë…€¡€Äd3\rFÃqÀät9N1 QŠE3Ú¡±hÄj[—J;±ºŠo—ç\nÓ(©Ubµ´da¬®ÆIÂ¾Ri¦Då\0\0A)÷XŞ8@q:g!ÏC½_#yÃÌ¸™6:‚¶ëÑÚ‹Ì.—òŠšíK;×.ğ›­Àƒ}FÊÍ¼S06ÂÁ½†¡Œ÷\\İÅv¯ëàÄN5°ªn5›çx!”är7œ¥ÄC	ĞÂ1#˜Êõã(æÍã¢&:ƒóæ;¿#\"\\! %:8!KÚHÈ+°Úœ0RĞ7±®úwC(\$F]“áÒ]“+°æ0¡Ò9©jjP ˜eî„Fdš²c@êœãJ*Ì#ìÓŠX„\n\npEÉš44…K\nÁd‹Âñ”È@3Êè&È!\0Úï3ZŒì0ß9Ê¤ŒHƒLn1\r?!\0Ê7?ôwBTXÊ<”8æ4Åäø0Ë(œT43ãJV« %hàÃSï*lœ°ù‡Î¢mC)è	RÜ˜„ˆA¯°íDòƒ, ÖõÍB”Eñ*iT\$“E0Ã1PJ2/#Í\"aHÇM¢ˆZvøkR˜Öà—ìRôRÁCpTÏ&DÜ°EÑ^”­G^§ÚI `P¢Ó2´hî¬Uk+¨i’pDĞÃhÂ4“N]Õ3;'I)ÁO<µ`Uj˜S#Y†T1B>6‡ZêmxÈO1[#P+	¢ht)Š`P¶<èƒÈº£hZ2€P±„½l«.ÌCbĞ#{40PŞ3Ãc¶2¥ÓaC3aÅÙOf;ÅèÏÎk†Z¢xš8¢¤Š|î½ C¾Íæ­[46E¡`@‹”s2:õpŠÆêÍYá8a—PPÜÊŒ;,Ûs§¦´(b¦)Û¨ÓÃq4³a¥3šH1J5—EXê—dr;¶ÁCÄP3©cE05Àã5\n:Òk°‚2\r»åÃt¨Ò2>Á\0x¡èÌ„C@è:˜t…ã¿Ì>gœ?#8_C…ã\$PşÒƒp^ß•:;c8xÃ>%ÁAšªRT(™Ú)¤í \$\$:/Ã£¨H)™`+ƒf®‰C)W¡Z¬ê³fê ¦\0K^³Ø{Oqï>Äù0w}¨7gØŸsğQêD7)4PıÊ@>0ç¨ƒ\ndQ Cÿ€,€¦u|AKTLK¡¢×\$‡IyUäMCâZ³aoñ\0îÅay@aÀû<`äC*Ğ!™H¨ĞæCc‹¡˜:ÆØÓAŒätš 4o+]z¹şØ¥‹¡QHq^+\"ôbŒÑªu4ğ»Š€…Ğ·AA@\$hºÑäq¤\"dÑÚEÖ1¿Ò9,€r\r'i@†xâäzOÈ!Hèşã‰Ko\0½÷LğO²˜e9¡ôÜ…›¸8T „ rZİšÄwšŞôj›A '‚ºSTJ-w¤4G	RY ¸‡rs˜¸£AI¡~¯öãKC¥Øâ“ôòÃCD¸\"â¤â„D‰S°s®Ì€»`RK‚I-hõ½9‰s-f¨®š„‚ƒ1ø:o-æÃUGT9è\nS t#/ÛRlFd¡âˆKxP	áL*pêßÜ!9…\rÄÄâD¹‰„GeÄÜœ“³ŠOh‰õz|Åt)eHÃŠd8LÎ Ú;£íÀĞÉ7J¼Y«ğeR¢ì‚¤¦9îÖù`Æ0¡\"dáÃ-PÉ3·dBA6»ã¾î,¤®u®K0›N‰‰)¹È¢ÉìA i40Q=±*‘Âr¤!–ˆÓ`×\\	/ñ9¿–„¯	É0ˆô“‹MS|m±h]’•‘\n¡P#ĞqgÒœ`”õ™'P™µ’’40\0ğÔ,sS²'¤åZ^Î™”´à((‡U1		0\n¸F\"*²úåUû¸ªÖ‹_o,U¾b,Í”SjÓš…¡¾7ª+U0lÓš£t°1¤´Â“‚¡Ş·#I™	jq\"!ÈÈ\$êÇEØ\rÇ\\0Øz&¨ÂÂK¬í¾ØºÅb.•šä\\Ë£	{Ô!Ò•4¨ªæ*é““\0‘»¸ºöI˜ìLÕé² ";break;case"zh":$g="æA*ês•\\šr¤îõâ|%ÌÂ:\$\nr.®„ö2Šr/d²È»[8Ğ S™8€r©!T¡\\¸s¦’I4¢b§r¬ñ•Ğ€Js!J¥“É:Ú2r«STâ¢”\n†Ìh5\rÇSRº9QÉ÷*-Y(eÈ—B†­+²¯Î…òFZI9PªYj^F•X9‘ªê¼Pæ¸ÜÜÉÔ¥2s&Ö’Eƒ¡~™Œª®·yc‘~¨¦#}K•r¶s®Ôûkõ|¿iµ-rÙÍ€Á)c(¸ÊC«İ¦#*ÛJ!A–R\nõk¡P€Œ/Wît¢¢ZœU9ÓêWJQ3ÓWãq¨*é'Os%îdbÊ¯C9Ô¿Mnr;NáPÁ)ÅÁZâ´'1Tœ¥‰*†J;’©§)nY5ªª®¨’ç9XS#%’ÊîœÄAns–%ÙÊO-ç30¥*\\OœÄ¹lt’å¢0]Œñ6r‘²Ê^’-‰8´å\0Jœ¤Ù|r—¥ÊS0Œ9„),„•ò²,‘´¯,Ápi+\r‘»F¼¯kéÊL»ĞJ[¡\$jÒü?D\nÊLÅEé*ä>’¬ù(OìáÊ]—QsÅ¡ã AR–LëI SA b8¥¤8s–’’N]œÄ\"†^‘§9zW%¤s]î‘AÉ±ÑÊEtIÌE•1j¨’IW)©i:R9TŒÙÒQ5L±	fœ¤y#`OA- 6U˜ŸBöí¾@?‹ÁÎG\n£¼\$	Ğš&‡B˜¦cÍü<‹¡pÚ6…Ã ÈX‰E=€PØ:Ijs”ÅÙÎ]ç!tC1¤â E3|ãAëAÏAÏÉ‰bt‘‘X¹1ñ˜“HdzW–ê5ÆDÇI\$¶qÒC£e|Î¼F¬9b˜¤#	9Hs‘\$b”ÿhdm\ro\\\rÊFèêYHWdşOd¬iOE\0;nè‚2\r£HÜ2Y³ütĞL’*\$KÀ—e`x0„@ä2ŒÁèD4ƒ à9‡Ax^;ópÃºnÛÀ\\7C8^2ÁxÈ7Ãè4õxD1LÁX_!„AĞE–)áÒP–§I:Q!„HxŒ!ğ\\Œ„Ó¦ÔBù”g½gË9³ĞŠº3OÜ,YyÄá>¥püOÆñü'ÊòüÏ7ºîã—?Ğô}(Ê< çÖt¡?ĞTƒÅLd\\af%I²Âsp9È…¢0K!±~!]Ú*	tî’”+Äéñ>gÔÆŠÑH9„˜WÅC/\$JÙPŸns‰±pBDa9ƒ”CŠÓØõKAABœºµfdDâÂL¨8¸(“”:@\$ÈÿÒ`ƒ‚¡Ú”w‚õˆÑ‚&¤ÜÏ	áÌ#…*@\rR™AÎ*Åzİf4Ã\"á!ñ‹1¤¾	3ƒ¹ù?g,¹ pxK8æñ½õº+Èà½ÊPû‹Å¢-À®Zâb@´š(è¶¯t˜(ÄM‰Á:Cƒ˜WUĞÄ{Wg”Q	åv(ºÂs	á8cé‰Â\$“ˆææûÂêk¬àsô …hâBgvï]ùW\n<)…D²zÌY1DşY'A#Ê‘a†--7È%-eºc\"VªñÊ\$Hğ»‘íÅ¢NyÊâ#@ GÉ 'è¬E…0¢\na>5ó—1öBœ\$©ÁCk¤çv.a©Œ/lÌ™±,,(ı!£bÈß˜JDØ®BEáq5L(ñ©(Ë\nLhŒ˜‚ôG„6 \rë_I‚T	ñ hG(€’ÂüMÄSL+ˆ¹Bdô[X/a™İ\n¡P#Ğpm„²y*ôÖ\"½º2`ã#¬%aŠ“¦´±««P\\°2T¡išC @‰CL\\„\n•­àì·mËèébú3œ!^ÅÍwª\"ñ\rˆ¡@:ì’3LÒu«	ohòañß%\"\\L	-\"\0¹›'/R=l\"0´¡vrËH¤*	;‹ÈxZ+y„^FB*%H(­)Ò¯1EWª²ŠR,";break;case"zh-tw":$g="ä^¨ê%Ó•\\šr¥ÑÎõâ|%ÌÂ:\$\ns¡.ešUÈ¸E9PK72©(æP¢h)Ê…@º:i	%“Êcè§Je åR)Ü«{º	Nd TâPˆ£\\ªÔÃ•8¨CˆÈf4†ãÌaS@/%Èäû•N‹¦¬’Ndâ%Ğ³C¹’É—B…Q+–¹Öê‡Bñ_MK,ª\$õÆçu»ŞowÔfš‚T9®WK´ÍÊW¹•ˆ§2mizX:P	—*‘½_/Ùg*eSLK¶Ûˆú™Î¹^9×HÌ\rºÛÕ7ºŒZz>‹ êÔ0)È¿Nï\nÙr!U=R\n¤ôÉÖ^¯ÜéJÅÑTçO©](ÅI–Ø^Ü«¥]EÌJ4\$yhr•ä2^?[ ô½eCr‘º^[#åk¢Ö‘g1'¤)ÌT'9jB)#›,§%')näªª»hV’èùdô=OaĞ@§IBO¤òàs¥Â¦K©¤¹Jºç12A\$±&ë8mQd€¨ÁlY»r—%ò\0J£1Ä¡ÌDÇ)*OÌŠTÍ4L°Ô9DÚB+ê°â°¥yÊL«)pYÊ@ÅÔs“%Ú^R©¥pr\$-G´ƒ˜Æ%,M•ÈxÈCÈè2…˜R¦“Ù SA bh©¤8¡®!v]œÄ!*åíBsÄ“öGIê~ƒ¥ÄZ<^“–i\\CD=šMÑÅi te­|[:ÅñtåS¬\\Xº°—\\W‡)]%Ñ\\	zŞêMF¡7Ä]–Ì±ÎG—Ê²°\$	Ğš&‡B˜¦cÎ,<‹¡pÚ6…Ã Ék[™ü“ PØ:L¹Pt“eM…ÑË…átº*T1FŞ×Å.ùŞ¥!c í7 \$	 HatAWğAÇI ª—ÄaÒC‘§ARS`ÈÔ€D&± †)ŠB0@:\rãXÊ70­‘­E^5IŠür’ÅtND'äTÙ^ñ9Oa:€F¥@‚2\r£HÜ2Zvåg1\nW(Ù¹Hµ¤ˆx0„@ä2ŒÁèD4ƒ à9‡Ax^;öpÃÈr\\ \\7C8_·…ã Ş7# Óá…á|s¤ƒD_!„AĞEèd±sÊôé†!à^0‡Áp)Œ£˜çãÚœW¤‘ÒG-n›¶yLæ—eÅE—Ù\$0JéİK«u®½Ø»7jíÜ‹“NíŞ»ğÜïÃÂ§\rÏä\"”›’r¢ÄJ½çÀœD°¹#‚Tt\ná&AœÊ’R‚rˆÁ,eŸ#æ}\rL_£‘@ô…«MI°ö\"qZ)Ğ \nìXv™ÜŸqˆ4s‰´„\$!6ÂH¡¡4ÏÄbõk#”O‹s(ØHÚ%éÑ¢3gğ»Kçı\0‹FÊ€H\n	š1!Ô?D#Ñ)Oqú•\"`L…‰ªk R¡`9ÄL\"4qpPFÆÙb˜‘´D¢s0aR™l¯İE!XĞ.åœs\nxÓQ¬4 A‹ÑÌ«J]JˆôuW©l¢nF’ÃÄ-‘ËJ%äÄ™É´`9…pµHá­”X¤'%	A5¨ –7#š9DP D¦ĞS!Ì'„àæ3,Í—QÊ/„ó.Q»·˜2,Dïnb\\N\$Ñ9¡ûÚ\"tQ` Â˜T \n¢€)Ì\0æl¡É\"ğlS8–Fğ°ÆM‰´››)2¤„™,*ø¯WÇÈ@	§Ø‚ P'dˆYĞtz\"Â˜Q	„àŞÎsœÍ™Â¤Á¥¿I|×ŸÒ‰¢¹üˆr„ø™</äÒšs§Tû~—Õ0ÄœÚ¡PæÜ¾«ü×Uu@gĞˆ1Bö@‰ñ~‰Ä`‰ <!²€ØrëIÑ9ã˜O“ó]4Ò‘”:â¸ÿ‹”NI‡,5S¥AÀª0-›Eô}{R‹òøŒ‘²:ÒY#)b‡™2üu…ı|‚åf‰’¤!…P \r\$OP¡6ªÇLôÃ§ÃÏe¶ò		È¹«İ}?ğD¨úšÓ!â¸Š=\n¬Ñ@ JlĞœâ0è½¢š\"Dœ·³}jÕº(DbùK^æHÈÅ½%ÖA{Ş´ü¦IqW ‡ğs+¥xx¬é²+ReÚD.QÒ<GÀ";break;}$yg=array();foreach(explode("\n",lzw_decompress($g))as$X)$yg[]=(strpos($X,"\t")?explode("\t",$X):$X);return$yg;}if(!$yg){$yg=get_translations($ba);$_SESSION["translations"]=$yg;}if(extension_loaded('pdo')){class
Min_PDO{var$_result,$server_info,$affected_rows,$errno,$error,$pdo;function
__construct(){global$b;$Me=array_search("SQL",$b->operators);if($Me!==false)unset($b->operators[$Me]);}function
dsn($Mb,$V,$F,$B=array()){try{$this->pdo=new
PDO($Mb,$V,$F,$B);}catch(Exception$ac){auth_error(h($ac->getMessage()));}$this->pdo->setAttribute(3,1);$this->pdo->setAttribute(13,array('Min_PDOStatement'));$this->server_info=@$this->pdo->getAttribute(4);}function
quote($Q){return$this->pdo->quote($Q);}function
query($G,$Gg=false){$I=$this->pdo->query($G);$this->error="";if(!$I){list(,$this->errno,$this->error)=$this->pdo->errorInfo();if(!$this->error)$this->error=lang(21);return
false;}$this->store_result($I);return$I;}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result($I=null){if(!$I){$I=$this->_result;if(!$I)return
false;}if($I->columnCount()){$I->num_rows=$I->rowCount();return$I;}$this->affected_rows=$I->rowCount();return
true;}function
next_result(){if(!$this->_result)return
false;$this->_result->_offset=0;return@$this->_result->nextRowset();}function
result($G,$p=0){$I=$this->query($G);if(!$I)return
false;$K=$I->fetch();return$K[$p];}}class
Min_PDOStatement
extends
PDOStatement{var$_offset=0,$num_rows;function
fetch_assoc(){return$this->fetch(2);}function
fetch_row(){return$this->fetch(3);}function
fetch_field(){$K=(object)$this->getColumnMeta($this->_offset++);$K->orgtable=$K->table;$K->orgname=$K->name;$K->charsetnr=(in_array("blob",(array)$K->flags)?63:0);return$K;}}}$Jb=array();class
Min_SQL{var$_conn;function
__construct($h){$this->_conn=$h;}function
select($R,$M,$Z,$Ic,$C=array(),$y=1,$D=0,$Re=false){global$b,$w;$qd=(count($Ic)<count($M));$G=$b->selectQueryBuild($M,$Z,$Ic,$C,$y,$D);if(!$G)$G="SELECT".limit(($_GET["page"]!="last"&&$y!=""&&$Ic&&$qd&&$w=="sql"?"SQL_CALC_FOUND_ROWS ":"").implode(", ",$M)."\nFROM ".table($R),($Z?"\nWHERE ".implode(" AND ",$Z):"").($Ic&&$qd?"\nGROUP BY ".implode(", ",$Ic):"").($C?"\nORDER BY ".implode(", ",$C):""),($y!=""?+$y:null),($D?$y*$D:0),"\n");$Rf=microtime(true);$J=$this->_conn->query($G);if($Re)echo$b->selectQuery($G,$Rf,!$J);return$J;}function
delete($R,$H,$y=0){$G="FROM ".table($R);return
queries("DELETE".($y?limit1($R,$G,$H):" $G$H"));}function
update($R,$P,$H,$y=0,$N="\n"){$Vg=array();foreach($P
as$x=>$X)$Vg[]="$x = $X";$G=table($R)." SET$N".implode(",$N",$Vg);return
queries("UPDATE".($y?limit1($R,$G,$H,$N):" $G$H"));}function
insert($R,$P){return
queries("INSERT INTO ".table($R).($P?" (".implode(", ",array_keys($P)).")\nVALUES (".implode(", ",$P).")":" DEFAULT VALUES"));}function
insertUpdate($R,$L,$Pe){return
false;}function
begin(){return
queries("BEGIN");}function
commit(){return
queries("COMMIT");}function
rollback(){return
queries("ROLLBACK");}function
slowQuery($G,$mg){}function
convertSearch($t,$X,$p){return$t;}function
value($X,$p){return(method_exists($this->_conn,'value')?$this->_conn->value($X,$p):(is_resource($X)?stream_get_contents($X):$X));}function
quoteBinary($rf){return
q($rf);}function
warnings(){return'';}function
tableHelp($A){}}$Jb["sqlite"]="SQLite 3";$Jb["sqlite2"]="SQLite 2";if(isset($_GET["sqlite"])||isset($_GET["sqlite2"])){$Ne=array((isset($_GET["sqlite"])?"SQLite3":"SQLite"),"PDO_SQLite");define("DRIVER",(isset($_GET["sqlite"])?"sqlite":"sqlite2"));if(class_exists(isset($_GET["sqlite"])?"SQLite3":"SQLiteDatabase")){if(isset($_GET["sqlite"])){class
Min_SQLite{var$extension="SQLite3",$server_info,$affected_rows,$errno,$error,$_link;function
__construct($pc){$this->_link=new
SQLite3($pc);$Xg=$this->_link->version();$this->server_info=$Xg["versionString"];}function
query($G){$I=@$this->_link->query($G);$this->error="";if(!$I){$this->errno=$this->_link->lastErrorCode();$this->error=$this->_link->lastErrorMsg();return
false;}elseif($I->numColumns())return
new
Min_Result($I);$this->affected_rows=$this->_link->changes();return
true;}function
quote($Q){return(is_utf8($Q)?"'".$this->_link->escapeString($Q)."'":"x'".reset(unpack('H*',$Q))."'");}function
store_result(){return$this->_result;}function
result($G,$p=0){$I=$this->query($G);if(!is_object($I))return
false;$K=$I->_result->fetchArray();return$K[$p];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($I){$this->_result=$I;}function
fetch_assoc(){return$this->_result->fetchArray(SQLITE3_ASSOC);}function
fetch_row(){return$this->_result->fetchArray(SQLITE3_NUM);}function
fetch_field(){$e=$this->_offset++;$U=$this->_result->columnType($e);return(object)array("name"=>$this->_result->columnName($e),"type"=>$U,"charsetnr"=>($U==SQLITE3_BLOB?63:0),);}function
__desctruct(){return$this->_result->finalize();}}}else{class
Min_SQLite{var$extension="SQLite",$server_info,$affected_rows,$error,$_link;function
__construct($pc){$this->server_info=sqlite_libversion();$this->_link=new
SQLiteDatabase($pc);}function
query($G,$Gg=false){$Zd=($Gg?"unbufferedQuery":"query");$I=@$this->_link->$Zd($G,SQLITE_BOTH,$o);$this->error="";if(!$I){$this->error=$o;return
false;}elseif($I===true){$this->affected_rows=$this->changes();return
true;}return
new
Min_Result($I);}function
quote($Q){return"'".sqlite_escape_string($Q)."'";}function
store_result(){return$this->_result;}function
result($G,$p=0){$I=$this->query($G);if(!is_object($I))return
false;$K=$I->_result->fetch();return$K[$p];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($I){$this->_result=$I;if(method_exists($I,'numRows'))$this->num_rows=$I->numRows();}function
fetch_assoc(){$K=$this->_result->fetch(SQLITE_ASSOC);if(!$K)return
false;$J=array();foreach($K
as$x=>$X)$J[($x[0]=='"'?idf_unescape($x):$x)]=$X;return$J;}function
fetch_row(){return$this->_result->fetch(SQLITE_NUM);}function
fetch_field(){$A=$this->_result->fieldName($this->_offset++);$He='(\[.*]|"(?:[^"]|"")*"|(.+))';if(preg_match("~^($He\\.)?$He\$~",$A,$_)){$R=($_[3]!=""?$_[3]:idf_unescape($_[2]));$A=($_[5]!=""?$_[5]:idf_unescape($_[4]));}return(object)array("name"=>$A,"orgname"=>$A,"orgtable"=>$R,);}}}}elseif(extension_loaded("pdo_sqlite")){class
Min_SQLite
extends
Min_PDO{var$extension="PDO_SQLite";function
__construct($pc){$this->dsn(DRIVER.":$pc","","");}}}if(class_exists("Min_SQLite")){class
Min_DB
extends
Min_SQLite{function
__construct(){parent::__construct(":memory:");$this->query("PRAGMA foreign_keys = 1");}function
select_db($pc){if(is_readable($pc)&&$this->query("ATTACH ".$this->quote(preg_match("~(^[/\\\\]|:)~",$pc)?$pc:dirname($_SERVER["SCRIPT_FILENAME"])."/$pc")." AS a")){parent::__construct($pc);$this->query("PRAGMA foreign_keys = 1");return
true;}return
false;}function
multi_query($G){return$this->_result=$this->query($G);}function
next_result(){return
false;}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($R,$L,$Pe){$Vg=array();foreach($L
as$P)$Vg[]="(".implode(", ",$P).")";return
queries("REPLACE INTO ".table($R)." (".implode(", ",array_keys(reset($L))).") VALUES\n".implode(",\n",$Vg));}function
tableHelp($A){if($A=="sqlite_sequence")return"fileformat2.html#seqtab";if($A=="sqlite_master")return"fileformat2.html#$A";}}function
idf_escape($t){return'"'.str_replace('"','""',$t).'"';}function
table($t){return
idf_escape($t);}function
connect(){global$b;list(,,$F)=$b->credentials();if($F!="")return
lang(22);return
new
Min_DB;}function
get_databases(){return
array();}function
limit($G,$Z,$y,$me=0,$N=" "){return" $G$Z".($y!==null?$N."LIMIT $y".($me?" OFFSET $me":""):"");}function
limit1($R,$G,$Z,$N="\n"){global$h;return(preg_match('~^INTO~',$G)||$h->result("SELECT sqlite_compileoption_used('ENABLE_UPDATE_DELETE_LIMIT')")?limit($G,$Z,1,0,$N):" $G WHERE rowid = (SELECT rowid FROM ".table($R).$Z.$N."LIMIT 1)");}function
db_collation($m,$fb){global$h;return$h->result("PRAGMA encoding");}function
engines(){return
array();}function
logged_user(){return
get_current_user();}function
tables_list(){return
get_key_vals("SELECT name, type FROM sqlite_master WHERE type IN ('table', 'view') ORDER BY (name = 'sqlite_sequence'), name");}function
count_tables($l){return
array();}function
table_status($A=""){global$h;$J=array();foreach(get_rows("SELECT name AS Name, type AS Engine, 'rowid' AS Oid, '' AS Auto_increment FROM sqlite_master WHERE type IN ('table', 'view') ".($A!=""?"AND name = ".q($A):"ORDER BY name"))as$K){$K["Rows"]=$h->result("SELECT COUNT(*) FROM ".idf_escape($K["Name"]));$J[$K["Name"]]=$K;}foreach(get_rows("SELECT * FROM sqlite_sequence",null,"")as$K)$J[$K["name"]]["Auto_increment"]=$K["seq"];return($A!=""?$J[$A]:$J);}function
is_view($S){return$S["Engine"]=="view";}function
fk_support($S){global$h;return!$h->result("SELECT sqlite_compileoption_used('OMIT_FOREIGN_KEY')");}function
fields($R){global$h;$J=array();$Pe="";foreach(get_rows("PRAGMA table_info(".table($R).")")as$K){$A=$K["name"];$U=strtolower($K["type"]);$Ab=$K["dflt_value"];$J[$A]=array("field"=>$A,"type"=>(preg_match('~int~i',$U)?"integer":(preg_match('~char|clob|text~i',$U)?"text":(preg_match('~blob~i',$U)?"blob":(preg_match('~real|floa|doub~i',$U)?"real":"numeric")))),"full_type"=>$U,"default"=>(preg_match("~'(.*)'~",$Ab,$_)?str_replace("''","'",$_[1]):($Ab=="NULL"?null:$Ab)),"null"=>!$K["notnull"],"privileges"=>array("select"=>1,"insert"=>1,"update"=>1),"primary"=>$K["pk"],);if($K["pk"]){if($Pe!="")$J[$Pe]["auto_increment"]=false;elseif(preg_match('~^integer$~i',$U))$J[$A]["auto_increment"]=true;$Pe=$A;}}$Of=$h->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($R));preg_match_all('~(("[^"]*+")+|[a-z0-9_]+)\s+text\s+COLLATE\s+(\'[^\']+\'|\S+)~i',$Of,$Qd,PREG_SET_ORDER);foreach($Qd
as$_){$A=str_replace('""','"',preg_replace('~^"|"$~','',$_[1]));if($J[$A])$J[$A]["collation"]=trim($_[3],"'");}return$J;}function
indexes($R,$i=null){global$h;if(!is_object($i))$i=$h;$J=array();$Of=$i->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($R));if(preg_match('~\bPRIMARY\s+KEY\s*\((([^)"]+|"[^"]*"|`[^`]*`)++)~i',$Of,$_)){$J[""]=array("type"=>"PRIMARY","columns"=>array(),"lengths"=>array(),"descs"=>array());preg_match_all('~((("[^"]*+")+|(?:`[^`]*+`)+)|(\S+))(\s+(ASC|DESC))?(,\s*|$)~i',$_[1],$Qd,PREG_SET_ORDER);foreach($Qd
as$_){$J[""]["columns"][]=idf_unescape($_[2]).$_[4];$J[""]["descs"][]=(preg_match('~DESC~i',$_[5])?'1':null);}}if(!$J){foreach(fields($R)as$A=>$p){if($p["primary"])$J[""]=array("type"=>"PRIMARY","columns"=>array($A),"lengths"=>array(),"descs"=>array(null));}}$Pf=get_key_vals("SELECT name, sql FROM sqlite_master WHERE type = 'index' AND tbl_name = ".q($R),$i);foreach(get_rows("PRAGMA index_list(".table($R).")",$i)as$K){$A=$K["name"];$u=array("type"=>($K["unique"]?"UNIQUE":"INDEX"));$u["lengths"]=array();$u["descs"]=array();foreach(get_rows("PRAGMA index_info(".idf_escape($A).")",$i)as$qf){$u["columns"][]=$qf["name"];$u["descs"][]=null;}if(preg_match('~^CREATE( UNIQUE)? INDEX '.preg_quote(idf_escape($A).' ON '.idf_escape($R),'~').' \((.*)\)$~i',$Pf[$A],$ef)){preg_match_all('/("[^"]*+")+( DESC)?/',$ef[2],$Qd);foreach($Qd[2]as$x=>$X){if($X)$u["descs"][$x]='1';}}if(!$J[""]||$u["type"]!="UNIQUE"||$u["columns"]!=$J[""]["columns"]||$u["descs"]!=$J[""]["descs"]||!preg_match("~^sqlite_~",$A))$J[$A]=$u;}return$J;}function
foreign_keys($R){$J=array();foreach(get_rows("PRAGMA foreign_key_list(".table($R).")")as$K){$Ac=&$J[$K["id"]];if(!$Ac)$Ac=$K;$Ac["source"][]=$K["from"];$Ac["target"][]=$K["to"];}return$J;}function
view($A){global$h;return
array("select"=>preg_replace('~^(?:[^`"[]+|`[^`]*`|"[^"]*")* AS\s+~iU','',$h->result("SELECT sql FROM sqlite_master WHERE name = ".q($A))));}function
collations(){return(isset($_GET["create"])?get_vals("PRAGMA collation_list",1):array());}function
information_schema($m){return
false;}function
error(){global$h;return
h($h->error);}function
check_sqlite_name($A){global$h;$hc="db|sdb|sqlite";if(!preg_match("~^[^\\0]*\\.($hc)\$~",$A)){$h->error=lang(23,str_replace("|",", ",$hc));return
false;}return
true;}function
create_database($m,$d){global$h;if(file_exists($m)){$h->error=lang(24);return
false;}if(!check_sqlite_name($m))return
false;try{$z=new
Min_SQLite($m);}catch(Exception$ac){$h->error=$ac->getMessage();return
false;}$z->query('PRAGMA encoding = "UTF-8"');$z->query('CREATE TABLE adminer (i)');$z->query('DROP TABLE adminer');return
true;}function
drop_databases($l){global$h;$h->__construct(":memory:");foreach($l
as$m){if(!@unlink($m)){$h->error=lang(24);return
false;}}return
true;}function
rename_database($A,$d){global$h;if(!check_sqlite_name($A))return
false;$h->__construct(":memory:");$h->error=lang(24);return@rename(DB,$A);}function
auto_increment(){return" PRIMARY KEY".(DRIVER=="sqlite"?" AUTOINCREMENT":"");}function
alter_table($R,$A,$q,$yc,$jb,$Vb,$d,$Ga,$Ee){global$h;$Rg=($R==""||$yc);foreach($q
as$p){if($p[0]!=""||!$p[1]||$p[2]){$Rg=true;break;}}$c=array();$ye=array();foreach($q
as$p){if($p[1]){$c[]=($Rg?$p[1]:"ADD ".implode($p[1]));if($p[0]!="")$ye[$p[0]]=$p[1][0];}}if(!$Rg){foreach($c
as$X){if(!queries("ALTER TABLE ".table($R)." $X"))return
false;}if($R!=$A&&!queries("ALTER TABLE ".table($R)." RENAME TO ".table($A)))return
false;}elseif(!recreate_table($R,$A,$c,$ye,$yc,$Ga))return
false;if($Ga){queries("BEGIN");queries("UPDATE sqlite_sequence SET seq = $Ga WHERE name = ".q($A));if(!$h->affected_rows)queries("INSERT INTO sqlite_sequence (name, seq) VALUES (".q($A).", $Ga)");queries("COMMIT");}return
true;}function
recreate_table($R,$A,$q,$ye,$yc,$Ga,$v=array()){global$h;if($R!=""){if(!$q){foreach(fields($R)as$x=>$p){if($v)$p["auto_increment"]=0;$q[]=process_field($p,$p);$ye[$x]=idf_escape($x);}}$Qe=false;foreach($q
as$p){if($p[6])$Qe=true;}$Lb=array();foreach($v
as$x=>$X){if($X[2]=="DROP"){$Lb[$X[1]]=true;unset($v[$x]);}}foreach(indexes($R)as$wd=>$u){$f=array();foreach($u["columns"]as$x=>$e){if(!$ye[$e])continue
2;$f[]=$ye[$e].($u["descs"][$x]?" DESC":"");}if(!$Lb[$wd]){if($u["type"]!="PRIMARY"||!$Qe)$v[]=array($u["type"],$wd,$f);}}foreach($v
as$x=>$X){if($X[0]=="PRIMARY"){unset($v[$x]);$yc[]="  PRIMARY KEY (".implode(", ",$X[2]).")";}}foreach(foreign_keys($R)as$wd=>$Ac){foreach($Ac["source"]as$x=>$e){if(!$ye[$e])continue
2;$Ac["source"][$x]=idf_unescape($ye[$e]);}if(!isset($yc[" $wd"]))$yc[]=" ".format_foreign_key($Ac);}queries("BEGIN");}foreach($q
as$x=>$p)$q[$x]="  ".implode($p);$q=array_merge($q,array_filter($yc));$gg=($R==$A?"adminer_$A":$A);if(!queries("CREATE TABLE ".table($gg)." (\n".implode(",\n",$q)."\n)"))return
false;if($R!=""){if($ye&&!queries("INSERT INTO ".table($gg)." (".implode(", ",$ye).") SELECT ".implode(", ",array_map('idf_escape',array_keys($ye)))." FROM ".table($R)))return
false;$Dg=array();foreach(triggers($R)as$Bg=>$ng){$Ag=trigger($Bg);$Dg[]="CREATE TRIGGER ".idf_escape($Bg)." ".implode(" ",$ng)." ON ".table($A)."\n$Ag[Statement]";}$Ga=$Ga?0:$h->result("SELECT seq FROM sqlite_sequence WHERE name = ".q($R));if(!queries("DROP TABLE ".table($R))||($R==$A&&!queries("ALTER TABLE ".table($gg)." RENAME TO ".table($A)))||!alter_indexes($A,$v))return
false;if($Ga)queries("UPDATE sqlite_sequence SET seq = $Ga WHERE name = ".q($A));foreach($Dg
as$Ag){if(!queries($Ag))return
false;}queries("COMMIT");}return
true;}function
index_sql($R,$U,$A,$f){return"CREATE $U ".($U!="INDEX"?"INDEX ":"").idf_escape($A!=""?$A:uniqid($R."_"))." ON ".table($R)." $f";}function
alter_indexes($R,$c){foreach($c
as$Pe){if($Pe[0]=="PRIMARY")return
recreate_table($R,$R,array(),array(),array(),0,$c);}foreach(array_reverse($c)as$X){if(!queries($X[2]=="DROP"?"DROP INDEX ".idf_escape($X[1]):index_sql($R,$X[0],$X[1],"(".implode(", ",$X[2]).")")))return
false;}return
true;}function
truncate_tables($T){return
apply_queries("DELETE FROM",$T);}function
drop_views($Zg){return
apply_queries("DROP VIEW",$Zg);}function
drop_tables($T){return
apply_queries("DROP TABLE",$T);}function
move_tables($T,$Zg,$fg){return
false;}function
trigger($A){global$h;if($A=="")return
array("Statement"=>"BEGIN\n\t;\nEND");$t='(?:[^`"\s]+|`[^`]*`|"[^"]*")+';$Cg=trigger_options();preg_match("~^CREATE\\s+TRIGGER\\s*$t\\s*(".implode("|",$Cg["Timing"]).")\\s+([a-z]+)(?:\\s+OF\\s+($t))?\\s+ON\\s*$t\\s*(?:FOR\\s+EACH\\s+ROW\\s)?(.*)~is",$h->result("SELECT sql FROM sqlite_master WHERE type = 'trigger' AND name = ".q($A)),$_);$le=$_[3];return
array("Timing"=>strtoupper($_[1]),"Event"=>strtoupper($_[2]).($le?" OF":""),"Of"=>($le[0]=='`'||$le[0]=='"'?idf_unescape($le):$le),"Trigger"=>$A,"Statement"=>$_[4],);}function
triggers($R){$J=array();$Cg=trigger_options();foreach(get_rows("SELECT * FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($R))as$K){preg_match('~^CREATE\s+TRIGGER\s*(?:[^`"\s]+|`[^`]*`|"[^"]*")+\s*('.implode("|",$Cg["Timing"]).')\s*(.*?)\s+ON\b~i',$K["sql"],$_);$J[$K["name"]]=array($_[1],$_[2]);}return$J;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","UPDATE OF","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
begin(){return
queries("BEGIN");}function
last_id(){global$h;return$h->result("SELECT LAST_INSERT_ROWID()");}function
explain($h,$G){return$h->query("EXPLAIN QUERY PLAN $G");}function
found_rows($S,$Z){}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($tf){return
true;}function
create_sql($R,$Ga,$Wf){global$h;$J=$h->result("SELECT sql FROM sqlite_master WHERE type IN ('table', 'view') AND name = ".q($R));foreach(indexes($R)as$A=>$u){if($A=='')continue;$J.=";\n\n".index_sql($R,$u['type'],$A,"(".implode(", ",array_map('idf_escape',$u['columns'])).")");}return$J;}function
truncate_sql($R){return"DELETE FROM ".table($R);}function
use_sql($k){}function
trigger_sql($R){return
implode(get_vals("SELECT sql || ';;\n' FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($R)));}function
show_variables(){global$h;$J=array();foreach(array("auto_vacuum","cache_size","count_changes","default_cache_size","empty_result_callbacks","encoding","foreign_keys","full_column_names","fullfsync","journal_mode","journal_size_limit","legacy_file_format","locking_mode","page_size","max_page_count","read_uncommitted","recursive_triggers","reverse_unordered_selects","secure_delete","short_column_names","synchronous","temp_store","temp_store_directory","schema_version","integrity_check","quick_check")as$x)$J[$x]=$h->result("PRAGMA $x");return$J;}function
show_status(){$J=array();foreach(get_vals("PRAGMA compile_options")as$ue){list($x,$X)=explode("=",$ue,2);$J[$x]=$X;}return$J;}function
convert_field($p){}function
unconvert_field($p,$J){return$J;}function
support($lc){return
preg_match('~^(columns|database|drop_col|dump|indexes|descidx|move_col|sql|status|table|trigger|variables|view|view_trigger)$~',$lc);}$w="sqlite";$Fg=array("integer"=>0,"real"=>0,"numeric"=>0,"text"=>0,"blob"=>0);$Vf=array_keys($Fg);$Mg=array();$te=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL");$Hc=array("hex","length","lower","round","unixepoch","upper");$Lc=array("avg","count","count distinct","group_concat","max","min","sum");$Ob=array(array(),array("integer|real|numeric"=>"+/-","text"=>"||",));}$Jb["pgsql"]="PostgreSQL";if(isset($_GET["pgsql"])){$Ne=array("PgSQL","PDO_PgSQL");define("DRIVER","pgsql");if(extension_loaded("pgsql")){class
Min_DB{var$extension="PgSQL",$_link,$_result,$_string,$_database=true,$server_info,$affected_rows,$error,$timeout;function
_error($Yb,$o){if(ini_bool("html_errors"))$o=html_entity_decode(strip_tags($o));$o=preg_replace('~^[^:]*: ~','',$o);$this->error=$o;}function
connect($O,$V,$F){global$b;$m=$b->database();set_error_handler(array($this,'_error'));$this->_string="host='".str_replace(":","' port='",addcslashes($O,"'\\"))."' user='".addcslashes($V,"'\\")."' password='".addcslashes($F,"'\\")."'";$this->_link=@pg_connect("$this->_string dbname='".($m!=""?addcslashes($m,"'\\"):"postgres")."'",PGSQL_CONNECT_FORCE_NEW);if(!$this->_link&&$m!=""){$this->_database=false;$this->_link=@pg_connect("$this->_string dbname='postgres'",PGSQL_CONNECT_FORCE_NEW);}restore_error_handler();if($this->_link){$Xg=pg_version($this->_link);$this->server_info=$Xg["server"];pg_set_client_encoding($this->_link,"UTF8");}return(bool)$this->_link;}function
quote($Q){return"'".pg_escape_string($this->_link,$Q)."'";}function
value($X,$p){return($p["type"]=="bytea"?pg_unescape_bytea($X):$X);}function
quoteBinary($Q){return"'".pg_escape_bytea($this->_link,$Q)."'";}function
select_db($k){global$b;if($k==$b->database())return$this->_database;$J=@pg_connect("$this->_string dbname='".addcslashes($k,"'\\")."'",PGSQL_CONNECT_FORCE_NEW);if($J)$this->_link=$J;return$J;}function
close(){$this->_link=@pg_connect("$this->_string dbname='postgres'");}function
query($G,$Gg=false){$I=@pg_query($this->_link,$G);$this->error="";if(!$I){$this->error=pg_last_error($this->_link);$J=false;}elseif(!pg_num_fields($I)){$this->affected_rows=pg_affected_rows($I);$J=true;}else$J=new
Min_Result($I);if($this->timeout){$this->timeout=0;$this->query("RESET statement_timeout");}return$J;}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$p=0){$I=$this->query($G);if(!$I||!$I->num_rows)return
false;return
pg_fetch_result($I->_result,0,$p);}function
warnings(){return
h(pg_last_notice($this->_link));}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($I){$this->_result=$I;$this->num_rows=pg_num_rows($I);}function
fetch_assoc(){return
pg_fetch_assoc($this->_result);}function
fetch_row(){return
pg_fetch_row($this->_result);}function
fetch_field(){$e=$this->_offset++;$J=new
stdClass;if(function_exists('pg_field_table'))$J->orgtable=pg_field_table($this->_result,$e);$J->name=pg_field_name($this->_result,$e);$J->orgname=$J->name;$J->type=pg_field_type($this->_result,$e);$J->charsetnr=($J->type=="bytea"?63:0);return$J;}function
__destruct(){pg_free_result($this->_result);}}}elseif(extension_loaded("pdo_pgsql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_PgSQL",$timeout;function
connect($O,$V,$F){global$b;$m=$b->database();$Q="pgsql:host='".str_replace(":","' port='",addcslashes($O,"'\\"))."' options='-c client_encoding=utf8'";$this->dsn("$Q dbname='".($m!=""?addcslashes($m,"'\\"):"postgres")."'",$V,$F);return
true;}function
select_db($k){global$b;return($b->database()==$k);}function
quoteBinary($rf){return
q($rf);}function
query($G,$Gg=false){$J=parent::query($G,$Gg);if($this->timeout){$this->timeout=0;parent::query("RESET statement_timeout");}return$J;}function
warnings(){return'';}function
close(){}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($R,$L,$Pe){global$h;foreach($L
as$P){$Ng=array();$Z=array();foreach($P
as$x=>$X){$Ng[]="$x = $X";if(isset($Pe[idf_unescape($x)]))$Z[]="$x = $X";}if(!(($Z&&queries("UPDATE ".table($R)." SET ".implode(", ",$Ng)." WHERE ".implode(" AND ",$Z))&&$h->affected_rows)||queries("INSERT INTO ".table($R)." (".implode(", ",array_keys($P)).") VALUES (".implode(", ",$P).")")))return
false;}return
true;}function
slowQuery($G,$mg){$this->_conn->query("SET statement_timeout = ".(1000*$mg));$this->_conn->timeout=1000*$mg;return$G;}function
convertSearch($t,$X,$p){return(preg_match('~char|text'.(!preg_match('~LIKE~',$X["op"])?'|date|time(stamp)?|boolean|uuid|'.number_type():'').'~',$p["type"])?$t:"CAST($t AS text)");}function
quoteBinary($rf){return$this->_conn->quoteBinary($rf);}function
warnings(){return$this->_conn->warnings();}function
tableHelp($A){$Id=array("information_schema"=>"infoschema","pg_catalog"=>"catalog",);$z=$Id[$_GET["ns"]];if($z)return"$z-".str_replace("_","-",$A).".html";}}function
idf_escape($t){return'"'.str_replace('"','""',$t).'"';}function
table($t){return
idf_escape($t);}function
connect(){global$b,$Fg,$Vf;$h=new
Min_DB;$j=$b->credentials();if($h->connect($j[0],$j[1],$j[2])){if(min_version(9,0,$h)){$h->query("SET application_name = 'Adminer'");if(min_version(9.2,0,$h)){$Vf[lang(25)][]="json";$Fg["json"]=4294967295;if(min_version(9.4,0,$h)){$Vf[lang(25)][]="jsonb";$Fg["jsonb"]=4294967295;}}}return$h;}return$h->error;}function
get_databases(){return
get_vals("SELECT datname FROM pg_database WHERE has_database_privilege(datname, 'CONNECT') ORDER BY datname");}function
limit($G,$Z,$y,$me=0,$N=" "){return" $G$Z".($y!==null?$N."LIMIT $y".($me?" OFFSET $me":""):"");}function
limit1($R,$G,$Z,$N="\n"){return(preg_match('~^INTO~',$G)?limit($G,$Z,1,0,$N):" $G".(is_view(table_status1($R))?$Z:" WHERE ctid = (SELECT ctid FROM ".table($R).$Z.$N."LIMIT 1)"));}function
db_collation($m,$fb){global$h;return$h->result("SHOW LC_COLLATE");}function
engines(){return
array();}function
logged_user(){global$h;return$h->result("SELECT user");}function
tables_list(){$G="SELECT table_name, table_type FROM information_schema.tables WHERE table_schema = current_schema()";if(support('materializedview'))$G.="
UNION ALL
SELECT matviewname, 'MATERIALIZED VIEW'
FROM pg_matviews
WHERE schemaname = current_schema()";$G.="
ORDER BY 1";return
get_key_vals($G);}function
count_tables($l){return
array();}function
table_status($A=""){$J=array();foreach(get_rows("SELECT c.relname AS \"Name\", CASE c.relkind WHEN 'r' THEN 'table' WHEN 'm' THEN 'materialized view' ELSE 'view' END AS \"Engine\", pg_relation_size(c.oid) AS \"Data_length\", pg_total_relation_size(c.oid) - pg_relation_size(c.oid) AS \"Index_length\", obj_description(c.oid, 'pg_class') AS \"Comment\", ".(min_version(12)?"''":"CASE WHEN c.relhasoids THEN 'oid' ELSE '' END")." AS \"Oid\", c.reltuples as \"Rows\", n.nspname
FROM pg_class c
JOIN pg_namespace n ON(n.nspname = current_schema() AND n.oid = c.relnamespace)
WHERE relkind IN ('r', 'm', 'v', 'f')
".($A!=""?"AND relname = ".q($A):"ORDER BY relname"))as$K)$J[$K["Name"]]=$K;return($A!=""?$J[$A]:$J);}function
is_view($S){return
in_array($S["Engine"],array("view","materialized view"));}function
fk_support($S){return
true;}function
fields($R){$J=array();$xa=array('timestamp without time zone'=>'timestamp','timestamp with time zone'=>'timestamptz',);$Yc=min_version(10)?"(a.attidentity = 'd')::int":'0';foreach(get_rows("SELECT a.attname AS field, format_type(a.atttypid, a.atttypmod) AS full_type, pg_get_expr(d.adbin, d.adrelid) AS default, a.attnotnull::int, col_description(c.oid, a.attnum) AS comment, $Yc AS identity
FROM pg_class c
JOIN pg_namespace n ON c.relnamespace = n.oid
JOIN pg_attribute a ON c.oid = a.attrelid
LEFT JOIN pg_attrdef d ON c.oid = d.adrelid AND a.attnum = d.adnum
WHERE c.relname = ".q($R)."
AND n.nspname = current_schema()
AND NOT a.attisdropped
AND a.attnum > 0
ORDER BY a.attnum")as$K){preg_match('~([^([]+)(\((.*)\))?([a-z ]+)?((\[[0-9]*])*)$~',$K["full_type"],$_);list(,$U,$Fd,$K["length"],$sa,$za)=$_;$K["length"].=$za;$Wa=$U.$sa;if(isset($xa[$Wa])){$K["type"]=$xa[$Wa];$K["full_type"]=$K["type"].$Fd.$za;}else{$K["type"]=$U;$K["full_type"]=$K["type"].$Fd.$sa.$za;}if($K['identity'])$K['default']='GENERATED BY DEFAULT AS IDENTITY';$K["null"]=!$K["attnotnull"];$K["auto_increment"]=$K['identity']||preg_match('~^nextval\(~i',$K["default"]);$K["privileges"]=array("insert"=>1,"select"=>1,"update"=>1);if(preg_match('~(.+)::[^)]+(.*)~',$K["default"],$_))$K["default"]=($_[1]=="NULL"?null:(($_[1][0]=="'"?idf_unescape($_[1]):$_[1]).$_[2]));$J[$K["field"]]=$K;}return$J;}function
indexes($R,$i=null){global$h;if(!is_object($i))$i=$h;$J=array();$dg=$i->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($R));$f=get_key_vals("SELECT attnum, attname FROM pg_attribute WHERE attrelid = $dg AND attnum > 0",$i);foreach(get_rows("SELECT relname, indisunique::int, indisprimary::int, indkey, indoption , (indpred IS NOT NULL)::int as indispartial FROM pg_index i, pg_class ci WHERE i.indrelid = $dg AND ci.oid = i.indexrelid",$i)as$K){$ff=$K["relname"];$J[$ff]["type"]=($K["indispartial"]?"INDEX":($K["indisprimary"]?"PRIMARY":($K["indisunique"]?"UNIQUE":"INDEX")));$J[$ff]["columns"]=array();foreach(explode(" ",$K["indkey"])as$gd)$J[$ff]["columns"][]=$f[$gd];$J[$ff]["descs"]=array();foreach(explode(" ",$K["indoption"])as$hd)$J[$ff]["descs"][]=($hd&1?'1':null);$J[$ff]["lengths"]=array();}return$J;}function
foreign_keys($R){global$oe;$J=array();foreach(get_rows("SELECT conname, condeferrable::int AS deferrable, pg_get_constraintdef(oid) AS definition
FROM pg_constraint
WHERE conrelid = (SELECT pc.oid FROM pg_class AS pc INNER JOIN pg_namespace AS pn ON (pn.oid = pc.relnamespace) WHERE pc.relname = ".q($R)." AND pn.nspname = current_schema())
AND contype = 'f'::char
ORDER BY conkey, conname")as$K){if(preg_match('~FOREIGN KEY\s*\((.+)\)\s*REFERENCES (.+)\((.+)\)(.*)$~iA',$K['definition'],$_)){$K['source']=array_map('trim',explode(',',$_[1]));if(preg_match('~^(("([^"]|"")+"|[^"]+)\.)?"?("([^"]|"")+"|[^"]+)$~',$_[2],$Pd)){$K['ns']=str_replace('""','"',preg_replace('~^"(.+)"$~','\1',$Pd[2]));$K['table']=str_replace('""','"',preg_replace('~^"(.+)"$~','\1',$Pd[4]));}$K['target']=array_map('trim',explode(',',$_[3]));$K['on_delete']=(preg_match("~ON DELETE ($oe)~",$_[4],$Pd)?$Pd[1]:'NO ACTION');$K['on_update']=(preg_match("~ON UPDATE ($oe)~",$_[4],$Pd)?$Pd[1]:'NO ACTION');$J[$K['conname']]=$K;}}return$J;}function
view($A){global$h;return
array("select"=>trim($h->result("SELECT pg_get_viewdef(".$h->result("SELECT oid FROM pg_class WHERE relname = ".q($A)).")")));}function
collations(){return
array();}function
information_schema($m){return($m=="information_schema");}function
error(){global$h;$J=h($h->error);if(preg_match('~^(.*\n)?([^\n]*)\n( *)\^(\n.*)?$~s',$J,$_))$J=$_[1].preg_replace('~((?:[^&]|&[^;]*;){'.strlen($_[3]).'})(.*)~','\1<b>\2</b>',$_[2]).$_[4];return
nl_br($J);}function
create_database($m,$d){return
queries("CREATE DATABASE ".idf_escape($m).($d?" ENCODING ".idf_escape($d):""));}function
drop_databases($l){global$h;$h->close();return
apply_queries("DROP DATABASE",$l,'idf_escape');}function
rename_database($A,$d){return
queries("ALTER DATABASE ".idf_escape(DB)." RENAME TO ".idf_escape($A));}function
auto_increment(){return"";}function
alter_table($R,$A,$q,$yc,$jb,$Vb,$d,$Ga,$Ee){$c=array();$Xe=array();if($R!=""&&$R!=$A)$Xe[]="ALTER TABLE ".table($R)." RENAME TO ".table($A);foreach($q
as$p){$e=idf_escape($p[0]);$X=$p[1];if(!$X)$c[]="DROP $e";else{$Ug=$X[5];unset($X[5]);if(isset($X[6])&&$p[0]=="")$X[1]=($X[1]=="bigint"?" big":" ")."serial";if($p[0]=="")$c[]=($R!=""?"ADD ":"  ").implode($X);else{if($e!=$X[0])$Xe[]="ALTER TABLE ".table($A)." RENAME $e TO $X[0]";$c[]="ALTER $e TYPE$X[1]";if(!$X[6]){$c[]="ALTER $e ".($X[3]?"SET$X[3]":"DROP DEFAULT");$c[]="ALTER $e ".($X[2]==" NULL"?"DROP NOT":"SET").$X[2];}}if($p[0]!=""||$Ug!="")$Xe[]="COMMENT ON COLUMN ".table($A).".$X[0] IS ".($Ug!=""?substr($Ug,9):"''");}}$c=array_merge($c,$yc);if($R=="")array_unshift($Xe,"CREATE TABLE ".table($A)." (\n".implode(",\n",$c)."\n)");elseif($c)array_unshift($Xe,"ALTER TABLE ".table($R)."\n".implode(",\n",$c));if($R!=""||$jb!="")$Xe[]="COMMENT ON TABLE ".table($A)." IS ".q($jb);if($Ga!=""){}foreach($Xe
as$G){if(!queries($G))return
false;}return
true;}function
alter_indexes($R,$c){$sb=array();$Kb=array();$Xe=array();foreach($c
as$X){if($X[0]!="INDEX")$sb[]=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");elseif($X[2]=="DROP")$Kb[]=idf_escape($X[1]);else$Xe[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($R."_"))." ON ".table($R)." (".implode(", ",$X[2]).")";}if($sb)array_unshift($Xe,"ALTER TABLE ".table($R).implode(",",$sb));if($Kb)array_unshift($Xe,"DROP INDEX ".implode(", ",$Kb));foreach($Xe
as$G){if(!queries($G))return
false;}return
true;}function
truncate_tables($T){return
queries("TRUNCATE ".implode(", ",array_map('table',$T)));return
true;}function
drop_views($Zg){return
drop_tables($Zg);}function
drop_tables($T){foreach($T
as$R){$Tf=table_status($R);if(!queries("DROP ".strtoupper($Tf["Engine"])." ".table($R)))return
false;}return
true;}function
move_tables($T,$Zg,$fg){foreach(array_merge($T,$Zg)as$R){$Tf=table_status($R);if(!queries("ALTER ".strtoupper($Tf["Engine"])." ".table($R)." SET SCHEMA ".idf_escape($fg)))return
false;}return
true;}function
trigger($A,$R=null){if($A=="")return
array("Statement"=>"EXECUTE PROCEDURE ()");if($R===null)$R=$_GET['trigger'];$L=get_rows('SELECT t.trigger_name AS "Trigger", t.action_timing AS "Timing", (SELECT STRING_AGG(event_manipulation, \' OR \') FROM information_schema.triggers WHERE event_object_table = t.event_object_table AND trigger_name = t.trigger_name ) AS "Events", t.event_manipulation AS "Event", \'FOR EACH \' || t.action_orientation AS "Type", t.action_statement AS "Statement" FROM information_schema.triggers t WHERE t.event_object_table = '.q($R).' AND t.trigger_name = '.q($A));return
reset($L);}function
triggers($R){$J=array();foreach(get_rows("SELECT * FROM information_schema.triggers WHERE event_object_table = ".q($R))as$K)$J[$K["trigger_name"]]=array($K["action_timing"],$K["event_manipulation"]);return$J;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW","FOR EACH STATEMENT"),);}function
routine($A,$U){$L=get_rows('SELECT routine_definition AS definition, LOWER(external_language) AS language, *
FROM information_schema.routines
WHERE routine_schema = current_schema() AND specific_name = '.q($A));$J=$L[0];$J["returns"]=array("type"=>$J["type_udt_name"]);$J["fields"]=get_rows('SELECT parameter_name AS field, data_type AS type, character_maximum_length AS length, parameter_mode AS inout
FROM information_schema.parameters
WHERE specific_schema = current_schema() AND specific_name = '.q($A).'
ORDER BY ordinal_position');return$J;}function
routines(){return
get_rows('SELECT specific_name AS "SPECIFIC_NAME", routine_type AS "ROUTINE_TYPE", routine_name AS "ROUTINE_NAME", type_udt_name AS "DTD_IDENTIFIER"
FROM information_schema.routines
WHERE routine_schema = current_schema()
ORDER BY SPECIFIC_NAME');}function
routine_languages(){return
get_vals("SELECT LOWER(lanname) FROM pg_catalog.pg_language");}function
routine_id($A,$K){$J=array();foreach($K["fields"]as$p)$J[]=$p["type"];return
idf_escape($A)."(".implode(", ",$J).")";}function
last_id(){return
0;}function
explain($h,$G){return$h->query("EXPLAIN $G");}function
found_rows($S,$Z){global$h;if(preg_match("~ rows=([0-9]+)~",$h->result("EXPLAIN SELECT * FROM ".idf_escape($S["Name"]).($Z?" WHERE ".implode(" AND ",$Z):"")),$ef))return$ef[1];return
false;}function
types(){return
get_vals("SELECT typname
FROM pg_type
WHERE typnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema())
AND typtype IN ('b','d','e')
AND typelem = 0");}function
schemas(){return
get_vals("SELECT nspname FROM pg_namespace ORDER BY nspname");}function
get_schema(){global$h;return$h->result("SELECT current_schema()");}function
set_schema($sf,$i=null){global$h,$Fg,$Vf;if(!$i)$i=$h;$J=$i->query("SET search_path TO ".idf_escape($sf));foreach(types()as$U){if(!isset($Fg[$U])){$Fg[$U]=0;$Vf[lang(26)][]=$U;}}return$J;}function
create_sql($R,$Ga,$Wf){global$h;$J='';$of=array();$Bf=array();$Tf=table_status($R);if(is_view($Tf)){$Yg=view($R);return
rtrim("CREATE VIEW ".idf_escape($R)." AS $Yg[select]",";");}$q=fields($R);$v=indexes($R);ksort($v);$vc=foreign_keys($R);ksort($vc);if(!$Tf||empty($q))return
false;$J="CREATE TABLE ".idf_escape($Tf['nspname']).".".idf_escape($Tf['Name'])." (\n    ";foreach($q
as$mc=>$p){$De=idf_escape($p['field']).' '.$p['full_type'].default_value($p).($p['attnotnull']?" NOT NULL":"");$of[]=$De;if(preg_match('~nextval\(\'([^\']+)\'\)~',$p['default'],$Qd)){$Af=$Qd[1];$Nf=reset(get_rows(min_version(10)?"SELECT *, cache_size AS cache_value FROM pg_sequences WHERE schemaname = current_schema() AND sequencename = ".q($Af):"SELECT * FROM $Af"));$Bf[]=($Wf=="DROP+CREATE"?"DROP SEQUENCE IF EXISTS $Af;\n":"")."CREATE SEQUENCE $Af INCREMENT $Nf[increment_by] MINVALUE $Nf[min_value] MAXVALUE $Nf[max_value] START ".($Ga?$Nf['last_value']:1)." CACHE $Nf[cache_value];";}}if(!empty($Bf))$J=implode("\n\n",$Bf)."\n\n$J";foreach($v
as$bd=>$u){switch($u['type']){case'UNIQUE':$of[]="CONSTRAINT ".idf_escape($bd)." UNIQUE (".implode(', ',array_map('idf_escape',$u['columns'])).")";break;case'PRIMARY':$of[]="CONSTRAINT ".idf_escape($bd)." PRIMARY KEY (".implode(', ',array_map('idf_escape',$u['columns'])).")";break;}}foreach($vc
as$uc=>$tc)$of[]="CONSTRAINT ".idf_escape($uc)." $tc[definition] ".($tc['deferrable']?'DEFERRABLE':'NOT DEFERRABLE');$J.=implode(",\n    ",$of)."\n) WITH (oids = ".($Tf['Oid']?'true':'false').");";foreach($v
as$bd=>$u){if($u['type']=='INDEX'){$f=array();foreach($u['columns']as$x=>$X)$f[]=idf_escape($X).($u['descs'][$x]?" DESC":"");$J.="\n\nCREATE INDEX ".idf_escape($bd)." ON ".idf_escape($Tf['nspname']).".".idf_escape($Tf['Name'])." USING btree (".implode(', ',$f).");";}}if($Tf['Comment'])$J.="\n\nCOMMENT ON TABLE ".idf_escape($Tf['nspname']).".".idf_escape($Tf['Name'])." IS ".q($Tf['Comment']).";";foreach($q
as$mc=>$p){if($p['comment'])$J.="\n\nCOMMENT ON COLUMN ".idf_escape($Tf['nspname']).".".idf_escape($Tf['Name']).".".idf_escape($mc)." IS ".q($p['comment']).";";}return
rtrim($J,';');}function
truncate_sql($R){return"TRUNCATE ".table($R);}function
trigger_sql($R){$Tf=table_status($R);$J="";foreach(triggers($R)as$_g=>$zg){$Ag=trigger($_g,$Tf['Name']);$J.="\nCREATE TRIGGER ".idf_escape($Ag['Trigger'])." $Ag[Timing] $Ag[Events] ON ".idf_escape($Tf["nspname"]).".".idf_escape($Tf['Name'])." $Ag[Type] $Ag[Statement];;\n";}return$J;}function
use_sql($k){return"\connect ".idf_escape($k);}function
show_variables(){return
get_key_vals("SHOW ALL");}function
process_list(){return
get_rows("SELECT * FROM pg_stat_activity ORDER BY ".(min_version(9.2)?"pid":"procpid"));}function
show_status(){}function
convert_field($p){}function
unconvert_field($p,$J){return$J;}function
support($lc){return
preg_match('~^(database|table|columns|sql|indexes|descidx|comment|view|'.(min_version(9.3)?'materializedview|':'').'scheme|routine|processlist|sequence|trigger|type|variables|drop_col|kill|dump)$~',$lc);}function
kill_process($X){return
queries("SELECT pg_terminate_backend(".number($X).")");}function
connection_id(){return"SELECT pg_backend_pid()";}function
max_connections(){global$h;return$h->result("SHOW max_connections");}$w="pgsql";$Fg=array();$Vf=array();foreach(array(lang(27)=>array("smallint"=>5,"integer"=>10,"bigint"=>19,"boolean"=>1,"numeric"=>0,"real"=>7,"double precision"=>16,"money"=>20),lang(28)=>array("date"=>13,"time"=>17,"timestamp"=>20,"timestamptz"=>21,"interval"=>0),lang(25)=>array("character"=>0,"character varying"=>0,"text"=>0,"tsquery"=>0,"tsvector"=>0,"uuid"=>0,"xml"=>0),lang(29)=>array("bit"=>0,"bit varying"=>0,"bytea"=>0),lang(30)=>array("cidr"=>43,"inet"=>43,"macaddr"=>17,"txid_snapshot"=>0),lang(31)=>array("box"=>0,"circle"=>0,"line"=>0,"lseg"=>0,"path"=>0,"point"=>0,"polygon"=>0),)as$x=>$X){$Fg+=$X;$Vf[$x]=array_keys($X);}$Mg=array();$te=array("=","<",">","<=",">=","!=","~","!~","LIKE","LIKE %%","ILIKE","ILIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL");$Hc=array("char_length","lower","round","to_hex","to_timestamp","upper");$Lc=array("avg","count","count distinct","max","min","sum");$Ob=array(array("char"=>"md5","date|time"=>"now",),array(number_type()=>"+/-","date|time"=>"+ interval/- interval","char|text"=>"||",));}$Jb["oracle"]="Oracle (beta)";if(isset($_GET["oracle"])){$Ne=array("OCI8","PDO_OCI");define("DRIVER","oracle");if(extension_loaded("oci8")){class
Min_DB{var$extension="oci8",$_link,$_result,$server_info,$affected_rows,$errno,$error;function
_error($Yb,$o){if(ini_bool("html_errors"))$o=html_entity_decode(strip_tags($o));$o=preg_replace('~^[^:]*: ~','',$o);$this->error=$o;}function
connect($O,$V,$F){$this->_link=@oci_new_connect($V,$F,$O,"AL32UTF8");if($this->_link){$this->server_info=oci_server_version($this->_link);return
true;}$o=oci_error();$this->error=$o["message"];return
false;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}function
select_db($k){return
true;}function
query($G,$Gg=false){$I=oci_parse($this->_link,$G);$this->error="";if(!$I){$o=oci_error($this->_link);$this->errno=$o["code"];$this->error=$o["message"];return
false;}set_error_handler(array($this,'_error'));$J=@oci_execute($I);restore_error_handler();if($J){if(oci_num_fields($I))return
new
Min_Result($I);$this->affected_rows=oci_num_rows($I);}return$J;}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$p=1){$I=$this->query($G);if(!is_object($I)||!oci_fetch($I->_result))return
false;return
oci_result($I->_result,$p);}}class
Min_Result{var$_result,$_offset=1,$num_rows;function
__construct($I){$this->_result=$I;}function
_convert($K){foreach((array)$K
as$x=>$X){if(is_a($X,'OCI-Lob'))$K[$x]=$X->load();}return$K;}function
fetch_assoc(){return$this->_convert(oci_fetch_assoc($this->_result));}function
fetch_row(){return$this->_convert(oci_fetch_row($this->_result));}function
fetch_field(){$e=$this->_offset++;$J=new
stdClass;$J->name=oci_field_name($this->_result,$e);$J->orgname=$J->name;$J->type=oci_field_type($this->_result,$e);$J->charsetnr=(preg_match("~raw|blob|bfile~",$J->type)?63:0);return$J;}function
__destruct(){oci_free_statement($this->_result);}}}elseif(extension_loaded("pdo_oci")){class
Min_DB
extends
Min_PDO{var$extension="PDO_OCI";function
connect($O,$V,$F){$this->dsn("oci:dbname=//$O;charset=AL32UTF8",$V,$F);return
true;}function
select_db($k){return
true;}}}class
Min_Driver
extends
Min_SQL{function
begin(){return
true;}}function
idf_escape($t){return'"'.str_replace('"','""',$t).'"';}function
table($t){return
idf_escape($t);}function
connect(){global$b;$h=new
Min_DB;$j=$b->credentials();if($h->connect($j[0],$j[1],$j[2]))return$h;return$h->error;}function
get_databases(){return
get_vals("SELECT tablespace_name FROM user_tablespaces");}function
limit($G,$Z,$y,$me=0,$N=" "){return($me?" * FROM (SELECT t.*, rownum AS rnum FROM (SELECT $G$Z) t WHERE rownum <= ".($y+$me).") WHERE rnum > $me":($y!==null?" * FROM (SELECT $G$Z) WHERE rownum <= ".($y+$me):" $G$Z"));}function
limit1($R,$G,$Z,$N="\n"){return" $G$Z";}function
db_collation($m,$fb){global$h;return$h->result("SELECT value FROM nls_database_parameters WHERE parameter = 'NLS_CHARACTERSET'");}function
engines(){return
array();}function
logged_user(){global$h;return$h->result("SELECT USER FROM DUAL");}function
tables_list(){return
get_key_vals("SELECT table_name, 'table' FROM all_tables WHERE tablespace_name = ".q(DB)."
UNION SELECT view_name, 'view' FROM user_views
ORDER BY 1");}function
count_tables($l){return
array();}function
table_status($A=""){$J=array();$uf=q($A);foreach(get_rows('SELECT table_name "Name", \'table\' "Engine", avg_row_len * num_rows "Data_length", num_rows "Rows" FROM all_tables WHERE tablespace_name = '.q(DB).($A!=""?" AND table_name = $uf":"")."
UNION SELECT view_name, 'view', 0, 0 FROM user_views".($A!=""?" WHERE view_name = $uf":"")."
ORDER BY 1")as$K){if($A!="")return$K;$J[$K["Name"]]=$K;}return$J;}function
is_view($S){return$S["Engine"]=="view";}function
fk_support($S){return
true;}function
fields($R){$J=array();foreach(get_rows("SELECT * FROM all_tab_columns WHERE table_name = ".q($R)." ORDER BY column_id")as$K){$U=$K["DATA_TYPE"];$Fd="$K[DATA_PRECISION],$K[DATA_SCALE]";if($Fd==",")$Fd=$K["DATA_LENGTH"];$J[$K["COLUMN_NAME"]]=array("field"=>$K["COLUMN_NAME"],"full_type"=>$U.($Fd?"($Fd)":""),"type"=>strtolower($U),"length"=>$Fd,"default"=>$K["DATA_DEFAULT"],"null"=>($K["NULLABLE"]=="Y"),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);}return$J;}function
indexes($R,$i=null){$J=array();foreach(get_rows("SELECT uic.*, uc.constraint_type
FROM user_ind_columns uic
LEFT JOIN user_constraints uc ON uic.index_name = uc.constraint_name AND uic.table_name = uc.table_name
WHERE uic.table_name = ".q($R)."
ORDER BY uc.constraint_type, uic.column_position",$i)as$K){$bd=$K["INDEX_NAME"];$J[$bd]["type"]=($K["CONSTRAINT_TYPE"]=="P"?"PRIMARY":($K["CONSTRAINT_TYPE"]=="U"?"UNIQUE":"INDEX"));$J[$bd]["columns"][]=$K["COLUMN_NAME"];$J[$bd]["lengths"][]=($K["CHAR_LENGTH"]&&$K["CHAR_LENGTH"]!=$K["COLUMN_LENGTH"]?$K["CHAR_LENGTH"]:null);$J[$bd]["descs"][]=($K["DESCEND"]?'1':null);}return$J;}function
view($A){$L=get_rows('SELECT text "select" FROM user_views WHERE view_name = '.q($A));return
reset($L);}function
collations(){return
array();}function
information_schema($m){return
false;}function
error(){global$h;return
h($h->error);}function
explain($h,$G){$h->query("EXPLAIN PLAN FOR $G");return$h->query("SELECT * FROM plan_table");}function
found_rows($S,$Z){}function
alter_table($R,$A,$q,$yc,$jb,$Vb,$d,$Ga,$Ee){$c=$Kb=array();foreach($q
as$p){$X=$p[1];if($X&&$p[0]!=""&&idf_escape($p[0])!=$X[0])queries("ALTER TABLE ".table($R)." RENAME COLUMN ".idf_escape($p[0])." TO $X[0]");if($X)$c[]=($R!=""?($p[0]!=""?"MODIFY (":"ADD ("):"  ").implode($X).($R!=""?")":"");else$Kb[]=idf_escape($p[0]);}if($R=="")return
queries("CREATE TABLE ".table($A)." (\n".implode(",\n",$c)."\n)");return(!$c||queries("ALTER TABLE ".table($R)."\n".implode("\n",$c)))&&(!$Kb||queries("ALTER TABLE ".table($R)." DROP (".implode(", ",$Kb).")"))&&($R==$A||queries("ALTER TABLE ".table($R)." RENAME TO ".table($A)));}function
foreign_keys($R){$J=array();$G="SELECT c_list.CONSTRAINT_NAME as NAME,
c_src.COLUMN_NAME as SRC_COLUMN,
c_dest.OWNER as DEST_DB,
c_dest.TABLE_NAME as DEST_TABLE,
c_dest.COLUMN_NAME as DEST_COLUMN,
c_list.DELETE_RULE as ON_DELETE
FROM ALL_CONSTRAINTS c_list, ALL_CONS_COLUMNS c_src, ALL_CONS_COLUMNS c_dest
WHERE c_list.CONSTRAINT_NAME = c_src.CONSTRAINT_NAME
AND c_list.R_CONSTRAINT_NAME = c_dest.CONSTRAINT_NAME
AND c_list.CONSTRAINT_TYPE = 'R'
AND c_src.TABLE_NAME = ".q($R);foreach(get_rows($G)as$K)$J[$K['NAME']]=array("db"=>$K['DEST_DB'],"table"=>$K['DEST_TABLE'],"source"=>array($K['SRC_COLUMN']),"target"=>array($K['DEST_COLUMN']),"on_delete"=>$K['ON_DELETE'],"on_update"=>null,);return$J;}function
truncate_tables($T){return
apply_queries("TRUNCATE TABLE",$T);}function
drop_views($Zg){return
apply_queries("DROP VIEW",$Zg);}function
drop_tables($T){return
apply_queries("DROP TABLE",$T);}function
last_id(){return
0;}function
schemas(){return
get_vals("SELECT DISTINCT owner FROM dba_segments WHERE owner IN (SELECT username FROM dba_users WHERE default_tablespace NOT IN ('SYSTEM','SYSAUX'))");}function
get_schema(){global$h;return$h->result("SELECT sys_context('USERENV', 'SESSION_USER') FROM dual");}function
set_schema($tf,$i=null){global$h;if(!$i)$i=$h;return$i->query("ALTER SESSION SET CURRENT_SCHEMA = ".idf_escape($tf));}function
show_variables(){return
get_key_vals('SELECT name, display_value FROM v$parameter');}function
process_list(){return
get_rows('SELECT sess.process AS "process", sess.username AS "user", sess.schemaname AS "schema", sess.status AS "status", sess.wait_class AS "wait_class", sess.seconds_in_wait AS "seconds_in_wait", sql.sql_text AS "sql_text", sess.machine AS "machine", sess.port AS "port"
FROM v$session sess LEFT OUTER JOIN v$sql sql
ON sql.sql_id = sess.sql_id
WHERE sess.type = \'USER\'
ORDER BY PROCESS
');}function
show_status(){$L=get_rows('SELECT * FROM v$instance');return
reset($L);}function
convert_field($p){}function
unconvert_field($p,$J){return$J;}function
support($lc){return
preg_match('~^(columns|database|drop_col|indexes|descidx|processlist|scheme|sql|status|table|variables|view|view_trigger)$~',$lc);}$w="oracle";$Fg=array();$Vf=array();foreach(array(lang(27)=>array("number"=>38,"binary_float"=>12,"binary_double"=>21),lang(28)=>array("date"=>10,"timestamp"=>29,"interval year"=>12,"interval day"=>28),lang(25)=>array("char"=>2000,"varchar2"=>4000,"nchar"=>2000,"nvarchar2"=>4000,"clob"=>4294967295,"nclob"=>4294967295),lang(29)=>array("raw"=>2000,"long raw"=>2147483648,"blob"=>4294967295,"bfile"=>4294967296),)as$x=>$X){$Fg+=$X;$Vf[$x]=array_keys($X);}$Mg=array();$te=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL");$Hc=array("length","lower","round","upper");$Lc=array("avg","count","count distinct","max","min","sum");$Ob=array(array("date"=>"current_date","timestamp"=>"current_timestamp",),array("number|float|double"=>"+/-","date|timestamp"=>"+ interval/- interval","char|clob"=>"||",));}$Jb["mssql"]="MS SQL (beta)";if(isset($_GET["mssql"])){$Ne=array("SQLSRV","MSSQL","PDO_DBLIB");define("DRIVER","mssql");if(extension_loaded("sqlsrv")){class
Min_DB{var$extension="sqlsrv",$_link,$_result,$server_info,$affected_rows,$errno,$error;function
_get_error(){$this->error="";foreach(sqlsrv_errors()as$o){$this->errno=$o["code"];$this->error.="$o[message]\n";}$this->error=rtrim($this->error);}function
connect($O,$V,$F){global$b;$m=$b->database();$nb=array("UID"=>$V,"PWD"=>$F,"CharacterSet"=>"UTF-8");if($m!="")$nb["Database"]=$m;$this->_link=@sqlsrv_connect(preg_replace('~:~',',',$O),$nb);if($this->_link){$id=sqlsrv_server_info($this->_link);$this->server_info=$id['SQLServerVersion'];}else$this->_get_error();return(bool)$this->_link;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}function
select_db($k){return$this->query("USE ".idf_escape($k));}function
query($G,$Gg=false){$I=sqlsrv_query($this->_link,$G);$this->error="";if(!$I){$this->_get_error();return
false;}return$this->store_result($I);}function
multi_query($G){$this->_result=sqlsrv_query($this->_link,$G);$this->error="";if(!$this->_result){$this->_get_error();return
false;}return
true;}function
store_result($I=null){if(!$I)$I=$this->_result;if(!$I)return
false;if(sqlsrv_field_metadata($I))return
new
Min_Result($I);$this->affected_rows=sqlsrv_rows_affected($I);return
true;}function
next_result(){return$this->_result?sqlsrv_next_result($this->_result):null;}function
result($G,$p=0){$I=$this->query($G);if(!is_object($I))return
false;$K=$I->fetch_row();return$K[$p];}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($I){$this->_result=$I;}function
_convert($K){foreach((array)$K
as$x=>$X){if(is_a($X,'DateTime'))$K[$x]=$X->format("Y-m-d H:i:s");}return$K;}function
fetch_assoc(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_ASSOC));}function
fetch_row(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_NUMERIC));}function
fetch_field(){if(!$this->_fields)$this->_fields=sqlsrv_field_metadata($this->_result);$p=$this->_fields[$this->_offset++];$J=new
stdClass;$J->name=$p["Name"];$J->orgname=$p["Name"];$J->type=($p["Type"]==1?254:0);return$J;}function
seek($me){for($r=0;$r<$me;$r++)sqlsrv_fetch($this->_result);}function
__destruct(){sqlsrv_free_stmt($this->_result);}}}elseif(extension_loaded("mssql")){class
Min_DB{var$extension="MSSQL",$_link,$_result,$server_info,$affected_rows,$error;function
connect($O,$V,$F){$this->_link=@mssql_connect($O,$V,$F);if($this->_link){$I=$this->query("SELECT SERVERPROPERTY('ProductLevel'), SERVERPROPERTY('Edition')");if($I){$K=$I->fetch_row();$this->server_info=$this->result("sp_server_info 2",2)." [$K[0]] $K[1]";}}else$this->error=mssql_get_last_message();return(bool)$this->_link;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}function
select_db($k){return
mssql_select_db($k);}function
query($G,$Gg=false){$I=@mssql_query($G,$this->_link);$this->error="";if(!$I){$this->error=mssql_get_last_message();return
false;}if($I===true){$this->affected_rows=mssql_rows_affected($this->_link);return
true;}return
new
Min_Result($I);}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
mssql_next_result($this->_result->_result);}function
result($G,$p=0){$I=$this->query($G);if(!is_object($I))return
false;return
mssql_result($I->_result,0,$p);}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($I){$this->_result=$I;$this->num_rows=mssql_num_rows($I);}function
fetch_assoc(){return
mssql_fetch_assoc($this->_result);}function
fetch_row(){return
mssql_fetch_row($this->_result);}function
num_rows(){return
mssql_num_rows($this->_result);}function
fetch_field(){$J=mssql_fetch_field($this->_result);$J->orgtable=$J->table;$J->orgname=$J->name;return$J;}function
seek($me){mssql_data_seek($this->_result,$me);}function
__destruct(){mssql_free_result($this->_result);}}}elseif(extension_loaded("pdo_dblib")){class
Min_DB
extends
Min_PDO{var$extension="PDO_DBLIB";function
connect($O,$V,$F){$this->dsn("dblib:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$O)),$V,$F);return
true;}function
select_db($k){return$this->query("USE ".idf_escape($k));}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($R,$L,$Pe){foreach($L
as$P){$Ng=array();$Z=array();foreach($P
as$x=>$X){$Ng[]="$x = $X";if(isset($Pe[idf_unescape($x)]))$Z[]="$x = $X";}if(!queries("MERGE ".table($R)." USING (VALUES(".implode(", ",$P).")) AS source (c".implode(", c",range(1,count($P))).") ON ".implode(" AND ",$Z)." WHEN MATCHED THEN UPDATE SET ".implode(", ",$Ng)." WHEN NOT MATCHED THEN INSERT (".implode(", ",array_keys($P)).") VALUES (".implode(", ",$P).");"))return
false;}return
true;}function
begin(){return
queries("BEGIN TRANSACTION");}}function
idf_escape($t){return"[".str_replace("]","]]",$t)."]";}function
table($t){return($_GET["ns"]!=""?idf_escape($_GET["ns"]).".":"").idf_escape($t);}function
connect(){global$b;$h=new
Min_DB;$j=$b->credentials();if($h->connect($j[0],$j[1],$j[2]))return$h;return$h->error;}function
get_databases(){return
get_vals("SELECT name FROM sys.databases WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb')");}function
limit($G,$Z,$y,$me=0,$N=" "){return($y!==null?" TOP (".($y+$me).")":"")." $G$Z";}function
limit1($R,$G,$Z,$N="\n"){return
limit($G,$Z,1,0,$N);}function
db_collation($m,$fb){global$h;return$h->result("SELECT collation_name FROM sys.databases WHERE name = ".q($m));}function
engines(){return
array();}function
logged_user(){global$h;return$h->result("SELECT SUSER_NAME()");}function
tables_list(){return
get_key_vals("SELECT name, type_desc FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ORDER BY name");}function
count_tables($l){global$h;$J=array();foreach($l
as$m){$h->select_db($m);$J[$m]=$h->result("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES");}return$J;}function
table_status($A=""){$J=array();foreach(get_rows("SELECT ao.name AS Name, ao.type_desc AS Engine, (SELECT value FROM fn_listextendedproperty(default, 'SCHEMA', schema_name(schema_id), 'TABLE', ao.name, null, null)) AS Comment FROM sys.all_objects AS ao WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ".($A!=""?"AND name = ".q($A):"ORDER BY name"))as$K){if($A!="")return$K;$J[$K["Name"]]=$K;}return$J;}function
is_view($S){return$S["Engine"]=="VIEW";}function
fk_support($S){return
true;}function
fields($R){$kb=get_key_vals("SELECT objname, cast(value as varchar) FROM fn_listextendedproperty('MS_DESCRIPTION', 'schema', ".q(get_schema()).", 'table', ".q($R).", 'column', NULL)");$J=array();foreach(get_rows("SELECT c.max_length, c.precision, c.scale, c.name, c.is_nullable, c.is_identity, c.collation_name, t.name type, CAST(d.definition as text) [default]
FROM sys.all_columns c
JOIN sys.all_objects o ON c.object_id = o.object_id
JOIN sys.types t ON c.user_type_id = t.user_type_id
LEFT JOIN sys.default_constraints d ON c.default_object_id = d.parent_column_id
WHERE o.schema_id = SCHEMA_ID(".q(get_schema()).") AND o.type IN ('S', 'U', 'V') AND o.name = ".q($R))as$K){$U=$K["type"];$Fd=(preg_match("~char|binary~",$U)?$K["max_length"]:($U=="decimal"?"$K[precision],$K[scale]":""));$J[$K["name"]]=array("field"=>$K["name"],"full_type"=>$U.($Fd?"($Fd)":""),"type"=>$U,"length"=>$Fd,"default"=>$K["default"],"null"=>$K["is_nullable"],"auto_increment"=>$K["is_identity"],"collation"=>$K["collation_name"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"primary"=>$K["is_identity"],"comment"=>$kb[$K["name"]],);}return$J;}function
indexes($R,$i=null){$J=array();foreach(get_rows("SELECT i.name, key_ordinal, is_unique, is_primary_key, c.name AS column_name, is_descending_key
FROM sys.indexes i
INNER JOIN sys.index_columns ic ON i.object_id = ic.object_id AND i.index_id = ic.index_id
INNER JOIN sys.columns c ON ic.object_id = c.object_id AND ic.column_id = c.column_id
WHERE OBJECT_NAME(i.object_id) = ".q($R),$i)as$K){$A=$K["name"];$J[$A]["type"]=($K["is_primary_key"]?"PRIMARY":($K["is_unique"]?"UNIQUE":"INDEX"));$J[$A]["lengths"]=array();$J[$A]["columns"][$K["key_ordinal"]]=$K["column_name"];$J[$A]["descs"][$K["key_ordinal"]]=($K["is_descending_key"]?'1':null);}return$J;}function
view($A){global$h;return
array("select"=>preg_replace('~^(?:[^[]|\[[^]]*])*\s+AS\s+~isU','',$h->result("SELECT VIEW_DEFINITION FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_SCHEMA = SCHEMA_NAME() AND TABLE_NAME = ".q($A))));}function
collations(){$J=array();foreach(get_vals("SELECT name FROM fn_helpcollations()")as$d)$J[preg_replace('~_.*~','',$d)][]=$d;return$J;}function
information_schema($m){return
false;}function
error(){global$h;return
nl_br(h(preg_replace('~^(\[[^]]*])+~m','',$h->error)));}function
create_database($m,$d){return
queries("CREATE DATABASE ".idf_escape($m).(preg_match('~^[a-z0-9_]+$~i',$d)?" COLLATE $d":""));}function
drop_databases($l){return
queries("DROP DATABASE ".implode(", ",array_map('idf_escape',$l)));}function
rename_database($A,$d){if(preg_match('~^[a-z0-9_]+$~i',$d))queries("ALTER DATABASE ".idf_escape(DB)." COLLATE $d");queries("ALTER DATABASE ".idf_escape(DB)." MODIFY NAME = ".idf_escape($A));return
true;}function
auto_increment(){return" IDENTITY".($_POST["Auto_increment"]!=""?"(".number($_POST["Auto_increment"]).",1)":"")." PRIMARY KEY";}function
alter_table($R,$A,$q,$yc,$jb,$Vb,$d,$Ga,$Ee){$c=array();$kb=array();foreach($q
as$p){$e=idf_escape($p[0]);$X=$p[1];if(!$X)$c["DROP"][]=" COLUMN $e";else{$X[1]=preg_replace("~( COLLATE )'(\\w+)'~",'\1\2',$X[1]);$kb[$p[0]]=$X[5];unset($X[5]);if($p[0]=="")$c["ADD"][]="\n  ".implode("",$X).($R==""?substr($yc[$X[0]],16+strlen($X[0])):"");else{unset($X[6]);if($e!=$X[0])queries("EXEC sp_rename ".q(table($R).".$e").", ".q(idf_unescape($X[0])).", 'COLUMN'");$c["ALTER COLUMN ".implode("",$X)][]="";}}}if($R=="")return
queries("CREATE TABLE ".table($A)." (".implode(",",(array)$c["ADD"])."\n)");if($R!=$A)queries("EXEC sp_rename ".q(table($R)).", ".q($A));if($yc)$c[""]=$yc;foreach($c
as$x=>$X){if(!queries("ALTER TABLE ".idf_escape($A)." $x".implode(",",$X)))return
false;}foreach($kb
as$x=>$X){$jb=substr($X,9);queries("EXEC sp_dropextendedproperty @name = N'MS_Description', @level0type = N'Schema', @level0name = ".q(get_schema()).", @level1type = N'Table',  @level1name = ".q($A).", @level2type = N'Column', @level2name = ".q($x));queries("EXEC sp_addextendedproperty @name = N'MS_Description', @value = ".$jb.", @level0type = N'Schema', @level0name = ".q(get_schema()).", @level1type = N'Table',  @level1name = ".q($A).", @level2type = N'Column', @level2name = ".q($x));}return
true;}function
alter_indexes($R,$c){$u=array();$Kb=array();foreach($c
as$X){if($X[2]=="DROP"){if($X[0]=="PRIMARY")$Kb[]=idf_escape($X[1]);else$u[]=idf_escape($X[1])." ON ".table($R);}elseif(!queries(($X[0]!="PRIMARY"?"CREATE $X[0] ".($X[0]!="INDEX"?"INDEX ":"").idf_escape($X[1]!=""?$X[1]:uniqid($R."_"))." ON ".table($R):"ALTER TABLE ".table($R)." ADD PRIMARY KEY")." (".implode(", ",$X[2]).")"))return
false;}return(!$u||queries("DROP INDEX ".implode(", ",$u)))&&(!$Kb||queries("ALTER TABLE ".table($R)." DROP ".implode(", ",$Kb)));}function
last_id(){global$h;return$h->result("SELECT SCOPE_IDENTITY()");}function
explain($h,$G){$h->query("SET SHOWPLAN_ALL ON");$J=$h->query($G);$h->query("SET SHOWPLAN_ALL OFF");return$J;}function
found_rows($S,$Z){}function
foreign_keys($R){$J=array();foreach(get_rows("EXEC sp_fkeys @fktable_name = ".q($R))as$K){$Ac=&$J[$K["FK_NAME"]];$Ac["db"]=$K["PKTABLE_QUALIFIER"];$Ac["table"]=$K["PKTABLE_NAME"];$Ac["source"][]=$K["FKCOLUMN_NAME"];$Ac["target"][]=$K["PKCOLUMN_NAME"];}return$J;}function
truncate_tables($T){return
apply_queries("TRUNCATE TABLE",$T);}function
drop_views($Zg){return
queries("DROP VIEW ".implode(", ",array_map('table',$Zg)));}function
drop_tables($T){return
queries("DROP TABLE ".implode(", ",array_map('table',$T)));}function
move_tables($T,$Zg,$fg){return
apply_queries("ALTER SCHEMA ".idf_escape($fg)." TRANSFER",array_merge($T,$Zg));}function
trigger($A){if($A=="")return
array();$L=get_rows("SELECT s.name [Trigger],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(s.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(s.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing],
c.text
FROM sysobjects s
JOIN syscomments c ON s.id = c.id
WHERE s.xtype = 'TR' AND s.name = ".q($A));$J=reset($L);if($J)$J["Statement"]=preg_replace('~^.+\s+AS\s+~isU','',$J["text"]);return$J;}function
triggers($R){$J=array();foreach(get_rows("SELECT sys1.name,
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing]
FROM sysobjects sys1
JOIN sysobjects sys2 ON sys1.parent_obj = sys2.id
WHERE sys1.xtype = 'TR' AND sys2.name = ".q($R))as$K)$J[$K["name"]]=array($K["Timing"],$K["Event"]);return$J;}function
trigger_options(){return
array("Timing"=>array("AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("AS"),);}function
schemas(){return
get_vals("SELECT name FROM sys.schemas");}function
get_schema(){global$h;if($_GET["ns"]!="")return$_GET["ns"];return$h->result("SELECT SCHEMA_NAME()");}function
set_schema($sf){return
true;}function
use_sql($k){return"USE ".idf_escape($k);}function
show_variables(){return
array();}function
show_status(){return
array();}function
convert_field($p){}function
unconvert_field($p,$J){return$J;}function
support($lc){return
preg_match('~^(comment|columns|database|drop_col|indexes|descidx|scheme|sql|table|trigger|view|view_trigger)$~',$lc);}$w="mssql";$Fg=array();$Vf=array();foreach(array(lang(27)=>array("tinyint"=>3,"smallint"=>5,"int"=>10,"bigint"=>20,"bit"=>1,"decimal"=>0,"real"=>12,"float"=>53,"smallmoney"=>10,"money"=>20),lang(28)=>array("date"=>10,"smalldatetime"=>19,"datetime"=>19,"datetime2"=>19,"time"=>8,"datetimeoffset"=>10),lang(25)=>array("char"=>8000,"varchar"=>8000,"text"=>2147483647,"nchar"=>4000,"nvarchar"=>4000,"ntext"=>1073741823),lang(29)=>array("binary"=>8000,"varbinary"=>8000,"image"=>2147483647),)as$x=>$X){$Fg+=$X;$Vf[$x]=array_keys($X);}$Mg=array();$te=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL");$Hc=array("len","lower","round","upper");$Lc=array("avg","count","count distinct","max","min","sum");$Ob=array(array("date|time"=>"getdate",),array("int|decimal|real|float|money|datetime"=>"+/-","char|text"=>"+",));}$Jb['firebird']='Firebird (alpha)';if(isset($_GET["firebird"])){$Ne=array("interbase");define("DRIVER","firebird");if(extension_loaded("interbase")){class
Min_DB{var$extension="Firebird",$server_info,$affected_rows,$errno,$error,$_link,$_result;function
connect($O,$V,$F){$this->_link=ibase_connect($O,$V,$F);if($this->_link){$Qg=explode(':',$O);$this->service_link=ibase_service_attach($Qg[0],$V,$F);$this->server_info=ibase_server_info($this->service_link,IBASE_SVC_SERVER_VERSION);}else{$this->errno=ibase_errcode();$this->error=ibase_errmsg();}return(bool)$this->_link;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}function
select_db($k){return($k=="domain");}function
query($G,$Gg=false){$I=ibase_query($G,$this->_link);if(!$I){$this->errno=ibase_errcode();$this->error=ibase_errmsg();return
false;}$this->error="";if($I===true){$this->affected_rows=ibase_affected_rows($this->_link);return
true;}return
new
Min_Result($I);}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$p=0){$I=$this->query($G);if(!$I||!$I->num_rows)return
false;$K=$I->fetch_row();return$K[$p];}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
__construct($I){$this->_result=$I;}function
fetch_assoc(){return
ibase_fetch_assoc($this->_result);}function
fetch_row(){return
ibase_fetch_row($this->_result);}function
fetch_field(){$p=ibase_field_info($this->_result,$this->_offset++);return(object)array('name'=>$p['name'],'orgname'=>$p['name'],'type'=>$p['type'],'charsetnr'=>$p['length'],);}function
__destruct(){ibase_free_result($this->_result);}}}class
Min_Driver
extends
Min_SQL{}function
idf_escape($t){return'"'.str_replace('"','""',$t).'"';}function
table($t){return
idf_escape($t);}function
connect(){global$b;$h=new
Min_DB;$j=$b->credentials();if($h->connect($j[0],$j[1],$j[2]))return$h;return$h->error;}function
get_databases($wc){return
array("domain");}function
limit($G,$Z,$y,$me=0,$N=" "){$J='';$J.=($y!==null?$N."FIRST $y".($me?" SKIP $me":""):"");$J.=" $G$Z";return$J;}function
limit1($R,$G,$Z,$N="\n"){return
limit($G,$Z,1,0,$N);}function
db_collation($m,$fb){}function
engines(){return
array();}function
logged_user(){global$b;$j=$b->credentials();return$j[1];}function
tables_list(){global$h;$G='SELECT RDB$RELATION_NAME FROM rdb$relations WHERE rdb$system_flag = 0';$I=ibase_query($h->_link,$G);$J=array();while($K=ibase_fetch_assoc($I))$J[$K['RDB$RELATION_NAME']]='table';ksort($J);return$J;}function
count_tables($l){return
array();}function
table_status($A="",$kc=false){global$h;$J=array();$xb=tables_list();foreach($xb
as$u=>$X){$u=trim($u);$J[$u]=array('Name'=>$u,'Engine'=>'standard',);if($A==$u)return$J[$u];}return$J;}function
is_view($S){return
false;}function
fk_support($S){return
preg_match('~InnoDB|IBMDB2I~i',$S["Engine"]);}function
fields($R){global$h;$J=array();$G='SELECT r.RDB$FIELD_NAME AS field_name,
r.RDB$DESCRIPTION AS field_description,
r.RDB$DEFAULT_VALUE AS field_default_value,
r.RDB$NULL_FLAG AS field_not_null_constraint,
f.RDB$FIELD_LENGTH AS field_length,
f.RDB$FIELD_PRECISION AS field_precision,
f.RDB$FIELD_SCALE AS field_scale,
CASE f.RDB$FIELD_TYPE
WHEN 261 THEN \'BLOB\'
WHEN 14 THEN \'CHAR\'
WHEN 40 THEN \'CSTRING\'
WHEN 11 THEN \'D_FLOAT\'
WHEN 27 THEN \'DOUBLE\'
WHEN 10 THEN \'FLOAT\'
WHEN 16 THEN \'INT64\'
WHEN 8 THEN \'INTEGER\'
WHEN 9 THEN \'QUAD\'
WHEN 7 THEN \'SMALLINT\'
WHEN 12 THEN \'DATE\'
WHEN 13 THEN \'TIME\'
WHEN 35 THEN \'TIMESTAMP\'
WHEN 37 THEN \'VARCHAR\'
ELSE \'UNKNOWN\'
END AS field_type,
f.RDB$FIELD_SUB_TYPE AS field_subtype,
coll.RDB$COLLATION_NAME AS field_collation,
cset.RDB$CHARACTER_SET_NAME AS field_charset
FROM RDB$RELATION_FIELDS r
LEFT JOIN RDB$FIELDS f ON r.RDB$FIELD_SOURCE = f.RDB$FIELD_NAME
LEFT JOIN RDB$COLLATIONS coll ON f.RDB$COLLATION_ID = coll.RDB$COLLATION_ID
LEFT JOIN RDB$CHARACTER_SETS cset ON f.RDB$CHARACTER_SET_ID = cset.RDB$CHARACTER_SET_ID
WHERE r.RDB$RELATION_NAME = '.q($R).'
ORDER BY r.RDB$FIELD_POSITION';$I=ibase_query($h->_link,$G);while($K=ibase_fetch_assoc($I))$J[trim($K['FIELD_NAME'])]=array("field"=>trim($K["FIELD_NAME"]),"full_type"=>trim($K["FIELD_TYPE"]),"type"=>trim($K["FIELD_SUB_TYPE"]),"default"=>trim($K['FIELD_DEFAULT_VALUE']),"null"=>(trim($K["FIELD_NOT_NULL_CONSTRAINT"])=="YES"),"auto_increment"=>'0',"collation"=>trim($K["FIELD_COLLATION"]),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"comment"=>trim($K["FIELD_DESCRIPTION"]),);return$J;}function
indexes($R,$i=null){$J=array();return$J;}function
foreign_keys($R){return
array();}function
collations(){return
array();}function
information_schema($m){return
false;}function
error(){global$h;return
h($h->error);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($sf){return
true;}function
support($lc){return
preg_match("~^(columns|sql|status|table)$~",$lc);}$w="firebird";$te=array("=");$Hc=array();$Lc=array();$Ob=array();}$Jb["simpledb"]="SimpleDB";if(isset($_GET["simpledb"])){$Ne=array("SimpleXML + allow_url_fopen");define("DRIVER","simpledb");if(class_exists('SimpleXMLElement')&&ini_bool('allow_url_fopen')){class
Min_DB{var$extension="SimpleXML",$server_info='2009-04-15',$error,$timeout,$next,$affected_rows,$_result;function
select_db($k){return($k=="domain");}function
query($G,$Gg=false){$E=array('SelectExpression'=>$G,'ConsistentRead'=>'true');if($this->next)$E['NextToken']=$this->next;$I=sdb_request_all('Select','Item',$E,$this->timeout);$this->timeout=0;if($I===false)return$I;if(preg_match('~^\s*SELECT\s+COUNT\(~i',$G)){$Zf=0;foreach($I
as$sd)$Zf+=$sd->Attribute->Value;$I=array((object)array('Attribute'=>array((object)array('Name'=>'Count','Value'=>$Zf,))));}return
new
Min_Result($I);}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0;function
__construct($I){foreach($I
as$sd){$K=array();if($sd->Name!='')$K['itemName()']=(string)$sd->Name;foreach($sd->Attribute
as$Ca){$A=$this->_processValue($Ca->Name);$Y=$this->_processValue($Ca->Value);if(isset($K[$A])){$K[$A]=(array)$K[$A];$K[$A][]=$Y;}else$K[$A]=$Y;}$this->_rows[]=$K;foreach($K
as$x=>$X){if(!isset($this->_rows[0][$x]))$this->_rows[0][$x]=null;}}$this->num_rows=count($this->_rows);}function
_processValue($Qb){return(is_object($Qb)&&$Qb['encoding']=='base64'?base64_decode($Qb):(string)$Qb);}function
fetch_assoc(){$K=current($this->_rows);if(!$K)return$K;$J=array();foreach($this->_rows[0]as$x=>$X)$J[$x]=$K[$x];next($this->_rows);return$J;}function
fetch_row(){$J=$this->fetch_assoc();if(!$J)return$J;return
array_values($J);}function
fetch_field(){$xd=array_keys($this->_rows[0]);return(object)array('name'=>$xd[$this->_offset++]);}}}class
Min_Driver
extends
Min_SQL{public$Pe="itemName()";function
_chunkRequest($Zc,$ra,$E,$dc=array()){global$h;foreach(array_chunk($Zc,25)as$Za){$Ce=$E;foreach($Za
as$r=>$s){$Ce["Item.$r.ItemName"]=$s;foreach($dc
as$x=>$X)$Ce["Item.$r.$x"]=$X;}if(!sdb_request($ra,$Ce))return
false;}$h->affected_rows=count($Zc);return
true;}function
_extractIds($R,$H,$y){$J=array();if(preg_match_all("~itemName\(\) = (('[^']*+')+)~",$H,$Qd))$J=array_map('idf_unescape',$Qd[1]);else{foreach(sdb_request_all('Select','Item',array('SelectExpression'=>'SELECT itemName() FROM '.table($R).$H.($y?" LIMIT 1":"")))as$sd)$J[]=$sd->Name;}return$J;}function
select($R,$M,$Z,$Ic,$C=array(),$y=1,$D=0,$Re=false){global$h;$h->next=$_GET["next"];$J=parent::select($R,$M,$Z,$Ic,$C,$y,$D,$Re);$h->next=0;return$J;}function
delete($R,$H,$y=0){return$this->_chunkRequest($this->_extractIds($R,$H,$y),'BatchDeleteAttributes',array('DomainName'=>$R));}function
update($R,$P,$H,$y=0,$N="\n"){$Bb=array();$md=array();$r=0;$Zc=$this->_extractIds($R,$H,$y);$s=idf_unescape($P["`itemName()`"]);unset($P["`itemName()`"]);foreach($P
as$x=>$X){$x=idf_unescape($x);if($X=="NULL"||($s!=""&&array($s)!=$Zc))$Bb["Attribute.".count($Bb).".Name"]=$x;if($X!="NULL"){foreach((array)$X
as$td=>$W){$md["Attribute.$r.Name"]=$x;$md["Attribute.$r.Value"]=(is_array($X)?$W:idf_unescape($W));if(!$td)$md["Attribute.$r.Replace"]="true";$r++;}}}$E=array('DomainName'=>$R);return(!$md||$this->_chunkRequest(($s!=""?array($s):$Zc),'BatchPutAttributes',$E,$md))&&(!$Bb||$this->_chunkRequest($Zc,'BatchDeleteAttributes',$E,$Bb));}function
insert($R,$P){$E=array("DomainName"=>$R);$r=0;foreach($P
as$A=>$Y){if($Y!="NULL"){$A=idf_unescape($A);if($A=="itemName()")$E["ItemName"]=idf_unescape($Y);else{foreach((array)$Y
as$X){$E["Attribute.$r.Name"]=$A;$E["Attribute.$r.Value"]=(is_array($Y)?$X:idf_unescape($Y));$r++;}}}}return
sdb_request('PutAttributes',$E);}function
insertUpdate($R,$L,$Pe){foreach($L
as$P){if(!$this->update($R,$P,"WHERE `itemName()` = ".q($P["`itemName()`"])))return
false;}return
true;}function
begin(){return
false;}function
commit(){return
false;}function
rollback(){return
false;}function
slowQuery($G,$mg){$this->_conn->timeout=$mg;return$G;}}function
connect(){global$b;list(,,$F)=$b->credentials();if($F!="")return
lang(22);return
new
Min_DB;}function
support($lc){return
preg_match('~sql~',$lc);}function
logged_user(){global$b;$j=$b->credentials();return$j[1];}function
get_databases(){return
array("domain");}function
collations(){return
array();}function
db_collation($m,$fb){}function
tables_list(){global$h;$J=array();foreach(sdb_request_all('ListDomains','DomainName')as$R)$J[(string)$R]='table';if($h->error&&defined("PAGE_HEADER"))echo"<p class='error'>".error()."\n";return$J;}function
table_status($A="",$kc=false){$J=array();foreach(($A!=""?array($A=>true):tables_list())as$R=>$U){$K=array("Name"=>$R,"Auto_increment"=>"");if(!$kc){$Yd=sdb_request('DomainMetadata',array('DomainName'=>$R));if($Yd){foreach(array("Rows"=>"ItemCount","Data_length"=>"ItemNamesSizeBytes","Index_length"=>"AttributeValuesSizeBytes","Data_free"=>"AttributeNamesSizeBytes",)as$x=>$X)$K[$x]=(string)$Yd->$X;}}if($A!="")return$K;$J[$R]=$K;}return$J;}function
explain($h,$G){}function
error(){global$h;return
h($h->error);}function
information_schema(){}function
is_view($S){}function
indexes($R,$i=null){return
array(array("type"=>"PRIMARY","columns"=>array("itemName()")),);}function
fields($R){return
fields_from_edit();}function
foreign_keys($R){return
array();}function
table($t){return
idf_escape($t);}function
idf_escape($t){return"`".str_replace("`","``",$t)."`";}function
limit($G,$Z,$y,$me=0,$N=" "){return" $G$Z".($y!==null?$N."LIMIT $y":"");}function
unconvert_field($p,$J){return$J;}function
fk_support($S){}function
engines(){return
array();}function
alter_table($R,$A,$q,$yc,$jb,$Vb,$d,$Ga,$Ee){return($R==""&&sdb_request('CreateDomain',array('DomainName'=>$A)));}function
drop_tables($T){foreach($T
as$R){if(!sdb_request('DeleteDomain',array('DomainName'=>$R)))return
false;}return
true;}function
count_tables($l){foreach($l
as$m)return
array($m=>count(tables_list()));}function
found_rows($S,$Z){return($Z?null:$S["Rows"]);}function
last_id(){}function
hmac($wa,$xb,$x,$bf=false){$Pa=64;if(strlen($x)>$Pa)$x=pack("H*",$wa($x));$x=str_pad($x,$Pa,"\0");$ud=$x^str_repeat("\x36",$Pa);$vd=$x^str_repeat("\x5C",$Pa);$J=$wa($vd.pack("H*",$wa($ud.$xb)));if($bf)$J=pack("H*",$J);return$J;}function
sdb_request($ra,$E=array()){global$b,$h;list($Vc,$E['AWSAccessKeyId'],$vf)=$b->credentials();$E['Action']=$ra;$E['Timestamp']=gmdate('Y-m-d\TH:i:s+00:00');$E['Version']='2009-04-15';$E['SignatureVersion']=2;$E['SignatureMethod']='HmacSHA1';ksort($E);$G='';foreach($E
as$x=>$X)$G.='&'.rawurlencode($x).'='.rawurlencode($X);$G=str_replace('%7E','~',substr($G,1));$G.="&Signature=".urlencode(base64_encode(hmac('sha1',"POST\n".preg_replace('~^https?://~','',$Vc)."\n/\n$G",$vf,true)));@ini_set('track_errors',1);$oc=@file_get_contents((preg_match('~^https?://~',$Vc)?$Vc:"http://$Vc"),false,stream_context_create(array('http'=>array('method'=>'POST','content'=>$G,'ignore_errors'=>1,))));if(!$oc){$h->error=$php_errormsg;return
false;}libxml_use_internal_errors(true);$kh=simplexml_load_string($oc);if(!$kh){$o=libxml_get_last_error();$h->error=$o->message;return
false;}if($kh->Errors){$o=$kh->Errors->Error;$h->error="$o->Message ($o->Code)";return
false;}$h->error='';$eg=$ra."Result";return($kh->$eg?$kh->$eg:true);}function
sdb_request_all($ra,$eg,$E=array(),$mg=0){$J=array();$Rf=($mg?microtime(true):0);$y=(preg_match('~LIMIT\s+(\d+)\s*$~i',$E['SelectExpression'],$_)?$_[1]:0);do{$kh=sdb_request($ra,$E);if(!$kh)break;foreach($kh->$eg
as$Qb)$J[]=$Qb;if($y&&count($J)>=$y){$_GET["next"]=$kh->NextToken;break;}if($mg&&microtime(true)-$Rf>$mg)return
false;$E['NextToken']=$kh->NextToken;if($y)$E['SelectExpression']=preg_replace('~\d+\s*$~',$y-count($J),$E['SelectExpression']);}while($kh->NextToken);return$J;}$w="simpledb";$te=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","IS NOT NULL");$Hc=array();$Lc=array("count");$Ob=array(array("json"));}$Jb["mongo"]="MongoDB";if(isset($_GET["mongo"])){$Ne=array("mongo","mongodb");define("DRIVER","mongo");if(class_exists('MongoDB')){class
Min_DB{var$extension="Mongo",$server_info=MongoClient::VERSION,$error,$last_id,$_link,$_db;function
connect($Og,$B){return@new
MongoClient($Og,$B);}function
query($G){return
false;}function
select_db($k){try{$this->_db=$this->_link->selectDB($k);return
true;}catch(Exception$ac){$this->error=$ac->getMessage();return
false;}}function
quote($Q){return$Q;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($I){foreach($I
as$sd){$K=array();foreach($sd
as$x=>$X){if(is_a($X,'MongoBinData'))$this->_charset[$x]=63;$K[$x]=(is_a($X,'MongoId')?'ObjectId("'.strval($X).'")':(is_a($X,'MongoDate')?gmdate("Y-m-d H:i:s",$X->sec)." GMT":(is_a($X,'MongoBinData')?$X->bin:(is_a($X,'MongoRegex')?strval($X):(is_object($X)?get_class($X):$X)))));}$this->_rows[]=$K;foreach($K
as$x=>$X){if(!isset($this->_rows[0][$x]))$this->_rows[0][$x]=null;}}$this->num_rows=count($this->_rows);}function
fetch_assoc(){$K=current($this->_rows);if(!$K)return$K;$J=array();foreach($this->_rows[0]as$x=>$X)$J[$x]=$K[$x];next($this->_rows);return$J;}function
fetch_row(){$J=$this->fetch_assoc();if(!$J)return$J;return
array_values($J);}function
fetch_field(){$xd=array_keys($this->_rows[0]);$A=$xd[$this->_offset++];return(object)array('name'=>$A,'charsetnr'=>$this->_charset[$A],);}}class
Min_Driver
extends
Min_SQL{public$Pe="_id";function
select($R,$M,$Z,$Ic,$C=array(),$y=1,$D=0,$Re=false){$M=($M==array("*")?array():array_fill_keys($M,true));$Kf=array();foreach($C
as$X){$X=preg_replace('~ DESC$~','',$X,1,$rb);$Kf[$X]=($rb?-1:1);}return
new
Min_Result($this->_conn->_db->selectCollection($R)->find(array(),$M)->sort($Kf)->limit($y!=""?+$y:0)->skip($D*$y));}function
insert($R,$P){try{$J=$this->_conn->_db->selectCollection($R)->insert($P);$this->_conn->errno=$J['code'];$this->_conn->error=$J['err'];$this->_conn->last_id=$P['_id'];return!$J['err'];}catch(Exception$ac){$this->_conn->error=$ac->getMessage();return
false;}}}function
get_databases($wc){global$h;$J=array();$zb=$h->_link->listDBs();foreach($zb['databases']as$m)$J[]=$m['name'];return$J;}function
count_tables($l){global$h;$J=array();foreach($l
as$m)$J[$m]=count($h->_link->selectDB($m)->getCollectionNames(true));return$J;}function
tables_list(){global$h;return
array_fill_keys($h->_db->getCollectionNames(true),'table');}function
drop_databases($l){global$h;foreach($l
as$m){$kf=$h->_link->selectDB($m)->drop();if(!$kf['ok'])return
false;}return
true;}function
indexes($R,$i=null){global$h;$J=array();foreach($h->_db->selectCollection($R)->getIndexInfo()as$u){$Eb=array();foreach($u["key"]as$e=>$U)$Eb[]=($U==-1?'1':null);$J[$u["name"]]=array("type"=>($u["name"]=="_id_"?"PRIMARY":($u["unique"]?"UNIQUE":"INDEX")),"columns"=>array_keys($u["key"]),"lengths"=>array(),"descs"=>$Eb,);}return$J;}function
fields($R){return
fields_from_edit();}function
found_rows($S,$Z){global$h;return$h->_db->selectCollection($_GET["select"])->count($Z);}$te=array("=");}elseif(class_exists('MongoDB\Driver\Manager')){class
Min_DB{var$extension="MongoDB",$server_info=MONGODB_VERSION,$error,$last_id;var$_link;var$_db,$_db_name;function
connect($Og,$B){$bb='MongoDB\Driver\Manager';return
new$bb($Og,$B);}function
query($G){return
false;}function
select_db($k){$this->_db_name=$k;return
true;}function
quote($Q){return$Q;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($I){foreach($I
as$sd){$K=array();foreach($sd
as$x=>$X){if(is_a($X,'MongoDB\BSON\Binary'))$this->_charset[$x]=63;$K[$x]=(is_a($X,'MongoDB\BSON\ObjectID')?'MongoDB\BSON\ObjectID("'.strval($X).'")':(is_a($X,'MongoDB\BSON\UTCDatetime')?$X->toDateTime()->format('Y-m-d H:i:s'):(is_a($X,'MongoDB\BSON\Binary')?$X->bin:(is_a($X,'MongoDB\BSON\Regex')?strval($X):(is_object($X)?json_encode($X,256):$X)))));}$this->_rows[]=$K;foreach($K
as$x=>$X){if(!isset($this->_rows[0][$x]))$this->_rows[0][$x]=null;}}$this->num_rows=$I->count;}function
fetch_assoc(){$K=current($this->_rows);if(!$K)return$K;$J=array();foreach($this->_rows[0]as$x=>$X)$J[$x]=$K[$x];next($this->_rows);return$J;}function
fetch_row(){$J=$this->fetch_assoc();if(!$J)return$J;return
array_values($J);}function
fetch_field(){$xd=array_keys($this->_rows[0]);$A=$xd[$this->_offset++];return(object)array('name'=>$A,'charsetnr'=>$this->_charset[$A],);}}class
Min_Driver
extends
Min_SQL{public$Pe="_id";function
select($R,$M,$Z,$Ic,$C=array(),$y=1,$D=0,$Re=false){global$h;$M=($M==array("*")?array():array_fill_keys($M,1));if(count($M)&&!isset($M['_id']))$M['_id']=0;$Z=where_to_query($Z);$Kf=array();foreach($C
as$X){$X=preg_replace('~ DESC$~','',$X,1,$rb);$Kf[$X]=($rb?-1:1);}if(isset($_GET['limit'])&&is_numeric($_GET['limit'])&&$_GET['limit']>0)$y=$_GET['limit'];$y=min(200,max(1,(int)$y));$Hf=$D*$y;$bb='MongoDB\Driver\Query';$G=new$bb($Z,array('projection'=>$M,'limit'=>$y,'skip'=>$Hf,'sort'=>$Kf));$nf=$h->_link->executeQuery("$h->_db_name.$R",$G);return
new
Min_Result($nf);}function
update($R,$P,$H,$y=0,$N="\n"){global$h;$m=$h->_db_name;$Z=sql_query_where_parser($H);$bb='MongoDB\Driver\BulkWrite';$Ta=new$bb(array());if(isset($P['_id']))unset($P['_id']);$gf=array();foreach($P
as$x=>$Y){if($Y=='NULL'){$gf[$x]=1;unset($P[$x]);}}$Ng=array('$set'=>$P);if(count($gf))$Ng['$unset']=$gf;$Ta->update($Z,$Ng,array('upsert'=>false));$nf=$h->_link->executeBulkWrite("$m.$R",$Ta);$h->affected_rows=$nf->getModifiedCount();return
true;}function
delete($R,$H,$y=0){global$h;$m=$h->_db_name;$Z=sql_query_where_parser($H);$bb='MongoDB\Driver\BulkWrite';$Ta=new$bb(array());$Ta->delete($Z,array('limit'=>$y));$nf=$h->_link->executeBulkWrite("$m.$R",$Ta);$h->affected_rows=$nf->getDeletedCount();return
true;}function
insert($R,$P){global$h;$m=$h->_db_name;$bb='MongoDB\Driver\BulkWrite';$Ta=new$bb(array());if(isset($P['_id'])&&empty($P['_id']))unset($P['_id']);$Ta->insert($P);$nf=$h->_link->executeBulkWrite("$m.$R",$Ta);$h->affected_rows=$nf->getInsertedCount();return
true;}}function
get_databases($wc){global$h;$J=array();$bb='MongoDB\Driver\Command';$ib=new$bb(array('listDatabases'=>1));$nf=$h->_link->executeCommand('admin',$ib);foreach($nf
as$zb){foreach($zb->databases
as$m)$J[]=$m->name;}return$J;}function
count_tables($l){$J=array();return$J;}function
tables_list(){global$h;$bb='MongoDB\Driver\Command';$ib=new$bb(array('listCollections'=>1));$nf=$h->_link->executeCommand($h->_db_name,$ib);$gb=array();foreach($nf
as$I)$gb[$I->name]='table';return$gb;}function
drop_databases($l){return
false;}function
indexes($R,$i=null){global$h;$J=array();$bb='MongoDB\Driver\Command';$ib=new$bb(array('listIndexes'=>$R));$nf=$h->_link->executeCommand($h->_db_name,$ib);foreach($nf
as$u){$Eb=array();$f=array();foreach(get_object_vars($u->key)as$e=>$U){$Eb[]=($U==-1?'1':null);$f[]=$e;}$J[$u->name]=array("type"=>($u->name=="_id_"?"PRIMARY":(isset($u->unique)?"UNIQUE":"INDEX")),"columns"=>$f,"lengths"=>array(),"descs"=>$Eb,);}return$J;}function
fields($R){$q=fields_from_edit();if(!count($q)){global$n;$I=$n->select($R,array("*"),null,null,array(),10);while($K=$I->fetch_assoc()){foreach($K
as$x=>$X){$K[$x]=null;$q[$x]=array("field"=>$x,"type"=>"string","null"=>($x!=$n->primary),"auto_increment"=>($x==$n->primary),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1,),);}}}return$q;}function
found_rows($S,$Z){global$h;$Z=where_to_query($Z);$bb='MongoDB\Driver\Command';$ib=new$bb(array('count'=>$S['Name'],'query'=>$Z));$nf=$h->_link->executeCommand($h->_db_name,$ib);$tg=$nf->toArray();return$tg[0]->n;}function
sql_query_where_parser($H){$H=trim(preg_replace('/WHERE[\s]?[(]?\(?/','',$H));$H=preg_replace('/\)\)\)$/',')',$H);$hh=explode(' AND ',$H);$ih=explode(') OR (',$H);$Z=array();foreach($hh
as$fh)$Z[]=trim($fh);if(count($ih)==1)$ih=array();elseif(count($ih)>1)$Z=array();return
where_to_query($Z,$ih);}function
where_to_query($dh=array(),$eh=array()){global$b;$xb=array();foreach(array('and'=>$dh,'or'=>$eh)as$U=>$Z){if(is_array($Z)){foreach($Z
as$ec){list($eb,$re,$X)=explode(" ",$ec,3);if($eb=="_id"){$X=str_replace('MongoDB\BSON\ObjectID("',"",$X);$X=str_replace('")',"",$X);$bb='MongoDB\BSON\ObjectID';$X=new$bb($X);}if(!in_array($re,$b->operators))continue;if(preg_match('~^\(f\)(.+)~',$re,$_)){$X=(float)$X;$re=$_[1];}elseif(preg_match('~^\(date\)(.+)~',$re,$_)){$yb=new
DateTime($X);$bb='MongoDB\BSON\UTCDatetime';$X=new$bb($yb->getTimestamp()*1000);$re=$_[1];}switch($re){case'=':$re='$eq';break;case'!=':$re='$ne';break;case'>':$re='$gt';break;case'<':$re='$lt';break;case'>=':$re='$gte';break;case'<=':$re='$lte';break;case'regex':$re='$regex';break;default:continue
2;}if($U=='and')$xb['$and'][]=array($eb=>array($re=>$X));elseif($U=='or')$xb['$or'][]=array($eb=>array($re=>$X));}}}return$xb;}$te=array("=","!=",">","<",">=","<=","regex","(f)=","(f)!=","(f)>","(f)<","(f)>=","(f)<=","(date)=","(date)!=","(date)>","(date)<","(date)>=","(date)<=",);}function
table($t){return$t;}function
idf_escape($t){return$t;}function
table_status($A="",$kc=false){$J=array();foreach(tables_list()as$R=>$U){$J[$R]=array("Name"=>$R);if($A==$R)return$J[$R];}return$J;}function
create_database($m,$d){return
true;}function
last_id(){global$h;return$h->last_id;}function
error(){global$h;return
h($h->error);}function
collations(){return
array();}function
logged_user(){global$b;$j=$b->credentials();return$j[1];}function
connect(){global$b;$h=new
Min_DB;list($O,$V,$F)=$b->credentials();$B=array();if($V.$F!=""){$B["username"]=$V;$B["password"]=$F;}$m=$b->database();if($m!="")$B["db"]=$m;if(($Fa=getenv("MONGO_AUTH_SOURCE")))$B["authSource"]=$Fa;try{$h->_link=$h->connect("mongodb://$O",$B);if($F!=""){$B["password"]="";try{$h->connect("mongodb://$O",$B);return
lang(22);}catch(Exception$ac){}}return$h;}catch(Exception$ac){return$ac->getMessage();}}function
alter_indexes($R,$c){global$h;foreach($c
as$X){list($U,$A,$P)=$X;if($P=="DROP")$J=$h->_db->command(array("deleteIndexes"=>$R,"index"=>$A));else{$f=array();foreach($P
as$e){$e=preg_replace('~ DESC$~','',$e,1,$rb);$f[$e]=($rb?-1:1);}$J=$h->_db->selectCollection($R)->ensureIndex($f,array("unique"=>($U=="UNIQUE"),"name"=>$A,));}if($J['errmsg']){$h->error=$J['errmsg'];return
false;}}return
true;}function
support($lc){return
preg_match("~database|indexes|descidx~",$lc);}function
db_collation($m,$fb){}function
information_schema(){}function
is_view($S){}function
convert_field($p){}function
unconvert_field($p,$J){return$J;}function
foreign_keys($R){return
array();}function
fk_support($S){}function
engines(){return
array();}function
alter_table($R,$A,$q,$yc,$jb,$Vb,$d,$Ga,$Ee){global$h;if($R==""){$h->_db->createCollection($A);return
true;}}function
drop_tables($T){global$h;foreach($T
as$R){$kf=$h->_db->selectCollection($R)->drop();if(!$kf['ok'])return
false;}return
true;}function
truncate_tables($T){global$h;foreach($T
as$R){$kf=$h->_db->selectCollection($R)->remove();if(!$kf['ok'])return
false;}return
true;}$w="mongo";$Hc=array();$Lc=array();$Ob=array(array("json"));}$Jb["elastic"]="Elasticsearch (beta)";if(isset($_GET["elastic"])){$Ne=array("json + allow_url_fopen");define("DRIVER","elastic");if(function_exists('json_decode')&&ini_bool('allow_url_fopen')){class
Min_DB{var$extension="JSON",$server_info,$errno,$error,$_url;function
rootQuery($Ge,$pb=array(),$Zd='GET'){@ini_set('track_errors',1);$oc=@file_get_contents("$this->_url/".ltrim($Ge,'/'),false,stream_context_create(array('http'=>array('method'=>$Zd,'content'=>$pb===null?$pb:json_encode($pb),'header'=>'Content-Type: application/json','ignore_errors'=>1,))));if(!$oc){$this->error=$php_errormsg;return$oc;}if(!preg_match('~^HTTP/[0-9.]+ 2~i',$http_response_header[0])){$this->error=$oc;return
false;}$J=json_decode($oc,true);if($J===null){$this->errno=json_last_error();if(function_exists('json_last_error_msg'))$this->error=json_last_error_msg();else{$ob=get_defined_constants(true);foreach($ob['json']as$A=>$Y){if($Y==$this->errno&&preg_match('~^JSON_ERROR_~',$A)){$this->error=$A;break;}}}}return$J;}function
query($Ge,$pb=array(),$Zd='GET'){return$this->rootQuery(($this->_db!=""?"$this->_db/":"/").ltrim($Ge,'/'),$pb,$Zd);}function
connect($O,$V,$F){preg_match('~^(https?://)?(.*)~',$O,$_);$this->_url=($_[1]?$_[1]:"http://")."$V:$F@$_[2]";$J=$this->query('');if($J)$this->server_info=$J['version']['number'];return(bool)$J;}function
select_db($k){$this->_db=$k;return
true;}function
quote($Q){return$Q;}}class
Min_Result{var$num_rows,$_rows;function
__construct($L){$this->num_rows=count($L);$this->_rows=$L;reset($this->_rows);}function
fetch_assoc(){$J=current($this->_rows);next($this->_rows);return$J;}function
fetch_row(){return
array_values($this->fetch_assoc());}}}class
Min_Driver
extends
Min_SQL{function
select($R,$M,$Z,$Ic,$C=array(),$y=1,$D=0,$Re=false){global$b;$xb=array();$G="$R/_search";if($M!=array("*"))$xb["fields"]=$M;if($C){$Kf=array();foreach($C
as$eb){$eb=preg_replace('~ DESC$~','',$eb,1,$rb);$Kf[]=($rb?array($eb=>"desc"):$eb);}$xb["sort"]=$Kf;}if($y){$xb["size"]=+$y;if($D)$xb["from"]=($D*$y);}foreach($Z
as$X){list($eb,$re,$X)=explode(" ",$X,3);if($eb=="_id")$xb["query"]["ids"]["values"][]=$X;elseif($eb.$X!=""){$hg=array("term"=>array(($eb!=""?$eb:"_all")=>$X));if($re=="=")$xb["query"]["filtered"]["filter"]["and"][]=$hg;else$xb["query"]["filtered"]["query"]["bool"]["must"][]=$hg;}}if($xb["query"]&&!$xb["query"]["filtered"]["query"]&&!$xb["query"]["ids"])$xb["query"]["filtered"]["query"]=array("match_all"=>array());$Rf=microtime(true);$uf=$this->_conn->query($G,$xb);if($Re)echo$b->selectQuery("$G: ".json_encode($xb),$Rf,!$uf);if(!$uf)return
false;$J=array();foreach($uf['hits']['hits']as$Uc){$K=array();if($M==array("*"))$K["_id"]=$Uc["_id"];$q=$Uc['_source'];if($M!=array("*")){$q=array();foreach($M
as$x)$q[$x]=$Uc['fields'][$x];}foreach($q
as$x=>$X){if($xb["fields"])$X=$X[0];$K[$x]=(is_array($X)?json_encode($X):$X);}$J[]=$K;}return
new
Min_Result($J);}function
update($U,$cf,$H,$y=0,$N="\n"){$Fe=preg_split('~ *= *~',$H);if(count($Fe)==2){$s=trim($Fe[1]);$G="$U/$s";return$this->_conn->query($G,$cf,'POST');}return
false;}function
insert($U,$cf){$s="";$G="$U/$s";$kf=$this->_conn->query($G,$cf,'POST');$this->_conn->last_id=$kf['_id'];return$kf['created'];}function
delete($U,$H,$y=0){$Zc=array();if(is_array($_GET["where"])&&$_GET["where"]["_id"])$Zc[]=$_GET["where"]["_id"];if(is_array($_POST['check'])){foreach($_POST['check']as$Va){$Fe=preg_split('~ *= *~',$Va);if(count($Fe)==2)$Zc[]=trim($Fe[1]);}}$this->_conn->affected_rows=0;foreach($Zc
as$s){$G="{$U}/{$s}";$kf=$this->_conn->query($G,'{}','DELETE');if(is_array($kf)&&$kf['found']==true)$this->_conn->affected_rows++;}return$this->_conn->affected_rows;}}function
connect(){global$b;$h=new
Min_DB;list($O,$V,$F)=$b->credentials();if($F!=""&&$h->connect($O,$V,""))return
lang(22);if($h->connect($O,$V,$F))return$h;return$h->error;}function
support($lc){return
preg_match("~database|table|columns~",$lc);}function
logged_user(){global$b;$j=$b->credentials();return$j[1];}function
get_databases(){global$h;$J=$h->rootQuery('_aliases');if($J){$J=array_keys($J);sort($J,SORT_STRING);}return$J;}function
collations(){return
array();}function
db_collation($m,$fb){}function
engines(){return
array();}function
count_tables($l){global$h;$J=array();$I=$h->query('_stats');if($I&&$I['indices']){$fd=$I['indices'];foreach($fd
as$ed=>$Sf){$dd=$Sf['total']['indexing'];$J[$ed]=$dd['index_total'];}}return$J;}function
tables_list(){global$h;$J=$h->query('_mapping');if($J)$J=array_fill_keys(array_keys($J[$h->_db]["mappings"]),'table');return$J;}function
table_status($A="",$kc=false){global$h;$uf=$h->query("_search",array("size"=>0,"aggregations"=>array("count_by_type"=>array("terms"=>array("field"=>"_type")))),"POST");$J=array();if($uf){$T=$uf["aggregations"]["count_by_type"]["buckets"];foreach($T
as$R){$J[$R["key"]]=array("Name"=>$R["key"],"Engine"=>"table","Rows"=>$R["doc_count"],);if($A!=""&&$A==$R["key"])return$J[$A];}}return$J;}function
error(){global$h;return
h($h->error);}function
information_schema(){}function
is_view($S){}function
indexes($R,$i=null){return
array(array("type"=>"PRIMARY","columns"=>array("_id")),);}function
fields($R){global$h;$I=$h->query("$R/_mapping");$J=array();if($I){$Md=$I[$R]['properties'];if(!$Md)$Md=$I[$h->_db]['mappings'][$R]['properties'];if($Md){foreach($Md
as$A=>$p){$J[$A]=array("field"=>$A,"full_type"=>$p["type"],"type"=>$p["type"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);if($p["properties"]){unset($J[$A]["privileges"]["insert"]);unset($J[$A]["privileges"]["update"]);}}}}return$J;}function
foreign_keys($R){return
array();}function
table($t){return$t;}function
idf_escape($t){return$t;}function
convert_field($p){}function
unconvert_field($p,$J){return$J;}function
fk_support($S){}function
found_rows($S,$Z){return
null;}function
create_database($m){global$h;return$h->rootQuery(urlencode($m),null,'PUT');}function
drop_databases($l){global$h;return$h->rootQuery(urlencode(implode(',',$l)),array(),'DELETE');}function
alter_table($R,$A,$q,$yc,$jb,$Vb,$d,$Ga,$Ee){global$h;$Ue=array();foreach($q
as$ic){$mc=trim($ic[1][0]);$nc=trim($ic[1][1]?$ic[1][1]:"text");$Ue[$mc]=array('type'=>$nc);}if(!empty($Ue))$Ue=array('properties'=>$Ue);return$h->query("_mapping/{$A}",$Ue,'PUT');}function
drop_tables($T){global$h;$J=true;foreach($T
as$R)$J=$J&&$h->query(urlencode($R),array(),'DELETE');return$J;}function
last_id(){global$h;return$h->last_id;}$w="elastic";$te=array("=","query");$Hc=array();$Lc=array();$Ob=array(array("json"));$Fg=array();$Vf=array();foreach(array(lang(27)=>array("long"=>3,"integer"=>5,"short"=>8,"byte"=>10,"double"=>20,"float"=>66,"half_float"=>12,"scaled_float"=>21),lang(28)=>array("date"=>10),lang(25)=>array("string"=>65535,"text"=>65535),lang(29)=>array("binary"=>255),)as$x=>$X){$Fg+=$X;$Vf[$x]=array_keys($X);}}$Jb["clickhouse"]="ClickHouse (alpha)";if(isset($_GET["clickhouse"])){define("DRIVER","clickhouse");class
Min_DB{var$extension="JSON",$server_info,$errno,$_result,$error,$_url;var$_db='default';function
rootQuery($m,$G){@ini_set('track_errors',1);$oc=@file_get_contents("$this->_url/?database=$m",false,stream_context_create(array('http'=>array('method'=>'POST','content'=>$this->isQuerySelectLike($G)?"$G FORMAT JSONCompact":$G,'header'=>'Content-type: application/x-www-form-urlencoded','ignore_errors'=>1,))));if($oc===false){$this->error=$php_errormsg;return$oc;}if(!preg_match('~^HTTP/[0-9.]+ 2~i',$http_response_header[0])){$this->error=$oc;return
false;}$J=json_decode($oc,true);if($J===null){if(!$this->isQuerySelectLike($G)&&$oc==='')return
true;$this->errno=json_last_error();if(function_exists('json_last_error_msg'))$this->error=json_last_error_msg();else{$ob=get_defined_constants(true);foreach($ob['json']as$A=>$Y){if($Y==$this->errno&&preg_match('~^JSON_ERROR_~',$A)){$this->error=$A;break;}}}}return
new
Min_Result($J);}function
isQuerySelectLike($G){return(bool)preg_match('~^(select|show)~i',$G);}function
query($G){return$this->rootQuery($this->_db,$G);}function
connect($O,$V,$F){preg_match('~^(https?://)?(.*)~',$O,$_);$this->_url=($_[1]?$_[1]:"http://")."$V:$F@$_[2]";$J=$this->query('SELECT 1');return(bool)$J;}function
select_db($k){$this->_db=$k;return
true;}function
quote($Q){return"'".addcslashes($Q,"\\'")."'";}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$p=0){$I=$this->query($G);return$I['data'];}}class
Min_Result{var$num_rows,$_rows,$columns,$meta,$_offset=0;function
__construct($I){$this->num_rows=$I['rows'];$this->_rows=$I['data'];$this->meta=$I['meta'];$this->columns=array_column($this->meta,'name');reset($this->_rows);}function
fetch_assoc(){$K=current($this->_rows);next($this->_rows);return$K===false?false:array_combine($this->columns,$K);}function
fetch_row(){$K=current($this->_rows);next($this->_rows);return$K;}function
fetch_field(){$e=$this->_offset++;$J=new
stdClass;if($e<count($this->columns)){$J->name=$this->meta[$e]['name'];$J->orgname=$J->name;$J->type=$this->meta[$e]['type'];}return$J;}}class
Min_Driver
extends
Min_SQL{function
delete($R,$H,$y=0){if($H==='')$H='WHERE 1=1';return
queries("ALTER TABLE ".table($R)." DELETE $H");}function
update($R,$P,$H,$y=0,$N="\n"){$Vg=array();foreach($P
as$x=>$X)$Vg[]="$x = $X";$G=$N.implode(",$N",$Vg);return
queries("ALTER TABLE ".table($R)." UPDATE $G$H");}}function
idf_escape($t){return"`".str_replace("`","``",$t)."`";}function
table($t){return
idf_escape($t);}function
explain($h,$G){return'';}function
found_rows($S,$Z){$L=get_vals("SELECT COUNT(*) FROM ".idf_escape($S["Name"]).($Z?" WHERE ".implode(" AND ",$Z):""));return
empty($L)?false:$L[0];}function
alter_table($R,$A,$q,$yc,$jb,$Vb,$d,$Ga,$Ee){$c=$C=array();foreach($q
as$p){if($p[1][2]===" NULL")$p[1][1]=" Nullable({$p[1][1]})";elseif($p[1][2]===' NOT NULL')$p[1][2]='';if($p[1][3])$p[1][3]='';$c[]=($p[1]?($R!=""?($p[0]!=""?"MODIFY COLUMN ":"ADD COLUMN "):" ").implode($p[1]):"DROP COLUMN ".idf_escape($p[0]));$C[]=$p[1][0];}$c=array_merge($c,$yc);$Tf=($Vb?" ENGINE ".$Vb:"");if($R=="")return
queries("CREATE TABLE ".table($A)." (\n".implode(",\n",$c)."\n)$Tf$Ee".' ORDER BY ('.implode(',',$C).')');if($R!=$A){$I=queries("RENAME TABLE ".table($R)." TO ".table($A));if($c)$R=$A;else
return$I;}if($Tf)$c[]=ltrim($Tf);return($c||$Ee?queries("ALTER TABLE ".table($R)."\n".implode(",\n",$c).$Ee):true);}function
truncate_tables($T){return
apply_queries("TRUNCATE TABLE",$T);}function
drop_views($Zg){return
drop_tables($Zg);}function
drop_tables($T){return
apply_queries("DROP TABLE",$T);}function
connect(){global$b;$h=new
Min_DB;$j=$b->credentials();if($h->connect($j[0],$j[1],$j[2]))return$h;return$h->error;}function
get_databases($wc){global$h;$I=get_rows('SHOW DATABASES');$J=array();foreach($I
as$K)$J[]=$K['name'];sort($J);return$J;}function
limit($G,$Z,$y,$me=0,$N=" "){return" $G$Z".($y!==null?$N."LIMIT $y".($me?", $me":""):"");}function
limit1($R,$G,$Z,$N="\n"){return
limit($G,$Z,1,0,$N);}function
db_collation($m,$fb){}function
engines(){return
array('MergeTree');}function
logged_user(){global$b;$j=$b->credentials();return$j[1];}function
tables_list(){$I=get_rows('SHOW TABLES');$J=array();foreach($I
as$K)$J[$K['name']]='table';ksort($J);return$J;}function
count_tables($l){return
array();}function
table_status($A="",$kc=false){global$h;$J=array();$T=get_rows("SELECT name, engine FROM system.tables WHERE database = ".q($h->_db));foreach($T
as$R){$J[$R['name']]=array('Name'=>$R['name'],'Engine'=>$R['engine'],);if($A===$R['name'])return$J[$R['name']];}return$J;}function
is_view($S){return
false;}function
fk_support($S){return
false;}function
convert_field($p){}function
unconvert_field($p,$J){if(in_array($p['type'],array("Int8","Int16","Int32","Int64","UInt8","UInt16","UInt32","UInt64","Float32","Float64")))return"to$p[type]($J)";return$J;}function
fields($R){$J=array();$I=get_rows("SELECT name, type, default_expression FROM system.columns WHERE ".idf_escape('table')." = ".q($R));foreach($I
as$K){$U=trim($K['type']);$ie=strpos($U,'Nullable(')===0;$J[trim($K['name'])]=array("field"=>trim($K['name']),"full_type"=>$U,"type"=>$U,"default"=>trim($K['default_expression']),"null"=>$ie,"auto_increment"=>'0',"privileges"=>array("insert"=>1,"select"=>1,"update"=>0),);}return$J;}function
indexes($R,$i=null){return
array();}function
foreign_keys($R){return
array();}function
collations(){return
array();}function
information_schema($m){return
false;}function
error(){global$h;return
h($h->error);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($sf){return
true;}function
auto_increment(){return'';}function
last_id(){return
0;}function
support($lc){return
preg_match("~^(columns|sql|status|table|drop_col)$~",$lc);}$w="clickhouse";$Fg=array();$Vf=array();foreach(array(lang(27)=>array("Int8"=>3,"Int16"=>5,"Int32"=>10,"Int64"=>19,"UInt8"=>3,"UInt16"=>5,"UInt32"=>10,"UInt64"=>20,"Float32"=>7,"Float64"=>16,'Decimal'=>38,'Decimal32'=>9,'Decimal64'=>18,'Decimal128'=>38),lang(28)=>array("Date"=>13,"DateTime"=>20),lang(25)=>array("String"=>0),lang(29)=>array("FixedString"=>0),)as$x=>$X){$Fg+=$X;$Vf[$x]=array_keys($X);}$Mg=array();$te=array("=","<",">","<=",">=","!=","~","!~","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL");$Hc=array();$Lc=array("avg","count","count distinct","max","min","sum");$Ob=array();}$Jb=array("server"=>"MySQL")+$Jb;if(!defined("DRIVER")){$Ne=array("MySQLi","MySQL","PDO_MySQL");define("DRIVER","server");if(extension_loaded("mysqli")){class
Min_DB
extends
MySQLi{var$extension="MySQLi";function
__construct(){parent::init();}function
connect($O="",$V="",$F="",$k=null,$Le=null,$Jf=null){global$b;mysqli_report(MYSQLI_REPORT_OFF);list($Vc,$Le)=explode(":",$O,2);$Qf=$b->connectSsl();if($Qf)$this->ssl_set($Qf['key'],$Qf['cert'],$Qf['ca'],'','');$J=@$this->real_connect(($O!=""?$Vc:ini_get("mysqli.default_host")),($O.$V!=""?$V:ini_get("mysqli.default_user")),($O.$V.$F!=""?$F:ini_get("mysqli.default_pw")),$k,(is_numeric($Le)?$Le:ini_get("mysqli.default_port")),(!is_numeric($Le)?$Le:$Jf),($Qf?64:0));$this->options(MYSQLI_OPT_LOCAL_INFILE,false);return$J;}function
set_charset($Ua){if(parent::set_charset($Ua))return
true;parent::set_charset('utf8');return$this->query("SET NAMES $Ua");}function
result($G,$p=0){$I=$this->query($G);if(!$I)return
false;$K=$I->fetch_array();return$K[$p];}function
quote($Q){return"'".$this->escape_string($Q)."'";}}}elseif(extension_loaded("mysql")&&!((ini_bool("sql.safe_mode")||ini_bool("mysql.allow_local_infile"))&&extension_loaded("pdo_mysql"))){class
Min_DB{var$extension="MySQL",$server_info,$affected_rows,$errno,$error,$_link,$_result;function
connect($O,$V,$F){if(ini_bool("mysql.allow_local_infile")){$this->error=lang(32,"'mysql.allow_local_infile'","MySQLi","PDO_MySQL");return
false;}$this->_link=@mysql_connect(($O!=""?$O:ini_get("mysql.default_host")),("$O$V"!=""?$V:ini_get("mysql.default_user")),("$O$V$F"!=""?$F:ini_get("mysql.default_password")),true,131072);if($this->_link)$this->server_info=mysql_get_server_info($this->_link);else$this->error=mysql_error();return(bool)$this->_link;}function
set_charset($Ua){if(function_exists('mysql_set_charset')){if(mysql_set_charset($Ua,$this->_link))return
true;mysql_set_charset('utf8',$this->_link);}return$this->query("SET NAMES $Ua");}function
quote($Q){return"'".mysql_real_escape_string($Q,$this->_link)."'";}function
select_db($k){return
mysql_select_db($k,$this->_link);}function
query($G,$Gg=false){$I=@($Gg?mysql_unbuffered_query($G,$this->_link):mysql_query($G,$this->_link));$this->error="";if(!$I){$this->errno=mysql_errno($this->_link);$this->error=mysql_error($this->_link);return
false;}if($I===true){$this->affected_rows=mysql_affected_rows($this->_link);$this->info=mysql_info($this->_link);return
true;}return
new
Min_Result($I);}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$p=0){$I=$this->query($G);if(!$I||!$I->num_rows)return
false;return
mysql_result($I->_result,0,$p);}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
__construct($I){$this->_result=$I;$this->num_rows=mysql_num_rows($I);}function
fetch_assoc(){return
mysql_fetch_assoc($this->_result);}function
fetch_row(){return
mysql_fetch_row($this->_result);}function
fetch_field(){$J=mysql_fetch_field($this->_result,$this->_offset++);$J->orgtable=$J->table;$J->orgname=$J->name;$J->charsetnr=($J->blob?63:0);return$J;}function
__destruct(){mysql_free_result($this->_result);}}}elseif(extension_loaded("pdo_mysql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_MySQL";function
connect($O,$V,$F){global$b;$B=array(PDO::MYSQL_ATTR_LOCAL_INFILE=>false);$Qf=$b->connectSsl();if($Qf){if(!empty($Qf['key']))$B[PDO::MYSQL_ATTR_SSL_KEY]=$Qf['key'];if(!empty($Qf['cert']))$B[PDO::MYSQL_ATTR_SSL_CERT]=$Qf['cert'];if(!empty($Qf['ca']))$B[PDO::MYSQL_ATTR_SSL_CA]=$Qf['ca'];}$this->dsn("mysql:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$O)),$V,$F,$B);return
true;}function
set_charset($Ua){$this->query("SET NAMES $Ua");}function
select_db($k){return$this->query("USE ".idf_escape($k));}function
query($G,$Gg=false){$this->pdo->setAttribute(1000,!$Gg);return
parent::query($G,$Gg);}}}class
Min_Driver
extends
Min_SQL{function
insert($R,$P){return($P?parent::insert($R,$P):queries("INSERT INTO ".table($R)." ()\nVALUES ()"));}function
insertUpdate($R,$L,$Pe){$f=array_keys(reset($L));$Oe="INSERT INTO ".table($R)." (".implode(", ",$f).") VALUES\n";$Vg=array();foreach($f
as$x)$Vg[$x]="$x = VALUES($x)";$Yf="\nON DUPLICATE KEY UPDATE ".implode(", ",$Vg);$Vg=array();$Fd=0;foreach($L
as$P){$Y="(".implode(", ",$P).")";if($Vg&&(strlen($Oe)+$Fd+strlen($Y)+strlen($Yf)>1e6)){if(!queries($Oe.implode(",\n",$Vg).$Yf))return
false;$Vg=array();$Fd=0;}$Vg[]=$Y;$Fd+=strlen($Y)+2;}return
queries($Oe.implode(",\n",$Vg).$Yf);}function
slowQuery($G,$mg){if(min_version('5.7.8','10.1.2')){if(preg_match('~MariaDB~',$this->_conn->server_info))return"SET STATEMENT max_statement_time=$mg FOR $G";elseif(preg_match('~^(SELECT\b)(.+)~is',$G,$_))return"$_[1] /*+ MAX_EXECUTION_TIME(".($mg*1000).") */ $_[2]";}}function
convertSearch($t,$X,$p){return(preg_match('~char|text|enum|set~',$p["type"])&&!preg_match("~^utf8~",$p["collation"])&&preg_match('~[\x80-\xFF]~',$X['val'])?"CONVERT($t USING ".charset($this->_conn).")":$t);}function
warnings(){$I=$this->_conn->query("SHOW WARNINGS");if($I&&$I->num_rows){ob_start();select($I);return
ob_get_clean();}}function
tableHelp($A){$Nd=preg_match('~MariaDB~',$this->_conn->server_info);if(information_schema(DB))return
strtolower(($Nd?"information-schema-$A-table/":str_replace("_","-",$A)."-table.html"));if(DB=="mysql")return($Nd?"mysql$A-table/":"system-database.html");}}function
idf_escape($t){return"`".str_replace("`","``",$t)."`";}function
table($t){return
idf_escape($t);}function
connect(){global$b,$Fg,$Vf;$h=new
Min_DB;$j=$b->credentials();if($h->connect($j[0],$j[1],$j[2])){$h->set_charset(charset($h));$h->query("SET sql_quote_show_create = 1, autocommit = 1");if(min_version('5.7.8',10.2,$h)){$Vf[lang(25)][]="json";$Fg["json"]=4294967295;}return$h;}$J=$h->error;if(function_exists('iconv')&&!is_utf8($J)&&strlen($rf=iconv("windows-1250","utf-8",$J))>strlen($J))$J=$rf;return$J;}function
get_databases($wc){$J=get_session("dbs");if($J===null){$G=(min_version(5)?"SELECT SCHEMA_NAME FROM information_schema.SCHEMATA ORDER BY SCHEMA_NAME":"SHOW DATABASES");$J=($wc?slow_query($G):get_vals($G));restart_session();set_session("dbs",$J);stop_session();}return$J;}function
limit($G,$Z,$y,$me=0,$N=" "){return" $G$Z".($y!==null?$N."LIMIT $y".($me?" OFFSET $me":""):"");}function
limit1($R,$G,$Z,$N="\n"){return
limit($G,$Z,1,0,$N);}function
db_collation($m,$fb){global$h;$J=null;$sb=$h->result("SHOW CREATE DATABASE ".idf_escape($m),1);if(preg_match('~ COLLATE ([^ ]+)~',$sb,$_))$J=$_[1];elseif(preg_match('~ CHARACTER SET ([^ ]+)~',$sb,$_))$J=$fb[$_[1]][-1];return$J;}function
engines(){$J=array();foreach(get_rows("SHOW ENGINES")as$K){if(preg_match("~YES|DEFAULT~",$K["Support"]))$J[]=$K["Engine"];}return$J;}function
logged_user(){global$h;return$h->result("SELECT USER()");}function
tables_list(){return
get_key_vals(min_version(5)?"SELECT TABLE_NAME, TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ORDER BY TABLE_NAME":"SHOW TABLES");}function
count_tables($l){$J=array();foreach($l
as$m)$J[$m]=count(get_vals("SHOW TABLES IN ".idf_escape($m)));return$J;}function
table_status($A="",$kc=false){$J=array();foreach(get_rows($kc&&min_version(5)?"SELECT TABLE_NAME AS Name, ENGINE AS Engine, TABLE_COMMENT AS Comment FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ".($A!=""?"AND TABLE_NAME = ".q($A):"ORDER BY Name"):"SHOW TABLE STATUS".($A!=""?" LIKE ".q(addcslashes($A,"%_\\")):""))as$K){if($K["Engine"]=="InnoDB")$K["Comment"]=preg_replace('~(?:(.+); )?InnoDB free: .*~','\1',$K["Comment"]);if(!isset($K["Engine"]))$K["Comment"]="";if($A!="")return$K;$J[$K["Name"]]=$K;}return$J;}function
is_view($S){return$S["Engine"]===null;}function
fk_support($S){return
preg_match('~InnoDB|IBMDB2I~i',$S["Engine"])||(preg_match('~NDB~i',$S["Engine"])&&min_version(5.6));}function
fields($R){$J=array();foreach(get_rows("SHOW FULL COLUMNS FROM ".table($R))as$K){preg_match('~^([^( ]+)(?:\((.+)\))?( unsigned)?( zerofill)?$~',$K["Type"],$_);$J[$K["Field"]]=array("field"=>$K["Field"],"full_type"=>$K["Type"],"type"=>$_[1],"length"=>$_[2],"unsigned"=>ltrim($_[3].$_[4]),"default"=>($K["Default"]!=""||preg_match("~char|set~",$_[1])?$K["Default"]:null),"null"=>($K["Null"]=="YES"),"auto_increment"=>($K["Extra"]=="auto_increment"),"on_update"=>(preg_match('~^on update (.+)~i',$K["Extra"],$_)?$_[1]:""),"collation"=>$K["Collation"],"privileges"=>array_flip(preg_split('~, *~',$K["Privileges"])),"comment"=>$K["Comment"],"primary"=>($K["Key"]=="PRI"),"generated"=>preg_match('~^(VIRTUAL|PERSISTENT|STORED)~',$K["Extra"]),);}return$J;}function
indexes($R,$i=null){$J=array();foreach(get_rows("SHOW INDEX FROM ".table($R),$i)as$K){$A=$K["Key_name"];$J[$A]["type"]=($A=="PRIMARY"?"PRIMARY":($K["Index_type"]=="FULLTEXT"?"FULLTEXT":($K["Non_unique"]?($K["Index_type"]=="SPATIAL"?"SPATIAL":"INDEX"):"UNIQUE")));$J[$A]["columns"][]=$K["Column_name"];$J[$A]["lengths"][]=($K["Index_type"]=="SPATIAL"?null:$K["Sub_part"]);$J[$A]["descs"][]=null;}return$J;}function
foreign_keys($R){global$h,$oe;static$He='(?:`(?:[^`]|``)+`|"(?:[^"]|"")+")';$J=array();$tb=$h->result("SHOW CREATE TABLE ".table($R),1);if($tb){preg_match_all("~CONSTRAINT ($He) FOREIGN KEY ?\\(((?:$He,? ?)+)\\) REFERENCES ($He)(?:\\.($He))? \\(((?:$He,? ?)+)\\)(?: ON DELETE ($oe))?(?: ON UPDATE ($oe))?~",$tb,$Qd,PREG_SET_ORDER);foreach($Qd
as$_){preg_match_all("~$He~",$_[2],$Lf);preg_match_all("~$He~",$_[5],$fg);$J[idf_unescape($_[1])]=array("db"=>idf_unescape($_[4]!=""?$_[3]:$_[4]),"table"=>idf_unescape($_[4]!=""?$_[4]:$_[3]),"source"=>array_map('idf_unescape',$Lf[0]),"target"=>array_map('idf_unescape',$fg[0]),"on_delete"=>($_[6]?$_[6]:"RESTRICT"),"on_update"=>($_[7]?$_[7]:"RESTRICT"),);}}return$J;}function
view($A){global$h;return
array("select"=>preg_replace('~^(?:[^`]|`[^`]*`)*\s+AS\s+~isU','',$h->result("SHOW CREATE VIEW ".table($A),1)));}function
collations(){$J=array();foreach(get_rows("SHOW COLLATION")as$K){if($K["Default"])$J[$K["Charset"]][-1]=$K["Collation"];else$J[$K["Charset"]][]=$K["Collation"];}ksort($J);foreach($J
as$x=>$X)asort($J[$x]);return$J;}function
information_schema($m){return(min_version(5)&&$m=="information_schema")||(min_version(5.5)&&$m=="performance_schema");}function
error(){global$h;return
h(preg_replace('~^You have an error.*syntax to use~U',"Syntax error",$h->error));}function
create_database($m,$d){return
queries("CREATE DATABASE ".idf_escape($m).($d?" COLLATE ".q($d):""));}function
drop_databases($l){$J=apply_queries("DROP DATABASE",$l,'idf_escape');restart_session();set_session("dbs",null);return$J;}function
rename_database($A,$d){$J=false;if(create_database($A,$d)){$hf=array();foreach(tables_list()as$R=>$U)$hf[]=table($R)." TO ".idf_escape($A).".".table($R);$J=(!$hf||queries("RENAME TABLE ".implode(", ",$hf)));if($J)queries("DROP DATABASE ".idf_escape(DB));restart_session();set_session("dbs",null);}return$J;}function
auto_increment(){$Ha=" PRIMARY KEY";if($_GET["create"]!=""&&$_POST["auto_increment_col"]){foreach(indexes($_GET["create"])as$u){if(in_array($_POST["fields"][$_POST["auto_increment_col"]]["orig"],$u["columns"],true)){$Ha="";break;}if($u["type"]=="PRIMARY")$Ha=" UNIQUE";}}return" AUTO_INCREMENT$Ha";}function
alter_table($R,$A,$q,$yc,$jb,$Vb,$d,$Ga,$Ee){$c=array();foreach($q
as$p)$c[]=($p[1]?($R!=""?($p[0]!=""?"CHANGE ".idf_escape($p[0]):"ADD"):" ")." ".implode($p[1]).($R!=""?$p[2]:""):"DROP ".idf_escape($p[0]));$c=array_merge($c,$yc);$Tf=($jb!==null?" COMMENT=".q($jb):"").($Vb?" ENGINE=".q($Vb):"").($d?" COLLATE ".q($d):"").($Ga!=""?" AUTO_INCREMENT=$Ga":"");if($R=="")return
queries("CREATE TABLE ".table($A)." (\n".implode(",\n",$c)."\n)$Tf$Ee");if($R!=$A)$c[]="RENAME TO ".table($A);if($Tf)$c[]=ltrim($Tf);return($c||$Ee?queries("ALTER TABLE ".table($R)."\n".implode(",\n",$c).$Ee):true);}function
alter_indexes($R,$c){foreach($c
as$x=>$X)$c[$x]=($X[2]=="DROP"?"\nDROP INDEX ".idf_escape($X[1]):"\nADD $X[0] ".($X[0]=="PRIMARY"?"KEY ":"").($X[1]!=""?idf_escape($X[1])." ":"")."(".implode(", ",$X[2]).")");return
queries("ALTER TABLE ".table($R).implode(",",$c));}function
truncate_tables($T){return
apply_queries("TRUNCATE TABLE",$T);}function
drop_views($Zg){return
queries("DROP VIEW ".implode(", ",array_map('table',$Zg)));}function
drop_tables($T){return
queries("DROP TABLE ".implode(", ",array_map('table',$T)));}function
move_tables($T,$Zg,$fg){$hf=array();foreach(array_merge($T,$Zg)as$R)$hf[]=table($R)." TO ".idf_escape($fg).".".table($R);return
queries("RENAME TABLE ".implode(", ",$hf));}function
copy_tables($T,$Zg,$fg){queries("SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO'");foreach($T
as$R){$A=($fg==DB?table("copy_$R"):idf_escape($fg).".".table($R));if(($_POST["overwrite"]&&!queries("\nDROP TABLE IF EXISTS $A"))||!queries("CREATE TABLE $A LIKE ".table($R))||!queries("INSERT INTO $A SELECT * FROM ".table($R)))return
false;foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($R,"%_\\")))as$K){$Ag=$K["Trigger"];if(!queries("CREATE TRIGGER ".($fg==DB?idf_escape("copy_$Ag"):idf_escape($fg).".".idf_escape($Ag))." $K[Timing] $K[Event] ON $A FOR EACH ROW\n$K[Statement];"))return
false;}}foreach($Zg
as$R){$A=($fg==DB?table("copy_$R"):idf_escape($fg).".".table($R));$Yg=view($R);if(($_POST["overwrite"]&&!queries("DROP VIEW IF EXISTS $A"))||!queries("CREATE VIEW $A AS $Yg[select]"))return
false;}return
true;}function
trigger($A){if($A=="")return
array();$L=get_rows("SHOW TRIGGERS WHERE `Trigger` = ".q($A));return
reset($L);}function
triggers($R){$J=array();foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($R,"%_\\")))as$K)$J[$K["Trigger"]]=array($K["Timing"],$K["Event"]);return$J;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
routine($A,$U){global$h,$Wb,$kd,$Fg;$xa=array("bool","boolean","integer","double precision","real","dec","numeric","fixed","national char","national varchar");$Mf="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$Eg="((".implode("|",array_merge(array_keys($Fg),$xa)).")\\b(?:\\s*\\(((?:[^'\")]|$Wb)++)\\))?\\s*(zerofill\\s*)?(unsigned(?:\\s+zerofill)?)?)(?:\\s*(?:CHARSET|CHARACTER\\s+SET)\\s*['\"]?([^'\"\\s,]+)['\"]?)?";$He="$Mf*(".($U=="FUNCTION"?"":$kd).")?\\s*(?:`((?:[^`]|``)*)`\\s*|\\b(\\S+)\\s+)$Eg";$sb=$h->result("SHOW CREATE $U ".idf_escape($A),2);preg_match("~\\(((?:$He\\s*,?)*)\\)\\s*".($U=="FUNCTION"?"RETURNS\\s+$Eg\\s+":"")."(.*)~is",$sb,$_);$q=array();preg_match_all("~$He\\s*,?~is",$_[1],$Qd,PREG_SET_ORDER);foreach($Qd
as$Be)$q[]=array("field"=>str_replace("``","`",$Be[2]).$Be[3],"type"=>strtolower($Be[5]),"length"=>preg_replace_callback("~$Wb~s",'normalize_enum',$Be[6]),"unsigned"=>strtolower(preg_replace('~\s+~',' ',trim("$Be[8] $Be[7]"))),"null"=>1,"full_type"=>$Be[4],"inout"=>strtoupper($Be[1]),"collation"=>strtolower($Be[9]),);if($U!="FUNCTION")return
array("fields"=>$q,"definition"=>$_[11]);return
array("fields"=>$q,"returns"=>array("type"=>$_[12],"length"=>$_[13],"unsigned"=>$_[15],"collation"=>$_[16]),"definition"=>$_[17],"language"=>"SQL",);}function
routines(){return
get_rows("SELECT ROUTINE_NAME AS SPECIFIC_NAME, ROUTINE_NAME, ROUTINE_TYPE, DTD_IDENTIFIER FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = ".q(DB));}function
routine_languages(){return
array();}function
routine_id($A,$K){return
idf_escape($A);}function
last_id(){global$h;return$h->result("SELECT LAST_INSERT_ID()");}function
explain($h,$G){return$h->query("EXPLAIN ".(min_version(5.1)?"PARTITIONS ":"").$G);}function
found_rows($S,$Z){return($Z||$S["Engine"]!="InnoDB"?null:$S["Rows"]);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($sf,$i=null){return
true;}function
create_sql($R,$Ga,$Wf){global$h;$J=$h->result("SHOW CREATE TABLE ".table($R),1);if(!$Ga)$J=preg_replace('~ AUTO_INCREMENT=\d+~','',$J);return$J;}function
truncate_sql($R){return"TRUNCATE ".table($R);}function
use_sql($k){return"USE ".idf_escape($k);}function
trigger_sql($R){$J="";foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($R,"%_\\")),null,"-- ")as$K)$J.="\nCREATE TRIGGER ".idf_escape($K["Trigger"])." $K[Timing] $K[Event] ON ".table($K["Table"])." FOR EACH ROW\n$K[Statement];;\n";return$J;}function
show_variables(){return
get_key_vals("SHOW VARIABLES");}function
process_list(){return
get_rows("SHOW FULL PROCESSLIST");}function
show_status(){return
get_key_vals("SHOW STATUS");}function
convert_field($p){if(preg_match("~binary~",$p["type"]))return"HEX(".idf_escape($p["field"]).")";if($p["type"]=="bit")return"BIN(".idf_escape($p["field"])." + 0)";if(preg_match("~geometry|point|linestring|polygon~",$p["type"]))return(min_version(8)?"ST_":"")."AsWKT(".idf_escape($p["field"]).")";}function
unconvert_field($p,$J){if(preg_match("~binary~",$p["type"]))$J="UNHEX($J)";if($p["type"]=="bit")$J="CONV($J, 2, 10) + 0";if(preg_match("~geometry|point|linestring|polygon~",$p["type"]))$J=(min_version(8)?"ST_":"")."GeomFromText($J, SRID($p[field]))";return$J;}function
support($lc){return!preg_match("~scheme|sequence|type|view_trigger|materializedview".(min_version(8)?"":"|descidx".(min_version(5.1)?"":"|event|partitioning".(min_version(5)?"":"|routine|trigger|view")))."~",$lc);}function
kill_process($X){return
queries("KILL ".number($X));}function
connection_id(){return"SELECT CONNECTION_ID()";}function
max_connections(){global$h;return$h->result("SELECT @@max_connections");}$w="sql";$Fg=array();$Vf=array();foreach(array(lang(27)=>array("tinyint"=>3,"smallint"=>5,"mediumint"=>8,"int"=>10,"bigint"=>20,"decimal"=>66,"float"=>12,"double"=>21),lang(28)=>array("date"=>10,"datetime"=>19,"timestamp"=>19,"time"=>10,"year"=>4),lang(25)=>array("char"=>255,"varchar"=>65535,"tinytext"=>255,"text"=>65535,"mediumtext"=>16777215,"longtext"=>4294967295),lang(33)=>array("enum"=>65535,"set"=>64),lang(29)=>array("bit"=>20,"binary"=>255,"varbinary"=>65535,"tinyblob"=>255,"blob"=>65535,"mediumblob"=>16777215,"longblob"=>4294967295),lang(31)=>array("geometry"=>0,"point"=>0,"linestring"=>0,"polygon"=>0,"multipoint"=>0,"multilinestring"=>0,"multipolygon"=>0,"geometrycollection"=>0),)as$x=>$X){$Fg+=$X;$Vf[$x]=array_keys($X);}$Mg=array("unsigned","zerofill","unsigned zerofill");$te=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","REGEXP","IN","FIND_IN_SET","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL");$Hc=array("char_length","date","from_unixtime","lower","round","floor","ceil","sec_to_time","time_to_sec","upper");$Lc=array("avg","count","count distinct","group_concat","max","min","sum");$Ob=array(array("char"=>"md5/sha1/password/encrypt/uuid","binary"=>"md5/sha1","date|time"=>"now",),array(number_type()=>"+/-","date"=>"+ interval/- interval","time"=>"addtime/subtime","char|text"=>"concat",));}define("SERVER",$_GET[DRIVER]);define("DB",$_GET["db"]);define("ME",preg_replace('~\?.*~','',relative_uri()).'?'.(sid()?SID.'&':'').(SERVER!==null?DRIVER."=".urlencode(SERVER).'&':'').(isset($_GET["username"])?"username=".urlencode($_GET["username"]).'&':'').(DB!=""?'db='.urlencode(DB).'&'.(isset($_GET["ns"])?"ns=".urlencode($_GET["ns"])."&":""):''));$ca="4.7.8";class
Adminer{var$operators=array("<=",">=");var$_values=array();function
name(){return"<a href='https://www.adminer.org/editor/'".target_blank()." id='h1'>".lang(34)."</a>";}function
credentials(){return
array(SERVER,$_GET["username"],get_password());}function
connectSsl(){}function
permanentLogin($sb=false){return
password_file($sb);}function
bruteForceKey(){return$_SERVER["REMOTE_ADDR"];}function
serverName($O){}function
database(){global$h;if($h){$l=$this->databases(false);return(!$l?$h->result("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', 1)"):$l[(information_schema($l[0])?1:0)]);}}function
schemas(){return
schemas();}function
databases($wc=true){return
get_databases($wc);}function
queryTimeout(){return
5;}function
headers(){}function
csp(){return
csp();}function
head(){return
true;}function
css(){$J=array();$pc="adminer.css";if(file_exists($pc))$J[]=$pc;return$J;}function
loginForm(){echo"<table cellspacing='0' class='layout'>\n",$this->loginFormField('username','<tr><th>'.lang(35).'<td>','<input type="hidden" name="auth[driver]" value="server"><input name="auth[username]" id="username" value="'.h($_GET["username"]).'" autocomplete="username" autocapitalize="off">'.script("focus(qs('#username'));")),$this->loginFormField('password','<tr><th>'.lang(36).'<td>','<input type="password" name="auth[password]" autocomplete="current-password">'."\n"),"</table>\n","<p><input type='submit' value='".lang(37)."'>\n",checkbox("auth[permanent]",1,$_COOKIE["adminer_permanent"],lang(38))."\n";}function
loginFormField($A,$Sc,$Y){return$Sc.$Y;}function
login($Kd,$F){return
true;}function
tableName($bg){return
h($bg["Comment"]!=""?$bg["Comment"]:$bg["Name"]);}function
fieldName($p,$C=0){return
h(preg_replace('~\s+\[.*\]$~','',($p["comment"]!=""?$p["comment"]:$p["field"])));}function
selectLinks($bg,$P=""){$a=$bg["Name"];if($P!==null)echo'<p class="tabs"><a href="'.h(ME.'edit='.urlencode($a).$P).'">'.lang(39)."</a>\n";}function
foreignKeys($R){return
foreign_keys($R);}function
backwardKeys($R,$ag){$J=array();foreach(get_rows("SELECT TABLE_NAME, CONSTRAINT_NAME, COLUMN_NAME, REFERENCED_COLUMN_NAME
FROM information_schema.KEY_COLUMN_USAGE
WHERE TABLE_SCHEMA = ".q($this->database())."
AND REFERENCED_TABLE_SCHEMA = ".q($this->database())."
AND REFERENCED_TABLE_NAME = ".q($R)."
ORDER BY ORDINAL_POSITION",null,"")as$K)$J[$K["TABLE_NAME"]]["keys"][$K["CONSTRAINT_NAME"]][$K["COLUMN_NAME"]]=$K["REFERENCED_COLUMN_NAME"];foreach($J
as$x=>$X){$A=$this->tableName(table_status($x,true));if($A!=""){$uf=preg_quote($ag);$N="(:|\\s*-)?\\s+";$J[$x]["name"]=(preg_match("(^$uf$N(.+)|^(.+?)$N$uf\$)iu",$A,$_)?$_[2].$_[3]:$A);}else
unset($J[$x]);}return$J;}function
backwardKeysPrint($Ka,$K){foreach($Ka
as$R=>$Ja){foreach($Ja["keys"]as$hb){$z=ME.'select='.urlencode($R);$r=0;foreach($hb
as$e=>$X)$z.=where_link($r++,$e,$K[$X]);echo"<a href='".h($z)."'>".h($Ja["name"])."</a>";$z=ME.'edit='.urlencode($R);foreach($hb
as$e=>$X)$z.="&set".urlencode("[".bracket_escape($e)."]")."=".urlencode($K[$X]);echo"<a href='".h($z)."' title='".lang(39)."'>+</a> ";}}}function
selectQuery($G,$Rf,$jc=false){return"<!--\n".str_replace("--","--><!-- ",$G)."\n(".format_time($Rf).")\n-->\n";}function
rowDescription($R){foreach(fields($R)as$p){if(preg_match("~varchar|character varying~",$p["type"]))return
idf_escape($p["field"]);}return"";}function
rowDescriptions($L,$_c){$J=$L;foreach($L[0]as$x=>$X){if(list($R,$s,$A)=$this->_foreignColumn($_c,$x)){$Zc=array();foreach($L
as$K)$Zc[$K[$x]]=q($K[$x]);$Db=$this->_values[$R];if(!$Db)$Db=get_key_vals("SELECT $s, $A FROM ".table($R)." WHERE $s IN (".implode(", ",$Zc).")");foreach($L
as$de=>$K){if(isset($K[$x]))$J[$de][$x]=(string)$Db[$K[$x]];}}}return$J;}function
selectLink($X,$p){}function
selectVal($X,$z,$p,$xe){$J=$X;$z=h($z);if(preg_match('~blob|bytea~',$p["type"])&&!is_utf8($X)){$J=lang(40,strlen($xe));if(preg_match("~^(GIF|\xFF\xD8\xFF|\x89PNG\x0D\x0A\x1A\x0A)~",$xe))$J="<img src='$z' alt='$J'>";}if(like_bool($p)&&$J!="")$J=(preg_match('~^(1|t|true|y|yes|on)$~i',$X)?lang(41):lang(42));if($z)$J="<a href='$z'".(is_url($z)?target_blank():"").">$J</a>";if(!$z&&!like_bool($p)&&preg_match(number_type(),$p["type"]))$J="<div class='number'>$J</div>";elseif(preg_match('~date~',$p["type"]))$J="<div class='datetime'>$J</div>";return$J;}function
editVal($X,$p){if(preg_match('~date|timestamp~',$p["type"])&&$X!==null)return
preg_replace('~^(\d{2}(\d+))-(0?(\d+))-(0?(\d+))~',lang(43),$X);return$X;}function
selectColumnsPrint($M,$f){}function
selectSearchPrint($Z,$f,$v){$Z=(array)$_GET["where"];echo'<fieldset id="fieldset-search"><legend>'.lang(44)."</legend><div>\n";$xd=array();foreach($Z
as$x=>$X)$xd[$X["col"]]=$x;$r=0;$q=fields($_GET["select"]);foreach($f
as$A=>$Cb){$p=$q[$A];if(preg_match("~enum~",$p["type"])||like_bool($p)){$x=$xd[$A];$r--;echo"<div>".h($Cb)."<input type='hidden' name='where[$r][col]' value='".h($A)."'>:",(like_bool($p)?" <select name='where[$r][val]'>".optionlist(array(""=>"",lang(42),lang(41)),$Z[$x]["val"],true)."</select>":enum_input("checkbox"," name='where[$r][val][]'",$p,(array)$Z[$x]["val"],($p["null"]?0:null))),"</div>\n";unset($f[$A]);}elseif(is_array($B=$this->_foreignKeyOptions($_GET["select"],$A))){if($q[$A]["null"])$B[0]='('.lang(7).')';$x=$xd[$A];$r--;echo"<div>".h($Cb)."<input type='hidden' name='where[$r][col]' value='".h($A)."'><input type='hidden' name='where[$r][op]' value='='>: <select name='where[$r][val]'>".optionlist($B,$Z[$x]["val"],true)."</select></div>\n";unset($f[$A]);}}$r=0;foreach($Z
as$X){if(($X["col"]==""||$f[$X["col"]])&&"$X[col]$X[val]"!=""){echo"<div><select name='where[$r][col]'><option value=''>(".lang(45).")".optionlist($f,$X["col"],true)."</select>",html_select("where[$r][op]",array(-1=>"")+$this->operators,$X["op"]),"<input type='search' name='where[$r][val]' value='".h($X["val"])."'>".script("mixin(qsl('input'), {onkeydown: selectSearchKeydown, onsearch: selectSearchSearch});","")."</div>\n";$r++;}}echo"<div><select name='where[$r][col]'><option value=''>(".lang(45).")".optionlist($f,null,true)."</select>",script("qsl('select').onchange = selectAddRow;",""),html_select("where[$r][op]",array(-1=>"")+$this->operators),"<input type='search' name='where[$r][val]'></div>",script("mixin(qsl('input'), {onchange: function () { this.parentNode.firstChild.onchange(); }, onsearch: selectSearchSearch});"),"</div></fieldset>\n";}function
selectOrderPrint($C,$f,$v){$we=array();foreach($v
as$x=>$u){$C=array();foreach($u["columns"]as$X)$C[]=$f[$X];if(count(array_filter($C,'strlen'))>1&&$x!="PRIMARY")$we[$x]=implode(", ",$C);}if($we){echo'<fieldset><legend>'.lang(46)."</legend><div>","<select name='index_order'>".optionlist(array(""=>"")+$we,($_GET["order"][0]!=""?"":$_GET["index_order"]),true)."</select>","</div></fieldset>\n";}if($_GET["order"])echo"<div style='display: none;'>".hidden_fields(array("order"=>array(1=>reset($_GET["order"])),"desc"=>($_GET["desc"]?array(1=>1):array()),))."</div>\n";}function
selectLimitPrint($y){echo"<fieldset><legend>".lang(47)."</legend><div>";echo
html_select("limit",array("","50","100"),$y),"</div></fieldset>\n";}function
selectLengthPrint($jg){}function
selectActionPrint($v){echo"<fieldset><legend>".lang(48)."</legend><div>","<input type='submit' value='".lang(49)."'>","</div></fieldset>\n";}function
selectCommandPrint(){return
true;}function
selectImportPrint(){return
true;}function
selectEmailPrint($Sb,$f){if($Sb){print_fieldset("email",lang(50),$_POST["email_append"]);echo"<div>",script("qsl('div').onkeydown = partialArg(bodyKeydown, 'email');"),"<p>".lang(51).": <input name='email_from' value='".h($_POST?$_POST["email_from"]:$_COOKIE["adminer_email"])."'>\n",lang(52).": <input name='email_subject' value='".h($_POST["email_subject"])."'>\n","<p><textarea name='email_message' rows='15' cols='75'>".h($_POST["email_message"].($_POST["email_append"]?'{$'."$_POST[email_addition]}":""))."</textarea>\n","<p>".script("qsl('p').onkeydown = partialArg(bodyKeydown, 'email_append');","").html_select("email_addition",$f,$_POST["email_addition"])."<input type='submit' name='email_append' value='".lang(11)."'>\n";echo"<p>".lang(53).": <input type='file' name='email_files[]'>".script("qsl('input').onchange = emailFileChange;"),"<p>".(count($Sb)==1?'<input type="hidden" name="email_field" value="'.h(key($Sb)).'">':html_select("email_field",$Sb)),"<input type='submit' name='email' value='".lang(54)."'>".confirm(),"</div>\n","</div></fieldset>\n";}}function
selectColumnsProcess($f,$v){return
array(array(),array());}function
selectSearchProcess($q,$v){$J=array();foreach((array)$_GET["where"]as$x=>$Z){$eb=$Z["col"];$re=$Z["op"];$X=$Z["val"];if(($x<0?"":$eb).$X!=""){$lb=array();foreach(($eb!=""?array($eb=>$q[$eb]):$q)as$A=>$p){if($eb!=""||is_numeric($X)||!preg_match(number_type(),$p["type"])){$A=idf_escape($A);if($eb!=""&&$p["type"]=="enum")$lb[]=(in_array(0,$X)?"$A IS NULL OR ":"")."$A IN (".implode(", ",array_map('intval',$X)).")";else{$kg=preg_match('~char|text|enum|set~',$p["type"]);$Y=$this->processInput($p,(!$re&&$kg&&preg_match('~^[^%]+$~',$X)?"%$X%":$X));$lb[]=$A.($Y=="NULL"?" IS".($re==">="?" NOT":"")." $Y":(in_array($re,$this->operators)||$re=="="?" $re $Y":($kg?" LIKE $Y":" IN (".str_replace(",","', '",$Y).")")));if($x<0&&$X=="0")$lb[]="$A IS NULL";}}}$J[]=($lb?"(".implode(" OR ",$lb).")":"1 = 0");}}return$J;}function
selectOrderProcess($q,$v){$cd=$_GET["index_order"];if($cd!="")unset($_GET["order"][1]);if($_GET["order"])return
array(idf_escape(reset($_GET["order"])).($_GET["desc"]?" DESC":""));foreach(($cd!=""?array($v[$cd]):$v)as$u){if($cd!=""||$u["type"]=="INDEX"){$Nc=array_filter($u["descs"]);$Cb=false;foreach($u["columns"]as$X){if(preg_match('~date|timestamp~',$q[$X]["type"])){$Cb=true;break;}}$J=array();foreach($u["columns"]as$x=>$X)$J[]=idf_escape($X).(($Nc?$u["descs"][$x]:$Cb)?" DESC":"");return$J;}}return
array();}function
selectLimitProcess(){return(isset($_GET["limit"])?$_GET["limit"]:"50");}function
selectLengthProcess(){return"100";}function
selectEmailProcess($Z,$_c){if($_POST["email_append"])return
true;if($_POST["email"]){$zf=0;if($_POST["all"]||$_POST["check"]){$p=idf_escape($_POST["email_field"]);$Xf=$_POST["email_subject"];$Wd=$_POST["email_message"];preg_match_all('~\{\$([a-z0-9_]+)\}~i',"$Xf.$Wd",$Qd);$L=get_rows("SELECT DISTINCT $p".($Qd[1]?", ".implode(", ",array_map('idf_escape',array_unique($Qd[1]))):"")." FROM ".table($_GET["select"])." WHERE $p IS NOT NULL AND $p != ''".($Z?" AND ".implode(" AND ",$Z):"").($_POST["all"]?"":" AND ((".implode(") OR (",array_map('where_check',(array)$_POST["check"]))."))"));$q=fields($_GET["select"]);foreach($this->rowDescriptions($L,$_c)as$K){$if=array('{\\'=>'{');foreach($Qd[1]as$X)$if['{$'."$X}"]=$this->editVal($K[$X],$q[$X]);$Rb=$K[$_POST["email_field"]];if(is_mail($Rb)&&send_mail($Rb,strtr($Xf,$if),strtr($Wd,$if),$_POST["email_from"],$_FILES["email_files"]))$zf++;}}cookie("adminer_email",$_POST["email_from"]);redirect(remove_from_uri(),lang(55,$zf));}return
false;}function
selectQueryBuild($M,$Z,$Ic,$C,$y,$D){return"";}function
messageQuery($G,$lg,$jc=false){return" <span class='time'>".@date("H:i:s")."</span><!--\n".str_replace("--","--><!-- ",$G)."\n".($lg?"($lg)\n":"")."-->";}function
editFunctions($p){$J=array();if($p["null"]&&preg_match('~blob~',$p["type"]))$J["NULL"]=lang(7);$J[""]=($p["null"]||$p["auto_increment"]||like_bool($p)?"":"*");if(preg_match('~date|time~',$p["type"]))$J["now"]=lang(56);if(preg_match('~_(md5|sha1)$~i',$p["field"],$_))$J[]=strtolower($_[1]);return$J;}function
editInput($R,$p,$Da,$Y){if($p["type"]=="enum")return(isset($_GET["select"])?"<label><input type='radio'$Da value='-1' checked><i>".lang(8)."</i></label> ":"").enum_input("radio",$Da,$p,($Y||isset($_GET["select"])?$Y:0),($p["null"]?"":null));$B=$this->_foreignKeyOptions($R,$p["field"],$Y);if($B!==null)return(is_array($B)?"<select$Da>".optionlist($B,$Y,true)."</select>":"<input value='".h($Y)."'$Da class='hidden'>"."<input value='".h($B)."' class='jsonly'>"."<div></div>".script("qsl('input').oninput = partial(whisper, '".ME."script=complete&source=".urlencode($R)."&field=".urlencode($p["field"])."&value=');
qsl('div').onclick = whisperClick;",""));if(like_bool($p))return'<input type="checkbox" value="1"'.(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?' checked':'')."$Da>";$Tc="";if(preg_match('~time~',$p["type"]))$Tc=lang(57);if(preg_match('~date|timestamp~',$p["type"]))$Tc=lang(58).($Tc?" [$Tc]":"");if($Tc)return"<input value='".h($Y)."'$Da> ($Tc)";if(preg_match('~_(md5|sha1)$~i',$p["field"]))return"<input type='password' value='".h($Y)."'$Da>";return'';}function
editHint($R,$p,$Y){return(preg_match('~\s+(\[.*\])$~',($p["comment"]!=""?$p["comment"]:$p["field"]),$_)?h(" $_[1]"):'');}function
processInput($p,$Y,$Gc=""){if($Gc=="now")return"$Gc()";$J=$Y;if(preg_match('~date|timestamp~',$p["type"])&&preg_match('(^'.str_replace('\$1','(?P<p1>\d*)',preg_replace('~(\\\\\\$([2-6]))~','(?P<p\2>\d{1,2})',preg_quote(lang(43)))).'(.*))',$Y,$_))$J=($_["p1"]!=""?$_["p1"]:($_["p2"]!=""?($_["p2"]<70?20:19).$_["p2"]:gmdate("Y")))."-$_[p3]$_[p4]-$_[p5]$_[p6]".end($_);$J=($p["type"]=="bit"&&preg_match('~^[0-9]+$~',$Y)?$J:q($J));if($Y==""&&like_bool($p))$J="'0'";elseif($Y==""&&($p["null"]||!preg_match('~char|text~',$p["type"])))$J="NULL";elseif(preg_match('~^(md5|sha1)$~',$Gc))$J="$Gc($J)";return
unconvert_field($p,$J);}function
dumpOutput(){return
array();}function
dumpFormat(){return
array('csv'=>'CSV,','csv;'=>'CSV;','tsv'=>'TSV');}function
dumpDatabase($m){}function
dumpTable($R,$Wf,$rd=0){echo"\xef\xbb\xbf";}function
dumpData($R,$Wf,$G){global$h;$I=$h->query($G,1);if($I){while($K=$I->fetch_assoc()){if($Wf=="table"){dump_csv(array_keys($K));$Wf="INSERT";}dump_csv($K);}}}function
dumpFilename($Xc){return
friendly_url($Xc);}function
dumpHeaders($Xc,$be=false){$fc="csv";header("Content-Type: text/csv; charset=utf-8");return$fc;}function
importServerPath(){}function
homepage(){return
true;}function
navigation($ae){global$ca;echo'<h1>
',$this->name(),' <span class="version">',$ca,'</span>
<a href="https://www.adminer.org/editor/#download"',target_blank(),' id="version">',(version_compare($ca,$_COOKIE["adminer_version"])<0?h($_COOKIE["adminer_version"]):""),'</a>
</h1>
';if($ae=="auth"){$sc=true;foreach((array)$_SESSION["pwds"]as$Wg=>$Df){foreach($Df[""]as$V=>$F){if($F!==null){if($sc){echo"<ul id='logins'>",script("mixin(qs('#logins'), {onmouseover: menuOver, onmouseout: menuOut});");$sc=false;}echo"<li><a href='".h(auth_url($Wg,"",$V))."'>".($V!=""?h($V):"<i>".lang(7)."</i>")."</a>\n";}}}}else{$this->databasesPrint($ae);if($ae!="db"&&$ae!="ns"){$S=table_status('',true);if(!$S)echo"<p class='message'>".lang(9)."\n";else$this->tablesPrint($S);}}}function
databasesPrint($ae){}function
tablesPrint($T){echo"<ul id='tables'>",script("mixin(qs('#tables'), {onmouseover: menuOver, onmouseout: menuOut});");foreach($T
as$K){echo'<li>';$A=$this->tableName($K);if(isset($K["Engine"])&&$A!="")echo"<a href='".h(ME).'select='.urlencode($K["Name"])."'".bold($_GET["select"]==$K["Name"]||$_GET["edit"]==$K["Name"],"select")." title='".lang(59)."'>$A</a>\n";}echo"</ul>\n";}function
_foreignColumn($_c,$e){foreach((array)$_c[$e]as$zc){if(count($zc["source"])==1){$A=$this->rowDescription($zc["table"]);if($A!=""){$s=idf_escape($zc["target"][0]);return
array($zc["table"],$s,$A);}}}}function
_foreignKeyOptions($R,$e,$Y=null){global$h;if(list($fg,$s,$A)=$this->_foreignColumn(column_foreign_keys($R),$e)){$J=&$this->_values[$fg];if($J===null){$S=table_status($fg);$J=($S["Rows"]>1000?"":array(""=>"")+get_key_vals("SELECT $s, $A FROM ".table($fg)." ORDER BY 2"));}if(!$J&&$Y!==null)return$h->result("SELECT $A FROM ".table($fg)." WHERE $s = ".q($Y));return$J;}}}$b=(function_exists('adminer_object')?adminer_object():new
Adminer);function
page_header($og,$o="",$Sa=array(),$pg=""){global$ba,$ca,$b,$Jb,$w;page_headers();if(is_ajax()&&$o){page_messages($o);exit;}$qg=$og.($pg!=""?": $pg":"");$rg=strip_tags($qg.(SERVER!=""&&SERVER!="localhost"?h(" - ".SERVER):"")." - ".$b->name());echo'<!DOCTYPE html>
<html lang="',$ba,'" dir="',lang(60),'">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex">
<title>',$rg,'</title>
<link rel="stylesheet" type="text/css" href="',h(preg_replace("~\\?.*~","",ME)."?file=default.css&version=4.7.8"),'">
',script_src(preg_replace("~\\?.*~","",ME)."?file=functions.js&version=4.7.8");if($b->head()){echo'<link rel="shortcut icon" type="image/x-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.7.8"),'">
<link rel="apple-touch-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.7.8"),'">
';foreach($b->css()as$vb){echo'<link rel="stylesheet" type="text/css" href="',h($vb),'">
';}}echo'
<body class="',lang(60),' nojs">
';$pc=get_temp_dir()."/adminer.version";if(!$_COOKIE["adminer_version"]&&function_exists('openssl_verify')&&file_exists($pc)&&filemtime($pc)+86400>time()){$Xg=unserialize(file_get_contents($pc));$Ve="-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwqWOVuF5uw7/+Z70djoK
RlHIZFZPO0uYRezq90+7Amk+FDNd7KkL5eDve+vHRJBLAszF/7XKXe11xwliIsFs
DFWQlsABVZB3oisKCBEuI71J4kPH8dKGEWR9jDHFw3cWmoH3PmqImX6FISWbG3B8
h7FIx3jEaw5ckVPVTeo5JRm/1DZzJxjyDenXvBQ/6o9DgZKeNDgxwKzH+sw9/YCO
jHnq1cFpOIISzARlrHMa/43YfeNRAm/tsBXjSxembBPo7aQZLAWHmaj5+K19H10B
nCpz9Y++cipkVEiKRGih4ZEvjoFysEOdRLj6WiD/uUNky4xGeA6LaJqh5XpkFkcQ
fQIDAQAB
-----END PUBLIC KEY-----
";if(openssl_verify($Xg["version"],base64_decode($Xg["signature"]),$Ve)==1)$_COOKIE["adminer_version"]=$Xg["version"];}echo'<script',nonce(),'>
mixin(document.body, {onkeydown: bodyKeydown, onclick: bodyClick',(isset($_COOKIE["adminer_version"])?"":", onload: partial(verifyVersion, '$ca', '".js_escape(ME)."', '".get_token()."')");?>});
document.body.className = document.body.className.replace(/ nojs/, ' js');
var offlineMessage = '<?php echo
js_escape(lang(61)),'\';
var thousandsSeparator = \'',js_escape(lang(5)),'\';
</script>

<div id="help" class="jush-',$w,' jsonly hidden"></div>
',script("mixin(qs('#help'), {onmouseover: function () { helpOpen = 1; }, onmouseout: helpMouseout});"),'
<div id="content">
';if($Sa!==null){$z=substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1);echo'<p id="breadcrumb"><a href="'.h($z?$z:".").'">'.$Jb[DRIVER].'</a> &raquo; ';$z=substr(preg_replace('~\b(db|ns)=[^&]*&~','',ME),0,-1);$O=$b->serverName(SERVER);$O=($O!=""?$O:lang(62));if($Sa===false)echo"$O\n";else{echo"<a href='".($z?h($z):".")."' accesskey='1' title='Alt+Shift+1'>$O</a> &raquo; ";if($_GET["ns"]!=""||(DB!=""&&is_array($Sa)))echo'<a href="'.h($z."&db=".urlencode(DB).(support("scheme")?"&ns=":"")).'">'.h(DB).'</a> &raquo; ';if(is_array($Sa)){if($_GET["ns"]!="")echo'<a href="'.h(substr(ME,0,-1)).'">'.h($_GET["ns"]).'</a> &raquo; ';foreach($Sa
as$x=>$X){$Cb=(is_array($X)?$X[1]:h($X));if($Cb!="")echo"<a href='".h(ME."$x=").urlencode(is_array($X)?$X[0]:$X)."'>$Cb</a> &raquo; ";}}echo"$og\n";}}echo"<h2>$qg</h2>\n","<div id='ajaxstatus' class='jsonly hidden'></div>\n";restart_session();page_messages($o);$l=&get_session("dbs");if(DB!=""&&$l&&!in_array(DB,$l,true))$l=null;stop_session();define("PAGE_HEADER",1);}function
page_headers(){global$b;header("Content-Type: text/html; charset=utf-8");header("Cache-Control: no-cache");header("X-Frame-Options: deny");header("X-XSS-Protection: 0");header("X-Content-Type-Options: nosniff");header("Referrer-Policy: origin-when-cross-origin");foreach($b->csp()as$ub){$Qc=array();foreach($ub
as$x=>$X)$Qc[]="$x $X";header("Content-Security-Policy: ".implode("; ",$Qc));}$b->headers();}function
csp(){return
array(array("script-src"=>"'self' 'unsafe-inline' 'nonce-".get_nonce()."' 'strict-dynamic'","connect-src"=>"'self'","frame-src"=>"https://www.adminer.org","object-src"=>"'none'","base-uri"=>"'none'","form-action"=>"'self'",),);}function
get_nonce(){static$he;if(!$he)$he=base64_encode(rand_string());return$he;}function
page_messages($o){$Og=preg_replace('~^[^?]*~','',$_SERVER["REQUEST_URI"]);$Xd=$_SESSION["messages"][$Og];if($Xd){echo"<div class='message'>".implode("</div>\n<div class='message'>",$Xd)."</div>".script("messagesPrint();");unset($_SESSION["messages"][$Og]);}if($o)echo"<div class='error'>$o</div>\n";}function
page_footer($ae=""){global$b,$ug;echo'</div>

';switch_lang();if($ae!="auth"){echo'<form action="" method="post">
<p class="logout">
<input type="submit" name="logout" value="',lang(63),'" id="logout">
<input type="hidden" name="token" value="',$ug,'">
</p>
</form>
';}echo'<div id="menu">
';$b->navigation($ae);echo'</div>
',script("setupSubmitHighlight(document);");}function
int32($de){while($de>=2147483648)$de-=4294967296;while($de<=-2147483649)$de+=4294967296;return(int)$de;}function
long2str($W,$bh){$rf='';foreach($W
as$X)$rf.=pack('V',$X);if($bh)return
substr($rf,0,end($W));return$rf;}function
str2long($rf,$bh){$W=array_values(unpack('V*',str_pad($rf,4*ceil(strlen($rf)/4),"\0")));if($bh)$W[]=strlen($rf);return$W;}function
xxtea_mx($mh,$lh,$Zf,$td){return
int32((($mh>>5&0x7FFFFFF)^$lh<<2)+(($lh>>3&0x1FFFFFFF)^$mh<<4))^int32(($Zf^$lh)+($td^$mh));}function
encrypt_string($Uf,$x){if($Uf=="")return"";$x=array_values(unpack("V*",pack("H*",md5($x))));$W=str2long($Uf,true);$de=count($W)-1;$mh=$W[$de];$lh=$W[0];$We=floor(6+52/($de+1));$Zf=0;while($We-->0){$Zf=int32($Zf+0x9E3779B9);$Nb=$Zf>>2&3;for($_e=0;$_e<$de;$_e++){$lh=$W[$_e+1];$ce=xxtea_mx($mh,$lh,$Zf,$x[$_e&3^$Nb]);$mh=int32($W[$_e]+$ce);$W[$_e]=$mh;}$lh=$W[0];$ce=xxtea_mx($mh,$lh,$Zf,$x[$_e&3^$Nb]);$mh=int32($W[$de]+$ce);$W[$de]=$mh;}return
long2str($W,false);}function
decrypt_string($Uf,$x){if($Uf=="")return"";if(!$x)return
false;$x=array_values(unpack("V*",pack("H*",md5($x))));$W=str2long($Uf,false);$de=count($W)-1;$mh=$W[$de];$lh=$W[0];$We=floor(6+52/($de+1));$Zf=int32($We*0x9E3779B9);while($Zf){$Nb=$Zf>>2&3;for($_e=$de;$_e>0;$_e--){$mh=$W[$_e-1];$ce=xxtea_mx($mh,$lh,$Zf,$x[$_e&3^$Nb]);$lh=int32($W[$_e]-$ce);$W[$_e]=$lh;}$mh=$W[$de];$ce=xxtea_mx($mh,$lh,$Zf,$x[$_e&3^$Nb]);$lh=int32($W[0]-$ce);$W[0]=$lh;$Zf=int32($Zf-0x9E3779B9);}return
long2str($W,true);}$h='';$Pc=$_SESSION["token"];if(!$Pc)$_SESSION["token"]=rand(1,1e6);$ug=get_token();$Je=array();if($_COOKIE["adminer_permanent"]){foreach(explode(" ",$_COOKIE["adminer_permanent"])as$X){list($x)=explode(":",$X);$Je[$x]=$X;}}function
add_invalid_login(){global$b;$Ec=file_open_lock(get_temp_dir()."/adminer.invalid");if(!$Ec)return;$od=unserialize(stream_get_contents($Ec));$lg=time();if($od){foreach($od
as$pd=>$X){if($X[0]<$lg)unset($od[$pd]);}}$nd=&$od[$b->bruteForceKey()];if(!$nd)$nd=array($lg+30*60,0);$nd[1]++;file_write_unlock($Ec,serialize($od));}function
check_invalid_login(){global$b;$od=unserialize(@file_get_contents(get_temp_dir()."/adminer.invalid"));$nd=$od[$b->bruteForceKey()];$ge=($nd[1]>29?$nd[0]-time():0);if($ge>0)auth_error(lang(64,ceil($ge/60)));}$Ea=$_POST["auth"];if($Ea){session_regenerate_id();$Wg=$Ea["driver"];$O=$Ea["server"];$V=$Ea["username"];$F=(string)$Ea["password"];$m=$Ea["db"];set_password($Wg,$O,$V,$F);$_SESSION["db"][$Wg][$O][$V][$m]=true;if($Ea["permanent"]){$x=base64_encode($Wg)."-".base64_encode($O)."-".base64_encode($V)."-".base64_encode($m);$Se=$b->permanentLogin(true);$Je[$x]="$x:".base64_encode($Se?encrypt_string($F,$Se):"");cookie("adminer_permanent",implode(" ",$Je));}if(count($_POST)==1||DRIVER!=$Wg||SERVER!=$O||$_GET["username"]!==$V||DB!=$m)redirect(auth_url($Wg,$O,$V,$m));}elseif($_POST["logout"]){if($Pc&&!verify_token()){page_header(lang(63),lang(65));page_footer("db");exit;}else{foreach(array("pwds","db","dbs","queries")as$x)set_session($x,null);unset_permanent();redirect(substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1),lang(66).' '.lang(67));}}elseif($Je&&!$_SESSION["pwds"]){session_regenerate_id();$Se=$b->permanentLogin();foreach($Je
as$x=>$X){list(,$ab)=explode(":",$X);list($Wg,$O,$V,$m)=array_map('base64_decode',explode("-",$x));set_password($Wg,$O,$V,decrypt_string(base64_decode($ab),$Se));$_SESSION["db"][$Wg][$O][$V][$m]=true;}}function
unset_permanent(){global$Je;foreach($Je
as$x=>$X){list($Wg,$O,$V,$m)=array_map('base64_decode',explode("-",$x));if($Wg==DRIVER&&$O==SERVER&&$V==$_GET["username"]&&$m==DB)unset($Je[$x]);}cookie("adminer_permanent",implode(" ",$Je));}function
auth_error($o){global$b,$Pc;$Ef=session_name();if(isset($_GET["username"])){header("HTTP/1.1 403 Forbidden");if(($_COOKIE[$Ef]||$_GET[$Ef])&&!$Pc)$o=lang(68);else{restart_session();add_invalid_login();$F=get_password();if($F!==null){if($F===false)$o.='<br>'.lang(69,target_blank(),'<code>permanentLogin()</code>');set_password(DRIVER,SERVER,$_GET["username"],null);}unset_permanent();}}if(!$_COOKIE[$Ef]&&$_GET[$Ef]&&ini_bool("session.use_only_cookies"))$o=lang(70);$E=session_get_cookie_params();cookie("adminer_key",($_COOKIE["adminer_key"]?$_COOKIE["adminer_key"]:rand_string()),$E["lifetime"]);page_header(lang(37),$o,null);echo"<form action='' method='post'>\n","<div>";if(hidden_fields($_POST,array("auth")))echo"<p class='message'>".lang(71)."\n";echo"</div>\n";$b->loginForm();echo"</form>\n";page_footer("auth");exit;}if(isset($_GET["username"])&&!class_exists("Min_DB")){unset($_SESSION["pwds"][DRIVER]);unset_permanent();page_header(lang(72),lang(73,implode(", ",$Ne)),false);page_footer("auth");exit;}stop_session(true);if(isset($_GET["username"])&&is_string(get_password())){list($Vc,$Le)=explode(":",SERVER,2);if(+$Le&&($Le<1024||$Le>65535))auth_error(lang(74));check_invalid_login();$h=connect();$n=new
Min_Driver($h);}$Kd=null;if(!is_object($h)||($Kd=$b->login($_GET["username"],get_password()))!==true){$o=(is_string($h)?h($h):(is_string($Kd)?$Kd:lang(75)));auth_error($o.(preg_match('~^ | $~',get_password())?'<br>'.lang(76):''));}if($Ea&&$_POST["token"])$_POST["token"]=$ug;$o='';if($_POST){if(!verify_token()){$jd="max_input_vars";$Ud=ini_get($jd);if(extension_loaded("suhosin")){foreach(array("suhosin.request.max_vars","suhosin.post.max_vars")as$x){$X=ini_get($x);if($X&&(!$Ud||$X<$Ud)){$jd=$x;$Ud=$X;}}}$o=(!$_POST["token"]&&$Ud?lang(77,"'$jd'"):lang(65).' '.lang(78));}}elseif($_SERVER["REQUEST_METHOD"]=="POST"){$o=lang(79,"'post_max_size'");if(isset($_GET["sql"]))$o.=' '.lang(80);}function
email_header($Qc){return"=?UTF-8?B?".base64_encode($Qc)."?=";}function
send_mail($Rb,$Xf,$Wd,$Fc="",$qc=array()){$Xb=(DIRECTORY_SEPARATOR=="/"?"\n":"\r\n");$Wd=str_replace("\n",$Xb,wordwrap(str_replace("\r","","$Wd\n")));$Ra=uniqid("boundary");$Ba="";foreach((array)$qc["error"]as$x=>$X){if(!$X)$Ba.="--$Ra$Xb"."Content-Type: ".str_replace("\n","",$qc["type"][$x]).$Xb."Content-Disposition: attachment; filename=\"".preg_replace('~["\n]~','',$qc["name"][$x])."\"$Xb"."Content-Transfer-Encoding: base64$Xb$Xb".chunk_split(base64_encode(file_get_contents($qc["tmp_name"][$x])),76,$Xb).$Xb;}$Ma="";$Rc="Content-Type: text/plain; charset=utf-8$Xb"."Content-Transfer-Encoding: 8bit";if($Ba){$Ba.="--$Ra--$Xb";$Ma="--$Ra$Xb$Rc$Xb$Xb";$Rc="Content-Type: multipart/mixed; boundary=\"$Ra\"";}$Rc.=$Xb."MIME-Version: 1.0$Xb"."X-Mailer: Adminer Editor".($Fc?$Xb."From: ".str_replace("\n","",$Fc):"");return
mail($Rb,email_header($Xf),$Ma.$Wd.$Ba,$Rc);}function
like_bool($p){return
preg_match("~bool|(tinyint|bit)\\(1\\)~",$p["full_type"]);}$h->select_db($b->database());$oe="RESTRICT|NO ACTION|CASCADE|SET NULL|SET DEFAULT";$Jb[DRIVER]=lang(37);if(isset($_GET["select"])&&($_POST["edit"]||$_POST["clone"])&&!$_POST["save"])$_GET["edit"]=$_GET["select"];if(isset($_GET["download"])){$a=$_GET["download"];$q=fields($a);header("Content-Type: application/octet-stream");header("Content-Disposition: attachment; filename=".friendly_url("$a-".implode("_",$_GET["where"])).".".friendly_url($_GET["field"]));$M=array(idf_escape($_GET["field"]));$I=$n->select($a,$M,array(where($_GET,$q)),$M);$K=($I?$I->fetch_row():array());echo$n->value($K[0],$q[$_GET["field"]]);exit;}elseif(isset($_GET["edit"])){$a=$_GET["edit"];$q=fields($a);$Z=(isset($_GET["select"])?($_POST["check"]&&count($_POST["check"])==1?where_check($_POST["check"][0],$q):""):where($_GET,$q));$Ng=(isset($_GET["select"])?$_POST["edit"]:$Z);foreach($q
as$A=>$p){if(!isset($p["privileges"][$Ng?"update":"insert"])||$b->fieldName($p)==""||$p["generated"])unset($q[$A]);}if($_POST&&!$o&&!isset($_GET["select"])){$Jd=$_POST["referer"];if($_POST["insert"])$Jd=($Ng?null:$_SERVER["REQUEST_URI"]);elseif(!preg_match('~^.+&select=.+$~',$Jd))$Jd=ME."select=".urlencode($a);$v=indexes($a);$Ig=unique_array($_GET["where"],$v);$Ye="\nWHERE $Z";if(isset($_POST["delete"]))queries_redirect($Jd,lang(81),$n->delete($a,$Ye,!$Ig));else{$P=array();foreach($q
as$A=>$p){$X=process_input($p);if($X!==false&&$X!==null)$P[idf_escape($A)]=$X;}if($Ng){if(!$P)redirect($Jd);queries_redirect($Jd,lang(82),$n->update($a,$P,$Ye,!$Ig));if(is_ajax()){page_headers();page_messages($o);exit;}}else{$I=$n->insert($a,$P);$Dd=($I?last_id():0);queries_redirect($Jd,lang(83,($Dd?" $Dd":"")),$I);}}}$K=null;if($_POST["save"])$K=(array)$_POST["fields"];elseif($Z){$M=array();foreach($q
as$A=>$p){if(isset($p["privileges"]["select"])){$_a=convert_field($p);if($_POST["clone"]&&$p["auto_increment"])$_a="''";if($w=="sql"&&preg_match("~enum|set~",$p["type"]))$_a="1*".idf_escape($A);$M[]=($_a?"$_a AS ":"").idf_escape($A);}}$K=array();if(!support("table"))$M=array("*");if($M){$I=$n->select($a,$M,array($Z),$M,array(),(isset($_GET["select"])?2:1));if(!$I)$o=error();else{$K=$I->fetch_assoc();if(!$K)$K=false;}if(isset($_GET["select"])&&(!$K||$I->fetch_assoc()))$K=null;}}if(!support("table")&&!$q){if(!$Z){$I=$n->select($a,array("*"),$Z,array("*"));$K=($I?$I->fetch_assoc():false);if(!$K)$K=array($n->primary=>"");}if($K){foreach($K
as$x=>$X){if(!$Z)$K[$x]=null;$q[$x]=array("field"=>$x,"null"=>($x!=$n->primary),"auto_increment"=>($x==$n->primary));}}}edit_form($a,$q,$K,$Ng);}elseif(isset($_GET["select"])){$a=$_GET["select"];$S=table_status1($a);$v=indexes($a);$q=fields($a);$Bc=column_foreign_keys($a);$ne=$S["Oid"];parse_str($_COOKIE["adminer_import"],$ta);$pf=array();$f=array();$jg=null;foreach($q
as$x=>$p){$A=$b->fieldName($p);if(isset($p["privileges"]["select"])&&$A!=""){$f[$x]=html_entity_decode(strip_tags($A),ENT_QUOTES);if(is_shortable($p))$jg=$b->selectLengthProcess();}$pf+=$p["privileges"];}list($M,$Ic)=$b->selectColumnsProcess($f,$v);$qd=count($Ic)<count($M);$Z=$b->selectSearchProcess($q,$v);$C=$b->selectOrderProcess($q,$v);$y=$b->selectLimitProcess();if($_GET["val"]&&is_ajax()){header("Content-Type: text/plain; charset=utf-8");foreach($_GET["val"]as$Jg=>$K){$_a=convert_field($q[key($K)]);$M=array($_a?$_a:idf_escape(key($K)));$Z[]=where_check($Jg,$q);$J=$n->select($a,$M,$Z,$M);if($J)echo
reset($J->fetch_row());}exit;}$Pe=$Lg=null;foreach($v
as$u){if($u["type"]=="PRIMARY"){$Pe=array_flip($u["columns"]);$Lg=($M?$Pe:array());foreach($Lg
as$x=>$X){if(in_array(idf_escape($x),$M))unset($Lg[$x]);}break;}}if($ne&&!$Pe){$Pe=$Lg=array($ne=>0);$v[]=array("type"=>"PRIMARY","columns"=>array($ne));}if($_POST&&!$o){$gh=$Z;if(!$_POST["all"]&&is_array($_POST["check"])){$Ya=array();foreach($_POST["check"]as$Va)$Ya[]=where_check($Va,$q);$gh[]="((".implode(") OR (",$Ya)."))";}$gh=($gh?"\nWHERE ".implode(" AND ",$gh):"");if($_POST["export"]){cookie("adminer_import","output=".urlencode($_POST["output"])."&format=".urlencode($_POST["format"]));dump_headers($a);$b->dumpTable($a,"");$Fc=($M?implode(", ",$M):"*").convert_fields($f,$q,$M)."\nFROM ".table($a);$Kc=($Ic&&$qd?"\nGROUP BY ".implode(", ",$Ic):"").($C?"\nORDER BY ".implode(", ",$C):"");if(!is_array($_POST["check"])||$Pe)$G="SELECT $Fc$gh$Kc";else{$Hg=array();foreach($_POST["check"]as$X)$Hg[]="(SELECT".limit($Fc,"\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$q).$Kc,1).")";$G=implode(" UNION ALL ",$Hg);}$b->dumpData($a,"table",$G);exit;}if(!$b->selectEmailProcess($Z,$Bc)){if($_POST["save"]||$_POST["delete"]){$I=true;$ua=0;$P=array();if(!$_POST["delete"]){foreach($f
as$A=>$X){$X=process_input($q[$A]);if($X!==null&&($_POST["clone"]||$X!==false))$P[idf_escape($A)]=($X!==false?$X:idf_escape($A));}}if($_POST["delete"]||$P){if($_POST["clone"])$G="INTO ".table($a)." (".implode(", ",array_keys($P)).")\nSELECT ".implode(", ",$P)."\nFROM ".table($a);if($_POST["all"]||($Pe&&is_array($_POST["check"]))||$qd){$I=($_POST["delete"]?$n->delete($a,$gh):($_POST["clone"]?queries("INSERT $G$gh"):$n->update($a,$P,$gh)));$ua=$h->affected_rows;}else{foreach((array)$_POST["check"]as$X){$ch="\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$q);$I=($_POST["delete"]?$n->delete($a,$ch,1):($_POST["clone"]?queries("INSERT".limit1($a,$G,$ch)):$n->update($a,$P,$ch,1)));if(!$I)break;$ua+=$h->affected_rows;}}}$Wd=lang(84,$ua);if($_POST["clone"]&&$I&&$ua==1){$Dd=last_id();if($Dd)$Wd=lang(83," $Dd");}queries_redirect(remove_from_uri($_POST["all"]&&$_POST["delete"]?"page":""),$Wd,$I);if(!$_POST["delete"]){edit_form($a,$q,(array)$_POST["fields"],!$_POST["clone"]);page_footer();exit;}}elseif(!$_POST["import"]){if(!$_POST["val"])$o=lang(85);else{$I=true;$ua=0;foreach($_POST["val"]as$Jg=>$K){$P=array();foreach($K
as$x=>$X){$x=bracket_escape($x,1);$P[idf_escape($x)]=(preg_match('~char|text~',$q[$x]["type"])||$X!=""?$b->processInput($q[$x],$X):"NULL");}$I=$n->update($a,$P," WHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($Jg,$q),!$qd&&!$Pe," ");if(!$I)break;$ua+=$h->affected_rows;}queries_redirect(remove_from_uri(),lang(84,$ua),$I);}}elseif(!is_string($oc=get_file("csv_file",true)))$o=upload_error($oc);elseif(!preg_match('~~u',$oc))$o=lang(86);else{cookie("adminer_import","output=".urlencode($ta["output"])."&format=".urlencode($_POST["separator"]));$I=true;$hb=array_keys($q);preg_match_all('~(?>"[^"]*"|[^"\r\n]+)+~',$oc,$Qd);$ua=count($Qd[0]);$n->begin();$N=($_POST["separator"]=="csv"?",":($_POST["separator"]=="tsv"?"\t":";"));$L=array();foreach($Qd[0]as$x=>$X){preg_match_all("~((?>\"[^\"]*\")+|[^$N]*)$N~",$X.$N,$Rd);if(!$x&&!array_diff($Rd[1],$hb)){$hb=$Rd[1];$ua--;}else{$P=array();foreach($Rd[1]as$r=>$eb)$P[idf_escape($hb[$r])]=($eb==""&&$q[$hb[$r]]["null"]?"NULL":q(str_replace('""','"',preg_replace('~^"|"$~','',$eb))));$L[]=$P;}}$I=(!$L||$n->insertUpdate($a,$L,$Pe));if($I)$I=$n->commit();queries_redirect(remove_from_uri("page"),lang(87,$ua),$I);$n->rollback();}}}$cg=$b->tableName($S);if(is_ajax()){page_headers();ob_start();}else
page_header(lang(49).": $cg",$o);$P=null;if(isset($pf["insert"])||!support("table")){$P="";foreach((array)$_GET["where"]as$X){if($Bc[$X["col"]]&&count($Bc[$X["col"]])==1&&($X["op"]=="="||(!$X["op"]&&!preg_match('~[_%]~',$X["val"]))))$P.="&set".urlencode("[".bracket_escape($X["col"])."]")."=".urlencode($X["val"]);}}$b->selectLinks($S,$P);if(!$f&&support("table"))echo"<p class='error'>".lang(88).($q?".":": ".error())."\n";else{echo"<form action='' id='form'>\n","<div style='display: none;'>";hidden_fields_get();echo(DB!=""?'<input type="hidden" name="db" value="'.h(DB).'">'.(isset($_GET["ns"])?'<input type="hidden" name="ns" value="'.h($_GET["ns"]).'">':""):"");echo'<input type="hidden" name="select" value="'.h($a).'">',"</div>\n";$b->selectColumnsPrint($M,$f);$b->selectSearchPrint($Z,$f,$v);$b->selectOrderPrint($C,$f,$v);$b->selectLimitPrint($y);$b->selectLengthPrint($jg);$b->selectActionPrint($v);echo"</form>\n";$D=$_GET["page"];if($D=="last"){$Dc=$h->result(count_rows($a,$Z,$qd,$Ic));$D=floor(max(0,$Dc-1)/$y);}$wf=$M;$Jc=$Ic;if(!$wf){$wf[]="*";$qb=convert_fields($f,$q,$M);if($qb)$wf[]=substr($qb,2);}foreach($M
as$x=>$X){$p=$q[idf_unescape($X)];if($p&&($_a=convert_field($p)))$wf[$x]="$_a AS $X";}if(!$qd&&$Lg){foreach($Lg
as$x=>$X){$wf[]=idf_escape($x);if($Jc)$Jc[]=idf_escape($x);}}$I=$n->select($a,$wf,$Z,$Jc,$C,$y,$D,true);if(!$I)echo"<p class='error'>".error()."\n";else{if($w=="mssql"&&$D)$I->seek($y*$D);$Tb=array();echo"<form action='' method='post' enctype='multipart/form-data'>\n";$L=array();while($K=$I->fetch_assoc()){if($D&&$w=="oracle")unset($K["RNUM"]);$L[]=$K;}if($_GET["page"]!="last"&&$y!=""&&$Ic&&$qd&&$w=="sql")$Dc=$h->result(" SELECT FOUND_ROWS()");if(!$L)echo"<p class='message'>".lang(12)."\n";else{$La=$b->backwardKeys($a,$cg);echo"<div class='scrollable'>","<table id='table' cellspacing='0' class='nowrap checkable'>",script("mixin(qs('#table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true), onkeydown: editingKeydown});"),"<thead><tr>".(!$Ic&&$M?"":"<td><input type='checkbox' id='all-page' class='jsonly'>".script("qs('#all-page').onclick = partial(formCheck, /check/);","")." <a href='".h($_GET["modify"]?remove_from_uri("modify"):$_SERVER["REQUEST_URI"]."&modify=1")."'>".lang(89)."</a>");$ee=array();$Hc=array();reset($M);$af=1;foreach($L[0]as$x=>$X){if(!isset($Lg[$x])){$X=$_GET["columns"][key($M)];$p=$q[$M?($X?$X["col"]:current($M)):$x];$A=($p?$b->fieldName($p,$af):($X["fun"]?"*":$x));if($A!=""){$af++;$ee[$x]=$A;$e=idf_escape($x);$Wc=remove_from_uri('(order|desc)[^=]*|page').'&order%5B0%5D='.urlencode($x);$Cb="&desc%5B0%5D=1";echo"<th>".script("mixin(qsl('th'), {onmouseover: partial(columnMouse), onmouseout: partial(columnMouse, ' hidden')});",""),'<a href="'.h($Wc.($C[0]==$e||$C[0]==$x||(!$C&&$qd&&$Ic[0]==$e)?$Cb:'')).'">';echo
apply_sql_function($X["fun"],$A)."</a>";echo"<span class='column hidden'>","<a href='".h($Wc.$Cb)."' title='".lang(90)."' class='text'> â†“</a>";if(!$X["fun"]){echo'<a href="#fieldset-search" title="'.lang(44).'" class="text jsonly"> =</a>',script("qsl('a').onclick = partial(selectSearch, '".js_escape($x)."');");}echo"</span>";}$Hc[$x]=$X["fun"];next($M);}}$Gd=array();if($_GET["modify"]){foreach($L
as$K){foreach($K
as$x=>$X)$Gd[$x]=max($Gd[$x],min(40,strlen(utf8_decode($X))));}}echo($La?"<th>".lang(91):"")."</thead>\n";if(is_ajax()){if($y%2==1&&$D%2==1)odd();ob_end_clean();}foreach($b->rowDescriptions($L,$Bc)as$de=>$K){$Ig=unique_array($L[$de],$v);if(!$Ig){$Ig=array();foreach($L[$de]as$x=>$X){if(!preg_match('~^(COUNT\((\*|(DISTINCT )?`(?:[^`]|``)+`)\)|(AVG|GROUP_CONCAT|MAX|MIN|SUM)\(`(?:[^`]|``)+`\))$~',$x))$Ig[$x]=$X;}}$Jg="";foreach($Ig
as$x=>$X){if(($w=="sql"||$w=="pgsql")&&preg_match('~char|text|enum|set~',$q[$x]["type"])&&strlen($X)>64){$x=(strpos($x,'(')?$x:idf_escape($x));$x="MD5(".($w!='sql'||preg_match("~^utf8~",$q[$x]["collation"])?$x:"CONVERT($x USING ".charset($h).")").")";$X=md5($X);}$Jg.="&".($X!==null?urlencode("where[".bracket_escape($x)."]")."=".urlencode($X):"null%5B%5D=".urlencode($x));}echo"<tr".odd().">".(!$Ic&&$M?"":"<td>".checkbox("check[]",substr($Jg,1),in_array(substr($Jg,1),(array)$_POST["check"])).($qd||information_schema(DB)?"":" <a href='".h(ME."edit=".urlencode($a).$Jg)."' class='edit'>".lang(92)."</a>"));foreach($K
as$x=>$X){if(isset($ee[$x])){$p=$q[$x];$X=$n->value($X,$p);if($X!=""&&(!isset($Tb[$x])||$Tb[$x]!=""))$Tb[$x]=(is_mail($X)?$ee[$x]:"");$z="";if(preg_match('~blob|bytea|raw|file~',$p["type"])&&$X!="")$z=ME.'download='.urlencode($a).'&field='.urlencode($x).$Jg;if(!$z&&$X!==null){foreach((array)$Bc[$x]as$Ac){if(count($Bc[$x])==1||end($Ac["source"])==$x){$z="";foreach($Ac["source"]as$r=>$Lf)$z.=where_link($r,$Ac["target"][$r],$L[$de][$Lf]);$z=($Ac["db"]!=""?preg_replace('~([?&]db=)[^&]+~','\1'.urlencode($Ac["db"]),ME):ME).'select='.urlencode($Ac["table"]).$z;if($Ac["ns"])$z=preg_replace('~([?&]ns=)[^&]+~','\1'.urlencode($Ac["ns"]),$z);if(count($Ac["source"])==1)break;}}}if($x=="COUNT(*)"){$z=ME."select=".urlencode($a);$r=0;foreach((array)$_GET["where"]as$W){if(!array_key_exists($W["col"],$Ig))$z.=where_link($r++,$W["col"],$W["val"],$W["op"]);}foreach($Ig
as$td=>$W)$z.=where_link($r++,$td,$W);}$X=select_value($X,$z,$p,$jg);$s=h("val[$Jg][".bracket_escape($x)."]");$Y=$_POST["val"][$Jg][bracket_escape($x)];$Pb=!is_array($K[$x])&&is_utf8($X)&&$L[$de][$x]==$K[$x]&&!$Hc[$x];$ig=preg_match('~text|lob~',$p["type"]);echo"<td id='$s'";if(($_GET["modify"]&&$Pb)||$Y!==null){$Mc=h($Y!==null?$Y:$K[$x]);echo">".($ig?"<textarea name='$s' cols='30' rows='".(substr_count($K[$x],"\n")+1)."'>$Mc</textarea>":"<input name='$s' value='$Mc' size='$Gd[$x]'>");}else{$Ld=strpos($X,"<i>â€¦</i>");echo" data-text='".($Ld?2:($ig?1:0))."'".($Pb?"":" data-warning='".h(lang(93))."'").">$X</td>";}}}if($La)echo"<td>";$b->backwardKeysPrint($La,$L[$de]);echo"</tr>\n";}if(is_ajax())exit;echo"</table>\n","</div>\n";}if(!is_ajax()){if($L||$D){$bc=true;if($_GET["page"]!="last"){if($y==""||(count($L)<$y&&($L||!$D)))$Dc=($D?$D*$y:0)+count($L);elseif($w!="sql"||!$qd){$Dc=($qd?false:found_rows($S,$Z));if($Dc<max(1e4,2*($D+1)*$y))$Dc=reset(slow_query(count_rows($a,$Z,$qd,$Ic)));else$bc=false;}}$Ae=($y!=""&&($Dc===false||$Dc>$y||$D));if($Ae){echo(($Dc===false?count($L)+1:$Dc-$D*$y)>$y?'<p><a href="'.h(remove_from_uri("page")."&page=".($D+1)).'" class="loadmore">'.lang(94).'</a>'.script("qsl('a').onclick = partial(selectLoadMore, ".(+$y).", '".lang(95)."â€¦');",""):''),"\n";}}echo"<div class='footer'><div>\n";if($L||$D){if($Ae){$Sd=($Dc===false?$D+(count($L)>=$y?2:1):floor(($Dc-1)/$y));echo"<fieldset>";if($w!="simpledb"){echo"<legend><a href='".h(remove_from_uri("page"))."'>".lang(96)."</a></legend>",script("qsl('a').onclick = function () { pageClick(this.href, +prompt('".lang(96)."', '".($D+1)."')); return false; };"),pagination(0,$D).($D>5?" â€¦":"");for($r=max(1,$D-4);$r<min($Sd,$D+5);$r++)echo
pagination($r,$D);if($Sd>0){echo($D+5<$Sd?" â€¦":""),($bc&&$Dc!==false?pagination($Sd,$D):" <a href='".h(remove_from_uri("page")."&page=last")."' title='~$Sd'>".lang(97)."</a>");}}else{echo"<legend>".lang(96)."</legend>",pagination(0,$D).($D>1?" â€¦":""),($D?pagination($D,$D):""),($Sd>$D?pagination($D+1,$D).($Sd>$D+1?" â€¦":""):"");}echo"</fieldset>\n";}echo"<fieldset>","<legend>".lang(98)."</legend>";$Hb=($bc?"":"~ ").$Dc;echo
checkbox("all",1,0,($Dc!==false?($bc?"":"~ ").lang(99,$Dc):""),"var checked = formChecked(this, /check/); selectCount('selected', this.checked ? '$Hb' : checked); selectCount('selected2', this.checked || !checked ? '$Hb' : checked);")."\n","</fieldset>\n";if($b->selectCommandPrint()){echo'<fieldset',($_GET["modify"]?'':' class="jsonly"'),'><legend>',lang(89),'</legend><div>
<input type="submit" value="',lang(14),'"',($_GET["modify"]?'':' title="'.lang(85).'"'),'>
</div></fieldset>
<fieldset><legend>',lang(100),' <span id="selected"></span></legend><div>
<input type="submit" name="edit" value="',lang(10),'">
<input type="submit" name="clone" value="',lang(101),'">
<input type="submit" name="delete" value="',lang(18),'">',confirm(),'</div></fieldset>
';}$Cc=$b->dumpFormat();foreach((array)$_GET["columns"]as$e){if($e["fun"]){unset($Cc['sql']);break;}}if($Cc){print_fieldset("export",lang(102)." <span id='selected2'></span>");$ze=$b->dumpOutput();echo($ze?html_select("output",$ze,$ta["output"])." ":""),html_select("format",$Cc,$ta["format"])," <input type='submit' name='export' value='".lang(102)."'>\n","</div></fieldset>\n";}$b->selectEmailPrint(array_filter($Tb,'strlen'),$f);}echo"</div></div>\n";if($b->selectImportPrint()){echo"<div>","<a href='#import'>".lang(103)."</a>",script("qsl('a').onclick = partial(toggle, 'import');",""),"<span id='import' class='hidden'>: ","<input type='file' name='csv_file'> ",html_select("separator",array("csv"=>"CSV,","csv;"=>"CSV;","tsv"=>"TSV"),$ta["format"],1);echo" <input type='submit' name='import' value='".lang(103)."'>","</span>","</div>";}echo"<input type='hidden' name='token' value='$ug'>\n","</form>\n",(!$Ic&&$M?"":script("tableCheck();"));}}}if(is_ajax()){ob_end_clean();exit;}}elseif(isset($_GET["script"])){if($_GET["script"]=="kill")$h->query("KILL ".number($_POST["kill"]));elseif(list($R,$s,$A)=$b->_foreignColumn(column_foreign_keys($_GET["source"]),$_GET["field"])){$y=11;$I=$h->query("SELECT $s, $A FROM ".table($R)." WHERE ".(preg_match('~^[0-9]+$~',$_GET["value"])?"$s = $_GET[value] OR ":"")."$A LIKE ".q("$_GET[value]%")." ORDER BY 2 LIMIT $y");for($r=1;($K=$I->fetch_row())&&$r<$y;$r++)echo"<a href='".h(ME."edit=".urlencode($R)."&where".urlencode("[".bracket_escape(idf_unescape($s))."]")."=".urlencode($K[0]))."'>".h($K[1])."</a><br>\n";if($K)echo"...\n";}exit;}else{page_header(lang(62),"",false);if($b->homepage()){echo"<form action='' method='post'>\n","<p>".lang(104).": <input type='search' name='query' value='".h($_POST["query"])."'> <input type='submit' value='".lang(44)."'>\n";if($_POST["query"]!="")search_tables();echo"<div class='scrollable'>\n","<table cellspacing='0' class='nowrap checkable'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),'<thead><tr class="wrap">','<td><input id="check-all" type="checkbox" class="jsonly">'.script("qs('#check-all').onclick = partial(formCheck, /^tables\[/);",""),'<th>'.lang(105),'<td>'.lang(106),"</thead>\n";foreach(table_status()as$R=>$K){$A=$b->tableName($K);if(isset($K["Engine"])&&$A!=""){echo'<tr'.odd().'><td>'.checkbox("tables[]",$R,in_array($R,(array)$_POST["tables"],true)),"<th><a href='".h(ME).'select='.urlencode($R)."'>$A</a>";$X=format_number($K["Rows"]);echo"<td align='right'><a href='".h(ME."edit=").urlencode($R)."'>".($K["Engine"]=="InnoDB"&&$X?"~ $X":$X)."</a>";}}echo"</table>\n","</div>\n","</form>\n",script("tableCheck();");}}page_footer();