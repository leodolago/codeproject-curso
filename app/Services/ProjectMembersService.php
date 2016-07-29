<?php
/**
 * Created by PhpStorm.
 * User: leodolago
 * Date: 30/05/2016
 * Time: 09:11
 */

namespace CodeProject\Services;

use CodeProject\Entities\Project;
use CodeProject\Entities\ProjectMember;
use CodeProject\Http\Controllers\ProjectController;
use CodeProject\Providers\CodeProjectRepositoryProvider;
use CodeProject\Repositories\ProjectMembersRepository;

class ProjectMembersService
{
    /**
     * @var ProjectMembersRepository
     */
    protected $repository;

    public function __construct(ProjectMembersRepository $repository)
    {
        $this->repository = $repository;
    }
    
    public function addMember($id, $memberId)
    {
       

        $id->members()->attach(3);


    }
    
}