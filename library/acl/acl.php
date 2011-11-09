<?php
/*
require_once 'Zend/Acl.php';
$acl=new Zend_Acl();

//add role
require_once 'Zend/Acl/Role.php';
$acl->addRole(new Zend_Acl_Role('22'));
$acl->addRole(new Zend_Acl_Role('basic'));

//add resource
require_once 'Zend/Acl/Resource.php';
$acl->add(new Zend_Acl_Resource('role'));

$acl->allow('22'); //this allows the premium role access to all defined resouces
$acl->deny('basic','role');

//access the ACL variable from anywhere
Zend_Registry::set('acl', $acl);
*/
require_once 'Zend/Db.php';

class ResAcl extends Zend_Acl{
	public function __construct()
	{
		//retrieve database from Registry
		$db=Zend_Registry::get('connectDb');
		$sql='	SELECT admin_role.role_id,privilege.module_name,privilege.controller_name 
				FROM privilege, rule, admin_role
				WHERE admin_role.role_id = rule.object_id
				AND rule.privilege_id = privilege.privilege_id';
		$resources=$db->query($sql);
		
		$sql='SELECT role_id, name FROM admin_role';
		$role=$db->query($sql);
		
		//Loop roles and put them in an assoc array by ID
		$roleArray = array();
		foreach ($role as $r)
		{
			$role=new Zend_Acl_Role($r['role_id']);
			$this->addRole($role);
			$roleArray[$r['role_id']] = $role;
		}
		
		foreach ($resources as $r)
		{
			$resources=new Zend_Acl_Resource($r['controller_name']);
			$this->add($resources);
			$role = $roleArray[$r['role_id']];
			$this->allow($role,$resources);
		}
		//access the ACL variable from anywhere
		//Zend_Registry::set('acl', $this);
	}
}

