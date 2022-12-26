<?php
/**
 * @file
 * Fetches data from DB and sends it to frontpage.
 * cool
 */

namespace Drupal\joblisting\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\joblisting\Service\EntityQueryService;
use Drupal\joblisting\Service\Utils;
use Symfony\Component\DependencyInjection\ContainerInterface;

class JobController extends ControllerBase
{
    protected EntityQueryService $query;
    protected Utils $utils;

    public function __construct(
        EntityQueryService $entityQueryService,
        Utils $utils
    ) {
        $this->query = $entityQueryService;
        $this->utils = $utils;
    }

    public static function create(ContainerInterface $container)
    {
        return new static(
            $container->get('joblisting.query'),
            $container->get('joblisting.utils')
        );
    }

    private function getJobs()
    {
        $title = \Drupal::request()->request->get('title');
        $location = \Drupal::request()->request->get('location');
        $locationS = \Drupal::request()->request->get('locationS');
        $fullTime = \Drupal::request()->request->get('fullTime');

        $results = $this->query->fetchJobs(
            $title,
            $location,
            $locationS,
            $fullTime
        );

        return $this->utils->loadJobs($results);
    }

    public function content()
    {
        $jobs = $this->getJobs();

        return [
            '#theme' => 'job-listing',
            '#jobs' => $jobs,
        ];
    }
}
