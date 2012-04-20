<?php 
 
function browser_body_class($classes) {
   global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone, $is_firefox_3, $is_windows, $is_linux, $is_mac;

   $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
   
   $platform = 'linux';
   if(strpos($user_agent, 'windows'))
           $platform = 'win';
   elseif(strpos($user_agent, 'macintosh'))
           $platform = 'mac';
   
   if ($is_iphone) {
       $classes[] = 'iphone';
       $platform = 'iphone';
   } else
       $classes[] = $platform;
   
   global ${'is_'.$platform};
   ${'is_'.$platform} = true;
   
   if ($is_lynx)
       $classes[] = 'lynx';
   elseif ($is_gecko)
       $classes[] = 'gecko';
   elseif ($is_opera)
       $classes[] = 'opera';
   elseif ($is_NS4)
       $classes[] = 'ns4';
   elseif ($is_safari)
       $classes[] = 'safari';        
   elseif ($is_chrome)
       $classes[] = 'chrome';
   elseif ($is_IE)
       $classes[] = 'ie';
   else
       $classes[] = 'unknown';
           
   // firefox version detection
   $browser = 'firefox';
   if (preg_match("#{$browser}/([0-9]+).([0-9]+)\.#", $user_agent, $match)) {
       $classes[] = $browser . $match[1]. '_' . $match[2];

       global ${'is_'.$browser.$match[1].'_'.$match[2]};
       
       ${'is_'.$browser.$match[1].'_'.$match[2]} = true;
   } 
   
   if (preg_match("#{$browser}/([0-9]+)\.#", $user_agent, $match)) {
       $classes[] = $browser . $match[1];

       global ${'is_'.$browser.$match[1]};
       
       ${'is_'.$browser.$match[1]} = true;
   }
   
   // msie version detection
   
   $browser = 'msie';
  
   if (preg_match("#{$browser} ([0-9]+).([0-9]+)\.#", $user_agent, $match)) {
       $classes[] = 'ie' . $match[1]. '_' . $match[2];

       global ${'is_ie'.$match[1].'_'.$match[2]};
       
       ${'is_ie'.$match[1].'_'.$match[2]} = true;
   }
   
   if (preg_match("#{$browser} ([0-9]+)\.#", $user_agent, $match)) {
       $classes[] = 'ie' . $match[1];

       global ${'is_ie'.$match[1]};
       
       ${'is_ie'.$match[1]} = true;
   }
   
   if (preg_match("#trident/([0-9]+)\.#", $user_agent, $match)) {
   	 $agent = false;
   	 switch($match[1]) :
   	 	case 4:
   	 		if(!$is_ie8)
       			$agent = '8compat';
   	 		break;
   	   case 5:
   	 		if(!$is_ie9)
   	      	$agent = '9compat';
   	   	break;
   	   case 6:
   	 		if(!$is_ie10)
   	      	$agent = '10compat';
   	   	break;
   	 endswitch;

		 if($agent) {
	   	 $classes[] = 'ie'.$agent;
	   	 
	       global ${'is_ie'.$agent};
	       
	       ${'is_ie'.$agent} = true;
       }
   }
   
   // chrome version detection
   $browser = 'chrome';
   if (preg_match("#{$browser}/([0-9]+)\.#", $user_agent, $match)) {
       $classes[] = $browser . $match[1];

       global ${'is_'.$browser.$match[1]};
       
       ${'is_'.$browser.$match[1]} = true;
   }
   
   // chrome version detection
   $browser = 'opera';
   if (preg_match("#{$browser}/([0-9]+)\.#", $user_agent, $match)) {
       $classes[] = $browser . $match[1];

       global ${'is_'.$browser.$match[1]};
       
       ${'is_'.$browser.$match[1]} = true;
   }
   if (preg_match("#{$browser}/([0-9]+).([0-9]+)\.#", $user_agent, $match)) {
       $classes[] = $browser . $match[1]. '_' . $match[2];

       global ${'is_'.$browser.$match[1].'_'.$match[2]};
       
       ${'is_'.$browser.$match[1].'_'.$match[2]} = true;
   }
   
   if (strpos($user_agent, 'firefox')) {
       $classes[] = 'firefox';
       global $is_firefox;
       $is_firefox = true;
   }
   
   return $classes;
}

function admin_browser_body_class($classes) {
	return implode(' ', browser_body_class(explode(' ', $classes)));
}

add_filter('body_class', 'browser_body_class');
add_filter('admin_body_class', 'admin_browser_body_class');

?>