<?php

namespace Drupal\joblisting\Service;
use \Drupal\node\Entity\Node;


class Utils {

  public function loadJobs($results) {
    $jobs = [];

    foreach ($results as $nid) {
      $node = Node::load($nid);


      $created = $node->getCreatedTime();

      $jobs[$nid] = [
        'title' => $node->getTitle(),
        'created_at' => $this->calculatePassedTime((int)$created),
        'company' => $node->field_company_name->getValue()[0]['value'],
        'company_logo' => file_create_url($node->field_company_logo->entity->getFileUri()),
        'location' => $node->field_location->getValue()[0]['value'],
        'full_time' => $node->field_full_time->getValue()[0]['value'],
        'node_url' => $node->toUrl()->toString(),
        'nid' => $nid,
      ];
    }
    return $jobs;
  }
  public function calculatePassedTime($nodeCreated) {
    $current_time = time();
    $created_date = $nodeCreated;
    $timestamp = $current_time - $created_date;
    $time = $timestamp;
    if($time > 60){
      $time = floor((int)$time / 60 ) . 'm';
      $tm = rtrim($time,'m');
      if($tm >= 60) {
        $time = floor((int)$time / 60) . 'h';
        $tm = rtrim($time,'h');
        if($tm >= 24) {
          $time = floor((int)$time / 24) . 'd';
          $tm = rtrim($time,'d');
          if($tm >= 7){
            $time = floor($time / 7) . 'w';
            $tm = rtrim($time,'w');
            if($tm >= 5){
              $time = floor((int)$time / 5) . 'm';
              $tm = rtrim($time,'w');
              if($tm >= 12){
                $time = floor((int)$time / 12) . 'y';
              }
            }
          }
        }
      }
    }
    return $time;
  }
}
