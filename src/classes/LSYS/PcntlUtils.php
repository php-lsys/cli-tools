<?php
/**
 * lsys pcntl tools function
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @copyright  (c) 2007-2012 Kohana Team
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 * @license    http://kohanaframework.org/license
 */
namespace LSYS;
class PcntlUtils{
    /**
     * set cli auto restart
     * @return boolean
     */
    static public function  setRestart() {
        if(DIRECTORY_SEPARATOR == '\\'&&!function_exists('pcntl_fork'))return false;
        runer_frok:
        $pid = pcntl_fork();
        if ($pid == -1) die(pcntl_get_last_error());
        else if ($pid) {
            unset($pid);
            $status=null;
            pcntl_wait($status,WUNTRACED);
            goto runer_frok;
        }
        return true;
    }
    /**
     * set cli exe user
     * @param string $user
     * @return boolean
     */
    static public function setUser($user=null,$cli_param='-u') {
        global $argv;
        if (!function_exists('pcntl_fork'))return false;
        if (empty($user)){
            $is_u=null;
            foreach($argv as $u){
                if(isset($is_u)){
                    $user=trim($u);break;
                }
                if($u==$cli_param)$is_u=true;
            }
            if (empty($user)){
                $web_user=array('nobody','www');
                foreach ($web_user as $u){
                    $userinfo = posix_getpwnam($u);
                    if(isset($userinfo['uid'])){
                        break;
                    }
                }
            }
        }
        if(!empty($user))$userinfo = posix_getpwnam($user);
        if(!isset($userinfo['uid'])) throw new \Exception("can't find user:".$user);
        @posix_setuid($userinfo['uid']);
        return true;
    }
}