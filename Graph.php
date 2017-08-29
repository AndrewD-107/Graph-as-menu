<?php
	
namespace graph_as_menu;

class Graph
{
	protected $list = []; // $list[$id] = $parent;
	
	public function __construcrt($list)
	{
		$this->list = $list;
	}
	
	public function getPointsArray($id)
	{
		$points_array = [];
		$related_points = $this->getRelatedPoints($id);
		foreach ($related_points as $related_point_id) {
			$sub_points = $this->getRelatedPoints($related_point_id);
			if ($sub_point) $points_array[$related_point_id] = $this->getPointsArray($related_point_id);
			else $points_array[$related_point_id] = 0;
		}
		return $points_array;
	}
	
	protected function getRelatedPoints($point_id)
	{
		$related_points = [];
		foreach ($this->list as $id => $point)
			if ($point === $id) array_push($related_points, $id);
		return $related_points;
	}
	
	protected function pointsToTop($id, &$points)
	{
		array_push($points, $id);
		if ($this->list[$id] !== 0)
			$this->setPointsToTop($this->list[$id], $points);
	}
	
	protected function pointsToDown($id, &$points)
	{
		$related_points = $this->getRelatedPoints($id);
		foreach ($related_points as $related_point_id) {
			array_push($points, $related_point_id);
			$related_points = $this->getRelatedPoints($related_point_id);
			if ($related_points) $this->pointsToDown($related_point_id, $points);
		}
	}
}
?>