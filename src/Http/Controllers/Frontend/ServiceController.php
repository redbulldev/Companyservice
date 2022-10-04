<?php

declare(strict_types=1);

namespace Companyservice\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Companybase\Http\Controllers\Frontend\BaseController;
use Illuminate\Http\Request;
use Companyservice\Models\Service;

class ServiceController extends BaseController
{
    public $service;

    public function __construct(Service $service)
    {
		parent::__construct();

        $this->service = $service;
    }

    public function index()
    {
        $services = $this->getServices(5);

        $featurePosts = $this->getFeaturePosts();

        $tags = $this->getTags();

        return view('companybase::frontend.service.index', compact('services', 'featurePosts', 'tags'));
    }

    public function detail($id)
    {
        $service = $this->service->where('id', $id)->first();

        return view('companybase::frontend.service.detail', compact('service'));
    }

}

