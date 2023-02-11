<?php 

namespace App\Core;

use Symfony\Component\Routing\RouteCollection;

class Controller
{
	public function __construct(
		public RouteCollection $routes,
    ) {}
}