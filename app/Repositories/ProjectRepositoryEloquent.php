<?php

namespace CodeProject\Repositories;


use CodeProject\Entities\Project;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ProjectRepositoryEloquent
 * @package namespace CodeProject\Repositories;
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    public function model()
    {
        return Project::class;
    }

    public function hasMembeer($projectId, $memberId)
    {
      $project = $this->find($projectId);
        foreach ($project->members as $member){
            If($member->id == $memberId){
                return true;
            }
        }
        return false;
    }
}
