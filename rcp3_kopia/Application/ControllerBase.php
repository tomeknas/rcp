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
        //  count
        $this->args = $args;
        $adminProjectBadge = ActiveRecord::countQuery('projects', 'active = TRUE AND sent > 0');
        $adminProjectBadge2 = ActiveRecord::countQuery('projects', 'status = 1');
        $projectManagerBadges = array();
        foreach (ActiveRecord::countQuery('projects', 'status = 0 GROUP BY kierownik_id', true, 'kierownik_id,') as $row) {
            if($row['kierownik_id']){
            $projectManagerBadges[$row['kierownik_id']] = $row['COUNT(*)'];  
            }
        }
        $projectCoordinator = array();
        foreach (ActiveRecord::countQuery('projects', 'status = 0 GROUP BY koordynator', true, 'koordynator,') as $row) {
            if($row['koordynator']){
            $projectCoordinator[$row['koordynator']] = $row['COUNT(*)'];   
            }
        }

       // count

        // array of project name
        $projectObject = new Project;
        

       foreach ($projectObject->getWhere('active = TRUE AND sent > 0') as $row) {
            $toSend[] = $row['name'];
       }
       $projectsToSend = implode(", ", $toSend);
    
       
        $p = $projectObject->getWhere("status = 0");
        foreach ($p as $row) {       
            if(isset($projectsForManager[$row['projectManagerId']])) {
                $temp = ',  '.$row['name'];
                $projectsForManager[$row['projectManagerId']] .= $temp;
                   }else{
                     $projectsForManager[$row['projectManagerId']] = $row['name']; 
                }
             }

        $d = $projectObject->getWhere("status = 0");
        foreach ($d as $row) {       
            if(isset($projectsForCoordinator[$row['projectCoordinator']])) {
                $temp = ',  '.$row['name'];
                $projectsForCoordinator[$row['projectCoordinator']] .= $temp;
                   }else{
                     $projectsForCoordinator[$row['projectCoordinator']] = $row['name']; 
                }
             }
               
   

        foreach (($projectObject->getWhere('status = 1')) as $row) {
           $toAccept[] = $row['name'];
       }
    
       $projectsToAccept = implode(", ", $toAccept);
          
        // array of project name
        


        self::$view->assign('projectsToSend', $projectsToSend ? $projectsToSend : '');
        self::$view->assign('projectsForManager', $projectsForManager ? $projectsForManager : '');
        self::$view->assign('projectsForCoordinator', $projectsForCoordinator ? $projectsForCoordinator : ''); 
        self::$view->assign('projectsToAccept', $projectsToAccept ? $projectsToAccept : ''); 
       
        self::$view->assign('projectBadge', $adminProjectBadge ? $adminProjectBadge : '');
        self::$view->assign('projectManagerBadges', $projectManagerBadges ? $projectManagerBadges: '');
        self::$view->assign('projectCoordinator', $projectCoordinator ? $projectCoordinator: '');
        self::$view->assign('projectBadge2', $adminProjectBadge2 ? $adminProjectBadge2 : '');
        
    }
    
    abstract public function index();
}
