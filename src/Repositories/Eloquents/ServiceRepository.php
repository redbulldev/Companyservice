<?php

namespace Companyservice\Repositories\Eloquents;

use Companyservice\Repositories\Contracts\ServiceRepositoryInterface;
use Companybase\Repositories\Eloquents\AbstractRepository;
use Companyservice\Models\Service;

class ServiceRepository extends AbstractRepository implements ServiceRepositoryInterface
{
	protected $service;

	function __construct(Service $service)
	{
		$this->service = $service;

		parent::__construct($service);
	}

}
