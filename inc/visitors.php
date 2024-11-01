<?

if(is_admin()):
    global $table_prefix;
    include DVP.'/search.php';
    ?>
<style>
    xli{
        margin-right:5%;
        float:left;
    }
</style>
<div id="wrap">
    <br><center><h2>Visitors</h2></center>
    <div class="search-box" style="float:right;margin-bottom:1%;">
    <form action="?page=dtv" method="GET">
	<label class="screen-reader-text" for="post-search-input">Cerca articoli:</label>
        <input type="hidden" name="page" value="dtv">
	<input type="search" id="post-search-input" name="st_vsi" >
	<input type="submit" id="search-submit" class="button" value="Search types">
    </form></div>
    
    <?
       $min = (int)$_GET['min']>0 ? (int)$_GET['min'] : 0;
       $max = (int)$_GET['max']>0 ? (int)$_GET['max'] : 10;
       $total = mysql_query("SELECT * FROM ".$table_prefix."visitors");
       $select = mysql_query("SELECT * FROM ".$table_prefix."visitors ".$p_query." ORDER BY id DESC LIMIT $min,$max");
       $ct = mysql_num_rows($total);
       if(mysql_num_rows($select)==0) echo '<table class="wp-list-table widefat fixed posts" cellspacing="0"><center>None external visit, admin visits are not counted</center></table>';
       while($rows = mysql_fetch_object($select)):
           $i++; if($i==11) break;
           $site = htmlspecialchars($rows->site);
           $page = htmlspecialchars($rows->page);
    ?>
    <table class="wp-list-table widefat fixed posts" cellspacing="0">
				<th scope="row" class="check-column"></th>
						<td class="post-title page-title column-title">
        <xli>IP<br><strong><? echo $rows->ip; ?></strong></xli>
        <xli>Nation<br><strong><? echo $rows->nation; ?></strong></xli>
        <xli>From site<br><strong><a href='<? echo $site; ?>' title='<? echo $site; ?>'><? echo spzz($site); ?></a></strong></xli>
        <xli>Visit page<br><strong><a href='<? echo $page; ?>' title='<? echo $page; ?>'><? echo spzz($page); ?></a></strong></xli>
        <xli>Date<br><strong><? echo $rows->date; ?></strong></xli>
        <xli>User (if registered)<br><strong><? echo htmlspecialchars($rows->user); ?></strong></xli>
<div class="row-actions">	
</div></td>
</table><br>
    <? endwhile; ?>
<span class="displaying-num"><? echo get_navig($ct,$min,$max); ?></span><br>

<h3>Block ip:</h3>
<form action="?page=dtv" method="POST">
	<input type="search" id="post-search-input" name="ip" >
	<input type="submit" id="search-submit" class="button" value="Block ip!">
    </form>
<h3>Unlock ip:</h3>
<form action="?page=dtv" method="POST">
	<input type="search" id="post-search-input" name="ip_u" >
	<input type="submit" id="search-submit" class="button" value="Unlock ip!">
    </form>
</div>
    
<?

endif;

function spzz($string){
    
     return (strlen($string)>35) ? substr($string,0,35).'...' : $string;
}

function get_navig($count_total,$min,$max){
    
    if($count_total>10) $st = '<a href=\'?page=dtv'.get_search().'\' style=\'text-decoration:none;margin-left:2%;\'><<<</a> ';
    if($min>0 && $min<=$count_total) $st .= '<a href=\'?page=dtv&min='.($min-10).'&max='.($max-10).get_search().'\' style=\'text-decoration:none;margin-left:1%;margin-right:2%;\'><<</a> ';
    if($max>0 && $count_total>$max) $st .='<a href=\'?page=dtv&min='.($min+10).'&max='.($max+10).get_search().'\' style=\'text-decoration:none;margin-left:2%;margin-right:1%;\'>>></a> ';
    $tt = round($count_total%10);
    if($count_total>10) $st.='<a href=\'?page=dtv&min='.($count_total-$tt).'&max='.($count_total+(10-$tt)).get_search().'\' style=\'text-decoration:none;margin-right:2%;\'>>>></a>';
    return $st;
}

function get_search(){
    if(!empty($_GET['st_vsi'])) return '&st_vsi='.$_GET['st_vsi'];
}
?>