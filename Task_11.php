<?php

class Point {

    private int $x;
    private int $y;

    public function __construct(int $x, int $y) {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX() {
        return $this->x;
    }

    public function getY() {
        return $this->y;
    }
    
    public function __toString() {
        return '(' . $this->x . ', ' . $this->y . ')';
    } 
}

class Path {

    private $points = array();

    public function __toString() {
        $str = '';
        foreach ($this->points as $point) {
            $str .= $point . ' ';
        }
        return $str;
    }

    public function addPoint(Point $point) {
        $this->points[] = $point;
    }

    public function createNewPath(Point $point): Path {
        $t = new Path();
        foreach ($this->points as $p) {
            $t->addPoint($p);
        }
        $t->addPoint($point);
        return $t;
    }

    public function getPoints() {
        return $this->points;
    }

    public function getPointsCount() {
        return count($this->points);
    }

    public function hasPoint(Point $point) {
        foreach ($this->points as $p) {
            if ($p->getX() == $point->getX() && 
                $p->getY() == $point->getY()) {
                return true;
            }
        }
        return false;
    }
}

class BFS {

    private $maze;
    private $size;
    private $shortestPath;

    public function __construct(int $size, Point $pointA, Point $pointB) {

        $this->size = $size;
        $this->createMaze();
        
        if ($this->maze[$pointA->getX()][$pointA->getY()]) {
            $this->shortestPath = "no path from $pointA to $pointB";
            return;
        }
        
        $minPath = new Path();
        $minPath->addPoint($pointA);
        $allPaths = $this->findAllPaths($minPath, $pointA, $pointB);
        
        if ($allPaths == NULL) {
            $this->shortestPath = "no path from $pointA to $pointB";
        } else {
            $this->shortestPath = $this->findShortestPath($allPaths);
        }
    }

    private function get1or0() {
        $num = rand(0, 3);
        return $num == 0 ? 1 : 0;
    }

    private function createMaze() {
        for ($i = 0; $i < $this->size; $i++) {
            for ($j = 0; $j < $this->size; $j++) {
                $this->maze[$i][$j] = $this->get1or0();
            }
        }
    }

    public function printMaze() {
        for ($i = 0; $i < $this->size; $i++) {
            for ($j = 0; $j < $this->size; $j++) {
                echo $this->maze[$i][$j] . ' ';
            }
            echo '</br>';
        }
    }

    public function printShortestPath() {
        echo $this->shortestPath;
    }

    private function findNeighbours(Point $point) {
        $neighbours = array();
        if ($point->getX() < $this->size - 1 && $this->maze[$point->getX() + 1][$point->getY()] == 0) {
            $neighbours[] = new Point($point->getX() + 1, $point->getY());
        }
        if ($point->getX() > 0 && $this->maze[$point->getX() - 1][$point->getY()] == 0) {
            $neighbours[] = new Point($point->getX() - 1, $point->getY());
        }
        if ($point->getY() < $this->size - 1 && $this->maze[$point->getX()][$point->getY() + 1] == 0) {
            $neighbours[] = new Point($point->getX(), $point->getY() + 1);
        }
        if ($point->getY() > 0 && $this->maze[$point->getX()][$point->getY() - 1] == 0) {
            $neighbours[] = new Point($point->getX(), $point->getY() - 1);
        }
        return $neighbours;
    }

    private function findAllPaths(Path $path, Point $pointA, Point $pointB) {
        $neighbours = $this->findNeighbours($pointA);
        if (count($neighbours) == 0) {
            return NULL;
        }
        $allPaths = array();
        foreach ($neighbours as $point) {
            if ($path->hasPoint($point)) {
                continue;
            }
            if ($point == $pointB) {
                $allPaths[] = $path->createNewPath($point);
            }
            else {
                $newPaths = $this->findAllPaths($path->createNewPath($point), $point, $pointB);
                foreach ($newPaths as $p) {
                    $allPaths[] = $p;
                }
            }
        }
        return $allPaths;
    }

    private function findShortestPath($paths): Path {
        for ($i = 0; $i < count($paths); $i++) {
            for ($j = 0; $j < count($paths) - 1; $j++) {
                if (count($paths[$j]->getPoints()) > count($paths[$j + 1]->getPoints())) {
                    $temp = $paths[$j];
                    $paths[$j] = $paths[$j + 1];
                    $paths[$j + 1] = $temp;
                }
            }
        }
        return $paths[0];
    }
}

$bfs = new BFS(5, new Point(2, 2), new Point(0, 1));
$bfs->printMaze();
$bfs->printShortestPath();

echo '</br> </br>';

$str = serialize($bfs);
file_put_contents('log', $str);
$str = file_get_contents('log');
$bfs2 = unserialize($str);
$bfs2->printMaze();
$bfs2->printShortestPath();

?>