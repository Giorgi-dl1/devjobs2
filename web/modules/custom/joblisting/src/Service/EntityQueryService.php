<?php

namespace Drupal\joblisting\Service;

use Drupal\Core\Entity\EntityTypeManagerInterface;

class EntityQueryService {

  protected EntityTypeManagerInterface $query;

  public function __construct(EntityTypeManagerInterface $query){
    $this->query = $query;
  }

  public function fetchJobs($title, $location, $locationS, $fullTime) {

    $nids = $this->query
      ->getStorage('node')
      ->getQuery()
      ->condition('type','job');

    if($title !== NULL) {
      $orGroup = $nids->orConditionGroup()
        ->condition('title.value',$title,'CONTAINS')
        ->condition('field_company_name',$title, 'CONTAINS');

      $nids->condition($orGroup);
    }

    if($location !== NULL) {
      $nids->condition('field_location', $location ,'CONTAINS');
    }

    if($locationS !== NULL) {
      $nids->condition('field_location', $locationS ,'CONTAINS');
    }

    if($fullTime == 'true') {
      $nids->condition('field_full_time', True, '=');
    }


    return $nids->execute();
  }

}
