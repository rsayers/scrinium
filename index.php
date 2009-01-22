<?

$p=$_GET['p'];
$b=$_GET['b'];
$bookmark=$_GET['bookmark'];

if (isset($bookmark)){
	setcookie(str_replace('.','',$b),$p,time()+30*24*3600);
}
$dir='.'; // What dir to check for text files
$lpp=30; // Lines per page
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
<?


if (!$p){
        $p=1;
    }
    if ($b){
        ?><title><?=$b;?> - Page: <?=$p;?></title><?
    }else{
        ?><title>Book List</title><?
    }
?>
</head>
<body>
<?
$d=dir($dir);
$lpp=30;

if ($b){
    
    $lines=file($dir.'/'.$b);
    
    $e=$p*$lpp;
    $s=$e-$lpp;
    
    ?>
    
    
    <form method="get" action="index.php">
    <div class='nav'>
    <a href="index.php?b=<?=$b;?>&amp;p=<?=$p-1;?>">&lt;</a>
    <input name="p" size="2" value="<?=$p;?>" />
    <input type='hidden' name='b' value="<?=$b;?>" />
    <input type='submit' value='Go' />  
    <a href="index.php?b=<?=$b;?>&amp;p=<?=$p+1;?>">&gt;</a><br/>
    </div>
    </form>
    
    
    <div class='textbody'>
    <?
    for ($i=$s;$i<$e;$i++){
        echo $lines[$i].'<br />';
    }
     ?>
     </div>
     
   
    <form method="get" action="index.php">
    <div class='nav'>
    <a href="index.php?b=<?=$b;?>&amp;p=<?=$p-1;?>">&lt;</a>
    <input name="p" size="2" value="<?=$p;?>" />
    <input type='hidden' name='b' value="<?=$b;?>" />
    <input type='submit' value='Go' />  
    <a href="index.php?b=<?=$b;?>&amp;p=<?=$p+1;?>">&gt;</a><br/>
    </div>
    </form>
    <div>
    <a href='index.php?bookmark&amp;b=<?=$b;?>&amp;p=<?=$p;?>'>Set Bookmark</a><br />
    <a href='index.php'>Book List</a>
    </div>
     
    <?
}else{    
echo "<div class='toc'>";
while (false !== ($entry = $d->read())) {
   if ( eregi('txt',$entry)){
        echo "<a href=\"index.php?b=$entry\">$entry</a>";
        if ($_COOKIE[str_replace('.','',$entry)]){
        	echo "[<a href=\"index.php?b=$entry&amp;p=".$_COOKIE[str_replace('.','',$entry)]."\">Go to bookmark</a>]";
        }
        
        echo "<br />";
   }
}
$d->close();
echo "</div>";

}
?> 
</body>
</html>
