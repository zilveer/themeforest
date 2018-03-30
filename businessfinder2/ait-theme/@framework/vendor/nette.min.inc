<?php //netteloader=Nette\Framework

/**
 * Nette Framework (version 2.0.16 released on 2014-08-28, http://nette.org)
 *
 * Copyright (c) 2004, 2014 David Grudl (http://davidgrudl.com)
 */
@empty($GLOBALS[0])&&$GLOBALS[0]=array();define('NETTE',TRUE);define('NETTE_DIR',dirname(__FILE__));define('NETTE_VERSION_ID',20016);define('NETTE_PACKAGE','PHP 5.2 prefixed');interface
ICacheStorage{function
read($key);function
lock($key);function
write($key,$data,array$dependencies);function
remove($key);function
clean(array$conditions);}interface
ICacheJournal{function
write($key,array$dependencies);function
clean(array$conditions);}interface
IFreezable{function
freeze();function
isFrozen();}interface
IMacro{function
initialize();function
finalize();function
nodeOpened(NMacroNode$node);function
nodeClosed(NMacroNode$node);}interface
IAnnotation{function
__construct(array$values);}interface
ITemplate{function
render();}interface
IFileTemplate
extends
ITemplate{function
setFile($file);function
getFile();}class
ArgumentOutOfRangeException
extends
InvalidArgumentException{}class
InvalidStateException
extends
RuntimeException{function
__construct($message='',$code=0,Exception$previous=NULL){if(PHP_VERSION_ID<50300){$this->previous=$previous;parent::__construct($message,$code);}else{parent::__construct($message,$code,$previous);}}}class
NotImplementedException
extends
LogicException{}class
NotSupportedException
extends
LogicException{}class
DeprecatedException
extends
NotSupportedException{}class
MemberAccessException
extends
LogicException{}class
IOException
extends
RuntimeException{}class
FileNotFoundException
extends
IOException{}class
DirectoryNotFoundException
extends
IOException{}class
NStaticClassException
extends
LogicException{}class
FatalErrorException
extends
Exception{private$severity;function
__construct($message,$code,$severity,$file,$line,$context,NException$previous=NULL){if(PHP_VERSION_ID<50300){$this->previous=$previous;parent::__construct($message,$code);}else{parent::__construct($message,$code,$previous);}$this->severity=$severity;$this->file=$file;$this->line=$line;$this->context=$context;}function
getSeverity(){return$this->severity;}}abstract
class
NObject{function
getReflection(){return
new
NClassReflection($this);}function
__call($name,$args){return
NObjectMixin::call($this,$name,$args);}static
function
__callStatic($name,$args){return
NObjectMixin::callStatic(get_called_class(),$name,$args);}static
function
extensionMethod($name,$callback=NULL){if(strpos($name,'::')===FALSE){$class=get_called_class();}else{list($class,$name)=explode('::',$name);}$class=new
NClassReflection($class);if($callback===NULL){return$class->getExtensionMethod($name);}else{$class->setExtensionMethod($name,$callback);}}function&__get($name){return
NObjectMixin::get($this,$name);}function
__set($name,$value){NObjectMixin::set($this,$name,$value);}function
__isset($name){return
NObjectMixin::has($this,$name);}function
__unset($name){NObjectMixin::remove($this,$name);}}class
NLimitedScope{final
function
__construct(){throw
new
NStaticClassException;}static
function
evaluate(){if(func_num_args()>1){foreach(func_get_arg(1)as$__k=>$__v)$$__k=$__v;unset($__k,$__v);}$res=eval('?>'.func_get_arg(0));if($res===FALSE&&($error=error_get_last())&&$error['type']===E_PARSE){throw
new
FatalErrorException($error['message'],0,$error['type'],$error['file'],$error['line'],NULL);}return$res;}static
function
load(){if(func_num_args()>1){if(func_get_arg(1)===TRUE){return require func_get_arg(0);}foreach(func_get_arg(1)as$__k=>$__v)$$__k=$__v;unset($__k,$__v);}return require func_get_arg(0);}}abstract
class
NAutoLoader
extends
NObject{static
private$loaders=array();public
static$count=0;static
function
load($type){foreach(func_get_args()as$type){if(!class_exists($type)){throw
new
InvalidStateException("Unable to load class or interface '$type'.");}}}static
function
getLoaders(){return
array_values(self::$loaders);}function
register(){if(!function_exists('spl_autoload_register')){throw
new
NotSupportedException('spl_autoload does not exist in this PHP installation.');}spl_autoload_register(array($this,'tryLoad'));self::$loaders[spl_object_hash($this)]=$this;}function
unregister(){unset(self::$loaders[spl_object_hash($this)]);return
spl_autoload_unregister(array($this,'tryLoad'));}abstract
function
tryLoad($type);}class
NHtml
extends
NObject
implements
ArrayAccess,Countable,IteratorAggregate{private$name;private$isEmpty;public$attrs=array();protected$children=array();public
static$xhtml=TRUE;public
static$emptyElements=array('img'=>1,'hr'=>1,'br'=>1,'input'=>1,'meta'=>1,'area'=>1,'embed'=>1,'keygen'=>1,'source'=>1,'base'=>1,'col'=>1,'link'=>1,'param'=>1,'basefont'=>1,'frame'=>1,'isindex'=>1,'wbr'=>1,'command'=>1,'track'=>1);static
function
el($name=NULL,$attrs=NULL){$el=new
self;$parts=explode(' ',$name,2);$el->setName($parts[0]);if(is_array($attrs)){$el->attrs=$attrs;}elseif($attrs!==NULL){$el->setText($attrs);}if(isset($parts[1])){foreach(NStrings::matchAll($parts[1].' ','#([a-z0-9:-]+)(?:=(["\'])?(.*?)(?(2)\\2|\s))?#i')as$m){$el->attrs[$m[1]]=isset($m[3])?$m[3]:TRUE;}}return$el;}function
setName($name,$isEmpty=NULL){if($name!==NULL&&!is_string($name)){throw
new
InvalidArgumentException(sprintf('Name must be string or NULL, %s given.',gettype($name)));}$this->name=$name;$this->isEmpty=$isEmpty===NULL?isset(self::$emptyElements[$name]):(bool)$isEmpty;return$this;}function
getName(){return$this->name;}function
isEmpty(){return$this->isEmpty;}function
addAttributes(array$attrs){$this->attrs=$attrs+$this->attrs;return$this;}function
__set($name,$value){$this->attrs[$name]=$value;}function&__get($name){return$this->attrs[$name];}function
__isset($name){return
isset($this->attrs[$name]);}function
__unset($name){unset($this->attrs[$name]);}function
__call($m,$args){$p=substr($m,0,3);if($p==='get'||$p==='set'||$p==='add'){$m=substr($m,3);$m[0]=$m[0]|"\x20";if($p==='get'){return
isset($this->attrs[$m])?$this->attrs[$m]:NULL;}elseif($p==='add'){$args[]=TRUE;}}if(count($args)===0){}elseif(count($args)===1){$this->attrs[$m]=$args[0];}elseif((string)$args[0]===''){$tmp=&$this->attrs[$m];}elseif(!isset($this->attrs[$m])||is_array($this->attrs[$m])){$this->attrs[$m][$args[0]]=$args[1];}else{$this->attrs[$m]=array($this->attrs[$m],$args[0]=>$args[1]);}return$this;}function
href($path,$query=NULL){if($query){$query=http_build_query($query,NULL,'&');if($query!==''){$path.='?'.$query;}}$this->attrs['href']=$path;return$this;}function
setHtml($html){if($html===NULL){$html='';}elseif(is_array($html)){throw
new
InvalidArgumentException(sprintf('Textual content must be a scalar, %s given.',gettype($html)));}else{$html=(string)$html;}$this->removeChildren();$this->children[]=$html;return$this;}function
getHtml(){$s='';foreach($this->children
as$child){if(is_object($child)){$s.=$child->render();}else{$s.=$child;}}return$s;}function
setText($text){if(!is_array($text)){$text=htmlspecialchars((string)$text,ENT_NOQUOTES);}return$this->setHtml($text);}function
getText(){return
html_entity_decode(strip_tags($this->getHtml()),ENT_QUOTES,'UTF-8');}function
add($child){return$this->insert(NULL,$child);}function
create($name,$attrs=NULL){$this->insert(NULL,$child=self::el($name,$attrs));return$child;}function
insert($index,$child,$replace=FALSE){if($child
instanceof
NHtml||is_scalar($child)){if($index===NULL){$this->children[]=$child;}else{array_splice($this->children,(int)$index,$replace?1:0,array($child));}}else{throw
new
InvalidArgumentException(sprintf('Child node must be scalar or Html object, %s given.',is_object($child)?get_class($child):gettype($child)));}return$this;}function
offsetSet($index,$child){$this->insert($index,$child,TRUE);}function
offsetGet($index){return$this->children[$index];}function
offsetExists($index){return
isset($this->children[$index]);}function
offsetUnset($index){if(isset($this->children[$index])){array_splice($this->children,(int)$index,1);}}function
count(){return
count($this->children);}function
removeChildren(){$this->children=array();}function
getIterator($deep=FALSE){if($deep){$deep=$deep>0?RecursiveIteratorIterator::SELF_FIRST:RecursiveIteratorIterator::CHILD_FIRST;return
new
RecursiveIteratorIterator(new
NGenericRecursiveIterator(new
ArrayIterator($this->children)),$deep);}else{return
new
NGenericRecursiveIterator(new
ArrayIterator($this->children));}}function
getChildren(){return$this->children;}function
render($indent=NULL){$s=$this->startTag();if(!$this->isEmpty){if($indent!==NULL){$indent++;}foreach($this->children
as$child){if(is_object($child)){$s.=$child->render($indent);}else{$s.=$child;}}$s.=$this->endTag();}if($indent!==NULL){return"\n".str_repeat("\t",$indent-1).$s."\n".str_repeat("\t",max(0,$indent-2));}return$s;}function
__toString(){return$this->render();}function
startTag(){if($this->name){return'<'.$this->name.$this->attributes().(self::$xhtml&&$this->isEmpty?' />':'>');}else{return'';}}function
endTag(){return$this->name&&!$this->isEmpty?'</'.$this->name.'>':'';}function
attributes(){if(!is_array($this->attrs)){return'';}$s='';foreach($this->attrs
as$key=>$value){if($value===NULL||$value===FALSE){continue;}elseif($value===TRUE){if(self::$xhtml){$s.=' '.$key.'="'.$key.'"';}else{$s.=' '.$key;}continue;}elseif(is_array($value)){if($key==='data'){foreach($value
as$k=>$v){if($v!==NULL&&$v!==FALSE){$q=strpos($v,'"')===FALSE?'"':"'";$s.=' data-'.$k.'='.$q.str_replace(array('&',$q),array('&amp;',$q==='"'?'&quot;':'&#39;'),$v).(strpos($v,'`')!==FALSE&&strpbrk($v,' <>"\'')===FALSE?' ':'').$q;}}continue;}$tmp=NULL;foreach($value
as$k=>$v){if($v!=NULL){$tmp[]=$v===TRUE?$k:(is_string($k)?$k.':'.$v:$v);}}if($tmp===NULL){continue;}$value=implode($key==='style'||!strncmp($key,'on',2)?';':' ',$tmp);}else{$value=(string)$value;}$q=strpos($value,'"')===FALSE?'"':"'";$s.=' '.$key.'='.$q.str_replace(array('&',$q),array('&amp;',$q==='"'?'&quot;':'&#39;'),$value).(strpos($value,'`')!==FALSE&&strpbrk($value,' <>"\'')===FALSE?' ':'').$q;}$s=str_replace('@','&#64;',$s);return$s;}function
__clone(){foreach($this->children
as$key=>$value){if(is_object($value)){$this->children[$key]=clone$value;}}}}class
NSafeStream{const
PROTOCOL='safe';private$handle;private$tempHandle;private$file;private$tempFile;private$deleteFile;private$writeError=FALSE;static
function
register(){return
stream_wrapper_register(self::PROTOCOL,__CLASS__);}function
stream_open($path,$mode,$options,&$opened_path){$path=substr($path,strlen(self::PROTOCOL)+3);$flag=trim($mode,'crwax+');$mode=trim($mode,'tb');$use_path=(bool)(STREAM_USE_PATH&$options);if($mode==='r'){return$this->checkAndLock($this->tempHandle=fopen($path,'r'.$flag,$use_path),LOCK_SH);}elseif($mode==='r+'){if(!$this->checkAndLock($this->handle=fopen($path,'r'.$flag,$use_path),LOCK_EX)){return
FALSE;}}elseif($mode[0]==='x'){if(!$this->checkAndLock($this->handle=fopen($path,'x'.$flag,$use_path),LOCK_EX)){return
FALSE;}$this->deleteFile=TRUE;}elseif($mode[0]==='w'||$mode[0]==='a'||$mode[0]==='c'){if($this->checkAndLock($this->handle=@fopen($path,'x'.$flag,$use_path),LOCK_EX)){$this->deleteFile=TRUE;}elseif(!$this->checkAndLock($this->handle=fopen($path,'a+'.$flag,$use_path),LOCK_EX)){return
FALSE;}}else{trigger_error("Unknown mode $mode",E_USER_WARNING);return
FALSE;}$tmp='~~'.lcg_value().'.tmp';if(!$this->tempHandle=fopen($path.$tmp,(strpos($mode,'+')?'x+':'x').$flag,$use_path)){$this->clean();return
FALSE;}$this->tempFile=realpath($path.$tmp);$this->file=substr($this->tempFile,0,-strlen($tmp));if($mode==='r+'||$mode[0]==='a'||$mode[0]==='c'){$stat=fstat($this->handle);fseek($this->handle,0);if($stat['size']!==0&&stream_copy_to_stream($this->handle,$this->tempHandle)!==$stat['size']){$this->clean();return
FALSE;}if($mode[0]==='a'){fseek($this->tempHandle,0,SEEK_END);}}return
TRUE;}private
function
checkAndLock($handle,$lock){if(!$handle){return
FALSE;}elseif(!flock($handle,$lock)){fclose($handle);return
FALSE;}return
TRUE;}private
function
clean(){flock($this->handle,LOCK_UN);fclose($this->handle);if($this->deleteFile){unlink($this->file);}if($this->tempHandle){fclose($this->tempHandle);unlink($this->tempFile);}}function
stream_close(){if(!$this->tempFile){flock($this->tempHandle,LOCK_UN);fclose($this->tempHandle);return;}flock($this->handle,LOCK_UN);fclose($this->handle);fclose($this->tempHandle);if($this->writeError||!(substr(PHP_OS,0,3)==='WIN'?unlink($this->file):TRUE)||!rename($this->tempFile,$this->file)){unlink($this->tempFile);if($this->deleteFile){unlink($this->file);}}}function
stream_read($length){return
fread($this->tempHandle,$length);}function
stream_write($data){$len=strlen($data);$res=fwrite($this->tempHandle,$data,$len);if($res!==$len){$this->writeError=TRUE;}return$res;}function
stream_tell(){return
ftell($this->tempHandle);}function
stream_eof(){return
feof($this->tempHandle);}function
stream_seek($offset,$whence){return
fseek($this->tempHandle,$offset,$whence)===0;}function
stream_stat(){return
fstat($this->tempHandle);}function
url_stat($path,$flags){$path=substr($path,strlen(self::PROTOCOL)+3);return($flags&STREAM_URL_STAT_LINK)?@lstat($path):@stat($path);}function
unlink($path){$path=substr($path,strlen(self::PROTOCOL)+3);return
unlink($path);}}class
NCache
extends
NObject
implements
ArrayAccess{const
PRIORITY='priority',EXPIRATION='expire',EXPIRE='expire',SLIDING='sliding',TAGS='tags',FILES='files',ITEMS='items',CONSTS='consts',CALLBACKS='callbacks',ALL='all';const
NAMESPACE_SEPARATOR="\x00";private$storage;private$namespace;private$key;private$data;function
__construct(ICacheStorage$storage,$namespace=NULL){$this->storage=$storage;$this->namespace=$namespace.self::NAMESPACE_SEPARATOR;}function
getStorage(){return$this->storage;}function
getNamespace(){return(string)substr($this->namespace,0,-1);}function
derive($namespace){$derived=new
self($this->storage,$this->namespace.$namespace);return$derived;}function
load($key,$fallback=NULL){$data=$this->storage->read($this->generateKey($key));if($data===NULL&&$fallback){return$this->save($key,new
NCallback($fallback));}return$data;}function
save($key,$data,array$dependencies=NULL){$this->release();$key=$this->generateKey($key);if($data
instanceof
NCallback||$data
instanceof
Closure){$this->storage->lock($key);$data=NCallback::create($data)->invokeArgs(array(&$dependencies));}if($data===NULL){$this->storage->remove($key);}else{$this->storage->write($key,$data,$this->completeDependencies($dependencies,$data));return$data;}}private
function
completeDependencies($dp,$data){if(is_object($data)){$dp[self::CALLBACKS][]=array(array(__CLASS__,'checkSerializationVersion'),get_class($data),NClassReflection::from($data)->getAnnotation('serializationVersion'));}if(isset($dp[NCache::EXPIRATION])){$dp[NCache::EXPIRATION]=NDateTime53::from($dp[NCache::EXPIRATION])->format('U')-time();}if(isset($dp[self::FILES])){foreach(array_unique((array)$dp[self::FILES])as$item){$dp[self::CALLBACKS][]=array(array(__CLASS__,'checkFile'),$item,@filemtime($item));}unset($dp[self::FILES]);}if(isset($dp[self::ITEMS])){$dp[self::ITEMS]=array_unique(array_map(array($this,'generateKey'),(array)$dp[self::ITEMS]));}if(isset($dp[self::CONSTS])){foreach(array_unique((array)$dp[self::CONSTS])as$item){$dp[self::CALLBACKS][]=array(array(__CLASS__,'checkConst'),$item,constant($item));}unset($dp[self::CONSTS]);}if(!is_array($dp)){$dp=array();}return$dp;}function
remove($key){$this->save($key,NULL);}function
clean(array$conditions=NULL){$this->release();$this->storage->clean((array)$conditions);}function
call($function){$key=func_get_args();return$this->load($key,create_function('','extract($GLOBALS[0]['.array_push($GLOBALS[0],array('function'=>$function,'key'=>$key)).'-1], EXTR_REFS);
			return NCallback::create($function)->invokeArgs(array_slice($key, 1));
		'));}function
wrap($function,array$dependencies=NULL){$cache=$this;return
create_function('','extract($GLOBALS[0]['.array_push($GLOBALS[0],array('cache'=>$cache,'function'=>$function,'dependencies'=>$dependencies)).'-1], EXTR_REFS);
			$_args=func_get_args(); $key = array($function, $_args);
			$data = $cache->load($key);
			if ($data === NULL) {
				$data = $cache->save($key, NCallback::create($function)->invokeArgs($key[1]), $dependencies);
			}
			return $data;
		');}function
start($key){$data=$this->load($key);if($data===NULL){return
new
NCachingHelper($this,$key);}echo$data;}protected
function
generateKey($key){return$this->namespace.md5(is_scalar($key)?$key:serialize($key));}function
offsetSet($key,$data){$this->save($key,$data);}function
offsetGet($key){$key=is_scalar($key)?(string)$key:serialize($key);if($this->key!==$key){$this->key=$key;$this->data=$this->load($key);}return$this->data;}function
offsetExists($key){$this->release();return$this->offsetGet($key)!==NULL;}function
offsetUnset($key){$this->save($key,NULL);}function
release(){$this->key=$this->data=NULL;}static
function
checkCallbacks($callbacks){foreach($callbacks
as$callback){if(!call_user_func_array(array_shift($callback),$callback)){return
FALSE;}}return
TRUE;}private
static
function
checkConst($const,$value){return
defined($const)&&constant($const)===$value;}private
static
function
checkFile($file,$time){return@filemtime($file)==$time;}private
static
function
checkSerializationVersion($class,$value){return
NClassReflection::from($class)->getAnnotation('serializationVersion')===$value;}}class
NCachingHelper
extends
NObject{public$dependencies;private$cache;private$key;function
__construct(NCache$cache,$key){$this->cache=$cache;$this->key=$key;ob_start();}function
end(array$dependencies=NULL){if($this->cache===NULL){throw
new
InvalidStateException('Output cache has already been saved.');}$this->cache->save($this->key,ob_get_flush(),(array)$dependencies+(array)$this->dependencies);$this->cache=NULL;}}class
NDevNullStorage
extends
NObject
implements
ICacheStorage{function
read($key){}function
lock($key){}function
write($key,$data,array$dependencies){}function
remove($key){}function
clean(array$conditions){}}class
NFileJournal
extends
NObject
implements
ICacheJournal{const
FILE='btfj.dat';const
FILE_MAGIC=0x6274666A;const
INDEX_MAGIC=0x696E6465;const
DATA_MAGIC=0x64617461;const
NODE_SIZE=4096;const
BITROT=12;const
HEADER_SIZE=4096;const
INT32_SIZE=4;const
INFO='i',TYPE='t',IS_LEAF='il',PREV_NODE='p',END='e',MAX='m',INDEX_DATA='id',LAST_INDEX='l';const
TAGS='t',PRIORITY='p',ENTRIES='e';const
DATA='d',KEY='k',DELETED='d';public
static$debug=FALSE;private$file;private$handle;private$lastNode=2;private$processIdentifier;private$nodeCache=array();private$nodeChanged=array();private$toCommit=array();private$deletedLinks=array();private$dataNodeFreeSpace=array();private
static$startNode=array(self::TAGS=>0,self::PRIORITY=>1,self::ENTRIES=>2,self::DATA=>3);function
__construct($dir){$this->file=$dir.'/'.self::FILE;}function
__destruct(){if($this->handle){$this->headerCommit();flock($this->handle,LOCK_UN);fclose($this->handle);$this->handle=FALSE;}}function
write($key,array$dependencies){$this->lock();$priority=!isset($dependencies[NCache::PRIORITY])?FALSE:(int)$dependencies[NCache::PRIORITY];$tags=empty($dependencies[NCache::TAGS])?FALSE:(array)$dependencies[NCache::TAGS];$exists=FALSE;$keyHash=crc32($key);list($entriesNodeId,$entriesNode)=$this->findIndexNode(self::ENTRIES,$keyHash);if(isset($entriesNode[$keyHash])){$entries=$this->mergeIndexData($entriesNode[$keyHash]);foreach($entries
as$link=>$foo){$dataNode=$this->getNode($link>>self::BITROT);if($dataNode[$link][self::KEY]===$key){if($dataNode[$link][self::TAGS]==$tags&&$dataNode[$link][self::PRIORITY]===$priority){if($dataNode[$link][self::DELETED]){$dataNode[$link][self::DELETED]=FALSE;$this->saveNode($link>>self::BITROT,$dataNode);}$exists=TRUE;}else{$toDelete=array();foreach($dataNode[$link][self::TAGS]as$tag){$toDelete[self::TAGS][$tag][$link]=TRUE;}if($dataNode[$link][self::PRIORITY]!==FALSE){$toDelete[self::PRIORITY][$dataNode[$link][self::PRIORITY]][$link]=TRUE;}$toDelete[self::ENTRIES][$keyHash][$link]=TRUE;$this->cleanFromIndex($toDelete);unset($dataNode[$link]);$this->saveNode($link>>self::BITROT,$dataNode);list($entriesNodeId,$entriesNode)=$this->findIndexNode(self::ENTRIES,$keyHash);}break;}}}if($exists===FALSE){$requiredSize=strlen($key)+75;if($tags){foreach($tags
as$tag){$requiredSize+=strlen($tag)+13;}}$requiredSize+=$priority?10:1;$freeDataNode=$this->findFreeDataNode($requiredSize);$data=$this->getNode($freeDataNode);if($data===FALSE){$data=array(self::INFO=>array(self::LAST_INDEX=>($freeDataNode<<self::BITROT),self::TYPE=>self::DATA));}$dataNodeKey=$this->findNextFreeKey($freeDataNode,$data);$data[$dataNodeKey]=array(self::KEY=>$key,self::TAGS=>$tags?$tags:array(),self::PRIORITY=>$priority,self::DELETED=>FALSE);$this->saveNode($freeDataNode,$data);$entriesNode[$keyHash][$dataNodeKey]=1;$this->saveNode($entriesNodeId,$entriesNode);if($tags){foreach($tags
as$tag){list($nodeId,$node)=$this->findIndexNode(self::TAGS,$tag);$node[$tag][$dataNodeKey]=1;$this->saveNode($nodeId,$node);}}if($priority!==FALSE){list($nodeId,$node)=$this->findIndexNode(self::PRIORITY,$priority);$node[$priority][$dataNodeKey]=1;$this->saveNode($nodeId,$node);}}$this->commit();$this->unlock();}function
clean(array$conditions){$this->lock();if(!empty($conditions[NCache::ALL])){$this->nodeCache=$this->nodeChanged=$this->dataNodeFreeSpace=array();$this->deleteAll();$this->unlock();return
NULL;}$toDelete=array(self::TAGS=>array(),self::PRIORITY=>array(),self::ENTRIES=>array());$entries=array();if(!empty($conditions[NCache::TAGS])){$entries=$this->cleanTags((array)$conditions[NCache::TAGS],$toDelete);}if(isset($conditions[NCache::PRIORITY])){$this->arrayAppend($entries,$this->cleanPriority((int)$conditions[NCache::PRIORITY],$toDelete));}$this->deletedLinks=array();$this->cleanFromIndex($toDelete);$this->commit();$this->unlock();return$entries;}private
function
cleanTags(array$tags,array&$toDelete){$entries=array();foreach($tags
as$tag){list(,$node)=$this->findIndexNode(self::TAGS,$tag);if(isset($node[$tag])){$ent=$this->cleanLinks($this->mergeIndexData($node[$tag]),$toDelete);$this->arrayAppend($entries,$ent);}}return$entries;}private
function
cleanPriority($priority,array&$toDelete){list(,$node)=$this->findIndexNode(self::PRIORITY,$priority);ksort($node);$allData=array();foreach($node
as$prior=>$data){if($prior===self::INFO){continue;}elseif($prior>$priority){break;}$this->arrayAppendKeys($allData,$this->mergeIndexData($data));}$nodeInfo=$node[self::INFO];while($nodeInfo[self::PREV_NODE]!==-1){$nodeId=$nodeInfo[self::PREV_NODE];$node=$this->getNode($nodeId);if($node===FALSE){if(self::$debug){throw
new
InvalidStateException("Cannot load node number $nodeId.");}break;}$nodeInfo=$node[self::INFO];unset($node[self::INFO]);foreach($node
as$data){$this->arrayAppendKeys($allData,$this->mergeIndexData($data));}}return$this->cleanLinks($allData,$toDelete);}private
function
cleanLinks(array$data,array&$toDelete){$return=array();$data=array_keys($data);sort($data);$max=count($data);$data[]=0;$i=0;while($i<$max){$searchLink=$data[$i];if(isset($this->deletedLinks[$searchLink])){++$i;continue;}$nodeId=$searchLink>>self::BITROT;$node=$this->getNode($nodeId);if($node===FALSE){if(self::$debug){throw
new
InvalidStateException("Cannot load node number $nodeId.");}++$i;continue;}do{$link=$data[$i];if(!isset($node[$link])){if(self::$debug){throw
new
InvalidStateException("Link with ID $searchLink is not in node $nodeId.");}continue;}elseif(isset($this->deletedLinks[$link])){continue;}$nodeLink=&$node[$link];if(!$nodeLink[self::DELETED]){$nodeLink[self::DELETED]=TRUE;$return[]=$nodeLink[self::KEY];}else{foreach($nodeLink[self::TAGS]as$tag){$toDelete[self::TAGS][$tag][$link]=TRUE;}if($nodeLink[self::PRIORITY]!==FALSE){$toDelete[self::PRIORITY][$nodeLink[self::PRIORITY]][$link]=TRUE;}$toDelete[self::ENTRIES][crc32($nodeLink[self::KEY])][$link]=TRUE;unset($node[$link]);$this->deletedLinks[$link]=TRUE;}}while(($data[++$i]>>self::BITROT)===$nodeId);$this->saveNode($nodeId,$node);}return$return;}private
function
cleanFromIndex(array$toDeleteFromIndex){foreach($toDeleteFromIndex
as$type=>$toDelete){ksort($toDelete);while(!empty($toDelete)){reset($toDelete);$searchKey=key($toDelete);list($masterNodeId,$masterNode)=$this->findIndexNode($type,$searchKey);if(!isset($masterNode[$searchKey])){if(self::$debug){throw
new
InvalidStateException('Bad index.');}unset($toDelete[$searchKey]);continue;}foreach($toDelete
as$key=>$links){if(isset($masterNode[$key])){foreach($links
as$link=>$foo){if(isset($masterNode[$key][$link])){unset($masterNode[$key][$link],$links[$link]);}}if(!empty($links)&&isset($masterNode[$key][self::INDEX_DATA])){$this->cleanIndexData($masterNode[$key][self::INDEX_DATA],$links,$masterNode[$key]);}if(empty($masterNode[$key])){unset($masterNode[$key]);}unset($toDelete[$key]);}else{break;}}$this->saveNode($masterNodeId,$masterNode);}}}private
function
mergeIndexData(array$data){while(isset($data[self::INDEX_DATA])){$id=$data[self::INDEX_DATA];unset($data[self::INDEX_DATA]);$childNode=$this->getNode($id);if($childNode===FALSE){if(self::$debug){throw
new
InvalidStateException("Cannot load node number $id.");}break;}$this->arrayAppendKeys($data,$childNode[self::INDEX_DATA]);}return$data;}private
function
cleanIndexData($nextNodeId,array$links,&$masterNodeLink){$prev=-1;while($nextNodeId&&!empty($links)){$nodeId=$nextNodeId;$node=$this->getNode($nodeId);if($node===FALSE){if(self::$debug){throw
new
InvalidStateException("Cannot load node number $nodeId.");}break;}foreach($links
as$link=>$foo){if(isset($node[self::INDEX_DATA][$link])){unset($node[self::INDEX_DATA][$link],$links[$link]);}}if(isset($node[self::INDEX_DATA][self::INDEX_DATA])){$nextNodeId=$node[self::INDEX_DATA][self::INDEX_DATA];}else{$nextNodeId=FALSE;}if(empty($node[self::INDEX_DATA])||(count($node[self::INDEX_DATA])===1&&$nextNodeId)){if($prev===-1){if($nextNodeId===FALSE){unset($masterNodeLink[self::INDEX_DATA]);}else{$masterNodeLink[self::INDEX_DATA]=$nextNodeId;}}else{$prevNode=$this->getNode($prev);if($prevNode===FALSE){if(self::$debug){throw
new
InvalidStateException("Cannot load node number $prev.");}}else{if($nextNodeId===FALSE){unset($prevNode[self::INDEX_DATA][self::INDEX_DATA]);if(empty($prevNode[self::INDEX_DATA])){unset($prevNode[self::INDEX_DATA]);}}else{$prevNode[self::INDEX_DATA][self::INDEX_DATA]=$nextNodeId;}$this->saveNode($prev,$prevNode);}}unset($node[self::INDEX_DATA]);}else{$prev=$nodeId;}$this->saveNode($nodeId,$node);}}private
function
getNode($id){if(isset($this->nodeCache[$id])){return$this->nodeCache[$id];}$binary=stream_get_contents($this->handle,self::NODE_SIZE,self::HEADER_SIZE+self::NODE_SIZE*$id);if(empty($binary)){return
FALSE;}list(,$magic,$length)=unpack('N2',$binary);if($magic!==self::INDEX_MAGIC&&$magic!==self::DATA_MAGIC){if(!empty($magic)){if(self::$debug){throw
new
InvalidStateException("Node $id has malformed header.");}$this->deleteNode($id);}return
FALSE;}$data=substr($binary,2*self::INT32_SIZE,$length-2*self::INT32_SIZE);$node=@unserialize($data);if($node===FALSE){$this->deleteNode($id);if(self::$debug){throw
new
InvalidStateException("Cannot unserialize node number $id.");}return
FALSE;}return$this->nodeCache[$id]=$node;}private
function
saveNode($id,array$node){if(count($node)===1){$nodeInfo=$node[self::INFO];if($nodeInfo[self::TYPE]!==self::DATA){if($nodeInfo[self::END]!==-1){$this->nodeCache[$id]=$node;$this->nodeChanged[$id]=TRUE;return;}if($nodeInfo[self::MAX]===-1){$max=PHP_INT_MAX;}else{$max=$nodeInfo[self::MAX];}list(,,$parentId)=$this->findIndexNode($nodeInfo[self::TYPE],$max,$id);if($parentId!==-1&&$parentId!==$id){$parentNode=$this->getNode($parentId);if($parentNode===FALSE){if(self::$debug){throw
new
InvalidStateException("Cannot load node number $parentId.");}}else{if($parentNode[self::INFO][self::END]===$id){if(count($parentNode)===1){$parentNode[self::INFO][self::END]=-1;}else{end($parentNode);$lastKey=key($parentNode);$parentNode[self::INFO][self::END]=$parentNode[$lastKey];unset($parentNode[$lastKey]);}}else{unset($parentNode[$nodeInfo[self::MAX]]);}$this->saveNode($parentId,$parentNode);}}if($nodeInfo[self::TYPE]===self::PRIORITY){if($nodeInfo[self::MAX]===-1){if($nodeInfo[self::PREV_NODE]!==-1){$prevNode=$this->getNode($nodeInfo[self::PREV_NODE]);if($prevNode===FALSE){if(self::$debug){throw
new
InvalidStateException("Cannot load node number {$nodeInfo[self::PREV_NODE]}.");}}else{$prevNode[self::INFO][self::MAX]=-1;$this->saveNode($nodeInfo[self::PREV_NODE],$prevNode);}}}else{list($nextId,$nextNode)=$this->findIndexNode($nodeInfo[self::TYPE],$nodeInfo[self::MAX]+1,NULL,$id);if($nextId!==-1&&$nextId!==$id){$nextNode[self::INFO][self::PREV_NODE]=$nodeInfo[self::PREV_NODE];$this->saveNode($nextId,$nextNode);}}}}$this->nodeCache[$id]=FALSE;}else{$this->nodeCache[$id]=$node;}$this->nodeChanged[$id]=TRUE;}private
function
commit(){do{foreach($this->nodeChanged
as$id=>$foo){if($this->prepareNode($id,$this->nodeCache[$id])){unset($this->nodeChanged[$id]);}}}while(!empty($this->nodeChanged));foreach($this->toCommit
as$node=>$str){$this->commitNode($node,$str);}$this->toCommit=array();}private
function
prepareNode($id,$node){if($node===FALSE){if($id<$this->lastNode){$this->lastNode=$id;}unset($this->nodeCache[$id]);unset($this->dataNodeFreeSpace[$id]);$this->deleteNode($id);return
TRUE;}$data=serialize($node);$dataSize=strlen($data)+2*self::INT32_SIZE;$isData=$node[self::INFO][self::TYPE]===self::DATA;if($dataSize>self::NODE_SIZE){if($isData){throw
new
InvalidStateException('Saving node is bigger than maximum node size.');}else{$this->bisectNode($id,$node);return
FALSE;}}$this->toCommit[$id]=pack('N2',$isData?self::DATA_MAGIC:self::INDEX_MAGIC,$dataSize).$data;if($this->lastNode<$id){$this->lastNode=$id;}if($isData){$this->dataNodeFreeSpace[$id]=self::NODE_SIZE-$dataSize;}return
TRUE;}private
function
commitNode($id,$str){fseek($this->handle,self::HEADER_SIZE+self::NODE_SIZE*$id);$written=fwrite($this->handle,$str);if($written===FALSE){throw
new
InvalidStateException("Cannot write node number $id to journal.");}}private
function
findIndexNode($type,$search,$childId=NULL,$prevId=NULL){$nodeId=self::$startNode[$type];$parentId=-1;while(TRUE){$node=$this->getNode($nodeId);if($node===FALSE){return
array($nodeId,array(self::INFO=>array(self::TYPE=>$type,self::IS_LEAF=>TRUE,self::PREV_NODE=>-1,self::END=>-1,self::MAX=>-1)),$parentId);}if($node[self::INFO][self::IS_LEAF]||$nodeId===$childId||$node[self::INFO][self::PREV_NODE]===$prevId){return
array($nodeId,$node,$parentId);}$parentId=$nodeId;if(isset($node[$search])){$nodeId=$node[$search];}else{foreach($node
as$key=>$childNode){if($key>$search&&$key!==self::INFO){$nodeId=$childNode;continue
2;}}$nodeId=$node[self::INFO][self::END];}}}private
function
findFreeNode($count=1){$id=$this->lastNode;$nodesId=array();do{if(isset($this->nodeCache[$id])){++$id;continue;}$offset=self::HEADER_SIZE+self::NODE_SIZE*$id;$binary=stream_get_contents($this->handle,self::INT32_SIZE,$offset);if(empty($binary)){$nodesId[]=$id;}else{list(,$magic)=unpack('N',$binary);if($magic!==self::INDEX_MAGIC&&$magic!==self::DATA_MAGIC){$nodesId[]=$id;}}++$id;}while(count($nodesId)!==$count);if($count===1){return$nodesId[0];}else{return$nodesId;}}private
function
findFreeDataNode($size){foreach($this->dataNodeFreeSpace
as$id=>$freeSpace){if($freeSpace>$size){return$id;}}$id=self::$startNode[self::DATA];while(TRUE){if(isset($this->dataNodeFreeSpace[$id])||isset($this->nodeCache[$id])){++$id;continue;}$offset=self::HEADER_SIZE+self::NODE_SIZE*$id;$binary=stream_get_contents($this->handle,2*self::INT32_SIZE,$offset);if(empty($binary)){$this->dataNodeFreeSpace[$id]=self::NODE_SIZE;return$id;}list(,$magic,$nodeSize)=unpack('N2',$binary);if(empty($magic)){$this->dataNodeFreeSpace[$id]=self::NODE_SIZE;return$id;}elseif($magic===self::DATA_MAGIC){$freeSpace=self::NODE_SIZE-$nodeSize;$this->dataNodeFreeSpace[$id]=$freeSpace;if($freeSpace>$size){return$id;}}++$id;}}private
function
bisectNode($id,array$node){$nodeInfo=$node[self::INFO];unset($node[self::INFO]);if(count($node)===1){$key=key($node);$dataId=$this->findFreeDataNode(self::NODE_SIZE);$this->saveNode($dataId,array(self::INDEX_DATA=>$node[$key],self::INFO=>array(self::TYPE=>self::DATA,self::LAST_INDEX=>($dataId<<self::BITROT))));unset($node[$key]);$node[$key][self::INDEX_DATA]=$dataId;$node[self::INFO]=$nodeInfo;$this->saveNode($id,$node);return;}ksort($node);$halfCount=ceil(count($node)/2);list($first,$second)=array_chunk($node,$halfCount,TRUE);end($first);$halfKey=key($first);if($id<=2){list($firstId,$secondId)=$this->findFreeNode(2);$first[self::INFO]=array(self::TYPE=>$nodeInfo[self::TYPE],self::IS_LEAF=>$nodeInfo[self::IS_LEAF],self::PREV_NODE=>-1,self::END=>-1,self::MAX=>$halfKey);$this->saveNode($firstId,$first);$second[self::INFO]=array(self::TYPE=>$nodeInfo[self::TYPE],self::IS_LEAF=>$nodeInfo[self::IS_LEAF],self::PREV_NODE=>$firstId,self::END=>$nodeInfo[self::END],self::MAX=>-1);$this->saveNode($secondId,$second);$parentNode=array(self::INFO=>array(self::TYPE=>$nodeInfo[self::TYPE],self::IS_LEAF=>FALSE,self::PREV_NODE=>-1,self::END=>$secondId,self::MAX=>-1),$halfKey=>$firstId);$this->saveNode($id,$parentNode);}else{$firstId=$this->findFreeNode();$first[self::INFO]=array(self::TYPE=>$nodeInfo[self::TYPE],self::IS_LEAF=>$nodeInfo[self::IS_LEAF],self::PREV_NODE=>$nodeInfo[self::PREV_NODE],self::END=>-1,self::MAX=>$halfKey);$this->saveNode($firstId,$first);$second[self::INFO]=array(self::TYPE=>$nodeInfo[self::TYPE],self::IS_LEAF=>$nodeInfo[self::IS_LEAF],self::PREV_NODE=>$firstId,self::END=>$nodeInfo[self::END],self::MAX=>$nodeInfo[self::MAX]);$this->saveNode($id,$second);list(,,$parent)=$this->findIndexNode($nodeInfo[self::TYPE],$halfKey);$parentNode=$this->getNode($parent);if($parentNode===FALSE){if(self::$debug){throw
new
InvalidStateException("Cannot load node number $parent.");}}else{$parentNode[$halfKey]=$firstId;ksort($parentNode);$this->saveNode($parent,$parentNode);}}}private
function
headerCommit(){fseek($this->handle,self::INT32_SIZE);@fwrite($this->handle,pack('N',$this->lastNode));}private
function
deleteNode($id){fseek($this->handle,0,SEEK_END);$end=ftell($this->handle);if($end<=(self::HEADER_SIZE+self::NODE_SIZE*($id+1))){$packedNull=pack('N',0);do{$binary=stream_get_contents($this->handle,self::INT32_SIZE,(self::HEADER_SIZE+self::NODE_SIZE*--$id));}while(empty($binary)||$binary===$packedNull);if(!ftruncate($this->handle,self::HEADER_SIZE+self::NODE_SIZE*($id+1))){throw
new
InvalidStateException('Cannot truncate journal file.');}}else{fseek($this->handle,self::HEADER_SIZE+self::NODE_SIZE*$id);$written=fwrite($this->handle,pack('N',0));if($written!==self::INT32_SIZE){throw
new
InvalidStateException("Cannot delete node number $id from journal.");}}}private
function
deleteAll(){if(!ftruncate($this->handle,self::HEADER_SIZE)){throw
new
InvalidStateException('Cannot truncate journal file.');}}private
function
lock(){if(!$this->handle){$this->prepare();}if(!flock($this->handle,LOCK_EX)){throw
new
InvalidStateException("Cannot acquire exclusive lock on journal file '$this->file'.");}$lastProcessIdentifier=stream_get_contents($this->handle,self::INT32_SIZE,self::INT32_SIZE*2);if($lastProcessIdentifier!==$this->processIdentifier){$this->nodeCache=$this->dataNodeFreeSpace=array();fseek($this->handle,self::INT32_SIZE*2);fwrite($this->handle,$this->processIdentifier);}}private
function
prepare(){if(!file_exists($this->file)){$init=@fopen($this->file,'xb');if(!$init){clearstatcache();if(!file_exists($this->file)){throw
new
InvalidStateException("Cannot create journal file '$this->file'.");}}else{$written=fwrite($init,pack('N2',self::FILE_MAGIC,$this->lastNode));fclose($init);if($written!==self::INT32_SIZE*2){throw
new
InvalidStateException("Cannot write journal header.");}}}$this->handle=fopen($this->file,'r+b');if(!$this->handle){throw
new
InvalidStateException("Cannot open journal file '$this->file'.");}if(!flock($this->handle,LOCK_SH)){throw
new
InvalidStateException('Cannot acquire shared lock on journal.');}$header=stream_get_contents($this->handle,2*self::INT32_SIZE,0);flock($this->handle,LOCK_UN);list(,$fileMagic,$this->lastNode)=unpack('N2',$header);if($fileMagic!==self::FILE_MAGIC){fclose($this->handle);$this->handle=FALSE;throw
new
InvalidStateException("Malformed journal file '$this->file'.");}$this->processIdentifier=pack('N',mt_rand());}private
function
unlock(){if($this->handle){fflush($this->handle);flock($this->handle,LOCK_UN);}}private
function
findNextFreeKey($nodeId,array&$nodeData){$newKey=$nodeData[self::INFO][self::LAST_INDEX]+1;$maxKey=($nodeId+1)<<self::BITROT;if($newKey>=$maxKey){$start=$nodeId<<self::BITROT;for($i=$start;$i<$maxKey;$i++){if(!isset($nodeData[$i])){return$i;}}throw
new
InvalidStateException("Node $nodeId is full.");}else{return++$nodeData[self::INFO][self::LAST_INDEX];}}private
function
arrayAppend(array&$array,array$append){foreach($append
as$value){$array[]=$value;}}private
function
arrayAppendKeys(array&$array,array$append){foreach($append
as$key=>$value){$array[$key]=$value;}}}class
NFileStorage
extends
NObject
implements
ICacheStorage{const
META_HEADER_LEN=28,META_TIME='time',META_SERIALIZED='serialized',META_EXPIRE='expire',META_DELTA='delta',META_ITEMS='di',META_CALLBACKS='callbacks';const
FILE='file',HANDLE='handle';public
static$gcProbability=0.001;public
static$useDirectories=TRUE;private$dir;private$useDirs;private$journal;private$locks;function
__construct($dir,ICacheJournal$journal=NULL){$this->dir=realpath($dir);if($this->dir===FALSE){throw
new
DirectoryNotFoundException("Directory '$dir' not found.");}$this->useDirs=(bool)self::$useDirectories;$this->journal=$journal;if(mt_rand()/mt_getrandmax()<self::$gcProbability){$this->clean(array());}}function
read($key){$meta=$this->readMetaAndLock($this->getCacheFile($key),LOCK_SH);if($meta&&$this->verify($meta)){return$this->readData($meta);}else{return
NULL;}}private
function
verify($meta){do{if(!empty($meta[self::META_DELTA])){if(filemtime($meta[self::FILE])+$meta[self::META_DELTA]<time()){break;}touch($meta[self::FILE]);}elseif(!empty($meta[self::META_EXPIRE])&&$meta[self::META_EXPIRE]<time()){break;}if(!empty($meta[self::META_CALLBACKS])&&!NCache::checkCallbacks($meta[self::META_CALLBACKS])){break;}if(!empty($meta[self::META_ITEMS])){foreach($meta[self::META_ITEMS]as$depFile=>$time){$m=$this->readMetaAndLock($depFile,LOCK_SH);if($m[self::META_TIME]!==$time||($m&&!$this->verify($m))){break
2;}}}return
TRUE;}while(FALSE);$this->delete($meta[self::FILE],$meta[self::HANDLE]);return
FALSE;}function
lock($key){$cacheFile=$this->getCacheFile($key);if($this->useDirs&&!is_dir($dir=dirname($cacheFile))){@mkdir($dir);}$handle=false;if(file_exists($cacheFile)){$handle=@fopen($cacheFile,'r+b');}if(!$handle){$handle=fopen($cacheFile,'wb');if(!$handle){return;}}$this->locks[$key]=$handle;flock($handle,LOCK_EX);}function
write($key,$data,array$dp){$meta=array(self::META_TIME=>microtime());if(isset($dp[NCache::EXPIRATION])){if(empty($dp[NCache::SLIDING])){$meta[self::META_EXPIRE]=$dp[NCache::EXPIRATION]+time();}else{$meta[self::META_DELTA]=(int)$dp[NCache::EXPIRATION];}}if(isset($dp[NCache::ITEMS])){foreach((array)$dp[NCache::ITEMS]as$item){$depFile=$this->getCacheFile($item);$m=$this->readMetaAndLock($depFile,LOCK_SH);$meta[self::META_ITEMS][$depFile]=$m[self::META_TIME];unset($m);}}if(isset($dp[NCache::CALLBACKS])){$meta[self::META_CALLBACKS]=$dp[NCache::CALLBACKS];}if(!isset($this->locks[$key])){$this->lock($key);if(!isset($this->locks[$key])){return;}}$handle=$this->locks[$key];unset($this->locks[$key]);$cacheFile=$this->getCacheFile($key);if(isset($dp[NCache::TAGS])||isset($dp[NCache::PRIORITY])){if(!$this->journal){throw
new
InvalidStateException('CacheJournal has not been provided.');}$this->journal->write($cacheFile,$dp);}ftruncate($handle,0);if(!is_string($data)){$data=serialize($data);$meta[self::META_SERIALIZED]=TRUE;}$head=serialize($meta).'?>';$head='<?php //netteCache[01]'.str_pad((string)strlen($head),6,'0',STR_PAD_LEFT).$head;$headLen=strlen($head);$dataLen=strlen($data);do{if(fwrite($handle,str_repeat("\x00",$headLen),$headLen)!==$headLen){break;}if(fwrite($handle,$data,$dataLen)!==$dataLen){break;}fseek($handle,0);if(fwrite($handle,$head,$headLen)!==$headLen){break;}flock($handle,LOCK_UN);fclose($handle);return;}while(FALSE);$this->delete($cacheFile,$handle);}function
remove($key){unset($this->locks[$key]);$this->delete($this->getCacheFile($key));}function
clean(array$conditions){$all=!empty($conditions[NCache::ALL]);$collector=empty($conditions);if($all||$collector){$now=time();foreach(NFinder::find('_*')->from($this->dir)->childFirst()as$entry){$path=(string)$entry;if($entry->isDir()){@rmdir($path);continue;}if($all){$this->delete($path);}else{$meta=$this->readMetaAndLock($path,LOCK_SH);if(!$meta){continue;}if((!empty($meta[self::META_DELTA])&&filemtime($meta[self::FILE])+$meta[self::META_DELTA]<$now)||(!empty($meta[self::META_EXPIRE])&&$meta[self::META_EXPIRE]<$now)){$this->delete($path,$meta[self::HANDLE]);continue;}flock($meta[self::HANDLE],LOCK_UN);fclose($meta[self::HANDLE]);}}if($this->journal){$this->journal->clean($conditions);}return;}if($this->journal){foreach($this->journal->clean($conditions)as$file){$this->delete($file);}}}protected
function
readMetaAndLock($file,$lock){if(!file_exists($file))return
NULL;$handle=@fopen($file,'r+b');if(!$handle){return
NULL;}flock($handle,$lock);$head=stream_get_contents($handle,self::META_HEADER_LEN);if($head&&strlen($head)===self::META_HEADER_LEN){$size=(int)substr($head,-6);$meta=stream_get_contents($handle,$size,self::META_HEADER_LEN);$meta=@unserialize($meta);if(is_array($meta)){fseek($handle,$size+self::META_HEADER_LEN);$meta[self::FILE]=$file;$meta[self::HANDLE]=$handle;return$meta;}}flock($handle,LOCK_UN);fclose($handle);return
NULL;}protected
function
readData($meta){$data=stream_get_contents($meta[self::HANDLE]);flock($meta[self::HANDLE],LOCK_UN);fclose($meta[self::HANDLE]);if(empty($meta[self::META_SERIALIZED])){return$data;}else{return@unserialize($data);}}protected
function
getCacheFile($key){$file=urlencode($key);if($this->useDirs&&$a=strrpos($file,'%00')){$file=substr_replace($file,'/_',$a,3);}return$this->dir.'/_'.$file;}private
static
function
delete($file,$handle=NULL){if(@unlink($file)){if($handle){flock($handle,LOCK_UN);fclose($handle);}return;}if(!$handle){$handle=@fopen($file,'r+');}if($handle){flock($handle,LOCK_EX);ftruncate($handle,0);flock($handle,LOCK_UN);fclose($handle);@unlink($file);}}}class
NMemoryStorage
extends
NObject
implements
ICacheStorage{private$data=array();function
read($key){return
isset($this->data[$key])?$this->data[$key]:NULL;}function
lock($key){}function
write($key,$data,array$dependencies){$this->data[$key]=$data;}function
remove($key){unset($this->data[$key]);}function
clean(array$conditions){if(!empty($conditions[NCache::ALL])){$this->data=array();}}}class
NPhpFileStorage
extends
NFileStorage{public$hint;protected
function
readData($meta){return
array('file'=>$meta[self::FILE],'handle'=>$meta[self::HANDLE]);}protected
function
getCacheFile($key){return
parent::getCacheFile(substr_replace($key,trim(strtr($this->hint,'\\/@','.._'),'.').'-',strpos($key,NCache::NAMESPACE_SEPARATOR)+1,0)).'.php';}}class
NArrayHash
extends
stdClass
implements
ArrayAccess,Countable,IteratorAggregate{static
function
from($arr,$recursive=TRUE){$obj=new
self;foreach($arr
as$key=>$value){if($recursive&&is_array($value)){$obj->$key=self::from($value,TRUE);}else{$obj->$key=$value;}}return$obj;}function
getIterator(){return
new
RecursiveArrayIterator($this);}function
count(){return
count((array)$this);}function
offsetSet($key,$value){if(!is_scalar($key)){throw
new
InvalidArgumentException(sprintf('Key must be either a string or an integer, %s given.',gettype($key)));}$this->$key=$value;}function
offsetGet($key){return$this->$key;}function
offsetExists($key){return
isset($this->$key);}function
offsetUnset($key){unset($this->$key);}}class
NArrayList
extends
NObject
implements
ArrayAccess,Countable,IteratorAggregate{private$list=array();function
getIterator(){return
new
ArrayIterator($this->list);}function
count(){return
count($this->list);}function
offsetSet($index,$value){if($index===NULL){$this->list[]=$value;}elseif($index<0||$index>=count($this->list)){throw
new
OutOfRangeException('Offset invalid or out of range');}else{$this->list[(int)$index]=$value;}}function
offsetGet($index){if($index<0||$index>=count($this->list)){throw
new
OutOfRangeException('Offset invalid or out of range');}return$this->list[(int)$index];}function
offsetExists($index){return$index>=0&&$index<count($this->list);}function
offsetUnset($index){if($index<0||$index>=count($this->list)){throw
new
OutOfRangeException('Offset invalid or out of range');}array_splice($this->list,(int)$index,1);}}class
NCallback
extends
NObject{private$cb;static
function
create($callback,$m=NULL){return
new
self($callback,$m);}function
__construct($cb,$m=NULL){if($m!==NULL){$cb=array($cb,$m);}elseif($cb
instanceof
self){$this->cb=$cb->cb;return;}if(PHP_VERSION_ID<50202&&is_string($cb)&&strpos($cb,'::')){$cb=explode('::',$cb,2);}elseif(is_object($cb)&&!$cb
instanceof
NClosure){$cb=array($cb,'__invoke');}if(is_string($this->cb)&&$a=strrpos($this->cb,'\\')){$this->cb=substr($this->cb,$a+1);}elseif(is_array($this->cb)&&is_string($this->cb[0])&&$a=strrpos($this->cb[0],'\\')){$this->cb[0]=substr($this->cb[0],$a+1);}if(!is_callable($cb,TRUE)){throw
new
InvalidArgumentException("Invalid callback.");}$this->cb=$cb;}function
__invoke(){if(!is_callable($this->cb)){throw
new
InvalidStateException("Callback '$this' is not callable.");}$_args=func_get_args();return
call_user_func_array($this->cb,$_args);}function
invoke(){if(!is_callable($this->cb)){throw
new
InvalidStateException("Callback '$this' is not callable.");}$_args=func_get_args();return
call_user_func_array($this->cb,$_args);}function
invokeArgs(array$args){if(!is_callable($this->cb)){throw
new
InvalidStateException("Callback '$this' is not callable.");}return
call_user_func_array($this->cb,$args);}function
isCallable(){return
is_callable($this->cb);}function
getNative(){return$this->cb;}function
toReflection(){if(is_string($this->cb)&&strpos($this->cb,'::')){return
new
NMethodReflection($this->cb);}elseif(is_array($this->cb)){return
new
NMethodReflection($this->cb[0],$this->cb[1]);}elseif(is_object($this->cb)&&!$this->cb
instanceof
Closure){return
new
NMethodReflection($this->cb,'__invoke');}else{return
new
NFunctionReflection($this->cb);}}function
isStatic(){return
is_array($this->cb)?is_string($this->cb[0]):is_string($this->cb);}function
__toString(){if($this->cb
instanceof
Closure){return'{closure}';}elseif(is_string($this->cb)&&$this->cb[0]==="\0"){return'{lambda}';}else{is_callable($this->cb,TRUE,$textual);return$textual;}}}class
NDateTime53
extends
DateTime{const
MINUTE=60;const
HOUR=3600;const
DAY=86400;const
WEEK=604800;const
MONTH=2629800;const
YEAR=31557600;static
function
from($time){if($time
instanceof
DateTime||$time
instanceof
DateTimeInterface){return
new
self($time->format('Y-m-d H:i:s'),$time->getTimezone());}elseif(is_numeric($time)){if($time<=self::YEAR){$time+=time();}$tmp=new
self('@'.$time);$tmp->setTimeZone(new
DateTimeZone(date_default_timezone_get()));return$tmp;}else{return
new
self($time);}}function
__toString(){return$this->format('Y-m-d H:i:s');}function
modifyClone($modify=''){$dolly=clone$this;return$modify?$dolly->modify($modify):$dolly;}function
setTimestamp($timestamp){$zone=PHP_VERSION_ID===50206?new
DateTimeZone($this->getTimezone()->getName()):$this->getTimezone();$this->__construct('@'.$timestamp);$this->setTimeZone($zone);return$this;}function
getTimestamp(){$ts=$this->format('U');return
is_float($tmp=$ts*1)?$ts:$tmp;}function
modify($modify){parent::modify($modify);return$this;}static
function
__set_state($state){return
new
self($state['date'],new
DateTimeZone($state['timezone']));}function
__sleep(){$zone=$this->getTimezone()->getName();if($zone[0]==='+'){$this->fix=array($this->format('Y-m-d H:i:sP'));}else{$this->fix=array($this->format('Y-m-d H:i:s'),$zone);}return
array('fix');}function
__wakeup(){if(isset($this->fix[1])){$this->__construct($this->fix[0],new
DateTimeZone($this->fix[1]));}else{$this->__construct($this->fix[0]);}unset($this->fix);}}class
NFramework{const
NAME='Nette Framework',VERSION='2.0.16',VERSION_ID=20016,REVISION='released on 2014-08-28';public
static$iAmUsingBadHost=FALSE;final
function
__construct(){throw
new
NStaticClassException;}}abstract
class
NFreezableObject
extends
NObject
implements
IFreezable{private$frozen=FALSE;function
freeze(){$this->frozen=TRUE;}function
isFrozen(){return$this->frozen;}function
__clone(){$this->frozen=FALSE;}protected
function
updating(){if($this->frozen){$class=get_class($this);throw
new
InvalidStateException("Cannot modify a frozen object $class.");}}}class
NObjectMixin{private
static$methods;private
static$props;final
function
__construct(){throw
new
NStaticClassException;}static
function
call($_this,$name,$args){$class=get_class($_this);$isProp=self::hasProperty($class,$name);if($name===''){throw
new
MemberAccessException("Call to class '$class' method without name.");}elseif($isProp==='event'){if(is_array($_this->$name)||$_this->$name
instanceof
Traversable){foreach($_this->$name
as$handler){NCallback::create($handler)->invokeArgs($args);}}elseif($_this->$name!==NULL){throw
new
UnexpectedValueException("Property $class::$$name must be array or NULL, ".gettype($_this->$name)." given.");}}elseif($cb=NClassReflection::from($_this)->getExtensionMethod($name)){array_unshift($args,$_this);return$cb->invokeArgs($args);}else{throw
new
MemberAccessException("Call to undefined method $class::$name().");}}static
function
callProperty($_this,$name,$args){if(strlen($name)>3){$op=substr($name,0,3);$prop=strtolower($name[3]).substr($name,4);if($op==='add'&&self::hasProperty(get_class($_this),$prop.'s')){$_this->{$prop.'s'}[]=$args[0];return$_this;}elseif($op==='set'&&self::hasProperty(get_class($_this),$prop)){$_this->$prop=$args[0];return$_this;}elseif($op==='get'&&self::hasProperty(get_class($_this),$prop)){return$_this->$prop;}}return
self::call($_this,$name,$args);}static
function
callStatic($class,$method,$args){throw
new
MemberAccessException("Call to undefined static method $class::$method().");}static
function&get($_this,$name){$class=get_class($_this);$uname=ucfirst($name);if(!isset(self::$methods[$class])){self::$methods[$class]=array_flip(get_class_methods($class));}if($name===''){throw
new
MemberAccessException("Cannot read a class '$class' property without name.");}elseif(isset(self::$methods[$class][$m='get'.$uname])||isset(self::$methods[$class][$m='is'.$uname])){$val=$_this->$m();return$val;}elseif(isset(self::$methods[$class][$name])){$val=NCallback::create($_this,$name);return$val;}else{$type=isset(self::$methods[$class]['set'.$uname])?'a write-only':'an undeclared';throw
new
MemberAccessException("Cannot read $type property $class::\$$name.");}}static
function
set($_this,$name,$value){$class=get_class($_this);$uname=ucfirst($name);if(!isset(self::$methods[$class])){self::$methods[$class]=array_flip(get_class_methods($class));}if($name===''){throw
new
MemberAccessException("Cannot write to a class '$class' property without name.");}elseif(self::hasProperty($class,$name)){$_this->$name=$value;}elseif(isset(self::$methods[$class][$m='set'.$uname])){$_this->$m($value);}else{$type=isset(self::$methods[$class]['get'.$uname])||isset(self::$methods[$class]['is'.$uname])?'a read-only':'an undeclared';throw
new
MemberAccessException("Cannot write to $type property $class::\$$name.");}}static
function
remove($_this,$name){$class=get_class($_this);if(!self::hasProperty($class,$name)){throw
new
MemberAccessException("Cannot unset the property $class::\$$name.");}}static
function
has($_this,$name){$class=get_class($_this);$name=ucfirst($name);if(!isset(self::$methods[$class])){self::$methods[$class]=array_flip(get_class_methods($class));}return$name!==''&&(isset(self::$methods[$class]['get'.$name])||isset(self::$methods[$class]['is'.$name]));}private
static
function
hasProperty($class,$name){$prop=&self::$props[$class][$name];if($prop===NULL){$prop=FALSE;try{$rp=new
ReflectionProperty($class,$name);if($name===$rp->getName()&&$rp->isPublic()&&!$rp->isStatic()){$prop=preg_match('#^on[A-Z]#',$name)?'event':TRUE;}}catch(ReflectionException$e){}}return$prop;}}class
NSmartCachingIterator
extends
CachingIterator
implements
Countable{private$counter=0;function
__construct($iterator){if(is_array($iterator)||$iterator
instanceof
stdClass){$iterator=new
ArrayIterator($iterator);}elseif($iterator
instanceof
IteratorAggregate){do{$iterator=$iterator->getIterator();}while($iterator
instanceof
IteratorAggregate);}elseif($iterator
instanceof
Traversable){if(!$iterator
instanceof
Iterator){$iterator=new
IteratorIterator($iterator);}}else{throw
new
InvalidArgumentException(sprintf('Invalid argument passed to foreach resp. %s; array or Traversable expected, %s given.',__CLASS__,is_object($iterator)?get_class($iterator):gettype($iterator)));}parent::__construct($iterator,0);}function
isFirst($width=NULL){return$this->counter===1||($width&&$this->counter!==0&&(($this->counter-1)%$width)===0);}function
isLast($width=NULL){return!$this->hasNext()||($width&&($this->counter
%$width)===0);}function
isEmpty(){return$this->counter===0;}function
isOdd(){return$this->counter
%
2===1;}function
isEven(){return$this->counter
%
2===0;}function
getCounter(){return$this->counter;}function
count(){$inner=$this->getInnerIterator();if($inner
instanceof
Countable){return$inner->count();}else{throw
new
NotSupportedException('Iterator is not countable.');}}function
next(){parent::next();if(parent::valid()){$this->counter++;}}function
rewind(){parent::rewind();$this->counter=parent::valid()?1:0;}function
getNextKey(){return$this->getInnerIterator()->key();}function
getNextValue(){return$this->getInnerIterator()->current();}function
__call($name,$args){return
NObjectMixin::call($this,$name,$args);}function&__get($name){return
NObjectMixin::get($this,$name);}function
__set($name,$value){NObjectMixin::set($this,$name,$value);}function
__isset($name){return
NObjectMixin::has($this,$name);}function
__unset($name){NObjectMixin::remove($this,$name);}}class
NNCallbackFilterIterator
extends
FilterIterator{private$callback;function
__construct(Iterator$iterator,$callback){parent::__construct($iterator);$this->callback=new
NCallback($callback);}function
accept(){return$this->callback->invoke($this);}}class
NInstanceFilterIterator
extends
FilterIterator
implements
Countable{private$type;function
__construct(Iterator$iterator,$type){$this->type=$type;parent::__construct($iterator);}function
accept(){return$this->current()instanceof$this->type;}function
count(){return
iterator_count($this);}}class
NNRecursiveCallbackFilterIterator
extends
FilterIterator
implements
RecursiveIterator{private$callback;private$childrenCallback;function
__construct(RecursiveIterator$iterator,$callback,$childrenCallback=NULL){parent::__construct($iterator);$this->callback=$callback===NULL?NULL:new
NCallback($callback);$this->childrenCallback=$childrenCallback===NULL?NULL:new
NCallback($childrenCallback);}function
accept(){return$this->callback===NULL||$this->callback->invoke($this);}function
hasChildren(){return$this->getInnerIterator()->hasChildren()&&($this->childrenCallback===NULL||$this->childrenCallback->invoke($this));}function
getChildren(){return
new
self($this->getInnerIterator()->getChildren(),$this->callback,$this->childrenCallback);}}class
NGenericRecursiveIterator
extends
IteratorIterator
implements
RecursiveIterator,Countable{function
hasChildren(){$obj=$this->current();return($obj
instanceof
IteratorAggregate&&$obj->getIterator()instanceof
RecursiveIterator)||$obj
instanceof
RecursiveIterator;}function
getChildren(){$obj=$this->current();return$obj
instanceof
IteratorAggregate?$obj->getIterator():$obj;}function
count(){return
iterator_count($this);}}class
NLatteCompiler
extends
NObject{public$defaultContentType=self::CONTENT_XHTML;private$tokens;private$output;private$position;private$macros;private$macroHandlers;private$htmlNodes=array();private$macroNodes=array();private$attrCodes=array();private$contentType;private$context;private$templateId;const
CONTENT_HTML='html',CONTENT_XHTML='xhtml',CONTENT_XML='xml',CONTENT_JS='js',CONTENT_CSS='css',CONTENT_ICAL='ical',CONTENT_TEXT='text';const
CONTEXT_COMMENT='comment',CONTEXT_SINGLE_QUOTED="'",CONTEXT_DOUBLE_QUOTED='"';function
__construct(){$this->macroHandlers=new
SplObjectStorage;}function
addMacro($name,IMacro$macro){$this->macros[$name][]=$macro;$this->macroHandlers->attach($macro);return$this;}function
compile(array$tokens){$this->templateId=NStrings::random();$this->tokens=$tokens;$output='';$this->output=&$output;$this->htmlNodes=$this->macroNodes=array();$this->setContentType($this->defaultContentType);foreach($this->macroHandlers
as$handler){$handler->initialize($this);}try{foreach($tokens
as$this->position=>$token){if($token->type===NLatteToken::TEXT){$this->output.=$token->text;}elseif($token->type===NLatteToken::MACRO_TAG){$isRightmost=!isset($tokens[$this->position+1])||substr($tokens[$this->position+1]->text,0,1)==="\n";$this->writeMacro($token->name,$token->value,$token->modifiers,$isRightmost);}elseif($token->type===NLatteToken::HTML_TAG_BEGIN){$this->processHtmlTagBegin($token);}elseif($token->type===NLatteToken::HTML_TAG_END){$this->processHtmlTagEnd($token);}elseif($token->type===NLatteToken::HTML_ATTRIBUTE){$this->processHtmlAttribute($token);}elseif($token->type===NLatteToken::COMMENT){$this->processComment($token);}}}catch(NCompileException$e){$e->sourceLine=$token->line;throw$e;}foreach($this->htmlNodes
as$htmlNode){if(!empty($htmlNode->macroAttrs)){throw
new
NCompileException("Missing end tag </$htmlNode->name> for macro-attribute ".NParser::N_PREFIX.implode(' and '.NParser::N_PREFIX,array_keys($htmlNode->macroAttrs)).".",0,$token->line);}}$prologs=$epilogs='';foreach($this->macroHandlers
as$handler){$res=$handler->finalize();$handlerName=get_class($handler);$prologs.=empty($res[0])?'':"<?php\n// prolog $handlerName\n$res[0]\n?>";$epilogs=(empty($res[1])?'':"<?php\n// epilog $handlerName\n$res[1]\n?>").$epilogs;}$output=($prologs?$prologs."<?php\n//\n// main template\n//\n?>\n":'').$output.$epilogs;if($this->macroNodes){throw
new
NCompileException("There are unclosed macros.",0,$token->line);}$output=$this->expandTokens($output);return$output;}function
setContentType($type){$this->contentType=$type;$this->context=NULL;return$this;}function
getContentType(){return$this->contentType;}function
setContext($context,$sub=NULL){$this->context=array($context,$sub);return$this;}function
getContext(){return$this->context;}function
getTemplateId(){return$this->templateId;}function
getLine(){return$this->tokens?$this->tokens[$this->position]->line:NULL;}function
expandTokens($s){return
strtr($s,$this->attrCodes);}private
function
processHtmlTagBegin(NLatteToken$token){if($token->closing){do{$htmlNode=array_pop($this->htmlNodes);if(!$htmlNode){$htmlNode=new
NHtmlNode($token->name);}if(strcasecmp($htmlNode->name,$token->name)===0){break;}if($htmlNode->macroAttrs){throw
new
NCompileException("Unexpected </$token->name>.",0,$token->line);}}while(TRUE);$this->htmlNodes[]=$htmlNode;$htmlNode->closing=TRUE;$htmlNode->offset=strlen($this->output);$this->setContext(NULL);}elseif($token->text==='<!--'){$this->setContext(self::CONTEXT_COMMENT);}else{$this->htmlNodes[]=$htmlNode=new
NHtmlNode($token->name);$htmlNode->isEmpty=in_array($this->contentType,array(self::CONTENT_HTML,self::CONTENT_XHTML),TRUE)&&isset(NHtml::$emptyElements[strtolower($token->name)]);$htmlNode->offset=strlen($this->output);$this->setContext(NULL);}$this->output.=$token->text;}private
function
processHtmlTagEnd(NLatteToken$token){if($token->text==='-->'){$this->output.=$token->text;$this->setContext(NULL);return;}$htmlNode=end($this->htmlNodes);$isEmpty=!$htmlNode->closing&&(NStrings::contains($token->text,'/')||$htmlNode->isEmpty);if($isEmpty&&in_array($this->contentType,array(self::CONTENT_HTML,self::CONTENT_XHTML),TRUE)){$token->text=preg_replace('#^.*>#',$this->contentType===self::CONTENT_XHTML?' />':'>',$token->text);}if(empty($htmlNode->macroAttrs)){$this->output.=$token->text;}else{$code=substr($this->output,$htmlNode->offset).$token->text;$this->output=substr($this->output,0,$htmlNode->offset);$this->writeAttrsMacro($code,$htmlNode);if($isEmpty){$htmlNode->closing=TRUE;$this->writeAttrsMacro('',$htmlNode);}}if($isEmpty){$htmlNode->closing=TRUE;}$lower=strtolower($htmlNode->name);if(!$htmlNode->closing&&($lower==='script'||$lower==='style')){$this->setContext($lower==='script'?self::CONTENT_JS:self::CONTENT_CSS);}else{$this->setContext(NULL);if($htmlNode->closing){array_pop($this->htmlNodes);}}}private
function
processHtmlAttribute(NLatteToken$token){$htmlNode=end($this->htmlNodes);if(NStrings::startsWith($token->name,NParser::N_PREFIX)){$name=substr($token->name,strlen(NParser::N_PREFIX));if(isset($htmlNode->macroAttrs[$name])){throw
new
NCompileException("Found multiple macro-attributes $token->name.",0,$token->line);}$htmlNode->macroAttrs[$name]=$token->value;return;}$htmlNode->attrs[$token->name]=TRUE;$this->output.=$token->text;$context=NULL;if($token->value&&in_array($this->contentType,array(self::CONTENT_HTML,self::CONTENT_XHTML),TRUE)){$lower=strtolower($token->name);if(substr($lower,0,2)==='on'){$context=self::CONTENT_JS;}elseif($lower==='style'){$context=self::CONTENT_CSS;}}$this->setContext($token->value,$context);}private
function
processComment(NLatteToken$token){$isLeftmost=trim(substr($this->output,strrpos("\n$this->output","\n")))==='';if(!$isLeftmost){$this->output.=substr($token->text,strlen(rtrim($token->text,"\n")));}}function
writeMacro($name,$args=NULL,$modifiers=NULL,$isRightmost=FALSE,NHtmlNode$htmlNode=NULL,$prefix=NULL){if($name[0]==='/'){$node=end($this->macroNodes);if(!$node||("/$node->name"!==$name&&'/'!==$name)||$modifiers||($args&&$node->args&&!NStrings::startsWith("$node->args ","$args "))){$name.=$args?' ':'';throw
new
NCompileException("Unexpected macro {{$name}{$args}{$modifiers}}".($node?", expecting {/$node->name}".($args&&$node->args?" or eventually {/$node->name $node->args}":''):''));}array_pop($this->macroNodes);if(!$node->args){$node->setArgs($args);}$isLeftmost=$node->content?trim(substr($this->output,strrpos("\n$this->output","\n")))==='':FALSE;$node->closing=TRUE;$node->macro->nodeClosed($node);$this->output=&$node->saved[0];$this->writeCode($node->openingCode,$this->output,$node->saved[1]);$this->writeCode($node->closingCode,$node->content,$isRightmost,$isLeftmost);$this->output.=$node->content;}else{$node=$this->expandMacro($name,$args,$modifiers,$htmlNode,$prefix);if($node->isEmpty){$this->writeCode($node->openingCode,$this->output,$isRightmost);}else{$this->macroNodes[]=$node;$node->saved=array(&$this->output,$isRightmost);$this->output=&$node->content;}}return$node;}private
function
writeCode($code,&$output,$isRightmost,$isLeftmost=NULL){if($isRightmost){$leftOfs=strrpos("\n$output","\n");$isLeftmost=$isLeftmost===NULL?trim(substr($output,$leftOfs))==='':$isLeftmost;if($isLeftmost&&substr($code,0,11)!=='<?php echo '){$output=substr($output,0,$leftOfs);}elseif(substr($code,-2)==='?>'){$code.="\n";}}$output.=$code;}function
writeAttrsMacro($code,NHtmlNode$htmlNode){$attrs=$htmlNode->macroAttrs;$left=$right=array();foreach($this->macros
as$name=>$foo){$attrName=NMacroNode::PREFIX_INNER."-$name";if(isset($attrs[$attrName])){if($htmlNode->closing){$left[]=array("/$name",'',NMacroNode::PREFIX_INNER);}else{array_unshift($right,array($name,$attrs[$attrName],NMacroNode::PREFIX_INNER));}unset($attrs[$attrName]);}}foreach(array_reverse($this->macros)as$name=>$foo){$attrName=NMacroNode::PREFIX_TAG."-$name";if(isset($attrs[$attrName])){$left[]=array($name,$attrs[$attrName],NMacroNode::PREFIX_TAG);array_unshift($right,array("/$name",'',NMacroNode::PREFIX_TAG));unset($attrs[$attrName]);}}foreach($this->macros
as$name=>$foo){if(isset($attrs[$name])){if($htmlNode->closing){$right[]=array("/$name",'',NULL);}else{array_unshift($left,array($name,$attrs[$name],NULL));}unset($attrs[$name]);}}if($attrs){throw
new
NCompileException("Unknown macro-attribute ".NParser::N_PREFIX.implode(' and '.NParser::N_PREFIX,array_keys($attrs)));}if(!$htmlNode->closing){$htmlNode->attrCode=&$this->attrCodes[$uniq=' n:'.NStrings::random()];$code=substr_replace($code,$uniq,($tmp=strrpos($code,'/>'))?$tmp:strrpos($code,'>'),0);}foreach($left
as$item){$node=$this->writeMacro($item[0],$item[1],NULL,NULL,$htmlNode,$item[2]);if($node->closing||$node->isEmpty){$htmlNode->attrCode.=$node->attrCode;if($node->isEmpty){unset($htmlNode->macroAttrs[$node->name]);}}}$this->output.=$code;foreach($right
as$item){$node=$this->writeMacro($item[0],$item[1],NULL,NULL,$htmlNode);if($node->closing){$htmlNode->attrCode.=$node->attrCode;}}if($right&&substr($this->output,-2)==='?>'){$this->output.="\n";}}function
expandMacro($name,$args,$modifiers=NULL,NHtmlNode$htmlNode=NULL,$prefix=NULL){if(empty($this->macros[$name])){$cdata=$this->htmlNodes&&in_array(strtolower(end($this->htmlNodes)->name),array('script','style'),TRUE);throw
new
NCompileException("Unknown macro {{$name}}".($cdata?" (in JavaScript or CSS, try to put a space after bracket.)":''));}foreach(array_reverse($this->macros[$name])as$macro){$node=new
NMacroNode($macro,$name,$args,$modifiers,$this->macroNodes?end($this->macroNodes):NULL,$htmlNode,$prefix);if($macro->nodeOpened($node)!==FALSE){return$node;}}throw
new
NCompileException("Unhandled macro {{$name}}");}}class
NLatteFilter
extends
NObject{private$parser;private$compiler;function
__construct(){$this->parser=new
NParser;$this->compiler=new
NLatteCompiler;$this->compiler->defaultContentType=NLatteCompiler::CONTENT_XHTML;NCoreMacros::install($this->compiler);$this->compiler->addMacro('cache',new
NCacheMacro($this->compiler));NUIMacros::install($this->compiler);NFormMacros::install($this->compiler);}function
__invoke($s){return$this->compiler->compile($this->parser->parse($s));}function
getParser(){return$this->parser;}function
getCompiler(){return$this->compiler;}}class
NTemplateException
extends
InvalidStateException{public$sourceFile;public$sourceLine;function
__construct($message,$code=0,$sourceLine=0){$this->sourceLine=(int)$sourceLine;parent::__construct($message,$code);}function
setSourceFile($file){$this->sourceFile=(string)$file;$this->message=rtrim($this->message,'.')." in ".str_replace(dirname(dirname($file)),'...',$file).($this->sourceLine?":$this->sourceLine":'');}}class
NCompileException
extends
NTemplateException{}class
NHtmlNode
extends
NObject{public$name;public$isEmpty=FALSE;public$attrs=array();public$macroAttrs=array();public$closing=FALSE;public$attrCode;public$offset;function
__construct($name){$this->name=$name;}}class
NMacroNode
extends
NObject{const
PREFIX_INNER='inner',PREFIX_TAG='tag';public$macro;public$name;public$isEmpty=FALSE;public$args;public$modifiers;public$closing=FALSE;public$tokenizer;public$parentNode;public$openingCode;public$closingCode;public$attrCode;public$content;public$data;public$htmlNode;public$prefix;public$saved;function
__construct(IMacro$macro,$name,$args=NULL,$modifiers=NULL,NMacroNode$parentNode=NULL,NHtmlNode$htmlNode=NULL,$prefix=NULL){$this->macro=$macro;$this->name=(string)$name;$this->modifiers=(string)$modifiers;$this->parentNode=$parentNode;$this->htmlNode=$htmlNode;$this->prefix=$prefix;$this->tokenizer=new
NMacroTokenizer($this->args);$this->data=new
stdClass;$this->setArgs($args);}function
setArgs($args){$this->args=(string)$args;$this->tokenizer->tokenize($this->args);}}class
NCacheMacro
extends
NObject
implements
IMacro{private$used;function
initialize(){$this->used=FALSE;}function
finalize(){if($this->used){return
array('NCacheMacro::initRuntime($template, $_g);');}}function
nodeOpened(NMacroNode$node){$this->used=TRUE;$node->isEmpty=FALSE;$node->openingCode=NPhpWriter::using($node)->write('<?php if (NCacheMacro::createCache($netteCacheStorage, %var, $_g->caches, %node.array?)) { ?>',NStrings::random());}function
nodeClosed(NMacroNode$node){$node->closingCode='<?php $_l->tmp = array_pop($_g->caches); if (!$_l->tmp instanceof stdClass) $_l->tmp->end(); } ?>';}static
function
initRuntime(NFileTemplate$template,stdClass$global){if(!empty($global->caches)){end($global->caches)->dependencies[NCache::FILES][]=$template->getFile();}}static
function
createCache(ICacheStorage$cacheStorage,$key,&$parents,array$args=NULL){if($args){if(array_key_exists('if',$args)&&!$args['if']){return$parents[]=new
stdClass;}$key=array_merge(array($key),array_intersect_key($args,range(0,count($args))));}if($parents){end($parents)->dependencies[NCache::ITEMS][]=$key;}$cache=new
NCache($cacheStorage,'Nette.Templating.Cache');if($helper=$cache->start($key)){if(isset($args['expire'])){$args['expiration']=$args['expire'];}$helper->dependencies=array(NCache::TAGS=>isset($args['tags'])?$args['tags']:NULL,NCache::EXPIRATION=>isset($args['expiration'])?$args['expiration']:'+ 7 days');$parents[]=$helper;}return$helper;}}class
NMacroSet
extends
NObject
implements
IMacro{private$compiler;private$macros;function
__construct(NLatteCompiler$compiler){$this->compiler=$compiler;}function
addMacro($name,$begin,$end=NULL,$attr=NULL){$this->macros[$name]=array($begin,$end,$attr);$this->compiler->addMacro($name,$this);return$this;}static
function
install(NLatteCompiler$compiler){return
new
self($compiler);}function
initialize(){}function
finalize(){}function
nodeOpened(NMacroNode$node){if($this->macros[$node->name][2]&&$node->htmlNode){$node->isEmpty=TRUE;$this->compiler->setContext(NLatteCompiler::CONTEXT_DOUBLE_QUOTED);$res=$this->compile($node,$this->macros[$node->name][2]);$this->compiler->setContext(NULL);if(!$node->attrCode){$node->attrCode="<?php $res ?>";}}else{$node->isEmpty=!isset($this->macros[$node->name][1]);$res=$this->compile($node,$this->macros[$node->name][0]);if(!$node->openingCode){$node->openingCode="<?php $res ?>";}}return$res!==FALSE;}function
nodeClosed(NMacroNode$node){$res=$this->compile($node,$this->macros[$node->name][1]);if(!$node->closingCode){$node->closingCode="<?php $res ?>";}}private
function
compile(NMacroNode$node,$def){$node->tokenizer->reset();$writer=NPhpWriter::using($node,$this->compiler);if(is_string($def)&&substr($def,0,1)!=="\0"){return$writer->write($def);}else{return
NCallback::create($def)->invoke($node,$writer);}}function
getCompiler(){return$this->compiler;}}class
NCoreMacros
extends
NMacroSet{static
function
install(NLatteCompiler$compiler){$me=new
self($compiler);$me->addMacro('if',array($me,'macroIf'),array($me,'macroEndIf'));$me->addMacro('elseif','} elseif (%node.args) {');$me->addMacro('else',array($me,'macroElse'));$me->addMacro('ifset','if (isset(%node.args)) {','}');$me->addMacro('elseifset','} elseif (isset(%node.args)) {');$me->addMacro('foreach','',array($me,'macroEndForeach'));$me->addMacro('for','for (%node.args) {','}');$me->addMacro('while','while (%node.args) {','}');$me->addMacro('continueIf','if (%node.args) continue');$me->addMacro('breakIf','if (%node.args) break');$me->addMacro('first','if ($iterator->isFirst(%node.args)) {','}');$me->addMacro('last','if ($iterator->isLast(%node.args)) {','}');$me->addMacro('sep','if (!$iterator->isLast(%node.args)) {','}');$me->addMacro('var',array($me,'macroVar'));$me->addMacro('assign',array($me,'macroVar'));$me->addMacro('default',array($me,'macroVar'));$me->addMacro('dump',array($me,'macroDump'));$me->addMacro('debugbreak',array($me,'macroDebugbreak'));$me->addMacro('l','?>{<?php');$me->addMacro('r','?>}<?php');$me->addMacro('_',array($me,'macroTranslate'),array($me,'macroTranslate'));$me->addMacro('=',array($me,'macroExpr'));$me->addMacro('?',array($me,'macroExpr'));$me->addMacro('capture',array($me,'macroCapture'),array($me,'macroCaptureEnd'));$me->addMacro('include',array($me,'macroInclude'));$me->addMacro('use',array($me,'macroUse'));$me->addMacro('class',NULL,NULL,array($me,'macroClass'));$me->addMacro('attr',array($me,'macroOldAttr'),'',array($me,'macroAttr'));$me->addMacro('href',NULL);}function
finalize(){return
array('list($_l, $_g) = NCoreMacros::initRuntime($template, '.var_export($this->getCompiler()->getTemplateId(),TRUE).')');}function
macroIf(NMacroNode$node,NPhpWriter$writer){if($node->data->capture=($node->args==='')){return'ob_start()';}if($node->prefix===NMacroNode::PREFIX_TAG){return$writer->write($node->htmlNode->closing?'if (array_pop($_l->ifs)) {':'if ($_l->ifs[] = (%node.args)) {');}return$writer->write('if (%node.args) {');}function
macroEndIf(NMacroNode$node,NPhpWriter$writer){if($node->data->capture){if($node->args===''){throw
new
NCompileException('Missing condition in {if} macro.');}return$writer->write('if (%node.args) '.(isset($node->data->else)?'{ ob_end_clean(); ob_end_flush(); }':'ob_end_flush();').' else '.(isset($node->data->else)?'{ $_else = ob_get_contents(); ob_end_clean(); ob_end_clean(); echo $_else; }':'ob_end_clean();'));}return'}';}function
macroElse(NMacroNode$node,NPhpWriter$writer){$ifNode=$node->parentNode;if($ifNode&&$ifNode->name==='if'&&$ifNode->data->capture){if(isset($ifNode->data->else)){throw
new
NCompileException('Macro {if} supports only one {else}.');}$ifNode->data->else=TRUE;return'ob_start()';}return'} else {';}function
macroTranslate(NMacroNode$node,NPhpWriter$writer){if($node->closing){return$writer->write('echo %modify($template->translate(ob_get_clean()))');}elseif($node->isEmpty=($node->args!=='')){return$writer->write('echo %modify($template->translate(%node.args))');}else{return'ob_start()';}}function
macroInclude(NMacroNode$node,NPhpWriter$writer){$code=$writer->write('NCoreMacros::includeTemplate(%node.word, %node.array? + $template->getParameters(), $_l->templates[%var])',$this->getCompiler()->getTemplateId());if($node->modifiers){return$writer->write('echo %modify(%raw->__toString(TRUE))',$code);}else{return$code.'->render()';}}function
macroUse(NMacroNode$node,NPhpWriter$writer){NCallback::create($node->tokenizer->fetchWord(),'install')->invoke($this->getCompiler())->initialize();}function
macroCapture(NMacroNode$node,NPhpWriter$writer){$variable=$node->tokenizer->fetchWord();if(substr($variable,0,1)!=='$'){throw
new
NCompileException("Invalid capture block variable '$variable'");}$node->data->variable=$variable;return'ob_start()';}function
macroCaptureEnd(NMacroNode$node,NPhpWriter$writer){return$node->data->variable.$writer->write(' = %modify(ob_get_clean())');}function
macroEndForeach(NMacroNode$node,NPhpWriter$writer){if($node->modifiers!=='|noiterator'&&preg_match('#\W(\$iterator|include|require|get_defined_vars)\W#',$this->getCompiler()->expandTokens($node->content))){$node->openingCode='<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator('.preg_replace('#(.*)\s+as\s+#i','$1) as ',$writer->formatArgs(),1).') { ?>';$node->closingCode='<?php $iterations++; } array_pop($_l->its); $iterator = end($_l->its) ?>';}else{$node->openingCode='<?php $iterations = 0; foreach ('.$writer->formatArgs().') { ?>';$node->closingCode='<?php $iterations++; } ?>';}}function
macroClass(NMacroNode$node,NPhpWriter$writer){return$writer->write('if ($_l->tmp = array_filter(%node.array)) echo \' class="\' . %escape(implode(" ", array_unique($_l->tmp))) . \'"\'');}function
macroAttr(NMacroNode$node,NPhpWriter$writer){return$writer->write('echo NHtml::el(NULL, %node.array)->attributes()');}function
macroOldAttr(NMacroNode$node){return
NStrings::replace($node->args.' ','#\)\s+#',')->');}function
macroDump(NMacroNode$node,NPhpWriter$writer){$args=$writer->formatArgs();return'NDebugger::barDump('.($node->args?"array(".$writer->write('%var',$args)." => $args)":'get_defined_vars()').', "Template " . str_replace(dirname(dirname($template->getFile())), "\xE2\x80\xA6", $template->getFile()))';}function
macroDebugbreak(NMacroNode$node,NPhpWriter$writer){return$writer->write(($node->args==NULL?'':'if (!(%node.args)); else').'if (function_exists("debugbreak")) debugbreak(); elseif (function_exists("xdebug_break")) xdebug_break()');}function
macroVar(NMacroNode$node,NPhpWriter$writer){$out='';$var=TRUE;$tokenizer=$writer->preprocess();while($token=$tokenizer->fetchToken()){if($var&&($token['type']===NMacroTokenizer::T_SYMBOL||$token['type']===NMacroTokenizer::T_VARIABLE)){if($node->name==='default'){$out.="'".ltrim($token['value'],"$")."'";}else{$out.='$'.ltrim($token['value'],"$");}$var=NULL;}elseif(($token['value']==='='||$token['value']==='=>')&&$token['depth']===0){$out.=$node->name==='default'?'=>':'=';$var=FALSE;}elseif($token['value']===','&&$token['depth']===0){$out.=$node->name==='default'?',':';';$var=TRUE;}elseif($var===NULL&&$node->name==='default'&&$token['type']!==NMacroTokenizer::T_WHITESPACE){throw
new
NCompileException("Unexpected '$token[value]' in {default $node->args}");}else{$out.=$writer->canQuote($tokenizer)?"'$token[value]'":$token['value'];}}return$node->name==='default'?"extract(array($out), EXTR_SKIP)":$out;}function
macroExpr(NMacroNode$node,NPhpWriter$writer){return$writer->write(($node->name==='?'?'':'echo ').'%modify(%node.args)');}static
function
includeTemplate($destination,array$params,ITemplate$template){if($destination
instanceof
ITemplate){$tpl=$destination;}elseif($destination==NULL){throw
new
InvalidArgumentException("Template file name was not specified.");}elseif($template
instanceof
IFileTemplate){if(!preg_match('#/|\\\\|[a-z]:#iA',$destination)){$destination=dirname($template->getFile()).'/'.$destination;}$tpl=clone$template;$tpl->setFile($destination);}else{throw
new
NotSupportedException('Macro {include "filename"} is supported only with IFileTemplate.');}$tpl->setParameters($params);return$tpl;}static
function
initRuntime(ITemplate$template,$templateId){if(isset($template->_l)){$local=$template->_l;unset($template->_l);}else{$local=new
stdClass;}$local->templates[$templateId]=$template;if(!isset($template->_g)){$template->_g=new
stdClass;}return
array($local,$template->_g);}}class
NFormMacros
extends
NMacroSet{static
function
install(NLatteCompiler$compiler){$me=new
self($compiler);$me->addMacro('form','NFormMacros::renderFormBegin($form = $_form = (is_object(%node.word) ? %node.word : $_control[%node.word]), %node.array)','NFormMacros::renderFormEnd($_form)');$me->addMacro('label',array($me,'macroLabel'),'if ($_label) echo $_label->endTag()');$me->addMacro('input','$_input = (is_object(%node.word) ? %node.word : $_form[%node.word]); echo $_input->getControl()->addAttributes(%node.array)',NULL,array($me,'macroAttrName'));$me->addMacro('formContainer','$_formStack[] = $_form; $formContainer = $_form = (is_object(%node.word) ? %node.word : $_form[%node.word])','$_form = array_pop($_formStack)');$me->addMacro('name',NULL,NULL,array($me,'macroAttrName'));}function
macroLabel(NMacroNode$node,NPhpWriter$writer){$cmd='$_input = is_object(%node.word) ? %node.word : $_form[%node.word]; if ($_label = $_input->getLabel()) echo $_label->addAttributes(%node.array)';if($node->isEmpty=(substr($node->args,-1)==='/')){$node->setArgs(substr($node->args,0,-1));return$writer->write($cmd);}else{return$writer->write($cmd.'->startTag()');}}function
macroAttrName(NMacroNode$node,NPhpWriter$writer){if($node->htmlNode->attrs){$reset=array_fill_keys(array_keys($node->htmlNode->attrs),NULL);return$writer->write('$_input = (is_object(%node.word) ? %node.word : $_form[%node.word]); echo $_input->getControl()->addAttributes(%var)->attributes()',$reset);}return$writer->write('$_input = (is_object(%node.word) ? %node.word : $_form[%node.word]); echo $_input->getControl()->attributes()');}static
function
renderFormBegin(NForm$form,array$attrs){$el=$form->getElementPrototype();$el->action=$action=(string)$el->action;$el=clone$el;if(strcasecmp($form->getMethod(),'get')===0){list($el->action)=explode('?',$action,2);if(($i=strpos($action,'#'))!==FALSE){$el->action.=substr($action,$i);}}echo$el->addAttributes($attrs)->startTag();}static
function
renderFormEnd(NForm$form){$s='';if(strcasecmp($form->getMethod(),'get')===0){$url=explode('?',$form->getElementPrototype()->action,2);if(isset($url[1])){list($url[1])=explode('#',$url[1],2);foreach(preg_split('#[;&]#',$url[1])as$param){$parts=explode('=',$param,2);$name=urldecode($parts[0]);if(!isset($form[$name])){$s.=NHtml::el('input',array('type'=>'hidden','name'=>$name,'value'=>urldecode($parts[1])));}}}}foreach($form->getComponents(TRUE,'NHiddenField')as$control){if(!$control->getOption('rendered')){$s.=$control->getControl();}}if(iterator_count($form->getComponents(TRUE,'NTextInput'))<2){$s.='<!--[if IE]><input type=IEbug disabled style="display:none"><![endif]-->';}echo($s?"<div>$s</div>\n":'').$form->getElementPrototype()->endTag()."\n";}}class
NUIMacros
extends
NMacroSet{private$namedBlocks=array();private$extends;static
function
install(NLatteCompiler$compiler){$me=new
self($compiler);$me->addMacro('include',array($me,'macroInclude'));$me->addMacro('includeblock',array($me,'macroIncludeBlock'));$me->addMacro('extends',array($me,'macroExtends'));$me->addMacro('layout',array($me,'macroExtends'));$me->addMacro('block',array($me,'macroBlock'),array($me,'macroBlockEnd'));$me->addMacro('define',array($me,'macroBlock'),array($me,'macroBlockEnd'));$me->addMacro('snippet',array($me,'macroBlock'),array($me,'macroBlockEnd'));$me->addMacro('ifset',array($me,'macroIfset'),'}');$me->addMacro('widget',array($me,'macroControl'));$me->addMacro('control',array($me,'macroControl'));$me->addMacro('href',NULL,NULL,create_function('NMacroNode $node, NPhpWriter $writer','extract($GLOBALS[0]['.array_push($GLOBALS[0],array('me'=>$me)).'-1], EXTR_REFS);
			return \' ?> href="<?php \' . $me->macroLink($node, $writer) . \' ?>"<?php \';
		'));$me->addMacro('plink',array($me,'macroLink'));$me->addMacro('link',array($me,'macroLink'));$me->addMacro('ifCurrent',array($me,'macroIfCurrent'),'}');$me->addMacro('contentType',array($me,'macroContentType'));$me->addMacro('status',array($me,'macroStatus'));}function
initialize(){$this->namedBlocks=array();$this->extends=NULL;}function
finalize(){try{$this->getCompiler()->writeMacro('/block');}catch(NCompileException$e){}$epilog=$prolog=array();if($this->namedBlocks){foreach($this->namedBlocks
as$name=>$code){$func='_lb'.substr(md5($this->getCompiler()->getTemplateId().$name),0,10).'_'.preg_replace('#[^a-z0-9_]#i','_',$name);$snippet=$name[0]==='_';$prolog[]="//\n// block $name\n//\n"."if (!function_exists(\$_l->blocks[".var_export($name,TRUE)."][] = '$func')) { "."function $func(\$_l, \$_args) { foreach (\$_args as \$__k => \$__v) \$\$__k = \$__v".($snippet?'; $_control->validateControl('.var_export(substr($name,1),TRUE).')':'')."\n?>$code<?php\n}}";}$prolog[]="//\n// end of blocks\n//";}if($this->namedBlocks||$this->extends){$prolog[]="// template extending and snippets support";$prolog[]='$_l->extends = '.($this->extends?$this->extends:'empty($template->_extended) && isset($_control) && $_control instanceof NPresenter ? $_control->findLayoutTemplateFile() : NULL').'; $template->_extended = $_extended = TRUE;';$prolog[]='
if ($_l->extends) {
	'.($this->namedBlocks?'ob_start();':'return NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();').'

} elseif (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}';}else{$prolog[]='
// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}';}return
array(implode("\n\n",$prolog),implode("\n",$epilog));}function
macroInclude(NMacroNode$node,NPhpWriter$writer){$destination=$node->tokenizer->fetchWord();if(substr($destination,0,1)!=='#'){return
FALSE;}$destination=ltrim($destination,'#');$parent=$destination==='parent';if($destination==='parent'||$destination==='this'){for($item=$node->parentNode;$item&&$item->name!=='block'&&!isset($item->data->name);$item=$item->parentNode);if(!$item){throw
new
NCompileException("Cannot include $destination block outside of any block.");}$destination=$item->data->name;}$name=NStrings::contains($destination,'$')?$destination:var_export($destination,TRUE);if(isset($this->namedBlocks[$destination])&&!$parent){$cmd="call_user_func(reset(\$_l->blocks[$name]), \$_l, %node.array? + get_defined_vars())";}else{$cmd='NUIMacros::callBlock'.($parent?'Parent':'')."(\$_l, $name, %node.array? + ".($parent?'get_defined_vars':'$template->getParameters').'())';}if($node->modifiers){return$writer->write("ob_start(); $cmd; echo %modify(ob_get_clean())");}else{return$writer->write($cmd);}}function
macroIncludeBlock(NMacroNode$node,NPhpWriter$writer){return$writer->write('NCoreMacros::includeTemplate(%node.word, %node.array? + get_defined_vars(), $_l->templates[%var])->render()',$this->getCompiler()->getTemplateId());}function
macroExtends(NMacroNode$node,NPhpWriter$writer){if(!$node->args){throw
new
NCompileException('Missing destination in {'.$node->name.'}');}if(!empty($node->parentNode)){throw
new
NCompileException('{'.$node->name.'} must be placed outside any macro.');}if($this->extends!==NULL){throw
new
NCompileException('Multiple {'.$node->name.'} declarations are not allowed.');}if($node->args==='none'){$this->extends='FALSE';}elseif($node->args==='auto'){$this->extends='$_presenter->findLayoutTemplateFile()';}else{$this->extends=$writer->write('%node.word%node.args');}return;}function
macroBlock(NMacroNode$node,NPhpWriter$writer){$name=$node->tokenizer->fetchWord();if($node->name==='block'&&$name===FALSE){return$node->modifiers===''?'':'ob_start()';}$node->data->name=$name=ltrim($name,'#');if($name==NULL){if($node->name!=='snippet'){throw
new
NCompileException("Missing block name.");}}elseif(NStrings::contains($name,'$')){if($node->name==='snippet'){for($parent=$node->parentNode;$parent&&$parent->name!=='snippet';$parent=$parent->parentNode);if(!$parent){throw
new
NCompileException("Dynamic snippets are allowed only inside static snippet.");}$parent->data->dynamic=TRUE;$node->data->leave=TRUE;$node->closingCode="<?php \$_dynSnippets[\$_dynSnippetId] = ob_get_flush() ?>";if($node->htmlNode){$node->attrCode=$writer->write("<?php echo ' id=\"' . (\$_dynSnippetId = \$_control->getSnippetId({$writer->formatWord($name)})) . '\"' ?>");return$writer->write('ob_start()');}$tag=trim($node->tokenizer->fetchWord(),'<>');$tag=$tag?$tag:'div';$node->closingCode.="\n</$tag>";return$writer->write("?>\n<$tag id=\"<?php echo \$_dynSnippetId = \$_control->getSnippetId({$writer->formatWord($name)}) ?>\"><?php ob_start()");}else{$node->data->leave=TRUE;$fname=$writer->formatWord($name);$node->closingCode="<?php }} ".($node->name==='define'?'':"call_user_func(reset(\$_l->blocks[$fname]), \$_l, get_defined_vars())")." ?>";$func='_lb'.substr(md5($this->getCompiler()->getTemplateId().$name),0,10).'_'.preg_replace('#[^a-z0-9_]#i','_',$name);return"\n\n//\n// block $name\n//\n"."if (!function_exists(\$_l->blocks[$fname]['{$this->getCompiler()->getTemplateId()}'] = '$func')) { "."function $func(\$_l, \$_args) { foreach (\$_args as \$__k => \$__v) \$\$__k = \$__v";}}if($node->name==='snippet'){$node->data->name=$name='_'.$name;}if(isset($this->namedBlocks[$name])){throw
new
NCompileException("Cannot redeclare static block '$name'");}$prolog=$this->namedBlocks?'':"if (\$_l->extends) { ob_end_clean(); return NCoreMacros::includeTemplate(\$_l->extends, get_defined_vars(), \$template)->render(); }\n";$this->namedBlocks[$name]=TRUE;$include='call_user_func(reset($_l->blocks[%var]), $_l, '.($node->name==='snippet'?'$template->getParameters()':'get_defined_vars()').')';if($node->modifiers){$include="ob_start(); $include; echo %modify(ob_get_clean())";}if($node->name==='snippet'){if($node->htmlNode){$node->attrCode=$writer->write('<?php echo \' id="\' . $_control->getSnippetId(%var) . \'"\' ?>',(string)substr($name,1));return$writer->write($prolog.$include,$name);}$tag=trim($node->tokenizer->fetchWord(),'<>');$tag=$tag?$tag:'div';return$writer->write("$prolog ?>\n<$tag id=\"<?php echo \$_control->getSnippetId(%var) ?>\"><?php $include ?>\n</$tag><?php ",(string)substr($name,1),$name);}elseif($node->name==='define'){return$prolog;}else{return$writer->write($prolog.$include,$name);}}function
macroBlockEnd(NMacroNode$node,NPhpWriter$writer){if(isset($node->data->name)){if($node->name==='snippet'&&$node->htmlNode&&!$node->prefix&&preg_match('#^.*? n:\w+>\n?#s',$node->content,$m1)&&preg_match('#[ \t]*<[^<]+\z#s',$node->content,$m2)){$node->openingCode=$m1[0].$node->openingCode;$node->content=substr($node->content,strlen($m1[0]),-strlen($m2[0]));$node->closingCode.=$m2[0];}if(empty($node->data->leave)){if(!empty($node->data->dynamic)){$node->content.='<?php if (isset($_dynSnippets)) return $_dynSnippets; ?>';}$this->namedBlocks[$node->data->name]=$tmp=rtrim(ltrim($node->content,"\n")," \t");$node->content=substr_replace($node->content,$node->openingCode."\n",strspn($node->content,"\n"),strlen($tmp));$node->openingCode="<?php ?>";}}elseif($node->modifiers){return$writer->write('echo %modify(ob_get_clean())');}}function
macroIfset(NMacroNode$node,NPhpWriter$writer){if(!NStrings::contains($node->args,'#')){return
FALSE;}$list=array();while(($name=$node->tokenizer->fetchWord())!==FALSE){$list[]=$name[0]==='#'?'$_l->blocks["'.substr($name,1).'"]':$name;}return'if (isset('.implode(', ',$list).')) {';}function
macroControl(NMacroNode$node,NPhpWriter$writer){$pair=$node->tokenizer->fetchWord();if($pair===FALSE){throw
new
NCompileException("Missing control name in {control}");}$pair=explode(':',$pair,2);$name=$writer->formatWord($pair[0]);$method=isset($pair[1])?ucfirst($pair[1]):'';$method=NStrings::match($method,'#^\w*\z#')?"render$method":"{\"render$method\"}";$param=$writer->formatArray();if(!NStrings::contains($node->args,'=>')){$param=substr($param,6,-1);}return($name[0]==='$'?"if (is_object($name)) \$_ctrl = $name; else ":'').'$_ctrl = $_control->getComponent('.$name.'); '.'if ($_ctrl instanceof IRenderable) $_ctrl->validateControl(); '."\$_ctrl->$method($param)";}function
macroLink(NMacroNode$node,NPhpWriter$writer){return$writer->write('echo %escape(%modify('.($node->name==='plink'?'$_presenter':'$_control').'->link(%node.word, %node.array?)))');}function
macroIfCurrent(NMacroNode$node,NPhpWriter$writer){return$writer->write(($node->args?'try { $_presenter->link(%node.word, %node.array?); } catch (NInvalidLinkException $e) {}':'').'; if ($_presenter->getLastCreatedRequestFlag("current")) {');}function
macroContentType(NMacroNode$node,NPhpWriter$writer){if(NStrings::contains($node->args,'xhtml')){$this->getCompiler()->setContentType(NLatteCompiler::CONTENT_XHTML);}elseif(NStrings::contains($node->args,'html')){$this->getCompiler()->setContentType(NLatteCompiler::CONTENT_HTML);}elseif(NStrings::contains($node->args,'xml')){$this->getCompiler()->setContentType(NLatteCompiler::CONTENT_XML);}elseif(NStrings::contains($node->args,'javascript')){$this->getCompiler()->setContentType(NLatteCompiler::CONTENT_JS);}elseif(NStrings::contains($node->args,'css')){$this->getCompiler()->setContentType(NLatteCompiler::CONTENT_CSS);}elseif(NStrings::contains($node->args,'calendar')){$this->getCompiler()->setContentType(NLatteCompiler::CONTENT_ICAL);}else{$this->getCompiler()->setContentType(NLatteCompiler::CONTENT_TEXT);}if(NStrings::contains($node->args,'/')){return$writer->write('$netteHttpResponse->setHeader("Content-Type", %var)',$node->args);}}function
macroStatus(NMacroNode$node,NPhpWriter$writer){return$writer->write((substr($node->args,-1)==='?'?'if (!$netteHttpResponse->isSent()) ':'').'$netteHttpResponse->setCode(%var)',(int)$node->args);}static
function
callBlock(stdClass$context,$name,array$params){if(empty($context->blocks[$name])){throw
new
InvalidStateException("Cannot include undefined block '$name'.");}$block=reset($context->blocks[$name]);$block($context,$params);}static
function
callBlockParent(stdClass$context,$name,array$params){if(empty($context->blocks[$name])||($block=next($context->blocks[$name]))===FALSE){throw
new
InvalidStateException("Cannot include undefined parent block '$name'.");}$block($context,$params);prev($context->blocks[$name]);}static
function
renderSnippets(NControl$control,stdClass$local,array$params){$control->snippetMode=FALSE;$payload=$control->getPresenter()->getPayload();if(isset($local->blocks)){foreach($local->blocks
as$name=>$function){if($name[0]!=='_'||!$control->isControlInvalid(substr($name,1))){continue;}ob_start();$function=reset($function);$snippets=$function($local,$params);$payload->snippets[$id=$control->getSnippetId(substr($name,1))]=ob_get_clean();if($snippets){$payload->snippets+=$snippets;unset($payload->snippets[$id]);}}}$control->snippetMode=TRUE;if($control
instanceof
IRenderable){$queue=array($control);do{foreach(array_shift($queue)->getComponents()as$child){if($child
instanceof
IRenderable){if($child->isControlInvalid()){$child->snippetMode=TRUE;$child->render();$child->snippetMode=FALSE;}}elseif($child
instanceof
IComponentContainer){$queue[]=$child;}}}while($queue);}}}class
NTokenizer
extends
NObject{public$tokens;public$position=0;public$ignored=array();private$input;private$re;private$types;public$current;function
__construct(array$patterns,$flags=''){$this->re='~('.implode(')|(',$patterns).')~A'.$flags;$keys=array_keys($patterns);$this->types=$keys===range(0,count($patterns)-1)?FALSE:$keys;}function
tokenize($input){$this->input=$input;if($this->types){$this->tokens=NStrings::matchAll($input,$this->re);$len=0;$count=count($this->types);$line=1;foreach($this->tokens
as&$match){$type=NULL;for($i=1;$i<=$count;$i++){if(!isset($match[$i])){break;}elseif($match[$i]!=NULL){$type=$this->types[$i-1];break;}}$match=self::createToken($match[0],$type,$line);$len+=strlen($match['value']);$line+=substr_count($match['value'],"\n");}if($len!==strlen($input)){$errorOffset=$len;}}else{$this->tokens=NStrings::split($input,$this->re,PREG_SPLIT_NO_EMPTY);if($this->tokens&&!NStrings::match(end($this->tokens),$this->re)){$tmp=NStrings::split($this->input,$this->re,PREG_SPLIT_NO_EMPTY|PREG_SPLIT_OFFSET_CAPTURE);list(,$errorOffset)=end($tmp);}}if(isset($errorOffset)){$line=$errorOffset?substr_count($this->input,"\n",0,$errorOffset)+1:1;$col=$errorOffset-strrpos(substr($this->input,0,$errorOffset),"\n")+1;$token=str_replace("\n",'\n',substr($input,$errorOffset,10));throw
new
NTokenizerException("Unexpected '$token' on line $line, column $col.");}return$this->tokens;}static
function
createToken($value,$type=NULL,$line=NULL){return
array('value'=>$value,'type'=>$type,'line'=>$line);}function
getOffset($i){$tokens=NStrings::split($this->input,$this->re,PREG_SPLIT_NO_EMPTY|PREG_SPLIT_OFFSET_CAPTURE);$offset=isset($tokens[$i])?$tokens[$i][1]:strlen($this->input);return
array($offset,($offset?substr_count($this->input,"\n",0,$offset)+1:1),$offset-strrpos(substr($this->input,0,$offset),"\n"));}function
fetch(){return$this->scan(func_get_args(),TRUE);}function
fetchToken(){return$this->scan(func_get_args(),TRUE)===FALSE?FALSE:$this->current;}function
fetchAll(){return$this->scan(func_get_args(),FALSE);}function
fetchUntil($arg){return$this->scan(func_get_args(),FALSE,TRUE,TRUE);}function
isNext($arg){return(bool)$this->scan(func_get_args(),TRUE,FALSE);}function
isPrev($arg){return(bool)$this->scan(func_get_args(),TRUE,FALSE,FALSE,TRUE);}function
hasNext(){return
isset($this->tokens[$this->position]);}function
hasPrev(){return$this->position>1;}function
isCurrent($arg){$args=func_get_args();if(is_array($this->current)){return
in_array($this->current['value'],$args,TRUE)||in_array($this->current['type'],$args,TRUE);}else{return
in_array($this->current,$args,TRUE);}}function
reset(){$this->position=0;$this->current=NULL;}private
function
scan($wanted,$first,$advance=TRUE,$neg=FALSE,$prev=FALSE){$res=FALSE;$pos=$this->position+($prev?-2:0);while(isset($this->tokens[$pos])){$token=$this->tokens[$pos];$pos+=$prev?-1:1;$value=is_array($token)?$token['value']:$token;$type=is_array($token)?$token['type']:$token;if(!$wanted||(in_array($value,$wanted,TRUE)||in_array($type,$wanted,TRUE))^$neg){if($advance){$this->position=$pos;$this->current=$token;}$res.=$value;if($first){break;}}elseif($neg||!in_array($type,$this->ignored,TRUE)){break;}}return$res;}}class
NTokenizerException
extends
Exception{}class
NMacroTokenizer
extends
NTokenizer{const
T_WHITESPACE=1,T_COMMENT=2,T_SYMBOL=3,T_NUMBER=4,T_VARIABLE=5,T_STRING=6,T_CAST=7,T_KEYWORD=8,T_CHAR=9;function
__construct($input){parent::__construct(array(self::T_WHITESPACE=>'\s+',self::T_COMMENT=>'(?s)/\*.*?\*/',self::T_STRING=>NParser::RE_STRING,self::T_KEYWORD=>'(?:true|false|null|and|or|xor|clone|new|instanceof|return|continue|break|endif|endforeach|endwhile|endswitch|[A-Z_][A-Z0-9_]{2,})(?![\w\pL_])',self::T_CAST=>'\((?:expand|string|array|int|integer|float|bool|boolean|object)\)',self::T_VARIABLE=>'\$[\w\pL_]+',self::T_NUMBER=>'[+-]?[0-9]+(?:\.[0-9]+)?(?:e[0-9]+)?',self::T_SYMBOL=>'[\w\pL_]+(?:-[\w\pL_]+)*',self::T_CHAR=>'::|=>|->|\+\+|--|<<|>>|<=|>=|===|!==|==|!=|<>|&&|\|\||[^"\']'),'u');$this->ignored=array(self::T_COMMENT,self::T_WHITESPACE);$this->tokenize($input);}function
fetchWord(){$word=$this->fetchUntil(self::T_WHITESPACE,',');$this->fetch(',');$this->fetchAll(self::T_WHITESPACE,self::T_COMMENT);return$word;}}class
NParser
extends
NObject{const
RE_STRING='\'(?:\\\\.|[^\'\\\\])*\'|"(?:\\\\.|[^"\\\\])*"';const
N_PREFIX='n:';public$defaultSyntax='latte';public$syntaxes=array('latte'=>array('\\{(?![\\s\'"{}])','\\}'),'double'=>array('\\{\\{(?![\\s\'"{}])','\\}\\}'),'asp'=>array('<%\s*','\s*%>'),'python'=>array('\\{[{%]\s*','\s*[%}]\\}'),'off'=>array('[^\x00-\xFF]',''));private$macroRe;private$input;private$output;private$offset;private$context;private$lastHtmlTag;private$syntaxEndTag;private$xmlMode;const
CONTEXT_TEXT='text',CONTEXT_CDATA='cdata',CONTEXT_TAG='tag',CONTEXT_ATTRIBUTE='attribute',CONTEXT_NONE='none',CONTEXT_COMMENT='comment';function
parse($input){if(substr($input,0,3)==="\xEF\xBB\xBF"){$input=substr($input,3);}if(!NStrings::checkEncoding($input)){throw
new
InvalidArgumentException('Template is not valid UTF-8 stream.');}$input=str_replace("\r\n","\n",$input);$this->input=$input;$this->output=array();$this->offset=0;$this->setSyntax($this->defaultSyntax);$this->setContext(self::CONTEXT_TEXT);$this->lastHtmlTag=$this->syntaxEndTag=NULL;while($this->offset<strlen($input)){$matches=$this->{"context".$this->context[0]}();if(!$matches){break;}elseif(!empty($matches['comment'])){$this->addToken(NLatteToken::COMMENT,$matches[0]);}elseif(!empty($matches['macro'])){$token=$this->addToken(NLatteToken::MACRO_TAG,$matches[0]);list($token->name,$token->value,$token->modifiers)=$this->parseMacroTag($matches['macro']);}$this->filter();}if($this->offset<strlen($input)){$this->addToken(NLatteToken::TEXT,substr($this->input,$this->offset));}return$this->output;}private
function
contextText(){$matches=$this->match('~
			(?:(?<=\n|^)[ \t]*)?<(?P<closing>/?)(?P<tag>[a-z0-9:]+)|  ##  begin of HTML tag <tag </tag - ignores <!DOCTYPE
			<(?P<htmlcomment>!--(?!>))|     ##  begin of HTML comment <!--, but not <!-->
			'.$this->macroRe.'              ##  macro tag
		~xsi');if(!empty($matches['htmlcomment'])){$this->addToken(NLatteToken::HTML_TAG_BEGIN,$matches[0]);$this->setContext(self::CONTEXT_COMMENT);}elseif(!empty($matches['tag'])){$token=$this->addToken(NLatteToken::HTML_TAG_BEGIN,$matches[0]);$token->name=$matches['tag'];$token->closing=(bool)$matches['closing'];$this->lastHtmlTag=$matches['closing'].strtolower($matches['tag']);$this->setContext(self::CONTEXT_TAG);}return$matches;}private
function
contextCData(){$matches=$this->match('~
			</(?P<tag>'.$this->lastHtmlTag.')(?![a-z0-9:])| ##  end HTML tag </tag
			'.$this->macroRe.'              ##  macro tag
		~xsi');if(!empty($matches['tag'])){$token=$this->addToken(NLatteToken::HTML_TAG_BEGIN,$matches[0]);$token->name=$this->lastHtmlTag;$token->closing=TRUE;$this->lastHtmlTag='/'.$this->lastHtmlTag;$this->setContext(self::CONTEXT_TAG);}return$matches;}private
function
contextTag(){$matches=$this->match('~
			(?P<end>\ ?/?>)([ \t]*\n)?|  ##  end of HTML tag
			'.$this->macroRe.'|          ##  macro tag
			\s*(?P<attr>[^\s/>={]+)(?:\s*=\s*(?P<value>["\']|[^\s/>{]+))? ## begin of HTML attribute
		~xsi');if(!empty($matches['end'])){$this->addToken(NLatteToken::HTML_TAG_END,$matches[0]);$this->setContext(!$this->xmlMode&&in_array($this->lastHtmlTag,array('script','style'),TRUE)?self::CONTEXT_CDATA:self::CONTEXT_TEXT);}elseif(isset($matches['attr'])&&$matches['attr']!==''){$token=$this->addToken(NLatteToken::HTML_ATTRIBUTE,$matches[0]);$token->name=$matches['attr'];$token->value=isset($matches['value'])?$matches['value']:'';if($token->value==='"'||$token->value==="'"){if(NStrings::startsWith($token->name,self::N_PREFIX)){$token->value='';if($m=$this->match('~(.*?)'.$matches['value'].'~xsi')){$token->value=$m[1];$token->text.=$m[0];}}else{$this->setContext(self::CONTEXT_ATTRIBUTE,$matches['value']);}}}return$matches;}private
function
contextAttribute(){$matches=$this->match('~
			(?P<quote>'.$this->context[1].')|  ##  end of HTML attribute
			'.$this->macroRe.'                 ##  macro tag
		~xsi');if(!empty($matches['quote'])){$this->addToken(NLatteToken::TEXT,$matches[0]);$this->setContext(self::CONTEXT_TAG);}return$matches;}private
function
contextComment(){$matches=$this->match('~
			(?P<htmlcomment>-->)|   ##  end of HTML comment
			'.$this->macroRe.'      ##  macro tag
		~xsi');if(!empty($matches['htmlcomment'])){$this->addToken(NLatteToken::HTML_TAG_END,$matches[0]);$this->setContext(self::CONTEXT_TEXT);}return$matches;}private
function
contextNone(){$matches=$this->match('~
			'.$this->macroRe.'     ##  macro tag
		~xsi');return$matches;}private
function
match($re){if($matches=NStrings::match($this->input,$re,PREG_OFFSET_CAPTURE,$this->offset)){$value=substr($this->input,$this->offset,$matches[0][1]-$this->offset);if($value!==''){$this->addToken(NLatteToken::TEXT,$value);}$this->offset=$matches[0][1]+strlen($matches[0][0]);foreach($matches
as$k=>$v)$matches[$k]=$v[0];}return$matches;}function
setContext($context,$quote=NULL){$this->context=array($context,$quote);return$this;}function
setSyntax($type){$type=($tmp=$type)?$tmp:$this->defaultSyntax;if(isset($this->syntaxes[$type])){$this->setDelimiters($this->syntaxes[$type][0],$this->syntaxes[$type][1]);}else{throw
new
InvalidArgumentException("Unknown syntax '$type'");}return$this;}function
setDelimiters($left,$right){$this->macroRe='
			(?P<comment>'.$left.'\\*.*?\\*'.$right.'\n{0,2})|
			'.$left.'
				(?P<macro>(?:'.self::RE_STRING.'|\{
						(?P<inner>'.self::RE_STRING.'|\{(?P>inner)\}|[^\'"{}])*+
				\}|[^\'"{}])+?)
			'.$right.'
			(?P<rmargin>[ \t]*(?=\n))?
		';return$this;}function
parseMacroTag($tag){$match=NStrings::match($tag,'~^
			(
				(?P<name>\?|/?[a-z]\w*+(?:[.:]\w+)*+(?!::|\(|\\\\))|   ## ?, name, /name, but not function( or class:: or namespace\
				(?P<noescape>!?)(?P<shortname>/?[=\~#%^&_]?)      ## !expression, !=expression, ...
			)(?P<args>.*?)
			(?P<modifiers>\|[a-z](?:'.NParser::RE_STRING.'|[^\'"])*)?
		()\z~isx');if(!$match){return
FALSE;}$modifiers=preg_replace('#\|noescape\s?(?=\||\z)#i','',$match['modifiers'],-1,$noescape);if($match['name']===''){$match['name']=($tmp=$match['shortname'])?$tmp:'=';if(!$noescape&&!$match['noescape']&&substr($match['shortname'],0,1)!=='/'){$modifiers.='|escape';}}return
array($match['name'],trim($match['args']),$modifiers);}private
function
addToken($type,$text){$this->output[]=$token=new
NLatteToken;$token->type=$type;$token->text=$text;$token->line=substr_count($this->input,"\n",0,max(1,$this->offset-1))+1;return$token;}protected
function
filter(){$token=end($this->output);if($token->type===NLatteToken::MACRO_TAG&&$token->name==='/syntax'){$this->setSyntax($this->defaultSyntax);$token->type=NLatteToken::COMMENT;}elseif($token->type===NLatteToken::MACRO_TAG&&$token->name==='syntax'){$this->setSyntax($token->value);$token->type=NLatteToken::COMMENT;}elseif($token->type===NLatteToken::HTML_ATTRIBUTE&&$token->name==='n:syntax'){$this->setSyntax($token->value);$this->syntaxEndTag='/'.$this->lastHtmlTag;$token->type=NLatteToken::COMMENT;}elseif($token->type===NLatteToken::HTML_TAG_END&&$this->lastHtmlTag===$this->syntaxEndTag){$this->setSyntax($this->defaultSyntax);}elseif($token->type===NLatteToken::MACRO_TAG&&$token->name==='contentType'){if(preg_match('#html|xml#',$token->value,$m)){$this->xmlMode=$m[0]==='xml';$this->setContext(self::CONTEXT_TEXT);}else{$this->setContext(self::CONTEXT_NONE);}}}}class
NPhpWriter
extends
NObject{private$argsTokenizer;private$modifiers;private$compiler;static
function
using(NMacroNode$node,NLatteCompiler$compiler=NULL){return
new
self($node->tokenizer,$node->modifiers,$compiler);}function
__construct(NMacroTokenizer$argsTokenizer,$modifiers=NULL,NLatteCompiler$compiler=NULL){$this->argsTokenizer=$argsTokenizer;$this->modifiers=$modifiers;$this->compiler=$compiler;}function
write($mask){$args=func_get_args();array_shift($args);$word=strpos($mask,'%node.word')===FALSE?NULL:$this->argsTokenizer->fetchWord();$me=$this;$mask=NStrings::replace($mask,'#%escape(\(([^()]*+|(?1))+\))#',create_function('$m','extract($GLOBALS[0]['.array_push($GLOBALS[0],array('me'=>$me)).'-1], EXTR_REFS);
			return $me->escape(substr($m[1], 1, -1));
		'));$mask=NStrings::replace($mask,'#%modify(\(([^()]*+|(?1))+\))#',create_function('$m','extract($GLOBALS[0]['.array_push($GLOBALS[0],array('me'=>$me)).'-1], EXTR_REFS);
			return $me->formatModifiers(substr($m[1], 1, -1));
		'));return
NStrings::replace($mask,'#([,+]\s*)?%(node\.word|node\.array|node\.args|var|raw)(\?)?(\s*\+\s*)?()#',create_function('$m','extract($GLOBALS[0]['.array_push($GLOBALS[0],array('me'=>$me,'word'=>$word,'args'=>&$args)).'-1], EXTR_REFS);
			list(, $l, $macro, $cond, $r) = $m;

			switch ($macro) {
				case \'node.word\':
					$code = $me->formatWord($word); break;
				case \'node.args\':
					$code = $me->formatArgs(); break;
				case \'node.array\':
					$code = $me->formatArray();
					$code = $cond && $code === \'array()\' ? \'\' : $code; break;
				case \'var\':
					$code = var_export(array_shift($args), TRUE); break;
				case \'raw\':
					$code = (string) array_shift($args); break;
			}

			if ($cond && $code === \'\') {
				return $r ? $l : $r;
			} else {
				return $l . $code . $r;
			}
		'));}function
formatModifiers($var){$modifiers=ltrim($this->modifiers,'|');if(!$modifiers){return$var;}$tokenizer=$this->preprocess(new
NMacroTokenizer($modifiers));$inside=FALSE;while($token=$tokenizer->fetchToken()){if($token['type']===NMacroTokenizer::T_WHITESPACE){$var=rtrim($var).' ';}elseif(!$inside){if($token['type']===NMacroTokenizer::T_SYMBOL){if($this->compiler&&$token['value']==='escape'){$var=$this->escape($var);$tokenizer->fetch('|');}else{$var="\$template->".$token['value']."($var";$inside=TRUE;}}else{throw
new
NCompileException("Modifier name must be alphanumeric string, '$token[value]' given.");}}else{if($token['value']===':'||$token['value']===','){$var=$var.', ';}elseif($token['value']==='|'){$var=$var.')';$inside=FALSE;}else{$var.=$this->canQuote($tokenizer)?"'$token[value]'":$token['value'];}}}return$inside?"$var)":$var;}function
formatArgs(){$out='';$tokenizer=$this->preprocess();while($token=$tokenizer->fetchToken()){$out.=$this->canQuote($tokenizer)?"'$token[value]'":$token['value'];}return$out;}function
formatArray(){$out='';$expand=NULL;$tokenizer=$this->preprocess();while($token=$tokenizer->fetchToken()){if($token['value']==='(expand)'&&$token['depth']===0){$expand=TRUE;$out.='),';}elseif($expand&&($token['value']===',')&&!$token['depth']){$expand=FALSE;$out.=', array(';}else{$out.=$this->canQuote($tokenizer)?"'$token[value]'":$token['value'];}}if($expand===NULL){return"array($out)";}else{return"array_merge(array($out".($expand?', array(':'')."))";}}function
formatWord($s){return(is_numeric($s)||preg_match('#^\$|[\'"]|^true\z|^false\z|^null\z#i',$s))?$s:'"'.$s.'"';}function
canQuote(NMacroTokenizer$tokenizer){return$tokenizer->isCurrent(NMacroTokenizer::T_SYMBOL)&&(!$tokenizer->hasPrev()||$tokenizer->isPrev(',','(','[','=>',':','?','.','<','>','<=','>=','===','!==','==','!=','<>','&&','||','=','and','or','xor'))&&(!$tokenizer->hasNext()||$tokenizer->isNext(',',';',')',']','=>',':','?','.','<','>','<=','>=','===','!==','==','!=','<>','&&','||','and','or','xor'));}function
preprocess(NMacroTokenizer$tokenizer=NULL){$tokenizer=$tokenizer===NULL?$this->argsTokenizer:$tokenizer;$inTernary=$prev=NULL;$tokens=$arrays=array();while($token=$tokenizer->fetchToken()){$token['depth']=$depth=count($arrays);if($token['type']===NMacroTokenizer::T_COMMENT){continue;}elseif($token['type']===NMacroTokenizer::T_WHITESPACE){$tokens[]=$token;continue;}if($token['value']==='?'){$inTernary=$depth;}elseif($token['value']===':'){$inTernary=NULL;}elseif($inTernary===$depth&&($token['value']===','||$token['value']===')'||$token['value']===']')){$tokens[]=NMacroTokenizer::createToken(':')+array('depth'=>$depth);$tokens[]=NMacroTokenizer::createToken('null')+array('depth'=>$depth);$inTernary=NULL;}if($token['value']==='['){if($arrays[]=$prev['value']!==']'&&$prev['value']!==')'&&$prev['type']!==NMacroTokenizer::T_SYMBOL&&$prev['type']!==NMacroTokenizer::T_VARIABLE&&$prev['type']!==NMacroTokenizer::T_KEYWORD){$tokens[]=NMacroTokenizer::createToken('array')+array('depth'=>$depth);$token=NMacroTokenizer::createToken('(');}}elseif($token['value']===']'){if(array_pop($arrays)===TRUE){$token=NMacroTokenizer::createToken(')');}}elseif($token['value']==='('){$arrays[]='(';}elseif($token['value']===')'){array_pop($arrays);}$tokens[]=$prev=$token;}if($inTernary!==NULL){$tokens[]=NMacroTokenizer::createToken(':')+array('depth'=>count($arrays));$tokens[]=NMacroTokenizer::createToken('null')+array('depth'=>count($arrays));}$tokenizer=clone$tokenizer;$tokenizer->reset();$tokenizer->tokens=$tokens;return$tokenizer;}function
escape($s){switch($this->compiler->getContentType()){case
NLatteCompiler::CONTENT_XHTML:case
NLatteCompiler::CONTENT_HTML:$context=$this->compiler->getContext();switch($context[0]){case
NLatteCompiler::CONTEXT_SINGLE_QUOTED:case
NLatteCompiler::CONTEXT_DOUBLE_QUOTED:if($context[1]===NLatteCompiler::CONTENT_JS){$s="NTemplateHelpers::escapeJs($s)";}elseif($context[1]===NLatteCompiler::CONTENT_CSS){$s="NTemplateHelpers::escapeCss($s)";}$quote=$context[0]===NLatteCompiler::CONTEXT_DOUBLE_QUOTED?', ENT_COMPAT':', ENT_QUOTES';return"NTemplateHelpers::escapeHtml($s$quote)";case
NLatteCompiler::CONTEXT_COMMENT:return"NTemplateHelpers::escapeHtmlComment($s)";case
NLatteCompiler::CONTENT_JS:case
NLatteCompiler::CONTENT_CSS:return'NTemplateHelpers::escape'.ucfirst($context[0])."($s)";default:return"NTemplateHelpers::escapeHtml($s, ENT_NOQUOTES)";}case
NLatteCompiler::CONTENT_XML:$context=$this->compiler->getContext();if($context[0]===NLatteCompiler::CONTEXT_COMMENT){return"NTemplateHelpers::escapeHtmlComment($s)";}case
NLatteCompiler::CONTENT_JS:case
NLatteCompiler::CONTENT_CSS:case
NLatteCompiler::CONTENT_ICAL:return'NTemplateHelpers::escape'.ucfirst($this->compiler->getContentType())."($s)";case
NLatteCompiler::CONTENT_TEXT:return$s;default:return"\$template->escape($s)";}}}class
NLatteToken
extends
NObject{const
TEXT='text',MACRO_TAG='macroTag',HTML_TAG_BEGIN='htmlTagBegin',HTML_TAG_END='htmlTagEnd',HTML_ATTRIBUTE='htmlAttribute',COMMENT='comment';public$type;public$text;public$line;public$name;public$value;public$modifiers;public$closing;}class
NRobotLoader
extends
NAutoLoader{const
RETRY_LIMIT=3;public$scanDirs=array();public$ignoreDirs='.*, *.old, *.bak, *.tmp, temp';public$acceptFiles='*.php, *.php5';public$autoRebuild=TRUE;private$classes=array();private$rebuilt=FALSE;private$missing=array();private$cacheStorage;function
__construct(){if(!extension_loaded('tokenizer')){throw
new
NotSupportedException("PHP extension Tokenizer is not loaded.");}}function
register(){$this->classes=$this->getCache()->load($this->getKey(),new
NCallback($this,'_rebuildCallback'));parent::register();return$this;}function
tryLoad($type){$type=ltrim(strtolower($type),'\\');$info=&$this->classes[$type];if(isset($this->missing[$type])||(is_int($info)&&$info>=self::RETRY_LIMIT)){return;}if($this->autoRebuild){if(!is_array($info)||!is_file($info['file'])){$info=is_int($info)?$info+1:0;if($this->rebuilt){$this->getCache()->save($this->getKey(),$this->classes,array(NCache::CONSTS=>'NFramework::REVISION'));}else{$this->rebuild();}}elseif(!$this->rebuilt&&filemtime($info['file'])!==$info['time']){$this->updateFile($info['file']);if(!isset($this->classes[$type])){$this->classes[$type]=0;}$this->getCache()->save($this->getKey(),$this->classes,array(NCache::CONSTS=>'NFramework::REVISION'));}}if(isset($this->classes[$type]['file'])){NLimitedScope::load($this->classes[$type]['file'],TRUE);self::$count++;}else{$this->missing[$type]=TRUE;}}function
addDirectory($path){foreach((array)$path
as$val){$real=realpath($val);if($real===FALSE){throw
new
DirectoryNotFoundException("Directory '$val' not found.");}$this->scanDirs[]=$real;}return$this;}function
getIndexedClasses(){$res=array();foreach($this->classes
as$info){if(is_array($info)){$res[$info['orig']]=$info['file'];}}return$res;}function
rebuild(){$this->rebuilt=TRUE;$this->getCache()->save($this->getKey(),new
NCallback($this,'_rebuildCallback'));}function
_rebuildCallback(&$dp){$files=$missing=array();foreach($this->classes
as$class=>$info){if(is_array($info)){$files[$info['file']]['time']=$info['time'];$files[$info['file']]['classes'][]=$info['orig'];}else{$missing[$class]=$info;}}$this->classes=array();foreach(array_unique($this->scanDirs)as$dir){foreach($this->createFileIterator($dir)as$file){$file=$file->getPathname();if(isset($files[$file])&&$files[$file]['time']==filemtime($file)){$classes=$files[$file]['classes'];}else{$classes=$this->scanPhp(file_get_contents($file));}foreach($classes
as$class){$info=&$this->classes[strtolower($class)];if(isset($info['file'])){$e=new
InvalidStateException("Ambiguous class $class resolution; defined in {$info['file']} and in $file.");if(PHP_VERSION_ID<50300){NDebugger::_exceptionHandler($e);exit;}else{throw$e;}}$info=array('file'=>$file,'time'=>filemtime($file),'orig'=>$class);}}}$dp=array(NCache::CONSTS=>'NFramework::REVISION');$this->classes+=$missing;return$this->classes;}private
function
createFileIterator($dir){if(!is_dir($dir)){return
new
ArrayIterator(array(new
SplFileInfo($dir)));}$ignoreDirs=is_array($this->ignoreDirs)?$this->ignoreDirs:preg_split('#[,\s]+#',$this->ignoreDirs);$disallow=array();foreach($ignoreDirs
as$item){if($item=realpath($item)){$disallow[$item]=TRUE;}}$iterator=NFinder::findFiles(is_array($this->acceptFiles)?$this->acceptFiles:preg_split('#[,\s]+#',$this->acceptFiles))->filter(create_function('$file','extract($GLOBALS[0]['.array_push($GLOBALS[0],array('disallow'=>&$disallow)).'-1], EXTR_REFS);
				return !isset($disallow[$file->getPathname()]);
			'))->from($dir)->exclude($ignoreDirs)->filter($filter=create_function('$dir','extract($GLOBALS[0]['.array_push($GLOBALS[0],array('disallow'=>&$disallow)).'-1], EXTR_REFS);
				$path = $dir->getPathname();
				if (is_file("$path/netterobots.txt")) {
					foreach (file("$path/netterobots.txt") as $s) {
					if (preg_match(\'#^(?:disallow\\\\s*:)?\\\\s*(\\\\S+)#i\', $s, $matches)) {
							$disallow[$path . str_replace(\'/\', DIRECTORY_SEPARATOR, rtrim(\'/\' . ltrim($matches[1], \'/\'), \'/\'))] = TRUE;
						}
					}
				}
				return !isset($disallow[$path]);
			'));$filter(new
SplFileInfo($dir));return$iterator;}private
function
updateFile($file){foreach($this->classes
as$class=>$info){if(isset($info['file'])&&$info['file']===$file){unset($this->classes[$class]);}}if(is_file($file)){foreach($this->scanPhp(file_get_contents($file))as$class){$info=&$this->classes[strtolower($class)];if(isset($info['file'])&&@filemtime($info['file'])!==$info['time']){$this->updateFile($info['file']);$info=&$this->classes[strtolower($class)];}if(isset($info['file'])){$e=new
InvalidStateException("Ambiguous class $class resolution; defined in {$info['file']} and in $file.");if(PHP_VERSION_ID<50300){NDebugger::_exceptionHandler($e);exit;}else{throw$e;}}$info=array('file'=>$file,'time'=>filemtime($file),'orig'=>$class);}}}private
function
scanPhp($code){$T_NAMESPACE=PHP_VERSION_ID<50300?-1:T_NAMESPACE;$T_NS_SEPARATOR=PHP_VERSION_ID<50300?-1:T_NS_SEPARATOR;$T_TRAIT=PHP_VERSION_ID<50400?-1:T_TRAIT;$expected=FALSE;$namespace='';$level=$minLevel=0;$classes=array();if(preg_match('#//nette'.'loader=(\S*)#',$code,$matches)){foreach(explode(',',$matches[1])as$name){$classes[]=$name;}return$classes;}foreach(@token_get_all($code)as$token){if(is_array($token)){switch($token[0]){case
T_COMMENT:case
T_DOC_COMMENT:case
T_WHITESPACE:continue
2;case$T_NS_SEPARATOR:case
T_STRING:if($expected){$name.=$token[1];}continue
2;case$T_NAMESPACE:case
T_CLASS:case
T_INTERFACE:case$T_TRAIT:$expected=$token[0];$name='';continue
2;case
T_CURLY_OPEN:case
T_DOLLAR_OPEN_CURLY_BRACES:$level++;}}if($expected){switch($expected){case
T_CLASS:case
T_INTERFACE:case$T_TRAIT:if($name&&$level===$minLevel){$classes[]=$namespace.$name;}break;case$T_NAMESPACE:$namespace=$name?$name.'\\':'';$minLevel=$token==='{'?1:0;}$expected=NULL;}if($token==='{'){$level++;}elseif($token==='}'){$level--;}}return$classes;}function
setCacheStorage(ICacheStorage$storage){$this->cacheStorage=$storage;return$this;}function
getCacheStorage(){return$this->cacheStorage;}protected
function
getCache(){if(!$this->cacheStorage){trigger_error('Missing cache storage.',E_USER_WARNING);$this->cacheStorage=new
NDevNullStorage;}return
new
NCache($this->cacheStorage,'Nette.RobotLoader');}protected
function
getKey(){return
array($this->ignoreDirs,$this->acceptFiles,$this->scanDirs);}}class
NAnnotation
extends
NObject
implements
IAnnotation{function
__construct(array$values){foreach($values
as$k=>$v){$this->$k=$v;}}function
__toString(){return$this->value;}}/**
 * Annotations support for PHP.
 *
 * @author     David Grudl
 * @Annotation
 * @package Nette\Reflection
 */class
NAnnotationsParser{const
RE_STRING='\'(?:\\\\.|[^\'\\\\])*\'|"(?:\\\\.|[^"\\\\])*"';const
RE_IDENTIFIER='[_a-zA-Z\x7F-\xFF][_a-zA-Z0-9\x7F-\xFF-\\\]*';public
static$useReflection;public
static$inherited=array('description','param','return');private
static$cache;private
static$timestamps;private
static$cacheStorage;final
function
__construct(){throw
new
NStaticClassException;}static
function
getAll(Reflector$r){if($r
instanceof
ReflectionClass){$type=$r->getName();$member='';}elseif($r
instanceof
ReflectionMethod){$type=$r->getDeclaringClass()->getName();$member=$r->getName();}else{$type=$r->getDeclaringClass()->getName();$member='$'.$r->getName();}if(!self::$useReflection){$file=$r
instanceof
ReflectionClass?$r->getFileName():$r->getDeclaringClass()->getFileName();if($file&&isset(self::$timestamps[$file])&&self::$timestamps[$file]!==filemtime($file)){unset(self::$cache[$type]);}unset(self::$timestamps[$file]);}if(isset(self::$cache[$type][$member])){return
self::$cache[$type][$member];}if(self::$useReflection===NULL){self::$useReflection=(bool)NClassReflection::from(__CLASS__)->getDocComment();}if(self::$useReflection){$annotations=self::parseComment($r->getDocComment());}else{if(!self::$cacheStorage){self::$cacheStorage=new
NDevNullStorage;}$outerCache=new
NCache(self::$cacheStorage,'Nette.Reflection.Annotations');if(self::$cache===NULL){self::$cache=(array)$outerCache->offsetGet('list');self::$timestamps=isset(self::$cache['*'])?self::$cache['*']:array();}if(!isset(self::$cache[$type])&&$file){self::$cache['*'][$file]=filemtime($file);self::parseScript($file);$outerCache->save('list',self::$cache);}if(isset(self::$cache[$type][$member])){$annotations=self::$cache[$type][$member];}else{$annotations=array();}}if($r
instanceof
ReflectionMethod&&!$r->isPrivate()&&(!$r->isConstructor()||!empty($annotations['inheritdoc'][0]))){try{$inherited=self::getAll(new
ReflectionMethod(get_parent_class($type),$member));}catch(ReflectionException$e){try{$inherited=self::getAll($r->getPrototype());}catch(ReflectionException$e){$inherited=array();}}$annotations+=array_intersect_key($inherited,array_flip(self::$inherited));}return
self::$cache[$type][$member]=$annotations;}private
static
function
parseComment($comment){static$tokens=array('true'=>TRUE,'false'=>FALSE,'null'=>NULL,''=>TRUE);$res=array();$comment=preg_replace('#^\s*\*\s?#ms','',trim($comment,'/*'));$parts=preg_split('#^\s*(?=@'.self::RE_IDENTIFIER.')#m',$comment,2);$description=trim($parts[0]);if($description!==''){$res['description']=array($description);}$matches=NStrings::matchAll(isset($parts[1])?$parts[1]:'','~
				(?<=\s|^)@('.self::RE_IDENTIFIER.')[ \t]*      ##  annotation
				(
					\((?>'.self::RE_STRING.'|[^\'")@]+)+\)|  ##  (value)
					[^(@\r\n][^@\r\n]*|)                     ##  value
			~xi');foreach($matches
as$match){list(,$name,$value)=$match;if(substr($value,0,1)==='('){$items=array();$key='';$val=TRUE;$value[0]=',';while($m=NStrings::match($value,'#\s*,\s*(?>('.self::RE_IDENTIFIER.')\s*=\s*)?('.self::RE_STRING.'|[^\'"),\s][^\'"),]*)#A')){$value=substr($value,strlen($m[0]));list(,$key,$val)=$m;$val=rtrim($val);if($val[0]==="'"||$val[0]==='"'){$val=substr($val,1,-1);}elseif(is_numeric($val)){$val=1*$val;}else{$lval=strtolower($val);$val=array_key_exists($lval,$tokens)?$tokens[$lval]:$val;}if($key===''){$items[]=$val;}else{$items[$key]=$val;}}$value=count($items)<2&&$key===''?$val:$items;}else{$value=trim($value);if(is_numeric($value)){$value=1*$value;}else{$lval=strtolower($value);$value=array_key_exists($lval,$tokens)?$tokens[$lval]:$value;}}$class=$name.'Annotation';if(class_exists($class)){$res[$name][]=new$class(is_array($value)?$value:array('value'=>$value));}else{$res[$name][]=is_array($value)?new
ArrayObject($value,ArrayObject::ARRAY_AS_PROPS):$value;}}return$res;}private
static
function
parseScript($file){$T_NAMESPACE=PHP_VERSION_ID<50300?-1:T_NAMESPACE;$T_NS_SEPARATOR=PHP_VERSION_ID<50300?-1:T_NS_SEPARATOR;$s=file_get_contents($file);if(NStrings::match($s,'#//nette'.'loader=(\S*)#')){return;}$expected=$namespace=$class=$docComment=NULL;$level=$classLevel=0;foreach(token_get_all($s)as$token){if(is_array($token)){switch($token[0]){case
T_DOC_COMMENT:$docComment=$token[1];case
T_WHITESPACE:case
T_COMMENT:continue
2;case
T_STRING:case$T_NS_SEPARATOR:case
T_VARIABLE:if($expected){$name.=$token[1];}continue
2;case
T_FUNCTION:case
T_VAR:case
T_PUBLIC:case
T_PROTECTED:case$T_NAMESPACE:case
T_CLASS:case
T_INTERFACE:$expected=$token[0];$name=NULL;continue
2;case
T_STATIC:case
T_ABSTRACT:case
T_FINAL:continue
2;case
T_CURLY_OPEN:case
T_DOLLAR_OPEN_CURLY_BRACES:$level++;}}if($expected){switch($expected){case
T_CLASS:case
T_INTERFACE:$class=$namespace.$name;$classLevel=$level;$name='';case
T_FUNCTION:if($token==='&'){continue
2;}case
T_VAR:case
T_PUBLIC:case
T_PROTECTED:if($class&&$name!==NULL&&$docComment){self::$cache[$class][$name]=self::parseComment($docComment);}break;case$T_NAMESPACE:$namespace=$name.'\\';}$expected=$docComment=NULL;}if($token===';'){$docComment=NULL;}elseif($token==='{'){$docComment=NULL;$level++;}elseif($token==='}'){$level--;if($level===$classLevel){$class=NULL;}}}}static
function
setCacheStorage(ICacheStorage$storage){self::$cacheStorage=$storage;}static
function
getCacheStorage(){return
self::$cacheStorage;}}class
NClassReflection
extends
ReflectionClass{private
static$extMethods;static
function
from($class){return
new
self($class);}function
__toString(){return'Class '.$this->getName();}function
hasEventProperty($name){if(preg_match('#^on[A-Z]#',$name)&&$this->hasProperty($name)){$rp=$this->getProperty($name);return$rp->isPublic()&&!$rp->isStatic();}return
FALSE;}function
setExtensionMethod($name,$callback){$l=&self::$extMethods[strtolower($name)];$l[strtolower($this->getName())]=new
NCallback($callback);$l['']=NULL;return$this;}function
getExtensionMethod($name){if(self::$extMethods===NULL||$name===NULL){$list=get_defined_functions();foreach($list['user']as$fce){$pair=explode('_prototype_',$fce);if(count($pair)===2){self::$extMethods[$pair[1]][$pair[0]]=new
NCallback($fce);self::$extMethods[$pair[1]]['']=NULL;}}if($name===NULL){return
NULL;}}$class=strtolower($this->getName());$l=&self::$extMethods[strtolower($name)];if(empty($l)){return
FALSE;}elseif(isset($l[''][$class])){return$l[''][$class];}$cl=$class;do{if(isset($l[$cl])){return$l[''][$class]=$l[$cl];}}while(($cl=strtolower(get_parent_class($cl)))!=='');foreach(class_implements($class)as$cl){$cl=strtolower($cl);if(isset($l[$cl])){return$l[''][$class]=$l[$cl];}}return$l[''][$class]=FALSE;}function
is($type){return$this->isSubclassOf($type)||strcasecmp($this->getName(),ltrim($type,'\\'))===0;}function
getConstructor(){return($ref=parent::getConstructor())?NMethodReflection::from($this->getName(),$ref->getName()):NULL;}function
getExtension(){return($name=$this->getExtensionName())?new
NExtensionReflection($name):NULL;}function
getInterfaces(){$res=array();foreach(parent::getInterfaceNames()as$val){$res[$val]=new
self($val);}return$res;}function
getMethod($name){return
new
NMethodReflection($this->getName(),$name);}function
getMethods($filter=-1){foreach($res=parent::getMethods($filter)as$key=>$val){$res[$key]=new
NMethodReflection($this->getName(),$val->getName());}return$res;}function
getParentClass(){return($ref=parent::getParentClass())?new
self($ref->getName()):NULL;}function
getProperties($filter=-1){foreach($res=parent::getProperties($filter)as$key=>$val){$res[$key]=new
NPropertyReflection($this->getName(),$val->getName());}return$res;}function
getProperty($name){return
new
NPropertyReflection($this->getName(),$name);}function
hasAnnotation($name){$res=NAnnotationsParser::getAll($this);return!empty($res[$name]);}function
getAnnotation($name){$res=NAnnotationsParser::getAll($this);return
isset($res[$name])?end($res[$name]):NULL;}function
getAnnotations(){return
NAnnotationsParser::getAll($this);}function
getDescription(){return$this->getAnnotation('description');}function
getReflection(){return
new
NClassReflection($this);}function
__call($name,$args){return
NObjectMixin::call($this,$name,$args);}function&__get($name){return
NObjectMixin::get($this,$name);}function
__set($name,$value){NObjectMixin::set($this,$name,$value);}function
__isset($name){return
NObjectMixin::has($this,$name);}function
__unset($name){NObjectMixin::remove($this,$name);}}class
NExtensionReflection
extends
ReflectionExtension{function
__toString(){return'Extension '.$this->getName();}function
getClasses(){$res=array();foreach(parent::getClassNames()as$val){$res[$val]=new
NClassReflection($val);}return$res;}function
getFunctions(){foreach($res=parent::getFunctions()as$key=>$val){$res[$key]=new
NFunctionReflection($key);}return$res;}function
getReflection(){return
new
NClassReflection($this);}function
__call($name,$args){return
NObjectMixin::call($this,$name,$args);}function&__get($name){return
NObjectMixin::get($this,$name);}function
__set($name,$value){NObjectMixin::set($this,$name,$value);}function
__isset($name){return
NObjectMixin::has($this,$name);}function
__unset($name){NObjectMixin::remove($this,$name);}}class
NFunctionReflection
extends
ReflectionFunction{private$value;function
__construct($name){parent::__construct($this->value=$name);}function
toCallback(){return
new
NCallback($this->value);}function
__toString(){return'Function '.$this->getName().'()';}function
getClosure(){return$this->isClosure()?$this->value:NULL;}function
getExtension(){return($name=$this->getExtensionName())?new
NExtensionReflection($name):NULL;}function
getParameters(){foreach($res=parent::getParameters()as$key=>$val){$res[$key]=new
NParameterReflection($this->value,$val->getName());}return$res;}function
getReflection(){return
new
NClassReflection($this);}function
__call($name,$args){return
NObjectMixin::call($this,$name,$args);}function&__get($name){return
NObjectMixin::get($this,$name);}function
__set($name,$value){NObjectMixin::set($this,$name,$value);}function
__isset($name){return
NObjectMixin::has($this,$name);}function
__unset($name){NObjectMixin::remove($this,$name);}}class
NMethodReflection
extends
ReflectionMethod{static
function
from($class,$method){return
new
self(is_object($class)?get_class($class):$class,$method);}function
toCallback(){return
new
NCallback(parent::getDeclaringClass()->getName(),$this->getName());}function
__toString(){return'Method '.parent::getDeclaringClass()->getName().'::'.$this->getName().'()';}function
getDeclaringClass(){return
new
NClassReflection(parent::getDeclaringClass()->getName());}function
getPrototype(){$prototype=parent::getPrototype();return
new
NMethodReflection($prototype->getDeclaringClass()->getName(),$prototype->getName());}function
getExtension(){return($name=$this->getExtensionName())?new
NExtensionReflection($name):NULL;}function
getParameters(){$me=array(parent::getDeclaringClass()->getName(),$this->getName());foreach($res=parent::getParameters()as$key=>$val){$res[$key]=new
NParameterReflection($me,$val->getName());}return$res;}function
hasAnnotation($name){$res=NAnnotationsParser::getAll($this);return!empty($res[$name]);}function
getAnnotation($name){$res=NAnnotationsParser::getAll($this);return
isset($res[$name])?end($res[$name]):NULL;}function
getAnnotations(){return
NAnnotationsParser::getAll($this);}function
getDescription(){return$this->getAnnotation('description');}function
getReflection(){return
new
NClassReflection($this);}function
__call($name,$args){return
NObjectMixin::call($this,$name,$args);}function&__get($name){return
NObjectMixin::get($this,$name);}function
__set($name,$value){NObjectMixin::set($this,$name,$value);}function
__isset($name){return
NObjectMixin::has($this,$name);}function
__unset($name){NObjectMixin::remove($this,$name);}}class
NParameterReflection
extends
ReflectionParameter{private$function;function
__construct($function,$parameter){parent::__construct($this->function=$function,$parameter);}function
getClass(){return($ref=parent::getClass())?new
NClassReflection($ref->getName()):NULL;}function
getClassName(){try{return($ref=parent::getClass())?$ref->getName():NULL;}catch(ReflectionException$e){if(preg_match('#Class (.+) does not exist#',$e->getMessage(),$m)){return$m[1];}throw$e;}}function
getDeclaringClass(){return($ref=parent::getDeclaringClass())?new
NClassReflection($ref->getName()):NULL;}function
getDeclaringFunction(){return
is_array($this->function)?new
NMethodReflection($this->function[0],$this->function[1]):new
NFunctionReflection($this->function);}function
isDefaultValueAvailable(){if(PHP_VERSION_ID===50316){try{$this->getDefaultValue();return
TRUE;}catch(ReflectionException$e){return
FALSE;}}return
parent::isDefaultValueAvailable();}function
__toString(){return'Parameter $'.parent::getName().' in '.$this->getDeclaringFunction();}function
getReflection(){return
new
NClassReflection($this);}function
__call($name,$args){return
NObjectMixin::call($this,$name,$args);}function&__get($name){return
NObjectMixin::get($this,$name);}function
__set($name,$value){NObjectMixin::set($this,$name,$value);}function
__isset($name){return
NObjectMixin::has($this,$name);}function
__unset($name){NObjectMixin::remove($this,$name);}}class
NPropertyReflection
extends
ReflectionProperty{function
__toString(){return'Property '.parent::getDeclaringClass()->getName().'::$'.$this->getName();}function
getDeclaringClass(){return
new
NClassReflection(parent::getDeclaringClass()->getName());}function
hasAnnotation($name){$res=NAnnotationsParser::getAll($this);return!empty($res[$name]);}function
getAnnotation($name){$res=NAnnotationsParser::getAll($this);return
isset($res[$name])?end($res[$name]):NULL;}function
getAnnotations(){return
NAnnotationsParser::getAll($this);}function
getDescription(){return$this->getAnnotation('description');}function
getReflection(){return
new
NClassReflection($this);}function
__call($name,$args){return
NObjectMixin::call($this,$name,$args);}function&__get($name){return
NObjectMixin::get($this,$name);}function
__set($name,$value){NObjectMixin::set($this,$name,$value);}function
__isset($name){return
NObjectMixin::has($this,$name);}function
__unset($name){NObjectMixin::remove($this,$name);}}class
NTemplate
extends
NObject
implements
ITemplate{public$onPrepareFilters=array();private$source;private$params=array();private$filters=array();private$helpers=array();private$helperLoaders=array();private$cacheStorage;function
setSource($source){$this->source=$source;return$this;}function
getSource(){return$this->source;}function
render(){$cache=new
NCache($storage=$this->getCacheStorage(),'Nette.Template');$cached=$compiled=$cache->load($this->source);if($compiled===NULL){$compiled=$this->compile();$cache->save($this->source,$compiled,array(NCache::CONSTS=>'NFramework::REVISION'));$cached=$cache->load($this->source);}if($cached!==NULL&&$storage
instanceof
NPhpFileStorage){NLimitedScope::load($cached['file'],$this->getParameters());}else{NLimitedScope::evaluate($compiled,$this->getParameters());}}function
save($file){if(file_put_contents($file,$this->__toString(TRUE))===FALSE){throw
new
IOException("Unable to save file '$file'.");}}function
__toString(){ob_start();try{$this->render();return
ob_get_clean();}catch(Exception$e){ob_end_clean();if(func_num_args()){throw$e;}trigger_error("Exception in ".__METHOD__."(): {$e->getMessage()} in {$e->getFile()}:{$e->getLine()}",E_USER_ERROR);}}function
compile(){if(!$this->filters){$this->onPrepareFilters($this);}$code=$this->getSource();foreach($this->filters
as$filter){$code=self::extractPhp($code,$blocks);$code=$filter->invoke($code);$code=strtr($code,$blocks);}return
NTemplateHelpers::optimizePhp($code);}function
registerFilter($callback){$callback=new
NCallback($callback);if(in_array($callback,$this->filters,TRUE)){throw
new
InvalidStateException("Filter '$callback' was registered twice.");}$this->filters[]=$callback;return$this;}function
getFilters(){return$this->filters;}function
registerHelper($name,$callback){$this->helpers[strtolower($name)]=new
NCallback($callback);return$this;}function
registerHelperLoader($callback){$this->helperLoaders[]=new
NCallback($callback);return$this;}function
getHelpers(){return$this->helpers;}function
getHelperLoaders(){return$this->helperLoaders;}function
__call($name,$args){$lname=strtolower($name);if(!isset($this->helpers[$lname])){foreach($this->helperLoaders
as$loader){$helper=$loader->invoke($lname);if($helper){$this->registerHelper($lname,$helper);return$this->helpers[$lname]->invokeArgs($args);}}return
parent::__call($name,$args);}return$this->helpers[$lname]->invokeArgs($args);}function
setTranslator(ITranslator$translator=NULL){$this->registerHelper('translate',$translator===NULL?NULL:array($translator,'translate'));return$this;}function
add($name,$value){if(array_key_exists($name,$this->params)){throw
new
InvalidStateException("The variable '$name' already exists.");}$this->params[$name]=$value;return$this;}function
setParameters(array$params){$this->params=$params+$this->params;return$this;}function
getParameters(){$this->params['template']=$this;return$this->params;}function
setParams(array$params){trigger_error(__METHOD__.'() is deprecated; use setParameters() instead.',E_USER_WARNING);return$this->setParameters($params);}function
getParams(){trigger_error(__METHOD__.'() is deprecated; use getParameters() instead.',E_USER_WARNING);return$this->getParameters();}function
__set($name,$value){$this->params[$name]=$value;}function&__get($name){if(!array_key_exists($name,$this->params)){trigger_error("The variable '$name' does not exist in template.",E_USER_NOTICE);}return$this->params[$name];}function
__isset($name){return
isset($this->params[$name]);}function
__unset($name){unset($this->params[$name]);}function
setCacheStorage(ICacheStorage$storage){$this->cacheStorage=$storage;return$this;}function
getCacheStorage(){if($this->cacheStorage===NULL){return
new
NDevNullStorage;}return$this->cacheStorage;}private
static
function
extractPhp($source,&$blocks){$res='';$blocks=array();$tokens=token_get_all($source);foreach($tokens
as$n=>$token){if(is_array($token)){if($token[0]===T_INLINE_HTML){$res.=$token[1];continue;}elseif($token[0]===T_CLOSE_TAG){if($php!==$res){$res.=str_repeat("\n",substr_count($php,"\n"));}$res.=$token[1];continue;}elseif($token[0]===T_OPEN_TAG&&$token[1]==='<?'&&isset($tokens[$n+1][1])&&$tokens[$n+1][1]==='xml'){$php=&$res;$token[1]='<<?php ?>?';}elseif($token[0]===T_OPEN_TAG||$token[0]===T_OPEN_TAG_WITH_ECHO){$res.=$id="<?php \x01@php:p".count($blocks)."@\x02";$php=&$blocks[$id];}$php.=$token[1];}else{$php.=$token;}}return$res;}}class
NFileTemplate
extends
NTemplate
implements
IFileTemplate{private$file;function
__construct($file=NULL){if($file!==NULL){$this->setFile($file);}}function
setFile($file){$this->file=realpath($file);if(!$this->file){throw
new
FileNotFoundException("Missing template file '$file'.");}return$this;}function
getFile(){return$this->file;}function
getSource(){return
file_get_contents($this->file);}function
render(){if($this->file==NULL){throw
new
InvalidStateException("Template file name was not specified.");}$cache=new
NCache($storage=$this->getCacheStorage(),'Nette.FileTemplate');if($storage
instanceof
NPhpFileStorage){$storage->hint=str_replace(dirname(dirname($this->file)),'',$this->file);}$cached=$compiled=$cache->load($this->file);if($compiled===NULL){try{$compiled="<?php\n\n// source file: $this->file\n\n?>".$this->compile();}catch(NTemplateException$e){$e->setSourceFile($this->file);throw$e;}$cache->save($this->file,$compiled,array(NCache::FILES=>$this->file,NCache::CONSTS=>'NFramework::REVISION'));$cached=$cache->load($this->file);}if($cached!==NULL&&$storage
instanceof
NPhpFileStorage){NLimitedScope::load($cached['file'],$this->getParameters());}else{NLimitedScope::evaluate($compiled,$this->getParameters());}}}class
NTemplateHelpers{private
static$helpers=array('normalize'=>'NStrings::normalize','toascii'=>'NStrings::toAscii','webalize'=>'NStrings::webalize','truncate'=>'NStrings::truncate','lower'=>'NStrings::lower','upper'=>'NStrings::upper','firstupper'=>'NStrings::firstUpper','capitalize'=>'NStrings::capitalize','trim'=>'NStrings::trim','padleft'=>'NStrings::padLeft','padright'=>'NStrings::padRight','reverse'=>'NStrings::reverse','replacere'=>'NStrings::replace','url'=>'rawurlencode','striptags'=>'strip_tags','substr'=>'NStrings::substring','repeat'=>'str_repeat','implode'=>'implode','number'=>'number_format');public
static$dateFormat='%x';static
function
loader($helper){if(method_exists(__CLASS__,$helper)){return
new
NCallback(__CLASS__,$helper);}elseif(isset(self::$helpers[$helper])){return
self::$helpers[$helper];}}static
function
escapeHtml($s,$quotes=ENT_QUOTES){if($quotes===ENT_NOQUOTES&&($s
instanceof
ITemplate||$s
instanceof
NHtml||$s
instanceof
NForm)){return$s->__toString(TRUE);}$s=(string)$s;if($quotes!==ENT_NOQUOTES&&strpos($s,'`')!==FALSE&&strpbrk($s,' <>"\'')===FALSE){$s.=' ';}return
htmlSpecialChars($s,$quotes);}static
function
escapeHtmlComment($s){$s=(string)$s;if($s&&($s[0]==='-'||$s[0]==='>'||$s[0]==='!')){$s=' '.$s;}return
str_replace('-','- ',$s);}static
function
escapeXML($s){return
htmlSpecialChars(preg_replace('#[\x00-\x08\x0B\x0C\x0E-\x1F]+#','',$s),ENT_QUOTES);}static
function
escapeCss($s){return
addcslashes($s,"\x00..\x1F!\"#$%&'()*+,./:;<=>?@[\\]^`{|}~");}static
function
escapeJs($s){if(is_object($s)&&($s
instanceof
ITemplate||$s
instanceof
NHtml||$s
instanceof
NForm)){$s=$s->__toString(TRUE);}return
str_replace(array(']]>','<!'),array(']]\x3E','\x3C!'),NJson::encode($s));}static
function
escapeICal($s){return
addcslashes(preg_replace('#[\x00-\x08\x0B\x0C-\x1F]+#','',$s),"\";\\,:\n");}static
function
safeUrl($s){return
preg_match('~^(?:(?:https?|ftp)://[^@]+(?:/.*)?|mailto:.+|[/?#].*|[^:]+)\z~i',$s)?$s:'';}static
function
strip($s){return
NStrings::replace($s,'#(</textarea|</pre|</script|^).*?(?=<textarea|<pre|<script|\z)#si',create_function('$m','
				return trim(preg_replace(\'#[ \\t\\r\\n]+#\', " ", $m[0]));
			'));}static
function
indent($s,$level=1,$chars="\t"){if($level>=1){$s=NStrings::replace($s,'#<(textarea|pre).*?</\\1#si',create_function('$m','
				return strtr($m[0], " \\t\\r\\n", "\\x1F\\x1E\\x1D\\x1A");
			'));$s=NStrings::indent($s,$level,$chars);$s=strtr($s,"\x1F\x1E\x1D\x1A"," \t\r\n");}return$s;}static
function
date($time,$format=NULL){if($time==NULL){return
NULL;}if(!isset($format)){$format=self::$dateFormat;}$time=NDateTime53::from($time);return
NStrings::contains($format,'%')?strftime($format,$time->format('U')):$time->format($format);}static
function
bytes($bytes,$precision=2){$bytes=round($bytes);$units=array('B','kB','MB','GB','TB','PB');foreach($units
as$unit){if(abs($bytes)<1024||$unit===end($units)){break;}$bytes=$bytes/1024;}return
round($bytes,$precision).' '.$unit;}static
function
length($var){return
is_string($var)?NStrings::length($var):count($var);}static
function
replace($subject,$search,$replacement=''){return
str_replace($search,$replacement,$subject);}static
function
dataStream($data,$type=NULL){if($type===NULL){$type=NMimeTypeDetector::fromString($data);}return'data:'.($type?"$type;":'').'base64,'.base64_encode($data);}static
function
null(){return'';}static
function
nl2br($value){return
nl2br($value,NHtml::$xhtml);}static
function
optimizePhp($source,$lineLength=80,$existenceOfThisParameterSolvesDamnBugInPHP535=NULL){$res=$php='';$lastChar=';';$tokens=new
ArrayIterator(token_get_all($source));foreach($tokens
as$key=>$token){if(is_array($token)){if($token[0]===T_INLINE_HTML){$lastChar='';$res.=$token[1];}elseif($token[0]===T_CLOSE_TAG){$next=isset($tokens[$key+1])?$tokens[$key+1]:NULL;if(substr($res,-1)!=='<'&&preg_match('#^<\?php\s*\z#',$php)){$php='';}elseif(is_array($next)&&$next[0]===T_OPEN_TAG){if(!strspn($lastChar,';{}:/')){$php.=$lastChar=';';}if(substr($next[1],-1)==="\n"){$php.="\n";}$tokens->next();}elseif($next){$res.=preg_replace('#;?(\s)*\z#','$1',$php).$token[1];if(strlen($res)-strrpos($res,"\n")>$lineLength&&(!is_array($next)||strpos($next[1],"\n")===FALSE)){$res.="\n";}$php='';}else{if(!strspn($lastChar,'};')){$php.=';';}}}elseif($token[0]===T_ELSE||$token[0]===T_ELSEIF){if($tokens[$key+1]===':'&&$lastChar==='}'){$php.=';';}$lastChar='';$php.=$token[1];}else{if(!in_array($token[0],array(T_WHITESPACE,T_COMMENT,T_DOC_COMMENT,T_OPEN_TAG),TRUE)){$lastChar='';}$php.=$token[1];}}else{$php.=$lastChar=$token;}}return$res.$php;}}class
NArrays{final
function
__construct(){throw
new
NStaticClassException;}static
function
get(array$arr,$key,$default=NULL){foreach(is_array($key)?$key:array($key)as$k){if(is_array($arr)&&array_key_exists($k,$arr)){$arr=$arr[$k];}else{if(func_num_args()<3){throw
new
InvalidArgumentException("Missing item '$k'.");}return$default;}}return$arr;}static
function&getRef(&$arr,$key){foreach(is_array($key)?$key:array($key)as$k){if(is_array($arr)||$arr===NULL){$arr=&$arr[$k];}else{throw
new
InvalidArgumentException('Traversed item is not an array.');}}return$arr;}static
function
mergeTree($arr1,$arr2){$res=$arr1+$arr2;foreach(array_intersect_key($arr1,$arr2)as$k=>$v){if(is_array($v)&&is_array($arr2[$k])){$res[$k]=self::mergeTree($v,$arr2[$k]);}}return$res;}static
function
searchKey($arr,$key){$foo=array($key=>NULL);return
array_search(key($foo),array_keys($arr),TRUE);}static
function
insertBefore(array&$arr,$key,array$inserted){$offset=self::searchKey($arr,$key);$arr=array_slice($arr,0,$offset,TRUE)+$inserted+array_slice($arr,$offset,count($arr),TRUE);}static
function
insertAfter(array&$arr,$key,array$inserted){$offset=self::searchKey($arr,$key);$offset=$offset===FALSE?count($arr):$offset+1;$arr=array_slice($arr,0,$offset,TRUE)+$inserted+array_slice($arr,$offset,count($arr),TRUE);}static
function
renameKey(array&$arr,$oldKey,$newKey){$offset=self::searchKey($arr,$oldKey);if($offset!==FALSE){$keys=array_keys($arr);$keys[$offset]=$newKey;$arr=array_combine($keys,$arr);}}static
function
grep(array$arr,$pattern,$flags=0){set_error_handler(create_function('$severity, $message','extract($GLOBALS[0]['.array_push($GLOBALS[0],array('pattern'=>$pattern)).'-1], EXTR_REFS); // preg_last_error does not return compile errors
			restore_error_handler();
			throw new NRegexpException("$message in pattern: $pattern");
		'));$res=preg_grep($pattern,$arr,$flags);restore_error_handler();if(preg_last_error()){throw
new
NRegexpException(NULL,preg_last_error(),$pattern);}return$res;}static
function
flatten(array$arr){$res=array();array_walk_recursive($arr,create_function('$a','extract($GLOBALS[0]['.array_push($GLOBALS[0],array('res'=>&$res)).'-1], EXTR_REFS); $res[] = $a; '));return$res;}}class
NFinder
extends
NObject
implements
IteratorAggregate{private$paths=array();private$groups;private$exclude=array();private$order=RecursiveIteratorIterator::SELF_FIRST;private$maxDepth=-1;private$cursor;static
function
find($mask){if(!is_array($mask)){$mask=func_get_args();}$finder=new
self;return$finder->select(array(),'isDir')->select($mask,'isFile');}static
function
findFiles($mask){if(!is_array($mask)){$mask=func_get_args();}$finder=new
self;return$finder->select($mask,'isFile');}static
function
findDirectories($mask){if(!is_array($mask)){$mask=func_get_args();}$finder=new
self;return$finder->select($mask,'isDir');}private
function
select($masks,$type){$this->cursor=&$this->groups[];$pattern=self::buildPattern($masks);if($type||$pattern){$this->filter(create_function('$file','extract($GLOBALS[0]['.array_push($GLOBALS[0],array('type'=>$type,'pattern'=>$pattern)).'-1], EXTR_REFS);
				return !$file->isDot()
					&& (!$type || $file->$type())
					&& (!$pattern || preg_match($pattern, \'/\' . strtr($file->getSubPathName(), \'\\\\\', \'/\')));
			'));}return$this;}function
in($path){if(!is_array($path)){$path=func_get_args();}$this->maxDepth=0;return$this->from($path);}function
from($path){if($this->paths){throw
new
InvalidStateException('Directory to search has already been specified.');}if(!is_array($path)){$path=func_get_args();}$this->paths=$path;$this->cursor=&$this->exclude;return$this;}function
childFirst(){$this->order=RecursiveIteratorIterator::CHILD_FIRST;return$this;}private
static
function
buildPattern($masks){$pattern=array();foreach($masks
as$mask){$mask=rtrim(strtr($mask,'\\','/'),'/');$prefix='';if($mask===''){continue;}elseif($mask==='*'){return
NULL;}elseif($mask[0]==='/'){$mask=ltrim($mask,'/');$prefix='(?<=^/)';}$pattern[]=$prefix.strtr(preg_quote($mask,'#'),array('\*\*'=>'.*','\*'=>'[^/]*','\?'=>'[^/]','\[\!'=>'[^','\['=>'[','\]'=>']','\-'=>'-'));}return$pattern?'#/('.implode('|',$pattern).')\z#i':NULL;}function
getIterator(){if(!$this->paths){throw
new
InvalidStateException('Call in() or from() to specify directory to search.');}elseif(count($this->paths)===1){return$this->buildIterator($this->paths[0]);}else{$iterator=new
AppendIterator();$iterator->append($workaround=new
ArrayIterator(array('workaround PHP bugs #49104, #63077')));foreach($this->paths
as$path){$iterator->append($this->buildIterator($path));}unset($workaround[0]);return$iterator;}}private
function
buildIterator($path){if(PHP_VERSION_ID<50301){$iterator=new
NRecursiveDirectoryIteratorFixed($path);}else{$iterator=new
RecursiveDirectoryIterator($path,RecursiveDirectoryIterator::FOLLOW_SYMLINKS);}if($this->exclude){$filters=$this->exclude;$iterator=new
NNRecursiveCallbackFilterIterator($iterator,create_function('$file','extract($GLOBALS[0]['.array_push($GLOBALS[0],array('filters'=>$filters)).'-1], EXTR_REFS);
				if (!$file->isDot() && !$file->isFile()) {
					foreach ($filters as $filter) {
						if (!call_user_func($filter, $file)) {
							return FALSE;
						}
					}
				}
				return TRUE;
			'));}if($this->maxDepth!==0){$iterator=new
RecursiveIteratorIterator($iterator,$this->order);$iterator->setMaxDepth($this->maxDepth);}if($this->groups){$groups=$this->groups;$iterator=new
NNCallbackFilterIterator($iterator,create_function('$file','extract($GLOBALS[0]['.array_push($GLOBALS[0],array('groups'=>$groups)).'-1], EXTR_REFS);
				foreach ($groups as $filters) {
					foreach ($filters as $filter) {
						if (!call_user_func($filter, $file)) {
							continue 2;
						}
					}
					return TRUE;
				}
				return FALSE;
			'));}return$iterator;}function
exclude($masks){if(!is_array($masks)){$masks=func_get_args();}$pattern=self::buildPattern($masks);if($pattern){$this->filter(create_function('$file','extract($GLOBALS[0]['.array_push($GLOBALS[0],array('pattern'=>$pattern)).'-1], EXTR_REFS);
				return !preg_match($pattern, \'/\' . strtr($file->getSubPathName(), \'\\\\\', \'/\'));
			'));}return$this;}function
filter($callback){$this->cursor[]=$callback;return$this;}function
limitDepth($depth){$this->maxDepth=$depth;return$this;}function
size($operator,$size=NULL){if(func_num_args()===1){if(!preg_match('#^(?:([=<>!]=?|<>)\s*)?((?:\d*\.)?\d+)\s*(K|M|G|)B?\z#i',$operator,$matches)){throw
new
InvalidArgumentException('Invalid size predicate format.');}list(,$operator,$size,$unit)=$matches;static$units=array(''=>1,'k'=>1e3,'m'=>1e6,'g'=>1e9);$size*=$units[strtolower($unit)];$operator=$operator?$operator:'=';}return$this->filter(create_function('$file','extract($GLOBALS[0]['.array_push($GLOBALS[0],array('operator'=>$operator,'size'=>$size)).'-1], EXTR_REFS);
			return NFinder::compare($file->getSize(), $operator, $size);
		'));}function
date($operator,$date=NULL){if(func_num_args()===1){if(!preg_match('#^(?:([=<>!]=?|<>)\s*)?(.+)\z#i',$operator,$matches)){throw
new
InvalidArgumentException('Invalid date predicate format.');}list(,$operator,$date)=$matches;$operator=$operator?$operator:'=';}$date=NDateTime53::from($date)->format('U');return$this->filter(create_function('$file','extract($GLOBALS[0]['.array_push($GLOBALS[0],array('operator'=>$operator,'date'=>$date)).'-1], EXTR_REFS);
			return NFinder::compare($file->getMTime(), $operator, $date);
		'));}static
function
compare($l,$operator,$r){switch($operator){case'>':return$l>$r;case'>=':return$l>=$r;case'<':return$l<$r;case'<=':return$l<=$r;case'=':case'==':return$l==$r;case'!':case'!=':case'<>':return$l!=$r;default:throw
new
InvalidArgumentException("Unknown operator $operator.");}}}if(PHP_VERSION_ID<50301){class
NRecursiveDirectoryIteratorFixed
extends
RecursiveDirectoryIterator{function
hasChildren(){return
parent::hasChildren(TRUE);}}}class
NJson{const
FORCE_ARRAY=1;private
static$messages=array(JSON_ERROR_DEPTH=>'The maximum stack depth has been exceeded',JSON_ERROR_STATE_MISMATCH=>'Syntax error, malformed JSON',JSON_ERROR_CTRL_CHAR=>'Unexpected control character found',JSON_ERROR_SYNTAX=>'Syntax error, malformed JSON',5=>'Invalid UTF-8 sequence',6=>'Recursion detected',7=>'Inf and NaN cannot be JSON encoded',8=>'Type is not supported');final
function
__construct(){throw
new
NStaticClassException;}static
function
encode($value){if(function_exists('ini_set')){$old=ini_set('display_errors',0);}set_error_handler(create_function('$severity, $message',' // needed to receive \'recursion detected\' error
			restore_error_handler();
			throw new NJsonException($message);
		'));$json=json_encode($value);restore_error_handler();if(isset($old)){ini_set('display_errors',$old);}if(PHP_VERSION_ID>=50300&&($error=json_last_error())){throw
new
NJsonException(isset(self::$messages[$error])?self::$messages[$error]:'Unknown error',$error);}$json=str_replace(array("\xe2\x80\xa8","\xe2\x80\xa9"),array('\u2028','\u2029'),$json);return$json;}static
function
decode($json,$options=0){$json=(string)$json;$value=json_decode($json,(bool)($options&self::FORCE_ARRAY));if($value===NULL&&$json!==''&&strcasecmp($json,'null')){$error=PHP_VERSION_ID>=50300?json_last_error():0;throw
new
NJsonException(isset(self::$messages[$error])?self::$messages[$error]:'Unknown error',$error);}return$value;}}class
NJsonException
extends
Exception{}class
NMimeTypeDetector{final
function
__construct(){throw
new
NStaticClassException;}static
function
fromFile($file){if(!is_file($file)){throw
new
FileNotFoundException("File '$file' not found.");}$info=@getimagesize($file);if(isset($info['mime'])){return$info['mime'];}elseif(extension_loaded('fileinfo')){$type=preg_replace('#[\s;].*\z#','',finfo_file(finfo_open(FILEINFO_MIME),$file));}elseif(function_exists('mime_content_type')){$type=mime_content_type($file);}return
isset($type)&&preg_match('#^\S+/\S+\z#',$type)?$type:'application/octet-stream';}static
function
fromString($data){if(extension_loaded('fileinfo')&&preg_match('#^(\S+/[^\s;]+)#',finfo_buffer(finfo_open(FILEINFO_MIME),$data),$m)){return$m[1];}elseif(strncmp($data,"\xff\xd8",2)===0){return'image/jpeg';}elseif(strncmp($data,"\x89PNG",4)===0){return'image/png';}elseif(strncmp($data,"GIF",3)===0){return'image/gif';}else{return'application/octet-stream';}}}class
NNeon
extends
NObject{const
BLOCK=1;private
static$patterns=array('
			\'[^\'\n]*\' |
			"(?: \\\\. | [^"\\\\\n] )*"
		','
			(?: [^#"\',:=[\]{}()\x00-\x20!`-] | [:-][^"\',\]})\s] )
			(?:
				[^,:=\]})(\x00-\x20]+ |
				:(?! [\s,\]})] | $ ) |
				[\ \t]+ [^#,:=\]})(\x00-\x20]
			)*
		','
			[,:=[\]{}()-]
		','?:\#.*','\n[\t\ ]*','?:[\t\ ]+');private
static$tokenizer;private
static$brackets=array('['=>']','{'=>'}','('=>')');private$n=0;private$indentTabs;static
function
encode($var,$options=NULL){if($var
instanceof
DateTime){return$var->format('Y-m-d H:i:s O');}elseif($var
instanceof
NNeonEntity){return
self::encode($var->value).'('.substr(self::encode($var->attributes),1,-1).')';}if(is_object($var)){$obj=$var;$var=array();foreach($obj
as$k=>$v){$var[$k]=$v;}}if(is_array($var)){$isList=NValidators::isList($var);$s='';if($options&self::BLOCK){if(count($var)===0){return"[]";}foreach($var
as$k=>$v){$v=self::encode($v,self::BLOCK);$s.=($isList?'-':self::encode($k).':').(NStrings::contains($v,"\n")?"\n\t".str_replace("\n","\n\t",$v):' '.$v)."\n";continue;}return$s;}else{foreach($var
as$k=>$v){$s.=($isList?'':self::encode($k).': ').self::encode($v).', ';}return($isList?'[':'{').substr($s,0,-2).($isList?']':'}');}}elseif(is_string($var)&&!is_numeric($var)&&!preg_match('~[\x00-\x1F]|^\d{4}|^(true|false|yes|no|on|off|null)\z~i',$var)&&preg_match('~^'.self::$patterns[1].'\z~x',$var)){return$var;}elseif(is_float($var)){$var=json_encode($var);return
NStrings::contains($var,'.')?$var:$var.'.0';}else{return
json_encode($var);}}static
function
decode($input){if(!is_string($input)){throw
new
InvalidArgumentException("Argument must be a string, ".gettype($input)." given.");}if(!self::$tokenizer){self::$tokenizer=new
NTokenizer(self::$patterns,'mix');}if(substr($input,0,3)==="\xEF\xBB\xBF"){$input=substr($input,3);}$input=str_replace("\r",'',$input);self::$tokenizer->tokenize($input);$parser=new
self;$res=$parser->parse(0);while(isset(self::$tokenizer->tokens[$parser->n])){if(self::$tokenizer->tokens[$parser->n][0]==="\n"){$parser->n++;}else{$parser->error();}}return$res;}private
function
parse($indent=NULL,$result=NULL){$inlineParser=$indent===NULL;$value=$key=NULL;$hasValue=$hasKey=FALSE;$tokens=self::$tokenizer->tokens;$n=&$this->n;$count=count($tokens);for(;$n<$count;$n++){$t=$tokens[$n];if($t===','){if((!$hasKey&&!$hasValue)||!$inlineParser){$this->error();}$this->addValue($result,$hasKey,$key,$hasValue?$value:NULL);$hasKey=$hasValue=FALSE;}elseif($t===':'||$t==='='){if($hasKey||!$hasValue){$this->error();}if(is_array($value)||is_object($value)){$this->error('Unacceptable key');}$key=(string)$value;$hasKey=TRUE;$hasValue=FALSE;}elseif($t==='-'){if($hasKey||$hasValue||$inlineParser){$this->error();}$key=NULL;$hasKey=TRUE;}elseif(isset(self::$brackets[$t])){if($hasValue){if($t!=='('){$this->error();}$n++;$entity=new
NNeonEntity;$entity->value=$value;$entity->attributes=$this->parse(NULL,array());$value=$entity;}else{$n++;$value=$this->parse(NULL,array());}$hasValue=TRUE;if(!isset($tokens[$n])||$tokens[$n]!==self::$brackets[$t]){$this->error();}}elseif($t===']'||$t==='}'||$t===')'){if(!$inlineParser){$this->error();}break;}elseif($t[0]==="\n"){if($inlineParser){if($hasKey||$hasValue){$this->addValue($result,$hasKey,$key,$hasValue?$value:NULL);$hasKey=$hasValue=FALSE;}}else{while(isset($tokens[$n+1])&&$tokens[$n+1][0]==="\n")$n++;if(!isset($tokens[$n+1])){break;}$newIndent=strlen($tokens[$n])-1;if($indent===NULL){$indent=$newIndent;}if($newIndent){if($this->indentTabs===NULL){$this->indentTabs=$tokens[$n][1]==="\t";}if(strpos($tokens[$n],$this->indentTabs?' ':"\t")){$n++;$this->error('Either tabs or spaces may be used as indenting chars, but not both.');}}if($newIndent>$indent){if($hasValue||!$hasKey){$n++;$this->error('Unexpected indentation.');}else{$this->addValue($result,$key!==NULL,$key,$this->parse($newIndent));}$newIndent=isset($tokens[$n])?strlen($tokens[$n])-1:0;$hasKey=FALSE;}else{if($hasValue&&!$hasKey){break;}elseif($hasKey){$this->addValue($result,$key!==NULL,$key,$hasValue?$value:NULL);$hasKey=$hasValue=FALSE;}}if($newIndent<$indent){return$result;}}}else{if($hasValue){$this->error();}static$consts=array('true'=>TRUE,'True'=>TRUE,'TRUE'=>TRUE,'yes'=>TRUE,'Yes'=>TRUE,'YES'=>TRUE,'on'=>TRUE,'On'=>TRUE,'ON'=>TRUE,'false'=>FALSE,'False'=>FALSE,'FALSE'=>FALSE,'no'=>FALSE,'No'=>FALSE,'NO'=>FALSE,'off'=>FALSE,'Off'=>FALSE,'OFF'=>FALSE);if($t[0]==='"'){$value=preg_replace_callback('#\\\\(?:u[0-9a-f]{4}|x[0-9a-f]{2}|.)#i',array($this,'cbString'),substr($t,1,-1));}elseif($t[0]==="'"){$value=substr($t,1,-1);}elseif(isset($consts[$t])){$value=$consts[$t];}elseif($t==='null'||$t==='Null'||$t==='NULL'){$value=NULL;}elseif(is_numeric($t)){$value=$t*1;}elseif(preg_match('#\d\d\d\d-\d\d?-\d\d?(?:(?:[Tt]| +)\d\d?:\d\d:\d\d(?:\.\d*)? *(?:Z|[-+]\d\d?(?::\d\d)?)?)?\z#A',$t)){$value=new
NDateTime53($t);}else{$value=$t;}$hasValue=TRUE;}}if($inlineParser){if($hasKey||$hasValue){$this->addValue($result,$hasKey,$key,$hasValue?$value:NULL);}}else{if($hasValue&&!$hasKey){if($result===NULL){$result=$value;}else{$this->error();}}elseif($hasKey){$this->addValue($result,$key!==NULL,$key,$hasValue?$value:NULL);}}return$result;}private
function
addValue(&$result,$hasKey,$key,$value){if($hasKey){if($result&&array_key_exists($key,$result)){$this->error("Duplicated key '$key'");}$result[$key]=$value;}else{$result[]=$value;}}private
function
cbString($m){static$mapping=array('t'=>"\t",'n'=>"\n",'r'=>"\r",'f'=>"\x0C",'b'=>"\x08",'"'=>'"','\\'=>'\\','/'=>'/','_'=>"\xc2\xa0");$sq=$m[0];if(isset($mapping[$sq[1]])){return$mapping[$sq[1]];}elseif($sq[1]==='u'&&strlen($sq)===6){return
NStrings::chr(hexdec(substr($sq,2)));}elseif($sq[1]==='x'&&strlen($sq)===4){return
chr(hexdec(substr($sq,2)));}else{$this->error("Invalid escaping sequence $sq");}}private
function
error($message="Unexpected '%s'"){list(,$line,$col)=self::$tokenizer->getOffset($this->n);$token=isset(self::$tokenizer->tokens[$this->n])?str_replace("\n",'<new line>',NStrings::truncate(self::$tokenizer->tokens[$this->n],40)):'end';throw
new
NNeonException(str_replace('%s',$token,$message)." on line $line, column $col.");}}class
NNeonEntity
extends
stdClass{public$value;public$attributes;}class
NNeonException
extends
Exception{}class
NStrings{final
function
__construct(){throw
new
NStaticClassException;}static
function
checkEncoding($s,$encoding='UTF-8'){return$s===self::fixEncoding($s,$encoding);}static
function
fixEncoding($s,$encoding='UTF-8'){if(strcasecmp($encoding,'UTF-8')===0){$s=str_replace("\xEF\xBB\xBF",'',$s);}if(PHP_VERSION_ID>=50400){ini_set('mbstring.substitute_character','none');return
mb_convert_encoding($s,$encoding,$encoding);}return@iconv('UTF-16',$encoding.'//IGNORE',iconv($encoding,'UTF-16//IGNORE',$s));}static
function
chr($code,$encoding='UTF-8'){return
iconv('UTF-32BE',$encoding.'//IGNORE',pack('N',$code));}static
function
startsWith($haystack,$needle){return
strncmp($haystack,$needle,strlen($needle))===0;}static
function
endsWith($haystack,$needle){return
strlen($needle)===0||substr($haystack,-strlen($needle))===$needle;}static
function
contains($haystack,$needle){return
strpos($haystack,$needle)!==FALSE;}static
function
substring($s,$start,$length=NULL){if($length===NULL){$length=self::length($s);}return
function_exists('mb_substr')?mb_substr($s,$start,$length,'UTF-8'):iconv_substr($s,$start,$length,'UTF-8');}static
function
normalize($s){$s=str_replace("\r\n","\n",$s);$s=strtr($s,"\r","\n");$s=preg_replace('#[\x00-\x08\x0B-\x1F\x7F]+#','',$s);$s=preg_replace('#[\t ]+$#m','',$s);$s=trim($s,"\n");return$s;}static
function
toAscii($s){$s=preg_replace('#[^\x09\x0A\x0D\x20-\x7E\xA0-\x{2FF}\x{370}-\x{10FFFF}]#u','',$s);$s=strtr($s,'`\'"^~',"\x01\x02\x03\x04\x05");if(ICONV_IMPL==='glibc'){$s=@iconv('UTF-8','WINDOWS-1250//TRANSLIT',$s);$s=strtr($s,"\xa5\xa3\xbc\x8c\xa7\x8a\xaa\x8d\x8f\x8e\xaf\xb9\xb3\xbe\x9c\x9a\xba\x9d\x9f\x9e"."\xbf\xc0\xc1\xc2\xc3\xc4\xc5\xc6\xc7\xc8\xc9\xca\xcb\xcc\xcd\xce\xcf\xd0\xd1\xd2\xd3"."\xd4\xd5\xd6\xd7\xd8\xd9\xda\xdb\xdc\xdd\xde\xdf\xe0\xe1\xe2\xe3\xe4\xe5\xe6\xe7\xe8"."\xe9\xea\xeb\xec\xed\xee\xef\xf0\xf1\xf2\xf3\xf4\xf5\xf6\xf8\xf9\xfa\xfb\xfc\xfd\xfe\x96","ALLSSSSTZZZallssstzzzRAAAALCCCEEEEIIDDNNOOOOxRUUUUYTsraaaalccceeeeiiddnnooooruuuuyt-");}else{$s=@iconv('UTF-8','ASCII//TRANSLIT',$s);}$s=str_replace(array('`',"'",'"','^','~'),'',$s);return
strtr($s,"\x01\x02\x03\x04\x05",'`\'"^~');}static
function
webalize($s,$charlist=NULL,$lower=TRUE){$s=self::toAscii($s);if($lower){$s=strtolower($s);}$s=preg_replace('#[^a-z0-9'.preg_quote($charlist,'#').']+#i','-',$s);$s=trim($s,'-');return$s;}static
function
truncate($s,$maxLen,$append="\xE2\x80\xA6"){if(self::length($s)>$maxLen){$maxLen=$maxLen-self::length($append);if($maxLen<1){return$append;}elseif($matches=self::match($s,'#^.{1,'.$maxLen.'}(?=[\s\x00-/:-@\[-`{-~])#us')){return$matches[0].$append;}else{return
self::substring($s,0,$maxLen).$append;}}return$s;}static
function
indent($s,$level=1,$chars="\t"){return$level<1?$s:self::replace($s,'#(?:^|[\r\n]+)(?=[^\r\n])#','$0'.str_repeat($chars,$level));}static
function
lower($s){return
mb_strtolower($s,'UTF-8');}static
function
upper($s){return
mb_strtoupper($s,'UTF-8');}static
function
firstUpper($s){return
self::upper(self::substring($s,0,1)).self::substring($s,1);}static
function
capitalize($s){return
mb_convert_case($s,MB_CASE_TITLE,'UTF-8');}static
function
compare($left,$right,$len=NULL){if($len<0){$left=self::substring($left,$len,-$len);$right=self::substring($right,$len,-$len);}elseif($len!==NULL){$left=self::substring($left,0,$len);$right=self::substring($right,0,$len);}return
self::lower($left)===self::lower($right);}static
function
length($s){return
strlen(utf8_decode($s));}static
function
trim($s,$charlist=" \t\n\r\0\x0B\xC2\xA0"){$charlist=preg_quote($charlist,'#');return
self::replace($s,'#^['.$charlist.']+|['.$charlist.']+\z#u','');}static
function
padLeft($s,$length,$pad=' '){$length=max(0,$length-self::length($s));$padLen=self::length($pad);return
str_repeat($pad,$length/$padLen).self::substring($pad,0,$length
%$padLen).$s;}static
function
padRight($s,$length,$pad=' '){$length=max(0,$length-self::length($s));$padLen=self::length($pad);return$s.str_repeat($pad,$length/$padLen).self::substring($pad,0,$length
%$padLen);}static
function
reverse($s){return@iconv('UTF-32LE','UTF-8',strrev(@iconv('UTF-8','UTF-32BE',$s)));}static
function
random($length=10,$charlist='0-9a-z'){$charlist=str_shuffle(preg_replace_callback('#.-.#',create_function('$m','
			return implode(\'\', range($m[0][0], $m[0][2]));
		'),$charlist));$chLen=strlen($charlist);if(function_exists('openssl_random_pseudo_bytes')&&(PHP_VERSION_ID>=50400||!defined('PHP_WINDOWS_VERSION_BUILD'))){$rand3=openssl_random_pseudo_bytes($length);}if(empty($rand3)&&function_exists('mcrypt_create_iv')&&(PHP_VERSION_ID>=50307||!defined('PHP_WINDOWS_VERSION_BUILD'))){$rand3=mcrypt_create_iv($length,MCRYPT_DEV_URANDOM);}if(empty($rand3)&&@is_readable('/dev/urandom')){$rand3=file_get_contents('/dev/urandom',FALSE,NULL,-1,$length);}if(empty($rand3)){static$cache;$rand3=($tmp=$cache)?$tmp:$cache=md5(serialize($_SERVER),TRUE);}$s='';for($i=0;$i<$length;$i++){if($i
%
5===0){list($rand,$rand2)=explode(' ',microtime());$rand+=lcg_value();}$rand*=$chLen;$s.=$charlist[($rand+$rand2+ord($rand3[$i
%
strlen($rand3)]))%$chLen];$rand-=(int)$rand;}return$s;}static
function
split($subject,$pattern,$flags=0){set_error_handler(create_function('$severity, $message','extract($GLOBALS[0]['.array_push($GLOBALS[0],array('pattern'=>$pattern)).'-1], EXTR_REFS); // preg_last_error does not return compile errors
			restore_error_handler();
			throw new NRegexpException("$message in pattern: $pattern");
		'));$res=preg_split($pattern,$subject,-1,$flags|PREG_SPLIT_DELIM_CAPTURE);restore_error_handler();if(preg_last_error()){throw
new
NRegexpException(NULL,preg_last_error(),$pattern);}return$res;}static
function
match($subject,$pattern,$flags=0,$offset=0){if($offset>strlen($subject)){return
NULL;}set_error_handler(create_function('$severity, $message','extract($GLOBALS[0]['.array_push($GLOBALS[0],array('pattern'=>$pattern)).'-1], EXTR_REFS); // preg_last_error does not return compile errors
			restore_error_handler();
			throw new NRegexpException("$message in pattern: $pattern");
		'));$res=preg_match($pattern,$subject,$m,$flags,$offset);restore_error_handler();if(preg_last_error()){throw
new
NRegexpException(NULL,preg_last_error(),$pattern);}if($res){return$m;}}static
function
matchAll($subject,$pattern,$flags=0,$offset=0){if($offset>strlen($subject)){return
array();}set_error_handler(create_function('$severity, $message','extract($GLOBALS[0]['.array_push($GLOBALS[0],array('pattern'=>$pattern)).'-1], EXTR_REFS); // preg_last_error does not return compile errors
			restore_error_handler();
			throw new NRegexpException("$message in pattern: $pattern");
		'));preg_match_all($pattern,$subject,$m,($flags&PREG_PATTERN_ORDER)?$flags:($flags|PREG_SET_ORDER),$offset);restore_error_handler();if(preg_last_error()){throw
new
NRegexpException(NULL,preg_last_error(),$pattern);}return$m;}static
function
replace($subject,$pattern,$replacement=NULL,$limit=-1){if(is_object($replacement)||is_array($replacement)||preg_match('#^\x00lambda_\d+\z#',$replacement)){if($replacement
instanceof
NCallback){$replacement=$replacement->getNative();}if(!is_callable($replacement,FALSE,$textual)){throw
new
InvalidStateException("Callback '$textual' is not callable.");}set_error_handler(create_function('$severity, $message','extract($GLOBALS[0]['.array_push($GLOBALS[0],array('tmp'=>&$tmp)).'-1], EXTR_REFS); // preg_last_error does not return compile errors
				restore_error_handler();
				throw new NRegexpException("$message in pattern: $tmp");
			'));foreach((array)$pattern
as$tmp){preg_match($tmp,'');}restore_error_handler();$res=preg_replace_callback($pattern,$replacement,$subject,$limit);if($res===NULL&&preg_last_error()){throw
new
NRegexpException(NULL,preg_last_error(),$pattern);}return$res;}elseif($replacement===NULL&&is_array($pattern)){$replacement=array_values($pattern);$pattern=array_keys($pattern);}set_error_handler(create_function('$severity, $message','extract($GLOBALS[0]['.array_push($GLOBALS[0],array('pattern'=>$pattern)).'-1], EXTR_REFS); // preg_last_error does not return compile errors
			restore_error_handler();
			throw new NRegexpException("$message in pattern: " . implode(\' or \', (array) $pattern));
		'));$res=preg_replace($pattern,$replacement,$subject,$limit);restore_error_handler();if(preg_last_error()){throw
new
NRegexpException(NULL,preg_last_error(),implode(' or ',(array)$pattern));}return$res;}}class
NRegexpException
extends
Exception{static
public$messages=array(PREG_INTERNAL_ERROR=>'Internal error',PREG_BACKTRACK_LIMIT_ERROR=>'Backtrack limit was exhausted',PREG_RECURSION_LIMIT_ERROR=>'Recursion limit was exhausted',PREG_BAD_UTF8_ERROR=>'Malformed UTF-8 data',5=>'Offset didn\'t correspond to the begin of a valid UTF-8 code point');function
__construct($message,$code=NULL,$pattern=NULL){if(!$message){$message=(isset(self::$messages[$code])?self::$messages[$code]:'Unknown error').($pattern?" (pattern: $pattern)":'');}parent::__construct($message,$code);}}class
NValidators
extends
NObject{protected
static$validators=array('bool'=>'is_bool','boolean'=>'is_bool','int'=>'is_int','integer'=>'is_int','float'=>'is_float','number'=>NULL,'numeric'=>array(__CLASS__,'isNumeric'),'numericint'=>array(__CLASS__,'isNumericInt'),'string'=>'is_string','unicode'=>array(__CLASS__,'isUnicode'),'array'=>'is_array','list'=>array(__CLASS__,'isList'),'object'=>'is_object','resource'=>'is_resource','scalar'=>'is_scalar','callable'=>array(__CLASS__,'isCallable'),'null'=>'is_null','email'=>array(__CLASS__,'isEmail'),'url'=>array(__CLASS__,'isUrl'),'none'=>array(__CLASS__,'isNone'),'pattern'=>NULL,'alnum'=>'ctype_alnum','alpha'=>'ctype_alpha','digit'=>'ctype_digit','lower'=>'ctype_lower','upper'=>'ctype_upper','space'=>'ctype_space','xdigit'=>'ctype_xdigit');protected
static$counters=array('string'=>'strlen','unicode'=>array('NStrings','length'),'array'=>'count','list'=>'count','alnum'=>'strlen','alpha'=>'strlen','digit'=>'strlen','lower'=>'strlen','space'=>'strlen','upper'=>'strlen','xdigit'=>'strlen');static
function
assert($value,$expected,$label='variable'){if(!self::is($value,$expected)){$expected=str_replace(array('|',':'),array(' or ',' in range '),$expected);if(is_array($value)){$type='array('.count($value).')';}elseif(is_object($value)){$type='object '.get_class($value);}elseif(is_string($value)&&strlen($value)<40){$type="string '$value'";}else{$type=gettype($value);}throw
new
NAssertionException("The $label expects to be $expected, $type given.");}}static
function
assertField($arr,$field,$expected=NULL,$label="item '%' in array"){self::assert($arr,'array','first argument');if(!array_key_exists($field,$arr)){throw
new
NAssertionException('Missing '.str_replace('%',$field,$label).'.');}elseif($expected){self::assert($arr[$field],$expected,str_replace('%',$field,$label));}}static
function
is($value,$expected){foreach(explode('|',$expected)as$item){list($type)=$item=explode(':',$item,2);if(isset(self::$validators[$type])){if(!call_user_func(self::$validators[$type],$value)){continue;}}elseif($type==='number'){if(!is_int($value)&&!is_float($value)){continue;}}elseif($type==='pattern'){if(preg_match('|^'.(isset($item[1])?$item[1]:'').'\z|',$value)){return
TRUE;}continue;}elseif(!$value
instanceof$type){continue;}if(isset($item[1])){if(isset(self::$counters[$type])){$value=call_user_func(self::$counters[$type],$value);}$range=explode('..',$item[1]);if(!isset($range[1])){$range[1]=$range[0];}if(($range[0]!==''&&$value<$range[0])||($range[1]!==''&&$value>$range[1])){continue;}}return
TRUE;}return
FALSE;}static
function
isNumericInt($value){return
is_int($value)||is_string($value)&&preg_match('#^-?[0-9]+\z#',$value);}static
function
isNumeric($value){return
is_float($value)||is_int($value)||is_string($value)&&preg_match('#^-?[0-9]*[.]?[0-9]+\z#',$value);}static
function
isCallable($value){return$value&&is_callable($value,TRUE);}static
function
isUnicode($value){return
is_string($value)&&preg_match('##u',$value);}static
function
isNone($value){return$value==NULL;}static
function
isList($value){return
is_array($value)&&(!$value||array_keys($value)===range(0,count($value)-1));}static
function
isInRange($value,$range){return(!isset($range[0])||$value>=$range[0])&&(!isset($range[1])||$value<=$range[1]);}static
function
isEmail($value){$atom="[-a-z0-9!#$%&'*+/=?^_`{|}~]";$localPart="(?:\"(?:[ !\\x23-\\x5B\\x5D-\\x7E]*|\\\\[ -~])+\"|$atom+(?:\\.$atom+)*)";$alpha="a-z\x80-\xFF";$domain="[0-9$alpha](?:[-0-9$alpha]{0,61}[0-9$alpha])?";$topDomain="[$alpha][-0-9$alpha]{0,17}[$alpha]";return(bool)preg_match("(^$localPart@(?:$domain\\.)+$topDomain\\z)i",$value);}static
function
isUrl($value){$alpha="a-z\x80-\xFF";$domain="[0-9$alpha](?:[-0-9$alpha]{0,61}[0-9$alpha])?";$topDomain="[$alpha][-0-9$alpha]{0,17}[$alpha]";return(bool)preg_match("(^https?://(?:(?:$domain\\.)*$topDomain|\\d{1,3}\.\\d{1,3}\.\\d{1,3}\.\\d{1,3}|\[[0-9a-f:]{3,39}\])(:\\d{1,5})?(/\\S*)?\\z)i",$value);}}class
NAssertionException
extends
Exception{}NSafeStream::register();function
callback($callback,$m=NULL){return
new
NCallback($callback,$m);}