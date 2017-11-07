<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerBase
 *
 * @author Tomek
 */
abstract class ControllerBase
{
    protected $args = array();
    
    /**
     *
     * @var Smarty
     */
    protected static $view;
    
    /**
     *
     * @var Auth
     */
    protected static $auth;
    
    private $_requireUserAccess = array();
    
    private $_ajaxActions = array();
    
    public function accessGranted($action)
    {
        $action = strtolower($action);
        if  (
                array_key_exists($action, $this->_requireUserAccess)
                &&
                (
                    !self::$auth->isLoggedIn()
                    ||
                    (
                        self::$auth->getUser()->accessLevel
                        <
                        $this->_requireUserAccess[$action]
                    )
                )
            ) {
            return false;
        }
        return true;
    }
    
    protected function requireUserAccess($action, $accessLevel = 1)
    {
        $this->_requireUserAccess[strtolower($action)] = $accessLevel;
    }
    
    protected function addAjax($action)
    {
        $this->_ajaxActions[] = $action;
    }
    
    public function isAjax($action)
    {
        return (\in_array($action, $this->_ajaxActions));
    }
    
    public static function setView($view)
    {
        self::$view = $view;
    }           
    
    public static function setAuth($auth)
    {
        self::$auth = $auth;
    }
    
    public function __construct($args = array()) {
        $this->args = $args;
        $adminProjectBadge = ActiveRecord::countQuery('projects', 'active = TRUE AND sent > 0');
        $adminProjectBadge2 = ActiveRecord::countQuery('projects', 'status = 1');
        $projectManagerBadges = array();
        foreach (ActiveRecord::countQuery('projects', 'status = 0 GROUP BY kierownik_id', true, 'kierownik_id,') as $row) {
            $projectManagerBadges[$row['kierownik_id']] = $row['COUNT(*)'];
        }
//        $projectObject = new Project;
//        $projectsToSend = $projectObject->getWhere('active = TRUE AND sent > 0');
//        $projectsToAccept = $projectObject->getWhere('status = 1');
//        $projectsForManagers = array();
//        
        self::$view->assign('projectBadge', $adminProjectBadge ? $adminProjectBadge : '');
        self::$view->assign('projectBadge2', $adminProjectBadge2 ? $adminProjectBadge2 : '');
        self::$view->assign('projectManagerBadges', $projectManagerBadges);
    }
    
    abstract public function index();
}
