<?php
class clsGroup
{
    private $groupName;
    private $participants;
    private $role;
    private $status;
    
    public function __construct($groupName, $participants = [], $role, $status) {
        $this->groupName = $groupName;
        $this->participants = $participants;
        $this->role = $role;
        $this->status = $status;
    }
}
?>