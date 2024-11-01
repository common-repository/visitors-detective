<?

global $user_login,$table_prefix; get_currentuserinfo();

if(!is_super_admin() && filter_any_nations(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2))!='error'){
mysql_query("INSERT INTO ".$table_prefix."visitors (nation,site,ip,page,date,user) 
    VALUES(
    '".filter_any_nations(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2))."',
    '".(!empty($_SERVER['HTTP_REFERER'])?mysql_real_escape_string($_SERVER['HTTP_REFERER'].'?'.$_SERVER['QUERY_STRING']):'undefined')."',
    '".$_SERVER['REMOTE_ADDR']."',
    '".mysql_real_escape_string($_SERVER['PHP_SELF'].(!empty($_SERVER['QUERY_STRING'])?'?'.$_SERVER['QUERY_STRING']:''))."',
    '".date('Y-m-d H:i:s')."',
    '".(is_user_logged_in()?mysql_real_escape_string($user_login):'undefined')."')");
}

function filter_any_nations($st){
    
    switch($st){
        
        case 'en':
            if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,5)=='en-us') return 'USA';
            if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,5)=='en-ca') return 'Canada';
            if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,5)=='en-au') return 'Australia';
            if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,5)=='en-gb') return 'British';
            return 'English';
            break;
        case 'de':
            return 'German';
            break;
        case 'es':
            if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,5)=='es-pe') return 'Peru';
            if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,5)=='es-ar') return 'Argentina';
            if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,5)=='es-mx') return 'Mexico';
            return 'Spanish';
            break;
        case 'it':
            return 'Italy';
            break;
        case 'fr':
            return 'France';
            break;
        case 'ja':
            return 'Japan';
            break;
        case 'fi':
            return 'Finland';
            break;
        case 'uk':
            return 'Ukrain';
            break;
        case 'ru':
            return 'Russia';
            break;
        case 'pt':
            if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,5)=='pt-br') return 'Brazil';
            return 'Portugal';
            break;
        case 'p':
            return 'Poland';
            break;
        case 'ro':
            return 'Romania';
            break;
        case 'sk':
            return 'Slovakia';
            break;
        case 's':
            return 'Slovenia';
            break;
        case 'tr':
            return 'Turkey';
            break;
        case 'da':
            return 'Denmark';
            break;
        case 'et':
            return 'Estonia';
            break;
        case 'hr':
            return 'Croatia';
            break;
        case 'be':
            return 'Belarusia';
            break;
        case 'in':
            return 'Indonesia';
            break;
        case 'ko':
            return 'Korea';
            break;
        case 'sv':
            return 'Swedish';
            break;
        case 'no':
            return 'Norway';
            break;
        case 'zh':
            return 'China';
            break;
        case '':
            return 'error';
            break;
        default:
            return $st;
        
    }
}