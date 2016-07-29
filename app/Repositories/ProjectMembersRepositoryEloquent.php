<?php

namespace CodeProject\Repositories;

use CodeProject\Entities\ProjectMember;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ProjectMembersRepositoryEloquent
 * @package namespace CodeProject\Repositories;
 */
class ProjectMembersRepositoryEloquent extends BaseRepository implements ProjectMembersRepository
{

    public function model()
    {
        return ProjectMember::class;
    }

}
