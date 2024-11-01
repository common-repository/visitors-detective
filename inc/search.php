<?

if(is_admin()):
    
    if(!empty($_GET['st_vsi']) && $s = mysql_real_escape_string($_GET['st_vsi']))
        
        $p_query = analize($s)!=false ? analize($s) : 
        "WHERE user LIKE '%$s%' OR nation LIKE '%$s%' OR site LIKE '%$s%' OR page LIKE '%$s%' OR ip LIKE '%$s%' OR date LIKE '%$s%'";
    
    if(!empty($_POST['ip'])){
        
        $ip_list = file(DVP.'/ip_list.php');
        
        if(in_array($_POST['ip']."\n",$ip_list)) base_message('Ip already blocked!','error');
        elseif($_POST['ip']==$_SERVER['REMOTE_ADDR']) base_message('Can\'t block your ip!','error');
        else{
            if(filter_var($_POST['ip'],FILTER_VALIDATE_IP)){
                fwrite(fopen(DVP.'/ip_list.php','a+'),$_POST['ip']."\n");
                base_message('Ip blocked!','updated');
            }else base_message('Invalid ip!','error');
        }
        
    }
    
    if(!empty($_POST['ip_u'])){
        
        $ip_list = file(DVP.'/ip_list.php');
        $total_ip='';
        
        foreach($ip_list as $ip) $total_ip .=$ip;
        
        if(substr_count($total_ip,$_POST['ip_u'])==1 && filter_var($_POST['ip_u'],FILTER_VALIDATE_IP)){
                fwrite(fopen(DVP.'/ip_list.php','w'),str_replace($_POST['ip_u']."\n",'',$total_ip));
                base_message('Ip unlocked!','updated');
            }else base_message('Invalid ip or not blocked!','error');
    }
    
        
    
endif;

function base_message($st,$type){
    echo '<br><div class="'.$type.'"><p>'.$st.'</p></div>';
}

function analize($s){
        $st = "WHERE ";
        
        if(filter_var($s,FILTER_VALIDATE_IP)) $st .= "ip LIKE '%$s%'";
        
        elseif(filter_var($s,FILTER_VALIDATE_URL) || substr($s,0,1)=='/') $st .= "site LIKE '%$s%' OR page LIKE '%$s%'";
        
        elseif(strtotime($s)) $st .= "date LIKE '%$s%'";
        
        elseif(substr_count($s,' ')==0) $st .= "user LIKE '%$s%' OR nation LIKE '%$s%'";
        
        else $st = false;
        
        return $st;
    }