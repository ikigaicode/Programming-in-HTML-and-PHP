<html>
  <head>
    <title>Stacks and Queues</title>
  </head>

  <body>
  <?php
    $a = array(-17, "David", 33.3, "Laura");
    //Treat $a like a stack (last in, first out)...
    echo "The original array (element [0] is the \"oldest\" element): <br />";
    print_r($a);

    //Add two elements to $a...
    array_push($a, "Susan", 0.5);
    echo "<br /> Push two elements on top of stack: <br />";
    print_r ($a);

    // Remove three elements from $a...
    array_pop($a); array_pop($a); array_pop($a);
    echo "<br /> Remove three elements from top of stacks: <br />";
    print_r($a);

    //Treat $a like a queue (first in, first out)...
    $a = array(-17, "David", 33.3, "Laura");
    echo "<br /> Back to original array: <br />";
    print_r($a);

    echo "<br /> Remove two elements from front of queue; <br />";
    array_shift($a);
    array_shift($a);
    print_r($a);

    echo "<br />Add three elements to end of queue: <br />";
    array_push($a, "Susan", 0.5, "new_guy");
    print_r($a);

    echo "<br /> Add a \"line crasher\" to the beginning of the queue: <br />";
    array_unshift($a, "queue_crasher_guy");
    print_r($a);
   ?>
  </body>
</html>
